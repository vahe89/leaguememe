<style>
    div.background-cover {
        display: none;
    }
</style>

<section id="single_post" style="background-color:#eee;">
    <div id="eventClick" class="container no-padding">
        <div class="single-panel" style="margin-top: 90px;">
            <div class="col-md-8 col-xs-12 col-sm-8 no-padding">

                <?php if ($required_login) { ?>
                    <div style="padding: 50px">
                        <form action="#" id="event-access-form" method="POST"  >
                            <p>Please provide a event password to view the information about the event. If you don't have please ask to admin of this event.</p>
                            Password
                            <div class="panel panel-default mar-b-40">
                                <div class="panel-body-discuss panel-body">
                                    <input type="password" name="pwd" class="title-discuss-input" placeholder="Event password" />
                                </div>
                            </div><div class="col-md-12 wrap-btn-step no-padding">
                                <input type="hidden" name="ei" value="<?= $event_info->id ?>" />
                                <input type="submit" class="btn btn-red pull-left" id="btn-create-event" value="Authenticate" />
                            </div>
                        </form>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="col-md-12 wraper-discuss-click">
                        <div class="title-event-detail">
                            <?= $event_info->title ?>
                            <span class="event-date">
                                Event ends: <?= date("F jS, Y", $event_info->end_date) ?> 
                            </span>
                        </div>
                        <div class="field-discuss">
                            <p>
                                <?= $event_info->descr ?>
                            </p>
                        </div>
                        <?php
                        if ($userdetail !== false) {
                            ?>
                            <div class="banner visible-xs">
                                <div class="btn btn-select-winner">
                                    Entry Number : <span id="entry_number"></span>
                                </div>
                                <div style="display: none" class="btn btn-select-winner btn-claim-winner" id="btn-win">
                                    Select Winner
                                </div> 

                                <div class="winner-box" id="winner-box"> </div>
                            </div>
                        <?php } ?>
                        <div class="outer-member-event">
                            <!-- Column 1 -->
                            <div class="col-md-13 col-xs-12 no-padding">
                                <?php
                                $winner = false;
                                $adminId = false;
                                $entryNumber = false;
                                foreach ($event_users as $key => $eu) {

                                    if ($eu->user_id == $userdetail['user_id'])
                                        $entryNumber = "ENT" . $eu->id;


                                    if ($eu->is_winner)
                                        $winner = $eu;
                                    if ($eu->is_admin == 1) {
                                        $adminId = $eu->user_id;
                                    }
                                    if ($entryNumber)
                                        echo "<script>document.getElementById('entry_number').innerHTML = 'ENT" . $eu->id . "'; </script>";
                                    ?>

                                    <div class="media info-avatar">
                                        <div class="media-left media-comment">
                                            <a href="<?= base_url("leaguememe_profile/" . $eu->user_name) ?>">
                                                <?php if (!empty($eu->user_image)) {
                                                    ?>
                                                <img alt="<?= $eu->user_name ?>" src="<?= base_url("uploads/users/" . $eu->user_image) ?>" class="media-object avatar img-circle">
                                                <?php 
                                                } else{
                                                    ?>
                                                <img alt="<?= $eu->user_name ?>" src="<?= base_url("assets/public/img/default_profile.jpeg") ?>" class="media-object avatar img-circle">
                                                <?php
                                                } ?>
                                            </a>
                                        </div>

                                        <div class="media-body w-100">
                                            <a href="<?= base_url("leaguememe_profile/" . $eu->user_name) ?>"><h5 class="user"><?= empty($eu->name) ? $eu->user_name : $eu->name ?></h5></a>
                                            <div class="date">Entry :  ENT<?= $eu->id ?></div>
                                            <span class="minute" style="display: inline;" data-livestamp="<?= $eu->created ?>"></span>   

                                        </div>
                                    </div>
                                    <?php
                                }
                                $winnerHtml = "";
                                if ($winner !== false) {
                                    $winnerHtml = "<div class='title-recent-discuss'> Winner </div> <div class='box-recent-discuss'> <div class='media info-avatar info-avatar-discuss'> <div class='media-left media-left-discuss'> <a href='" . base_url("leaguememe_profile/" . $winner->user_name) . "'> <img alt='' src='" . base_url("uploads/users/" . $winner->user_image) . "' class='media-object avatar avatar-discuss'> </a> </div> <div class='media-body w-2000'> <a href='" . base_url("leaguememe_profile/" . $winner->user_name) . "'><h5>";
                                    if (empty($winner->name)) {
                                        $winnerHtml .= $winner->user_name;
                                    } else {
                                        $winnerHtml .= $winner->name;
                                    } $winnerHtml.= "</h5></a> <span class='minute by-username'>Entry : ENT" . $winner->id . "</span> <span class='profile-username'>click to claim 24hrs</span> </div> </div> </div> ";
                                    echo '<script>document.getElementById("winner-box").innerHTML = "' . $winnerHtml . '";</script>';
                                }
                                ?>
                                <!-- AVATAR 1 -->

                            </div>
                        </div>
                    </div>
	<div class="col-md-12"><ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-9746555787553362"
     data-ad-slot="1317445683"></ins></div>
                    <!-- wraper-view -->
                    <div class="tab-comment">
                        <ul id="pop" class="nav pop-tabs pop-view" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#popular" role="tab" data-toggle="tab" aria-controls="popular" aria-expanded="true">Popular</a>
                            </li>
                            <li role="presentation" class="mar-lm-5">
                                <a href="#news" role="tab" data-toggle="tab" aria-controls="news" id="fresh1">News</a>
                            </li>
                            <li role="presentation" class="mar-lm-5">
                                <a href="#old" role="tab" data-toggle="tab" aria-controls="old">Old</a>
                            </li>
                            <li style="float:right;">
                                <div class="comment-status" id="toggler-<?= $event_info->id ?>y">

                                    <span class="count">
                                        <?= $num_comments ?>
                                    </span> Comments
                                </div>
                            </li>
                        </ul>
                        <hr/>

                    </div>
                    <div class="animation_image col-md-12" align="center" style="display: none">
                        <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif" class="img-responsive" style="width:40px">
                    </div>
                    <div class="tab-content">
                        <div class="text-comment" id="cmtclick">
                            <div class="wrap-avatar-comment">
                                <?php
                                if (isset($userdetail['user_image']) && !empty($userdetail['user_image'])) {
                                    ?>
                                    <a href="#">
                                        <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>uploads/users/<?php echo $userdetail['user_image']; ?>" alt="">
                                    </a>
                                    <?php
                                } else {
                                    ?>
                                    <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>assets/public/img/default_profile.jpeg" alt="profile pic">
                                    <?php
                                }
                                ?>

                            </div>
                            <?php if ($this->session->userdata('user_id')) { ?>

                                <!--<form class="" method="post" id="upload_form" enctype="multipart/form-data">-->
                                <div class="input-text-comment" id="enterfield<?= $event_info->id ?>">
                                    <input type="hidden" name="league_image_id" value="<?= $event_info->id ?>">
                                    <div class="show-upload" style="display: none">
                                        <input type="file"  name="userfile" size="20" id="make_click" onchange="readURL(this)"/>
                                    </div>

                                    <div class="preview_image" style="display: none">
                                        <div id="rem_1">
                                            <img id="show" src="" alt="" width="120px;" height="120px;" style="margin-bottom: 5px; margin-top: 5px;" />
                                            <i class="fa fa-remove remove" href="javascript:void(0);" style="margin-top: -72px; margin-right: 0px; margin-left: -4px; color: red; cursor: pointer; cursor: hand;"></i>
                                        </div>
                                    </div>


                                    <textarea class="form-control form-comment textarea-box" id="addCommentBox<?= $event_info->id ?>" name="commentss" rows="3" placeholder="What's on your mind"></textarea>

                                    <div class="post-comment">



                                        <div class="another-post">
                                            <a href="#" class="photo"> 
                                                <i class="fa fa-picture-o image_upload"></i> 
                                            </a> 
                                            <button type="submit" class="btn pull-right small-btn green-bg comment-btn commentPostBtn" module="event" id="<?= $event_info->id ?>">
                                                Comment
                                            </button>
                                        </div>
                                    </div>

                                    <span id="wordcount<?= $event_info->id ?>" class="value-box">1000</span>
                                    <div class="added-image"></div>
                                </div>
                                <!--</form>-->
                                <!--end-->

                            <?php } else {
                                ?>
                                <div class="input-text-comment" id="enterfield<?= $event_info->id ?>">
                                    <form action="">
                                        <textarea class="form-control form-comment textarea-box" readonly="" rows="3"name="commentss" required="" id="cmtbox" placeholder="What's on your mind"></textarea>

                                        <div class="post-comment">

                                            <div class="added-image"></div>

                                            <div class="another-post">
                                                <a href="#" class="photo"> 
                                                    <i class="fa fa-picture-o image_upload"></i> 
                                                </a> 
                                                <button type="submit" class="btn pull-right small-btn green-bg comment-btn commentPostBtn" module="event" id="<?= $event_info->id ?>">
                                                    Comment
                                                </button>
                                            </div>
                                        </div>
                                        <p class="value-box">1000</p>

                                    </form>
                                </div>

                            <?php } ?>

                        </div>
                        <!-- popular-->
                        <div role="tabpanel" class="tab-pane active" id="popular" style="width: 100%;">
                            <div  id="scroll_wrap_<?= $event_info->id ?>">
                                <div id="cmt_<?= $event_info->id ?>">
                                </div>
                            </div>
                            <div id="comment_input"></div>
                        </div>
                        <!-- tab panel -->

                        <div role="tabpanel" class="tab-pane" id="news" style="width: 100%;">
                            <h1>news</h1>
                            <div id="scroll_wrap_<?= $event_info->id ?>">
                                <div   id="ct_<?= $event_info->id ?>">
                                </div>
                            </div>
                            <div id="comment_input"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-4 col-xs-12 col-sm-4 ads-view">
                <?php
                if ($required_login == false) {
                    if ($userdetail !== false) {
                        ?>
                        <div class="banner hidden-xs">
                            <?php if ($entryNumber) { ?>
                                <div class="btn btn-select-winner"> Entry Number :  <?= $entryNumber ?></div>
                                <?php
                            }
                            $uid = $this->session->userdata('user_id');
                            if ($winner == false AND $adminId == $uid) {
                                echo '<script>document.getElementById("btn-win").style.display = "block";</script>';
                                ?>
                                <div style="" class="btn btn-select-winner btn-claim-winner">
                                    Select Winner
                                </div>
                            <?php } ?>
                            <div class="winner-box">
                                <?= $winnerHtml ?>
                            </div>


                        </div>
                        <?php
                    }
                }
                echo $this->load->view('template/right_sidebar');
                ?>
            </div>
        </div>
    </div>
</section>


<script src="<?= base_url() ?>assets/public/js/comments.js" type="text/javascript"></script>
<script>
                                    $("#event-access-form").submit(function(e) {
                                        e.preventDefault();
                                        $.ajax({
                                            url: "<?= base_url("public/event/auth") ?>",
                                            type: 'POST',
                                            dataType: 'JSON',
                                            data: $("#event-access-form").serialize(),
                                            success: function(data, textStatus, jqXHR) {
                                                if (data.status) {
                                                    window.location.reload();
                                                }
                                                else {
                                                    $("input[type=submit]").before("<small style='color:red'>" + data.msg + "</small> <br/>");
                                                }
                                            }
                                        })
                                    })
                                    $(".btn-claim-winner").click(function() {
                                        $.ajax({
                                            url: "<?= base_url("public/event/claimwinner") ?>",
                                            data: {
                                                id: <?= $event_info->id ?>
                                            },
                                            type: 'POST',
                                            dataType: 'JSON',
                                            beforeSend: function(xhr) {
                                                $(".btn-claim-winner").text("Loading...");
                                            },
                                            success: function(data, textStatus, jqXHR) {
                                                if (data.status) {
                                                    if (data.user.name != "") {
                                                        var name = data.user.name;
                                                    } else {
                                                        var name = data.user.user_name;
                                                    }
                                                    $(".btn-claim-winner").remove();
                                                    $html = '<div class="title-recent-discuss"> Winner </div><div class="box-recent-discuss">' +
                                                            '<div class="media info-avatar info-avatar-discuss">' +
                                                            '<div class="media-left media-left-discuss">' +
                                                            '<a href="<?= base_url("leaguememe_profile/") ?>"' + data.user.user_name + '>' +
                                                            '<img alt="' + data.user.name + '" src="<?= base_url("uploads/users/") ?>/' + data.user.user_image + '" class="media-object avatar avatar-discuss">' +
                                                            '</a>' +
                                                            '</div>' +
                                                            '<div class="media-body w-2000">' +
                                                            '<a href="<?= base_url("leaguememe_profile/") ?>"' + data.user.user_name + '><h5>' + name + '</h5></a>' +
                                                            '<span class="minute by-username">Entry : ENT' + data.user.id + '</span>' +
                                                            '<span class="profile-username">click to claim 24hrs</span>' +
                                                            '</div>' +
                                                            '</div>' +
                                                            '</div>';
                                                    $('.winner-box').html($html);
                                                }
                                                else {
                                                    $(".btn-claim-winner").text("Select Winner");
                                                    console.log(data.msg);
                                                }
                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                                $(".btn-claim-winner").text("Select Winner");
                                            }
                                        })
                                    })
<?php
if (isset($entryNumber) AND $entryNumber == false) {
    echo '$("#entry_number").parent().hide()';
}
?>
</script>
