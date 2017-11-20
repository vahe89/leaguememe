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
                        <h3 class="box-title">Add Articles</h3>
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
                    <form class="form uniformForm validateForm" action="<?php echo base_url(); ?>add_articles" id="add_articles_form" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="required">Article Name:</label>
                                <div class="field">
                                    <input type="text" name="article_name" id="article_name" size="32" class="validate[required] form-control"/>	
                                    <?php echo form_error('article_name'); ?>
                                </div>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="required">Article Url:</label>
                                <div class="field">
                                    <input type="text" name="article_url" id="article_url" size="32" readonly/>	
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="required">Article Tag:</label>
                                <div class="field">
                                    <input type="text" name="article_tag" id="article_tag" size="32" class="validate[required] form-control"/>	
                                    <?php echo form_error('article_tag'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="required">Article Description:</label>
                                <div class="field"> 
                                    <textarea name="editor1" id="editor1" class="validate[required] form-control"></textarea>	
                                    <?php echo form_error('editor1'); ?>
                                </div>
                            </div>
                            <div class="form-group" id="fileupload">
                                <label for="required">Article Image:</label>
                                <div class="field">
                                    <input type="file" name="article_img" id="article_img" class="validate[required]"/>	

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="field">  
                                    <label for="required">Tag Name:</label>
                                    <input type="text" name="tag_name" id="tag_name" placeholder="Ex: THEORY"  value="THEORY">

                                    <label for="required">Tag Color:</label> 
                                    <input type="text" name="tag_color" id="tag_color" placeholder="Ex : #dfdfdf or red" value="#dfdfdf">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="required">Spoiler:</label>
                                <div class="field"> 
                                    <input type="checkbox" name="spoiler" id="spoiler" value="1" class="" >	

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="required">Meta Keyword:</label>
                                <div class="field"> 
                                    <input name="meta_keyword" id="meta_keyword" class="validate[required] form-control">	
                                    <?php echo form_error('meta_keyword'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="required">Meta Description:</label>
                                <div class="field"> 
                                    <textarea name="meta_description" id="meta_description" class="validate[required] form-control"></textarea>	
                                    <?php echo form_error('meta_description'); ?>
                                </div>
                            </div>
                            <!-- .form-group -->
                            <div class="actions">						
                                <button type="submit" class="btn btn-tertiary">Submit</button>
                            </div> <!-- .actions -->
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
<script src="<?php echo base_url(); ?>assets/admin/js/add_article.js" type="text/javascript"></script>
