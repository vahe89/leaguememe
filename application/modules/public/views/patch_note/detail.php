<meta charset="utf-8"/>
<style>
    div.background-cover {
        display: none;
    }
</style>

<?php
?>
<section style="background-color:#eee;" id="single_post">
    <div class="container no-padding">
        <div class="single-panel single-panel-view" style="margin-top: 90px;" >
            <div class="col-md-8 col-sm-12 no-padding">

                <div class="col-md-12 col-xs-12 no-padding">

                    <div class="col-md-9 col-xs-9 no-padding">
                        <div class="media info-avatar avatar-view">
                            <div class="media-left">
                                <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>assets/public/img/default_profile.jpeg" alt="profile pic">
                            </div>
                            <div class="media-body">

                                <h5 class="text-uppercase">Admin</h5>

                                <span class="minute" style="display: inline;" data-livestamp="<?php echo strtotime($patchDetail->datecreated); ?>"></span>
                            </div>
                        </div>
                    </div> 
                </div>

                <!--avatar -->
                <div class="col-md-12 wraper-view">


                    <h3 style="padding-left: 0px;"><a href="javascript:void(0);"><?php echo $patchDetail->patch_title; ?></a></h3>
                    <?php
                    foreach ($pachSections as $psec) {
//                        echo "<pre>";
//                        print_r($psec);
//                        exit;
                        ?>
                        <!--<div style="border: 1px solid lightgray">-->
                        <p class="description-view-posting" style="margin-left:66px">
                        <div style="margin-left: 2%; text-decoration: underline;"><?php echo $psec->patch_name ?></div>
    <!--                            <div><?php echo $psec->patch_description ?></div>-->
                        </p>
                        <?php
                        $img_slider = explode(",", $psec->file);

                        foreach ($img_slider as $img) {
                            if (!empty($img)) {
                                ?>
                                <div class="col-md-12" style="margin-bottom: 20px">
                                    <a href="<?= base_url() ?>uploads/patch_notes/<?= $img ?>" class="image1" rel="patch_group"  src="<?= base_url() ?>uploads/patch_notes/<?= $img ?>"> 
                                        <img class="img-responsive meme-view"  src="<?= base_url() ?>uploads/patch_notes/<?= $img ?>" alt="<?php echo $img ?>" >
                                    </a>
                                </div>
                                <?php
                            } else {
                                echo "<br>No Patch notes image found";
                            }
                        }
                        ?>
                        <div style="margin-left: 2%;"><?php echo $psec->patch_description ?></div>
                        <hr>
                        <!--</div>-->
                    <?php }
                    ?> 
