<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Animelist extends MX_Controller {

    function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('users_model', 'usermod');
        $this->load->model('league_model', 'leaguemod');
        $this->load->model('home_model', 'hm');

        $this->load->model('anime_model', 'animemod');
    }

    function userdetail() {
        $session = $this->session->userdata('user_id');
        return $profile = $this->usermod->userProfile_detail($session);
    }

    function anime_album() {

        $data['username'] = $this->session->userdata('uname');
        $data['userdetail'] = $this->userdetail();
        $data['content'] = $this->load->view('anime_album', $data, TRUE);
        load_public_template($data);
    }

    function anime_get_list() {
        $user_id = $this->session->userdata('user_id');
        $match = $this->input->post('main');
        $maintab = $this->input->post('mainTab');

        if ($user_id != "") {

            $data['anime_list'] = $this->animemod->getafavAnimeList($match, $maintab, $user_id);

            if ($data['anime_list']) {

                $data['user_id'] = $user_id;
                echo $this->load->view('anime_list', $data, TRUE);
            } else {
                $data['anime_list'] = $this->animemod->get_searchanime_list_after($match, $maintab, $user_id);

                $data['user_id'] = $user_id;
                if (!$data['anime_list']) {

                    echo "<h6><i class='fa fa-asterisk' style='color:red'></i> Not Found Anime Start With Latter " . $match . "</h6>";
                } else {
                    echo "<span><i class='fa fa-asterisk' style='color:green'></i> All Anime Found Which Contain " . $match . "</span> ";
                    echo " <h6><i class='fa fa-asterisk' style='color:red'></i>  Not Found Anime Start With Latter " . $match . " </h6>";

                    echo $this->load->view('anime_list', $data, TRUE);
                }
            }
        } else {

            $data['anime_list'] = $this->animemod->getAnimeList($match, $maintab);

            if ($data['anime_list']) {

                echo $this->load->view('anime_list', $data, TRUE);
            } else {

                $data['anime_list'] = $this->animemod->get_searchanime_list($match, $maintab);

                if (!$data['anime_list']) {
                    echo "<h6><i class='fa fa-asterisk' style='color:red'></i> Not Found Anime Start With Latter " . $match . "</h6>";
                } else {
                    echo "<span><i class='fa fa-asterisk' style='color:green'></i> All Anime Found Which Contain " . $match . "</span> ";
                    echo " <h6><i class='fa fa-asterisk' style='color:red'></i>  Not Found Anime Start With Latter " . $match . " </h6>";
                    echo $this->load->view('anime_list', $data, TRUE);
                }
            }
        }
    }

    function anime_album_episode_list($anime_id = '') {

        $data['username'] = $this->session->userdata('uname');
        $data['userdetail'] = $this->userdetail();
        $data["side_link"] = $this->hm->get_all_sidelinksside();
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside();
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
        $data["anime_id"] = $anime_id;
        $data["sub_cate"] = $this->animemod->getAnimeSubtab($anime_id);
        $data["anime_detail"] = $this->animemod->getAnimeDetail($anime_id);
        $data["all_detail"] = $this->animemod->getAnimeAllDetail($anime_id);
        $data["recent_dis"] = $this->animemod->getRecentDiscussion(4);

        $data['content'] = $this->load->view('anime_album_list', $data, TRUE);
        load_public_template($data);
    }

    function add_favorite() {

        $user_id = $this->session->userdata('user_id');
        if ($user_id != '') {
            $anime_id = $this->input->post('anime_id');
            $result = $this->animemod->check_anime_fav($user_id, $anime_id);
            //print_r($result);

            if ($result) {
                $favourites_status = $result['favourite'];
                $favourites_id = $result['anime_fav_id'];

                if ($favourites_status == NULL) {
                    $favouritesArray = array(
                        'anime_id' => $anime_id,
                        'user_id' => $this->session->userdata('user_id'),
                        'favourite' => 'A');
                    $this->animemod->add_animefavourites($favouritesArray);
                    echo json_encode(array('status' => 'insert'));
                    exit;
                } else if ($favourites_status == "A") {
                    $this->animemod->removeanimefavourites($user_id, $anime_id);
                    echo json_encode(array('status' => 'delete'));
                    exit;
                }
            } else {
                $favouritesArray = array(
                    'anime_id' => $anime_id,
                    'user_id' => $this->session->userdata('user_id'),
                    'favourite' => 'A');
                $this->animemod->add_animefavourites($favouritesArray);
                echo json_encode(array('status' => 'insert'));
                exit;
            }
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

    function anime_discussion_tab() {
        $data['user_id'] = $this->session->userdata('user_id');
        $data['header_type'] = 1; // discuddion type 
        echo $this->load->view('anime_discussion_tab', $data);
    }

    function anime_first_tab() {
        $animename1 = $this->input->post('anime_id');
        $data['animename1'] = $animename1;
        echo $this->load->view('anime_first_tab', $data);
    }

    function anime_manga_tab() {
        $data['user_id'] = $this->session->userdata('user_id');
        $data['header_type'] = 2; // Manga type 
        echo $this->load->view('anime_discussion_tab', $data);
//        echo $this->load->view('anime_manga_tab');
    }

    function anime_theories_tab() {
        $data['user_id'] = $this->session->userdata('user_id');
        $data['header_type'] = 3; // theories type 
        echo $this->load->view('anime_discussion_tab', $data);
//        echo $this->load->view('anime_theories_tab');
    }

    function anime_episode_sec_tab() {
        echo $this->load->view('anime_episode_sec_tab');
    }

    function anime_review_sec_tab() {
        $anime_id = $this->input->post('anime_id');


        $data['first'] = $this->animemod->getanimeRating(0.5, $anime_id);
        $data['second'] = $this->animemod->getanimeRating(1, $anime_id);
        $data['third'] = $this->animemod->getanimeRating(1.5, $anime_id);
        $data['fourth'] = $this->animemod->getanimeRating(2, $anime_id);
        $data['fifth'] = $this->animemod->getanimeRating(2.5, $anime_id);
        $data['sixth'] = $this->animemod->getanimeRating(3, $anime_id);
        $data['seventh'] = $this->animemod->getanimeRating(3.5, $anime_id);
        $data['eighth'] = $this->animemod->getanimeRating(4, $anime_id);
        $data['ninth'] = $this->animemod->getanimeRating(4.5, $anime_id);
        $data['tenth'] = $this->animemod->getanimeRating(5, $anime_id);
        foreach ($data as $value) {

            if (isset($value->overall_rate) || isset($value->overall)) {
                $rate_sum[] = $value->overall_rate;
                $user_sum[] = count(explode(",", $value->overall));
            }
        }
        if (isset($rate_sum) && isset($user_sum)) {

            $data['anime_oerallrate'] = number_format(array_sum($rate_sum) / array_sum($user_sum), 1);
            $data['user_review'] = array_sum($user_sum);
        }
        $data['userid'] = $this->session->userdata('user_id');

        $data["anime_detail"] = $this->animemod->getAnimeDetail($anime_id);
        echo $this->load->view('anime_review_sec_tab', $data, TRUE);
    }

    function getreview_help() {
        $like = $this->input->post('like');
        $data['text'] = $this->input->post('text');
        $anime_id = $this->input->post('anime_id');
        $data['anime_list'] = $this->animemod->getReviewlikelist($anime_id, $like);
//        echo '<pre>';
//        print_r($data['anime_list']);
//        exit;
        echo $this->load->view('review_filtering', $data, TRUE);
    }

    function getreview_time() {
        $time = $this->input->post('time');
        $anime_id = $this->input->post('anime_id');
        $data['anime_list'] = $this->animemod->getReviewtimelist($anime_id, $time);
        $data['text'] = $this->input->post('text');
//        echo '<pre>';
//        print_r($data['anime_list']);
//        exit;
        echo $this->load->view('review_filtering', $data, TRUE);
    }

    function anime_review_list() {
        $anime_id = $this->input->post('anime_id');
        $data['review_list'] = $this->animemod->getReviewlist($anime_id);
//        echo '<pre>';
//        print_r($data['review_list']);
//        exit;

        echo $this->load->view('anime_review_list', $data, TRUE);
    }

    function anime_quotes_sec_tab() {
        echo $this->load->view('anime_quotes_sec_tab');
    }

    function anime_readmore_tab() {
        $data['review_status'] = $this->input->post('user_review');

        $user_id = $this->session->userdata('user_id');
        $data['userdetail'] = $this->usermod->userProfile_detail($user_id);
        $user_review_id = $this->input->post('user_review_id');
        $review_id = $this->input->post('anime_id');
        $data['review_detail'] = $this->animemod->getReviewDetail($review_id);
        $data['anime_list'] = $this->animemod->getReviewAnimeList($user_review_id);
        $data['user_id'] = $user_id;
        $data['review_like_check'] = $this->animemod->check_review_like($user_id, $review_id);
//        print_r($data['review_like_check']);
//        exit;
        $positive_votes = $this->animemod->countpositive_votes($review_id);
        $data['positive_vote'] = $positive_votes->positive_vote;
        $total_votes = $this->animemod->counttotal_votes($review_id);
        $data['total_vote'] = $total_votes->total_vote;
        echo $this->load->view('anime_readmore_tab', $data, TRUE);
    }

     function postcommentreview() {

        $dataReview = $this->input->post('rewTypeUnique');
        $cmtdate = date('Y-m-d H:i:s');
        if (isset($dataReview) && !empty($dataReview)) {

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

            $ins_comment = array(
                'user_id' => $this->input->post('user_id'),
                'anime_rev_id' => $this->input->post('reviewid'),
                'parent_id' => $this->input->post('parent'),
                'review_comment' => $this->input->post('cmt'),
                'review_comment_timestamp' => $cmtdate,
                'review_image' => $filename
            );

            $allComment = array(
                'user_id' => $this->input->post('user_id'),
                'reviewid' => $this->input->post('reviewid'),
                'parent' => $this->input->post('parent'),
                'cmt' => $this->input->post('cmt'),
            );
        } else {

            $allComment = $this->input->post('cmtData');

            $ins_comment = array(
                'user_id' => $allComment['user_id'],
                'anime_rev_id' => $allComment['reviewid'],
                'parent_id' => $allComment['parent'],
                'review_comment' => $allComment['cmt'],
                'review_comment_timestamp' => $cmtdate,
            );
        }

        $insertid = $this->animemod->add_reviewcomment($ins_comment);

        $getuserdata = $this->hm->getuserdata($allComment['user_id']);
        $data['userdata'] = $allComment;
        $data['useralldata'] = $getuserdata;
        $data['comment_date'] = $cmtdate;
        $data['lastid'] = $insertid;
        echo $this->load->view('addreviewcomment', $data, true);
//        echo "true";
    }

    function getReviewCommentData() {

        $id = $this->input->post('cmtDATAid');
        $cmtdata = $data_side = $this->animemod->getAnimeReviewCmtData($id);

        $total_comment = 0;

        $data['return_array'] = array();
        foreach ($cmtdata as $cmt) {

            if ($cmt->parent_id == 0 && !isset($return_array[$cmt->rev_commentid])) {
                $return_array[$cmt->rev_commentid] = array();
                $return_array[$cmt->rev_commentid]['main_comment'] = $cmt;
                $return_array[$cmt->rev_commentid]['main_comment']->total_like = $this->animemod->getReviewCommentLikes($cmt->rev_commentid);
                $return_array[$cmt->rev_commentid]['main_comment']->total_dislike = $this->animemod->getReviewCommentDislikes($cmt->rev_commentid);
            } else if ($cmt->parent_id != 0) {
                $cmt->total_like = $this->animemod->getReviewCommentLikes($cmt->rev_commentid);
                $cmt->total_dislike = $this->animemod->getReviewCommentDislikes($cmt->rev_commentid);
//$cmt->T_COMMENT = count($return_array[$cmt->parent_id]);
//$total_comment = $cmt->T_COMMENT;
                $return_array[$cmt->parent_id][] = $cmt;
            }

// $return_array[$cmt->rev_commentid]->T_COMMENT = $total_comment;
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

//        echo "<pre>";
//        print_r($data['comments']);
//        exit;
//        $htmldata[] = $this->load->view('reviewcommets', $data, true);
//        print_r($htmldata);
        echo $this->load->view('reviewcomments', $data, true);
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

    function anime_post_review_tab() {
        echo $this->load->view('anime_post_review_tab');
    }

    function review_like() {

        $user_id = $this->session->userdata('user_id');
        if ($user_id != '') {
            $review_id = $this->input->post('review_id');

            $result = $this->animemod->check_review_like($user_id, $review_id);
//            print_r($result);

            if ($result) {
                $like_status = $result['like'];
                $like_id = $result['id'];
                if ($like_status == '1') {
                    $this->animemod->removeReviewlike($user_id, $review_id);
                    $positive_votes = $this->animemod->countpositive_votes($review_id);
                    $positive_vote = $positive_votes->positive_vote;
                    $total_votes = $this->animemod->counttotal_votes($review_id);
                    $total_vote = $total_votes->total_vote;
                    $data = array('status' => 'delete', 'positive_votes' => $positive_vote, 'total_votes' => $total_vote);
                    echo json_encode($data);
                    exit;
                } else {
                    $dataArray = array(
                        'like' => '1'
                    );

                    $this->animemod->updateReviewLike($dataArray, $like_id);
                    $positive_votes = $this->animemod->countpositive_votes($review_id);
                    $positive_vote = $positive_votes->positive_vote;
                    $total_votes = $this->animemod->counttotal_votes($review_id);
                    $total_vote = $total_votes->total_vote;
                    $data = array('status' => 'update', 'positive_votes' => $positive_vote, 'total_votes' => $total_vote);
                    echo json_encode($data);
                    exit;
                }
            } else {
                $dataArray = array(
                    'review_id' => $review_id,
                    'user_id' => $user_id,
                    'like' => '1',
                );
                $this->animemod->add_reviewlike($dataArray);
                $positive_votes = $this->animemod->countpositive_votes($review_id);
                $positive_vote = $positive_votes->positive_vote;
                $total_votes = $this->animemod->counttotal_votes($review_id);
                $total_vote = $total_votes->total_vote;
                $data = array('status' => 'insert', 'positive_votes' => $positive_vote, 'total_votes' => $total_vote);
                echo json_encode($data);
                exit;
            }
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

    function review_dislike() {

        $user_id = $this->session->userdata('user_id');
        if ($user_id != '') {
            $review_id = $this->input->post('review_id');

            $result = $this->animemod->check_review_like($user_id, $review_id);
//            print_r($result);

            if ($result) {
                $like_status = $result['like'];
                $like_id = $result['id'];
                if ($like_status == '0') {
                    $this->animemod->removeReviewdislike($user_id, $review_id);
                    $positive_votes = $this->animemod->countpositive_votes($review_id);
                    $positive_vote = $positive_votes->positive_vote;
                    $total_votes = $this->animemod->counttotal_votes($review_id);
                    $total_vote = $total_votes->total_vote;
                    $data = array('status' => 'delete', 'positive_votes' => $positive_vote, 'total_votes' => $total_vote);
                    echo json_encode($data);
                    exit;
                } else {
                    $dataArray = array(
                        'like' => '0'
                    );
                    $this->animemod->updateReviewLike($dataArray, $like_id);

                    $positive_votes = $this->animemod->countpositive_votes($review_id);
                    $positive_vote = $positive_votes->positive_vote;
                    $total_votes = $this->animemod->counttotal_votes($review_id);
                    $total_vote = $total_votes->total_vote;
                    $data = array('status' => 'update', 'positive_votes' => $positive_vote, 'total_votes' => $total_vote);
                    echo json_encode($data);
                    exit;
                }
            } else {
                $dataArray = array(
                    'review_id' => $review_id,
                    'user_id' => $user_id,
                    'like' => '0',
                );
                $this->animemod->add_reviewlike($dataArray);
                $positive_votes = $this->animemod->countpositive_votes($review_id);
                $positive_vote = $positive_votes->positive_vote;
                $total_votes = $this->animemod->counttotal_votes($review_id);
                $total_vote = $total_votes->total_vote;
                $data = array('status' => 'insert', 'positive_votes' => $positive_vote, 'total_votes' => $total_vote);
                echo json_encode($data);
                exit;
            }
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

    function reviewlikedislike() {


        $status = $this->input->post('status');
        $user_id = $this->input->post('user_id');
        $comment_id = $this->input->post('comment_id');
        $check = $this->animemod->check_like($user_id, $comment_id);

        if ($status == "dislike") {


            if (empty($check)) {
                $data = array(
                    'user_id' => $user_id,
                    'rev_commentid' => $comment_id,
                    'like' => 0
                );
                $query = $this->animemod->like($data);
                if ($query) {
                    $result = array(
                        'like' => $this->animemod->getReviewCommentLikes($comment_id),
                        'dislike' => $this->animemod->getReviewCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/down-reply-hover.png" onmouseover="this.src =' . base_url() . 'assets/public/img/down-reply-hover.png">'
                    );
// echo json_encode($result);
                }
            } elseif ($check[0]->like == 0) {

                $query = $this->animemod->delete_like($user_id, $comment_id);
                if ($query) {
                    $result = array(
                        'like' => $this->animemod->getReviewCommentLikes($comment_id),
                        'dislike' => $this->animemod->getReviewCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/down-reply.png" onmouseover="this.src =' . base_url() . 'assets/public/img/down-reply-hover.png">'
                    );
// echo json_encode($result);
                }
            } else {

                $data = array(
                    'like' => 0
                );
                $query = $this->animemod->update_like($user_id, $comment_id, $data);
                if ($query) {
                    $result = array(
                        'like' => $this->animemod->getReviewCommentLikes($comment_id),
                        'dislike' => $this->animemod->getReviewCommentDislikes($comment_id),
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
                    'rev_commentid' => $comment_id,
                    'like' => 1
                );
                $query = $this->animemod->like($data);

                if ($query) {

                    $result = array(
                        'like' => $this->animemod->getReviewCommentLikes($comment_id),
                        'dislike' => $this->animemod->getReviewCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/up-reply-hover.png" onmouseover="this.src =' . base_url() . 'assets/public/img/up-reply-hover.png">'
                    );
// echo json_encode($result);
                }
            } elseif ($check[0]->like == 1) {
                $query = $this->animemod->delete_like($user_id, $comment_id);

                if ($query) {
                    $result = array(
                        'like' => $this->animemod->getReviewCommentLikes($comment_id),
                        'dislike' => $this->animemod->getReviewCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/up-reply.png" onmouseover="this.src =' . base_url() . 'assets/public/img/up-reply-hover.png ">'
                    );
//  echo json_encode($result);
                }
            } else {
                $data = array(
                    'like' => 1
                );
                $query = $this->animemod->update_like($user_id, $comment_id, $data);
                if ($query) {
                    $result = array(
                        'like' => $this->animemod->getReviewCommentLikes($comment_id),
                        'dislike' => $this->animemod->getReviewCommentDislikes($comment_id),
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

    function delete_comment() {
        $comment_id = $this->input->post("comment_id");
        $user_id = $this->input->post("u_id");

        $this->animemod->delete_comment($comment_id, $user_id);

        echo "success";
    }

    function post_review() {
        $user_id = $this->session->userdata('user_id');
        $anime_id = $this->input->post('anime_id');
        $spoiler_review = $this->input->post('spoiler_review');
        $review_process = $this->input->post('review_process');
        $story_review = $this->input->post('story_review');
        $animation_review = $this->input->post('animation_review');
        $character_review = $this->input->post('character_review');
        $enjoy_review = $this->input->post('enjoy_review');
        $sound_review = $this->input->post('sound_review');
        $recomendation_review = $this->input->post('recomendation_review');
        $story_rate = $this->input->post('story_rate');
        $animation_rate = $this->input->post('animation_rate');
        $character_rate = $this->input->post('character_rate');
        $enjoy_rate = $this->input->post('enjoy_rate');
        $sound_rate = $this->input->post('sound_rate');
        $overall_sum = array($story_rate, $animation_rate, $character_rate, $enjoy_rate, $sound_rate);
        $overall = array_sum($overall_sum) / 5;

        $overall_rate = round($overall) / 2;


        if (isset($review_process) && empty($review_process)) {
            $data = array('result' => 'error', 'msg' => 'Please Enter Review');
            echo json_encode($data);
            die;
        }
        if (isset($recomendation_review) && empty($recomendation_review)) {
            $data = array('result' => 'error', 'msg' => 'Please Enter Recomendation');
            echo json_encode($data);
            die;
        }



        if (isset($story_rate) && empty($story_rate)) {
            $data = array('result' => 'error', 'msg' => 'Please Rate Story');
            echo json_encode($data);
            die;
        }
        if (isset($animation_rate) && empty($animation_rate)) {
            $data = array('result' => 'error', 'msg' => 'Please Rate Animation');
            echo json_encode($data);
            die;
        }
        if (isset($character_rate) && empty($character_rate)) {
            $data = array('result' => 'error', 'msg' => 'Please Rate Character');
            echo json_encode($data);
            die;
        }
        if (isset($enjoy_rate) && empty($enjoy_rate)) {
            $data = array('result' => 'error', 'msg' => 'Please Enjoyment Story');
            echo json_encode($data);
            die;
        }
        if (isset($sound_rate) && empty($sound_rate)) {
            $data = array('result' => 'error', 'msg' => 'Please Rate Sound');
            echo json_encode($data);
            die;
        }
        if (isset($story_review) && empty($story_review)) {
            $data = array('result' => 'error', 'msg' => 'Please Enter Story Review');
            echo json_encode($data);
            die;
        }
        if (isset($animation_review) && empty($animation_review)) {
            $data = array('result' => 'error', 'msg' => 'Please Enter Animation Review');
            echo json_encode($data);
            die;
        }
        if (isset($character_review) && empty($character_review)) {
            $data = array('result' => 'error', 'msg' => 'Please Enter Character Review');
            echo json_encode($data);
            die;
        }
        if (isset($enjoy_review) && empty($enjoy_review)) {
            $data = array('result' => 'error', 'msg' => 'Please Enter Enjoyment Review');
            echo json_encode($data);
            die;
        }
        if (isset($sound_review) && empty($sound_review)) {
            $data = array('result' => 'error', 'msg' => 'Please Enter Sound Review');
            echo json_encode($data);
            die;
        }


        $dataArray = array(
            'user_id' => $user_id,
            'anime_id' => $anime_id,
            'spoiler_review' => $spoiler_review,
            'review_process' => $review_process,
            'recomendation_review' => $recomendation_review,
            'story_review' => $story_review,
            'animation_review' => $animation_review,
            'character_review' => $character_review,
            'enjoy_review' => $enjoy_review,
            'sound_review' => $sound_review,
            'story_rate' => $story_rate,
            'animation_rate' => $animation_rate,
            'character_rate' => $character_rate,
            'enjoy_rate' => $enjoy_rate,
            'sound_rate' => $sound_rate,
            'overall_rate' => $overall_rate,
        );
        $this->animemod->add_anime_review($dataArray);
        $data = array('result' => 'success');
        echo json_encode($data);
        die;
    }

    function discussion_list() {

        $main = $this->input->post('main');
        $headerType = $this->input->post('headerType');

        $anime_name = $this->input->post('anime_name');

        if ($anime_name == " ") {
            $anime = 0;
        } else {
            $anime = $anime_name;
        }


        $data['discussion_detail'] = $this->animemod->discussion_list($main, $anime, $headerType);

//        echo "<pre>";
//        print_r($data['discussion_detail']);
//        exit;
        if ($this->session->userdata('user_id')) {
            $data['userid'] = $this->session->userdata('user_id');
        }
        $victory = array();
        $defact = array();
        foreach ($data['discussion_detail'] as $league) {
            if (isset($league->vic_users) && !empty($league->vic_users)) {
                $victory[$league->anime_discussionid] = explode(",", $league->vic_users);
            }
            if (isset($league->def_users) && !empty($league->def_users)) {
                $defact[$league->anime_discussionid] = explode(",", $league->def_users);
            }
        }

//        echo "<pre>";
//        print_r($data);
//        exit;

        $data['victory'] = $victory;
        $data['defact'] = $defact;
        $data['total'] = count($data['discussion_detail']);
        echo $this->load->view('anime_discussion_list', $data, true);
    }

    function discussion_single($anime_discussionid = ' ') {
        $data['recent_disc'] = $this->animemod->getRecentDiscussion(4);
        $data['discussion_detail'] = $this->animemod->single_image_list($anime_discussionid);
        $victory = array();
        $defact = array();
        foreach ($data['discussion_detail'] as $league) {
            if (isset($league->vic_users) && !empty($league->vic_users)) {
                $victory[$league->anime_discussionid] = explode(",", $league->vic_users);
            }
            if (isset($league->def_users) && !empty($league->def_users)) {
                $defact[$league->anime_discussionid] = explode(",", $league->def_users);
            }
        }

//        echo "<pre>";
//        print_r($data['recent_disc']);
//        exit;

        $data['victory'] = $victory;
        $data['defact'] = $defact;
        $data['username'] = $this->session->userdata('uname');
        $data['userid'] = $this->session->userdata('user_id');
        $data['userdetail'] = $this->userdetail();
        $data["side_link"] = $this->hm->get_all_sidelinksside();
        $data["side_linkss"] = $this->hm->get_all_sidelinksnoside();
        $data["side_links"] = array_merge($data["side_link"], $data["side_linkss"]);
        $data['content'] = $this->load->view('discussion_single', $data, TRUE);
        load_public_template($data);
    }

    function anime_victory() {
        $user_id = $this->session->userdata('user_id');
        if ($user_id != '') {
            $discussion_id = $this->input->post("victory");
            $result = $this->animemod->point_anime($user_id, $discussion_id);
            //print_r($result);

            if ($result) {
                $point_status = $result['points'];
                $point_id = $result['point_id'];
                if ($point_status == 'L') {
                    $this->animemod->removelikepoint($user_id, $discussion_id);
                    echo json_encode(array('status' => 'delete'));
                    exit;
                } else {
                    $victoryArray = array(
                        'points' => 'L'
                    );
                    $this->animemod->updatelikepoint($victoryArray, $point_id);
                    echo json_encode(array('status' => 'update'));
                    exit;
                }
            } else {
                $victoryArray = array(
                    'anime_discussionid' => $discussion_id,
                    'user_id' => $this->session->userdata('user_id'),
                    'points' => 'L',
                );
                $this->animemod->add_discussionpoint($victoryArray);

                echo json_encode(array('status' => 'insert'));
                exit;
            }
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

    function anime_defeat() {
        $user_id = $this->session->userdata('user_id');
        if ($user_id != '') {
            if ($this->session->userdata('user_id')) {
                $discussion_id = $this->input->post("defeat");
                $result = $this->animemod->point_anime($user_id, $discussion_id);
                if ($result) {
                    $point_status = $result['points'];
                    $point_id = $result['point_id'];
                    if ($point_status == 'D') {
                        $this->animemod->removedislikepoint($user_id, $discussion_id);
                        echo json_encode(array('status' => 'delete'));
                        exit;
                    } else {
                        $victoryArray = array(
                            'points' => 'D'
                        );
                        $this->animemod->updatelikepoint($victoryArray, $point_id);

                        echo json_encode(array('status' => 'update'));
                        exit;
                    }
                } else {
                    $victoryArray = array(
                        'anime_discussionid' => $discussion_id,
                        'user_id' => $this->session->userdata('user_id'),
                        'points' => 'D',
                    );
                    $this->animemod->add_discussionpoint($victoryArray);


                    echo json_encode(array('status' => 'insert'));
                    exit;
                }
            }
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

    function getCommentData() {

        $id = $this->input->post('cmtDATAid');
        $cmtdata = $data_side = $this->animemod->getDiscussionCommentData($id);

        $total_comment = 0;

        $data['return_array'] = array();
        foreach ($cmtdata as $cmt) {

            if ($cmt->parent_id == 0 && !isset($return_array[$cmt->comment_id])) {
                $return_array[$cmt->comment_id] = array();
                $return_array[$cmt->comment_id]['main_comment'] = $cmt;
                $return_array[$cmt->comment_id]['main_comment']->total_like = $this->animemod->getDiscussionCommentLikes($cmt->comment_id);
                $return_array[$cmt->comment_id]['main_comment']->total_dislike = $this->animemod->getDiscussionCommentDislikes($cmt->comment_id);
            } else if ($cmt->parent_id != 0) {
                $cmt->total_like = $this->animemod->getDiscussionCommentLikes($cmt->comment_id);
                $cmt->total_dislike = $this->animemod->getDiscussionCommentDislikes($cmt->comment_id);
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

//        echo "<pre>";
//        print_r($data['comments']);
//        exit;
//        $htmldata[] = $this->load->view('commets', $data, true);
//        print_r($htmldata);
        echo $this->load->view('commets', $data, true);
    }

    function getCommentFData() {
        $id = $this->input->post('cmtDATAid');
        $cmtdata = $data_side = $this->animemod->getDiscussionCommentData($id);

        $data['return_array'] = array();

        foreach ($cmtdata as $cmt) {

            if ($cmt->parent_id == 0 && !isset($return_array[$cmt->comment_id])) {

                $return_array[$cmt->comment_id] = array();
                $return_array[$cmt->comment_id]['main_comment'] = $cmt;
                $return_array[$cmt->comment_id]['main_comment']->total_like = $this->animemod->getDiscussionCommentLikes($cmt->comment_id);
                $return_array[$cmt->comment_id]['main_comment']->total_dislike = $this->animemod->getDiscussionCommentDislikes($cmt->comment_id);
            } else if ($cmt->parent_id != 0) {
                $cmt->total_like = $this->animemod->getDiscussionCommentLikes($cmt->comment_id);
                $cmt->total_dislike = $this->animemod->getDiscussionCommentDislikes($cmt->comment_id);
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

//        echo "<pre>";
//        print_r($data['comments']);
//        exit;
//        $htmldata[] = $this->load->view('commets', $data, true);
//        print_r($htmldata);
        echo $this->load->view('commets', $data, true);
    }

    function addNewComment() {
        $dataAnime = $this->input->post('animeuniqueType');
        $cmtdate = date('Y-m-d H:i:s');
        if (isset($dataAnime) && !empty($dataAnime)) {

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

            $ins_comment = array(
                'user_id' => $this->input->post('user_id'),
                'anime_discussionid' => $this->input->post('discuusion_id'),
                'parent_id' => $this->input->post('parent'),
                'comment' => $this->input->post('cmt'),
                'comment_date' => $cmtdate,
                'discussion_image' => $filename
            );

            $allComment = array(
                'user_id' => $this->input->post('user_id'),
//                'anime_discussionid' => $this->input->post('anime_discussionid'),
                'discuusion_id' => $this->input->post('discuusion_id'),
                'parent' => $this->input->post('parent'),
                'cmt' => $this->input->post('cmt'),
            );
        } else {
            $allComment = $this->input->post('cmtData');
            
            $ins_comment = array(
                'user_id' => $allComment['user_id'],
                'anime_discussionid' => $allComment['discuusion_id'],
                'parent_id' => $allComment['parent'],
                'comment' => $allComment['cmt'],
                'comment_date' => $cmtdate,
            );
        }

        $insertid = $this->animemod->add_discussion_comment($ins_comment);

        $getuserdata = $this->hm->getuserdata($allComment['user_id']);
        $data['userdata'] = $allComment;
        $data['useralldata'] = $getuserdata;
        $data['comment_date'] = $cmtdate;
        $data['lastid'] = $insertid;

        echo $this->load->view('addcomment', $data, true);
    }

    function discussionCommentLikedislike() {

        $status = $this->input->post('status');
        $user_id = $this->input->post('user_id');
        $comment_id = $this->input->post('comment_id');
        $check = $this->animemod->check_discussionlike($user_id, $comment_id);

        if ($status == "dislike") {


            if (empty($check)) {
                $data = array(
                    'user_id' => $user_id,
                    'comment_id' => $comment_id,
                    'like' => 0
                );
                $query = $this->animemod->add_discussionlike($data);
                if ($query) {
                    $result = array(
                        'like' => $this->animemod->getDiscussionCommentLikes($comment_id),
                        'dislike' => $this->animemod->getDiscussionCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/down-reply-hover.png">'
                    );
// echo json_encode($result);
                }
            } elseif ($check[0]->like == 0) {

                $query = $this->animemod->delete_discussion_like($user_id, $comment_id);
                if ($query) {
                    $result = array(
                        'like' => $this->animemod->getDiscussionCommentLikes($comment_id),
                        'dislike' => $this->animemod->getDiscussionCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/down-reply.png" >'
                    );
// echo json_encode($result);
                }
            } else {

                $data = array(
                    'like' => 0
                );
                $query = $this->animemod->update_discussion_like($user_id, $comment_id, $data);
                if ($query) {
                    $result = array(
                        'like' => $this->animemod->getDiscussionCommentLikes($comment_id),
                        'dislike' => $this->animemod->getDiscussionCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/down-reply-hover.png" >'
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
                $query = $this->animemod->add_discussionlike($data);

                if ($query) {

                    $result = array(
                        'like' => $this->animemod->getDiscussionCommentLikes($comment_id),
                        'dislike' => $this->animemod->getDiscussionCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/up-reply-hover.png" >'
                    );
// echo json_encode($result);
                }
            } elseif ($check[0]->like == 1) {
                $query = $this->animemod->delete_discussion_like($user_id, $comment_id);

                if ($query) {
                    $result = array(
                        'like' => $this->animemod->getDiscussionCommentLikes($comment_id),
                        'dislike' => $this->animemod->getDiscussionCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/up-reply.png">'
                    );
//  echo json_encode($result);
                }
            } else {
                $data = array(
                    'like' => 1
                );
                $query = $this->animemod->update_discussion_like($user_id, $comment_id, $data);
                if ($query) {
                    $result = array(
                        'like' => $this->animemod->getDiscussionCommentLikes($comment_id),
                        'dislike' => $this->animemod->getDiscussionCommentDislikes($comment_id),
                        'icon' => ' <img src="' . base_url() . 'assets/public/img/up-reply-hover.png">'
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

    function delete_discusion_comment() {

        $comment_id = $this->input->post("comment_id");
        $user_id = $this->input->post("u_id");
        $this->animemod->delete_disccusion_comment($comment_id, $user_id);
        echo "success";
    }

    function getsubcomment_ajax() {
        $parent_id = $this->input->post('pid');
        //echo "parent_id" .$parent_id;exit;
        $cmtdata = $data_side = $this->animemod->getDisccusionCmtData_subComment($parent_id);
        // print_r($cmtdata);
        $i = 0;
        foreach ($cmtdata as $cmt) {

            $total_likes = $this->animemod->getDiscussionCommentLikes($cmt->comment_id);
            $total_Dislikes = $this->animemod->getDiscussionCommentDislikes($cmt->comment_id);
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

    function getsubcomment_ajaxreview() {
        $parent_id = $this->input->post('pid');
        //echo "parent_id" .$parent_id;exit;
        $cmtdata = $data_side = $this->animemod->getReviewCmtData_subComment($parent_id);
        // print_r($cmtdata);
        $i = 0;
        foreach ($cmtdata as $cmt) {

            $total_likes = $this->animemod->getReviewCommentLikes($cmt->rev_commentid);
            $total_Dislikes = $this->animemod->getReviewCommentDislikes($cmt->rev_commentid);
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

            $html .= ' <div class="user-comment row chdrepl_' . $parent_id . '" id="childid_' . $value->rev_commentid . '" >
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
                                            <span class="nick us-name getusername__' . $value->rev_commentid . '">' . $value->user_name . '</span>
                                        </h5></a>
                                    <div class="date"><span class="points" id="countLike_' . $value->rev_commentid . '">' . $like_dislike[$j]['total_cmtrplpoint'] . '</span> Point - <a href=""> 
                                            <span class="points" data-livestamp="' . strtotime($value->review_comment_timestamp) . '"> </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <p class="dis-cap comment-field-user">';
            $html .= $value->review_comment . ' 
                            </p>';

            $html .= ' <div class="reply-comment">
                                <div class="' . $value->rev_commentid . '" >
                                    <ul class="list-inline" id="' . $parent_id . '" >';

            $user_id = $this->session->userdata('user_id');
            if ($user_id) {

                $html .= '<li class="childsubcmtrpl" id="childsubcmtrpl_' . $parent_id . '"><a style="cursor: pointer;"  href="javascript:void(0);"><span>Reply</span></a></li>';
            } else {

                $html .='<li><a  style="cursor: pointer;" href="javascript:void(0);" id="login" style="cursor: pointer" data-toggle="modal" data-target="#login"><span>Reply</span></a></li>';
            }

            //$user_id = $this->session->userdata('user_id');
            if ($user_id) {

                $html .='<li><a class="hvr-bounce-in" style="cursor: pointer;" id="like_' . $value->rev_commentid . '" onclick="like(' . $user_id . ',' . $value->rev_commentid . ')"> ';

                if ($value->cmnt_user_id == $user_id && $value->cmnt_comment_id == $value->rev_commentid && $value->like == 1) {

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

                $html .='<li class="comment-disvote"><a style="cursor: pointer;" class="hvr-bounce-in" id="dislike_' . $value->rev_commentid . '" onclick="dislike(' . $user_id . ',' . $value->rev_commentid . ')">';

                if ($value->cmnt_user_id == $user_id && $value->cmnt_comment_id == $value->rev_commentid && $value->like == 0) {

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

                    $html .='<li><a title="Deletecommet" style="cursor: pointer;" class="hvr-bounce-in" onClick="delete_Comment(' . $value->rev_commentid . ',' . '\'off\',' . $user_id . ')"><i class="fa fa-remove fa-lg"></i></a></li>';
                }
            }

            $html .='</ul>
                                    <div class="comment-container">
                                    <div id="childrplycmtbox-' . $value->rev_commentid . '" style="display:none" class="childrplycmtbox-' . $parent_id . '"  >
                                        <div  id="' . $parent_id . '">
                                            <textarea class="comment-box form-control form-comment childinnercomboBox" placeholder="Comment reply" id="childaddrplCommentBox-' . $value->rev_commentid . '" ></textarea>
                                            <div  id="' . $parent_id . '">
                                                <button class="pull-right small-btn green-bg btn childcommentrplPostBtn" id="' . $value->rev_commentid . '"  >Reply</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-2  pull-right comment-count" id="childinerwordcountdiv' . $value->rev_commentid . '">
                                            <p>1000</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>  </div>';
        }
        echo $html;
    }
    function update_disc_desc(){
        $data = array(
            "description" => $_POST['desc']
        );
        echo $this->animemod->updateDiscussion($data,$_POST['id']);
    }
    function deletedescussion(){
        echo $this->animemod->deleteDiscussion($_POST['id']);
    }
}
