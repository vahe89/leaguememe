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

    function halloffame() {
        $this->db->select('*');
        $this->db->from('le_donate');
        $this->db->where('payment_status', "Payment Received");
        $query = $this->db->get();
        return $query->result_array();
    }

    function halloffame_limit($limit, $start) {

        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->from('le_donate');
        $this->db->where('payment_status', "Payment Received");
        $query = $this->db->get();
        return $query->result_array();
    }

    function league_images() {
        $this->db->select('*');
        $this->db->from('le_leagueimages');
        $this->db->join('le_category', 'le_category.category_id=le_leagueimages.category_id');
        $this->db->where('leagueimage_status', 'A');
        $this->db->where('leagueimage_setpopular', 'Y');
        $query = $this->db->get();
        return $query->result_array();
    }

    function league_images_url($where) {
        $this->db->select('*');
        $this->db->from('le_leagueimages');
        $this->db->where('leagueimage_status', 'A');
        if (!empty($where)) {
            foreach ($where as $row) {
                $this->db->where($row);
            }
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    function league_images_new() {
        $this->db->select('*');
        $this->db->from('le_leagueimages');
        $this->db->join('le_category', 'le_category.category_id=le_leagueimages.category_id');
        $this->db->where('leagueimage_status', 'A');
        $this->db->order_by("leagueimage_id", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    function league_comments() {
        $sql = "SELECT sum(donate_amount) FROM le_donate WHERE le_donate.user_id = le_comments.user_id";
        $this->db->select('*, (' . $sql . ') as sum_donate');
        $this->db->from('le_comments');
        $this->db->join('le_users', 'le_comments.user_id=le_users.user_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    function updatecomment($commentArray, $comment_id) {
        $this->db->where('comment_id', $comment_id)->update('le_comments', $commentArray);
        return;
    }

    function select_single_image($league_image_id) {
        $comment = "SELECT count(comment) FROM le_comments WHERE le_comments.leagueimage_id = le_leagueimages.leagueimage_id";
        $favourite = "SELECT count(leagueimage_id) FROM le_favourites WHERE le_favourites.leagueimage_id = le_leagueimages.leagueimage_id AND le_favourites.favourites_status = 'A'";
        $victory = "SELECT count(victory_id) FROM le_victory WHERE le_victory.leagueimages_id = le_leagueimages.leagueimage_id AND le_victory.victory_defeat = 'V'";
        $defeat = "SELECT count(victory_id) FROM le_victory WHERE le_victory.leagueimages_id = le_leagueimages.leagueimage_id AND le_victory.victory_defeat = 'D'";

        $this->db->select('*, le_leagueimages.leagueimage_id as leagueimage_id,( ' . $comment . ' ) as total_comment,( ' . $favourite . ' ) as favourite,GROUP_CONCAT(tag) as tags, le_users.user_name, ( ' . $victory . ' ) as total_victory, ( ' . $defeat . ' ) as total_defeat');
        $this->db->from('le_leagueimages');
        $this->db->join('le_category', 'le_category.category_id	=le_leagueimages.category_id');
        $this->db->join('le_tags', 'le_leagueimages.leagueimage_id = le_tags.leagueimage_id', 'left');
        $this->db->join('le_credits', 'le_credits.leagueimage_id = le_leagueimages.leagueimage_id', 'left');
        $this->db->join('le_users', 'le_leagueimages.leagueimage_userid = le_users.user_id', 'left');
        $this->db->join('le_favourites', "le_favourites.leagueimage_id = le_leagueimages.leagueimage_id AND le_favourites.favourites_status = 'A'", 'left');
        $this->db->where('le_leagueimages.leagueimage_id', $league_image_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_leagueimage_id($league_name) {
        $this->db->select('leagueimage_id');
        $this->db->like('tag', $league_name);
        $this->db->distinct();
        return $this->db->get('le_tags');
    }

    function league_search($limit, $start, $ids) {
        $comment = "SELECT count(comment) FROM le_comments WHERE le_comments.leagueimage_id = le_leagueimages.leagueimage_id";
        $favourite = "SELECT count(leagueimage_id) FROM le_favourites WHERE le_favourites.leagueimage_id = le_leagueimages.leagueimage_id AND le_favourites.favourites_status = 'A'";
        $victory = "SELECT count(victory_id) FROM le_victory WHERE le_victory.leagueimages_id = le_leagueimages.leagueimage_id AND le_victory.victory_defeat = 'V'";
        $defeat = "SELECT count(victory_id) FROM le_victory WHERE le_victory.leagueimages_id = le_leagueimages.leagueimage_id AND le_victory.victory_defeat = 'D'";

        $this->db->limit($limit, $start);
        $this->db->select('*,le_leagueimages.leagueimage_id as leagueimage_id,le_users.user_name,GROUP_CONCAT(tag) as tags,(' . $victory . ') as total_victory,(' . $defeat . ') as total_defeat,(' . $favourite . ') as total_favourite,(' . $comment . ') as total_comment');
        $this->db->from('le_leagueimages');
        $this->db->join('le_category', 'le_category.category_id=le_leagueimages.category_id');
        $this->db->join('le_tags', 'le_leagueimages.leagueimage_id = le_tags.leagueimage_id', 'left');
        $this->db->join('le_credits', 'le_credits.leagueimage_id = le_leagueimages.leagueimage_id', 'left');
        $this->db->join('le_users', 'le_leagueimages.leagueimage_userid = le_users.user_id', 'left');
        $this->db->join('le_favourites', "le_favourites.leagueimage_id = le_leagueimages.leagueimage_id AND le_favourites.favourites_status = 'A'", 'left');
        $this->db->where('leagueimage_status', 'A');
        $this->db->where_in('le_leagueimages.leagueimage_id', $ids);
        $this->db->group_by('le_tags.leagueimage_id');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    function select_league_views($league_img_id) {
        $this->db->select('leagueimage_total_view');
        $this->db->from('le_leagueimages');
        $this->db->where('leagueimage_id', $league_img_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function update_imageviews($league_img_id, $dataArr) {
        $this->db->where('leagueimage_id', $league_img_id)->update('le_leagueimages', $dataArr);
        return;
    }

    function update_imagesetpopular($league_img_id, $dataArr) {
        $this->db->where('leagueimage_id', $league_img_id)->update('le_leagueimages', $dataArr);
        return;
    }

    function add_donation($ins_array) {
        $this->db->insert('le_donate', $ins_array);
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

    public function record_count() {
        $query = $this->db->select('*')->from('le_leagueimages')->where('leagueimage_status', 'A')->get();

        return count($query->result_array());
    }

    public function count_popular_allthings() {
        $this->db->select('*');
        $this->db->from('le_leagueimages');
        $this->db->join('le_category', 'le_category.category_id=le_leagueimages.category_id');
        //$this->db->join('le_credits','le_credits.leagueimage_id=le_leagueimages.leagueimage_id','left');
        $this->db->where('leagueimage_status', 'A');
        $this->db->where('leagueimage_setpopular', 'Y');
        $this->db->where('category_name', 'All the Things'); //updated on 24/04/2015 
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function count_popular_video() {
        $this->db->select('*');
        $this->db->from('le_leagueimages');
        $this->db->join('le_category', 'le_category.category_id=le_leagueimages.category_id');
        //$this->db->join('le_credits','le_credits.leagueimage_id=le_leagueimages.leagueimage_id','left');
        $this->db->where('leagueimage_status', 'A');
        $this->db->where('leagueimage_setpopular', 'Y');
        $this->db->where('category_name', 'Video');
        $query = $this->db->get();

        return count($query->result_array());
    }

    public function count_popular_random() {
        $this->db->select('*');
        $this->db->from('le_leagueimages');
        $this->db->join('le_category', 'le_category.category_id=le_leagueimages.category_id');
        //$this->db->join('le_credits','le_credits.leagueimage_id=le_leagueimages.leagueimage_id','left');
        $this->db->where('leagueimage_status', 'A');
        $this->db->where('leagueimage_setpopular', 'Y');
        $this->db->order_by('user_id', 'RANDOM');
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function count_popular_art() {
        $this->db->select('*');
        $this->db->from('le_leagueimages');
        $this->db->join('le_category', 'le_category.category_id=le_leagueimages.category_id');
        //$this->db->join('le_credits','le_credits.leagueimage_id=le_leagueimages.leagueimage_id','left');
        $this->db->where('leagueimage_status', 'A');
        $this->db->where('leagueimage_setpopular', 'Y');
        $this->db->where('category_name', 'Art');
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function count_all() {
        $this->db->select('*');
        $this->db->from('le_leagueimages');
        $this->db->join('le_category', 'le_category.category_id=le_leagueimages.category_id');
        //$this->db->join('le_credits','le_credits.leagueimage_id=le_leagueimages.leagueimage_id','left');
        $this->db->where('leagueimage_status', 'A');

        $query = $this->db->get();
        return count($query->result_array());
    }

    public function fetch_leagues($limit, $start) {
        $this->db->limit($limit, $start);

        $query = $this->db->select('*')->from('le_leagueimages')->where('leagueimage_status', 'A')->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function all($limit, $start) {

        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->from('le_leagueimages');
        $this->db->join('le_category', 'le_category.category_id=le_leagueimages.category_id');
        //$this->db->join('le_credits','le_credits.leagueimage_id=le_leagueimages.leagueimage_id','left');
        $this->db->where('leagueimage_status', 'A');

        $this->db->order_by("le_leagueimages.leagueimage_id", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function art_popular($limit, $start) {
        
         $quy = 'SELECT  le_leimg.*,
                ctgry.category_name,
                /* user data */
                user.user_name,
                user.user_email,
                user.user_region,
                user.user_image,
                user.online_status,
                /* credit */
                le_crd.credit_id,
                le_crd.credit,
                le_crd.credit_status,
                le_crd.credit_timestamp,
                /* TAGS */
                tg.tags,
               /*  victory victory.total_victory,victoryd.`total_defeat` */
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

        FROM le_leagueimages AS le_leimg
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
           FROM le_comments AS c
           LEFT JOIN
           (
              SELECT i.*,
                     GROUP_CONCAT(i.comment,"**^^**") AS chdcomment,
                     GROUP_CONCAT(i.comment_id,"**^^**") AS chdcomment_id,
                     GROUP_CONCAT(i.user_id,"**^^**") AS chdcomment_userid,
                     GROUP_CONCAT(i.comment_date,"**^^**") AS chdcomment_date,
                     GROUP_CONCAT(l_user.user_name,"**^^**") AS luser_name 
              FROM `le_comments` AS i
              LEFT JOIN `le_users` AS l_user ON l_user.`user_id` = i.`user_id`	      
              GROUP BY i.parent_id 
           ) AS chdg ON chdg.parent_id = c.comment_id
           WHERE c.`parent_id` = 0
           GROUP BY c.leagueimage_id
           ORDER BY c.leagueimage_id 
         ) AS cmtData ON cmtData.`leagueimage_id` = le_leimg.`leagueimage_id`  
         LEFT JOIN
          (
            SELECT u.*
            FROM le_users AS u
            WHERE u.user_status = "A"    
          ) AS user ON le_leimg.leagueimage_userid = user.user_id
        RIGHT JOIN
            (
              SELECT ctg.*
              FROM le_category AS ctg
              WHERE ctg.category_status = "A" AND ctg.category_name = "Art"    
            ) AS ctgry ON le_leimg.category_id = ctgry.category_id  
        LEFT JOIN `le_credits` AS le_crd ON le_crd.`leagueimage_id` = le_leimg.`leagueimage_id`  
         LEFT JOIN
         (
            SELECT count(vic.victory_id) AS total_victory,
                   vic.*
            FROM le_victory as vic 
            WHERE vic.victory_defeat = "V"
            GROUP BY vic.leagueimages_id
            ORDER BY vic.leagueimages_id
         ) AS victory ON victory.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(vicd.victory_id) AS total_defeat,
                   vicd.*
            FROM le_victory as vicd 
            WHERE vicd.victory_defeat = "D"
            GROUP BY vicd.leagueimages_id
            ORDER BY vicd.leagueimages_id
         ) AS victoryd ON victoryd.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(fvt.leagueimage_id) AS favourite,
                   GROUP_CONCAT(fvt.favourites_id) AS fvtid,
                   GROUP_CONCAT(fvt.user_id) AS fvtuserid,
                   fvt.*
            FROM  le_favourites as fvt 
            WHERE fvt.favourites_status = "A"
            GROUP BY fvt.leagueimage_id
            ORDER BY fvt.leagueimage_id
         ) AS faver ON faver.`leagueimage_id` = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(cmt.comment) AS total_comment,
                   cmt.*
            FROM  le_comments as cmt
            WHERE cmt.`parent_id` = 0 
            GROUP BY cmt.leagueimage_id
            ORDER BY cmt.leagueimage_id
         ) AS comment ON comment.`leagueimage_id` = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
           SELECT GROUP_CONCAT(t.tag) AS tags,
                  t.*
           FROM  le_tags AS t
           GROUP BY t.leagueimage_id
           ORDER BY t.leagueimage_id
         ) AS tg ON tg.`leagueimage_id` = le_leimg.`leagueimage_id`
        WHERE le_leimg.`leagueimage_status` = "A" AND le_leimg.`leagueimage_setpopular` = "Y"
        ORDER BY le_leimg.`leagueimage_id` desc LIMIT ' . $start . ',' . $limit;        
        
        $query = $this->db->query($quy);
        
        $this->db->last_query();
        
        if ($query->num_rows() > 0) {
            
            return $query->result();
            
        }
        return false;
    }

    function allthings_popular($limit, $start) {
//        $victory = "SELECT count(victory_id) FROM le_victory WHERE le_victory.leagueimages_id = le_leagueimages.leagueimage_id AND le_victory.victory_defeat = 'V'";
//        $defeat = "SELECT count(victory_id) FROM le_victory WHERE le_victory.leagueimages_id = le_leagueimages.leagueimage_id AND le_victory.victory_defeat = 'D'";
//        $comment = "SELECT count(comment) FROM le_comments WHERE le_comments.leagueimage_id = le_leagueimages.leagueimage_id";
//        $favourite = "SELECT count(leagueimage_id) FROM le_favourites WHERE le_favourites.leagueimage_id = le_leagueimages.leagueimage_id AND le_favourites.favourites_status = 'A'";
//        $this->db->limit($limit, $start);
//        $this->db->select('*, le_leagueimages.leagueimage_id as leagueimage_id,le_users.user_name, GROUP_CONCAT(tag) as tags,( ' . $victory . ' ) as total_victory, ( ' . $defeat . ' ) as total_defeat, ( ' . $comment . ' ) as total_comment, ( ' . $favourite . ' ) as favourite');
//        $this->db->from('le_leagueimages');
//        $this->db->join('le_category', 'le_category.category_id = le_leagueimages.category_id');
//        $this->db->join('le_credits', 'le_credits.leagueimage_id = le_leagueimages.leagueimage_id', 'left');
//        $this->db->join('le_users', 'le_leagueimages.leagueimage_userid = le_users.user_id', 'left');
//        $this->db->join('le_tags', 'le_leagueimages.leagueimage_id = le_tags.leagueimage_id', 'left');
//        $this->db->join('le_favourites', "le_favourites.leagueimage_id = le_leagueimages.leagueimage_id AND le_favourites.favourites_status = 'A'", 'left');
//        $this->db->where('leagueimage_status', 'A');
//        $this->db->where('leagueimage_setpopular', 'Y');
//        $this->db->group_by('le_tags.leagueimage_id');
//        //$this->db->where('category_name','All the Things'); //updated on 24/04/2015 
//        $this->db->order_by("le_leagueimages.leagueimage_id", "desc");
        $quy = 'SELECT  le_leimg.*,
                ctgry.category_name,
                /* user data */
                user.user_name,
                user.user_email,
                user.user_region,
                user.user_image,
                user.online_status,
                /* credit */
                le_crd.credit_id,
                le_crd.credit,
                le_crd.credit_status,
                le_crd.credit_timestamp,
                /* TAGS */
                tg.tags,
               /*  victory victory.total_victory,victoryd.`total_defeat` */
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

        FROM le_leagueimages AS le_leimg
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
           FROM le_comments AS c
           LEFT JOIN
           (
              SELECT i.*,
                     GROUP_CONCAT(i.comment,"**^^**") AS chdcomment,
                     GROUP_CONCAT(i.comment_id,"**^^**") AS chdcomment_id,
                     GROUP_CONCAT(i.user_id,"**^^**") AS chdcomment_userid,
                     GROUP_CONCAT(i.comment_date,"**^^**") AS chdcomment_date,
                     GROUP_CONCAT(l_user.user_name,"**^^**") AS luser_name 
              FROM `le_comments` AS i
              LEFT JOIN `le_users` AS l_user ON l_user.`user_id` = i.`user_id`	      
              GROUP BY i.parent_id 
           ) AS chdg ON chdg.parent_id = c.comment_id
           WHERE c.`parent_id` = 0
           GROUP BY c.leagueimage_id
           ORDER BY c.leagueimage_id 
         ) AS cmtData ON cmtData.`leagueimage_id` = le_leimg.`leagueimage_id`  
         LEFT JOIN
          (
            SELECT u.*
            FROM le_users AS u
            WHERE u.user_status = "A"    
          ) AS user ON le_leimg.leagueimage_userid = user.user_id
        RIGHT JOIN
            (
              SELECT ctg.*
              FROM le_category AS ctg
              WHERE ctg.category_status = "A" AND ctg.category_name = "All the Things"   
            ) AS ctgry ON le_leimg.category_id = ctgry.category_id  
        LEFT JOIN `le_credits` AS le_crd ON le_crd.`leagueimage_id` = le_leimg.`leagueimage_id`  
         LEFT JOIN
         (
            SELECT count(vic.victory_id) AS total_victory,
                   vic.*
            FROM le_victory as vic 
            WHERE vic.victory_defeat = "V"
            GROUP BY vic.leagueimages_id
            ORDER BY vic.leagueimages_id
         ) AS victory ON victory.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(vicd.victory_id) AS total_defeat,
                   vicd.*
            FROM le_victory as vicd 
            WHERE vicd.victory_defeat = "D"
            GROUP BY vicd.leagueimages_id
            ORDER BY vicd.leagueimages_id
         ) AS victoryd ON victoryd.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(fvt.leagueimage_id) AS favourite,
                   GROUP_CONCAT(fvt.favourites_id) AS fvtid,
                   GROUP_CONCAT(fvt.user_id) AS fvtuserid,
                   fvt.*
            FROM  le_favourites as fvt 
            WHERE fvt.favourites_status = "A"
            GROUP BY fvt.leagueimage_id
            ORDER BY fvt.leagueimage_id
         ) AS faver ON faver.`leagueimage_id` = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(cmt.comment) AS total_comment,
                   cmt.*
            FROM  le_comments as cmt
            WHERE cmt.`parent_id` = 0 
            GROUP BY cmt.leagueimage_id
            ORDER BY cmt.leagueimage_id
         ) AS comment ON comment.`leagueimage_id` = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
           SELECT GROUP_CONCAT(t.tag) AS tags,
                  t.*
           FROM  le_tags AS t
           GROUP BY t.leagueimage_id
           ORDER BY t.leagueimage_id
         ) AS tg ON tg.`leagueimage_id` = le_leimg.`leagueimage_id`
        WHERE le_leimg.`leagueimage_status` = "A" AND le_leimg.`leagueimage_setpopular` = "Y"
        ORDER BY le_leimg.`leagueimage_id` desc LIMIT ' . $start . ',' . $limit;
        $query = $this->db->query($quy);
        return $query->result();
    }

    function video_popular($limit, $start) {
        $quy = 'SELECT  le_leimg.*,
                ctgry.category_name,
                /* user data */
                user.user_name,
                user.user_email,
                user.user_region,
                user.user_image,
                user.online_status,
                /* credit */
                le_crd.credit_id,
                le_crd.credit,
                le_crd.credit_status,
                le_crd.credit_timestamp,
                /* TAGS */
                tg.tags,
               /*  victory victory.total_victory,victoryd.`total_defeat` */
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

        FROM le_leagueimages AS le_leimg
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
           FROM le_comments AS c
           LEFT JOIN
           (
              SELECT i.*,
                     GROUP_CONCAT(i.comment,"**^^**") AS chdcomment,
                     GROUP_CONCAT(i.comment_id,"**^^**") AS chdcomment_id,
                     GROUP_CONCAT(i.user_id,"**^^**") AS chdcomment_userid,
                     GROUP_CONCAT(i.comment_date,"**^^**") AS chdcomment_date,
                     GROUP_CONCAT(l_user.user_name,"**^^**") AS luser_name 
              FROM `le_comments` AS i
              LEFT JOIN `le_users` AS l_user ON l_user.`user_id` = i.`user_id`	      
              GROUP BY i.parent_id 
           ) AS chdg ON chdg.parent_id = c.comment_id
           WHERE c.`parent_id` = 0
           GROUP BY c.leagueimage_id
           ORDER BY c.leagueimage_id 
         ) AS cmtData ON cmtData.`leagueimage_id` = le_leimg.`leagueimage_id`  
         LEFT JOIN
          (
            SELECT u.*
            FROM le_users AS u
            WHERE u.user_status = "A"    
          ) AS user ON le_leimg.leagueimage_userid = user.user_id
        RIGHT JOIN
            (
              SELECT ctg.*
              FROM le_category AS ctg
              WHERE ctg.category_status = "A" AND ctg.category_name = "Video"    
            ) AS ctgry ON le_leimg.category_id = ctgry.category_id  
        LEFT JOIN `le_credits` AS le_crd ON le_crd.`leagueimage_id` = le_leimg.`leagueimage_id`  
         LEFT JOIN
         (
            SELECT count(vic.victory_id) AS total_victory,
                   vic.*
            FROM le_victory as vic 
            WHERE vic.victory_defeat = "V"
            GROUP BY vic.leagueimages_id
            ORDER BY vic.leagueimages_id
         ) AS victory ON victory.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(vicd.victory_id) AS total_defeat,
                   vicd.*
            FROM le_victory as vicd 
            WHERE vicd.victory_defeat = "D"
            GROUP BY vicd.leagueimages_id
            ORDER BY vicd.leagueimages_id
         ) AS victoryd ON victoryd.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(fvt.leagueimage_id) AS favourite,
                   GROUP_CONCAT(fvt.favourites_id) AS fvtid,
                   GROUP_CONCAT(fvt.user_id) AS fvtuserid,
                   fvt.*
            FROM  le_favourites as fvt 
            WHERE fvt.favourites_status = "A"
            GROUP BY fvt.leagueimage_id
            ORDER BY fvt.leagueimage_id
         ) AS faver ON faver.`leagueimage_id` = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(cmt.comment) AS total_comment,
                   cmt.*
            FROM  le_comments as cmt
            WHERE cmt.`parent_id` = 0 
            GROUP BY cmt.leagueimage_id
            ORDER BY cmt.leagueimage_id
         ) AS comment ON comment.`leagueimage_id` = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
           SELECT GROUP_CONCAT(t.tag) AS tags,
                  t.*
           FROM  le_tags AS t
           GROUP BY t.leagueimage_id
           ORDER BY t.leagueimage_id
         ) AS tg ON tg.`leagueimage_id` = le_leimg.`leagueimage_id`
        WHERE le_leimg.`leagueimage_status` = "A" AND le_leimg.`leagueimage_setpopular` = "Y"
        ORDER BY le_leimg.`leagueimage_id` desc LIMIT ' . $start . ',' . $limit;        
        $query = $this->db->query($quy);
        $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    function random_popular($limit, $start) {
        $quy = 'SELECT  le_leimg.*,
                ctgry.category_name,
                /* user data */
                user.user_name,
                user.user_email,
                user.user_region,
                user.user_image,
                user.online_status,
                /* credit */
                le_crd.credit_id,
                le_crd.credit,
                le_crd.credit_status,
                le_crd.credit_timestamp,
                /* TAGS */
                tg.tags,
               /*  victory victory.total_victory,victoryd.`total_defeat` */
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

        FROM le_leagueimages AS le_leimg
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
           FROM le_comments AS c
           LEFT JOIN
           (
              SELECT i.*,
                     GROUP_CONCAT(i.comment,"**^^**") AS chdcomment,
                     GROUP_CONCAT(i.comment_id,"**^^**") AS chdcomment_id,
                     GROUP_CONCAT(i.user_id,"**^^**") AS chdcomment_userid,
                     GROUP_CONCAT(i.comment_date,"**^^**") AS chdcomment_date,
                     GROUP_CONCAT(l_user.user_name,"**^^**") AS luser_name 
              FROM `le_comments` AS i
              LEFT JOIN `le_users` AS l_user ON l_user.`user_id` = i.`user_id`	      
              GROUP BY i.parent_id 
           ) AS chdg ON chdg.parent_id = c.comment_id
           WHERE c.`parent_id` = 0
           GROUP BY c.leagueimage_id
           ORDER BY c.leagueimage_id 
         ) AS cmtData ON cmtData.`leagueimage_id` = le_leimg.`leagueimage_id`  
         LEFT JOIN
          (
            SELECT u.*
            FROM le_users AS u
            WHERE u.user_status = "A"    
          ) AS user ON le_leimg.leagueimage_userid = user.user_id
        RIGHT JOIN
            (
              SELECT ctg.*
              FROM le_category AS ctg
              WHERE ctg.category_status = "A"
            ) AS ctgry ON le_leimg.category_id = ctgry.category_id  
        LEFT JOIN `le_credits` AS le_crd ON le_crd.`leagueimage_id` = le_leimg.`leagueimage_id`  
         LEFT JOIN
         (
            SELECT count(vic.victory_id) AS total_victory,
                   vic.*
            FROM le_victory as vic 
            WHERE vic.victory_defeat = "V"
            GROUP BY vic.leagueimages_id
            ORDER BY vic.leagueimages_id
         ) AS victory ON victory.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(vicd.victory_id) AS total_defeat,
                   vicd.*
            FROM le_victory as vicd 
            WHERE vicd.victory_defeat = "D"
            GROUP BY vicd.leagueimages_id
            ORDER BY vicd.leagueimages_id
         ) AS victoryd ON victoryd.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(fvt.leagueimage_id) AS favourite,
                   GROUP_CONCAT(fvt.favourites_id) AS fvtid,
                   GROUP_CONCAT(fvt.user_id) AS fvtuserid,
                   fvt.*
            FROM  le_favourites as fvt 
            WHERE fvt.favourites_status = "A"
            GROUP BY fvt.leagueimage_id
            ORDER BY fvt.leagueimage_id
         ) AS faver ON faver.`leagueimage_id` = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(cmt.comment) AS total_comment,
                   cmt.*
            FROM  le_comments as cmt
            WHERE cmt.`parent_id` = 0 
            GROUP BY cmt.leagueimage_id
            ORDER BY cmt.leagueimage_id
         ) AS comment ON comment.`leagueimage_id` = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
           SELECT GROUP_CONCAT(t.tag) AS tags,
                  t.*
           FROM  le_tags AS t
           GROUP BY t.leagueimage_id
           ORDER BY t.leagueimage_id
         ) AS tg ON tg.`leagueimage_id` = le_leimg.`leagueimage_id`
        WHERE le_leimg.`leagueimage_status` = "A" AND le_leimg.`leagueimage_setpopular` = "Y"
        ORDER BY RAND() LIMIT ' . $start . ',' . $limit;        
        $query = $this->db->query($quy);
        $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function getLegaueCmtData($legid) {

        //*
        //SELECT le_ct . * , u.user_name
//FROM `le_comments` AS le_ct
//LEFT JOIN le_users AS u ON le_ct.user_id = u.user_id
//WHERE le_ct.leagueimage_id =7148 order by `parent_id`
        //*//
//        $sql = 'SELECT  le_ct.*,ig.prcomment,ig.prcomment_id,ig.prcomment_userid,ig.prcomment_date
//                FROM `le_comments` AS le_ct
//                LEFT JOIN (
//                   SELECT GROUP_CONCAT(i.comment,"**^^**") AS prcomment,
//                          GROUP_CONCAT(i.comment_id,"**^^**") AS prcomment_id,
//                          GROUP_CONCAT(i.user_id,"**^^**") AS prcomment_userid,
//                          GROUP_CONCAT(i.comment_date,"**^^**") AS prcomment_date,                         
//                    i.*
//                   FROM `le_comments` AS i
//                   GROUP BY i.parent_id 
//                ) AS ig ON ig.parent_id = le_ct.comment_id
//                Where le_ct.parent_id = 0 AND le_ct.leagueimage_id ='.$legid;
//        $likes = "SELECT count(comment_points.like) FROM comment_points le_comments WHERE comment_points.comment_id = le_comments.comment_id AND comment_points.like = 1";
        $sql = 'SELECT cp.*, cp.user_id as cmnt_user_id, cp.comment_id as cmnt_comment_id,le_ct. * , u.user_name,u.user_region,u.user_image
                FROM `le_comments` AS le_ct
                LEFT JOIN le_users AS u ON le_ct.user_id = u.user_id
                LEFT JOIN comment_points AS cp ON cp.comment_id = le_ct.comment_id
                WHERE le_ct.leagueimage_id =' . $legid . '
                ORDER BY `parent_id`';
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getCommentLikes($comment_id) {
        $this->db->select('like');
        $this->db->from('comment_points');
        $this->db->where('like', '1');
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return count($query->result_array());
    }
    
    public function getCommentDislikes($comment_id) {
        $this->db->select('like');
        $this->db->from('comment_points');
        $this->db->where('like', '0');
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function count_new_random() {
        $this->db->select('*');
        $this->db->from('le_leagueimages');
        $this->db->join('le_category', 'le_category.category_id=le_leagueimages.category_id');
        //$this->db->join('le_credits','le_credits.leagueimage_id=le_leagueimages.leagueimage_id','left');
        $this->db->where('leagueimage_status', 'A');
        $this->db->where('leagueimage_setpopular', 'N');
        $this->db->order_by('user_id', 'RANDOM');
        $this->db->order_by("le_leagueimages.leagueimage_id", "desc");
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function count_new_video() {
        $this->db->select('*');
        $this->db->from('le_leagueimages');
        $this->db->join('le_category', 'le_category.category_id=le_leagueimages.category_id');
        //$this->db->join('le_credits','le_credits.leagueimage_id=le_leagueimages.leagueimage_id','left');
        $this->db->where('leagueimage_status', 'A');
        $this->db->where('category_name', 'Video');
        $this->db->where('leagueimage_setpopular', 'N');
        $this->db->order_by("le_leagueimages.leagueimage_id", "desc");
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function count_new_art() {
        $this->db->select('*');
        $this->db->from('le_leagueimages');
        $this->db->join('le_category', 'le_category.category_id=le_leagueimages.category_id');
        //$this->db->join('le_credits','le_credits.leagueimage_id=le_leagueimages.leagueimage_id','left');
        $this->db->where('leagueimage_status', 'A');
        $this->db->where('category_name', 'Art');
        $this->db->where('leagueimage_setpopular', 'N');
        $this->db->order_by("le_leagueimages.leagueimage_id", "desc");
        $this->db->last_query();
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function count_new_allthings() {

        $this->db->select('*');
        $this->db->from('le_leagueimages');
        $this->db->join('le_category', 'le_category.category_id=le_leagueimages.category_id');
        //$this->db->join('le_credits','le_credits.leagueimage_id=le_leagueimages.leagueimage_id','left');
        $this->db->where('leagueimage_status', 'A');
        $this->db->where('leagueimage_setpopular', 'N');
        $this->db->where('category_name', 'All the Things');  //updated on 24/04/2015 
        $this->db->order_by("le_leagueimages.leagueimage_id", "desc");
        $query = $this->db->get();
        return count($query->result_array());
    }

    function art_new($limit, $start) {
        $quy = 'SELECT  le_leimg.*,
                ctgry.category_name,
                /* user data */
                user.user_name,
                user.user_email,
                user.user_region,
                user.user_image,
                user.online_status,
                /* credit */
                le_crd.credit_id,
                le_crd.credit,
                le_crd.credit_status,
                le_crd.credit_timestamp,
                /* TAGS */
                tg.tags,
               /*  victory victory.total_victory,victoryd.`total_defeat` */
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

        FROM le_leagueimages AS le_leimg
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
           FROM le_comments AS c
           LEFT JOIN
           (
              SELECT i.*,
                     GROUP_CONCAT(i.comment,"**^^**") AS chdcomment,
                     GROUP_CONCAT(i.comment_id,"**^^**") AS chdcomment_id,
                     GROUP_CONCAT(i.user_id,"**^^**") AS chdcomment_userid,
                     GROUP_CONCAT(i.comment_date,"**^^**") AS chdcomment_date,
                     GROUP_CONCAT(l_user.user_name,"**^^**") AS luser_name 
              FROM `le_comments` AS i
              LEFT JOIN `le_users` AS l_user ON l_user.`user_id` = i.`user_id`	      
              GROUP BY i.parent_id 
           ) AS chdg ON chdg.parent_id = c.comment_id
           WHERE c.`parent_id` = 0
           GROUP BY c.leagueimage_id
           ORDER BY c.leagueimage_id 
         ) AS cmtData ON cmtData.`leagueimage_id` = le_leimg.`leagueimage_id`  
         LEFT JOIN
          (
            SELECT u.*
            FROM le_users AS u
            WHERE u.user_status = "A"    
          ) AS user ON le_leimg.leagueimage_userid = user.user_id
        RIGHT JOIN
            (
              SELECT ctg.*
              FROM le_category AS ctg
              WHERE ctg.category_status = "A" AND ctg.category_name = "Art"    
            ) AS ctgry ON le_leimg.category_id = ctgry.category_id  
        LEFT JOIN `le_credits` AS le_crd ON le_crd.`leagueimage_id` = le_leimg.`leagueimage_id`  
         LEFT JOIN
         (
            SELECT count(vic.victory_id) AS total_victory,
                   vic.*
            FROM le_victory as vic 
            WHERE vic.victory_defeat = "V"
            GROUP BY vic.leagueimages_id
            ORDER BY vic.leagueimages_id
         ) AS victory ON victory.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(vicd.victory_id) AS total_defeat,
                   vicd.*
            FROM le_victory as vicd 
            WHERE vicd.victory_defeat = "D"
            GROUP BY vicd.leagueimages_id
            ORDER BY vicd.leagueimages_id
         ) AS victoryd ON victoryd.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(fvt.leagueimage_id) AS favourite,
                   GROUP_CONCAT(fvt.favourites_id) AS fvtid,
                   GROUP_CONCAT(fvt.user_id) AS fvtuserid,
                   fvt.*
            FROM  le_favourites as fvt 
            WHERE fvt.favourites_status = "A"
            GROUP BY fvt.leagueimage_id
            ORDER BY fvt.leagueimage_id
         ) AS faver ON faver.`leagueimage_id` = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(cmt.comment) AS total_comment,
                   cmt.*
            FROM  le_comments as cmt
            WHERE cmt.`parent_id` = 0 
            GROUP BY cmt.leagueimage_id
            ORDER BY cmt.leagueimage_id
         ) AS comment ON comment.`leagueimage_id` = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
           SELECT GROUP_CONCAT(t.tag) AS tags,
                  t.*
           FROM  le_tags AS t
           GROUP BY t.leagueimage_id
           ORDER BY t.leagueimage_id
         ) AS tg ON tg.`leagueimage_id` = le_leimg.`leagueimage_id`
        WHERE le_leimg.`leagueimage_status` = "A" AND le_leimg.`leagueimage_setpopular` = "N"
        ORDER BY le_leimg.`leagueimage_id` desc LIMIT ' . $start . ',' . $limit;        
        $query = $this->db->query($quy);
        $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    function video_new($limit, $start) {
//        $victory = "SELECT count(victory_id) FROM le_victory WHERE le_victory.leagueimages_id = le_leagueimages.leagueimage_id AND le_victory.victory_defeat = 'V'";
//        $defeat = "SELECT count(victory_id) FROM le_victory WHERE le_victory.leagueimages_id = le_leagueimages.leagueimage_id AND le_victory.victory_defeat = 'D'";
//        $comment = "SELECT count(comment) FROM le_comments WHERE le_comments.leagueimage_id = le_leagueimages.leagueimage_id";
//        $favourite = "SELECT count(leagueimage_id) FROM le_favourites WHERE le_favourites.leagueimage_id = le_leagueimages.leagueimage_id AND le_favourites.favourites_status = 'A'";
//        $this->db->limit($limit, $start);
//        $this->db->select('*, le_leagueimages.leagueimage_id as leagueimage_id,le_users.user_name, GROUP_CONCAT(tag) as tags,( ' . $victory . ' ) as total_victory, ( ' . $defeat . ' ) as total_defeat, ( ' . $comment . ' ) as total_comment, ( ' . $favourite . ' ) as favourite');
//        $this->db->from('le_leagueimages');
//        $this->db->join('le_category', 'le_category.category_id=le_leagueimages.category_id');
//        $this->db->join('le_credits', 'le_credits.leagueimage_id = le_leagueimages.leagueimage_id', 'left');
//        $this->db->join('le_users', 'le_leagueimages.leagueimage_userid = le_users.user_id', 'left');
//        $this->db->join('le_tags', 'le_leagueimages.leagueimage_id = le_tags.leagueimage_id', 'left');
//        $this->db->join('le_favourites', "le_favourites.leagueimage_id = le_leagueimages.leagueimage_id AND le_favourites.favourites_status = 'A'", 'left');
//        $this->db->where('leagueimage_status', 'A');
//        $this->db->where('leagueimage_setpopular', 'N');
//        $this->db->where('category_name', 'Video');
//        $this->db->order_by("le_leagueimages.leagueimage_id", "desc");
//        $this->db->group_by('le_tags.leagueimage_id');
//        $query = $this->db->get();
        
        
        $quy = 'SELECT  le_leimg.*,
                ctgry.category_name,
                /* user data */
                user.user_name,
                user.user_email,
                user.user_region,
                user.user_image,
                user.online_status,
                /* credit */
                le_crd.credit_id,
                le_crd.credit,
                le_crd.credit_status,
                le_crd.credit_timestamp,
                /* TAGS */
                tg.tags,
               /*  victory victory.total_victory,victoryd.`total_defeat` */
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

        FROM le_leagueimages AS le_leimg
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
           FROM le_comments AS c
           LEFT JOIN
           (
              SELECT i.*,
                     GROUP_CONCAT(i.comment,"**^^**") AS chdcomment,
                     GROUP_CONCAT(i.comment_id,"**^^**") AS chdcomment_id,
                     GROUP_CONCAT(i.user_id,"**^^**") AS chdcomment_userid,
                     GROUP_CONCAT(i.comment_date,"**^^**") AS chdcomment_date,
                     GROUP_CONCAT(l_user.user_name,"**^^**") AS luser_name 
              FROM `le_comments` AS i
              LEFT JOIN `le_users` AS l_user ON l_user.`user_id` = i.`user_id`	      
              GROUP BY i.parent_id 
           ) AS chdg ON chdg.parent_id = c.comment_id
           WHERE c.`parent_id` = 0
           GROUP BY c.leagueimage_id
           ORDER BY c.leagueimage_id 
         ) AS cmtData ON cmtData.`leagueimage_id` = le_leimg.`leagueimage_id`  
         LEFT JOIN
          (
            SELECT u.*
            FROM le_users AS u
            WHERE u.user_status = "A"    
          ) AS user ON le_leimg.leagueimage_userid = user.user_id
        RIGHT JOIN
            (
              SELECT ctg.*
              FROM le_category AS ctg
              WHERE ctg.category_status = "A" AND ctg.category_name = "Video"   
            ) AS ctgry ON le_leimg.category_id = ctgry.category_id  
        LEFT JOIN `le_credits` AS le_crd ON le_crd.`leagueimage_id` = le_leimg.`leagueimage_id`  
         LEFT JOIN
         (
            SELECT count(vic.victory_id) AS total_victory,
                   vic.*
            FROM le_victory as vic 
            WHERE vic.victory_defeat = "V"
            GROUP BY vic.leagueimages_id
            ORDER BY vic.leagueimages_id
         ) AS victory ON victory.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(vicd.victory_id) AS total_defeat,
                   vicd.*
            FROM le_victory as vicd 
            WHERE vicd.victory_defeat = "D"
            GROUP BY vicd.leagueimages_id
            ORDER BY vicd.leagueimages_id
         ) AS victoryd ON victoryd.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(fvt.leagueimage_id) AS favourite,
                   GROUP_CONCAT(fvt.favourites_id) AS fvtid,
                   GROUP_CONCAT(fvt.user_id) AS fvtuserid,
                   fvt.*
            FROM  le_favourites as fvt 
            WHERE fvt.favourites_status = "A"
            GROUP BY fvt.leagueimage_id
            ORDER BY fvt.leagueimage_id
         ) AS faver ON faver.`leagueimage_id` = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(cmt.comment) AS total_comment,
                   cmt.*
            FROM  le_comments as cmt
            WHERE cmt.`parent_id` = 0 
            GROUP BY cmt.leagueimage_id
            ORDER BY cmt.leagueimage_id
         ) AS comment ON comment.`leagueimage_id` = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
           SELECT GROUP_CONCAT(t.tag) AS tags,
                  t.*
           FROM  le_tags AS t
           GROUP BY t.leagueimage_id
           ORDER BY t.leagueimage_id
         ) AS tg ON tg.`leagueimage_id` = le_leimg.`leagueimage_id`
        WHERE le_leimg.`leagueimage_status` = "A" AND le_leimg.`leagueimage_setpopular` = "N"
        ORDER BY le_leimg.`leagueimage_id` desc LIMIT ' . $start . ',' . $limit;
        $query = $this->db->query($quy);
      
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    function random_new($limit, $start) {
        $quy = 'SELECT  le_leimg.*,
                ctgry.category_name,
                /* user data */
                user.user_name,
                user.user_email,
                user.user_region,
                user.user_image,
                user.online_status,
                /* credit */
                le_crd.credit_id,
                le_crd.credit,
                le_crd.credit_status,
                le_crd.credit_timestamp,
                /* TAGS */
                tg.tags,
               /*  victory victory.total_victory,victoryd.`total_defeat` */
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

        FROM le_leagueimages AS le_leimg
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
           FROM le_comments AS c
           LEFT JOIN
           (
              SELECT i.*,
                     GROUP_CONCAT(i.comment,"**^^**") AS chdcomment,
                     GROUP_CONCAT(i.comment_id,"**^^**") AS chdcomment_id,
                     GROUP_CONCAT(i.user_id,"**^^**") AS chdcomment_userid,
                     GROUP_CONCAT(i.comment_date,"**^^**") AS chdcomment_date,
                     GROUP_CONCAT(l_user.user_name,"**^^**") AS luser_name 
              FROM `le_comments` AS i
              LEFT JOIN `le_users` AS l_user ON l_user.`user_id` = i.`user_id`	      
              GROUP BY i.parent_id 
           ) AS chdg ON chdg.parent_id = c.comment_id
           WHERE c.`parent_id` = 0
           GROUP BY c.leagueimage_id
           ORDER BY c.leagueimage_id 
         ) AS cmtData ON cmtData.`leagueimage_id` = le_leimg.`leagueimage_id`  
         LEFT JOIN
          (
            SELECT u.*
            FROM le_users AS u
            WHERE u.user_status = "A"    
          ) AS user ON le_leimg.leagueimage_userid = user.user_id
        RIGHT JOIN
            (
              SELECT ctg.*
              FROM le_category AS ctg
              WHERE ctg.category_status = "A"
            ) AS ctgry ON le_leimg.category_id = ctgry.category_id  
        LEFT JOIN `le_credits` AS le_crd ON le_crd.`leagueimage_id` = le_leimg.`leagueimage_id`  
         LEFT JOIN
         (
            SELECT count(vic.victory_id) AS total_victory,
                   vic.*
            FROM le_victory as vic 
            WHERE vic.victory_defeat = "V"
            GROUP BY vic.leagueimages_id
            ORDER BY vic.leagueimages_id
         ) AS victory ON victory.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(vicd.victory_id) AS total_defeat,
                   vicd.*
            FROM le_victory as vicd 
            WHERE vicd.victory_defeat = "D"
            GROUP BY vicd.leagueimages_id
            ORDER BY vicd.leagueimages_id
         ) AS victoryd ON victoryd.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(fvt.leagueimage_id) AS favourite,
                   GROUP_CONCAT(fvt.favourites_id) AS fvtid,
                   GROUP_CONCAT(fvt.user_id) AS fvtuserid,
                   fvt.*
            FROM  le_favourites as fvt 
            WHERE fvt.favourites_status = "A"
            GROUP BY fvt.leagueimage_id
            ORDER BY fvt.leagueimage_id
         ) AS faver ON faver.`leagueimage_id` = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(cmt.comment) AS total_comment,
                   cmt.*
            FROM  le_comments as cmt
            WHERE cmt.`parent_id` = 0 
            GROUP BY cmt.leagueimage_id
            ORDER BY cmt.leagueimage_id
         ) AS comment ON comment.`leagueimage_id` = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
           SELECT GROUP_CONCAT(t.tag) AS tags,
                  t.*
           FROM  le_tags AS t
           GROUP BY t.leagueimage_id
           ORDER BY t.leagueimage_id
         ) AS tg ON tg.`leagueimage_id` = le_leimg.`leagueimage_id`
        WHERE le_leimg.`leagueimage_status` = "A" AND le_leimg.`leagueimage_setpopular` = "N"
        ORDER BY RAND() LIMIT ' . $start . ',' . $limit;        
        $query = $this->db->query($quy);
        $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    function allthings_new($limit, $start) {
//        $victory = "SELECT count(victory_id) FROM le_victory WHERE le_victory.leagueimages_id = le_leagueimages.leagueimage_id AND le_victory.victory_defeat = 'V'";
//        $defeat = "SELECT count(victory_id) FROM le_victory WHERE le_victory.leagueimages_id = le_leagueimages.leagueimage_id AND le_victory.victory_defeat = 'D'";
//        $comment = "SELECT count(comment) FROM le_comments WHERE le_comments.leagueimage_id = le_leagueimages.leagueimage_id";
//        $favourite = "SELECT count(leagueimage_id) FROM le_favourites WHERE le_favourites.leagueimage_id = le_leagueimages.leagueimage_id AND le_favourites.favourites_status = 'A'";
//        $this->db->limit($limit, $start);
//        $this->db->select('*, le_leagueimages.leagueimage_id as leagueimage_id,le_users.user_name, GROUP_CONCAT(tag) as tags,( ' . $victory . ' ) as total_victory, ( ' . $defeat . ' ) as total_defeat, ( ' . $comment . ' ) as total_comment, ( ' . $favourite . ' ) as favourite');
//        $this->db->from('le_leagueimages');
//        $this->db->join('le_category', 'le_category.category_id=le_leagueimages.category_id');
//        $this->db->join('le_credits', 'le_credits.leagueimage_id = le_leagueimages.leagueimage_id', 'left');
//        $this->db->join('le_users', 'le_leagueimages.leagueimage_userid = le_users.user_id', 'left');
//        $this->db->join('le_tags', 'le_leagueimages.leagueimage_id = le_tags.leagueimage_id', 'left');
//        $this->db->join('le_favourites', "le_favourites.leagueimage_id = le_leagueimages.leagueimage_id AND le_favourites.favourites_status = 'A'", 'left');
//        $this->db->where('leagueimage_status', 'A');
//        $this->db->where('leagueimage_setpopular', 'N');
//        $this->db->where('category_name', 'All the Things'); //updated on 24/04/2015 
//        $this->db->order_by("le_leagueimages.leagueimage_id", "desc");
//        $this->db->group_by('le_tags.leagueimage_id');
//        
        
        
        $quy = 'SELECT  le_leimg.*,
                ctgry.category_name,
                /* user data */
                user.user_name,
                user.user_email,
                user.user_region,
                user.user_image,
                user.online_status,
                /* credit */
                le_crd.credit_id,
                le_crd.credit,
                le_crd.credit_status,
                le_crd.credit_timestamp,
                /* TAGS */
                tg.tags,
               /*  victory victory.total_victory,victoryd.`total_defeat` */
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

        FROM le_leagueimages AS le_leimg
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
           FROM le_comments AS c
           LEFT JOIN
           (
              SELECT i.*,
                     GROUP_CONCAT(i.comment,"**^^**") AS chdcomment,
                     GROUP_CONCAT(i.comment_id,"**^^**") AS chdcomment_id,
                     GROUP_CONCAT(i.user_id,"**^^**") AS chdcomment_userid,
                     GROUP_CONCAT(i.comment_date,"**^^**") AS chdcomment_date,
                     GROUP_CONCAT(l_user.user_name,"**^^**") AS luser_name 
              FROM `le_comments` AS i
              LEFT JOIN `le_users` AS l_user ON l_user.`user_id` = i.`user_id`	      
              GROUP BY i.parent_id 
           ) AS chdg ON chdg.parent_id = c.comment_id
           WHERE c.`parent_id` = 0
           GROUP BY c.leagueimage_id
           ORDER BY c.leagueimage_id 
         ) AS cmtData ON cmtData.`leagueimage_id` = le_leimg.`leagueimage_id`  
         LEFT JOIN
          (
            SELECT u.*
            FROM le_users AS u
            WHERE u.user_status = "A"    
          ) AS user ON le_leimg.leagueimage_userid = user.user_id
        RIGHT JOIN
            (
              SELECT ctg.*
              FROM le_category AS ctg
              WHERE ctg.category_status = "A" AND ctg.category_name = "All the Things"    
            ) AS ctgry ON le_leimg.category_id = ctgry.category_id  
        LEFT JOIN `le_credits` AS le_crd ON le_crd.`leagueimage_id` = le_leimg.`leagueimage_id`  
         LEFT JOIN
         (
            SELECT count(vic.victory_id) AS total_victory,
                   vic.*
            FROM le_victory as vic 
            WHERE vic.victory_defeat = "V"
            GROUP BY vic.leagueimages_id
            ORDER BY vic.leagueimages_id
         ) AS victory ON victory.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(vicd.victory_id) AS total_defeat,
                   vicd.*
            FROM le_victory as vicd 
            WHERE vicd.victory_defeat = "D"
            GROUP BY vicd.leagueimages_id
            ORDER BY vicd.leagueimages_id
         ) AS victoryd ON victoryd.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(fvt.leagueimage_id) AS favourite,
                   GROUP_CONCAT(fvt.favourites_id) AS fvtid,
                   GROUP_CONCAT(fvt.user_id) AS fvtuserid,
                   fvt.*
            FROM  le_favourites as fvt 
            WHERE fvt.favourites_status = "A"
            GROUP BY fvt.leagueimage_id
            ORDER BY fvt.leagueimage_id
         ) AS faver ON faver.`leagueimage_id` = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(cmt.comment) AS total_comment,
                   cmt.*
            FROM  le_comments as cmt
            WHERE cmt.`parent_id` = 0 
            GROUP BY cmt.leagueimage_id
            ORDER BY cmt.leagueimage_id
         ) AS comment ON comment.`leagueimage_id` = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
           SELECT GROUP_CONCAT(t.tag) AS tags,
                  t.*
           FROM  le_tags AS t
           GROUP BY t.leagueimage_id
           ORDER BY t.leagueimage_id
         ) AS tg ON tg.`leagueimage_id` = le_leimg.`leagueimage_id`
        WHERE le_leimg.`leagueimage_status` = "A" AND le_leimg.`leagueimage_setpopular` = "N"
        ORDER BY le_leimg.`leagueimage_id` desc LIMIT ' . $start . ',' . $limit;
        
        $query = $this->db->query($quy);
        //$query = $this->db->get();
        if ($query->num_rows() > 0) {
             return $query->result();
        }
        return false;
    }

    function get_all_youtube() {
        $this->db->select('*');
        $this->db->from('youtube');
        $this->db->where('status', 'Active');
        $query = $this->db->get();
        return $query->row();
    }

    function check_like($user_id, $comment_id) {
        $this->db->select('*');
        $this->db->from('comment_points');
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return $query->result();
    }

    function like($data) {
        $this->db->insert('comment_points', $data);
        return TRUE;
    }

    function update_like($user_id, $comment_id, $data) {
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $this->db->update('comment_points', $data);
        return TRUE;
    }

    function delete_like($user_id, $comment_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $this->db->delete('comment_points');
        return TRUE;
    }

}

?>
