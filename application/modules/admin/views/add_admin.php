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
                        <h3 class="box-title">Add Admin</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                            <form role="form" action="<?php echo base_url(); ?>add_admin" id="add_admin_form" method="post">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="required">Web Title:</label>
                                        <input type="text" name="web_title" placeholder="Web Title" id="web_title" required="" class="form-control"/>	
                                        <span class="error"><?php echo form_error('web_title'); ?></span>

                                    </div>
                                    <div class="form-group">
                                        <label for="required">Email:</label>
                                        <input type="email" name="email" id="email"  placeholder="Email" required="" class="form-control"/>	
                                        <span class="error"><?php echo form_error('email'); ?></span>

                                    </div>
                                    <div class="form-group">
                                        <label for="required">Username:</label>
                                        <input type="text" name="username"  id="username"  placeholder="UserName" required="" class="form-control"/>	
                                        <span class="error"><?php echo form_error('username'); ?></span>

                                    </div>
                                    <div class="form-group">
                                        <label for="required">Password:</label>
                                        <input type="password" name="password"  id="password" required=""  placeholder="Password" class="form-control"/>	
                                        <span class="error"><?php echo form_error('password'); ?></span>

                                    </div>
                                    <div class="form-group">
                                        <label for="required">Confirm Password:</label>
                                        <input type="password" name="c_password"  id="c_password" required=""  placeholder="Confirm Password" class="form-control"/>	
                                        <span class="error"><?php echo form_error('c_password'); ?></span>

                                    </div>
                                   </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                </div>
            </div>    
            <div class="col-lg-2">
            </div>
        </div>
    </section>
</div> 
<script src="<?php echo base_url(); ?>assets/admin/js/admin_list.js" type="text/javascript"></script>
