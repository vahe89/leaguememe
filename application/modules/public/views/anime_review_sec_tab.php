<div class="row">
    <div class="col-md-12">
        <h3>Review</h3>

        <div class="row">
            <div class="col-md-6  col-xs-12 most-help-wrapper"> 
                <div class="dropdown">
                    <button class="btn btn-dropdown dropdown-toggle" id="review-fiter" type="button" data-toggle="dropdown"><b id="reviewfreshVal">Most Helpfull Weighted</b>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu"  aria-labelledby="review-filter">
                        <li id="Most Helpfull Weighted" class="reviewTab active"><a href="javascript:void(0);" class="active" id="like_1" >Most Helpfull Weighted</a></li>
                        <li id="No Helpfull Weighted" class="reviewTab"><a href="javascript:void(0);" id="like_0">No Helpfull Weighted</a></li>
                        <li id="New - old" class="reviewTab"><a href="javascript:void(0);" id="like_time_new">New - old</a></li>
                        <li id="Old - New" class="reviewTab"><a href="javascript:void(0);" id="like_time_old" >Old - New</a></li>
                    </ul>
                </div>
            </div>
            <script>
                $(document).ready(function () {
                    var text = 'Most Helpfull Weighted';
                    var like = 1;
                    getreviewhelp(like, text);
                    var reviewTabs;
                    var reviewTabValue = 'Most Helpfull Weighted';
                    $('#reviewfreshVal').text("Most Helpfull Weighted");
                    $('#review-filter').html();
                    $('.reviewTab').each(function () { 
                        var subids = $(this).children().attr('id');
                        var subclass = $('#' + subids).attr('class');
                        if (subclass == "active") {
                            reviewTabs = subids;
                            reviewTabValue = $('#' + subids).parent().attr('id');

                        }
                        $('#' + subids).bind('click', function () { 
                            $('#' + reviewTabs).removeClass('active');
                            $('#' + reviewTabs).parent().removeClass('active');
                            $(this).addClass('active');
                            $(this).parent().addClass('active');
                            reviewTabs = subids;
                            reviewTabValue = $('#' + subids).parent().attr('id');
                            $('#reviewfreshVal').text($(this).text());
                            var text = reviewTabValue;
                            if (reviewTabs == "like_1") {
                                var like = 1;
                                getreviewhelp(like, text);
                            } else if (reviewTabs == "like_0") {
                                var like = 0;
                                getreviewhelp(like, text);
                            }
                            else if (reviewTabs == "like_time_new") {
                                var time = 'desc';
                                getreviewtime(time, text);
                            }
                            else if (reviewTabs == "like_time_old") {
                                var time = 'asc';
                                getreviewtime(time, text);
                            }
                        });
                    });
                });

                function getreviewhelp(like, text) {
                    var anime_id = $('#anime_name').val();

                    $.ajax({
                        type: 'POST',
                        url: base_url + 'public/animelist/getreview_help',
                        data: {like: like, anime_id: anime_id, text: text},
                        dataType: 'html',
                        beforeSend: function () {
                            $('.filter_loader').show();
                        },
                        success: function (data) {
                            $('.filter_loader').hide();
                            $('#review_filter').html(data);
                        }
                    });
                }
                function getreviewtime(time, text) {
                    var anime_id = $('#anime_name').val();
                    $.ajax({
                        type: 'POST',
                        url: base_url + 'public/animelist/getreview_time',
                        data: {time: time, anime_id: anime_id, text: text},
                        dataType: 'html',
                        beforeSend: function () {
                            $('.filter_loader').show();
                        },
                        success: function (data) {
                            $('.filter_loader').hide();
                            $('#review_filter').html(data);
                        }
                    });
                }
            </script>
            <div class="col-md-6  col-xs-12  most-help-wrapper ">
                <?php if (isset($userid) && !empty($userid)) {
                    ?>
                <a class="btn btn-red pull-right" href="#posting-review" aria-controls="background" role="tab" data-toggle="tab" onclick="postReview();">
                        <?php
                    } else {
                        ?>
                        <a data-toggle="modal" data-target="#login" class="btn btn-red pull-right"> 
                        <?php } ?>
                        <i class="fa fa-pencil-square-o"></i>
                        <span>Post Review</span>
                    </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 mar-t-30">
        <div class="panel panel-default pad-10">
            <div class="histo-title">
                Rating Chart
            </div>

            <div class="histogram">
                <ul class="community-rating-wrapper">
                    <?php
                    $rate = 0;
                    if (isset($first->overall)) {
                        $rate = count(explode(",", $first->overall));
                        ?>
                        <li title="<?php echo $rate; ?> users rated 0.5" data-tooltip="<?php echo $rate; ?> users rated 0.5">
                            <?php
                        } else {
                            ?>
                        <li title="<?php echo $rate; ?> users rated 0.5" data-tooltip="<?php echo $rate; ?> users rated 0.5">
                            <?php
                        }
                        ?>
                        <div class="rating-column">
                            <div class="rating-value" style="height: 0.5499541704857929%;"></div>
                        </div>
                    </li>


                    <?php
                    $rate = 0;
                    if (isset($second->overall)) {
                        $rate = count(explode(",", $second->overall));
                        ?>
                        <li title="<?php echo $rate; ?>  users rated 1" data-tooltip="<?php echo $rate; ?> users rated 1">
                            <?php
                        } else {
                            ?>
                        <li title="<?php echo $rate; ?>  users rated 1" data-tooltip="<?php echo $rate; ?> users rated 1">
                            <?php
                        }
                        ?>
                        <div class="rating-column">
                            <div class="rating-value" style="height: 2.3258478460128322%;"></div>
                        </div>
                    </li>


                    <?php
                    $rate = 0;
                    if (isset($third->overall)) {
                        $rate = count(explode(",", $third->overall));
                        ?>
                        <li title="<?php echo $rate; ?> rated 1.5" data-tooltip="<?php echo $rate; ?> users rated 1.5">
                            <?php
                        } else {
                            ?>
                        <li title="<?php echo $rate; ?>  rated 1.5" data-tooltip="<?php echo $rate; ?> users rated 1.5">
                            <?php
                        }
                        ?>
                        <div class="rating-column">
                            <div class="rating-value" style="height: 1.4780018331805682%;"></div>
                        </div>
                    </li>

                    <?php
                    $rate = 0;
                    if (isset($fourth->overall)) {
                        $rate = count(explode(",", $fourth->overall));
                        ?>
                        <li title="<?php echo $rate; ?> users rated 2" data-tooltip="<?php echo $rate; ?> users rated 2">
                            <?php
                        } else {
                            ?>
                        <li title="<?php echo $rate; ?> users rated 2" data-tooltip="<?php echo $rate; ?> users rated 2">
                            <?php
                        }
                        ?>

                        <div class="rating-column">
                            <div class="rating-value" style="height: 0.6301558203483043%;"></div>
                        </div>
                    </li>


                    <?php
                    $rate = 0;
                    if (isset($fifth->overall)) {
                        $rate = count(explode(",", $fifth->overall));
                        ?>
                        <li title="<?php echo $rate; ?>  users rated 2.5" data-tooltip="<?php echo $rate; ?> users rated 2.5">
                            <?php
                        } else {
                            ?>
                        <li title="<?php echo $rate; ?> users rated 2.5" data-tooltip="<?php echo $rate; ?> users rated 2.5">
                            <?php
                        }
                        ?>
                        <div class="rating-column">
                            <div class="rating-value" style="height: 1.500916590284143%;"></div>
                        </div>
                    </li>


                    <?php
                    $rate = 0;
                    if (isset($sixth->overall)) {
                        $rate = count(explode(",", $sixth->overall));
                        ?>
                        <li title="<?php echo $rate; ?>  users rated 3" data-tooltip="<?php echo $rate; ?>  users rated 3">
                            <?php
                        } else {
                            ?>
                        <li title="<?php echo $rate; ?> users rated 3" data-tooltip="<?php echo $rate; ?>  users rated 3">
                            <?php
                        }
                        ?> 
                        <div class="rating-column">
                            <div class="rating-value" style="height: 9.360678276810265%;"></div>
                        </div>
                    </li>


                    <?php
                    $rate = 0;
                    if (isset($seventh->overall)) {
                        $rate = count(explode(",", $seventh->overall));
                        ?>
                        <li title="<?php echo $rate; ?> users rated 3.5" data-tooltip="<?php echo $rate; ?> users rated 3.5">
                            <?php
                        } else {
                            ?>
                        <li title="<?php echo $rate; ?> users rated 3.5" data-tooltip="<?php echo $rate; ?> users rated 3.5">
                            <?php
                        }
                        ?>
                        <div class="rating-column">
                            <div class="rating-value" style="height: 14.608157653528872%;"></div>
                        </div>
                    </li>

                    <?php
                    $rate = 0;
                    if (isset($eighth->overall)) {
                        $rate = count(explode(",", $eighth->overall));
                        ?>
                        <li title="<?php echo $rate; ?> users rated 4" data-tooltip="<?php echo $rate; ?> users rated 4">
                            <?php
                        } else {
                            ?>
                        <li title="<?php echo $rate; ?>  users rated 4" data-tooltip="<?php echo $rate; ?> users rated 4">
                            <?php
                        }
                        ?>

                        <div class="rating-column">
                            <div class="rating-value" style="height: 19.867094408799268%;"></div>
                        </div>
                    </li>

                    <?php
                    $rate = 0;
                    if (isset($ninth->overall)) {
                        $rate = count(explode(",", $ninth->overall));
                        ?>
                        <li title="<?php echo $rate; ?>  users rated 4.5" data-tooltip="<?php echo $rate; ?> users rated 4.5">
                            <?php
                        } else {
                            ?>
                        <li title="<?php echo $rate; ?>  users rated 4.5" data-tooltip="<?php echo $rate; ?> users rated 4.5">
                            <?php
                        }
                        ?>
                        <div class="rating-column">
                            <div class="rating-value" style="height: 25.52703941338222%;"></div>
                        </div>
                    </li>


                    <?php
                    $rate = 0;
                    if (isset($tenth->overall)) {
                        $rate = count(explode(",", $tenth->overall));
                        ?>
                        <li title="<?php echo $rate; ?> users rated 5" data-tooltip="<?php echo $rate; ?> users rated 5">
                            <?php
                        } else {
                            ?>
                        <li title="<?php echo $rate; ?> users rated 5" data-tooltip="<?php echo $rate; ?> users rated 5">
                            <?php
                        }
                        ?>

                        <div class="rating-column">
                            <div class="rating-value" style="height: 100%;"></div>
                        </div>
                    </li>
                </ul>
                <div class="rating-legend">
                    <span class="lowest-rating">
                        <i class="fa fa-star-half-o"></i>
                        <i class="fa fa-long-arrow-right"></i>
                    </span>
                    <span class="highest-rating">
                        <i class="fa fa-long-arrow-left"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </span>
                </div>
                <div class="score-title">
                    <span>Leaguememe User’s Scored <?php echo $anime_detail->anime_name; ?> :</span>
                    <div class="score">
                        <span class="highest-rating">
                            <?php
                            if (isset($anime_oerallrate)) {

                                for ($i = 0; $i < $anime_oerallrate; $i++) {
                                    echo ' <i class="fa fa-star"></i>';
                                }
                                echo '<i class="fa fa-star-o"></i>&nbsp;';
                                echo $anime_oerallrate;
                            } else {
                                echo "0";
                            }
                            ?>
                        </span>
                        <span class="score-review">out of <?php
                            if (isset($user_review)) {
                                echo $user_review;
                            } else {
                                echo "0";
                            }
                            ?> reviews</span>
                    </div>
                </div>
            </div>
            <!-- end histogram-->
        </div>
    </div>

    <div class="col-md-6 mar-t-30" id="review_filter">
        <div class="filter_loader col-md-6 col-xs-12" style="display:none;margin-right: auto;margin-left: auto;" align="center">
            <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif">
        </div>
    </div>

    <div class="col-md-12" id="review_list">
        <div class="review_loader col-md-12 col-xs-12" style="display:none;margin-right: auto;margin-left: auto;" align="center">
            <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif">
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        review_listing();
    });
    function review_listing() {
        var anime_id = $('#anime_name').val();
        $.ajax({
            type: 'POST',
            url: base_url + 'public/animelist/anime_review_list',
            data: {anime_id: anime_id},
            dataType: 'html',
            beforeSend: function () {
                $('.review_loader').show();
            },
            success: function (data) {
                $('.review_loader').hide();
                $('#review_list').html(data);
            }
        });
    }
</script>
<script src="<?php echo base_url(); ?>assets/public/js/anime.js"></script>