<?php
foreach ($comments as $key => $value) {
    $totalchildcmt = count($value);
    $total_sub_comment = $totalchildcmt - 1;
    if (isset($value['main_comment']->comment)) {
        ?> 

        <!--<div class="container-fluid pad-left-0 pad-right-0">-->
        <div class="user-comment" id="comment_<?php echo $key; ?>">

            <div class="media info-avatar">
                <div class="media-left media-comment">
                    <a href="#">
                        <?php if (!empty($value['main_comment']->user_image) && $value['main_comment']->user_image != "") { ?>
                            <img src="<?php echo base_url() ?>uploads/users/<?php echo $value['main_comment']->user_image; ?>" alt="<?php echo $value['main_comment']->user_image; ?>" class="media-object avatar img-circle"  >
                        <?php } else { ?>
                            <img src="<?php echo base_url() ?>assets/public/img/admin.png" alt="Leaguememe" class="media-object avatar img-circle">
                        <?php } ?>
                    </a>
                </div>

                <div class="media-body w-100">
                    <a href=""><h5 class="user prtgetusername__<?php echo $key; ?>"><?php echo $value['main_comment']->user_name; ?></h5></a>
                    <?php
                    $total_cmtpoint = ((int) $value['main_comment']->total_like) - ((int) $value['main_comment']->total_dislike);
                    ?>
                    <div class="date"><span class="points" id="countLike_<?php echo $value['main_comment']->comment_id; ?>"><?php echo $total_cmtpoint; ?></span> Point - <a href=""><span class="points" data-livestamp="<?php echo strtotime($value['main_comment']->comment_date); ?>"> </span> </a>
                    </div>
                </div>
            </div>
<!--            <div class="report-comment">
                <div class="disable-comment">
                    <i class="fa fa-minus-square-o"></i>
                </div>
                <div class="separator-report"></div>
                <div class="report-flag-comment">
                    <i class="fa fa-trash-o"></i>
                </div>
            </div>-->
            <div class="wrap-comment-field">
                <?php
                $check = $value['main_comment']->comment;
                $rows = explode("\n", $check);
                $words = array();
                foreach ($rows as $row) {
                    $temp = explode(" ", $row);
                    foreach ($temp as $word)
                        $words[] = $word;
                }

                $a = $value['main_comment']->comment;
                $start = "@";
                $result = preg_match_all("#" . $start . "\w+#", $a, $matches);
                if ($result) {
                    if (!empty($matches)) {
                        foreach ($matches as $match) {
                            $Array = array();
                            for ($i = 0; $i < $result; $i++) {
                                if (in_array($match[$i], $words)) {
                                    $key = array_search($match[$i], $words);
                                    $new = implode(" ", $words);
                                    array_push($Array, $match[$i]);
                                }
                            }
                        }
                        ?>
                        <p class="dis-cap comment-field-user">
                            <?php
                            $highlight = $new;
                            foreach ($Array as $keyword) {
                                $highlight = str_replace($keyword, "<a href = '' style='color:#17ae97;'>$keyword</a>", $highlight);
                            }
                            echo $highlight;
                            ?>
                        </p>

                        <?php
                    }
                } else {
                    ?>
                    <p class="dis-cap comment-field-user">
                        <?php echo $value['main_comment']->comment; ?>
                    </p>

                    <?php
                }
                ?>

                <div class="media-left media-profile" >
                    <?php
                    if (!empty($value['main_comment']->le_comment_image)) {
                        ?>
                        <img class="media-object comment-picture" style="margin-left: 0px; margin-bottom: 10px;" src="<?php echo base_url(); ?>uploads/comment_picture/<?php echo $value['main_comment']->le_comment_image; ?>" width="120px;" height="120px;" alt="">
                        <?php
                    } else if (!empty($value['main_comment']->discussion_image)) {
                        ?>
                        <img class="media-object comment-picture" style="margin-left: 0px; margin-bottom: 10px;" src="<?php echo base_url(); ?>uploads/comment_picture/<?php echo $value['main_comment']->discussion_image; ?>" width="120px;" height="120px;" alt="">
                    <?php } else { ?>

                    <?php } ?>
                </div>

                <div class="reply-comment">
                    <ul class="list-inline" id="<?php echo $key; ?>">
                        <?php
                        $user_id = $this->session->userdata('user_id');
                        if ($user_id) {
                            ?>
                            <li class="parentcmtrpl trigger-reply" id="parentcmtrpl_<?php echo $key; ?>"><a  href="javascript:void(0)" ><span>Reply</span></a></li>
                        <?php } else {
                            ?>

                            <li> <a   href="javascript:void(0);" id="login" style="cursor: pointer" data-toggle="modal" data-target="#login"><span>Reply</span></a></li>
                        <?php } ?>

                        <?php
                        $user_id = $this->session->userdata('user_id');
                        if ($user_id) {
                            ?>
                            <li><a style="cursor: pointer;" class="hvr-bounce-in" id="like_<?php echo $value['main_comment']->comment_id; ?>" onclick="like(<?php echo $user_id; ?>,<?php echo $value['main_comment']->comment_id; ?>)">
                                    <?php
                                    $cmnt_user_id = $value['main_comment']->cmnt_user_id;
                                    $cmnt_comment_id = $value['main_comment']->cmnt_comment_id;

                                    if ($cmnt_user_id == $user_id && $cmnt_comment_id == $value['main_comment']->comment_id && $value['main_comment']->like == 1) {
                                        ?>
                                        <img src="<?php echo base_url(); ?>assets/public/img/up-reply-hover.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/up-reply-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/up-reply.png"; ?>'">
                                    <?php } else { ?>
                                        <img src="<?php echo base_url(); ?>assets/public/img/up-reply.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/up-reply-hover.png"; ?>'"  onmouseout="this.src = '<?php echo base_url() . "assets/public/img/up-reply.png"; ?>'">
                                    <?php } ?>
                                </a></li>

                        <?php } else {
                            ?>
                            <li><a class="hvr-bounce-in" href="javascript:void(0);" id="login" style="cursor: pointer" data-toggle="modal" data-target="#login"><img src="<?php echo base_url(); ?>assets/public/img/up-reply.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/up-reply-hover.png"; ?>'"  onmouseout="this.src = '<?php echo base_url() . "assets/public/img/up-reply.png"; ?>'"></a></li>
                        <?php } ?>

                        <?php
                        $user_id = $this->session->userdata('user_id');
                        if ($user_id) {
                            ?>

                            <li class="comment-disvote "><a style="cursor: pointer;"  class="disvote hvr-bounce-in" id="dislike_<?php echo $value['main_comment']->comment_id; ?>" onclick="dislike(<?php echo $user_id; ?>,<?php echo $value['main_comment']->comment_id; ?>)">
                                    <?php
                                    if ($cmnt_user_id == $user_id && $cmnt_comment_id == $value['main_comment']->comment_id && $value['main_comment']->like == 0) {
                                        ?>
                                        <img src="<?php echo base_url(); ?>assets/public/img/down-reply-hover.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/down-reply-hover.png"; ?>'"  onmouseout="this.src = '<?php echo base_url() . "assets/public/img/down-reply.png"; ?>'">

                                    <?php } else { ?>
                                        <img src="<?php echo base_url(); ?>assets/public/img/down-reply.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/down-reply-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/down-reply.png"; ?>'">
                                    <?php } ?>
                                </a></li>
                        <?php } else {
                            ?>
                            <li class="comment-disvote "><a style="cursor: pointer;" class="hvr-bounce-in" href="javascript:void(0);" id="login" data-toggle="modal" data-target="#login"> <img src="<?php echo base_url(); ?>assets/public/img/down-reply.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/down-reply-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/down-reply.png"; ?>'"></a></li>
                        <?php } ?>
                        <?php
                        $user_id = $this->session->userdata('user_id');
                        if ($user_id) {
                            $u_id = $value['main_comment']->user_id;
                            if ($user_id == $u_id) {
                                ?>
                                <li> <a title="Deletecommet" style="cursor: pointer;" onClick="delete_Comment(<?php echo $value['main_comment']->comment_id; ?>,<?php echo $key; ?>,<?php echo $user_id; ?>)"><i class="fa fa-remove fa-lg"></i></a></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                    <div id="rplycmtbox-<?php echo $key; ?>" style="display:none" class="input-text-comment  comment-container" >
                        <div   id="<?php echo $key; ?>">
                            <textarea class="form-control form-comment textarea-box innercomboBox" placeholder="Comment reply" id="addrplCommentBox<?php echo $key; ?>" ></textarea>
                            <div  id="<?php echo $key; ?>">
                                <button class="pull-right small-btn green-bg btn comment-btn commentrplPostBtn" id="replypostBtn-<?php echo $key; ?>"  >Reply</button>
                            </div>
                        </div>
                        <div class="col-lg-2 pull-right comment-count value-box " style="bottom: 24px;right: -54px" id="inerwordcountdiv<?php echo $key; ?>" >
                            <p >1000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="comment-to-comment col-md-12" id="fullReplyBox-<?php echo $key; ?>">
            <?php if ($total_sub_comment <= 1) { ?>
                <div id="one_comment_div" style="display:block">  
                    <?php for ($i = 0; $i < $totalchildcmt - 1; $i++) { ?>
                        <div class="user-comment row chdrepl_<?php echo $key; ?>" id="childid_<?php echo $value[$i]->comment_id; ?>"  >
                            <div class="media info-avatar">
                                <div class="media-left media-comment">
                                    <a href="#">

                                        <?php if (!empty($value[$i]->user_image) && $value[$i]->user_image != "") { ?>
                                            <img src="<?php echo base_url() ?>uploads/users/<?php echo $value[$i]->user_image; ?>" alt="<?php echo $value[$i]->user_image; ?>" class="media-object avatar img-circle"  >
                                        <?php } else { ?>
                                            <img src="<?php echo base_url() ?>assets/public/img/admin.png" alt="Leaguememe" class="media-object avatar img-circle">
                                        <?php } ?>
                                    </a>
                                </div>

                                <div class="media-body w-100">

                                    <?php
                                    $total_cmtrplpoint = ((int) $value[$i]->total_like) - ((int) $value[$i]->total_dislike);
                                    ?>

                                    <a href=""><h5 class="user">
                                            <span class="nick us-name getusername__<?php echo $value[$i]->comment_id; ?>"><?php echo $value[$i]->user_name; ?></span>
                                        </h5></a>
                                    <div class="date"><span class="points" id="countLike_<?php echo $value[$i]->comment_id; ?>"><?php echo $total_cmtrplpoint; ?></span> Point - <a href=""> 
                                            <span class="points" data-livestamp="<?php echo strtotime($value[$i]->comment_date); ?>"> </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="wrap-comment-field">
                                <p class="dis-cap comment-field-user">
                                    <?php
                                    $cmt = $value[$i]->comment;

                                    $getArray = array();
                                    $createArr = explode(" ", $cmt);
                                    foreach ($createArr as $cr)
                                        $getArray[] = $cr;

                                    $start = "@";
                                    $res = preg_match_all("#" . $start . "\w+#", $cmt, $matches);
                                    if ($res) {
                                        if (!empty($matches)) {
                                            foreach ($matches as $mat) {
                                                $getting_value = array();
                                                for ($j = 0; $j < $res; $j++) {
                                                    if (in_array($mat[$j], $getArray)) {
                                                        array_push($getting_value, $mat[$j]);
                                                    }
                                                }
                                            }

                                            $hlcmt = $cmt;
                                            foreach ($getting_value as $wantocolor) {
                                                $hlcmt = str_replace($wantocolor, "<a href = '' style='color:#17ae97;'>$wantocolor</a>", $hlcmt);
                                            }
                                            echo $hlcmt;
                                        }
                                    } else {
                                        echo $value[$i]->comment;
                                    }
                                    ?>
                                </p>

                                <div class="reply-comment">
                                    <div class="<?php echo $value[$i]->comment_id; ?>" >
                                        <ul class="list-inline" id="<?php echo $key; ?>" >
                                            <?php
                                            $user_id = $this->session->userdata('user_id');
                                            if ($user_id) {
                                                ?>
                                                <li class="childsubcmtrpl" id="childsubcmtrpl_<?php echo $value['main_comment']->comment_id; ?>"><a style="cursor: pointer;"  href="javascript:void(0);"><span>Reply</span></a></li>
                                            <?php } else {
                                                ?>
                                                <li><a  style="cursor: pointer;" href="javascript:void(0);" id="login" style="cursor: pointer" data-toggle="modal" data-target="#login"><span>Reply</span></a></li>
                                            <?php } ?>    


                                            <?php
                                            $user_id = $this->session->userdata('user_id');
                                            if ($user_id) {
                                                ?>
                                                <li><a class="hvr-bounce-in" style="cursor: pointer;" id="like_<?php echo $value[$i]->comment_id; ?>" onclick="like(<?php echo $user_id; ?>,<?php echo $value[$i]->comment_id; ?>)">

                                                        <?php
                                                        if ($value[$i]->cmnt_user_id == $user_id && $value[$i]->cmnt_comment_id == $value[$i]->comment_id && $value[$i]->like == 1) {
                                                            ?>
                                                            <img src="<?php echo base_url(); ?>assets/public/img/up-reply-hover.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/up-reply-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/up-reply.png"; ?>'">
                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/public/img/up-reply.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/up-reply-hover.png"; ?>'"  onmouseout="this.src = '<?php echo base_url() . "assets/public/img/up-reply.png"; ?>'">
                                                        <?php } ?>
                                                    </a></li>

                                            <?php } else {
                                                ?>
                                                <li><a style="cursor: pointer;" class="hvr-bounce-in" href="javascript:void(0);" id="login" style="cursor: pointer" data-toggle="modal" data-target="#login"><img src="<?php echo base_url(); ?>assets/public/img/up-reply.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/up-reply-hover.png"; ?>'"  onmouseout="this.src = '<?php echo base_url() . "assets/public/img/up-reply.png"; ?>'"></a></li>
                                            <?php } ?>
                                            <?php
                                            $user_id = $this->session->userdata('user_id');
                                            if ($user_id) {
                                                ?>
                                                <li class="comment-disvote"><a style="cursor: pointer;" class="hvr-bounce-in" id="dislike_<?php echo $value[$i]->comment_id; ?>" onclick="dislike(<?php echo $user_id; ?>,<?php echo $value[$i]->comment_id; ?>)">
                                                        <?php
                                                        if ($value[$i]->cmnt_user_id == $user_id && $value[$i]->cmnt_comment_id == $value[$i]->comment_id && $value[$i]->like == 0) {
                                                            ?>
                                                            <img src="<?php echo base_url(); ?>assets/public/img/down-reply-hover.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/down-reply-hover.png"; ?>'"  onmouseout="this.src = '<?php echo base_url() . "assets/public/img/down-reply.png"; ?>'">

                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/public/img/down-reply.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/down-reply-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/down-reply.png"; ?>'">
                                                        <?php } ?>
                                                    </a></li>

                                            <?php } else {
                                                ?>
                                                <li class="comment-disvote"><a style="cursor: pointer;" class="hvr-bounce-in" href="javascript:void(0);" id="login_modal" style="cursor: pointer" data-toggle="modal" data-target="#login-modal"> <img src="<?php echo base_url(); ?>assets/public/img/down-reply.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/down-reply-hover.png"; ?>'"  onmouseout="this.src = '<?php echo base_url() . "assets/public/img/down-reply.png"; ?>'"></a></li>
                                            <?php } ?>
                                            <?php
                                            $user_id = $this->session->userdata('user_id');
                                            if ($user_id) {
                                                $u_id = $value[$i]->user_id;
                                                if ($user_id == $u_id) {
                                                    ?>
                                                    <li><a title="Deletecommet" style="cursor: pointer;" class="hvr-bounce-in" onClick="delete_Comment(<?php echo $value[$i]->comment_id; ?>, 'off',<?php echo $user_id; ?>)"><i class="fa fa-remove fa-lg"></i></a></li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                        <!--<div class="comment-container">-->
                                        <div id="childrplycmtbox-<?php echo $value[$i]->comment_id; ?>" style="display:none" class="childrplycmtbox-<?php echo $key; ?>"  >
                                            <div  id="<?php echo $key; ?>">
                                                <textarea class="form-control form-comment textarea-box  childinnercomboBox" placeholder="Comment reply" id="childaddrplCommentBox-<?php echo $value[$i]->comment_id; ?>" ></textarea>
                                                <div  id="<?php echo $key; ?>">
                                                    <button class="pull-right small-btn green-bg btn childcommentrplPostBtn" id="<?php echo $value[$i]->comment_id; ?>"  >Reply</button>
                                                </div>
                                            </div>
                                            <div class="col-lg-2  pull-right comment-count" id="childinerwordcountdiv<?php echo $value[$i]->comment_id; ?>">
                                                <p>1000</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                </div>
            <?php } else {
                ?> 

                <div id="more_comment_div_<?php echo $key; ?>" >
                    <?php for ($i = 0; $i < 1; $i++) { ?>
                        <div class="user-comment row chdrepl_<?php echo $key; ?>" id="childid_<?php echo $value[$i]->comment_id; ?>"  >
                            <div class="media info-avatar">
                                <div class="media-left media-comment">
                                    <a href="#">

                                        <?php if (!empty($value[$i]->user_image) && $value[$i]->user_image != "") { ?>
                                            <img src="<?php echo base_url() ?>uploads/users/<?php echo $value[$i]->user_image; ?>" alt="<?php echo $value[$i]->user_image; ?>" class="media-object avatar img-circle"  >
                                        <?php } else { ?>
                                            <img src="<?php echo base_url() ?>assets/public/img/admin.png" alt="Leaguememe" class="media-object avatar img-circle">
                                        <?php } ?>
                                    </a>
                                </div>

                                <div class="media-body w-100">

                                    <?php
                                    $total_cmtrplpoint = ((int) $value[$i]->total_like) - ((int) $value[$i]->total_dislike);
                                    ?>

                                    <a href=""><h5 class="user">
                                            <span class="nick us-name getusername__<?php echo $value[$i]->comment_id; ?>"><?php echo $value[$i]->user_name; ?></span>
                                        </h5></a>
                                    <div class="date"><span class="points" id="countLike_<?php echo $value[$i]->comment_id; ?>"><?php echo $total_cmtrplpoint; ?></span> Point - <a href=""> 
                                            <span class="points" data-livestamp="<?php echo strtotime($value[$i]->comment_date); ?>"> </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="wrap-comment-field">
                                <p class="dis-cap comment-field-user">
                                    <?php echo $value[$i]->comment; ?>
                                </p>

                                <div class="reply-comment">
                                    <div class="<?php echo $value[$i]->comment_id; ?>" >
                                        <ul class="list-inline" id="<?php echo $key; ?>" >
                                            <?php
                                            $user_id = $this->session->userdata('user_id');
                                            if ($user_id) {
                                                ?>
                                                <li class="childsubcmtrpl" id="childsubcmtrpl_<?php echo $value['main_comment']->comment_id; ?>"><a style="cursor: pointer;"  href="javascript:void(0);"><span>Reply</span></a></li>
                                            <?php } else {
                                                ?>
                                                <li><a  style="cursor: pointer;" href="javascript:void(0);" id="login" style="cursor: pointer" data-toggle="modal" data-target="#login"><span>Reply</span></a></li>
                                            <?php } ?>    


                                            <?php
                                            $user_id = $this->session->userdata('user_id');
                                            if ($user_id) {
                                                ?>
                                                <li><a class="hvr-bounce-in" style="cursor: pointer;" id="like_<?php echo $value[$i]->comment_id; ?>" onclick="like(<?php echo $user_id; ?>,<?php echo $value[$i]->comment_id; ?>)">

                                                        <?php
                                                        if ($value[$i]->cmnt_user_id == $user_id && $value[$i]->cmnt_comment_id == $value[$i]->comment_id && $value[$i]->like == 1) {
                                                            ?>
                                                            <img src="<?php echo base_url(); ?>assets/public/img/up-reply-hover.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/up-reply-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/up-reply.png"; ?>'">
                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/public/img/up-reply.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/up-reply-hover.png"; ?>'"  onmouseout="this.src = '<?php echo base_url() . "assets/public/img/up-reply.png"; ?>'">
                                                        <?php } ?>
                                                    </a></li>

                                            <?php } else {
                                                ?>
                                                <li><a style="cursor: pointer;" class="hvr-bounce-in" href="javascript:void(0);" id="login" style="cursor: pointer" data-toggle="modal" data-target="#login"><img src="<?php echo base_url(); ?>assets/public/img/up-reply.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/up-reply-hover.png"; ?>'"  onmouseout="this.src = '<?php echo base_url() . "assets/public/img/up-reply.png"; ?>'"></a></li>
                                            <?php } ?>
                                            <?php
                                            $user_id = $this->session->userdata('user_id');
                                            if ($user_id) {
                                                ?>
                                                <li class="comment-disvote"><a style="cursor: pointer;" class="hvr-bounce-in" id="dislike_<?php echo $value[$i]->comment_id; ?>" onclick="dislike(<?php echo $user_id; ?>,<?php echo $value[$i]->comment_id; ?>)">
                                                        <?php
                                                        if ($value[$i]->cmnt_user_id == $user_id && $value[$i]->cmnt_comment_id == $value[$i]->comment_id && $value[$i]->like == 0) {
                                                            ?>
                                                            <img src="<?php echo base_url(); ?>assets/public/img/down-reply-hover.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/down-reply-hover.png"; ?>'"  onmouseout="this.src = '<?php echo base_url() . "assets/public/img/down-reply.png"; ?>'">

                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/public/img/down-reply.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/down-reply-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/down-reply.png"; ?>'">
                                                        <?php } ?>
                                                    </a></li>

                                            <?php } else {
                                                ?>
                                                <li class="comment-disvote"><a style="cursor: pointer;" class="hvr-bounce-in" href="javascript:void(0);" id="login_modal" style="cursor: pointer" data-toggle="modal" data-target="#login-modal"> <img src="<?php echo base_url(); ?>assets/public/img/down-reply.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/down-reply-hover.png"; ?>'"  onmouseout="this.src = '<?php echo base_url() . "assets/public/img/down-reply.png"; ?>'"></a></li>
                                            <?php } ?>
                                            <?php
                                            $user_id = $this->session->userdata('user_id');
                                            if ($user_id) {
                                                $u_id = $value[$i]->user_id;
                                                if ($user_id == $u_id) {
                                                    ?>
                                                    <li><a title="Deletecommet" style="cursor: pointer;" class="hvr-bounce-in" onClick="delete_Comment(<?php echo $value[$i]->comment_id; ?>, 'off',<?php echo $user_id; ?>)"><i class="fa fa-remove fa-lg"></i></a></li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                        <!--<div class="comment-container">-->
                                        <div id="childrplycmtbox-<?php echo $value[$i]->comment_id; ?>" style="display:none" class="childrplycmtbox-<?php echo $key; ?>"  >
                                            <div  id="<?php echo $key; ?>">
                                                <textarea class="form-control form-comment textarea-box  childinnercomboBox" placeholder="Comment reply" id="childaddrplCommentBox-<?php echo $value[$i]->comment_id; ?>" ></textarea>
                                                <div  id="<?php echo $key; ?>">
                                                    <button class="pull-right small-btn green-bg btn comment-bt childcommentrplPostBtn" id="<?php echo $value[$i]->comment_id; ?>"  >Reply</button>
                                                </div>
                                            </div>
                                            <div class="col-lg-2  pull-right comment-count value-box" style="bottom: 24px;right: -54px" id="childinerwordcountdiv<?php echo $value[$i]->comment_id; ?>">
                                                <p>1000</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id='<?php echo $value['main_comment']->comment_id; ?>' class="older-replies  loadmore_<?php echo $key; ?>" onclick="loadMoreReply(this.id);">  Show <?php echo $total_sub_comment - 1; ?> older replies   </div>
                        </div>

                        <?php
                    }
                    ?>

                </div>


            <?php }
            ?>
        </div>



        <?php
    }
}
?>

<script>
    $(function () {
        $('.comment-container').hide();
    });



</script>