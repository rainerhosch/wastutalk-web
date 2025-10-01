<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
    *  File Name             : Dashboard.php
    *  File Type             : Controller
    *  File Package          : CI_Controller
    ** * * * * * * * * * * * * * * * * * **
    *  Author                : Rizky Ardiansyah
    *  Date Created          : 30/09/2025
    *  Quots of the code     : 'Hanya seorang yang hobi berbicara dengan komputer.'
*/
class Dashboard extends CI_Controller
{
        public function __construct()
        {
            parent::__construct();
            date_default_timezone_set('Asia/Jakarta');
            $now = date('Y-m-d H:i:s');
            $pecah_tgl_waktu = explode(' ', $now);
            $this->tgl = $this->formattanggal->konversi($pecah_tgl_waktu[0]);
            $this->time = $pecah_tgl_waktu[1];
    
            $this->load->model('Event_model', 'event');
        }

        public function index()
        {
            $data['title'] = 'WastuTalk';
            $data['page'] = 'Dashboard';
            $data['content'] = 'admin/dashboard';
            $offset = $this->event->getEvent()->num_rows();
            // var_dump($offset);
            $limit = 3;
            // die;
            $offset = ($offset - $limit);
            $data['total_event'] = $this->event->getEvent()->num_rows();
            $this->load->view('admin_layout', $data);
        }
}