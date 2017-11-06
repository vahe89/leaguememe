<?php
echo $this->load->view('template/sidebar_list');
?>
<div class="right-panel-sec" id="anime_switch">
    <?php foreach ($total_review as $value) {
        ?>
        <div class="anime-post">    <span>   <a href="<?php echo base_url(); ?>anime-list-album/<?php echo $value['anime_id']; ?>" ><?php echo $value['anime_name']; ?></a></span></div>
        <div class="media info-avatar avatar-review">

            <div class="media-left">
                <a href="<?php echo base_url(); ?>animemoment_profile/<?php echo $value['user_name'] ?>">
                    <img src="<?php echo base_url(); ?>uploads/users/<?php echo $value['user_image']; ?>" alt="" class="media-object avatar">
                </a>
            </div>

            <div class="media-body">
                <input type="hidden" class="readmore_<?php echo $value['reid']; ?>" value="<?php echo $value['userid']; ?>"

                       <h5 class="username-review">
                    <a href="<?php echo base_url(); ?>animemoment_profile/<?php echo $value['user_name']; ?>"><?php
                        if (empty($value['name'])) {
                            echo $value['user_name'];
                        } else {
                            echo $value['name'];
                        }
                        ?></a></h5>
                <span class="date-review">
                    <?php
                    $data = $value['review_timestamp'];
                    echo date("M dS,Y", strtotime($data));
                    ?>

                </span>

                <div class="col-md-12 no-padding mar-res" >
                    <span class="minute" data-livestamp="<?php echo strtotime($value['review_timestamp']); ?>"><?php echo strtotime($value['review_timestamp']); ?></span>
                    <span class="minute"> <a href="<?php echo base_url(); ?>anime-list-album/<?php echo $value['anime_id']; ?>" class="minute">/a/<?php echo $value['anime_name']; ?></a></span>
                </div>

                <div class="tag tag-review">
                    <?php
                    if ($value['spoiler_review'] == "1") {
                        ?>
                        <span class="red-tag">Spoiler</span>
                        <?php
                    }
                    ?>
                </div>
            </div>


            <div class="overall-rating">
                <span>Overall Rating:</span>&nbsp;<?php echo $value['overall_rate'] * 2; ?>
            </div>
        </div>

        <div class="text-review-page mar-t-20">

            <p><?php echo substr($value['review_process'], 0, 300); ?>
                <a href="#read-more" aria-controls="background" role="tab" data-toggle="tab" id ="readmore_<?php echo $value['reid']; ?>" onclick="readmore(this.id)">...read more</a>
            </p>
        </div>

        <div class="footer-info">
            <a href="#"><?php
                if (isset($value['total_review'])) {
                    echo $value['total_review'];
                } else {
                    echo "0";
                }
                ?></a> people found this review helpfull
        </div>

        <hr/>

        <?php
    }
    ?>
</div>
<script>

    function readmore(str) {
        var id = str.split("_");

        var anime_id = id[1];
        var user_review_id = $('.' + str).val();
        $.ajax({
            type: "POST",
            url: base_url + 'public/animelist/anime_readmore_tab',
            data: {anime_id: anime_id, user_review_id: user_review_id, user_review: 'user_review'},
            beforeSend: function () {
                $('.anime_loader').show();
            },
            success: function (msg) {
                $('.anime_loader').hide();
                $('#anime_switch').addClass('col-md-12');
                $('#anime_switch').removeClass('col-md-7');
                $('#anime_ads').hide();
                $('#anime_switch').html(msg);

            }
        });
    }
</script>