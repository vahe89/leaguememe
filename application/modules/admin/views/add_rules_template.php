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
    <!--    <hr/> -->
    <section class="content">
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Rules Template</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo base_url(); ?>rules_template" class="form validateForm" id="add_rules_template" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="required">Add Page Name:</label>
                                <input type="text" name="page_name" id="page_name" placeholder="Add Page Name" class="validate[required] form-control"/>	
                                <span class="error page_name_error"><?php echo form_error('page_name'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="required">Rules Template:</label>
                                <div class="field"> 
                                    <textarea name="rules_editor" id="rules_editor" class="validate[required] form-control"></textarea>	
                                     <span class="error rules_editor_error"><?php echo form_error('rules_editor'); ?></span>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="button" id="add_rules_btn" class="btn btn-primary">Submit</button>
                            <!--<button type="submit" class="btn btn-primary">Submit</button>-->
                        </div>
                    </form>
                </div>
            </div>    
            <div class="col-lg-2">
            </div>
        </div>
    </section>
</div>    
<script src="<?php echo base_url(); ?>assets/admin/js/category_list.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/add_rules.js" type="text/javascript"></script>
