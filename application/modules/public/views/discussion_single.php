 
<?php
foreach ($discussion_detail as $discussion) {
    //$allid = $main_category."-".$discussion->leagueimage_id;
    ?>
    <?php
    $total_point = ((int) $discussion->total_victory) - ((int) $discussion->total_defeat);
    ?>
    <section style="background-color:#eee;">
        <div class="container no-padding">
            <div class="single-panel" style="margin-top: 35px;">
                <div class="col-md-8 no-padding">

                    <div class="col-md-12 wrap-res-avatar no-padding">

                        <div class="col-md-12 no-padding">
                            <div class="media info-avatar avatar-fifth-page" style="width: 100%">
                                <div class="media-left up-triangle-hide" style=" width: 9%;">
                                    <?php
                                    if (isset($userid) && !empty($userid) && isset($victory[$discussion->anime_discussionid]) && !empty($victory[$discussion->anime_discussionid])) {
                                        if (in_array($userid, $victory[$discussion->anime_discussionid])) {
                                            ?>
                                            <a href="javascript:void(0)" class="pad-l-22" onclick="ondiscussionvictory(this.id)" id="vic_<?php echo $discussion->anime_discussionid; ?>">
                                                <img class="up-scroll"  id="like_<?php echo $discussion->anime_discussionid; ?>"  src="<?php echo base_url(); ?>assets/public/img/up-triangle-hover.png">
                                            </a>
                                            <?php
                                        } else {
                                            ?>  
                                            <a href="javascript:void(0)"class="pad-l-22" onclick="ondiscussionvictory(this.id)" id="vic_<?php echo $discussion->anime_discussionid; ?>">
                                                <img class="up-scroll"  id="like_<?php echo $discussion->anime_discussionid; ?>" src="<?php echo base_url(); ?>assets/public/img/up-triangle.png">
                                            </a>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <a href="javascript:void(0)" class="pad-l-22" onclick="ondiscussionvictory(this.id)" id="vic_<?php echo $discussion->anime_discussionid; ?>">
                                            <img class="up-scroll"  id="like_<?php echo $discussion->anime_discussionid; ?>"  src="<?php echo base_url(); ?>assets/public/img/up-triangle.png">
                                        </a>
                                        <?php
                                    }
                                    ?>

                                    <div class="rating" id="points_<?php echo $discussion->anime_discussionid; ?>"><?php echo $total_point; ?></div>
                                    <?php
                                    if (isset($userid) && !empty($userid) && isset($defact[$discussion->anime_discussionid]) && !empty($defact[$discussion->anime_discussionid])) {
                                        if (in_array($userid, $defact[$discussion->anime_discussionid])) {
                                            ?>
                                            <a href="javascript:void(0)"class="pad-l-22"onclick="ondiscussiondefeat(this.id)" id="def_<?php echo $discussion->anime_discussionid; ?>">
                                                <img class="down-scroll"  id="dislike_<?php echo $discussion->anime_discussionid; ?>" src="<?php echo base_url(); ?>assets/public/img/down-triangle-hover.png">
                                            </a>
                                            <?php
                                        } else {
                                            ?> 
                                            <a href="javascript:void(0)" class="pad-l-22" onclick="ondiscussiondefeat(this.id)" id="def_<?php echo $discussion->anime_discussionid; ?>">
                                                <img class="down-scroll"   id="dislike_<?php echo $discussion->anime_discussionid; ?>" src="<?php echo base_url(); ?>assets/public/img/down-triangle.png">
                                            </a>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <a href="javascript:void(0)" class="pad-l-22" onclick="ondiscussiondefeat(this.id)" id="def_<?php echo $discussion->anime_discussionid; ?>">
                                            <img class="down-scroll"  id="dislike_<?php echo $discussion->anime_discussionid; ?>" src="<?php echo base_url(); ?>assets/public/img/down-triangle.png">
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="media-body">
                                    <a style="float: left" href="<?php echo base_url(); ?>animemoment-profile/<?php echo $discussion->user_name ?>">
                                        <?php
                                        if (isset($discussion->user_image)) {
                                            ?>
                                            <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>uploads/users/<?php echo $discussion->user_image; ?>" alt="<?php echo $discussion->user_name; ?>"> 
                                            <?php
                                        } else {
                                            ?>
                                            <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>assets/public/img/admin.png" alt="profile pic">
                                            <?php
                                        }
                                        ?>
                                    </a>
                                    <a href="<?php echo base_url(); ?>animemoment-profile/<?php echo $discussion->user_name ?>">
                                        <h5 class="pad-l-65"><?php echo empty($discussion->name) ? $discussion->user_name : $discussion->name; ?></h5>
                                    </a>

                                    <span class="minute pad-l-65" style="display: block" data-livestamp="<?php echo strtotime($discussion->discussion_timestamp); ?>"> </span>


                                    <div class="wrap-tag-comment">
                                        <div class="avatar-comment">

                                            <a id="point_<?php echo $discussion->anime_discussionid; ?>"><?php echo $total_point; ?></a><a> Likes </a> &nbsp; - &nbsp;
                                            <a href="#" id="distoggler-<?php echo $discussion->anime_discussionid . "y"; ?>"><?php
                                                $total_comment = $discussion->total_comment;
                                                if (!empty($total_comment)) {
                                                    echo $total_comment;
                                                } else {
                                                    echo '0';
                                                }
                                                ?> </a><a>Comments</a>
                                        </div>
                                        <div class = "tag tag-minute">
                                            <span class = "normal-tag">theory</span>
                                            <?php if ($discussion->spoiler == 1) {
                                                ?>
                                                <span class="normal-tag red-tag">spoiler</span>
                                            <?php }
                                            if(!empty($discussion->creditor_author) AND !empty($discussion->creditor_site)){
                                            ?>
                                            <span  class="normal-tag disc-credit-show" data-credit="<?=$discussion->creditor_author?>">Credit</span>
                                                    <?php 
                                                    $img = "fb-credit.png";
                                                    $lnk = "https://www.facebook.com/";
                                                    
                                                    if(strpos($discussion->creditor_site, "facebook")){
                                                        $img = "fb-credit.png";
                                                        $lnk = "https://www.facebook.com/";
                                                    }
                                                    elseif(strpos($discussion->creditor_site, "twitter")){
                                                        $img = "tt-credit.png";
                                                        $lnk = "https://twitter.com/";
                                                    }
                                                    elseif(strpos($discussion->creditor_site, "insta")){
                                                        $img = "ig-credit.png";
                                                        $lnk = "https://www.instagram.com";
                                                    }
                                                    ?>
                                                <a href="<?=$lnk?>"  target="_BLANK"  class="fb-1" style="display: none">
                                                     <img src="<?=  base_url()?>assets/public/img/<?=$img?>" style="width: 22px;"> 
                                                </a>
                                            <?php } ?>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="wrap-bottom-avatar">
                                    <div class="media-left up-triangle-res">
                                        <?php
                                        if (isset($userid) && !empty($userid) && isset($victory[$discussion->anime_discussionid]) && !empty($victory[$discussion->anime_discussionid])) {
                                            if (in_array($userid, $victory[$discussion->anime_discussionid])) {
                                                ?>
                                                <a href="javascript:void(0)" class="pad-l-10" onclick="ondiscussionvictory(this.id)" id="resvic_<?php echo $discussion->anime_discussionid; ?>">
                                                    <img class="up-scroll"  id="res-like_<?php echo $discussion->anime_discussionid; ?>"  src="<?php echo base_url(); ?>assets/public/img/up-triangle-hover.png">
                                                </a>
                                                <?php
                                            } else {
                                                ?>  
                                                <a href="javascript:void(0)"class="pad-l-10" onclick="ondiscussionvictory(this.id)" id="resvic_<?php echo $discussion->anime_discussionid; ?>">
                                                    <img class="up-scroll"  id="res-like_<?php echo $discussion->anime_discussionid; ?>" src="<?php echo base_url(); ?>assets/public/img/up-triangle.png">
                                                </a>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <a href="javascript:void(0)" class="pad-l-10" onclick="ondiscussionvictory(this.id)" id="resvic_<?php echo $discussion->anime_discussionid; ?>">
                                                <img class="up-scroll"  id="res-like_<?php echo $discussion->anime_discussionid; ?>"  src="<?php echo base_url(); ?>assets/public/img/up-triangle.png">
                                            </a>
                                            <?php
                                        }
                                        ?>

                                        <div class="rating" id="respoints_<?php echo $discussion->anime_discussionid; ?>"><?php echo $total_point; ?></div>
                                        <?php
                                        if (isset($userid) && !empty($userid) && isset($defact[$discussion->anime_discussionid]) && !empty($defact[$discussion->anime_discussionid])) {
                                            if (in_array($userid, $defact[$discussion->anime_discussionid])) {
                                                ?>
                                                <a href="javascript:void(0)"class="pad-l-10"onclick="ondiscussiondefeat(this.id)" id="resdef_<?php echo $discussion->anime_discussionid; ?>">
                                                    <img class="down-scroll"  id="res-dislike_<?php echo $discussion->anime_discussionid; ?>" src="<?php echo base_url(); ?>assets/public/img/down-triangle-hover.png">
                                                </a>
                                                <?php
                                            } else {
                                                ?> 
                                                <a href="javascript:void(0)" class="pad-l-10" onclick="ondiscussiondefeat(this.id)" id="resdef_<?php echo $discussion->anime_discussionid; ?>">
                                                    <img class="down-scroll"   id="res-dislike_<?php echo $discussion->anime_discussionid; ?>" src="<?php echo base_url(); ?>assets/public/img/down-triangle.png">
                                                </a>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <a href="javascript:void(0)" class="pad-l-10" onclick="ondiscussiondefeat(this.id)" id="resdef_<?php echo $discussion->anime_discussionid; ?>">
                                                <img class="down-scroll"  id="res-dislike_<?php echo $discussion->anime_discussionid; ?>" src="<?php echo base_url(); ?>assets/public/img/down-triangle.png">
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="tag tag-minute">
                                        <span class = "normal-tag">theory</span>
                                        <?php if ($discussion->spoiler == 1) {
                                            ?>
                                            <span class="normal-tag red-tag">spoiler</span>
                                        <?php }
                                        if(!empty($discussion->creditor_author) AND !empty($discussion->creditor_site)){
                                        ?>
                                        <span  class="normal-tag disc-credit-show" data-credit="<?=$discussion->creditor_author?>">Credit</span>
                                            <a href="javascript:void(0)" class="fb-1" style="display: none">
                                                <?php 
                                                $img = "fb-credit.png";
                                                if(strpos($discussion->creditor_site, "facebook")){
                                                    $img = "fb-credit.png";
                                                }
                                                elseif(strpos($discussion->creditor_site, "twitter")){
                                                    $img = "tt-credit.png";
                                                }
                                                elseif(strpos($discussion->creditor_site, "insta")){
                                                    $img = "ig-credit.png";
                                                }
                                                ?>
                                                <img src="<?=  base_url()?>assets/public/img/<?=$img?>" style="width: 22px;">
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>

                    <!--avatar -->

                    <div class="col-md-12 wraper-discuss-click">
                        <div class="title-discuss-click">
                            <a href="javascript:void(0)" >
                                <?php echo $discussion->title; ?>
                            </a>
                        </div>
                        <div class="field-discuss">
                            <div id="desc-original" class="discuss-desc">
                                <?= $discussion->description?>
                            </div>
                            <div class="edit-disc-desc" id="edit-desc" style="display: none">
                                <form action="#" method="POST" id="form-edit-discussion">
                                    <textarea name="descussion_description" class="form-control" id="desc-textarea"><?php echo $discussion->description; ?></textarea>
                                </form>
                            </div>
                            
                                <?php
//                                $myfile = getcwd() . '/uploads/discussion/' . $discussion->discussion_file;
//                                echo "<p>".file_get_contents($myfile)."</p>";
                                
                                ?>
                            </p>
                        </div>

                        <div class="share-fifth-click">
                            <!--social share -->
                            <div class="social-share">
                                <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank" class="btn-fb-share" style="margin-left: 0px !important;">
                                    <span>Share</span>
                                </a>
                                <a data-count="vertical" data-via="your_screen_name" data-hashtags="mayur8189" href="https://twitter.com/share" target="_blank" class="btn-tt-share">
                                    <span>Share</span>
                                </a>
                            </div>
                        </div>

                    </div>
                    <!-- wraper-view -->
                    <script>function fbs_click() {
                            u = location.href;
                            t = document.title;
                            window.open('http://www.facebook.com/sharer.php?u=' + encodeURIComponent(u) + '&t=' + encodeURIComponent(t), 'sharer', 'toolbar=0,status=0,width=626,height=436');
                            return false;
                        }</script>
                    <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
                    <div class="tab-comment">
                        <ul id="pop" class="nav pop-tabs pop-view" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#popular" role="tab" data-toggle="tab" aria-controls="popular" aria-expanded="true">Popular</a>
                            </li>
                            <li role="presentation" class="mar-lm-5" id="fresh1">
                                <a href="#news" role="tab" data-toggle="tab" aria-controls="news">News</a>
                            </li>
                            <li style="float:right;">
                                <div class="comment-status" ><a href="#" id="distoggler-<?php echo $discussion->anime_discussionid . "yy"; ?>"><?php
                                        $total_comment = $discussion->total_comment;
                                        if (!empty($total_comment)) {
                                            echo $total_comment;
                                        } else {
                                            echo '0';
                                        }
                                        ?> </a><a>Comments</a></div>
                            </li>
                        </ul>
                        <hr/>

                        <div class="tab-content">
                            <!-- popular--><div class="text-comment">
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
                                    <div class="input-text-comment" id="enterfield<?php echo $discussion->anime_discussionid;
                                    ?>">




                                        <input type="hidden" name="anime_discussionid" value="<?php echo $discussion->anime_discussionid; ?>">
                                        <div class="show-upload" style="display: none">
                                            <input type="file"  name="userfile" size="20" id="discussion_click" onchange="readURL(this)"/>
                                        </div>

                                        <div class="preview_image" style="display: none">
                                            <div id="rem_1">
                                                <img id="show" src="" alt="" width="120px;" height="120px;" style="margin-bottom: 5px; margin-top: 5px;" />
                                                <i class="fa fa-remove remove" href="javascript:void(0);" style="margin-top: -72px; margin-right: 0px; margin-left: -4px; color: red; cursor: pointer; cursor: hand;"></i>
                                            </div>
                                        </div>


                                        <textarea class="form-control form-comment textarea-box" id="disaddCommentBox<?php echo $discussion->anime_discussionid; ?>" name="commentss" rows="3" placeholder="What's on your mind"></textarea>

                                        <div class="post-comment">

                                            <div class="added-image"></div>

                                            <div class="another-post">
                                                <a href="#" class="photo"> 
                                                    <i class="fa fa-picture-o image_upload"></i> 
                                                </a> 
                                                <button type="submit" class="btn pull-right small-btn green-bg comment-btn discommentPostBtn" id="<?php echo $discussion->anime_discussionid; ?>">
                                                    Comment
                                                </button>
                                            </div>
                                        </div>


                                        <span id="diswordcount<?php echo $discussion->anime_discussionid; ?>" class="value-box diswordcount">1000</span>

                                    </div>

                                <?php } else {
                                    ?>
                                    <div class="input-text-comment" id="enterfield<?php echo $discussion->anime_discussionid; ?>">

                                        <textarea class="form-control form-comment" readonly="" rows="3"name="commentss" required="" id="discmtbox" placeholder="What's on your mind"></textarea>
                                        <div class="post-comment">

                                            <div class="added-image"></div>

                                            <div class="another-post">
                                                <a href="#" class="photo"> 
                                                    <i class="fa fa-picture-o image_upload"></i> 
                                                </a> 
                                                <button type="submit" class="btn pull-right small-btn green-bg comment-btn discommentPostBtn" id="<?php echo $discussion->anime_discussionid; ?>">
                                                    Comment
                                                </button>
                                            </div>
                                        </div>
                                        <p class="value-box">1000</p>
                                    

                                    </div>

                                <?php } ?>


                            </div>
                            <div class="animation_image" style="margin-right: auto;margin-left: auto;" align="center"><img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif" class="img-responsive" style="width:40px"></div>
                            <div role="tabpanel" class="tab-pane active" id="popular">
                                <div id="discmt_<?php echo $discussion->anime_discussionid; ?>">
                                </div>
                            </div>
                            <!-- tab panel -->

                            <div role="tabpanel" class="tab-pane" id="news">

                                <div id="disct_<?php echo $discussion->anime_discussionid; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 ads-view">
                    <div class="box-center">
                        <?php echo $this->load->view('template/right_sidebar',array("discussion_detail_page" => true,
                            "recent_disc" => $recent_disc,
                            "discussion" => $discussion )); ?>
                    </div>
                </div>

            </div>
        </div>
        <script>
            var discussion_id = "<?php echo $discussion->anime_discussionid; ?>";
        </script>
    </section>
<?php } ?>
<script>
    $(document).ready(function () {
        $(".image_upload").click(function (e) {
            e.preventDefault();
            $('#discussion_click').click();

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
                $('#discussion_click').val("");
            })
                    );
        }
    }

    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    }
    ;

</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/public/js/discussion_single.js"></script>