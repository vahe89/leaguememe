<style>
    div.background-cover {
        display: none;
    } 
    body {
        background-color:#eee;
    } 
</style>

<div class="container no-padding news-detail">
    <div class="single-panel single-panel-view">
        <div class="col-md-8 col-xs-12 col-sm-12 no-padding">
            <div class="col-md-12 col-xs-12 no-padding">
                <div class="media info-avatar avatar-view">
                    <div class="media-left">
                        <a href=""> <img src="<?= base_url() ?>assets/public/img/luffy.png" alt="" class="media-object avatar img-circle"> </a>
                    </div>
                    <div class="media-body">
                        <a href="">
                            <h5>ADMIN</h5> </a> 
                        <span class="minute" style="display: inline;" data-livestamp="<?php echo strtotime($article_detail->created_date); ?>"></span>
<!--                        <span class="minute" style="display: inline;">to <a href="javascript:void(0)" class="minute">  /a/onepiece</a></span>-->
                        <div class="tag tag-minute"> 
                            <?php 
                            $tagstyle = $article_detail->tag_style;
                            $tagstyle = explode(",", $tagstyle);
                            $tag_name = "THEORY";
                            $tag_color = "#dfdfdf";
                            $spoiler ="";
                            if (!empty($tagstyle[0])) {
                                $tag_name = trim($tagstyle[0]);
                            }
                            if (!empty($tagstyle[1])) {
                                $tag_color = trim($tagstyle[1]);
                            }
                            if($article_detail->spoiler == 1){
                                $spoiler = '<span class="red-tag">Spoiler</span>';
                            }
                            ?>
                            <span class="normal-tag" style="border:1px solid <?= $tag_color ?>"><?= $tag_name ?></span> 
                            <?= $spoiler ?> <span class="count-view"><b> <?= empty($article_detail->article_views) ? '0' : $article_detail->article_views ?></b> Views</span> </div>
                    </div>
                </div>
            </div>
            <div class="articel">
                <div class="main-title">
                    <?= $article_detail->article_name ?>
                </div> 
                <div class="image-articel">
                    <img src="<?= base_url() ?>uploads/articles/<?= $article_detail->article_image ?>" class="img-responsive meme-view" style="width: 100%">
                </div>
                <div class="fill-articel">
                    <?= $article_detail->article_description ?>
                </div>

            </div>
            <!--avatar -->
            <div class="hastag-view">
                <?php
                $tags = trim($article_detail->tags, "%%");
                $tags = explode("%%", $tags);
                foreach ($tags as $tag) {
                    $tag = trim($tag, ",");
                    ?>
                    <a class="btn btn-grey" href="#" role="button"><?= $tag ?></a>
                    <?php
                }
                ?>


            </div>
            <div class="social-share social-btn" style="padding: 5px; padding-left: 10px;">
                <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank" class="btn-fb-share">
                    <span>share</span>
                </a>

                <a  data-count="vertical" data-via="your_screen_name" data-hashtags="mayur8189" href="https://twitter.com/share" class="btn-tt-share">
                    <span>share </span>
                </a>
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
                        <div class="comment-status" id="toggler-<?php echo $article_detail->article_id . "y"; ?>">

                            <span class="count">
                                <?php
                                $total_comment = $article_detail->total_comment;
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
            <div class="animation_image col-md-12" align="center"><img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif" class="img-responsive" style="width:40px"></div>
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
                        <div class="input-text-comment" id="enterfield<?php echo $article_detail->article_id; ?>">
                            <input type="hidden" name="league_image_id" value="<?php echo $article_detail->article_id; ?>">
                            <div class="show-upload" style="display: none">
                                <input type="file"  name="userfile" size="20" id="make_click" onchange="readURL(this)"/>
                            </div>

                            <div class="preview_image" style="display: none">
                                <div id="rem_1">
                                    <img id="show" src="" alt="" width="120px;" height="120px;" style="margin-bottom: 5px; margin-top: 5px;" />
                                    <i class="fa fa-remove remove" href="javascript:void(0);" style="margin-top: -72px; margin-right: 0px; margin-left: -4px; color: red; cursor: pointer; cursor: hand;"></i>
                                </div>
                            </div>


                            <textarea class="form-control form-comment textarea-box" id="addCommentBox<?php echo $article_detail->article_id; ?>" name="commentss" rows="3" placeholder="What's on your mind"></textarea>

                            <div class="post-comment">



                                <div class="another-post">
                                    <a href="#" class="photo"> 
                                        <i class="fa fa-picture-o image_upload"></i> 
                                    </a> 
                                    <button type="submit" class="btn pull-right small-btn green-bg comment-btn commentPostBtn" id="<?php echo $article_detail->article_id; ?>">
                                        Comment
                                    </button>
                                </div>
                            </div>

                            <span id="wordcount<?php echo $article_detail->article_id; ?>" class="value-box">1000</span>
                            <div class="added-image"></div>
                        </div>
                        <!--</form>-->
                        <!--end-->

                    <?php } else {
                        ?>
                        <div class="input-text-comment" id="enterfield<?php echo $article_detail->article_id; ?>">
                            <form action="">
                                <textarea class="form-control form-comment textarea-box" readonly="" rows="3"name="commentss" required="" id="cmtbox" placeholder="What's on your mind"></textarea>

                                <div class="post-comment">

                                    <div class="added-image"></div>

                                    <div class="another-post">
                                        <a href="#" class="photo"> 
                                            <i class="fa fa-picture-o image_upload"></i> 
                                        </a> 
                                        <button type="submit" class="btn pull-right small-btn green-bg comment-btn commentPostBtn" id="<?php echo $article_detail->article_id; ?>">
                                            Comment
                                        </button>
                                    </div>
                                </div>
                                <p class="value-box">1000</p>

                            </form>
                        </div>

                    <?php } ?>

                </div>
                <!--popular-->
                <div role="tabpanel" class="tab-pane active" id="popular" style="width: 100%;">
                    <div  id="scroll_wrap_<?php echo $article_detail->article_id; ?>">
                        <div id="cmt_<?php echo $article_detail->article_id ?>">
                        </div>
                    </div>
                    <div id="comment_input"></div>
                </div>
                <!--tab panel--> 

                <div role="tabpanel" class="tab-pane" id="news" style="width: 100%;">
                     
                    <div id="scroll_wrap_<?php echo $article_detail->article_id; ?>">
                        <div   id="ct_<?php echo $article_detail->article_id ?>">
                        </div>
                    </div>
                    <div id="comment_input"></div>
                </div>
            </div> 
        </div>
        <?php echo $this->load->view('articles_right_sidebar') ?>
    </div>
