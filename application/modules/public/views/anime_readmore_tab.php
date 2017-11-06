<div class="row">
    <div class="anime-post">

        <span>Mirai Nikki (TV)</span>
        <?php
        if ($review_status === 'user_review') {
            ?>
            <a href="<?php echo base_url(); ?>review-list/<?php echo $review_detail->user_id ?>" class="btn btn-red btn-back-review">Back</a>
            <?php
        } else {
            ?>
            <a href="#review-sec" class="btn btn-red btn-back-review" aria-controls="background" role="tab" data-toggle="tab" aria-expanded="true" onclick="review()">Back</a>
            <?php
        }
        ?>

    </div>
    <div class="col-md-12">
        <div class="media info-avatar avatar-view">
            <div class="media-left">
                <a href="<?php echo base_url(); ?>animemoment_profile/<?php echo $review_detail->user_name ?>">
                    <img src="<?php echo base_url(); ?>uploads/users/<?php echo $review_detail->user_image; ?>" alt="" class="media-object avatar">
                </a>
            </div>
            <div class="media-body">
                <a href="<?php echo base_url(); ?>animemoment_profile/<?php echo $review_detail->user_name ?>">
                    <h5><?php echo empty($review_detail->name) ? $review_detail->user_name : $review_detail->name; ?></h5>
                </a>

                <span class="minute" data-livestamp="<?php echo strtotime($review_detail->review_timestamp); ?>"></span>
                <span class="minute"> <a href="<?php echo base_url(); ?>anime-list-album/<?php echo $review_detail->anime_id; ?>" class="minute">/a/<?php echo $review_detail->anime_name; ?></a></span>

                <div class="tag tag-read-more">
                    <?php
                    if ($review_detail->spoiler_review == "1") {
                        ?>
                        <span class="red-tag">Spoiler</span>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
        <div class="media info-avatar info-like">
            <div class="btn-like">
                <?php
                if (isset($user_id) && !empty($user_id)) {
                    if (!empty($review_like_check) && $review_like_check['user_id'] == $user_id && $review_like_check['like'] == 1 && $review_like_check['review_id'] == $review_detail->id) {
                        ?>
                        <a class="btn btn-gray" id="reviewlike_<?php echo $review_detail->id; ?>" onclick="reviewLike(this.id)" style=' font-size: 14px; width: 174px; padding: 8px 12px;'>Liked!</a>
                    <?php } else { ?>
                        <a class="btn btn-red" id="reviewlike_<?php echo $review_detail->id; ?>" onclick="reviewLike(this.id)" style=' font-size: 14px; width: 174px; padding: 8px 12px;margin-left: 0'>Like this review</a>
                        <?php
                    }
                } else {
                    ?>
                    <a class="btn btn-red" data-toggle="modal" data-target="#login" style=' font-size: 14px; width: 174px; padding: 8px 12px;'>Like this review</a>
                <?php } ?>

                <?php
                if (isset($user_id) && !empty($user_id)) {
                    if (!empty($review_like_check) && $review_like_check['user_id'] == $user_id && $review_like_check['like'] == 0 && $review_like_check['review_id'] == $review_detail->id) {
                        ?>
                        <a class="btn btn-red" id="reviewdislike_<?php echo $review_detail->id; ?>" onclick="reviewDislike(this.id)"  style="margin-left:10px;padding: 11px 21px;" ><i class="fa fa-thumbs-down"></i></a>
                    <?php } else { ?>
                        <a class="btn btn-gray" id="reviewdislike_<?php echo $review_detail->id; ?>" onclick="reviewDislike(this.id)" style="padding: 8px 21px;"><i class="fa fa-thumbs-down"></i></a>
                        <?php
                    }
                } else {
                    ?>
                    <a class="btn btn-gray" data-toggle="modal" data-target="#login" style="padding: 8px 21px;"><i class="fa fa-thumbs-down"></i></a>
                <?php } ?>

            </div>
            <script>
                function reviewLike(str) {
                    var id = str.split("_");
                    var review_id = id[1];
                    $.ajax({
                        type: 'POST',
                        url: base_url + 'public/animelist/review_like',
                        dataType: 'json',
                        data: {review_id: review_id},
                        success: function(data) {
                            if (data.status === "false") {
                                var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
                                $('#body_id').append(html);
                                $('#login').addClass('in');
                                $('#login').show();
                            } else if (data.status === "insert") {
                                $('#reviewdislike_' + review_id).addClass('btn-gray');
                                $('#reviewdislike_' + review_id).css('padding', '8px 21px');
                                $('#reviewdislike_' + review_id).removeClass('btn-red');
                                $('#reviewlike_' + review_id).addClass('btn-gray');
                                $('#reviewlike_' + review_id).removeClass('btn-red');
                                $('#' + str).css('margin-left', '0px');
                                $('#' + str).text('Liked!');
                                $('#positive_votes').html(data.positive_votes);
                                $('#total_votes').html(data.total_votes);
                            } else if (data.status === "update") {
                                $('#reviewdislike_' + review_id).addClass('btn-gray');
                                $('#reviewdislike_' + review_id).css('padding', '8px 21px');
                                $('#reviewdislike_' + review_id).removeClass('btn-red');
                                $('#reviewlike_' + review_id).addClass('btn-gray');
                                $('#reviewlike_' + review_id).removeClass('btn-red');
                                $('#' + str).css('margin-left', '0px');
                                $('#' + str).text('Liked!');
                                $('#positive_votes').html(data.positive_votes);
                                $('#total_votes').html(data.total_votes);
                            }
                            else if (data.status === "delete") {
                                $('#reviewlike_' + review_id).addClass('btn-red');
                                $('#reviewdislike_' + review_id).addClass('btn-gray');
                                $('#reviewdislike_' + review_id).css('padding', '8px 21px');
                                $('#reviewdislike_' + review_id).removeClass('btn-red');
                                $('#' + str).text('Like this review');
                                $('#positive_votes').html(data.positive_votes);
                                $('#total_votes').html(data.total_votes);
                            }
                        }
                    });
                }

                function reviewDislike(str) {
                    var id = str.split("_");
                    var review_id = id[1];
                    $.ajax({
                        type: 'POST',
                        url: base_url + 'public/animelist/review_dislike',
                        dataType: 'json',
                        data: {review_id: review_id},
                        success: function(data) {
                            if (data.status === "false") {
                                var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
                                $('#body_id').append(html);
                                $('#login').addClass('in');
                                $('#login').show();
                            } else if (data.status === "insert") {
                                $('#reviewdislike_' + review_id).addClass('btn-red');
                                $('#reviewlike_' + review_id).addClass('btn-gray');
                                $('#reviewlike_' + review_id).removeClass('btn-red');
                                $('#reviewlike_' + review_id).text('Like this review');
                                $('#positive_votes').html(data.positive_votes);
                                $('#total_votes').html(data.total_votes);
                            } else if (data.status === "update") {
                                $('#reviewdislike_' + review_id).addClass('btn-red');
                                $('#reviewlike_' + review_id).removeClass('btn-red');
                                $('#reviewlike_' + review_id).addClass('btn-gray');
                                $('#reviewlike_' + review_id).text('Like this review');
                                $('#positive_votes').html(data.positive_votes);
                                $('#total_votes').html(data.total_votes);
                            } else if (data.status === "delete") {
                                $('#reviewdislike_' + review_id).removeClass('btn-red');
                                $('#reviewdislike_' + review_id).addClass('btn-gray');
                                $('#reviewlike_' + review_id).removeClass('btn-gray');
                                $('#reviewlike_' + review_id).addClass('btn-red');
                                $('#reviewdislike_' + review_id).css('padding', '8px 21px');
                                $('#positive_votes').html(data.positive_votes);
                                $('#total_votes').html(data.total_votes);
                            }
                        }
                    });
                }
            </script>
            <div class="caption-like">
                <span> <span id="positive_votes"><?php echo $positive_vote; ?></span> out of <span id="total_votes"><?php echo $total_vote; ?></span> users found this review helpful.</span>
            </div>
        </div>
    </div>

    <div class="col-md-12 review-sec">
        <!--- review fill --->
        <div class="title-review">
            <?php echo $review_detail->anime_name; ?> Review
        </div>
        <div class="date-review">
            <?php
            $data = $review_detail->review_timestamp;
            echo date("M dS,Y", strtotime($data));
            ?>
        </div>
        <div class="col-md-12 subtitle-review">
            I’m going to try keep this as short as I can
        </div>
        <div class="overall-rating">
            <span>Overall Rating:</span>&nbsp;<?php echo $review_detail->overall_rate * 2; ?>
        </div>
        <div class="review-text" style="width:100%">
            <p>
                <?php echo $review_detail->review_process; ?>
            </p>
            <div class="col-md-12 no-padding mar-b-10">
                <div class="col-md-6 no-padding">
                    <div class="review-story">
                        <a href="#collapse1" data-toggle="collapse" data-parent="#accordion">
                            <img src="<?php echo base_url(); ?>assets/public/img/plus-circle-o.png">
                            <span>Story</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 no-padding pull-right">
                    <div class="tag tag-green-more">
                        <span class="green-tag">Story: <?php echo number_format(($review_detail->story_rate) / 2, 1); ?></span>
                    </div>
                </div>
                <div id="collapse1" class="panel-collapse accor-readmore collapse">
                    <div class="panel-body review-spec">
                        <?php echo $review_detail->story_review; ?> 
                    </div>
                </div>
            </div>
            <div class="col-md-12 no-padding mar-b-10">
                <div class="col-md-6 no-padding">
                    <div class="review-story">
                        <a href="#collapse2" data-toggle="collapse" data-parent="#accordion">
                            <img src="<?php echo base_url(); ?>assets/public/img/plus-circle-o.png">
                            <span>Animation</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 no-padding pull-right">
                    <div class="tag tag-green-more">
                        <span class="green-tag">Animation: <?php echo number_format(($review_detail->animation_rate) / 2, 1); ?></span>
                    </div>
                </div>
                <div id="collapse2" class="panel-collapse accor-readmore collapse">
                    <div class="panel-body review-spec">
                        <?php echo $review_detail->animation_review; ?> 
                    </div>
                </div>
            </div>
            <div class="col-md-12 no-padding mar-b-10">
                <div class="col-md-6 no-padding">
                    <div class="review-story">
                        <a href="#collapse3" data-toggle="collapse" data-parent="#accordion">
                            <img src="<?php echo base_url(); ?>assets/public/img/plus-circle-o.png">
                            <span>Sound</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 no-padding pull-right">
                    <div class="tag tag-green-more">
                        <span class="green-tag">Music/Sound: <?php echo number_format(($review_detail->sound_rate) / 2, 1); ?></span>
                    </div>
                </div>
                <div id="collapse3" class="panel-collapse accor-readmore collapse">
                    <div class="panel-body review-spec">
                        <?php echo $review_detail->sound_review; ?> 
                    </div>
                </div>
            </div>
            <div class="col-md-12 no-padding mar-b-10">
                <div class="col-md-6 no-padding">
                    <div class="review-story">
                        <a href="#collapse4" data-toggle="collapse" data-parent="#accordion">
                            <img src="<?php echo base_url(); ?>assets/public/img/plus-circle-o.png">
                            <span>Character</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 no-padding pull-right">
                    <div class="tag tag-green-more">
                        <span class="green-tag">Character: <?php echo number_format(($review_detail->character_rate) / 2, 1); ?></span>
                    </div>
                </div>
                <div id="collapse4" class="panel-collapse accor-readmore collapse">
                    <div class="panel-body review-spec">
                        <?php echo $review_detail->character_review; ?> 
                    </div>
                </div>
            </div>
            <div class="col-md-12 no-padding mar-b-10">
                <div class="col-md-6 no-padding">
                    <div class="review-story">
                        <a href="#collapse5" data-toggle="collapse" data-parent="#accordion">
                            <img src="<?php echo base_url(); ?>assets/public/img/plus-circle-o.png">
                            <span>Enjoyment</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 no-padding pull-right">
                    <div class="tag tag-green-more">
                        <span class="green-tag">Enjoyment: <?php echo number_format(($review_detail->enjoy_rate) / 2, 1); ?></span>
                    </div>
                </div>
                <div id="collapse5" class="panel-collapse accor-readmore collapse">
                    <div class="panel-body review-spec">
                        <?php echo $review_detail->enjoy_review; ?> 
                    </div>
                </div>
            </div>

            <p class="last-page">
                <?php echo $review_detail->recomendation_review; ?>
            </p>
        </div>
    </div>
    <!--- end review fill --->
    <div class="col-md-12 mar-t-40">
        <div class="slider">
            <div class="caption-slider">
                <span>More reviews from <?php echo $review_detail->name == " " ? $review_detail->user_name : $review_detail->name; ?></span>
            </div>
            <hr />
            <div id="owl-review2" class="owl-carousel owl-theme">

                <?php foreach ($anime_list as $anime) {
                    ?>
                    <div class="image-carousel">
                        <a class="item-carousel" href="<?php echo base_url(); ?>anime-list-album/<?php echo $anime['anime_id']; ?>">
                            <img src="<?php echo base_url(); ?>uploads/anime/<?php echo $anime['anime_jpg']; ?>" alt="cover">
                            <div class="title-image-carousel">
                                <div class="limit-carousel"><?php echo $anime['anime_name']; ?></div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
            <!-- owl carousel-->
            <hr />
        </div>
        <!--slider -->
    </div>
    <!--col-md-12 slider-->

    <div class="col-md-12">
        <div class="text-comment">
            <div class="wrap-avatar-comment">
                <?php
                if (isset($userdetail['user_image'])) {
                    ?>
                    <a href="#">
                        <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>uploads/users/<?php echo $userdetail['user_image']; ?>" alt="">
                    </a>
                    <?php
                } else {
                    ?>
                    <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>assets/public/img/luffy.png" alt="profile pic">
                    <?php
                }
                ?>

            </div>

            <div class="input-text-comment">
                <?php if (isset($userdetail['user_id'])) { ?>
                    <input type="hidden" id="review_commentid" value="<?php echo $review_detail->id; ?>">
                    <div class="show-upload" style="display: none">
                        <input type="file"  name="userfile" size="20" id="animeReview_click" onchange="readURL(this)"/>
                    </div>

                    <div class="preview_image" style="display: none">
                        <div id="rem_1">
                            <img id="show" src="" alt="" width="120px;" height="120px;" style="margin-bottom: 5px; margin-top: 5px;" />
                            <i class="fa fa-remove remove" href="javascript:void(0);" style="margin-top: -72px; margin-right: 0px; margin-left: -4px; color: red; cursor: pointer; cursor: hand;"></i>
                        </div>
                    </div>


                    <textarea class="form-control form-comment textarea-box" id="addReviewCommentBox<?php echo $review_detail->id; ?>" name="commentss" rows="3" placeholder="What's on your mind"></textarea>

                    <div class="post-comment">

                        <div class="added-image"></div>

                        <div class="another-post">
                            <a href="#" class="photo"> 
                                <i class="fa fa-picture-o image_upload"></i> 
                            </a> 
                            <button type="submit" class="btn pull-right small-btn green-bg comment-btn" onclick="postcommentReview();">
                                Comment
                            </button>
                        </div>
                    </div>

                    <span id="wordcount<?php echo $review_detail->id; ?>" class="value-box wordcount">1000</span>
                <?php } else { ?>
                    <textarea class="form-control form-comment textarea-box" rows="3" placeholder="What's on your mind"></textarea>
                    <div class="post-comment">

                        <div class="added-image"></div>

                        <div class="another-post">
                            <a href="#" class="photo"> 
                                <i class="fa fa-picture-o image_upload"></i> 
                            </a> 
                            <button data-toggle="modal" data-target="#login" class="btn pull-right small-btn green-bg comment-btn discommentPostBtn"  >
                                Comment
                            </button>
                        </div>
                    </div>

                    <span class="value-box wordcount">1000</span>
                <?php } ?>
            </div>
        </div>
        <div class="animation_image" style="display: none;margin-right: auto;margin-left: auto;" align="center"><img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif" class="img-responsive" style="width:40px"></div>
        <div id ="reviewcmt_<?php echo $review_detail->id; ?>">
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        $(".image_upload").click(function(e) {
            e.preventDefault();
            $('#make_click').click();

        });
    });

