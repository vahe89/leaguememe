<?php

/**
 * Description of crud
 *
 * @author abc
 */
class Anime_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getAnimeList($match, $mainTab) {

        if ($mainTab == 'all') {
            $popular = ' ';
        } else {
            $popular = 'anime_popular = 1  AND';
        }

        $qry = "SELECT * from anime WHERE " . $popular . " anime_name LIKE '" . $match . "%'  ORDER BY anime_name asc ";

        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function getAnimeDetail($match) {
        $this->db->select('*');
        $this->db->from('anime');
        $this->db->where('anime_id', $match);
        $query = $this->db->get();
        return $query->row();
    }

    function add_anime_review($dataArray) {
        $this->db->insert('le_reviewanime', $dataArray);
        return $this->db->insert_id();
    }

    function getanimeRating($rate, $anime_id) {
        $this->db->select('le_rev.overall_rate,GROUP_CONCAT(overall_rate) as overall');
        $this->db->from('le_reviewanime as le_rev');
        $this->db->where('le_rev.overall_rate', $rate);
        $this->db->where('le_rev.anime_id', $anime_id);
        $this->db->group_by("le_rev.overall_rate");
        $query = $this->db->get();
        return $query->row();
    }

    function getReviewDetail($reviewid) {
        $this->db->select('*');
        $this->db->from('le_reviewanime as le_rev');
        $this->db->join('le_users as l_user', 'l_user.user_id= le_rev.user_id', 'left');
        $this->db->join('anime as ani', 'ani.anime_id= le_rev.anime_id', 'left');
        $this->db->where('le_rev.id', $reviewid);
        $query = $this->db->get();
        return $query->row();
    }

    function getReviewAnimeList($user_review_id) {
        $this->db->select('*');
        $this->db->from('le_reviewanime as le_rev');
        $this->db->join('le_users as l_user', 'l_user.user_id= le_rev.user_id', 'left');
        $this->db->join('anime as ani', 'ani.anime_id= le_rev.anime_id', 'left');
        $this->db->where('le_rev.user_id', $user_review_id);
        $this->db->group_by("le_rev.anime_id");
        $query = $this->db->get();
        return $query->result_array();
    }

