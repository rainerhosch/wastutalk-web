<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : Event.php
 *  File Type             : Controller
 *  File Package          : CI_Controller
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 03/10/2025
 *  Quots of the code     : 'Hanya seorang yang hobi berbicara dengan komputer.'
 */
class Event extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('google');
        $this->load->model('Event_model', 'event');
        $this->load->model('participant_model');
        $this->load->model('User_model', 'user');
        $this->load->model('Presensi_model', 'presensi_model');
    }
    public function index()
    {

        $data['title'] = 'WastuTalk';
        $data['page'] = 'Daftar Event';
        $data['content'] = 'event/list';
        $limit = 10;
        $data['event_latest'] = $this->event->getEvent(null, $limit, "")->result();
        $this->load->view('layout', $data);
    }
    public function detail()
    {
        $id = $this->input->get('id');
        $data['title'] = 'WastuTalk';
        $data['page'] = 'Detail Event';
        $data['content'] = 'event/detail';
        $limit = 3;
        $data['event_latest'] = $this->event->getEventById($id)->row();
        $data['regist_button'] = $this->google->get_client()->createAuthUrl();
        $this->load->view('layout', $data);
    }

    public function presensi()
    {
        $datetime_now = date('Y-m-d H:i:s');
        $id = $this->input->get('id');
        $event_latest = $this->event->getEventById($id)->row();
        
        if (!$event_latest) {
            redirect('event');
        }

        $event_start = $event_latest->sesi_date . ' ' . $event_latest->start_time;
        $event_end = $event_latest->sesi_date . ' ' . $event_latest->end_time;

        if ($datetime_now > $event_end) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger text-center">Event sudah selesai</div>');
            redirect('event/detail?id=' . $id);
        } elseif ($datetime_now < $event_start) {
            $this->session->set_flashdata('alert', '<div class="alert alert-warning text-center">Event belum dimulai</div>');
            redirect('event/detail?id=' . $id);
        } else {
            // Jika ada external URI dan dipaksa (bisa ditambahkan kondisinya), untuk sekarang langsung pakai form internal
            $data['title'] = 'WastuTalk Presensi';
            $data['page'] = 'Presensi Event';
            $data['content'] = 'event/presensi';
            $data['event'] = $event_latest;
            $this->load->view('layout', $data);
        }
    }

    public function submit_presensi()
    {
        $id_event = $this->input->post('id_event');
        $kode_participant = $this->input->post('kode_participant');
        
        // Cek apakah sudah pernah presensi
        if ($this->presensi_model->check_already_presensi($id_event, $kode_participant)) {
            $this->session->set_flashdata('alert', '<div class="alert alert-warning text-center">Anda sudah melakukan presensi untuk event ini.</div>');
            redirect('event/presensi?id=' . $id_event);
            return;
        }

        $data = [
            'id_event' => $id_event,
            'kode_participant' => $kode_participant,
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'no_hp' => $this->input->post('no_hp'),
            'institusi' => $this->input->post('institusi'),
            'program_studi' => $this->input->post('program_studi'),
            'time_stamp' => date('Y-m-d H:i:s')
        ];

        $insert = $this->presensi_model->insert_presensi($data);
        if ($insert) {
            $this->session->set_flashdata('alert', '<div class="alert alert-success text-center">Presensi berhasil disubmit. Terima kasih!</div>');
            redirect('event/detail?id=' . $id_event);
        } else {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger text-center">Terjadi kesalahan, gagal menyimpan data.</div>');
            redirect('event/presensi?id=' . $id_event);
        }
    }

    public function register()
    {
        if (isset($_GET['code'])) {
            $token = $this->google->get_client()->fetchAccessTokenWithAuthCode($_GET['code']);
            if (!isset($token['error'])) {
                $this->google->get_client()->setAccessToken($token);

                $google_service = new Google_Service_Oauth2($this->google->get_client());
                $user_info = $google_service->userinfo->get();

                $google_id = $user_info->id;
                $user = $user_info->name;
                $email = $user_info->email;
                $profile_picture = $user_info->picture;

                $user = $this->user->get_user_by_google_id($google_id);

                if (!$user) {
                    // Registrasi pengguna baru
                    $data = array(
                        'google_id' => $google_id,
                        'name' => $user,
                        'email' => $email,
                        'role' => 7,
                        'profile_picture_url' => $profile_picture,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                    $this->user->insert_data('sys_users', $data);
                }

                // Buat sesi pengguna
                $session_data = array(
                    'nama' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'pic' => $user->profile_picture_url
                );
                $this->session->set_userdata($session_data);
                $cek_user = $this->user->get_user_by_google_id($google_id);
                // Cek apakah pengguna sudah terdaftar sebagai peserta
                if ($this->participant_model->is_registered($cek_user->id)) {
                    // Jika sudah, arahkan ke halaman berhasil daftar
                    $this->session->set_flashdata('success', 'Pendaftaran peserta event, berhasil!');
                    redirect('user/event/success');
                } else {
                    // Jika belum, arahkan ke halaman pendaftaran event
                    redirect('user/event/register');
                }
            }
        }
    }
}