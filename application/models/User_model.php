<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * file name     : User_model
 * file type     : models
 * file packages : CodeIgniter 3
 * author        : rizky ardiansyah
 * date-create   : 14 Dec 2020
 */

class User_model extends CI_Model
{
    // Add user
    public function addUser($data)
    {
        return $this->db->insert('sys_users', $data);
    }
    // insert data
    public function insert_data($table, $data)
    {
        $insert_status = $this->db->insert($table, $data);
        $id_insert = $this->db->insert_id();
        if ($insert_status) {
            return $id_insert;
        } else {
            return false;
        }
    }

    public function get_user_by_google_id($google_id)
    {
        $this->db->where('google_id', $google_id);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function get_role_user($where = null)
    {
        $this->db->select('id_role, role_type');
        $this->db->from('sys_user_role');
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }

    public function roleUser($where = null)
    {
        $this->db->distinct();
        $this->db->select('id_role, role_type');
        $this->db->from('sys_user_role');
        $this->db->where('id_role <> 1');
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }

    // Update user
    public function updateUser($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('sys_users', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // get one user
    public function getUser($param)
    {
        return $this->db->get_where('sys_users', $param);
    }

    // get data all user
    public function getAllUser()
    {
        // code here...
        $this->db->select('id, name, email,sys_users.role as role_id, sys_user_role.role_type as role, created_at');
        $this->db->from('sys_users');
        $this->db->join('sys_user_role', 'sys_user_role.id_role = sys_users.role');
        $this->db->order_by('id', 'asc');
        return $this->db->get();
    }

    // Delete User
    public function deleteUser($data)
    {
        $this->db->where($data);
        $this->db->delete('sys_users');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_data($tbl, $where)
    {
        $this->db->where($where);
        $this->db->delete($tbl);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}