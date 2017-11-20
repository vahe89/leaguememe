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

    function sel_favourites($user_id, $league_image_id) {
        $this->db->select('*');
        $this->db->from('dis_favourites');
        $this->db->where('user_id', $user_id);
        $this->db->where('anime_discussionid', $league_image_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function add_favourites($dataArr) {
        $this->db->insert('dis_favourites', $dataArr);
        return $this->db->insert_id();
    }

    function removefavourites($user_id, $favourites_id) {
        $result = $this->db->where('favourites_id', $favourites_id)
                ->where('user_id', $user_id)
                ->where('favourites_status', "A")
                ->delete('dis_favourites');
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
