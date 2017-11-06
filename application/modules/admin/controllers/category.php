<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->model('league_model', 'leaguemod');
        $this->load->model('admin_model', 'admin');
        $this->load->model('users_model', 'usermod');
        $this->load->model('category_model', 'category');
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('list_category');
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

    function add_category() {
        if ($this->session->userdata('logged_in')) {
            if ($_POST) {
                $this->form_validation->set_rules('category_name', 'Category Name', 'required|is_unique[le_category.category_name]');

                $validate = $this->form_validation->run();
                if ($validate == TRUE) {
                    $image_name = $_FILES['category_photo']['name'];
                    $config['upload_path'] = './uploads/category/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = 100000;
                    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    $filename = rand(0, 9999999999);
                    $category_photo = $filename . '.' . $ext;
                    $config['file_name'] = $filename;
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('category_photo')) {
                        $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('message', 'type of file is not valid');
                        redirect('list_category');
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                    }
                    $category_name = $this->input->post('category_name');
                    $dataArr = array(
                        'category_name' => $category_name,
                        'category_logo' => $category_photo,
                        'category_status' => 'A'
                    );
                    $result = $this->category->add_category_data($dataArr);
                    $this->session->set_flashdata('message', 'Category added successfully');
                    redirect('list_category');
                }
            }
            $data['left'] = "<a href='list_category'>categories</a>  &nbsp;>&nbsp; Add_category";
            $data['content_header'] = "Category";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();
            $data['content'] = $this->load->view('add_category', $data, TRUE);
            load_admin_template($data);
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }
function change_category_photo() {
        $cid = $this->input->post('catId'); 
        $image_name = $_FILES['category_photo']['name']; 
        $config['upload_path'] = './uploads/category/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100000;
        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
        $filename = rand(0, 9999999999);
        $category_photo = $filename . '.' . $ext;
        $config['file_name'] = $filename;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('category_photo')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
            exit;
            $this->session->set_flashdata('message', 'type of file is not valid');
           redirect('list_category');
        } else {
            $data = array('upload_data' => $this->upload->data());
        }

        $data = array(
            'category_logo' => $category_photo
        );

        $this->category->update_photo_category($cid, $data);
        $this->session->set_flashdata('message', 'Photo Change successfully');
       redirect('list_category');
    }
    function list_category() {

        if ($this->session->userdata('logged_in')) {
            $data['left'] = "<a href='" . base_url() . "list_category'>Categories</a> &nbsp;>&nbsp; List_category";
            $data['content_header'] = "Category";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();
 
            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();

            $data['content'] = $this->load->view('list_category', $data, TRUE);
            load_admin_template($data);
        } else {
            redirect('admin/login');
        }
    }

    function category_list_ajax() {
        $this->category->category_list_request();
    }

    public function update_category_status() {
        $category_id = $this->input->post('category_id');
        $category_status = $this->input->post('category_status');
        if ($category_status == "A") {
            $dataArr = array('category_status' => 'I');
        } else {
            $dataArr = array('category_status' => 'A');
        }
        $this->category->updateCategory($dataArr, $category_id);
        $this->session->set_flashdata('message', 'Status updated successfully');
    }

    public function delete_category() {
        $cid = $this->input->post('category_id');
        $this->category->deleteCategory($cid);
        $this->session->set_flashdata('message', 'Category  deleted successfully');
    }

    public function edit_category($category_id) {
        if ($this->session->userdata('logged_in')) {
            if ($_POST) {
                $this->form_validation->set_rules('category_name', 'Category Name', 'required');
                $validate = $this->form_validation->run();
                if ($validate == TRUE) {

                    $category_name = $this->input->post('category_name');
                    $category_status = $this->input->post('category_status');

                    $dataArr = array('category_name' => $category_name,
                        'category_status' => $category_status);
                    $this->category->updateCategory($dataArr, $category_id);
                    $this->session->set_flashdata('message', 'Category updated successfully');
                    redirect('list_category');
                } else {
                    $data['category_id'] = $category_id;

                    $data['left'] = "<a href='" . base_url() . "list_category'>Categories</a> &nbsp;>&nbsp; Add_category";
                    $data['content_header'] = "Category";
                    $data['users'] = $this->admin->getUsers();
                    $data['league'] = $this->admin->getAllLeagueImages();
                    $data['brand_details'] = $this->category->getCategoryDetail($category_id);

                    $data['count_meme'] = $this->leaguemod->count_inactive_league();
                    $data['count_new_user'] = $this->admin->count_new_user();
                    $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();

                    $data['content'] = $this->load->view('edit_category', $data, TRUE);
                    load_admin_template($data);
                }
            } else {
                $data['category_id'] = $category_id;

                $data['left'] = "<a href='" . base_url() . "list_category'>Categories</a> &nbsp;>&nbsp; Add_category";
                $data['content_header'] = "Category";
                $data['users'] = $this->admin->getUsers();
                $data['league'] = $this->admin->getAllLeagueImages();
                $data['brand_details'] = $this->category->getCategoryDetail($category_id);

                $data['count_meme'] = $this->leaguemod->count_inactive_league();
                $data['count_new_user'] = $this->admin->count_new_user();
                $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();

                $data['content'] = $this->load->view('edit_category', $data, TRUE);
                load_admin_template($data);
            }
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

}
