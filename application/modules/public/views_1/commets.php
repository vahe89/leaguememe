<?php
foreach ($comments as $key => $value) {
    $totalchildcmt = count($value);

    if (isset($value['main_comment']->comment)) {
        ?> 
<div class="container-fluid pad-left-0 pad-right-0">
    <div class="clicked-comments-hot ">
        <div class="container-fluid pad-left-0 pad-right-0">
            <ul>  
                <li>
                    <div class="comment-holder" id="comment_<?php echo $key; ?>">
                        <div class="row" style="margin-left:0.2%;">
                            <div class="col-lg-2 col-sm-2  col-xs-2 pad-right-0">
                                <div class="img-container">
                                     <?php if (!empty($value['main_comment']->user_image) && $value['main_comment']->user_image != "") { ?>
                                        <img src="<?php echo base_url() ?>uploads/users/<?php echo $value['main_comment']->user_image; ?>" alt="<?php echo $value['main_comment']->user_image; ?>" class="img-responsive pull-right photo" style="max-width:90%">
                                    <?php } else { ?>
                                        <img src="<?php echo base_url() ?>assets/public/images/%EF%80%87.png" alt="Leaguememe" class="img-responsive pull-right photo">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-10 col-sm-9 col-sm-push-0 col-md-10 col-xs-8 col-xs-push-1 pad-left-0 pad-right-0">
                                <div class="comment-holder">
                                    <div class="title ">
                                        <span class="nick us-name prtgetusername__<?php echo $key; ?>"><?php echo $value['main_comment']->user_name; ?></span>
                                        <?php
                                        $total_cmtpoint = ((int)$value['main_comment']->total_like) - ((int) $value['main_comment']->total_dislike);
                                        ?>
                                        <span class="points" id="countLike_<?php echo $value['main_comment']->comment_id; ?>"><?php echo $total_cmtpoint; ?></span>
                                        <span class="points">points </span> .
                                        <?php // echo date("H:i A,D, d M Y", strtotime($value['main_comment']->comment_date));  ?>
                                        <span class="points" data-livestamp="<?php echo strtotime($value['main_comment']->comment_date); ?>"><?php echo strtotime($value['main_comment']->comment_date); ?></span>
                                    </div>
                                        <p class="comment-test">
                                            <?php echo $value['main_comment']->comment;?>
                                        </p>
                                    <div class="comment-footer">
                                    
                                        <ul class="list-inline" id="<?php echo $key; ?>">
                                            
                                            <?php 
                                             $user_id = $this->session->userdata('user_id');
                                                if ($user_id) {
                                            ?>
                                            <li class="parentcmtrpl" id="parentcmtrpl_<?php echo $key; ?>"><a href="javascript:void();" >Reply</a></li>
                                            <?php }
                                                else {?>

                                            <li> <a style="cursor: pointer;" href="javascript:void(0);" id="login_modal" style="cursor: pointer" data-toggle="modal" data-target="#login-modal">Reply</a></li>
                                            <?php }?>
                                            
                                            <?php 
                                             $user_id = $this->session->userdata('user_id');
                                                if ($user_id) {
                                            ?>
                                            <li><a style="cursor: pointer;"  id="like_<?php echo $value['main_comment']->comment_id; ?>" onclick="like(<?php echo $user_id; ?>,<?php echo $value['main_comment']->comment_id; ?>)">
                                            <?php
                                            $cmnt_user_id = $value['main_comment']->cmnt_user_id;
                                            $cmnt_comment_id = $value['main_comment']->cmnt_comment_id;

                                            if ($cmnt_user_id == $user_id && $cmnt_comment_id == $value['main_comment']->comment_id && $value['main_comment']->like == 1) {
                                                ?>
                                                <i class="fa fa-arrow-up fa-lg victory_active"></i>
                                            <?php } else { ?>
                                                <i class="fa fa-arrow-up fa-lg "></i>
                                            <?php } ?>
                                            </a></li>

                                            <?php }
                                            else {?>
                                            <li><a style="cursor: pointer;" href="javascript:void(0);" id="login_modal" style="cursor: pointer" data-toggle="modal" data-target="#login-modal"><i class="fa fa-arrow-up fa-lg "></i></a></li>
                                            <?php }?>
                                            
                                            <?php 
                                             $user_id = $this->session->userdata('user_id');
                                                if ($user_id) {
                                            ?>
                                            
                                            <li class="comment-disvote"><a style="cursor: pointer;"  class="disvote" id="dislike_<?php echo $value['main_comment']->comment_id; ?>" onclick="dislike(<?php echo $user_id; ?>,<?php echo $value['main_comment']->comment_id; ?>)">
                                            <?php
                                            if ($cmnt_user_id == $user_id && $cmnt_comment_id == $value['main_comment']->comment_id && $value['main_comment']->like == 0) {
                                                ?>
                                                <i class="fa fa-arrow-down fa-lg defeat_active"></i>
                                            <?php } else { ?>
                                                <i class="fa fa-arrow-down fa-lg"></i>
                                            <?php } ?>
                                            </a></li>
                                            <?php }
                                            else {?>
                                            <li class="comment-disvote"><a style="cursor: pointer;" href="javascript:void(0);" id="login_modal" style="cursor: pointer" data-toggle="modal" data-target="#login-modal"><i class="fa fa-arrow-down fa-lg "></i></a></li>
                                            <?php }?>
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
                                      
                                    </div>
                                </div>
                                        <div class="row replyBox" id="fullReplyBox-<?php echo $key; ?>">  
                                    <?php
                                    for ($i = 0; $i < $totalchildcmt - 1; $i++) {
                                        ?>
                                        <div class="row chdrepl_<?php echo $key; ?>" id="childid_<?php echo $value[$i]->comment_id; ?>" style="margin-left: 30px;">
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-2 col-sm-2  col-xs-2 pad-right-0">
                                                <div class="img-container">
                                                    <?php if (!empty($value['main_comment']->user_image) && $value['main_comment']->user_image != "") { ?>
                                                        <img src="<?php echo base_url() ?>uploads/users/<?php echo $value['main_comment']->user_image; ?>" alt="<?php echo $value['main_comment']->user_image; ?>" class="img-responsive pull-right photo">
                                                    <?php } else { ?>
                                                        <img src="<?php echo base_url() ?>assets/public/images/%EF%80%87.png" alt="Leaguememe" class="img-responsive pull-right photo" >
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-sm-9 col-sm-push-0 col-md-10 col-xs-8 col-xs-push-1 pad-left-0 pad-right-0">
                                                <div class="comment-holder">
                                                    <div class="title">
                                                        <span class="nick us-name getusername__<?php echo $value[$i]->comment_id; ?>"><?php echo $value[$i]->user_name; ?></span>
                                                        <?php
                                                        $total_cmtrplpoint = ((int)$value[$i]->total_like) - ((int) $value[$i]->total_dislike);
                                                        ?>
                                                        <span class="points" id="countLike_<?php echo $value[$i]->comment_id; ?>"><?php echo $total_cmtrplpoint; ?></span>

                                                        <span class="points">points </span> . 
                                                        <?php // echo date("H:i A,D, d M Y", strtotime($value[$i]->comment_date)); ?>
                                                        <span class="points" data-livestamp="<?php echo strtotime($value[$i]->comment_date); ?>"> hi</span>

                                                    </div>

                                                    <p class="comment-test">
                                                       <?php echo $value[$i]->comment; ?>
                                                    </p>
                                                    <div class="comment-footer">
                                                        <div id="<?php echo $key; ?>" class="<?php echo $value[$i]->comment_id; ?>" >
                                                        <ul class="list-inline"  >
                                                            <?php 
                                                         $user_id = $this->session->userdata('user_id');
                                                            if ($user_id) {
                                                        ?>
                                                            <li class="childsubcmtrpl" id="childsubcmtrpl_<?php echo $value['main_comment']->comment_id; ?>"><a style="cursor: pointer;">Reply</a></li>
                                                            <?php }
                                                        else {?>
                                                            <li><a  style="cursor: pointer;" href="javascript:void(0);" id="login_modal" style="cursor: pointer" data-toggle="modal" data-target="#login-modal">Reply</a></li>
                                                        <?php }?>    


                                                        <?php 
                                                         $user_id = $this->session->userdata('user_id');
                                                            if ($user_id) {
                                                        ?>
                                                            <li><a style="cursor: pointer;" id="like_<?php echo $value[$i]->comment_id; ?>" onclick="like(<?php echo $user_id; ?>,<?php echo $value[$i]->comment_id; ?>)">

                                                            <?php
                                                            if ($value[$i]->cmnt_user_id == $user_id && $value[$i]->cmnt_comment_id == $value[$i]->comment_id && $value[$i]->like == 1) {
                                                                ?>
                                                                <i class="fa fa-arrow-up fa-lg victory_active"></i>
                                                               <?php } else { ?>
                                                                <i class="fa fa-arrow-up fa-lg "></i>
                                                            <?php } ?>
                                                                </a></li>

                                                            <?php }
                                                        else {?>
                                                                <li><a style="cursor: pointer;" href="javascript:void(0);" id="login_modal" style="cursor: pointer" data-toggle="modal" data-target="#login-modal"><i class="fa fa-arrow-up fa-lg "></i></a></li>
                                                        <?php }?>
                                                        <?php 
                                                         $user_id = $this->session->userdata('user_id');
                                                            if ($user_id) {
                                                        ?>
                                                                <li class="comment-disvote"><a style="cursor: pointer;" id="dislike_<?php echo $value[$i]->comment_id; ?>" onclick="dislike(<?php echo $user_id; ?>,<?php echo $value[$i]->comment_id; ?>)">
                                                            <?php
                                                            if ($value[$i]->cmnt_user_id == $user_id && $value[$i]->cmnt_comment_id == $value[$i]->comment_id && $value[$i]->like == 0) {
                                                                ?>
                                                                <i class="fa fa-arrow-down fa-lg defeat_active"></i>
                                                            <?php } else { ?>
                                                                <i class="fa fa-arrow-down fa-lg"></i>
                                                            <?php } ?>
                                                                    </a></li>

                                                            <?php }
                                                        else {?>
                                                                    <li class="comment-disvote"><a style="cursor: pointer;" href="javascript:void(0);" id="login_modal" style="cursor: pointer" data-toggle="modal" data-target="#login-modal"><i class="fa fa-arrow-down fa-lg "></i></a></li>
                                                        <?php }?>
                                                                <?php
                                                                $user_id = $this->session->userdata('user_id');
                                                                if ($user_id) {
                                                                    $u_id = $value[$i]->user_id;
                                                                    if ($user_id == $u_id) {
                                                                        ?>
                                                                    <li><a title="Deletecommet" style="cursor: pointer;" onClick="delete_Comment(<?php echo $value[$i]->comment_id; ?>, 'off',<?php echo $user_id; ?>)"><i class="fa fa-remove fa-lg"></i></a></li>
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
                                    </div>  
                                <?php
                                }
                                ?> 
                            </div>
                            </div>
                        </div>
                        <div id="rplycmtbox-<?php echo $key; ?>" style="display:none" class="comment-holder">
                    <div class="row">&nbsp;</div>
                    <div class="row" >
                        <div class="col-lg-2">
                            
                        </div>
                        <div class="col-lg-2">
                            <div class="img-container ">
                                <img id="userPhoto"  class="img-responsive" alt="Leaguememe" src="<?php echo base_url(); ?>uploads/users/6143756727.jpg">
                            </div>                                                      
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group comment-input" style="padding:1px;" id="<?php echo $key; ?>">
                                <textarea class="form-control innercomboBox" placeholder="Update Your Reply" id="addrplCommentBox<?php echo $key; ?>" style="resize: none;"></textarea>
                                <div  id="<?php echo $key; ?>">
                                <button class="btn comment-submit  commentrplPostBtn" id="replypostBtn-<?php echo $key; ?>"  >Comment</button>
                            </div>
                            </div>  
                            <div class="col-lg-2" id="inerwordcountdiv<?php echo $key; ?>">
                                <p>1000</p>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php 
}}?>
 