<?php

class Discussion_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function discussion_list($main, $user_id = 0, $row, $rowperpage) {
        if ($main == "new") {
            $popular = 'ani_dis.animediscussion_popular = "N"';
        } else if ($main == "popular") {
            $popular = 'ani_dis.animediscussion_popular = "Y" ';
        } else if ($main == "fav") {
            $popular = '(ani_dis.bookmark = "1" OR favourites_status = "A")';
        } else {
            $popular = 'ani_dis.animediscussion_popular = "Y" ';
        }


        $quy = 'SELECT  ani_dis.*,
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
                cmtData.childcmtdate
                
                
        FROM anime_discussion AS ani_dis
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
           FROM discussion_comment AS c
           LEFT JOIN
           (
              SELECT i.*,
                     GROUP_CONCAT(i.comment,"**^^**") AS chdcomment,
                     GROUP_CONCAT(i.comment_id,"**^^**") AS chdcomment_id,
                     GROUP_CONCAT(i.user_id,"**^^**") AS chdcomment_userid,
                     GROUP_CONCAT(i.comment_date,"**^^**") AS chdcomment_date,
                     GROUP_CONCAT(l_user.user_name,"**^^**") AS luser_name 
              FROM `discussion_comment` AS i
              LEFT JOIN `le_users` AS l_user ON l_user.`user_id` = i.`user_id`	      
              GROUP BY i.parent_id 
           ) AS chdg ON chdg.parent_id = c.comment_id
           WHERE c.`parent_id` = 0
           GROUP BY c.anime_discussionid
           ORDER BY c.anime_discussionid 
         ) AS cmtData ON cmtData.`anime_discussionid` = ani_dis.`anime_discussionid` 
        LEFT JOIN
          (
            SELECT u.*
            FROM le_users AS u
            WHERE u.user_status = "A"    
          ) AS user ON  ani_dis.discussion_userid = user.user_id
           LEFT JOIN
         (
            SELECT count(vic.point_id) AS total_victory,
                   GROUP_CONCAT(vic.user_id) AS vic_users,
                   vic.*
            FROM discussion_point as vic 
            WHERE vic.points = "L"
            GROUP BY vic.anime_discussionid
            ORDER BY vic.anime_discussionid
         ) AS victory ON victory.anime_discussionid = ani_dis.`anime_discussionid`
         LEFT JOIN
         (
            SELECT count(vicd.point_id) AS total_defeat,
                   GROUP_CONCAT(vicd.user_id) AS def_users,
                   vicd.*
            FROM discussion_point as vicd 
            WHERE vicd.points = "D"
            GROUP BY vicd.anime_discussionid
            ORDER BY vicd.anime_discussionid
         ) AS victoryd ON victoryd.anime_discussionid = ani_dis.`anime_discussionid`
          LEFT JOIN
         (
            SELECT count(fvt.anime_discussionid) AS favourite,
                   GROUP_CONCAT(fvt.favourites_id) AS fvtid,
                   GROUP_CONCAT(fvt.user_id) AS fvtuserid,
                   fvt.*
            FROM  dis_favourites as fvt 
            WHERE fvt.favourites_status = "A" AND fvt.user_id= ' . $user_id . '
            GROUP BY fvt.anime_discussionid
            ORDER BY fvt.anime_discussionid
         ) AS faver ON faver.`anime_discussionid` = ani_dis.`anime_discussionid`
          LEFT JOIN
         (
            SELECT count(cmt.comment) AS total_comment,
                   cmt.*
            FROM  discussion_comment as cmt
            WHERE cmt.`parent_id` = 0 
            GROUP BY cmt.anime_discussionid
            ORDER BY cmt.anime_discussionid
         ) AS comment ON comment.`anime_discussionid` = ani_dis.`anime_discussionid`
         LEFT JOIN
        (
          SELECT b.*,
                  GROUP_CONCAT(b.anime_category_id) as anime_cat,
               GROUP_CONCAT(cc.anime_nm) as anime_nm      
            FROM `anime_discussion_category` as b
            LEFT JOIN
            (
             SELECT c.*,
                 GROUP_CONCAT(c.anime_name) as anime_nm
                FROM anime as c
                GROUP BY c.anime_id
                ORDER BY c.anime_id
            ) as cc on cc.anime_id = b.anime_category_id
            GROUP BY b.anime_discussionid
            Order by b.anime_discussionid
        ) as bb on ani_dis.anime_discussionid = bb.anime_discussionid
         WHERE  ' . $popular . " ORDER BY ani_dis.anime_discussionid DESC LIMIT " . $row . ',' . $rowperpage;
        $query = $this->db->query($quy);
        return $query->result();
    }

    function get_total_row($main, $user_id = 0) {
        if ($main == "new") {
            $popular = 'ani_dis.animediscussion_popular = "N"';
        } else if ($main == "popular") {
            $popular = 'ani_dis.animediscussion_popular = "Y" ';
        } else if ($main == "fav") {
            $popular = '(ani_dis.bookmark = "1" OR favourites_status = "A")';
        } else {
            $popular = 'ani_dis.animediscussion_popular = "Y" ';
        }

        $sql = 'SELECT  count(*) as count   
                
        FROM anime_discussion AS ani_dis
        LEFT JOIN
         (
            SELECT count(fvt.anime_discussionid) AS favourite,
                   GROUP_CONCAT(fvt.favourites_id) AS fvtid,
                   GROUP_CONCAT(fvt.user_id) AS fvtuserid,
                   fvt.*
            FROM  dis_favourites as fvt 
            WHERE fvt.favourites_status = "A" AND fvt.user_id = ' . $user_id . '
            GROUP BY fvt.anime_discussionid
            ORDER BY fvt.anime_discussionid
         ) AS faver ON faver.`anime_discussionid` = ani_dis.`anime_discussionid`
         
          WHERE ' . $popular;

        $query = $this->db->query($sql);
        return $query->row();
    }

    function single_discussion_list($anime_discussionid) {

        $quy = 'SELECT  ani_dis.*,
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
                
                
        FROM anime_discussion AS ani_dis
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
           FROM discussion_comment AS c
           LEFT JOIN
           (
              SELECT i.*,
                     GROUP_CONCAT(i.comment,"**^^**") AS chdcomment,
                     GROUP_CONCAT(i.comment_id,"**^^**") AS chdcomment_id,
                     GROUP_CONCAT(i.user_id,"**^^**") AS chdcomment_userid,
                     GROUP_CONCAT(i.comment_date,"**^^**") AS chdcomment_date,
                     GROUP_CONCAT(l_user.user_name,"**^^**") AS luser_name 
              FROM `discussion_comment` AS i
              LEFT JOIN `le_users` AS l_user ON l_user.`user_id` = i.`user_id`	      
              GROUP BY i.parent_id 
           ) AS chdg ON chdg.parent_id = c.comment_id
           WHERE c.`parent_id` = 0
           GROUP BY c.anime_discussionid
           ORDER BY c.anime_discussionid 
         ) AS cmtData ON cmtData.`anime_discussionid` = ani_dis.`anime_discussionid` 
        LEFT JOIN
          (
            SELECT u.*
            FROM le_users AS u
            WHERE u.user_status = "A"    
          ) AS user ON  ani_dis.discussion_userid = user.user_id
           LEFT JOIN
         (
            SELECT count(vic.point_id) AS total_victory,
                   GROUP_CONCAT(vic.user_id) AS vic_users,
                   vic.*
            FROM discussion_point as vic 
            WHERE vic.points = "L"
            GROUP BY vic.anime_discussionid
            ORDER BY vic.anime_discussionid
         ) AS victory ON victory.anime_discussionid = ani_dis.`anime_discussionid`
         LEFT JOIN
         (
            SELECT count(vicd.point_id) AS total_defeat,
                   GROUP_CONCAT(vicd.user_id) AS def_users,
                   vicd.*
            FROM discussion_point as vicd 
            WHERE vicd.points = "D"
            GROUP BY vicd.anime_discussionid
            ORDER BY vicd.anime_discussionid
         ) AS victoryd ON victoryd.anime_discussionid = ani_dis.`anime_discussionid`
          LEFT JOIN
         (
            SELECT count(cmt.comment) AS total_comment,
                   cmt.*
            FROM  discussion_comment as cmt
            WHERE cmt.`parent_id` = 0 
            GROUP BY cmt.anime_discussionid
            ORDER BY cmt.anime_discussionid
         ) AS comment ON comment.`anime_discussionid` = ani_dis.`anime_discussionid`
         LEFT JOIN
        (
          SELECT b.*,
                  GROUP_CONCAT(b.anime_category_id) as anime_cat,
               GROUP_CONCAT(cc.anime_nm) as anime_nm      
            FROM `anime_discussion_category` as b
            LEFT JOIN
            (
             SELECT c.*,
                 GROUP_CONCAT(c.anime_name) as anime_nm
                FROM anime as c
                GROUP BY c.anime_id
                ORDER BY c.anime_id
            ) as cc on cc.anime_id = b.anime_category_id
            GROUP BY b.anime_discussionid
            Order by b.anime_discussionid
        ) as bb on ani_dis.anime_discussionid = bb.anime_discussionid
 
         
                WHERE ani_dis.anime_discussionid = "' . $anime_discussionid . '"
                ';
        $query = $this->db->query($quy);
//        echo $this->db->last_query();
//        exit;
        return $query->result();
    }

    function getRecentDiscussion($limit) {
        $sql = "SELECT ad.*,le_us.* FROM `anime_discussion` as ad
                JOIN  `le_users`   as le_us ON le_us.user_id = ad.discussion_userid
                ORDER BY ad.anime_discussionid desc LIMIT 0, $limit";
        $query = $this->db->query($sql);
        return $query->result();
    }

}
