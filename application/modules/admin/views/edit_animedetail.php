
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
                <div id="success_alert" style="display: none" class="text-center alert alert-success"></div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Anime Detail</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->


                    <form role="form" action="<?php echo base_url(); ?>edit-animedetail/<?php echo $anime_data['anime_id']; ?>" id="edit_animedetail_form" method="post" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="required">Anime Name:</label>
                                <input type="text" name="anime_img_name" id="anime_img_name" class="form-control" value="<?php echo $anime_data['anime_name']; ?>" placeholder="Anime Name" readonly/>	

                            </div>
                            
                            <div class="form-group">
                                <label for="required">Score:</label>
                                <input type="text" name="anime_score" id="anime_score" class="form-control" value="<?php
                                if (!empty($result)) {
                                    echo $result['score'];
                                } else {
                                    echo "";
                                };
                                ?>" placeholder="Anime Score"/>	

                                <span class="error"><?php echo form_error('anime_score'); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="required">Current Episode:</label>
                                <input type="text" name="anime_episode" id="anime_episode" class="form-control" value="<?php
                                if (!empty($result)) {
                                    echo $result['current_episode'];
                                } else {
                                    echo "";
                                }
                                ?>" placeholder="Current Episode"/>	

                                <span class="error"><?php echo form_error('anime_episode'); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="required">Current Manga:</label>
                                <input type="text" name="anime_manga" id="anime_manga" class="form-control" value="<?php
                                if (!empty($result)) {
                                    echo $result['current_manga'];
                                } else {
                                    echo "";
                                }
                                ?>" placeholder="Current Manga"/>	

                                <span class="error"><?php echo form_error('anime_manga'); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="required">Status:</label>
                                <div class="field">
                                    <input type="text" name="league_img_status" id="league_img_status" class="form-control" value="<?php
                                    if (!empty($result)) {
                                        echo $result['status'];
                                    } else {
                                        echo "";
                                    };
                                    ?>"/>	

                                    <span class="error"><?php echo form_error('league_img_status'); ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="required">Synonyms:</label>
                                <div class="field">
                                    <input type="text" name="anime_synonyms" id="anime_synonyms" class="form-control" value="<?php
                                    if (!empty($result)) {
                                        echo $result['synonyms'];
                                    } else {
                                        echo "";
                                    };
                                    ?>" placeholder="Give Synonyms"/>	

                                    <span class="error"><?php echo form_error('anime_synonyms'); ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="required">English:</label>
                                <div class="field">
                                    <input type="text" name="anime_english" id="anime_english" class="form-control" value="<?php
                                    if (!empty($result)) {
                                        echo $result['english'];
                                    } else {
                                        echo "";
                                    };
                                    ?>" placeholder="English Name"/>	

                                    <span class="error"><?php echo form_error('anime_english'); ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="required">Japanese:</label>
                                <div class="field">
                                    <input type="text" name="anime_japanese" id="anime_japanese" class="form-control" value="<?php
                                    if (!empty($result)) {
                                        echo $result['japanese'];
                                    } else {
                                        echo "";
                                    };
                                    ?>" placeholder="Japanese Name"/>	

                                    <span class="error"><?php echo form_error('anime_japanese'); ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="required">Episode:</label>
                                <div class="field">
                                    <input type="text" name="episode_no" id="episode_no" class="form-control" value="<?php
//                                    if (!empty($result)) {
//                                        echo $result['japanese'];
//                                    } else {
//                                        echo "";
//                                    };
                                    ?>" placeholder="Episode No."/>	

                                    <span class="error"><?php echo form_error('episode_no'); ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="required">Aired:</label>
                                <div class="field">
                                    <input type="text" name="anime_aired" id="anime_aired" class="form-control" value="<?php
                                    if (!empty($result)) {
                                        echo date("Y-m-d", strtotime($result['aired']));
                                    } else {
                                        echo "";
                                    }
                                    ?>"/>	

                                    <span class="error"><?php echo form_error('anime_aired'); ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="required">Genres:</label>
                                <div class="field">
                                    <input type="text" name="anime_genres" id="anime_genres" class="form-control" value="<?php
                                    if (!empty($result)) {
                                        echo $result['jenres'];
                                    } else {
                                        echo "";
                                    };
                                    ?>"/>	

                                    <span class="error"><?php echo form_error('anime_genres'); ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="required">Duration:</label>
                                <div class="field">
                                    <input type="text" name="anime_duration" id="anime_duration" class="form-control" placeholder="00:00:00" value="<?php
                                    if (!empty($result)) {
                                        echo $result['duration'];
                                    } else {
                                        echo "";
                                    };
                                    ?>"/>	

                                    <span class="error"><?php echo form_error('anime_duration'); ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="required">Rating:</label>
                                <div class="field">
                                    <input type="text" name="anime_rating" id="anime_rating" class="form-control" value="<?php
                                    if (!empty($result)) {
                                        echo $result['rating'];
                                    } else {
                                        echo "";
                                    };
                                    ?>"/>	

                                    <span class="error"><?php echo form_error('anime_rating'); ?></span>
                                </div>
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



<script type="text/javascript">
    $(document).ready(function () {

        var base_url = "<?php echo base_url(); ?>";
//        alert(base_url);
        $("#edit_animedetail_form").validate({
            rules: {
                anime_score: {
                    required: true,
                    digits: true,
                    maxlength: 1
                },
                anime_episode: {
                    required: true,
                    digits: true
                },
                anime_manga: {
                    required: true,
                    digits: true
                },
                league_img_status: {
                    required: true,
                },
                anime_synonyms: {
                    required: true,
                },
                anime_english: {
                    required: true,
                },
                anime_japanese: {
                    required: true
                },
                episode_no: {
                    required: true
                },
                anime_aired: {
                    required: true
                },
                anime_genres: {
                    required: true
                },
                anime_duration: {
                    required: true,
                },
                anime_rating: {
                    required: true,
                    digits: true
                },
            },
            messages: {
                anime_score: {
                    required: "Please Enter Score",
                    digits: "Only digits are allow"
                },
                anime_episode: {
                    required: "Please Enter Episode",
                    digits: "Only digits are allow"
                },
                anime_manga: {
                    required: "Please Enter Manga",
                    digits: "Only digits are allow"

                },
                league_img_status: {
                    required: "Please Enter Password",
                },
                anime_synonyms: {
                    required: "Please Enter Synonyms",
                },
                anime_english: {
                    required: "Please Describe In English",
                },
                anime_japanese: {
                    required: "Please Describe In Japanese"
                },
                episode_no: {
                    required: "Please Enter Episode No."
                },
                anime_aired: {
                    required: "Please Write Aired"
                },
                anime_genres: {
                    required: "Please Enter Genres"
                },
                anime_duration: {
                    required: "Please Select Time Duration",
                },
                anime_rating: {
                    required: "Please Give Rating",
                    digits: "Only digits are allow"
                },
            },
            submitHandler: function (form) {

                if ($(form).valid()) {
                    var data = $("#edit_animedetail_form").serialize();
                    $.ajax({
                        url: base_url + 'admin/animecategory/edit_anime_detail/<?php echo $anime_data['anime_id']; ?>',
                        type: 'post',
                        data: data,
                        success: function (data) {
                            var msg = "your data has been successfuly updated";
                            $('#success_alert').show();
                            $('#success_alert').html(msg);
                        }
                    });
                }
            }
        });
    });
</script>

<script>
    $(function () {

        $('#anime_aired').datepicker({format: 'yyyy-mm-dd'});
//        $('#anime_duration').datepicker({format: 'yyyy-mm-dd'});

    });
</script>



