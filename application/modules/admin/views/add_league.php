<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header with-border">
        <h1>
            <?php echo isset($content_header) ? $content_header : "Leaguememe"; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo isset($left) ? $left : "Leaguememe"; ?></li>
        </ol>
    </section>
    <!--    <hr/> -->
    <section class="content">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add League</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form uniformForm validateForm" action="<?php echo base_url(); ?>add_league" id="add_league_form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                       <div class="col-lg-12"> 
                        <div class="col-lg-3">
                            <label>Select Category :</label>
                            <select name="category_list" id="category_list" class="form-control validate[required]">
                                <?php
                                if (isset($category_list) && !empty($category_list)) {
                                    foreach ($category_list as $category) {
                                        ?>
                                        <option value="<?php echo $category->category_id; ?>"> <?php echo ucwords($category->category_name); ?> </option>
                                        <?php
                                    }
                                } else {
                                    echo '<option>No Category found.</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-lg-4">
                            <label for="required">Number Of Meme:</label>
                            <div>
                                <input class="padding1" type="number" name="league_img_number" min='1' id="league_img_number"/>
                                <button class="btn btn-success btn-circle" type="button" name="goBtn" id="goBtn">GO</button>
                                <p id="nofmeme" style="display: none"></p>
                            </div>
                        </div>
                           <div class="col-lg-5"></div>
                       </div>
                        <div class="col-lg-12">&nbsp;</div>
                        <!--data append here-->
                        <div id="legimgDataId">
                            <div id="legimgDataId2">
                            </div>
                        </div>
                        <div>
                            <p id="loader"></p> 
                        </div>

                        <div style="display: none" id='totalnum'>
                        </div>
                        <div class="actions pull-left ml-3">						
                            <button type="submit" id="imgSubmit" class="btn btn-primary">Submit</button>
                        </div>
                        <!-- / data append here-->
                    </div>
                </form>
            </div>
        </div>
    </section> 
</div>


<script src="<?php echo base_url(); ?>assets/admin/js/upload_leagueimage.js" type="text/javascript"></script>
