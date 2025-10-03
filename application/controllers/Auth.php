<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : Auth.php
 *  File Type             : Controller
 *  File Package          : CI_Controller
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 30/09/2025
 *  Quots of the code     : 'Hanya seorang yang hobi berbicara dengan komputer.'
 */
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('google');
        $this->load->model('User_model', 'user');
    }

    public function index()
    {
        if ($this->session->userdata('email') !== null) {
            // $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button> <h4><i class='icon fa fa-warning'></i> Alert!</h4> Harus Login Terlebih Dahulu</div>");
            redirect(base_url('admin/dashboard'));
        }
        // code here...
        $data['login_button'] = $this->google->get_client()->createAuthUrl();
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            // $data['content'] = 'auth/login';
            $this->load->view('templates/auth/login', $data);
        } else {
            // validasi sukses
            $this->_login();
        }
    }

    private function _login()
    {
        // code here...
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        $user = $this->db->get_where('sys_users', ['email' => $email])->row_array();

        if ($user) {
            // code here...
            if (md5($password) == $user['password_hash']) {
                $data = [
                    // 'id_user' => $user['id'],
                    'nama' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];
                $this->session->set_userdata($data);
                redirect('admin/dashboard');
            } else {
                // password salah
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
                redirect('auth');
            }
        } else {
            // data login tidak ada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak ada data dengan username ' . $email . '!</div>');
            redirect('auth');
        }
    }

    public function register_google()
    {
        if (isset($_GET['code'])) {
            $token = $this->google->get_client()->fetchAccessTokenWithAuthCode($_GET['code']);
            if (!isset($token['error'])) {
                $this->google->get_client()->setAccessToken($token);

                $google_service = new Google_Service_Oauth2($this->google->get_client());
                $user_info = $google_service->userinfo->get();

                $google_id = $user_info->id;
                $name = $user_info->name;
                $email = $user_info->email;
                $profile_picture = $user_info->picture;

                $user = $this->user->get_user_by_google_id($google_id);

                if (!$user) {
                    // Registrasi pengguna baru
                    $data = array(
                        'google_id' => $google_id,
                        'name' => $name,
                        'email' => $email,
                        'role' => 7,
                        'profile_picture_url' => $profile_picture,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                    $this->user->insert_data('sys_users', $data);
                }

                // Buat sesi pengguna
                $session_data = array(
                    'google_id' => $google_id,
                    'name' => $name,
                    'email' => $email
                );
                $this->session->set_userdata('user_data', $session_data);

                redirect('user/dashboard'); // Redirect ke halaman dashboard
            }
        }
    }

    // sign-out
    public function logout()
    {
        // code here...
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');
        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Berhasil Logout!</div>');
        // redirect
        redirect('auth');
    }
}