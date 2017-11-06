<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends MX_Controller {

    var $max_image_size = 640; //Maximum image size (height and width)
    var $max_image_size_new = 800;
    var $thumb_prefix = "thumb_"; //Normal thumb Prefix
    var $destination_folder = 'uploads/users/';
    var $destination_folder1 = 'uploads/league/'; //upload directory ends with / (slash)
    var $jpeg_quality = 100;
    var $htmldata = array();
    var $max_image_size_upload = 1024;
    var $destination_folder_dump = 'uploads/dump/';

    function __construct() {

        parent::__construct();
        //$this->load->library('email');

        $this->load->model('users_model', 'usermod');
        $this->load->model('news_model', 'newsmod');
          $this->load->model('league_model', 'leaguemod');
        $this->load->model('home_model', 'hm');
        
    
        $this->load->helper('template');
        $this->load->library('upload');
    }
     function userdetail() {
        $session = $this->session->userdata('user_id');
        return $profile = $this->usermod->userProfile_detail($session);
    }

    public function index() {
       // $orderid = $this->input->post('orderid');
        $pagetrackid = $this->input->post('pagetrackid');
        $maintabval = $this->input->post('mainTabval');
        $subtabval = $this->input->post('subTabval');
        $animename1 = $this->input->post('anime_name');

        $Session = $this->session->userdata('user_id');
        $data['orderid'] = $anime;
        $data['pagetrackid'] = $pagetrackid;
        $data['maintabval'] = $maintabval;
        $data['subtabval'] = $subtabval;
        $data['animename1'] = $animename1;
        $data['userdetail'] = $this->userdetail();
        $data['username'] = $this->session->userdata('uname');
        $data['userid'] = $this->session->userdata('user_id');
        $data["side_link"] = $this->hm->get_all_sidelinksside($anime, $maintabval);
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside($anime, $maintabval);
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
        $data["new_post"] = $this->hm->get_new_post();
        $data["new_discussion"] = $this->hm->get_let_discussion();
        $data["new_like"] = $this->hm->get_newlike();
        $data['content'] = $this->load->view('news', $data, TRUE);
        load_public_template($data);
    }
    
    public function news_home(){
        
        $Session = $this->session->userdata('user_id');
        
        $data['userdetail'] = $this->userdetail();
        $data['username'] = $this->session->userdata('uname');
        $data['userid'] = $this->session->userdata('user_id');
       
        $data['article_data'] =  $this->newsmod->get_all_articals();
        $data['article_top_treading'] = $this->newsmod->get_articles_top_treading();
        $data['content'] = $this->load->view('news', $data, TRUE);
        load_public_template($data);
      
    }
}