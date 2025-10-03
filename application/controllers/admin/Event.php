<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : Event.php
 *  File Type             : Controller
 *  File Package          : CI_Controller
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 01/10/2025
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
        if (!in_array($this->session->userdata('role'), [1, 2])) {
            redirect(base_url('user/dashboard'));
        }
        $this->load->model('Event_model', 'event');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['title'] = 'WastuTalk';
        $data['page'] = 'Manajemen Event';
        $data['content'] = 'admin/manajemen/event';
        $this->load->view('admin_layout', $data);
    }

    public function get_event_list()
    {
        $data['total_event'] = $this->event->getEvent()->num_rows();
        $data['limit'] = 10;
        $data['offset'] = $data['total_event'] > $data['limit'] ? ($data['total_event'] - $data['limit']) : "";
        $data['event_list'] = $this->event->getEvent(null, $data['limit'], $data['offset'])->result();
        // $data['last_query'] = $this->db->last_query();
        $response = [
            'status' => true,
            'data' => $data
        ];
        echo json_encode($response);
    }
    public function get_event_by_id()
    {
        $id = $this->input->get('id');
        $data = $this->event->getEvent(['id' => $id], '', '')->row_array();
        $response = [
            'status' => true,
            'data' => $data
        ];
        echo json_encode($response);
    }
    public function add_event()
    {
        // config folder
        $year = date('Y');
        $dir_upload = FCPATH . 'assets/uploads/event/' . $year;
        if (!is_dir($dir_upload)) {
            mkdir($dir_upload, 0777, true);
            // copy($dirIndex, $dir_tahun . '/index.html');
        }

        if (empty($_FILES) || empty($_FILES['event_banner']) || $_FILES['event_banner']['error'] != 0) {
            $response = [
                'status' => false,
                'msg' => 'File event tidak ditemukan atau terjadi kesalahan upload.'
            ];
            echo json_encode($response);
            return;
        }

        $_FILES['event_banner']['name'];
        $file_ext = pathinfo($_FILES['event_banner']['name'], PATHINFO_EXTENSION);
        $new_name = $this->input->post('title') . '.' . $file_ext;
        $config['file_name'] = $new_name;
        $config['upload_path'] = $dir_upload . "/";
        $config['allowed_types'] = 'jpg|png|jpeg|pdf';
        $config['max_size'] = '10000'; // change to 10Mb

        $_FILES['file']['name'] = $new_name;
        $_FILES['file']['type'] = $_FILES['event_banner']['type'];
        $_FILES['file']['tmp_name'] = $_FILES['event_banner']['tmp_name'];
        $_FILES['file']['error'] = $_FILES['event_banner']['error'];
        $_FILES['file']['size'] = $_FILES['event_banner']['size'];

        // Cek apakah file sudah ada, jika sudah unlink dulu
        $target_file = $dir_upload . "/" . $new_name;
        if (file_exists($target_file)) {
            unlink($target_file);
        }
        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload('file');
        $data_input = $this->input->post();
        $data_input['event_image'] = $new_name;
        $data = $this->event->addEvent($data_input);
        if (!$data) {
            $response = [
                'status' => false,
                'msg' => 'Gagal menambah event.'
            ];
        } else {
            $response = [
                'status' => true,
                'msg' => 'Event berhasil ditambahkan.'
            ];
        }
        echo json_encode($response);
    }
    public function update_event()
    {
        $id = $this->input->post('id');
        $data_update = $this->input->post();
        $year = date('Y');
        $dir_upload = FCPATH . 'assets/uploads/event/' . $year;
        if (!is_dir($dir_upload)) {
            mkdir($dir_upload, 0777, true);
            // copy($dirIndex, $dir_tahun . '/index.html');
        }
        $new_name = '';
        $file_error = (empty($_FILES) || empty($_FILES['event_banner']) || $_FILES['event_banner']['error'] != 0);
        if ($file_error == false) {
            $_FILES['event_banner']['name'];
            $file_ext = pathinfo($_FILES['event_banner']['name'], PATHINFO_EXTENSION);
            $new_name = $this->input->post('title') . '.' . $file_ext;
            $config['file_name'] = $new_name;
            $config['upload_path'] = $dir_upload . "/";
            $config['allowed_types'] = 'jpg|png|jpeg|pdf';
            $config['max_size'] = '10000'; // change to 10Mb

            $_FILES['file']['name'] = $new_name;
            $_FILES['file']['type'] = $_FILES['event_banner']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['event_banner']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['event_banner']['error'];
            $_FILES['file']['size'] = $_FILES['event_banner']['size'];

            // Cek apakah file sudah ada, jika sudah unlink dulu
            $target_file = $dir_upload . "/" . $new_name;
            if (file_exists($target_file)) {
                unlink($target_file);
            }
            $this->load->library('upload');
            $this->upload->initialize($config);
            $this->upload->do_upload('file');
            $data_update['event_image'] = $new_name;
        }

        $data = $this->event->updateEvent($data_update, $id);
        if (!$data) {
            $response = [
                'status' => false,
                'msg' => 'Gagal mengupdate event.'
            ];
        } else {
            $response = [
                'status' => true,
                'msg' => 'Event berhasil diupdate.'
            ];
        }
        echo json_encode($response);
    }
    public function delete_event()
    {
        $id = $this->input->post('id');

        $data = $this->event->getEvent(['id' => $id], '', '')->row_array();
        if ($data['event_banner'] != '') {
            $dir_upload = FCPATH . 'assets/uploads/event/' . $data['year'];
            $target_file = $dir_upload . "/" . $data['event_banner'];
            if (file_exists($target_file)) {
                unlink($target_file);
            }
        }
        $data = $this->event->deleteEvent($id);
        if (!$data) {
            $response = [
                'status' => false,
                'msg' => 'Gagal menghapus event.'
            ];
        } else {
            $response = [
                'status' => true,
                'msg' => 'Event berhasil dihapus.'
            ];
        }
        echo json_encode($response);
    }

}