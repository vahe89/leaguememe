<div class="col-md-12">
    
    <?php foreach ($anime_list_album_name as $anime_list) {
        ?>
        <!--wrapper avatar-->
        <div class="wrapper-avatar ">
            <input type="hidden" name="total_groups" class="total_groups" value="<?php echo isset($total_groups) ? $total_groups : 0; ?>"/>
                <div class="media info-avatar">
                    <div class="media-left">
                        <a href="">
                            <!--<img class="media-object avatar" src="<?php echo base_url(); ?>assets/public/img/admin.png" alt="...">-->
                            <?php
                            if (isset($anime_list->user_image)) {
                                ?>
                                <a href="<?php echo base_url(); ?>animemoment_profile/<?php echo $anime_list->user_name ?>"><img class="media-object avatar img-circle" src="<?php echo base_url(); ?>uploads/users/<?php echo $anime_list->user_image; ?>" alt="<?php echo $anime_list->user_name; ?>"></a>
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
                        <a href="<?php echo base_url(); ?>animemoment_profile/<?php echo $anime_list->user_name ?>"><h5><?php echo isset($anime_list->user_name) ? $anime_list->user_name : "Admin"; ?></h5></a>

                        <span class="minute" data-livestamp="<?php echo strtotime($anime_list->leagueimage_timestamp); ?>"><?php echo strtotime($anime_list->leagueimage_timestamp); ?> <a href="" class="minute">/a/onepiece</a></span>
                        <span style="display: none" id="creditt<?php echo $anime_list->leagueimage_id; ?>"><?php echo isset($anime_list->author) ? $anime_list->author : "Not Assign"; ?></span>
                        <div class="tag tag-index">
                            <?php
                            if (isset($anime_list->total_images_parent)) {

                                if ($anime_list->total_images_parent > 0) {
                                    ?>
                                    <span id="album1" class="normal-tag tag-album">album</span>

                                    <?php
                                } else {
                                    ?>
                                    <?Php
                                    if (isset($anime_list->credit)) {
                                        ?>
                                        <span id="credit<?php echo $anime_list->leagueimage_id; ?>" onClick="javascript:changeText('<?php echo $anime_list->leagueimage_id; ?>')" class="normal-tag">Credit</span>

                                        <?php $dd = explode(".", $anime_list->credit); ?>
                                        <a href="" class="fb-1">
                                            <img src="<?php echo base_url(); ?>assets/public/img/<?php echo isset($dd[1]) ? $dd[1] : 'pro-pic'; ?>.png">
                                        </a>
                                        <?php
                                    } else {
                                        ?>
                                        <span id="credit<?php echo $anime_list->leagueimage_id; ?>" onClick="javascript:changeText('<?php echo $anime_list->leagueimage_id; ?>')" class="normal-tag">Credit</span>

                                        <?php $dd = explode(".", $anime_list->credit); ?>
                                        <a href="" class="fb-1">
                                            <img src="<?php echo base_url(); ?>assets/public/img/<?php echo isset($dd[1]) ? $dd[1] : 'pro-pic'; ?>.png">
                                        </a>


                                        <?php
                                    }
                                }
                            }
                            ?>
                            <?php
                            if ($anime_list->image_spoiler == 1) {
                                ?>
                                <span class="red-tag">spoiler</span>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                    <div class="row col-lg-12 container-fluid" style="width:auto;">
                        <input style="display:none" readonly="readonly" type="text" class="form-group col-sm-12 cpylink" id="<?php echo "copytext_" . $anime_list->leagueimage_id; ?>" value="<?php echo base_url(); ?><?php echo $anime_list->leagueimage_id; ?>">
                    </div>

                    <!--<div class="media-body">
                            <span><img src="<?php echo base_url(); ?>assets/public/img/icon/post/click.png"></span>&nbsp;&nbsp;
                            <a href=""><span class="linky">One Piece</span></a>
                          </div>-->
                </div>
                <h3>
                    <?php
                    if ($anime_list->leagueimage_maintitle === "") {
                        ?>
                        <a class="image1" href="<?php echo base_url(); ?><?php echo $anime_list->leagueimage_id; ?>"><?php echo $anime_list->leagueimage_name; ?></a>
                        <?php
                    } else {
                        ?>
                        <a class="image1" href="<?php echo base_url(); ?><?php echo $anime_list->leagueimage_id; ?>"><?php echo $anime_list->leagueimage_maintitle; ?></a>
                    <?php } ?>
                </h3>


                <?php
                $category = $anime_list->category_name;
                if (isset($anime_list->total_images_parent)) {
                    if ($anime_list->total_images_parent > 0) {
                        if ($category != 'Video') {

                            $al = explode(",", $anime_list->le_parentid);
                            $al_img = explode(",", $anime_list->le_parentimg);
                            ?>
                            <div class="album-wraper-index row" style="margin-left: -5px;">
                                <div class="left-side-album">
                                    <a href="<?php echo base_url(); ?><?php echo $anime_list->leagueimage_id; ?>">
                                        <img class="img-responsive album-responsive-main" alt="ace" src="<?php echo base_url(); ?>uploads/league/<?php echo $anime_list->leagueimage_filename; ?>">
                                    </a>
                                </div>
                                <div class="right-side-album">
                                    <?php
                                    $more = count($al) - 4;
                                    for ($l = 0; $l < count($al); $l++) {
                                        $img_id = trim($al[$l], "^^%%^^");
                                        $img = trim($al_img[$l], "^^%%^^");

                                        if (isset($img_id) && !empty($img_id)) {
                                            if ($l < 2) {
                                                ?>
                                                <div class="top-album">
                                                    <a href="<?php echo base_url(); ?><?php echo $anime_list->leagueimage_id; ?>">
                                                        <img class="img-responsive album-responsive" src="<?php echo base_url(); ?>uploads/league/<?php echo $img; ?>">
                                                    </a>
                                                </div>

                                                <?php
                                            } else {
                                                if ($l == 2) {
                                                    ?>
                                                    <div class="top-album">
                                                        <a href="<?php echo base_url(); ?><?php echo $anime_list->leagueimage_id; ?>">
                                                            <img class="img-responsive album-responsive" src="<?php echo base_url(); ?>uploads/league/<?php echo $img; ?>">
                                                            <?php if ($more === -1) {
                                                                ?>

                                                                <?php
                                                            } else {
                                                                ?>
                                                                <div class="overlay-album">
                                                                    <div class="caption-album">
                                                                        +&nbsp;<?php echo $more + 1; ?>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>

                                                        </a>
                                                    </div>
                                                    <?php
                                                    break;
                                                } else {
                                                    ?>
                                                    <div class="top-album">
                                                        <a href="<?php echo base_url(); ?><?php echo $anime_list->leagueimage_id; ?>">
                                                            <img class="img-responsive album-responsive" src="<?php echo base_url(); ?>uploads/league/<?php echo $img; ?>">
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <?php
                        } else if ($category == 'Video') {
                            ?>

                            <a class="image1" href="<?php echo base_url(); ?><?php echo $anime_list->leagueimage_id; ?>">
                                <div class="meme-img col-sm-12" ><?php echo $anime_list->leagueimage_filename; ?></div>
                            </a>
                            <?php
                        }
                        ?>

                        <?php
                    } else {
                        if ($category != 'Video') {
                            $ext = array();
                            $ext = explode(".", $anime_list->leagueimage_filename);
                            if ($ext[1] == "gif") {
                                ?>
                                <div class="clear"></div>
                                <div id="video_<?php echo $anime_list->leagueimage_id; ?>" class="video">
                                    <!--<video width="100%" controls=""id="v<?php /* echo $anime_list->leagueimage_id; */ ?>"  loop="">
                                        <source src="<?php /* echo base_url(); */ ?>uploads/league/mp4/<?php /* echo $anime_list->videoname; */ ?>" type="video/webm">
                                    </video>-->
                                    <!--<img src="<?php /* echo base_url(); */ ?>uploads/league/<?php /* echo $anime_list->leagueimage_filename; */ ?>" />
                                    <span class="play">Gif</span>-->

                                    <a class="image1" href="<?php echo base_url(); ?><?php echo $anime_list->leagueimage_id; ?>">
                                        <img  class = "post-image img-responsive meme-big" src="<?php echo base_url(); ?>uploads/league/<?php echo $anime_list->leagueimage_filename; ?>" alt="<?php echo $anime_list->leagueimage_name; ?>">
                                    </a>

                                </div>

                                <!--meme-img-->
                                <?php
                            } else {
                                ?>

                                <a class="image1" href="<?php echo base_url(); ?><?php echo $anime_list->leagueimage_id; ?>"> 
                                    <img  class = "post-image img-responsive meme-big" src="<?php echo base_url(); ?>uploads/league/<?php echo $anime_list->leagueimage_filename; ?>" alt="<?php echo $anime_list->leagueimage_name; ?>">
                                </a>
                                <?php
                            }
                        } else if ($category == 'Video') {
                            ?>

                            <a class="image1" href="<?php echo base_url(); ?><?php echo $anime_list->leagueimage_id; ?>">
                                <div class="meme-img col-sm-12" ><?php echo $anime_list->leagueimage_filename; ?></div>
                            </a>
                            <?php
                        }
                    }
                }
                ?>
                <!--like-->
                <div class="link-comment " >

                    <?php
                    $total_point = ((int) $anime_list->total_victory) - ((int) $anime_list->total_defeat);
                    ?>

                    <a id="point_<?php echo $anime_list->leagueimage_id; ?>"><?php echo $total_point; ?> </a> <a>Likes</a> &nbsp; - &nbsp;
                    <a  >
                        <?php
                        $total_comment = $anime_list->total_comment;
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
                            if (isset($userid) && !empty($userid) && isset($victory[$anime_list->leagueimage_id]) && !empty($victory[$anime_list->leagueimage_id])) {
                                if (in_array($userid, $victory[$anime_list->leagueimage_id])) {
                                    ?>
                                    <li>
                                        <a onClick = "onvictory(this.id);" id = "<?php echo $anime_list->leagueimage_id; ?>" style = "cursor: pointer" rel = "<?php echo $anime_list->leagueimage_id; ?>"class="hvr-bounce-in">
                                            <img id="victory_img_<?php echo $anime_list->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/up-hover.png">
                                            <!--<i  class = "fa fa-arrow-up fa-lg victory_active"></i>-->
                                        </a>
                                    </li>
                                    <?php
                                } else {
                                    ?> 
                                    <li>
                                        <a onClick = "onvictory(this.id);" id = "<?php echo $anime_list->leagueimage_id; ?>" style = "cursor: pointer" rel = "<?php echo $anime_list->leagueimage_id; ?>"  class="hvr-bounce-in">
                                            <img id="victory_img_<?php echo $anime_list->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/up.png" >
                                        </a>
                                    </li>
                                    <?php
                                }
                            } else {
                                ?>
                                <li>
                                    <a onClick = "onvictory(this.id);" id = "<?php echo $anime_list->leagueimage_id; ?>" style = "cursor: pointer" rel = "<?php echo $anime_list->leagueimage_id; ?>"  class="hvr-bounce-in">
                                        <img id="victory_img_<?php echo $anime_list->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/up.png" >
                                    </a>
                                </li>
                                <?php
                            }
                            ?>

                            <?php
                            if (isset($userid) && !empty($userid) && isset($defact[$anime_list->leagueimage_id]) && !empty($defact[$anime_list->leagueimage_id])) {
                                if (in_array($userid, $defact[$anime_list->leagueimage_id])) {
                                    ?>
                                    <li>
                                        <a class="hvr-bounce-in" onClick="ondefeat(this.id)" id="<?php echo $anime_list->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anime_list->leagueimage_id; ?>">
                                            <img id="defeat_img_<?php echo $anime_list->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/down-hover.png" >
                                        </a>
                                    </li>
                                    <?php
                                } else {
                                    ?> 
                                    <li>
                                        <a class="hvr-bounce-in" onClick="ondefeat(this.id)" id="<?php echo $anime_list->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anime_list->leagueimage_id; ?>">
                                            <img id="defeat_img_<?php echo $anime_list->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/down.png" >
                                        </a>
                                    </li>
                                    <?php
                                }
                            } else {
                                ?>
                                <li>
                                    <a  class="hvr-bounce-in" onClick="ondefeat(this.id)" id="<?php echo $anime_list->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anime_list->leagueimage_id; ?>">
                                        <img id="defeat_img_<?php echo $anime_list->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/down.png" >
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                            <li>
                                <a  href = "<?php echo base_url() . $anime_list->leagueimage_id; ?>#cmtclick" class="hvr-bounce-in">
                                    <img src="<?php echo base_url(); ?>assets/public/img/icon/post/comment.png" >
                                </a>
                            </li>
                            <?php
                            if (isset($userid) && !empty($userid) && isset($favuserid[$anime_list->leagueimage_id]) && !empty($favuserid[$anime_list->leagueimage_id])) {

                                if (in_array($userid, $favuserid[$anime_list->leagueimage_id])) {
                                    ?>
                                    <li>
                                        <a class="hvr-bounce-in" onclick="onfavourites(this.id)" id="<?php echo $anime_list->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anime_list->leagueimage_id; ?>">
                                            <img id="favourites_img_<?php echo $anime_list->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/open-hover.png" >
                                        </a>
                                    </li>

                                    <?php
                                } else {
                                    ?> 
                                    <li>
                                        <a class="hvr-bounce-in" onclick="onfavourites(this.id)" id="<?php echo $anime_list->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anime_list->leagueimage_id; ?>">
                                            <img id="favourites_img_<?php echo $anime_list->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/open.png" >
                                        </a>
                                    </li>
                                    <?php
                                }
                            } else {
                                ?>
                                <li>
                                    <a class="hvr-bounce-in" onclick="onfavourites(this.id)" id="<?php echo $anime_list->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anime_list->leagueimage_id; ?>">
                                        <img id="favourites_img_<?php echo $anime_list->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/open.png" >
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                            <li class="js-textareacopybtn" title="click to copy " id="<?php echo "copy_" . $anime_list->leagueimage_id; ?>" value="<?php echo $anime_list->leagueimage_id; ?>">
                                <a href = "javascript:void(0);" class="hvr-bounce-in">
                                    <img src="<?php echo base_url(); ?>assets/public/img/icon/post/link.png" >
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- social -->
                    <div class="pull-right social-btn">
                        <script>function fbs_click() {
                                u = location.href;
                                t = document.title;
                                window.open('http://www.facebook.com/sharer.php?u=' + encodeURIComponent(u) + '&t=' + encodeURIComponent(t), 'sharer', 'toolbar=0,status=0,width=626,height=436');
                                return false;
                            }</script>
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
                $tags = isset($anime_list->tags) ? $anime_list->tags : '';
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
        <!--end col-md-12-->
        <?php
    }
    ?>
</div>