    function add_reviewcomment($ins_comment) {
        $this->db->insert('review_comment', $ins_comment);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function getAnimeReviewCmtData($id) {
        $sql = 'SELECT cp.*, cp.user_id as cmnt_user_id, cp.rev_commentid as cmnt_comment_id,le_ct. * , u.user_name,u.user_region,u.user_image
                FROM `review_comment` AS le_ct
                LEFT JOIN le_users AS u ON le_ct.user_id = u.user_id
                LEFT JOIN review_comment_point AS cp ON cp.rev_commentid = le_ct.rev_commentid
                WHERE le_ct.anime_rev_id =' . $id . '
                ORDER BY `parent_id`,`review_comment_timestamp` desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getAnimeAllDetail($match) {
        $this->db->select('*');
        $this->db->from('admin_animeedit');
        $this->db->where('anime_id', $match);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getReviewCommentLikes($comment_id) {
        $this->db->select('like');
        $this->db->from('review_comment_point');
        $this->db->where('like', '1');
        $this->db->where('rev_commentid', $comment_id);
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function getReviewCommentDislikes($comment_id) {
        $this->db->select('like');
        $this->db->from('review_comment_point');
        $this->db->where('like', '0');
        $this->db->where('rev_commentid', $comment_id);
        $query = $this->db->get();
        return count($query->result_array());
    }

    function check_like($user_id, $comment_id) {
        $this->db->select('*');
        $this->db->from('review_comment_point');
        $this->db->where('user_id', $user_id);
        $this->db->where('rev_commentid', $comment_id);
        $query = $this->db->get();
        return $query->result();
    }

    function like($data) {
        $this->db->insert('review_comment_point', $data);
        return TRUE;
    }

    function update_like($user_id, $comment_id, $data) {
        $this->db->where('user_id', $user_id);
        $this->db->where('rev_commentid', $comment_id);
        $this->db->update('review_comment_point', $data);
        return TRUE;
    }

    function delete_like($user_id, $comment_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('rev_commentid', $comment_id);
        $this->db->delete('review_comment_point');
        return TRUE;
    }

    function delete_comment($league_comment, $userid) {
        $result = $this->db->where('rev_commentid', $league_comment)->delete('review_comment');
        $result = $this->db->where('parent_id', $league_comment)->delete('review_comment');
        $result = $this->db->where('rev_commentid', $league_comment)->where('user_id', $userid)->delete('review_comment');
        return;
    }

    function add_reviewlike($dataArray) {
        $this->db->insert('review_like', $dataArray);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function countpositive_votes($review_id) {
        $this->db->select('count(review_id) as positive_vote');
        $this->db->from('review_like');
        $this->db->where('review_id', $review_id);
        $this->db->where('like', 1);
        $query = $this->db->get();
        return $query->row();
    }

    function counttotal_votes($review_id) {
        $this->db->select('count(review_id) as total_vote');
        $this->db->from('review_like');
        $this->db->where('review_id', $review_id);
        $query = $this->db->get();
        return $query->row();
    }

    function check_review_like($user_id, $review_id) {
        $this->db->select('*');
        $this->db->from('review_like');
        $this->db->where('review_id', $review_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function updateReviewLike($dataArr, $like_id) {
        $this->db->where('id', $like_id)->update('review_like', $dataArr);
        return;
    }

    function removeReviewlike($user_id, $review_id) {
        $result = $this->db->where('review_id', $review_id)
                ->where('user_id', $user_id)
                ->where('like', "1")
                ->delete('review_like');
    }

    function removeReviewdislike($user_id, $review_id) {
        $result = $this->db->where('review_id', $review_id)
                ->where('user_id', $user_id)
                ->where('like', "0")
                ->delete('review_like');
    }

    function getReviewlikelist($anime_id, $like) {
        $qry = 'SELECT * , count( review_id) as total_review FROM `le_reviewanime` as re
                LEFT JOIN le_users as u ON re.user_id = u.user_id
                LEFT JOIN
                (
                   SELECT * 
                    FROM review_like as rl
                    WHERE rl.like= ' . $like . '
                )AS rrl ON rrl.review_id= re.id
                where re.anime_id = ' . $anime_id . '
                GROUP BY re.user_id
                ORDER BY total_review desc';
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function getReviewtimelist($anime_id, $time) {
        $qry = 'SELECT * , count(review_id) as total_review FROM `le_reviewanime` as re
                LEFT JOIN le_users as u ON re.user_id = u.user_id
                LEFT JOIN
                (
                   SELECT * 
                    FROM review_like as rl     
                    
                
                )AS rrl ON rrl.review_id= re.id
                where re.anime_id =' . $anime_id . '
                GROUP BY re.user_id 
                    ORDER BY re.review_timestamp ' . $time;
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function getReviewlist($anime_id) {
        $qry = ' SELECT *, re.id as reid, re.user_id as userid FROM `le_reviewanime` as re
                LEFT JOIN le_users as u ON re.user_id = u.user_id
                LEFT JOIN anime as a  ON re.anime_id = a.anime_id
                LEFT JOIN
                (
                   SELECT * , count(rl.review_id) as total_review
                    FROM review_like as rl
                    WHERE rl.like=1
                        GROUP BY rl.review_id

                )AS rrl ON rrl.review_id= re.id
                where re.anime_id = ' . $anime_id;

        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function check_anime_fav($user_id, $anime_id) {
        $this->db->select('*');
        $this->db->from('anime_favourite');
        $this->db->where('anime_id', $anime_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function add_animefavourites($favouritesArray) {
        $this->db->insert('anime_favourite', $favouritesArray);
        return $this->db->insert_id();
    }

    function removeanimefavourites($user_id, $favourites_id) {
        $result = $this->db->where('anime_id', $favourites_id)
                ->where('user_id', $user_id)
                ->where('favourite', "A")
                ->delete('anime_favourite');
    }

    function getafavAnimeList($match, $mainTab, $user_id) {
        if ($mainTab == 'all') {
            $popular = ' ';
        } else {
            $popular = 'anime_popular = 1  AND';
        }

        $qry = "SELECT *,an.anime_id,aff.user_id from anime as an
        LEFT JOIN
        (
        select af.*
        from
        anime_favourite as af
        WHERE af.user_id = " . $user_id . "
        )
        AS aff ON aff.anime_id = an.anime_id
        WHERE  " . $popular . " anime_name LIKE '" . $match . "%'  ORDER BY anime_name asc ";

        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function get_searchanime_list_after($match, $mainTab, $user_id) {
        if ($mainTab == 'all') {
            $popular = ' ';
        } else {
            $popular = 'anime_popular = 1  AND';
        }
        $qry = "SELECT *,an.anime_id,aff.user_id from anime as an
        LEFT JOIN
        (
        select af.*

        from
        anime_favourite as af
        WHERE af.user_id = " . $user_id . "
        )
        AS aff ON aff.anime_id = an.anime_id
         WHERE  " . $popular . "  anime_name LIKE '%" . $match . "%'  ORDER BY anime_name asc";

        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function get_searchanime_list($match, $mainTab) {
        if ($mainTab == 'all') {
            $popular = ' ';
        } else {
            $popular = 'anime_popular = 1  AND';
        }
        $qry = "SELECT *  from anime  
        WHERE  " . $popular . " anime_name LIKE '%" . $match . "%' ORDER BY anime_name asc";

        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function add_anime_discussion($dataArr) {
        $this->db->insert('anime_discussion', $dataArr);
        return $this->db->insert_id();
    }

    function add_anime_category($dataArr) {
        $this->db->insert('anime_discussion_category', $dataArr);
        return $this->db->insert_id();
    }

    function discussion_list($main, $anime = 0, $header) {
        if ($main == "new") {
            $popular = 'animediscussion_popular = "N"';
        } else if ($main == "popular") {
            $popular = 'animediscussion_popular = "Y" ';
        } else if ($main == "fav") {
            $popular = 'bookmark = "1"';
        }else {
            $popular = 'animediscussion_popular = "Y" ';
        }

        if ($anime == 0) {
            $anim_where = ' ';
            $anim_query = ' ';
            $anime_data = ' ';
//            $orderBy = 'ORDER BY le_leimg.`leagueimage_id` desc LIMIT 0,8';
        } else {
            $anim_query = ' LEFT JOIN
            (
              SELECT an.*
              FROM anime_discussion_category AS an
              WHERE an.anime_category_id = ' . $anime . ' 
                GROUP BY an.anime_discussionid
                ORDER BY an.anime_discussionid
            ) AS anictgry ON anictgry.`anime_discussionid` = ani_dis.`anime_discussionid`';
            $anim_where = ' AND anictgry.anime_category_id = ' . $anime;
            $anime_data = 'anictgry.`anime_category_id`,';
        }

        $quy = 'SELECT  ani_dis.*,
            bb.anime_cat,bb.anime_nm,

                ' . $anime_data . '
                 
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
          ' . $anim_query .
                'WHERE  ani_dis.' . $popular . ' AND ani_dis.header_type = ' . $header . $anim_where . " ORDER BY ani_dis.anime_discussionid DESC";

//        'WHERE ' . $anim_where . ' AND  ani_dis.`animediscussion_popular` = "' . $popular . '" ';
        $query = $this->db->query($quy);
//        echo $this->db->last_query();
//        exit;
        return $query->result();
    }

    function single_image_list($anime_discussionid) {

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

    function point_anime($user_id, $discussion_id) {
        $this->db->select('*');
        $this->db->from('discussion_point');
        $this->db->where('user_id', $user_id);
        $this->db->where('anime_discussionid', $discussion_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function removelikepoint($user_id, $discussion_id) {
        $result = $this->db->where('anime_discussionid', $discussion_id)
                ->where('user_id', $user_id)
                ->where('points', "L")
                ->delete('discussion_point');
    }

    function updatelikepoint($dataArr, $point_id) {
        $this->db->where('point_id', $point_id)->update('discussion_point', $dataArr);
        return;
    }

    function add_discussionpoint($dataArr) {
        $this->db->insert('discussion_point', $dataArr);
        return $this->db->insert_id();
    }

    function removedislikepoint($user_id, $discussion_id) {
        $result = $this->db->where('anime_discussionid', $discussion_id)
                ->where('user_id', $user_id)
                ->where('points', "D")
                ->delete('discussion_point');
    }

    function getDiscussionCommentData($id) {
        $sql = 'SELECT dp.*, dp.user_id as cmnt_user_id, dp.comment_id as cmnt_comment_id,ct. * , u.user_name,u.user_region, CASE WHEN (u.user_image IS NULL OR u.user_image = "")
		 THEN "0"
		 ELSE u.user_image
        END AS user_image
                FROM `discussion_comment` AS ct
                LEFT JOIN le_users AS u ON ct.user_id = u.user_id
                LEFT JOIN discussion_comment_points AS dp ON dp.comment_id = ct.comment_id
                WHERE ct.anime_discussionid =' . $id . '
                ORDER BY `parent_id`,`comment_date` desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getDiscussionCommentLikes($comment_id) {
        $this->db->select('like');
        $this->db->from('discussion_comment_points');
        $this->db->where('like', '1');
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function getDiscussionCommentDislikes($comment_id) {
        $this->db->select('like');
        $this->db->from('discussion_comment_points');
        $this->db->where('like', '0');
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return count($query->result_array());
    }

    function add_discussion_comment($ins_comment) {
        $this->db->insert('discussion_comment', $ins_comment);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function check_discussionlike($user_id, $comment_id) {
        $this->db->select('*');
        $this->db->from('discussion_comment_points');
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return $query->result();
    }

    function add_discussionlike($data) {
        $this->db->insert('discussion_comment_points', $data);
        return TRUE;
    }

    function update_discussion_like($user_id, $comment_id, $data) {
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $this->db->update('discussion_comment_points', $data);
        return TRUE;
    }

    function delete_discussion_like($user_id, $comment_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $this->db->delete('discussion_comment_points');
        return TRUE;
    }

    function delete_disccusion_comment($league_comment, $userid) {
        $result = $this->db->where('comment_id', $league_comment)->delete('discussion_comment');
        $result = $this->db->where('parent_id', $league_comment)->delete('discussion_comment');
        $result = $this->db->where('comment_id', $league_comment)->where('user_id', $userid)->delete('discussion_comment_points');
        return;
    }

    function getAnimeSubtab($anime_id) {
        $this->db->select('*');
        $this->db->from('anime_sub_category');
        $this->db->where('anime_id', $anime_id);
        $query = $this->db->get();
        return $query->result();
    }

    function recentDiscussion($anime_id) {
        $sql = "SELECT ad.*, adc.*,le_us.*
                FROM `anime_discussion` as ad
                RIGHT JOIN
                (
                SELECT *
                FROM `anime_discussion_category`
                WHERE anime_category_id =" . $anime_id . "
                 ) as adc ON adc.anime_discussionid = ad.anime_discussionid
              JOIN 
                 (
                     SELECT *
                FROM `le_users`  
                 ) as le_us ON le_us.user_id = ad.discussion_userid
                ORDER BY ad.anime_discussionid desc
                LIMIT 0, 4";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getRecentDiscussion($limit) {
        $sql = "SELECT ad.*,le_us.* FROM `anime_discussion` as ad
                JOIN  `le_users`   as le_us ON le_us.user_id = ad.discussion_userid
                ORDER BY ad.anime_discussionid desc LIMIT 0, $limit";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function anime_favourite_fetch($user_id) {
        $this->db->select('*');
        $this->db->from('anime_favourite as af');
        $this->db->join('anime as am', 'am.anime_id= af.anime_id', 'left');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('anime_fav_id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getDisccusionCmtData_subComment($pid) {
        $sql = 'SELECT dp.*, dp.user_id as cmnt_user_id, dp.comment_id as cmnt_comment_id,ct. * , u.user_name,u.user_region, CASE WHEN (u.user_image IS NULL OR u.user_image = "")
		 THEN "0"
		 ELSE u.user_image
        END AS user_image
                FROM `discussion_comment` AS ct
                LEFT JOIN le_users AS u ON ct.user_id = u.user_id
                LEFT JOIN discussion_comment_points AS dp ON dp.comment_id = ct.comment_id
                WHERE ct.parent_id =' . $pid . '
                ORDER BY `parent_id`,`comment_date` desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getReviewCmtData_subComment($pid) {
        $sql = 'SELECT cp.*, cp.user_id as cmnt_user_id, cp.rev_commentid as cmnt_comment_id,le_ct. * , u.user_name,u.user_region,u.user_image
                FROM `review_comment` AS le_ct
                LEFT JOIN le_users AS u ON le_ct.user_id = u.user_id
                LEFT JOIN review_comment_point AS cp ON cp.rev_commentid = le_ct.rev_commentid
                WHERE le_ct.parent_id =' . $pid . '
                ORDER BY `parent_id`,`review_comment_timestamp` desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    function updateDiscussion($data, $id) {
        $this->db->where("anime_discussionid", $id);
        return $this->db->update("anime_discussion", $data);
    }

    function deleteDiscussion($id) {
        $this->db->where("anime_discussionid", $id);
        return $this->db->delete("anime_discussion");
    }

}
