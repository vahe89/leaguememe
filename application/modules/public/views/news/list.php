 
<div classs="row">
    <div class="col-md-12 wrap-main">
        <input type="hidden" name="total_groups" id="article_total_groups" value="<?php echo isset($allcount) ? $allcount : 0; ?>"/>
        <?php 
        if (isset($article_data) && !empty($article_data) && count($article_data) > 0) {
            $k = 0;
            $divider = 10;
            foreach ($article_data as $article) {
                 if (stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")) { // if mobile browser
                    if ($k % $divider == 0) {
                        ?>
                                <ins class="adsbygoogle"
                                 style="display:inline-block;width:300px;height:280px"
                                 data-ad-client="ca-pub-9746555787553362"
                                 data-ad-slot="5203425452"
                                 data-ad-format="auto"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        <?php
                    }
                }
                ?>
                <div class="wrapper-avatar popular-news">


                    <div class="media info-avatar">
                        <div class="media-left">
                            <a href="#">
                                <?php
                                if (isset($article->user_image)) {
                                    ?>
                                    <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>uploads/users/<?php echo $article->user_image; ?>" alt="<?php echo $article->user_name; ?>"> 
                                    <?php
                                } else {
                                    ?>
                                    <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>assets/public/img/luffy.png" alt="profile pic">
                                    <?php
                                }
                                ?>

                            </a>
                        </div>
                        <div class="media-body w-2000">
                            <a href="#"><h5><?php echo isset($article->user_name) ? $article->user_name : "Admin"; ?></h5></a>

                            <div class="col-md-12 no-padding">
                                <span class="minute" style="display: inline" data-livestamp="<?php echo strtotime($article->created_date); ?>"></span> 

                            </div>
                            <span style="display: none" id="creditt<?php echo $article->article_id; ?>"><?php echo isset($article->author) ? $article->author : "Not Assign"; ?></span>
                            <div class="tag tag-index">
                                <?php
                                if ($article->spoiler == 1) {
                                    ?>
                                    <span class="red-tag">spoiler</span>
                                    <?php
                                }
                                ?>



                            </div>
                        </div>
                        <div class="row col-lg-12 container-fluid" style="width:auto;">
                            <input style="display:none" readonly="readonly" type="text" class="form-group col-sm-12 cpylink" id="<?php echo "articlecopytext_" . $article->article_id; ?>" value="<?php echo base_url(); ?>news-detail/<?php echo $article->article_id; ?>">
                        </div>

                    </div>
                    <h3>
                        <?php
                        if ($article->article_name === "") {
                            ?>
                            <a class="image1" href="<?php echo base_url(); ?>news-detail/<?php echo $article->article_id; ?>">NA</a>
                            <?php
                        } else {
                            ?>
                            <a class="image1" href="<?php echo base_url(); ?>news-detail/<?php echo $article->article_id; ?>"><?php echo $article->article_name; ?></a>
                        <?php } ?>
                    </h3>

                    <a href="<?php echo base_url(); ?>news-detail/<?php echo $article->article_id; ?>"><img src="<?= base_url() ?>uploads/articles/<?= $article->article_image ?>" alt="<?= $article->article_image ?>" class="img-responsive meme-big" /> </a>

                    <!--like-->
                    <div class="link-comment" >
                        <?php
                        $total_point = ((int) $article->total_victory) - ((int) $article->total_defeat);
                        ?>

                        <a id="article_point_<?php echo $article->article_id; ?>"><?php echo $total_point; ?> </a> <a>Likes</a> &nbsp; - &nbsp;
                        <a>
                            <?php
                            $total_comment = $article->total_comment;
                            if (!empty($total_comment)) {
                                echo $total_comment;
                            } else {
                                echo '0';
                            }
                            ?>
                            <span>Comments</span></a>  

                    </div>

                    <div class="shares">
                        <!-- update -->
                        <div class="link-icon pull-left">
                            <ul class="list-unstyled left-link">
                                <?php
                                if (isset($userid) && !empty($userid) && isset($victory[$article->article_id]) && !empty($victory[$article->article_id])) {
                                    if (in_array($userid, $victory[$article->article_id])) {
                                        ?>
                                        <li>
                                            <a onClick = "onArticleVictory(this.id);" id = "<?php echo $article->article_id; ?>" style = "cursor: pointer" rel = "<?php echo $article->article_id; ?>"class="hvr-bounce-in">
                                                <img id="article_victory_img_<?php echo $article->article_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/up-hover.png">
                                                <!--<i  class = "fa fa-arrow-up fa-lg victory_active"></i>-->
                                            </a>
                                        </li>
                                        <?php
                                    } else {
                                        ?> 
                                        <li>
                                            <a onClick = "onArticleVictory(this.id);" id = "<?php echo $article->article_id; ?>" style = "cursor: pointer" rel = "<?php echo $article->article_id; ?>"  class="hvr-bounce-in">
                                                <img id="article_victory_img_<?php echo $article->article_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/up.png" >
                                            </a>
                                        </li>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <li>
                                        <a onClick = "onArticleVictory(this.id);" id = "<?php echo $article->article_id; ?>" style = "cursor: pointer" rel = "<?php echo $article->article_id; ?>"  class="hvr-bounce-in">
                                            <img id="article_victory_img_<?php echo $article->article_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/up.png" >
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>

                                <?php
                                if (isset($userid) && !empty($userid) && isset($defact[$article->article_id]) && !empty($defact[$article->article_id])) {
                                    if (in_array($userid, $defact[$article->article_id])) {
                                        ?>
                                        <li>
                                            <a class="hvr-bounce-in" onClick="onArticleDefeat(this.id)" id="<?php echo $article->article_id; ?>" style="cursor: pointer" rel="<?php echo $article->article_id; ?>">
                                                <img id="article_defeat_img_<?php echo $article->article_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/down-hover.png" >
                                            </a>
                                        </li>
                                        <?php
                                    } else {
                                        ?> 
                                        <li>
                                            <a class="hvr-bounce-in" onClick="onArticleDefeat(this.id)" id="<?php echo $article->article_id; ?>" style="cursor: pointer" rel="<?php echo $article->article_id; ?>">
                                                <img id="article_defeat_img_<?php echo $article->article_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/down.png" >
                                            </a>
                                        </li>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <li>
                                        <a  class="hvr-bounce-in" onClick="onArticleDefeat(this.id)" id="<?php echo $article->article_id; ?>" style="cursor: pointer" rel="<?php echo $article->article_id; ?>">
                                            <img id="article_defeat_img_<?php echo $article->article_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/down.png" >
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                                <li>
                                    <a  href = "<?php echo base_url(); ?>news-detail/<?php echo $article->article_id; ?>#cmtclick" class="hvr-bounce-in">
                                        <img src="<?php echo base_url(); ?>assets/public/img/icon/post/comment.png" >
                                    </a>
                                </li>
                                <?php
                                if (isset($userid) && !empty($userid) && isset($favuserid[$article->article_id]) && !empty($favuserid[$article->article_id])) {

                                    if (in_array($userid, $favuserid[$article->article_id])) {
                                        ?>
                                        <li>
                                            <a class="hvr-bounce-in" onclick="onArticleFavourites(this.id)" id="<?php echo $article->article_id; ?>" style="cursor: pointer" rel="<?php echo $article->article_id; ?>">
                                                <img id="article_favourites_img_<?php echo $article->article_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/open-hover.png" >
                                            </a>
                                        </li>

                                        <?php
                                    } else {
                                        ?> 
                                        <li>
                                            <a class="hvr-bounce-in" onclick="onArticleFavourites(this.id)" id="<?php echo $article->article_id; ?>" style="cursor: pointer" rel="<?php echo $article->article_id; ?>">
                                                <img id="article_favourites_img_<?php echo $article->article_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/open.png" >
                                            </a>
                                        </li>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <li>
                                        <a class="hvr-bounce-in" onclick="onArticleFavourites(this.id)" id="<?php echo $article->article_id; ?>" style="cursor: pointer" rel="<?php echo $article->article_id; ?>">
                                            <img id="article_favourites_img_<?php echo $article->article_id; ?>" src="<?php echo base_url(); ?>assets/public/img/icon/post/open.png" >
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                                <li class="js-aricletextareacopybtn" title="click to copy " id="<?php echo "copy_" . $article->article_id; ?>" value="<?php echo $article->article_id; ?>">
                                    <a href = "javascript:void(0);" class="hvr-bounce-in">
                                        <img src="<?php echo base_url(); ?>assets/public/img/icon/post/link.png" >
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- social -->
                        <div class="pull-right social-btn">


                            <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click(<?= $article->article_id ?>)" target="_blank" class="fb-bg medium-btn mar-r-5">
                                <i class="fa fa-facebook"></i> share
                            </a> 
                            <a  href="http://twitter.com/home/?status=<?php echo base_url(); ?>news-detail/<?php echo $article->article_id; ?> (via @leaguememecom)" class="popup twitter tw-bg medium-btn">
                                <i class="fa fa-twitter"></i> share
                            </a>
                        </div>
                    </div>
                    <!-- end shares-->

                    <div class="clearfix"></div>
                    <?php
//                            $tags = isset($article->tags) ? $article->tags : '';
//                            if (empty($tags)) {
//                                
                    ?>
                    <!--<div class="hastag" style="display: none"></div>-->
                    <?php
//                            } else {
//                                
                    ?>
                    <!--<div class="hastag">-->
                    <?php
//                                    if (!empty($tags)) {
//                                        $pieces = explode(" ", $tags);
//                                        foreach ($pieces as $tag) {
//                                            $tag_name = str_replace(" ", "-", $tag);
//                                            
                    ?>
                                <!--<a class = "btn btn-grey" href = "//<?php echo base_url(); ?>tag/<?php echo urlencode($tag_name); ?>" id="text_decoration_none" role = "button"><?php echo $tag; ?></a>-->
                    <?php
//                                        }
//                                    }
//                                    
                    ?>
                    <!--</div>-->
                    <?php //} ?>
                </div>
                <?php
          $k++;  }
        } else { 
            if ( $page_row == 0) {
                ?>
                <br>
                <div> 
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> No Articles found  
                    </div>
                </div>
                <?php
            }
            ?>

            <?php
        }
        ?>
    </div>

    <!--end col-md-12-->

</div> 
<script>
    $('.popup').click(function(event) {
        var width = 575,
                height = 400,
                left = ($(window).width() - width) / 2,
                top = ($(window).height() - height) / 2,
                url = this.href,
                opts = 'status=1' +
                ',width=' + width +
                ',height=' + height +
                ',top=' + top +
                ',left=' + left;

        window.open(url, 'twitter', opts);

        return false;
    });
</script>
<script>
    function fbs_click(id) {
        u = base_url + 'news-detail/' + id;
        t = document.title;
        window.open('http://www.facebook.com/sharer.php?u=' + encodeURIComponent(u) + '&t=' + encodeURIComponent(t), 'sharer', 'toolbar=0,status=0,width=626,height=436');
        return false;
    }
</script> 
