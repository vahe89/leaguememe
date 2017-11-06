<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Discussion extends MX_Controller {

    function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('users_model', 'usermod');
        $this->load->model('league_model', 'leaguemod');
        $this->load->model('home_model', 'hm');
        $this->load->model('discussion_model', 'discmod');

        $this->load->model('anime_model', 'animemod');
    }

    function userdetail() {
        $session = $this->session->userdata('user_id');
        return $profile = $this->usermod->userProfile_detail($session);
    }

    public function index() {

        $data['userdetail'] = $this->userdetail();
        $data['active_menu'] = "discussion";
        $data['username'] = $this->session->userdata('uname');
        $data['userid'] = $this->session->userdata('user_id');
        $data["side_link"] = $this->hm->get_all_sidelinksside();
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside();
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
        $data["new_post"] = $this->hm->get_new_post();
        $data["new_discussion"] = $this->hm->get_let_discussion();
        $get_rules = $this->leaguemod->get_rules("discussion");
        
        if (count($get_rules) > 0) {
            $rightbar = array(
                'rules' => $get_rules[0]->template
            );
        }else{
            $rightbar = array(
                'rules' => ''
            );
        }

        $data["right_bar"] = $rightbar;
        $data["new_like"] = $this->hm->get_newlike();
         $data['getTabposition'] = $this->leaguemod->getTabs(); 
        $data['content'] = $this->load->view('discussion/index', $data, TRUE);
        load_public_template($data);
    }

    public function fav() {

        $data['userdetail'] = $this->userdetail();
        $data['active_menu'] = "discussion";
        $data['username'] = $this->session->userdata('uname');
        $data['userid'] = $this->session->userdata('user_id');
        $data["side_link"] = $this->hm->get_all_sidelinksside();
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside();
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
        $data["new_post"] = $this->hm->get_new_post();
        $data["new_discussion"] = $this->hm->get_let_discussion();
        $data["new_like"] = $this->hm->get_newlike();
        $get_rules = $this->leaguemod->get_rules("discussion");
        
        if (count($get_rules) > 0) {
            $rightbar = array(
                'rules' => $get_rules[0]->template
            );
        }else{
            $rightbar = array(
                'rules' => ''
            );
        }

        $data["right_bar"] = $rightbar;
         $data['getTabposition'] = $this->leaguemod->getTabs(); 
        $data['content'] = $this->load->view('discussion/index', $data, TRUE);
        load_public_template($data);
    }

    function discussion_list() {
        if ($this->session->userdata('user_id')) {
            $user_id = $this->session->userdata('user_id');
        } else {
            $user_id = 0;
        }
        $main = $this->input->post('main');

        $rowperpage = $this->input->post('rowperpage');
        $row = $this->input->post('row');
        $allcount_fetch = $this->discmod->get_total_row($main, $user_id);

        $data['allcount'] = $allcount_fetch->count;

        $data['discussion_detail'] = $this->discmod->discussion_list($main, $user_id, $row, $rowperpage);

        if ($this->session->userdata('user_id')) {
            $data['userid'] = $this->session->userdata('user_id');
        }
        $victory = array();
        $defact = array();
        foreach ($data['discussion_detail'] as $league) {
            if (isset($league->vic_users) && !empty($league->vic_users)) {
                $victory[$league->anime_discussionid] = explode(",", $league->vic_users);
            }
            if (isset($league->def_users) && !empty($league->def_users)) {
                $defact[$league->anime_discussionid] = explode(",", $league->def_users);
            }
        }
        $fav_userid = array();
        foreach ($data['discussion_detail'] as $league) {
            if (isset($league->fvtuserid) && !empty($league->fvtuserid)) {
                $fav_userid[$league->anime_discussionid] = explode(",", $league->fvtuserid);
            }
        }
        $data['favuserid'] = $fav_userid;
        $data['victory'] = $victory;
        $data['defact'] = $defact;
        $data['total'] = count($data['discussion_detail']);
        echo $this->load->view('discussion/discussion_list', $data, true);
    }

    function discussion_single($anime_discussionid = ' ') {
        $data['recent_disc'] = $this->discmod->getRecentDiscussion(4);
        $data['discussion_detail'] = $this->discmod->single_discussion_list($anime_discussionid);
        $victory = array();
        $defact = array();
        foreach ($data['discussion_detail'] as $league) {
            if (isset($league->vic_users) && !empty($league->vic_users)) {
                $victory[$league->anime_discussionid] = explode(",", $league->vic_users);
            }
            if (isset($league->def_users) && !empty($league->def_users)) {
                $defact[$league->anime_discussionid] = explode(",", $league->def_users);
            }
        }
        $data['victory'] = $victory;
        $data['defact'] = $defact;
        $data['username'] = $this->session->userdata('uname');
        $data['userid'] = $this->session->userdata('user_id');
        $data['userdetail'] = $this->userdetail();
        $data["side_link"] = $this->hm->get_all_sidelinksside();
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside();
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
        $data['content'] = $this->load->view('discussion_single', $data, TRUE);
        load_public_template($data);
    }

}
