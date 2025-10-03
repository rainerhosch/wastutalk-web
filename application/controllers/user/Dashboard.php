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
        if ($this->session->has_userdata('email') == null) {
            $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button> <h4><i class='icon fa fa-warning'></i> Alert!</h4> Harus Login Terlebih Dahulu</div>");
            redirect(base_url());
        }
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
        $data['content'] = 'user/dashboard';
        $limit = 3;
		$where = array(
			'sesi_date >=' => date('Y-m-d')
		);
		$data['event_list'] = $this->event->getEvent($where, $limit, "")->result_array();
        $this->load->view('admin_layout', $data);
    }
}