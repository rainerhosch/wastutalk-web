<?php
// application/models/Participant_model.php

defined('BASEPATH') OR exit('No direct script access allowed');

class Participant_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function is_registered($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('participants');
        return $query->num_rows() > 0;
    }

    public function get_list_event($data = null)
    {
        $this->db->select('*');
        $this->db->from('events e');
        $this->db->join('participants p', 'e.id=p.event_id');
        if($data != null){
            $this->db->where($data);
        }
        return $this->db->get();
    }

    public function register_participant($data)
    {
        return $this->db->insert('participants', $data);
    }
}