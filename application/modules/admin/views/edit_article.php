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
                    <form class="form uniformForm validateForm" action="<?= base_url() ?>edit_articles/<?php echo $article_detail['article_id']; ?>" id="add_articles_form" method="post" enctype="multipart/form-data">

                        <div class="box-body">
                            <div class="form-group">
                                <label for="required">Article Name:</label>
                                <div class="field">
                                    <input type="text" name="article_name" id="article_name" size="32" class="validate[required] form-control" value="<?php echo $article_detail['article_name']; ?>"/>	
                                </div>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="required">Article Url:</label>
                                <div class="field">

                                    <input type="text" name="article_url" id="article_url" size="32"  value="<?php echo $article_detail['article_url']; ?>"/>	
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="required">Article Tag:</label>
                                <div class="field">

                                    <input type="text" name="article_tag" id="article_tag" size="32" class="validate[required] form-control" value="<?php echo $tag; ?>"/>	
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="required">Article Description:</label>
                                <div class="field"> 
                                    <textarea name="editor1" id="editor1" class="validate[required] form-control"><?php echo $article_detail['article_description']; ?></textarea>	
                                </div>
                            </div>
                            <div class="form-group" id="fileupload">
                                <label for="required">Article Image:</label>
                                <div class="field">
                                    <span class="field"><img src="<?= base_url() ?>uploads/articles/<?php echo $article_detail['article_image']; ?>" width="130" height="190" ></span>
                                    <input type="file" name="article_imgs" id="article_imgs"  />	
                                    <input type="hidden" name="article_img_old" id="article_img_old" value="<?php echo $article_detail['article_image']; ?>"> 
                                </div>
                            </div>
                            <div class="form-group"> 
                                <div class="field"> 
                                    <?php 
                                    $tag_name  = "THEORY";
                                    $tag_color = "#dfdfdf";
                                    if(!empty($article_detail['tag_style']) &&  isset($article_detail['tag_style'])){
                                        $tags = explode(",", $article_detail['tag_style']);
                                        $tag_name = $tags[0];
                                        $tag_color = $tags[1];
                                    }?>
                                    <label for="required">Tag Name:</label>
                                    <input type="text" name="tag_name" id="tag_name" placeholder="Ex: THEORY"  value="<?= $tag_name ?>">
                                    
                                    <label for="required">Tag Color:</label> 
                                    <input type="text" name="tag_color" id="tag_color" placeholder="Ex :  #dfdfdf or red" value="<?= $tag_color ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="required">Spoiler:</label>
                                <div class="field"> 

                                    <input type="checkbox" name="spoiler" id="spoiler" value="1" class=""  <?= ($article_detail['spoiler'] == "1") ? "checked='checked'" : "" ?>>	

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="required">Meta Keyword:</label>
                                <div class="field"> 
                                    <input name="meta_keyword" value="<?php echo $article_detail['meta_keyword']; ?>" id="meta_keyword" class="validate[required] form-control">	
                                    <?php echo form_error('meta_keyword'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="required">Meta Description:</label>
                                <div class="field"> 
                                    <textarea name="meta_description" id="meta_description" class="validate[required] form-control"><?php echo $article_detail['meta_description']; ?></textarea>	
                                    <?php echo form_error('meta_description'); ?>
                                </div>
                            </div>
                            <!-- .form-group -->

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
<script src="<?php echo base_url(); ?>assets/admin/js/add_article.js" type="text/javascript"></script>
