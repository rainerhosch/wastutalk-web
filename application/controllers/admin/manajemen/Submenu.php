<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submenu extends CI_Controller
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

    // ===================== SubMenu Manajemen ==================================
    public function index()
    {
        // code here
        $data['title'] = 'WastuTalk';
        $data['page'] = 'Manajemen SubMenu';
        $data['content'] = 'admin/manajemen/submenu';
        $data['datasubmenu'] = $this->menu->getSubMenuAll()->result_array();
        $this->load->view('admin_layout', $data);
    }

    public function AddNewSubmenu()
    {
        $dataPost = [
            'id_menu' => $this->input->post('menu_parent'),
            'nama_submenu' => $this->input->post('nama_submenu'),
            'url' => $this->input->post('url_submenu'),
            'icon' => $this->input->post('icon_submenu'),
            'is_active' => 0,
        ];
        $add = $this->menu->addNewSubmenu($dataPost);
        if (!$add) {
            // error
            $this->session->set_flashdata('error', 'Gagal menambahkan SubMenu!');
            redirect('admin/manajemen/submenu');
        } else {
            $this->session->set_flashdata('success', 'SubMenu ' . $this->input->post('nama_submenu') . ', berhasil ditambahkan!');
            redirect('admin/manajemen/submenu');
        }
    }

    public function getDataSubMenu()
    {
        $response = $this->menu->getSubMenuAll()->result_array();
        echo json_encode($response);
    }

    // activate or non activate submenu
    public function ChangeStatusSubmenu()
    {
        if ($this->input->is_ajax_request()) {
            $id_submenu = $this->input->post('id_submenu');
            $is_active = $this->input->post('status');
            $dataUpdate = [
                // 'id_menu' => $id_menu,
                'is_active' => $is_active
            ];
            $data = $this->menu->updateSubMenu($id_submenu, $dataUpdate);
        } else {
            $data = "Error di edit Menu";
        }
        echo json_encode($data);
    }

    public function EditSubmenu()
    {
        // code here
        if ($this->input->is_ajax_request()) {
            $id_submenu = $this->input->post('id_submenu');
            $where = ['id_submenu' => $id_submenu];
            $data = $this->menu->getSubmenuById($where)->row_array();
        } else {
            $data = "Error di edit menu";
        }
        echo json_encode($data);
    }

    public function UpdateSubmenu()
    {
        // code here
        $id_submenu = $this->input->post('id_submenu_edit');
        $nama = $this->input->post('nama_submenu_edit');
        $link = $this->input->post('link_submenu_edit');
        $icon = $this->input->post('icon_submenu_edit');
        $id_menu = $this->input->post('menu_parent_edit');
        $dataUpdate = [
            'id_menu' => $id_menu,
            'nama_submenu' => $nama,
            'url' => $link,
            'icon' => $icon
        ];
        $update = $this->menu->updateSubmenu($id_submenu, $dataUpdate);
        if (!$update) {
            // error
            $this->session->set_flashdata('error', 'Gagal edit submenu!');
            redirect('admin/manajemen/submenu');
        } else {
            $this->session->set_flashdata('success', 'Sukses edit submenu!');
            redirect('admin/manajemen/submenu');
        }
    }
    // delete submenu
    public function DeleteSubmenu()
    {
        $id_submenu = $this->input->post('hapus_id_submenu');
        $where = ['id_submenu' => $id_submenu];
        $deleted = $this->menu->deleteSubmenu($where);
        if (!$deleted) {
            // error
            $this->session->set_flashdata('error', 'Gagal hapus submenu!');
            redirect('admin/manajemen/submenu');
        } else {
            $this->session->set_flashdata('success', 'Data berhasil di hapus!');
            redirect('admin/manajemen/submenu');
        }
    }
}