<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends MX_Controller {

    public function __construct() {
        parent::__construct();
   
        $this->load->model('admin_model', 'admin');
        $this->load->model('league_model', 'leaguemod');
        $this->load->model('users_model', 'user');
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('user_list');
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

    function user_list_ajax() {
        $this->user->users_list_request();
    }

    public function ban_users() {
        $user_id = $this->input->post('banned');
        $days = $this->input->post('days');
        if (isset($_POST['Update'])) {
            $ban_date = $this->input->post('ban_date');
            $active_date = date('Y-m-d', strtotime($ban_date . ' + ' . $days));
            $userUpdateData = array(
                'active_date' => $active_date,
                'days' => $days
            );
            $value = $this->user->update_banned($userUpdateData, $user_id);
            if ($value == 1) {
                redirect('user_list');
            }
        } elseif (isset($_POST['Unban'])) {
            $value = $this->user->unbanned_user($user_id);
            if ($value == 1) {
                redirect('user_list');
            }
        } elseif (isset($_POST['Ban'])) {
            $todaydate = date('Y-m-d');
            $active_date = date('Y-m-d', strtotime($todaydate . ' + ' . $days));
            $userData = array(
                'user_id' => $user_id,
                'ban_date' => date('Y-m-d'),
                'days' => $days,
                'active_date' => $active_date,
                'ban_status' => 'A'
            );
            $inser_id = $this->user->banned_user($userData);
            if (isset($inser_id) && !empty($inser_id)) {
                redirect('user_list');
            }
        }
    }

    function user_list() {
        if ($this->session->userdata('logged_in')) {
            $data['left'] = "<a href='" . base_url() . "users'>Users</a> &nbsp;>&nbsp; Users_list";
            $data['content_header'] = "Users";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();

            $data['content'] = $this->load->view('user_list', $data, TRUE);
            load_admin_template($data);
        } else {
            redirect('admin/login');
        }
    }

     
    function update_status_video() {
        $league_img_id = $this->input->post('league_id');
        $league_img_status = $this->input->post('league_status');
        if ($league_img_status == "Active") {
            $dataArr1 = array('status' => Inactive);
        } else {
            $dataArr1 = array('status' => Active);
        }
        $dataArr = array('status' => Inactive);
        $this->user->updateVideoStatus($dataArr, $dataArr1, $league_img_id);
        redirect('list_youtube');
    }

    
 

}
