<?php

/**
 * Description of crud
 *
 * @author abc
 * Rules Template
 */
class Rules_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    function check_page_name($page_name) {
        $this->db->select('*');
        $this->db->from('rules_templates');
        $this->db->where('page_name', $page_name);  
//        $this->db->where('page_name = ' . "'" . $page_name . "'");
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return false;
        } else {
            return TRUE;
        }
    }
    
    function save_rules($dataArr){
        $this->db->insert('rules_templates', $dataArr);
        return $this->db->insert_id();
    }
    
    function rules_list_request() {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('id', 'page_name', 'template', 'status');

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

//        if ($sWhere == '') {
//            $sWhere = " WHERE (active = '' OR p.status = '0' OR p.status = '1')";
//        } else {
//            $sWhere .= " AND (p.status = '5' OR p.status = '0' OR p.status = '1')";
//        }

        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = " SELECT * FROM rules_templates
                    $sWhere  
                    $sOrder
                    $sLimit";

        $data = $this->db->query($sQuery);
        $rResult = $data->result_array();

        /* Data set length after filtering */
        $sQuery = " SELECT * FROM rules_templates
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

        $aColumns = array('serial_no', 'page_name', 'template','status', 'action');
        $j = 0;
        foreach ($rResult as $aRow) {
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == 'serial_no') {
                    $row[] = $aRow['id'];
                } elseif ($aColumns[$i] == 'status') {
                    if ($aRow["status"] == 1) {
                        $row[] = 'Active';
                    }else{
                        $row[] = 'Inactive';                        
                    }
                } elseif ($aColumns[$i] == 'action') {
                    // button for active and inactive
                    $html = "<a onclick=\"active_rules_template('" . $aRow['id'] . "','" . $aRow['status'] . "');\" id='active' title='Status' style='cursor: pointer;'>";

                    if ($aRow["status"] == 1) {
                        $html .= "<img alt='Active' src='" . base_url() . "assets/images/active.png'>";
                    } else {
                        $html .= "<img alt='Inactive' src='" . base_url() . "assets/images/inactive.png'>";
                    }
                    $html .= '</a> ';
                    // button for Edit
                    
                    $html .= "<a href='" . base_url() . "edit_rules_template/" . $aRow['id'] . "'><img title='Edit' alt='Edit' src='" . base_url() . "assets/images/edit1.png'></a>";
                    // button for delete
                    
                    $html .= "<a onclick=\"delete_rules_template('" . $aRow['id'] . "');\" style='cursor: pointer;'><img title='Delete' alt='Delete' src='" . base_url() . "assets/images/btn-close.png'></a>";

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
    
    function updateRuleTemplateById($dataArr, $aid) {
        return $this->db->where('id', $aid)
                        ->update('rules_templates', $dataArr);
    }
    
    function delete_template($rules_id){
        $result = $this->db->where('id', $rules_id)
                ->delete('rules_templates');
        return;
    }
    
    function select_template($rules_id) {
        $this->db->select('*');
        $this->db->from('rules_templates');
        $this->db->where('id', $rules_id);
        $query = $this->db->get();
        return $query->row_array();
    }
}
