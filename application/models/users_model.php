<?php

/**
 * Description of crud
 *
 * @author abc
 */
class Users_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_username($user_id) {
        $this->db->select('user_name');
        $this->db->from('le_users');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $data = $query->result();
        return $data[0]->user_name;
    }

    //New function addes on 27 july 2015
    function updateUserByEmail($email, $dataArr) {
        $this->db->where('user_email', $email)->update('le_users', $dataArr);
    }

    function updateUserById($userId, $data) {
        $this->db->where('user_id', $userId)
                ->update('le_users', $data);
    }

    function getUserById($userID) {
        return $this->db->select('*')
                        ->from('le_users')
                        ->where('user_id', $userID)
                        ->get()
                        ->row();
    }

    function get($from, $where) {
        return $this->db->from($from)
                        ->where($where)
                        ->get();
    }

    function getDonate($dId) {
        $this->db->select('*')
                ->from('le_donate')
                ->where('donate_id', $dId)
                ->get()
                ->row();
    }

    function updateDonate($dId, $data) {
        $this->db->where('donate_id', $dId)
                ->update('le_donate', $data);
    }

    function addUser($dataArr) {
        $this->db->insert('le_users', $dataArr);
        return $this->db->insert_id();
    }

    function user_login($username, $password) {
        $this->db->select('*');
        $this->db->from('le_users');
        $this->db->where('user_name = ' . "'" . $username . "'");
        $this->db->where('user_password = ' . "'" . MD5($password) . "'");
        $this->db->where('user_status', 'A');
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function email_check($user_email) {
        $this->db->select('*');
        $this->db->from('le_users');
        $this->db->where('user_email', $user_email);
        $query = $this->db->get();
        return $query->result();
    }

    function user_check($u_name) {
        $this->db->select('*');
        $this->db->from('le_users');
        $this->db->where('user_name', $u_name);
        $query = $this->db->get();
        return $query->result();
    }

    function userdetails($username, $password) {
        $this->db->select('*');
        $this->db->from('le_users');
        $this->db->where('user_name', $username);
        $this->db->where('user_password', MD5($password));
        $this->db->where('user_status', 'A');
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function check_ban_status($uid) {

        $this->db->select('*');
        $this->db->from('le_banusers');
        $this->db->where('user_id', $uid);
        $this->db->where('ban_status = "A"');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    function editUserProfile($user_id) {
        $query = $this->db->select('*')
                        ->from('le_users')
                        ->where('user_name', $user_id)->get();
        return $query->row_array();
    }

    function update_UserProfile($user_id, $dataArr) {
        $this->db->where('user_name', $user_id)
                ->update('le_users', $dataArr);
        return;
    }

    function forgot_pswdd($user_email) {
        $this->db->select('*');
        $this->db->from('le_users');
//        $this->db->where('user_email = ' . "'" . $user_email . "'");
        $this->db->where('user_email', $user_email);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    function forgot_pswdd_userid($user_email) {
        $this->db->select('user_id');
        $this->db->from('le_users');
//        $this->db->where('user_email = ' . "'" . $user_email . "'");
        $this->db->where('user_email', $user_email);
        $this->db->limit(1);
        $query = $this->db->get();
        $data = $query->result();
        if (!empty($data)) {
            return $data[0]->user_id;
        }
    }

    function get_user_by_id($user_id) {
        $this->db->select('*');
        $this->db->from('le_users');
        $this->db->where('user_id = ' . "'" . $user_id . "'");
        $this->db->where('user_status', 'A');
        $query = $this->db->get();
        return $query->row();
    }

}
?>