<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : UserAccesMenu.php
 *  File Type             : Controller
 *  File Package          : CI_Controller
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 01/10/2025
 *  Quots of the code     : 'Hanya seorang yang hobi berbicara dengan komputer.'
 */
class UserAccesMenu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model', 'menu');
        $this->load->model('User_model', 'user');
    }


    public function index()
    {
        // code here
        $data['title'] = 'WastuTalk';
        $data['page'] = 'Manajemen User Access Menu';
        $data['content'] = 'admin/manajemen/user_access_menu';
        $data['datauser'] = $this->user->getAllUser()->result_array();
        $this->load->view('admin_layout', $data);
    }

    public function data_user_access_menu()
    {
        if ($this->input->is_ajax_request()) {
            $data = [];
            $data_role = $this->user->roleUser()->result_array();
            foreach ($data_role as $i => $role) {
                $role['menu_access'] = $this->menu->getUserMenu(['uam.role_id' => $role['id_role']])->result_array();
                $data[$i] = $role;
            }
            $res = [
                'status' => true,
                'code' => 200,
                'data' => $data,
                'msg' => 'success.'
            ];
        } else {
            $res = [
                'status' => false,
                'code' => 403,
                'data' => null,
                'msg' => 'Invalid request.'
            ];
        }
        echo json_encode($res);
    }

    public function get_menu_access()
    {
        if ($this->input->is_ajax_request()) {
            $id = [];
            $data_post = $this->input->post('role_id');
            $where = [
                'ur.id_role' => $data_post
            ];
            $dataRole = $this->user->get_role_user(['id_role' => $data_post])->row_array();
            $dataMenuAccess = $this->menu->get_user_access_menu($where)->result_array();
            if(count($dataMenuAccess) == 0){
                $where = null;
            }else{
                foreach ($dataMenuAccess as $i => $dma) {
                    $id[$i] = $dma['id_menu'];
                }
                $where = 'id_menu NOT IN (' . implode(",", $id) . ')';
            }
            $dataRole['menu_can_use'] = $this->menu->get_all_menu($where)->result_array();
            $data = [
                'code' => 200,
                'status' => true,
                'msg' => 'Data ditemukan.',
                'data' => $dataRole
            ];
        } else {
            $data = [
                'code' => 500,
                'status' => false,
                'msg' => 'Invalid request.',
                'data' => null
            ];
        }
        echo json_encode($data);
    }

    public function simpan_menu_access()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            $data_input = [
                'role_id' => $data_post['id_role'],
                'menu_id' => $data_post['select_menu_access'],
                'sub_menu_id' => 0,
            ];
            $insert = $this->menu->addData('sys_user_access_menu', $data_input);
            if ($insert) {
                $data = [
                    'code' => 200,
                    'status' => true,
                    'msg' => 'Berhasil menambahkan menu akses baru.',
                    'data' => $insert
                ];
            } else {
                $data = [
                    'code' => 500,
                    'status' => false,
                    'msg' => 'Gagal menambahkan data.',
                    'data' => null
                ];
            }
        } else {
            $data = [
                'code' => 500,
                'status' => false,
                'msg' => 'Invalid request.',
                'data' => null
            ];
        }
        echo json_encode($data);
    }

    public function delete_role_access_menu()
    {
        if ($this->input->is_ajax_request()) {
            $input_post = $this->input->post();
            $delete = $this->menu->delete_data('sys_user_access_menu', ['id' => $input_post['id']]);
            if ($delete) {
                $data = [
                    'code' => 200,
                    'status' => true,
                    'msg' => 'Data berhasil dihapus.',
                    'data' => $input_post['id']
                ];
            } else {
                $data = [
                    'code' => 500,
                    'status' => false,
                    'msg' => 'Gagal saat menghapus data.',
                    'data' => null
                ];
            }
        } else {
            $data = [
                'code' => 500,
                'status' => false,
                'msg' => 'Invalid request.',
                'data' => null
            ];
        }
        echo json_encode($data);
    }

    // modul Role User
    public function simpan_role_baru()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            $data_insert = [
                'role_type' => $data_post['role_type'],
                // 'description' => $data_post['desc']
            ];
            $insert = $this->user->insert_data('sys_user_role', $data_insert);
            if ($insert) {
                $data = [
                    'code' => 200,
                    'status' => true,
                    'msg' => 'Data berhasil ditambahkan.',
                    'data' => $data_post
                ];
            } else {
                $data = [
                    'code' => 500,
                    'status' => false,
                    'msg' => 'Gagal insert data role.',
                    'data' => null
                ];
            }
        } else {
            $data = [
                'code' => 500,
                'status' => false,
                'msg' => 'Invalid request.',
                'data' => null
            ];
        }
        echo json_encode($data);
    }

    public function delete_role_user()
    {
        if ($this->input->is_ajax_request()) {
            $input_post = $this->input->post();
            $delete = $this->user->delete_data('sys_user_role', ['id_role' => $input_post['id']]);
            if ($delete) {
                $data = [
                    'code' => 200,
                    'status' => true,
                    'msg' => 'Data berhasil dihapus.',
                    'data' => $input_post['id']
                ];
            } else {
                $data = [
                    'code' => 500,
                    'status' => false,
                    'msg' => 'Gagal saat menghapus data.',
                    'data' => null
                ];
            }
        } else {
            $data = [
                'code' => 500,
                'status' => false,
                'msg' => 'Invalid request.',
                'data' => null
            ];
        }
        echo json_encode($data);
    }

}