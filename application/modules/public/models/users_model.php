<?php

/**
 * Description of crud
 *
 * @author abc
 */
class Users_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function user_login($username, $password) {
        $this->db->select('*');
        $this->db->from('le_users');
        $this->db->where('user_name = ' . "'" . $username . "'");
        $this->db->where('user_password = ' . "'" . MD5($password) . "'");
        $this->db->where('user_status', 'A');
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function userdetails($username, $password) {
        $this->db->select('*');
        $this->db->from('le_users');
        $this->db->where('user_name', $username);
        $this->db->where('user_password', MD5($password));
        $this->db->where('user_status', 'A');
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function userProfile_detail($session) {
        $this->db->select('*');
        $this->db->from('le_users');
        $this->db->where('user_id', $session);
        $this->db->where('user_status', 'A');
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function userOtherProfile_detail($session) {
        $this->db->select('*');
        $this->db->from('le_users');
        $this->db->where('user_name', $session);
        $this->db->where('user_status', 'A');
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function check_ban_status($uid) {

        $this->db->select('*');
        $this->db->from('le_banusers');
        $this->db->where('user_id', $uid);
        $this->db->where('ban_status = "A"');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    function updateUserByEmail($name, $dataArr) {
        $this->db->where('user_name', $name)->update('le_users', $dataArr);
    }

    function updateUserByName($email, $dataArr) {
        $this->db->where('user_email', $email)->update('le_users', $dataArr);
    }

    function addUser($dataArr) {
        $this->db->insert('le_users', $dataArr);
        return $this->db->insert_id();
    }

    function email_check($user_email) {
        $this->db->select('*');
        $this->db->from('le_users');
        $this->db->where('user_email', $user_email);
        $query = $this->db->get();
        return $query->result();
    }

    function user_check($u_name) {
        $this->db->select('*');
        $this->db->from('le_users');
        $this->db->where('user_name', $u_name);
        $query = $this->db->get();
        return $query->result();
    }

    function updateUserProfile($user_id, $dataArr) {
        $this->db->where('user_id', $user_id)->update('le_users', $dataArr);
    }

    function updateUserCover($user_id, $dataArr) {
        $this->db->where('user_id', $user_id)->update('le_users', $dataArr);
    }

    function add_follower($dataArr) {
        $this->db->insert('le_follower', $dataArr);
        return $this->db->insert_id();
    }

    function follow_check($user_id, $follow) {
        $this->db->select('*');
        $this->db->from('le_follower');
        $this->db->where('user_id', $user_id);
        $this->db->where('following_id', $follow);
        $query = $this->db->get();
        return $query->row_array();
    }

    function updateFollowStatus($followArray, $follow) {
        $this->db->where('follow_id', $follow)->update('le_follower', $followArray);
        return;
    }

    function removeFollow($user_id, $follow_id) {
        $this->db->where('follow_id', $follow_id)
                ->where('user_id', $user_id)
                ->where('follow_status', "1")
                ->delete('le_follower');
//        echo $this->db->last_query(); die
    }

    function following_count($user_id) {
        $this->db->select('count(follow_id) as total_following');
        $this->db->from('le_follower');
        $this->db->where('user_id', $user_id);
        $this->db->where('follow_status', '1');
        $query = $this->db->get();
        return $query->row();
    }

    function follower_count($user_id) {
        $this->db->select('count(follow_id) as total_follower');
        $this->db->from('le_follower');
        $this->db->where('following_id', $user_id);
        $this->db->where('follow_status', '1');
        $query = $this->db->get();
        return $query->row();
    }

    function follower_list($user_id) {
        $this->db->select('*');
        $this->db->from('le_follower as l_foll');
        $this->db->join('le_users as l_user', 'l_user.user_id= l_foll.user_id', 'left');
        $this->db->where('following_id', $user_id);
        $this->db->where('follow_status', '1');
        $query = $this->db->get();
        return $query->result_array();
    }

    function following_list($user_id) {
        $this->db->select('*');
        $this->db->from('le_follower as l_foll');
        $this->db->join('le_users as l_user', 'l_user.user_id= l_foll.following_id', 'left');
        $this->db->where('l_foll.user_id', $user_id);
        $this->db->where('l_foll.follow_status', '1');
        $query = $this->db->get();
        return $query->result_array();
    }

    function user_post_list($user_id) {
        $this->db->select('*');
        $this->db->from('le_leagueimages as l_league');
        $this->db->join('le_users as l_user', 'l_user.user_id= l_league.leagueimage_userid', 'left');
        $this->db->where('leagueimage_userid', $user_id);
        $this->db->where('parent_id', '0');
        $this->db->order_by("leagueimage_id", "desc");

        $query = $this->db->get();
        return $query->result_array();
    }

    function add_comment_Attimeline($dataArray) {
        $this->db->insert('timeline_comment', $dataArray);
        return $this->db->insert_id();
    }

    function comment_timeline_fetch($user_id, $per_page, $offset) {
        $this->db->select('*');
        $this->db->from('timeline_comment as comment');
        $this->db->join('le_users as l_user', 'l_user.user_id= comment.user_id', 'left');
        $this->db->where('other_user_id', $user_id);
        $this->db->order_by('profile_comment_id', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    function count_timeline_comment($user_id) {
        $this->db->select('count(profile_comment_id) as total_comment_id');
        $this->db->from('timeline_comment');
        $this->db->where('other_user_id', $user_id);
        $query = $this->db->get();
        return $query->row();
    }

    function add_notification($notificationArray) {
        $this->db->insert('le_notification', $notificationArray);
        return $this->db->insert_id();
    }

    function delete_notification($league_image_id, $user_id, $other_id, $comment_id) {
        $this->db->where('leagueimage_id', $league_image_id)
                ->where('user_id', $other_id)
                ->where('other_user_id', $user_id)
                ->where('le_comment_id', $comment_id)
                ->delete('le_notification');
//           echo $this->db->last_query(); die;
    }

    function getNotificationDetail($user_id) {
        $this->db->select('le_not.id, le_not.le_comment_id, le_not.user_id, le_not.other_user_id, le_not.leagueimage_id, le_not.pre_value,'
                . 'le_not.status, le_not.noti_timestamp, le_not.noti_date, l_user.user_name, l_user.name, l_user.user_email, l_user.user_region,'
                . 'l_user.user_image, l_user.cover_image, le_league.leagueimage_name, le_league.leagueimage_filename,'
                . 'le_league.leagueimage_status, le_league.image_spoiler, le_league.image_nsfw, le_cmt.comment, le_cmt.le_comment_image,'
        );
        $this->db->from('le_notification as le_not');
        $this->db->join('le_users as l_user', 'l_user.user_id = le_not.other_user_id', 'left');
        $this->db->join('le_leagueimages as le_league', 'le_league.leagueimage_id= le_not.leagueimage_id', 'left');
        $this->db->join('le_comments as le_cmt', 'le_cmt.comment_id= le_not.le_comment_id', 'left');
        $this->db->where('le_not.user_id', $user_id);
        $this->db->order_by("le_not.noti_timestamp", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    function getNotificationDetails($user_id) {
        $this->db->select('*');
        $this->db->from('le_notification as le_not');
        $this->db->join('le_users as l_user', 'l_user.user_id = le_not.other_user_id', 'left');
        $this->db->join('le_leagueimages as le_league', 'le_league.leagueimage_id= le_not.leagueimage_id', 'left');
        $this->db->where('le_not.user_id', $user_id);
        $this->db->where('le_not.status', 'unread');
        $this->db->order_by("le_not.noti_timestamp", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    function update_notification($dataArray, $user_id) {
        $this->db->where('user_id', $user_id)->update('le_notification', $dataArray);
        return;
    }

    function getSingleNotificationDetail($user_id, $date) {
        $this->db->select('*');
        $this->db->from('le_notification as le_not');
        $this->db->join('le_users as l_user', 'l_user.user_id = le_not.other_user_id', 'left');
        $this->db->join('le_leagueimages as le_league', 'le_league.leagueimage_id= le_not.leagueimage_id', 'left');
        $this->db->where('le_not.user_id', $user_id);
        $this->db->like('le_not.noti_date', $date);
        $this->db->order_by("le_not.noti_timestamp", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    function getgroupData($user_id) {
        $this->db->select('*,GROUP_CONCAT(le_not.noti_date) as date');
        $this->db->from('le_notification as le_not');
        $this->db->where('le_not.user_id', $user_id);
        $this->db->order_by("date", "desc");
        $this->db->group_by("le_not.noti_date");
        $query = $this->db->get();
        return $query->result_array();
    }

    function getUserNotificationDetail($league_image_id) {
        $this->db->select('*');
        $this->db->from('le_leagueimages');
        $this->db->where('leagueimage_id', $league_image_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function updateUserById($userId, $data) {
        $this->db->where('user_id', $userId)
                ->update('le_users', $data);
    }

    function getUserById($userID) {
        return $this->db->select('*')
                        ->from('le_users')
                        ->where('user_id', $userID)
                        ->get()
                        ->row();
    }

    function get($from, $where) {
        return $this->db->from($from)
                        ->where($where)
                        ->get();
    }

    function update_UserProfile($user_id, $dataArr) {
        $this->db->where('user_id', $user_id)
                ->update('le_users', $dataArr);
        return;
    }

    function update_username_email($user_id, $dataArr) {
        $this->db->where('user_id', $user_id)
                ->update('le_users', $dataArr);
        return;
    }

    function forgot_pswdd($user_email) {
        $this->db->select('*');
        $this->db->from('le_users');
//        $this->db->where('user_email = ' . "'" . $user_email . "'");
        $this->db->where('user_email', $user_email);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    function forgot_pswdd_userid($user_email) {
        $this->db->select('user_id');
        $this->db->from('le_users');
//        $this->db->where('user_email = ' . "'" . $user_email . "'");
        $this->db->where('user_email', $user_email);
        $this->db->limit(1);
        $query = $this->db->get();
        $data = $query->result();
        if (!empty($data)) {
            return $data[0]->user_id;
        }
    }

    function get_user_by_id($user_id) {
        $this->db->select('*');
        $this->db->from('le_users');
        $this->db->where('user_id = ' . "'" . $user_id . "'");
        $this->db->where('user_status', 'A');
        $query = $this->db->get();
        return $query->row();
    }

    function update_bio($user_id, $dataArr) {
        return $this->db->where('user_id', $user_id)
                        ->update('le_users', $dataArr);
    }

    function getSummoner($user) {
        $row = $this->db->where("user_id", $user)->get("summoner");
        return $row->row();
    }

    function updateSummoner($user, $data) {
        return $this->db->where("user_id", $user)->update("summoner", $data);
    }

    function saveSummoner($data) {
        return $this->db->insert("summoner", $data);
    }

    function summonerExist($user) {
        $rows = $this->db->where("user_id", $user)
                ->get("summoner");
        return $rows->num_rows();
    }

}

?>