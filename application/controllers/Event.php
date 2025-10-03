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