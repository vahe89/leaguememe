  

<input type="hidden" name="total_groups" id="total_groups" value="<?php echo isset($allcount) ? $allcount : 0; ?>"/>
<?php
if (count($result) > 0 && !empty($result)) {
    foreach ($result as $all_poll_data) {
        $total_point = ((int) $all_poll_data['total_victory']) - ((int) $all_poll_data['total_defeat']);
        $array = explode(",", $all_poll_data['answers']);
        $poll_id = $all_poll_data['id']; 
        
        ?>
        <div class="media info-avatar all-poll">

            <div class="media-body media-body-vote">
                <?php
                if (isset($all_poll_data['user_image']) && !empty($all_poll_data['user_image'])) {
                    ?>
                    <a href="#" style="float: left;">
                        <img src="<?php echo base_url(); ?>uploads/users/<?php echo $all_poll_data['user_image']; ?>" alt="" class="media-object avatar img-circle">
                    </a>
                    <?php
                } else {
                    ?>                 
                    <a href="#" style="float: left;">
                        <img src="<?php echo base_url(); ?>assets/public/img/default_profile.jpeg" alt="profile pic" class="media-object avatar img-circle">
                    </a>
                <?php } ?>  

                <a href="<?php echo base_url(); ?>leaguememe-profile/<?php echo $all_poll_data['user_name']; ?>">
                    <h5 class="pad-l-65"><?php echo empty($all_poll_data['name']) ? $all_poll_data['user_name'] : $all_poll_data['name']; ?></h5>
                </a>

                <span class="minute pad-l-65" style="display: block" data-livestamp="<?php echo strtotime($all_poll_data['created_date']); ?>"></span>
                <div class="wrap-tag-comment">
                    <div class="avatar-comment">
                        <a id="<?php echo $all_poll_data['id']; ?>"><?php echo $total_point; ?></a><a> Likes </a> &nbsp; - &nbsp;
                        <a href="#" id="<?php echo $all_poll_data['id'] . "yy"; ?>"><?php
                            $total_comment = $all_poll_data['total_comment'];
                            if (!empty($total_comment)) {
                                echo $total_comment;
                            } else {
                                echo '0';
                            }
                            ?> </a><a> Comments</a>
                    </div>

                </div>
                <div class="wrap-tag-comment mar-t-10"> 
                    <div class="tag   tag-index tag-vote">
                        <span id="credit2" class="normal-tag tag-poll">Poll</span>
                        <?php if ($all_poll_data['spoiler'] == 1) { ?>
                            <span class="red-tag normal-tag">Spoiler</span>
                            <?php
                        }
                        if (!empty($all_poll_data['author']) AND ! empty($all_poll_data['credit'])) {
                            ?>
                            <span  class="normal-tag disc-credit-show" data-credit="<?= $all_poll_data['author'] ?>">Credit</span>
                            <?php
                            $img = "fb-credit.png";
                            $lnk = "https://www.facebook.com";
                            if (strpos($all_poll_data['credit'], "facebook")) {
                                $img = "fb-credit.png";
                                $lnk = "https://www.facebook.com/";
                            } elseif (strpos($all_poll_data['credit'], "twitter")) {
                                $img = "tt-credit.png";
                                $lnk = "https://twitter.com";
                            } elseif (strpos($all_poll_data['credit'], "insta")) {
                                $img = "ig-credit.png";
                                $lnk = "https://www.instagram.com";
                            }
                            ?>
                            <a href="<?= isset($all_poll_data['author']) ? $lnk . '/' . $all_poll_data['author'] : $lnk ?>" target="_BLANK" class="fb-1" style="display: none">
                                <img src="<?=  base_url()?>assets/public/img/<?= $img ?>">
                            </a>
                        <?php } ?>
                        <!--                                    </div>-->
                    </div>
                </div>
            </div>


            <a href="<?php echo base_url(); ?>poll-vote/<?php echo $all_poll_data['id']; ?>"> 
                <div class="title-voting-click">
                    <?php echo $all_poll_data['questions']; ?>
                </div>

                <?php
                for ($i = 0; $i < count($array); $i++) {
                    ?>
                    <ul class="list-answer" id="list-answer">
                        <li>
                            <div class="answer1">
                                <?php echo $i + '1' . ". "; ?><?php echo $array[$i]; ?>
                            </div>
                        </li>

                    </ul>

                <?php } ?>
            </a>
            <div class="button-vote-wrapper">

                <a href="<?php echo base_url(); ?>poll-vote/<?php echo $all_poll_data['id']; ?>" class="btn btn-voting">
                    Give Vote
                </a>
                <a href="<?php echo base_url(); ?>result-voting/<?php echo $all_poll_data['id']; ?>" class="btn btn-review">
                    Result
                </a>

            </div>
        </div>
        <?php
    }
} else {
    if (!isset($row) && empty($row) && $row = 0) {
        ?>
        <div> 
            <div class="alert alert-danger">
                <strong>Oops!</strong> No Poll result found  
            </div>
        </div>
        <?php
    }
    ?>

<?php }
?>
   



