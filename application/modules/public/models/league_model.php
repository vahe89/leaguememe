<?php

/**
 * Description of crud
 *
 * @author abc
 */
class League_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function list_league($main, $sub, $anime = 0, $start) {
        if ($main == "new") {
            $popular = "AND le_leimg.leagueimage_setpopular = 'N'";
        } else if ($main == "popular") {
            $popular = "AND le_leimg.leagueimage_setpopular = 'Y'";
        } else {
            $popular = 'AND favourites_status = "A"';
        }

        if ($sub == 0) {
            $sub = '';
            $orderBy = 'ORDER BY RAND() desc LIMIT ' . $start . ',10';
        } else {
            $sub = "AND ctg.category_id = " . $sub;
            $orderBy = 'ORDER BY le_leimg.`leagueimage_id` desc LIMIT ' . $start . ',10';
//            $orderBy = 'ORDER BY total_comment desc ,total_victory desc LIMIT 0,8';
        }
//        echo "FIrst:::" . $orderBy;
        if ($anime == 0) {
            $anim_where = '';
            $anim_query = '';
            $anime_data = '';
//            $orderBy = 'ORDER BY le_leimg.`leagueimage_id` desc LIMIT 0,8';
        } else {
            $anim_query = ' LEFT JOIN
            (
              SELECT an.*
              FROM le_animecategory AS an
              WHERE an.anime_categoryid = ' . $anime . ' 
                GROUP BY an.leaguememe_id
                ORDER BY an.leaguememe_id
            ) AS anictgry ON anictgry.`leaguememe_id` = le_leimg.`leagueimage_id`';
            $anim_where = ' AND anictgry.anime_categoryid = ' . $anime;
            $anime_data = 'anictgry.`anime_categoryid`,';
//            $orderBy = 'ORDER BY le_leimg.`leagueimage_id` desc LIMIT 0,8';
        }

        $quy = 'SELECT  le_leimg.*,
            bb.anime_cat,bb.anime_nm,

                ctgry.category_name,
                ' . $anime_data . '
                 
                /* user data */
                user.user_name,
                user.user_email,
                user.user_region,
                user.user_image,
                user.NFSW,
                user.spoiler,
                user.online_status,
                /* credit */
                le_crd.credit_id,
                le_crd.credit,
                le_crd.author,
                le_crd.credit_status,
                le_crd.credit_timestamp,
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
                cmtData.childusername,album.`le_parentid`,album.`le_parentimg`,album.`le_parentvideo`,
                CASE WHEN (album.`total_images` IS NULL OR album.`total_images` = "")
                         THEN "0"
                         ELSE album.`total_images`
                END AS total_images_parent
                
