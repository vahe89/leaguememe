<div class="row">
    <div class="anime-post">
        <span>Mirai Nikki (TV)</span>
        <a href="#review-sec" class="btn btn-red btn-back-review" aria-controls="background" role="tab" data-toggle="tab" aria-expanded="true" onclick="review()">Back</a>
    </div>
    <div class="col-md-10">
        <div id="review_alert" style="display: none" class="text-center alert alert-danger no-padding"></div>
        <div class="spoiler-post">
            Contain Spoiler?
            <input type="checkbox" name="option" id="spoiler-review" checked/>
            <label for="spoiler-review">
                <span class="fa-stack">
                    <i class="fa fa-square-o fa-stack-1x"></i>
                    <i class="fa fa-check fa-stack-1x"></i>
                </span>
            </label>
        </div>

        <div class="intro-review-post">
            <div class="title-intro">
                Introduction to your review and thought process
            </div>
            <textarea class="text-intro" id="review_process" placeholder="e.g. ‘A great modernization of an under-appreciate is fast, fourious, and endlessly deep.’"></textarea>
        </div>

        <ul class="list-review-post">
            <li>
                <div class="triger-post">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        <i class="fa fa-plus-circle"></i>
                        <span> Story...</span>
                    </a>
                </div>
                <div  class="story_div">
                    <?php for ($i = 1; $i <= 10; $i++) {
                        ?>
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" href="javascript:void(0);" class="story btn btn-circle" id="story_<?php echo $i; ?>" onclick="getRate(this.id)"><?php echo $i; ?></a>
                        <?php
                    }
                    ?>
                </div>
                <div id="collapseOne" class="panel-collapse collapse">
                    <textarea id="story_review" class="text-acor" placeholder="e.g. ‘A great modernization of an under-appreciate is fast, fourious, and endlessly deep.’"></textarea>
                </div>
            </li>
            <li>
                <div class="triger-post">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        <i class="fa fa-plus-circle"></i>
                        <span> Animation...</span>
                    </a>
                </div>
                <div  class="animation_div">
                    <?php for ($i = 1; $i <= 10; $i++) {
                        ?>
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" href="javascript:void(0);" class="animation btn btn-circle" id="animation_<?php echo $i; ?>" onclick="getRate(this.id)"><?php echo $i; ?></a>
                        <?php
                    }
                    ?>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse in">
                    <textarea  id="animation_review" class="text-acor" placeholder="e.g. ‘A great modernization of an under-appreciate is fast, fourious, and endlessly deep.’"></textarea>
                </div>
            </li>
            <li>
                <div class="triger-post">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        <i class="fa fa-plus-circle"></i>
                        <span> Character...</span>
                    </a>
                </div>
                <div  class="character_div"> 
                    <?php for ($i = 1; $i <= 10; $i++) {
                        ?>
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" href="javascript:void(0);" class="character btn btn-circle" id="character_<?php echo $i; ?>" onclick="getRate(this.id)"><?php echo $i; ?></a>
                        <?php
                    }
                    ?>
                </div>
                <div id="collapseThree" class="panel-collapse collapse">
                    <textarea  id="character_review" class="text-acor" placeholder="e.g. ‘A great modernization of an under-appreciate is fast, fourious, and endlessly deep.’"></textarea>
                </div>
            </li>
            <li>
                <div class="triger-post">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                        <i class="fa fa-plus-circle"></i>
                        <span> Enjoyment...</span>
                    </a>
                </div>
                <div  class="enjoy_div">
                    <?php for ($i = 1; $i <= 10; $i++) {
                        ?>
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" href="javascript:void(0);" class="enjoy btn btn-circle" id="enjoy_<?php echo $i; ?>" onclick="getRate(this.id)"><?php echo $i; ?></a>
                        <?php
                    }
                    ?>
                </div>
                <div id="collapseFour" class="panel-collapse collapse">
                    <textarea  id="enjoy_review" class="text-acor" placeholder="e.g. ‘A great modernization of an under-appreciate is fast, fourious, and endlessly deep.’"></textarea>
                </div>
            </li>
            <li>
                <div class="triger-post">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                        <i class="fa fa-plus-circle"></i>
                        <span> Sound...</span>
                    </a>
                </div>
                <div  class="sound_div">
                    <?php for ($i = 1; $i <= 10; $i++) {
                        ?>
                        <a  data-toggle="collapse" data-parent="#accordion" href="#collapseFive" href="javascript:void(0);" class="sound btn btn-circle" id="sound_<?php echo $i; ?>" onclick="getRate(this.id)"><?php echo $i; ?></a>
                        <?php
                    }
                    ?>
                </div>
                <div id="collapseFive" class="panel-collapse collapse">
                    <textarea class="text-acor" id="sound_review" placeholder="e.g. ‘A great modernization of an under-appreciate is fast, fourious, and endlessly deep.’"></textarea>
                </div>
            </li>
        </ul>

        <div class="intro-review-post">
            <div class="title-intro">
                Recomendation
            </div>
            <textarea class="text-intro" id="recomendation_review" placeholder="e.g. ‘A great modernization of an under-appreciate is fast, fourious, and  endlessly deep.’"></textarea>
        </div>
        <a href="javascript:void(0)" class="btn btn-red submit-post" onclick="postreview()" style="margin-top: 3px;">Submit</a>
        <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif" class="pull-right"  id="review_loader" style="margin-top: 3px;display: none">
        <h6 style="display:none" id="review_text_loader" class="pull-right text-danger pad-r-10"></h6>
    </div>
</div>
<script>
    function postreview() {
        var anime_id = $('#anime_name').val();
        var story_rate = $('.story_div .active').text();
        var animation_rate = $('.animation_div .active').text();
        var character_rate = $('.character_div .active').text();
        var enjoy_rate = $('.enjoy_div .active').text();
        var sound_rate = $('.sound_div .active').text();
        if ($("#spoiler-review").is(':checked')) {
            var spoiler_review = 1;
        }
        else {
            var spoiler_review = 0;
        }
        var review_process = $("#review_process").val();
        var story_review = $("#story_review").val();
        var animation_review = $("#animation_review").val();
        var character_review = $("#character_review").val();
        var enjoy_review = $("#enjoy_review").val();
        var sound_review = $("#sound_review").val();
        var recomendation_review = $("#recomendation_review").val();

        $.ajax({
            type: "POST",
            url: base_url + 'public/animelist/post_review',
            dataType: 'json',
            data: {
                anime_id: anime_id,
                spoiler_review: spoiler_review,
                review_process: review_process,
                story_review: story_review,
                animation_review: animation_review,
                character_review: character_review,
                enjoy_review: enjoy_review,
                sound_review: sound_review,
                recomendation_review: recomendation_review,
                story_rate: story_rate,
                animation_rate: animation_rate,
                character_rate: character_rate,
                enjoy_rate: enjoy_rate,
                sound_rate: sound_rate
            },
            beforeSend: function () {
                $('#review_loader').show();
            },
            success: function (data) {
                if (data.result == "success") {
                    review();
                }
                else if (data.result == "error") {
                    $('#review_loader').hide();
                    $("#review_text_loader").show();
                    $('#review_text_loader').text("Error Detail Show Above");
                    $("#review_alert").show('slow');
                    $("#review_alert").html('<strong>' + data.msg + '</strong>');
                }

            }
        });
    }
    function getRate(str) {
        var id = str.split('_');
        $('.' + id[0]).removeClass('active');
        $('#' + str).addClass('active');
    }
</script>