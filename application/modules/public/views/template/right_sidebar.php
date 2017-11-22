 
<style >
    .affix{
        top:70px;
    }
</style>
<!--<div class="col-md-5 col-sm-12 ads">--> 
<?php
//function compress($source, $destination, $quality) {
//
//    $info = getimagesize($source);
//
//    if ($info['mime'] == 'image/jpeg')
//        $image = imagecreatefromjpeg($source);
//
//    elseif ($info['mime'] == 'image/gif')
//        $image = imagecreatefromgif($source);
//
//    elseif ($info['mime'] == 'image/png')
//        $image = imagecreatefrompng($source);
//
//    imagejpeg($image, $destination, $quality);
//
//    return $destination;
//}
?>
<div class="box-center" >

    <div class="banner banner_first" style="display:none;">
        <div class="title-recent-discuss">
            <strong>Rules and Guideline</strong>
        </div>
        <div class="panel panel-default right_bar_rules">
            <?php
            if (isset($rules) && !empty($rules)) {
                echo $rules;
            } else {
                ?>
                <ul class="rules-list">
                    <li>Picture Category</li>
                    <li>Spoiler Tags</li>
                    <li>Submit pictures to right category</li>
                    <li>No hentai</li>
                    <li>This sub should only be related to one piece</li>
                    <li>High quality pictures</li>
                </ul>
                <?php
            }
            ?>
        </div>

    </div>
    <?php
    if (isset($discussion_detail_page)) {
        $uid = $this->session->userdata('user_id');

        if ($discussion->discussion_userid == $uid) {
            ?>
            <a href="javascript:void(0)" class="btn btn-edit-detail" style="display: inline-block;">
                Edit
            </a>
            <a href="javascript:void(0)" class="btn btn-info btn-save-detail" style="display: none;">
                Save
            </a>
            <a href="javascript:void(0)" class="btn btn-info btn-delete-detail">
                Delete
            </a>
        <?php } ?>
        <div class="banner">
            <div class="title-recent-discuss">
                Recent Discussion
            </div>
            <?php foreach ($recent_disc as $recent) { ?>
                <div class="box-recent-discuss">
                    <div class="media info-avatar info-avatar-discuss">
                        <div class="media-left media-left-discuss">
                            <a href="<?= base_url("discussion-single/" . $recent->anime_discussionid) ?>">
                                <?php if (isset($recent->user_image) && !empty($recent->user_image)) {
                                    ?>

                                    <img class="media-object avatar img-circle avatar-discuss" src="<?= base_url() ?>uploads/users/<?= $recent->user_image ?>" alt="<?= $recent->name ?>">
                                    <?php
                                } else {
                                    ?>
                                    <img class="media-object avatar img-circle avatar-discuss " src="<?= base_url() ?>assets/public/img/luffy.png" alt="<?= $recent->name ?>">
                                    <?php
                                }
                                ?>
                            </a>
                        </div>
                        <div class="media-body w-2000">
                            <a href="<?= base_url("discussion-single/" . $recent->anime_discussionid) ?>"><h5><?= $recent->title ?></h5></a>
                            <span class="minute by-username">By </span>
                            <span class="profile-username"><?= $recent->name ?></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php
    }
    ?>
    <div class="right_banner_side text-center" data-offset-top="155">

        <?php echo $right_bar['content'];?>
        <div class="summary">

            <div class="social_banner">
                <!--<a href="#" target="_self">
                    <img src="<?php /*echo base_url(); */?>assets/public/img/asasa.png" alt="ads" style="" class="img-responsive" />
                </a>-->

                <!-- Leaguememe Right Side -->

                <ins class="adsbygoogle"
                     style="display:inline-block;width:300px;height:600px"
                     data-ad-client="ca-pub-9746555787553362"
                     data-ad-slot="8840712489"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
            <div class="social-network">
                <ul class="list-unstyled">
                    <?php
                    $urls = 'https://graph.facebook.com/v2.7/LeagueMemes?fields=fan_count&access_token=1727081077607945|e6c9a2afffc0219efbe7de97a913a0dd';
                    $string = @file_get_contents($urls);
                    ?>

                    <li>

                        <a href="https://www.facebook.com/LeagueMemes" target="_self">
                            <div class="link"><i class="fa fa-facebook"></i>
                            </div>
                        </a>
                        <p class="text-con">
                            <?php
                            if ($string) {
                                $fan_count = json_decode($string);
                                $get_fan_count = $fan_count->fan_count;

                                $postresultscount = (($get_fan_count) ? $get_fan_count : 1);
                                $k = 1000;
                                if ($postresultscount >= $k) {
                                    $echoxcount = round($postresultscount / $k) . 'K';
                                } else {
                                    $echoxcount = $postresultscount;
                                }
                                echo $echoxcount;
                            }
                            ?>
                        </p>
                    </li>
                    <li>

                        <?php

                        class Result {

                            public $sumCount = 0;

                            function __construct($count) {
                                $this->sumCount = $count;
                            }

                        }

                        $tw_username = 'mayur8189';

                        $data = file_get_contents('https://cdn.syndication.twimg.com/widgets/followbutton/info.json?screen_names=' . $tw_username);
                        $parsed = json_decode($data, true);
                        $tw_followers = $parsed[0]['followers_count'];
                        ?>

                        <a href = "https://twitter.com/mayur8189" target = "_self">
                            <div class = "link"><i class = "fa fa-twitter"></i>
                            </div>
                        </a>

                        <p class = "text-con">
                            <?php
                            $resultcount = new Result($tw_followers);

                            $twitterscount = (($resultcount) ? $resultcount->sumCount : 1);
                            $tk = 1000;
                            if ($twitterscount >= $tk) {
                                $echoxcount = round($twitterscount / $tk) . 'K';
                            } else {
                                $echoxcount = $twitterscount;
                            }
                            echo $echoxcount;
                            ?>
                        </p>
                    </li>
                    <li>

                        <?php
                        $insta_access_token = '1990944904.1677ed0.5bc564c91d5d4eb6ac950b6aa23300cc';
                        $url = 'https://api.instagram.com/v1/users/self/?access_token=' . $insta_access_token;
                        $curl = curl_init($url);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                        $result = curl_exec($curl);
                        curl_close($curl);
                        $insta_details = json_decode($result, true);
                        ?>
                        <a href = "https://www.instagram.com/mayur.8189/" target = "_self">
                            <div class = "link"><i class = "fa fa-instagram"></i>
                            </div>
                        </a>
                        <p class = "text-con instagram">
                            <?php
                            $ipostresultscount = (( $insta_details['data']['counts']['followed_by']) ? $insta_details['data']['counts']['followed_by'] : 1);
                            $ik = 1000;
                            if ($ipostresultscount >= $ik) {
                                $iechoxcount = round($ipostresultscount / $ik) . 'K';
                            } else {
                                $iechoxcount = $ipostresultscount;
                            }
                            echo $iechoxcount;
                            ?>
                        </p>
                    </li>
                </ul>
            </div>

            <div class = "link-bottom">
                <ul class = "list-unstyled">
                    <li><a href = "#">Advertise</a>
                    </li>
                    <li><a href = "#">Contacts</a>
                    </li>
                    <li><a href = "#">Privacy</a>
                    </li>
                    <li><a href = "">Terms</a>
                    </li>
                </ul>
                <p class = "text-center copyright">Copyright © All Rights Reserved</p>
            </div>
        </div>
        <div class="summary"></div>
    </div>
</div>

<!--</div> -->
