<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    /* Applies a page template to a returned view */
    
    function load_admin_template($data)
    {
        echo Modules::run('admin/template_admin/index', $data);
    }
    
    function load_public_template($data)
    {
        echo Modules::run('public/template_public/index', $data);
    }
?>
