<?php

/**
 * Description of crud
 *
 * @author abc
 */
class Article_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getAllArticle() {
        $query = $this->db->select('*')
                ->from('article')
                ->order_by('article_id', 'desc')
                ->get();
        return $query->result();
    }

    function getLeagueImageById($league_img_id) {
        $query = $this->db->select('*')
                ->from('le_leagueimages')
                ->join('le_category', 'le_category.category_id=le_leagueimages.category_id')
                ->where('leagueimage_id', $league_img_id)
                ->get();
        return $query->row_array();
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

    function updateArticleById($dataArr, $aid) {
        return $this->db->where('article_id', $aid)
                        ->update('article', $dataArr);
    }

    function saveArticle($dataArr) {
        $this->db->insert('article', $dataArr);
        return $this->db->insert_id();
    }

    function saveArticleTag($dataArr) {
        $this->db->insert('article_tag', $dataArr);
        return $this->db->insert_id();
    }

    /* tags */

    function delete_article($article_id) {
        $qry = $this->db->where('article_id', $article_id)
                ->get('article');
        $result = $qry->row();

        unlink('uploads/articles/' . $result->article_image);

        $result = $this->db->where('article_id', $article_id)
                ->delete('article');

        return;
    }

    function select_article($article_id) {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->where('article_id', $article_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function getuser_details($userid) {
        $this->db->select('*');
        $this->db->from('le_users');
        $this->db->where('user_id', $userid);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_articles_by_url($url) {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->where('article_url', $url);
        $query = $this->db->get();
        return $query->result();
    }

    function get_articles_id_by_tag($league_name) {
        $this->db->select('article_id');
        $this->db->from('article_tag');
        $this->db->where('tag', $league_name);
        $query = $this->db->get();
        $data = $query->result();
        if ($data) {
            return $data[0]->article_id;
        } else {
            return '';
        }
    }

    function get_articles_id_by_id($league_id) {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->where('article_id', $league_id);
        $query = $this->db->get();
        return $query->result();
    }

    function get_articles_by_id($article_id) {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->where('article_id', $article_id);
        $query = $this->db->get();
        return $query->result();
    }

    function get_tags_by_article_id($article_id) {
        $this->db->select('tag');
        $this->db->from('article_tag');
        $this->db->where('article_id', $article_id);
        $query = $this->db->get();
        return $query->result();
    }

    function add_comment($data) {
        $this->db->insert('article_comment', $data);
    }

    function get_comment_of_article($article_id) {
        $this->db->select('*');
        $this->db->from('article_comment as ac');
        $this->db->join('le_users as lu', 'ac.user_id = lu.user_id');
        $this->db->where('article_id', $article_id);
        $this->db->order_by('comment_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    function get_tags($article_id) {
        $this->db->select('tag');
        $this->db->from('article_tag');
        $this->db->where('article_id', $article_id);
        $query = $this->db->get();
        return $query->result();
    }

    function delete_tags($article_id) {
        $result = $this->db->where('article_id', $article_id)->delete('article_tag');
        return $result;
    }

    function delete_comments($article_id) {
        $result = $this->db->where('article_id', $article_id)->delete('article_comment');
        return $result;
    }

    function updateImagePopulartatus($dataArr, $league_img_id) {
        $this->db->where('leagueimage_id', $league_img_id)->update('le_leagueimages', $dataArr);
        return;
    }

    function article_limit($limit, $start) {
        $sql = 'SELECT COUNT(comment) FROM `article_comment` WHERE article_comment.article_id = article.article_id';
        $this->db->limit($limit, $start);
        $this->db->select('*, GROUP_CONCAT(tag) as tags,(' . $sql . ') as total_comment');
        $this->db->from('article');
        $this->db->join('article_tag ', 'article_tag.article_id = article.article_id');
        $this->db->where('status', "A")->group_by('article_tag.article_id');
        $this->db->order_by('article.article_id', 'DESC');
        $query = $this->db->get();

        return $query->result_array();
    }

    function article_list_request() {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('article_id', 'article_name', 'article_description', 'article_image', 'status');

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
        $sQuery = " SELECT * FROM article
                    $sWhere  
                    $sOrder
                    $sLimit";

        $data = $this->db->query($sQuery);
        $rResult = $data->result_array();

        /* Data set length after filtering */
        $sQuery = " SELECT * FROM article
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

        $aColumns = array('serial_no', 'article_name', 'article_description', 'article_image', 'action');
        $j = 0;
        foreach ($rResult as $aRow) {
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == 'serial_no') {
                    $row[] = $aRow['article_id'];
                } else if ($aColumns[$i] == 'article_image') {
                    $row[] = "<img title='" . $aRow['article_image'] . "' alt='" . $aRow['article_image'] . "' width='100px' height='80px' src='" . base_url() . "uploads/articles/" . $aRow['article_image'] . "'>";
                } else if ($aColumns[$i] == 'article_description') {
                    $row[] = substr(strip_tags($aRow['article_description']), 0, 20) . '...';
                } elseif ($aColumns[$i] == 'action') {
                    // button for active and inactive
                    $html = "<a onclick=\"active_article('" . $aRow['article_id'] . "','" . $aRow['status'] . "');\" id='active' title='Active' style='cursor: pointer;'>";

                    if ($aRow["status"] == "A") {
                        $html .= "<img alt='Active' src='" . base_url() . "assets/images/active.png'>";
                    } else {
                        $html .= "<img alt='Inactive' src='" . base_url() . "assets/images/inactive.png'>";
                    }
                    $html .= '</a> ';
                    $html .="<a onclick=\"popular_article('" . $aRow['article_id'] . "', '" . $aRow['setpopular'] . "');\"  id='active' title='Active' style='cursor: pointer;'>";
                    if ($aRow['setpopular'] == "N") {
                        $html .= "<img alt='Popular'  title='Set as popular' src='" . base_url() . "assets/images/popular1.png'>";
                    } else {
                        $html .= "<img alt='Popular' src='" . base_url() . "assets/images/popular.png'>";
                    }
                    $html .= '</a> ';
                    // button for Edit
                    
                    $html .= "<a href='" . base_url() . "edit_articles/" . $aRow['article_id'] . "'><img title='Edit' alt='Edit' src='" . base_url() . "assets/images/edit1.png'></a>";
                    // button for delete
                    
                    $html .= "<a onclick=\"delete_article('" . $aRow['article_id'] . "');\" style='cursor: pointer;'><img title='Delete' alt='Delete' src='" . base_url() . "assets/images/btn-close.png'></a>";

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

}

?>