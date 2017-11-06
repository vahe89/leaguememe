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
                        <h3 class="box-title">Edit Section</h3>
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
                    <form class="form uniformForm validateForm" action="<?= base_url() ?>edit_section/<?php echo $id; ?>" id="edit_section_form" method="post">

                        <div class="box-body" id="section_main">
                            <div class="form-group">
                                <label>Section Name:</label>
                                <div class="field">
                                    <input type="text" class="form-control" name="section_name" value="<?= $section_name['section_name'] ?>" id='section_name'>
                                        <span class="error" id="err_section_name" style="display: none">Section Name field is reqiured</span>
                                </div>
                            </div>
                            <?php
                            foreach ($section_list as $key => $section) {
                                if ($key !== "1") {
                                    ?>
                                    <hr class="dashed-h">
                                    <?php
                                }
                                ?>
                                    <input type="hidden" value="<?= $section['idd'] ?>" name="section_id[]">
                                <div class="form-group" style="border:1px solid #d2d6de;padding:10px">
                                    <div class="field">
                                        <label>Section Title:</label>
                                        <input type="text" class=" form-control section_title" id="title_<?= $section['idd'] ?>" data-title-id="<?= $section['idd'] ?>" name="ins_title_data[<?= $section['idd'] ?>]" placeholder="Enter Title" value="<?= $section['title'] ?>">
                                        <span class="error" id="err_title_<?= $section['idd'] ?>" style="display: none">Section title field is reqiured</span>
                                    </div>
                                    <br>
                                    <div class="field">
                                        <label>Section Link:</label>
                                        <input type="text" class=" form-control section_link" id="link_<?= $section['idd'] ?>" data-link-id="<?= $section['idd'] ?>" name="ins_link_data[<?= $section['idd'] ?>]" placeholder="Enter Link" value="<?= $section['link'] ?>">
                                        <span class="error" id="err_link_<?= $section['idd'] ?>" style="display: none">Section link field is reqiured.</span>
                                    </div>
                                </div>

                                <?php
                            }
                            ?>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-success">Save</button>
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
<script>
    $(document).ready(function() {
        $("#edit_section_form").submit(function() {
            var error  = 0; 
            $('.error').hide(); 
            if($('#section_name').val() == "" || $('#section_name').val() == " "){
              $("#err_section_name").css('display', 'block');
              error = 1;  
            }
            $(".section_title").each(function(index) {
                var id = $(this).attr('data-title-id');
                if ($(this).val() === " " || $(this).val() == "") {
                    $("#err_title_" + id).css('display', 'block');
                    error = 1;
                }
            });
            $(".section_link").each(function(index) {
                var id = $(this).attr('data-link-id');
                if ($(this).val() === " " || $(this).val() == "") {
                    $("#err_link_" + id).css('display', 'block');
                    error = 1;
                }
            });
            if(error == 1){
                return false;
            }else{
                return true;
            }

        }); 

    });
</script>
