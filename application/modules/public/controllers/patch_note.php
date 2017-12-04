<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Patch_note extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));

        $this->load->model('users_model', 'usermod');
        $this->load->model('league_model', 'leaguemod');
        $this->load->model('home_model', 'hm');
        $this->load->model('patch_model', 'pm');
    }

    function userdetail() {
        $session = $this->session->userdata('user_id');
        return $profile = $this->usermod->userProfile_detail($session);
    }

    function index() {
        $type = $this->uri->segment(2);

        if (!empty($type)) {
            if ($type == "new") {
                $maintabval = "new";
            } else if ($type == "bookmark") {
                $maintabval = "fav";
            } else {
                $maintabval = "new";
            }
        } else {
            $maintabval = "new";
        }
        $orderid = 0;
        $Session = $this->session->userdata('user_id');

        $data['maintabval'] = $maintabval;

        $data['sub_items'] = $this->get_sub_items('new',"");
        $data['userdetail'] = $this->userdetail();
        $data['username'] = $this->session->userdata('uname');
        $data['userid'] = $this->session->userdata('user_id');
        $data["side_link"] = $this->hm->get_all_sidelinksside($orderid, $maintabval);
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside($orderid, $maintabval);
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
        $data["new_post"] = $this->hm->get_new_post();
        $data["new_discussion"] = $this->hm->get_let_discussion();
        $data["new_like"] = $this->hm->get_newlike();
        $data['active_menu'] = "patch_note";
        $data['getTabposition'] = $this->leaguemod->getTabs();

        $get_rules = $this->leaguemod->get_rules($type);
        $right_content = $this->getRightContent($maintabval,'');

        $data['getTabposition'] = $this->leaguemod->getTabs();
        if (count($get_rules) > 0) {
            $rightbar = array(
                'rules' => $get_rules[0]->template,
                'content'=>''
            );
        } else {
            $rightbar = array(
                'rules' => '',
                'content'=>$right_content
            );
        }
        //get data for content

        /*********************/

        if ($this->session->userdata('user_id')) {
            $user_id = $this->session->userdata('user_id');
        } else {
            $user_id = 0;
        }
        $row = 0;
        $rowperpage = 5;
        $main = $maintabval;
        $allcount_fetch = $this->pm->get_total_row($main, $user_id);
        $data['allcount'] = $allcount_fetch->count;
        $data['page_row'] = $row;
        $data['list_patch_notes'] = $this->pm->list_patch_notes($main, $row, $rowperpage, $user_id);

        $victory = array();
        $defact = array();
        $fav_userid = array();
        foreach ($data['list_patch_notes'] as $patch) {
            $pid = $patch['patch']['main_id'];
            if (isset($patch['patch']['vic_users']) && !empty($patch['patch']['vic_users'])) {
                $vu = $patch['patch']['vic_users'];
                $victory[$pid] = explode(",", $vu);
            }
            if (isset($patch['patch']['def_users']) && !empty($patch['patch']['def_users'])) {
                $du = $patch['patch']['vic_users'];
                $defact[$pid] = explode(",", $du);
            }

            if (isset($patch['patch']['fvtuserid']) && !empty($patch['patch']['fvtuserid'])) {
                $fu = $patch['patch']['fvtuserid'];
                $fav_userid[$pid] = explode(",", $fu);
            }
        }

        $data['favuserid'] = $fav_userid;

        $data['userid'] = $this->session->userdata('user_id');
        $data['scroll'] = "0";
        $data['victory'] = $victory;
        $data['defact'] = $defact;
        $data['total'] = count($data['list_patch_notes']);

        /*********************/

        $data["right_bar"] = $rightbar;

        $data['content'] = $this->load->view('patch_note/index', $data, TRUE);
        load_public_template($data);
    }

    function list_patch() {
        if ($this->session->userdata('user_id')) {
            $user_id = $this->session->userdata('user_id');
        } else {
            $user_id = 0;
        }
        $row = $this->input->post('row');
        $rowperpage = $this->input->post('rowperpage');
        $main = $_POST['main'];
        $allcount_fetch = $this->pm->get_total_row($main, $user_id);
        $data['allcount'] = $allcount_fetch->count;
        $data['page_row'] = $row;
        $data['list_patch_notes'] = $this->pm->list_patch_notes($main, $row, $rowperpage, $user_id);

        $victory = array();
        $defact = array();
        $fav_userid = array();
        foreach ($data['list_patch_notes'] as $patch) {
            $pid = $patch['patch']['main_id'];
            if (isset($patch['patch']['vic_users']) && !empty($patch['patch']['vic_users'])) {
                $vu = $patch['patch']['vic_users'];
                $victory[$pid] = explode(",", $vu);
            }
            if (isset($patch['patch']['def_users']) && !empty($patch['patch']['def_users'])) {
                $du = $patch['patch']['vic_users'];
                $defact[$pid] = explode(",", $du);
            }

            if (isset($patch['patch']['fvtuserid']) && !empty($patch['patch']['fvtuserid'])) {
                $fu = $patch['patch']['fvtuserid'];
                $fav_userid[$pid] = explode(",", $fu);
            }
        }

        $data['favuserid'] = $fav_userid;

        $data['userid'] = $this->session->userdata('user_id');
        $data['scroll'] = "0";
        $data['victory'] = $victory;
        $data['defact'] = $defact;
        $data['total'] = count($data['list_patch_notes']);
        echo $this->load->view('patch_note/list', $data, TRUE);
    }

    function patch_victory() {
        $user_id = $this->session->userdata('user_id');
        if ($user_id != '') {
            $patch_id = $this->input->post("victory");
            $result = $this->pm->victory_defeat($user_id, $patch_id);
            //print_r($result);

            if ($result) {
                $victory_status = $result['victory_defeat'];
                $victory_id = $result['victory_id'];
                if ($victory_status == 'V') {
                    $this->pm->removevictory($user_id, $patch_id);
                    echo json_encode(array('status' => 'delete'));
                    exit;
                } else {
                    $victoryArray = array(
                        'victory_defeat' => 'V'
                    );
                    $this->pm->updatevictory($victoryArray, $victory_id);

                    echo json_encode(array('status' => 'update'));
                    exit;
                }
            } else {
                $victoryArray = array(
                    'patch_id' => $patch_id,
                    'user_id' => $this->session->userdata('user_id'),
                    'victory_defeat' => 'V',
                    'victory_status' => 'A');
                $this->pm->add_victory_defeat($victoryArray);

                echo json_encode(array('status' => 'insert'));
                exit;
            }
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

    function patch_defeat() {
        $user_id = $this->session->userdata('user_id');
        if ($this->session->userdata('user_id')) {
            $patch_id = $this->input->post("defeat");
            $result = $this->pm->victory_defeat($user_id, $patch_id);
            if ($result) {
                $victory_status = $result['victory_defeat'];
                $victory_id = $result['victory_id'];
                if ($victory_status == 'D') {
                    $this->pm->removedefact($user_id, $patch_id);
                    echo json_encode(array('status' => 'delete'));
                    exit;
                } else {
                    $victoryArray = array('victory_defeat' => 'D');
                    $this->pm->updatevictory($victoryArray, $victory_id);

                    echo json_encode(array('status' => 'update'));
                    exit;
                }
            } else {
                $victoryArray = array(
                    'patch_id' => $patch_id,
                    'user_id' => $this->session->userdata('user_id'),
                    'victory_defeat' => 'D',
                    'victory_status' => 'A'
                );
                $this->pm->add_victory_defeat($victoryArray);


                echo json_encode(array('status' => 'insert'));
                exit;
            }
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

    function patch_favourites() {
        $user_id = $this->session->userdata('user_id');
        if ($user_id != '') {
            $patch_id = $this->input->post("favourites");
            $result = $this->pm->sel_favourites($user_id, $patch_id);
//            print_r($result);

            if ($result) {
                $favourites_status = $result['favourites_status'];
                $favourites_id = $result['favourites_id'];

                if ($favourites_status == NULL) {
                    $favouritesArray = array(
                        'patch_id' => $patch_id,
                        'user_id' => $this->session->userdata('user_id'),
                        'favourites_status' => 'A');
                    $this->pm->add_favourites($favouritesArray);
                    echo json_encode(array('status' => 'insert'));
                    exit;
                } else if ($favourites_status == "A") {
//                    $favouritesArray = array(
//                        'favourites_status' => 'I'
//                    );
                    $this->pm->removefavourites($user_id, $favourites_id);
                    echo json_encode(array('status' => 'delete'));
                    exit;
//                    $this->leaguemod->updatefavourites($favouritesArray, $favourites_id);
//                    echo json_encode(array('status' => 'update'));
//                    exit;
                }
            } else {
                $favouritesArray = array(
                    'patch_id' => $patch_id,
                    'user_id' => $this->session->userdata('user_id'),
                    'favourites_status' => 'A');
                $this->pm->add_favourites($favouritesArray);
                echo json_encode(array('status' => 'insert'));
                exit;
            }
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

    function detail($patch_id) {
        $type = $this->uri->segment(2);
        $maintabval = "new";
        $patch_detail['patch_alldetail'] = $this->pm->single_patch_note($patch_id);

        $data['patchDetail'] = $patch_detail['patch_alldetail']['patch'][0];
        $data['pachSections'] = $patch_detail['patch_alldetail']['section'];

        $victory = array();
        $defact = array();

        if (isset($data['patchDetail']->vic_users) && !empty($data['patchDetail']->vic_users)) {
            $victory[$patch_id] = explode(",", $data['patchDetail']->vic_users);
        }
        if (isset($data['patchDetail']->def_users) && !empty($data['patchDetail']->def_users)) {
            $defact[$patch_id] = explode(",", $data['patchDetail']->def_users);
        }

        $data['victory'] = $victory;
        $data['defact'] = $defact;
        $data['username'] = $this->session->userdata('uname');
        $data['userid'] = $this->session->userdata('user_id');
        $data['userdetail'] = $this->userdetail();
        $data["side_link"] = $this->hm->get_all_sidelinksside();
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside();
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);

        $get_rules = $this->leaguemod->get_rules($type);
        $right_content = $this->getRightContent($maintabval,'', 3);

        $data['getTabposition'] = $this->leaguemod->getTabs();
        if (count($get_rules) > 0) {
            $rightbar = array(
                'rules' => $get_rules[0]->template,
                'content'=>''
            );
        } else {
            $rightbar = array(
                'rules' => '',
                'content'=>$right_content
            );
        }
        //get data for content

        $data["right_bar"] = $rightbar;
        $data['social_banner'] = false;

        $data['content'] = $this->load->view('patch_note/detail', $data, TRUE);
        load_public_template($data);
    }

    function getsubcomment_ajax() {
        $parent_id = $this->input->post('pid');
        //echo "parent_id" .$parent_id;exit;

        $cmtdata = $data_side = $this->pm->getPatchCmtData_subComment($parent_id);
        // print_r($cmtdata);
        $i = 0;
        foreach ($cmtdata as $cmt) {

            $total_likes = $this->pm->getCommentLikes($cmt->comment_id);
            $total_Dislikes = $this->pm->getCommentDislikes($cmt->comment_id);
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
                $html .= '<img src="' . base_url() . 'assets/public/img/luffy.png" alt="Leaguememe" class="media-object avatar img-circle"> ';
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
                                            <div  id="' . $parent_id . '" class="childcommentrplPostBtn' . $value->comment_id . '">
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

    function getCommentFData() {
        $id = $this->input->post('cmtDATAid');
        $cmtdata = $data_side = $this->pm->getPatchCmtfData($id);

        $data['return_array'] = array();
        foreach ($cmtdata as $cmt) {

            if ($cmt->parent_id == 0 && !isset($return_array[$cmt->comment_id])) {
                $return_array[$cmt->comment_id] = array();
                $return_array[$cmt->comment_id]['main_comment'] = $cmt;
                $return_array[$cmt->comment_id]['main_comment']->total_like = $this->pm->getCommentLikes($cmt->comment_id);
                $return_array[$cmt->comment_id]['main_comment']->total_dislike = $this->pm->getCommentDislikes($cmt->comment_id);
            } else if ($cmt->parent_id != 0) {
                $cmt->total_like = $this->pm->getCommentLikes($cmt->comment_id);
                $cmt->total_dislike = $this->pm->getCommentDislikes($cmt->comment_id);
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

    function getCommentData() {
        $id = $this->input->post('cmtDATAid');
        $cmtdata = $data_side = $this->pm->getPatchCmtData($id);

        $total_comment = 0;

        $data['return_array'] = array();
        foreach ($cmtdata as $cmt) {

            if ($cmt->parent_id == 0 && !isset($return_array[$cmt->comment_id])) {
                $return_array[$cmt->comment_id] = array();
                $return_array[$cmt->comment_id]['main_comment'] = $cmt;
                $return_array[$cmt->comment_id]['main_comment']->total_like = $this->pm->getCommentLikes($cmt->comment_id);
                $return_array[$cmt->comment_id]['main_comment']->total_dislike = $this->pm->getCommentDislikes($cmt->comment_id);
            } else if ($cmt->parent_id != 0) {
                $cmt->total_like = $this->pm->getCommentLikes($cmt->comment_id);
                $cmt->total_dislike = $this->pm->getCommentDislikes($cmt->comment_id);
                $return_array[$cmt->parent_id][] = $cmt;
            }
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

    function delete_comment() {
        $comment_id = $this->input->post("comment_id");
        $user_id = $this->input->post("u_id");

        $this->pm->delete_comment($comment_id, $user_id);

        echo "success";
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
                'patch_id' => $this->input->post('patchid'),
                'parent_id' => $this->input->post('parent'),
                'comment' => $this->input->post('cmt'),
                'comment_date' => $cmtdate,
                'comment_image' => $filename
            );

            $allComment = array(
                'user_id' => $this->input->post('user_id'),
                'patchid' => $this->input->post('patchid'),
                'parent' => $this->input->post('parent'),
                'cmt' => $this->input->post('cmt'),
                'filename' => $filename,
            );
        } else {
            $allComment = $this->input->post('cmtData');
            $cmtdate = date('Y-m-d H:i:s');
            $ins_comment = array(
                'user_id' => $allComment['user_id'],
                'patch_id' => $allComment['patchid'],
                'parent_id' => $allComment['parent'],
                'comment' => $allComment['cmt'],
                'comment_date' => $cmtdate,
            );
        }


        $insertid = $this->pm->add_comment($ins_comment);

        $getuserdata = $this->hm->getuserdata($allComment['user_id']);
        $data['userdata'] = $allComment;
        $data['useralldata'] = $getuserdata;
        $data['comment_date'] = $cmtdate;
        $data['lastid'] = $insertid;
        echo $this->load->view('addcomment', $data, true);
    }

    function likedislike() {

        $status = $this->input->post('status');
        $user_id = $this->input->post('user_id');
        $comment_id = $this->input->post('comment_id');
        $check = $this->pm->check_like($user_id, $comment_id);

        if ($status == "dislike") {

            if (empty($check)) {
                $data = array(
                    'user_id' => $user_id,
                    'comment_id' => $comment_id,
                    'like' => 0
                );
                $query = $this->pm->like($data);
                if ($query) {
                    $result = array(
                        'like' => $this->pm->getCommentLikes($comment_id),
                        'dislike' => $this->pm->getCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/down-reply-hover.png" onmouseover="this.src =' . base_url() . 'assets/public/img/down-reply-hover.png">'
                    );
                }
            } elseif ($check[0]->like == 0) {

                $query = $this->pm->delete_like($user_id, $comment_id);
                if ($query) {
                    $result = array(
                        'like' => $this->pm->getCommentLikes($comment_id),
                        'dislike' => $this->pm->getCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/down-reply.png" onmouseover="this.src =' . base_url() . 'assets/public/img/down-reply-hover.png">'
                    );
                }
            } else {

                $data = array(
                    'like' => 0
                );
                $query = $this->pm->update_like($user_id, $comment_id, $data);
                if ($query) {
                    $result = array(
                        'like' => $this->pm->getCommentLikes($comment_id),
                        'dislike' => $this->pm->getCommentDislikes($comment_id),
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
                $query = $this->pm->like($data);

                if ($query) {

                    $result = array(
                        'like' => $this->pm->getCommentLikes($comment_id),
                        'dislike' => $this->pm->getCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/up-reply-hover.png" onmouseover="this.src =' . base_url() . 'assets/public/img/up-reply-hover.png">'
                    );
                }
            } elseif ($check[0]->like == 1) {
                $query = $this->pm->delete_like($user_id, $comment_id);

                if ($query) {
                    $result = array(
                        'like' => $this->pm->getCommentLikes($comment_id),
                        'dislike' => $this->pm->getCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/up-reply.png" onmouseover="this.src =' . base_url() . 'assets/public/img/up-reply-hover.png ">'
                    );
                }
            } else {
                $data = array(
                    'like' => 1
                );
                $query = $this->pm->update_like($user_id, $comment_id, $data);
                if ($query) {
                    $result = array(
                        'like' => $this->pm->getCommentLikes($comment_id),
                        'dislike' => $this->pm->getCommentDislikes($comment_id),
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
    function test_patch($id) { 
      $data['patch_data'] = $this->pm->test_single($id); 
 
        $data['username'] = $this->session->userdata('uname');
        $data['userid'] = $this->session->userdata('user_id');
        $data['userdetail'] = $this->userdetail();
        $data["side_link"] = $this->hm->get_all_sidelinksside();
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside();
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);

        $data['content'] = $this->load->view('patch_note/test_patch', $data, TRUE);
        load_public_template($data);  
    }
}
