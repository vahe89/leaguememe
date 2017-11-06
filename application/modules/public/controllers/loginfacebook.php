<?php

require_once getcwd() . '/application/libraries/fb-sdk/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;

class Loginfacebook extends CI_Controller {

    var $appId;
    var $appSecret;
    var $redirectUrl;
    var $helper;

    function __construct() {
        parent::__construct();
        //Live
        //$this->appId = '913485652038167';
        // $this->appSecret = '35cc34040a9231da5fda78c81cfbec2e';
        //Mayur
        $this->appId = '1727081077607945';
        $this->appSecret = 'e6c9a2afffc0219efbe7de97a913a0dd';
        $this->redirectUrl = base_url() . 'public/loginfacebook/returnfb';
        $this->load->library('facebook', array(
            'appId' => $this->appId,
            'secret' => $this->appSecret,
            'cookie' => true
        ));
        $this->load->model('users_model', 'um');
        $this->load->model('home_model', 'hm');
        $this->load->library('email');
        FacebookSession::setDefaultApplication('1727081077607945', 'e6c9a2afffc0219efbe7de97a913a0dd');
        $this->helper = new FacebookRedirectLoginHelper($this->redirectUrl);
    }

    function index() { 
        try {
            $session = $this->helper->getSessionFromRedirect();
        } catch (FacebookRequestException $ex) {
            // When Facebook returns an error
        } catch (Exception $ex) {
            // When validation fails or other local issues
        }
        if (isset($session)) {
            $this->returnfb();
        } else {
            $loginUrl = $this->helper->getLoginUrl();
            redirect($loginUrl);
        }
//        $url = 'https://www.facebook.com/dialog/oauth?client_id=' . $this->appId . '&redirect_uri=' . $this->redirectUrl . '&scope=public_profile,email';
//        redirect($url);
    }

    function save_session_username() {
        $user_name = $_POST['u_name'];
        $uname = $this->session->userdata('uname');
        $dataArr = array(
            'user_name' => $user_name,
        );
        $this->um->updateUserByEmail($uname, $dataArr);
        $this->session->set_userdata('tmp_usrname', $user_name);
        $this->session->set_userdata('uname', $user_name);
        $this->session->set_userdata('user_name', $user_name);
        $this->session->unset_userdata('modal_show');
    }

    function returnfb() {

        if (isset($_GET['code'])) {
            //$this->facebook->clearAllPersistentData();
            try {
                try {
                    $session = $this->helper->getSessionFromRedirect();
                } catch (FacebookRequestException $ex) {
                    // When Facebook returns an error
                } catch (Exception $ex) {
                    // When validation fails or other local issues
                }
                $fbuser = array();
                // graph api request for user data
                $request = new FacebookRequest($session, 'GET', '/me?fields=email,id,name,picture');
                $response = $request->execute();
                // get response
                $graphObject = $response->getGraphObject();
                $fbid = $graphObject->getProperty('id');              // To Get Facebook ID
                $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
                $femail = $graphObject->getProperty('email');    // To Get Facebook email ID
                /* ---- Session Variables ----- */
                $fbuser['fb_id'] = $fbid;
                $fbuser['full_name'] = $fbfullname;
                $fbuser['email'] = $femail;

                if (isset($fbuser['email'])) {

                    $res = $this->um->email_check($fbuser['email']);

                    if (!empty($res)) {

                        $this->do_login($res);
                    } else {

                        $this->do_registration($fbuser);
                    }
                }
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }
        } else {
            redirect(base_url());
        }
    }

    private function do_login($user) {

        $ban_status = $this->um->check_ban_status($user[0]->user_id);
        if ($ban_status) {
            $this->session->set_userdata('uname', $user[0]->user_name);
            $this->session->set_userdata('user_name', $user[0]->user_name);

            $this->session->set_userdata('user_id', $user[0]->user_id);
            $sess_user_array = array();

            $dataArr = array('online_status' => 'online');
            $this->um->updateUserByEmail($user[0]->user_name, $dataArr);
            //echo '1' ;
            redirect(base_url());
            //return $err ;
        } else {
            $data['msg'] = "You Are Banned!";
            $this->load->view('header');
            $this->load->view('login', $data
            );
        }
    }

    private function do_registration($user) {
        $this->session->set_userdata('modal_show');
        $uname = explode('@', $user['email']);

        $user_name = $uname[0];
        $id = $user['fb_id'];
        $unique_name = uniqid();
        $url = "https://graph.facebook.com/$id/picture?width=350&height=500";
        $data = file_get_contents($url);
        $fpath = getcwd() . '/uploads/users/' . $unique_name . '.jpg';
        $fp = fopen($fpath, "wb");
        fwrite($fp, $data);
        fclose($fp);
        chmod($fpath, 0777);
        $dataArr = array(
            'user_name' => $user_name,
            'user_email' => $user['email'],
            'user_password' => md5(random_string('alnum', 8)),
            'user_region' => 'NA',
            'user_status' => 'A',
            'user_image' => ''
//            'user_image' => $unique_name . '.jpg'
        );
        $result = $this->um->addUser($dataArr);
        $this->session->set_userdata('modal_show', '1');
        if (isset($result) AND ! empty($result)) {
            $this->session->set_userdata('uname', $dataArr['user_name']);
            $this->session->set_userdata('user_name', $dataArr['user_name']);

            $this->session->set_userdata('user_id', $result);

            $sess_user_array = array();

            $dataArr = array('online_status' => 'online');
            $this->um->updateUserByEmail($user_name, $dataArr);
        }
//            $config['protocol'] = 'mail';
//             $config['mailpath'] = '/usr/sbin/sendmail';
//            $config['charset'] = 'iso-8859-1';
//            $config['wordwrap'] = TRUE;
//            $config['mailtype'] = 'html';
//            $this->email->initialize($config);
//            $activate_link = base_url() . 'user/Acccount_activation/' . base64_encode($result);
        //$this->email->from($this->input->post('cnt_email'), $this->input->post('cnt_name'));
//            $this->email->from('register@leaguememe.com');
//            $this->email->from('info@skylineinfosys.com');
//            $this->email->to($this->input->post('email'));
//            $this->email->subject('League Meme - Confirmation Mail');
//            $html = '<table style = "width:100%;
//                font-family:Verdana, Geneva, sans-serif;
//                text-align:left;
//                border:0px" cellspacing = "0" >
////			<tbody>
//			<tr><td style="font-size:14px;
//                padding:10px 0;
//                color:#000;">Dear ' . $this->input->post('fullname') . ',</td></tr>
//			<tr><td style="font-size:14px;padding:10px 0;color:#000;">You recently entered a new email address for the user ' . $this->input->post('fullname') . '.</td></tr>
//			<tr><td style="font-size:14px;padding:10px 0;color:#000;">Please confirm your email by clicking the below link. </td></tr>
//			<tr><td style="font-size:14px;padding:10px 0;color:#000"><a href="' . $activate_link . '" style="color:#C27613;font-weight:bold">Activate Account</a></td></tr>
//			<tr><td style="font-size:14px;padding:10px 0;color:#000">Thank you</td></tr>
//			<tr><td style="font-size:14px;padding:10px 0;color:#000">Team League Meme</td></tr>
//			</tbody>
//			</table>';
//            $this->email->message($html);
//            $this->email->send();
//            $this->session->set_flashdata('message', 'User registered successfully. Please check Mail to activate your account. In case you have not received it in your inbox, please check your spam folder.');
//                     
        redirect(base_url());
    }

}
