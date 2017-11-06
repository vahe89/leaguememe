<?php

class Anime_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function anime_category_request() {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('anime_id', 'anime_name');

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
        $sWhere = "WHERE anime_status = '1'";
        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $sWhere = "WHERE anime_status = '1' AND (";
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == "serial_no") {
                    $sWhere .= "serial_no LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if ($aColumns[$i] == "anime_id") {
                    $sWhere .= "anime_id LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if ($aColumns[$i] == "credit") {
                    $sWhere .= "anime_name LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                } else if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
                    $sWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                }
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        $sQuery = " SELECT *
                    FROM anime
                    $sWhere  
                    $sOrder
                    $sLimit";

        $data = $this->db->query($sQuery);
        $rResult = $data->result_array();

        /* Data set length after filtering */

        $sQuery = " SELECT *
                    FROM anime 
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
        $aColumns = array('serial_no', 'anime_name', 'anime_jpg', 'action');

        $j = 0;

        foreach ($rResult as $aRow) {
            $j++;
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                $html = '';


                if ($aColumns[$i] == 'serial_no') {
                    $row[] = $j;
                } else if ($aColumns[$i] == 'anime_jpg') {
                    $row[] = "<img title='" . $aRow['anime_name'] . "' alt='" . $aRow['anime_jpg'] . "' width='100px' height='80px' src='" . base_url() . "uploads/anime/" . $aRow['anime_jpg'] . "'>";
                } elseif ($aColumns[$i] == 'action') {

                    $html .= " <a href='" . base_url() . "edit-animedetail/" . $aRow["anime_id"] . "'><img title='Edit' alt='Edit' src='" . base_url() . "assets/images/edit1.png'></a>";
                    $html .= '</a> ';
                    $html .= " <a href='javascript:void(0);' id='delete-animedetail_" . $aRow["anime_id"] . "' onclick='delete_anime(this.id)'><img title='Delete' alt='Delete' src='" . base_url() . "assets/images/btn-close.png'></a>";
                    $html .= '</a> ';
                    $html .= " <a href='#changeImage' id='update-image_" . $aRow["anime_id"] . "' data-toggle='modal' data-id='#updateimage" . $aRow["anime_id"] . "' onclick='change_image(this.id)'><i class='fa fa-pencil ' title='Change image'></i></a>";
                    $html .= '</a> ';
                    // button for popular
                    $html .= "<a onclick=\"popular_anime(" . $aRow['anime_id'] . ",'" . $aRow['anime_popular'] . "')\" style='cursor: pointer;'>";
                    if ($aRow["anime_popular"] == 0) {
                        $html .= "<img title='Set as popular' alt='NotPopular' src='" . base_url() . "assets/images/popular1.png'>";
                    } else {
                        $html .= "<img alt='Popular' src='" . base_url() . "assets/images/popular.png'  title='Remove-Popularity'>";
                    }
                    $html .= "</a>";
                    $html .= " <a href='" . base_url() . "admin/animecategory/edit_subCategory/" . $aRow["anime_id"] . "'><i title='Edit Sub Category'  class='fa fa-tasks'></i></a>";
                    $html .= '</a> ';
                    $html .= " <a href='#episodetime' id='episode-time_" . $aRow["anime_id"] . "_" . $aRow["episode_time"] . "_" . $aRow["manga_time"] . "' data-toggle='modal' data-id='#episodetime" . $aRow["anime_id"] . "' onclick='episode_time(this.id)'><i class='fa fa-clock-o' title='Change time'></i></a>";
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

    function getDataByAnimeimage($anime_img_id) {
        $query = $this->db->select('*')
                ->where('anime_id', $anime_img_id)
                ->from('anime')
                ->get();
        return $query->row_array();
    }

    function getanime_editdetail($anime_img_id) {
        $query = $this->db->select('*')
                ->where('anime_id', $anime_img_id)
                ->from('admin_animeedit')
                ->get();
        return $query->result();
    }

    function insertAnimedata($anime_img_id, $dataArr) {
        $this->db->insert('admin_animeedit', $dataArr);
    }

    function updateAnimedata($anime_img_id, $dataArr) {
        $this->db->where('anime_id', $anime_img_id)
                ->update('admin_animeedit', $dataArr);
        return;
    }

    function animedetail($anime_img_id) {
        $query = $this->db->select('*')
                ->where('anime_id', $anime_img_id)
                ->from('admin_animeedit')
                ->get();
        return $query->row_array();
    }

    function add_animecategory_data($dataArr) {
        $this->db->insert('anime', $dataArr);
        return $this->db->insert_id();
    }

    function add_animesubcategory_data($cateArr) {
        $this->db->insert('anime_sub_category', $cateArr);
    }

    function deleteCategory($category_id, $dataArr) {
        $this->db->where('anime_id', $category_id)
                ->update('anime', $dataArr);
        return;
    }

    function update_photo_anime($category_id, $dataArr) {
        $this->db->where('anime_id', $category_id)
                ->update('anime', $dataArr);
        return;
    }

    function getAnimeSubtab($anime_id) {
        $this->db->select('*');
        $this->db->from('anime_sub_category');
        $this->db->where('anime_id', $anime_id);
        $query = $this->db->get();
        return $query->result();
    }

    function deleteanimesubcate($anime_id) {
        $this->db->where('anime_id', $anime_id)->delete('anime_sub_category');
    }

    function updateAnimePopulartatus($dataArr, $anime_id) {
        $this->db->where('anime_id', $anime_id)->update('anime', $dataArr);
        return;
    }

    function update_episode_time($category_id, $dataArr) {
        $this->db->where('anime_id', $category_id)
                ->update('anime', $dataArr);
        return;
    }

    function update_manga_time($category_id, $dataArr) {
        $this->db->where('anime_id', $category_id)
                ->update('anime', $dataArr);
        return;
    }

//    for cron
    function getanime() {
        $query = $this->db->select('*')
                ->from('anime')
                ->get();
        return $query->result();
    }

    function update_episode($anime_id, $dataArray) {
        $this->db->where('anime_id', $anime_id)
                ->update('anime', $dataArray);
        return;
    }
    function update_episode_detail($anime_id, $dataArray) {
        $this->db->where('anime_id', $anime_id)
                ->update('admin_animeedit', $dataArray);
        return;
    }

}
