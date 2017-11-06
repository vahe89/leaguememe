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
                    <ul class="nav nav-tabs draggable draggable-center" id="index-main-tab" role="tablist">
                        
                        <li  role="presentation" class="active">
                            <a data-toggle="tab" role="tab" aria-controls="home" href="#moment" aria-expanded="false">Leaguememe</a>
                        </li>
                        <li role="presentation" id="tab-disc">
                            <a data-toggle="tab" role="tab" aria-controls="profile" href="#discussion"  aria-expanded="true">Discussion</a>
                        </li>
                        <li class="" role="presentation">
                            <a data-toggle="tab" role="tab" aria-controls="profile" href="#news-outer" aria-expanded="false">News</a>
                        </li>
                        <li class="" role="presentation">
                            <a data-toggle="tab" role="tab" aria-controls="profile" href="#gameChat" aria-expanded="false">Gamechat</a>
                        </li>
                        <li role="presentation">
                            <a data-toggle="tab" role="tab" aria-controls="profile" href="#event" aria-expanded="false">Event</a>
                        </li>
                        <li role="presentation">
                            <a data-toggle="tab" role="tab" aria-controls="profile" href="#poll" aria-expanded="false">Poll</a>
                        </li>

                    </ul>
                </div>
                <div class="tab-content">
                    <div class="visible-xs" style="padding-top: 30px">
                        <div class="inline-league-btn">
                            <a href="javascript:void(0)" <?= (isset($username) && !empty($username)) ? "" : 'data-target="#login" data-toggle="modal"' ?>  class="btn btn-new-thread <?= (isset($username) && !empty($username)) ? "onePieceThread" : "" ?> " >
                                <i class="fa fa-plus-circle"> </i> Upload Pics
                            </a>
                            <a href="javascript:void(0)" class="btn btn-back-thread onePieceBack" style="display: none;" >
                                Back
                            </a>
                        </div>
                        <div class="inline-disc-btn" style="display: none">
                            <a class="btn btn-new-thread discussionThread" <?= (isset($username) && !empty($username)) ? 'data-toggle="tab" role="tab"  href="#upload-discussion-tab"' : 'data-target="#login" data-toggle="modal"  href="javascript:void(0)" ' ?> >
                                <i class="fa fa-plus-circle"></i>
                                Create Discussion
                            </a>
                            <a href="javascript:void(0)" class="btn btn-back-thread discussionBack" style="display: none;">
                                Back
                            </a>
                        </div>
                        <!-- <div class="inline-event-btn" style="display: none">
                                <a class="btn btn-new-thread  " <?= (isset($username) && !empty($username)) ? ' onclick="loadEvent(\'form\')" ' : 'data-target="#login" data-toggle="modal"  href="javascript:void(0)" ' ?> >
                                    <i class="fa fa-plus-circle"></i>
                                    Create Event
                                </a>
                            </div>-->
                        <div class="inline-gamechat-btn" style="display: none">
                            <a class="btn btn-new-thread gamechatThread" <?= (isset($username) && !empty($username)) ? 'data-toggle="tab" role="tab"  href="#uploadGamechat"' : 'data-target="#login" data-toggle="modal"  href="javascript:void(0)"  ' ?>>
                                <i class="fa fa-plus-circle"> </i> Gamechat
                            </a>
                        </div>
                        <a href="javascript:void(0);" class="btn btn-more-detail" onclick="toggler('index1');"> More info </a>
                    </div>
                    <div class="left-panel-sec  " id="index1">
                        <div class="hidden-xs">
                            <div class="inline-league-btn">
                                <a href="javascript:void(0)" <?= (isset($username) && !empty($username)) ? "" : 'data-target="#login" data-toggle="modal"' ?>  class="btn btn-new-thread <?= (isset($username) && !empty($username)) ? "onePieceThread" : "" ?> " >
                                    <i class="fa fa-plus-circle"> </i> Upload Pics
                                </a>
                                <a href="javascript:void(0)" class="btn btn-back-thread onePieceBack" style="display: none;" >
                                    Back
                                </a>
                            </div>
                            <div class="inline-disc-btn" style="display: none">
                                <a class="btn btn-new-thread discussionThread" <?= (isset($username) && !empty($username)) ? 'data-toggle="tab" role="tab"  href="#upload-discussion-tab"' : 'data-target="#login" data-toggle="modal"  href="javascript:void(0)" ' ?> >
                                    <i class="fa fa-plus-circle"></i>
                                    Create Discussion
                                </a>
                                <a href="javascript:void(0)" class="btn btn-back-thread discussionBack" style="display: none;">
                                    Back
                                </a>
                            </div>
                            <div class="inline-gamechat-btn" style="display: none">
                                <a  <?= (isset($username) && !empty($username)) ? 'data-toggle="tab" role="tab"  href="#uploadGamechat"' : 'data-target="#login" data-toggle="modal"  href="javascript:void(0)"' ?>class="btn btn-new-thread gamechatThread">
                                    <i class="fa fa-plus-circle"> </i> Gamechat
                                </a>
                            </div>
                            <!--   <div class="inline-event-btn" style="display: none">
                                        <a class="btn btn-new-thread  " <?= (isset($username) && !empty($username)) ? 'onclick="loadEvent(\'form\')"' : 'data-target="#login" data-toggle="modal"  href="javascript:void(0)" ' ?> >
                                            <i class="fa fa-plus-circle"></i>
                                            Create Event
                                        </a>
                                    </div>-->
                            <div class="inline-poll-btn" style="display: none">
                                <a <?= (isset($username) && !empty($username)) ? 'data-toggle="tab" role="tab"  href="#upload-poll-tab"' : 'data-target="#login" data-toggle="modal"  href="javascript:void(0)"' ?> class="btn btn-new-thread pollThread" >
                                    <i class="fa fa-plus-circle"></i>
                                    Create Poll
                                </a>
                                <a href="javascript:void(0)" class="btn btn-back-thread pollBack" style="display: none;">
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="wrap-panel">
                            <div class="title">
                                <p>NEWS</p>
                            </div>
                            <div class="content-panel">
                                <ul class="list-unstyled">
                                    <?php
                                    foreach ($new_post as $link) {
                                        ?> <li style="text-transform:uppercase"><a target="_blank" href="<?php echo base_url(); ?><?php echo $link['leagueimage_id']; ?>"><?php echo isset($link['leagueimage_name']) ? $link['leagueimage_name'] : LINK; ?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!-- end wrap-panel-->

                        <div class="wrap-panel uns-list">
                            <div class="title">
                                <p>RECENT DISCUSSION</p>
                            </div>
                            <div class="content-panel">
                                <ul class="list-unstyled">
                                    <?php
                                    foreach ($new_discussion as $discussion) {
                                        ?> 
                                        <li style="text-transform:uppercase"><a target="_blank" href="<?php echo base_url(); ?>anime-list-album/<?php echo $discussion['anime_category_id']; ?>"><?php echo isset($discussion['anime_name']) ? $discussion['anime_name'] : 'ONE PIECE'; ?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!-- end wrap-panel-->

                        <div class="wrap-panel uns-list">
                            <div class="title">
                                <p>LIKES</p>
                            </div>
                            <div class="content-panel">
                                <ul class="list-unstyled">
                                    <?php
                                    foreach ($new_like as $likes) {
                                        ?> 
                                        <li style="text-transform:uppercase"><a target="_blank" href="<?php echo base_url(); ?>anime-list-album/<?php echo $likes['anime_categoryid']; ?>"><?php echo isset($likes['anime_name']) ? $likes['anime_name'] : 'ONE PIECE'; ?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!-- end wrap-panel-->

                        <div class="wrap-panel uns-list" style="display: none">
                            <div class="title">
                                <p>GROUP</p>
                            </div>
                            <div class="content-panel">
                                <ul class="list-unstyled">
                                    <li><a href="">ONE PIECE</a>
                                    </li>
                                    <li><a href="">NARUTO</a>
                                    </li>
                                    <li><a href="">DORAEMON</a>
                                    </li>
                                    <li><a href="">BLEACH</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- end wrap-panel-->
                    </div>






