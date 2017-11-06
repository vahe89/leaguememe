<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Poll extends MX_Controller {

    function __construct() {

        parent::__construct();


        $this->load->model('users_model', 'usermod');
        $this->load->model('league_model', 'leaguemod');
        $this->load->model('anime_model', 'animemod');
        $this->load->model('poll_model', 'poll');

        $this->load->model('home_model', 'hm');

        $this->load->helper('template');
        $this->load->library('upload');
    }

    function userdetail() {
        $session = $this->session->userdata('user_id');
        return $profile = $this->usermod->userProfile_detail($session);
    }

    public function poll_question($poll_id = '') {
        $Session = $this->session->userdata('user_id');

        $data['result'] = $this->poll->single_poll_list($poll_id);
//        echo '<pre>';
//        print_r($data);
//        exit;
        $data['userdetail'] = $this->userdetail();
        $data['username'] = $this->session->userdata('uname');
        $data['userid'] = $this->session->userdata('user_id');
 $data["side_link"] = $this->hm->get_all_sidelinksside();
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside();
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);

        $data['content'] = $this->load->view('poll_question', $data, TRUE);
        load_public_template($data);
    }

    function poll_victory() {
        $user_id = $this->session->userdata('user_id');
        if ($user_id != '') {
            $poll_id = $this->input->post("victory");
            $result = $this->poll->poll_points($user_id, $poll_id);
            //print_r($result);

            if ($result) {
                $point_status = $result['points'];
                $point_id = $result['point_id'];
                if ($point_status == 'L') {
                    $this->poll->removepolllikepoints($user_id, $poll_id);
                    echo json_encode(array('status' => 'delete'));
                    exit;
                } else {
                    $victoryArray = array(
                        'points' => 'L'
                    );
                    $this->poll->updatepollpoints($victoryArray, $point_id);
                    echo json_encode(array('status' => 'update'));
                    exit;
                }
            } else {
                $victoryArray = array(
                    'poll_id' => $poll_id,
                    'user_id' => $this->session->userdata('user_id'),
                    'points' => 'L',
                );
                $this->poll->add_poll_points($victoryArray);

                echo json_encode(array('status' => 'insert'));
                exit;
            }
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

    function poll_defeat() {
        $user_id = $this->session->userdata('user_id');
        if ($user_id != '') {
            if ($this->session->userdata('user_id')) {
                $poll_id = $this->input->post("defeat");
                $result = $this->poll->poll_points($user_id, $poll_id);
                if ($result) {
                    $point_status = $result['points'];
                    $point_id = $result['point_id'];
                    if ($point_status == 'D') {
                        $this->poll->removepolldislikepoints($user_id, $poll_id);
                        echo json_encode(array('status' => 'delete'));
                        exit;
                    } else {
                        $victoryArray = array(
                            'points' => 'D'
                        );
                        $this->poll->updatepollpoints($victoryArray, $point_id);

                        echo json_encode(array('status' => 'update'));
                        exit;
                    }
                } else {
                    $victoryArray = array(
                        'poll_id' => $poll_id,
                        'user_id' => $this->session->userdata('user_id'),
                        'points' => 'D',
                    );
                    $this->poll->add_poll_points($victoryArray);


                    echo json_encode(array('status' => 'insert'));
                    exit;
                }
            }
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

    function result_voting($poll_id = '') {
        $data['poll_vote'] = $this->poll->get_poll_vote($poll_id);
//        $data['poll_vote'] = $this->poll->get_vote($poll_id);
        $data['poll_ans'] = $this->poll->get_poll_answers($poll_id);

        $data['result_voting'] = $this->poll->get_poll_question($poll_id);

        $data['userdetail'] = $this->userdetail();
        $data['username'] = $this->session->userdata('uname');
        $data['userid'] = $this->session->userdata('user_id');
       $data["side_link"] = $this->hm->get_all_sidelinksside();
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside();
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
        $data['content'] = $this->load->view('result_voting', $data, TRUE);
        load_public_template($data);
    }

    function addNewComment() {
        $allComment = $this->input->post('cmtData');
        $cmtdate = date('Y-m-d H:i:s');
        $ins_comment = array(
            'user_id' => $allComment['user_id'],
            'poll_id' => $allComment['pollid'],
            'parent_id' => $allComment['parent'],
            'comment' => $allComment['cmt'],
            'comment_date' => $cmtdate,
        );
        $insertid = $this->poll->add_comment($ins_comment);

        $getuserdata = $this->hm->getuserdata($allComment['user_id']);
        $data['userdata'] = $allComment;
        $data['useralldata'] = $getuserdata;
        $data['comment_date'] = $cmtdate;
        $data['lastid'] = $insertid;

        echo $this->load->view('addcomment', $data, true);
    }

    function getCommentData() {
        $id = $this->input->post('cmtDATAid');
        $cmtdata = $data_side = $this->poll->getPollCommentData($id);

        $total_comment = 0;

        $data['return_array'] = array();
        foreach ($cmtdata as $cmt) {

            if ($cmt->parent_id == 0 && !isset($return_array[$cmt->comment_id])) {
                $return_array[$cmt->comment_id] = array();
                $return_array[$cmt->comment_id]['main_comment'] = $cmt;
                $return_array[$cmt->comment_id]['main_comment']->total_like = $this->poll->getCommentLikes($cmt->comment_id);
                $return_array[$cmt->comment_id]['main_comment']->total_dislike = $this->poll->getCommentDislikes($cmt->comment_id);
            } else if ($cmt->parent_id != 0) {
                $cmt->total_like = $this->poll->getCommentLikes($cmt->comment_id);
                $cmt->total_dislike = $this->poll->getCommentDislikes($cmt->comment_id);
                $return_array[$cmt->parent_id][] = $cmt;
            }
        }

        $new_array = array();
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
        $cmtdata = $data_side = $this->poll->getPollCommentFData($id);

        $data['return_array'] = array();
        foreach ($cmtdata as $cmt) {

            if ($cmt->parent_id == 0 && !isset($return_array[$cmt->comment_id])) {
                $return_array[$cmt->comment_id] = array();
                $return_array[$cmt->comment_id]['main_comment'] = $cmt;
                $return_array[$cmt->comment_id]['main_comment']->total_like = $this->poll->getCommentLikes($cmt->comment_id);
                $return_array[$cmt->comment_id]['main_comment']->total_dislike = $this->poll->getCommentDislikes($cmt->comment_id);
            } else if ($cmt->parent_id != 0) {
                $cmt->total_like = $this->poll->getCommentLikes($cmt->comment_id);
                $cmt->total_dislike = $this->poll->getCommentDislikes($cmt->comment_id);
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

    function pollcommentlikedislike() {

        $status = $this->input->post('status');
        $user_id = $this->input->post('user_id');
        $comment_id = $this->input->post('comment_id');
        $check = $this->poll->check_pollComment_like($user_id, $comment_id);

        if ($status == "dislike") {


            if (empty($check)) {
                $data = array(
                    'user_id' => $user_id,
                    'comment_id' => $comment_id,
                    'like' => 0
                );
                $query = $this->poll->pollCommentlike($data);
                if ($query) {
                    $result = array(
                        'like' => $this->poll->getCommentLikes($comment_id),
                        'dislike' => $this->poll->getCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/down-reply-hover.png" onmouseover="this.src =' . base_url() . 'assets/public/img/down-reply-hover.png">'
                    );
// echo json_encode($result);
                }
            } elseif ($check[0]->like == 0) {

                $query = $this->poll->delete_pollCommentlike($user_id, $comment_id);
                if ($query) {
                    $result = array(
                        'like' => $this->poll->getCommentLikes($comment_id),
                        'dislike' => $this->poll->getCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/down-reply.png" onmouseover="this.src =' . base_url() . 'assets/public/img/down-reply-hover.png">'
                    );
// echo json_encode($result);
                }
            } else {

                $data = array(
                    'like' => 0
                );
                $query = $this->poll->update_pollCommentlike($user_id, $comment_id, $data);
                if ($query) {
                    $result = array(
                        'like' => $this->poll->getCommentLikes($comment_id),
                        'dislike' => $this->poll->getCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/down-reply-hover.png" onmouseover="this.src =' . base_url() . 'assets/public/img/down-reply-hover.png">'
                    );
//  echo json_encode($result);
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
                $query = $this->poll->pollCommentlike($data);

                if ($query) {

                    $result = array(
                        'like' => $this->poll->getCommentLikes($comment_id),
                        'dislike' => $this->poll->getCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/up-reply-hover.png" onmouseover="this.src =' . base_url() . 'assets/public/img/up-reply-hover.png">'
                    );
// echo json_encode($result);
                }
            } elseif ($check[0]->like == 1) {
                $query = $this->poll->delete_pollCommentlike($user_id, $comment_id);

                if ($query) {
                    $result = array(
                        'like' => $this->poll->getCommentLikes($comment_id),
                        'dislike' => $this->poll->getCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/up-reply.png" onmouseover="this.src =' . base_url() . 'assets/public/img/up-reply-hover.png ">'
                    );
//  echo json_encode($result);
                }
            } else {
                $data = array(
                    'like' => 1
                );
                $query = $this->poll->update_pollCommentlike($user_id, $comment_id, $data);
                if ($query) {
                    $result = array(
                        'like' => $this->poll->getCommentLikes($comment_id),
                        'dislike' => $this->poll->getCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/up-reply-hover.png" onmouseover="this.src =' . base_url() . 'assets/public/img/up-reply-hover.png">'
                    );
//  echo json_encode($result);
                }
            }
        }

        $total = ((int) $result['like']) - ((int) $result['dislike']);

        $result['total'] = $total;

        echo json_encode($result);
        die;
    }

    function delete_pollComment() {
        $comment_id = $this->input->post("comment_id");
        $user_id = $this->input->post("u_id");
        $this->poll->delete_pollComment($comment_id, $user_id);
    }

    function poll_ans() {
        $id = $this->session->userdata('user_id');

        $this->load->view('result_voting', $result);
    }

    public function poll_listing() {
        $Session = $this->session->userdata('user_id');

        $data['result'] = $this->poll->all_poll_question();

        $data['userdetail'] = $this->userdetail();
        $data['username'] = $this->session->userdata('uname');
        $data['userid'] = $this->session->userdata('user_id');

         $data["side_link"] = $this->hm->get_all_sidelinksside();
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside();
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
        $data["new_post"] = $this->hm->get_new_post();
        $data["new_discussion"] = $this->hm->get_let_discussion();
        $data["new_like"] = $this->hm->get_newlike();
//        $data['content'] = $this->load->view('poll_listing', $data, TRUE);
        echo $this->load->view('poll_listing', $data,TRUE); 
    }

    function vote_result() {
        $answer = $this->input->post('answer');
        $poll_id = $this->input->post('poll_id');
        $user_id = $this->session->userdata('user_id');

        if (isset($answer)) {
            if (empty($answer)) {
//                    $data['answer'] = form_error('answer');
                echo json_encode(array('status' => 'false'));
//                    echo json_encode($data);
                die;
            }
        }

        if ($user_id != '') {
            $discussion_id = $this->input->post("victory");
            $result = $this->poll->check_poll_vote($user_id, $poll_id);


            if ($result) {

                $answerArray = array(
                    'answer' => $answer
                );
                $this->poll->updatepollvote($answerArray, $poll_id, $user_id);
                echo json_encode(array('poll_id' => $poll_id));
                exit;
            } else {
                $answerArray = array(
                    'poll_id' => $poll_id,
                    'user_id' => $user_id,
                    'answer' => $answer
                );
                $this->poll->addpollvote($answerArray);
                echo json_encode(array('poll_id' => $poll_id));
                exit;
            }
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

}
