<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo base_url(); ?>dashboard" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>LM</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Leaguememe</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a title="Pending League" href="<?php echo base_url(); ?>list_league/Pending-League">
                                <i class="fa fa fa-hourglass-end"></i>
                                <span class="label label-success">
                                    <?php
                                    if ($count_meme != 0) {
                                        echo $count_meme;
                                    }
                                    ?>
                                </span>
                            </a>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a title="Pending Credit" href="<?php echo base_url(); ?>list_league/Pending-Credits">
                                <i class="fa fa-credit-card"></i>
                                <span class="label label-warning">
                                    <?php
                                    if ($count_pending_credit_status != 0) {
                                        echo $count_pending_credit_status;
                                    }
                                    ?> 
                                </span>
                            </a>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url(); ?>assets/admin/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo ucwords($this->session->userdata('username')); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo base_url(); ?>assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                    <p>
                                        <?php echo ucwords($this->session->userdata('username')); ?>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left label label-success">
                                        <a class="btn btn-default btn-flat" href="<?php echo base_url(); ?>edit_profile">Profile</a>
                                    </div>
                                    <div class="pull-right label label-danger">
                                        <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>