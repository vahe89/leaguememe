<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Leaguelist extends MX_Controller {

    var $max_image_size = 1080; //Maximum image size (height and width)
    var $max_image_size_new = 5000;
    var $thumb_prefix = "thumb_"; //Normal thumb Prefix
    var $destination_folder = './uploads/league/'; //upload directory ends with / (slash)
    var $jpeg_quality = 100; //jpeg quality 

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('users_model', 'usermod');
        $this->load->model('league_model', 'leaguemod');
        $this->load->model('home_model', 'hm');
    }

    function userdetail() {
        $session = $this->session->userdata('user_id');
        return $profile = $this->usermod->userProfile_detail($session);
    }

    function list_league($anime) {
        if ($this->session->userdata('user_id')) {
            $user_id = $this->session->userdata('user_id');
        } else {
            $user_id = 0;
        }
        $main = $this->input->post('main');
        $sub_name = $this->input->post('sub');
        $upload_type = $this->input->post('upload_type');
        if (empty($upload_type)) {
            $up_type = 1;
        } else {
            $up_type = $upload_type;
        }
        if (isset($anime)) {
            $start = $anime;
        } else {
            $start = 0;
        }
$limit  =  $this->input->post('perpage');
        if ($sub_name != "random") {
            if ($sub_name == "Art") {
                 $data['sub_tab_data'] = $this->leaguemod->get_subTab_id("Art/Cosplay");
            } else {
            $data['sub_tab_data'] = $this->leaguemod->get_subTab_id($sub_name);
            
            }
                if (empty($data['sub_tab_data'])) {
                    $sub = 0;
                } else {
                    $sub = $data['sub_tab_data'][0]['category_id'];
                } 
        } else {
            $sub = 0;
        }
        $anime_name = $this->input->post('anime_name');

        if ($anime_name == " ") {
            $anime = 0;
        } else {
            $anime = $anime_name;
        }
        $get_total_rows = 0;
        $items_per_group = $limit;

        $data['row_result'] = $this->leaguemod->get_total_row($main, $sub,$up_type);
        $data['total_row'] = $data['row_result'][0]['totalRecord'];
        $data['total_groups'] = ceil($data['total_row'] / $items_per_group);
        $data['main_category'] = $main;
        $data['sub_category_name'] = $sub_name;
        $data['sub_category'] = $sub;

        $data['league_details'] = $this->leaguemod->list_league($main, $sub, $anime, $start,$limit, $up_type, $user_id);

        if ($this->session->userdata('user_id')) {
            $data['userid'] = $this->session->userdata('user_id');
        }
        $victory = array();
        $defact = array();
        foreach ($data['league_details'] as $league) {
            if (isset($league->vic_users) && !empty($league->vic_users)) {
                $victory[$league->leagueimage_id] = explode(",", $league->vic_users);
            }
            if (isset($league->def_users) && !empty($league->def_users)) {
                $defact[$league->leagueimage_id] = explode(",", $league->def_users);
            }
        }
        $fav_userid = array();
        foreach ($data['league_details'] as $league) {
            if (isset($league->fvtuserid) && !empty($league->fvtuserid)) {
                $fav_userid[$league->leagueimage_id] = explode(",", $league->fvtuserid);
            }
        }
        $data['favuserid'] = $fav_userid;
//        echo "<pre>";
//        print_r($data['favuserid']);
//        exit;
        $data['scroll'] = "0";
        $data['victory'] = $victory;
        $data['defact'] = $defact;
        $data['up_type'] = $up_type;
        $data['total'] = count($data['league_details']);
        echo $this->load->view('list_league_home', $data, true);
    }

    function league_victory() {
        $user_id = $this->session->userdata('user_id');
        if ($user_id != '') {
            $league_image_id = $this->input->post("victory");
            $result = $this->leaguemod->victory_defeat($user_id, $league_image_id);
            //print_r($result);

            if ($result) {
                $victory_status = $result['victory_defeat'];
                $victory_id = $result['victory_id'];
                if ($victory_status == 'V') {
                    $this->leaguemod->removevictory($user_id, $league_image_id);

                    $data['user_upload'] = $this->usermod->getUserNotificationDetail($league_image_id);
                    $other_id = $data['user_upload'][0]['leagueimage_userid'];
                    $comment_id = '0';
                    $this->usermod->delete_notification($league_image_id, $user_id, $other_id, $comment_id);
                    echo json_encode(array('status' => 'delete'));
                    exit;
                } else {
                    $victoryArray = array(
                        'victory_defeat' => 'V'
                    );
                    $this->leaguemod->updatevictory($victoryArray, $victory_id);
                    $data['user_upload'] = $this->usermod->getUserNotificationDetail($league_image_id);

                    $other_id = $data['user_upload'][0]['leagueimage_userid'];

                    $notificationArray = array(
                        'user_id' => $other_id,
                        'other_user_id' => $user_id,
                        'leagueimage_id' => $league_image_id,
                        'pre_value' => 'Upvote your post',
                        'noti_date' => date("Y-m-d"),
                    );
                    if ($other_id !== $this->session->userdata('user_id'))
                        $this->usermod->add_notification($notificationArray);

                    echo json_encode(array('status' => 'update'));
                    exit;
                }
            } else {
                $victoryArray = array(
                    'leagueimages_id' => $league_image_id,
                    'user_id' => $this->session->userdata('user_id'),
                    'victory_defeat' => 'V',
                    'victory_status' => 'A');
                $this->leaguemod->add_victory_defeat($victoryArray);
                $data['user_upload'] = $this->usermod->getUserNotificationDetail($league_image_id);

                $other_id = $data['user_upload'][0]['leagueimage_userid'];

                $notificationArray = array(
                    'user_id' => $other_id,
                    'other_user_id' => $user_id,
                    'leagueimage_id' => $league_image_id,
                    'pre_value' => 'Upvote your post',
                    'noti_date' => date("Y-m-d"),
                );
                if ($other_id !== $this->session->userdata('user_id')) {
                    $this->usermod->add_notification($notificationArray);
                }
                echo json_encode(array('status' => 'insert'));
                exit;
            }
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

    function league_defeat() {
        $user_id = $this->session->userdata('user_id');
        if ($this->session->userdata('user_id')) {
            $league_image_id = $this->input->post("defeat");
            $result = $this->leaguemod->victory_defeat($user_id, $league_image_id);
            if ($result) {
                $victory_status = $result['victory_defeat'];
                $victory_id = $result['victory_id'];
                if ($victory_status == 'D') {
                    $this->leaguemod->removedefact($user_id, $league_image_id);
                    echo json_encode(array('status' => 'delete'));
                    exit;
                } else {
                    $victoryArray = array('victory_defeat' => 'D');
                    $this->leaguemod->updatevictory($victoryArray, $victory_id);

                    echo json_encode(array('status' => 'update'));
                    exit;
                }
            } else {
                $victoryArray = array(
                    'leagueimages_id' => $league_image_id,
                    'user_id' => $this->session->userdata('user_id'),
                    'victory_defeat' => 'D',
                    'victory_status' => 'A'
                );
                $this->leaguemod->add_victory_defeat($victoryArray);


                echo json_encode(array('status' => 'insert'));
                exit;
            }
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

    function league_favourites() {
        $user_id = $this->session->userdata('user_id');
        if ($user_id != '') {
            $league_image_id = $this->input->post("favourites");
            $result = $this->leaguemod->sel_favourites($user_id, $league_image_id);
//            print_r($result);

            if ($result) {
                $favourites_status = $result['favourites_status'];
                $favourites_id = $result['favourites_id'];

                if ($favourites_status == NULL) {
                    $favouritesArray = array(
                        'leagueimage_id' => $league_image_id,
                        'user_id' => $this->session->userdata('user_id'),
                        'favourites_status' => 'A');
                    $this->leaguemod->add_favourites($favouritesArray);
                    echo json_encode(array('status' => 'insert'));
                    exit;
                } else if ($favourites_status == "A") {
//                    $favouritesArray = array(
//                        'favourites_status' => 'I'
//                    );
                    $this->leaguemod->removefavourites($user_id, $favourites_id);
                    echo json_encode(array('status' => 'delete'));
                    exit;
//                    $this->leaguemod->updatefavourites($favouritesArray, $favourites_id);
//                    echo json_encode(array('status' => 'update'));
//                    exit;
                }
            } else {
                $favouritesArray = array(
                    'leagueimage_id' => $league_image_id,
                    'user_id' => $this->session->userdata('user_id'),
                    'favourites_status' => 'A');
                $this->leaguemod->add_favourites($favouritesArray);
                echo json_encode(array('status' => 'insert'));
                exit;
            }
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

    function list_scroll_data() {
        if ($this->session->userdata('user_id')) {
            $user_id = $this->session->userdata('user_id');
        } else {
            $user_id = 0;
        }
        $main = $this->input->post('main');
        $sub_name = $this->input->post('sub');
        $upload_type = $this->input->post('upload_type');
        $offset = $this->input->post('offset') + $this->input->post('perpage');
        if (empty($upload_type)) {
            $up_type = 1;
        } else {
            $up_type = $upload_type;
        }
        if ($sub_name != "random") {
             if ($sub_name == "Art") {
                 $data['sub_tab_data'] = $this->leaguemod->get_subTab_id("Art/Cosplay");
            } else {
            $data['sub_tab_data'] = $this->leaguemod->get_subTab_id($sub_name);
            
            } 
            $sub = $data['sub_tab_data'][0]['category_id'];
        } else {
            $sub = 0;
        }
        $anime_name = $this->input->post('anime_name');

        if ($anime_name == " ") {
            $anime = 0;
        } else {
            $anime = $anime_name;
        }
        $get_total_rows = 0;
        $items_per_group = $this->input->post('perpage');

        $data['league_details'] = $this->leaguemod->list_league_new($main, $sub, $anime, $offset, $items_per_group, $up_type, $user_id, $offset);
        //$data['league_details'] = $this->leaguemod->list_scroll_league($main, $sub, $anime, $position, $items_per_group, $up_type, $user_id, $offset);
//        echo "<pre>";
//        print_r($data['league_details']);
//        exit;
        if ($this->session->userdata('user_id')) {
            $data['userid'] = $this->session->userdata('user_id');
        }
        $victory = array();
        $defact = array();
        foreach ($data['league_details'] as $league) {
            if (isset($league->vic_users) && !empty($league->vic_users)) {
                $victory[$league->leagueimage_id] = explode(",", $league->vic_users);
            }
            if (isset($league->def_users) && !empty($league->def_users)) {
                $defact[$league->leagueimage_id] = explode(",", $league->def_users);
            }
        }
        $data['scroll'] = "1";
        $data['victory'] = $victory;
        $data['defact'] = $defact;
        $data['up_type'] = $up_type;
        $data['total'] = count($data['league_details']);
        echo $this->load->view('list_league_home', $data, true);
    }

    function more_fun_data() {
        if ($this->session->userdata('user_id')) {
            $user_id = $this->session->userdata('user_id');
        } else {
            $user_id = 0;
        }
        $main = $this->input->post('main');
        $sub_name = $this->input->post('sub');
        if ($sub_name != "random") {
            $data['sub_tab_data'] = $this->leaguemod->get_subTab_id($sub_name);
            $sub = $data['sub_tab_data'][0]['category_id'];
        } else {
            $sub = 0;
        }
        $anime_name = $this->input->post('anime_name');

        if ($anime_name == " ") {
            $anime = 0;
        } else {
            $anime = $anime_name;
        }
        $get_total_rows = 0;
        $items_per_group = $this->input->post('perpage');
        $group_number = $this->input->post('group_no');

//        $position = ($group_number * $items_per_group);
        $position = $group_number;

        $data['league_details'] = $this->leaguemod->list_scroll_league($main, $sub, $anime, $position, $items_per_group, $user_id);
//        echo "<pre>";
//        print_r($data['league_details']);
//        exit;
        if ($this->session->userdata('user_id')) {
            $data['userid'] = $this->session->userdata('user_id');
        }
        $victory = array();
        $defact = array();
        foreach ($data['league_details'] as $league) {
            if (isset($league->vic_users) && !empty($league->vic_users)) {
                $victory[$league->leagueimage_id] = explode(",", $league->vic_users);
            }
            if (isset($league->def_users) && !empty($league->def_users)) {
                $defact[$league->leagueimage_id] = explode(",", $league->def_users);
            }
        }
        $data['scroll'] = "0";
        $data['victory'] = $victory;
        $data['defact'] = $defact;
        $data['total'] = count($data['league_details']);
        echo $this->load->view('list_league_home', $data, true);
    }

    function league_image_tag($tag = '') {

        $text_search = str_replace("#", "", $this->input->post('search'));
        $league_name = trim($text_search);
        if (empty($league_name)) {
            $league_name1 = urldecode($tag);
            if (empty($league_name1)) {
                // $this->session->set_flashdata('message', 'Tag not found.');
                redirect(base_url());
                exit;
            } else {
                $league_name = str_replace("-", " ", $league_name1);
            }
        }
        $data['tag_league_name'] = $league_name;
        $start = 0;
        $items_per_group = 8;

        $league_ids = $this->leaguemod->get_leagueimage_id($start, $items_per_group, $league_name);

        //echo $league_ids->num_rows();
        if ($league_ids->num_rows() == 0) {
            $data["total_rows"] = 0;
        } else {
            $data["total_rows"] = $league_ids->num_rows();
        }

        $data['userdetail'] = $this->userdetail();
        $data['total_groups'] = ceil($data['total_rows'] / $items_per_group);

        $data["side_link"] = $this->hm->get_all_sidelinksside();
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside();
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
        $data["new_post"] = $this->hm->get_new_post();
        $data["new_discussion"] = $this->hm->get_let_discussion();
        $data["new_like"] = $this->hm->get_newlike();
        $items_per_group = 8;
        $data['username'] = $this->session->userdata('uname');
        $data['content'] = $this->load->view('tag_search', $data, TRUE);
        load_public_template($data);
    }

    function list_tag_leagues() {

        $league_name = $this->input->post('tags');
        $total_data = $this->input->post('total_data');
        $start = 1;
        $items_per_group = 8;

        if ($total_data == 0) {
            
        } else {
            $data["total_rows"] = $total_data;
        }

        $league_ids = $this->leaguemod->get_leagueimage_id($start, $items_per_group, $league_name);
        $ids = '';
        foreach ($league_ids->result() as $id) {
            $ids .= "'" . $id->leagueimage_id . "',";
        }
        $ids = trim($ids, ",");
//        $data["league_images"] = $this->leaguemod->league_search();
        $data["league_images"] = $this->leaguemod->league_search($ids);

        if ($this->session->userdata('user_id')) {
            $data['userid'] = $this->session->userdata('user_id');
        }
        $victory = array();
        $defact = array();
        $fav_userid = array();

        if (!empty($data["league_images"])) {
            foreach ($data["league_images"] as $league) {
                if (isset($league->vic_user) && !empty($league->vic_user)) {
                    $victory[$league->leagueimage_id] = explode(",", $league->vic_user);
                }
                if (isset($league->def_users) && !empty($league->def_users)) {
                    $defact[$league->leagueimage_id] = explode(",", $league->def_users);
                }
            }


            foreach ($data["league_images"] as $league) {
                if (isset($league->fvtuserid) && !empty($league->fvtuserid)) {
                    $fav_userid[$league->leagueimage_id] = explode(",", $league->fvtuserid);
                }
            }
        }
        $data['favuserid'] = $fav_userid;
        $data['scroll'] = "0";
        $data['victory'] = $victory;
        $data['defact'] = $defact;
        $data['league_name'] = $league_name;

        $data['userid'] = $this->session->userdata('user_id');
        echo $this->load->view('tag_search_list', $data, true);
    }

    function list_tag_scroll() {

        $group_number = $this->input->post('group_no');
        $items_per_group = 8;
        $position = ($group_number * $items_per_group);

        $league_name = $this->input->post('tags');
        $league_ids = $this->leaguemod->get_leagueimage_id($position, $items_per_group, $league_name);

        $ids = '';
        foreach ($league_ids->result() as $id) {
            $ids .= "'" . $id->leagueimage_id . "',";
        }
        $ids = trim($ids, ",");
        $data['scroll'] = "1";
        $data["league_images"] = $this->leaguemod->league_search($ids);

        echo $this->load->view('tag_search_list', $data, true);
    }

    function add_comment() {

        $league_img_id = $this->input->post("league_img_id");
        $commentArray = array(
            'leagueimage_id' => $league_img_id,
            'user_id' => $this->session->userdata('user_id'),
            'comment' => $this->input->post("comment"));

        $this->leaguemod->add_comments($commentArray);
        echo "success";
    }

    function delete_comment() {
        $comment_id = $this->input->post("comment_id");
        $user_id = $this->input->post("u_id");

        $this->leaguemod->delete_comment($comment_id, $user_id);

        echo "success";
    }

    function single_image_list($league_id = '') {

        //$data['league_details'] = $this->leaguemod->list_league($main, $sub);
        $data['userdetail'] = $this->userdetail();
        $data['league_details'] = $this->leaguemod->single_image_list($league_id);

        $total_view = $data['league_details'][0]->leagueimage_total_view;
        $viewArray = array(
            'leagueimage_total_view' => $total_view + 1,
        );
        $view = $this->leaguemod->update_view($league_id, $viewArray);

        $category_id = $this->leaguemod->get_subTab_id(@$data['league_details'][0]->category_name);
        $image_type = $data['league_details'][0]->leagueimage_setpopular;

        $view = $this->leaguemod->update_view($league_id, $viewArray);
        if ($image_type == "Y") {
            $image_type = "popular";
        } else {
            $image_type = "new";
        }


        $all_images = $this->leaguemod->list_league($image_type, $category_id[0]['category_id'], 0, '0','1', 0);


        $next_image = 0;

        reset($all_images);
        $first_key = key($all_images);


        foreach ($all_images as $key => $row) {
            if ($row->leagueimage_id == $league_id) {
                $key1 = $key + 1;
                if (isset($all_images[$key1]->leagueimage_id)) {
                    $next_image = $all_images[$key1]->leagueimage_id;
                } else {
                    $next_image = $all_images[$first_key]->leagueimage_id;
                }
            }
        }
        $data['next_image'] = $next_image;
        if ($this->session->userdata('user_id')) {
            $data['userid'] = $this->session->userdata('user_id');
        }

        $victory = array();
        $defact = array();
        foreach ($data['league_details'] as $league) {
            if (isset($league->vic_users) && !empty($league->vic_users)) {
                $victory[$league->leagueimage_id] = explode(",", $league->vic_users);
            }
            if (isset($league->def_users) && !empty($league->def_users)) {
                $defact[$league->leagueimage_id] = explode(",", $league->def_users);
            }
        }
        $data['victory'] = $victory;
        $data['defact'] = $defact;
        $anime = 0;
        $data["side_link"] = $this->hm->get_all_sidelinksside();
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside();
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
        $data['username'] = $this->session->userdata('uname');
        $data['content'] = $this->load->view('single_image_list', $data, TRUE);
        load_public_template($data);
    }

    public function season_index() {
        $Session = $this->session->userdata('user_id');
        $data['userdetail'] = $this->userdetail();
        $data['username'] = $this->session->userdata('uname');
        $data['userid'] = $this->session->userdata('user_id');
        $data["side_link"] = $this->hm->get_all_sidelinksside();
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside();
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
        $data["new_post"] = $this->hm->get_new_post();
        $data["new_discussion"] = $this->hm->get_let_discussion();
        $data["new_like"] = $this->hm->get_newlike();
        $data['active_menu'] = "leaguememe";
        $rightbar = array(
                'rules' => ''
            );
        $data["right_bar"] = $rightbar;
          $data['getTabposition'] = $this->leaguemod->getTabs();

        $data['sub_items'] = $this->get_sub_items(false, false);
        $data['content_content'] = $this->getSubContent('season-old', '', 0);
        $data['content'] = $this->load->view('index', $data, TRUE);
        load_public_template($data);
    }

    function season_old() { 
        $dir = getcwd() . '/uploads/backup/images';
        $allow = array('jpg', 'jpeg', 'JPEG', 'JPG', 'gif', 'png', 'PNG', 'GIF');
        $i = 0;
        $open = opendir($dir);
        $league = "";
        $league_details[] = array();
        while (($file = readdir($open)) !== false) {
            $ext = str_replace('.', '', strrchr($file, '.'));
            if (in_array($ext, $allow))
                $list[$i++] = $file;
        }
          
            $page_to = $this->input->post('season_page'); 
            $perPage = $page_to;  
        $total = count($list);
        $pages = ceil($total / $perPage);

        $thisPage = isset($_POST['group_no']) ? $_POST['group_no'] : 0;
        $start = $thisPage * $perPage;
        $imgCnt = 0;
        for ($i = $start; $i < $start + $perPage; $i++) {

            if (isset($list[$i]))
                $league_details[$i]['leagueimage_filename'] = $list[$i];
            else
                $imgCnt+=1;
        }
        closedir($open);
        $data['league_details'] = $league_details;
         $data['perPage'] = $perPage;
        $data['total_groups'] = $pages;
        echo $this->load->view('season_old_list', $data, true);
        exit;
//        $dir = getcwd() . '/uploads/backup/images';
//        $file_display = array(
//            'jpg',
//            'jpeg',
//            'png',
//            'gif'
//        );
//
//        $league = "";
//        $league_details[] = array(); 
//        if (file_exists($dir) == false) {
//            echo 'Directory \'' . $dir . '\' not found!';
//        } else {
//            $dir_contents = scandir($dir);
//            $i = 0;
//            foreach ($dir_contents as $file) {
//                $file_type = strtolower(end(explode('.', $file)));
//                $file_detail = (explode('.', $file));
//
//                if ($file !== '.' && $file !== '..' && in_array($file_type, $file_display) == true) {
//                    $league_details[$i]['leagueimage_filename'] = $file;
//                    $league_details[$i]['leagueimage_name'] = $file_detail[0];
//                    array_push($league_details, $league);
//                    $i++;
//                }
//            }
//            $data['league_details'] = $league_details;
//            echo $this->load->view('season_old_list', $data, true);
//        }
    }
    function getCredit_author(){
        $getData = $this->leaguemod->getAuthore();
        $creditHtml = '';
        foreach ($getData as $val){
            $creditHtml .= '<img class="image_filter" style="cursor: pointer" src="'. base_url() .'uploads/author/'.$val->image.'"  data-name="'. $val->name.'" data-link="'. $val->link.'" style="width:32px;height:32px">' ;
        }
        echo $creditHtml;
        exit;
    }

    private function getSubContent($main, $sub_name, $orderid){

        if ($this->session->userdata('user_id')) {
            $user_id = $this->session->userdata('user_id');
        } else {
            $user_id = 0;
        }

        if (empty($upload_type)) {
            $up_type = 1;
        } else {
            $up_type = $upload_type;
        }
        if (isset($anime)) {
            $start = $anime;
        } else {
            $start = 0;
        }

        $limit  = 10 ;

        if (stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")) {

            $limit = 4;
        }
        if ($sub_name != "random") {
            if ($sub_name == "Art") {
                $data['sub_tab_data'] = $this->leaguemod->get_subTab_id("Art/Cosplay");
            } else {
                $data['sub_tab_data'] = $this->leaguemod->get_subTab_id($sub_name);

            }
            if (empty($data['sub_tab_data'])) {
                $sub = 0;
            } else {
                $sub = $data['sub_tab_data'][0]['category_id'];
            }
        } else {
            $sub = 0;
        }
        $anime_name =' ';

        if ($anime_name == " ") {
            $anime = 0;
        } else {
            $anime = $anime_name;
        }
        $get_total_rows = 0;
        $items_per_group = $limit;

        $data['row_result'] = $this->leaguemod->get_total_row($main, $sub,$up_type);
        $data['total_row'] = $data['row_result'][0]['totalRecord'];
        $data['total_groups'] = ceil($data['total_row'] / $items_per_group);
        $data['main_category'] = $main;
        $data['sub_category_name'] = $sub_name;
        $data['sub_category'] = $sub;

        $data['league_details'] = $this->leaguemod->list_league($main, $sub, $anime, $start,$limit, $up_type, $user_id);

        if ($this->session->userdata('user_id')) {
            $data['userid'] = $this->session->userdata('user_id');
        }
        $victory = array();
        $defact = array();
        foreach ($data['league_details'] as $league) {
            if (isset($league->vic_users) && !empty($league->vic_users)) {
                $victory[$league->leagueimage_id] = explode(",", $league->vic_users);
            }
            if (isset($league->def_users) && !empty($league->def_users)) {
                $defact[$league->leagueimage_id] = explode(",", $league->def_users);
            }
        }
        $fav_userid = array();
        foreach ($data['league_details'] as $league) {
            if (isset($league->fvtuserid) && !empty($league->fvtuserid)) {
                $fav_userid[$league->leagueimage_id] = explode(",", $league->fvtuserid);
            }
        }
        $data['favuserid'] = $fav_userid;
//        echo "<pre>";
//        print_r($data['favuserid']);
//        exit;
        $data['scroll'] = "0";
        $data['victory'] = $victory;
        $data['defact'] = $defact;
        $data['up_type'] = $up_type;
        $data['total'] = count($data['league_details']);
        $result = $this->load->view('list_league_home', $data, true);
        return $result;
    }


    function get_sub_items($types='new',$subtype = 'all') {

        if (!empty($types)) {
            if ($types == "popular") {
                $maintabval = "popular";
            } else if ($types == "new") {
                $maintabval = "new";
            } else if ($types == "bookmark") {
                $maintabval = "bookmark";
            } else {
                $maintabval = "popular";
            }
        } else {
            $maintabval = "popular";
        }

        if (!empty($subtype)) {

            $subtabval = $subtype;
        } else {
            $subtabval = "";
        }
        $data['subTabData'] = $this->hm->get_sub_tabs();
        $total = count($data['subTabData']);
        $html = '';
        $type = $this->input->post('type');


        for ($i = 0; $i < $total; $i++) {
            $active = "";


            if ($data['subTabData'][$i]['category_name'] == "All") {
                if ($subtabval == "All") {
                    $active = "active";
                }
                $html .= '<li class="' . $type . $active . ' subTab" id="' . $type . '' . $data["subTabData"][$i]["category_name"] . '"><a id="' . $type . 'sub' . $data["subTabData"][$i]["category_id"] . '" href="' . base_url()  . "new/" . 'all" class="active">' . ucwords($data["subTabData"][$i]["category_name"]) . '</a></li>';
//$html .= "<li class='subTab active' id='" . $data['subTabData'][$i]['category_id'] . "'><a id='" . $data['subTabData'][$i]['category_id'] . "' class='active' href='#'>" . ucwords($data['subTabData'][$i]['category_name']) . "</a></li>";
            } else {
                $cate_name =  $data['subTabData'][$i]['category_name'];

                if ($data['subTabData'][$i]['category_name'] == "Art/Cosplay") {
                    $category = "art";
                } else {
                    $category = $data['subTabData'][$i]['category_name'];
                }
                $html .= '<li class="' . $type ;
                if($subtabval == "Art"){
                    $cate_new_name = "Art/Cosplay";
                }else{
                    $cate_new_name = ucfirst($subtabval) ;
                }
                if($cate_new_name == $cate_name) { $html .= 'active' ; }
                $html .='  subTab" id="' . $type . '' . $data["subTabData"][$i]["category_name"] . '"><a id="' . $type . 'sub' . $cate_name . '" href="' . base_url() . "new/" . strtolower($category) . '">' . ucwords($data["subTabData"][$i]["category_name"]) . '</a></li>';
//$html .= "<li class='subTab' id='" . $data['subTabData'][$i]['category_id'] . "'><a id='" . $data['subTabData'][$i]['category_id'] . "' href='#'>" . ucwords($data['subTabData'][$i]['category_name']) . "</a></li>";
            }
        }
        $actives = "";
        if ($subtabval == "random") {
            $actives = "active";
        }

        $html .= "<li class='" . $type . $actives . " subTab' id='" . $type . "random'><a id='" . $type . "sub0' href='" . base_url() . 'new/' . "random'>Random</a></li>";
        return $html;
    }

}

?>