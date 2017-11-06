<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MX_Controller {

    var $max_image_size = 640; //Maximum image size (height and width)
    var $max_image_size_new = 800;
    var $thumb_prefix = "thumb_"; //Normal thumb Prefix
    var $destination_folder = 'uploads/users/';
    var $destination_folder1 = 'uploads/league/'; //upload directory ends with / (slash)
    var $jpeg_quality = 100;
    var $htmldata = array();
    var $max_image_size_upload = 1024;
    var $destination_folder_dump = 'uploads/dump/';

    function __construct() {

        parent::__construct();
//$this->load->library('email');
        $this->load->helper('text');
        $this->load->model('users_model', 'usermod');
        $this->load->model('league_model', 'leaguemod');
        $this->load->model('anime_model', 'animemod');
        $this->load->model('home_model', 'hm');
        $this->load->helper('template');
        $this->load->library('upload');
    }

    function userdetail() {
        $session = $this->session->userdata('user_id');
        return $profile = $this->usermod->userProfile_detail($session);
    }

    public function index($anime = 0) {
//        $orderid = $this->input->post('orderid');
        $pagetrackid = $this->input->post('pagetrackid');
        $maintabval = $this->input->post('mainTabval');
        $subtabval = $this->input->post('subTabval');
        $animename1 = $this->input->post('anime_name');

        $Session = $this->session->userdata('user_id');
        $data['orderid'] = $anime;
        $data['pagetrackid'] = $pagetrackid;
        $data['maintabval'] = $maintabval;
        $data['subtabval'] = $subtabval;
        $data['animename1'] = $animename1;
        $data['userdetail'] = $this->userdetail();
        $data['username'] = $this->session->userdata('uname');
        $data['userid'] = $this->session->userdata('user_id');
        $data["side_link"] = $this->hm->get_all_sidelinksside($anime, $maintabval);
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside($anime, $maintabval);
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
        $data["new_post"] = $this->hm->get_new_post();
        $data["new_discussion"] = $this->hm->get_let_discussion();
        $data["new_like"] = $this->hm->get_newlike();
        $data['content'] = $this->load->view('index', $data, TRUE);
        load_public_template($data);
    }

    function get_sub_tab_data() {
        $data['subTabData'] = $this->hm->get_sub_tabs();
        $total = count($data['subTabData']);
        $html = '';
        for ($i = 0; $i < $total; $i++) {
            if ($data['subTabData'][$i]['category_name'] == "All the Things") {

                $html .= '<li class="subTab active" id="' . $data["subTabData"][$i]["category_name"] . '"><a id="sub' . $data["subTabData"][$i]["category_id"] . '" href="javascript:void(0);" class="active">' . ucwords($data["subTabData"][$i]["category_name"]) . '</a></li>';
//$html .= "<li class='subTab active' id='" . $data['subTabData'][$i]['category_id'] . "'><a id='" . $data['subTabData'][$i]['category_id'] . "' class='active' href='#'>" . ucwords($data['subTabData'][$i]['category_name']) . "</a></li>";
            } else {
                $html .= '<li class="subTab" id="' . $data["subTabData"][$i]["category_name"] . '"><a id="sub' . $data["subTabData"][$i]["category_id"] . '" href="javascript:void(0);">' . ucwords($data["subTabData"][$i]["category_name"]) . '</a></li>';
//$html .= "<li class='subTab' id='" . $data['subTabData'][$i]['category_id'] . "'><a id='" . $data['subTabData'][$i]['category_id'] . "' href='#'>" . ucwords($data['subTabData'][$i]['category_name']) . "</a></li>";
            }
        }
        $html .= "<li class='subTab' id='random'><a id='sub0' href='javascript:void(0)'>Random</a></li>";
        echo $html;
    }

    function getCommentData() {
        $id = $this->input->post('cmtDATAid');
        $cmtdata = $data_side = $this->hm->getLegaueCmtData($id);

        $total_comment = 0;

        $data['return_array'] = array();
        foreach ($cmtdata as $cmt) {

            if ($cmt->parent_id == 0 && !isset($return_array[$cmt->comment_id])) {
                $return_array[$cmt->comment_id] = array();
                $return_array[$cmt->comment_id]['main_comment'] = $cmt;
                $return_array[$cmt->comment_id]['main_comment']->total_like = $this->hm->getCommentLikes($cmt->comment_id);
                $return_array[$cmt->comment_id]['main_comment']->total_dislike = $this->hm->getCommentDislikes($cmt->comment_id);
            } else if ($cmt->parent_id != 0) {
                $cmt->total_like = $this->hm->getCommentLikes($cmt->comment_id);
                $cmt->total_dislike = $this->hm->getCommentDislikes($cmt->comment_id);
//$cmt->T_COMMENT = count($return_array[$cmt->parent_id]);
//$total_comment = $cmt->T_COMMENT;
                $return_array[$cmt->parent_id][] = $cmt;
            }

// $return_array[$cmt->comment_id]->T_COMMENT = $total_comment;
        }

        $new_array = array();
        if (!empty($return_array)) {

//        $return_array = array();
            foreach ($return_array as $key => $row) {

                if (isset($row['main_comment'])) {

                    $return_array[$key]['main_comment']->t_comment = count($row);

                    $return_array[$key]['main_comment']->t_point = ((int) $return_array[$key]['main_comment']->total_like) - ((int) $return_array[$key]['main_comment']->total_dislike);

                    $new_array[$key]['t_point'] = $row['main_comment']->t_point;
                    $new_array[$key]['t_comment'] = $row['main_comment']->t_comment;
                }
            }
        }
        $this->sortBySubArrayValue($new_array, 't_comment', 'desc');

        $i = 0;
        foreach ($new_array as $key => $row) {
            $new_array1[$i][$key] = $row;

            $i = $i + 1;
        }

        if (!empty($new_array1)) {
            foreach ($new_array1 as $key1 => $row1) {
                $i = 0;
                foreach ($row1 as $key3 => $row3) {

                    foreach ($new_array1 as $key2 => $row2) {

                        foreach ($row2 as $key4 => $row4) {

                            if ($key1 != $key2) {

                                if ($row3['t_comment'] == $row4['t_comment']) {

                                    if ($i == 0) {

                                        $temp = $new_array1[$key2][$key4];
                                        $new_array1[$key2][$key3] = $new_array1[$key1][$key3];
                                        $new_array1[$key1][$key4] = $temp;

                                        $i = 1;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $i = 0;
        if (!empty($new_array1)) {
            foreach ($new_array1 as $key => $row) {
                $this->sortBySubArrayValue($row, 't_point', 'desc');
                $new_array1[$i] = $row;

                $i = $i + 1;
            }
        }

        $j = 0;
        if (!empty($new_array1)) {
            foreach ($new_array1 as $key => $row) {
                if (!empty($new_array1[$key])) {
                    $this->sortBySubArrayValue($new_array1[$key], 't_point', 'desc');

                    foreach ($row as $key1 => $row1) {

                        if (isset($new_array1[$key + 1])) {
                            if (array_key_exists($key1, $new_array1[$key + 1])) {

                                if (count(@$new_array1[$key]) == count(@$new_array1[$key + 1])) {
                                    unset($new_array1[$key + 1]);
                                } else if (count(@$new_array1[$key]) > count(@$new_array1[$key + 1])) {
                                    $new_array1[$key] = $this->merge($new_array1[$key], $new_array1[$key + 1]);
                                    unset($new_array1[$key + 1]);
                                    $this->sortBySubArrayValue($new_array1[$key], 't_point', 'desc');
                                } else {
                                    $new_array1[$key + 1] = $this->merge(@$new_array1[$key], @$new_array1[$key + 1]);
                                    unset($new_array1[$key]);
                                    $this->sortBySubArrayValue($new_array1[$key + 1], 't_point', 'desc');
                                }
                            }
                        }
                    }
                } else {
                    unset($new_array1[$key]);
                }
            }
        }
        if (!empty($new_array1)) {
            foreach ($new_array1 as $key => $row) {
                if (!empty($row)) {
                    foreach ($row as $key1 => $row1) {
                        if (!is_numeric($key1)) {
                            unset($new_array1[$key]);
                        }
                    }
                } else {
                    unset($new_array1[$key]);
                }
            }
        }
        $new_array2 = array();
        if (!empty($new_array1)) {
            foreach ($new_array1 as $key => $row) {
                foreach ($row as $key1 => $row1) {
                    $new_array2[$key1] = $row1;
                }
            }
        }
        $sorted = array();

        foreach ($new_array2 as $key => $row) {

            if (isset($return_array[$key]) && !empty($return_array[$key])) {
                $sorted[$key] = @$return_array[$key];
            }
        }

        $sorted["total"] = count($data['return_array']);


        $data['comments'] = $sorted;

        echo $this->load->view('commets', $data, true);
    }

    function merge($arr1, $arr2) {
        if (!is_array($arr1))
            $arr1 = array();
        if (!is_array($arr2))
            $arr2 = array();
        $keys1 = array_keys($arr1);
        $keys2 = array_keys($arr2);
        $keys = array_merge($keys1, $keys2);
        $vals1 = array_values($arr1);
        $vals2 = array_values($arr2);
        $vals = array_merge($vals1, $vals2);
        $ret = array();

        foreach ($keys as $key) {
            list($unused, $val) = each($vals);
            $ret[$key] = $val;
        }

        return $ret;
    }

    function sortBySubArrayValue(&$array, $key, $dir = 'asc') {

        $sorter = array();
        $rebuilt = array();

//make sure we start at the beginning of $array
        reset($array);

//loop through the $array and store the $key's value
        foreach ($array as $ii => $value) {

            $sorter[$ii] = $value[$key];
        }

//sort the built array of key values
        if ($dir == 'asc')
            asort($sorter);
        if ($dir == 'desc')
            arsort($sorter);

//build the returning array and add the other values associated with the key
        foreach ($sorter as $ii => $value) {
            $rebuilt[$ii] = $array[$ii];
        }

//assign the rebuilt array to $array
        $array = $rebuilt;
    }

    function getCommentFData() {
        $id = $this->input->post('cmtDATAid');
        $cmtdata = $data_side = $this->hm->getLegaueCmtfData($id);

        $data['return_array'] = array();
        foreach ($cmtdata as $cmt) {

            if ($cmt->parent_id == 0 && !isset($return_array[$cmt->comment_id])) {
                $return_array[$cmt->comment_id] = array();
                $return_array[$cmt->comment_id]['main_comment'] = $cmt;
                $return_array[$cmt->comment_id]['main_comment']->total_like = $this->hm->getCommentLikes($cmt->comment_id);
                $return_array[$cmt->comment_id]['main_comment']->total_dislike = $this->hm->getCommentDislikes($cmt->comment_id);
            } else if ($cmt->parent_id != 0) {
                $cmt->total_like = $this->hm->getCommentLikes($cmt->comment_id);
                $cmt->total_dislike = $this->hm->getCommentDislikes($cmt->comment_id);
                $return_array[$cmt->parent_id][] = $cmt;
            }
        }


        if (!empty($return_array)) {
            foreach ($return_array as $key => $row) {

                if (isset($row['main_comment'])) {
                    $return_array[$key]['main_comment']->t_comment = count($row);

                    $return_array[$key]['main_comment']->t_point = ((int) $return_array[$key]['main_comment']->total_like) - ((int) $return_array[$key]['main_comment']->total_dislike);

                    $new_array[$key]['t_point'] = $row['main_comment']->t_point;
                    $new_array[$key]['t_comment'] = $row['main_comment']->t_comment;
                }
            }
        }
        $new_array = array();
        if (!empty($return_array)) {
            foreach ($return_array as $key => $row) {

                if (isset($row['main_comment'])) {
                    if ($row['main_comment']->total_like == 0 && $row['main_comment']->total_dislike == 0) {
                        $new_array[$key] = (array) $row['main_comment'];
                    }
                }
            }
        }
        $this->sortBySubArrayValue($new_array, 't_comment');

        $sorted = array();

        foreach ($new_array as $key => $row) {
            $sorted[$key] = $return_array[$key];
        }


        $sorted["total"] = count($data['return_array']);

        $data['comments'] = $sorted;
        echo $this->load->view('commets', $data, true);
    }

    public function upload() {

        if (!empty($_FILES)) {


            $image_name = $_FILES['file']['name']; //file name
            $image_size = $_FILES['file']['size']; //file size
            $image_temp = $_FILES['file']['tmp_name'];
            if (empty($image_temp)) {
                $data = array('result' => 'error', 'msg' => 'Unkown Error found');
                echo json_encode($data);
                die;
            }
            $_FILES['new_league_img']['name'] = $_FILES['file']['name'];
            $_FILES['new_league_img']['type'] = $_FILES['file']['type'];
            $_FILES['new_league_img']['tmp_name'] = $_FILES['file']['tmp_name'];
            $_FILES['new_league_img']['error'] = $_FILES['file']['error'];
            $_FILES['new_league_img']['size'] = $_FILES['file']['size'];

            $ext = pathinfo($image_name, PATHINFO_EXTENSION);
            if ($ext == "gif") {
                $config['upload_path'] = "./uploads/dump";
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $filename = rand(0, 9999999999);
                $videoname = $filename . '.webm';
                $config['file_name'] = $filename;
// $config['max_size'] = '10240';
//exec("/usr/bin/ffmpeg -i " . $image_temp . " -c:v libvpx -crf 12 -b:v 500K " . getcwd() . "\uploads\league\mp4\\" . $videoname);
//exec("avconv -i $image_temp -c:v libvpx -crf 12 -b:v 500K $videoname");
                $this->load->library('upload', $config);


                if (!$this->upload->do_upload('new_league_img')) {
                    echo $this->upload->display_errors();
                } else {
                    $imgArr = $filename . '.' . $ext;
                    $newimageuploadpath = "uploads/league/mp4/";
                    $oldimageuploadpath = "uploads/dump/";
                    $imagetemppath1 = "uploads/league/temp/";
// $imagetemppath2 = "uploads/league/test/";

                    shell_exec('convert -verbose -coalesce "' . $oldimageuploadpath . $imgArr . '" -quality 100 "' . $imagetemppath1 . $filename . '%d.png"');
                }
                shell_exec('avconv -f image2 -i "' . $imagetemppath1 . $filename . '%d.png" "' . $newimageuploadpath . $videoname . '"');
            } else {

//start  image resize
                $videoname = '';
                $image_size_info = getimagesize($image_temp); //get image size
//                                print_r($image_size_info);
//                                exit;

                if ($image_size_info) {
                    $image_width = $image_size_info[0]; //image width
                    $image_height = $image_size_info[1]; //image height
                    $image_type = $image_size_info['mime']; //image type
                } else {

                    $data = array('result' => 'error', 'msg' => 'Make sure image file is valid!');
                    echo json_encode($data);
                    die;
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
                    case 'image/jpeg':
                    case 'image/pjpeg':
                    case 'image/jpg':
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

//folder path to save resized images and thumbnails
                    $image_save_folder = $this->destination_folder_dump . $new_file_name;
// $image_width = $image_width / 2;
// $image_height = $image_height / 2;
//call normal_resize_image() function to proportionally resize image
                    if ($this->normal_resize_image($image_res, $image_save_folder, $image_type, $this->max_image_size_upload, $image_width, $image_height, 100)) {
                        $imgArr = $new_file_name;
                    }

                    imagedestroy($image_res); //freeup memory
                }
            }
            $this->session->set_userdata('image_name', $imgArr);
            $data = array('result' => 'success', 'name' => $imgArr, 'videoname' => $videoname);

            echo json_encode($data);
            die;
        }
        $data = array('result' => 'error', 'msg' => 'Image is not uploded successfully.Please retry...');

        echo json_encode($data);
        die;
    }

    public function discussupload() {

        if (!empty($_FILES)) {


            $_FILES['new_league_img']['name'] = $_FILES['file']['name'];
            $_FILES['new_league_img']['type'] = $_FILES['file']['type'];
            $_FILES['new_league_img']['tmp_name'] = $_FILES['file']['tmp_name'];
            $_FILES['new_league_img']['error'] = $_FILES['file']['error'];
            $_FILES['new_league_img']['size'] = $_FILES['file']['size'];

            $config['upload_path'] = "./uploads/discussion";
            $config['allowed_types'] = 'doc|docx|rtf|text|txt';
            $filename = rand(0, 9999999999);
            $config['file_name'] = $filename;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('new_league_img')) {
                $msg = $this->upload->display_errors();
                $data = array('result' => 'error', 'msg' => $msg);
                echo json_encode($data);
                die;
            } else {
                $data = array('upload_data' => $this->upload->data());
                $zfile = $data['upload_data']['full_path']; // get file path
                chmod($zfile, 0777); // CHMOD file
                $discussion_file = $data['upload_data']['orig_name'];
                $data = array('result' => 'success', 'discussion' => $discussion_file);
                echo json_encode($data);
                die;
            }
        }
    }

    public function discussion_next_upload() {
        $title = $this->input->post('discussion_title');
        $description = $this->input->post('discussion_desc');
        $creditcheck_disc = $this->input->post('creditcheck_disc');
        $disc_credit = $this->input->post('disc_credit');
        $disc_author = $this->input->post('disc_author');
        $desc_count = $this->input->post('desc_count');
        $category = $this->input->post('category');
        $title_count = $this->input->post('title_count');

        if (isset($title) && empty($title)) {
            $data = array('result' => 'error', 'msg' => 'Please describe title');
            echo json_encode($data);
            die;
        }

        if (isset($description) && empty($description)) {
            $data = array('result' => 'error', 'msg' => 'Please describe Description');
            echo json_encode($data);
            die;
        }
        if ($desc_count == "250") {
            $data = array('result' => 'error', 'msg' => 'Please describe Description');
            echo json_encode($data);
            die;
        }
        if ($desc_count < "0") {
            $data = array('result' => 'error', 'msg' => 'Description not allowed more than 250 character');
            echo json_encode($data);
            die;
        }
        if ($title_count < "0") {
            $data = array('result' => 'error', 'msg' => 'Title not allowed more than 150 character');
            echo json_encode($data);
            die;
        }
        if ($creditcheck_disc == "true") {

            if (empty($disc_credit)) {
                $data = array('result' => 'error', 'msg' => 'Please describe Name of Creditor');
                echo json_encode($data);
                die;
            }
            if (empty($disc_author)) {
                $data = array('result' => 'error', 'msg' => 'Please author name ');
                echo json_encode($data);
                die;
            }
        }
        if (isset($category) && empty($category)) {
            $data = array('result' => 'error', 'msg' => 'Please select category');
            echo json_encode($data);
            die;
        }
        $data = array('result' => 'success');
        echo json_encode($data);
        die;
    }

    public function upload_image_next() {
        if ($this->input->post()) {

            $title = $this->input->post('title');
            $not_safe = $this->input->post('not_safe');
            $credit_author = $this->input->post('credit_author');
            $author = $this->input->post('author');
            $credit = $this->input->post('credit');
            $tag = $this->input->post('tag');
            $word = $this->input->post('wordd');

            $image_data['image_data']['image_name'] = $this->session->userdata('image_name');

            $image_name = $this->session->userdata('image_name');
            $category = $this->input->post('category');

            if (isset($title) && empty($title)) {
                $data = array('result' => 'error', 'msg' => 'Please describe title');
                echo json_encode($data);
                die;
            }
            if (isset($word) && $word < 0) {
                $data = array('result' => 'error', 'msg' => 'Maximum allow 150 character');
                echo json_encode($data);
                die;
            }

            if (isset($credit_author) && !empty($credit_author)) {
                $image_data['image_data']['credit_author'] = $credit_author;

                if ($credit_author == 1) {

                    if (isset($credit) && empty($credit)) {
                        $data = array('result' => 'error', 'msg' => 'Please describe author name');
                        echo json_encode($data);
                        die;
                    }
                    if (isset($author) && empty($author)) {
                        $data = array('result' => 'error', 'msg' => 'Please describe credit name');
                        echo json_encode($data);
                        die;
                    }
                }
            }

            if (isset($category) && empty($category)) {
                $data = array('result' => 'error', 'msg' => 'Please select  any one category');
                echo json_encode($data);
                die;
            }

            $data = array('result' => 'success', 'image_name' => $image_name, 'title' => $title, 'not_safe' => $not_safe, 'credit_author' => $credit_author, 'tag' => $tag, 'author' => $author, 'credit' => $credit);
            echo json_encode($data);
            die;
        } else {
            $data = array('result' => 'fail');
            echo json_encode($data);
            die;
        }
    }

    public function last_save_discussion() {
        if ($this->input->post()) {
            $title = $this->input->post('title');
            $category = $this->input->post('category');
            $discussion_file = $this->input->post('discussion_file');
            $spoiler = $this->input->post('spoiler');
            $description = $this->input->post('description');
            $header_type = $this->input->post('header_type');

            $creditor_site = $this->input->post('disc_creditor_site');
            $creditor_author = $this->input->post('disc_creditor_author');



            $category_id = $this->leaguemod->get_subTab_id($category);

            if (empty($category_id)) {
                $category_id = 0;
            }

            $category_id = $category_id[0]['category_id'];

            $dataArr = array(
                'title' => $title,
                'category_id' => $category_id,
                'description' => $description,
                'animediscussion_popular' => 'N',
                'discussion_userid' => $this->session->userdata('user_id'),
                'discussion_file' => $discussion_file,
                'spoiler' => $spoiler,
                'creditor_author' => $creditor_author,
                'creditor_site' => $creditor_site,
                'header_type' => $header_type
            );

            $result = $this->animemod->add_anime_discussion($dataArr);



            $data = array('result' => 'success');
            echo json_encode($data);
            die;
        } else {
            $data = array('result' => 'error', 'msg' => 'Not successfully save!');
            echo json_encode($data);
            die;
        }
    }

    public function save_upload_image() {



        $category = $this->input->post('category');

        if (isset($category) && empty($category)) {
            $data = array('result' => 'error', 'msg' => 'Please select  any one category');
            echo json_encode($data);
            die;
        } else {
            $data = array('result' => 'success');
            echo json_encode($data);
            die;
        }
    }

    function get_image_upload_category() {
        $data['subTabData'] = $this->hm->get_sub_tabs();
        $type = $this->input->post('type');
        $total = count($data['subTabData']);
        $html = '';
        for ($i = 0; $i < $total; $i++) {

            $html .= ' <li id="' . $data["subTabData"][$i]["category_name"] . '">
        <div class = "img-filter">
        <img src="' . base_url() . 'uploads/category/' . $data["subTabData"][$i]["category_logo"] . '"  alt="">
        </div>
        <div class = "sec-description">
        <span>' . $data["subTabData"][$i]["category_name"] . '</span>
        <p>e.g lol, joke, prank, fail</p>
        </div>
        <div class = "radio radio-category">
        <input class = "pic_category" id = "' . $data["subTabData"][$i]["category_name"] . $type . '1" type = "radio" name = "AccountType" value="' . $data["subTabData"][$i]["category_name"] . '">
        <label for = "' . $data["subTabData"][$i]["category_name"] . $type . '1" style = "margin-right:0px;"></label>
        </div>
        </li>';
        }

        echo $html;
    }

    function get_image_upload_animecategory() {
        $data['subTabData'] = $this->hm->get_anime_list();
//        echo '<PRe>';
//        print_r($data);
//        exit;
        $total = count($data['subTabData']);
        $html = '';
        for ($i = 0; $i < $total; $i++) {

            $html .= '<li  id="' . $data["subTabData"][$i]["anime_jpg"] . '">
                                            <div class="img-filter">
                                                <img src="' . base_url() . 'uploads/anime/' . $data["subTabData"][$i]["anime_jpg"] . '" style="width:50px;height:50px" alt="">
                                            </div>
                                            <div class="sec-description">
                                                <span>' . $data["subTabData"][$i]["anime_name"] . '</span>
                                            </div>
                                            <div class="wrap-filter-post anime-check" style="border-top:none">
                                                <input class= "anime_category" type="checkbox" name="anime_category[]" id = "' . $data["subTabData"][$i]["anime_name"] . '1"  value="' . $data["subTabData"][$i]["anime_id"] . '" style="display: none;"/>
                                                <label for="' . $data["subTabData"][$i]["anime_name"] . '1">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square-o fa-stack-1x"></i>
                                                        <i class="fa fa-check fa-stack-1x"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </li>';
        }

        echo $html;
    }

    function search_anime_list() {
        $search = $this->input->post('id');

        $data['subTabData'] = $this->hm->get_searchanime_list($search);
//        echo '<PRe>';
//        print_r($data);
//        exit;
        $total = count($data['subTabData']);
        $html = '';
        for ($i = 0; $i < $total; $i++) {

            $html .= '<li  id="' . $data["subTabData"][$i]["anime_jpg"] . '">
                                            <div class="img-filter">
                                                <img src="' . base_url() . 'uploads/anime/' . $data["subTabData"][$i]["anime_jpg"] . '" style="width:50px;height:50px" alt="">
                                            </div>
                                            <div class="sec-description">
                                                <span>' . $data["subTabData"][$i]["anime_name"] . '</span>
                                            </div>
                                            <div class="wrap-filter-post anime-check" style="border-top:none">
                                                <input class= "anime_category" type="checkbox" name="anime_category[]" id = "' . $data["subTabData"][$i]["anime_name"] . '1"  value="' . $data["subTabData"][$i]["anime_id"] . '" style="display: none;"/>
                                                <label for="' . $data["subTabData"][$i]["anime_name"] . '1">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square-o fa-stack-1x"></i>
                                                        <i class="fa fa-check fa-stack-1x"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </li>';
        }

        echo $html;
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
            case 'image/jpeg':
            case 'image/pjpeg':
                imagejpeg($source, $destination, $quality);
                return true; //save jpeg file
                break;
            default:
                return false;
        }
    }

    function like() {
        $user_id = $this->input->post('user_id');
        $comment_id = $this->input->post('comment_id');

        $check = $this->hm->check_like($user_id, $comment_id);

        if (empty($check)) {
            $data = array(
                'user_id' => $user_id,
                'comment_id' => $comment_id,
                'like' => 1
            );
            $query = $this->hm->like($data);

            if ($query) {

                $result = array(
                    'like' => $this->hm->getCommentLikes($comment_id),
                    'dislike' => $this->hm->getCommentDislikes($comment_id),
                    'icon' => '<i class="fa fa-arrow-up fa-lg victory_active"></i>'
                );
                echo json_encode($result);
            } else {
                echo 'false';
            }
        } elseif ($check[0]->like == 1) {
            $query = $this->hm->delete_like($user_id, $comment_id);

            if ($query) {
                $result = array(
                    'like' => $this->hm->getCommentLikes($comment_id),
                    'dislike' => $this->hm->getCommentDislikes($comment_id),
                    'icon' => '<i class="fa fa-arrow-up fa-lg "></i>'
                );
                echo json_encode($result);
            } else {
                echo 'false';
            }
        } else {
            $data = array(
                'like' => 1
            );
            $query = $this->hm->update_like($user_id, $comment_id, $data);
            if ($query) {
                $result = array(
                    'like' => $this->hm->getCommentLikes($comment_id),
                    'dislike' => $this->hm->getCommentDislikes($comment_id),
                    'icon' => '<i class="fa fa-arrow-up fa-lg victory_active"></i>'
                );
                echo json_encode($result);
            } else {
                echo 'false';
            }
        }
    }

    function dislike() {
        $user_id = $this->input->post('user_id');
        $comment_id = $this->input->post('comment_id');
        $check = $this->hm->check_like($user_id, $comment_id);

        if (empty($check)) {
            $data = array(
                'user_id' => $user_id,
                'comment_id' => $comment_id,
                'like' => 0
            );
            $query = $this->hm->like($data);
            if ($query) {
                $result = array(
                    'like' => $this->hm->getCommentLikes($comment_id),
                    'dislike' => $this->hm->getCommentDislikes($comment_id),
                    'icon' => '<i class="fa fa-arrow-down fa-lg defeat_active"></i>'
                );
                echo json_encode($result);
            } else {
                echo 'false';
            }
        } elseif ($check[0]->like == 0) {

            $query = $this->hm->delete_like($user_id, $comment_id);
            if ($query) {
                $result = array(
                    'like' => $this->hm->getCommentLikes($comment_id),
                    'dislike' => $this->hm->getCommentDislikes($comment_id),
                    'icon' => '<i class="fa fa-arrow-down fa-lg "></i>'
                );
                echo json_encode($result);
            } else {
                echo 'false';
            }
        } else {

            $data = array(
                'like' => 0
            );
            $query = $this->hm->update_like($user_id, $comment_id, $data);
            if ($query) {
                $result = array(
                    'like' => $this->hm->getCommentLikes($comment_id),
                    'dislike' => $this->hm->getCommentDislikes($comment_id),
                    'icon' => '<i class="fa fa-arrow-down fa-lg defeat_active"></i>'
                );
                echo json_encode($result);
            } else {
                echo 'false';
            }
        }
    }

    function likedislike() {

        $status = $this->input->post('status');
        $user_id = $this->input->post('user_id');
        $comment_id = $this->input->post('comment_id');
        $check = $this->hm->check_like($user_id, $comment_id);

        if ($status == "dislike") {


            if (empty($check)) {
                $data = array(
                    'user_id' => $user_id,
                    'comment_id' => $comment_id,
                    'like' => 0
                );
                $query = $this->hm->like($data);
                if ($query) {
                    $result = array(
                        'like' => $this->hm->getCommentLikes($comment_id),
                        'dislike' => $this->hm->getCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/down-reply-hover.png" onmouseover="this.src =' . base_url() . 'assets/public/img/down-reply-hover.png">'
                    );
                }
            } elseif ($check[0]->like == 0) {

                $query = $this->hm->delete_like($user_id, $comment_id);
                if ($query) {
                    $result = array(
                        'like' => $this->hm->getCommentLikes($comment_id),
                        'dislike' => $this->hm->getCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/down-reply.png" onmouseover="this.src =' . base_url() . 'assets/public/img/down-reply-hover.png">'
                    );
                }
            } else {

                $data = array(
                    'like' => 0
                );
                $query = $this->hm->update_like($user_id, $comment_id, $data);
                if ($query) {
                    $result = array(
                        'like' => $this->hm->getCommentLikes($comment_id),
                        'dislike' => $this->hm->getCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/down-reply-hover.png" onmouseover="this.src =' . base_url() . 'assets/public/img/down-reply-hover.png">'
                    );
                }
            }
        }


        if ($status == "like") {

            if (empty($check)) {
                $data = array(
                    'user_id' => $user_id,
                    'comment_id' => $comment_id,
                    'like' => 1
                );
                $query = $this->hm->like($data);

                if ($query) {

                    $result = array(
                        'like' => $this->hm->getCommentLikes($comment_id),
                        'dislike' => $this->hm->getCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/up-reply-hover.png" onmouseover="this.src =' . base_url() . 'assets/public/img/up-reply-hover.png">'
                    );
                }
            } elseif ($check[0]->like == 1) {
                $query = $this->hm->delete_like($user_id, $comment_id);

                if ($query) {
                    $result = array(
                        'like' => $this->hm->getCommentLikes($comment_id),
                        'dislike' => $this->hm->getCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/up-reply.png" onmouseover="this.src =' . base_url() . 'assets/public/img/up-reply-hover.png ">'
                    );
                }
            } else {
                $data = array(
                    'like' => 1
                );
                $query = $this->hm->update_like($user_id, $comment_id, $data);
                if ($query) {
                    $result = array(
                        'like' => $this->hm->getCommentLikes($comment_id),
                        'dislike' => $this->hm->getCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/up-reply-hover.png" onmouseover="this.src =' . base_url() . 'assets/public/img/up-reply-hover.png">'
                    );
                }
            }
        }

        $total = ((int) $result['like']) - ((int) $result['dislike']);

        $result['total'] = $total;

        echo json_encode($result);
        die;
    }

    function file_download() {
        $url = $this->input->post('url');
        preg_match('(.jpg|.png|.gif|.bmp|.jpeg)', $url, $matches);

        if (!empty($matches[0])) {
            $rand_name = uniqid() . $matches[0];
            $url = mysql_real_escape_string($url);
            @$rawimage = file_get_contents($url);
            if ($rawimage) {
                file_put_contents("uploads/league/" . $rand_name, $rawimage);

                $data = array('result' => 'success', 'msg' => 'Click on Next Button Below', 'name' => $rand_name);
                echo json_encode($data);
                die;
            } else {
                $data = array('result' => 'error', 'msg' => 'Can not Download image from link');
                echo json_encode($data);
                die;
            }
        } else {

            @$rawimage = file_get_contents($url);

            preg_match_all(
                    '/<meta property="og:image" content="(.*?)"> /s', $rawimage, $posts, // will contain the article data
                    PREG_SET_ORDER // formats data into an array of posts
            );
            preg_match_all(
                    '/<meta property="og:title" content="(.*?)"> /s', $rawimage, $titles, // will contain the article data
                    PREG_SET_ORDER // formats data into an array of posts
            );

            $img_url = '';
            foreach ($posts as $post) {
                $img_url = $post[1];
            }
            foreach ($titles as $title) {
                $title_name = $title[1];
            }

            if (isset($img_url) && !empty($img_url)) {
                $tit = explode("\"", $title[1]);
                $img = explode("\"", $post[1]);
                preg_match('(.jpg|.png|.gif|.bmp|.jpeg)', $post[1], $matches);
                $rand_name = uniqid() . $matches[0];
                if (!empty($img[0])) {
                    @$rawimage = file_get_contents($img[0]);
                    if ($rawimage) {
                        file_put_contents("uploads/league/" . $rand_name, $rawimage);

                        $data = array('result' => 'success', 'msg' => 'Click on Next Button Below', 'name' => $rand_name, 'title' => $tit[0]);
                        echo json_encode($data);
                        die;
                    } else {
                        $data = array('result' => 'error', 'msg' => 'Can not Download image from link');
                        echo json_encode($data);
                        die;
                    }
                } else {
                    $data = array('result' => 'error', 'msg' => 'Not valid image url');
                    echo json_encode($data);
                    die;
                }
            } else {
                $data = array('result' => 'error', 'msg' => 'Not valid image url');
                echo json_encode($data);
                die;
            }
        }
    }

    public function save_url_image() {


        $category = $this->input->post('category');
        if (isset($category) && empty($category)) {
            $data = array('result' => 'error', 'msg' => 'Please select  any one category');
            echo json_encode($data);
            die;
        } else {
            $data = array('result' => 'success', 'msg' => 'click on next ');
            echo json_encode($data);
//            die;
        }
    }

    public function file_upload() {
        $files = $_FILES;
        if (!empty($files)) {
            $cpt = count($_FILES['userfile']['name']);
            $data = array('result' => 'error');
            if ($cpt > 0) {
                for ($i = 0; $i < $cpt; $i++) {
                    preg_match('(.jpg|.png|.gif|.bmp|.jpeg)', $files['userfile']['name'][$i], $matches);
                    foreach ($matches as $value) {
                        $val = $value;
                    }
                    if (empty($val)) {
                        $data = array('result' => 'error', 'msg' => 'Make sure file is valid');
                        echo json_encode($data);
                        die;
                    } else {


                        $_FILES['userfile']['name'] = uniqid() . $matches[0];
                        $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                        $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                        $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                        $_FILES['userfile']['size'] = $files['userfile']['size'][$i];
                        $this->upload->initialize($this->set_upload_options());
                        $this->upload->do_upload();
                    }
                    $fileName = $_FILES['userfile']['name'];
                    $images[] = urlencode($fileName);
                }
                $fileName = implode(',', $images);
                $data = array('result' => 'success', 'firstname' => $fileName);
            } else {
                $data = array('result' => 'error', 'msg' => "Unkwon Error");
            }
        } else {
            $data = array('result' => 'error', 'msg' => 'Image is not uploded successfully.Please retry...');
        }
        echo json_encode($data);
        die;
    }

    private function set_upload_options() {
// upload an image options
        $config = array();
        $config['upload_path'] = './uploads/league'; //give the path to upload the image in folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
    }

    public function add_albumdata() {

        $credit_author = $this->input->post('credit_author');
        $spolier = $this->input->post('spolier');
        $spolier_val = $this->input->post('spolier_val');
        $main_title = $this->input->post('main_title');
        $author = $this->input->post('author');
        $credit = $this->input->post('credit');
        $notsafe = $this->input->post('notsafe');
        $category = $this->input->post('category');
        $word = $this->input->post('word');
        if (isset($main_title) && empty($main_title)) {
            $data = array('result' => 'error', 'msg' => 'Please describe Album title');
            echo json_encode($data);
            die;
        }
        if (isset($word) && $word < 0) {
            $data = array('result' => 'error', 'msg' => 'Allow maximum 150 character');
            echo json_encode($data);
            die;
        }
        if ($credit_author == 1) {
            if (isset($author) && empty($author)) {
                $data = array('result' => 'error', 'msg' => 'Please describe author name');
                echo json_encode($data);
                die;
            }
        }
        if ($spolier == 1) {
            if (isset($spolier_val) && empty($spolier_val)) {
                $data = array('result' => 'error', 'msg' => 'Please Select Spolier Tag');
                echo json_encode($data);
                die;
            }
        }
        if ($credit_author == 1) {
            if (isset($credit) && empty($credit)) {
                $data = array('result' => 'error', 'msg' => 'Please describe credit');
                echo json_encode($data);
                die;
            }
        }

        if (isset($category) && empty($category)) {
            $data = array('result' => 'error', 'msg' => 'Please select  any one category');
            echo json_encode($data);
            die;
        }
        $data = array('result' => 'success');
        echo json_encode($data);
        die;
    }

    public function last_save_album_image() {
        $test = $this->input->post('data');

        $dev = explode("&", $test);

        $video_name = $this->input->post('video_name');
        $category = $this->input->post('category');
//        $tag = $this->input->post('tag');
        $main_title = $this->input->post('main_title');
        $author = $this->input->post('author');
        $credit = $this->input->post('credit');
        $credit_author = $this->input->post('credit_author');
        $spolier_val = $this->input->post('spolier_val');
        $notsafe = $this->input->post('notsafe');

        $category_id = $this->leaguemod->get_subTab_id($category);

        if (empty($category_id)) {
            $category_id = 0;
        }

        $category_id = $category_id[0]['category_id'];

        $hi = array();

        $i = 0;
        $valu = '';
        $total = count($dev);


        foreach ($dev as $k => $value) {
            $m = $k + 1;
            if ($m % 4 == 0) {
                $valu .= "**" . $value;
                array_push($hi, $valu);
                $i++;
                $valu = '';
            } else {
                $valu .= "**" . $value;
            }
        }


        $sds = count($hi);
        $parent_id = 0;
        for ($i = 0; $i < $sds; $i++) {
            $test = explode("**", $hi[$i]);


            for ($j = 1; $j <= 4; $j++) {
                $n = str_replace("+", " ", explode("=", $test[$j]));


                if ($j == 1) {
                    $league_name = str_replace("%252B", "+", $n[1]);
                } else if ($j == 2) {
                    $title = $n[1];
                } else if ($j == 3) {
                    $tag = trim($n[1], " ");
                } else if ($j == 4) {
                    $description = urldecode($n[1]);
                }
            }
            preg_match('(.jpg|.png|.gif|.bmp|.jpeg)', $league_name, $matches);

            foreach ($matches as $value) {
                $val = $value;
            }
            if (empty($val)) {
                $data = array('result' => 'error', 'msg' => 'Please Upload image');
                echo json_encode($data);
                die;
            }

            if ($i === 0) {
                $dataArray = array(
                    'category_id' => $category_id,
                    'leagueimage_userid' => $this->session->userdata('user_id'),
                    'leagueimage_status' => 'A',
                    'leagueimage_setpopular' => 'N',
                    'leagueimage_filename' => $league_name,
                    'league_img_access' => 1,
                    'leagueimage_name' => $title,
                    'leagueimage_maintitle' => $main_title,
                    'leagueimage_description' => $description,
                    'image_spoiler' => $spolier_val,
                    'image_nsfw' => $notsafe,
//                    'parent_id' => $parent_id,
//                    'videoname' => $video_name,
                );
//                print_r($dataArray);
//                exit;
                $result = $this->leaguemod->add_league_img($dataArray);

                $i = 0;
                if (isset($result)) {
                    $dataArray = array(
                        'leagueimage_id' => $result,
                        'user_id' => $this->session->userdata('user_id'),
                        'tag' => $tag,
                    );
                    $this->leaguemod->add_league_imgtags($dataArray);
                }
                if ($credit_author == 1) {

                    $creditArray = array(
                        'leagueimage_id' => $result,
                        'user_id' => '0',
                        'credit_status' => 'A',
                        'author' => $author,
                        'credit' => $credit,
                    );

                    $this->leaguemod->add_league_credits($creditArray);
                }

                $allpag = $this->leaguemod->select_league($result);
                $per_page = $allpag[0];
                $parent_id = $per_page['leagueimage_id'];
            } else {
                $dataArray = array(
                    'category_id' => $category_id,
                    'leagueimage_userid' => $this->session->userdata('user_id'),
                    'leagueimage_status' => 'A',
                    'leagueimage_setpopular' => 'N',
                    'leagueimage_filename' => $league_name,
                    'league_img_access' => 1,
                    'leagueimage_name' => $title,
                    'leagueimage_description' => $description,
//                    'videoname' => $video_name,
                    'parent_id' => $parent_id,
                    'image_spoiler' => $spolier_val,
                );
//                print_r($dataArray);
//                exit;
                $result = $this->leaguemod->add_league_img($dataArray);
                if (isset($result)) {
                    $dataArray = array(
                        'leagueimage_id' => $result,
                        'user_id' => $this->session->userdata('user_id'),
                        'tag' => $tag,
                    );
                    $this->leaguemod->add_league_imgtags($dataArray);
                }
            }
        }
        $data = array('result' => 'success');
        echo json_encode($data);
        die;
    }

    public function last_anime_save() {
        if ($this->input->post()) {
            $question = $this->input->post('question');
            $category = $this->input->post('category');
            $answers = $this->input->post('answers');
            $answer = implode(',', $answers);
            $discription = $this->input->post('discription');
            $title = $this->input->post('title');
            $credit = $this->input->post('credit');
            $author = $this->input->post('author');
            $spoiler = $this->input->post('spoiler');

            $category_id = $this->leaguemod->get_subTab_id($category);

            if (empty($category_id)) {
                $category_id = 0;
            }

            $category_id = $category_id[0]['category_id'];

            $dataArr = array(
                'questions' => $question,
                'discription' => $discription,
                'category_id' => $category_id,
                'title' => $title,
                'answers' => $answer,
                'league_userid' => $this->session->userdata('user_id'),
                'credit' => $credit,
                'author' => $author,
                'spoiler' => $spoiler,
                'created_date' => date('Y-m-d H:i:s'),
                'modified_date' => '',
            );
            // print_r($dataArr);die;
            $result = $this->leaguemod->save_poll_data($dataArr);


            $data = array('result' => 'success');
            echo json_encode($data);
            die;
        } else {
            $data = array('result' => 'error', 'msg' => 'Not successfully save!');
            echo json_encode($data);
            die;
        }
    }

    public function poll_next_upload() {

        $answers = $this->input->post('answers');
        $category = $this->input->post('category');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('question', 'Question', 'required');
        $this->form_validation->set_rules('option', 'Answer', 'required');
        $this->form_validation->set_rules('discription', 'discription', 'required');
        if (isset($_POST['creditChk']) AND ! empty($_POST['creditChk']) AND $_POST['creditChk'] != "false") {
            $this->form_validation->set_rules('credit', 'Credit', 'required');
            $this->form_validation->set_rules('author', 'Author', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = form_error('title');
            $data['question'] = form_error('question');
            $data['discription'] = form_error('discription');
            $data['author'] = form_error('author');
            $data['credit'] = form_error('credit');

            if (isset($answers)) {
                foreach ($answers as $ans) {
                    if (empty($ans)) {
                        $data['option'] = form_error('option');
                    }
                }
            }
            if (empty($category)) {
                $data = array('result' => 'error', 'msg' => 'Please select category');
                echo json_encode($data);
                die;
            }
            if (empty($data['title']) && empty($data['question']) && empty($data['discription']) && empty($data['option'])) {
                $data['success'] = TRUE;
                echo json_encode($data);
                die;
            } else {
                echo json_encode($data);
                die;
            }
        }
    }

    public function last_save_upload_image() {
        if ($this->input->post()) {
            $title = $this->input->post('title');
            $image_spoiler = $this->input->post('spoiler');
            $credit_author = $this->input->post('credit_author');
            $image_name = $this->input->post('image_name');
            $video_name = $this->input->post('video_name');
            $category = $this->input->post('category');
            $tag = $this->input->post('tag');
            $author = $this->input->post('author');
            $credit = $this->input->post('credit');
            $not_safe = $this->input->post('not_safe');




            $category_id = $this->leaguemod->get_subTab_id($category);

            if (empty($category_id)) {
                $category_id = 0;
            }

            $category_id = $category_id[0]['category_id'];

            $dataArr = array(
                'leagueimage_name' => $title,
                'category_id' => $category_id,
                'leagueimage_userid' => $this->session->userdata('user_id'),
                'leagueimage_status' => 'A',
                'leagueimage_setpopular' => 'N',
                'leagueimage_filename' => $image_name,
                'videoname' => $video_name,
                'league_img_access' => 1,
                'image_spoiler' => $image_spoiler,
                'image_spoiler' => $not_safe,
            );

            $result = $this->leaguemod->add_league_img($dataArr);

            if (isset($result)) {
                $dataArray = array(
                    'leagueimage_id' => $result,
                    'user_id' => $this->session->userdata('user_id'),
                    'tag' => $tag,
                );
                $abc = $this->leaguemod->add_league_imgtags($dataArray);
            }

            if ($credit_author == 1) {

                $creditArray = array(
                    'leagueimage_id' => $result,
                    'user_id' => '0',
                    'credit_status' => 'A',
                    'credit' => $credit,
                    'author' => $author,
                );

                $credit = $this->leaguemod->add_league_credits($creditArray);
            }

            shell_exec('mv uploads/dump/' . $image_name . ' uploads/league/');

            $data = array('result' => 'success');
            echo json_encode($data);
            die;
        } else {
            $data = array('result' => 'error', 'msg' => 'Not successfully save!');
            echo json_encode($data);
            die;
        }
    }

    public function anime_report() {
        $anime_report_id = $this->input->post('poll_id');
        $user_id = $this->session->userdata('user_id');
        $report = $this->input->post('AccountType');
        $link = $this->input->post('link');

        if ($user_id == 0) {
            $data['modal'] = true;
            echo json_encode($data);
            die;
        } else {

            $check = $this->leaguemod->check_report($user_id, $anime_report_id);

            if ($check) {
                if (isset($report) && empty($report)) {
                    $data = array('result' => 'error', 'msg' => 'Please Select Report Category');
                    echo json_encode($data);
                    die;
                } else if (isset($link) && empty($link)) {
                    $data = array('result' => 'error', 'msg' => 'Please Select link');
                    echo json_encode($data);
                    die;
                } else {
                    $reportArray = array(
                        'anime_report_id' => $anime_report_id,
                        'link' => $link,
                        'report_id' => $report,
                    );
                    $this->leaguemod->update_report($reportArray, $anime_report_id, $user_id);
                    $data['success'] = TRUE;
                    echo json_encode($data);
                    die;
                }
            } else {

                if (isset($report) && empty($report)) {
                    $data = array('result' => 'error', 'msg' => 'Please Select Report Category');
                    echo json_encode($data);
                    die;
                } else if (isset($link) && empty($link)) {
                    $data = array('result' => 'error', 'msg' => 'Enter Image Link');
                    echo json_encode($data);
                    die;
                } else {
                    $dataArr = array(
                        'league_report_id' => $user_id,
                        'report_id' => $report,
                        'anime_report_id' => $anime_report_id,
                        'link' => $link,
                        'status' => '0',
                        'date' => date('Y-m-d H:i:s'),
                    );
                    $result = $this->leaguemod->add_report_data($dataArr);
                    $data['success'] = TRUE;
                    echo json_encode($data);
                    die;
                }
            }
        }
    }

    public function validate_urltitle_data() {
        $url = $this->input->post('url');
        $url_title = $this->input->post('url_title');
        $url_author_name = $this->input->post('url_author_name');
        $url_credit = $this->input->post('url_credit');
        $url_spolier_val = $this->input->post('url_spolier_val');
        $url_spolier = $this->input->post('url_spolier');
        $credit_author = $this->input->post('credit_author');
        $nsfw = $this->input->post('nsfw');
        $urltag = $this->input->post('urltag');

        if (isset($url_title) && empty($url_title)) {
            $data = array('result' => 'error', 'msg' => 'Please enter title');
            echo json_encode($data);
            die;
        }
        if ($url_spolier == '1') {
            if ($url_spolier_val == '0') {
                $data = array('result' => 'error', 'msg' => 'Please mark spoiler');
                echo json_encode($data);
                die;
            }
        }

        if ($credit_author == '1') {
            if (isset($url_author_name) && empty($url_author_name)) {
                $data = array('result' => 'error', 'msg' => 'Please write author name');
                echo json_encode($data);
                die;
            }
            if (isset($url_credit) && empty($url_credit)) {
                $data = array('result' => 'error', 'msg' => 'Please give credit to author');
                echo json_encode($data);
                die;
            }
        }

        $data = array('result' => 'success');
        echo json_encode($data);
        die;
    }

    function getsubcomment_ajax() {
        $parent_id = $this->input->post('pid');
        //echo "parent_id" .$parent_id;exit;

        $cmtdata = $data_side = $this->hm->getLegaueCmtData_subComment($parent_id);
        // print_r($cmtdata);
        $i = 0;
        foreach ($cmtdata as $cmt) {

            $total_likes = $this->hm->getCommentLikes($cmt->comment_id);
            $total_Dislikes = $this->hm->getCommentDislikes($cmt->comment_id);
            $total_cmtrplpoint = ((int) $total_likes) - ((int) $total_Dislikes);
            $like_dislike[$i]['total_like'] = $total_likes;
            $like_dislike[$i]['total_dislike'] = $total_Dislikes;
            $like_dislike[$i]['total_cmtrplpoint'] = $total_cmtrplpoint;
            $i++;
        }
        //print_r($like_dislike);
        //exit;
        $j = 0;
        $html = "";
        foreach ($cmtdata as $value) {

            $html .= ' <div class="user-comment row chdrepl_' . $parent_id . '" id="childid_' . $value->comment_id . '" >
                            <div class="media info-avatar">
                                <div class="media-left media-comment">
                                    <a href="#">';

            if (!empty($value->user_image) && $value->user_image != "") {
                $html .= ' <img src="' . base_url() . 'uploads/users/' . $value->user_image . '" alt="' . $value->user_image . '" class="media-object avatar img-circle"  >';
            } else {
                $html .= '<img src="' . base_url() . 'assets/public/img/admin.png" alt="Leaguememe" class="media-object avatar img-circle"> ';
            }
            $html .='   </a>
                                </div>

                                <div class="media-body w-100"> ';

            // $total_cmtrplpoint = ((int) $value->total_like) - ((int) $value->total_dislike);


            $html .=' <a href=""><h5 class="user">
                                            <span class="nick us-name getusername__' . $value->comment_id . '">' . $value->user_name . '</span>
                                        </h5></a>
                                    <div class="date"><span class="points" id="countLike_' . $value->comment_id . '">' . $like_dislike[$j]['total_cmtrplpoint'] . '</span> Point - <a href=""> 
                                            <span class="points" data-livestamp="' . strtotime($value->comment_date) . '"> </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <p class="dis-cap comment-field-user">';
            $html .= $value->comment . ' 
                            </p>';

            $html .= ' <div class="reply-comment">
                                <div class="' . $value->comment_id . '" >
                                    <ul class="list-inline" id="' . $parent_id . '" >';

            $user_id = $this->session->userdata('user_id');
            if ($user_id) {

                $html .= '<li class="childsubcmtrpl" id="childsubcmtrpl_' . $parent_id . '"><a style="cursor: pointer;"  href="javascript:void(0);"><span>Reply</span></a></li>';
            } else {

                $html .='<li><a  style="cursor: pointer;" href="javascript:void(0);" id="login" style="cursor: pointer" data-toggle="modal" data-target="#login"><span>Reply</span></a></li>';
            }

            //$user_id = $this->session->userdata('user_id');
            if ($user_id) {

                $html .='<li><a class="hvr-bounce-in" style="cursor: pointer;" id="like_' . $value->comment_id . '" onclick="like(' . $user_id . ',' . $value->comment_id . ')"> ';

                if ($value->cmnt_user_id == $user_id && $value->cmnt_comment_id == $value->comment_id && $value->like == 1) {

                    $html .='<img src="' . base_url() . 'assets/public/img/up-reply-hover.png" onmouseover="this.src = \'' . base_url() . 'assets/public/img/up-reply-hover.png \'" onmouseout="this.src =\'' . base_url() . 'assets/public/img/up-reply.png \'"> ';
                } else {
                    $html .= '<img src=" ' . base_url() . 'assets/public/img/up-reply.png" onmouseover="this.src = \'' . base_url() . 'assets/public/img/up-reply-hover.png \'"   onmouseout="this.src = \'' . base_url() . 'assets/public/img/up-reply.png \'">';
                }
                $html .= ' </a></li> ';
            } else {

                $html .='<li><a style="cursor: pointer;" class="hvr-bounce-in" href="javascript:void(0);" id="login" style="cursor: pointer" data-toggle="modal" data-target="#login"><img src="' . base_url() . 'assets/public/img/up-reply.png" onmouseover="this.src = \'' . base_url() . 'assets/public/img/up-reply-hover.png\'"  onmouseout="this.src = \'' . base_url() . 'assets/public/img/up-reply.png\'"></a></li>';
            }

            //   $user_id = $this->session->userdata('user_id');
            if ($user_id) {

                $html .='<li class="comment-disvote"><a style="cursor: pointer;" class="hvr-bounce-in" id="dislike_' . $value->comment_id . '" onclick="dislike(' . $user_id . ',' . $value->comment_id . ')">';

                if ($value->cmnt_user_id == $user_id && $value->cmnt_comment_id == $value->comment_id && $value->like == 0) {

                    $html .='<img src="' . base_url() . 'assets/public/img/down-reply-hover.png" onmouseover="this.src = \'' . base_url() . 'assets/public/img/down-reply-hover.png \'"  onmouseout="this.src = \'' . base_url() . 'assets/public/img/down-reply.png\'">';
                } else {
                    $html .='<img src="' . base_url() . 'assets/public/img/down-reply.png" onmouseover="this.src = \'' . base_url() . 'assets/public/img/down-reply-hover.png\'" onmouseout="this.src = \'' . base_url() . 'assets/public/img/down-reply.png\'">';
                }
                $html .='</a></li>';
            } else {

                $html .='<li class="comment-disvote"><a style="cursor: pointer;" class="hvr-bounce-in" href="javascript:void(0);" id="login_modal" style="cursor: pointer" data-toggle="modal" data-target="#login-modal"> <img src="' . base_url() . 'assets/public/img/down-reply.png" onmouseover="this.src = \'' . base_url() . 'assets/public/img/down-reply-hover.png\'"  onmouseout="this.src = \'' . base_url() . 'assets/public/img/down-reply.png\'"></a></li>';
            }

            $user_id = $this->session->userdata('user_id');
            if ($user_id) {
                $u_id = $value->user_id;
                if ($user_id == $u_id) {

                    $html .='<li><a title="Deletecommet" style="cursor: pointer;" class="hvr-bounce-in" onClick="delete_Comment(' . $value->comment_id . ',' . '\'off\',' . $user_id . ')"><i class="fa fa-remove fa-lg"></i></a></li>';
                }
            }

            $html .='</ul>
                                    <div class="comment-container">
                                    <div id="childrplycmtbox-' . $value->comment_id . '" style="display:none" class="childrplycmtbox-' . $parent_id . '"  >
                                        <div  id="' . $parent_id . '">
                                            <textarea class="comment-box form-control form-comment childinnercomboBox" placeholder="Comment reply" id="childaddrplCommentBox-' . $value->comment_id . '" ></textarea>
                                            <div  id="' . $parent_id . '">
                                                <button class="pull-right small-btn green-bg btn childcommentrplPostBtn" id="' . $value->comment_id . '"  >Reply</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-2  pull-right comment-count" id="childinerwordcountdiv' . $value->comment_id . '">
                                            <p>1000</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>  </div>';
        }
        echo $html;
    }

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */
    