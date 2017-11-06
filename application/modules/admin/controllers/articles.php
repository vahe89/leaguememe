<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Articles extends MX_Controller {

    var $max_image_size = 640; //Maximum image size (height and width)
    var $max_image_size_new = 800;
    var $thumb_prefix = "thumb_"; //Normal thumb Prefix
    var $destination_folder = 'uploads/articles/'; //upload directory ends with / (slash)
    var $jpeg_quality = 90; //jpeg quality 

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('article_model', 'articlemod');
        $this->load->model('league_model', 'leaguemod');
        $this->load->model('admin_model', 'admin');
        $this->load->model('users_model', 'usermod');
        $this->load->library('email');
        $this->load->library("pagination");
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('article_list', 'refresh');
        } else {
            $this->load->view('admin/login');
        }
    }

    function add_article() {
        $this->form_validation->set_rules('article_name', 'Article Name', 'required');
        $this->form_validation->set_rules('article_tag', 'Article Tag', 'required');
        $this->form_validation->set_rules('editor1', 'Article Description', 'required');
        $this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'required');
        $this->form_validation->set_rules('meta_description', 'Meta Description', 'required');
        $validate = $this->form_validation->run();
        if ($validate == TRUE) {

            if ($_POST) {
                if ($_FILES['article_img']['name'] != "") {
                    if (!isset($_FILES['article_img']) || !is_uploaded_file($_FILES['article_img']['tmp_name'])) {
                        //die('Image file is Missing!'); // output error when above checks fail.
                    }

                    //uploaded file info we need to proceed
                    $image_name = $_FILES['article_img']['name']; //file name
                    $image_size = $_FILES['article_img']['size']; //file size
                    $image_temp = $_FILES['article_img']['tmp_name']; //file temp

                    $ext = pathinfo($image_name, PATHINFO_EXTENSION);

                    $image_size_info = getimagesize($image_temp); //get image size

                    if ($image_size_info) {
                        $image_width = $image_size_info[0]; //image width
                        $image_height = $image_size_info[1]; //image height
                        $image_type = $image_size_info['mime']; //image type
                    } else {
                        die("Make sure image file is valid!");
                    }

                    //switch statement below checks allowed image type 
                    //as well as creates new image from given file 
                    switch ($image_type) {
                        case 'image/png':
                            $image_res = imagecreatefrompng($image_temp);
                            break;
                        case 'image/gif':
                            $image_res = imagecreatefromgif($image_temp);
                            break;
                        case 'image/jpeg': case 'image/pjpeg':
                            $image_res = imagecreatefromjpeg($image_temp);
                            break;
                        default:
                            $image_res = false;
                    }

                    if ($image_res) {

                        //Get file extension and name to construct new file name 
                        $image_info = pathinfo($image_name);
                        $image_extension = strtolower($image_info["extension"]); //image extension
                        $image_name_only = strtolower($image_info["filename"]); //file name only, no extension
                        //create a random name for new image (Eg: fileName_293749.jpg) ;
                        $new_file_name = rand(0, 9999999999) . '.' . $image_extension;
                        
                        
                         if ($image_type == 'image/jpeg' || $imageType == 'image/pjpeg') {
                            $image = imagecreatefromjpeg($image_temp);
                            $image_path = getcwd() . "/uploads/articles/$new_file_name";
                            imagejpeg($image, $image_path, 80);
                        } elseif ($image_type == 'image/png') {
                            $image = imagecreatefrompng($image_temp);
                            $image_path = getcwd() . "/uploads/articles/$new_file_name";
                            imagepng($image, $image_path);
                        }

                        $config['upload_path'] = "./uploads/articles_original";
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['file_name'] = $new_file_name;
                        $config['max_size'] = '0';
                        $config['overwrite'] = FALSE;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        $this->upload->do_upload('article_img');
                        $imgArr = $new_file_name;

                        //folder path to save resized images and thumbnails
                        $image_save_folder = $this->destination_folder . $new_file_name;

                        //call normal_resize_image() function to proportionally resize image

                        //if ($this->normal_resize_image($image_res, $image_save_folder, $image_type, $this->max_image_size, $image_width, $image_height, $this->jpeg_quality)) {
                            $imgArr = $new_file_name;
                        //}

                        imagedestroy($image_res); //freeup memory
                    }
//                }
                }
                if ($this->input->post('spoiler') == "" || $this->input->post('spoiler') == " ") {
                    $spoiler = 0;
                } else {
                    $spoiler = $this->input->post('spoiler');
                }
                if ($this->input->post('tag_name') == "" && $this->input->post('tag_name') == " ") {
                    $tag_name = "THEORY";
                } else {
                    $tag_name = $this->input->post('tag_name');
                }
                if ($this->input->post('tag_color') == "" && $this->input->post('tag_color') == " ") {
                    $tag_color = "#dfdfdf";
                } else {
                    $tag_color = $this->input->post('tag_color');
                }
                $tag_style = trim($tag_name) . "," . trim($tag_color);
                $dataArr = array(
                    'article_name' => $this->input->post('article_name'),
                    'article_description' => $this->input->post('editor1'),
                    'article_url' => $this->input->post('article_url'),
                    'meta_keyword' => $this->input->post('meta_keyword'),
                    'meta_description' => $this->input->post('meta_description'),
                    'tag_style' => $tag_style,
                    'status' => 'A',
                    'spoiler' => $spoiler,
                    'article_image' => $imgArr
                );
                $result = $this->articlemod->saveArticle($dataArr);
                if ($this->input->post('article_tag')) {

                    $tag_explode = explode(',', $this->input->post('article_tag'));
                    foreach ($tag_explode as $tag) {
                        $dataArray = array(
                            'article_id' => $result,
                            'user_id' => '0',
                            'tag' => $tag,
                            'created_date' => date('Y-m-d H:i:s'),
                            'user_id' => $this->session->userdata('user_id')
                        );
                        $this->articlemod->saveArticleTag($dataArray);
                    }
                }

                $this->session->set_flashdata('message', 'Article added successfully');
                redirect('add_articles');
            }

            if ($this->session->userdata('logged_in')) {
                $data['left'] = "<a href='" . base_url() . "admin_list'>Admin</a> &nbsp;>&nbsp; Articles";
                $data['content_header'] = "Articles";
                $data['users'] = $this->admin->getUsers();
                $data['league'] = $this->admin->getAllLeagueImages();

                $data['count_meme'] = $this->leaguemod->count_inactive_league();
                $data['count_new_user'] = $this->admin->count_new_user();
                $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();

                $data['content'] = $this->load->view('add_article', $data, TRUE);
                load_admin_template($data);
            } else {
                $data['content'] = $this->load->view('login', '', TRUE);
                load_admin_template($data);
            }
        } else {
            if ($this->session->userdata('logged_in')) {
                $data['left'] = "<a href='" . base_url() . "admin_list'>Admin</a> &nbsp;>&nbsp; Articles";
                $data['content_header'] = "Articles";
                $data['users'] = $this->admin->getUsers();
                $data['league'] = $this->admin->getAllLeagueImages();

                $data['count_meme'] = $this->leaguemod->count_inactive_league();
                $data['count_new_user'] = $this->admin->count_new_user();
                $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();

                $data['content'] = $this->load->view('add_article', $data, TRUE);
                load_admin_template($data);
            } else {
                $data['content'] = $this->load->view('login', '', TRUE);
                load_admin_template($data);
            }
        }
    }

    function article_list_ajax() {
        $this->articlemod->article_list_request();
    }

    function article_list() {

        if ($this->session->userdata('logged_in')) {
            $data['left'] = "<a href='" . base_url() . "admin_list'>Admin</a> &nbsp;>&nbsp; Articles";
            $data['content_header'] = "Articles";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();
            $data['content'] = $this->load->view('list_articles', $data, TRUE);
            load_admin_template($data);
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

    function popular_status() {
        $article_id = $this->input->post('article_id');
        $popular_status = $this->input->post('popular_status');
        if ($popular_status == "Y") {
            $dataArr = array('setpopular' => 'N');
        } else {
            $dataArr = array('setpopular' => 'Y');
        }
        $result = $this->articlemod->updateArticleById($dataArr, $article_id);
        $this->session->set_flashdata('message', 'Status updated successfully');
    }

    function update_status() {

        $article_id = $this->input->post('article_id');
        $article_status = $this->input->post('article_status');

        if ($article_status == "A") {
            $dataArr = array('status' => 'I');
        } else {
            $dataArr = array('status' => 'A');
        }
        $result = $this->articlemod->updateArticleById($dataArr, $article_id);
        $this->session->set_flashdata('message', 'Status updated successfully');
    }

    function delete_article() {
        $article_id = $this->input->post('article_id');

        // Delete article image
        $article_detail = $this->articlemod->select_article($article_id);
        $article_image = $article_detail['article_image'];
        $url = 'uploads/articles/' . $article_image;
        @unlink($url);

        $this->articlemod->delete_article($article_id);
        $this->articlemod->delete_tags($article_id);
        $this->articlemod->delete_comments($article_id);
        $this->session->set_flashdata('message', 'Article  deleted successfully');
    }

    function edit_article($article_id) {
        if ($this->session->userdata('logged_in')) {

            if ($_POST) {
                $this->form_validation->set_rules('article_name', 'Article Name', 'required');
                $this->form_validation->set_rules('article_tag', 'Article Tag', 'required');
                $this->form_validation->set_rules('editor1', 'Article Description', 'required');
                $this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'required');
                $this->form_validation->set_rules('meta_description', 'Meta Description', 'required');
                $validate = $this->form_validation->run();
                if ($validate == TRUE) {
                    if ($_FILES['article_imgs']['name'] != "") {
                        if (!isset($_FILES['article_imgs']) || !is_uploaded_file($_FILES['article_imgs']['tmp_name'])) {
                            //die('Image file is Missing!'); // output error when above checks fail.
                        }

                        //uploaded file info we need to proceed
                        $image_name = $_FILES['article_imgs']['name']; //file name
                        $image_size = $_FILES['article_imgs']['size']; //file size
                        $image_temp = $_FILES['article_imgs']['tmp_name']; //file temp

                        $ext = pathinfo($image_name, PATHINFO_EXTENSION);

                        $image_size_info = getimagesize($image_temp); //get image size

                        if ($image_size_info) {
                            $image_width = $image_size_info[0]; //image width
                            $image_height = $image_size_info[1]; //image height
                            $image_type = $image_size_info['mime']; //image type
                        } else {
                            die("Make sure image file is valid!");
                        }

                        //switch statement below checks allowed image type 
                        //as well as creates new image from given file 
                        switch ($image_type) {
                            case 'image/png':
                                $image_res = imagecreatefrompng($image_temp);
                                break;
                            case 'image/gif':
                                $image_res = imagecreatefromgif($image_temp);
                                break;
                            case 'image/jpeg': case 'image/pjpeg':
                                $image_res = imagecreatefromjpeg($image_temp);
                                break;
                            default:
                                $image_res = false;
                        }
                        $article_img_old = $this->input->post('article_img_old');
                        if ($image_res) {

                            //Get file extension and name to construct new file name 
                            $image_info = pathinfo($image_name);
                            $image_extension = strtolower($image_info["extension"]); //image extension
                            $image_name_only = strtolower($image_info["filename"]); //file name only, no extension
                            //create a random name for new image (Eg: fileName_293749.jpg) ;
                            $new_file_name = rand(0, 9999999999) . '.' . $image_extension;
                            
                            
                            if ($image_type == 'image/jpeg' || $imageType == 'image/pjpeg') {
                                $image = imagecreatefromjpeg($image_temp);
                                $image_path = getcwd() . "/uploads/articles/$new_file_name";
                                imagejpeg($image, $image_path, 80);
                            } elseif ($image_type == 'image/png') {
                                $image = imagecreatefrompng($image_temp);
                                $image_path = getcwd() . "/uploads/articles/$new_file_name";
                                imagepng($image, $image_path);
                            } else {
                                $config_oth['upload_path'] = "./uploads/articles";
                                $config_oth['allowed_types'] = 'gif|jpg|png|jpeg';
                                $config_oth['file_name'] = $new_file_name;
                                $config_oth['max_size'] = '0';
                                $config_oth['overwrite'] = FALSE;
                                $this->load->library('upload', $config_oth);
                                $this->upload->initialize($config_oth);
                                $this->upload->do_upload('article_imgs');
                            }

                            $config['upload_path'] = "./uploads/articles_original";
                            $config['allowed_types'] = 'gif|jpg|png|jpeg';
                            $config['file_name'] = $new_file_name;
                            $config['max_size'] = '0';
                            $config['overwrite'] = FALSE;
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            $this->upload->do_upload('article_imgs');
                            $imgArr = $new_file_name;

                            //folder path to save resized images and thumbnails
                            $image_save_folder = $this->destination_folder . $new_file_name;

                            //call normal_resize_image() function to proportionally resize image
                          //  if ($this->normal_resize_image($image_res, $image_save_folder, $image_type, $this->max_image_size, $image_width, $image_height, $this->jpeg_quality)) {
                               // $imgArr = $new_file_name;
                                $url = 'uploads/articles/' . $article_img_old;
                                $url_ori = 'uploads/articles_original/' . $article_img_old;
                                @unlink($url);
                                @unlink($url_ori);
                          //  }
                            imagedestroy($image_res); //freeup memory
                        }
                    } else {
                        $article_img_old = $this->input->post('article_img_old');
                        $imgArr = $article_img_old;
                    }
                    if ($this->input->post('spoiler') == "" || $this->input->post('spoiler') == " ") {
                        $spoiler = 0;
                    } else {
                        $spoiler = $this->input->post('spoiler');
                    }

                    if ($this->input->post('tag_name') == "" && $this->input->post('tag_name') == " ") {
                        $tag_name = "THEORY";
                    } else {
                        $tag_name = $this->input->post('tag_name');
                    }
                    if ($this->input->post('tag_color') == "" && $this->input->post('tag_color') == " ") {
                        $tag_color = "#dfdfdf";
                    } else {
                        $tag_color = $this->input->post('tag_color');
                    }
                    $tag_style = trim($tag_name) . "," . trim($tag_color);
                    $dataArr = array(
                        'article_name' => $this->input->post('article_name'),
                        'article_description' => $this->input->post('editor1'),
                        'article_image' => $imgArr,
                        'article_url' => $this->input->post('article_url'),
                        'meta_keyword' => $this->input->post('meta_keyword'),
                        'meta_description' => $this->input->post('meta_description'),
                        'tag_style' => $tag_style,
                        'spoiler' => $spoiler,
                        'modified_date' => date('Y-m-d H:i:s')
                    );
                    $result = $this->articlemod->updateArticleById($dataArr, $article_id);

                    if ($this->input->post('article_tag')) {

                        $query = $this->articlemod->delete_tags($article_id);

                        $tag_explode = explode(',', $this->input->post('article_tag'));
                        foreach ($tag_explode as $tag) {
                            $dataArray = array(
                                'article_id' => $article_id,
                                'user_id' => $this->session->userdata('user_id'),
                                'tag' => $tag,
                                'created_date' => date('Y-m-d H:i:s'),
                            );
                            $this->articlemod->saveArticleTag($dataArray);
                        }
                    }

                    $this->session->set_flashdata('message', 'Article updated successfully');
                    redirect('edit_articles/' . $article_id);
                } else {
                    redirect('edit_articles/' . $article_id);
                }
            }
            $data['left'] = "<a href='" . base_url() . "admin_list'>Admin</a> &nbsp;>&nbsp; Edit Articles";
            $data['content_header'] = "Articles";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();
            $data['article_detail'] = $this->articlemod->select_article($article_id);
            $data['tags'] = $this->articlemod->get_tags($article_id);

            $all = '';
            foreach ($data['tags'] as $tags)
                $all.= $tags->tag . ",";

            $data['tag'] = trim($all, ',');
//            $data['data'] = $this->admin->getAdminById($admin_id);

            $data['content'] = $this->load->view('edit_article', $data, TRUE);
            load_admin_template($data);
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

    function normal_resize_image($source, $destination, $image_type, $max_size, $image_width, $image_height, $quality) {

        if ($image_width <= 0 || $image_height <= 0) {
            return false;
        } //return false if nothing to resize
        //do not resize if image is smaller than max size
        if ($image_width <= $max_size && $image_height <= $max_size) {
            if ($this->save_image($source, $destination, $image_type, $quality)) {
                return true;
            }
        }

        //Construct a proportional size of new image
        $image_scale = min($max_size / $image_width, $max_size / $image_height);
        $new_width = ceil($image_scale * $image_width);
        $new_height = ceil($image_scale * $image_height);

        $new_canvas = imagecreatetruecolor($new_width, $new_height); //Create a new true color image
        //Copy and resize part of an image with resampling
        if (imagecopyresampled($new_canvas, $source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height)) {
            $this->save_image($new_canvas, $destination, $image_type, $quality); //save resized image
        }

        return true;
    }

    function save_image($source, $destination, $image_type, $quality) {
        switch (strtolower($image_type)) {//determine mime type  
            case 'image/png':
                imagepng($source, $destination);
                return true; //save png file
                break;
            case 'image/gif':
                imagegif($source, $destination);
                return true; //save gif file
                break;
            case 'image/jpeg': case 'image/pjpeg':
                imagejpeg($source, $destination, $quality);
                return true; //save jpeg file
                break;
            default: return false;
        }
    }

    function article_detail() {
        $url = $this->uri->segment(2);
        $data['article'] = $this->articlemod->get_articles_by_url($url);
        $article_id = $data['article'][0]->article_id;
        $data['tags'] = $this->articlemod->get_tags_by_article_id($article_id);
        $data['comments'] = $this->articlemod->get_comment_of_article($article_id);
        $this->load->view('header', $data);
        $this->load->view('article_browse', $data);
    }

    function add_comment() {
        $article_id = $this->uri->segment(2);
        $data = array(
            'comment' => $this->input->post('article_comment', TRUE),
            'created_date' => date('Y-m-d H:i:s'),
            'article_id' => $article_id,
            'user_id' => $this->session->userdata('user_id')
        );

        $this->articlemod->add_comment($data);
        $user_id = $data['user_id'];
        $query = $this->usermod->get_username($user_id);

        echo '<div id="show_comment" class="show_comments">'
        . '<div class="col-xs-2 col-sm-2 col-md-2 profile-wrap" style="padding:0;">'
        . '<div class="profile-pic">'
        . '<img src="' . base_url() . 'assets/images/user_icon1.jpg" alt="User" class="img-responsive pull-right photo">'
        . '</div>'
        . '</div>'
        . '<div class="col-xs-10 col-sm-10 col-md-10">'
        . '<p class="txt">' . $data["comment"] . '</p>'
        . ' <p class="txt">'
        . 'by '
        . '<span>'
        . '' . $query . ''
        . '</span>'
        . '</p>'
        . '<hr style="margin-bottom: 0%;margin-top: 2%">'
        . '<p class="date">'
        . '' . date("H:i A,D, d M Y", strtotime($data["created_date"])) . ''
        . '</p>'
        . '</div>'
        . '</div>';
    }

    function articles_view() {
        $config = array();
        $config["base_url"] = base_url() . "articles/articles";
        $config["total_rows"] = count($this->homemod->halloffame());
        $config["per_page"] = 15;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['article'] = $this->articlemod->article_limit($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['youtube'] = $this->homemod->get_all_youtube();

        $this->load->view('header');
        $this->load->view('article', $data);
    }

}
