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
                        <h3 class="box-title">Edit League</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo base_url(); ?>edit_league/<?php echo $league_list['leagueimage_id']; ?>" id="edit_league_form" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="required">Select Category :</label>
                                <div class="field-group">
                                    <select name="category_list" id="category_list" class="form-control" >
                                        <option value=""> Choose Category </option>
                                        <?php foreach ($cat_list as $category) { ?>
                                            <option value="<?php echo $category->category_id; ?>" <?php if ($category->category_id == $league_list['category_id']) { ?> selected <?php } ?>> <?php echo $category->category_name; ?> </option>
                                        <?php } ?>
                                    </select>
                                    <span class="error"><?php echo form_error('category_list'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="required">League Name:</label>
                                <input type="text" name="league_img_name" id="league_name" class="form-control" value="<?php echo $league_list['leagueimage_name']; ?>" placeholder="League Name"/>	
                                
                                <span class="error"><?php echo form_error('league_img_name'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="required">Credits:</label>
                                <div class="field">
                                    <input type="text" name="league_img_credits" id="league_img_credits" class="form-control" value="<?php
                                    if ($league_credit) {
                                        echo $league_credit['credit'];
                                    } else {
                                        echo '';
                                    }
                                    ?>"/>	
                                    <?php echo form_error('league_img_name'); ?>
                                </div>

                            </div>
                            <div class="form-group" id="fileupload"  style="<?php
                            if ($league_list['category_id'] == $videoCategory) {
                                echo "display:none";
                            }
                            ?>">
                                <label for="required">Meme Image:</label>
                                <div class="field">
                                    <span class="field"><img alt="" src="<?php echo base_url(); ?>uploads/league/<?php echo $league_list['leagueimage_filename']; ?>" width="150" height="150" ></span>
                                    <div>&nbsp;</div>
                                    <input type="file" name="league_img" id="league_img">	
                                    <input type="hidden" name="league_img_old" id="league_img_old" value="<?php echo $league_list['leagueimage_filename']; ?>">
                                    <span id="img"></span>	
                                </div>
                            </div>
                            <div class="form-group" id="videoupload" style="<?php
                            if ($league_list['category_id'] != $videoCategory) {
                                echo 'display:none';
                            }
                            ?>">
                                <label for="required">Video Link:</label>
                                <div class="field">
                                    <textarea name="videolink"><?php echo $league_list['videoname']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="required">Tags:</label>
                                <div class="field">
                                    <?php
                                    if (isset($league_tags)) {
                                        $i = 0;
                                        $tag = '';
                                        $c = count($league_tags);
                                        foreach ($league_tags as $tags) {
                                            $tag .= $tags['tag'] . ",";
                                        }
                                    }
                                    ?>
                                    <input type="text" name="league_tags" id="league_tags" placeholder="League Tags" class="form-control" value="<?php echo substr($tag, 0, strlen($tag) - 1); ?>"/>	
                                    
                                    <?php echo form_error('league_img_name'); ?>
                                </div>
                            </div>
                            <div id='checkedImgData'>

                            </div>
                            <div class="form-group">
                                <label for="required">Content is not safe for work (sfw) : </label>
                                <?php
                                if ($league_list['league_img_access'] == 1) {
                                    $check = "checked";
                                } else {
                                    $check = "";
                                }
                                ?>
                                <input type="checkbox" name="league_access"  value="1" <?php echo $check; ?>>
                            </div>
                        </div> 
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
<script src="<?php echo base_url(); ?>assets/admin/js/league_list.js" type="text/javascript"></script>
