<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // if ($this->session->has_userdata('username') == null) {
        //     $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button> <h4><i class='icon fa fa-warning'></i> Alert!</h4> Harus Login Terlebih Dahulu</div>");
        //     redirect(base_url());
        // }
        $this->load->model('Menu_model', 'menu');
        $this->load->model('User_model', 'user');
    }

    // ===================== User Manajemen ==================================
    public function index()
    {
        // code here
        $data['title'] = 'WastuTalk';
        $data['page'] = 'Manajemen User';
        $data['content'] = 'admin/manajemen/user';
        $data['datauser'] = $this->user->getAllUser()->result_array();
        $this->load->view('admin_layout', $data);
    }

    public function getUserByID()
    {
        if ($this->input->is_ajax_request()) {
            $id_user = $this->session->userdata('id_user');
            $data = $this->user->getUser(['id_user' => $id_user])->row_array();
        } else {
            $data = 'invalid request.';
        }
        echo json_encode($data);
    }

    public function AddUser()
    {
        // code here
        $nama = $this->input->post('nama_user');
        $username = $this->input->post('username');
        $pass = $this->input->post('add_password');
        $role = $this->input->post('add_role');
        $dataPost = [
            'name' => $nama,
            'email' => $username,
            'password_hash' => md5($pass),
            'role' => $role
        ];
        $add = $this->user->addUser($dataPost);
        if (!$add) {
            // error
            $this->session->set_flashdata('error', 'Gagal menambahkan user!');
            redirect('admin/manajemen/user');
        } else {
            $this->session->set_flashdata('success', 'Data ' . $username . ', berhasil ditambahkan!');
            redirect('admin/manajemen/user');
        }
    }

    public function EditUser()
    {
        // code here
        if ($this->input->is_ajax_request()) {
            $id_user = $this->input->post('id_user');
            $where = ['id' => $id_user];
            $data = $this->user->getUser($where)->row_array();
        } else {
            $data = "Error di editUser";
        }
        echo json_encode($data);
    }

    public function UpdateUser()
    {
        // code here
        $id_user = $this->input->post('edit_id_user');
        $nama = $this->input->post('edit_nama');
        $username = $this->input->post('edit_username');
        $pass = $this->input->post('edit_password');
        $role = $this->input->post('edit_role');
        $dataUpdate = [
            'name' => $nama,
            'email' => $username,
            'password_hash' => md5($pass),
            'role' => $role
        ];
        $update = $this->user->updateUser($id_user, $dataUpdate);
        if (!$update) {
            // error
            $this->session->set_flashdata('error', 'Gagal edit user!');
            redirect('admin/manajemen/user');
        } else {
            $this->session->set_flashdata('success', 'Data ' . $username . ', berhasil di edit!');
            redirect('admin/manajemen/user');
        }
    }

    public function DeleteUser()
    {
        $id_user = $this->input->post('hapus_id_user');
        $where = ['id_user' => $id_user];
        $deleted = $this->user->deleteUser($where);
        if (!$deleted) {
            // error
            $this->session->set_flashdata('error', 'Gagal hapus user!');
            redirect('admin/manajemen/user');
        } else {
            $this->session->set_flashdata('success', 'Data berhasil di hapus!');
            redirect('admin/manajemen/user');
        }
    }
}