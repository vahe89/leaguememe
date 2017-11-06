<?php

class Admin_lib {

    private $CI;
	var $file_ext		= "";

    public function __construct() {
        $this->CI = & get_instance();
    }

    function is_logged() {
        if (!$this->CI->session->userdata('logged_in')) {
            redirect('admin/admin');
            die();
        }
    }
 
     

}

