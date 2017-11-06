<?php
if ($scroll == 0) {
    ?>
    <div class="well"> <?= (isset($league_name) && !empty($league_name)) ? "Searching result for tag '<span style='color:#a94442;'>" . $league_name . "</span>'" : "" ?></div>
    <?php
}
if (count($league_images) > 0 && !empty($league_images)) {
    foreach ($league_images as $anim_img) {

        //$allid = $main_category."-".$anim_img->leagueimage_id;
        ?>

        <div classs="row">
            <input type="hidden" name="total_groups" class="total_groups" value="<?php echo isset($total_groups) ? $total_groups : 0; ?>"/>

            <div class="col-md-12 col-xs-8 wrap-main">

                <!--wrapper avatar-->
                <div class="wrapper-avatar ">
                    <div class="media info-avatar">
                        <div class="media-left">
                            <a href="">
                                <!--<img class="media-object avatar" src="<?php echo base_url(); ?>assets/public/img/luffy.png" alt="...">-->
                                <?php
                                if (isset($anim_img->user_image)) {
                                    ?>
                                    <a href="<?php echo base_url(); ?>leaguememe_profile/<?php echo $anim_img->user_name ?>"><img class="media-object avatar img-circle" src="<?php echo base_url(); ?>uploads/users/<?php echo $anim_img->user_image; ?>" alt="<?php echo $anim_img->user_name; ?>"></a>
                                    <?php
                                } else {
                                    ?>
                                    <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>assets/public/img/default_profile.jpeg" alt="profile pic">
                                    <?php
                                }
                                ?>

                            </a>
                        </div>
                        <div class="media-body w-2000">
                            <a <?= isset($anim_img->user_name) ? 'href="'.base_url().'leaguememe_profile/'.$anim_img->user_name .'"' : ''?>><h5><?php echo isset($anim_img->user_name) ? $anim_img->user_name : "Admin"; ?></h5></a>
                            <div class="col-md-12 no-padding">
                                <span class="minute" data-livestamp="<?php echo strtotime($anim_img->leagueimage_timestamp); ?>"  style="display: inline"> </span> 
                                <!--<span class="minute" style="display: inline;">to <a href="javascript:void(0)" class="minute">  /a/onepiece</a></span>-->
                                
                            </div>
                            <span style="display: none" id="creditt<?php echo $anim_img->leagueimage_id; ?>"><?php echo isset($anim_img->author) ? $anim_img->author : "NOt Assign"; ?></span>
                            <div class="tag tag-index"> 
                                <?php if (!empty($anim_img->credit) AND ! empty($anim_img->author)) { ?>
                                    <span  class="normal-tag disc-credit-show" data-credit="<?= $anim_img->author ?>">Credit</span>
                                    <?php
                                    $img = "fb-credit.png";
                                    $lnk = "https://www.facebook.com/";

                                    if (strpos($anim_img->credit, "facebook")) {
                                        $img = "fb-credit.png";
                                        $lnk = "https://www.facebook.com/";
                                    } elseif (strpos($anim_img->credit, "twitter")) {
                                        $img = "tt-credit.png";
                                        $lnk = "https://twitter.com/";
                                    } elseif (strpos($anim_img->credit, "insta")) {
                                        $img = "ig-credit.png";
                                        $lnk = "https://www.instagram.com";
                                    }
                                    ?>
                                    <a href="<?= $lnk ?>"  target="_BLANK"  class="fb-1" style="display: none">
                                        <img src="<?= base_url() ?>assets/public/img/<?= $img ?>" style="width: 22px;"> 
                                    </a>
                                    <?php
                                }
                                if ($anim_img->spoiler == 1) {
                                    ?>
                                    <span class="red-tag">spoiler</span>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                        <div class="row col-lg-12 container-fluid" >
                            <input  data-toggle="tooltip"  title="Press Esc to close all link box  And Ctrl+ V to paste link " style="display:none" readonly="readonly" type="text" class="form-group col-sm-12 cpylink" id="<?php echo "copytext_" . $anim_img->leagueimage_id; ?>" value="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>">
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

                                <a class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>">
                                    <img  class = "post-image img-responsive meme-big" src="<?php echo base_url(); ?>uploads/league/<?php echo $anim_img->leagueimage_filename; ?>" alt="<?php echo $anim_img->leagueimage_name; ?>">
                                </a>

                            </div>

                            <!--meme-img-->
                            <?php
                        } else {
                            ?>

                            <a class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>"> 
                                <img  class = "post-image img-responsive meme-big" src="<?php echo base_url(); ?>uploads/league/<?php echo $anim_img->leagueimage_filename; ?>" alt="<?php echo $anim_img->leagueimage_name; ?>">
                            </a>
                            <?php
                        }
                    } else if ($category == 'Video') {
                        ?>

                        <a class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>">
                            <div class="meme-img col-sm-12" ><?php echo $anim_img->leagueimage_filename; ?></div>
                        </a>
                    <?php } ?>
                    <!--like-->
                    <div class="link-comment " >

                        <?php
                        $total_point = ((int) $anim_img->total_victory) - ((int) $anim_img->total_defeat);
                        ?>

                        <a id="point_<?php echo $anim_img->leagueimage_id; ?>"><?php echo $total_point; ?> </a> <a>Likes</a> &nbsp; - &nbsp;
                        <a  >
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
                                                <img id="victory_img_<?php echo $anim_img->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/up-hover.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/icon/post/up-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/icon/post/up-hover.png"; ?>'">
                                                <!--<i  class = "fa fa-arrow-up fa-lg victory_active"></i>-->
                                            </a>
                                        </li>
                                        <?php
                                    } else {
                                        ?> 
                                        <li>
                                            <a onClick = "onvictory(this.id);" id = "<?php echo $anim_img->leagueimage_id; ?>" style = "cursor: pointer" rel = "<?php echo $anim_img->leagueimage_id; ?>"  class="hvr-bounce-in">
                                                <img id="victory_img_<?php echo $anim_img->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/up.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/icon/post/up-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/icon/post/up.png"; ?>'">
                                            </a>
                                        </li>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <li>
                                        <a onClick = "onvictory(this.id);" id = "<?php echo $anim_img->leagueimage_id; ?>" style = "cursor: pointer" rel = "<?php echo $anim_img->leagueimage_id; ?>"  class="hvr-bounce-in">
                                            <img id="victory_img_<?php echo $anim_img->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/up.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/icon/post/up-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/icon/post/up.png"; ?>'">
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
                                                <img id="defeat_img_<?php echo $anim_img->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/down-hover.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/icon/post/down-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/icon/post/down-hover.png"; ?>'">
                                            </a>
                                        </li>
                                        <?php
                                    } else {
                                        ?> 
                                        <li>
                                            <a class="hvr-bounce-in" onClick="ondefeat(this.id)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>">
                                                <img id="defeat_img_<?php echo $anim_img->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/down.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/icon/post/down-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/icon/post/down.png"; ?>'">
                                            </a>
                                        </li>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <li>
                                        <a  class="hvr-bounce-in" onClick="ondefeat(this.id)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>">
                                            <img id="defeat_img_<?php echo $anim_img->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/down.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/icon/post/down-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/icon/post/down.png"; ?>'">
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                                <li>
                                    <a  href = "<?php echo base_url() . $anim_img->leagueimage_id; ?>#cmtclick" class="hvr-bounce-in">
                                        <img src="<?php echo base_url(); ?>assets/public/img/icon/post/comment.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/icon/post/comment-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/icon/post/comment.png"; ?>'">
                                    </a>
                                </li>
                                <?php
                                if (isset($userid) && !empty($userid) && isset($favuserid[$anim_img->leagueimage_id]) && !empty($favuserid[$anim_img->leagueimage_id])) {

                                    if (in_array($userid, $favuserid[$anim_img->leagueimage_id])) {
                                        ?>
                                        <li>
                                            <a class="hvr-bounce-in" onclick="onfavourites(this.id)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>">
                                                <img id="favourites_img_<?php echo $anim_img->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/open-hover.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/icon/post/open-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/icon/post/open-hover.png"; ?>'">
                                            </a>
                                        </li>

                                        <?php
                                    } else {
                                        ?> 
                                        <li>
                                            <a class="hvr-bounce-in" onclick="onfavourites(this.id)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>">
                                                <img id="favourites_img_<?php echo $anim_img->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/open.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/icon/post/open-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/icon/post/open.png"; ?>'">
                                            </a>
                                        </li>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <li>
                                        <a class="hvr-bounce-in" onclick="onfavourites(this.id)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>">
                                            <img id="favourites_img_<?php echo $anim_img->leagueimage_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/open.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/icon/post/open-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/icon/post/open.png"; ?>'">
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                                <li class="js-textareacopybtn" title="click to copy " id="<?php echo "copy_" . $anim_img->leagueimage_id; ?>" value="<?php echo $anim_img->leagueimage_id; ?>">
                                    <a href = "javascript:void(0);" class="hvr-bounce-in">
                                        <img src="<?php echo base_url(); ?>assets/public/img/icon/post/link.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/icon/post/link-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/icon/post/link.png"; ?>'">
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

            </div>
            <!--end col-md-12-->

        </div>

        <?php
    }
} else {
    if ($scroll == 0) {
        ?>
        <div> 
            <div class="alert alert-danger">
                <strong>Oops!</strong> No result found for tag <span class="alert-link">"<?= (isset($league_name) && !empty($league_name)) ? $league_name : "" ?>"</span>
            </div>
        </div>
        <?php
    }
}
?>
<script>
    $(document).keyup(function(e) {

        if (e.which === 27) { // escape key maps to keycode `27`
            $(".cpylink").hide();
        }
    });
    setTimeout(function() {
        $(".cpylink").hide();
        $('.subTab').each(function() {
            var subids = $(this).children().attr('id');
            var subclass = $('#' + subids).attr('class');
            if (subclass == "active") {
                subTabs = subids;
                subTabValue = $('#' + subids).parent().attr('id');
            }
            $('#' + subids).bind('click', function() {
                $('#' + subTabs).removeClass('active');
                $('#' + subTabs).parent().removeClass('active');
                $(this).addClass('active');
                $(this).parent().addClass('active');
                subTabs = subids;
                subTabValue = $('#' + subids).parent().attr('id');
                $('#freshVal').text($(this).text());
                list_league(mainTab, subTabValue);
            });
        });
        $('.js-textareacopybtn').each(function() {
            var id = $(this).attr('id');

            $('#' + id).bind('click', function() {
                var leagueid = id.split('_');
                var selectorid = "#copytext_" + leagueid[1];
                var copyTextarea = document.querySelector(selectorid);
                $(selectorid).show();
                copyTextarea.select();
                try {
                    var successful = document.execCommand('copy');
                    $('#copy_user_msg').show(1000);
                    $('#copy_user_msg').hide(10000);
                } catch (err) {
                    //console.log('Oops, unable to copy');
                }
                 $('[data-toggle="tooltip"]').tooltip();
            });
        });
    }, 2000); 

</script>
