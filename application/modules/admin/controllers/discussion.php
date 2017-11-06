<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Discussion extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model("discussion_model", "dm");
        $this->load->model('league_model', 'leaguemod');
        $this->load->model('admin_model', 'admin');
        $this->load->model('users_model', 'usermod');
        $this->load->model('category_model', 'category');
        $this->load->library('email');
        $this->load->library("pagination");
    }

    public function list_discussion() {
        if ($this->session->userdata('logged_in')) {
            $data['left'] = "<a href='" . base_url() . "list_discussion'>Discussion</a> &nbsp;>&nbsp; Discussion list";
            $data['content_header'] = "Discussion";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();
            $data['content'] = $this->load->view('list_discussion', $data, TRUE);
            load_admin_template($data);
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

    public function discussion_list_ajax() {
        $this->dm->discussion_list_request();
    }

    public function update_discussion_bookmark() {
        $league_dis_id = $this->input->post('anime_discussionid');
        $league_dis_bookmark = $this->input->post('bookmark');

        if ($league_dis_bookmark == "1") {
            $dataArr = array('bookmark' => '0');
        } else {
            $dataArr = array('bookmark' => '1');
        }
        $result = $this->dm->updateDisBookmark($dataArr, $league_dis_id);
        $this->session->set_flashdata('message', 'Status updated successfully');
    }

    function popular_status() {

        $league_dis_id = $this->input->post('anime_discussionid');
        $popular_status = $this->input->post('popular_status');

        if ($popular_status == "Y") {
            $dataArr = array('animediscussion_popular' => 'N');
        } else {
            $dataArr = array('animediscussion_popular' => 'Y');
        }
        $result = $this->dm->updateDisPopulartatus($dataArr, $league_dis_id);
        $this->session->set_flashdata('message', 'Status updated successfully');
    }

    function delete_discussion() {
        $league_dis_id = $this->input->post('anime_discussionid');
        $this->dm->delete_discussion($league_dis_id);
        $this->session->set_flashdata('message', 'Discussion  deleted successfully');
    }

}

?>