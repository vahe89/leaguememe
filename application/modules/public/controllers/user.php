<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MX_Controller {

    var $max_image_size = 640; //Maximum image size (height and width)
    var $max_image_size_new = 800;
    var $thumb_prefix = "thumb_"; //Normal thumb Prefix
    var $destination_folder = 'uploads/users/';
    var $destination_folder1 = 'uploads/league/'; //upload directory ends with / (slash)
    var $jpeg_quality = 90;
    public $home = 'home';
    public $login_view = 'login';
    public $headers = 'header';
    public $login_success_view = 'index';
    public $footer = 'footer';
    public $details = 'details';
    public $category = 'category';
    public $list_ages = 'list_ages';
    public $search = 'search';
    public $page = 'page';
    public $wishlist = 'wishlist';
    public $account = 'account';
    public $profile_side = 'profile_side';
    public $order_history = 'order_history';
    public $profile = 'profile';
    public $order_details = 'order_details';
    public $forgot = 'forgot';
    public $change_password = 'change_password';
    public $contact = 'contact';
    public $franchise = 'franchise';

    function __construct() {
        parent::__construct();
        $this->load->helper('text');
        $this->load->library('email');
        $this->load->model('users_model', 'usermod');
        $this->load->model('league_model', 'leaguemod');
        $this->load->model('home_model', 'hm');
        $this->load->model('anime_model', 'animod');
    }

    public function login() {
        if ($this->session->userdata('user_id')) {
            redirect(base_url());
        } else {

            if ($_POST) {
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');
                $validate = $this->form_validation->run();
                if ($validate == TRUE) {

                    $username = $this->input->post('username');
                    $password = $this->input->post('password');

                    $result = $this->usermod->user_login($username, $password);
                    $rememberme = $this->input->post('rememberme');

                    if ($rememberme == 'Yes') {

                        setcookie('username', $username, time() + (86400 * 30), "/");
                        setcookie('password', $password, time() + (86400 * 30), "/");
                    }

                    if ($result) {
                        $res = $this->usermod->userdetails($username, $password);

                        $ban_status = $this->usermod->check_ban_status($res['user_id']);

                        if ($ban_status) {
                            $this->session->set_userdata('uname', $username);
                            $profile = $this->usermod->userProfile_detail($res['user_id']);
                            $this->session->set_userdata($profile);
                            $this->session->set_userdata('user_id', $res['user_id']);
                            $sess_user_array = array();

                            $dataArr = array('online_status' => 'online');
                            $this->usermod->updateUserByEmail($username, $dataArr);
                            if ($this->uri->uri_string() === "user/login") {
                                redirect(base_url());
                            } else {
                                header("Location: " . $_SERVER['HTTP_REFERER']);
                            }
                        } else {
                            $data['msg'] = "You Are Banned !";
                            $data['content'] = $this->load->view('login', $data, TRUE);
                            load_public_template($data);
                        }
                    }
                } else {
                    $data['content'] = $this->load->view('login');
                    load_public_template($data);
                }
                $data['msg'] = "Wrong Username or Password !";
                $data['content'] = $this->load->view('login', $data, TRUE);
                load_public_template($data);
            } else {
                $data['content'] = $this->load->view('login');
                load_public_template($data);
            }
        }
    }

    public function sign_up() {
        if ($this->session->userdata('user_id')) {
            redirect(base_url());
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]');
            $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is.unique[le_users.user_email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('passconf', 'Re-enter Password', 'required|matches[password]');
            $validate = $this->form_validation->run();

            if ($validate == TRUE) {

                $dataArr = array(
                    'user_name' => $this->input->post('username'),
                    'user_email' => $this->input->post('email'),
                    'user_password' => md5($this->input->post('password')),
                    'user_status' => 'I',
                    'is_new' => 1
                );
                $result = $this->usermod->addUser($dataArr);

                $config['protocol'] = 'mail';
                $config['mailpath'] = '/usr/sbin/sendmail';
                $config['charset'] = 'iso-8859-1';
                $config['wordwrap'] = TRUE;
                $config['mailtype'] = 'html';
                $this->email->initialize($config);
                $activate_link = base_url() . 'user/Acccount_activation/' . base64_encode($result);
//$this->email->from($this->input->post('cnt_email'), $this->input->post('cnt_name'));
                $this->email->from('register@leaguememe.com');
//            $this->email->from('info@skylineinfosys.com');
                $this->email->to($this->input->post('email'));
                $this->email->subject('Leaguememe - Confirmation Mail');
                $html = '<table style="width:100%; font-family:Verdana, Geneva, sans-serif;text-align:left;border:0px" cellspacing="0">
			<tbody>
			<tr><td style="font-size:14px;padding:10px 0;color:#000;">Dear ' . $this->input->post('username') . ',</td></tr>
			<tr><td style="font-size:14px;padding:10px 0;color:#000;">You recently entered a new email address for the user ' . $this->input->post('fullname') . '.</td></tr>
			<tr><td style="font-size:14px;padding:10px 0;color:#000;">Please confirm your email by clicking the below link. </td></tr>
			<tr><td style="font-size:14px;padding:10px 0;color:#000"><a href="' . $activate_link . '" style="color:#C27613;font-weight:bold">Activate Account</a></td></tr>
			<tr><td style="font-size:14px;padding:10px 0;color:#000">Thank you</td></tr>
			<tr><td style="font-size:14px;padding:10px 0;color:#000">Team League Meme</td></tr>
			</tbody>
			</table>';
                $this->email->message($html);
                $this->email->send();
                $this->session->set_flashdata('message', 'Thank you for registering with Leaguememe. Before you can login, you will need to verify your email address. We sent you an activation email with a link in it. Please click on that link to verify your email address.Please check your spam folder if you do not receive the email within a few minutes.');

                redirect(base_url());
            } else {
//            $this->session->set_flashdata('message', 'regis_false');
//            redirect(base_url());
                $data['header'] = $this->load->view('template/header');
                $data['top_nav'] = $this->load->view('template/top_nav');
                $data['content'] = $this->load->view('registration');
                $data['footer'] = $this->load->view('template/footer');
                load_public_template($data);
            }
        }
    }

    function logout() {
        $user_id = $this->session->userdata('uname');
        $dataArr = array('online_status' => 'offline');
        $this->usermod->updateUserByEmail($user_id, $dataArr);
        $this->session->sess_destroy();
        unset($_SESSION['token']);
        redirect(base_url());
    }

    function Acccount_activation($id = '') {
        $uid = base64_decode($id);
        
        $data_array = array(
            'user_id' => mysql_real_escape_string($uid)
        );
        $querys = $this->usermod->get('le_users', $data_array);
        $user_count = $querys->num_rows();

        if ($user_count == 1) {
            $dataArr = array('user_status' => 'A');

            $res = $this->usermod->updateUserById($uid, $dataArr);
           
            if ($res == true) {
                $user_details = $this->usermod->getUserById($uid);
                if ($user_details) {
                    $sess_user_array = array();
                    $sess_user_array = array(
                        'user_name' => $user_details->user_name,
                        'user_id' => $user_details->user_id
                    );
                    $this->session->set_userdata($sess_user_array);
                    $dataArr = array('online_status' => 'online');
                    $this->usermod->updateUserById($user_details->user_id, $dataArr);
                }

                $this->session->set_flashdata('message', 'Acountactive');
               
                redirect(base_url());
            }
        } else {
            $this->session->sess_destroy();
            $this->session->set_flashdata('message', 'Invalid Account Activated');
        }
        redirect(base_url());
    }

    function email_checkk() {
        $email = $this->input->post("email_id");
        $result = $this->usermod->email_check($email);
        if (count($result) == 0) {
            $str = " ";
        } else {
            $str = "Email Already Exists!!!";
        }
        echo $str;
    }

    function user_checkk() {
        $u_name = $this->input->post("u_name");
        $result = $this->usermod->user_check($u_name);
        if (count($result) == 0) {
            $str = " ";
        } else {
            $str = "Username already Taken!!";
        }
        echo $str;
    }
 function email_checkmodal() {
        $email = $this->input->post("email");
        $result = $this->usermod->email_check($email);
        if (count($result) == 0) {
            $str = "true";
        } else {
            $str = "false";
        }
        echo $str;
    }

    function user_checkmodal() {
        $u_name = $this->input->post("username");
        $result = $this->usermod->user_check($u_name);
        if (count($result) == 0) {
            $str = "true";
        } else {
            $str = "false";
        }
        echo $str;
    }
    function email_check() {
        $email = $this->input->post("email_id");
        $result = $this->usermod->email_check($email);
        if (count($result) == 0) {
            $str = "true";
        } else {
            $str = "false";
        }
        echo $str;
    }

    function user_check() {
        $u_name = $this->input->post("u_name");
        $result = $this->usermod->user_check($u_name);
        if (count($result) == 0) {
            $str = "true";
        } else {
            $str = "false";
        }
        echo $str;
    }

    function userdetail() {
        $session = $this->session->userdata('user_id');
        return $profile = $this->usermod->userProfile_detail($session);
    }

    function leaguememe_profile($user_id = '') {
        if ($this->session->userdata('user_id')) {
            $data['userdetail'] = $this->usermod->userOtherProfile_detail($user_id);

            $user_id = $this->session->userdata('user_id');

            $follow = $data['userdetail']['user_id'];
            $data['follow'] = $this->usermod->follow_check($user_id, $follow);
            $data['followerlist'] = $this->usermod->follower_list($data['userdetail']['user_id']);
            $data['link'] = $this->leaguemod->count_league($user_id);
            $this->load->library('pagination');
            $data['total_rows'] = $this->usermod->count_timeline_comment($data['userdetail']['user_id']);
            $config['total_rows'] = $data['total_rows']->total_comment_id;

            $config["num_links"] = floor($config['total_rows']);
            $config['per_page'] = 5;
            $config["uri_segment"] = 3;
            $choice = $config['total_rows'] / $config["per_page"];
            $page_url = $config['base_url'] = base_url() . 'leaguememe_profile/' . $data['userdetail']['user_name'];
            $config["num_links"] = floor($choice);
            $config['full_tag_open'] = '<ul class="pagination pagination-green">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = true;
            $config['last_link'] = true;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '<';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '>';
            $config['next_tag_open'] = '<li class="next">';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a  href=" ' . $page_url . '" class="active" >';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['comment_detail'] = $this->usermod->comment_timeline_fetch($data['userdetail']['user_id'], $config["per_page"], $data['page']);
            $data['pagination'] = $this->pagination->create_links();
            $data['username'] = $this->session->userdata('uname');
            $data['user_id'] = $this->session->userdata('user_id');
            $data["side_link"] = $this->hm->get_all_sidelinksside();
            $data["side_linkss"] = $this->hm->get_all_sidelinksnoside();
            $data['summoner'] = $this->usermod->getSummoner($data['userdetail']['user_id']);
            $data['champs'] = $this->hm->getChamp();  
            $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
            $data['content'] = $this->load->view('profile', $data, TRUE);
            load_public_template($data);
        } else {
            redirect(base_url());
        }
    }

    function edit_profile_page() {
        if ($this->session->userdata('user_id')) {
            $data['userdetail'] = $this->userdetail();
            $data['username'] = $this->session->userdata('uname');
            echo $this->load->view('edit_profile', $data, TRUE);
        } else {
            redirect(base_url());
        }
    }

    function setting_profile_page() {
        if ($this->session->userdata('user_id')) {
            $data['userdetail'] = $this->userdetail();
            echo $this->load->view('setting_profile', $data, TRUE);
        } else {
            redirect(base_url());
        }
    }

    function about_profile_page() {
        if ($this->session->userdata('user_id')) {
            $user_id = $this->input->post('id');
            $data['userdetail'] = $this->usermod->userOtherProfile_detail($user_id);

            echo $this->load->view('about_profile', $data, TRUE);
        } else {
            redirect(base_url());
        }
    }

    function update_user() {
        $nfsw1 = $this->input->post('onoffswitch');
        $spoiler1 = $this->input->post('onoffswitchspoiler');
        if (empty($nfsw1)) {
            $nfsw = '0';
        } else {
            $nfsw = '1';
        }
        if (empty($spoiler1)) {
            $spoiler = '0';
        } else {
            $spoiler = '1';
        }
        if ($_FILES['user_profile']['name'] !== "") {

            if (!isset($_FILES['user_profile']) || !is_uploaded_file($_FILES['user_profile']['tmp_name'])) {
//die('Image file is Missing!'); // output error when above checks fail.
            }

//uploaded file info we need to proceed
            $image_name = $_FILES['user_profile']['name']; //file name
            $image_size = $_FILES['user_profile']['size']; //file size
            $image_temp = $_FILES['user_profile']['tmp_name']; //file temp

            $image_size_info = getimagesize($image_temp); //get image size

            if ($image_size_info) {
                $image_width = $image_size_info[0]; //image width
                $image_height = $image_size_info[1]; //image height
                $image_type = $image_size_info['mime']; //image type
            } else {
                $this->session->set_flashdata('request', 'error');
                redirect('leaguememe_profile/' . $this->session->userdata('user_name'));
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
//                        echo 'here';exit;
                if ($this->normal_resize_image($image_res, $image_save_folder, $image_type, $this->max_image_size, $image_width, $image_height, $this->jpeg_quality)) {
                    $imgArr = $new_file_name;
                    if ($this->input->post('userimg_old') != 0) {
                        @unlink('uploads/users/' . $this->input->post('userimg_old'));
                    }
                }

                imagedestroy($image_res); //freeup memory
            }
        }


//--==================================image uploading===================================---	
        else {
            $imgArr = $this->input->post('userimg_old');
        }
        if (!empty($_POST['gender'])) {
            $gender = $this->input->post('gender');
        } else {
            $gender = $this->input->post('gender_old');
        }
        if (!empty($_POST['AccountType'])) {
            $account = $this->input->post('AccountType');
        } else {
            $account = $this->input->post('account_old');
        }
        $dob = $this->input->post('year') . "-" . $this->input->post('month') . "-" . $this->input->post('date');
        $dataArr = array(
            'name' => $this->input->post('name'),
            'gender' => $gender,
            'dob' => $dob,
            'user_region' => $this->input->post('country'),
            'user_image' => $imgArr,
            'account_type' => $account,
            'NFSW' => $nfsw,
            'spoiler' => $spoiler,
        );
        $user_id = $this->session->userdata('user_id');
        $this->usermod->update_UserProfile($user_id, $dataArr);
        $this->session->set_flashdata('request', 'Successfully Edited.');
        redirect('leaguememe_profile/' . $this->session->userdata('user_name'));
    }

    function update_pswd() {

        $user_id = $this->session->userdata('user_id');
        $curr_pass = $this->input->post('current_password');
        $d_pass = $this->usermod->getUserById($user_id);

        $data_curr_pass = $d_pass->user_password;
        if (MD5($curr_pass) != $data_curr_pass) {

            $data = array('result' => 'error', 'msg' => 'Incorrect Old Password ');
            echo json_encode($data);
            die;

//            $this->session->set_flashdata('message', 'Incorrect Old Password ');
//            redirect('user_profile');
        } else {

            $data['user_id'] = $user_id;
            $password = $this->input->post('new_password');
            $repassword = $this->input->post('new_password_repeats');
            $newpass = MD5($password);
            $renewpass = MD5($repassword);
            if ($newpass != $renewpass) {
                $data = array('result' => 'error', 'msg' => 'Password Not Match');
                echo json_encode($data);
                die;
            } else {


                if ($password != "") {
                    $dataArr = array('user_password' => $newpass);

                    $this->usermod->updateUserById($user_id, $dataArr);
                    $data = array('result' => 'success', 'msg' => 'Password change successfully');
                    echo json_encode($data);
                    die;
                }
            }
        }
    }

    function forgot_password() {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $validate = $this->form_validation->run();
        if ($validate == TRUE) {

            $user_email = $this->input->post('email');
            $result = $this->usermod->forgot_pswdd($user_email);
            $uid = $this->usermod->forgot_pswdd_userid($user_email);
            $count = count($result);

            if ($count == 0) {
                echo 'false';
            } else {

                $config['protocol'] = 'mail';
                $config['mailpath'] = '/usr/sbin/sendmail';
                $config['charset'] = 'iso-8859-1';
                $config['wordwrap'] = TRUE;
                $config['mailtype'] = 'html';
                $activate_link = base_url();
                $this->email->initialize($config);
                $this->email->from('forgottenpassword@leaguememe.com', 'support');
                $this->email->subject('Forgot password (Leaguememe)');
                $this->email->to($user_email);
                $change_pwd_link = base_url() . 'user/reset_password/' . $uid;
//urlencode($user_email) ;
                $html = '<table style="width:100%; font-family:Verdana, Geneva, sans-serif;text-align:left;border:0px" cellspacing="0">
		<tbody>		 
		<tr><td style="font-size:14px;padding:10px 0"><p>Dear User</td></tr>
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;">We appreciate and thank you for using Animemoent services.</td></tr>  
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;"><a href="' . $change_pwd_link . '" style="color:#cc3366;font-weight:bold">Click to Change Password</a></td></tr> 
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;">In case you have not made this request, please ignore this mail. As long as you do not click on the link contained in the email, no action will be taken and your account will remain secure. If you constantly receive such mails please contact us on support@leaguememe.com. </td></tr>
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;">Yours Sincerely,</td></tr>
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;">Leaguememe.com support team,</td></tr>
		<tr><td style="font-size:14px;padding:10px 0;background-color:#f6f6f6;">Note : Please do not reply back to this mail. This is sent from an unattended mailbox. If you have any queries, visit our site www.leaguememe.com/support,</td></tr>

		</tbody>
		</table>';

                $this->email->message($html);
                $send = $this->email->send();
                echo $this->email->print_debugger();
//                echo 'true';
            }
        } else {
            echo 'error';
        }
    }

    function reset_password($id) {

// $email=urldecode($this->uri->segment(3));
// $data['email']=$email; 

        $uid = $this->uri->segment(3);

        $result = $this->usermod->get_user_by_id($uid);


        $username = $result->user_name;
        $password = $result->user_password;
        $data["dat"] = $result;

        if ($result) {
            $res = $this->usermod->userdetails($username, $password);

            $ban_status = $this->usermod->check_ban_status($res['user_id']);

            if ($ban_status) {
//                $this->session->set_userdata('uname', $username);
//                $this->session->set_userdata('user_id', $res['user_id']);
//                $sess_user_array = array();

                $dataArr = array('online_status' => 'online');
                $this->usermod->updateUserByEmail($username, $dataArr);
//echo '1' ; 
//$this->load->view('reset_password',$data);
                $data["new_post"] = $this->hm->get_new_post();
                $data["new_discussion"] = $this->hm->get_let_discussion();
                $data["new_like"] = $this->hm->get_newlike();
                $data["side_link"] = $this->hm->get_all_sidelinksside();
                $data["side_linkss"] = $this->hm->get_all_sidelinksnoside();
                $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
                $this->load->view('template/header');
                $this->load->view('template/top_nav');
                $this->load->view('reset_password', $data);
                $this->load->view('template/footer');
//$this->load->view('reset_password');
//return $err ;
            } else {
                $data['msg'] = "You Are Banned !";
                $this->load->view('header');
                $this->load->view('login', $data);
            }
        }
    }

    function update_password() {
        if ($this->session->userdata('user_id')) {
            redirect(base_url());
        } else {


            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('new_password', 'New Password', 'required');
            $this->form_validation->set_rules('cpswd', 'Re-type Password', 'required');
            $validate = $this->form_validation->run();
            if ($validate == TRUE) {

                $email = $this->input->post("email");
                $password = $this->input->post('new_password');
                $newpass = MD5($password);
                $dataArr = array('user_password' => $newpass);
                $this->usermod->updateUserByName($email, $dataArr);

                $this->session->set_flashdata('message', 'Password changed successfully');

                redirect(base_url());
            } else {
                $url = $_SERVER["HTTP_REFERER"];
                redirect($url);
            }
        }
    }

    function change_pswd() {

        if ($this->session->userdata('user_id')) {
            $this->load->view('template/header');
            $this->load->view('changepassword');
            $this->load->view('template/footer');
        } else {
            redirect('user/login');
        }
    }

    public function crop_upload() {
        if (isset($_POST['upload'])) {
            define('UPLOAD_DIR', 'uploads/users/');
            $img = $_POST['img'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $file = UPLOAD_DIR . uniqid() . '.png';
            $filename = explode("/", $file);
//            echo $filename[2];
            $user_id = $this->session->userdata('user_id');
            $dataArr = array('user_image' => $filename[2]);
            $this->usermod->updateUserProfile($user_id, $dataArr);

            $success = file_put_contents($file, $data);
//            print $success ? $file : 'Unable to save the file.';
        }
        redirect(base_url());
    }

    public function cover_crop_upload() {
        if (isset($_POST['cover_upload'])) {
            define('UPLOAD_DIR', 'uploads/users/cover/');
            $img = $_POST['coverimg'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $file = UPLOAD_DIR . uniqid() . '.png';
            $filename = explode("/", $file);
            $user_id = $this->session->userdata('user_id');
            $dataArr = array('cover_image' => $filename[3]);
            $this->usermod->updateUserCover($user_id, $dataArr);

            $success = file_put_contents($file, $data);
        }
        redirect(base_url());
    }

    public function follower() {

        $user_id = $this->session->userdata('user_id');
        if ($user_id != '') {



            $follow = $this->input->post("str");
            $data['userdetail'] = $this->usermod->userProfile_detail($follow);

            $result = $this->usermod->follow_check($user_id, $follow);

            if ($result) {
                $follow_status = $result['follow_status'];
                $follow_id = $result['follow_id'];
                if ($follow_status == '1') {
                    $this->usermod->removeFollow($user_id, $follow_id);

                    $comment_id = '0';
                    $league_image_id = 1;
                    $this->usermod->delete_notification($league_image_id, $user_id, $follow, $comment_id);
                    echo json_encode(array('status' => 'unfollow'));
                    exit;
                } else {
                    if ($data['userdetail']['account_type'] === "private") {
                        $notificationArray = array(
                            'user_id' => $follow,
                            'other_user_id' => $user_id,
                            'leagueimage_id' => 1,
                            'pre_value' => 'Approve Request',
                            'noti_date' => date("Y-m-d"),
                        );
                        $this->usermod->add_notification($notificationArray);
                        echo json_encode(array('status' => 'request'));
                        exit;
                    } else {
                        $followArray = array(
                            'follow_status' => '1'
                        );
                        $this->usermod->updateFollowStatus($followArray, $follow);
                        $notificationArray = array(
                            'user_id' => $follow,
                            'other_user_id' => $user_id,
                            'leagueimage_id' => 1,
                            'pre_value' => 'Followed you',
                            'noti_date' => date("Y-m-d"),
                        );

                        $this->usermod->add_notification($notificationArray);
                        echo json_encode(array('status' => 'follow'));
                        exit;
                    }
                }
            } else {
                if ($data['userdetail']['account_type'] === "private") {
                    $notificationArray = array(
                        'user_id' => $follow,
                        'other_user_id' => $user_id,
                        'leagueimage_id' => 1,
                        'pre_value' => 'Approve Request',
                        'noti_date' => date("Y-m-d"),
                    );
                    $this->usermod->add_notification($notificationArray);
                    echo json_encode(array('status' => 'request'));
                    exit;
                } else {
                    $dataArray = array(
                        'user_id' => $user_id,
                        'following_id' => $follow,
                        'follow_status' => '1'
                    );
                    $this->usermod->add_follower($dataArray);
                    $notificationArray = array(
                        'user_id' => $follow,
                        'other_user_id' => $user_id,
                        'leagueimage_id' => 1,
                        'pre_value' => 'Followed you',
                        'noti_date' => date("Y-m-d"),
                    );
                    $this->usermod->add_notification($notificationArray);
                    echo json_encode(array('status' => 'follow'));
                    exit;
                }
            }
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

    public function timeline_comment() {
        $this->load->helper('form');
        $this->load->helper('url');

        $comment = $this->input->post('comment');
        $other_id = $this->input->post('id');
        $other_name = $this->input->post('name');
        $user_id = $this->session->userdata('user_id');

        $filecheck = basename($_FILES['userfile']['name']);
        $ext = substr($filecheck, strrpos($filecheck, '.'));
        $new_filename = random_string('numeric', 7) . $ext;

        $config['upload_path'] = 'uploads/comment_picture/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $new_filename;

        $this->load->library('upload', $config);
        $img = "userfile";

        if ($this->upload->do_upload($img)) {
            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $filename = $new_filename;
        } else {
            $filename = '';
        }

        $dataArray = array(
            'user_id' => $user_id,
            'other_user_id' => $other_id,
            'comment' => $comment,
            'comment_image' => $filename,
        );

        $this->usermod->add_comment_Attimeline($dataArray);
        redirect('leaguememe_profile/' . $other_name);
    }

    public function notification() {

        $Session = $this->session->userdata('user_id');
        if ($Session == '') {
            redirect(base_url());
        } else {
            $data['userdetail'] = $this->userdetail();
            $data['noti_detail'] = $this->usermod->getgroupData($Session);

            $html = '<div class="notif-group">';
            for ($i = 0; $i < count($data['noti_detail']); $i++) {
                $date = $data['noti_detail'][$i]['noti_date'];

                $data['noti_details'] = $this->usermod->getSingleNotificationDetail($Session, $date);
                if (isset($data["noti_details"][$i]["user_id"])) {
                    $check_user = $data["noti_details"][$i]["user_id"];
                } else {
                    $check_user = 0;
                }
                $result = $this->usermod->follow_check($check_user, $Session);
                for ($j = 0; $j < count($data['noti_details']); $j++) {
                    if ($j == 0) {
                        $html .= ' 
                                <div class="col-md-12 no-padding  mar-b-20 notif-date-title">
                                    <span>' . date("d M Y", strtotime($data['noti_details'][$j]['noti_date'])) . '</span>
                                </div>
                                <div class="wrap-notif-item">
                                    <span class="status-notif"> ';
                        if ($data["noti_details"][$j]["pre_value"] === "Upvote your post") {
                            $html .='<i class="fa fa-arrow-up"></i>';
                        } else if ($data["noti_details"][$j]["pre_value"] === "Comment on your post") {
                            $html .='<i class="fa fa-comment"></i>';
                        } else if ($data["noti_details"][$j]["pre_value"] === "Followed you") {
                            $html .='<i class="fa fa-user-plus"></i>';
                        } else if ($data["noti_details"][$j]["pre_value"] === "Approve Request" || $data["noti_details"][$j]["pre_value"] === "Accept Request") {
                            $html .='<i class="fa fa-user-plus"></i>';
                        }
                        $html .= '</span>
                                <div class="username-notif-page">
                                        <span> <a href="' . base_url() . 'leaguememe_profile/' . $data['noti_details'][$j]['user_name'] . '">';
                        if (!empty($data["noti_details"][$j]["name"])) {
                            $html .= $data["noti_details"][$j]["name"];
                        } else {
                            $html .= $data["noti_details"][$j]["user_name"];
                        }
                        $html .= ' </a></span>
                                        <span>' . $data["noti_details"][$j]["pre_value"] . '</span>
                                        <span> ';
                        if (($data["noti_details"][$j]["parent_id"]) == 0) {

                            if ($data["noti_details"][$j]["pre_value"] === "Approve Request") {
                                if ($result) {
                                    $html .= '<a href="javascript:void(0);" title="Unfollow"  style=" border: 1px solid #ccc; padding: 5px 18px;" onclick="request_approve(this.id);" class="approve_btn" id="' . $data["noti_details"][$i]["user_id"] . '"> Unfollow <i class="fa fa-close"></i></a>';
                                } else {
                                    $html .= '<a href="javascript:void(0);" title="Follow"  style=" border: 1px solid #ccc; padding: 5px 18px;" onclick="request_approve(this.id);" class="approve_btn" id="' . $data["noti_details"][$i]["user_id"] . '">Follow <i class="fa fa-check"></i></a>';
                                }
                            } else {
                                if ($data["noti_details"][$j]["pre_value"] === "Followed you" || $data["noti_details"][$j]["pre_value"] === "Accept Request") {
                                    
                                } else if (empty($data["noti_details"][$j]["leagueimage_maintitle"])) {
                                    $html .= '<a href="' . base_url() . $data["noti_details"][$j]["leagueimage_id"] . '">' . $data["noti_details"][$j]["leagueimage_name"] . '</a>';
                                } else {
                                    $html .= '<a href="' . base_url() . $data["noti_details"][$j]["leagueimage_id"] . '">' . $data["noti_details"][$j]["leagueimage_maintitle"] . '</a>';
                                }
                            }
                        } else {
                            if ($data["noti_details"][$j]["pre_value"] === "Approve Request") {
                                if ($result) {
                                    $html .= '<a href="javascript:void(0);" title="Unfollow"  style=" border: 1px solid #ccc; padding: 5px 18px;" onclick="request_approve(this.id);" class="approve_btn" id="' . $data["noti_details"][$i]["user_id"] . '"> Unfollow <i class="fa fa-close"></i></a>';
                                } else {
                                    $html .= '<a href="javascript:void(0);" title="Follow"  style=" border: 1px solid #ccc; padding: 5px 18px;" onclick="request_approve(this.id);" class="approve_btn" id="' . $data["noti_details"][$i]["user_id"] . '">Follow <i class="fa fa-check"></i></a>';
                                }
                            } else {

                                if ($data["noti_details"][$j]["pre_value"] === "Followed you" || $data["noti_details"][$j]["pre_value"] === "Accept Request") {
                                    
                                } else if (empty($data["noti_details"][$j]["leagueimage_name"])) {
                                    $html .= 'Not Avalialbe';
                                } else {
                                    $html .= $data["noti_details"][$j]["leagueimage_name"];
                                }
                            }
                        }

                        $html .='</span>
                                        <span>' . date("h:i A", strtotime($data["noti_details"][$j]["noti_timestamp"])) . '</span>
                                     </div>
                              </div>';
                    } else {
                        $html .= '<div class="wrap-notif-item">
                                <span class="status-notif">';
                        if ($data["noti_details"][$j]["pre_value"] === "Upvote your post") {
                            $html .='<i class="fa fa-arrow-up"></i>';
                        } else if ($data["noti_details"][$j]["pre_value"] === "Comment on your post") {
                            $html .='<i class="fa fa-comment"></i>';
                        } else if ($data["noti_details"][$j]["pre_value"] === "Followed you") {
                            $html .='<i class="fa fa-user-plus"></i>';
                        } else if ($data["noti_details"][$j]["pre_value"] === "Approve Request" || $data["noti_details"][$j]["pre_value"] === "Accept Request") {
                            $html .='<i class="fa fa-user-plus"></i>';
                        }
                        $html .= '</span>
                                <div class="username-notif-page">
                                        <span> <a href="' . base_url() . 'leaguememe_profile/' . $data['noti_details'][$j]['user_name'] . '">';
                        if (!empty($data["noti_details"][$j]["name"])) {
                            $html .= $data["noti_details"][$j]["name"];
                        } else {
                            $html .= $data["noti_details"][$j]["user_name"];
                        }
                        $html .= ' </a></span>
                                        <span>' . $data["noti_details"][$j]["pre_value"] . '</span>
                                        <span>';
                        if (($data["noti_details"][$j]["parent_id"]) == 0) {

                            if ($data["noti_details"][$j]["pre_value"] === "Approve Request") {
                                if ($result) {
                                    $html .= '<a href="javascript:void(0);" title="Unfollow"  style=" border: 1px solid #ccc; padding: 5px 18px;" onclick="request_approve(this.id);" class="approve_btn" id="' . $data["noti_details"][$i]["user_id"] . '"> Unfollow <i class="fa fa-close"></i></a>';
                                } else {
//                                    $html .= '<a href="javascript:void(0);" title="Follow"  style=" border: 1px solid #ccc; padding: 5px 18px;" onclick="request_approve(this.id);" class="approve_btn" id="' . $data["noti_details"][$i]["user_id"] . '">Follow <i class="fa fa-check"></i></a>';
                                }
                            } else {
                                if ($data["noti_details"][$j]["pre_value"] === "Followed you" || $data["noti_details"][$j]["pre_value"] === "Accept Request") {
                                    
                                } else if (empty($data["noti_details"][$j]["leagueimage_maintitle"])) {
                                    $html .= $data["noti_details"][$j]["leagueimage_name"];
                                } else {
                                    $html .= $data["noti_details"][$j]["leagueimage_maintitle"];
                                }
                            }
                        } else {
                            if ($data["noti_details"][$j]["pre_value"] === "Approve Request") {
                                if ($result) {
                                    $html .= '<a href="javascript:void(0);" title="Unfollow"  style=" border: 1px solid #ccc; padding: 5px 18px;" onclick="request_approve(this.id);" class="approve_btn" id="' . $data["noti_details"][$i]["user_id"] . '"> Unfollow <i class="fa fa-close"></i></a>';
                                } else {
                                    $html .= '<a href="javascript:void(0);" title="Follow"  style=" border: 1px solid #ccc; padding: 5px 18px;" onclick="request_approve(this.id);" class="approve_btn" id="' . $data["noti_details"][$i]["user_id"] . '">Follow <i class="fa fa-check"></i></a>';
                                }
                            } else {
                                if ($data["noti_details"][$j]["pre_value"] === "Followed you" || $data["noti_details"][$j]["pre_value"] === "Accept Request") {
                                    
                                } else if (empty($data["noti_details"][$j]["leagueimage_name"])) {
                                    $html .= 'Not Avalialbe';
                                } else {
                                    $html .= $data["noti_details"][$j]["leagueimage_name"];
                                }
                            }
                        }

                        $html .='</span>
                                        <span>' . date("h:i A", strtotime($data["noti_details"][$j]["noti_timestamp"])) . '</span>
                                     </div>
                              </div>';
                    }
                }
                $html .= '<hr/>';
            }
            $html .='</div>';


            $data['list_noti'] = $html;
            $data['username'] = $this->session->userdata('uname');
            $data['userid'] = $this->session->userdata('user_id');

            $data["side_link"] = $this->hm->get_all_sidelinksside();
            $data["side_linkss"] = $this->hm->get_all_sidelinksnoside();
            $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
            $data["new_post"] = $this->hm->get_new_post();
            $data["new_discussion"] = $this->hm->get_let_discussion();
            $data["new_like"] = $this->hm->get_newlike();
            $data['content'] = $this->load->view('notification', $data, TRUE);
            load_public_template($data);
        }
    }

    function noti_modal() {
        $noti_userid = $this->session->userdata('user_id');
        $data['noti_detail'] = $this->usermod->getNotificationDetail($noti_userid);

        $dataArray = array(
            'status' => "read"
        );
        echo $this->load->view('notification-view', $data, TRUE);
        $this->usermod->update_notification($dataArray, $noti_userid);
    }

    function request_approve() {
        $user_id = $this->session->userdata('user_id');
        if ($user_id != '') {
            $follow = $this->input->post("str");

//            $data['userdetail'] = $this->usermod->userProfile_detail($follow);
            $result = $this->usermod->follow_check($follow, $user_id);


            if ($result) {
                $follow_status = $result['follow_status'];
                $follow_id = $result['follow_id'];
                $following_id = $result['user_id'];
                if ($follow_status == '1') {
                    $this->usermod->removeFollow($follow_id, $following_id);
                    echo json_encode(array('status' => 'unfollow'));
                    exit;
                } else {

                    $followArray = array(
                        'follow_status' => '1'
                    );
                    $this->usermod->updateFollowStatus($followArray, $follow);
                    $notificationArray = array(
                        'user_id' => $follow,
                        'other_user_id' => $user_id,
                        'leagueimage_id' => 1,
                        'pre_value' => 'Accept Request',
                        'noti_date' => date("Y-m-d"),
                    );
                    $this->usermod->add_notification($notificationArray);
                    echo json_encode(array('status' => 'follow'));
                    exit;
                }
            } else {

                $dataArray = array(
                    'user_id' => $follow,
                    'following_id' => $user_id,
                    'follow_status' => '1'
                );
                $this->usermod->add_follower($dataArray);
                $notificationArray = array(
                    'user_id' => $follow,
                    'other_user_id' => $user_id,
                    'leagueimage_id' => 1,
                    'pre_value' => 'Accept Request',
                    'noti_date' => date("Y-m-d"),
                );
                $this->usermod->add_notification($notificationArray);
                echo json_encode(array('status' => 'follow'));
                exit;
            }
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

    function addNewComment() {

        $allComment = $this->input->post('ftypeunique');
        if (isset($allComment) && !empty($allComment)) {
            if (isset($_FILES['userfile']['name'])) {
                $filecheck = basename($_FILES['userfile']['name']);
                $ext = substr($filecheck, strrpos($filecheck, '.'));
                $new_filename = random_string('numeric', 7) . $ext;

                $config['upload_path'] = 'uploads/comment_picture/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['file_name'] = $new_filename;

                $this->load->library('upload', $config);
                $img = 'userfile';

                if ($this->upload->do_upload($img)) {
                    $filename = $new_filename;
                } else {
                    $filename = '';
                }
            } else {
                $filename = '';
            }

            $cmtdate = date('Y-m-d H:i:s');
            $ins_comment = array(
                'user_id' => $this->input->post('user_id'),
                'leagueimage_id' => $this->input->post('leaguid'),
                'parent_id' => $this->input->post('parent'),
                'comment' => $this->input->post('cmt'),
                'comment_date' => $cmtdate,
                'le_comment_image' => $filename
            );

            $allComment = array(
                'user_id' => $this->input->post('user_id'),
                'leaguid' => $this->input->post('leaguid'),
                'parent' => $this->input->post('parent'),
                'cmt' => $this->input->post('cmt'),
                'filename' => $filename,
            );
        } else {
            $allComment = $this->input->post('cmtData');
            $cmtdate = date('Y-m-d H:i:s');
            $ins_comment = array(
                'user_id' => $allComment['user_id'],
                'leagueimage_id' => $allComment['leaguid'],
                'parent_id' => $allComment['parent'],
                'comment' => $allComment['cmt'],
                'comment_date' => $cmtdate,
            );
        }


        $insertid = $this->hm->add_comment($ins_comment);

        $data['user_upload'] = $this->usermod->getUserNotificationDetail($allComment['leaguid']);
        $other_id = $data['user_upload'][0]['leagueimage_userid'];

        $notificationArray = array(
            'le_comment_id' => $insertid,
            'user_id' => $other_id,
            'other_user_id' => $this->session->userdata('user_id'),
            'leagueimage_id' => $allComment['leaguid'],
            'pre_value' => 'Comment on your post',
            'noti_date' => date("Y-m-d"),
        );

        if ($other_id !== $this->session->userdata('user_id')) {
            $this->usermod->add_notification($notificationArray);
        }


        $getuserdata = $this->hm->getuserdata($allComment['user_id']);
        $data['userdata'] = $allComment;
        $data['useralldata'] = $getuserdata;
        $data['comment_date'] = $cmtdate;
        $data['lastid'] = $insertid;
        echo $this->load->view('addcomment', $data, true);
    }

    function show_all_post($user_id = '') {
        $data['userdetail'] = $this->usermod->userOtherProfile_detail($user_id);
        $data['user_post_list'] = $this->usermod->user_post_list($data['userdetail']['user_id']);
        $data['username'] = $this->session->userdata('uname');
        $data["side_link"] = $this->hm->get_all_sidelinksside();
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside();
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
        $data["new_post"] = $this->hm->get_new_post();
        $data["new_discussion"] = $this->hm->get_let_discussion();
        $data["new_like"] = $this->hm->get_newlike();
        $data['content'] = $this->load->view('show_all_post', $data, TRUE);
        load_public_template($data);
    }

    function user_review_list($user_id = '') {

        $data["new_post"] = $this->hm->get_new_post();
        $data["new_discussion"] = $this->hm->get_let_discussion();
        $data["new_like"] = $this->hm->get_newlike();
        $data['userdetail'] = $this->usermod->userProfile_detail($user_id);
        $data["total_review"] = $this->usermod->get_user_allReview($user_id);
        $data['username'] = $this->session->userdata('uname');
        $data['content'] = $this->load->view('user_review_list', $data, TRUE);
        load_public_template($data);
    }

/////////////////////////////////////////// old data ///////////////


    function forgot_check() {
        $email = $this->input->post("email_id");
        $result = $this->usermod->email_check($email);
        if (count($result) == 0) {
            $str = 'Email id doesnt exists..';
        } else {
            $str = "";
        }
        echo $str;
    }

    function request_password() {
        if ($this->input->post('submit')) {

            $curtime = time();
            $arg = $this->input->post('Email');
            $encrypted_string = base64_encode($arg);

            $from = 'admin@gmail.com';
            $name = 'Admin';
            $to = $this->input->post('Email');
            $subject = 'Password Request to leaguememe.com';

            $message = '<table style="width:50%; font-family:Verdana, Geneva, sans-serif;border:1px solid #cc0000; margin:0 auto;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;padding:20px" cellspacing="0">
                <tr><td style="text-align:center"><img src="' . base_url() . 'img/yannikulogo.jpg" alt=""></td></tr>
            <tr><td style="font-size:13px;color:#000;font-weight:bold">Dear User, </td></tr>
            <tr><td style="font-size:13px;color:#000;padding:10px 0 0 0">You have requested for a password change.  </td></tr>
             <tr><td height="10px"></td></tr>
             <tr><td style="text-align:center;background-color:#cc0000;color:#FFF;padding: 13px 0;"><a href="' . base_url() . 'users/users/actv_link_pass/' . $encrypted_string . '/' . $curtime . '" style="color:#FFF;text-decoration:none;">Click here to change password.</a></td></tr>
             <tr><td style="background-color:#ececec;font-size: 13px;padding: 10px 0;text-align: center;">If you have any question, please <a href="' . base_url() . '">contact us</a><br>Yanikuu Team</td></tr>
        </table>';

            $this->send_mail($from, $name, $to, $subject, $message);
            $this->session->set_flashdata('message', 'password reset link has been sent to your registered Email Id.');
            $this->load->view('password_request');
        } else {
            $this->load->view('password_request');
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

    function checkUserLoginOrNot() {
        if ($this->session->userdata('user_id') != "") {
            echo $this->session->userdata('user_id');
        } else {
            echo "offline";
        }
    }

    public function set_user_mail() {

        if (!empty($_POST['username'])) {
            $username = $this->input->post('username');
        } else {
            $username = $this->input->post('old_username');
        }
        if (!empty($_POST['email'])) {
            $email = $this->input->post('email');
        } else {
            $email = $this->input->post('old_email');
        }

        $dataArr = array(
            'user_name' => $username,
            'user_email' => $email,
        );

        $user_id = $this->session->userdata('user_id');

        $this->usermod->update_username_email($user_id, $dataArr);
        $data = array('result' => 'ok', 'msg' => 'Update Successfully  ');
        echo json_encode($data);
        die;
    }

    public function update_biodata() {
        $description = $this->input->post('description');
        $dataArr = array(
            'bio' => $description,
        );
        $user_id = $this->session->userdata('user_id');
        echo $this->usermod->update_bio($user_id, $dataArr);
    }

    public function save_summoner() {
        $champ = isset($_POST['fav_champ']) ? implode(",", $_POST['fav_champ']) : "";
//        $champ = $_POST['fav_champ'];
        $role = isset($_POST['fav_role']) ? implode(",", $_POST['fav_role']) : "";
        $userId = $this->session->userdata('user_id');

        $data = array(
            "name" => $this->input->post('name'),
            "server" => $this->input->post('server'),
            "level" => $this->input->post('label'),
            "tier" => $this->input->post('tier'),
            "div" => $this->input->post('division'),
            "fav_champ" => $champ,
            "role" => $role,
            "sum_img" => $this->input->post('summoner-image'),
            "created" => time()
        );

        if ($this->usermod->summonerExist($userId)) {

            echo $this->usermod->updateSummoner($userId, $data);
        } else {

            $data['user_id'] = $userId;
            echo $this->usermod->saveSummoner($data);
        }
    }

    function uploadBioImg() {
        $accepted_origins = array("http://localhost", "http://leaguememe.com");

        $imageFolder = "uploads/user-bio-img/";

        reset($_FILES);
        $temp = current($_FILES);
        if (is_uploaded_file($temp['tmp_name'])) {
            if (isset($_SERVER['HTTP_ORIGIN'])) {
                // same-origin requests won't set an origin. If the origin is set, it must be valid.
                if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
                    header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
                } else {
                    header("HTTP/1.0 403 Origin Denied");
                    return;
                }
            }

            // Sanitize input
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.0 500 Invalid file name.");
                return;
            }

            // Verify extension
            if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
                header("HTTP/1.0 500 Invalid extension.");
                return;
            }

            // Accept upload if there was no origin, or if it is an accepted origin
            $filetowrite = $imageFolder . $temp['name'];
            move_uploaded_file($temp['tmp_name'], $filetowrite);

            echo json_encode(array('location' => base_url() . $filetowrite));
        } else {
            // Notify editor that the upload failed
            header("HTTP/1.0 500 Server Error");
        }
    }

}
