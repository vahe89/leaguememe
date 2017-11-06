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
                        <h3 class="box-title">Add Author</h3>
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
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo base_url(); ?>add_author" id="add_author_form" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="required">Author Name:</label>
                                <input type="text" name="author_name" id="author_name" placeholder="ex: Facebook" class="form-control"/>	
                                <span class="error"><?php echo form_error('author_name'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="required">Author Link:</label>
                                <input type="text" name="author_link" id="author_link" placeholder="ex: http://www.facebook.com" class="form-control"/>	
                                <span class="error"><?php echo form_error('author_link'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="required">Author Photo:</label>
                                <input type="file" name="auhtor_photo" id="author_photo"/>	
                                <span class="error"><?php echo form_error('auhtor_photo'); ?></span>
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

<script>
$(document).ready(function () {
   
    $('#add_author_form').validate({
        rules: {
            author_name: {
                required: true,
            },
            author_link: {
                required: true,
            },
            auhtor_photo: {
                required: true,
            }
        },
        messages: {
            author_name: {
                required: "Author Name field is reqiured.",
            }, 
            author_link: {
                required: "Author link field is reqiured.",
            }, 
            auhtor_photo: {
                required: "Author photo is reqiured.",
            },
        }
    });
});
</script>