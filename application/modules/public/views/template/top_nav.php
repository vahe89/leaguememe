<style>
    #back-to-top {
        position: fixed;
        bottom: 40px;
        right: 40px;
        z-index: 9999;
        width: 32px;
        height: 32px;
        text-align: center;
        line-height: 30px;
        background: #B83C54;
        color: #444;
        cursor: pointer;
        border: 0;
        border-radius: 2px;
        text-decoration: none;
        transition: opacity 0.2s ease-out;
        opacity: 0;
    }

    #back-to-top:hover {
        background: green;
        /*background: #e9ebec;*/
    }

    #back-to-top.show {
        opacity: 1;
    }

    img {
        max-width: 100%;
    }

    .cropper-view-box,
    .cropper-face {
        border-radius: 50%;
    }

    #imagePreview {
        width: 180px;
        height: 180px;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
        display: inline-block;
    }

    #coverImage .cropper-view-box, #coverImage .cropper-face {
        border-radius: 0%;
    }

    #result img {
        width: 215px;
        height: 215px;
    }

    .error {
        color: red;
    }

    .select2-drop {
        z-index: 100050;
        /*width: 100%;*/
    }

    @media (min-width: 991px) {
        .pad-left {
            padding-left: 0px
        }
    }

    @media (min-width: 775px) {
        .pad-left {
            padding-left: 0px
        }
    }
</style>
</head>

