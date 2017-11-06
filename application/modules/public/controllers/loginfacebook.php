<?php

class Loginfacebook extends CI_Controller {

    var $appId;
    var $appSecret;
    var $redirectUrl;

    function __construct() {
        parent::__construct();
        //Live
        //$this->appId = '913485652038167';
        // $this->appSecret = '35cc34040a9231da5fda78c81cfbec2e';
        //Mayur
        $this->appId = '1727081077607945';
        $this->appSecret = 'e6c9a2afffc0219efbe7de97a913a0dd';
        $this->redirectUrl = base_url().'public/loginfacebook/returnfb';
        $this->load->library('facebook', array(
            'appId' => $this->appId,
            'secret' => $this->appSecret,
            'cookie' => true
        ));
        $this->load->model('users_model', 'um');
        $this->load->model('home_model', 'hm');
        $this->load->library('email');
    }

    function index() {

        $url = 'https://www.facebook.com/dialog/oauth?client_id=' . $this->appId . '&redirect_uri=' . $this->redirectUrl . '&scope=public_profile,email';
        redirect($url);
    }

    function returnfb() {
        if (isset($_GET['code'])) {
        	//$this->facebook->clearAllPersistentData();
            try {
                $token_url = "https://graph.facebook.com/oauth/access_token?"
                        . "client_id=" . $this->appId . "&redirect_uri=" . urlencode($this->redirectUrl)
                        . "&client_secret=" . $this->appSecret . "&code=" . $_GET['code'];

                $response = file_get_contents($token_url);
                
                $params = null;
                parse_str($response, $params);
                $this->facebook->setAccessToken($params['access_token']);
                $fbuser = $this->facebook->api('/me?fields=email,id,name,picture');

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
            $data['msg'] = "You Are Banned !";
            $this->load->view('header');
            $this->load->view('login', $data);
        }
    }

    private function do_registration($user) {
        $uname = explode('@', $user['email']);
        $dataArr = array(
            'user_name' => $uname[0],
            'user_email' => $user['email'],
            'user_password' => md5(random_string('alnum', 8)),
            'user_region' => 'NA',
            'user_status' => 'A',
            'user_image' => 'graph.facebook.com/' . $user['id'] . '/picture'
        );
        $result = $this->um->addUser($dataArr);
        if (isset($result) AND !empty($result)) {
            $this->session->set_userdata('uname', $dataArr['user_name']);
            $this->session->set_userdata('user_name', $dataArr['user_name']);

            $this->session->set_userdata('user_id', $result);
            $sess_user_array = array();

            $dataArr = array('online_status' => 'online');
           $this->um->updateUserByEmail($uname[0], $dataArr);
        }
//            $config['protocol'] = 'mail';
//            $config['mailpath'] = '/usr/sbin/sendmail';
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
//            $html = '<table style="width:100%; font-family:Verdana, Geneva, sans-serif;text-align:left;border:0px" cellspacing="0">
//			<tbody>
//			<tr><td style="font-size:14px;padding:10px 0;color:#000;">Dear ' . $this->input->post('fullname') . ',</td></tr>
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
