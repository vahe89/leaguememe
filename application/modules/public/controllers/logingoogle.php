<?php

class Logingoogle extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('google');
        $this->load->model('users_model', 'um');
        $this->load->model('home_model', 'hm');
        $this->load->library('email');
         $this->google->setApplicationName('Login to leaguememe.com');
            $this->google->setClientId('649334031550-iur9uanfkkahr86vsql0dtsah69dagsd.apps.googleusercontent.com');
            $this->google->setClientSecret('PWHvWrkU2OQF3dQLuFgpOV4C');
            $this->google->setRedirectUri(base_url().'public/logingoogle/googleBack');
            //$this->google->setDeveloperKey('AIzaSyCH8GMufQPLR0gGmr1uHtMRdeS9G00y_24');
            $this->google->setScopes('email');
    }

    function index() {
        try {
            $authUrl = $this->google->createAuthUrl();
            redirect($authUrl);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    function googleBack() {
        if (isset($_GET['code'])) {
            try {
            	if(isset($_SESSION['token']) AND !empty($_SESSION['token'])){
                    $this->google->setAccessToken($_SESSION['token']);
                }
                else{
                    $this->google->authenticate($_GET['code']);
                    $_SESSION['token'] = $this->google->getAccessToken();
                    
//                    echo $_SESSION['token'];
//                    exit();
                }
                
                $google_oauthV2 = new Google_Oauth2Service($this->google);
                $user = $google_oauthV2->userinfo->get();
               
                if(!empty($user['email'])){
                     
                   $res = $this->um->email_check($user['email']);
                   if(!empty($res)){
                      
                       $this->do_login($res);
                       
                   }
                   else{
                       
                       $this->do_registration($user);
                   }
                }
               
//               $this->oauth->userinfo->get();
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }
        }
        else {
            redirect(base_url());
        }
    }
    private function do_login($user){
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
    private function do_registration($user){
        $uname = explode('@', $user['email']);
        $dataArr = array(
            'user_name' => $uname[0],
            'user_email' => $user['email'],
            'user_password' => md5(random_string('alnum', 8)),
            'user_region' => 'NA',
            'user_status' => 'A',
            'user_image' => $user['picture']
        );
        $result = $this->um->addUser($dataArr);
        if (isset($result)) {
            $this->session->set_userdata('uname', $dataArr['user_name']);
            $this->session->set_userdata('user_name', $dataArr['user_name']);

            $this->session->set_userdata('user_id', $result);
            $sess_user_array = array();

            $dataArr = array('online_status' => 'online');
            $this->um->updateUserByEmail($uname[0], $dataArr);
        }
//        $config['protocol'] = 'mail';
//        $config['mailpath'] = '/usr/sbin/sendmail';
//        $config['charset'] = 'iso-8859-1';
//        $config['wordwrap'] = TRUE;
//        $config['mailtype'] = 'html';
//        $this->email->initialize($config);
//        $activate_link = base_url() . 'home/Acccount_activation/' . base64_encode($result) . '/' . base64_encode($this->input->post('uname'));
//        //$this->email->from($this->input->post('cnt_email'), $this->input->post('cnt_name'));
//        $this->email->from('register@leaguememe.com');
//        $this->email->to($user['email']);
//        $this->email->subject('League Meme - Confirmation Mail');
//        $html = '<table style="width:100%; font-family:Verdana, Geneva, sans-serif;text-align:left;border:0px" cellspacing="0">
//			<tbody>
//			<tr><td style="font-size:14px;padding:10px 0;color:#000;">Hi ' . $this->input->post('uname') . ',</td></tr>
//			<tr><td style="font-size:14px;padding:10px 0;color:#000;">Thank you for registering League Meme.</td></tr>
//			<tr><td style="font-size:14px;padding:10px 0;color:#000;">Please click on the link <a href="' . $activate_link . '" style="color:#C27613;font-weight:bold">Activate Account</a></td></tr>
//			<tr><td style="font-size:14px;padding:10px 0;color:#000">Thank you</td></tr>
//			<tr><td style="font-size:14px;padding:10px 0;color:#000">Team League Meme</td></tr>
//			</tbody>
//			</table>';
//        $this->email->message($html);
//        $this->email->send();
//        $this->session->set_flashdata('message', 'User registered successfully. Please check Mail to activate your account. In case you have not received it in your inbox, please check your spam folder.');
        redirect(base_url());
    }
}
    