</script>
<script>
    $(document).ready(function() {
        $(".image_upload").click(function(e) {
            e.preventDefault();
            $('#animeReview_click').click();

        });
    });

</script>

<script>
    function readURL(input) {
        abc = '';
        if (input.files && input.files[0]) {

            abc += 1;

            var reader = new FileReader();

            $('.added-image').html("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src='' width='120px;' height='120px;' style='margin-bottom: 8px; margin-top: 8px; margin-left: 8px; display: inline;'/></div>");

            reader.onload = imageIsLoaded;
            reader.readAsDataURL(input.files[0]);
            $("#abcd" + abc).append($('<i class="fa fa-remove remove" style="margin-top: -75px; margin-right: 0px; margin-left: -2px; color: red; cursor: pointer; cursor: hand;"></i>').click(function() {
                $("#abcd" + abc).remove();
                $("#previewimg" + abc).val("");
                $('#animeReview_click').val("");
            })
                    );
        }
    }

    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    }
    ;


    $('.textarea-box').focus(function() {
        $(this).addClass('resize');
        $(this).next().addClass('display-post-comment');
        $(this).next().next().addClass('value-box-click');
    });

    $(document).click(function(event) {
        if ($(event.target).closest('.input-text-comment').length == 0) {
            $('.textarea-box').removeClass('resize');
            $('.textarea-box').next().removeClass('display-post-comment');
            $('.textarea-box').next().next().removeClass('value-box-click');
        }
    });
</script>
<script>
    var anime_single_id = "<?php echo $review_detail->id; ?>";

    $('.textarea-box').focus(function() {

        $(this).addClass('resize');
        $(this).next().addClass('display-post-comment');
        $(this).next().next().addClass('value-box-click');
    });

    $(document).click(function(event) {
        if ($(event.target).closest('.input-text-comment').length == 0) {
            $('.textarea-box').removeClass('resize');
            $('.textarea-box').next().removeClass('display-post-comment');
            $('.textarea-box').next().next().removeClass('value-box-click');
        }
    });
</script>
<script src="<?php echo base_url(); ?>assets/public/js/anime_readmore.js"></script>
<script src="<?php echo base_url(); ?>assets/public/js/anime.js"></script>


<script src="<?php echo base_url(); ?>assets/public/js/owl.carousel.js"></script>
<script src="<?php echo base_url(); ?>assets/public/js/owl-trigger.js"></script>