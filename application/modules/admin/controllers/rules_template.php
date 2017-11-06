<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rules_template extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('league_model', 'leaguemod');
        $this->load->model('admin_model', 'admin');
        $this->load->model('users_model', 'usermod');
        $this->load->model('category_model', 'category');
        $this->load->model('rules_model', 'rulesmod');
    }

    public function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/login');
        }
    }

    function all_rules_template() {
        if ($this->session->userdata('logged_in')) {
            $data['left'] = "<a href='" . base_url() . "admin_list'>Admin</a> &nbsp;>&nbsp; Rules Template";
            $data['content_header'] = "List Templates";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();
            $data['content'] = $this->load->view('list_rules_template', $data, TRUE);
            load_admin_template($data);
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

    function rules_templates() {
        $this->form_validation->set_rules('page_name', 'Page Name', 'required|is_unique[rules_templates.page_name]');
        $this->form_validation->set_rules('rules_editor', 'Rules Template', 'required');
        
        $validate = $this->form_validation->run();
        if ($validate == TRUE) {
            // add data into database
                $dataArr = array(
                    'page_name' => $this->input->post('page_name'),
                    'template' => $this->input->post('rules_editor'),
                    'status' => 1                 
                );
                $result = $this->rulesmod->save_rules($dataArr);
                if($result){
                    $this->session->set_flashdata('message', 'Rules Template added successfully');
                    redirect('list_rules_template');
                }                
        } else {
            
            if ($this->session->userdata('logged_in')) {
                $data['left'] = "<a href='rules_template'>League</a>  &nbsp;>&nbsp; Add_Rules";
                $data['content_header'] = "Rules Template";
                $data['users'] = $this->admin->getUsers();
                $data['league'] = $this->admin->getAllLeagueImages();
                $data['category_list'] = $this->category->getAllCategory();
                $data['count_meme'] = $this->leaguemod->count_inactive_league();
                $data['count_new_user'] = $this->admin->count_new_user();
                $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();
                $data['content'] = $this->load->view('add_rules_template', $data, TRUE);
                load_admin_template($data);
            } else {
                $this->load->view('admin/login');
            }
        }
    }

    function check_page_name() {
        $pg_name = $this->input->post('pg_name');
        $pg_name = trim($pg_name);
        $query = $this->rulesmod->check_page_name($pg_name);
        if ($query) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
    
    function list_rulesTmp_ajax(){
         $this->rulesmod->rules_list_request();
    }
    
    function update_status() {

        $rule_id = $this->input->post('rule_id');
        $status = $this->input->post('rule_status');

        if ($status == 1) {
            $dataArr = array('status' => 0);
        } else {
            $dataArr = array('status' => 1);
        }
        $result = $this->rulesmod->updateRuleTemplateById($dataArr, $rule_id);
        $this->session->set_flashdata('message', 'Status updated successfully');
    }
    
    function delete_rules_template(){
        $rules_id = $this->input->post('rules_id');
        $this->rulesmod->delete_template($rules_id);
        $this->session->set_flashdata('message', 'Template deleted successfully');
    }
    
    function edit_rules_template($rules_id){
         if ($this->session->userdata('logged_in')) {
            if ($_POST) {
                $this->form_validation->set_rules('rules_editor', 'Rules Template', 'required');
                $validate = $this->form_validation->run();
                if ($validate == TRUE) {
                    $dataArr = array(
                        'template' => $this->input->post('rules_editor'),
                        'status' => 1                 
                    );
                    $result = $this->rulesmod->updateRuleTemplateById($dataArr, $rules_id);

                    $this->session->set_flashdata('message', 'Rules Template updated successfully');
                    redirect('edit_rules_template/' . $rules_id);
                } else {
                    redirect('edit_rules_template/' . $rules_id);
                }
            }
            
            $data['left'] = "<a href='" . base_url() . "admin_list'>Admin</a> &nbsp;>&nbsp; Rules Template";
            $data['content_header'] = "List Templates";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();
            $data['rules_detail'] = $this->rulesmod->select_template($rules_id);
            $data['content'] = $this->load->view('edit_rules_template', $data, TRUE);
            load_admin_template($data);
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

}
