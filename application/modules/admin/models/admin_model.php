<?php

/**
 * Description of crud
 *
 * @author abc
 */
class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * ADMIN LOGIN PAGE EXECUTED
     * @param type $username
     * @param type $password
     * @return boolean
     */
    function login($username, $password) {
        $this->db->select('*');
        $this->db->from('admin_user');
        $this->db->where('username = ' . "'" . $username . "'");
        $this->db->where('password = ' . "'" . MD5($password) . "'");
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function admin_list_request() {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('admin_id', 'web_title', 'admin_email', 'username');

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

//        if ($sWhere == '') {
//            $sWhere = " WHERE (active = '' OR p.status = '0' OR p.status = '1')";
//        } else {
//            $sWhere .= " AND (p.status = '5' OR p.status = '0' OR p.status = '1')";
//        }

        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = " SELECT * FROM admin_user
                    $sWhere  
                    $sOrder
                    $sLimit";

        $data = $this->db->query($sQuery);
        $rResult = $data->result_array();

        /* Data set length after filtering */
        $sQuery = " SELECT * FROM admin_user
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
        $aColumns = array('serial_no', 'web_title', 'admin_email', 'username', 'action');
        $j = 0;
        foreach ($rResult as $aRow) {
            $j++;
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == 'serial_no') {
                    $row[] = $j;
                } elseif ($aColumns[$i] == 'action') {
                    // button for active and inactive

                    $html = "<a onclick=\"active_admin(" . $aRow['admin_id'] . ",'" . $aRow['is_active'] . "');\" id='active' title='Active' style='cursor: pointer;'>";
                    if ($aRow["is_active"] == "1") {
                        $html .= "<img alt='Active' src='" . base_url() . "assets/images/active.png'>";
                    } else {
                        $html .= "<img alt='Inactive' src='" . base_url() . "assets/images/inactive.png'>";
                    }
                    $html .= '</a> ';
                    // button for Edit
                    $html .= "<a href='" . base_url() . "edit_admin/" . $aRow["admin_id"] . "'><img title='Edit' alt='Edit' src='" . base_url() . "assets/images/edit1.png'></a>";
                    // button for delete
                    $html .= "<a onclick=\"delete_admin(" . $aRow['admin_id'] . ");\" style='cursor: pointer;'><img title='Delete' alt='Delete' src='" . base_url() . "assets/images/btn-close.png'></a>";

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

    function getUsers() {
        $this->db->select('*, lu.user_id as user_id');
        $this->db->from('le_users as lu');
        $this->db->join('le_banusers as lb', 'lu.user_id = lb.user_id', 'left');
        $this->db->where('lu.user_status', 'A');
        $this->db->order_by('lu.user_id', 'desc');
        $this->db->group_by('lu.user_id');
        $query = $this->db->get();
        return $query->result();
    }

    function getAllLeagueImages() {
        $query = $this->db->select('*')
                ->from('le_leagueimages')
                ->get();
        return $query->result();
    }

    function count_new_user() {
        $this->db->select('*');
        $this->db->from('le_users');
        $this->db->where('user_status', 'A');
        $this->db->where('is_new', '1');
        $this->db->order_by("user_timestamp", "desc");
        $query = $this->db->get();
        return $query->num_rows();
    }

    function update_admin_status($admin_id, $data) {
        $this->db->where('admin_id', $admin_id);
        $this->db->update('admin_user', $data);
        return TRUE;
    }

    function delete_admin($admin_id) {
        $this->db->where('admin_id', $admin_id);
        $this->db->delete('admin_user');
        return TRUE;
    }

    function getAdminById($admin_id) {
        $this->db->select('*');
        $this->db->from('admin_user');
        $this->db->where('admin_id', $admin_id);
        $query = $this->db->get();
        return $query->result();
    }

    function update_admin($admin_id, $data) {
        $this->db->where('admin_id', $admin_id);
        $this->db->update('admin_user', $data);
        return TRUE;
    }

    function add_admin_data($data) {
        $this->db->insert('admin_user', $data);
        return TRUE;
    }
    
    function selectCategory() {
        $query = $this->db->select('*')
                ->from('le_category')
                ->where('category_status', 'A')
                ->get();
        return $query->result();
    }
    
    function selectByUsername($username) {
        $query = $this->db->select('*')
                ->from('admin_user')
                ->where('username', $username)
                ->get();
        return $query->row();
    }

}

?>
