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
                        <h3 class="box-title">Add Anime Category</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo base_url(); ?>admin/animecategory/add_anime_category" id="add_anime_category_form" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="required">Anime Category Name:</label>
                                <input type="text" name="anime_category_name" id="anime_category_name" placeholder="Anime Category Name" class="form-control"/>	
                                <span class="error"><?php echo form_error('anime_category_name'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="required">Anime Photo:</label>
                                <input type="file" name="anime_category_photo" id="anime_category_photo"  />	
                                <span class="error"><?php echo form_error('anime_category_photo'); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="required">Episode :</label>
                                <input type="text" name="anime_episode" id="anime_episode" placeholder="Ex : 10"/>	
                            </div>
                            <div class="form-group">
                                <label for="required">Episode Time:</label>
                                <input type="text" name="anime_episode_time" id="anime_episode_time" placeholder="Friday 09:00pm"/>	
                            </div>
                            <div class="form-group">
                                <label for="required">Manga :</label>
                                <input type="text" name="anime_manga" id="anime_manga" placeholder="Ex : 10"/>	
                            </div>
                            <div class="form-group">
                                <label for="required">Manga Time:</label>
                                <input type="text" name="anime_manga_time" id="anime_manga_time" placeholder="Friday 09:00pm"/>	
                            </div>
                            <div class="form-group">
                                <label for="required">Anime Sub Category:</label>
                                <select class="form-group" multiple="" name="anime_sub_cate[]" id="anime_sub_cate">
                                    <option value="discussion">discussion</option>
                                    <option value="manga">manga</option>
                                    <option value="theories">theories</option>
                                    <option value="episode">episode</option>
                                    <option value="review">review</option>
                                    <option value="quotes">quotes</option>
                                </select>	
                                <span class="error"><?php echo form_error('anime_sub_cate'); ?></span>
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

<script src="<?php echo base_url(); ?>assets/admin/js/anime_category.js" type="text/javascript"></script>
