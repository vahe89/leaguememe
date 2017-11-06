<style>
    .hidden-xs {
        display: none;
    }
     .draggable-container {
        display: none;
    }
    .tab-top,.tab-not-login {
        margin-top:0px;
    }
</style>
<?php
echo $this->load->view('template/sidebar_list');
?>
<div class="right-panel-sec">
    <div class="row">
        <div class="col-md-12 no-padding ">
            <div class="title-section">
                <span>Notification</span>
                <a href="<?php echo base_url(); ?>leaguememe_profile/<?php echo $userdetail['user_name']; ?>" class="btn btn-red btn-back-review">Back</a>
            </div>
        </div>
        <div class="col-md-7 main-content">
            <?php
            echo $list_noti;
            ?>

        </div>

        <div class="col-md-5 col-sm-12 ads-view">
            <?php
            echo $this->load->view('template/right_sidebar');
            ?>
        </div>
        <!--end ads-->
    </div>
</div>
<script>
    function request_approve(str) {
        $.ajax({
            url: '<?php echo site_url(); ?>public/user/request_approve',
            type: 'POST',
            data: {
                'str': str,
            },
            dataType: 'json',
            success: function (data) {
                if (data.status == 'follow') {
                    $('.approve_btn').html('Unfollow <i class="fa fa-close"></i>');
                    var total_follow = parseInt($('#followers_' + str).text()) + 1;
                    $('#followers_' + str).text(total_follow);
                }
                else if (data.status == 'unfollow') {
                    $('.approve_btn').html('Follow <i class="fa fa-check"></i>');
                    var total_follow = parseInt($('#followers_' + str).text()) - 1;
                    $('#followers_' + str).text(total_follow);
                }


            }
        });
    }
</script>