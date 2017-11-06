<style>
    .dis_action_tray{
        width: 20px;opacity: 0.5
    }
    .dis_action_tray:hover{
        opacity: 1;
    }
</style>
<div classs="row">
    <div class="col-md-12 wrap-main">
        <?php
        if (count($discussion_detail) > 0 && !empty($discussion_detail)) {
            foreach ($discussion_detail as $discussion) {
                //$allid = $main_category."-".$discussion->leagueimage_id;
                ?>
                <div class="wrapper-avatar pad-b-10 w-100" style="border: none;"> 
                    <div class="media info-avatar">
                        <div class="media-left">
                            <a href="<?php echo base_url(); ?>leaguememe-profile/<?php echo $discussion->user_name ?>">
                                <?php
                                if (isset($discussion->user_image) && !empty($discussion->user_image)) {
                                    ?>
                                    <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>uploads/users/<?php echo $discussion->user_image; ?>" alt="<?php echo $discussion->user_name; ?>"> 
                                    <?php
                                } else {
                                    ?>
                                    <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>assets/public/img/luffy.png" alt="profile pic">
                                    <?php
                                }
                                ?>
                            </a>
                        </div>

                        <div class="media-body">
                            <h5><a href="<?php echo base_url(); ?>leaguememe-profile/<?php echo $discussion->user_name ?>"><h5><?php echo empty($discussion->name) ? $discussion->user_name : $discussion->name; ?></h5></a>
                            </h5>
                            <div class="col-md-12 no-padding" >
                                <span class="minute"  style="display: inline" data-livestamp="<?php echo strtotime($discussion->discussion_timestamp); ?>"></span>
                            </div>
                            <div class="tag   tag-index">  
                                <?php if ($discussion->spoiler == 1) { ?>
                                    <span class="red-tag normal-tag">spoiler</span>
                                    <?php
                                }
                                if (!empty($discussion->creditor_author) AND ! empty($discussion->creditor_site)) {
                                    ?>
                                    <span  class="normal-tag disc-credit-show" data-credit="<?= $discussion->creditor_author ?>">Credit</span>
                                    <?php
                                    $img = "fb-credit.png";
                                    $lnk = "https://www.facebook.com";
                                    if (strpos($discussion->creditor_site, "facebook")) {
                                        $img = "fb-credit.png";
                                        $lnk = "https://www.facebook.com";
                                    } elseif (strpos($discussion->creditor_site, "twitter")) {
                                        $img = "tt-credit.png";
                                        $lnk = "https://twitter.com";
                                    } elseif (strpos($discussion->creditor_site, "insta")) {
                                        $img = "ig-credit.png";
                                        $lnk = "https://www.instagram.com";
                                    }
                                    ?>
                                    <a href="<?= isset($discussion->creditor_author) ? $lnk . '/' . $discussion->creditor_author : $lnk ?>" target="_BLANK" class="fb-1" style="display: none">
                                        <img src="assets/public/img/<?= $img ?>">
                                    </a>
                                <?php } ?> 
                            </div>
                        </div>



                    </div>

                    <!--list 1 -->
                    <div class="list-pos">
                        <span class="troll">
                            <?php
                            if (isset($userid) && !empty($userid) && isset($victory[$discussion->anime_discussionid]) && !empty($victory[$discussion->anime_discussionid])) {
                                if (in_array($userid, $victory[$discussion->anime_discussionid])) {
                                    ?>
                                    <a href="javascript:void(0)" style="position:absolute;" onclick="ondiscussionvictory(this.id)" id="<?php echo $discussion->anime_discussionid; ?>">
                                        <img class="up-scroll"  id="like_<?php echo $discussion->anime_discussionid; ?>"  src="<?php echo base_url(); ?>assets/public/img/up-triangle-hover.png">
                                    </a>
                                    <?php
                                } else {
                                    ?>  
                                    <a href="javascript:void(0)" style="position:absolute;" onclick="ondiscussionvictory(this.id)" id="<?php echo $discussion->anime_discussionid; ?>">
                                        <img class="up-scroll"  id="like_<?php echo $discussion->anime_discussionid; ?>" src="<?php echo base_url(); ?>assets/public/img/up-triangle.png">
                                    </a>
                                    <?php
                                }
                            } else {
                                ?>
                                <a href="javascript:void(0)" style="position:absolute;" onclick="ondiscussionvictory(this.id)" id="<?php echo $discussion->anime_discussionid; ?>">
                                    <img class="up-scroll"  id="like_<?php echo $discussion->anime_discussionid; ?>"  src="<?php echo base_url(); ?>assets/public/img/up-triangle.png">
                                </a>
                                <?php
                            }
                            ?>
                            <?php
                            if (isset($userid) && !empty($userid) && isset($defact[$discussion->anime_discussionid]) && !empty($defact[$discussion->anime_discussionid])) {
                                if (in_array($userid, $defact[$discussion->anime_discussionid])) {
                                    ?>
                                    <a href="javascript:void(0)" style="position: absolute; margin-top: 20px;" onclick="ondiscussiondefeat(this.id)" id="<?php echo $discussion->anime_discussionid; ?>">
                                        <img class="down-scroll"  id="dislike_<?php echo $discussion->anime_discussionid; ?>" src="<?php echo base_url(); ?>assets/public/img/down-triangle-hover.png">
                                    </a>
                                    <?php
                                } else {
                                    ?> 
                                    <a href="javascript:void(0)" style="position: absolute; margin-top: 20px;" onclick="ondiscussiondefeat(this.id)" id="<?php echo $discussion->anime_discussionid; ?>">
                                        <img class="down-scroll"   id="dislike_<?php echo $discussion->anime_discussionid; ?>" src="<?php echo base_url(); ?>assets/public/img/down-triangle.png">
                                    </a>
                                    <?php
                                }
                            } else {
                                ?>
                                <a href="javascript:void(0)" style="position: absolute; margin-top: 20px;" onclick="ondiscussiondefeat(this.id)" id="<?php echo $discussion->anime_discussionid; ?>">
                                    <img class="down-scroll"  id="dislike_<?php echo $discussion->anime_discussionid; ?>" src="<?php echo base_url(); ?>assets/public/img/down-triangle.png">
                                </a>
                                <?php
                            }
                            ?>
                        </span>
                        <span class="right-pos">
                            <a href="<?php echo base_url(); ?>discussion-single/<?php echo $discussion->anime_discussionid; ?>">
                                <p><?php echo $discussion->title; ?></p>
                            </a>
                            <?php
                            $total_point = ((int) $discussion->total_victory) - ((int) $discussion->total_defeat);
                            ?>
                            <h5 style="border-top:1px solid #ededed;padding-top:5px"><a id="point_<?php echo $discussion->anime_discussionid; ?>"><?php echo $total_point; ?></a><a> points </a>&nbsp; -  &nbsp;

                                <a><?php
                                    $total_comment = $discussion->total_comment;
                                    if (!empty($total_comment)) {
                                        echo $total_comment;
                                    } else {
                                        echo '0';
                                    }
                                    ?> comments</a>
                                <?php
                                if (isset($userid) && !empty($userid) && isset($favuserid[$discussion->anime_discussionid]) && !empty($favuserid[$discussion->anime_discussionid])) {

                                    if (in_array($userid, $favuserid[$discussion->anime_discussionid])) {
                                        ?> 
                                        <a class="hvr-bounce-in pull-right" onclick="discussion_fav(this.id)"  id="<?= $discussion->anime_discussionid ?>" style="cursor: pointer" rel="<?= $discussion->anime_discussionid ?>">
                                            <img style="width: 12px;" id="disFav_<?= $discussion->anime_discussionid ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/open-hover.png"  class="dis_action_tray">
                                        </a> 

                                        <?php
                                    } else {
                                        ?>  
                                        <a  class="hvr-bounce-in pull-right" onclick="discussion_fav(this.id)"  id="<?= $discussion->anime_discussionid ?>"  style="cursor: pointer" rel="<?= $discussion->anime_discussionid ?>">
                                            <img style="width: 12px;" id="disFav_<?= $discussion->anime_discussionid ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/open.png"   class="dis_action_tray">
                                        </a> 
                                        <?php
                                    }
                                } else {
                                    ?> 
                                    <a class="hvr-bounce-in pull-right" onclick="discussion_fav(this.id)"  id="<?= $discussion->anime_discussionid ?>"  style="cursor: pointer" rel="<?= $discussion->anime_discussionid ?>">
                                        <img style="width: 12px;" id="disFav_<?= $discussion->anime_discussionid ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/open.png"   class="dis_action_tray">
                                    </a> 
                                    <?php
                                }
                                ?>

                            </h5> 

                        </span>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
            <br>
            <div> 
                <div class="alert alert-danger">
                    <strong>Oops!</strong> No Discussion found here
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/public/js/anime_discussion_list.js"></script>