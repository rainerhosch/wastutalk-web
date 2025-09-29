<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
    *  File Name             : Event_model.php
    *  File Type             : Model
    *  File Package          : CI_Models
    ** * * * * * * * * * * * * * * * * * **
    *  Author                : Rizky Ardiansyah
    *  Date Created          : 20/009/2025
    *  Quots of the code     : 'sebuah code program bukanlah sebatas perintah-perintah yang ditulis di komputer, melainkan sebuah kesempatan berkomunikasi antara komputer dan manusia. (bagi yang tidak punya teman wkwk)'
*/
class Event_model extends CI_Model
{
    public function getEvent($data = null, $limit = '', $start = '')
    {
        $this->db->select('*');
        $this->db->from('events');
        if($data != null){
            $this->db->where($data);
        }
        // if limit and start provided
        if ($limit != "") {
            $this->db->limit($limit, $start);
        } else if ($start != "") {
            $this->db->limit($limit, $start);
        }
        $this->db->order_by('sesi_date');
        return $this->db->get();
    }
}