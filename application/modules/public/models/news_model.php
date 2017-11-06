<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class News_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function count_articles() {
        $this->db->select('count(article_id) as count');
        $this->db->from('article');
        $this->db->where('status', "A");
        $query = $this->db->get();
        return $query->row();
    }

    function getArticlesById($articles_id) {
        $sql = 'SELECT a.article_id,a.article_name,a.article_image,a.tag_style,a.article_description,a.article_url,a.article_views,a.spoiler,a.meta_keyword,
                a.meta_description,a.created_date,a.modified_date , total_comment , tags
                FROM `article` AS a
                LEFT JOIN ( SELECT  *,count( ac.article_id ) as total_comment FROM article_comment AS ac
                    GROUP BY ac.article_id
                ) as acc ON acc.article_id = a.article_id
                LEFT JOIN ( SELECT  *,GROUP_CONCAT(at.tag,"%%") as tags FROM article_tag AS at
                    GROUP BY at.article_id
                ) as att ON att.article_id = a.article_id 
                WHERE a.article_id=' . $articles_id . ' AND a.status="A"';
        $query = $this->db->query($sql);
        return $query->row();
    }

    function getArticlesList($main, $row, $rowperpage,$user_id) {
        if ($main == "new") {
            $popular = "AND art.setpopular = 'N'";
        } else if ($main == "popular") {
            $popular = "AND art.setpopular = 'Y'";
        } else {
            $popular = 'AND favourites_status = "A"';
        }
        $sql = 'SELECT  art.*, 
                  
                /* TAGS */
                tg.tags,
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
               /* favourite faver.`favourite`, */
               CASE WHEN (faver.`favourite` IS NULL OR faver.`favourite` = "")
                         THEN "0"
                         ELSE faver.`favourite`
                END AS favourite,
                faver.fvtuserid,
                faver.fvtid,
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
                cmtData.childcmtdate,
                cmtData.childusername 
                
        FROM article AS art
        
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
           FROM article_comment AS c
           LEFT JOIN
           (
              SELECT i.*,
                     GROUP_CONCAT(i.comment,"**^^**") AS chdcomment,
                     GROUP_CONCAT(i.comment_id,"**^^**") AS chdcomment_id,
                     GROUP_CONCAT(i.user_id,"**^^**") AS chdcomment_userid,
                     GROUP_CONCAT(i.comment_date,"**^^**") AS chdcomment_date,
                     GROUP_CONCAT(l_user.user_name,"**^^**") AS luser_name 
              FROM `article_comment` AS i
              LEFT JOIN `le_users` AS l_user ON l_user.`user_id` = i.`user_id`	      
              GROUP BY i.parent_id 
           ) AS chdg ON chdg.parent_id = c.comment_id
           WHERE c.`parent_id` = 0
           GROUP BY c.article_id
           ORDER BY c.article_id 
         ) AS cmtData ON cmtData.`article_id` = art.`article_id`  
          LEFT JOIN
         (
            SELECT count(vic.victory_id) AS total_victory,
                   GROUP_CONCAT(vic.user_id) AS vic_users,
                   vic.*
            FROM article_victory as vic 
            WHERE vic.victory_defeat = "V"
            GROUP BY vic.article_id
            ORDER BY vic.article_id
         ) AS victory ON victory.article_id = art.`article_id`
         LEFT JOIN
         (
            SELECT count(vicd.victory_id) AS total_defeat,
                   GROUP_CONCAT(vicd.user_id) AS def_users,
                   vicd.*
            FROM article_victory as vicd 
            WHERE vicd.victory_defeat = "D"
            GROUP BY vicd.article_id
            ORDER BY vicd.article_id
         ) AS victoryd ON victoryd.article_id = art.`article_id`
         LEFT JOIN
         (
            SELECT count(fvt.article_id) AS favourite,
                   GROUP_CONCAT(fvt.favourites_id) AS fvtid,
                   GROUP_CONCAT(fvt.user_id) AS fvtuserid,
                   fvt.*
            FROM  article_favourites as fvt 
            WHERE fvt.favourites_status = "A" AND fvt.user_id = '.$user_id.'
            GROUP BY fvt.article_id
            ORDER BY fvt.article_id
         ) AS faver ON faver.`article_id` = art.`article_id`
         LEFT JOIN
         (
            SELECT count(cmt.comment) AS total_comment,
                   cmt.*
            FROM  article_comment as cmt
            WHERE cmt.`parent_id` = 0 
            GROUP BY cmt.article_id
            ORDER BY cmt.article_id
         ) AS comment ON comment.`article_id` = art.`article_id`
        
         LEFT JOIN
         (
           SELECT GROUP_CONCAT(t.tag) AS tags,
                  t.*
           FROM  article_tag AS t
           GROUP BY t.article_id
           ORDER BY t.article_id
         ) AS tg ON tg.`article_id` = art.`article_id` WHERE art.`status` = "A"  ' . $popular . '  ORDER BY art.`article_id` desc LIMIT ' . $row . ',' . $rowperpage;

        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_total_row($main,$user_id) {
       if ($main == "new") {
            $popular = "AND art.setpopular = 'N'";
        } else if ($main == "popular") {
            $popular = "AND art.setpopular = 'Y'";
        } else {
            $popular = 'AND favourites_status = "A"';
        }
        $sql = 'SELECT  count(*) as count   
                
        FROM article AS art 
        LEFT JOIN
         (
            SELECT count(fvt.article_id) AS favourite,
                   GROUP_CONCAT(fvt.favourites_id) AS fvtid,
                   GROUP_CONCAT(fvt.user_id) AS fvtuserid,
                   fvt.*
            FROM  article_favourites as fvt 
            WHERE fvt.favourites_status = "A" AND fvt.user_id = '.$user_id.'
            GROUP BY fvt.article_id
            ORDER BY fvt.article_id
         ) AS faver ON faver.`article_id` = art.`article_id`
         
          WHERE art.`status` = "A"  ' . $popular ;

        $query = $this->db->query($sql);
        return $query->row();
    }

    function victory_defeat($user_id, $article_id) {
        $this->db->select('*');
        $this->db->from('article_victory');
        $this->db->where('user_id', $user_id);
        $this->db->where('article_id', $article_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function add_victory_defeat($dataArr) {
        $this->db->insert('article_victory', $dataArr);
        return $this->db->insert_id();
    }

    function updatevictory($dataArr, $victory_id) {
        $this->db->where('victory_id', $victory_id)->update('article_victory', $dataArr);
        return;
    }

    function sel_favourites($user_id, $article_id) {
        $this->db->select('*');
        $this->db->from('article_favourites');
        $this->db->where('user_id', $user_id);
        $this->db->where('article_id', $article_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function add_favourites($dataArr) {
        $this->db->insert('article_favourites', $dataArr);
        return $this->db->insert_id();
    }

    function removefavourites($user_id, $favourites_id) {
        $result = $this->db->where('favourites_id', $favourites_id)
                ->where('user_id', $user_id)
                ->where('favourites_status', "A")
                ->delete('article_favourites');
    }

    function get_all_articals($row, $rowperpage) {
        $this->db->select('*');
        $this->db->from('article');
        //$this->db->join('article_comment', 'article.article_id = article_comment.article_id','left');
        // $this->db->join('article_tag', 'article.article_id= article_tag.article_id','left');
        $this->db->where('status', "A");
        $this->db->order_by("article.created_date", "desc");
        $this->db->limit($rowperpage, $row);
        $query = $this->db->get();

        return $query->result_array();
    }

    function get_articles_top_treading($row, $rowperpage) {
        $this->db->select('*');
        $this->db->from('article');
        //$this->db->join('article_comment', 'article.article_id = article_comment.article_id','left');
        // $this->db->join('article_tag', 'article.article_id= article_tag.article_id','left');
        $this->db->where('status', "A");
        $this->db->order_by("article.article_views", "desc");
        $this->db->limit($rowperpage, $row);
        $query = $this->db->get();

        return $query->result_array();
    }

    function get_article_comments($article_id) {
        $this->db->select('*');
        $this->db->from('article_comment');
        $this->where('article_id', $article_id);
        $this->db->order_by("created_date", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    function getCommentData($id) {
        $sql = 'SELECT acp.*, acp.user_id as cmnt_user_id, acp.comment_id as cmnt_comment_id,ac. * , u.user_name,u.user_region, CASE WHEN (u.user_image IS NULL OR u.user_image = "")
		 THEN "0"
		 ELSE u.user_image
        END AS user_image
                FROM `article_comment` AS ac
                LEFT JOIN le_users AS u ON ac.user_id = u.user_id
                LEFT JOIN articel_comment_points AS acp ON acp.comment_id = ac.comment_id
                WHERE ac.article_id =' . $id . '
                ORDER BY `parent_id`,`created_date` desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getCmtData_subComment($pid) {
        $sql = 'SELECT acp.*, acp.user_id as cmnt_user_id, acp.comment_id as cmnt_comment_id,ac. * , u.user_name,u.user_region, CASE WHEN (u.user_image IS NULL OR u.user_image = "")
		 THEN "0"
		 ELSE u.user_image
        END AS user_image
                FROM `article_comment` AS ac
                LEFT JOIN le_users AS u ON ac.user_id = u.user_id
                LEFT JOIN articel_comment_points AS acp ON acp.comment_id = ac.comment_id
                WHERE ac.parent_id =' . $pid . '
                ORDER BY `parent_id`,`comment_date` desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getCommentLikes($comment_id) {
        $this->db->select('like');
        $this->db->from('articel_comment_points');
        $this->db->where('like', '1');
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function getCommentDislikes($comment_id) {
        $this->db->select('like');
        $this->db->from('articel_comment_points');
        $this->db->where('like', '0');
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return count($query->result_array());
    }

    function check_like($user_id, $comment_id) {
        $this->db->select('*');
        $this->db->from('articel_comment_points');
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return $query->result();
    }

    function add_like($data) {
        $this->db->insert('articel_comment_points', $data);
        return TRUE;
    }

    function delete_like($user_id, $comment_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $this->db->delete('articel_comment_points');
        return TRUE;
    }

    function update_like($user_id, $comment_id, $data) {
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $this->db->update('articel_comment_points', $data);
        return TRUE;
    }

    function delete_comment($comment, $userid) {
        $result = $this->db->where('comment_id', $comment)->delete('article_comment');
        $result = $this->db->where('parent_id', $comment)->delete('article_comment');
        $result = $this->db->where('comment_id', $comment)->where('user_id', $userid)->delete('articel_comment_points');
        return;
    }

    function add_comment($ins_comment) {
        $this->db->insert('article_comment', $ins_comment);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function updateArticleById($dataArr, $aid) {
        return $this->db->where('article_id', $aid)
                        ->update('article', $dataArr);
    }

    function select_article($article_id) {
        $this->db->select('article_views');
        $this->db->from('article');
        $this->db->where('article_id', $article_id);
        $query = $this->db->get();
        return $query->row();
    }

}
