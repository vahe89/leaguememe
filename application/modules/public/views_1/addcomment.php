
   <?php
foreach ($useralldata as $key => $value) {
    if ($userdata['parent'] == 0) {
        $key1 = $userdata['parent'];
    } else {
        $key1 = $lastid;
    }
    ?> 
    <div class="container-fluid pad-left-0 pad-right-0">
        <div class="clicked-comments-hot ">
            <div class="container-fluid pad-left-0 pad-right-0">
                <ul>

                    <li>
                        <div class="comment-holder">
                            <div class="row chdrepl_<?php echo $userdata['parent']; ?>;" id="childid_<?php echo $key1; ?>" style="margin-left: 30px;">
                            <div class="row">

                                <div class="col-lg-2 col-sm-2  col-xs-2 pad-right-0">
                                    <div class="img-container">
                                         <?php if (!empty($value['main_comment']->user_image) && $value['main_comment']->user_image != "") { ?>
                                            <img src="<?php echo base_url() ?>uploads/users/<?php echo $value['main_comment']->user_image; ?>" alt="<?php echo $value['main_comment']->user_image; ?>" class="img-responsive pull-right photo">
                                        <?php } else { ?>
                                            <img src="<?php echo base_url() ?>assets/public/images/%EF%80%87.png" alt="Leaguememe" class="img-responsive pull-right photo">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-sm-9 col-sm-push-0 col-md-10 col-xs-8 col-xs-push-1 pad-left-0 pad-right-0">
                                    <div class="comment-holder">
                                        <div class="title">
                                            <span class="nick us-name getusername__<?php echo $key1; ?>" id="getusername<?php echo $key1; ?>"><?php echo $value['user_name']; ?></span>
                                          <?php
                        //                            $total_cmtpoint = ((int)$value['main_comment']->total_like) - ((int) $value['main_comment']->total_dislike);
                                                    ?>
                                                <span class="points" id="countLike_<?php echo $key1?>"> <?php  echo '0'; ?> </span>
                                            <span class="points"> points </span> .
                                            <span class="points"  data-livestamp="<?php echo strtotime($comment_date); ?>"></span>
                                        </div>

                                        <p class="comment-test">
                                          <?php echo $userdata['cmt']; ?>
                                        </p>
                                        <div class="comment-footer">
                                                 <div class="<?php echo $key1; ?>" id="<?php echo $userdata['parent']; ?>">
                                                    <ul class="list-inline">
                                                      <?php 
                                                        $user_id = $this->session->userdata('user_id');?>
                                                     <li class="childsubcmtrpl" id="childsubcmtrpl_<?php echo $userdata['parent']; ?>"><a href="javascript:void();">Reply</a></li>
                    
                                                     <li><a style="cursor: pointer;" id="like_<?php echo $key1; ?>" onclick="like(<?php echo $user_id; ?>,<?php echo $key1; ?>)">
                                                        <i class="fa fa-arrow-up fa-lg"></i>
                                                         </a></li>
 
                                                         <li class="comment-disvote"><a class="disvote" style="cursor: pointer;"  id="dislike_<?php echo $key1; ?>" onclick="dislike(<?php echo $user_id; ?>,<?php echo $key1; ?>)">
                                                        <i class="fa fa-arrow-down fa-lg"></i>
                                                         </a></li>
                                            </ul>
                                        </div>
                                                

                                        </div>
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
}
?> 

  