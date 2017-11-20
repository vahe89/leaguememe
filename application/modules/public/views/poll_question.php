<style>
    div.background-cover {
        display: none;
    }
</style>
<body style="background-color:#eee;" >


    <div class="container no-padding" >
        <div class="single-panel single-panel-view" style="margin-top: 90px;" >
            <?php
            foreach ($result as $poll_result) {
                $total_point = ((int) $poll_result['total_victory']) - ((int) $poll_result['total_defeat']);
                $array = explode(",", $poll_result['answers']);
                ?>
                <div class="row-custom">
                    <div class="col-md-12 no-padding">
                        <div class="title-section" style="margin-top: -10px;">
                            <span>Poll Question</span>
                            <a href="javascript:void(0);" class="btn btn-red btn-back-review" id="backtoPoll">Back</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 no-padding">
                    <div class="col-md-12 wrap-res-avatar no-padding">

                        <div class="col-md-12 no-padding">
                            <div class="media info-avatar avatar-fifth-page" style="width: 100%">
                                <div class="media-left up-triangle-hide"  style=" width: 9%;">
                                    <?php
                                    if (isset($userid) && !empty($userid) && isset($victory[$poll_result['id']]) && !empty($victory[$poll_result['id']])) {
                                        if (in_array($userid, $victory[$poll_result['id']])) {
                                            ?>
                                            <a href="javascript:void(0)" class="pad-l-22" onclick="pollvictory(this.id)" id="vic_<?php echo $poll_result['id']; ?>">
                                                <img class="up-scroll"  id="like_<?php echo $poll_result['id']; ?>"  src="<?php echo base_url(); ?>assets/public/img/up-triangle-hover.png">
                                            </a>
                                            <?php
                                        } else {
                                            ?>  
                                            <a href="javascript:void(0)"class="pad-l-22" onclick="pollvictory(this.id)" id="vic_<?php echo $poll_result['id']; ?>">
                                                <img class="up-scroll"  id="like_<?php echo $poll_result['id']; ?>" src="<?php echo base_url(); ?>assets/public/img/up-triangle.png">
                                            </a>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <a href="javascript:void(0)" class="pad-l-22" onclick="pollvictory(this.id)" id="vic_<?php echo $poll_result['id']; ?>">
                                            <img class="up-scroll"  id="like_<?php echo $poll_result['id']; ?>"  src="<?php echo base_url(); ?>assets/public/img/up-triangle.png">
                                        </a>
                                        <?php
                                    }
                                    ?>

                                    <div class="rating" id="points_<?php echo $poll_result['id']; ?>"><?php echo $total_point; ?></div>
                                    <?php
                                    if (isset($userid) && !empty($userid) && isset($defact[$poll_result['id']]) && !empty($defact[$poll_result['id']])) {
                                        if (in_array($userid, $defact[$poll_result['id']])) {
                                            ?>
                                            <a href="javascript:void(0)"class="pad-l-22"onclick="polldefeat(this.id)" id="def_<?php echo $poll_result['id']; ?>">
                                                <img class="down-scroll"  id="dislike_<?php echo $poll_result['id']; ?>" src="<?php echo base_url(); ?>assets/public/img/down-triangle-hover.png">
                                            </a>
                                            <?php
                                        } else {
                                            ?> 
                                            <a href="javascript:void(0)" class="pad-l-22" onclick="polldefeat(this.id)" id="def_<?php echo $poll_result['id']; ?>">
                                                <img class="down-scroll"   id="dislike_<?php echo $poll_result['id']; ?>" src="<?php echo base_url(); ?>assets/public/img/down-triangle.png">
                                            </a>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <a href="javascript:void(0)" class="pad-l-22" onclick="polldefeat(this.id)" id="def_<?php echo $poll_result['id']; ?>">
                                            <img class="down-scroll"  id="dislike_<?php echo $poll_result['id']; ?>" src="<?php echo base_url(); ?>assets/public/img/down-triangle.png">
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="media-body media-body-vote">
                                    <a style="float: left" href="<?php echo base_url(); ?>leaguememe-profile/<?php echo $poll_result['user_name'] ?>">
                                        <?php
                                        if (isset($poll_result['user_image']) && !empty($poll_result['user_image'])) {
                                            ?>
                                            <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>uploads/users/<?php echo $poll_result['user_image']; ?>" alt="<?php echo $poll_result['user_name']; ?>"> 
                                            <?php
                                        } else {
                                            ?>
                                            <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>assets/public/img/default_profile.jpeg" alt="profile pic">
                                            <?php
                                        }
                                        ?>
                                    </a>
                                    <a href="<?php echo base_url(); ?>leaguememe-profile/<?php echo $poll_result['user_name']; ?>">
                                        <h5 class="pad-l-65"><?php echo empty($poll_result['name']) ? $poll_result['user_name'] : $poll_result['name']; ?></h5>
                                    </a>
                                    <span class="minute pad-l-65" style="display: block" data-livestamp="<?php echo strtotime($poll_result['created_date']); ?>"><?php echo strtotime($poll_result['created_date']); ?></span>

                                    <div class="wrap-tag-comment">
                                        <div class="avatar-comment">
                                            <a id="point_<?php echo $poll_result['id']; ?>"><?php echo $total_point; ?></a><a> Likes </a> &nbsp; - &nbsp;
                                            <a href="#" id="polltoggler-<?php echo $poll_result['id'] . "yy"; ?>"><?php
                                                $total_comment = $poll_result['total_comment'];
                                                if (!empty($total_comment)) {
                                                    echo $total_comment;
                                                } else {
                                                    echo '0';
                                                }
                                                ?> </a><a> Comments</a>
                                        </div>

                                    </div>
                                    <div class="wrap-tag-comment mar-t-10">
                                        <div class="tag   tag-index tag-vote">
                                            <span id="credit2" class="normal-tag tag-poll">Poll</span>
                                            <?php if ($poll_result['spoiler'] == 1) { ?>
                                                <span class="red-tag normal-tag">Spoiler</span>
                                            <?php
                                            }
                                            if (!empty($poll_result['author']) AND ! empty($poll_result['credit'])) {
                                                ?>
                                                <span  class="normal-tag disc-credit-shows" data-credit="<?= $poll_result['author'] ?>">Credit</span>
                                                <?php
                                                $img = "fb-credit.png";
                                                $lnk = "https://www.facebook.com/";
                                                if (strpos($poll_result['credit'], "facebook")) {
                                                    $img = "fb-credit.png";
                                                    $lnk = "https://www.facebook.com/";
                                                } elseif (strpos($poll_result['credit'], "twitter")) {
                                                    $img = "tt-credit.png";
                                                    $lnk = "https://twitter.com/";
                                                } elseif (strpos($poll_result['credit'], "insta")) {
                                                    $img = "ig-credit.png";
                                                    $lnk = "https://www.instagram.com";
                                                }
                                                ?>
                                                <a href="<?= $lnk ?>" target="_BLANK" class="fb-1" style="display: none">
                                                    <img src="<?= base_url() ?>assets/public/img/<?= $img ?>">
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 wraper-discuss-click">

                        <div class="title-voting-click">
                            <?php echo $poll_result['questions']; ?>
                        </div>
                        <?php
                        for ($i = 0; $i < count($array); $i++) {
                            ?>
                            <ul class="list-answer" id="list-answer">
                                <li>
                                    <div class="radio radio-voting">
                                        <!--<input type="radio" value="answers" name="answers" id="answers">-->
                                        <input id="choice<?php echo $i; ?>" type="radio" name="AccountType" class="answerlist" value=" <?php echo $array[$i]; ?>">
                                        <label for="choice<?php echo $i; ?>" style="margin-right:0px;"></label>
                                    </div>
                                    <div class="answer1">
                                        <?php echo $array[$i]; ?>
                                    </div>
                                </li>

                            </ul>
                        <?php } ?>

                        <div class="button-vote-wrapper">
                            <a href="javascript:void(0);" class="btn btn-voting" id="givevote">
                                Vote
                            </a>
                            <a href="javascript:void(0);" class="btn btn-review" id="results">
                                Results
                            </a>
                        </div>

                        <div class="field-discuss">
                            <p><?php echo $poll_result['discription']; ?></p>
                        </div>

                        <div class="share-fifth-click">
                            <!--social share -->
                            <div class="social-share">
                                <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank" class="btn-fb-share" style="margin-left: 0px !important;">
                                    <span>Share</span>
                                </a>
                                <a data-count="vertical" data-via="your_screen_name" data-hashtags="mayur8189" href="https://twitter.com/share" target="_blank" class="btn-tt-share">
                                    <span>Share</span>
                                </a>
                            </div>
                        </div>


                    </div> 
 <div class="col-md-12"><ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-9746555787553362"
     data-ad-slot="1317445683"></ins></div>
                    <div class="tab-comment">
                        <ul id="pop" class="nav pop-tabs pop-view" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#popular" role="tab" data-toggle="tab" aria-controls="popular" aria-expanded="true">Popular</a>
                            </li>
                            <li role="presentation" class="mar-lm-5">
                                <a href="#news" role="tab" data-toggle="tab" aria-controls="news" id="fresh1">News</a>
                            </li>
                            <li style="float:right;">
                                <div class="comment-status" id="polltoggler-<?php echo $poll_result['id'] . "y"; ?>">

                                    <span class="count">
                                        <?php
//                                    $total_comment = $anim_img->total_comment;
                                        if (!empty($total_comment)) {
                                            echo $total_comment;
                                        } else {
                                            echo '0';
                                        }
                                        ?>
                                    </span> Comments
                                </div>
                            </li>
                        </ul>
                        <hr/>

                    </div>

                    <div class="animation_image col-md-12"  ><img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif" class="img-responsive" style="width:40px"></div>
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
                                <div class="input-text-comment" id="enterfield<?php echo $poll_result['id']; ?>">
                                    <form action="">
                                        <textarea class="form-control form-comment" rows="3"name="commentss" required="" id="addCommentBox<?php echo $poll_result['id']; ?>" placeholder="What's on your mind"></textarea>
                                        <input type="hidden" name="league_image_id" value="<?php echo $poll_result['id']; ?>">
                                        <div style="cursor: pointer" class="pull-right small-btn green-bg commentPostBtn" id="<?php echo $poll_result['id']; ?>" >
                                            Comment
                                        </div>
                                        <div class="col-lg-2  pull-right main-comment" id="<?php echo $poll_result['id']; ?>" >
                                            <p id="wordcount<?php echo $poll_result['id']; ?>" class="wordcount">1000</p>
                                        </div>
                                    </form>
                                </div>

                            <?php } else {
                                ?>
                                <div class="input-text-comment" id="enterfield<?php echo $poll_result['id']; ?>">
                                    <form action="">
                                        <textarea class="form-control form-comment" readonly="" rows="3"name="commentss" required="" id="cmtbox" placeholder="What's on your mind"></textarea>
                                        <a href="" class="pull-right small-btn green-bg btn disabled">
                                            Comment
                                        </a>
                                        <div class="col-lg-2  pull-right main-comment">
                                            <p class="wordcount">1000</p>
                                        </div>
                                    </form>
                                </div>

                            <?php } ?>

                        </div>
                        <!-- popular-->
                        <div role="tabpanel" class="tab-pane active" id="popular" style="width: 100%;">
                            <div  id="scroll_wrap_<?php echo $poll_result['id']; ?>">
                                <div id="cmt_<?php echo $poll_result['id']; ?>">
                                </div>
                            </div>
                            <div id="comment_input"></div>
                        </div>
                        <!-- tab panel -->

                        <div role="tabpanel" class="tab-pane" id="news" style="width: 100%;">

                            <div id="scroll_wrap_<?php echo $poll_result['id']; ?>">
                                <div   id="ct_<?php echo $poll_result['id']; ?>">
                                </div>
                            </div>
                            <div id="comment_input"></div>
                        </div>
                    </div>


                </div>
            <?php } ?>
            <div class="col-md-4 col-sm-12 ads-view"> 
            <input type="hidden" value="dtlPage" id="getPage">
                <?php
                echo $this->load->view('template/right_sidebar');
                ?>
            </div>


        </div>
    </div>


    <script>
        var poll_id = "<?php echo $poll_result['id']; ?>";
    </script>

</body>
<script>function fbs_click() {
        u = location.href;
        t = document.title;
        window.open('http://www.facebook.com/sharer.php?u=' + encodeURIComponent(u) + '&t=' + encodeURIComponent(t), 'sharer', 'toolbar=0,status=0,width=626,height=436');
        return false;
    }</script>
<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
<script src="<?php echo base_url(); ?>assets/public/js/poll_question.js"></script>
