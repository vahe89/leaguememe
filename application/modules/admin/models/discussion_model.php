<?php

/**
 * Description of crud
 *
 * @author abc
 */
class Discussion_model extends CI_Model {

    var $table = "anime_discussion";

    public function __construct() {
        parent::__construct();
    }

    public function discussion_list_request() {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('anime_discussionid', 'title', 'description', 'discussion_file', 'discussion_userid');

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
                if (isset($_POST['bSearchable_' . $i]) && $_POST['bSearchable_' . $i] == "true") {
                    $sWhere .= "d." . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_POST['sSearch']) . "%' OR ";
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
        $sQuery = " SELECT  d.*,u.user_name,u.name 
                    FROM $this->table AS d  
                    LEFT JOIN le_users AS u ON u.user_id = d.discussion_userid 
                   
                    $sWhere  
                    $sOrder
                    $sLimit";
        $data = $this->db->query($sQuery);
        $rResult = $data->result_array();

        /* Data set length after filtering */
        $sQuery = " SELECT  d.*,u.user_name,u.name 
                    FROM $this->table AS d  
                    LEFT JOIN le_users AS u ON u.user_id = d.discussion_userid 
                 
                    $sWhere   ";

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
                if ($aColumns[$i] == 'anime_discussionid') {
                    $row[] = $aRow['anime_discussionid'];
                } else if ($aColumns[$i] == 'title') {
                    $row[] =$aRow['title'] ;
                } else if ($aColumns[$i] == 'description') {
                    $row[] = $aRow['description'];
                } else if ($aColumns[$i] == 'discussion_file') {
                    $row[] =  "<a href=\"javascript:openModal('" . base_url() . "uploads/discussion/" . $aRow["discussion_file"] . "','" . $aRow["title"] . "');\"   title='Select winner' >". $aRow['discussion_file'] ."</a>";
                } else if ($aColumns[$i] == 'discussion_userid') {
                    if ($aRow['discussion_userid'] == "0") {
                        $name = "Admin";
                    } elseif (!empty($aRow['name'])) {
                        $name = $aRow['name'];
                    } else {
                        $name = $aRow['user_name'];
                    }
                    $row[] = $name;
                } elseif ($aColumns[$i] == 'action') {

                    $html = "<a onclick=\"bookmark_discussion(" . $aRow['anime_discussionid'] . ",'" . $aRow['bookmark'] . "');\" id='discussion_active' style='cursor: pointer;'>";
                    if ($aRow["bookmark"] == "1") {
                        $html .= "<img title='Already Bookmark' alt='Active' src='" . base_url() . "assets/images/active.png'>";
                    } else {
                        $html .= "<img alt='InActive' src='" . base_url() . "assets/images/inactive.png'  title='Not Bookmark'>";
                    }
                    $html .= '</a> ';
                    // button for popular
                    $html .= "<a onclick=\"popular_discussion(" . $aRow['anime_discussionid'] . ",'" . $aRow['animediscussion_popular'] . "')\" style='cursor: pointer;'>";
                    if ($aRow["animediscussion_popular"] == "N") {
                        $html .= "<img title='Set as popular' alt='NotPopular' src='" . base_url() . "assets/images/popular1.png'>";
                    } else {
                        $html .= "<img alt='Popular' src='" . base_url() . "assets/images/popular.png'  title='Remove-Popularity'>";
                    }
                    $html .= "</a>";
                    // button for delete
                    $html .= "<a onclick=\"delete_discussion(" . $aRow['anime_discussionid'] . ");\" href='javascript:void(0)' title='Delete event' style='padding:5px'><i class='fa fa-trash-o' aria-hidden='true'></i></a>";
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

    function updateDisBookmark($dataArr, $league_dis_id) {
        $this->db->where('anime_discussionid', $league_dis_id)->update($this->table, $dataArr);
        return;
    }

    function updatedisPopulartatus($dataArr, $league_dis_id) {
        $this->db->where('anime_discussionid', $league_dis_id)->update($this->table, $dataArr);
        return;
    }

    function delete_discussion($league_dis_id) {
        $this->db->where('anime_discussionid', $league_dis_id)->delete($this->table);
        return;
    }

}

?>