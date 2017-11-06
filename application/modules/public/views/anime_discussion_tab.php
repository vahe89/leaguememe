<?php
$model_header = "";
if ($header_type == 1) {
    $model_header = "Discussion";
} else if ($header_type == 2) {
    $model_header = "Manga";
} else if ($header_type == 3) {
    $model_header = "Theory";
}
?>
<script>
    var model_header = '<?php echo $model_header; ?>';
    $('#recent_dis').hide();
</script>
<div class="row">
    <div class="col-md-8">
        <ul id="pop" class="nav pop-tabs" role="tablist" style="margin-top: 10px;">
            <li role="presentation" class="mar-rm-5">
                <a href="#pinned" role="tab" data-toggle="tab" aria-controls="pinned"><i class="fa fa-bookmark" style="margin-top:5px;"></i></a>
            </li>
            <li role="presentation" class="active discussionTab">
                <a href="#popular-discussion" id="popular" role="tab" data-toggle="tab" aria-controls="popular" aria-expanded="true">Popular</a>
            </li>
            <li role="presentation" class="mar-lm-5 discussionTab">
                <a href="#popular-discussion" id="new" role="tab" data-toggle="tab" aria-controls="news">News</a>
            </li>
        </ul>
    </div>
    <div class="col-md-4 col-xs-12 wrap-btn-thread" style="text-align: left;padding-top: 15px;">
        <!--<a href="#" class="btn-thread">-->

        <?php if ($user_id != "") {
            ?>

            <a id="new_thread_model" class="btn-thread" href="#tread_modal">
                <?php
            } else {
                ?>
                <a data-toggle="modal" data-target="#login"  class="btn-thread" href="javascript:void(0)" > 
                    <?php
                }
                ?>
                <i class="fa fa-plus-circle"></i>
                New Thread
            </a>
    </div>
</div>
<input type="hidden" name="header_type" value="<?php echo isset($header_type) ? $header_type : 1; ?>" id="header_type"/>
<input type="hidden" name="header_name" value="<?php echo isset($model_header) ? $model_header : "Discussion"; ?>" id="header_name"/>
<input type="hidden" name="anime_name_details" value="" id="anime_name_details"/>
<div class="tab-content">

    <!-- Pinned -->
    <div role="tabpanel" class="tab-pane" id="pinned">
        <p>
            Bookmark here
        </p>
    </div>

    <!-- popular-->
    <div role="tabpanel" class="tab-pane fade in active" id="popular-discussion">
        <div classs="row">
            <div class="col-md-12" id="discussion_list">



            </div>
            <div class="animation_image" style="display:none;background: #F9FFFF;border: 1px solid #E1FFFF;padding: 10px;width: 500px;margin-right: auto;margin-left: auto;" align="center">
                <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif">
            </div>
            <!--end col-md-12-->
        </div>
    </div>

    <!-- news -->
    <div role="tabpanel" class="tab-pane" id="aaa">
        <p>
            News
        </p>
    </div>

</div>
<script>
    $(document).ready(function () {
        $('#anime_name_details').val($('#anime_id').val());

        var mainTab = "popular";

        discussion_list(mainTab);

        $('.discussionTab').each(function () {
            var data = $(this).children().attr('id');
            $('#' + data).click(function () {
                mainTab = $(this).attr('id');
                discussion_list(mainTab);
            });
        });
        $("#new_thread_model").leanModal({
            top: 200,
            overlay: 0.6,
            closeButton: ".modal_close"
        });

        $(document).on('click', '#new_thread_model', function () {
            $(".discuss-upload1").hide();
            $(".upload").show();

            setTimeout(function () {
                var html_header = "Upload " + model_header + " Post";
                var panel_title = "Choose or drag " + model_header + " file here";
                var sub_title = model_header ;
                $('#tread_model_title').html(html_header);
                $('#panel_tread_title').html(panel_title);
                $('.sec_sub_id').html(sub_title);
            }, 100);
        });
        function discussion_list(mainTab) {
            var anime_name = $('#anime_name').val();
            var header_type = $('#header_type').val();
            $.ajax({
                type: "POST",
                url: base_url + 'public/animelist/discussion_list',
                data: {main: mainTab, anime_name: anime_name, headerType: header_type},
                beforeSend: function () {
                    $('.animation_image').show();
                },
                success: function (msg) {

                    $('.animation_image').hide();
                    $('#discussion_list').html(msg);

                }
            });
        }
    });
</script>


