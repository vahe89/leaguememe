<?php
//echo $total;
//echo "<pre>";
//print_r($league_details);

foreach ($league_details as $anim_img) {
    ?>
    <section id="body_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12  ">
                    <!-- <ul class="animemoment">
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Animemoment <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li><a href="#">View 1</a></li>
                                <li><a href="#">View 2</a></li>
                                <li><a href="#">View 3</a></li>
                              </ul>
                            </li>
                        </ul> -->

                    <div class="clicked-body">
                        <form action="<?php echo base_url(); ?>tag" id="search_form_name" method="post">
                            <input type="text" name="search" id="search" class="form-control pull-right" placeholder="Search">
                        </form>
                        <div class="content_and_sidebar_area-clicked ">
                            <div class="row">
                                <div class="col-md-7 col-lg-7  col-sm-12 pad-right-0 pad-left-0 ">
                                    <div class="content-clicked">
                                        <div class="row">
                                            <div class="col-sm-2 col-xs-2 col-lg-1 col-md-1">
                                                <a href="#"><img class="pro-pic" src="<?php echo base_url(); ?>assets/public/img/pro-pic.png" alt="profile pic"></a>
                                            </div>
                                            <div class="col-sm-2 col-sm-offset-0 col-xs-offset-0 col-md-offset-1 col-lg-offset-1 col-xs-1 pad-left-0">

                                                <div class="clicked-content-head-title-fix1">
                                                    <a class="author" href="#"><h5 class="text-uppercase"><?php echo isset($anim_img->user_name) ? $anim_img->user_name : "Admin"; ?></h5></a>
                                                    <p class="date"><a href="#">15 Min</a></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-5  col-md-5 col-lg-6 col-xs-6 text-center">
                                                <a class="anime-title" href="javascript:void(0);"><h5><?php echo $anim_img->leagueimage_name; ?></h5>
                                                </a>
                                                <?php
                                                $total_point = ((int) $anim_img->total_victory) - ((int) $anim_img->total_defeat);
                                                ?>
                                                <p class="anime-title-coments" ><a id="point_<?php echo $anim_img->leagueimage_id; ?>" href=""><?php echo $total_point; ?> </a>points <span class="plus-sign">+</span> <a id="toggler-<?php echo $anim_img->leagueimage_id . "yy"; ?>" href="#"> <?php
                                                        $total_comment = $anim_img->total_comment;
                                                        if (!empty($total_comment)) {
                                                            echo $total_comment;
                                                        } else {
                                                            echo '0';
                                                        }
                                                        ?></a> Comments </p>

                                            </div>
                                            <!--                                            <div class="col-sm-5  col-md-5 col-lg-6 col-xs-6 text-center">
                                                                                            <a class="anime-title" href="javascript:void(0);"><h5><?php echo $anim_img->leagueimage_name; ?></h5></a>
                                                                                            <p class="anime-title-coments">
                                                                                            <h6>
                                                                                                <div>
                                            <?php
//                                                        $total_point = ((int) $anim_img->total_victory) - ((int) $anim_img->total_defeat);
                                            ?>
                                                                                                    <span id="point_<?php echo $anim_img->leagueimage_id; ?>"><?php echo $total_point; ?></span> Points
                                                                                                </div>
                                                                                                <span class="plus-sign"><i class="fa fa-plus"></i></span>
                                                                                                <div class="cmnt-btn toggler"  id="toggler-<?php echo $anim_img->leagueimage_id . "yy"; ?>">
                                                                                                    <span class="count">
                                            <?php
//                                                            $total_comment = $anim_img->total_comment;
//                                                            if (!empty($total_comment)) {
//                                                                echo $total_comment;
//                                                            } else {
//                                                                echo '0';
//                                                            }
                                            ?>
                                                                                                    </span> Comments
                                                                                                </div>
                                                                                            </h6>
                                                                                            </p>
                                            
                                                                                        </div>-->
                                            <?php if (isset($next_image) && $next_image != "0") { ?>
                                                <div class="col-lg-1 col-xs-12 text-right col-md-1 col-sm-3 pad-right-0" >
                                                    <div class="clicked-content-title-fix-2">
                                                        <div class="btn content-head-button-next" id="single_next_btn">
                                                            next
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-12 pad">
                                                <div class="post">
                                                    <div class="col-lg-11 col-lg-push-1 col-sm-11 col-sm-push-0 col-sm-push-1 pad-left-0">

                                                        <?php
                                                        $category = $anim_img->category_name;
                                                        if ($category != 'Video') {
                                                            $ext = array();
                                                            $ext = explode(".", $anim_img->leagueimage_filename);
                                                            if ($ext[1] == "gif") {
                                                                ?>
                                                                <!--<div class="clear"></div>-->
                                                                <div id="video_<?php echo $anim_img->leagueimage_id; ?>" class="video">
                                                                    <!-- <video width="100%" controls=""id="v<?php /* echo $anim_img->leagueimage_id; */ ?>"  loop="">
                                <source src="<?php /* echo base_url(); */ ?>uploads/league/mp4/<?php /* echo $anim_img->videoname; */ ?>" type="video/webm">
                            </video>
                            <span class="play">Gif</span> -->
                                                                    <a class="image1" href="javascript:void(0);">
                                                                        <img  class = "post-image img-responsive meme-img" src="<?php echo base_url(); ?>uploads/league/<?php echo $anim_img->leagueimage_filename; ?>" alt="<?php echo $anim_img->leagueimage_name; ?>">
                                                                    </a>

                                                                </div>

                                                                <!--meme-img-->
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <!--<div class="clear"></div>-->
                                                                <a class="image1" href="javascript:void(0);">
                                                                    <img  class = "post-image img-responsive meme-img" src="<?php echo base_url(); ?>uploads/league/<?php echo $anim_img->leagueimage_filename; ?>" alt="<?php echo $anim_img->leagueimage_name; ?>">
                                                                </a>
                                                                <!--meme-img-->
                                                                <?php
                                                            }
                                                        } else if ($category == 'Video') {
                                                            ?>
                                                            <a class="image1" href="javascript:void(0);">
                                                                <div class="meme-img col-sm-12" ><?php echo $anim_img->leagueimage_filename; ?></div>
                                                            </a>
                                                        <?php } ?>
                                                        <a href="#">
                                                            <p class="clicked-report text-right pull-right">Report</p>
                                                        </a>
                                                    </div>
                                                    <div class="row ">

                                                        <div class="col-lg-12 text-right col-sm-12 pad-right-0 col-md-12 col-xs-12 ">
                                                            <ul class="list-inline clicked">
                                                                <li>
                                                                    <div class="qwe">
                                                                        <!-- <a href="#">
                                                                            <img src="<?php echo base_url(); ?>assets/public/images/Shape-3-copy-2.png" alt=""> UP
                                                                        </a>-->
                                                                        <?php
                                                                        if (isset($userid) && !empty($userid) && isset($victory[$anim_img->leagueimage_id]) && !empty($victory[$anim_img->leagueimage_id])) {
                                                                            if (in_array($userid, $victory[$anim_img->leagueimage_id])) {
                                                                                ?>
                                                                                                                <!--<i id="victory_img_<?php echo $anim_img->leagueimage_id; ?>" class = "fa fa-arrow-up fa-lg victory_active"></i>-->
                                                                                <a onClick = "onvictory(this.id);" id = "<?php echo $anim_img->leagueimage_id; ?>" style = "cursor: pointer" rel = "<?php echo $anim_img->leagueimage_id; ?>"><i id="victory_img_<?php echo $anim_img->leagueimage_id; ?>" class = "fa fa-arrow-up fa-lg victory_single_active"> UP</i></a>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <a onClick = "onvictory(this.id);" id = "<?php echo $anim_img->leagueimage_id; ?>" style = "cursor: pointer" rel = "<?php echo $anim_img->leagueimage_id; ?>"><i id="victory_img_<?php echo $anim_img->leagueimage_id; ?>" class = "fa fa-arrow-up fa-lg"></i> UP</a>
                                                                                <?php
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            <a onClick = "onvictory(this.id);" id = "<?php echo $anim_img->leagueimage_id; ?>" style = "cursor: pointer" rel = "<?php echo $anim_img->leagueimage_id; ?>"><i id="victory_img_<?php echo $anim_img->leagueimage_id; ?>" class = "fa fa-arrow-up fa-lg"></i> UP</a>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div class="qwe1">
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
                                                                    </div>
                                                                </li>

                                                                <li class="dropdown">

                                                                    <a href="#" class="dotsdropdown dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h fa-2x"></i></a>

                                                                    <ul class="dropdown-menu  nonborder" aria-labelledby="dLabel">
                                                                        <li><a href="#"><i class="fa fa-arrow-down fa-lg"></i>+Google</a></li>
                                                                        <li><a href="#"><i class="fa fa-arrow-down fa-lg"></i>Email</a></li>
                                                                    </ul>

                                                                </li>
                                                                <li class="share pull-right"  >

                                                                    <div class="btn clicked-facebook">
                                                                        <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank" style="color:white">Share on facebook</a>
                                                                    </div>

                                                                </li>
                                                                <li class="tweet pull-right"  >

                                                                    <div class="btn clicked-twitter">
                                                                        <a   data-count="vertical" data-via="your_screen_name" data-hashtags="mayur8189" href="https://twitter.com/share" style="color:white">  Share on twitter </a>
                                                                    </div>

                                                                </li>
                                                                <li class="share-button-sm hidden-md share-last-right hidden-lg hidden-sm hidden-xs ">
                                                                    <div class="b-container">
                                                                        <a class="sharebutton" href="javascript:shareShow()">Share</a>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </div>

                                                    <div class="col-xs-12 col-sm-8 tags-clicked pad-left-0">

                                                        <?php
                                                        $tags = isset($anim_img->tags) ? $anim_img->tags : '';
                                                        if (!empty($tags)) {
                                                            $pieces = explode(",", $tags);
                                                            foreach ($pieces as $tag) {
                                                                $tag_name = str_replace(" ", "-", $tag);
                                                                ?>
                                                                <a href = "<?php echo base_url(); ?>tag/<?php echo $tag_name; ?>" id="text_decoration_none" class = "btn btn-default btn-category" role = "button" > #<?php echo $tag; ?></a>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <ul class="nav nav-tabs navtabs-comment" role="tablist">
                                            <li role="presentation" class="active"><a href="#hot" aria-controls="hot" role="tab" data-toggle="tab"><b>HOT</b></a></li>
                                            <li role="presentation"><a href="#fresh" aria-controls="fresh" role="tab" data-toggle="tab" id="fresh1"><b>FRESH</b></a></li>
                                            <li class=" pull-right">
                                                <!--<a href="#" class="comments-count"><b>351 Comments</b> </a>-->
                                                <div class="cmnt-btn toggler comments-count"  id="toggler-<?php echo $anim_img->leagueimage_id . "y"; ?>">
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
                                        <div class="container-fluid pad-left-0 pad-right-0"   id="cmtclick">
                                            <div class="clicked-comments-hot ">
                                                <div class="container-fluid pad-left-0 pad-right-0">
                                                    <ul>
                                                        <li>
                                                            <div class="comment-holder">

                                                                <div class="row" style="margin-top:30px">

                                                                    <div class="col-lg-2 col-xs-2 col-md-2 pad-right-0">
                                                                        <div class="img-container">
                                                                            <img src="<?php echo base_url(); ?>assets/public/images/%EF%80%87.png" alt="">
                                                                        </div>

                                                                    </div>

                                                                    <div class="col-lg-10 col-xs-10 col-sm-9 col-sm-push-0 col-md-10 col-xs-8 col-xs-push-1 pad-left-0 pad-right-0">
                                                                        <?php if ($this->session->userdata('user_id')) { ?>
                                                                            <div class="comment-input" id="enterfield<?php echo $anim_img->leagueimage_id; ?>" >
                                                                                <form action="">
                                                                                    <textarea class="form-control" name="commentss" required="" placeholder="Update Your Comment" id="addCommentBox<?php echo $anim_img->leagueimage_id; ?>" rows="3"></textarea>
                                                                                    <input type="hidden" name="league_image_id" value="<?php echo $anim_img->leagueimage_id; ?>">
                                                                                    <div class="btn comment-submit commentPostBtn" id="<?php echo $anim_img->leagueimage_id; ?>" >
                                                                                        Comments
                                                                                    </div>

                                                                                </form>
                                                                            </div>

                                                                        <?php } else {
                                                                            ?>
                                                                            <div class="comment-input">
                                                                                <form action="">
                                                                                    <textarea class="form-control" rows="3" id="cmtbox"></textarea>
                                                                                    <div class="btn comment-submit">
                                                                                        Comment
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <div class="col-lg-2" id="<?php echo $anim_img->leagueimage_id; ?>">
                                                                            <p id="wordcount<?php echo $anim_img->leagueimage_id; ?>" class="wordcount">1000</p>
                                                                            <!--<li><?php echo $smiley_table[$anim_img->leagueimage_id]; ?></li>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="animation_image" style="background: #F9FFFF;border: 1px solid #E1FFFF;padding: 10px;width: 500px;margin-right: auto;margin-left: auto;" align="center"><img src="<?php echo base_url(); ?>assets/public/images/ajax-loader.gif" class="img-responsive" style="width:40px"></div>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="hot">

                                                <div class="container-fluid pad-left-0 pad-right-0">
                                                    <div class="clicked-comments-hot ">
                                                        <div class="container-fluid pad-left-0 pad-right-0">
                                                            <ul>

                                                                <li>
                                                                    <div  id="scroll_wrap_<?php echo $anim_img->leagueimage_id; ?>">

                                                                        <div class="row comment" id="cmt_<?php echo $anim_img->leagueimage_id ?>">

                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <div id="comment_input"></div>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="fresh">

                                                <div class="container-fluid pad-left-0 pad-right-0">
                                                    <div class="clicked-comments-hot ">
                                                        <div class="container-fluid pad-left-0 pad-right-0">
                                                            <ul>
                                                                <li>
                                                                    <div  id="scroll_wrap_<?php echo $anim_img->leagueimage_id; ?>">

                                                                        <div class="row comment" id="ct_<?php echo $anim_img->leagueimage_id ?>">

                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <div id="comment_input"></div>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-11 col-sm-offset-1 col-lg-offset-1 pad-right-0">
                                    <div class="right-sidebar-clicked hidden-xs hidden-sm font-play">

                                         
                                        <div>
                                        <?php
                                        if (count($side_links) > 0) {
                                            $total_sidelink = count($side_links);
                                            for ($i = 0; $i < $total_sidelink; $i++) {
                                                ?>
                                                <?php
                                                if ($i % 7 == 0) {
                                                    ?>
                                                    <div class="row" style="margin-top:7%;margin-bottom:8%">
                                                        <div class="col-xs-12 col-sm-12 col-md-12 google-ad-rt">
                                                            <script type="text/javascript">(function () {
                                                                    var ref = '';
                                                                    var cachebuster = Math.round(Math.random() * 100000);
                                                                    try {
                                                                        if (window.top === window.self) {
                                                                            ref = window.location.href;
                                                                        } else if (window.top === parent || ref === '') {
                                                                            ref = document.referrer;
                                                                        }
                                                                    } catch (ignore) {
                                                                    }
                                                                    document.write('<scr' + 'ipt type="text/javascript" src="http://ib.adnxs.com/ttj?id=5029272&referrer=' + encodeURIComponent(ref) + '&cb=' + cachebuster + '"></scr' + 'ipt>');
                                                                })();</script>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                                <a href="<?php echo base_url() . $side_links[$i]['leagueimage_id']; ?>" ><img
                                                        src="<?php echo base_url(); ?>uploads/league/<?php echo $side_links[$i]['leagueimage_filename']; ?>"
                                                        class="box-sm img-responsive sideinfo" alt="">

                                                    <p><?php echo $side_links[$i]['leagueimage_name']; ?></p></a>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                        
                                            <div class="row" style="margin-top:7%;margin-bottom:8%" >
                                                <!--<h1>helloo</h1>-->
                                                <div class="col-xs-12 col-sm-12 col-md-12 google-ad-rt">
                                                    <script type="text/javascript">(function () {
                                                            var ref = '';
                                                            var cachebuster = Math.round(Math.random() * 100000);
                                                            try {
                                                                if (window.top === window.self) {
                                                                    ref = window.location.href;
                                                                } else if (window.top === parent || ref === '') {
                                                                    ref = document.referrer;
                                                                }
                                                            } catch (ignore) {
                                                            }
                                                            document.write('<scr' + 'ipt type="text/javascript" src="http://ib.adnxs.com/ttj?id=5029272&referrer=' + encodeURIComponent(ref) + '&cb=' + cachebuster + '"></scr' + 'ipt>');
                                                        })();</script>
                                                </div>
                                            </div>
                                            <ul class="list-inline hidden-xs set_a" >
                                                <script>(function (d, t) {
                                                        var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
                                                        g.src = "//x.instagramfollowbutton.com/follow.js";
                                                        s.parentNode.insertBefore(g, s);
                                                    }(document, "script"));</script>
                                                <script>!function (d, s, id) {
                                                        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                                                        if (!d.getElementById(id)) {
                                                            js = d.createElement(s);
                                                            js.id = id;
                                                            js.src = p + '://platform.twitter.com/widgets.js';
                                                            fjs.parentNode.insertBefore(js, fjs);
                                                        }
                                                    }(document, 'script', 'twitter-wjs');</script>

                                                <!--                                        <li><div class="fb-like" data-href="http://www.facebook.com/parthuphotography" data-width="200" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div></li>
                                                                                        <li><a href="https://twitter.com/mayur8189" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @mayur8189</a></li>
                                                                                        <li><span class="ig-follow" data-id="112877a633" data-handle="parthu.1404" data-count="true" data-size="large" data-username="true"></span></li>-->
                                                <li><a href="https://www.facebook.com/LeagueMemes"><img
                                                            src="<?php echo base_url(); ?>assets/public/img/facebook.png"
                                                            class="img-responsive" alt="facebook"></a></li>
                                                <li><a href="https://twitter.com/mayur8189"><img
                                                            src="<?php echo base_url(); ?>assets/public/img/tweeter.png"
                                                            class="img-responsive" alt="twitter"></a></li>
                                                <li><a href="http://instafollow.in/widgets/instagram/"><img
                                                            src="<?php echo base_url(); ?>assets/public/img/instagram.png"
                                                            class="img-responsive" alt="instagran"></a></li>
                                            </ul>
                                
                                
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12  ">
                    <div class="clicked-body">
                        <div class="content_and_sidebar_area-clicked ">
                            <div class="row">
                                <script type="text/javascript">(function () {
                                        var ref = '';
                                        var cachebuster = Math.round(Math.random() * 100000);
                                        try {
                                            if (window.top === window.self) {
                                                ref = window.location.href;
                                            } else if (window.top === parent || ref === '') {
                                                ref = document.referrer;
                                            }
                                        } catch (ignore) {
                                        }
                                        document.write('<scr' + 'ipt type="text/javascript" src="http://ib.adnxs.com/ttj?id=5029274&referrer=' + encodeURIComponent(ref) + '&cb=' + cachebuster + '"></scr' + 'ipt>');
                                    })();</script>
                            </div>
                        </div>
                    </div>
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

        $('#login_close_btn').click(function () {
            $('#login-modal').removeClass('in');
            $('#login-modal').hide();
            $('#modal_backdrop').remove();
        });
        $('#cmtbox').focus(function () {

            var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
            $('#body_id').append(html);
            $('#login-modal').addClass('in');
            $('#login-modal').show();
        });
        $('#search').on('keypress', function (event) {
            if (event.which == 13) {
                $('#search_form_name').submit();
            }
        });
        var current_id = "<?php echo $anim_img->leagueimage_id; ?>";
        $('#single_next_btn').click(function () {
            window.location.href = '<?php echo base_url() . $next_image; ?>';
            console.log(current_id);
        });
    });
    function onvictory(victory) {
        $.ajax({
            type: "POST",
            url: base_url + "public/leaguelist/league_victory",
            data: {victory: victory},
            cache: false,
            dataType: 'JSON',
            success: function (data) {
                if (data.status === "false") {
//                    location.href = base_url + "user/login";
                    var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
                    $('#body_id').append(html);
                    $('#login-modal').addClass('in');
                    $('#login-modal').show();
                } else if (data.status === "delete") {
                    $('#defeat_img_' + victory).removeClass('victory_single_active');
                    $('#victory_img_' + victory).removeClass('victory_single_active');
                    var total_point = parseInt($('#point_' + victory).text()) - 1;
                    $('#point_' + victory).text(total_point);
                } else if (data.status === "update") {
                    $('#defeat_img_' + victory).removeClass('victory_single_active');
                    $('#victory_img_' + victory).addClass('victory_single_active');
                    var total_point = parseInt($('#point_' + victory).text()) + 2;
                    $('#point_' + victory).text(total_point);
                } else if (data.status === "insert") {
                    $('#defeat_img_' + victory).removeClass('victory_single_active');
                    $('#victory_img_' + victory).addClass('victory_single_active');
                    var total_point = parseInt($('#point_' + victory).text()) + 1;
                    $('#point_' + victory).text(total_point);
                } else {
                    location.reload();
                }
            }
        });
    }
    function ondefeat(defeat) {
        $.ajax({
            type: "POST",
            url: base_url + "public/leaguelist/league_defeat",
            data: {defeat: defeat},
            cache: false,
            dataType: 'JSON',
            success: function (data) {
                if (data.status == "false") {
//              location.href = base_url + "user/login";
                    var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
                    $('#body_id').append(html);
                    $('#login-modal').addClass('in');
                    $('#login-modal').show();
                } else if (data.status === "delete") {
                    $('#victory_img_' + defeat).removeClass('victory_single_active');
                    $('#defeat_img_' + defeat).removeClass('victory_single_active');
                    var total_point = parseInt($('#point_' + defeat).text()) + 1;
                    $('#point_' + defeat).text(total_point);
                } else if (data.status === "update") {
                    $('#victory_img_' + defeat).removeClass('victory_single_active');
                    $('#defeat_img_' + defeat).addClass('victory_single_active');
                    var total_point = parseInt($('#point_' + defeat).text()) - 2;
                    $('#point_' + defeat).text(total_point);
                } else if (data.status === "insert") {
                    $('#victory_img_' + defeat).removeClass('victory_single_active');
                    $('#defeat_img_' + defeat).addClass('victory_single_active');
                    var total_point = parseInt($('#point_' + defeat).text()) - 1;
                    $('#point_' + defeat).text(total_point);
                } else {
                    location.reload();
                }
            }
        });
    }
</script>
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



