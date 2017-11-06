<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header with-border">
        <h1>
            <?php echo isset($content_header) ? $content_header : "Leaguememe"; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo isset($left) ? $left : "leaguememe"; ?></li>
        </ol>
    </section>
    <section class="content">
        <?php
        $message = $this->session->flashdata('message');
        if ($message != '') {
            ?>
            <center>
                <div class="alert alert-danger alert-dismissable" style="width: 40%">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>
                        <?php echo $message; ?>
                    </strong> 
                </div> 
            </center> 
        <?php } ?>
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Profile</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php
                    if (isset($admin_details) && !empty($admin_details)) {
                        ?>
                        <form role="form" action="<?php echo base_url(); ?>edit_profile" id="edit_admin_form" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="required">Username:</label>
                                    <input type="text" name="username" disabled="" value="<?php echo $admin_details->username; ?>" id="username" class="form-control"/>	
                                    <span class="error"><?php echo form_error('username'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="required">Email:</label>
                                    <input type="email" name="email" value="<?php echo $admin_details->admin_email; ?>" id="email" required="" class="form-control"/>	
                                    <span class="error"><?php echo form_error('email'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="required">Old Password:</label>
                                    <input type="password" name="old_pwd" value="" id="old_pwd" class="form-control"/>	
                                    <span class="error"><?php echo form_error('old_pwd'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="required">New Password:</label>
                                    <input type="password" name="new_pwd" value="" id="new_pwd" class="form-control"/>	
                                    <span class="error"><?php echo form_error('new_pwd'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="required">Confirm Password:</label>
                                    <input type="password" name="cnf_pwd" value="" id="cnf_pwd" class="form-control"/>	
                                    <span class="error"><?php echo form_error('cnf_pwd'); ?></span>
                                </div>

                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <?php
                    }
                    ?>
                </div>
            </div>    
            <div class="col-lg-2">
            </div>
        </div>
    </section>
</div> 
<script src="<?php echo base_url(); ?>assets/admin/js/admin_list.js" type="text/javascript"></script>
