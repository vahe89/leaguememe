<?php

class Patch_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function addPatchNotes($dataArr, $ptitle) {
        $date = date('Y-m-d h:i:s');
        $main_id = array(
            'main_id' => '',
            'patch_title' => $ptitle,
            'is_active' => '1',
            'datecreated' => $date,
        );
        $this->db->insert('newPatch_id', $main_id);
        $pid = $this->db->insert_id();

        for ($i = 0; $i < count($dataArr); $i++) {
            $tet = $dataArr[$i];
            $pname = $tet[0];
            $pdesc = $tet[1];
            $pImgArr = $tet[2];
            $pArr = array(
                'patch_id' => $pid,
                'patch_name' => $pname,
                'patch_description' => $pdesc,
                "created_date" => $date,
            );
            $this->db->insert('newPatch_section', $pArr);
            $secId = $this->db->insert_id();

            for ($j = 0; $j < count($pImgArr); $j++) {
                $pchImage = $this->base64_to_jpeg($pImgArr[$j]);
                $ptch = array(
                    'id' => '',
                    'patch_secId' => $secId,
                    'filename' => $pchImage,
                );
                $this->db->insert('newPatch_image', $ptch);
            }
        }
    }

    function base64_to_jpeg($base64_string) {
        $data = explode(',', $base64_string);
        $firstdata = explode(";", $data[0]);
        $getbase = explode(":", $firstdata[0]);
        $getimgtype = explode("/", $getbase[1]);
        $output_file = $this->generateRandomString() . "." . $getimgtype[1];
        // open the output file for writing
        $ifp = fopen(getcwd() . '/uploads/patch_original/' . $output_file, 'wb');

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string> 
        // we could add validation here with ensuring count( $data ) > 1
        fwrite($ifp, base64_decode($data[1]));

        // clean up the file resource
        fclose($ifp);
//        chmod($output_file, 0777); // CHMOD file


//        for image optimize
        $decode_image = imagecreatefromstring(base64_decode($data[1]));

        if ($getimgtype[1] == 'jpeg' || $getimgtype[1] == 'pjpeg' || $getimgtype[1] == 'jpg') {
            $image_path = getcwd() . "/uploads/patch_notes/$output_file";
            imagejpeg($decode_image, $image_path, 80);
        } elseif ($getimgtype[1] == 'png') {
            $image_path = getcwd() . "/uploads/patch_notes/$output_file";
            imagepng($decode_image, $image_path);
        } else {
            $image_path = fopen(getcwd() . '/uploads/patch_notes/' . $output_file, 'wb');
            fwrite($image_path, base64_decode($data[1]));
            fclose($image_path);
        }

//        end

        return $output_file;
//        imagedestroy($source);
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function patchNotes_list_request() {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('main_id', 'patch_title');

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
                    $sOrder .= "pi." . $aColumns[intval($_GET['iSortCol_' . $i])] . "
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
            $sWhere .= "  WHERE  (";
            for ($i = 0; $i < count($aColumns); $i++) {
                if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
                    $sWhere .= "pi." . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                }
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }
        /*
         * SQL queries
         * Get data to display
         */

        $sQuery = " SELECT * FROM `newPatch_id` AS pi  LEFT JOIN newPatch_section AS ps ON ps.patch_id = pi.main_id
                    $sWhere  
                        GROUP BY pi.main_id
                    $sOrder
                    $sLimit";


        $data = $this->db->query($sQuery);
        $rResult = $data->result_array();

        /* Data set length after filtering */
        $sQuery = "  SELECT * FROM `newPatch_id` AS pi  LEFT JOIN newPatch_section AS ps ON ps.patch_id = pi.main_id
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

        $aColumns = array('patch_title', 'action');
        $j = 0;
        foreach ($rResult as $aRow) {
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == 'action') {
                    // button for active and inactive
                    $html = "<a onclick=\"active_patch_notes('" . $aRow['main_id'] . "','" . $aRow['is_active'] . "');\" id='active' title='Status' style='cursor: pointer;'>";

                    if ($aRow["is_active"] == 1) {
                        $html .= "<img alt='Active' src='" . base_url() . "assets/images/active.png'>";
                    } else {
                        $html .= "<img alt='Inactive' src='" . base_url() . "assets/images/inactive.png'>";
                    }
                    $html .= '</a> ';
                    // button for Edit

                    $html .= "<a href='" . base_url() . "edit_patch_notes/" . $aRow['main_id'] . "'><img title='Edit' alt='Edit' src='" . base_url() . "assets/images/edit1.png'></a>";
                    // button for delete

                    $html .= "<a onclick=\"delete_patch_notes('" . $aRow['main_id'] . "');\" style='cursor: pointer;'><img title='Delete' alt='Delete' src='" . base_url() . "assets/images/btn-close.png'></a>";

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

    function updatePatchNotesById($dataArr, $id) {
        return $this->db->where('main_id', $id)
                        ->update('newPatch_id', $dataArr);
    }

    function delete_patchnotes($id) {
        $this->db->where('main_id', $id)
                ->delete('newPatch_id');
        $this->db->where('patch_id', $id)
                ->delete('newPatch_section');
        $this->db->where('patch_secId', $id)
                ->delete('newPatch_image');
        $this->db->where('patch_id', $id)
                ->delete('newPatch_victory');
        $this->db->where('patch_id', $id)
                ->delete('newPatch_comments');
        return;
    }

    function delete_patchnotes_image($id) {
        $this->db->where('id', $id)
                ->delete('newPatch_image');
        return;
    }

    function delete_section($id) {
        $this->db->where('sect_id', $id)
                ->delete('newPatch_section');
        $this->db->where('patch_secId', $id)
                ->delete('newPatch_image');
        return;
    }

    function getPatchDataId($id) {
        $this->db->select('*');
        $this->db->from('newPatch_id');
        $this->db->where('main_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function getPatchSecData($id) {
        $this->db->select('*');
        $this->db->from('newPatch_section');
        $this->db->where('patch_id', $id);
        $query = $this->db->get();
        $data = $query->result();
        $a = array();
        foreach ($data as $row) {
            $sid = $row->sect_id;

            $this->db->select('*');
            $this->db->from('newPatch_image');
            $this->db->where('patch_secId', $sid);
            $qry = $this->db->get();
            $qDta = $qry->result_array();
            $patch['pSecdata'] = $row;
            $patch['pImgdata'] = $qDta;

            array_push($a, $patch);
        }
        return $a;
    }

  
    function updatePatchdata($id, $ptitle, $aldata) {

        $this->db->where('main_id', $id);
        $this->db->update('newPatch_id', array('patch_title' => $ptitle));

        for ($i = 0; $i < count($aldata); $i++) {
            $secArray = $aldata[$i];

            $scId = $secArray[0];
            $pnm = $secArray[1];
            $pdc = $secArray[2];

            if ($scId == 'new') {
                $secData = array(
                    "sect_id" => '',
                    "patch_id" => $id,
                    "patch_name" => $pnm,
                    "patch_description" => $pdc,
                    "created_date" => date('Y-m-d h:i:s'),
                );
                $this->db->insert('newPatch_section', $secData);
                $newScid = $this->db->insert_id();
            } else {
                $secData = array(
                    "patch_name" => $pnm,
                    "patch_description" => $pdc,
                );

                $this->db->where('sect_id', $scId);
                $this->db->where('patch_id', $id);
                $this->db->update('newPatch_section', $secData);

                $newScid = $scId;
            }

            if (isset($secArray[3])) {
                $pImgArr = $secArray[3];
                for ($j = 0; $j < count($pImgArr); $j++) {
                    $pchImage = $this->base64_to_jpeg($pImgArr[$j]);
                    $ptch = array(
                        'id' => '',
                        'patch_secId' => $newScid,
                        'filename' => $pchImage,
                    );
                    $this->db->insert('newPatch_image', $ptch);
                }
            }
        }
    }
    function savePatchNotes($data){
        return  $this->db->insert('patchEditor', $data);
         
    }

}
