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

    function league_list_request() {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('leagueimage_id', 'leagueimage_name', 'category_name', 'credit');

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
                if ($aColumns[$i] == "category_name") {
                    $sWhere .= "ct.category_name LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if ($aColumns[$i] == "credit") {
                    $sWhere .= "cd.credit LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
                    $sWhere .= "l." . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                }
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = " SELECT l.*,ct.category_name,cd.credit,cd.credit_id,cd.credit_status 
                    FROM le_leagueimages AS l
                    LEFT JOIN le_category AS ct ON ct.category_id = l.category_id 
                    LEFT JOIN le_credits AS cd ON cd.leagueimage_id = l.leagueimage_id 
                    $sWhere  
                    $sOrder
                    $sLimit";

        $data = $this->db->query($sQuery);
        $rResult = $data->result_array();

        /* Data set length after filtering */
        $sQuery = " SELECT l.*,ct.category_name,cd.credit,cd.credit_id,cd.credit_status 
                    FROM le_leagueimages AS l
                    LEFT JOIN le_category AS ct ON ct.category_id = l.category_id 
                    LEFT JOIN le_credits AS cd ON cd.leagueimage_id = l.leagueimage_id
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
        $aColumns = array('leagueimage_id', 'leagueimage_name', 'category_name', 'credit', 'league', 'action');
        foreach ($rResult as $aRow) {
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == 'league') {
                    $row[] = "<img title='" . $aRow['leagueimage_name'] . "' alt='" . $aRow['leagueimage_filename'] . "' width='100px' height='80px' src='" . base_url() . "uploads/league/" . $aRow['leagueimage_filename'] . "'>";
                } elseif ($aColumns[$i] == 'credit') {
                    $creditStatus = $aRow["credit"] . "<br/>" . "<a onclick=\"credit_status(" . $aRow['credit_id'] . ",'" . $aRow['credit_status'] . "');\" id='active' style='cursor: pointer;'>";
                    if ($aRow["credit_status"] == "A") {
                        $creditStatus .= "<img title='Inactive' alt='Active' src='" . base_url() . "assets/images/active.png'>";
                    } else {
                        $creditStatus .= "<img alt='InActive' src='" . base_url() . "assets/images/inactive.png'  title='Active'>";
                    }
                    $creditStatus .= '</a> ';
                    $row[] = $creditStatus;
                } elseif ($aColumns[$i] == 'action') {
                    // button for active and inactive

                    $html = "<a onclick=\"active_league(" . $aRow['leagueimage_id'] . ",'" . $aRow['leagueimage_status'] . "');\" id='active' style='cursor: pointer;'>";
                    if ($aRow["leagueimage_status"] == "A") {
                        $html .= "<img title='Inactive' alt='Active' src='" . base_url() . "assets/images/active.png'>";
                    } else {
                        $html .= "<img alt='InActive' src='" . base_url() . "assets/images/inactive.png'  title='Active'>";
                    }
                    $html .= '</a> ';
                    // button for popular
                    $html .= "<a onclick=\"popular_league(" . $aRow['leagueimage_id'] . ",'" . $aRow['leagueimage_setpopular'] . "')\" style='cursor: pointer;'>";
                    if ($aRow["leagueimage_setpopular"] == "N") {
                        $html .= "<img title='Set as popular' alt='NotPopular' src='" . base_url() . "assets/images/popular1.png'>";
                    } else {
                        $html .= "<img alt='Popular' src='" . base_url() . "assets/images/popular.png'  title='Remove-Popularity'>";
                    }
                    $html .= "</a>";

                    // button for sidebar
                    $html .= " <a onclick=\"sidebar_status(" . $aRow['leagueimage_id'] . ",'" . $aRow['is_sidebar'] . "')\" style='cursor: pointer;'>";

                    if ($aRow["is_sidebar"] == "0") {
                        $html .= "<img title='set as Sidebar' alt='sidebar' src='" . base_url() . "assets/images/power_off.png'>";
                    } else {
                        $html .= "<img title='Remove as Sidebar' alt='sidebar' src='" . base_url() . "assets/images/power_on.png'>";
                    }
                    $html .= "</a>";

                    // button for Edit
                    $html .= " <a href='" . base_url() . "edit_league/" . $aRow["leagueimage_id"] . "'><img title='Edit' alt='Edit' src='" . base_url() . "assets/images/edit1.png'></a>";
                    // button for delete
                    $html .= "<a onclick=\"delete_league_img(" . $aRow['leagueimage_id'] . ");\" style='cursor: pointer;'><img title='Delete' alt='Delete' src='" . base_url() . "assets/images/btn-close.png'></a>";

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

    function updateLeagueStatus($dataArr, $league_img_id) {
        $this->db->where('leagueimage_id', $league_img_id)->update('le_leagueimages', $dataArr);
        $this->db->where('parent_id', $league_img_id)->update('le_leagueimages', $dataArr);
        return;
    }

    function select_league_images($league_img_id) {
        $this->db->select('*');
        $this->db->from('le_leagueimages');
        $this->db->where('leagueimage_id', $league_img_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function getLeagueImageById($league_img_id) {
        $query = $this->db->select('*')
                ->from('le_leagueimages')
                ->join('le_category', 'le_category.category_id=le_leagueimages.category_id')
                ->where('leagueimage_id', $league_img_id)
                ->get();
        return $query->row_array();
    }

    function delete_league($league_img_id) {
        $qry = $this->db->where('leagueimage_id', $league_img_id)->get('le_leagueimages');
        $result = $qry->row();

        $qry1 = $this->db->where('parent_id', $league_img_id)->get('le_leagueimages');
        $result1 = $qry->row();
        //unlink(base_url().'uploads/league/' . $result->leagueimage_filename);
        // unlink('uploads/league/mp4/' . $result->videoname);


        $result = $this->db->where('leagueimage_id', $league_img_id)->delete('le_leagueimages');
        $result1 = $this->db->where('parent_id', $league_img_id)->delete('le_leagueimages');
        $result2 = $this->db->where('leagueimage_id', $league_img_id)->delete('le_credits');
        $result3 = $this->db->where('leagueimage_id', $league_img_id)->delete('le_tags');

        return;
    }

    function updateImagePopulartatus($dataArr, $league_img_id) {
        $this->db->where('leagueimage_id', $league_img_id)->update('le_leagueimages', $dataArr);
        $this->db->where('parent_id', $league_img_id)->update('le_leagueimages', $dataArr);

        return;
    }

    function updateCreditStatus($dataArr, $credit_img_id) {
        $this->db->where('credit_id', $credit_img_id)->update('le_credits', $dataArr);
        return;
    }

    function updateImageSidebarStatus($dataArr, $league_img_id) {
        $this->db->where('leagueimage_id', $league_img_id)->update('le_leagueimages', $dataArr);
        return;
    }

    function getCreditByLeagueimage($league_img_id) {
        $query = $this->db->select('*')
                ->from('le_credits')
                ->where('leagueimage_id', $league_img_id)
                ->get();
        return $query->row_array();
    }

    function getTagByLeagueimage($league_img_id) {
        $query = $this->db->select('*')
                ->from('le_tags')
                ->where('leagueimage_id', $league_img_id)
                ->get();
        return $query->result_array();
    }

    function getCategoryId($data) {
        $this->db->select('*');
        $this->db->from('le_category');
        $this->db->where('category_name', $data);
        $this->db->or_where('category_name', "Video");
        $query = $this->db->get();
        $data = $query->result();
        if ($data) {
            return $data[0]->category_id;
            //return $data;
        } else {
            return 0;
        }
    }

    function deleteLeagueImgtags($league_img_id) {
        $result = $this->db->where('leagueimage_id', $league_img_id)->delete('le_tags');
    }

    function add_league_imgtags($dataArr) {
        $this->db->insert('le_tags', $dataArr);
        return $this->db->insert_id();
    }

    function deleteLeagueImgcredits($league_img_id) {
        $result = $this->db->where('leagueimage_id', $league_img_id)->delete('le_credits');
    }

    function add_league_credits($dataArr) {
        $this->db->insert('le_credits', $dataArr);
        return $this->db->insert_id();
    }

    function updateLeagueImg($dataArr, $league_img_id) {
        $this->db->where('leagueimage_id', $league_img_id)->update('le_leagueimages', $dataArr);
        return;
    }

    function sidebar_list_request() {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('leagueimage_id', 'leagueimage_filename', 'leagueimage_name');

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
                if ($i == 1) {
                    
                } else if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
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

        if ($sWhere == '') {
            $sWhere = " WHERE (is_sidebar = '1' AND leagueimage_status = 'A')";
        } else {
            $sWhere .= " AND (is_sidebar = '1' AND leagueimage_status = 'A')";
        }

        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = " SELECT *
                    FROM le_leagueimages
                    $sWhere  
                    $sOrder
                    $sLimit";

        $data = $this->db->query($sQuery);
        $rResult = $data->result_array();

        /* Data set length after filtering */
        $sQuery = " SELECT *
                    FROM le_leagueimages
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
        $aColumns = array('leagueimage_id', 'leagueimage', 'leagueimage_name', 'action');
        foreach ($rResult as $aRow) {
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == 'leagueimage') {
                    $row[] = "<img title='" . $aRow['leagueimage_name'] . "' alt='" . $aRow['leagueimage_filename'] . "' width='100px' height='80px' src='" . base_url() . "uploads/league/" . $aRow['leagueimage_filename'] . "'>";
                } elseif ($aColumns[$i] == 'action') {
                    // button for delete
                    $row[] = "<a onclick=\"remove_sidebar_img(" . $aRow['leagueimage_id'] . ");\" style='cursor: pointer;'><img title='Remove from Sidebar' alt='Remove' src='" . base_url() . "assets/images/btn-close.png'></a>";
                } else {
                    $row[] = $aRow[$aColumns[$i]];
                }
            }
            $output['aaData'][] = $row;
        }

        echo json_encode($output);
        exit;
    }

    function removeSideBar($dataArr, $league_img_id) {
        $this->db->where('leagueimage_id', $league_img_id)->update('le_leagueimages', $dataArr);
        return;
    }

    function pending_list_request($pending) {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('leagueimage_id', 'leagueimage_name', 'category_name', 'credit');

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
                if ($aColumns[$i] == "category_name") {
                    $sWhere .= "ct.category_name LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if ($aColumns[$i] == "credit") {
                    $sWhere .= "cd.credit LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
                    $sWhere .= "l." . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                }
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        if (isset($_GET['pending_type']) && $_GET['pending_type'] == "Pending-League") {
            if ($sWhere == '') {
                $sWhere = " WHERE (l.leagueimage_status = 'I')";
            } else {
                $sWhere .= " AND (l.leagueimage_status = 'I')";
            }
        } else {
            if ($sWhere == '') {
                $sWhere = " WHERE (cd.credit_status = 'I')";
            } else {
                $sWhere .= " AND (cd.credit_status = 'I')";
            }
        }

        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = " SELECT l.*,ct.category_name,cd.credit,cd.credit_id,cd.credit_status 
                    FROM le_leagueimages AS l
                    LEFT JOIN le_category AS ct ON ct.category_id = l.category_id 
                    LEFT JOIN le_credits AS cd ON cd.leagueimage_id = l.leagueimage_id 
                    $sWhere  
                    $sOrder
                    $sLimit";

        $data = $this->db->query($sQuery);
        $rResult = $data->result_array();

        /* Data set length after filtering */
        $sQuery = " SELECT l.*,ct.category_name,cd.credit,cd.credit_id,cd.credit_status 
                    FROM le_leagueimages AS l
                    LEFT JOIN le_category AS ct ON ct.category_id = l.category_id 
                    LEFT JOIN le_credits AS cd ON cd.leagueimage_id = l.leagueimage_id
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
        $aColumns = array('leagueimage_id', 'leagueimage_name', 'category_name', 'credit', 'league', 'action');
        foreach ($rResult as $aRow) {
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == 'league') {
                    $row[] = "<img title='" . $aRow['leagueimage_name'] . "' alt='" . $aRow['leagueimage_filename'] . "' width='100px' height='80px' src='" . base_url() . "uploads/league/" . $aRow['leagueimage_filename'] . "'>";
                } elseif ($aColumns[$i] == 'credit') {
                    $creditStatus = $aRow["credit"] . "<br/>" . "<a onclick=\"credit_status(" . $aRow['credit_id'] . ",'" . $aRow['credit_status'] . "');\" id='active' style='cursor: pointer;'>";
                    if ($aRow["credit_status"] == "A") {
                        $creditStatus .= "<img title='Inactive' alt='Active' src='" . base_url() . "assets/images/active.png'>";
                    } else {
                        $creditStatus .= "<img alt='InActive' src='" . base_url() . "assets/images/inactive.png'  title='Active'>";
                    }
                    $creditStatus .= '</a> ';
                    $row[] = $creditStatus;
                } elseif ($aColumns[$i] == 'action') {
                    // button for active and inactive

                    $html = "<a onclick=\"active_league(" . $aRow['leagueimage_id'] . ",'" . $aRow['leagueimage_status'] . "');\" id='active' style='cursor: pointer;'>";
                    if ($aRow["leagueimage_status"] == "A") {
                        $html .= "<img title='Inactive' alt='Active' src='" . base_url() . "assets/images/active.png'>";
                    } else {
                        $html .= "<img alt='InActive' src='" . base_url() . "assets/images/inactive.png'  title='Active'>";
                    }
                    $html .= '</a> ';
                    // button for popular
                    $html .= "<a onclick=\"popular_league(" . $aRow['leagueimage_id'] . ",'" . $aRow['leagueimage_setpopular'] . "')\" style='cursor: pointer;'>";
                    if ($aRow["leagueimage_setpopular"] == "N") {
                        $html .= "<img title='Set as popular' alt='NotPopular' src='" . base_url() . "assets/images/popular1.png'>";
                    } else {
                        $html .= "<img alt='Popular' src='" . base_url() . "assets/images/popular.png'  title='Remove-Popularity'>";
                    }
                    $html .= "</a>";

                    // button for sidebar
                    $html .= " <a onclick=\"sidebar_status(" . $aRow['leagueimage_id'] . ",'" . $aRow['is_sidebar'] . "')\" style='cursor: pointer;'>";

                    if ($aRow["is_sidebar"] == "0") {
                        $html .= "<img title='set as Sidebar' alt='sidebar' src='" . base_url() . "assets/images/power_off.png'>";
                    } else {
                        $html .= "<img title='Remove as Sidebar' alt='sidebar' src='" . base_url() . "assets/images/power_on.png'>";
                    }
                    $html .= "</a>";

                    // button for Edit
                    $html .= " <a href='" . base_url() . "edit_league/" . $aRow["leagueimage_id"] . "'><img title='Edit' alt='Edit' src='" . base_url() . "assets/images/edit1.png'></a>";
                    // button for delete
                    $html .= "<a onclick=\"delete_league_img(" . $aRow['leagueimage_id'] . ");\" style='cursor: pointer;'><img title='Delete' alt='Delete' src='" . base_url() . "assets/images/btn-close.png'></a>";

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

    function count_inactive_league() {
        $this->db->select('*');
        $this->db->from('le_leagueimages');
        $this->db->where('leagueimage_status', 'I');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_pending_credit_status() {
        $this->db->select('*');
        $this->db->from('le_credits');
        $this->db->where('credit_status', 'I');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function add_league_img($dataArr) {
        $this->db->insert('le_leagueimages', $dataArr);
        return $this->db->insert_id();
    }

    function getuser_details($userid) {
        $this->db->select('*');
        $this->db->from('le_users');
        $this->db->where('user_id', $userid);
        $query = $this->db->get();
        return $query->row_array();
    }

    function list_anime_report1($total) {
        $query = 'SELECT count(lr.id) as total,l.*
                    FROM `le_report` as lr
                    RIGHT JOIN le_leagueimages as l ON l.leagueimage_id = lr.anime_report_id AND leagueimage_status = "A"
                    GROUP BY `anime_report_id`,`report_id`
                    HAVING count(id) > ' . $total;
        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return FALSE;
        }
    }

    function list_anime_report($mim_limit) {

        $mim_limit = $_GET['min_limit'];
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('l.leagueimage_name', 'l.leagueimage_filename', 'l.leagueimage_total_view', 'lc.category_name');

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
        $sQuery = " SELECT count(lr.id) as total,l.*,lc.category_name
                    FROM `le_report` as lr
                    RIGHT JOIN le_leagueimages as l ON l.leagueimage_id = lr.anime_report_id AND leagueimage_status = 'A'
                    LEFT JOIN  le_category as lc ON lc.category_id = l.category_id
                     " . $sWhere . " 
                    GROUP BY `anime_report_id`,`report_id`
                    HAVING count(id) >= " . $mim_limit . "
                    $sOrder
                    $sLimit";

        $data = $this->db->query($sQuery);

//        echo $this->db->last_query();
//        exit;
        $rResult = $data->result_array();

        /* Data set length after filtering */
        $sQuery = " SELECT count(lr.id) as total,l.*,lc.category_name
                    FROM `le_report` as lr
                    RIGHT JOIN le_leagueimages as l ON l.leagueimage_id = lr.anime_report_id AND leagueimage_status = 'A'
                    LEFT JOIN  le_category as lc ON lc.category_id = l.category_id                     
                     " . $sWhere . " 
                    GROUP BY `anime_report_id`,`report_id`
                    HAVING count(id) >= " . $mim_limit;

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

        $aColumns = array('serial_no', 'leagueimage_name', 'leagueimage_filename', 'category_name', 'leagueimage_total_view', 'total', 'action');
        $j = 0;
        foreach ($rResult as $aRow) {
            $j++;
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == 'serial_no') {
                    $row[] = $j;
                } elseif ($aColumns[$i] == 'leagueimage_name') {
                    if (strlen($aRow[$aColumns[$i]]) > 25) {
                        $row[] = substr(strip_tags($aRow[$aColumns[$i]]), 0, 25) . '...';
                    } else {
                        $row[] = $aRow[$aColumns[$i]];
                    }
                } elseif ($aColumns[$i] == 'leagueimage_filename') {
                    $row[] = '<img src="' . base_url() . 'uploads/league/' . $aRow[$aColumns[$i]] . '" alt="' . $aRow["leagueimage_name"] . '" width="100px" height="80px" >';
                } elseif ($aColumns[$i] == 'action') {
                    // button for active and inactive

                    $html = "<a onclick=\"active_league(" . $aRow['leagueimage_id'] . ",'" . $aRow['leagueimage_status'] . "');\" id='active' title='Active' style='cursor: pointer;'>";
                    if ($aRow["leagueimage_status"] == "A") {
                        $html .= "<img alt='Active' src='" . base_url() . "assets/images/active.png'>";
                    } else {
                        $html .= "<img alt='Inactive' src='" . base_url() . "assets/images/inactive.png'>";
                    }
                    $html .= '</a> ';
                    // button for popular or new
                    $html .= "<a onclick=\"popular_league(" . $aRow['leagueimage_id'] . ",'" . $aRow['leagueimage_setpopular'] . "');\"  id='active' title='Active' style='cursor: pointer;'>";
                    if ($aRow["leagueimage_setpopular"] == "N") {
                        $html .= "<img src='" . base_url() . "assets/images/popular1.png' alt='Popular' title='Set as popular'>";
                    } else {
                        $html .= "<img src='" . base_url() . "assets/images/popular.png' alt='Popular'>";
                    }
                    $html .= '</a> ';
                    // button for Edit
                   $html .= " <a href='" . base_url() . "edit_league/" . $aRow["leagueimage_id"] ."'><img title='Edit' alt='Edit' src='" . base_url() . "assets/images/edit1.png'></a>";
                    // button for delete
                    $html .= "<a onclick=\"delete_league_img(" . $aRow['leagueimage_id'] . ");\" style='cursor: pointer;'><img title='Delete' alt='Delete' src='" . base_url() . "assets/images/btn-close.png'></a>";

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
function updateReportStatus($dataArr, $id, $league_report_status, $league_report_user_id) {
        $this->db->where('id', $id)->where('league_report_id', $league_report_user_id)->update('le_report', $dataArr);

        return;
    }
    

    function select_report_data($league_report_user_id, $id) {
        $this->db->select('*');
        $this->db->from('le_report');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function league_report_request() {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('user_name', 'anime_report_id', 'leagueimage_name', 'report_id', 'link', 'status');

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
                if ($aColumns[$i] == "serial_no") {
                    $sWhere .= "serial_no LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if ($aColumns[$i] == "credit") {
                    $sWhere .= "lr.report_id LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if ($aColumns[$i] == "credit") {
                    $sWhere .= "l.leagueimage_name LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if ($aColumns[$i] == "credit") {
                    $sWhere .= "lu.user_name LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
                    $sWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                }
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        if (empty($sWhere)) {
            $sWhere = ' WHERE status= "' . $_GET['status_check'] . '"';
        } else {
            $sWhere .= ' AND status= "' . $_GET['status_check'] . '"';
        }

        $sQuery = " SELECT *, l.leagueimage_id, l.leagueimage_filename, l.leagueimage_name, lu.user_name
                    FROM le_report AS lr
                    LEFT JOIN le_leagueimages AS l ON lr.anime_report_id = l.leagueimage_id
                    LEFT JOIN le_users AS lu ON lu.user_id = lr.league_report_id 

                    $sWhere  
                    $sOrder
                    $sLimit";

        $data = $this->db->query($sQuery);
        $rResult = $data->result_array();

        /* Data set length after filtering */

        $sQuery = " SELECT *, l.leagueimage_id, l.leagueimage_filename, l.leagueimage_name, lu.user_name
                    FROM le_report AS lr
                    LEFT JOIN le_leagueimages AS l ON lr.anime_report_id = l.leagueimage_id
                    LEFT JOIN le_users AS lu ON lu.user_id = lr.league_report_id

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
        $aColumns = array('serial_no', 'user_name', 'leagueimage_name', 'report_id', 'link', 'league', 'status', 'action');
        $j = 0;
        foreach ($rResult as $aRow) {
            $j++;
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                $html = '';


                if ($aColumns[$i] == 'serial_no') {
                    $row[] = $j;
                } else if ($aColumns[$i] == 'status') {
                    if ($aRow["status"] == "1") {
                       $html .="<span class='label label-info' style='min-width:90%;'>Active</span>";
                    } else {
                         $html .="<span class='label label-danger' style='min-width:90%;'>Inactive</span>";
                    }
                    $html .= '</a> ';
                    $row[] = $html;
                } else if ($aColumns[$i] == 'league') {
                    $row[] = "<img title='" . $aRow['leagueimage_name'] . "' alt='" . $aRow['leagueimage_filename'] . "' width='100px' height='80px' src='" . base_url() . "uploads/league/" . $aRow['leagueimage_filename'] . "'>";
                } elseif ($aColumns[$i] == 'action') {
                    // button for active and inactive

                    $html = "<a onclick=\"active_report(" . $aRow['id'] . ", '" . $aRow['status'] . "','" . $aRow['league_report_id'] . "', '" . $aRow['leagueimage_id'] . "');\" id='active' style='cursor: pointer;'>";
                    if ($aRow["status"] == "1") {
                        $html .= "<img title='Inactive' alt='Active' src='" . base_url() . "assets/images/active.png'>";
                    } else {
                        $html .= "<img alt='InActive' src='" . base_url() . "assets/images/inactive.png'  title='Active'>";
                    }
                    $html .= '</a> ';

                    
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
    function report_comment_request() {

        $aColumns = array('serial_no', 'user_comment', 'comment');

        $sLimit = "";
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " . intval($_GET['iDisplayLength']);
        }


        $sOrder = "";
        if (isset($_GET['iSortCol_1'])) {
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

        $sWhere = "";

        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $sWhere = "AND (";
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == "serial_no") {
                    $sWhere .= "arc.id LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if ($aColumns[$i] == "user_comment") {
                    $sWhere .= "arc.user_comment LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if ($aColumns[$i] == "comment") {
                    $sWhere .= "l.comment LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
                    $sWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                }
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        $dWhere = "";
        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $dWhere = "AND (";
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == "serial_no") {
                    $dWhere .= "arc.id LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if ($aColumns[$i] == "user_comment") {
                    $dWhere .= "arc.user_comment LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if ($aColumns[$i] == "comment") {
                    $dWhere .= "dc.comment LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
                    $dWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                }
            }
            $dWhere = substr_replace($dWhere, "", -3);
            $dWhere .= ')';
        }

        if (empty($sWhere)) {
            $sWhere = ' AND arc.status= "' . $_GET['status_check'] . '"';
        } else {
            $sWhere .= ' AND arc.status= "' . $_GET['status_check'] . '"';
        }

        if (empty($dWhere)) {
            $dWhere = ' AND arc.status= "' . $_GET['status_check'] . '"';
        } else {
            $dWhere .= ' AND arc.status= "' . $_GET['status_check'] . '"';
        }

        $sQuery = "SELECT * FROM anime_report_comment WHERE status= '" . $_GET['status_check'] . "'";

        $data = $this->db->query($sQuery);
        $rResult = $data->result_array();

      // print_r($rResult);

        $Array = array();
        for ($j = 0; $j < count($rResult); $j++) {
            $header = $rResult[$j]['comment_header'];
            $cid = $rResult[$j]['id'];
            if ($header == '1') {
                $query1 = "SELECT *, lu.user_name, lu.user_email
                    FROM anime_report_comment AS arc
                    LEFT JOIN le_users AS lu ON lu.user_id = arc.user_id
                 LEFT JOIN le_comments AS l ON arc.all_comment_id = l.comment_id WHERE arc.comment_header = 1 AND id= $cid
               

                    $sWhere  
                    $sOrder
                    $sLimit
                   ";
            } else {
                $query1 = "SELECT *, lu.user_name, lu.user_email
                    FROM anime_report_comment AS arc
                    LEFT JOIN le_users AS lu ON lu.user_id = arc.user_id
                    LEFT JOIN discussion_comment AS dc ON arc.all_comment_id = dc.comment_id WHERE arc.comment_header = 2 
                    
                    $dWhere  
                    $sOrder
                    $sLimit
                   ";
            }
            $data = $this->db->query($query1);
            $Result = $data->row();
            array_push($Array, $Result);
        }

        $finalData = json_decode(json_encode($Array), True);

        
        
     //  echo "FINALLL <pre>";
      // print_r($finalData);
     //  exit;


        $iFilteredTotal = count($finalData);
        $iTotal = count($finalData);

        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );


        $aColumns = array('id', 'user_name', 'comment', 'user_comment', 'image_link', 'status');
        foreach ($finalData as $aRow) {
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                $html = '';

                if ($aColumns[$i] == 'image_link') {
                    if ($aRow['comment_header'] == "1") {
                        $row[] = "<a href='" . base_url() . "" . $aRow["leagueimage_id"] . "'>" . base_url() . "" . $aRow["leagueimage_id"] . "</a>";
                    } else if ($aRow['comment_header'] == "2") {
                        $row[] = "<a href='" . base_url() . "discussion-single/" . $aRow["anime_discussionid"] . "'>" . base_url() . "discussion-single/" . $aRow["anime_discussionid"] . "</a>";
                    }
                } else if ($aColumns[$i] == 'status') {
                    if ($aRow["status"] == "0") {
                        $html .="<span class='label label-info' style='min-width:90%;'>Active</span>";
                    } else {
                        $html .="<span class='label label-danger' style='min-width:90%;'>Inactive</span>";
                    }
                    $html .= '</a> ';
                    $row[] = $html;
                } 
//                else if ($aColumns[$i] == 'action') {
////                    $row[] = 'action';
//                    $html = "<a onclick=\"active_comment(" . $aRow['id'] . ", '" . $aRow['comment_header'] . "','" . $aRow['all_comment_id'] . "', '" . $aRow["status"] . "');\" id='comment' style='cursor: pointer;'>";
//                    if ($aRow["status"] == "0") {
//                        $html .= "<img title='Inactive' alt='Active' src='" . base_url() . "assets/images/active.png'>";
//                    } else {
//                        $html .= "<img alt='InActive' src='" . base_url() . "assets/images/inactive.png'  title='Active'>";
//                    }
//                    $html .= '</a> ';
//
//
//                    $row[] = $html;
//                } 
                else {
                    $row[] = $aRow[$aColumns[$i]];
                }
            }
            $output['aaData'][] = $row;
        }

        echo json_encode($output);
        exit;
    }

    function updateCmtStatus($id, $dataArr) {
        $this->db->where('id', $id)->update('anime_report_comment', $dataArr);
        return;
    }
    function lCommentreport($total) {
        
        
        
         $aColumns = array('serial_no', 'user_comment', 'comment');

        $sLimit = "";
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " . intval($_GET['iDisplayLength']);
        }


        $sOrder = "";
        if (isset($_GET['iSortCol_1'])) {
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

        $sWhere = "";

        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $sWhere = "AND (";
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == "serial_no") {
                    $sWhere .= "arc.id LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if ($aColumns[$i] == "user_comment") {
                    $sWhere .= "arc.user_comment LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if ($aColumns[$i] == "comment") {
                    $sWhere .= "l.comment LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
                    $sWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                }
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        $dWhere = "";
        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $dWhere = "AND (";
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == "serial_no") {
                    $dWhere .= "arc.id LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if ($aColumns[$i] == "user_comment") {
                    $dWhere .= "arc.user_comment LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if ($aColumns[$i] == "comment") {
                    $dWhere .= "dc.comment LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
                    $dWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                }
            }
            $dWhere = substr_replace($dWhere, "", -3);
            $dWhere .= ')';
        }

//        if (empty($sWhere)) {
//            $sWhere = ' AND arc.status= "' . $_GET['status_check'] . '"';
//        } else {
//            $sWhere .= ' AND arc.status= "' . $_GET['status_check'] . '"';
//        }
//
//        if (empty($dWhere)) {
//            $dWhere = ' AND arc.status= "' . $_GET['status_check'] . '"';
//        } else {
//            $dWhere .= ' AND arc.status= "' . $_GET['status_check'] . '"';
//        }

//        $sQuery = "SELECT * FROM anime_report_comment WHERE status= '" . $_GET['status_check'] . "'";
        $sQuery = "SELECT count(arc.id) as total,arc.*, lu.user_name, lu.user_email,l.*
                    FROM anime_report_comment AS arc
                    LEFT JOIN le_users AS lu ON lu.user_id = arc.user_id
                    LEFT JOIN le_comments AS l ON arc.all_comment_id = l.comment_id WHERE arc.comment_header = 1                    
                     GROUP BY `all_comment_id`";
        
        

        $data = $this->db->query($sQuery);
        $rResult = $data->result_array();
      
         $query1 = "SELECT count(arc.id) as total,arc.*, lu.user_name, lu.user_email, dc.*
                    FROM anime_report_comment AS arc
                    LEFT JOIN le_users AS lu ON lu.user_id = arc.user_id
                    LEFT JOIN discussion_comment AS dc ON arc.all_comment_id = dc.comment_id WHERE arc.comment_header = 2  GROUP BY `all_comment_id` ";
           
        $data = $this->db->query($query1);
        $rResult1 = $data->result_array();
   
        $result = array_merge($rResult, $rResult1);
      //  print_r($result);
        $iFilteredTotal = count($result);
        $iTotal = count($result);

        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );


        $aColumns = array('id', 'user_name', 'comment', 'image_link', 'total','action');
        foreach ($result as $aRow) {
         //   print_r($aRow);
          //  echo "test" . $aRow['comment_header'] ."---";
            
            
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                $html = '';

                if ($aColumns[$i] == 'image_link') {
                    if ($aRow['comment_header'] == "1") {
                        $row[] = "<a href='" . base_url() . "" . $aRow["leagueimage_id"] . "'>" . base_url() . "" . $aRow["leagueimage_id"] . "</a>";
                    } else if ($aRow['comment_header'] == "2") {
                        $row[] = "<a href='" . base_url() . "discussion-single/" . $aRow["anime_discussionid"] . "'>" . base_url() . "discussion-single/" . $aRow["anime_discussionid"] . "</a>";
                    }
                } else if ($aColumns[$i] == 'status') {
                    if ($aRow["status"] == "0") {
                        $html .="<span class='label label-info' style='min-width:90%;'>Active</span>";
                    } else {
                        $html .="<span class='label label-danger' style='min-width:90%;'>Inactive</span>";
                    }
                    $html .= '</a> ';
                    $row[] = $html;
                } 
                else if ($aColumns[$i] == 'action') {
//                    $row[] = 'action';
                    $html = "<a onclick=\"active_comment(" . $aRow['id'] . ", '" . $aRow['comment_header'] . "','" . $aRow['all_comment_id'] . "', '" . $aRow["status"] . "');\" id='comment' style='cursor: pointer;'>";
                    if ($aRow["status"] == "0") {
                        $html .= "<img title='Inactive' alt='Active' src='" . base_url() . "assets/images/active.png'>";
                    } else {
                        $html .= "<img alt='InActive' src='" . base_url() . "assets/images/inactive.png'  title='Active'>";
                    }
                    $html .= '</a> ';


                    $row[] = $html;
                } 
                else {
                    $row[] = $aRow[$aColumns[$i]];
                }
            }
            $output['aaData'][] = $row;
        }

        echo json_encode($output);
        exit;
        
  
        
    }
    

}

?>