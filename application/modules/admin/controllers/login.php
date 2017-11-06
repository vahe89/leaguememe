<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_in')) {
            redirect('admin/dashboard');
        }
        $method = $this->router->fetch_method();
        if ($method != "index" && $method != "check_login")
            $this->admin_lib->is_logged();
        $this->load->model('admin_model', 'admin');
    }

    public function index() {
        if ($this->uri->segment(1) != "admin") {
            redirect('');
        }
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard', 'refresh');
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

    public function check_login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $result = $this->admin->login($username, $password);
            if ($result) {
                $sess_array = array();
                foreach ($result as $row) {
                    $sess_array = array(
                        'username' => $row->username,
                        'admin_id' => $row->admin_id,
                        'is_superadmin' => $row->is_superadmin
                    );
                    $this->session->set_userdata('logged_in', $sess_array);
                    $this->session->set_userdata($sess_array);
                    redirect('dashboard');
                }
            } else {
                $this->session->set_flashdata('login_error', '<div class="alert alert-danger"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>Email or Password is Wrong.</div>');
                $data['content'] = $this->load->view('login', '', TRUE);
                load_admin_template($data);
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('admin/login', 'refresh');
    }

}