<body id="body_id">
<a href="javascript:void(0);" id="back-to-top" title="Back to top">&uarr;</a>
<script>
    $(window).load(function () {
        $('#fb_login_models').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
        });
    });
    window.fbAsyncInit = function () {
        FB.init({
            appId: '1727081077607945',
            xfbml: true,
            version: 'v2.8'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<!-- Modal Login-->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="overflow: auto">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" id="login_close" class="close" data-dismiss="modal" aria-label="Close">&times;
            </button>
            <div class="modal-header bor-none">
                <h2 class="modal-title mar-t-40" id="myModalLabel" style="text-align: center;">Login to Your
                    Account</h2>
                <p class="grey-color-xs" style="text-align: center;">You can connect with a social network</p>


                <div class="connect-social">
                    <div class="wrap-socmed" style="width: 100%">
                        <div class="facebook-conect">
                            <img src="<?= base_url() ?>assets/public/img/fb-connect.png">
                            <span style="padding-left: 0px"> Facebook</span>
                            <a href="<?= base_url() . 'public/loginfacebook' ?>" id="fb_login_model"
                               class="btn btn-fb-connect"> Connect</a>
                        </div>
                    </div>
                    <div class="wrap-socmed" style="width: 100%">
                        <div class="facebook-conect">
                            <img src="<?= base_url() ?>assets/public/img/gplus-connect.png">
                            <span style="padding-left: 0px"> Google+</span>
                            <a href="<?= base_url() . 'public/logingoogle' ?>" class="btn btn-gplus-connect">
                                Connect</a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="center-block">
                            <span class="circles"> OR</span>
                        </div>
                    </div>
                </div>
                <!-- connect social -->
            </div>
            <!-- end modal header-->

            <div class="modal-footer">
                <form action="<?php echo base_url(); ?>public/user/login" method="post" id="user_llogin">
                    <div class="form-group text-left">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" name="username"
                               <?php if (isset($_COOKIE['username'])) { ?>value="<?= $_COOKIE['username']; ?>"<?php } ?>
                               class="form-control" id="exampleInputEmail1" placeholder="Username">
                        <label class="error" for="username"
                               generated="true"><?php echo form_error('username'); ?></label>
                    </div>
                    <div class="form-group text-left">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password"
                               <?php if (isset($_COOKIE['password'])) { ?>value="<?= $_COOKIE['password']; ?>"<?php } ?>
                               class="form-control" id="exampleInputPassword1" placeholder="Password">
                        <label class="error" for="password"
                               generated="true"><?php echo form_error('password'); ?></label>
                        <?php
                        if (isset($msg)) {
                            echo "<h5 style='color:red'>$msg</h5>";
                        }
                        ?>
                        <p class="text-right link-log" onclick="$('#forgetmodel').modal()" data-target="#forgetmodel" id="forgetmodal"
                           style="cursor: pointer;">Forgot the password?</p>
                    </div>
                    <button type="submit" class="btn btn-login-green pull-left">Login</button>
                    <div class="clearfix"></div>
                    <!--<p class="link-log text-left">Didn’t have an account? <a href="<?php echo base_url(); ?>public/user/signup">Sign up</a>-->
                    <p class="link-log text-left">Didn’t have an account? <a href="javascript:void(0);"
                                                                             onclick="$('#signup').modal()" data-target="#signup"
                                                                             id="regi_click">Sign up</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- end modal -->
<?php
if ($this->session->userdata('modal_show')) {
    ?>
    <div class="modal fade" id="fb_login_models" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title mar-t-40" id="myModalLabel">Enter new username</h4>
                    <!--<span  style="font-size: 10px;color:red">(If you were earlier already login via facebook then change username feature not work or click skip button)</span>-->
                </div>
                <form method="post" id="fb_login_form">
                    <div class="modal-body">
                        <div id="forgot">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter new username" name="username"
                                       id="username_login_fb">

                                <div id="username_login_fb_error" style="color:#F00" class="alert_style"></div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-red ">Submit</button>
                        <!--<a href="<?= base_url() ?>"  class="btn btn-red">Skip</a>-->
                    </div>
                </form>
            </div>

        </div>
    </div>
    <?php
}
?>
<!-- start FOLLOWER-->
<div class="modal fade" id="followermodal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Follower List</h4>
            </div>
            <div class="modal-body">

                <div class="panel panel-default" style="max-height: 300px; overflow-y: auto;">

                    <ul class="anime">
                        <?php
                        if (isset($follower_list)) {
                            foreach ($follower_list as $fwerlist) {
                                ?>

                                <li>
                                    <div class="sec-description">
                                        <a href="<?php echo base_url(); ?>leaguememe-profile/<?php echo $fwerlist['user_name'] ?>"
                                           target="_blank">
                                            <span><?php echo empty($fwerlist['name']) ? $fwerlist['user_name'] : $fwerlist['name']; ?></span>
                                        </a>
                                    </div>
                                    <div class="sec-description pull-right">
                                        <span>  <a href="javascript:void(0);"
                                                   class="btn btn-red">Follows You</a> </span>
                                    </div>
                                </li>

                                <?php
                            }
                        }
                        ?>


                    </ul>

                </div>
            </div>
        </div>

    </div>
</div>
<!--END FOLLOWER-->
<!-- start FOLLLOWING-->
<div class="modal fade" id="followingmodal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Following List</h4>
            </div>
            <div class="modal-body">

                <div class="panel panel-default" style="max-height: 300px; overflow-y: auto;">

                    <ul class="anime">
                        <?php
                        if (isset($following_list)) {

                            foreach ($following_list as $flinglist) {
                                ?>

                                <li>
                                    <div class="sec-description">
                                        <a href="<?php echo base_url(); ?>leaguememe-profile/<?php echo $flinglist['user_name'] ?>"
                                           target="_blank">
                                            <span><?php echo empty($flinglist['name']) ? $flinglist['user_name'] : $flinglist['name']; ?></span></a>
                                    </div>
                                    <div class="sec-description pull-right">
                                        <span>  <a href="javascript:void(0);"
                                                   class="btn btn-red"> You Follow</a> </span>
                                    </div>
                                </li>

                                <?php
                            }
                        }
                        ?>


                    </ul>

                </div>
            </div>
        </div>

    </div>
</div>
<!--END FOLLLOWING-->
<!--start forgot modal-->
<div class="modal fade" id="forgetmodel" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title mar-t-40" id="myModalLabel">Forgot Password</h2>
            </div>
            <form method="post" id="forgot_password">
                <div class="modal-body">
                    <div id="forgot">
                        <p align="center" id="for_error22"
                           style="display:none; float:left;padding-left:20px; color:#F00" class="alert_style">Invalid
                            Email !</p>

                        <p align="center" id="change_pass"
                           style="display:none; float:left;padding-left:20px; color:#F00;" class="alert_style">Reset
                            password link has been sent to your mail id. </p>

                        <p align="center" id="email_error"
                           style="display:none; float:left;padding-left:20px; color:#F00;" class="alert_style">Please
                            enter valid mail. </p>

                        <div class="clear"></div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email" name="email" id="forgot_email">

                            <div id="forgotemail" style="color:#F00" class="alert_style"></div>
                        </div>

                        <div class="form-group forgot">
                            <label>

                            </label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-red " id="click_forgot">Submit</button>
                    <button type="button" class="btn btn-red" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>


<!--end forgot modal-->

<!-- sign up -->
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" id="sign_close" class="close" data-dismiss="modal" aria-label="Close">&times;
            </button>

            <div class="modal-header bor-none">
                <h2 class="modal-title mar-t-40" id="myModalLabel" style="text-align: center;">Sign Up With Us</h2>
                <p class="grey-color-xs" style="text-align: center;">You can connect with a social network</p>
                <div class="connect-social">
                    <div class="wrap-socmed" style="width: 100%">
                        <div class="facebook-conect">
                            <img src="<?= base_url() ?>assets/public/img/fb-connect.png">
                            <span style="padding-left: 0px"> Facebook</span>
                            <a href="<?= base_url() . 'public/loginfacebook' ?>" id="fb_login_model2"
                               class="btn btn-fb-connect"> Connect</a>

                        </div>
                    </div>
                    <div class="wrap-socmed" style="width: 100%">
                        <div class="facebook-conect">
                            <img src="<?= base_url() ?>assets/public/img/gplus-connect.png">
                            <span style="padding-left: 0px"> Google+</span>
                            <a href="<?= base_url() . 'public/logingoogle' ?>" class="btn btn-gplus-connect">
                                Connect</a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="center-block">
                            <span class="circles" style="margin-top: 0px"> OR</span>
                        </div>
                    </div>
                </div>

                <!-- connect social -->
            </div><!-- end modal header-->

            <div class="modal-footer">
                <form class="mar-t-20" action="<?php echo base_url(); ?>public/user/sign_up" method="post" name="sign"
                      id="register">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group text-left">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Username"
                                       name="username">
                                <div id="usermsg" style="color:#F00"
                                     class="alert_style"> <?php echo form_error('username'); ?> </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group text-left">
                                <label for="exampleInputEmail1">Email Address</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                                <div id="emailmsg" style="color:#F00"
                                     class="alert_style"> <?php echo form_error('email'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group text-left">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password"
                                       name="password">
                                <div style="color:#F00" class="alert_style"><?php echo form_error('password'); ?> </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group text-left">
                                <label for="exampleInputPassword1">Repeat Password</label>
                                <input type="password" class="form-control" id="passconf" placeholder="Confirm Password"
                                       name="passconf">
                                <div id="passconf1" style="color:#F00"
                                     class="alert_style"> <?php echo form_error('passconf'); ?> </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-login-green btn-res pull-left" id="signup_ajax">Sign up
                    </button>
                    <div class="clearfix"></div>
                    <p class="link-log text-left">Have an account? <a href="javascript:void(0);" onclick="$('#login').modal()"
                                                                      data-target="#login" id="login_click">Login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<!-- start upload post -->
<div id="modal" class="popupContainer upload-page"
     style="display:none;width:100%;max-height: 100%;overflow: auto; margin-top: -35px;">
    <header class="popupHeader">
        <span class="modal_close" id="close_modal_click"><i class="fa fa-times"></i></span>
    </header>

    <section class="popupBody" style="overflow: hidden">
        <!-- Upload -->
        <div class="upload" id="modal_upload">
            <h2 class="modal-title-upload mar-t-20" id="myModalLabel">Upload Post</h2>
            <hr/>
            <p class="grey-color-xs">Choose how you want to upload</p>
            <div id="upload_alert" style="display: none" class="text-center alert alert-danger"></div>
            <div class="upload-top">
                <form action="#" id="uploadform" class="dropzone">
                    <a href="#" id="choose-image">
                        <div class="upload-image panel panel-default">
                            <div class="panel-body">
                                <img src="<?php echo base_url(); ?>assets/public/img/upload-image.png">
                            </div>
                            <div class="panel-title">
                                <span>Choose or drag picture here</span>
                            </div>
                        </div>
                    </a>
                </form>
                <!-- <div class="col-sm-12"> -->
                <div class="">
                    <div id="wait" style="display:none;width:69px;height:89px;margin-left:43%;margin-top: -118px;"><img
                                src='<?php echo base_url(); ?>assets/public/img/ajax-loader.gif' width="64"
                                height="64"/><br><strong class="text">Uploading...</strong></div>
                </div>
            </div>
            <!-- upload top -->

            <div class="upload-bottom">
                <div style="width: 100%">
                    <div id="album_alert1" style="display: none" class="text-center alert alert-danger"></div>
                    <div style="width: 49%;float: left">
                        <form method="POST" name="album_form" id="album_form" enctype='multipart/form-data'>
                            <input type="file" class="hidden" id="uploadalbum" name="userfile[]" multiple=""
                                   accept="image/*" style="display:none"/>
                            <a href="javascript:void(0)" id="choose-album">
                                <div class="col-md-12 col-xs-12 panel panel-bottom modal-album">
                                    <div class="panel-body"><img src="<?= base_url() ?>assets/public/img/add-album.png">
                                    </div>
                                    <div class="panel-title">
                                        <span>Add Album</span>
                                        <p> Hold ctrl for multiple image </p>
                                    </div>
                                </div>
                            </a>
                        </form>
                        <span class="waitalbum" style="display:none">  <img
                                    src='<?php echo base_url(); ?>assets/public/img/ajax-loader.gif'
                                    style="width:30px;height: 30px;"> <strong class="text">Uploading...</strong> </span>
                    </div>
                    <div style="width: 2%;float: left">
                        &nbsp
                    </div>
                    <div style="width: 49%;float: left">
                        <a href="#" id="choose-rating">
                            <div class="col-md-12 col-xs-12 panel panel-bottom modal-polling">
                                <div class="panel-body"><img src="<?= base_url() ?>assets/public/img/rating.png"></div>
                                <div class="panel-title"><span>Make a poll</span></div>
                            </div>
                        </a>
                    </div>
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>

        <!-- image-upload -->
        <div class="image-upload img-upload">
            <div class="modal-header bor-none">
                <h2 class="modal-title-upload mar-t-20" id="myModalLabel">Submit a picture</h2>
                <hr/>
                <p class="grey-color-xs img-subtitle">Be as accurate as possible with your submission to help people
                    discover your post!</p>
                <div id="alert" style="display: none" class="text-center alert alert-danger"></div>
                <div class="panel panel-default bor-radius-0">
                    <div class="panel-body">
                        <div class="panel-content col-md-12 no-padding">
                            <a href="javascript:void(0)">
                                <div class="img-panel">
                                    <input type="hidden" id="img_name" name="img_name">
                                    <img id="img" name="img" src="" alt="">
                                </div>
                            </a>
                            <input type="text" placeholder="Give a title here..." class="title-img-upload"
                                   name="upload_title" id="upload_title" maxlength="150">
                            <div class="pull-right count-right">
                                <span id="anime_count">150</span>
                            </div>


                            <textarea placeholder="Describe your post with tags!" id="tag" class="txt-area-tags"
                                      onkeyup="handle(event);"></textarea>

                            <div class="hastag-view-upload" id="tag1">

                            </div>
                            <textarea style="display: none" class="form-control desc" id="tag2" rows="2"></textarea>
                        </div>
                    </div>
                    <!--end panel --->

                    <div class="wrap-filter-post">
                        This post is not safe for work
                        <input type="checkbox" name="check1" id="check1"/>
                        <label for="check1">
                                <span class="fa-stack">
                                    <i class="fa fa-square-o fa-stack-1x"></i>
                                    <i class="fa fa-check fa-stack-1x"></i>
                                </span>
                        </label>
                    </div>
                    <div class="wrap-filter-post">
                        Add spoiler tag
                        <input id="check3" type="checkbox" name="option">
                        <label for="check3">
                                <span class="fa-stack">
                                    <i class="fa fa-square-o fa-stack-1x"></i>
                                    <i class="fa fa-check fa-stack-1x"></i>
                                </span>
                        </label>
                    </div>

                    <div class="wrap-filter-post">
                        Credit the author
                        <input type="checkbox" name="option" id="check2" value="check2" class="only_credit"/>
                        <label for="check2">
                                <span class="fa-stack">
                                    <i class="fa fa-square-o fa-stack-1x"></i>
                                    <i class="fa fa-check fa-stack-1x"></i>
                                </span>
                        </label>
                    </div>

                    <div class="credit check2" style="display: none">
                        <div class="socmed-credit">

                        </div>
                        <div class="name-author">
                            <input type="text" placeholder="http://" id="author" name="author" readonly="">
                            <input type="text" placeholder="Name of Creditor" id="credit">
                        </div>

                    </div>
                </div>
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button"
                   aria-haspopup="true" aria-expanded="true">
                    <span class="catSelection_image">Pick a selection</span><span class="caret"></span>
                </a>
                <ul class="dropdown-menu genre" id="category_list">

                </ul>
                <div class="col-md-12 wrap-btn-step">
                    <a href="javascript:void(0)" class="btn btn-red pull-right" id="next-image" onclick="next_page();">Save</a>
                    <a href="javascript:void(0)" class="btn btn-back pull-right" id="back-image">Back</a>
                </div>
            </div>
        </div>

        <!-- Discussion Upload -->
        <div class="discuss-upload image-upload">
            <div class="modal-header bor-none">
                <h2 class="modal-title-upload mar-t-20" id="myModalLabel">Create a discussion thread</h2>
                <hr/>
                <p class="grey-color-xs img-subtitle">Have a question or anything you want to discuss? </p>
                <div id="discussionalert" style="display: none" class="text-center alert alert-danger"></div>
                <div class="panel panel-default">
                    <input type="hidden" id="discussion_file">
                    <div class="panel-body-discuss panel-body">
                        <div class="panel-content col-md-12 no-padding">
                            <input type="text" placeholder="Give Title Here..." class="title-discuss-input"
                                   id="discussion_count" maxlength="150">
                            <span class="pull-right char-length" id="di_count_span">150</span>
                        </div>
                    </div>
                </div>
                <!--end panel --->
                <div class="panel panel-default panel-discuss-editor mar-t-50">
                    <textarea placeholder="Describe your post" class="discuss-edit tinymce" id="discussion_count_desc"
                              maxlength="250"></textarea>
                    <span class="char-length-editor" id="dis_desc_span">250</span>
                </div>
                <!--end panel --->
                <div class="panel panel-default ">
                    <div class="wrap-filter-post">
                        spoiler instead
                        <input type="checkbox" style="display: none;" name="option" id="discussioncheck"/>
                        <label for="discussioncheck">
                                <span class="fa-stack">
                                    <i class="fa fa-square-o fa-stack-1x"></i>
                                    <i class="fa fa-check fa-stack-1x"></i>
                                </span>
                        </label>
                    </div>
                    <div class="wrap-filter-post">
                        Credit the author
                        <input type="checkbox" name="option" class="only_credit" style="display: none;"
                               id="creditcheck_disc" value="creditcheck_disc"/>
                        <label for="creditcheck_disc">
                                <span class="fa-stack">
                                    <i class="fa fa-square-o fa-stack-1x"></i>
                                    <i class="fa fa-check fa-stack-1x"></i>
                                </span>
                        </label>
                    </div>

                    <div class="credit creditcheck_disc" style="display: none">
                        <div class="socmed-credit">

                        </div>
                        <div class="name-author">
                            <input type="text" placeholder="http://" id="disc_creditor_site" name="author" readonly="">
                            <input type="text" placeholder="Name of Creditor" id="disc_creditor_author">
                        </div>

                    </div>
                </div>
                <div class="col-md-12 wrap-btn-step">
                    <a href="javascript:void(0);" class="btn btn-red pull-right" onclick="discussion_next();">Save</a>
                    <a href="#" class="btn btn-back pull-right" id="back-discuss">Back</a>
                </div>
            </div>
        </div>


        <!-- Album Upload -->
        <div class="album-upload image-upload">

            <div class="modal-header bor-none">
                <h2 class="modal-title-upload" id="myModalLabel">Create an album</h2>
                <hr/>
                <p class="grey-color-xs img-subtitle">Share your album (cosplay, art, comics, and more) with
                    everyone!</p>
                <div id="album_alert" style="display: none" class="text-center alert alert-danger"></div>
                <p id="showalbum" class="text-danger"></p>
                <form id="albumform" method="post" action="">

                    <div class="panel panel-default">
                        <div class="panel-body-discuss panel-body">
                            <div class="panel-content col-md-12 no-padding">
                                <input type="text" placeholder="Give a Title Here..." id="main_title"
                                       class="title-discuss-input">
                                <span class="pull-right char-length" id=albumanime_count>150</span>
                            </div>
                        </div>
                    </div>
                    <!--end panel --->

                    <div id="albumarea"></div>


                    <a href="javascript:void(0);" class="wrap-add-album" id="add_more_album">
                        <i class="fa fa-plus-circle"></i>
                        <span>Add another one (select multiple image by holding CTRL)</span>
                    </a>

                    <span class="waitalbum" style="display:none">  <img
                                src='<?php echo base_url(); ?>assets/public/img/ajax-loader.gif'
                                style="width:30px;height: 30px;"> <strong class="text">Uploading...</strong> </span>
                    <div class="panel panel-default panel-checkbox">
                        <div class="wrap-filter-post">
                            This post is not safe for work
                            <input id="album-not-safe" type="checkbox" style="display: none" name="option">
                            <label for="album-not-safe">
                                    <span class="fa-stack">
                                        <i class="fa fa-square-o fa-stack-1x"></i>
                                        <i class="fa fa-check fa-stack-1x"></i>
                                    </span>
                            </label>
                        </div>
                        <div class="wrap-filter-post">
                            Add spoiler tag
                            <input id="albumcheck3" type="checkbox" value="1" style="display: none" name="option">
                            <label for="albumcheck3">
                                    <span class="fa-stack">
                                        <i class="fa fa-square-o fa-stack-1x"></i>
                                        <i class="fa fa-check fa-stack-1x"></i>
                                    </span>
                            </label>
                        </div>
                        <div class="wrap-filter-post">
                            Credit the author
                            <input type="checkbox" style="display: none" id="albumcheck2" value="albumcheck2"
                                   class="only_credit"/>
                            <label for="albumcheck2">
                                    <span class="fa-stack">
                                        <i class="fa fa-square-o fa-stack-1x"></i>
                                        <i class="fa fa-check fa-stack-1x"></i>
                                    </span>
                            </label>
                        </div>
                        <div class="credit albumcheck2" style="display: none">
                            <div class="socmed-credit">

                            </div>
                            <div class="name-author">
                                <input type="text" placeholder="http://" id="albumcredit" readonly="">
                                <input type="text" placeholder="Name of Creditor" id="albumauthor">
                            </div>

                        </div>
                    </div>
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="true">
                        <span class="catSelection_album">Pick a selection</span><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu genre" id="category_album_list" style="position: static">

                    </ul>


                    <div class="col-md-12 wrap-btn-step">
                        <input type="submit" name="g" class="btn btn-red pull-right" value="Save" id="next-album">
                        <a href="#" class="btn btn-back pull-right" id="back-album">Back</a>
                    </div>
                </form>
            </div>
        </div>


        <!--Rating upload-->
        <form id="poll_form" method="post" action="">
            <div class="rating-upload image-upload">
                <div class="modal-header bor-none form-group">
                    <h2 class="modal-title-upload" id="myModalLabel">Give your post a Title</h2>
                    <hr/>
                    <p class="grey-color-xs img-subtitle">An accurate, discriptive title can help people discover your
                        post</p>
                    <div id="first_poll_alert" style="display: none" class="text-center alert alert-danger"></div>

                    <div class="form-control">
                        <div class="panel-content col-md-12 no-padding">
                            <input type="text" placeholder="Give a Title Here..." class="title-discuss-input"
                                   name="title" id="title">
                            <span class="pull-right char-length" id="title_count">150</span>
                        </div>
                    </div>
                    <span id="error_title" class="help-inline error-red"></span>&nbsp;

                    <div class="form-control">
                        <div class="panel-content col-md-12 no-padding">
                            <input type="text" placeholder="Type your question..." name="question"
                                   class="title-discuss-input" id="question">
                            <span class="pull-right char-length" id="question_count">150</span>
                        </div>
                    </div>
                    <span id="error_question" class="help-inline error-red"></span>&nbsp;

                    <div class="form-control">
                        <div class="panel-content col-md-12 no-padding" id="add_option">
                            <input type="text" placeholder="Enter poll option..." class="option title-discuss-input"
                                   name="poll_amswer" id="poll_amswer">
                            <span class="option_count pull-right char-length" id="option_count">150</span>
                        </div>
                    </div>
                    <span id="error_option" class="help-inline error-red"></span>&nbsp;

                    <div id="more_option" name="optionm" id="optionm"></div>
                    <!--                                            <span id="error_more_option" class="help-inline error-red"></span>&nbsp;-->

                    <div class="wrap-filter-post no-padding mar-b-20" id="add_more">
                        <a href="javascript:void(0);"><i class="fa fa-plus-circle"
                                                         style="color: #17ae97; margin-right: 10px;"></i>Add another one</a>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-body-discuss panel-body">
                            <!--<div class="panel-content col-md-12 no-padding">-->
                            <textarea placeholder="Describe your post" class="title-polling-upload" id="discription"
                                      name="discription"></textarea>
                            <span class="pull-right char-length-polling" id="discription_count">350</span>
                            <!--</div>-->
                        </div>
                    </div>
                    <span id="error_discription" class="help-inline error-red" style="margin-top: -5px;"></span>
                    <div class="panel panel-default panel-discuss-check">
                        <div class="wrap-filter-post">
                            Add spoiler tag
                            <input type="checkbox" name="in_poll_spoiler" style="display: none" id="in_poll_spoiler"/>
                            <label for="in_poll_spoiler">
                                    <span class="fa-stack">
                                        <i class="fa fa-square-o fa-stack-1x"></i>
                                        <i class="fa fa-check fa-stack-1x"></i>
                                    </span>
                            </label>
                        </div>
                        <div class="wrap-filter-post">
                            Credit the author
                            <input type="checkbox" name="credit_poll_author" class="only_credit" style="display: none"
                                   id="credit_poll_author" value="credit"/>
                            <label for="credit_poll_author">
                                    <span class="fa-stack">
                                        <i class="fa fa-square-o fa-stack-1x"></i>
                                        <i class="fa fa-check fa-stack-1x"></i>
                                    </span>
                            </label>
                        </div>

                        <div class="credit credit_poll_author" style="display: none">
                            <div class="socmed-credit">

                            </div>
                            <div class="name-author">
                                <input type="text" id="poll_credit" name="credit" placeholder="http://" readonly="">
                                <input type="text" id="poll_author" name="author" placeholder="Name of Creditor">
                            </div>
                        </div>
                        <span id="poll_error_author" class="help-inline error-red" style="margin-top: -5px;"></span>
                        <span id="inline_poll_error_credit" class="help-inline error-red"
                              style="margin-top: -5px;"></span>
                    </div>
                    <div class="col-md-12 mar-t-20 wrap-btn-step">
                        <a href="javascript:void(0);" class="btn btn-red pull-right" id="next-rating"
                           onclick="poll_next();">Save</a>
                        <a href="javascript:void(0);" class="btn btn-back pull-right" id="back-rating">Back</a>
                    </div>
                </div>
            </div>
        </form>

        <!--Game dialogue upload-->
        <div class="gamechat-upload image-upload">
            <div class="modal-header bor-none">
                <h2 class="modal-title-upload mar-t-20" id="myModalLabel">Create a league dialogue</h2>
                <hr/>
                <p class="grey-color-xs img-subtitle">Had a funny conversation with someone in game? POST IT HERE!</p>
                <div id="gamechat_alert" style="display: none" class="text-center alert alert-danger"></div>
                <p id="showgamechat" class="text-danger"></p>
                <div class="panel panel-default bor-radius-0">
                    <select class="splashart" multiple="multiple" id="splashart_model">
                        <option value="badge1">badge1</option>
                        <option value="badge2">badge2</option>
                        <option value="badge3">badge3</option>
                        <option value="badge4">badge4</option>
                        <option value="badge5">badge5</option>
                    </select>
                </div>
                <div class="form-control">
                    <div class="panel-content col-md-12 no-padding">
                        <input type="text" placeholder="Give a Title Here..." class="title-discuss-input" name="title"
                               id="main_title_gamechat" maxlength="150">
                        <span class="pull-right char-length" id="title_count_gamechat">150</span>
                    </div>
                </div>
                <form id="gameform" method="post" action="">
                    <div class="panel panel-default bor-radius-0" id="gamechatarea"></div>
                    <div class="col-md-12 wrap-btn-step">
                        <input type="submit" name="g" class="btn btn-red pull-right" value="Next" id="next-gamechat">
                        <a href="javascript:void(0)" class="btn btn-back pull-right" id="back-gamechat">Back</a>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function format(state) {
                if (!state.id) {
                    return state.text;
                }
//            return "<img class='flag' src='<?php echo base_url(); ?>assets/public/img/" + state.id.toLowerCase() + ".png'/>" + state.text;
                var $state = $(
                    '<span><img src="<?php echo base_url(); ?>assets/public/img/' + state.id.toLowerCase() + '.png" class="img-flag" style="width:35px" /> ' + state.text + '</span>'
                );
                return $state;
            }

            $("select#splashart_model").select2({
                formatResult: format,
                placeholder: 'Enter Splashart name',
                maximumSelectionSize: 5,
            }).on("select2-selecting", function (e) {
                $('#gamechatarea').append('<div class="panel-body" id="gameRem_' + e.val + '"> \n\
                    <div class="panel-content col-md-12 no-padding"> \n\
                        <input type="hidden"  name="img_' + e.val + '" value="' + e.val + '.png" > \n\
                        <a href="javascript:void(0)"> <div class="img-panel"> <img src="' + base_url + 'assets/public/img/' + e.val + '.png" style="height:100%">  </div> </a> \n\
                        <div class="title-dialogue"> \n\
                            <select  name="opt_' + e.val + '" > \n\
                                <option value="volvo">Here a title</option> \n\
                                <option value="saab">lalalala</option> \n\
                                <option value="mercedes">Medusa got a rampage</option> \n\
                                <option value="audi">Anti Mage teach</option> \n\
                            </select> <hr>  \n\
                            <textarea placeholder="Dialogue" class="desc_count" name="desc_' + e.val + '" maxlength="150" id="desr**' + e.val + '"></textarea> \n\
                        </div>  \n\
                        <div class="count-right" id="dese' + e.val + '"> <span>150</span> </div> \n\
                    </div> \n\
                </div>');
            }).on("select2-removed", function (e) {
                document.getElementById('gameRem_' + e.val).remove();
            })
        </script>
    </section>
</div>
<!-- end upload post -->

<!-- Crop cover -->
<div class="modal fade" id="crop-cover" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Crop Cover Image</h4>
            </div>

            <?php
            if (empty($userdetail['cover_image'])) {
                $style = "Display: none";
                $remove_style = "Display: none";
            } else {
                $style = "";
                $remove_style = "";
            }
            if (empty($userdetail['user_image'])) {
                $profilestyle = "Display: none";
                $profileremove_style = "Display: none";
            } else {
                $profilestyle = "";
                $profileremove_style = "";
            }
            ?>

            <form method="post" action="<?php echo base_url(); ?>public/user/cover_crop_upload">
                <div class="modal-body">
                    <div class="row" style="margin-left: 0px;">
                        <input id="uploadcover" type="file" name="coverimg" accept="image/*" class="img"/>

                    </div>

                    <div class="row hshowdiv" style="<?php echo $style; ?>">
                        <div class="col-md-12">
                            <h3 class="page-header">Crop Image</h3>
                            <div id="coverImage">
                                <img class="img-responsive" id="coverimage" alt="jcrop Circle Area Example"/>
                            </div>
                        </div>
                        <div class="col-md-12">

                            <button type="button" class="btn btn-red" id="removeCover"
                                    value="<?php echo $userdetail['cover_image']; ?>"
                                    style="float:right; margin-top:8px; margin-bottom: 8px; margin-left: 10px; <?php echo $remove_style; ?>">
                                Remove
                            </button>
                            <button type="button" class="btn btn-red" name="covercrop" id="coverbutton"
                                    style="float:right; margin-top:8px; margin-bottom: 8px;">Upload
                            </button>
                            <div id="coverresult" style="display:none"></div>
                        </div>
                        <div class="col-md-12" id="loaderCover" style="display: none">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-red" name="cover_upload" id="up_cover" style="display: none">
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Crop -->

<!-- Crop Profile Picture -->
<div class="modal fade" id="edit-profile-picture" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Crop Cover Image</h4>
            </div>
            <form method="post" action="<?php echo base_url(); ?>public/user/crop_upload">
                <div class="modal-body">
                    <div class="row">
                        <input id="uploadFile" type="file" accept="image/*" name="img" class="img"/>
                        <div id="imagePreview1"></div>
                    </div>
                    <div class="row imshow" style="<?php echo $style; ?>">
                        <div class="col-md-12">
                            <h3 class="page-header">Image</h3>
                            <div id="imagePreview">
                                <img class="img-responsive" id="image" alt="jcrop Circle Area Example"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!--<button type="button" class="btn btn-red" id="removeProfile" value="<?php echo $userdetail['user_image']; ?>" style="float:right; margin-top:8px; margin-bottom: 8px; margin-left: 10px; <?php echo $profileremove_style; ?>" >Remove</button>-->
                            <button type="button" class="btn btn-red" name="crop" id="button"
                                    style="float:right; margin-top:8px; margin-bottom: 8px;">Upload
                            </button>
                            <!--<button type="button" class="btn btn-red pull-right" name="crop" id="button">Upload</button>-->
                            <div id="result" class=" col-md-offset-4" style="display: none"></div>
                            <!--<button type="submit" name="upload"> Upload </button>-->

                        </div>
                        <div class="col-md-12" id="loaderimage" style="display: none">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="upload" class="btn btn-red" id="up_image" style="display: none">Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-----------------------           new thread model ----------------->

<div id="tread_modal" class="popupContainer" style="display:none;">
    <header class="popupHeader">
        <span class="modal_close" id="close_modal_click"><i class="fa fa-times"></i></span>
    </header>

    <section class="popupBody" style="overflow: hidden">
        <div class="upload">
            <h2 class="modal-title-upload mar-t-20" id="tread_model_title">Upload Post</h2>
            <hr/>
            <!--upload image-->
            <div id="discussupload_alert1" style="display: none" class="text-center alert alert-danger"></div>
            <form action="#" id="uploadformdiscussion1" class="dropzone">
                <a href="#" id="choose-discuss1">
                    <div class="upload-image panel panel-default">
                        <div class="panel-body">
                            <img src="<?php echo base_url(); ?>assets/public/img/upload-discussion.png">
                        </div>
                        <div class="panel-title">
                            <span id="panel_tread_title">Choose or drag files discussion here</span>
                        </div>
                    </div>
                </a>
            </form>
            <div class="col-sm-12">
                <div id="waitdiscussion1"
                     style="display:none;width:69px;height:89px;margin-left:43%;margin-top: -118px;">
                    <img src='<?php echo base_url(); ?>assets/public/img/ajax-loader.gif' width="64"
                         height="64"/><br><strong class="text">Uploading...</strong></div>
            </div>
        </div>

        <div class="discuss-upload1" style="display: none">
            <div class="modal-header bor-none">
                <h2 class="modal-title-upload mar-t-20" id="myModalLabel">Create a <span class="sec_sub_id"></span>
                    thread</h2>
                <hr/>
                <p class="grey-color-xs img-subtitle">Have a question or anything you want to <span
                            class="sec_sub_id"></span> ? </p>
                <div id="discussionalert1" style="display: none" class="text-center alert alert-danger"></div>
                <div class="panel panel-default">
                    <input type="hidden" id="discussion_file1">
                    <div class="panel-body-discuss panel-body">
                        <div class="panel-content col-md-12 no-padding">
                            <input type="text" placeholder="Give Title Here..." class="title-discuss-input"
                                   id="discussion_count1" maxlength="150">
                            <span class="pull-right char-length" id="di_count_span1">150</span>
                        </div>
                    </div>
                </div>
                <!--end panel --->
                <div class="panel panel-default panel-discuss-editor mar-t-50">
                    <textarea placeholder="Describe your post" class="discuss-edit tinymce" id="discussion_count_desc1"
                              maxlength="250"></textarea>
                    <span class="char-length-editor" id="dis_desc_span1">250</span>
                </div>

                <!--end panel --->
                <div class="panel panel-default panel-discuss-check">
                    <div class="wrap-filter-post">
                        Add spoiler tag
                        <input name="option" id="discussioncheck1" style="display: none;" type="checkbox">
                        <label for="discussioncheck1">
                                <span class="fa-stack">
                                    <i class="fa fa-square-o fa-stack-1x"></i>
                                    <i class="fa fa-check fa-stack-1x"></i>
                                </span>
                        </label>
                    </div>
                    <div class="wrap-filter-post">
                        Credit the author
                        <input type="checkbox" name="option" class="only_credit" style="display: none;"
                               id="creditcheck_disc1" value="creditcheck_disc1"/>
                        <label for="creditcheck_disc1">
                                <span class="fa-stack">
                                    <i class="fa fa-square-o fa-stack-1x"></i>
                                    <i class="fa fa-check fa-stack-1x"></i>
                                </span>
                        </label>
                    </div>

                    <div class="credit creditcheck_disc1" style="display:none">
                        <div class="socmed-credit">

                        </div>
                        <div class="name-author">
                            <input type="text" placeholder="http://" id="disc_creditor_site1" name="author" readonly="">
                            <input type="text" placeholder="Name of Creditor" id="disc_creditor_author1">
                        </div>

                    </div>
                </div>


                <div class="col-md-12 wrap-btn-step">
                    <a href="javascript:void(0);" class="btn btn-red pull-right"
                       onclick="anime_discussion_next();">Next</a>
                    <a href="javascript:void(0);" class="btn btn-back pull-right" id="back-discuss1"
                       onclick="anime_discussion_back();">Back</a>
                </div>
            </div>
        </div>
        <!--upload discussion-->
    </section>
</div>


<script src="<?php echo $new_url; ?>assets_new/public/js/cropper.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        <?php
        $cover = "";
        if (empty($userdetail['cover_image'])) {
            $cover = "";
        } else {
            $cover = $userdetail['cover_image'];
        }
        ?>
        $("#imagePreview").html('<img src="<?php echo base_url(); ?>uploads/users/cover/<?php echo $cover ?>" class="img-responsive" id="image"  alt="jcrop Circle Area Example" style="max-width: 100%; max-height: 100%;"/>');
        getCropImage();
        $("#coverImage").html('<img src="<?php echo base_url(); ?>uploads/users/cover/<?php echo $cover ?>" class="img-responsive" id="coverimage"  alt="jcrop Circle Area Example" style="max-width: 100%; max-height: 100%;"/>');
        getCropCover();

        var count = 1;
        $("#add_more").click(function () {
            count++;
            $("#more_option").append('<a class="remove_img fa fa-remove pull-right" href="javascript:void(0);" id="' + count + '" style="margin-top: -8px; margin-right: -5px; color: red;"><a><div class="panel panel-default mar-b-20" id="rem_' + count + '"><div class="panel-body-discuss panel-body"><div class="panel-content col-md-12 no-padding"><input type="text" placeholder="Enter poll option..." class="option title-discuss-input" name="option" id="option"><span class="option_count pull-right char-length" id="option_count">150</span></div></div></div>');

        });
    });

    // cropper

    function getCoverCanvas(sourceCanvas) {
        var canvas = document.createElement('canvas');
        var context = canvas.getContext('2d');
        var width = sourceCanvas.width;
        var height = sourceCanvas.height;
        canvas.width = width;
        canvas.height = height;
        context.beginPath();
        context.rect(0, 0, width, height);
        context.strokeStyle = 'rgba(0,0,0,0)';
        context.stroke();
        context.clip();
        context.drawImage(sourceCanvas, 0, 0, width, height);
        return canvas;
    }

    function getCropCover() {
        //                alert("df");
        var $image = $('#coverimage');
        var $result = $('#coverresult');
        var croppable = false;
        $image.cropper({
//                    aspectRatio: 16 / 9,
//                    aspectRatio: 150 / 200,
//                        dragCrop: false,
//                        dragMode: 'crop',
            setSelect: [0, 0, 1440, 350],
            aspectRatio: 1440 / 350,
            highlight: true,
            minCropBoxWidth: 568,
            minCropBoxHeight: 156,
            minContainerWidth: 568,
            minContainerHeight: 400,
            viewMode: 1,
            built: function () {
                croppable = true;
            }
        });

    }

    $('#coverbutton').on('click', function () {

        var croppedCanvas;
        var coverCanvas;


        // Crop
        croppedCanvas = $('#coverimage').cropper('getCroppedCanvas');
//                                    console.log(croppedCanvas);
        // Cover

        try {
            coverCanvas = getCoverCanvas(croppedCanvas);
            $('#loaderCover').show();
            $('#loaderCover').html('<span><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"  style="font-size: 40px; margin-top: 5px;"> </i> </span>');
        }
        catch (err) {
            $('#loaderCover').show();
            $('#loaderCover').html('<p style="color:red">Something went wrong,try again</p>');
        }

        // Show
        $('#coverresult').html('<img src="' + coverCanvas.toDataURL() + '"><input name="coverimg" type="hidden" value="' + coverCanvas.toDataURL() + '">');
//                                    $('#up_cover').show();
        $('#up_cover').trigger('click');
    });

    function getRoundedCanvas(sourceCanvas) {
        var canvas = document.createElement('canvas');
        var context = canvas.getContext('2d');
        var width = sourceCanvas.width;
        var height = sourceCanvas.height;
        canvas.width = width;
        canvas.height = height;
        context.beginPath();
        context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI);
        context.strokeStyle = 'rgba(0,0,0,0)';
        context.stroke();
        context.clip();
        context.drawImage(sourceCanvas, 0, 0, width, height);
        return canvas;
    }

    function getCropImage() {
        var $image = $('#image');
        var croppable = false;
        $image.cropper({
            aspectRatio: 1, minContainerWidth: 568,
            viewMode: 1,
            built: function () {
                croppable = true;
            }
        });

    }

    $('#button').on('click', function () {
        var croppedCanvas;
        var roundedCanvas;

        // Crop
        croppedCanvas = $('#image').cropper('getCroppedCanvas');
        try {
            // Round
            roundedCanvas = getRoundedCanvas(croppedCanvas);
            $('#loaderimage').show();
            $('#loaderimage').html('<span><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"  style="font-size: 40px; margin-top: 5px;"> </i> </span>');
        }
        catch (err) {
            $('#loaderimage').show();
            $('#loaderimage').html('<p style="color:red">Something went wrong,try again</p>');
        }

        // Show
        $('#result').html('<img src="' + roundedCanvas.toDataURL() + '"><input name="img" type="hidden" value="' + roundedCanvas.toDataURL() + '">');
//                                    $('#up_image').show();
        $('#up_image').trigger('click');

    });
    $(function () {
            $("#uploadFile").on("change", function () {
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader)
                    return; // no file selected, or no FileReader support
                $('.imshow').show();
                $('#imagePreview').html('<p>Please wait...</p>');
                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function () { // set image data as background of div
                        $('.imshow').show();
                        $("#imagePreview").html('<img src="' + this.result + '" class="img-responsive" id="image"  alt="jcrop Circle Area Example" style="max-width: 100%; max-height: 100%;"/>');
                        getCropImage();
                    };
                }
            });
            $("#uploadcover").on("change", function () {
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader)
                    return; // no file selected, or no FileReader support
                $('.hshowdiv').show();
                $('#coverImage').html('<p>Please wait...</p>');
                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function () { // set image data as background of div
                        $('.hshowdiv').show();
                        $("#coverImage").html('<img src=" ' + this.result + '" class="img-responsive" id="coverimage"  alt="jcrop Circle Area Example" style="max-width: 100%; max-height: 100%;"/>');
                        getCropCover();
                    };
                }
            });
        }
    );
