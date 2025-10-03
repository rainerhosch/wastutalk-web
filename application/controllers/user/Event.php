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
        if ($this->session->has_userdata('email') == null) {
            $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button> <h4><i class='icon fa fa-warning'></i> Alert!</h4> Harus Login Terlebih Dahulu</div>");
            redirect(base_url());
        }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Event_model', 'event');
        $this->load->model('participant_model');
        $this->load->model('User_model', 'user');
    }

    public function index()
    {
        $data['title'] = 'WastuTalk';
        $data['page'] = 'Event';
        $data['content'] = 'user/event/index';
        $this->load->view('admin_layout', $data);
    }

    public function register($event_id)
    {
        if ($this->session->userdata('role')) {
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->user->getUser(['id'=>$user_id])->result();
            // var_dump($data);die;

            // Cek jika sudah terdaftar, redirect ke halaman sukses
            if ($this->participant_model->is_registered($user_id)) {
                redirect('event/success');
            }
            $limit = 3;
        
            $data['event_latest'] = $this->event->getEvent(null, $limit, "")->result();

            // Tampilkan form pendaftaran
            $data['title'] = 'WastuTalk';
            $data['page'] = 'Register Event';
            $data['content'] = 'user/event/registration_view';
            $data['event_id'] = $event_id;
            $this->load->view('admin_layout', $data);
        } else {
            // Jika belum login, arahkan ke halaman login
            redirect('auth');
        }
    }
    public function get_event_list()
    {
        $user_id = $this->session->userdata('user_id');
        $where = array(
            'p.user_id' => $user_id
        );
        $data['event_list'] = $this->participant_model->get_list_event($where)->result();
        // $data['last_query'] = $this->db->last_query();
        $response = [
            'status' => true,
            'data' => $data
        ];
        echo json_encode($response);
    }

    public function process_registration()
    {
        // Pastikan pengguna sudah login
        if ($this->session->userdata('user_id')) {
            $user_id = $this->session->userdata('user_id');

            // Ambil data yang dibutuhkan dari form (jika ada)
            // Misalnya: $event_id = $this->input->post('event_id');
            $event_id = 1; // Contoh: ID event statis

            $data = array(
                'user_id' => $user_id,
                'event_id' => $event_id,
                'registration_date' => date('Y-m-d H:i:s')
            );

            // Simpan data pendaftaran ke database
            $this->participant_model->register_participant($data);

            // Redirect ke halaman sukses
            redirect('user/event/success');
        } else {
            redirect('auth');
        }
    }

    public function success()
    {
        // Halaman yang menampilkan pesan sukses
        $data['title'] = 'WastuTalk';
        $data['page'] = 'Success';
        $data['content'] = 'user/event/success_view';
        $this->load->view('admin_layout', $data);
    }

}