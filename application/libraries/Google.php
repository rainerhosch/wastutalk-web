<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Google
{

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        // Jika Anda menginstal melalui Composer di root proyek
        require_once FCPATH . 'vendor/autoload.php';

        $this->CI->load->config('google');

        $this->client = new Google_Client();
        $this->client->setClientId($this->CI->config->item('google_client_id'));
        $this->client->setClientSecret($this->CI->config->item('google_client_secret'));
        $this->client->setRedirectUri($this->CI->config->item('google_redirect_uri'));
        $this->client->addScope('email');
        $this->client->addScope('profile');
    }

    public function get_client()
    {
        return $this->client;
    }
}