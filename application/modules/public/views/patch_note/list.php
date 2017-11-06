 
<div classs="row">
    <div class="col-md-12 wrap-main"> 
        <input type="hidden" name="total_groups" id="patch_total_groups" value="<?php echo isset($allcount) ? $allcount : 0; ?>"/>
        <?php
        if (count($list_patch_notes) > 0) {
            $k = 0;
            $divider = 10;
            foreach ($list_patch_notes as $value) {

                $patch_sn = $value['patch'];
                $patch_sec = $value['section'];

                $main_id = $patch_sn['main_id'];
                $pTitle = $patch_sn['patch_title'];


                if (count($value['section']) > 0) {
                    if (stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")) { // if mobile browser
                    if ($k % $divider == 0) {
                        ?>
                                <ins class="adsbygoogle"
                                 style="display:inline-block;width:300px;height:280px"
                                 data-ad-client="ca-pub-9746555787553362"
                                 data-ad-slot="5203425452"
                                 data-ad-format="auto"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        <?php
                    }
                }
                    
                    ?>
                    <div class="wrapper-avatar patch_notes_list" style="border-bottom: none">
                        <div class="media info-avatar">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>assets/public/img/default_profile.jpeg" alt="profile pic">
                                </a>
                            </div>
                            <div class="media-body w-2000">
                                <a href="#"><h5> Admin </h5></a>

                                <div class="col-md-12 no-padding">
                                    <span class="minute" style="display: inline"  data-livestamp="<?php echo strtotime($patch_sn['datecreated']); ?>"></span> 
                                </div> 
                            </div> 

                        </div>
                        <h3><a href="<?= base_url() ?>patch-note-detail/<?= $main_id ?>"><?= !empty($pTitle) ? $pTitle : '' ?></a></h3> 

                        <?php
                        foreach ($value['section'] as $section) {
                            $img_slider = explode(",", $section->file);
                            ?>
                        <div>  <?= !empty($section->patch_name) ? $section->patch_name : '' ?> </div>
                            <div id="patch_slider_<?= $section->sect_id ?>" class=" patch_slider" >
                                <?php
                                  // if($key == 1){
                                foreach ($img_slider as $key => $img) {
                                    if (!empty($img)) {
                                     
                                        ?>
                                        <div>
                                            <a href="<?= base_url() ?>patch-note-detail/<?= $main_id ?>"> 
                                                <img class="img-responsive meme-big" src="<?= base_url() ?>uploads/patch_notes/<?= $img ?>"  >
                                            </a>
                                        </div>
                                        <?php
                                 //  }
                                    
                               break; } else {
                                        echo "No Patch notes image found";
                                    }
                                }
                                ?>
                            </div> 
                        
                        <?php break; }
                        ?>

                        <div class="shares">
                            <!-- update -->
                            <div class="link-icon pull-left">
                                <ul class="list-unstyled left-link">
                                    <?php
                                    if (isset($userid) && !empty($userid) && isset($victory[$main_id]) && !empty($victory[$main_id])) {
                                        if (in_array($userid, $victory[$main_id])) {
                                            ?>
                                            <li>
                                                <a onClick = "onvictory(this.id);" id = "<?php echo $main_id; ?>" style = "cursor: pointer" rel = "<?php echo $main_id; ?>"class="hvr-bounce-in">
                                                    <img id="victory_img_<?php echo $main_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/up-hover.png">
                                                </a>
                                            </li>
                                            <?php
                                        } else {
                                            ?> 
                                            <li>
                                                <a onClick = "onvictory(this.id);" id = "<?php echo $main_id; ?>" style = "cursor: pointer" rel = "<?php echo $main_id; ?>"  class="hvr-bounce-in">
                                                    <img id="victory_img_<?php echo $main_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/up.png" >
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <li>
                                            <a onClick = "onvictory(this.id);" id = "<?php echo $main_id; ?>" style = "cursor: pointer" rel = "<?php echo $main_id; ?>"  class="hvr-bounce-in">
                                                <img id="victory_img_<?php echo $main_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/up.png" >
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    if (isset($userid) && !empty($userid) && isset($defact[$main_id]) && !empty($defact[$main_id])) {
                                        if (in_array($userid, $defact[$main_id])) {
                                            ?>
                                            <li>
                                                <a class="hvr-bounce-in" onClick="ondefeat(this.id)" id="<?php echo $main_id; ?>" style="cursor: pointer" rel="<?php echo $main_id; ?>">
                                                    <img id="defeat_img_<?php echo $main_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/down-hover.png" >
                                                </a>
                                            </li>
                                            <?php
                                        } else {
                                            ?> 
                                            <li>
                                                <a class="hvr-bounce-in" onClick="ondefeat(this.id)" id="<?php echo $main_id; ?>" style="cursor: pointer" rel="<?php echo $main_id; ?>">
                                                    <img id="defeat_img_<?php echo $main_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/down.png" >
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <li>
                                            <a  class="hvr-bounce-in" onClick="ondefeat(this.id)" id="<?php echo $main_id; ?>" style="cursor: pointer" rel="<?php echo $main_id; ?>">
                                                <img id="defeat_img_<?php echo $main_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/down.png" >
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                    <li>
                                        <a  href = "<?= base_url() ?>patch-note-detail/<?= $main_id ?>#cmtclick" class="hvr-bounce-in">
                                            <img src="<?php echo base_url(); ?>assets/public/img/icon/post/comment.png" >
                                        </a>
                                    </li>
                                    <?php
                                    if (isset($userid) && !empty($userid) && isset($favuserid[$main_id]) && !empty($favuserid[$main_id])) {

                                        if (in_array($userid, $favuserid[$main_id])) {
                                            ?>
                                            <li>
                                                <a class="hvr-bounce-in" onclick="onfavourites(this.id)" id="<?php echo $main_id; ?>" style="cursor: pointer" rel="<?php echo $main_id; ?>">
                                                    <img id="favourites_img_<?php echo $main_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/open-hover.png" >
                                                </a>
                                            </li>

                                            <?php
                                        } else {
                                            ?> 
                                            <li>
                                                <a class="hvr-bounce-in" onclick="onfavourites(this.id)" id="<?php echo $main_id; ?>" style="cursor: pointer" rel="<?php echo $main_id; ?>">
                                                    <img id="favourites_img_<?php echo $main_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/open.png" >
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <li>
                                            <a class="hvr-bounce-in" onclick="onfavourites(this.id)" id="<?php echo $main_id; ?>" style="cursor: pointer" rel="<?php echo $main_id; ?>">
                                                <img id="favourites_img_<?php echo $main_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/open.png" >
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>

                                </ul>
                            </div>

                            <!-- social -->
                            <div class="pull-right social-btn">


                                <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click(<?= $main_id ?>)" target="_blank" class="fb-bg medium-btn mar-r-5">
                                    <i class="fa fa-facebook"></i> share
                                </a> 
                                <a  href="http://twitter.com/home/?status=<?= base_url() ?>patch-note-detail/<?= $main_id ?> (via @leaguememecom)" class="popup twitter tw-bg medium-btn" target="_blank">
                                    <i class="fa fa-twitter"></i> share
                                </a>
                            </div>
                        </div>
                        <div class="clearfix"></div> 
                         <div class="link-comment" style="border-top: 1px solid #ededed;margin-top: 10px">
                            <?php
                            $total_point = ((int) $patch_sn['total_victory']) - ((int) $patch_sn['total_defeat']);
                            ?>
                            <a href="javascript:void(0)" id="point_<?php // echo $value->patchId;      ?>"><?php echo $total_point; ?>  </a> <a>Likes</a> &nbsp; - &nbsp;
                            <a href="javascript:void(0)"> <?= !empty($patch_sn['total_comment']) ? $patch_sn['total_comment'] : '0' ?> Comments</a>
                        </div>
                    </div>

                       
                    <?php
               $k++; }
            }
        } else {
            if ($page_row == 0) {
                ?>
                <br>
                <div> 
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> No Patch Notes found  
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div> 