<!--                    <p class="description-view-posting" style="margin-left:66px">
                    <?php //$patch->patch_description  ?>
                </p>-->

                    <!--like-->
                    <div class="link-comment" style="padding: 0px 55px;">

                        <?php
                        $total_point = ((int) $patchDetail->total_victory) - ((int) $patchDetail->total_defeat);
                        ?>
                        <a id="point_<?php echo $patchDetail->main_id; ?>" href="">
                            <?php echo $total_point; ?>  </a> <a>Likes</a>  &nbsp; - &nbsp;
                        <a id="toggler-<?php echo $patchDetail->main_id . "yy"; ?>" href="#"> <?php
                            $total_comment = $patchDetail->total_comment;
                            if (!empty($total_comment)) {
                                echo $total_comment;
                            } else {
                                echo '0';
                            }
                            ?> </a> <a>Comments</a>   


                    </div>

                    <!-- vote -->
                    <div class="wraper-share">
                        <ul class="horizontal-vote">
                            <li class="horizontal-vote-up" style="width: 102px;">
                                <?php
                                if (isset($userid) && !empty($userid) && isset($victory[$patchDetail->main_id]) && !empty($victory[$patchDetail->main_id])) {
                                    if (in_array($userid, $victory[$patchDetail->main_id])) {
                                        ?>
                                        <a onClick = "onvictory(this.id);" id = "<?php echo $patchDetail->main_id; ?>" style = "cursor: pointer" rel = "<?php echo $patchDetail->main_id; ?>">
                                            <i id="victory_img_<?php echo $patchDetail->main_id; ?>" class = "fa fa-arrow-up fa-lg victory_single_active"></i>
                                            <span>Victory</span>
                                        </a>                                                                                                                               
                                        <?php
                                    } else {
                                        ?>
                                        <a onClick = "onvictory(this.id);" id = "<?php echo $patchDetail->main_id; ?>" style = "cursor: pointer" rel = "<?php echo $patchDetail->main_id; ?>">
                                            <i id="victory_img_<?php echo $patchDetail->main_id; ?>" class = "fa fa-arrow-up fa-lg victory_single_active"></i>
                                            <span>Victory</span>
                                        </a> 
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <a onClick = "onvictory(this.id);" id = "<?php echo $patchDetail->main_id; ?>" style = "cursor: pointer" rel = "<?php echo $patchDetail->main_id; ?>">
                                        <i id="victory_img_<?php echo $patchDetail->main_id; ?>" class = "fa fa-arrow-up fa-lg "></i>
                                        <span>Victory</span>
                                    </a> 
                                    <?php
                                }
                                ?>

                            </li>

                            <li class="horizontal-vote-down">
                                <?php
                                if (isset($userid) && !empty($userid) && isset($defact[$patchDetail->main_id]) && !empty($defact[$patchDetail->main_id])) {
                                    if (in_array($userid, $defact[$patchDetail->main_id])) {
                                        ?>
                                        <a onClick="ondefeat(this.id,<?php echo $patchDetail->main_id; ?>)" id="<?php echo $patchDetail->main_id; ?>" style="cursor: pointer" rel="<?php echo $patchDetail->main_id; ?>" class = "disvote"><i id="defeat_img_<?php echo $patchDetail->main_id; ?>" class = "fa fa-arrow-down fa-lg victory_single_active"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a onClick="ondefeat(this.id,<?php echo $patchDetail->main_id; ?>)" id="<?php echo $patchDetail->main_id; ?>" style="cursor: pointer" rel="<?php echo $patchDetail->main_id; ?>" class = "disvote"><i id="defeat_img_<?php echo $patchDetail->main_id; ?>" class = "fa fa-arrow-down fa-lg"></i></a>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <a onClick="ondefeat(this.id,<?php echo $patchDetail->main_id; ?>)" id="<?php echo $patchDetail->main_id; ?>" style="cursor: pointer" rel="<?php echo $patchDetail->main_id; ?>" class = "disvote"><i id="defeat_img_<?php echo $patchDetail->main_id; ?>" class = "fa fa-arrow-down fa-lg"></i></a>
                                    <?php
                                }
                                ?>

                            </li>
                        </ul>

                        <!-- others btn -->
                        <div class="others-btn">
                            <img src="<?php echo base_url(); ?>assets/public/img/others-btn.png">
                        </div>

                        <div class="social-share social-btn" style="padding: 0px; padding-left: 10px;">
                            <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank" class="fb-bg medium-btn mar-r-5" style="padding: 7.7px 11px;">
                                <i class="fa fa-facebook"></i> share
                            </a>

                            <a  data-count="vertical" data-via="your_screen_name" data-hashtags="mayur8189" href="https://twitter.com/share" class="tw-bg medium-btn" style="padding: 7.7px 11px;" target="_blank">
                                <i class="fa fa-twitter"></i> share
                            </a>
                        </div>
                    </div>

                </div>
                <!-- wraper-view -->
                <div class="col-md-12"><ins class="adsbygoogle"
                                            style="display:inline-block;width:728px;height:90px"
                                            data-ad-client="ca-pub-9746555787553362"
                                            data-ad-slot="1317445683"></ins></div>
                <div class="tab-comment">
                    <ul id="pop" class="nav pop-tabs pop-view" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#popular" role="tab" data-toggle="tab" aria-controls="popular" aria-expanded="true">Popular</a>
                        </li>
                        <li role="presentation" class="mar-lm-5">
                            <a href="#news" role="tab" data-toggle="tab" aria-controls="news" id="fresh1">News</a>
                        </li> 
                        <li style="float:right;">
                            <div class="comment-status" id="toggler-<?php echo $patchDetail->main_id . "y"; ?>">

                                <span class="count">
                                    <?php
                                    $total_comment = $patchDetail->total_comment;

                                    if (!empty($total_comment)) {
                                        echo $total_comment;
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </span> Comments
                            </div>
                        </li>
                    </ul>
                    <hr/>

                </div>

                <div class="animation_image col-md-12" align="center"><img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif" class="img-responsive" style="width:40px"></div>
                <div class="tab-content">
                    <div class="text-comment" id="cmtclick">
                        <div class="wrap-avatar-comment">
                            <?php
                            if (isset($userdetail['user_image']) && !empty($userdetail['user_image'])) {
                                ?>
                                <a href="#">
                                    <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>uploads/users/<?php echo $userdetail['user_image']; ?>" alt="">
                                </a>
                                <?php
                            } else {
                                ?>
                                <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>assets/public/img/default_profile.jpeg" alt="profile pic">
                                <?php
                            }
                            ?>

                        </div>
                        <?php if ($this->session->userdata('user_id')) { ?>

                            <!--<form class="" method="post" id="upload_form" enctype="multipart/form-data">-->
                            <div class="input-text-comment" id="enterfield<?php echo $patchDetail->main_id; ?>">
                                <input type="hidden" name="league_image_id" value="<?php echo $patchDetail->main_id; ?>">
                                <div class="show-upload" style="display: none">
                                    <input type="file"  name="userfile" size="20" id="make_click" onchange="readURL(this)"/>
                                </div>

                                <div class="preview_image" style="display: none">
                                    <div id="rem_1">
                                        <img id="show" src="" alt="" width="120px;" height="120px;" style="margin-bottom: 5px; margin-top: 5px;" />
                                        <i class="fa fa-remove remove" href="javascript:void(0);" style="margin-top: -72px; margin-right: 0px; margin-left: -4px; color: red; cursor: pointer; cursor: hand;"></i>
                                    </div>
                                </div>


                                <textarea class="form-control form-comment textarea-box" id="addCommentBox<?php echo $patchDetail->main_id; ?>" name="commentss" rows="3" placeholder="What's on your mind"></textarea>

                                <div class="post-comment">



                                    <div class="another-post">
                                        <a href="#" class="photo"> 
                                            <i class="fa fa-picture-o image_upload"></i> 
                                        </a> 
                                        <button type="submit" class="btn pull-right small-btn green-bg comment-btn commentPostBtn" id="<?php echo $patchDetail->main_id; ?>">
                                            Comment
                                        </button>
                                    </div>
                                </div>

                                <span id="wordcount<?php echo $patchDetail->main_id; ?>" class="value-box">1000</span>
                                <div class="added-image"></div>
                            </div>
                            <!--</form>-->
                            <!--end-->

                        <?php } else {
                            ?>
                            <div class="input-text-comment" id="enterfield<?php echo $patchDetail->main_id; ?>">
                                <form action="">
                                    <textarea class="form-control form-comment textarea-box" readonly="" rows="3"name="commentss" required="" id="cmtbox" placeholder="What's on your mind"></textarea>

                                    <div class="post-comment">

                                        <div class="added-image"></div>

                                        <div class="another-post">
                                            <a href="#" class="photo"> 
                                                <i class="fa fa-picture-o image_upload"></i> 
                                            </a> 
                                            <button type="submit" class="btn pull-right small-btn green-bg comment-btn commentPostBtn" id="<?php echo $patchDetail->main_id; ?>">
                                                Comment
                                            </button>
                                        </div>
                                    </div>
                                    <p class="value-box">1000</p>

                                </form>
                            </div>

                        <?php } ?>

                    </div>
                    <!-- popular-->
                    <div role="tabpanel" class="tab-pane active" id="popular" style="width: 100%;">
                        <div  id="scroll_wrap_<?php echo $patchDetail->main_id; ?>">
                            <div id="cmt_<?php echo $patchDetail->main_id ?>">
                            </div>
                        </div>
                        <div id="comment_input"></div>
                    </div>
                    <!-- tab panel -->

                    <div role="tabpanel" class="tab-pane" id="news" style="width: 100%;">

                        <div id="scroll_wrap_<?php echo $patchDetail->main_id; ?>">
                            <div   id="ct_<?php echo $patchDetail->main_id; ?>">
                            </div>
                        </div>
                        <div id="comment_input"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 ads-view">
                <?php
                echo $this->load->view('template/right_sidebar');
                ?>
            </div>

        </div>
    </div>
</section>

<script>
    var single_id = "<?php echo $patchDetail->main_id; ?>";
</script>

<script>function fbs_click() {
        u = location.href;
        t = document.title;
        window.open('http://www.facebook.com/sharer.php?u=' + encodeURIComponent(u) + '&t=' + encodeURIComponent(t), 'sharer', 'toolbar=0,status=0,width=626,height=436');
        return false;
    }</script>
<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>

<script src="<?php echo base_url(); ?>assets/public/js/patch_single.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/public/js/jquery.mCustomScrollbar.concat.min.js"></script>  
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script>

    $(document).ready(function() {
        $("a[rel=patch_group]").fancybox({'transitionIn': 'elastic',
            'transitionOut': 'elastic',
            'speedIn': 600,
            'speedOut': 200, });

        $('#login_close').click(function() {
            $('#login').removeClass('in');
            $('#login').hide();
            $('#modal_backdrop').remove();
        });
        $('#cmtbox').focus(function() {

            var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
            $('#body_id').append(html);
            $('#login').addClass('in');
            $('#login').show();
        });
        $('#search').on('keypress', function(event) {
            if (event.which == 13) {
                $('#search_form_name').submit();
            }
        });

    });
</script> 

<script>
    !function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
        if (!d.getElementById(id)) {
            js = d.createElement(s);
            js.id = id;
            js.src = p + '://platform.twitter.com/widgets.js';
            fjs.parentNode.insertBefore(js, fjs);
        }
    }(document, 'script', 'twitter-wjs');
</script>

<script>
    function anime_report() {
        var report = $('.radio-report:checked').val();
        var poll_id = "<?php echo $patchDetail->main_id; ?>";
        var link = $(".report-url").val();

        $.ajax({
            type: 'POST',
            url: base_url + 'public/home/anime_report',
            dataType: 'json',
            data: {
                AccountType: report,
                poll_id: poll_id,
                link: link
            },
            success: function(data) {
                if (data.success == true) {
                    $('#report').modal('hide');
                } else if (data.modal == true) {

                } else {
                    $("#report_alert").show();
                    $("#report_alert").html('<strong>' + data.msg + '</strong>');
//                    alert("error");
                }
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        $(".image_upload").click(function(e) {
            e.preventDefault();
            $('#make_click').click();

        });
    });

</script>

<script>
    function readURL(input) {
        abc = '';
        if (input.files && input.files[0]) {

            abc += 1;

            var reader = new FileReader();

            $('.added-image').html("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src='' width='120px;' height='120px;' style='margin-bottom: 8px; margin-top: 8px; margin-left: 8px; display: inline;'/></div>");

            reader.onload = imageIsLoaded;
            reader.readAsDataURL(input.files[0]);
            $("#abcd" + abc).append($('<i class="fa fa-remove remove" style="margin-top: -75px; margin-right: 0px; margin-left: -2px; color: red; cursor: pointer; cursor: hand;"></i>').click(function() {
                $("#abcd" + abc).remove();
                $("#previewimg" + abc).val("");
                $('#make_click').val("");
            })
                    );
        }
    }

    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    }

</script>

