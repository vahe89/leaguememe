<?php

/**
 * Description of crud
 *
 * @author abc
 */
class Category_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function category_list_request() {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('category_id', 'category_name', 'text', 'category_logo','category_status');

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
        $sQuery = " SELECT * FROM le_category
                    $sWhere  
                    $sOrder
                    $sLimit";

        $data = $this->db->query($sQuery);
        $rResult = $data->result_array();

        /* Data set length after filtering */
        $sQuery = " SELECT * FROM le_category
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

        $aColumns = array('serial_no', 'category_name', 'text', 'category_logo','action');
        $j = 0;
        foreach ($rResult as $aRow) {
            $j++;
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == 'serial_no') {
                    $row[] = $j;
                } else if ($aColumns[$i] == 'category_logo'){
                     $row[] = "<img title='" . $aRow['category_logo'] . "' alt='" . $aRow['category_logo'] . "' width='100px' height='80px' src='" . base_url() . "uploads/category/" . $aRow['category_logo'] . "'>";
                }elseif ($aColumns[$i] == 'action') {
                    // button for active and inactive

                    $html = "<a onclick=\"active_category('" . $aRow['category_id'] . "','" . $aRow['category_status'] . "');\" id='active' title='Active' style='cursor: pointer;'>";
                    if ($aRow["category_status"] == "A") {
                        $html .= "<img alt='Active' src='" . base_url() . "assets/images/active.png'>";
                    } else {
                        $html .= "<img alt='Inactive' src='" . base_url() . "assets/images/inactive.png'>";
                    }
                    $html .= '</a> ';

                    // button for Edit
                    $html .= "<a href='" . base_url() . "edit_category/" . $aRow['category_id'] . "'><img title='Edit' alt='Edit' src='" . base_url() . "assets/images/edit1.png'></a>";
                    // button for delete
                    $html .= "<a onclick=\"delete_category('" . $aRow['category_id'] . "');\" style='cursor: pointer;'><img title='Delete' alt='Delete' src='" . base_url() . "assets/images/btn-close.png'></a>";

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

    function updateCategory($dataArr, $category_id) {
        return $this->db->where('category_id', $category_id)
                        ->update('le_category', $dataArr);
    }

    function deleteCategory($category_id) {
        return $this->db->where('category_id', $category_id)
                        ->delete('le_category');
    }
 function update_photo_category($category_id, $dataArr) {
        $this->db->where('category_id', $category_id)
                ->update('le_category', $dataArr);
        return;
    }
    function unique_exist_updation($unique_value, $unique_field, $table_name, $id, $uniqueid) {
        $this->db->from($table_name);
        $this->db->where($unique_field, $unique_value);
        $this->db->where($id . ' !=', $uniqueid);
        $query = $this->db->get();
        return $query->result();
    }

    function getCategoryDetail($category_id) {
        $query = $this->db->select('*')
                ->from('le_category')
                ->where('category_id', $category_id)
                ->get();
        return $query->row();
    }

    function add_category_data($dataArr) {
        $this->db->insert('le_category', $dataArr);
        return $this->db->insert_id();
    }

    function getAllCategory() {
        $query = $this->db->select('*')
                ->from('le_category')
                ->get();
        return $query->result();
    }

    function getCategoryId($category) {
        $this->db->select('*');
        $this->db->from('le_category');
        $this->db->where('category_name', $category);
        $this->db->or_where('category_name', "Video");
        $query = $this->db->get();
        $data = $query->result();
        if ($data) {
            return $data[0]->category_id;
        } else {
            return 0;
        }
    }

}

?>