</script>

<!-- Static navbar -->
<nav class="navbar navbar-custom navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php
            if (isset($username) && !empty($username)) {
                ?>
                <div id="noti_Container_res">
                    <div id="noti_Counter_res"></div>
                    <!--SHOW NOTIFICATIONS COUNT.-->

                    <div id="noti_Button_res">
                        <a href="#">
                            <span class="fa fa-bell-o" aria-hidden="true"></span>
                        </a>
                    </div>

                    <!--THE NOTIFICAIONS DROPDOWN BOX.-->
                    <div id="notifications_res">
                        <img src="<?php echo base_url(); ?>assets/public/img/loading_1.gif"
                             style="width:83px;  margin-left: 41%;display: none" id="loader_noti_res">
                    </div>
                </div>
            <?php } ?>
            <a class="navbar-brand" href="<?php echo base_url(); ?>">

                <img src="<?php echo base_url(); ?>assets/public/img/logo-simple.png" alt="logo"/>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav menu">
                <!--<li><a href="<?= base_url(); ?>discussion">Discussion</a></li>-->

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Discussion<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a class="res-caption-nav" href="#">Action</a></li>
                        <li><a class="res-caption-nav" href="#">Another action</a></li>
                        <li><a class="res-caption-nav" href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header separator-nav">Nav header</li>
                        <li><a class="res-caption-nav" href="#">Separated link</a></li>
                        <li><a class="res-caption-nav" href="#">One more separated link</a></li>
                    </ul>
                </li>

                <li><a href="<?= base_url(); ?>news">News</a></li>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">Patch Note<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a class="res-caption-nav" href="javascript:void(0)">Patch Note</a></li>
                        <li><a class="res-caption-nav" href="javascript:void(0)">PBE Note</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right menu">

                <?php
                if (isset($username) && !empty($username)) {
                    ?>
                    <li class="active custom-list-nav">
                        <a href="<?php echo base_url(); ?>leaguememe_profile/<?php echo $sessionuserdetail['user_name']; ?>"
                           class="link-profpict">
                            <div class="profile-picture-nav">
                                <?php
                                if (isset($userdetail['user_image']) && !empty($userdetail['user_image'])) {
                                    if (isset($sessionuserdetail['user_image']) && !empty($sessionuserdetail['user_image'])) {
                                        ?>
                                        <img src="<?php echo base_url(); ?>uploads/users/<?php echo $sessionuserdetail['user_image']; ?>"
                                             class="profile-picture-nav "> &nbsp;
                                        <?php
                                    } else {
                                        ?>
                                        <img src="<?php echo base_url(); ?>assets/public/img/default_profile.jpeg"
                                             class="profile-picture-nav"> &nbsp;
                                        <?php
                                    }
                                    ?>
                                <?php } else {
                                    ?>
                                    <img src="<?php echo base_url(); ?>assets/public/img/default_profile.jpeg"
                                         class="profile-picture-nav"> &nbsp;
                                    <?php
                                }
                                ?>

                            </div>
                        </a>
                        <a href="<?php echo base_url(); ?>leaguememe_profile/<?php echo $sessionuserdetail['user_name']; ?>"
                           class="res-username"><?= empty($sessionuserdetail['name']) ? $sessionuserdetail['user_name'] : $sessionuserdetail['name']; ?></a>
                        <a href="#" class="btn dropdown-toggle" id="dropdown_list_nav" type="button"
                           data-toggle="dropdown">
                            <i class="fa fa-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-list" role="menu" aria-labelledby="dropdown_list_nav">
                            <li>
                                <a href="<?php echo base_url(); ?>leaguememe_profile/<?php echo $sessionuserdetail['user_name']; ?>">Edit
                                    Profile</a></li>
                            <li><a href="<?= base_url(); ?>user/logout">Log Out</a></li>
                        </ul>
                    </li>
                    <li class="separator-search"></li>
                    <li id="noti_Container">
                        <input type="hidden" value="<?php echo count($noti_details); ?>" id="noti_hide_count">
                        <div id="noti_Counter"></div>
                        <!--SHOW NOTIFICATIONS COUNT.-->

                        <div id="noti_Button">
                            <a href="javascript:void(0);">
                                <span class="fa fa-bell-o" aria-hidden="true"></span>
                            </a>
                        </div>

                        <!--THE NOTIFICAIONS DROPDOWN BOX.-->

                        <div id="notifications">
                            <img src="<?php echo base_url(); ?>assets/public/img/loading_1.gif"
                                 style="width:83px; margin-left: 41%;display: none" id="loader_noti">
                        </div>

                    </li>
                <?php } ?>
                <li class="hide-search-res">
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#search-collapse">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </a>
                </li>

                <li class="search-res">
                    <input type="text" class="search-query mac-style" placeholder="Search">
                    <button type="submit" class="btn btn-search-res"><i class="glyphicon glyphicon-search"></i></button>
                </li>
                <?php
                if (isset($username) && !empty($username)) {
                    ?>

                    <li class="upload-triger">
                        <a id="modal_trigger" href="#modal" class="btn btn-red">Upload</a>
                    </li>
                <?php } else {
                    ?>
                    <li class="active">
                        <a onclick="$('#login').modal()" data-target="#login" class="padding-login">Login</a>
                    </li>

                    <li class="upload-triger">
                        <a href="javascript:void(0);" onclick="$('#signup').modal()" data-target="#signup" type="button"
                           class="btn btn-red">Sign up</a>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <!--/.nav-collapse -->
    </div>
</nav>

<!-- Search box -->
<div id="search-collapse" class="collapse" style="position: absolute; right: 213px;">
    <div class="container no-padding">
        <div class="input-group pull-right w-form-search">
            <form id="search_form_name" method="post" action="<?php echo base_url(); ?>tag/">
                <input type="text" id="search" class="form-control" name="search" id="enter"
                       placeholder="Search for snippets and hit enter"
                       style="height: 40px; z-index: 9999;position: fixed;width: 320px" required="">
            </form>
        </div>
    </div>
</div>

<!-- Search Box -->

<!-- Background Cover -->
<?php if (isset($username) && !empty($username)) { ?>
    <div class="background-cover"
         style="background: url(<?php echo base_url(); ?>uploads/users/cover/<?php echo $userdetail['cover_image']; ?>)no-repeat scroll 0% 0% ;background-size:cover;background-position: top;">
        <div class="overlay-cover overlay-other">
            <?php
            $sidebar = $this->router->fetch_method();
            $base_url = site_url() . $sidebar;
            ?>


            <div class="trigger-edit-cover hide-cover" href="#">
                <a class="wrap-image-cover">
                    <i class="fa fa-camera"></i> Edit Cover 1440px X 350px
                </a>
            </div>
            <div class="bottom-cover bottom-cover-other">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="text-center list-unstyled list-place row">
                                <li class="list-followers">
                                    <a href="javascript:void(0)"
                                       onclick="$('#login').modal()" <?= $following->total_following == 0 ? '' : 'data-target="#followingmodal"' ?> >
                                        <h5>FOLLLOWING</h5>
                                        <h2 id="following_<?php echo $userdetail['user_id'] ?>"><?php echo $following->total_following; ?></h2>
                                    </a>
                                </li>

                                <li class="list-followers">
                                    <a href="javascript:void(0)"
                                       onclick="$('#login').modal()" <?= $follower->total_follower == 0 ? '' : 'data-target="#followermodal"' ?> >
                                        <h5>FOLLOWERS</h5>
                                        <h2 id="followers_<?php echo $userdetail['user_id'] ?>"><?php echo $follower->total_follower; ?></h2>
                                    </a>
                                </li>
                                <li class="list-followers">
                                    <a href="javascript:void(0)">
                                        <!--<a href="<?php echo base_url(); ?>show-all-post/<?php echo $userdetail['user_name']; ?>">-->
                                        <h5>POST COUNT</h5>
                                        <h2><?php echo $count->total_post; ?></h2>
                                    </a>
                                </li>
                                <li class="right-button">
                                    <?php
                                    $user = $this->uri->segment(2);
                                    $base_user_url = $base_url . '/' . $user;
                                    if ($user === $username) {
                                        ?>
                                        <!--                                            <a href="javascript:void(0)" class="btn btn-red">
                                                                                        <i class="fa fa-envelope"></i>
                                                                                    </a>-->
                                        &nbsp;
                                        <a href="javascript:void(0)" class="btn btn-grey btn-picture"
                                           id="change_profpict">
                                            <i class="fa fa-pencil"></i>&nbsp;Edit
                                        </a>

                                        <?php
                                    } else {
                                    if ($base_url == site_url() . 'leaguememe_profile') {
                                    ?>
                                <li class="right-button">
                                    <input type="hidden" id="str_follow" value="<?php echo $userdetail['user_id']; ?>">

                                    <?php if (isset($follow['follow_status'])) { ?>
                                        <input type="button" class="btn btn-red" onclick="follow();" id="follow_btn"
                                               value="Following"> &nbsp;
                                    <?php } else { ?>
                                        <input type="button" class="btn btn-red" onclick="follow();" id="follow_btn"
                                               value="Follow"> &nbsp;
                                    <?php } ?>

                                    <!--                                                <button type="button" class="btn btn-trans">Message</button>-->
                                </li>


                                <?php
                                } else {
                                    ?>

                                    <a href="javascript:void(0)" class="btn btn-grey btn-picture" id="change_profpict">
                                        <i class="fa fa-pencil"></i>&nbsp;Edit
                                    </a>
                                    <?php
                                }
                                }
                                ?>
                                <ul class="dropdown-menu edit-cover-nores" role="menu" aria-labelledby="edit-cover">
                                    <li><a href="#" onclick="$('#crop-cover').modal()" data-target="#crop-cover"><i
                                                    class="fa fa-picture-o"></i>&nbsp;&nbsp;Change cover photo</a></li>
                                    <li><a href="#" onclick="$('#edit-profile-picture').modal()" data-target="#edit-profile-picture"><i
                                                    class="fa fa-picture-o"></i>&nbsp;&nbsp;Change profile picture</a>
                                    </li>
                                </ul>

                                </li>
                                <li class="others-btn-res">

                                    <?php if ($user === $username) {
                                        ?>

                                        <button class="btn btn-dropdown btn-others dropdown-toggle" id="others-profile"
                                                type="button" data-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu menu-others-btn" role="menu"
                                            aria-labelledby="others-profile">
                                            <li><a href="#" onclick="$('#crop-cover').modal()" data-target="#crop-cover"><i
                                                            class="fa fa-picture-o"></i>&nbsp;&nbsp;Change cover
                                                    photo</a></li>
                                            <li><a href="#" onclick="$('#edit-profile-picture').modal()" data-target="#edit-profile-picture"><i
                                                            class="fa fa-picture-o"></i>Change profile picture</a></li>
                                            <?php
                                            if ($base_url == site_url() . 'leaguememe_profile') {
                                                ?>
                                                <!--<li><a href="#"><i class="fa fa-envelope-o"></i>Message</a></li>-->
                                            <?php } ?>
                                        </ul>
                                    <?php } else { ?>
                                        <button class="btn btn-dropdown btn-others dropdown-toggle" id="others-profiles"
                                                type="button" data-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu menu-others-btn menu-others-profile" role="menu"
                                            aria-labelledby="others-profiles">

                                            <?php if (isset($follow['follow_status'])) { ?>
                                                <li onclick="follow();"><a href="javascript:void(0);"
                                                                           id="follow_btn_res"><i
                                                                class="fa fa-minus"></i>&nbsp;&nbsp;Following</a></li>
                                            <?php } else { ?>
                                                <li onclick="follow();"><a href="javascript:void(0);"
                                                                           id="follow_btn_res"><i
                                                                class="fa fa-user-plus"></i>&nbsp;&nbsp;Follow</a></li>
                                            <?php } ?>


                                            <!--<li><a href="#"><i class="fa fa-envelope-o"></i>Message</a></li>-->
                                        </ul>
                                    <?php } ?>

                                    <script>
                                        function follow() {
                                            var str = $('#str_follow').val();
                                            $.ajax({
                                                url: '<?php echo site_url(); ?>public/user/follower',
                                                type: 'POST',
                                                data: {
                                                    'str': str,
                                                },
                                                dataType: 'json',
                                                success: function (data) {
                                                    if (data.status == 'follow') {
                                                        $('#follow_btn').attr('value', 'Following');
                                                        $('#follow_btn_res').html('<i class="fa fa-minus"></i>&nbsp;&nbsp;Following');
                                                        var total_follow = parseInt($('#followers_' + str).text()) + 1;
                                                        $('#followers_' + str).text(total_follow);
                                                    }
                                                    else if (data.status == 'unfollow') {
                                                        $('#follow_btn').attr('value', 'Follow');
                                                        $('#follow_btn_res').html('<i class="fa fa-user-plus"></i>&nbsp;&nbsp;Follow');
                                                        var total_follow = parseInt($('#followers_' + str).text()) - 1;
                                                        $('#followers_' + str).text(total_follow);
                                                    }
                                                    else if (data.status == 'request') {
                                                        $('#follow_btn').attr('value', 'Requested');
                                                        $('#follow_btn_res').html('<i class="fa fa-user-plus"></i>&nbsp;&nbsp;Requested');
                                                    }

                                                }
                                            });
                                        }
                                    </script>
                                </li>
                            </ul>
                        </div>
                        <!-- end col-md-12 -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
        </div>
    </div>
<?php } ?>
<!-- end background-cover -->

<script>

    $(document).on('click', '.image_filter', function () {
        var textid = $(this).parent('div').next('div').find("input:eq(0)").attr('id');
        var link = $(this).attr('data-link');
        $('#' + textid).val(link);
        $('.socmed-credit').find('img').addClass('image_filter');
        $(this).removeClass('image_filter');
    })

    $(document).on('click', '#removeCover', function () {
        var img = $(this).val();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: base_url + "public/home/removecover",
            data: {
                cover_image: img,
            },
            success: function (data) {
                location.reload();
            }

        })
    });

    $(document).on('change', '.pic_category', function () {
        var category = $(this).val();
        var classt = $(this).parent().parent().parent().prev().find("span:first").attr('class');
        $("." + classt).text(category);
//            $(".catSelection").html(category);
    })
    $(document).ready(function () {
        $.ajax({
            type: 'POST',
            url: base_url + "public/leaguelist/getCredit_author",
            success: function (data, textStatus, jqXHR) {
                $('.socmed-credit').html(data);
            }
        });
    })

</script>



