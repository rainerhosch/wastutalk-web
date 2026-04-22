<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Presensi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert_presensi($data)
    {
        $this->db->insert('presensi', $data);
        return $this->db->affected_rows();
    }

    public function check_already_presensi($id_event, $kode_participant)
    {
        $this->db->where('id_event', $id_event);
        $this->db->where('kode_participant', $kode_participant);
        $query = $this->db->get('presensi');
        
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }
    
    public function get_presensi_by_event($id_event)
    {
        $this->db->where('id_event', $id_event);
        $this->db->order_by('time_stamp', 'DESC');
        return $this->db->get('presensi')->result_array();
    }
}
