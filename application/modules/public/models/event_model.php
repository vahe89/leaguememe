<?php
class Event_model extends CI_Model {

    var $table = "events";
    var $tbl_event_join = "event_join";
    public function __construct() {
        parent::__construct();
    }
    /**
     * Save data
     * @param type $data field array with value
     * @return type
     */
    public function save($data){
        $this->db->insert($this->table,$data);
        $insertId = $this->db->insert_id();
        if($insertId > 0)
            $this->joinEvent ($insertId, $data['user_id'], 0);
        return $insertId;
    }
    public function updateEventJoin($ei,$ui,$data){
        return $this->db->where("event_id",$ei)
                ->where("user_id",$ui)
                ->update($this->tbl_event_join,$data);
    }
    /**
     * Check user joined event
     * @param type $ei
     * @param type $ui
     * @return type
     */
    public function isJoined($ei,$ui){
        $res = $this->db->from("event_join")->where("event_id",$ei)->where("user_id",$ui)->get()->num_rows();
        return ($res === 1);
    }
    /**
     * Join User in Event 
     * @param type $ei Event id
     * @param type $ui User Id
     * @param type $ia Is this user event admin
     */
    public function joinEvent($ei,$ui,$ia){
        $data = array(
            "user_id" => $ui,
            "event_id" => $ei,
            "is_admin" => $ia,
            "created" => time()
        );
        $this->db->insert($this->tbl_event_join,$data);
        return $this->db->insert_id();
    }
    /*public function getEvents($includePrivate = false){
        $this->db->from($this->table." as e")
                ->join("le_users as u","u.user_id = e.user_id");
        if($includePrivate !== true){
            $this->db->where("private",0);
        }
        
        $qry = $this->db->get();
        return $qry->result();
    }*/
    /*
     * Get all event with count number of joined members
     * @param boolean $includePrivate if you want to get also private events
     */
    public function getEventWithMembersCount($includePrivate){
        $where = "WHERE e.end_date > ".time();
        if($includePrivate == false){
            $where = " AND e.private = 0";
        }
        return $this->db->query("SELECT *,GROUP_CONCAT(j.user_id) as users FROM $this->table as e 
                                JOIN $this->tbl_event_join as j ON j.event_id = e.id
                                $where
                                GROUP BY e.id 
                                ")->result();
        
    }
    public function getAllEventWithMembersCount($includePrivate, $limit, $start) {
        $where = "WHERE e.end_date > " . time();
        if ($includePrivate == false) {
            $where = " AND e.private = 0";
        }

        return $this->db->query("SELECT *,GROUP_CONCAT(j.user_id) as users FROM $this->table as e 
                                JOIN $this->tbl_event_join as j ON j.event_id = e.id
                                $where
                                GROUP BY e.id LIMIT " . $start . "," . $limit . "
                                ")->result();
    }
    
    /**
     * Get list of users that have joined event 
     * @param type $id
     * @return type
     */
    public function getEventUsers($id){
        
        return $this->db->from($this->tbl_event_join)
                ->join("le_users as u","u.user_id = $this->tbl_event_join.user_id")
                ->where("event_id",$id)
                ->get()->result();
        
    }
    /**
     * Retrive event information
     * @param type $id
     * @return type
     */
    public function getEventInfo($id){
        return $this->db->from($this->table)
                ->join("le_users as u","u.user_id = $this->table.user_id",'left')
                ->where($this->table.".id",$id)
                ->get()->row();
//        echo $this->db->last_query(); die;
    }
    /**
     * Is winner claimed ?
     * @param type $eventId
     */
    public function winnerClainmed($eventId){
        $res = $this->db->from( $this->tbl_event_join)
                ->where("event_id",$eventId)
                ->where("is_winner",1)
                ->get()
                ->num_rows();
        return ($res === 1);
    }
    
    public function isEventAdmin($eventId,$userId){
        $res = $this->db->from( $this->tbl_event_join)
                ->where("event_id",$eventId)
                ->where("user_id",$userId)
                ->where("is_admin",1)
                ->get()
                ->num_rows();
        return ($res === 1);
    }
}