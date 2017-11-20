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
                        <h3 class="box-title">Edit Category</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo base_url(); ?>edit_category/<?= $category_id ?>" id="edit_category_form" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="required">Category Name:</label>
                                <input type="text" name="category_name" id="category_name"class="form-control" value="<?= $brand_details->category_name; ?>"/>	
                                <span class="error"><?php echo form_error('category_name'); ?></span>
                                
                                <input type="hidden" name="category_status" id="category_status" value="<?= $brand_details->category_status; ?>">
                                <a  href='#changeImage'  data-toggle='modal'>Only change category photo</a>
                            </div>
                             <div class="form-group">
                                <label>Category text:</label>
                                <input type="text" name="category_exmp" id="category_exmp"class="form-control" value="<?= $brand_details->text; ?>" placeholder="e.g lol, joke, prank, fail"/>
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
    <div id="changeImage" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change League Image</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo base_url(); ?>admin/category/change_category_photo" id="add_category_form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="required">Category Photo:</label>
                        <input type="file" name="category_photo" id="category_photo"/>	
                        <span class="error"><?php echo form_error('category_photo'); ?></span>
                    </div>
                    <input type="hidden" name="catId" id="catId" value="<?= $category_id ?>"/>
                    <input type="submit" class="btn btn-default" value="Change">
                </form>
            </div>
             
        </div>

    </div>
</div>
</div> 
<script src="<?php echo base_url(); ?>assets/admin/js/category_list.js" type="text/javascript"></script>
