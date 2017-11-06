<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event extends MX_Controller {

    var $logUserId;
    var $authenticatedEvents = array();

    function __construct() {

        parent::__construct();
        $this->load->model("event_model", "em");
        $this->load->model("comment_model", "cm");
        $this->logUserId = $this->session->userdata('user_id');
        $this->cm->module = 'event';
//        $this->session->set_userdata('authevents', array());
        $this->authenticatedEvents = $this->session->userdata('authevents');
        $this->load->helper('text');
        $this->load->model('users_model', 'usermod');
         $this->load->model('home_model', 'hm');
          $this->load->model('league_model', 'leaguemod');
          
    }

//    public function index() {
//        $events = $this->em->getEventWithMembersCount(true);
//
//        echo $this->load->view("event/list", array("events" => $events, "loginUser" => $this->logUserId, "auth_events" => $this->authenticatedEvents), true);
//    }

    public function index() {
        $get_total_rows = 0;
        $items_per_group = 8;
        $start = 0;

        $events_count = $this->em->getEventWithMembersCount(true);
        $count_event = count($events_count);

        $data['total_row'] = $count_event;
        $data['total_groups'] = ceil($count_event / $items_per_group);

        $includePrivate = true;
        $events = $this->em->getAllEventWithMembersCount($includePrivate, $items_per_group, $start);
        $data['getTabposition'] = $this->leaguemod->getTabs(); 
        echo $this->load->view("event/list", array("events" => $events, "loginUser" => $this->logUserId, "auth_events" => $this->authenticatedEvents), $data, true);
    }

    public function mainevent($event = 0) {
        $maintabval = $this->input->post('mainTabval');
        $subtabval = $this->input->post('subTabval');
        $eventtrack = $this->input->post('eventtrack');

        $items_per_group = 8;
        $events_count = $this->em->getEventWithMembersCount(true);
        $count_event = count($events_count);
        $data['total_groups'] = ceil($count_event / $items_per_group);


        $Session = $this->session->userdata('user_id');
        $data['eventtrack'] = $eventtrack;
        $data['orderid'] = $event;
        $data['maintabval'] = $maintabval;
        $data['subtabval'] = $subtabval;
        $data['userdetail'] = $this->userdetail();
        $data['username'] = $this->session->userdata('uname');
        $data['userid'] = $this->session->userdata('user_id');
        $data["side_link"] = $this->hm->get_all_sidelinksside($event, $maintabval);
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside($event, $maintabval);
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
        $data["new_post"] = $this->hm->get_new_post();
        $data["active_menu"] = "event";
        $data["new_discussion"] = $this->hm->get_let_discussion();
        $data["new_like"] = $this->hm->get_newlike();
 $data['getTabposition'] = $this->leaguemod->getTabs(); 
        $data['content'] = $this->load->view('event/index', $data, TRUE);
        load_public_template($data);
    }

    function event_scroll_data() {
        $get_total_rows = 0;
        $items_per_group = 8;
        $group_number = $this->input->post('group_no');

        $position = ($group_number * $items_per_group);
        $includePrivate = true;

        $events = $this->em->getAllEventWithMembersCount($includePrivate, $items_per_group, $position);

        if ($this->session->userdata('user_id')) {
            $data['userid'] = $this->session->userdata('user_id');
        }

        $events_count = $this->em->getEventWithMembersCount(true);

        echo $this->load->view("event/list", array("events" => $events, "loginUser" => $this->logUserId, "auth_events" => $this->authenticatedEvents), true);
    }

    function userdetail() {
        $session = $this->session->userdata('user_id');
        return $profile = $this->usermod->userProfile_detail($session);
    }

    public function form() {
        echo $this->load->view("event/form");
    }

    public function auth() {
        $event = $this->em->getEventInfo($_POST['ei']);
        if (strlen($_POST['pwd']) > 0) {
            if ($this->authenticatedEvents == false OR ! in_array($_POST['ei'], $this->authenticatedEvents)) {
                if ($event->password === $_POST['pwd']) {
                    $this->authenticatedEvents[] = $_POST['ei'];
                    $this->session->set_userdata('authevents', $this->authenticatedEvents);
                    echo json_encode(array("status" => true));
                } else {
                    echo json_encode(array("status" => false, "msg" => "Invalid password"));
                }
            } else {
                echo json_encode(array("status" => true));
            }
        } else {
            echo json_encode(array("status" => false, "msg" => "Password field can not be empty"));
        }
    }

    public function join() {
        $user_id = $this->session->userdata('user_id');
        $eventId = $this->input->post("id");
        if ($user_id == '') {
            $response = array("status" => false, "msg" => "Please login");
        } else if ($this->em->isJoined($eventId, $this->logUserId) == false) {
            $event = $this->em->getEventInfo($eventId);
            $id = $this->em->joinEvent($eventId, $this->logUserId, 0);
            $response = array("status" => true, "msg" => "Joined");
        } else {
            $response = array("status" => false, "msg" => "Already joined");
        }

        echo json_encode($response);
    }

    public function create() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('start_date', 'Event start date', 'required');
        $this->form_validation->set_rules('end_date', 'Event end date', 'required');
        $this->form_validation->set_rules('desc', 'Event Description', 'required|min_length[3]');
        if (isset($_POST['private'])) {
            $this->form_validation->set_rules('password', 'Event password', 'required|min_length[6]|max_length[16]');
        }
        if ($this->form_validation->run() == FALSE) {
            $response = json_encode(array("status" => false, "msg" => validation_errors()));
        } else {
            $config['upload_path'] = 'uploads/event/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 1024;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;
            $config['file_name'] = time() . $this->input->post("title");

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('event_file')) {
                $response = json_encode(array("status" => false, 'msg' => $this->upload->display_errors()));
            } else {
                $imageData = array('upload_data' => $this->upload->data());
                $private = isset($_POST['private']) ? 1 : 0;

                $data = array(
                    "title" => $this->input->post("title"),
                    "start_date" => strtotime($this->input->post("start_date")),
                    "end_date" => strtotime($this->input->post("end_date")),
                    "descr" => $this->input->post("desc"),
                    "private" => $private,
                    "password" => $this->input->post("password"),
                    "image" => $imageData['upload_data']['file_name'],
                    "user_id" => $this->logUserId,
                    "created" => time(),
                    "updated" => time()
                );
                if ($this->em->save($data))
                    $response = json_encode(array("status" => true));
                else
                    $response = json_encode(array("status" => false, "msg" => "Unknown error. Please try again later."));
            }
        }
        echo $response;
    }

    public function detail($id) {
        $this->load->model('home_model', 'hm');
        $this->load->model('users_model', 'usermod');
        $this->load->model('league_model', 'leaguemod');
        $data['event_info'] = $this->em->getEventInfo($id);
        $data['num_comments'] = $this->cm->getCountParentComments($id);
        $data['event_users'] = $this->em->getEventUsers($id);
        $data['userdetail'] = $this->usermod->userProfile_detail($this->logUserId);
        $data["side_links"] = $this->hm->get_all_sidelinksside();
        $data['username'] = $this->session->userdata('uname');
        $requiredLogin = false;

        if ($data['event_info']->private) {
            if ($this->authenticatedEvents == false OR ! in_array($id, $this->authenticatedEvents)) {
                $requiredLogin = true;
            }
        }
        $data['required_login'] = $requiredLogin;
        $data['content'] = $this->load->view('event/detail', $data, TRUE);
        load_public_template($data);
    }

    public function claimwinner() {
        $eventId = $this->input->post("id");
        if ($this->em->isEventAdmin($eventId, $this->logUserId)) {
            if ($this->em->winnerClainmed($eventId) == false) {
                $eventUsers = $this->em->getEventUsers($eventId);
                $totalUser = count($eventUsers);
                $max = $totalUser - 1;
                $winnerKey = mt_rand(0, $max);
                $winner = $eventUsers[$winnerKey];

                $this->em->updateEventJoin($eventId, $winner->user_id, array("is_winner" => 1));
                echo json_encode(array("status" => true, "user" => $winner));
            } else {
                echo json_encode(array("status" => false, "msg" => "Winner alreay declared!"));
            }
        } else {
            echo json_encode(array("status" => false, "msg" => "Event admin can only do this."));
        }
    }

}
