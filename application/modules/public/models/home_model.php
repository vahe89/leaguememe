<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 * @author abc
 */
class Home_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_sub_tabs() {
        $this->db->select('*');
        $this->db->from('le_category');
        $this->db->order_by("category_name", "asc");
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_anime_list() {
        $this->db->select('*');
        $this->db->from('anime');
        $this->db->order_by("anime_name", "asc");
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_searchanime_list($search) {
        $this->db->select('*');
        $this->db->from('anime');
        $this->db->like('anime_name', $search);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_all_sidelinksnoside($start = 0, $maintabval = "new") {
        if (empty($maintabval)) {
            $maintabval = 'Y';
        } else if ($maintabval == "new") {
            $maintabval = 'N';
        } else {
            $maintabval = 'Y';
        }

        $sql = "SELECT * 
               FROM le_leagueimages
               WHERE `leagueimage_setpopular` = '" . $maintabval . "' AND is_sidebar = 0
               ORDER BY is_sidebar ASC, RAND() ASC LIMIT " . $start . ",100";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_all_sidelinksside($maintabval = "new") {
        if (empty($maintabval)) {
            $maintabval = 'Y';
        } else if ($maintabval == "new") {
            $maintabval = 'N';
        } else {
            $maintabval = 'Y';
        }

        $sql = "SELECT * 
                FROM le_leagueimages
                WHERE `leagueimage_setpopular` = '" . $maintabval . "'
                AND is_sidebar = 1";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_new_post() {
        $sql = "SELECT *
                FROM le_leagueimages
                WHERE leagueimage_setpopular = 'N'
                AND parent_id = '0'
                ORDER BY leagueimage_id DESC
                LIMIT 0, 4";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_newlike() {


        $sql = "SELECT ad. *, lv. *, la . *, a.anime_name
                FROM le_victory AS lv
                RIGHT JOIN (

                SELECT *
                FROM `le_animecategory`
                GROUP BY leaguememe_id
                ORDER BY leaguememe_id DESC
                ) AS la ON la.leaguememe_id = lv.leagueimages_id
                LEFT JOIN (

                SELECT *
                FROM anime
                ) AS a ON a.anime_id = la.anime_categoryid
                LEFT JOIN (

                SELECT *
                FROM `le_leagueimages`
                ) AS ad ON ad.leagueimage_id = lv.leagueimages_id
                WHERE victory_defeat = 'V'
                ORDER BY lv.victory_timestamp DESC
                LIMIT 0, 4";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_let_discussion() {


        $sql = "SELECT ad.*, adc.*, a.anime_name
                FROM `anime_discussion` as ad
                RIGHT JOIN
                (
                SELECT *
                FROM `anime_discussion_category`
                GROUP BY anime_category_id
                ORDER BY anime_discussionid desc
                ) as adc ON adc.anime_discussionid = ad.anime_discussionid
                LEFT JOIN
                (
                SELECT *
                FROM anime
                ) as a ON a.anime_id = adc.anime_category_id
                WHERE ad.`header_type` = 1
                ORDER BY ad.anime_discussionid desc
                LIMIT 0, 4";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getLegaueCmtData(
    $legid) {
        $sql = 'SELECT cp.*, cp.user_id as cmnt_user_id, cp.comment_id as cmnt_comment_id,le_ct. * , u.user_name,u.user_region, CASE WHEN (u.user_image IS NULL OR u.user_image = "")
		 THEN "0"
		 ELSE u.user_image
        END AS user_image
                FROM `le_comments` AS le_ct
                LEFT JOIN le_users AS u ON le_ct.user_id = u.user_id
                LEFT JOIN comment_points AS cp ON cp.comment_id = le_ct.comment_id
                WHERE le_ct.leagueimage_id =' . $legid . '
                ORDER BY `parent_id`,`comment_date` desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getLegaueCmtfData(
    $legid) {

        $sql = 'SELECT cp.*, cp.user_id as cmnt_user_id, cp.comment_id as cmnt_comment_id,le_ct. * , u.user_name,u.user_region,u.user_image
                FROM `le_comments` AS le_ct
                LEFT JOIN le_users AS u ON le_ct.user_id = u.user_id
                LEFT JOIN comment_points AS cp ON cp.comment_id = le_ct.comment_id
                WHERE le_ct.leagueimage_id =' . $legid . '
                ORDER BY `parent_id`,`comment_date` desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getCommentLikes(
    $comment_id) {
        $this->db->select('like');
        $this->db->from('comment_points');
        $this->db->where('like', '1');
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function getCommentDislikes(
    $comment_id) {
        $this->db->select('like');
        $this->db->from('comment_points');
        $this->db->where('like', '0');
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return count($query->result_array());
    }

    function check_like(
    $user_id, $comment_id) {
        $this->db->select('*');
        $this->db->from('comment_points');
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return $query->result();
    }

    function like(
    $data) {
        $this->db->insert('comment_points', $data);
        return TRUE;
    }

    function update_like(
    $user_id, $comment_id, $data) {
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $this->db->update('comment_points', $data);
        return TRUE;
    }

    function delete_like(
    $user_id, $comment_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $this->db->delete('comment_points');
        return TRUE;
    }

    function add_comment($ins_comment) {
        $this->db->insert('le_comments', $ins_comment);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function getuserdata($id) {
        $this->db->select('*');
        $this->db->from('le_users');
        $this->db->where('user_id', $id);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getLegaueCmtData_subComment($pid) {
        $sql = 'SELECT cp.*, cp.user_id as cmnt_user_id, cp.comment_id as cmnt_comment_id,le_ct.*, u.user_name,u.user_region, CASE WHEN (u.user_image IS NULL OR u.user_image = "")
   THEN "0"
   ELSE u.user_image
        END AS user_image
                FROM `le_comments` AS le_ct
                LEFT JOIN le_users AS u ON le_ct.user_id = u.user_id
                LEFT JOIN comment_points AS cp ON cp.comment_id = le_ct.comment_id
                WHERE le_ct.parent_id =' . $pid . '
                ORDER BY `comment_date` desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

}

?>
