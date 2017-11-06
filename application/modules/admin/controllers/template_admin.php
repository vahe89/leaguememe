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

class Template_admin extends MX_Controller {

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
        
        $data['header'] = $this->header();
        $data['top_nav'] = $this->top_nav();
        $data['sidebar'] = $this->sidebar();
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
    public function header() {
       return $this->load->view('template/header','', true);
    }
    
    public function sidebar() {
       return $this->load->view('template/sidebar_list','', true);
    }

    public function top_nav() {

        $data = array();
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
        return $this->load->view('template/footer','', true);
    }

}
