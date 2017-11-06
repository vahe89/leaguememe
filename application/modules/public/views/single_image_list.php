<style>
    div.background-cover {
        display: none;
    }
</style>
<?php
foreach ($league_details as $anim_img) {
    ?>
    <section style="background-color:#eee;" id="single_post">
        <div class="container no-padding">
            <div class="single-panel single-panel-view" style="margin-top: 90px;" >
                <div class="col-md-8 col-sm-12 no-padding">

                    <div class="col-md-12 col-xs-12 no-padding">

                        <div class="col-md-9 col-xs-9 no-padding">
                            <div class="media info-avatar avatar-view">
                                <div class="media-left">
                                    <?php
                                    if (isset($anim_img->user_image)) {
                                        ?>
                                        <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>uploads/users/<?php echo $anim_img->user_image; ?>" alt="<?php echo $anim_img->user_name; ?>">
                                        <?php
                                    } else {
                                        ?>
                                        <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>assets/public/img/pro-pic.png" alt="profile pic">
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="media-body">
                                    <a>
                                        <h5 class="text-uppercase"><?php echo isset($anim_img->user_name) ? $anim_img->user_name : "Admin"; ?></h5>
                                    </a>
                                    <span class="minute" style="display: inline;" data-livestamp="<?php echo strtotime($anim_img->leagueimage_timestamp); ?>"></span>
                                    <span class="minute" style="display: inline;">to <a href="javascript:void(0)" class="minute">  /a/onepiece</a></span>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($next_image) && $next_image != "0") { ?>
                            <div class="col-md-3 col-xs-3 wrap-next no-padding" id="single_next_btn">
                                <a class="btn btn-red btn-view  ">Next</a>
                            </div>
                        <?php } ?>
                    </div>

                    <!--avatar -->
                    <div class="col-md-12 wraper-view">
                        <?php
                        $category = $anim_img->category_name;
                        if (isset($anim_img->total_images_parent)) {
                            if ($anim_img->total_images_parent > 0) {
                                if ($category != 'Video') {

                                    $al = explode(",", $anim_img->le_parentid);
                                    $al_img = explode(",", $anim_img->le_parentimg);
                                    $al_name = explode(",", $anim_img->le_parentname);
                                    $al_desc = explode("^^%%^^", $anim_img->le_description);
                                    ?>
                                    <!--                                    <div class="wrapper-view-posting">-->
                                    <h3><a href="javascript:void(0);"><?php echo $anim_img->leagueimage_name; ?></a></h3>

                                    <a href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>" >
                                        <img class="img-responsive meme-view" alt="ace" src="<?php echo base_url(); ?>uploads/league/<?php echo $anim_img->leagueimage_filename; ?>"   >
                                    </a>
                                    <p class="description-view-posting" style="margin-left:66px"> 
                                        <?php echo $anim_img->leagueimage_description; ?>
                                    </p>
                                    <!--</div>-->
                                    <?php
                                    $more = count($al) - 4;
                                    for ($l = 0; $l < count($al); $l++) {
                                        $img_id = trim($al[$l], "^^%%^^");
                                        $img = trim($al_img[$l], "^^%%^^");
                                        $name = trim($al_name[$l], "^^%%^^");
                                        $desc = trim($al_desc[$l], ",");
                                        if (isset($img_id) && !empty($img_id)) {
                                            ?>
                                            <!--<div class="wrapper-view-posting">-->
                                            <h3><a href="javascript:void(0);"><?php echo $name; ?></a></h3>
                                            <a href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>">
                                                <img class="img-responsive meme-view" src="<?php echo base_url(); ?>uploads/league/<?php echo $img; ?>">
                                            </a>
                                            <p class="description-view-posting" style="margin-left:66px">
                                                <?php echo $desc; ?>
                                            </p>
                                            <!--</div>-->
                                            <?php
                                        }
                                    }
                                    ?> 

                                    <?php
                                } else if ($category == 'Video') {
                                    ?>
                                    <!--<div class="wrapper-view-posting">-->
                                    <h3><a href="javascript:void(0);"><?php echo $anim_img->leagueimage_name; ?></a></h3>
                                    <a class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>">
                                        <div class="meme-img col-sm-12" ><?php echo $anim_img->leagueimage_filename; ?></div>
                                    </a>
                                    <!--</div>-->
                                    <?php
                                }
                                ?>

                                <?php
                            } else {
                                if ($category != 'Video') {
                                    $ext = array();
                                    $ext = explode(".", $anim_img->leagueimage_filename);
                                    if ($ext[1] == "gif") {
                                        ?>
                                        <div class="clear"></div>
                                        <div id="video_<?php echo $anim_img->leagueimage_id; ?>" class="video">
                                            <!--<video width="100%" controls=""id="v<?php /* echo $anim_img->leagueimage_id; */ ?>"  loop="">
                                                <source src="<?php /* echo base_url(); */ ?>uploads/league/mp4/<?php /* echo $anim_img->videoname; */ ?>" type="video/webm">
                                            </video>-->
                                            <!--<img src="<?php /* echo base_url(); */ ?>uploads/league/<?php /* echo $anim_img->leagueimage_filename; */ ?>" />
                                            <span class="play">Gif</span>-->
                                            <!--<div class="wrapper-view-posting">-->
                                            <h3><a href="javascript:void(0);"><?php echo $anim_img->leagueimage_name; ?></a></h3>
                                            <a class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>">
                                                <img  class="img-responsive meme-view" src="<?php echo base_url(); ?>uploads/league/<?php echo $anim_img->leagueimage_filename; ?>" alt="<?php echo $anim_img->leagueimage_name; ?>"  >
                                            </a>
                                            <!--</div>-->
                                        </div>

                                        <!--meme-img-->
                                        <?php
                                    } else {
                                        ?>
                                        <!--<div class="wrapper-view-posting">-->
                                        <h3><a href="javascript:void(0);"><?php echo $anim_img->leagueimage_name; ?></a></h3>
                                        <a class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>"> 
                                            <img class="img-responsive meme-view"  src="<?php echo base_url(); ?>uploads/league/<?php echo $anim_img->leagueimage_filename; ?>" alt="<?php echo $anim_img->leagueimage_name; ?>"  >
                                        </a>
                                        <!--</div>-->
                                        <?php
                                    }
                                } else if ($category == 'Video') {
                                    ?>
                                    <!--<div class="wrapper-view-posting">-->
                                    <h3><a href="javascript:void(0);"><?php echo $anim_img->leagueimage_name; ?></a></h3>
                                    <a class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>">
                                        <div class="meme-img col-sm-12" ><?php echo $anim_img->leagueimage_filename; ?></div>
                                    </a>
                                    <!--</div>-->
                                    <?php
                                }
                            }
                        }
                        ?>




                        <!--like-->
                        <div class="link-comment" style="padding: 0px 55px;">

                            <?php
                            $total_point = ((int) $anim_img->total_victory) - ((int) $anim_img->total_defeat);
                            ?>
                            <a id="point_<?php echo $anim_img->leagueimage_id; ?>" href="">
                                <?php echo $total_point; ?>  </a> <a>Likes</a>  &nbsp; - &nbsp;
                            <a id="toggler-<?php echo $anim_img->leagueimage_id . "yy"; ?>" href="#"> <?php
                                $total_comment = $anim_img->total_comment;
                                if (!empty($total_comment)) {
                                    echo $total_comment;
                                } else {
                                    echo '0';
                                }
                                ?> </a> <a>Comments</a>   

                            <?php if ($this->session->userdata('user_id')) { ?>
                                <a data-toggle="modal" href="javascript:void(0);" data-target="#report" style="float: right;">Report</a>
                            <?php } else { ?>
                                <a data-toggle="modal" href="javascript:void(0);" data-target="#login" id="login_click" style="float: right;">Report</a>
                            <?php } ?>

                        </div>

                        <!-- vote -->
                        <div class="wraper-share">
                            <ul class="horizontal-vote">
                                <li class="horizontal-vote-up">
                                    <?php
                                    if (isset($userid) && !empty($userid) && isset($victory[$anim_img->leagueimage_id]) && !empty($victory[$anim_img->leagueimage_id])) {
                                        if (in_array($userid, $victory[$anim_img->leagueimage_id])) {
                                            ?>
                                            <a onClick = "onvictory(this.id);" id = "<?php echo $anim_img->leagueimage_id; ?>" style = "cursor: pointer" rel = "<?php echo $anim_img->leagueimage_id; ?>">
                                                <i id="victory_img_<?php echo $anim_img->leagueimage_id; ?>" class = "fa fa-arrow-up fa-lg victory_single_active"></i>
                                                <span>SUGOI</span>
                                            </a>                                                                                                                               
                                            <?php
                                        } else {
                                            ?>
                                            <a onClick = "onvictory(this.id);" id = "<?php echo $anim_img->leagueimage_id; ?>" style = "cursor: pointer" rel = "<?php echo $anim_img->leagueimage_id; ?>">
                                                <i id="victory_img_<?php echo $anim_img->leagueimage_id; ?>" class = "fa fa-arrow-up fa-lg victory_single_active"></i>
                                                <span>SUGOI</span>
                                            </a> 
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <a onClick = "onvictory(this.id);" id = "<?php echo $anim_img->leagueimage_id; ?>" style = "cursor: pointer" rel = "<?php echo $anim_img->leagueimage_id; ?>">
                                            <i id="victory_img_<?php echo $anim_img->leagueimage_id; ?>" class = "fa fa-arrow-up fa-lg "></i>
                                            <span>SUGOI</span>
                                        </a> 
                                        <?php
                                    }
                                    ?>

                                </li>

                                <li class="horizontal-vote-down">
                                    <?php
                                    if (isset($userid) && !empty($userid) && isset($defact[$anim_img->leagueimage_id]) && !empty($defact[$anim_img->leagueimage_id])) {
                                        if (in_array($userid, $defact[$anim_img->leagueimage_id])) {
                                            ?>
                                            <a onClick="ondefeat(this.id,<?php echo $anim_img->leagueimage_id; ?>)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>" class = "disvote"><i id="defeat_img_<?php echo $anim_img->leagueimage_id; ?>" class = "fa fa-arrow-down fa-lg victory_single_active"></i></a>
                                            <?php
                                        } else {
                                            ?>
                                            <a onClick="ondefeat(this.id,<?php echo $anim_img->leagueimage_id; ?>)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>" class = "disvote"><i id="defeat_img_<?php echo $anim_img->leagueimage_id; ?>" class = "fa fa-arrow-down fa-lg"></i></a>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <a onClick="ondefeat(this.id,<?php echo $anim_img->leagueimage_id; ?>)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>" class = "disvote"><i id="defeat_img_<?php echo $anim_img->leagueimage_id; ?>" class = "fa fa-arrow-down fa-lg"></i></a>
                                        <?php
                                    }
                                    ?>

                                </li>
                            </ul>

                            <!-- others btn -->
                            <div class="others-btn">
                                <img src="<?php echo base_url(); ?>assets/public/img/others-btn.png">
                            </div>
                            <!--social share -->
                            <!--<div class="social-share">
                                <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank" class="btn-fb-share">
                                    <span>Share</span>
                                </a>
                                <a data-count="vertical" data-via="your_screen_name" data-hashtags="mayur8189" href="https://twitter.com/share"  class="btn-tt-share">
                                    <span>Share</span>
                                </a>
                            </div>-->
                            
                            <div class="social-share social-btn" style="padding: 5px; padding-left: 10px;">
                                <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank" class="fb-bg medium-btn mar-r-5">
                                    <i class="fa fa-facebook"></i> share
                                </a>

                                <a  data-count="vertical" data-via="your_screen_name" data-hashtags="mayur8189" href="https://twitter.com/share" class="tw-bg medium-btn">
                                    <i class="fa fa-twitter"></i> share
                                </a>
                            </div>
                        </div>

                        <div class="hastag-view">
                            <?php
                            $tags = isset($anim_img->tags) ? $anim_img->tags : '';
                            if (!empty($tags)) {
                                $pieces = explode(" ", $tags);
                                foreach ($pieces as $tag) {
                                    $tag_name = str_replace(" ", "-", $tag);
                                    ?>
                                    <a class = "btn btn-grey" href = "<?php echo base_url(); ?>tag/<?php echo urlencode($tag_name); ?>" id="text_decoration_none" role = "button"><?php echo $tag; ?></a>
                                    <?php
                                }
                            }
                            ?>

                        </div>

                    </div>
                    <!-- wraper-view -->

                    <div class="tab-comment">
                        <ul id="pop" class="nav pop-tabs pop-view" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#popular" role="tab" data-toggle="tab" aria-controls="popular" aria-expanded="true">Popular</a>
                            </li>
                            <li role="presentation" class="mar-lm-5">
                                <a href="#news" role="tab" data-toggle="tab" aria-controls="news" id="fresh1">News</a>
                            </li>
                            <li role="presentation" class="mar-lm-5">
                                <a href="#old" role="tab" data-toggle="tab" aria-controls="old">Old</a>
                            </li>
                            <li style="float:right;">
                                <div class="comment-status" id="toggler-<?php echo $anim_img->leagueimage_id . "y"; ?>">

                                    <span class="count">
                                        <?php
                                        $total_comment = $anim_img->total_comment;
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
                                if (isset($userdetail['user_image'])) {
                                    ?>
                                    <a href="#">
                                        <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>uploads/users/<?php echo $userdetail['user_image']; ?>" alt="">
                                    </a>
                                    <?php
                                } else {
                                    ?>
                                    <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>assets/public/img/luffy.png" alt="profile pic">
                                    <?php
                                }
                                ?>

                            </div>
                            <?php if ($this->session->userdata('user_id')) { ?>

                                <!--<form class="" method="post" id="upload_form" enctype="multipart/form-data">-->
                                <div class="input-text-comment" id="enterfield<?php echo $anim_img->leagueimage_id; ?>">
                                    <input type="hidden" name="league_image_id" value="<?php echo $anim_img->leagueimage_id; ?>">
                                    <div class="show-upload" style="display: none">
                                        <input type="file"  name="userfile" size="20" id="make_click" onchange="readURL(this)"/>
                                    </div>

                                    <div class="preview_image" style="display: none">
                                        <div id="rem_1">
                                            <img id="show" src="" alt="" width="120px;" height="120px;" style="margin-bottom: 5px; margin-top: 5px;" />
                                            <i class="fa fa-remove remove" href="javascript:void(0);" style="margin-top: -72px; margin-right: 0px; margin-left: -4px; color: red; cursor: pointer; cursor: hand;"></i>
                                        </div>
                                    </div>


                                    <textarea class="form-control form-comment textarea-box" id="addCommentBox<?php echo $anim_img->leagueimage_id; ?>" name="commentss" rows="3" placeholder="What's on your mind"></textarea>

                                    <div class="post-comment">

                                        

                                        <div class="another-post">
                                            <a href="#" class="photo"> 
                                                <i class="fa fa-picture-o image_upload"></i> 
                                            </a> 
                                            <button type="submit" class="btn pull-right small-btn green-bg comment-btn commentPostBtn" id="<?php echo $anim_img->leagueimage_id; ?>">
                                                Comment
                                            </button>
                                        </div>
                                    </div>

                                    <span id="wordcount<?php echo $anim_img->leagueimage_id; ?>" class="value-box">1000</span>
                                    <div class="added-image"></div>
                                </div>
                                <!--</form>-->
                                <!--end-->

                            <?php } else {
                                ?>
                                <div class="input-text-comment" id="enterfield<?php echo $anim_img->leagueimage_id; ?>">
                                    <form action="">
                                        <textarea class="form-control form-comment textarea-box" readonly="" rows="3"name="commentss" required="" id="cmtbox" placeholder="What's on your mind"></textarea>
                                         
                                        <div class="post-comment">

                                            <div class="added-image"></div>

                                            <div class="another-post">
                                                <a href="#" class="photo"> 
                                                    <i class="fa fa-picture-o image_upload"></i> 
                                                </a> 
                                                <button type="submit" class="btn pull-right small-btn green-bg comment-btn commentPostBtn" id="<?php echo $anim_img->leagueimage_id; ?>">
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
                            <div  id="scroll_wrap_<?php echo $anim_img->leagueimage_id; ?>">
                                <div id="cmt_<?php echo $anim_img->leagueimage_id ?>">
                                </div>
                            </div>
                            <div id="comment_input"></div>
                        </div>
                        <!-- tab panel -->

                        <div role="tabpanel" class="tab-pane" id="news" style="width: 100%;">
                            <h1>news</h1>
                            <div id="scroll_wrap_<?php echo $anim_img->leagueimage_id; ?>">
                                <div   id="ct_<?php echo $anim_img->leagueimage_id ?>">
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
    <?php
}
?>
<script>
    var league_single_id = "<?php echo $anim_img->leagueimage_id; ?>";
</script>
<script>function fbs_click() {
        u = location.href;
        t = document.title;
        window.open('http://www.facebook.com/sharer.php?u=' + encodeURIComponent(u) + '&t=' + encodeURIComponent(t), 'sharer', 'toolbar=0,status=0,width=626,height=436');
        return false;
    }</script>
<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>

<script src="<?php echo base_url(); ?>assets/public/js/home.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/public/js/jquery.mCustomScrollbar.concat.min.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/public/js/single_image.js" type="text/javascript"></script>-->

<script>

    $(document).ready(function () {

        $('#login_close').click(function () {
            $('#login').removeClass('in');
            $('#login').hide();
            $('#modal_backdrop').remove();
        });
        $('#cmtbox').focus(function () {

            var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
            $('#body_id').append(html);
            $('#login').addClass('in');
            $('#login').show();
        });
        $('#search').on('keypress', function (event) {
            if (event.which == 13) {
                $('#search_form_name').submit();
            }
        });
        var current_id = "<?php echo $anim_img->leagueimage_id; ?>";
        $('#single_next_btn').click(function () {
            window.location.href = '<?php echo base_url() . $next_image; ?>#single_post';
            console.log(current_id);
        });
    });
</script>
<script src="<?php echo base_url(); ?>assets/public/js/single_image.js"></script>
<script>
    !function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
        if (!d.getElementById(id)) {
            js = d.createElement(s);
            js.id = id;
            js.src = p + '://platform.twitter.com/widgets.js';
            fjs.parentNode.insertBefore(js, fjs);
        }
    }(document, 'script', 'twitter-wjs');
</script>

<!-- modal report -->
<div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="<?php echo base_url(); ?>assets/public/img/close.png" alt="close" />
            </button>
            <div class="modal-header bor-none">
                <h2 class="modal-title title-report" id="myModalLabel">Report Post</h2>
                <p class="question-report">What do you report this post for?</p>
                <div id="report_alert" style="display: none" class="text-center alert alert-danger"></div>

                <div class="radio">
                    <input id="copyright" type="radio" name="ReportType" value="copyright" class="radio-report">
                    <label for="copyright" class="radio-report">Contains a trademark or copyright violation</label>

                    <input id="spam" type="radio" name="ReportType" value="spam" class="radio-report">
                    <label for="spam" class="radio-report">Spam, blatant advertising, or solicitation</label>

                    <input id="porn" type="radio" name="ReportType" value="porn" class="radio-report">
                    <label for="porn" class="radio-report">Contains offensive materials/nudity</label>

                    <input id="repost" type="radio" name="ReportType" value="repost" class="radio-report">
                    <label for="repost" class="radio-report">Repost of another post on 9GAG</label>
                </div>

                <div class="form-group wrap-input-url">
                    <input type="text" class="report-url" placeholder="http://leaguememe.com" value="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>">
                    <a href="javascript:void(0);" class="btn btn-red" type="submit" onclick="anime_report();">Submit</a>
                </div>
            </div>
            <!-- end modal header-->
        </div>
    </div>
</div>
<!-- end modal -->

<script>
    function anime_report() {
        var report = $('.radio-report:checked').val();
        var poll_id = "<?php echo $anim_img->leagueimage_id; ?>";
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
            success: function (data) {
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
    $(document).ready(function () {
        $(".image_upload").click(function (e) {
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
            $("#abcd" + abc).append($('<i class="fa fa-remove remove" style="margin-top: -75px; margin-right: 0px; margin-left: -2px; color: red; cursor: pointer; cursor: hand;"></i>').click(function () {
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
    ;

</script>

