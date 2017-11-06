
<style>
   body {
       background-color:#eee;
    }
</style>
<!--content section-->
<div class="container no-padding">
    <div class="single-panel single-panel-view" style="margin-top: 70px;">
        <div class="col-md-8 mar-t-20" style="padding-right: 5px;">
            <h4 class="block-title"><span>Trending Now</span></h4>
            <div class="outer-thumb">
                <div class="wrap-trending-articel">
                    <?php
                    foreach ($article_top_treading as $top_article) {
                        $date_str = date_create($top_article['created_date']);
                        ?> 
                        <div class="col-md-6 wrap-news-thumb">
                            <figure>
                                <div class="wrap-thumb-img">
                                    <a href="#">
                                        <img src="<?php echo base_url(); ?>assets/public/img/news-1.jpg">
                                    </a>
                                </div>
                            </figure>
                            <div class="info-thumb">
                                <div class="title-thumb">
                                    <a href="javacript:void(0);">
                                        <?php
                                        $article_description = $top_article['article_name'];
                                        if (strlen($article_description) > 30) {
                                            $article_description1 = substr($article_description, 0, 30) . '...';
                                        } else {
                                            $article_description1 = $article_description;
                                        }
                                       echo $article_description1; ?> </a>
                                </div>
                                <div class="wrap-detail-thumb">
                                    <div class="wrap-author-thumb">
                                        <span>by</span>
                                        &nbsp;
                                        <a class="author-thumb" href="javascript:void(0)">Admin</a>
                                    </div>
                                    <div class="wrap-view-thumb">
                                        <a class="view-thumb" href="#"><?php echo number_format($top_article['article_views']); ?> views</a>
                                    </div>
                                    <div class="wrap-date-thumb">
                                        <a class="date-thumb" href="#"> <?php echo date_format($date_str, "F d,Y"); ?></a>
                                    </div>
                                </div>
                                <div class="tag tag-minute-thumb">
                                    <a href="#" class="normal-tag">Theory</a>
                                    <a href="#" class="red-tag">Spoiler</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>



                </div>
            </div>

            <div class="outer-last">
                <div class="block-title"><span>Latest Articel</span></div>
                <div class="wrap-latest-articel">
                    <div class="col-md-12 wrap-news-articel">
                        <?php
                        foreach ($article_data as $article) {
                            $date = date_create($article['created_date']);
                            ?>
                            <div class="news-articel col-md-12 col-sm-12 col-xs-12">
                                <div class="news-articel-left">
                                    <a href="#" class="image-link">
                                        <img src="<?php echo base_url(); ?>assets/public/img/articel1.jpeg<?php //echo $article['article_image'];    ?> ">
                                    </a>
                                </div>
                                <div class="news-articel-right ">
                                    <p class="title-articel">
                                        <a href="#" class="title-articel-link"><?php echo $article['article_name'] . " - " . date_format($date, "F Y"); ?> </a>

                                    </p>
                                    <div class="text-articel">
                                        <?php echo $article['article_description']; ?>

                                    </div>
                                    <div class="information-articel">
                                        <p class="info">
                                            by <a href="javascript:void(0);">Admin</a>
                                        </p>
                                        <p class="view">
                                            <?php echo $article['article_views'] ?> views
                                        </p>
                                        <div class="tag-minute-thumb">
                                            <a href="#" class="normal-tag">Theory</a>
                                            <?php if ($article['spoiler'] == 1) { ?>
                                                <a href="#" class="red-tag">Spoiler</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?> 	
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 ads-view-news">
            <div class="featured-side-block">
                <p class="header">Top Page Views</p>
                <ul class="featured-list">
                    <li class="featured">
                        <a href="#" class="img-featured">
                            <img src="<?php echo base_url(); ?>assets/public/img/articel-right1.jpeg">
                        </a>
                        <div class="detail-featured">
                            <span class="detail-featured-number">1.</span>
                            <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                            <div class="information-featured">
                                <p class="info-featured">
                                    by <a href="#">MAL_editing_team</a>
                                </p>
                                <div class="tag-minute-featured">
                                    <a href="#" class="normal-tag">Theory</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="featured">
                        <a href="#" class="img-featured">
                            <img src="<?php echo base_url(); ?>assets/public/img/articel-right2.jpeg">
                        </a>
                        <div class="detail-featured">
                            <span class="detail-featured-number">2.</span>
                            <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                            <div class="information-featured">
                                <p class="info-featured">
                                    by <a href="#">MAL_editing_team</a>
                                </p>
                                <div class="tag-minute-featured">
                                    <a href="#" class="normal-tag">Theory</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="featured">
                        <a href="#" class="img-featured">
                            <img src="<?php echo base_url(); ?>assets/public/img/articel-right3.jpeg">
                        </a>
                        <div class="detail-featured">
                            <span class="detail-featured-number">3.</span>
                            <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                            <div class="information-featured">
                                <p class="info-featured">
                                    by <a href="#">MAL_editing_team</a>
                                </p>
                                <div class="tag-minute-featured">
                                    <a href="#" class="normal-tag">Theory</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="featured">
                        <a href="#" class="img-featured">
                            <img src="<?php echo base_url(); ?>assets/public/img/articel-right2.jpeg">
                        </a>
                        <div class="detail-featured">
                            <span class="detail-featured-number">4.</span>
                            <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                            <div class="information-featured">
                                <p class="info-featured">
                                    by <a href="#">MAL_editing_team</a>
                                </p>
                                <div class="tag-minute-featured">
                                    <a href="#" class="normal-tag">Theory</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="featured">
                        <a href="#" class="img-featured">
                            <img src="<?php echo base_url(); ?>assets/public/img/articel-right3.jpeg">
                        </a>
                        <div class="detail-featured">
                            <span class="detail-featured-number">5.</span>
                            <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                            <div class="information-featured">
                                <p class="info-featured">
                                    by <a href="#">MAL_editing_team</a>
                                </p>
                                <div class="tag-minute-featured">
                                    <a href="#" class="normal-tag">Theory</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="featured">
                        <a href="#" class="img-featured">
                            <img src="<?php echo base_url(); ?>assets/public/img/articel-right1.jpeg">
                        </a>
                        <div class="detail-featured">
                            <span class="detail-featured-number">6.</span>
                            <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                            <div class="information-featured">
                                <p class="info-featured">
                                    by <a href="#">MAL_editing_team</a>
                                </p>
                                <div class="tag-minute-featured">
                                    <a href="#" class="normal-tag">Theory</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="featured">
                        <a href="#" class="img-featured">
                            <img src="<?php echo base_url(); ?>assets/public/img/articel-right2.jpeg">
                        </a>
                        <div class="detail-featured">
                            <span class="detail-featured-number">7.</span>
                            <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                            <div class="information-featured">
                                <p class="info-featured">
                                    by <a href="#">MAL_editing_team</a>
                                </p>
                                <div class="tag-minute-featured">
                                    <a href="#" class="normal-tag">Theory</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="featured">
                        <a href="#" class="img-featured">
                            <img src="<?php echo base_url(); ?>assets/public/img/articel-right3.jpeg">
                        </a>
                        <div class="detail-featured">
                            <span class="detail-featured-number">8.</span>
                            <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                            <div class="information-featured">
                                <p class="info-featured">
                                    by <a href="#">MAL_editing_team</a>
                                </p>
                                <div class="tag-minute-featured">
                                    <a href="#" class="normal-tag">Theory</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="featured">
                        <a href="#" class="img-featured">
                            <img src="<?php echo base_url(); ?>assets/public/img/articel-right1.jpeg">
                        </a>
                        <div class="detail-featured">
                            <span class="detail-featured-number">9.</span>
                            <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                            <div class="information-featured">
                                <p class="info-featured">
                                    by <a href="#">MAL_editing_team</a>
                                </p>
                                <div class="tag-minute-featured">
                                    <a href="#" class="normal-tag">Theory</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="featured">
                        <a href="#" class="img-featured">
                            <img src="<?php echo base_url(); ?>assets/public/img/articel-right2.jpeg">
                        </a>
                        <div class="detail-featured">
                            <span class="detail-featured-number">10.</span>
                            <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                            <div class="information-featured">
                                <p class="info-featured">
                                    by <a href="#">MAL_editing_team</a>
                                </p>
                                <div class="tag-minute-featured">
                                    <a href="#" class="normal-tag">Theory</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="featured-side-block">
                <div class="header">
                    <p>Interview</p>
                    <a href="#">More..</a>
                </div>	
                <ul class="featured-list">
                    <li class="featured">
                        <a href="#" class="img-featured">
                            <img src="<?php echo base_url(); ?>assets/public/img/articel-right1.jpeg">
                        </a>
                        <div class="detail-featured">
                            <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                            <div class="information-featured">
                                <p class="info-interview">
                                    by <a href="#">OG.Fear</a>
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="featured">
                        <a href="#" class="img-featured">
                            <img src="<?php echo base_url(); ?>assets/public/img/articel-right2.jpeg">
                        </a>
                        <div class="detail-featured">
                            <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                            <div class="information-featured">
                                <p class="info-interview">
                                    by <a href="#">oldMan</a>
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="featured">
                        <a href="#" class="img-featured">
                            <img src="<?php echo base_url(); ?>assets/public/img/articel-right3.jpeg">
                        </a>
                        <div class="detail-featured">
                            <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                            <div class="information-featured">
                                <p class="info-interview">
                                    by <a href="#">Luffy D'monkey</a>
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="featured">
                        <a href="#" class="img-featured">
                            <img src="<?php echo base_url(); ?>assets/public/img/articel-right2.jpeg">
                        </a>
                        <div class="detail-featured">
                            <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                            <div class="information-featured">
                                <p class="info-interview">
                                    by <a href="#">MAL_editing_team</a>
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="featured">
                        <a href="#" class="img-featured">
                            <img src="<?php echo base_url(); ?>assets/public/img/articel-right3.jpeg">
                        </a>
                        <div class="detail-featured">
                            <a href="#" class="detail-featured-title">Top 25 Best Romance Anime of All Time</a>
                            <div class="information-featured">
                                <p class="info-interview">
                                    by <a href="#">Dude</a>
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="default-side">
                <!--bannner-->
                <div class="banner banner-news">
                    <a href="#" target="_self">
                        <img src="<?php echo base_url(); ?>assets/public/img/banner2.png" alt="banner" class="img-responsive" />
                        <h4>What is she</h4>
                    </a>
                </div>

                <!-- social -->
                <div class="social-network">
                    <ul class="list-unstyled">
                        <li>
                            <a href="#" target="_self">
                                <div class="link"><i class="fa fa-facebook"></i></div>
                            </a>
                            <p class="text-con">50K</p>
                        </li>
                        <li>
                            <a href="#" target="_self">
                                <div class="link"><i class="fa fa-twitter"></i></div>
                            </a>
                            <p class="text-con">1K</p>
                        </li>
                        <li>
                            <a href="#" target="_self">
                                <div class="link"><i class="fa fa-instagram"></i></div>
                            </a>
                            <p class="text-con">30K</p>
                        </li>
                    </ul>
                </div>

                <div class="link-bottom">
                    <ul class="list-unstyled">
                        <li><a href="#">Advertise</a></li>
                        <li><a href="#">Contacts</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="">Terms</a></li>
                    </ul>
                    <p class="text-center copyright">Copyright © All Rights Reserved
                </div>
            </div>
        </div>

    </div>
</div>
