<h3 class="notif-title">Notifications</h3>
<?php if (!empty($noti_detail)) {
    ?>
    <div style="overflow: auto; height: 330px;">
        <?php
        foreach ($noti_detail as $value) {
            $user_name = $this->session->userdata('user_name');
            $username = '@' . $user_name;
            $check = $value['comment'];
            $rows = explode("\n", $check);
            $words = array();
            foreach ($rows as $row) {
                $temp = explode(" ", $row);
                foreach ($temp as $word)
                    $words[] = $word;
            }

            if ($value['status'] == 'unread') {
                ?>
                <div class="notif-fill" style="background:navajowhite" >
                    <div class="ava-notif">
                        <img class="img-circle" src="<?php echo base_url(); ?>uploads/users/<?php echo $value['user_image']; ?>">
                    </div>

                    <div class="middle-section">
                        <div class="username-notif">

                            <?php
                            if (in_array($username, $words)) {
                                $key = array_search($username, $words);
                                unset($words[$key]);
                                $new = implode(" ", $words);
                                ?>
                                <span><a href="<?php echo base_url(); ?>leaguememe_profile/<?php echo $value['user_name'] ?>" class="linkin-user"> <?php echo empty($value['name']) ? $value['user_name'] : $value['name']; ?></a></span>
                                <span><?php echo "mentioned you in comment:"; ?></span>
                                <div class="date-notif" style="font-size: 13px;"><a href="<?php echo base_url(); ?>leaguememe_profile/<?php echo $user_name; ?>"><?php echo $username; ?></a>&nbsp;<?php echo $new; ?></div>
                            <?php } else { ?>
                                <span><a href="<?php echo base_url(); ?>leaguememe_profile/<?php echo $value['user_name'] ?>" class="linkin-user"> <?php echo empty($value['name']) ? $value['user_name'] : $value['name']; ?></a></span>
                                <span><?php echo $value['pre_value']; ?></span>
                                <div class="date-notif" style="font-size: 13px;"><?php echo $value['comment']; ?></div>
                            <?php } ?>
                            <div class="date-notif" data-livestamp="<?php echo strtotime($value['noti_timestamp']); ?>"></div>
                        </div>
                    </div>

                    <div class="post-notif">
                        <?php if ($value['leagueimage_id'] == 1) {
                            ?>
                            <a href="<?php echo base_url(); ?>leaguememe_profile/<?php echo $value['user_name'] ?>" class="btn btn-red" style="width: auto; margin-left: -19px;"> <i class="fa fa-user-plus"></i> </a>
                            <?php
                        } else {
                            ?>
                            <a href="<?php echo base_url(); ?><?php echo $value['leagueimage_id'] ?>"><img class="img-responsive "    src="<?php echo base_url(); ?>uploads/league/<?php echo $value['leagueimage_filename']; ?>"></a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="notif-fill" >
                    <div class="ava-notif">
                        <img class="img-circle" src="<?php echo base_url(); ?>uploads/users/<?php echo $value['user_image']; ?>">
                    </div>

                    <div class="middle-section">
                        <div class="username-notif">
                            <?php
                            if (in_array($username, $words)) {
                                $key = array_search($username, $words);
                                $new = implode(" ", $words);

                                ?>
                                <span><a href="<?php echo base_url(); ?>leaguememe_profile/<?php echo $value['user_name'] ?>" class="linkin-user"> <?php echo empty($value['name']) ? $value['user_name'] : $value['name']; ?></a></span>
                                <span><?php echo "mentioned you in comment:"; ?></span>
                                <div class="date-notif" style="font-size: 13px;">
                                    <?php echo highlight_phrase($new, $words[$key], '<a href = "leaguememe_profile/'.$user_name.'"><span class="linkin-user">', '</span></a>'); ?>
                                </div>  
                            <?php } else { ?>
                                <span><a href="<?php echo base_url(); ?>leaguememe_profile/<?php echo $value['user_name'] ?>" class="linkin-user"> <?php echo empty($value['name']) ? $value['user_name'] : $value['name']; ?></a></span>
                                <span><?php echo $value['pre_value']; ?></span>
                                <div class="date-notif" style="font-size: 13px;"><?php echo $value['comment']; ?></div>
                            <?php } ?>
                            <div class="date-notif" data-livestamp="<?php echo strtotime($value['noti_timestamp']); ?>"></div>
                        </div>
                    </div>

                    <div class="post-notif">
                        <?php if ($value['leagueimage_id'] == 1) {
                            ?>
                            <a href="<?php echo base_url(); ?>leaguememe_profile/<?php echo $value['user_name'] ?>" class="btn btn-red" style="width: auto; margin-left: -19px;"> <i class="fa fa-user-plus"></i> </a>
                            <?php
                        } else {
                            ?>
                            <a href="<?php echo base_url(); ?><?php echo $value['leagueimage_id'] ?>"><img   class="img-responsive "  src="<?php echo base_url(); ?>uploads/league/<?php echo $value['leagueimage_filename']; ?>"></a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
        }
        ?> 
    </div>

    <div class="btn btn-see-all seeAll"><a href="<?Php echo base_url(); ?>notification">See All</a></div>
    <?php
} else {
    ?>
    <div>
        <h3 class="notif-title">Notification Not Available</h3>
    </div>
    <?php
}
?>