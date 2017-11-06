<?php

/**
 * Description of crud
 *
 * @author abc
 */
class Event_model extends CI_Model {

    var $table = "events";
    var $tbl_event_join = "event_join";

    public function __construct() {
        parent::__construct();
    }

    public function save($data) {
        $this->db->insert($this->table, $data);
        $insertId = $this->db->insert_id();
        if ($insertId > 0)
            $this->joinEvent($insertId, $data['user_id'], 1);
        return $insertId;
    }

    public function joinEvent($ei, $ui, $ia) {
        $data = array(
            "user_id" => $ui,
            "event_id" => $ei,
            "is_admin" => $ia,
            "created" => time()
        );
        $this->db->insert($this->tbl_event_join, $data);
        return $this->db->insert_id();
    }

    public function update($data, $id) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return TRUE;
    }

    function event_list_request() {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('id', 'title', 'descr', 'image', 'private', 'user_id', 'join', 'end_date');

        /*
         * Paging
         */
        $sLimit = "";
        if (isset($_POST['iDisplayStart']) && $_POST['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . intval($_POST['iDisplayStart']) . ", " . intval($_POST['iDisplayLength']);
        }

        /*
         * Ordering
         */
        $sOrder = "";
        if (isset($_POST['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_POST['iSortingCols']); $i++) {
                if ($_POST['bSortable_' . intval($_POST['iSortCol_' . $i])] == "true") {
                    $sOrder .= $aColumns[intval($_POST['iSortCol_' . $i])] . "
                       " . ($_POST['sSortDir_' . $i] === 'asc' ? 'desc' : 'asc') . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }

//        if ($sOrder == '') {
//            $sOrder = "ORDER BY article_id desc ";
//        }

        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $sWhere = "";
        if (isset($_POST['sSearch']) && $_POST['sSearch'] != "") {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == "join") {
                    $sWhere .= " ";
//                } else if ($aColumns[$i] == "credit") {
//                    $sWhere .= "cd.credit LIKE '%" . mysql_real_escape_string($_POST['sSearch']) . "%' OR ";
                } else if (isset($_POST['bSearchable_' . $i]) && $_POST['bSearchable_' . $i] == "true") {
                    $sWhere .= "e." . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_POST['sSearch']) . "%' OR ";
                } else if (isset($_POST['bSearchable_' . $i]) && $_POST['bSearchable_' . $i] == "true") {
                    $sWhere .= "u." . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_POST['sSearch']) . "%' OR ";
                }
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = " SELECT  e.*,ej.user_id as join_user,count(ej.id) as total, u.user_name,u.name 
                    FROM $this->table AS e
                    LEFT JOIN $this->tbl_event_join AS ej ON ej.event_id = e.id 
                    LEFT JOIN le_users AS u ON u.user_id = e.user_id 
                   
                    $sWhere  
                         GROUP BY id
                    $sOrder
                    $sLimit";
        $data = $this->db->query($sQuery);
        $rResult = $data->result_array();

        /* Data set length after filtering */
        $sQuery = "  SELECT  e.*,ej.user_id as join_user,count(ej.id) as total, u.user_name,u.name 
                    FROM $this->table AS e
                    LEFT JOIN $this->tbl_event_join AS ej ON ej.event_id = e.id 
                    LEFT JOIN le_users AS u ON u.user_id = e.user_id 
                 
                    $sWhere    GROUP BY id";

        $rResultFilterTotal = $this->db->query($sQuery);
        $aResultFilterTotal = $rResultFilterTotal->result_array();
        $iFilteredTotal = count($aResultFilterTotal);
        $iTotal = count($aResultFilterTotal);


        /*
         * Output
         */
        $output = array(
            "sEcho" => intval($_POST['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );
        array_push($aColumns, 'action');
        foreach ($rResult as $aRow) {
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == 'id') {
                    $row[] = $aRow['id'];
                } else if ($aColumns[$i] == 'title') {
                    $row[] = $aRow['title'];
                } else if ($aColumns[$i] == 'descr') {
                    $row[] = $aRow['descr'];
                } else if ($aColumns[$i] == 'join') {
                    $row[] = $aRow['total'];
                } else if ($aColumns[$i] == 'user_id') {
                    if ($aRow['user_id'] == "0") {
                        $name = "Admin";
                    } elseif (!empty($aRow['name'])) {
                        $name = $aRow['name'];
                    } else {
                        $name = $aRow['user_name'];
                    }
                    $row[] = $name;
                } else if ($aColumns[$i] == 'end_date') {
                    $end_day = date("F j, Y, g:i a", $aRow['end_date']);
                    $row[] = $end_day;
                } else if ($aColumns[$i] == 'image') {
                    $row[] = "<img title='" . $aRow['image'] . "' alt='" . $aRow['image'] . "' width='100px' height='80px' src='" . base_url() . "uploads/event/" . $aRow['image'] . "'>";
                } else if ($aColumns[$i] == 'private') {
                    if ($aRow['private'] == 0) {
                        $private = "NO";
                    } else {
                        $private = "YES(" . $aRow['password'] . ")";
                    }
                    $row[] = $private;
                } elseif ($aColumns[$i] == 'action') {

                    // button for Edit
                    $html = " <a href='" . base_url() . "edit_event/" . $aRow["id"] . "' title='Edit event' style='padding:5px'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>";
                    // button for delete
                    $html .= "<a onclick=\"delete_event(" . $aRow['id'] . ");\"  title='Delete event' style='padding:5px'><i class='fa fa-trash-o' aria-hidden='true'></i></a>";
                    // button for select wiinner
                    $html .= " <a href=\"javascript:openModal('" . base_url() . "select_winner/" . $aRow["id"] . "','" . $aRow["title"] . "');\"   title='Select winner' ><i class='fa fa-trophy' aria-hidden='true'></i></a>";
                    $row[] = $html;
                } else {
                    $row[] = $aRow[$aColumns[$i]];
                }
            }
            $output['aaData'][] = $row;
        }

        echo json_encode($output);
        exit;
    }

    function delete_event($event_id) {



        $result = $this->db->where('id', $event_id)->delete($this->table);
        $result1 = $this->db->where('event_id', $event_id)->delete($this->tbl_event_join);


        return;
    }

    function getEventDetail($event_id) {
        $sql = "SELECT  e.*,ej.user_id as join_user,count(ej.id) as total, u.user_name,u.name 
                    FROM $this->table AS e
                    LEFT JOIN $this->tbl_event_join AS ej ON ej.event_id = e.id 
                    LEFT JOIN le_users AS u ON u.user_id = e.user_id WHERE e.id = $event_id ";
        $data = $this->db->query($sql);
        $rResult = $data->row();
        return $rResult;
    }

    function getJoinUser($event_id) {
        $sql = "SELECT ej.* , u.user_name,u.name,u.user_image 
                    FROM   $this->tbl_event_join  AS ej 
                    LEFT JOIN le_users AS u ON u.user_id = ej.user_id WHERE ej.event_id = $event_id ";
        $data = $this->db->query($sql);
        $rResult = $data->result_array();
        return $rResult;
    }

    public function getEventUsers($id) {

        return $this->db->from($this->tbl_event_join)
                        ->join("le_users as u", "u.user_id = $this->tbl_event_join.user_id")
                        ->where("event_id", $id)
                        ->get()->result();
    }

    public function winnerClainmed($eventId) {
        $res = $this->db->from($this->tbl_event_join)
                ->where("event_id", $eventId)
                ->where("is_winner", 1)
                ->get()
                ->num_rows();
        return ($res === 1);
    }

    public function updateEventJoin($ei, $ui, $data) {

        return $this->db->where("event_id", $ei)
                        ->where("user_id", $ui)
                        ->update($this->tbl_event_join, $data);
    }

}

?>