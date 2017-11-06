<?php

/**
 * Description of crud
 *
 * @author abc
 */
class Comment_model extends CI_Model {

    var $comment_tbl = "cmnts";
    var $points_tbl = "cmnt_points";
    var $module = "";

    public function __construct() {
        parent::__construct();
    }

    public function getCommentLikes($comment_id) {
        $this->db->select('like');
        $this->db->from($this->points_tbl);
        $this->db->where('like', '1');
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function getCommentDislikes($comment_id) {
        $this->db->select('like');
        $this->db->from($this->points_tbl);
        $this->db->where('like', '0');
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return count($query->result_array());
    }
    public function getCountParentComments($rId){
        return $this->db->from($this->comment_tbl)
                ->where("module",  $this->module)
                ->where("parent_id",0)
                ->where("record_id",$rId)
                ->get()->num_rows();
        
    }

    public function getLegaueCmtData($legid) {
        $sql = 'SELECT cp.*, cp.user_id as cmnt_user_id, cp.comment_id as cmnt_comment_id,le_ct. * , u.user_name,u.user_region, CASE WHEN (u.user_image IS NULL OR u.user_image = "")
		 THEN "0"
		 ELSE u.user_image
        END AS user_image
                FROM ' . $this->comment_tbl . ' AS le_ct
                LEFT JOIN le_users AS u ON le_ct.user_id = u.user_id
                LEFT JOIN ' . $this->points_tbl . ' AS cp ON cp.comment_id = le_ct.comment_id
                WHERE le_ct.record_id =' . $legid . ' AND module = "' . $this->module . '"
                ORDER BY `parent_id`,`comment_date` desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getLegaueCmtfData($legid) {

        $sql = 'SELECT cp.*, cp.user_id as cmnt_user_id, cp.comment_id as cmnt_comment_id,le_ct. * , u.user_name,u.user_region,u.user_image
                FROM ' . $this->comment_tbl . ' AS le_ct
                LEFT JOIN le_users AS u ON le_ct.user_id = u.user_id
                LEFT JOIN ' . $this->points_tbl . '  AS cp ON cp.comment_id = le_ct.comment_id
                WHERE le_ct.record_id =' . $legid . ' AND module = "' . $this->module . '"
                ORDER BY `parent_id`,`comment_date` desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    function add_comment($ins_comment) {
        $ins_comment['module'] = $this->module;
        $this->db->insert($this->comment_tbl, $ins_comment);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function delete_comment($league_comment, $userid) {
        $result = $this->db->where('comment_id', $league_comment)->delete($this->comment_tbl);
        $result = $this->db->where('parent_id', $league_comment)->delete($this->comment_tbl);
        $result = $this->db->where('comment_id', $league_comment)->where('user_id', $userid)->delete($this->points_tbl);
        return;
    }

    function check_like( $user_id, $comment_id) {
        $this->db->select('*');
        $this->db->from($this->points_tbl);
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
        return $query->result();
    }

    function like( $data) {
        $this->db->insert($this->points_tbl, $data);
        return TRUE;
    }

    function update_like( $user_id, $comment_id, $data) {
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $this->db->update($this->points_tbl, $data);
        return TRUE;
    }

    function delete_like( $user_id, $comment_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('comment_id', $comment_id);
        $this->db->delete($this->points_tbl);
        return TRUE;
    }
    public function getLegaueCmtData_subComment($pid) {
        $sql = 'SELECT cp.*, cp.user_id as cmnt_user_id, cp.comment_id as cmnt_comment_id,le_ct.*, u.user_name,u.user_region, CASE WHEN (u.user_image IS NULL OR u.user_image = "")
   THEN "0"
   ELSE u.user_image
        END AS user_image
                FROM '.$this->comment_tbl.' AS le_ct
                LEFT JOIN le_users AS u ON le_ct.user_id = u.user_id
                LEFT JOIN '.$this->points_tbl.' AS cp ON cp.comment_id = le_ct.comment_id
                WHERE le_ct.parent_id =' . $pid . '
                ORDER BY `comment_date` desc';
        $query = $this->db->query($sql);
        return $query->result();
    }
    

}
