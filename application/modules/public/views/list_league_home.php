 
<div classs="row">
    <div class="col-md-12 wrap-main">

        <?php
        if (count($league_details) > 0 && !empty($league_details)) {
            foreach ($league_details as $anim_img) {
                ?>
                <!--wrapper avatar-->
                <div class="wrapper-avatar ">
                    <input type="hidden" name="total_groups" class="total_groups" value="<?php echo isset($total_groups) ? $total_groups : 0; ?>"/>
                    <input type="hidden" name="pageload" id="pageload" />
                    <div class="media info-avatar">
                        <div class="media-left">
                            <a href="<?php echo base_url(); ?>animemoment-profile/<?php echo $anim_img->user_name ?>">
                                <?php
                                if (isset($anim_img->user_image)) {
                                    ?>
                                    <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>uploads/users/<?php echo $anim_img->user_image; ?>" alt="<?php echo $anim_img->user_name; ?>"> 
                                    <?php
                                } else {
                                    ?>
                                    <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>assets/public/img/admin.png" alt="profile pic">
                                    <?php
                                }
                                ?>

                            </a>
                        </div>
                        <div class="media-body w-2000">
                            <a href="<?php echo base_url(); ?>animemoment_profile/<?php echo $anim_img->user_name ?>"><h5><?php echo isset($anim_img->user_name) ? $anim_img->user_name : "Admin"; ?></h5></a>

                            <div class="col-md-12 no-padding">
                                <span class="minute" style="display: inline" data-livestamp="<?php echo strtotime($anim_img->leagueimage_timestamp); ?>"></span>
                                <span class="minute" style="display: inline;">to <a href="javascript:void(0)" class="minute">  /a/onepiece</a></span>

                            </div>
                            <span style="display: none" id="creditt<?php echo $anim_img->leagueimage_id; ?>"><?php echo isset($anim_img->author) ? $anim_img->author : "Not Assign"; ?></span>
                            <div class="tag tag-index">
                                <?php
                                if (isset($anim_img->total_images_parent)) {

                                    if ($anim_img->total_images_parent > 0) {
                                        ?>
                                        <span id="album1" class="normal-tag tag-album">album</span>

                                        <?php
                                    } else {
                                        if (!empty($anim_img->credit)) {
                                            ?>
                                            <span  class="normal-tag disc-credit-show" data-credit="<?= $anim_img->credit ?>">Credit</span>
                                            <?php
                                            $img = "fb-credit.png";
                                            $lnk = "https://www.facebook.com/";

                                            if (strpos($anim_img->author, "facebook")) {
                                                $img = "fb-credit.png";
                                                $lnk = "https://www.facebook.com/";
                                            } elseif (strpos($anim_img->author, "twitter")) {
                                                $img = "tt-credit.png";
                                                $lnk = "https://twitter.com/";
                                            } elseif (strpos($anim_img->author, "insta")) {
                                                $img = "ig-credit.png";
                                                $lnk = "https://www.instagram.com";
                                            }
                                            ?>
                                            <a href="<?= $lnk ?>"  target="_BLANK"  class="fb-1" style="display: none">
                                                <img src="<?= base_url() ?>assets/public/img/<?= $img ?>" style="width: 22px;"> 
                                            </a>
                                            <?php
                                        }
                                    }
                                }

                                if ($anim_img->image_spoiler == 1) {
//                                    if ($anim_img->spoiler == 1) {
                                    ?>
                                    <span class="red-tag">spoiler</span>
                                    <?php
//                                    }
                                }
                                ?>



                            </div>
                        </div>
                        <div class="row col-lg-12 container-fluid" style="width:auto;">
                            <input style="display:none" readonly="readonly" type="text" class="form-group col-sm-12 cpylink" id="<?php echo "copytext_" . $anim_img->leagueimage_id; ?>" value="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>">
                        </div>

                    </div>
                    <h3>
                        <?php
                        if ($anim_img->leagueimage_maintitle === "") {
                            ?>
                            <a class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>"><?php echo $anim_img->leagueimage_name; ?></a>
                            <?php
                        } else {
                            ?>
                            <a class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>"><?php echo $anim_img->leagueimage_maintitle; ?></a>
                        <?php } ?>
                    </h3>


                    <?php
                    $category = $anim_img->category_name;

                    if (isset($anim_img->total_images_parent)) {
                        if ($anim_img->total_images_parent > 0) {
                            if ($category != 'Video') {

                                $al = explode(",", $anim_img->le_parentid);
                                $al_img = explode(",", $anim_img->le_parentimg);
                                ?>
                                <div href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>" class="wrap-avatar-img">
                                    <img src="<?php echo base_url(); ?>uploads/league/<?php echo $anim_img->leagueimage_filename; ?>" alt="ace" class="img-responsive meme-big" />
                                    <a class="album-more" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>" target="_blank">View Album (<?php echo count($al); ?>)<span class="shadow"></span></a>
                                </div>


                                <?php
                            } else if ($category == 'Video') {
                                ?>

                                <a class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>">
                                    <div class="meme-img col-sm-12" ><?php echo $anim_img->leagueimage_filename; ?></div>
                                </a>

                                <?php
                            }
                            ?>

                            <?php
                        } else if ($category != 'Video') {
                            $ext = array();
                            $ext = explode(".", $anim_img->leagueimage_filename);

                            if ($ext[1] == "gif") {
                                ?>
                                <div class="clear"></div>
                                <div id="video_<?php echo $anim_img->leagueimage_id; ?>" class="video">

                                    <a class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>">
                                        <img  class = "img-responsive meme-big" src="<?php echo base_url(); ?>uploads/league/<?php echo $anim_img->leagueimage_filename; ?>" alt="<?php echo $anim_img->leagueimage_name; ?>">
                                    </a>

                                </div>

                                <!--meme-img-->

                                <?php
                            } else {

                                if (!$this->session->userdata('user_id')) {

                                    if ($anim_img->image_spoiler == 1) {
                                        ?>
                                        <a id="get_image" class="get_image" href="javascript:void(0);" onclick="spoilerImage()"> 
                                            <img class = "img-responsive meme-big" id="not_safe" src="<?php echo base_url(); ?>assets/public/img/spoiler.png" alt="<?php echo $anim_img->leagueimage_name; ?>">
                                        </a>
                                        <a data-toggle="modal" href="javascript:void(0);" data-target="#login" id="login_click" style="float: right; display:none">Login</a>
                                    <?php } else if ($anim_img->image_nsfw == 1) {
                                        ?>

                                        <a id="get_image" class="get_image" href="javascript:void(0);" onclick="spoilerImage()"> 
                                            <img class = "img-responsive meme-big" id="not_safe" src="<?php echo base_url(); ?>assets/public/img/nsfw.png" alt="<?php echo $anim_img->leagueimage_name; ?>">
                                        </a>
                                        <a data-toggle="modal" href="javascript:void(0);" data-target="#login" id="login_click" style="float: right; display:none">Login</a>
                                    <?php } else { ?> 
                                        <a id="get_image" class="get_image" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>"> 
                                            <img class = "img-responsive meme-big" id="not_safe" src="<?php echo base_url(); ?>uploads/league/<?php echo $anim_img->leagueimage_filename; ?>" alt="<?php echo $anim_img->leagueimage_name; ?>">
                                        </a>
                                        <?php
                                    }
                                } else {
                                    if ($anim_img->image_nsfw == 0 && $anim_img->image_spoiler == 0) {
                                        ?>
                                        <a id="spoiler_image" class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>"> 
                                            <img  id="image1" class = "img-responsive meme-big" src="<?php echo base_url(); ?>uploads/league/<?php echo $anim_img->leagueimage_filename; ?>" alt="<?php echo $anim_img->leagueimage_name; ?>">
                                        </a> 
                                        <?php
                                    } else if ($anim_img->image_nsfw == 1 && $anim_img->image_spoiler == 0) {
                                        if ($anim_img->image_nsfw == 1) {
                                            ?>
                                            <a id="spoiler_image" class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>"> 
                                                <img  id="image1" class = "img-responsive meme-big" src="<?php echo base_url(); ?>assets/public/img/nsfw.png" alt="<?php echo $anim_img->leagueimage_name; ?>">
                                            </a> 

                                        <?php } else { ?>
                                            <a id="spoiler_image" class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>"> 
                                                <img  id="image1" class = "img-responsive meme-big" src="<?php echo base_url(); ?>uploads/league/<?php echo $anim_img->leagueimage_filename; ?>" alt="<?php echo $anim_img->leagueimage_name; ?>">
                                            </a> 
                                            <?php
                                        }
                                    } else if ($anim_img->image_nsfw == 1 && $anim_img->image_spoiler == 1) {
                                        if ($anim_img->image_nsfw == 1) {
                                            ?>
                                            <a id="spoiler_image" class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>"> 
                                                <img  id="image1" class = "img-responsive meme-big" src="<?php echo base_url(); ?>assets/public/img/nsfw.png" alt="<?php echo $anim_img->leagueimage_name; ?>">
                                            </a>

                                        <?php } else { ?>
                                            <a id="spoiler_image" class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>"> 
                                                <img  id="image1" class = "img-responsive meme-big" src="<?php echo base_url(); ?>uploads/league/<?php echo $anim_img->leagueimage_filename; ?>" alt="<?php echo $anim_img->leagueimage_name; ?>">
                                            </a> 
                                            <?php
                                        }
                                    }
                                }
                            }
                        } else if ($category == 'Video') {
                            ?>

                            <a class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>">
                                <div class="meme-img col-sm-12" ><?php echo $anim_img->leagueimage_filename; ?></div>
                            </a>
                            <?php
                        }
                    }
                    ?>
                    <!--like-->
                    <div class="link-comment" >
                        <?php
                        $total_point = ((int) $anim_img->total_victory) - ((int) $anim_img->total_defeat);
                        ?>

                        <a id="point_<?php echo $anim_img->leagueimage_id; ?>"><?php echo $total_point; ?> </a> <a>Likes</a> &nbsp; - &nbsp;
                        <a>
                            <?php
                            $total_comment = $anim_img->total_comment;
                            if (!empty($total_comment)) {
                                echo $total_comment;
                            } else {
                                echo '0';
                            }
                            ?>
                            <span>Comments</span></a>  

                    </div>

                    <div class="shares">
                        <!-- update -->
                        <div class="link-icon pull-left">
                            <ul class="list-unstyled left-link">
                                <?php
                                if (isset($userid) && !empty($userid) && isset($victory[$anim_img->leagueimage_id]) && !empty($victory[$anim_img->leagueimage_id])) {
                                    if (in_array($userid, $victory[$anim_img->leagueimage_id])) {
                                        ?>
                                        <li>
                                            <a onClick = "onvictory(this.id);" id = "<?php echo $anim_img->leagueimage_id; ?>" style = "cursor: pointer" rel = "<?php echo $anim_img->leagueimage_id; ?>"class="hvr-bounce-in">
                                                <img id="victory_img_<?php echo $anim_img->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/up-hover.png">
                                                <!--<i  class = "fa fa-arrow-up fa-lg victory_active"></i>-->
                                            </a>
                                        </li>
                                        <?php
                                    } else {
                                        ?> 
                                        <li>
                                            <a onClick = "onvictory(this.id);" id = "<?php echo $anim_img->leagueimage_id; ?>" style = "cursor: pointer" rel = "<?php echo $anim_img->leagueimage_id; ?>"  class="hvr-bounce-in">
                                                <img id="victory_img_<?php echo $anim_img->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/up.png" >
                                            </a>
                                        </li>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <li>
                                        <a onClick = "onvictory(this.id);" id = "<?php echo $anim_img->leagueimage_id; ?>" style = "cursor: pointer" rel = "<?php echo $anim_img->leagueimage_id; ?>"  class="hvr-bounce-in">
                                            <img id="victory_img_<?php echo $anim_img->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/up.png" >
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>

                                <?php
                                if (isset($userid) && !empty($userid) && isset($defact[$anim_img->leagueimage_id]) && !empty($defact[$anim_img->leagueimage_id])) {
                                    if (in_array($userid, $defact[$anim_img->leagueimage_id])) {
                                        ?>
                                        <li>
                                            <a class="hvr-bounce-in" onClick="ondefeat(this.id)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>">
                                                <img id="defeat_img_<?php echo $anim_img->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/down-hover.png" >
                                            </a>
                                        </li>
                                        <?php
                                    } else {
                                        ?> 
                                        <li>
                                            <a class="hvr-bounce-in" onClick="ondefeat(this.id)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>">
                                                <img id="defeat_img_<?php echo $anim_img->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/down.png" >
                                            </a>
                                        </li>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <li>
                                        <a  class="hvr-bounce-in" onClick="ondefeat(this.id)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>">
                                            <img id="defeat_img_<?php echo $anim_img->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/down.png" >
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                                <li>
                                    <a  href = "<?php echo base_url() . $anim_img->leagueimage_id; ?>#cmtclick" class="hvr-bounce-in">
                                        <img src="<?php echo base_url(); ?>assets/public/img/icon/post/comment.png" >
                                    </a>
                                </li>
                                <?php
                                if (isset($userid) && !empty($userid) && isset($favuserid[$anim_img->leagueimage_id]) && !empty($favuserid[$anim_img->leagueimage_id])) {

                                    if (in_array($userid, $favuserid[$anim_img->leagueimage_id])) {
                                        ?>
                                        <li>
                                            <a class="hvr-bounce-in" onclick="onfavourites(this.id)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>">
                                                <img id="favourites_img_<?php echo $anim_img->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/open-hover.png" >
                                            </a>
                                        </li>

                                        <?php
                                    } else {
                                        ?> 
                                        <li>
                                            <a class="hvr-bounce-in" onclick="onfavourites(this.id)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>">
                                                <img id="favourites_img_<?php echo $anim_img->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/open.png" >
                                            </a>
                                        </li>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <li>
                                        <a class="hvr-bounce-in" onclick="onfavourites(this.id)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>">
                                            <img id="favourites_img_<?php echo $anim_img->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/open.png" >
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                                <li class="js-textareacopybtn" title="click to copy " id="<?php echo "copy_" . $anim_img->leagueimage_id; ?>" value="<?php echo $anim_img->leagueimage_id; ?>">
                                    <a href = "javascript:void(0);" class="hvr-bounce-in">
                                        <img src="<?php echo base_url(); ?>assets/public/img/icon/post/link.png" >
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- social -->
                        <div class="pull-right social-btn">
                            <script>
                                function fbs_click() {
                                    u = location.href;
                                    t = document.title;
                                    window.open('http://www.facebook.com/sharer.php?u=' + encodeURIComponent(u) + '&t=' + encodeURIComponent(t), 'sharer', 'toolbar=0,status=0,width=626,height=436');
                                    return false;
                                }
                            </script>
                            <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script> 
                            <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank" class="fb-bg medium-btn mar-r-5">
                                <i class="fa fa-facebook"></i> share
                            </a>

                            <a  data-count="vertical" data-via="your_screen_name" data-hashtags="mayur8189" href="https://twitter.com/share" class="tw-bg medium-btn">
                                <i class="fa fa-twitter"></i> share
                            </a>
                        </div>
                    </div>
                    <!-- end shares-->

                    <div class="clearfix"></div>
                    <?php
                    $tags = isset($anim_img->tags) ? $anim_img->tags : '';
                    if (empty($tags)) {
                        ?>
                        <div class="hastag" style="display: none"></div>
                        <?php
                    } else {
                        ?>
                        <div class="hastag">
                            <?php
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
                    <?php } ?>
                </div>

                <!-- wrapper avatar -->



                <?php
            }
        } else {
            if ($scroll == 0) {
                ?>
                <div> 
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> No League found  
                    </div>
                </div>
                <?php
            }
        }
        ?>

    </div>

    <!--end col-md-12-->

</div>     

<script type="text/javascript">
    function spoilerImage() {
        $('#login').modal('show');
    }
</script>