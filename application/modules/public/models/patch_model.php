<?php

class Patch_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function list_patch_notes($main, $row, $rowperpage, $user_id) {

        if ($main == "new") {
            $popular = " ";
        } else if ($main == "popular") {
            $popular = " ";
        } else {
            $popular = 'AND favourites_status = "A"';
        }
        $sql = " SELECT  pn.*,pn.main_id as patchId, victory.*,victoryd.*,faver.*,comment.*,
               /*  victory victory.total_victory,victoryd.`total_defeat` */
                victory.vic_users,
                victoryd.def_users,
                CASE WHEN (victory.`total_victory` IS NULL OR victory.`total_victory` = '')
                         THEN '0'
                         ELSE victory.`total_victory`
                END AS total_victory,
                CASE WHEN (victoryd.`total_defeat` IS NULL OR victoryd.`total_defeat` ='')
                         THEN '0'
                         ELSE victoryd.`total_defeat`
                END AS total_defeat,        
               /* favourite faver.`favourite`, */
               CASE WHEN (faver.`favourite` IS NULL OR faver.`favourite` = '')
                         THEN '0'
                         ELSE faver.`favourite`
                END AS favourite,
                faver.fvtuserid,
                faver.fvtid,
               /*  Total Comment comment.total_comment,*/
               CASE WHEN (comment.`total_comment` IS NULL OR comment.`total_comment` = '')
                         THEN '0'
                         ELSE comment.`total_comment`
                END AS total_comment 
             FROM `newPatch_id`  as pn  LEFT JOIN
                      
         (
            SELECT count(vic.victory_id) AS total_victory,
                   GROUP_CONCAT(vic.user_id) AS vic_users,
                   vic.*
            FROM newPatch_victory as vic 
            WHERE vic.victory_defeat = 'V'
            GROUP BY vic.patch_id
            ORDER BY vic.patch_id
         ) AS victory ON victory.patch_id =  pn.main_id
         LEFT JOIN
         (
            SELECT count(vicd.victory_id) AS total_defeat,
                   GROUP_CONCAT(vicd.user_id) AS def_users,
                   vicd.*
            FROM newPatch_victory as vicd 
            WHERE vicd.victory_defeat = 'D'
            GROUP BY vicd.patch_id
            ORDER BY vicd.patch_id
         ) AS victoryd ON victoryd.patch_id =  pn.main_id
         LEFT JOIN
         (
            SELECT count(fvt.patch_id) AS favourite,
                   GROUP_CONCAT(fvt.favourites_id) AS fvtid,
                   GROUP_CONCAT(fvt.user_id) AS fvtuserid,
                   fvt.*
            FROM newPatch_favourites as fvt 
            WHERE fvt.favourites_status = 'A' AND fvt.user_id= '" . $user_id . "'
            GROUP BY fvt.patch_id
            ORDER BY fvt.patch_id
         ) AS faver ON faver.`patch_id` =  pn.main_id
          LEFT JOIN
         (
            SELECT count(cmt.comment) AS total_comment,
                   cmt.*
            FROM  newPatch_comments as cmt
            WHERE cmt.`parent_id` = 0 
            GROUP BY cmt.patch_id
            ORDER BY cmt.patch_id
         ) AS comment ON comment.`patch_id` = pn.`main_id` WHERE pn.`is_active` = '1'  " . $popular . "  ORDER BY pn.`main_id` desc LIMIT " . $row . "," . $rowperpage;


        $query = $this->db->query($sql);

        $data = $query->result_array();
        $newArry = array();
        for ($i = 0; $i < count($data); $i++) {
            $newdata = $data[$i];

            $mPid = $newdata['main_id'];

            $q = "select nps.*, pii.* from newPatch_section as nps "
                    . "left join (SELECT patch_secId, GROUP_CONCAT(pi.filename) AS file "
                    . "FROM newPatch_image as pi GROUP BY pi.patch_secId ORDER BY pi.patch_secId ) "
                    . "AS pii ON pii.`patch_secId` = nps.`sect_id` where nps.patch_id = $mPid ";

            $re = $this->db->query($q);
            $fre = $re->result();

            $newArry[$i]['patch'] = $newdata;
            $newArry[$i]['section'] = $fre;
        }

