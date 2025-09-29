<?php
// if (!defined('BASEPATH')) exit('No direct script access allowed');

// if (!function_exists('get_dynamic_years')) {
//     function get_dynamic_years() {
//         $CI =& get_instance();
//         $CI->load->database();
        
//         $CI->db->select('YEAR(created_at) as year');
//         $CI->db->from('posts');
//         $CI->db->where('status', 'publish');
//         $CI->db->group_by('year');
//         $CI->db->order_by('year', 'DESC');
//         $query = $CI->db->get();
        
//         $years = [];
//         if ($query->num_rows() > 0) {
//             foreach ($query->result() as $row) {
//                 $years[] = $row->year;
//             }
//         }

//         // Pastikan tahun sekarang selalu ada
//         $current_year = date('Y');
//         if (!in_array($current_year, $years)) {
//             array_unshift($years, $current_year);
//         }
        
//         return $years;
//     }
// }