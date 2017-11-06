
<?php
foreach ($useralldata as $key => $value) {
    if ($userdata['parent'] == 0) {
        $key1 = $userdata['parent'];
    } else {
        $key1 = $lastid;
    }
    ?> 

    <div class="chdrepl_<?php echo $userdata['parent']; ?> user-comment" id="childid_<?php echo $key1; ?>" >
        <!--<div class="user-comment" >-->

        <div class="media info-avatar">
            <div class="media-left media-comment">
                <a href="#">
                    <?php
                    if (isset($value['user_image'])) {
                        ?>
                        <a href="#">
                            <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>uploads/users/<?php echo $value['user_image']; ?>" alt="">
                        </a>
                        <?php
                    } else {
                        ?>
                        <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>assets/public/img/luffy.png" alt="profile pic">
                        <?php
                    }
                    ?>
                </a>
            </div>

            <div class="media-body w-100">
                <a href=""><h5 class="user">
                        <span class="nick us-name getusername__<?php echo $key1; ?>" id="getusername<?php echo $key1; ?>"><?php echo $value['user_name']; ?></span>

                    </h5></a>
                <div class="date"><span class="points" id="countLike_<?php echo $key1 ?>"> <?php echo '0'; ?> </span> Point - <a href=""> 
                        <span class="points"  data-livestamp="<?php echo strtotime($comment_date); ?>"></span> </a>
                </div>
            </div>
        </div>
        <div class="wrap-comment-field">

            <p class="dis-cap comment-field-user">
                <?php
                $cmt = $userdata['cmt'];

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
                    echo $userdata['cmt'];
                }
                ?>
            </p>
            <div class="reply-comment <?php echo $key1; ?>" id="<?php echo $userdata['parent']; ?>">

                <ul class="list-inline" id="<?php echo $key1; ?>">
                    <?php
                    $user_id = $this->session->userdata('user_id');
                    if ($user_id) {
                        ?>
                        <li class="parentcmtrpl trigger-reply"  id="childsubcmtrpl_<?php echo $userdata['parent']; ?>"><a  href="javascript:void(0)" ><span>Reply</span></a></li>
                    <?php } else {
                        ?>

                        <li> <a   href="javascript:void(0);" id="login" style="cursor: pointer" data-toggle="modal" data-target="#login"><span>Reply</span></a></li>
                    <?php } ?>

                    <li>
                        <a style="cursor: pointer;" class="hvr-bounce-in" id="like_<?php echo $key1; ?>" onclick="like(<?php echo $user_id; ?>,<?php echo $key1; ?>)">
                            <img src="<?php echo base_url(); ?>assets/public/img/up-reply.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/up-reply-hover.png"; ?>'" onmouseout="this.src = '<?php echo base_url() . "assets/public/img/up-reply.png"; ?>'">
                        </a>
                    </li>


                    <li class="comment-disvote ">
                        <a class="disvote" class="hvr-bounce-in" style="cursor: pointer;"  id="dislike_<?php echo $key1; ?>" onclick="dislike(<?php echo $user_id; ?>,<?php echo $key1; ?>)">
                            <img src="<?php echo base_url(); ?>assets/public/img/down-reply.png" onmouseover="this.src = '<?php echo base_url() . "assets/public/img/down-reply-hover.png"; ?>'"  onmouseout="this.src = '<?php echo base_url() . "assets/public/img/down-reply.png"; ?>'">
                        </a>
                    </li>


                </ul>
                <div id="rplycmtbox-<?php echo $key1; ?>" style="display:none" class="comment-container" >
                    <div   id="<?php echo $key1; ?>">
                        <textarea class="comment-box form-control form-comment innercomboBox" placeholder="Comment reply" id="addrplCommentBox<?php echo $key1; ?>" ></textarea>
                        <div  id="<?php echo $key1; ?>">
                            <button class="pull-right small-btn green-bg btn commentrplPostBtn" id="replypostBtn-<?php echo $key1; ?>"  >Reply</button>
                        </div>
                    </div>
                    <div class="col-lg-2 pull-right comment-count" id="inerwordcountdiv<?php echo $key1; ?>" >
                        <p >1000</p>
                    </div>
                </div>
            </div>


        </div>

        <!--</div>-->
    </div>
    </div>

    <?php
}
?> 

