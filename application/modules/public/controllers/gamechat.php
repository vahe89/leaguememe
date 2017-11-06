<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gamechat extends MX_Controller {

    function __construct() {

        parent::__construct();
        $this->load->helper('text');
        $this->load->model('users_model', 'usermod');
        $this->load->model('league_model', 'leaguemod');
        $this->load->model('anime_model', 'animemod');
        $this->load->model('home_model', 'hm');
        $this->load->helper('template');
        $this->load->library('upload');
        $this->load->library('image_lib');
    }

    function userdetail() {
        $session = $this->session->userdata('user_id');
        return $profile = $this->usermod->userProfile_detail($session);
    }

    public function index($maintabval = "popular", $subtabval = "All", $orderid = 0) {
        $type = $this->uri->segment(2);
        $start = $this->uri->segment(3);
        if (!empty($subtype)) {
            if ($subtype == "all") {
                $subtabval = "All";
            } else if ($subtype == "art") {
                $subtabval = "Art";
            } else if ($subtype == "video") {
                $subtabval = "Video";
            } else if ($subtype == "random") {
                $subtabval = "random";
            } else {
                $subtabval = "All";
            }
        } else {
            $subtabval = "All";
        } 
        if (!empty($type)) {
            if ($type == "popular") {
                $maintabval = "popular";
            } else if ($type == "new") {
                $maintabval = "new";
            } else if ($type == "bookmark") {
                $maintabval = "fav";
            } else {
                $maintabval = "popular";
            }
        } else {
            $maintabval = "popular";
        }
        if (!empty($start)) {
            $orderid = $start;
        } else {
            $orderid = 0;
        }
        $pagetrackid = $this->input->post('pagetrackid');
        $Session = $this->session->userdata('user_id');
        $data['orderid'] = $orderid;
        $data['pagetrackid'] = $pagetrackid;
        $data['maintabval'] = $maintabval;
        $data['subtabval'] = $subtabval;
        $data['userdetail'] = $this->userdetail();
        $data['username'] = $this->session->userdata('uname');
        $data['userid'] = $this->session->userdata('user_id');
        $data["side_link"] = $this->hm->get_all_sidelinksside($orderid, $maintabval);
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside($orderid, $maintabval);
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
        $data["new_post"] = $this->hm->get_new_post();
        $data["new_discussion"] = $this->hm->get_let_discussion();
        $data["new_like"] = $this->hm->get_newlike();
        $data['active_menu'] = "gamechat";
         $data['getTabposition'] = $this->leaguemod->getTabs(); 
        $get_rules = $this->leaguemod->get_rules("gamechat");

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
        $data['content'] = $this->load->view('index', $data, TRUE);
        load_public_template($data);
    }

}
