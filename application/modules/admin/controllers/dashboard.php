<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model', 'admin');
        $this->load->model('league_model', 'leaguemod');
    }

    public function index() {
        if (!$this->session->userdata('logged_in')) {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        } else {
            $data['left'] = "Dashboard";
            $data['content_header'] = "Dashboard";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();

            $data['select'] = "leaguememe.com";
            $data['content'] = $this->load->view('dashboard', $data, TRUE);
            load_admin_template($data);
        }
    }

}
