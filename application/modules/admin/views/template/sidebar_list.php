<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url(); ?>assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo ucwords($this->session->userdata('username')); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <?php
            $superadmin = $this->session->userdata('is_superadmin');
            if ($superadmin == 1) {
                if (isset($content_header) && $content_header == "Admin") {
                    ?>
                    <li class="active treeview">
                        <?php
                    } else {
                        ?>
                    <li class="treeview">
                        <?php
                    }
                    ?>
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>Admin</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url(); ?>add_admin"><i class="fa fa-circle-o"></i> Add Admin</a></li>
                        <li><a href="<?php echo base_url(); ?>admin_list"><i class="fa fa-circle-o"></i> Admin Manage</a></li>
                    </ul>
                </li>
                <?php
            }
            if (isset($content_header) && $content_header == "Dashboard") {
                ?>
                <li class="active treeview">
                    <?php
                } else {
                    ?>
                <li class="treeview">
                    <?php
                }
                ?>
                <a href="<?php echo base_url(); ?>dashboard">
                    <i class="fa fa-desktop"></i> <span>Dashboard</span><span class="label label-primary pull-right bg-green"><?= count($league) ?></span>
                </a>
            </li>
            <?php
            if (isset($content_header) && $content_header == "Category") {
                ?>
                <li class="active treeview">
                    <?php
                } else {
                    ?>
                <li class="treeview">
                    <?php
                }
                ?>
                <a href="#">
                    <i class="fa fa-th"></i> 
                    <span>Category</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>add_category"><i class="fa fa-circle-o"></i> Add Category</a></li>
                    <li><a href="<?php echo base_url(); ?>list_category"><i class="fa fa-circle-o"></i> List Category</a></li>
                </ul>
            </li>

             
            <?php
            if (isset($content_header) && $content_header == "League") {
                ?>
                <li class="active treeview">
                    <?php
                } else {
                    ?>
                <li class="treeview">
                    <?php
                }
                ?>
                <a href="#">
                    <i class="fa fa-picture-o"></i>
                    <span>Leaguememe</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>add_league"><i class="fa fa-circle-o"></i> Add League</a></li>
                    <li><a href="<?php echo base_url(); ?>list_league"><i class="fa fa-circle-o"></i> List League</a></li>
                </ul>
            </li>
            <?php
            if (isset($content_header) && $content_header == "League") {
                ?>
                <li class="active treeview">
                    <?php
                } else {
                    ?>
                <li class="treeview">
                    <?php
                }
                ?>
                <a href="#">
                    <i class="fa fa-comments"></i>
                    <span>Discussion</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    
                    <li><a href="<?php echo base_url(); ?>list_discussion"><i class="fa fa-circle-o"></i> List Discussion</a></li>
                </ul>
            </li>
            <?php
            if (isset($content_header) && $content_header == "Articles") {
                ?>
                <li class="active treeview">
                    <?php
                } else {
                    ?>
                <li class="treeview">
                    <?php
                }
                ?>
                <a href="#">
                    <i class="fa fa-newspaper-o"></i>
                    <span>Articles</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    
                    <li><a href="<?php echo base_url(); ?>list_articles"><i class="fa fa-circle-o"></i> List Articles</a></li>
                    <li><a href="<?php echo base_url(); ?>add_articles"><i class="fa fa-circle-o"></i> Add Articles</a></li>
                </ul>
            </li>
            <?php
            if (isset($content_header) && $content_header == "Patch Notes") {
                ?>
                <li class="active treeview">
                    <?php
                } else {
                    ?>
                <li class="treeview">
                    <?php
                }
                ?>
                <a href="#">
                    <i class="fa fa-newspaper-o"></i>
                    <span> Patch Notes</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    
                    <li><a href="<?php echo base_url(); ?>list_patch_notes"><i class="fa fa-circle-o"></i> List Patch Notes</a></li>
                    <li><a href="<?php echo base_url(); ?>add_patch_notes"><i class="fa fa-circle-o"></i> Add  Patch Notes</a></li>
                </ul>
            </li>
            <?php
            if (isset($content_header) && $content_header == "Event") {
                ?>
                <li class="active treeview">
                    <?php
                } else {
                    ?>
                <li class="treeview">
                    <?php
                }
                ?>
                <a href="#">
                    <i class="fa fa-calendar"></i>
                    <span>Event</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>add_event"><i class="fa fa-circle-o"></i> Add Event</a></li>
                    <li><a href="<?php echo base_url(); ?>list_event"><i class="fa fa-circle-o"></i> List Event </a></li>
                </ul>
            </li>
            <?php
            if (isset($content_header) && $content_header == "Users") {
                ?>
                <li class="active treeview">
                    <?php
                } else {
                    ?>
                <li class="treeview">
                    <?php
                }
                ?>
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>User Status</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>users"><i class="fa fa-circle-o"></i> User <span class="label label-primary pull-right bg-yellow"><?= count($users) ?></span></a></li>
                </ul>
            </li>

            <?php
            if (isset($content_header) && $content_header == "Sidebar") {
                ?>
                <li class="active treeview">
                    <?php
                } else {
                    ?>
                <li class="treeview">
                    <?php
                }
                ?>
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Side Links</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>sidebar_list"><i class="fa fa-circle-o"></i> View Sidebar </a></li>
                </ul>
            </li>

            <?php
            if (isset($content_header) && $content_header == "Report") {
                ?>
                <li class="active treeview">
                    <?php
                } else {
                    ?>
                <li class="treeview">
                    <?php
                }
                ?>
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Report</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>list_anime_report"><i class="fa fa-circle-o"></i> List Most Report </a></li>
                    <li><a href="<?php echo base_url(); ?>all_anime_report"><i class="fa fa-circle-o"></i> League Report </a></li>
                </ul>
            </li>
            <?php
            if (isset($content_header) && ($content_header == "Rules Template" || $content_header == "List Templates")) {
                ?>
                <li class="active treeview">
                    <?php
                } else {
                    ?>
                <li class="treeview">
                    <?php
                }
                ?>
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Rules</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>list_rules_template"><i class="fa fa-circle-o"></i> List Rules Template </a></li>
                    <li><a href="<?php echo base_url(); ?>rules_template"><i class="fa fa-circle-o"></i> Rules Template </a></li>
                </ul>
            </li>
            <?php
            if (isset($content_header) && ($content_header == "Tab Manage")) {
                ?>
                <li class="active treeview">
                    <?php
                } else {
                    ?>
                <li class="treeview">
                    <?php
                }
                ?>
                    <a href="<?= base_url()?>manage_tab">
                    <i class="fa fa-book"></i>
                    <span>Manage Tab</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                 
            </li>
            <?php
            if (isset($content_header) && $content_header == "Credit Authors") {
                ?>
                <li class="active treeview">
                    <?php
                } else {
                    ?>
                <li class="treeview">
                    <?php
                }
                ?>
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Credit Authors</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>list_author"><i class="fa fa-circle-o"></i> Author Lists</a></li>
                    <li><a href="<?php echo base_url(); ?>add_author"><i class="fa fa-circle-o"></i> Add Author </a></li>
                </ul>
            </li>
            <!--   Left Section--> 
             <?php
            if (isset($content_header) && $content_header == "Left_section") {
                ?>
                <li class="active treeview">
                    <?php
                } else {
                    ?>
                <li class="treeview">
                    <?php
                }
                ?>
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Left Section</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>addsection"><i class="fa fa-circle-o"></i> Add section </a></li>
                    <li><a href="<?php echo base_url(); ?>list_section"><i class="fa fa-circle-o"></i> List Section</a></li>
                    
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>