</div>
<script>
    var article_single_id = "<?php echo $article_detail->article_id; ?>";
</script>
<script>function fbs_click() {
        u = location.href;
        t = document.title;
        window.open('http://www.facebook.com/sharer.php?u=' + encodeURIComponent(u) + '&t=' + encodeURIComponent(t), 'sharer', 'toolbar=0,status=0,width=626,height=436');
        return false;
    }</script>
<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>

<script src="<?php echo base_url(); ?>assets/public/js/article_single.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/public/js/jquery.mCustomScrollbar.concat.min.js"></script> 

<script>

    $(document).ready(function() {

        $('#login_close').click(function() {
            $('#login').removeClass('in');
            $('#login').hide();
            $('#modal_backdrop').remove();
        });
        $('#cmtbox').focus(function() {

            var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
            $('#body_id').append(html);
            $('#login').addClass('in');
            $('#login').show();
        });


    });
</script> 
<script>
    $(document).ready(function() {
        $(".image_upload").click(function(e) {
            e.preventDefault();
            $('#make_click').click();

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
                $('#make_click').val("");
            })
                    );
        }
    }

    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    }

</script>
<script>
    !function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
        if (!d.getElementById(id)) {
            js = d.createElement(s);
            js.id = id;
            js.src = p + '://platform.twitter.com/widgets.js';
            fjs.parentNode.insertBefore(js, fjs);
        }
    }(document, 'script', 'twitter-wjs');
</script>
