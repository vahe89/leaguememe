<style>
    .delete{
        background: white;
        border-radius: 100%; 
        margin-left: -8px; 
        cursor: pointer;
    }
    .thumb {
        height: 75px;
        border: 1px solid #000;
        margin: 10px 5px 0 0;
    } 
    .delete_yt_url {
        cursor: pointer;
        color:red;
    }
</style>
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
                        <h3 class="box-title">Add Patch Notes</h3>
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
                    <form action="<?= base_url()?>admin/patch_note/add_patch_notes_new" method="post">
                        
                    
                    
                    <div class="clearfix"></div>
                    <div class="box-body">
                        <div class="form-group">
                        <label for="required">Patch Note Title:</label>
                        <input type="text" name="patch_notes_title" id="patch_notes_title" size="32" class="validate[required] form-control patch_notes_title"/>	

                    </div> 
                        <div class="form-group"> 
                            <textarea class="patch_editor" id="patch_editor" name="patch_editor"></textarea>
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-success">Add Patch</button>
                    </div>
                    </div>
                    
                    </form> 
                </div>
            </div>    
            <div class="col-lg-2">
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url(); ?>assets/admin/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script> 
//end
	CKEDITOR.replace( 'patch_editor', {
			extraPlugins: 'embed,autoembed,image2',
			height: 500,

			// Load the default contents.css file plus customizations for this sample.
			contentsCss: [ CKEDITOR.basePath + 'contents.css', 'http://sdk.ckeditor.com/samples/assets/css/widgetstyles.css' ],
			// Setup content provider. See http://docs.ckeditor.com/#!/guide/dev_media_embed
			embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

			// Configure the Enhanced Image plugin to use classes instead of styles and to disable the
			// resizer (because image size is controlled by widget styles or the image takes maximum
			// 100% of the editor width).
			image2_alignClasses: [ 'image-align-left', 'image-align-center', 'image-align-right' ],
			image2_disableResizer: true
		} ); 
 
</script>