        FROM le_leagueimages AS le_leimg
        LEFT JOIN
          (
            SELECT al.*,
                   count(al.leagueimage_id) as total_images, 
                   GROUP_CONCAT(al.leagueimage_id,"^^%%^^") AS le_parentid,
                   GROUP_CONCAT(al.leagueimage_filename,"^^%%^^") AS le_parentimg,
                   GROUP_CONCAT(al.videoname,"^^%%^^") AS le_parentvideo
            FROM le_leagueimages AS al
            WHERE al.leagueimage_status = "A" AND al.parent_id != 0 
            GROUP BY al.parent_id
            ORDER BY al.parent_id
          ) AS album ON le_leimg.leagueimage_id = album.parent_id
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
              WHERE ctg.category_status = "A" ' . $sub . '
            ) AS ctgry ON le_leimg.category_id = ctgry.category_id  
        LEFT JOIN `le_credits` AS le_crd ON le_crd.`leagueimage_id` = le_leimg.`leagueimage_id`  
       
         LEFT JOIN
         (
            SELECT count(vic.victory_id) AS total_victory,
                   GROUP_CONCAT(vic.user_id) AS vic_users,
                   vic.*
            FROM le_victory as vic 
            WHERE vic.victory_defeat = "V"
            GROUP BY vic.leagueimages_id
            ORDER BY vic.leagueimages_id
         ) AS victory ON victory.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(vicd.victory_id) AS total_defeat,
                   GROUP_CONCAT(vicd.user_id) AS def_users,
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
          SELECT b.*,
                  GROUP_CONCAT(b.anime_categoryid) as anime_cat,
               GROUP_CONCAT(cc.anime_nm) as anime_nm      
            FROM `le_animecategory` as b
            LEFT JOIN
            (
             SELECT c.*,
                 GROUP_CONCAT(c.anime_name) as anime_nm
                FROM anime as c
                GROUP BY c.anime_id
                ORDER BY c.anime_id
            ) as cc on cc.anime_id = b.anime_categoryid
            GROUP BY b.leaguememe_id
            Order by b.leaguememe_id
        ) as bb on le_leimg.leagueimage_id = bb.leaguememe_id

         LEFT JOIN
         (
           SELECT GROUP_CONCAT(t.tag) AS tags,
                  t.*
           FROM  le_tags AS t
           GROUP BY t.leagueimage_id
           ORDER BY t.leagueimage_id
         ) AS tg ON tg.`leagueimage_id` = le_leimg.`leagueimage_id`
        
          ' . $anim_query .
                'WHERE le_leimg.`leagueimage_status` = "A" ' . $anim_where . ' ' . $popular . ' AND le_leimg.`parent_id` = 0
                ' . $orderBy;

        $query = $this->db->query($quy);
        return $query->result();
    }

    function victory_defeat($user_id, $league_image_id) {
        $this->db->select('*');
        $this->db->from('le_victory');
        $this->db->where('user_id', $user_id);
        $this->db->where('leagueimages_id', $league_image_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function add_victory_defeat($dataArr) {
        $this->db->insert('le_victory', $dataArr);
        return $this->db->insert_id();
    }

    function updatevictory($dataArr, $victory_id) {
        $this->db->where('victory_id', $victory_id)->update('le_victory', $dataArr);
        return;
    }

    function sel_favourites($user_id, $league_image_id) {
        $this->db->select('*');
        $this->db->from('le_favourites');
        $this->db->where('user_id', $user_id);
        $this->db->where('leagueimage_id', $league_image_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function add_favourites($dataArr) {
        $this->db->insert('le_favourites', $dataArr);
        return $this->db->insert_id();
    }

    function removefavourites($user_id, $favourites_id) {
        $result = $this->db->where('favourites_id', $favourites_id)
                ->where('user_id', $user_id)
                ->where('favourites_status', "A")
                ->delete('le_favourites');
    }

    function get_total_row($main, $sub) {
        if ($main == "new") {
            $sub2 = "WHERE leagueimage_setpopular = 'N'";
        } else if ($main == "popular") {
            $sub2 = "WHERE leagueimage_setpopular = 'Y'";
        } else {
            $sub2 = 'WHERE leagueimage_setpopular != ""';
        }
        if ($sub == 0) {
            $sub1 = '';
        } else {
            $sub1 = "AND category_id = " . $sub;
        }

        $sql = "SELECT COUNT(*) as totalRecord
                  FROM le_leagueimages
                          $sub2  
                          $sub1";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function list_scroll_league($main, $sub, $anime, $start, $limit) {
        if ($main == "new") {
            $popular = "AND le_leimg.leagueimage_setpopular = 'N'";
        } else if ($main == "popular") {
            $popular = "AND le_leimg.leagueimage_setpopular = 'Y'";
        } else {
            $popular = 'AND favourites_status = "A"';
        }

        if ($sub == 0) {
            $sub = '';
            $orderBy = 'ORDER BY RAND() desc LIMIT ' . $start . ',' . $limit . '';
        } else {
            $sub = "AND ctg.category_id = " . $sub;
            $orderBy = 'ORDER BY le_leimg.`leagueimage_id` desc LIMIT ' . $start . ',' . $limit . '';
//            $orderBy = 'ORDER BY total_comment desc ,total_victory desc LIMIT ' . $start . ',' . $limit . '';
        }
//        echo "Second:::" . $orderBy;
        if ($anime == 0) {
            $anim_where = '';
            $anim_query = '';
            $anime_data = '';
//            $orderBy = 'ORDER BY le_leimg.`leagueimage_id` desc LIMIT 0,8';
        } else {
            $anim_query = ' LEFT JOIN
            (
              SELECT an.*
              FROM le_animecategory AS an
              WHERE an.anime_categoryid = ' . $anime . ' 
                GROUP BY an.leaguememe_id
                ORDER BY an.leaguememe_id
            ) AS anictgry ON anictgry.`leaguememe_id` = le_leimg.`leagueimage_id`';
            $anim_where = ' AND anictgry.anime_categoryid = ' . $anime;
            $anime_data = 'anictgry.`anime_categoryid`,';
//            $orderBy = 'ORDER BY le_leimg.`leagueimage_id` desc LIMIT 0,8';
        }

        $quy = 'SELECT  le_leimg.*,
                ctgry.category_name,
                 bb.anime_cat,bb.anime_nm,
                ' . $anime_data . '
                /* user data */
                user.user_name,
                user.user_email,
                user.user_region,
                user.user_image,
                user.NFSW,
                user.spoiler,
                user.online_status,
                /* credit */
                le_crd.credit_id,
                le_crd.credit,
                le_crd.author,
                le_crd.credit_status,
                le_crd.credit_timestamp,
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
                cmtData.childusername,album.`le_parentid`,album.`le_parentimg`,album.`le_parentvideo`,
                CASE WHEN (album.`total_images` IS NULL OR album.`total_images` = "")
                         THEN "0"
                         ELSE album.`total_images`
                END AS total_images_parent
                
        FROM le_leagueimages AS le_leimg
        LEFT JOIN
          (
            SELECT al.*,
                   count(al.leagueimage_id) as total_images, 
                   GROUP_CONCAT(al.leagueimage_id,"^^%%^^") AS le_parentid,
                   GROUP_CONCAT(al.leagueimage_filename,"^^%%^^") AS le_parentimg,
                   GROUP_CONCAT(al.videoname,"^^%%^^") AS le_parentvideo
            FROM le_leagueimages AS al
            WHERE al.leagueimage_status = "A" AND al.parent_id != 0 
            GROUP BY al.parent_id
            ORDER BY al.parent_id
          ) AS album ON le_leimg.leagueimage_id = album.parent_id
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
              WHERE ctg.category_status = "A" ' . $sub . '
            ) AS ctgry ON le_leimg.category_id = ctgry.category_id  
        LEFT JOIN `le_credits` AS le_crd ON le_crd.`leagueimage_id` = le_leimg.`leagueimage_id`  
         LEFT JOIN
         (
            SELECT count(vic.victory_id) AS total_victory,
                   GROUP_CONCAT(vic.user_id) AS vic_users,
                   vic.*
            FROM le_victory as vic 
            WHERE vic.victory_defeat = "V"
            GROUP BY vic.leagueimages_id
            ORDER BY vic.leagueimages_id
         ) AS victory ON victory.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(vicd.victory_id) AS total_defeat,
                   GROUP_CONCAT(vicd.user_id) AS def_users,
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
          SELECT b.*,
                  GROUP_CONCAT(b.anime_categoryid) as anime_cat,
               GROUP_CONCAT(cc.anime_nm) as anime_nm      
            FROM `le_animecategory` as b
            LEFT JOIN
            (
             SELECT c.*,
                 GROUP_CONCAT(c.anime_name) as anime_nm
                FROM anime as c
                GROUP BY c.anime_id
                ORDER BY c.anime_id
            ) as cc on cc.anime_id = b.anime_categoryid
            GROUP BY b.leaguememe_id
            Order by b.leaguememe_id
        ) as bb on le_leimg.leagueimage_id = bb.leaguememe_id
         LEFT JOIN
         (
           SELECT GROUP_CONCAT(t.tag) AS tags,
                  t.*
           FROM  le_tags AS t
           GROUP BY t.leagueimage_id
           ORDER BY t.leagueimage_id
         ) AS tg ON tg.`leagueimage_id` = le_leimg.`leagueimage_id`
       ' . $anim_query .
                'WHERE le_leimg.`leagueimage_status` = "A" ' . $anim_where . ' ' . $popular . ' AND le_leimg.`parent_id` = 0
        ' . $orderBy;
        $query = $this->db->query($quy);
        return $query->result();
    }

    function get_subTab_id($sub_name) {
        $sql = 'SELECT category_id 
                FROM le_category
                WHERE category_name = "' . $sub_name . '"
                ';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function single_image_list($league_id) {

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
                le_crd.author,
                le_crd.credit_status,
                le_crd.credit_timestamp,
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
                cmtData.childusername,
                album.`le_parentid`,album.`le_parentimg`,album.`le_parentvideo`,album.`le_parentname`,album.`le_description`,
                CASE WHEN (album.`total_images` IS NULL OR album.`total_images` = "")
                         THEN "0"
                         ELSE album.`total_images`
                END AS total_images_parent

        FROM le_leagueimages AS le_leimg
         LEFT JOIN
          (
            SELECT al.*,
                   count(al.leagueimage_id) as total_images, 
                   GROUP_CONCAT(al.leagueimage_id,"^^%%^^") AS le_parentid,
                   GROUP_CONCAT(al.leagueimage_filename,"^^%%^^") AS le_parentimg,
                   GROUP_CONCAT(al.leagueimage_name,"^^%%^^") AS le_parentname,
                   GROUP_CONCAT(al.leagueimage_description,"^^%%^^") AS le_description,
                   GROUP_CONCAT(al.videoname,"^^%%^^") AS le_parentvideo
            FROM le_leagueimages AS al
            WHERE al.leagueimage_status = "A" AND al.parent_id != 0 
            GROUP BY al.parent_id
            ORDER BY al.parent_id
          ) AS album ON le_leimg.leagueimage_id = album.parent_id
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
                   GROUP_CONCAT(vic.user_id) AS vic_users,
                   vic.*
            FROM le_victory as vic 
            WHERE vic.victory_defeat = "V"
            GROUP BY vic.leagueimages_id
            ORDER BY vic.leagueimages_id
         ) AS victory ON victory.leagueimages_id = le_leimg.`leagueimage_id`
         LEFT JOIN
         (
            SELECT count(vicd.victory_id) AS total_defeat,
                   GROUP_CONCAT(vicd.user_id) AS def_users,
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
        WHERE le_leimg.`leagueimage_status` = "A" AND le_leimg.`leagueimage_id` = ' . $league_id . '
        ORDER BY le_leimg.`leagueimage_id` desc';
        $query = $this->db->query($quy);
        return $query->result();
    }

    function get_leagueimage_id($position, $limit, $league_name) {

        $this->db->select('leagueimage_id');
        $this->db->like('tag', $league_name);
        $this->db->distinct();
        $this->db->order_by('leagueimage_id', 'desc');
        if ($position > 0) {
            if ($position == 1) {
                $position = 0;
            }
            $this->db->limit($limit, $position);
        }
        //echo $this->db->last_query();
        return $this->db->get('le_tags');
    }

    function league_search($ids) {
        if (empty($ids)) {
            $ids = '0';
        } 
        $quy = "SELECT *, `le_leagueimages`.`leagueimage_id` as leagueimage_id, `le_users`.`user_name`, GROUP_CONCAT(tag) as tags,
                  (SELECT count(victory_id) FROM le_victory WHERE le_victory.leagueimages_id = le_leagueimages.leagueimage_id AND le_victory.victory_defeat = 'V' GROUP BY le_victory.leagueimages_id ORDER BY le_victory.leagueimages_id) as total_victory, 
                  (SELECT GROUP_CONCAT(user_id) AS vic_users FROM le_victory WHERE le_victory.leagueimages_id = le_leagueimages.leagueimage_id AND le_victory.victory_defeat = 'V' GROUP BY le_victory.leagueimages_id ORDER BY le_victory.leagueimages_id) as vic_user, 
                  (SELECT GROUP_CONCAT(user_id) AS def_users FROM le_victory WHERE le_victory.leagueimages_id = le_leagueimages.leagueimage_id AND le_victory.victory_defeat = 'D' GROUP BY le_victory.leagueimages_id ORDER BY le_victory.leagueimages_id) as def_users, (SELECT GROUP_CONCAT(user_id) AS fvtuserid FROM le_favourites WHERE le_favourites.leagueimage_id = le_leagueimages.leagueimage_id AND le_favourites.favourites_status = 'A' ) as fvtuserid, 
                  (SELECT GROUP_CONCAT(favourites_id) AS fvtid FROM le_favourites WHERE le_favourites.leagueimage_id = le_leagueimages.leagueimage_id AND le_favourites.favourites_status = 'A' ) as fvtid, (SELECT count(victory_id) FROM le_victory WHERE le_victory.leagueimages_id = le_leagueimages.leagueimage_id AND le_victory.victory_defeat = 'D') as total_defeat, (SELECT count(leagueimage_id) FROM le_favourites WHERE le_favourites.leagueimage_id = le_leagueimages.leagueimage_id AND le_favourites.favourites_status = 'A') as total_favourite, 
                  (SELECT count(comment) FROM le_comments WHERE le_comments.leagueimage_id = le_leagueimages.leagueimage_id) as total_comment FROM (`le_leagueimages`) 
                  
                    JOIN `le_category` ON `le_category`.`category_id`=`le_leagueimages`.`category_id` 
                    LEFT JOIN `le_tags` ON `le_leagueimages`.`leagueimage_id` = `le_tags`.`leagueimage_id`
                    LEFT JOIN `le_credits` ON `le_credits`.`leagueimage_id` = `le_leagueimages`.`leagueimage_id` 
                    LEFT JOIN `le_users` ON `le_leagueimages`.`leagueimage_userid` = `le_users`.`user_id` 
                    LEFT JOIN (
                            SELECT an.* ,a.anime_name,GROUP_CONCAT(a.anime_name) AS anime_nm ,GROUP_CONCAT(a.anime_id) AS anime_cat
                            FROM le_animecategory AS an  LEFT JOIN anime as a ON a.anime_id = an.anime_categoryid 
                            GROUP BY an.leaguememe_id
                            ORDER BY an.leaguememe_id
                        ) AS anictgry ON anictgry.`leaguememe_id` = le_leagueimages.`leagueimage_id` 
                    LEFT JOIN `le_favourites` ON `le_favourites`.`leagueimage_id` = `le_leagueimages`.`leagueimage_id` AND le_favourites.favourites_status = 'A' 
                    WHERE `leagueimage_status` = 'A' AND `le_leagueimages`.`leagueimage_id` IN (" . $ids . ")
                    GROUP BY `le_tags`.`leagueimage_id` 
                    ORDER BY `le_leagueimages`.`leagueimage_id` desc LIMIT 8"; 
        $query = $this->db->query($quy); 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    function removevictory($user_id, $league_id) {
        $result = $this->db->where('leagueimages_id', $league_id)
                ->where('user_id', $user_id)
                ->where('victory_defeat', "V")
                ->delete('le_victory');
    }

    function removedefact($user_id, $league_id) {
        $result = $this->db->where('leagueimages_id', $league_id)
                ->where('user_id', $user_id)
                ->where('victory_defeat', "D")
                ->delete('le_victory');
    }

    function add_league_img($dataArr) {
        $this->db->insert('le_leagueimages', $dataArr);
        return $this->db->insert_id();
    }

    function add_anime_category($dataArr) {
        $this->db->insert('le_animecategory', $dataArr);
        return $this->db->insert_id();
    }

    function add_url_credit($creditdata) {
        $this->db->insert('le_credits', $creditdata);
        return $this->db->insert_id();
    }

    function add_url_tag($tagArray) {
        $this->db->insert('le_tags', $tagArray);
        return $this->db->insert_id();
    }

    /* tags */

    function getuser_details($userid) {
        $this->db->select('*');
        $this->db->from('le_users');
        $this->db->where('user_id', $userid);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_all_sidelinks() {
        $this->db->select('*');
        $this->db->from('sidebar');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_detail_sidelink($league_id) {
        $this->db->select('*');
        $this->db->from('le_leagueimages');
        $this->db->join('le_category', 'le_category.category_id=le_leagueimages.category_id');
        $this->db->where('leagueimage_id', $league_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function updateFavouriteById($id, $data) {
        return $this->db->where('favourites_id', $id)
                        ->update('le_favourites', $data);
    }

    function add_fav($fav_array) {
        $this->db->insert('le_favourites', $fav_array);
    }

    function league_favorites_page($uid, $limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->from('le_favourites');
        $this->db->join('le_leagueimages', 'le_favourites.leagueimage_id=le_leagueimages.leagueimage_id');
        $this->db->where('user_id', $uid);
        $this->db->where('favourites_status', 'A');
        $query = $this->db->get();
        return $query->result_array();
    }

    function league_favorites($uid) {

        $this->db->select('*');
        $this->db->from('le_favourites');
        $this->db->join('le_leagueimages', 'le_favourites.leagueimage_id=le_leagueimages.leagueimage_id');
        $this->db->where('user_id', $uid);
        $this->db->where('favourites_status', 'A');
        $query = $this->db->get();
        return $query->result_array();
    }

    function delete_comment($league_comment, $userid) {
        $result = $this->db->where('comment_id', $league_comment)->delete('le_comments');
        $result = $this->db->where('parent_id', $league_comment)->delete('le_comments');
        $result = $this->db->where('comment_id', $league_comment)->where('user_id', $userid)->delete('comment_points');
        return;
    }

//    function delete_commentpoint($league_comment,$userid){
//       $result = $this->db->where('comment_id', $league_comment)>where('user_id', $user_id)->delete('comment_points');
//        return; 
//    }        
    function add_comments($commentArray) {
        $this->db->insert('le_comments', $commentArray);
        return $this->db->insert_id();
    }

    function add_league_imgtags($dataArr) {
        $this->db->insert('le_tags', $dataArr);
        return $this->db->insert_id();
    }

    function add_league_credits($dataArr) {
        $this->db->insert('le_credits', $dataArr);
        return $this->db->insert_id();
    }

    function count_league($user_id) {
        $this->db->select('count(leagueimage_id) as total_post');
        $this->db->from('le_leagueimages');
        $this->db->where('leagueimage_userid', $user_id);
        $this->db->where('parent_id', '0');
        $query = $this->db->get();
        return $query->row();
    }

    function save_poll_data($dataArr) {
        $this->db->insert('poll_data', $dataArr);
        return $this->db->insert_id();
    }

    function add_poll_anime_category($dataArr) {
        $this->db->insert('le_poll_animecategory', $dataArr);
        return $this->db->insert_id();
    }

//    for report

    function add_report_data($dataArr) {
        $this->db->insert('le_report', $dataArr);
        return $this->db->insert_id();
    }

    function check_report($user_id, $anime_report_id) {
        $this->db->select('*');
        $this->db->from('le_report');
        $this->db->where('status', '0');
        $this->db->where('league_report_id', $user_id);
        $this->db->where('anime_report_id', $anime_report_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function update_report($reportArray, $anime_report_id, $user_id) {
        $this->db->where('anime_report_id', $anime_report_id)
                ->where('league_report_id', $user_id)
                ->where('status', '0')
                ->update('le_report', $reportArray);
        return;
    }

    function update_view($league_id, $viewArray) {

        $this->db->where('leagueimage_id', $league_id)
                ->update('le_leagueimages', $viewArray);
        return;
    }

    function select_league($result) {

        $query = "select * from le_leagueimages where leagueimage_id=$result   order by leagueimage_id DESC limit 1";

        $res = $this->db->query($query);

        if ($res->num_rows() > 0) {
            return $res->result("array");
        }
        return array();
    }

}

?>