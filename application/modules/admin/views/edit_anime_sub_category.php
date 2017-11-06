<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header with-border">
        <h1>
            <?php echo isset($content_header) ? $content_header : "Animemonent"; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo isset($left) ? $left : "Animemonent"; ?></li>
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
                        <h3 class="box-title">Edit Anime Sub Category</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="" id="add_anime_category_form" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <?php if (isset($discussion)) {
                                    ?>
                                    <input type="checkbox" class="anime_cate" value="discussion" checked="">  <label>Discussion</label> <br>
                                    <?php
                                } else {
                                    ?> <input type="checkbox" class="anime_cate" value="discussion">  <label>Discussion</label> <br>
                                    <?php
                                }
                                ?>
                                <?php if (isset($manga)) {
                                    ?>
                                    <input type="checkbox" class="anime_cate" value="manga" checked=""> <label>Manga</label> <br>
                                    <?php
                                } else {
                                    ?><input type="checkbox" class="anime_cate" value="manga"> <label>Manga</label> <br>
                                    <?php
                                }
                                ?>
                                <?php if (isset($theories)) {
                                    ?>
                                    <input type="checkbox" class="anime_cate" value="theories" checked=""> <label>Theories</label> <br>
                                    <?php
                                } else {
                                    ?>  <input type="checkbox" class="anime_cate" value="theories"> <label>Theories</label> <br>
                                    <?php
                                }
                                ?>
                                <?php if (isset($episode)) {
                                    ?>
                                    <input type="checkbox" class="anime_cate" value="episode" checked="">  <label>Episode</label> <br>
                                    <?php
                                } else {
                                    ?>    <input type="checkbox" class="anime_cate" value="episode">  <label>Episode</label> <br>
                                    <?php
                                }
                                ?>
                                <?php if (isset($review)) {
                                    ?>
                                    <input type="checkbox" class="anime_cate" value="review" checked=""> <label>Review</label>  <br>
                                    <?php
                                } else {
                                    ?>  <input type="checkbox" class="anime_cate" value="review"> <label>Review</label>  <br>
                                    <?php
                                }
                                ?>
                                <?php if (isset($quotes)) {
                                    ?>
                                    <input type="checkbox" class="anime_cate" value="quotes" checked="">  <label>Quotes</label> <br>
                                    <?php
                                } else {
                                    ?> <input type="checkbox" class="anime_cate" value="quotes">  <label>Quotes</label> <br>
                                    <?php
                                }
                                ?>

                                <span class="error"><?php echo form_error('anime_sub_cate'); ?></span>
                            </div>

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" value="<?php echo $anime_id; ?>" id="anime_id_ajax">
                            <button type="button" id="send_cate" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>    
            <div class="col-lg-2">
            </div>
        </div>
    </section>
</div> 
<script src="<?php echo base_url(); ?>assets/admin/js/anime_category.js" type="text/javascript"></script>