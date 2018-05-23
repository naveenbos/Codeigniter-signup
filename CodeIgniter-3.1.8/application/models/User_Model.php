<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    /**
     * [insertUserDetails insert details of a user in db]
     * @param  [string] $data details from the signup form
     * @return [string]       id of user
     */
    public function insertUserDetails($data)
    {
        return $this->db->insert('user', $data);
    }

    /**
     * [checkUser check user exists or not]
     * @param  string $email email id of the user
     * @return string user data
     */
    public function checkUser($email)
    {
        $this->db->like('email', $email);
        $query = $this->db->get('user');
        return $query->result();
    }

    /**
     * [activateUser activate user after clicking url from email]
     * @param  [string] $email   email address of a user
     * @param  [activation key] $key   activation key of that user
     * @return void
     */
    public function activateUser($email, $key)
    {
        $this->db->select('user_id');
        $this->db->from('user');
        $this->db->where('email', $email);
        $this->db->where('activation_key', $key);
        $query  = $this->db->get();
        $user_id = $query->row('user_id');
        if ($user_id != "") {
            $data = array(
                'active_status' => '1',
            );
            $this->db->where('user_id', $user_id);
            $this->db->update('user', $data);
            return true;
        } else {
            return false;
        }
    }

}