        return $newArry;
    }

    function single_patch_note($patch_id) {
        $sql = " SELECT  pn.*,pn.main_id as patchId, victory.*,victoryd.*,comment.*,
               /*  victory victory.total_victory,victoryd.`total_defeat` */
                victory.vic_users,
                victoryd.def_users,
                CASE WHEN (victory.`total_victory` IS NULL OR victory.`total_victory` = '')
                         THEN '0'
                         ELSE victory.`total_victory`
                END AS total_victory,
                CASE WHEN (victoryd.`total_defeat` IS NULL OR victoryd.`total_defeat` ='')
                         THEN '0'
                         ELSE victoryd.`total_defeat`
                END AS total_defeat,        
                
               /*  Total Comment comment.total_comment,*/
               CASE WHEN (comment.`total_comment` IS NULL OR comment.`total_comment` = '')
                         THEN '0'
                         ELSE comment.`total_comment`
                END AS total_comment 
             FROM `newPatch_id`  as pn  LEFT JOIN
        
         (
            SELECT count(vic.victory_id) AS total_victory,
                   GROUP_CONCAT(vic.user_id) AS vic_users,
                   vic.*
            FROM newPatch_victory as vic 
            WHERE vic.victory_defeat = 'V'
            GROUP BY vic.patch_id
            ORDER BY vic.patch_id
         ) AS victory ON victory.patch_id =  pn.main_id
         LEFT JOIN
         (
            SELECT count(vicd.victory_id) AS total_defeat,
                   GROUP_CONCAT(vicd.user_id) AS def_users,
                   vicd.*
            FROM newPatch_victory as vicd 
            WHERE vicd.victory_defeat = 'D'
            GROUP BY vicd.patch_id
            ORDER BY vicd.patch_id
         ) AS victoryd ON victoryd.patch_id =  pn.main_id
          
          LEFT JOIN
         (
            SELECT count(cmt.comment) AS total_comment,
                   cmt.*
            FROM  newPatch_comments as cmt
            WHERE cmt.`parent_id` = 0 
            GROUP BY cmt.patch_id
            ORDER BY cmt.patch_id
         ) AS comment ON comment.`patch_id` = pn.`main_id` WHERE pn.`is_active` = '1' AND pn.main_id = " . $patch_id;


        $query = $this->db->query($sql);
        $data['patch'] = $query->result();

        $q = "select nps.*, pii.* from newPatch_section as nps "
                . "left join (SELECT patch_secId, GROUP_CONCAT(pi.filename) AS file "
                . "FROM newPatch_image as pi GROUP BY pi.patch_secId ORDER BY pi.patch_secId ) "
                . "AS pii ON pii.`patch_secId` = nps.`sect_id` where nps.patch_id = $patch_id ";

        $re = $this->db->query($q);
        $fre = $re->result();

        $data['section'] = $fre;

        return $data;
    }

    function get_total_row($main, $user_id) {
        if ($main == "new") {
            $popular = "";
        } else if ($main == "popular") {
            $popular = " ";
        } else {
            $popular = 'AND favourites_status = "A"';
        }
        $sql = 'SELECT  count(*) as count   
                
        FROM newPatch_id AS pn 
        LEFT JOIN
         (
            SELECT count(fvt.patch_id) AS favourite,
                   GROUP_CONCAT(fvt.favourites_id) AS fvtid,
                   GROUP_CONCAT(fvt.user_id) AS fvtuserid,
                   fvt.*
            FROM  newPatch_favourites as fvt 
            WHERE fvt.favourites_status = "A" AND fvt.user_id = ' . $user_id . '
            GROUP BY fvt.patch_id
            ORDER BY fvt.patch_id
         ) AS faver ON faver.`patch_id` = pn.`main_id`
         
          WHERE pn.`is_active` = "1"  ' . $popular;

        $query = $this->db->query($sql);
        return $query->row();
    }

    function victory_defeat($user_id, $patch_id) {
        $this->db->select('*');
        $this->db->from('newPatch_victory');
        $this->db->where('user_id', $user_id);
        $this->db->where('patch_id', $patch_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function add_victory_defeat($dataArr) {
        $this->db->insert('newPatch_victory', $dataArr);
        return $this->db->insert_id();
    }

    function updatevictory($dataArr, $victory_id) {
        $this->db->where('victory_id', $victory_id)->update('newPatch_victory', $dataArr);
        return;
    }

    function sel_favourites($user_id, $patch_id) {
        $this->db->select('*');
        $this->db->from('newPatch_favourites');
        $this->db->where('user_id', $user_id);
        $this->db->where('patch_id', $patch_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function add_favourites($dataArr) {
        $this->db->insert('newPatch_favourites', $dataArr);
        return $this->db->insert_id();
    }

    function removefavourites($user_id, $favourites_id) {
        $result = $this->db->where('favourites_id', $favourites_id)
                ->where('user_id', $user_id)
                ->where('favourites_status', "A")
                ->delete('newPatch_favourites');
    }

    function removevictory($user_id, $patch_id) {
        $result = $this->db->where('patch_id', $patch_id)
                ->where('user_id', $user_id)
                ->where('victory_defeat', "V")
                ->delete('newPatch_victory');
    }

    function removedefact($user_id, $patch_id) {
        $result = $this->db->where('patch_id', $patch_id)
                ->where('user_id', $user_id)
                ->where('victory_defeat', "D")
                ->delete('newPatch_victory');
    }

    public function getPatchCmtData_subComment($pid) {
        $sql = 'SELECT cp.*, cp.user_id as cmnt_user_id, cp.comment_id as cmnt_comment_id,pt_ct.*, u.user_name,u.user_region, CASE WHEN (u.user_image IS NULL OR u.user_image = "")
   THEN "0"
   ELSE u.user_image
        END AS user_image
                FROM `newPatch_comments` AS pt_ct
                LEFT JOIN le_users AS u ON pt_ct.user_id = u.user_id
                LEFT JOIN newPatch_comment_points AS cp ON cp.comment_id = pt_ct.comment_id
                WHERE pt_ct.parent_id =' . $pid . '
                ORDER BY `comment_date` desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getPatchCmtData($patchid) {
        $sql = 'SELECT cp.*, cp.user_id as cmnt_user_id, cp.comment_id as cmnt_comment_id,pt_ct. * , u.user_name,u.user_region, CASE WHEN (u.user_image IS NULL OR u.user_image = "")
		 THEN "0"
		 ELSE u.user_image
        END AS user_image
                FROM `newPatch_comments` AS pt_ct
                LEFT JOIN le_users AS u ON pt_ct.user_id = u.user_id
                LEFT JOIN newPatch_comment_points AS cp ON cp.comment_id = pt_ct.comment_id
                WHERE pt_ct.patch_id =' . $patchid . '
                ORDER BY `parent_id`,`comment_date` desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getPatchCmtfData($patchid) {

        $sql = 'SELECT cp.*, cp.user_id as cmnt_user_id, cp.comment_id as cmnt_comment_id,pt_ct. * , u.user_name,u.user_region,u.user_image
                FROM `newPatch_comments` AS pt_ct
                LEFT JOIN le_users AS u ON pt_ct.user_id = u.user_id
                LEFT JOIN newPatch_comment_points AS cp ON cp.comment_id = pt_ct.comment_id
                WHERE pt_ct.patch_id =' . $patchid . '
                ORDER BY `parent_id`,`comment_date` desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getCommentLikes($comment_id) {
        $this->db->select('like');
        $this->db->from('newPatch_comment_points');
        $this->db->where('like', '1');
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function getCommentDislikes($comment_id) {
        $this->db->select('like');
        $this->db->from('newPatch_comment_points');
        $this->db->where('like', '0');
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return count($query->result_array());
    }

    function check_like($user_id, $comment_id) {
        $this->db->select('*');
        $this->db->from('newPatch_comment_points');
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return $query->result();
    }

    function like($data) {
        $this->db->insert('patch_comment_points', $data);
        return TRUE;
    }

    function update_like($user_id, $comment_id, $data) {
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $this->db->update('newPatch_comment_points', $data);
        return TRUE;
    }

    function delete_like($user_id, $comment_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $this->db->delete('newPatch_comment_points');
        return TRUE;
    }

    function add_comment($ins_comment) {
        $this->db->insert('newPatch_comments', $ins_comment);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function delete_comment($league_comment, $userid) {
        $result = $this->db->where('comment_id', $league_comment)->delete('newPatch_comments');
        $result = $this->db->where('parent_id', $league_comment)->delete('newPatch_comments');
        $result = $this->db->where('comment_id', $league_comment)->where('user_id', $userid)->delete('newPatch_comment_points');
        return;
    }
function test_single($id){
        $this->db->select('*');
        $this->db->from('patchEditor'); 
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
}
