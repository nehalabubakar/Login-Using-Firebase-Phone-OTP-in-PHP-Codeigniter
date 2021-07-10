<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Database_queries extends CI_Model
{
    public function create_user($new_user_details)
    {
        if ($this->check_if_user_is_new($new_user_details['email'])) {
            $this->db->insert('users', $new_user_details);
            return true;
        } else {
            $error = 'Account Already Exists Please Login To Continue';
            return $error;
        }
    }

    public function check_if_user_is_new($user_email)
    {
        $this->db->where('email', $user_email);
        $user_exists = $this->db->get('users');

        if ($user_exists->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function login($login_details)
    {
        $this->db->select('password');
        $this->db->where('email', $login_details['email']);
        if ($this->db->get('users')->num_rows() > 0) {
            $decrypted_password = $this->encryption->decrypt($this->db->get('users')->row()->password);
            if ($login_details['password'] == $decrypted_password) {
                return true;
            } else {
                return 'Password Incorrect';
            }
        } else {
            return "Email Doesnot Exists";
        }
    }

    public function check_user_phone_number_for_OTP($phone_number)
    {
        $this->db->where('phone', $phone_number);
        if ($this->db->get('users')->num_rows() > 0) {
            return true;
        } else {
            return 'Phone Number Does Not Exist';
        }
    }
}
