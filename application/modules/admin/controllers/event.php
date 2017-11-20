<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model("event_model", "em");
        $this->load->model('league_model', 'leaguemod');
        $this->load->model('admin_model', 'admin');
        $this->load->model('users_model', 'usermod');
        $this->load->model('category_model', 'category'); 
        $this->load->library('email');
        $this->load->library("pagination");
    }

    function add_event() {
        if ($this->session->userdata('logged_in')) {
            $data['left'] = "<a href='add_event'>Event</a>  &nbsp;>&nbsp; Add Event";
            $data['content_header'] = "Event";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();
            $data['category_list'] = $this->category->getAllCategory();
            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();
            $data['content'] = $this->load->view('add_event', $data, TRUE);
            load_admin_template($data);
        } else {
            $this->load->view('admin/login');
        }
    }

    public function create_event() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('start_date', 'Event start date', 'required');
        $this->form_validation->set_rules('end_date', 'Event end date', 'required');
        $this->form_validation->set_rules('desc', 'Event Description', 'required|min_length[3]');
        if (isset($_POST['private'])) {
            $this->form_validation->set_rules('password', 'Event password', 'required|min_length[6]|max_length[16]');
        }
        if (empty($_POST['join_limit'])) {
            $join_limit = 100;
        } else {
            $join_limit = trim($this->input->post("join_limit"), " ");
        }
        if ($this->form_validation->run() == FALSE) {
            $response = json_encode(array("status" => false, "msg" => validation_errors()));
        } else {
            if ($_POST['type'] == 0) {
                $config['upload_path'] = 'uploads/event_original/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
//                $config['max_size'] = 1024;
                $config['max_width'] = 600;
                $config['max_height'] = 400;
                $config['file_name'] = time() . $this->input->post("title");

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('event_file')) {
                    $response = json_encode(array("status" => false, 'msg' => $this->upload->display_errors()));
                } else {
                    
                    $name = $_FILES["event_file"]["name"];
                    $ext = pathinfo($name, PATHINFO_EXTENSION);

                    $image_temp = $_FILES['event_file']['tmp_name'];
                    $image_size_info = getimagesize($image_temp);
                    $image_type = $image_size_info['mime'];

                    $new_file_name = time() . $this->input->post("title") . "." . $ext;

                    if ($image_type == 'image/jpeg' || $image_type == 'image/pjpeg') {
                        $image = imagecreatefromjpeg($image_temp);
                        $image_path = getcwd() . "/uploads/event/$new_file_name";
                        imagejpeg($image, $image_path, 80);
                    } elseif ($image_type == 'image/png') {
                        $image = imagecreatefrompng($image_temp);
                        $image_path = getcwd() . "/uploads/event/$new_file_name";
                        imagepng($image, $image_path);
                    } else {
                        $config_oth['upload_path'] = "./uploads/event";
                        $config_oth['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config_oth['file_name'] = $new_file_name;
                        $config_oth['max_size'] = '0';
                        $config_oth['overwrite'] = FALSE;
                        $this->load->library('upload', $config_oth);
                        $this->upload->initialize($config_oth);
                        $this->upload->do_upload('event_file');
                    }
                    
                    $imageData = array('upload_data' => $this->upload->data());
                    $private = isset($_POST['private']) ? 1 : 0;

                    $data = array(
                        "title" => $this->input->post("title"),
                        "start_date" => strtotime($this->input->post("start_date")),
                        "end_date" => strtotime($this->input->post("end_date")),
                        "descr" => $this->input->post("desc"),
                        "join_limit" => $join_limit,
                        "private" => $private,
                        "password" => $this->input->post("password"),
                        "image" => $imageData['upload_data']['file_name'],
                        "user_id" => "0",
                        "created" => time(),
                        "updated" => time()
                    );

                    if ($this->em->save($data))
                        $response = json_encode(array("status" => true));
                    else
                        $response = json_encode(array("status" => false, "msg" => "Unknown error. Please try again later."));
                }
            } else {
                $private = isset($_POST['private']) ? 1 : 0;
                $data = array(
                    "title" => $this->input->post("title"),
                    "start_date" => strtotime($this->input->post("start_date")),
                    "end_date" => strtotime($this->input->post("end_date")),
                    "descr" => $this->input->post("desc"),
                    "join_limit" => $join_limit,
                    "private" => $private,
                    "password" => $this->input->post("password"),
                    "image" => $this->input->post("event_file"),
                    "user_id" => "0",
                    "created" => time(),
                    "updated" => time()
                );
                if ($this->em->update($data, $_POST['type']))
                    $response = json_encode(array("status" => true));
                else
                    $response = json_encode(array("status" => false, "msg" => "Unknown error. Please try again later."));
            }
        }
        echo $response;
    }

    function list_event() {
        if ($this->session->userdata('logged_in')) {
            $data['left'] = "<a href='" . base_url() . "list_event'>Event</a> &nbsp;>&nbsp; Event List";
            $data['content_header'] = "Event";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();
            $data['content'] = $this->load->view('list_event', $data, TRUE);
            load_admin_template($data);
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

    function event_list_ajax() {
        $this->em->event_list_request();
    }

    function delete_event() {
        $event_id = $this->input->post('event_id');
        $this->em->delete_event($event_id);
        $this->session->set_flashdata('message', 'Event  deleted successfully');
    }

    function edit_event($event_id) {
        if ($this->session->userdata('logged_in')) {
            $data['left'] = "<a href='" . base_url() . "list_league'>League</a> &nbsp;>&nbsp; League_list";
            $data['content_header'] = "Event";
            $data['users'] = $this->admin->getUsers();
            $data['league'] = $this->admin->getAllLeagueImages();

            $data['count_meme'] = $this->leaguemod->count_inactive_league();
            $data['count_new_user'] = $this->admin->count_new_user();
            $data['count_pending_credit_status'] = $this->leaguemod->count_pending_credit_status();
            $data['event_data'] = $this->em->getEventDetail($event_id);
            $data['content'] = $this->load->view('add_event', $data, TRUE);
            load_admin_template($data);
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

    function select_winner($event_id) {
        if ($this->session->userdata('logged_in')) {
            $data['join_user'] = $this->em->getJoinUser($event_id);
            $data['event_id'] = $event_id;
            echo $this->load->view('select_event_winner', $data, TRUE);
        } else {
            $data['content'] = $this->load->view('login', '', TRUE);
            load_admin_template($data);
        }
    }

    public function claimwinner() {
        $eventId = $this->input->post("event_id");
        if ($this->session->userdata('logged_in')) {
            if ($this->em->winnerClainmed($eventId) == false) {
                $eventUsers = $this->em->getEventUsers($eventId);
                if (empty($eventUsers)) {
                    $this->session->set_flashdata('message', "Admin can't be winner");
                    exit;
                }
                $totalUser = count($eventUsers);
                $max = $totalUser - 1;
                $winnerKey = mt_rand(0, $max);
                $winner = $eventUsers[$winnerKey];
                $this->em->updateEventJoin($eventId, $winner->user_id, array("is_winner" => 1));

                if (empty($winner->name)) {
                    $winner = $winner->user_name;
                } else {
                    $winner = $winner->name;
                }
                $this->session->set_flashdata('message', $winner . ' is winner');
            } else {
                $this->session->set_flashdata('message', 'Winner alreay declared!');
            }
        } else {
            $this->session->set_flashdata('message', 'Event admin can only do this.');
        }
    }

}

?>
