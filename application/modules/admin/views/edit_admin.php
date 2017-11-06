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
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Admin</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php
                    if (isset($data) && !empty($data)) {
                        foreach ($data as $admin) {
                            ?>
                            <form role="form" action="<?php echo base_url(); ?>edit_admin/<?php echo $admin->admin_id; ?>" id="edit_admin_form" method="post" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="required">Web Title:</label>
                                        <input type="text" name="web_title" value="<?php echo $admin->web_title; ?>" id="web_title" required="" class="form-control"/>	
                                        <span class="error"><?php echo form_error('web_title'); ?></span>

                                    </div>
                                    <div class="form-group">
                                        <label for="required">Email:</label>
                                        <input type="email" name="email" value="<?php echo $admin->admin_email; ?>" id="email" required="" class="form-control"/>	
                                        <span class="error"><?php echo form_error('email'); ?></span>

                                    </div>
                                    <div class="form-group">
                                        <label for="required">Username:</label>
                                        <input type="text" name="username" value="<?php echo $admin->username; ?>" id="username" disabled="" class="form-control"/>	
                                        <span class="error"><?php echo form_error('username'); ?></span>

                                    </div>
                                    <div class="form-group">
                                        <label for="required">Admin Status:</label>
                                        <select name="is_active" class="form-control" id="is_active">
                                            <?php if ($admin->is_active == 0) { ?>
                                                <option value="0" selected>Inactive </option>
                                                <option value="1">Active </option>
                                            <?php } else { ?>
                                                <option value="0">Inactive </option>
                                                <option value="1" selected>Active </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            <?php
                        }
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
