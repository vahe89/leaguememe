<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/** load the CI class for Modular Extensions **/
require dirname(__FILE__).'/Base.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Controller.php
 *
 * @copyright	Copyright (c) 2011 Wiredesignz
 * @version 	5.4
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class MX_Controller 
{
	public $autoload = array();
	
	public function __construct() 
	{
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class." MX_Controller Initialized");
		Modules::$registry[strtolower($class)] = $this;	
		
		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);	
		
		/* autoload module items */
		$this->load->_autoloader($this->autoload);
	}
	
	public function __get($class) {
		return CI::$APP->$class;
	}

    function getRightContent($maintabval,$add, $count = 55) {

        $side_link = $this->hm->get_all_sidelinksside($maintabval);
        $side_linkss = $this->hm->get_all_sidelinksnoside(0, $maintabval, $count);
        $data["side_links"] = array_merge($side_link, $side_linkss);
        $data["sideadd"] = $add;
        return $this->load->view('ajax_right_sidebar', $data, TRUE);

    }

    function get_sub_items($types='new',$subtype = 'all') {

        if (!empty($types)) {
            if ($types == "popular") {
                $maintabval = "popular";
            } else if ($types == "new") {
                $maintabval = "new";
            } else if ($types == "bookmark") {
                $maintabval = "bookmark";
            } else {
                $maintabval = "popular";
            }
        } else {
            $maintabval = "popular";
        }

        if (!empty($subtype)) {

            $subtabval = $subtype;
        } else {
            $subtabval = "";
        }
        $data['subTabData'] = $this->hm->get_sub_tabs();
        $total = count($data['subTabData']);
        $html = '';
        $type = $this->input->post('type');


        for ($i = 0; $i < $total; $i++) {
            $active = "";


            if ($data['subTabData'][$i]['category_name'] == "All") {
                if ($subtabval == "All") {
                    $active = "active";
                }
                $html .= '<li class="' . $type . $active . ' subTab" id="' . $type . '' . $data["subTabData"][$i]["category_name"] . '"><a id="' . $type . 'sub' . $data["subTabData"][$i]["category_id"] . '" href="' . base_url()  . "new/" . 'all" class="active">' . ucwords($data["subTabData"][$i]["category_name"]) . '</a></li>';
//$html .= "<li class='subTab active' id='" . $data['subTabData'][$i]['category_id'] . "'><a id='" . $data['subTabData'][$i]['category_id'] . "' class='active' href='#'>" . ucwords($data['subTabData'][$i]['category_name']) . "</a></li>";
            } else {
                $cate_name =  $data['subTabData'][$i]['category_name'];

                if ($data['subTabData'][$i]['category_name'] == "Art/Cosplay") {
                    $category = "art";
                } else {
                    $category = $data['subTabData'][$i]['category_name'];
                }
                $html .= '<li class="' . $type ;
                if($subtabval == "Art"){
                    $cate_new_name = "Art/Cosplay";
                }else{
                    $cate_new_name = ucfirst($subtabval) ;
                }
                if($cate_new_name == $cate_name) { $html .= 'active' ; }
                $html .='  subTab" id="' . $type . '' . $data["subTabData"][$i]["category_name"] . '"><a id="' . $type . 'sub' . $cate_name . '" href="' . base_url() . "new/" . strtolower($category) . '">' . ucwords($data["subTabData"][$i]["category_name"]) . '</a></li>';
//$html .= "<li class='subTab' id='" . $data['subTabData'][$i]['category_id'] . "'><a id='" . $data['subTabData'][$i]['category_id'] . "' href='#'>" . ucwords($data['subTabData'][$i]['category_name']) . "</a></li>";
            }
        }
        $actives = "";
        if ($subtabval == "random") {
            $actives = "active";
        }

        $html .= "<li class='" . $type . $actives . " subTab' id='" . $type . "random'><a id='" . $type . "sub0' href='" . base_url() . 'new/' . "random'>Random</a></li>";
        return $html;
    }
}