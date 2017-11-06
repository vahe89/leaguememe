<?php
foreach ($league_images as $anim_img) {

    //$allid = $main_category."-".$anim_img->leagueimage_id;
    ?>

    <div class="row">
        <div class="col-sm-2 col-xs-2 col-lg-1 col-md-1">
            <a href="#"><img class="pro-pic" src="<?php echo base_url(); ?>assets/public/img/pro-pic.png" alt="profile pic"></a>
        </div>
        <div class="col-sm-4 col-sm-offset-0 col-xs-offset-0  col-md-offset-1 col-xs-3 pad-left-0 col-lg-2 ">
            <?php if (isset($anim_img->user_name)) { ?>
                <div class="autor-index-top">
                    <a class="author" href="#"><h5 class="text-uppercase"><?php echo isset($anim_img->user_name) ? $anim_img->user_name : "Admin"; ?></h5></a>
                    <p class="date">15 Min
                        <!--<span data-livestamp="<?php //echo strtotime("2015-09-19 15:22:24");     ?>"></span></p>-->
                </div>
            <?php } ?>
        </div>
        <div class="col-xs-offset-0 col-xs-4 col-md-offset-0 col-md-3 col-lg-offset-0 col-lg-3 pad-left-1">
            <a class="anime-title" href="#"><h5><span class="fa fa-angle-double-right"></span> <?php echo $anim_img->credit; ?></h5></a>
        </div>
    </div>
    <div class="row col-lg-12 container-fluid" style="width:auto;">
        <input style="display:none" readonly="readonly" type="text" class="form-group col-sm-12 cpylink" id="<?php echo "copytext_" . $anim_img->leagueimage_id; ?>" value="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>">
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12 ">
            <div class="post">

                <a class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>"><h4><?php echo $anim_img->leagueimage_name; ?></h4></a>
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
                            </video>
                            <span class="play">Gif</span> -->
                            <a class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>">
                                <img  class = "post-image img-responsive meme-img" src="<?php echo base_url(); ?>uploads/league/<?php echo $anim_img->leagueimage_filename; ?>" alt="<?php echo $anim_img->leagueimage_name; ?>">
                            </a>

                        </div>

                        <!--meme-img-->
                        <?php
                    } else {
                        ?>

                        <a class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>"> 
                            <img  class = "post-image img-responsive meme-img" src="<?php echo base_url(); ?>uploads/league/<?php echo $anim_img->leagueimage_filename; ?>" alt="<?php echo $anim_img->leagueimage_name; ?>">
                        </a>
                        <?php
                    }
                } else if ($category == 'Video') {
                    ?>
                    <a class="image1" href="<?php echo base_url(); ?><?php echo $anim_img->leagueimage_id; ?>">
                        <div class="meme-img col-sm-12" ><?php echo $anim_img->leagueimage_filename; ?></div>
                    </a>
                <?php } ?>
                <p class = "post-likes font-play">
                    <?php
                    $total_point = ((int) $anim_img->total_victory) - ((int) $anim_img->total_defeat);
                    ?>
                    <span id="point_<?php echo $anim_img->leagueimage_id; ?>"><?php echo $total_point; ?></span> Points <span class="plus-sign"><i class="fa fa-plus"></i></span>
                    <span class="count">
                        <?php
                        $total_comment = $anim_img->total_comment;
                        if (!empty($total_comment)) {
                            echo $total_comment;
                        } else {
                            echo '0';
                        }
                        ?>
                    </span> Comments </p>
                <ul class = "list-inline comments">
                    <?php
                    if (isset($userid) && !empty($userid) && isset($victory[$anim_img->leagueimage_id]) && !empty($victory[$anim_img->leagueimage_id])) {
                        if (in_array($userid, $victory[$anim_img->leagueimage_id])) {
                            ?>
                            <li><a onClick = "onvictory(this.id);" id = "<?php echo $anim_img->leagueimage_id; ?>" style = "cursor: pointer" rel = "<?php echo $anim_img->leagueimage_id; ?>"><i id="victory_img_<?php echo $anim_img->leagueimage_id; ?>" class = "fa fa-arrow-up fa-lg victory_active"></i></a></li>
                            <?php
                        } else {
                            ?> 
                            <li><a onClick = "onvictory(this.id);" id = "<?php echo $anim_img->leagueimage_id; ?>" style = "cursor: pointer" rel = "<?php echo $anim_img->leagueimage_id; ?>"><i id="victory_img_<?php echo $anim_img->leagueimage_id; ?>" class = "fa fa-arrow-up fa-lg"></i></a></li>
                            <?php
                        }
                    } else {
                        ?>
                        <li><a onClick = "onvictory(this.id);" id = "<?php echo $anim_img->leagueimage_id; ?>" style = "cursor: pointer" rel = "<?php echo $anim_img->leagueimage_id; ?>"><i id="victory_img_<?php echo $anim_img->leagueimage_id; ?>" class = "fa fa-arrow-up fa-lg"></i></a></li>
                        <?php
                    }
                    ?>
                    <!--     For dis like btn  -->    
                    <?php
                    if (isset($userid) && !empty($userid) && isset($defact[$anim_img->leagueimage_id]) && !empty($defact[$anim_img->leagueimage_id])) {
                        if (in_array($userid, $defact[$anim_img->leagueimage_id])) {
                            ?>
                            <li><a onClick="ondefeat(this.id)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>" class = "disvote"><i id="defeat_img_<?php echo $anim_img->leagueimage_id; ?>" class = "fa fa-arrow-down fa-lg defeat_active"></i></a></li>
                            <?php
                        } else {
                            ?> 
                            <li><a onClick="ondefeat(this.id)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>" class = "disvote"><i id="defeat_img_<?php echo $anim_img->leagueimage_id; ?>" class = "fa fa-arrow-down fa-lg"></i></a></li>
                            <?php
                        }
                    } else {
                        ?>
                        <li><a onClick="ondefeat(this.id)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>" class = "disvote"><i id="defeat_img_<?php echo $anim_img->leagueimage_id; ?>" class = "fa fa-arrow-down fa-lg"></i></a></li>
                        <?php
                    }
                    ?>
                    <li><a href = "<?php echo base_url() . $anim_img->leagueimage_id; ?>"><i class = "fa fa-comment fa-lg"></i></a></li>
                    <?php
                    if (isset($userid) && !empty($userid) && isset($favuserid[$anim_img->leagueimage_id]) && !empty($favuserid[$anim_img->leagueimage_id])) {

                        if (in_array($userid, $favuserid[$anim_img->leagueimage_id])) {
                            ?>
                            <li><a onclick="onfavourites(this.id)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>" ><i id="favourites_img_<?php echo $anim_img->leagueimage_id; ?>" class = "fa fa-folder-open fa-lg favourites_active"></i></a></li>
                            <?php
                        } else {
                            ?> 
                            <li><a onclick="onfavourites(this.id)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>"  ><i id="favourites_img_<?php echo $anim_img->leagueimage_id; ?>"class = "fa fa-folder-open fa-lg"></i></a></li>
                            <?php
                        }
                    } else {
                        ?>
                        <li><a onclick="onfavourites(this.id)" id="<?php echo $anim_img->leagueimage_id; ?>" style="cursor: pointer" rel="<?php echo $anim_img->leagueimage_id; ?>"  ><i id="favourites_img_<?php echo $anim_img->leagueimage_id; ?>" class = "fa fa-folder-open fa-lg"></i></a></li>
                        <?php
                    }
                    ?>

                    <li class="js-textareacopybtn" title="click to copy " id="<?php echo "copy_" . $anim_img->leagueimage_id; ?>" value="<?php echo $anim_img->leagueimage_id; ?>" ><a href = "javascript:void(0);"><i class = "fa fa-link fa-lg"></i></a></li>
                    <li class = "share">
                        <script>function fbs_click() {
                                    u = location.href;
                                    t = document.title;
                                    window.open('http://www.facebook.com/sharer.php?u=' + encodeURIComponent(u) + '&t=' + encodeURIComponent(t), 'sharer', 'toolbar=0,status=0,width=626,height=436');
                                    return false;
                                }</script>
                        <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script> 
                        <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank"><img src = "<?php echo base_url(); ?>assets/public/img/share.png" alt = ""></a>
                        <a data-count="vertical" data-via="your_screen_name" data-hashtags="mayur8189" href="https://twitter.com/share"><img src = "<?php echo base_url(); ?>assets/public/img/tweet.png" alt = ""></a>
                    </li>
                    <!--<li class = "hidden-md hidden-lg share-last-right hidden-sm share-index-right"><div class = "b-container">
                    <a class = "sharebutton" href = "javascript:shareShow()">Share</a>
                    </div>
                    </li> -->
                </ul>
                <input type="hidden" name="total_groups" class="total_groups" value="<?php echo isset($total_groups) ? $total_groups : 0; ?>"/>

                <div class = "hidden-xs">
    <?php
    $tags = isset($anim_img->tags) ? $anim_img->tags : '';
    if (!empty($tags)) {
        $pieces = explode(" ", $tags);
        foreach ($pieces as $tag) {
            $tag_name = str_replace(" ", "-", $tag);
            ?>
                            <a href = "<?php echo base_url(); ?>tag/<?php echo urlencode($tag_name); ?>" id="text_decoration_none" class = "btn btn-default btn-category" role = "button" > #<?php echo $tag; ?></a>
                            <?php
                        }
                    }
                    ?>
                </div>

            </div>
            <hr>
        </div>
    </div>

    <?php
}
?>
<script>
    $(document).keyup(function (e) {

        if (e.which === 27) { // escape key maps to keycode `27`
//        alert(e.which);
            $(".cpylink").hide();
//       $(".cpylink").val("");
        }
    });
    setTimeout(function () {
//          alert('hi');

        $(".cpylink").hide();
        $('.subTab').each(function () {
            var subids = $(this).children().attr('id');
            var subclass = $('#' + subids).attr('class');
            if (subclass == "active") {
                subTabs = subids;
                subTabValue = $('#' + subids).parent().attr('id');
            }
            $('#' + subids).bind('click', function () {
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
        $('.js-textareacopybtn').each(function () {
            var id = $(this).attr('id');

            $('#' + id).bind('click', function () {
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
          
                $('#copytext_' + leagueid[1]).css({top: 100, 'z-index': '100', 'left': 180});
            });
        });
    }, 2000);


</script>
