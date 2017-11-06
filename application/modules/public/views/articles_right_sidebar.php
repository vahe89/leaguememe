<style >
    .affix{
        top:70px;
    }
</style>
<div class="col-md-4 col-xs-12 col-sm-12 no-padding">
    <div class="box-center">
        <div class="featured-side-block">
            <p class="header">Top Page Views</p>
            <ul class="featured-list" id="top_10_pageview">

            </ul>
        </div>

        <!--        <div class="featured-side-block">
                    <div class="header">
                        <p>Interview</p>
                        <a href="#">More..</a>
                    </div>	
                    <ul class="featured-list">
                        <li class="featured">
                            <a href="#" class="img-featured">
                                <img src="<?php echo base_url(); ?>assets/public/img/articel-right1.jpeg">
                            </a>
                            <div class="detail-featured">
                                <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                                <div class="information-featured">
                                    <p class="info-interview">
                                        by <a href="#">OG.Fear</a>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="featured">
                            <a href="#" class="img-featured">
                                <img src="<?php echo base_url(); ?>assets/public/img/articel-right2.jpeg">
                            </a>
                            <div class="detail-featured">
                                <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                                <div class="information-featured">
                                    <p class="info-interview">
                                        by <a href="#">oldMan</a>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="featured">
                            <a href="#" class="img-featured">
                                <img src="<?php echo base_url(); ?>assets/public/img/articel-right3.jpeg">
                            </a>
                            <div class="detail-featured">
                                <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                                <div class="information-featured">
                                    <p class="info-interview">
                                        by <a href="#">Luffy D'monkey</a>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="featured">
                            <a href="#" class="img-featured">
                                <img src="<?php echo base_url(); ?>assets/public/img/articel-right2.jpeg">
                            </a>
                            <div class="detail-featured">
                                <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                                <div class="information-featured">
                                    <p class="info-interview">
                                        by <a href="#">MAL_editing_team</a>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="featured">
                            <a href="#" class="img-featured">
                                <img src="<?php echo base_url(); ?>assets/public/img/articel-right3.jpeg">
                            </a>
                            <div class="detail-featured">
                                <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                                <div class="information-featured">
                                    <p class="info-interview">
                                        by <a href="#">Dude</a>
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>-->

        <div class="sidebar_Article">

   <?php 
 if (stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")) {
     
 }else{?>
            <div class="banner">
<!--                <a href="#" target="_self">
                    <img src="<?php echo base_url(); ?>assets/public/img/asasa.png" alt="ads" style="" class="img-responsive" />
                </a>  -->

                <!-- Leaguememe Right Side -->

            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:280px"
                 data-ad-client="ca-pub-9746555787553362"
                 data-ad-slot="1902005285"></ins>
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
            <?php }
?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $.ajax({
            url: base_url + 'public/news/getAjaxtop10Views',
            type: 'post',
            beforeSend: function() {
                $("#top_10_pageview").html("<div class='text-center'><img src='<?= base_url() ?>assets/public/img/ajax-loader.gif'></div>");
            },
            success: function(response) {
                $('#top_10_pageview').html(response);
                $(".sidebar_Article").affix({offset: {top: $('#top_10_pageview').outerHeight(true)}});
            }
        });

    });

</script>