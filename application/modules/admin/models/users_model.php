<?php

/**
 * Description of crud
 *
 * @author abc
 */
class Users_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function users_list_request() {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('u.user_id', 'u.user_name', 'u.user_email');

        /*
         * Paging
         */
        $sLimit = "";
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " . intval($_GET['iDisplayLength']);
        }

        /*
         * Ordering
         */
        $sOrder = "";
        if (isset($_GET['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
                if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
                    $sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . "
                       " . ($_GET['sSortDir_' . $i] === 'asc' ? 'desc' : 'asc') . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }
//
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
        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($aColumns); $i++) {
                if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
                    $sWhere .= $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                }
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        if ($sWhere == '') {
            $sWhere = " WHERE (user_status = 'A')";
        } else {
            $sWhere .= " AND (user_status = 'A')";
        }

        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = " SELECT u.*,b.ban_status,b.days,b.ban_date 
                    FROM le_users AS u
                    LEFT JOIN le_banusers AS b ON b.user_id = u.user_id
                    $sWhere  
                    $sOrder
                    $sLimit";

        $data = $this->db->query($sQuery);
        $rResult = $data->result_array();

        /* Data set length after filtering */
        $sQuery = " SELECT u.*,b.ban_status,b.days,b.ban_date 
                    FROM le_users AS u
                    LEFT JOIN le_banusers AS b ON b.user_id = u.user_id
                    $sWhere";

        $rResultFilterTotal = $this->db->query($sQuery);
        $aResultFilterTotal = $rResultFilterTotal->result_array();
        $iFilteredTotal = count($aResultFilterTotal);
        $iTotal = count($aResultFilterTotal);


        /*
         * Output
         */
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );

        $aColumns = array('serial_no', 'user_name', 'user_email', 'action');
        $j = 0;
        foreach ($rResult as $aRow) {
            $j++;
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == 'serial_no') {
                    $row[] = $j;
                } elseif ($aColumns[$i] == 'action') {
                    // button for active and inactive
//                     $row[] = "All Button";
                    $html = "<a onclick=\"ban_show(" . $aRow['user_id'] . ");\" id='ban_" . $aRow['user_id'] . "' title='Action' style='cursor: pointer;'>";
                    if ($aRow["ban_status"] == "A") {
                        $html .= "<img alt='Banned' src='" . base_url() . "assets/images/user_remove.png'>";
                    } elseif ($aRow["ban_status"] == "I") {
                        $html .= "";
                    } else {
                        $html .= "<img alt='Inactive' src='" . base_url() . "assets/images/block_user.png'>";
                    }

                    $html .= '</a> ';
                    $html .= "<div style='display:none' id='banuser_" . $aRow['user_id'] . "'>
                              <form method='post' action='" . base_url() . "ban_users'>
                                  <input type=hidden value='" . $aRow['user_id'] . "' name='banned'/>
                                  <input type='radio' name='days' value='5 Days' required ";
                    if ($aRow['days'] == "5 Days") {
                        $html .= "checked /> <b>5 Days</b><br/>";
                    } else {
                        $html .= "/> <b>5 Days</b><br/>";
                    }
                    $html .= "<input type='radio' name='days' value='10 Days' required ";
                    if ($aRow['days'] == "10 Days") {
                        $html .= "checked /> <b>10 Days</b><br/>";
                    } else {
                        $html .= "/> <b>10 Days</b><br/>";
                    }
                    $html .= "<input type='radio' name='days' value='20 Days' required ";
                    if ($aRow['days'] == "20 Days") {
                        $html .= "checked /> <b>20 Days</b><br/>";
                    } else {
                        $html .= "/> <b>20 Days</b><br/>";
                    }
                    if (isset($aRow['ban_status']) && !empty($aRow['ban_status'])) {
                        $html .= "<input type=hidden value='" . $aRow['ban_date'] . "' name='ban_date'/> 
                                  <input type='submit' class='btn btn-primary' name='Update' value='Update'>
                                    <input type='submit' class='btn btn-primary' name='Unban' value='Unban'>";
                    } else {
                        $html .= "<input type='submit' class='btn btn-danger' name='Ban' value='Ban'>
                                    <input type='reset' class='btn btn-primary' name='Reset' value='Reset'>";
                    }
                    $html .="</form>
                              </div>";

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

    function check_ban_status($uid) {

        $this->db->select('*');
        $this->db->from('le_banusers');
        $this->db->where('user_id', $uid);
        $this->db->where('ban_status = "A"');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    function update_banned($user_update, $user_id) {
        return $this->db->where('user_id', $user_id)
                        ->update('le_banusers', $user_update);
    }

    function unbanned_user($user_id) {
        return $this->db->where('user_id', $user_id)
                        ->delete('le_banusers');
    }

    function banned_user($userData) {
        $this->db->insert('le_banusers', $userData);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

}

?>