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
            $this->load->model('Event_model', 'event');
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
            $this->load->view('layout', $data);
        }

        public function regist()
        {
        }
}