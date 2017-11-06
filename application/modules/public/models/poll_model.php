<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Poll_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function all_poll_question() {

        $quy = 'SELECT  poll.*,
            bb.anime_cat,bb.anime_nm,
                 
                 
                /* user data */
                user.user_name,
                user.name,
                user.user_email,
                user.user_region,
                user.user_image,
                user.online_status,
              /*  victory victory.total_victory,victoryd.`total_defeat` */
                victory.vic_users,
                victoryd.def_users,
                CASE WHEN (victory.`total_victory` IS NULL OR victory.`total_victory` = "")
                         THEN "0"
                         ELSE victory.`total_victory`
                END AS total_victory,
                CASE WHEN (victoryd.`total_defeat` IS NULL OR victoryd.`total_defeat` = "")
                         THEN "0"
                         ELSE victoryd.`total_defeat`
                END AS total_defeat,   
              /*  Total Comment comment.total_comment,*/
               CASE WHEN (comment.`total_comment` IS NULL OR comment.`total_comment` = "")
                         THEN "0"
                         ELSE comment.`total_comment`
                END AS total_comment,
                cmtData.commentid,
                cmtData.prcmt,
                cmtData.userid,
                cmtData.childcmtid,
                cmtData.childcmt,  
                cmtData.childcmtuserid,
                cmtData.childcmtdate
                
                
        FROM poll_data AS poll
          LEFT JOIN 
         (
           SELECT GROUP_CONCAT(c.comment_id) AS commentid,
                  GROUP_CONCAT(c.comment,"%%**%%") AS prcmt,
                  GROUP_CONCAT(c.user_id) AS userid,
                  GROUP_CONCAT(chdg.chdcomment,"%%") AS childcmt,
                  GROUP_CONCAT(chdg.chdcomment_id,"%%") AS childcmtid,
                  GROUP_CONCAT(chdg.chdcomment_userid,"%%") AS childcmtuserid,
                  GROUP_CONCAT(chdg.chdcomment_date,"%%") AS childcmtdate,
                  GROUP_CONCAT(chdg.luser_name,"%%") AS childusername,
                  c.*
           FROM anime_comments_poll AS c
           LEFT JOIN
           (
              SELECT i.*,
                     GROUP_CONCAT(i.comment,"**^^**") AS chdcomment,
                     GROUP_CONCAT(i.comment_id,"**^^**") AS chdcomment_id,
                     GROUP_CONCAT(i.user_id,"**^^**") AS chdcomment_userid,
                     GROUP_CONCAT(i.comment_date,"**^^**") AS chdcomment_date,
                     GROUP_CONCAT(l_user.user_name,"**^^**") AS luser_name 
              FROM `anime_comments_poll` AS i
              LEFT JOIN `le_users` AS l_user ON l_user.`user_id` = i.`user_id`	      
              GROUP BY i.parent_id 
           ) AS chdg ON chdg.parent_id = c.comment_id
           WHERE c.`parent_id` = 0
           GROUP BY c.poll_id
           ORDER BY c.poll_id 
         ) AS cmtData ON cmtData.`poll_id` = poll.`id` 
        LEFT JOIN
          (
            SELECT u.*
            FROM le_users AS u
            WHERE u.user_status = "A"    
          ) AS user ON  poll.league_userid = user.user_id
           LEFT JOIN
         (
            SELECT count(vic.point_id) AS total_victory,
                   GROUP_CONCAT(vic.user_id) AS vic_users,
                   vic.*
            FROM poll_points as vic 
            WHERE vic.points = "L"
            GROUP BY vic.poll_id
            ORDER BY vic.poll_id
         ) AS victory ON victory.poll_id = poll.`id`
         LEFT JOIN
         (
            SELECT count(vicd.point_id) AS total_defeat,
                   GROUP_CONCAT(vicd.user_id) AS def_users,
                   vicd.*
            FROM poll_points as vicd 
            WHERE vicd.points = "D"
            GROUP BY vicd.poll_id
            ORDER BY vicd.poll_id
         ) AS victoryd ON victoryd.poll_id = poll.`id`
          LEFT JOIN
         (
            SELECT count(cmt.comment) AS total_comment,
                   cmt.*
            FROM  anime_comments_poll as cmt
            WHERE cmt.`parent_id` = 0 
            GROUP BY cmt.poll_id
            ORDER BY cmt.poll_id
         ) AS comment ON comment.`poll_id` = poll.`id`
         LEFT JOIN
        (
          SELECT b.*,
                  GROUP_CONCAT(b.anime_categoryid) as anime_cat,
               GROUP_CONCAT(cc.anime_nm) as anime_nm      
            FROM `le_poll_animecategory` as b
            LEFT JOIN
            (
             SELECT c.*,
                 GROUP_CONCAT(c.anime_name) as anime_nm
                FROM anime as c
                GROUP BY c.anime_id
                ORDER BY c.anime_id
            ) as cc on cc.anime_id = b.anime_categoryid
            GROUP BY b.leaguememe_poll_id
            Order by b.leaguememe_poll_id
        ) as bb on poll.id = bb.leaguememe_poll_id
        ORDER BY id DESC';

        $query = $this->db->query($quy);
//        echo $this->db->last_query();
//        exit;
        return $query->result_array();
    }

    function add_comment($ins_comment) {
        $this->db->insert('anime_comments_poll', $ins_comment);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function getPollCommentData($legid) {
        $sql = 'SELECT cp.*, cp.user_id as cmnt_user_id, cp.comment_id as cmnt_comment_id,le_ct. * , u.user_name,u.user_region, CASE WHEN (u.user_image IS NULL OR u.user_image = "")
		 THEN "0"
		 ELSE u.user_image
        END AS user_image
                FROM `anime_comments_poll` AS le_ct
                LEFT JOIN le_users AS u ON le_ct.user_id = u.user_id
                LEFT JOIN poll_comment_points AS cp ON cp.comment_id = le_ct.comment_id
                WHERE le_ct.poll_id =' . $legid . '
                ORDER BY `parent_id`,`comment_date` desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getCommentLikes($comment_id) {
        $this->db->select('like');
        $this->db->from('poll_comment_points');
        $this->db->where('like', '1');
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function getCommentDislikes($comment_id) {
        $this->db->select('like');
        $this->db->from('poll_comment_points');
        $this->db->where('like', '0');
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function getPollCommentFData($legid) {

        $sql = 'SELECT cp.*, cp.user_id as cmnt_user_id, cp.comment_id as cmnt_comment_id,le_ct. * , u.user_name,u.user_region,u.user_image
                 FROM `anime_comments_poll` AS le_ct
                LEFT JOIN le_users AS u ON le_ct.user_id = u.user_id
                LEFT JOIN poll_comment_points AS cp ON cp.comment_id = le_ct.comment_id
                WHERE le_ct.poll_id =' . $legid . '
                ORDER BY `parent_id`,`comment_date` desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    function check_pollComment_like($user_id, $comment_id) {
        $this->db->select('*');
        $this->db->from('poll_comment_points');
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return $query->result();
    }

    function pollCommentlike($data) {
        $this->db->insert('poll_comment_points', $data);
        return TRUE;
    }

    function delete_pollCommentlike($user_id, $comment_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $this->db->delete('poll_comment_points');
        return TRUE;
    }

    function update_pollCommentlike($user_id, $comment_id, $data) {
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $this->db->update('poll_comment_points', $data);
        return TRUE;
    }

    function delete_pollComment($league_comment, $userid) {
        $result = $this->db->where('comment_id', $league_comment)->delete('anime_comments_poll');
        $result = $this->db->where('parent_id', $league_comment)->delete('anime_comments_poll');
        $result = $this->db->where('comment_id', $league_comment)->where('user_id', $userid)->delete('poll_comment_points');
        return;
    }

    function single_poll_list($poll_id) {

        $quy = 'SELECT  poll.*,
            bb.anime_cat,bb.anime_nm,
                 
                 
                /* user data */
                user.user_name,
                user.name,
                user.user_email,
                user.user_region,
                user.user_image,
                user.online_status,
              /*  victory victory.total_victory,victoryd.`total_defeat` */
                victory.vic_users,
                victoryd.def_users,
                CASE WHEN (victory.`total_victory` IS NULL OR victory.`total_victory` = "")
                         THEN "0"
                         ELSE victory.`total_victory`
                END AS total_victory,
                CASE WHEN (victoryd.`total_defeat` IS NULL OR victoryd.`total_defeat` = "")
                         THEN "0"
                         ELSE victoryd.`total_defeat`
                END AS total_defeat,   
              /*  Total Comment comment.total_comment,*/
               CASE WHEN (comment.`total_comment` IS NULL OR comment.`total_comment` = "")
                         THEN "0"
                         ELSE comment.`total_comment`
                END AS total_comment,
                cmtData.commentid,
                cmtData.prcmt,
                cmtData.userid,
                cmtData.childcmtid,
                cmtData.childcmt,  
                cmtData.childcmtuserid,
                cmtData.childcmtdate
                
                
        FROM poll_data AS poll
          LEFT JOIN 
         (
           SELECT GROUP_CONCAT(c.comment_id) AS commentid,
                  GROUP_CONCAT(c.comment,"%%**%%") AS prcmt,
                  GROUP_CONCAT(c.user_id) AS userid,
                  GROUP_CONCAT(chdg.chdcomment,"%%") AS childcmt,
                  GROUP_CONCAT(chdg.chdcomment_id,"%%") AS childcmtid,
                  GROUP_CONCAT(chdg.chdcomment_userid,"%%") AS childcmtuserid,
                  GROUP_CONCAT(chdg.chdcomment_date,"%%") AS childcmtdate,
                  GROUP_CONCAT(chdg.luser_name,"%%") AS childusername,
                  c.*
           FROM anime_comments_poll AS c
           LEFT JOIN
           (
              SELECT i.*,
                     GROUP_CONCAT(i.comment,"**^^**") AS chdcomment,
                     GROUP_CONCAT(i.comment_id,"**^^**") AS chdcomment_id,
                     GROUP_CONCAT(i.user_id,"**^^**") AS chdcomment_userid,
                     GROUP_CONCAT(i.comment_date,"**^^**") AS chdcomment_date,
                     GROUP_CONCAT(l_user.user_name,"**^^**") AS luser_name 
              FROM `anime_comments_poll` AS i
              LEFT JOIN `le_users` AS l_user ON l_user.`user_id` = i.`user_id`	      
              GROUP BY i.parent_id 
           ) AS chdg ON chdg.parent_id = c.comment_id
           WHERE c.`parent_id` = 0
           GROUP BY c.poll_id
           ORDER BY c.poll_id 
         ) AS cmtData ON cmtData.`poll_id` = poll.`id` 
        LEFT JOIN
          (
            SELECT u.*
            FROM le_users AS u
            WHERE u.user_status = "A"    
          ) AS user ON  poll.league_userid = user.user_id
           LEFT JOIN
         (
            SELECT count(vic.point_id) AS total_victory,
                   GROUP_CONCAT(vic.user_id) AS vic_users,
                   vic.*
            FROM poll_points as vic 
            WHERE vic.points = "L"
            GROUP BY vic.poll_id
            ORDER BY vic.poll_id
         ) AS victory ON victory.poll_id = poll.`id`
         LEFT JOIN
         (
            SELECT count(vicd.point_id) AS total_defeat,
                   GROUP_CONCAT(vicd.user_id) AS def_users,
                   vicd.*
            FROM poll_points as vicd 
            WHERE vicd.points = "D"
            GROUP BY vicd.poll_id
            ORDER BY vicd.poll_id
         ) AS victoryd ON victoryd.poll_id = poll.`id`
          LEFT JOIN
         (
            SELECT count(cmt.comment) AS total_comment,
                   cmt.*
            FROM  anime_comments_poll as cmt
            WHERE cmt.`parent_id` = 0 
            GROUP BY cmt.poll_id
            ORDER BY cmt.poll_id
         ) AS comment ON comment.`poll_id` = poll.`id`
         LEFT JOIN
        (
          SELECT b.*,
                  GROUP_CONCAT(b.anime_categoryid) as anime_cat,
               GROUP_CONCAT(cc.anime_nm) as anime_nm      
            FROM `le_poll_animecategory` as b
            LEFT JOIN
            (
             SELECT c.*,
                 GROUP_CONCAT(c.anime_name) as anime_nm
                FROM anime as c
                GROUP BY c.anime_id
                ORDER BY c.anime_id
            ) as cc on cc.anime_id = b.anime_categoryid
            GROUP BY b.leaguememe_poll_id
            Order by b.leaguememe_poll_id
        ) as bb on poll.id = bb.leaguememe_poll_id
 
         
                WHERE poll.id = "' . $poll_id . '"
                ';
        $query = $this->db->query($quy);
//        echo $this->db->last_query();
//        exit;
        return $query->result_array();
    }

    function poll_points($user_id, $poll_id) {
        $this->db->select('*');
        $this->db->from('poll_points');
        $this->db->where('user_id', $user_id);
        $this->db->where('poll_id', $poll_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function removepolllikepoints($user_id, $poll_id) {
        $result = $this->db->where('poll_id', $poll_id)
                ->where('user_id', $user_id)
                ->where('points', "L")
                ->delete('poll_points');
    }

    function updatepollpoints($dataArr, $point_id) {
        $this->db->where('point_id', $point_id)->update('poll_points', $dataArr);
        return;
    }

    function add_poll_points($dataArr) {
        $this->db->insert('poll_points', $dataArr);
        return $this->db->insert_id();
    }

    function removepolldislikepoints($user_id, $poll_id) {
        $result = $this->db->where('poll_id', $poll_id)
                ->where('user_id', $user_id)
                ->where('points', "D")
                ->delete('poll_points');
    }

    function check_poll_vote($user_id, $poll_id) {
        $this->db->select('*');
        $this->db->from('poll_vote_result');
        $this->db->where('user_id', $user_id);
        $this->db->where('poll_id', $poll_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function updatepollvote($answerArray, $poll_id, $user_id) {
        $this->db->where('poll_id', $poll_id)->where('user_id', $user_id)->update('poll_vote_result', $answerArray);
        return;
    }

    function addpollvote($answerArray) {
        $this->db->insert('poll_vote_result', $answerArray);
        return $this->db->insert_id();
    }

    public function get_poll_question($poll_id) {
        $this->db->select('*');
        $this->db->from('poll_data');
        $this->db->where('id', $poll_id);
//         $this->db->where('league_userid', $id);
//        $this->db->order_by("category_name", "asc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_poll_answers($poll_id) {
        $this->db->select('count(answer) as total_answer');
        $this->db->from('poll_data as pd');
        $this->db->join('poll_vote_result pvr', 'pvr.poll_id=pd.id', 'right');
        $this->db->where('poll_id', $poll_id);


        $query = $this->db->get();
        return $query->result_array();
    }

//function get_poll_vote($poll_id) {
//    $que = 'SELECT count(user_id) as total, answer FROM `poll_vote_result` WHERE `poll_id` = "' . $poll_id . '" GROUP BY answer';
//    $query = $this->db->query($que);
//    return $query->result_array();
//}
//public function get_poll_vote($poll_id) {
//    $this->db->select('count(user_id) as total, answer');
//    $this->db->group_by('answer');
//    $this->db->from('poll_vote_result');
//    $this->db->where('poll_id', $poll_id);
//
//
//    $query = $this->db->get();
//    return $query->result_array();
//}
//    public function get_poll_vote($poll_id) {
//        $this->db->select('count(user_id) as total, answer');
//        $this->db->group_by('answer');
//        $this->db->order_by('answer');
//        $this->db->from('poll_vote_result as pvr');
//        $this->db->join('poll_data pd', 'pvr.poll_id=pd.id', 'right');
//        $this->db->where('poll_id', $poll_id);
//
//        $query = $this->db->get();
//        return $query->result_array();
//    }

    public function get_poll_vote($poll_id) {
        $this->db->select('count(user_id) as total, answer');
        $this->db->group_by('answer');
        $this->db->order_by('answer', 'desc');
        $this->db->from('poll_vote_result as pvr');
        $this->db->join('poll_data pd', 'pvr.poll_id=pd.id', 'right');
        $this->db->where('poll_id', $poll_id);

        $query = $this->db->get();
        return $query->result_array();
    }

}
