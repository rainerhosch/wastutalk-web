<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : Laporan.php
 *  File Type             : Controller
 *  File Package          : CI_Controller
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 20/05/2026
 *  Quots of the code     : 'Hanya seorang yang hobi berbicara dengan komputer.'
 */
class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->has_userdata('email') == null) {
            $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button> <h4><i class='icon fa fa-warning'></i> Alert!</h4> Harus Login Terlebih Dahulu</div>");
            redirect(base_url());
        }
        if (!in_array($this->session->userdata('role'), [1, 2])) {
            redirect(base_url('user/dashboard'));
        }
        $this->load->model('Event_model', 'event');
        date_default_timezone_set('Asia/Jakarta');
    }
    
    public function event()
    {
        $data['title'] = 'WastuTalk';
        $data['page'] = 'Laporan Event';
        $data['content'] = 'admin/laporan/event';
        $this->load->view('admin_layout', $data);
    }
}