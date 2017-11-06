<link rel="stylesheet" href="<?php echo base_url(); ?>assets/public/css/img-hover.css">
<style>
    .episode{
        padding: 10px 0px;
    }
</style>

<?php
if (empty($username)) {
    ?>
    <div class="col-md-12 tab-not-login  no-padding">

        <?php
    } else {
        ?>
        <div class="col-md-12 tab-top no-padding">
            <?php
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="draggable-container">
                    <ul class="nav nav-tabs draggable draggable-center" role="tablist">
                        <li role="presentation" class="active"><a href="#summary" aria-controls="home" role="tab" data-toggle="tab" onclick="summary()"><?php echo $anime_detail->anime_name; ?></a></li>
                        <?php
                        foreach ($sub_cate as $sub) {
                            if ($sub->sub_cate == "discussion") {
                                ?>
                                <li role="presentation"><a href="#discussion" aria-controls="profile" role="tab" data-toggle="tab" id="discussion">Discussion</a></li>
                                <?php
                            } elseif ($sub->sub_cate == "manga") {
                                ?>
                                <li role="presentation"><a href="#manga" aria-controls="messages" role="tab" data-toggle="tab" id="manga">Manga</a></li>
                                <?php
                            } elseif ($sub->sub_cate == "theories") {
                                ?>
                                <li role="presentation"><a href="#theories" aria-controls="settings" role="tab" data-toggle="tab" id="theories">Theories</a></li>
                                <?php
                            } elseif ($sub->sub_cate == "episode") {
                                ?>
                                <li role="presentation"><a href="#episode-sec" aria-controls="settings" role="tab" data-toggle="tab" id="episode-sec">Episode</a></li>
                                <?php
                            } elseif ($sub->sub_cate == "review") {
                                ?>
                                <li role="presentation"><a href="#review-sec" aria-controls="settings" role="tab" data-toggle="tab" onclick="review()">Review</a></li>
                                <?php
                            } elseif ($sub->sub_cate == "quotes") {
                                ?>
                                <li role="presentation"><a href="#quotes-sec" aria-controls="settings" role="tab" data-toggle="tab" id="quotes-sec">Quotes</a></li>  
                                <?php
                            }
                        }
                        ?>

                    </ul>
                </div>

                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- One piece tab -->
                    <div role="tabpanel" class="tab-pane active" id="summary">
                        <div class="">
                            <!--<a href="javascript:void(0);" class="btn btn-more-detail" onclick="toggler('myContent1');"> More info </a>-->
                            <div class="left-panel-sec " id="myContent1">
                                <div class="wrap-panel">
                                    <div class="content-panel">
                                        <input type="hidden" value="<?php echo $anime_id; ?>" id="anime_name">
                                        <input type="hidden" value="<?php echo $anime_detail->anime_name; ?>" id="anime_id">
                                        <img src="<?Php echo base_url(); ?>uploads/anime/<?php echo $anime_detail->anime_jpg; ?>" alt="" class="w-100" style="height: 268px;">
                                    </div>
                                    <?php
                                    $episode = $anime_detail->episode;
                                    $episode_time = $anime_detail->episode_time;
                                    $timestamp = strtotime($episode_time);
                                    $time = date('Y-m-d H:i:s', $timestamp);

                                    $manga = $anime_detail->manga;
                                    $manga_time = $anime_detail->manga_time;
                                    $mgtimestamp = strtotime($manga_time);
                                    $mgtime = date('Y-m-d H:i:s', $mgtimestamp);
                                    ?>
                                    <div class="episode-title">
                                        Ep: <?php echo $episode; ?>
                                    </div>
                                    <div class="manga-title">
                                        Manga: <?php echo $manga; ?>
                                    </div>


                                    <div class="last-update">
                                        <div class="episode">
                                            <span id="epclock"></span>
                                        </div>
                                        <div class="episode">
                                            <span id="mgclock"></span>
                                        </div>

                                        <script src="//cdn.rawgit.com/hilios/jQuery.countdown/2.1.0/dist/jquery.countdown.min.js"></script>
                                        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment-with-locales.min.js"></script>
                                        <script src="//cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.4.0/moment-timezone-with-data-2010-2020.min.js"></script>

                                        <script>
                                    var nextYear = moment.tz("<?php echo $time; ?>", "EST");
                                    $('#epclock').countdown(nextYear.toDate(), function(event) {
                                        $(this).html(event.strftime('%Dd %Hhr %Mm'));
                                    });
                                    var nextmgYear = moment.tz("<?php echo $mgtime; ?>", "EST");
                                    $('#mgclock').countdown(nextmgYear.toDate(), function(event) {
                                        $(this).html(event.strftime('%Dd %Hhr %Mm'));
                                    });
                                        </script>
                                    </div>
                                    <div class="content-panel info-table">

                                        <div class="fill-describe">
                                            <span class="caption-describe">Score</span>
                                            <span>:</span>
                                            <span class="score-left">
                                                <?php
                                                if (!empty($all_detail)) {
                                                    echo $all_detail['score'];
                                                } else {
                                                    echo "0";
                                                }
                                                ?>/10
                                            </span>
                                        </div>
                                        <div class="fill-describe">
                                            <span class="caption-describe">Current Episode</span>
                                            <span>:</span>
                                            <span class="score-left">
                                                <?php
                                                if (!empty($all_detail)) {
                                                    echo $all_detail['current_episode'];
                                                } else {
                                                    echo "";
                                                }
                                                ?>
                                            </span>
                                        </div>
                                        <div class="fill-eiscribe">
                                            <span class="caption-describe">Current Manga</span>
                                            <span>:</span>
                                            <span class="score-left">
                                                <?php
                                                if (!empty($all_detail)) {
                                                    echo $all_detail['current_manga'];
                                                } else {
                                                    echo "";
                                                }
                                                ?>
                                            </span>
                                        </div>

                                        <div class="td">
                                            <div class="fill-describe">
                                                <span class="caption-describe">English</span>
                                                <span>:</span>
                                                <span class="score-left">
                                                    <?php
                                                    if (!empty($all_detail)) {
                                                        echo $all_detail['english'];
                                                    } else {
                                                        echo "ERASED";
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="fill-describe">
                                                <span class="caption-describe">Synonyms</span>
                                                <span>:</span>
                                                <span class="score-left">
                                                    <?php
                                                    if (!empty($all_detail)) {
                                                        echo $all_detail['synonyms'];
                                                    } else {
                                                        echo "The Town Where";
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="fill-describe">
                                                <span class="caption-describe">Japanese</span>
                                                <span>:</span>
                                                <span class="score-left">
                                                    <?php
                                                    if (!empty($all_detail)) {
                                                        echo $all_detail['japanese'];
                                                    } else {
                                                        echo "僕だけが";
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="fill-describe">
                                                <span class="caption-describe">Episode</span>
                                                <span>:</span>
                                                <span class="score-left">
                                                    <?php
                                                    if (!empty($all_detail)) {
                                                        echo $all_detail['episode'];
                                                    } else {
                                                        echo "0";
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="fill-describe">
                                                <span class="caption-describe">Status</span>
                                                <span>:</span>
                                                <span class="score-left">
                                                    <?php
                                                    if (!empty($all_detail)) {
                                                        echo $all_detail['status'];
                                                    } else {
                                                        echo "Currently Airing";
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="fill-describe">
                                                <span class="caption-describe">Aired</span>
                                                <span>:</span>
                                                <span class="score-left">
                                                    <?php
                                                    if (!empty($all_detail) && $all_detail['aired'] !== "0000-00-00 00:00:00") {
                                                        echo date("d F, Y", strtotime($all_detail['aired']));
                                                    } else {
                                                        echo "Jan 8, 2016";
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="fill-describe">
                                                <span class="caption-describe">Genres</span>
                                                <span>:</span>
                                                <span class="score-left">
                                                    <?php
                                                    if (!empty($all_detail)) {
                                                        echo $all_detail['jenres'];
                                                    } else {
                                                        echo "Mystery";
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="fill-describe">
                                                <span class="caption-describe">Duration</span>
                                                <span>:</span>
                                                <span class="score-left">
                                                    <?php
                                                    if (!empty($all_detail)) {
                                                        echo $all_detail['duration'];
                                                    } else {
                                                        echo "23 min/eps";
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="fill-describe">
                                                <span class="caption-describe">Rating</span>
                                                <span>:</span>
                                                <span class="score-left">
                                                    <?php
                                                    if (!empty($all_detail)) {
                                                        echo $all_detail['rating'];
                                                    } else {
                                                        echo "R - 17+";
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="btn-more" id="more">More..</div>
                                    </div>


                                    <div class="title link-menu">
                                        <a href="#" class="link-fifth-left"><i class="fa fa-book"></i> Synopsis</a>
                                    </div>
                                    <div class="title link-menu">
                                        <a href="javascript:void(0)" onclick="postReview();"class="link-fifth-left"><i class="fa fa-pencil-square-o"></i> Write Review</a>
                                    </div>
                                    <div class="title link-menu">
                                        <a href="#" class="link-fifth-left"><i class="fa fa-plus"></i> Add to..</a>
                                    </div>
                                </div>
                                <!-- end wrap-panel-->
                            </div>
                            <!-- end left-panel-sec -->

                            <div class="right-panel-sec"> 
                                <div class="anime_loader col-md-7 col-xs-12" style="display:none;margin-right: auto;margin-left: auto;" align="center">
                                    <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif">
                                </div>
                                <div class="col-md-7 col-xs-12 main-content" id="anime_switch">
                                </div>

                                <div class="col-md-5 col-sm-12 ads" id="anime_ads" >
                                    <div class="box-center">
                                        <div class="banner" id="recent_dis">
                                            <div class="title-recent-discuss">
                                                Recent Discussion
                                            </div>
                                            <?php foreach ($recent_dis as $recent) { ?>
                                                <div class="box-recent-discuss">
                                                    <div class="media info-avatar info-avatar-discuss">
                                                        <div class="media-left media-left-discuss">
                                                            <a href="<?= base_url("discussion-single/" . $recent->anime_discussionid) ?>">
                                                                <img class="media-object avatar avatar-discuss" src="<?= base_url() ?>uploads/users/<?= $recent->user_image ?>" alt="<?= $recent->name ?>">
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

                                        <?php echo $this->load->view('template/right_sidebar'); ?>
                                    </div>
                                </div>
                                <!--end ads--> 
                            </div>
                            <!--end right-panel-sec -->
                        </div>
                    </div>
                    <!-- end one piece tab -->

                </div>
                <!-- end tab content -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->

    </div>
    <!-- end col-md-12 -->

    <script src="<?php echo base_url(); ?>assets/public/js/anime_album_list.js"></script>
    <script src="<?php echo base_url(); ?>assets/public/js/anime.js"></script>