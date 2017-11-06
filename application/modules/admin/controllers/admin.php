<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model', 'admin');
        $this->load->model('league_model', 'leaguemod');
    }

    public function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/login');
        }
    }

    function add_admin() {
        if ($this->session->userdata('logged_in')) {
            if ($_POST) {
                $this->form_validation->set_rules('web_title', 'Web Title', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('c_password', 'Confirm Password', 'required');
                $validate = $this->form_validation->run();
                if ($validate == TRUE) {
                    $password = $this->input->post('password');
                    $c_password = $this->input->post('c_password');
                    if ($password == $c_password) {
                        $data = array(
                            'web_title' => $this->input->post('web_title'),
                            'admin_email' => $this->input->post('email'),
                            'username' => $this->input->post('username'),
                            'password' => md5($this->input->post('password')),
                            'is_active' => 1
                        );

                        $query = $this->admin->add_admin_data($data);
                        if ($query) {
                            $this->session->set_flashdata('message', 'Admin Successfully Added');
                            redirect('admin_list');
                        }
                    }
                }
            } else {
                $data['left'] = "<a href='" . base_url() . "admin_list'>Admin</a> &nbsp;>&nbsp; Add Admin";
                $data['content_header'] = "Admin";
                $data['users'] = $this->admin->getUsers();
                $data['league'] = $this->admin->getAllLeagueImages();

                $data['count_meme'] = $this->leaguemod->count_inactive_league();
                $data['count_new_user'] = $this->admin->count_new_user();
                $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();

                $data['content'] = $this->load->view('add_admin', $data, TRUE);
                load_admin_template($data);
            }
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

    function admin_list() {
        if ($this->session->userdata('logged_in')) {
            $data['left'] = "<a href='" . base_url() . "admin_list'>Admin</a> &nbsp;>&nbsp; Admin_list";
            $data['content_header'] = "Admin";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();

            $data['content'] = $this->load->view('admin_list', $data, TRUE);
            load_admin_template($data);
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

    function admin_list_ajax() {
        $this->admin->admin_list_request();
    }

    function active_admin() {
        $admin_id = $this->input->post('admin_id');
        $status = $this->input->post('status');

        if ($status == 0) {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        $data = array(
            'is_active' => $is_active
        );

        $query = $this->admin->update_admin_status($admin_id, $data);
        if ($query) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    function delete_admin() {
        $admin_id = $this->input->post('admin_id');

        $query = $this->admin->delete_admin($admin_id);
        if ($query) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    function edit_admin($admin_id) {
        if ($this->session->userdata('logged_in')) {
            if ($_POST) {
                $this->form_validation->set_rules('web_title', 'Web Title', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('username', 'Username', 'required');

                $validate = $this->form_validation->run();
                if ($validate == TRUE) {
                    $web_title = $this->input->post('web_title');
                    $email = $this->input->post('email');
                    $username = $this->input->post('username');
                    $is_active = $this->input->post('is_active');
                    $data = array(
                        'web_title' => $web_title,
                        'admin_email' => $email,
                        'username' => $username,
                        'is_active' => $is_active
                    );
                    $query = $this->admin->update_admin($admin_id, $data);
                    if ($query) {
                        $this->session->set_flashdata('message', 'Admin Deatils updated successfully');
                        redirect('admin_list');
                    }
                }
            } else {
                $data['left'] = "<a href='" . base_url() . "admin_list'>Admin</a> &nbsp;>&nbsp; Edit Admin";
                $data['content_header'] = "Admin";
                $data['users'] = $this->admin->getUsers();
                $data['league'] = $this->admin->getAllLeagueImages();

                $data['count_meme'] = $this->leaguemod->count_inactive_league();
                $data['count_new_user'] = $this->admin->count_new_user();
                $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();
                $data['data'] = $this->admin->getAdminById($admin_id);

                $data['content'] = $this->load->view('edit_admin', $data, TRUE);
                load_admin_template($data);
            }
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }
    
    public function edit_profile() {

        if ($this->session->userdata('logged_in')) {
            $username = $this->session->userdata('username');
            $data['admin_details'] = $this->admin->selectByUsername($username);
             $password = $data['admin_details']->password;
            $admin_id = $data['admin_details']->admin_id;
            if ($_POST) {
                $old_pwd = $this->input->post('old_pwd');
                $new_pwd = $this->input->post('new_pwd');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

                if (isset($old_pwd) && !empty($old_pwd)) {
                   
                    if ($password == md5($old_pwd)) {
                        $this->form_validation->set_rules('new_pwd', 'New Password', 'required|matches[cnf_pwd]');
                        $this->form_validation->set_rules('cnf_pwd', 'Confirm Password', 'required');
                    } else {
                        $data['left'] = "<a href='" . base_url() . "admin_list'>Admin</a> &nbsp;>&nbsp; Edit Profile";
                        $data['content_header'] = "Admin";
                        $data['users'] = $this->admin->getUsers();
                        $data['league'] = $this->admin->getAllLeagueImages();

                        $data['count_meme'] = $this->leaguemod->count_inactive_league();
                        $data['count_new_user'] = $this->admin->count_new_user();
                        $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();
                        $this->session->set_flashdata('message', 'Old Password is wrong');
                        $data['content'] = $this->load->view('edit_profile', $data, TRUE);
                        load_admin_template($data);
                        exit;
                    }
                }
                $validate = $this->form_validation->run();
                if ($validate == TRUE) {
                    $email = $this->input->post('email');
                    $username = $this->input->post('username');
                    if (!empty($old_pwd) && !empty($new_pwd)) {
                        $data = array(
                            'admin_email' => $email,
                            'password' => $new_pwd
                        );
                    } else {
                        $data = array(
                            'admin_email' => $email
                        );
                    }

                    $query = $this->admin->update_admin($admin_id, $data);
                    if ($query) {
                        $this->session->set_flashdata('message', 'Admin Deatils updated successfully');
                        redirect('admin_list');
                    }
                } else {
                    $data['left'] = "<a href='" . base_url() . "admin_list'>Admin</a> &nbsp;>&nbsp; Edit Profile";
                    $data['content_header'] = "Admin";
                    $data['users'] = $this->admin->getUsers();
                    $data['league'] = $this->admin->getAllLeagueImages();

                    $data['count_meme'] = $this->leaguemod->count_inactive_league();
                    $data['count_new_user'] = $this->admin->count_new_user();
                    $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();

                    $data['content'] = $this->load->view('edit_profile', $data, TRUE);
                    load_admin_template($data);
                }
            } 
            else {
                $data['left'] = "<a href='" . base_url() . "admin_list'>Admin</a> &nbsp;>&nbsp; Edit Profile";
                $data['content_header'] = "Admin";
                $data['users'] = $this->admin->getUsers();
                $data['league'] = $this->admin->getAllLeagueImages();

                $data['count_meme'] = $this->leaguemod->count_inactive_league();
                $data['count_new_user'] = $this->admin->count_new_user();
                $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();

                $data['content'] = $this->load->view('edit_profile', $data, TRUE);
                load_admin_template($data);
            }
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('admin/login', 'refresh');
    }
}
