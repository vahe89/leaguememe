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
                        <h3 class="box-title">Edit Article</h3>
                    </div><!-- /.box-header -->
                    <?php
                    $message = $this->session->flashdata('message');
                    if ($message != '') {
                        ?>
                        <center>
                            <div class="alert alert-success alert-dismissable" style="width: 40%">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>
                                    <?php echo $message; ?>
                                </strong> 
                            </div> 
                        </center> 
                    <?php } ?> 
                    <!-- form start -->
                    <form class="form uniformForm validateForm" action="<?= base_url() ?>edit_rules_template/<?php echo $rules_detail['id']; ?>" id="edit_rules_form" method="post">

                        <div class="box-body">
                            <div class="form-group">
                                <label for="required">Page Name:</label>
                                <div class="field">
                                    <span class="form-control" style="background-color: #eee"><?php echo $rules_detail['page_name']; ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="required">Rules Template:</label>
                                <div class="field"> 
                                    <textarea name="rules_editor" id="rules_editor" class="validate[required] form-control"><?php echo $rules_detail['template']; ?></textarea>	
                                    <?php echo form_error('rules_editor'); ?>
                                </div>
                            </div>
                            <div class="actions">						
                                <button type="submit" class="btn btn-tertiary">Submit</button>
                            </div> <!-- .actions -->
                        </div><!-- /.box-body -->
                    </form>
                </div>
            </div>    
            <div class="col-lg-2">
            </div>
        </div>
    </section>
</div> 
<script src="<?php echo base_url(); ?>assets/admin/js/add_rules.js" type="text/javascript"></script>
