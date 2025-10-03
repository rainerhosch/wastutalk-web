<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        // $pecah_tgl_waktu = explode(' ', $now);
        // $this->tgl = $this->formattanggal->konversi($pecah_tgl_waktu[0]);
        // $this->time = $pecah_tgl_waktu[1];

        $this->load->model('Event_model', 'event');
    }
	public function index()
	{
        
        $data['title'] = 'WastuTalk';
        $data['page'] = 'Beranda';
        $data['content'] = 'page/beranda';
        $limit = 3;
        
		$data['event_latest'] = $this->event->getEvent(null, $limit, "")->result();
		$this->load->view('layout', $data);
	}
}
