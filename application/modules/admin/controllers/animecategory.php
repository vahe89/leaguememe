<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Animecategory extends MX_Controller {

    var $max_image_size = 1080; //Maximum image size (height and width)
    var $max_image_size_new = 5000;
    var $thumb_prefix = "thumb_"; //Normal thumb Prefix
    var $destination_folder = './uploads/league/'; //upload directory ends with / (slash)
    var $jpeg_quality = 100; //jpeg quality 

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));

        $this->load->model('league_model', 'leaguemod');
        $this->load->model('admin_model', 'admin');
        $this->load->model('users_model', 'usermod');
        $this->load->model('category_model', 'category');
        $this->load->model('anime_model', 'animod');
        $this->load->library('email');
        $this->load->library("pagination");
    }

    function anime_category() {
        if ($this->session->userdata('logged_in')) {
            $data['left'] = "<a href='" . base_url() . "anime-category'>Anime</a> &nbsp;>&nbsp; anime-category";
            $data['content_header'] = "Anime";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();

            $data['content'] = $this->load->view('anime_category', $data, TRUE);
            load_admin_template($data);
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

    function anime_category_list() {
        $this->animod->anime_category_request();
    }

    function edit_anime_detail($anime_img_id) {

        if ($this->session->userdata('logged_in')) {


            if ($_POST) {

                $dataArr = array(
                    'anime_id' => $anime_img_id,
                    'score' => $this->input->post('anime_score'),
                    'current_episode' => $this->input->post('anime_manga'),
                    'current_manga' => $this->input->post('anime_manga'),
                    'status' => $this->input->post('league_img_status'),
                    'synonyms' => $this->input->post('anime_synonyms'),
                    'english' => $this->input->post('anime_english'),
                    'japanese' => $this->input->post('anime_japanese'),
                    'episode' => $this->input->post('episode_no'),
                    'aired' => $this->input->post('anime_aired'),
                    'jenres' => $this->input->post('anime_genres'),
                    'duration' => $this->input->post('anime_duration'),
                    'rating' => $this->input->post('anime_rating')
                );

                $result = $this->animod->getanime_editdetail($anime_img_id);
                if (empty($result)) {
                    $this->animod->insertAnimedata($anime_img_id, $dataArr);
                } else {
                    $this->animod->updateAnimedata($anime_img_id, $dataArr);
                }
            }
            $data['anime_data'] = $this->animod->getDataByAnimeimage($anime_img_id);
            $data['result'] = $this->animod->animedetail($anime_img_id);

            $data['left'] = "<a href='" . base_url() . "anime-category'>Anime</a> &nbsp;>&nbsp; Edit Anime Detail";
            $data['content_header'] = "Anime Category";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();

            $data['content'] = $this->load->view('edit_animedetail', $data, TRUE);
            load_admin_template($data);
        } else {
            redirect('admin/login');
        }
    }

    function add_anime_category() {

        if ($this->session->userdata('logged_in')) {
            if ($_POST) {

                $this->form_validation->set_rules('anime_category_name', 'Category Name', 'required|is_unique[anime.anime_name]');

                $validate = $this->form_validation->run();
                if ($validate == TRUE) {
                    $image_name = $_FILES['anime_category_photo']['name'];
                    $config['upload_path'] = './uploads/anime/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = 100000;
                    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    $filename = rand(0, 9999999999);
                    $category_photo = $filename . '.' . $ext;
                    $episode_time = trim($this->input->post('anime_episode_time'));
                    $episode = $this->input->post('anime_episode');
                    $manga_time = trim($this->input->post('anime_manga_time'));
                    $manga = $this->input->post('anime_manga');
                    $config['file_name'] = $filename;
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('anime_category_photo')) {
                        $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('message', 'type of file is not valid');
                        redirect('anime-category');
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                    }
                    $category_name = trim($this->input->post('anime_category_name'));

                    $dataArr = array(
                        'anime_name' => $category_name,
                        'anime_jpg' => $category_photo,
                        'anime_access' => '1',
                        'anime_userid' => '0',
                        'anime_interest_count' => '0',
                        'anime_status' => '1',
                        'episode_time' => $episode_time,
                        'episode' => $episode,
                        'manga_time' => $manga_time,
                        'manga' => $manga,
                    );

                    $result = $this->animod->add_animecategory_data($dataArr);
                    $sub_category = $this->input->post('anime_sub_cate');

                    foreach ($sub_category as $sub) {

                        $cateArr = array(
                            'anime_id' => $result,
                            'sub_cate' => $sub
                        );
                        $this->animod->add_animesubcategory_data($cateArr);
                    }

                    $this->session->set_flashdata('message', 'Category added successfully');
                    redirect('anime-category');
                }
            }

            $data['left'] = "<a href='" . base_url() . "anime-category'>Anime</a> &nbsp;>&nbsp; Edit Anime Detail";
            $data['content_header'] = "Anime Category";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();
            $data['content'] = $this->load->view('add_anime_category', $data, TRUE);
            load_admin_template($data);
        } else {
            redirect('admin/login');
        }
    }

    function delete_animecategory() {
        $cid = $this->input->post('category_id');
        $dataArr = array(
            'anime_status' => '0'
        );
        $this->animod->deleteCategory($cid, $dataArr);
        $this->session->set_flashdata('message', 'Category  deleted successfully');
    }

    function change_category_photo() {
        $cid = $this->input->post('aniId');
        $image_name = $_FILES['anime_category_photo']['name'];
        $config['upload_path'] = './uploads/anime/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100000;
        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
        $filename = rand(0, 9999999999);
        $category_photo = $filename . '.' . $ext;
        $config['file_name'] = $filename;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('anime_category_photo')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('message', 'type of file is not valid');
            redirect('anime-category');
        } else {
            $data = array('upload_data' => $this->upload->data());
        }

        $data = array(
            'anime_jpg' => $category_photo
        );

        $this->animod->update_photo_anime($cid, $data);
        $this->session->set_flashdata('message', 'Photo Change successfully');
        redirect('anime-category');
    }

    function changeanime_episode_time() {
        $cid = $this->input->post('aniEpId');
        $episode_time = $this->input->post('anime_episode_time');
        $data = array(
            'episode_time' => trim($episode_time)
        );
        $this->animod->update_episode_time($cid, $data);
        $this->session->set_flashdata('message', 'Episode time Change successfully');
        redirect('anime-category');
    }

    function changeanime_manga_time() {
        $cid = $this->input->post('animgId');
        $manga_time = $this->input->post('anime_manga_time');
        $data = array(
            'manga_time' => trim($manga_time)
        );
        $this->animod->update_manga_time($cid, $data);
        $this->session->set_flashdata('message', 'Manga time Change successfully');
        redirect('anime-category');
    }

    function edit_subCategory($anime_id) {

        if ($this->session->userdata('logged_in')) {

            $data['left'] = "<a href='" . base_url() . "anime-category'>Anime</a> &nbsp;>&nbsp; Edit Anime Detail";
            $data['content_header'] = "Anime Category";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();
            $sub_cate = $this->animod->getAnimeSubtab($anime_id);
            foreach ($sub_cate as $sub) {
                if ($sub->sub_cate == 'discussion') {
                    $data['discussion'] = $sub->sub_cate;
                } else if ($sub->sub_cate == 'manga') {
                    $data['manga'] = $sub->sub_cate;
                } else if ($sub->sub_cate == 'theories') {
                    $data['theories'] = $sub->sub_cate;
                } else if ($sub->sub_cate == 'episode') {
                    $data['episode'] = $sub->sub_cate;
                } else if ($sub->sub_cate == 'review') {
                    $data['review'] = $sub->sub_cate;
                } else if ($sub->sub_cate == 'quotes') {
                    $data['quotes'] = $sub->sub_cate;
                }
            }

            $data['anime_id'] = $anime_id;
            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();
            $data['content'] = $this->load->view('edit_anime_sub_category', $data, TRUE);
            load_admin_template($data);
        } else {
            redirect('admin/login');
        }
    }

    function edit_categorySub($anime_id) {
        if ($this->session->userdata('logged_in')) {
            $this->animod->deleteanimesubcate($anime_id);

            $sub_category = $this->input->post('anime_sub_cate');

            foreach ($sub_category as $sub) {
                $cateArr = array(
                    'anime_id' => $anime_id,
                    'sub_cate' => $sub
                );

                $this->animod->add_animesubcategory_data($cateArr);
            }
        } else {
            redirect('admin/login');
        }
    }

    function popular_status() {

        $anime_id = $this->input->post('anime_id');
        $popular_status = $this->input->post('popular_status');

        if ($popular_status == 1) {
            $dataArr = array('anime_popular' => 0);
        } else {
            $dataArr = array('anime_popular' => 1);
        }
        $result = $this->animod->updateAnimePopulartatus($dataArr, $anime_id);
        $this->session->set_flashdata('message', 'Status updated successfully');
        redirect('anime-category');
    }

}
