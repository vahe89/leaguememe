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
        $this->load->model('league_model', 'leaguemod');
        $this->load->model('admin_model', 'admin');
        $this->load->model('users_model', 'usermod');
        $this->load->model('category_model', 'category');
        $this->load->library('email');
        $this->load->library("pagination");
    }

    function add_league() {

        $allLGData = $this->input->post('league_img_name');
        $categoryData = $this->input->post('category_list');
        $totalData = count($allLGData);
        $total = $this->input->post('league_img_total');
        $this->form_validation->set_rules('category_list', 'Category', 'required');
        $this->form_validation->set_rules('league_img_name', 'League Image Name', 'required');

        $validate = $this->form_validation->run();
        if ($validate == TRUE) {
            for ($i = 1; $i <= $total; $i++) {
                if (isset($allLGData[$i]["name"]) && !empty($allLGData[$i]["name"])) {
                    if (isset($allLGData[$i]["video"]) && !empty($allLGData[$i]["video"]) && $allLGData[$i]["video"] != "") {
                        //code for video
                        $videoname = $allLGData[$i]['video'];
                        $imgArr = '';
                    } else {
                        if (isset($_FILES['league_img']) && isset($_FILES['league_img']['name'][$i])) {

                            if (!isset($_FILES['league_img']) || !is_uploaded_file($_FILES['league_img']['tmp_name'][$i])) {
                                die('Image file is Missing!'); // output error when above checks fail.
                            }
                            //uploaded file info we need to proceed
                            $image_name = $_FILES['league_img']['name'][$i]; //file name
                            $image_size = $_FILES['league_img']['size'][$i]; //file size
                            $image_temp = $_FILES['league_img']['tmp_name'][$i]; //file temp

                            $_FILES['new_league_img']['name'] = $_FILES['league_img']['name'][$i];
                            $_FILES['new_league_img']['type'] = $_FILES['league_img']['type'][$i];
                            $_FILES['new_league_img']['tmp_name'] = $_FILES['league_img']['tmp_name'][$i];
                            $_FILES['new_league_img']['error'] = $_FILES['league_img']['error'][$i];
                            $_FILES['new_league_img']['size'] = $_FILES['league_img']['size'][$i];

                            $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                            if ($ext == "gif") {
                                $config['upload_path'] = "./uploads/league";
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
                                    $oldimageuploadpath = "uploads/league/";
                                    $imagetemppath1 = "uploads/league/temp/";
                                    // $imagetemppath2 = "uploads/league/test/";
                                    shell_exec('convert "' . $oldimageuploadpath . $imgArr . '" "' . $imagetemppath1 . $filename . '%d.png"');
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
                                    case 'image/jpeg': case 'image/pjpeg': case 'image/jpg':
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
                                    $image_save_folder = $this->destination_folder . $new_file_name;
                                    $image_width = $image_width / 2;
                                    $image_height = $image_height / 2;
                                    //call normal_resize_image() function to proportionally resize image
                                    if ($this->normal_resize_image($image_res, $image_save_folder, $image_type, $this->max_image_size_new, $image_width, $image_height, 100)) {
                                        $imgArr = $new_file_name;
                                    }

                                    imagedestroy($image_res); //freeup memory
                                }
                            }
                        }
                    }
                    $category = $categoryData;
                    if (isset($allLGData[$i]['swf'])) {
                        if ($allLGData[$i]['swf'] === '1') {
                            $userleague_access = '1';
                        } else {
                            $userleague_access = '0';
                        }
                    } else {
                        $userleague_access = '0';
                    }

                    // $userleague_access = ($allLGData[$i]['swf'] === '1') ? '1' : '0';
                    $dataArr = array(
                        'leagueimage_name' => $allLGData[$i]['name'],
                        'category_id' => $category,
                        'leagueimage_userid' => '0',
                        'leagueimage_status' => 'A',
                        'leagueimage_setpopular' => 'N',
                        'leagueimage_filename' => $imgArr,
                        'videoname' => $videoname,
                        'league_img_access' => $userleague_access
                    );

                    $result = $this->leaguemod->add_league_img($dataArr);
                    //print_r($result);
                    if (!empty($result)) {
                        if (isset($allLGData[$i]['tag'])) {
                            $tag_explode = explode(',', $allLGData[$i]['tag']);
                            foreach ($tag_explode as $tag) {
                                if (trim($tag)) {// or use !empty 
                                    $dataArray = array(
                                        'leagueimage_id' => $result,
                                        'user_id' => '0',
                                        'tag' => $tag
                                    );
                                    $this->leaguemod->add_league_imgtags($dataArray);
                                }//check tag is emapty or not
                            }
                        }

                        if (isset($allLGData[$i]['credit'])) {
                            $creditArray = array(
                                'leagueimage_id' => $result,
                                'user_id' => '0',
                                'credit_status' => 'A',
                                'credit' => $allLGData[$i]['credit']
                            );

                            $this->leaguemod->add_league_credits($creditArray);
                        }
                    }
                }
            }//for loop over
            $this->session->set_flashdata('message', 'Meme added successfully');
            redirect('list_league');
        } else {
            if ($this->session->userdata('logged_in')) {
                $data['left'] = "<a href='articles'>League</a>  &nbsp;>&nbsp; Add_league";
                $data['content_header'] = "League";
                $data['users'] = $this->admin->getUsers();
                $data['league'] = $this->admin->getAllLeagueImages();
                $data['category_list'] = $this->category->getAllCategory();
                $data['count_meme'] = $this->leaguemod->count_inactive_league();
                $data['count_new_user'] = $this->admin->count_new_user();
                $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();
                $data['content'] = $this->load->view('add_league', $data, TRUE);
                load_admin_template($data);
            } else {
                $this->load->view('admin/login');
            }
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

    function getCategoryId() {
        $category = $this->input->post('category');
        echo $this->leaguemod->getCategoryId($category);
    }

    function list_league() {
        if ($this->session->userdata('logged_in')) {
            $data['left'] = "<a href='" . base_url() . "list_league'>League</a> &nbsp;>&nbsp; League_list";
            $data['content_header'] = "League";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();

            $data['content'] = $this->load->view('list_league', $data, TRUE);
            load_admin_template($data);
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

    function league_list_ajax() {
        $this->leaguemod->league_list_request();
    }

    function update_league_status() {
        $league_img_id = $this->input->post('league_id');
        $league_img_status = $this->input->post('league_status');

        if ($league_img_status == "A") {
            $dataArr = array('leagueimage_status' => 'I');
        } else {
            $dataArr = array('leagueimage_status' => 'A');
        }
        $result = $this->leaguemod->updateLeagueStatus($dataArr, $league_img_id);
        $res = $this->leaguemod->select_league_images($league_img_id);
        if ($res['leagueimage_userid'] != '0') {
            $user = $this->leaguemod->getuser_details($res['leagueimage_userid']);
            if ($res['leagueimage_status'] == 'A') {
                $html = '<table style="width:100%; font-family:Verdana, Geneva, sans-serif;text-align:left;border:0px" cellspacing="0">
		<tbody>		 
		<tr><td style="font-size:14px;padding:10px 0"><p>Dear User</td></tr>

		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;">Your Meme has been verified and published.visit our site www.leaguememe.com</td></tr>
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;">Yours Sincerely,</td></tr>
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;">LeagueMeme.com support team,</td></tr>
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;"Note : Please do not reply back to this mail. This is sent from an unattended mailbox. If you have any queries, visit our site www.leaguememe.com/support,</td></tr>

		</tbody>
		</table>';
            } else {
                $html = '<table style="width:100%; font-family:Verdana, Geneva, sans-serif;text-align:left;border:0px" cellspacing="0">
		<tbody>		 
		<tr><td style="font-size:14px;padding:10px 0"><p>Dear User</td></tr>
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;">Your Meme has been rejected </td></tr>
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;">Yours Sincerely,</td></tr>
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;">LeagueMeme.com support team,</td></tr>
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;"Note : Please do not reply back to this mail. This is sent from an unattended mailbox. If you have any queries, visit our site www.leaguememe.com/support,</td></tr>
		</tbody>
		</table>';
            }


            $config['protocol'] = 'mail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';
            $activate_link = base_url();
            $this->email->initialize($config);
            $this->email->from('support@leaguemoment.com', 'support');
            $this->email->subject('Design Verification');
            //$this->email->to($email_name);
            $this->email->to($user['user_email']);


            $this->email->message($html);
            $send = $this->email->send();
        }
        $this->session->set_flashdata('message', 'Status updated successfully');
    }

    function deleteleague_img() {
        $league_img_id = $this->input->post('league_img_id');
        $data = $this->leaguemod->getLeagueImageById($league_img_id);
        $img_name = $data['leagueimage_filename'];
        $img_extention = substr(strrchr($img_name, '.'), 1);

        //Delete League Image
        $url = base_url() . "uploads/league/" . $img_name;
        @unlink($url);

        if ($img_extention == "gif") {
            $image_name_without_extention = substr($img_name, 0, strpos($img_name, "."));
            $video_url = base_url() . "uploads/league/mp4/" . $image_name_without_extention . ".webm";
            @unlink($video_url);
        }

        $this->leaguemod->delete_league($league_img_id);
        $this->session->set_flashdata('message', 'League  deleted successfully');
    }

    function popular_status() {

        $league_img_id = $this->input->post('league_id');
        $popular_status = $this->input->post('popular_status');

        if ($popular_status == "Y") {
            $dataArr = array('leagueimage_setpopular' => 'N');
        } else {
            $dataArr = array('leagueimage_setpopular' => 'Y');
        }
        $result = $this->leaguemod->updateImagePopulartatus($dataArr, $league_img_id);
        $this->session->set_flashdata('message', 'Status updated successfully');
    }

    function active_credit() {

        $credit_id = $this->input->post('credit_id');
        $credit_status = $this->input->post('credit_status');

        if ($credit_status == "A") {
            $dataArr = array('credit_status' => 'I');
        } else {
            $dataArr = array('credit_status' => 'A');
        }
        $result = $this->leaguemod->updateCreditStatus($dataArr, $credit_id);

        $this->session->set_flashdata('message', 'Status updated successfully');
    }

    function sidebar_status() {

        $league_img_id = $this->input->post('league_id');
        $sidebar_status = $this->input->post('is_sidebar');

        if ($sidebar_status == "0") {
            $dataArr = array('is_sidebar' => '1');
        } else {
            $dataArr = array('is_sidebar' => '0');
        }
        $result = $this->leaguemod->updateImageSidebarStatus($dataArr, $league_img_id);
        $this->session->set_flashdata('message', 'Status updated successfully');
    }

    function edit_league($league_img_id) {

        if ($this->session->userdata('logged_in')) {
            if ($_POST) {
                $this->form_validation->set_rules('category_list', 'Category', 'required');
                $this->form_validation->set_rules('league_img_name', 'Meme Name', 'required');
                $validate = $this->form_validation->run();
                if ($validate == TRUE) {

                    if ($_FILES['league_img']['name'] != "") {
                        //--==================================image uploading===================================---			   
                        if (!isset($_FILES['league_img']) || !is_uploaded_file($_FILES['league_img']['tmp_name'])) {
                            //die('Image file is Missing!'); // output error when above checks fail.
                        }

                        //uploaded file info we need to proceed
                        $image_name = $_FILES['league_img']['name']; //file name
                        $image_size = $_FILES['league_img']['size']; //file size
                        $image_temp = $_FILES['league_img']['tmp_name']; //file temp

                        $ext = pathinfo($image_name, PATHINFO_EXTENSION);


                        if ($ext == "gif") {
                            $config['upload_path'] = "uploads/league/";
                            $config['allowed_types'] = 'gif|jpg|png|jpeg';

                            $filename = rand(0, 9999999999);
                            $videoname = $filename . '.webm';
                            $config['file_name'] = $filename;
                            // exec("C:/ffmpeg/bin/ffmpeg -i " . $image_temp . " -c:v libvpx -crf 12 -b:v 500K " . getcwd() . "\uploads\league\mp4\\" . $videoname);

                            $this->load->library('upload', $config);

                            if (!$this->upload->do_upload('league_img')) {
                                echo $this->upload->display_errors();
                            } else {
                                $imgArr = $filename . '.' . $ext;
                                $newimageuploadpath = "uploads/league/mp4/";
                                $oldimageuploadpath = "uploads/league/";
                                $imagetemppath1 = "uploads/league/temp/";
                                // $imagetemppath2 = "uploads/league/test/";
                                shell_exec('convert "' . $oldimageuploadpath . $imgArr . '" "' . $imagetemppath1 . $filename . '%d.png"');
                            }
                            shell_exec('avconv -f image2 -i "' . $imagetemppath1 . $filename . '%d.png" "' . $newimageuploadpath . $videoname . '"');
                            $old_imageFile_name = $this->input->post('league_img_old');
                            $old_video_file = explode(".", $old_imageFile_name);
                            @unlink('uploads/league/' . $old_imageFile_name);
                            @unlink('uploads/league/mp4/' . $old_video_file[0] . ".webm");
                        } else {
                            //start  image resize
                            $videoname = '';
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

                                //folder path to save resized images and thumbnails
                                $image_save_folder = $this->destination_folder . $new_file_name;

                                //call normal_resize_image() function to proportionally resize image

                                $image_width = $image_width / 2;
                                $image_height = $image_height / 2;

                                if ($this->normal_resize_image($image_res, $image_save_folder, $image_type, $this->max_image_size_new, $image_width, $image_height, 100)) {
                                    $imgArr = $new_file_name;
                                    $old_file = $this->input->post('league_img_old');
                                    @unlink(base_url() . 'uploads/league/' . $old_file);
                                }

                                imagedestroy($image_res); //freeup memory
                            }
                        }
                    }
//--================================== image uploading===================================---	
                    else {
                        $imgArr = $this->input->post('league_img_old');
                        $videoname = "";
                    }
                    $category = $this->input->post('category_list');
                    if ($category == "6") {
                        $videoname = $this->input->post('videolink');
                        $imgArr = '';
                        $league_img_old = $this->input->post('league_img_old');
                        $url = base_url() . 'uploads/league/' . $league_img_old;
                        @unlink($url);
                    }
                    $userleague_access = ($this->input->post('league_access') === '1') ? '1' : '0';
                    $dataArr = array(
                        'leagueimage_name' => $this->input->post('league_img_name'),
                        'leagueimage_filename' => $imgArr,
                        'videoname' => $videoname,
                        'category_id' => $this->input->post('category_list'),
                        'leagueimage_userid' => $this->input->post('leaguee_userr_id'),
                        'league_img_access' => $userleague_access
                    );
                    if ($this->input->post('league_tags')) {

                        $this->leaguemod->deleteLeagueImgtags($league_img_id);
                        $tag_explode = explode(',', $this->input->post('league_tags'));
                        foreach ($tag_explode as $tag) {
                            $dataArray = array(
                                'leagueimage_id' => $league_img_id,
                                'user_id' => $this->input->post('leaguee_userr_id'),
                                'tag' => $tag);

                            $this->leaguemod->add_league_imgtags($dataArray);
                        }
                    }
                    if ($this->input->post('league_img_credits')) {
                        $this->leaguemod->deleteLeagueImgcredits($league_img_id);
                        $creditArray = array(
                            'leagueimage_id' => $league_img_id,
                            'user_id' => $this->input->post('leaguee_userr_id'),
                            'credit_status' => 'A',
                            'credit' => $this->input->post('league_img_credits'));

                        $this->leaguemod->add_league_credits($creditArray);
                    }


                    $this->leaguemod->updateLeagueImg($dataArr, $league_img_id);

                    $this->session->set_flashdata('message', 'Meme updated successfully');
//                    redirect($_SERVER['HTTP_REFERER']);
//                    echo $return_path;exit;
                    redirect('list_league');
                }
            }
            $videoCat = "video";
            $data['videoCategory'] = $this->leaguemod->getCategoryId($videoCat);
            $data['cat_list'] = $this->admin->selectCategory();
            $data['league_list'] = $this->leaguemod->getLeagueImageById($league_img_id);
            $data['league_credit'] = $this->leaguemod->getCreditByLeagueimage($league_img_id);
            $data['league_tags'] = $this->leaguemod->getTagByLeagueimage($league_img_id);


            $data['left'] = "<a href='" . base_url() . "list_league'>League</a> &nbsp;>&nbsp;Edit League";
            $data['content_header'] = "League";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();

            $data['content'] = $this->load->view('edit_league', $data, TRUE);
            load_admin_template($data);
        } else {
            redirect('admin/login');
        }
    }

    function view_sidebar() {
        if ($this->session->userdata('logged_in')) {
            $data['left'] = "<a href='" . base_url() . "sidebar_list'>Sidebar</a> &nbsp;>&nbsp; Sidebar_list";
            $data['content_header'] = "Sidebar";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();

            $data['content'] = $this->load->view('list_sidebar', $data, TRUE);
            load_admin_template($data);
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

    function sidebar_list_ajax() {
        $this->leaguemod->sidebar_list_request();
    }

    function remove_sidebar_img() {
        $league_img_id = $this->input->post('league_img_id');
        $dataArr = array('is_sidebar' => '0');
        $result = $this->leaguemod->removeSideBar($dataArr, $league_img_id);
        $this->session->set_flashdata('message', 'League remove from sidebar successfully');
    }

    function top_navigation($value) {
        if ($this->session->userdata('logged_in')) {
            $data['pendingdata'] = $value;
            $data['left'] = "<a href='" . base_url() . "list_league'>League</a> &nbsp;>&nbsp; League_list";
            $data['content_header'] = "League";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();

            $data['content'] = $this->load->view('pending_league', $data, TRUE);
            load_admin_template($data);
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

    function pending_list_ajax() {
        $pending = $this->input->post('record');
        $this->leaguemod->pending_list_request($pending);
    }

    function list_anime_report1() {
        $mim_limit = 1;
        $data['report'] = $this->leaguemod->list_anime_report($mim_limit);
        if ($data['report']) {
            
        }
    }

    function anime_report() {
        if ($this->session->userdata('logged_in')) {
            $data['left'] = "<a href='" . base_url() . "anime_report'>Report</a> &nbsp;>&nbsp; Report_List";
            $data['content_header'] = "Leaguememe Report";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();
                                
            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();
            $data['content'] = $this->load->view('list_anime_report', $data, TRUE);
            load_admin_template($data);
        } else {
            redirect('admin/login');
        }
    }

    function list_anime_report() {

        $mim_limit = 1;
        $this->leaguemod->list_anime_report($mim_limit);
//        $this->articlemod->article_list_request();
    }
function all_anime_report() {
        if ($this->session->userdata('logged_in')) {
            $data['left'] = "<a href='" . base_url() . "all_anime_report'>Report</a> &nbsp;>&nbsp; all_anime_report";
            $data['content_header'] = "Report";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();

            $data['content'] = $this->load->view('all_anime_report', $data, TRUE);
            load_admin_template($data);
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }
    
     function league_report_ajax() {
        $this->leaguemod->league_report_request();
    }
    
    function update_report_status() {
        $id = $this->input->post('id');
        $league_report_status = $this->input->post('report_status');
        $league_report_user_id = $this->input->post('league_report_id');

        if ($league_report_status == "1") {
            $dataArr = array('status' => '0');
        } else {
            $dataArr = array('status' => '1');
        }
        $result = $this->leaguemod->updateReportStatus($dataArr, $id, $league_report_status, $league_report_user_id);
        $res = $this->leaguemod->select_report_data($league_report_user_id);
        if ($res['league_report_id'] != '0') {
            $user = $this->leaguemod->getuser_details($res['league_report_id']);
            if ($res['status'] == '1') {
                $html = '<table style="width:100%; font-family:Verdana, Geneva, sans-serif;text-align:left;border:0px" cellspacing="0">
		<tbody>		 
		<tr><td style="font-size:14px;padding:10px 0"><p>Dear User</td></tr>

		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;">Your Meme has been verified and published.visit our site www.leaguememe.com</td></tr>
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;">Yours Sincerely,</td></tr>
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;">LeagueMeme.com support team,</td></tr>
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;"Note : Please do not reply back to this mail. This is sent from an unattended mailbox. If you have any queries, visit our site www.leaguememe.com/support,</td></tr>

		</tbody>
		</table>';
            } else {
                $html = '<table style="width:100%; font-family:Verdana, Geneva, sans-serif;text-align:left;border:0px" cellspacing="0">
		<tbody>		 
		<tr><td style="font-size:14px;padding:10px 0"><p>Dear User</td></tr>
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;">Your Meme has been rejected </td></tr>
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;">Yours Sincerely,</td></tr>
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;">LeagueMeme.com support team,</td></tr>
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;"Note : Please do not reply back to this mail. This is sent from an unattended mailbox. If you have any queries, visit our site www.leaguememe.com/support,</td></tr>
		</tbody>
		</table>';
            }


            $config['protocol'] = 'mail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';
            $activate_link = base_url();
            $this->email->initialize($config);
            $this->email->from('support@leaguemoment.com', 'support');
            $this->email->subject('Design Verification');
            //$this->email->to($email_name);
            $this->email->to($user['user_email']);


            $this->email->message($html);
            $send = $this->email->send();
        }
        $this->session->set_flashdata('message', 'Status updated successfully');
    }

}

?>