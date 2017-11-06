<?php

/**
 * LeagueMeme.com
 *
 * Public Template controller
 *
 * LICENSE:
 *
 * @package		Public
 * @subpackage  Template Controller
 * @author		mayur
 * @copyright	Copyright (c) 2015 Web Development Experts
 * @link		http://www.WebDevelopment.expert
 * @since		Version 5.0
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Template_public extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Website Template
     *
     * @author   mayur
     * @access   public
     * @param    $data array
     * @return	 void
     */
    public function index($data) {

        $data['header'] = $this->header($data);
        $data['top_nav'] = $this->top_nav($data);
//        $data['sidebar'] = $this->sidebar();
        $data['footer'] = $this->footer();
        $this->load->view('template/main', $data);
    }

    /**
     * 
     * @author    mayur
     * @access    public
     * $param    
     * @return    string 
     */
    function userdetail() {
        $session = $this->session->userdata('user_id');
        return $profile = $this->usermod->userProfile_detail($session);
    }

    public function header($data) {

        $Session = $data['userdetail']['user_id'];

        return $this->load->view('template/header', $data, true);
    }

//    public function sidebar() {
//       return $this->load->view('template/sidebar_list','', true);
//    }



    public function top_nav($data) {

        $data['sessionuserdetail'] = $this->userdetail();
        $Session = $data['userdetail']['user_id'];
        $noti_userid = $this->session->userdata('user_id');
        $data['noti_details'] = $this->usermod->getNotificationDetails($noti_userid);
        $data['count'] = $this->leaguemod->count_league($Session);
        $data['following'] = $this->usermod->following_count($Session);
        $data['follower_list'] = $this->usermod->follower_list($Session);
        
//        echo '<pre>';
//        print_r($data['follower_list']);
//        exit;
        $data['following_list'] = $this->usermod->following_list($Session);
        $data['follower'] = $this->usermod->follower_count($Session);

//        echo '<pre>';
//        print_r($data['follower_list']);
//        exit;
//        $data = array();
//        if ($this->session->userdata('logged_in')) {
//            $user_id = $this->session->userdata('user_id');
//            $table = 'users';
//            $where = array('id' => $user_id);
//            $select = array('balance', 'points_balance', 'username');
//            $user_info = get_data_object($table, $where, $select);
//            $data['username'] = $user_info[0]->username;
//            $data['balance'] = $user_info[0]->balance;
//            $data['points_balance'] = $user_info[0]->points_balance;
//        }
        return $this->load->view('template/top_nav', $data, true);
    }

    /**
     * 
     * @author    Developer6
     * @access    public
     * $param    
     * @return    string 
     */
    public function footer() {
        return $this->load->view('template/footer', '', true);
    }

}
