<?php
if (isset($action) && !empty($action)) {
    if ($action == 1) {
        $errors = "No Data Found..!";
    } else {
        $errors = "";
    }
} else {
    $errors = "";
}
if (isset($article_top_treading)) {
    if (count($article_top_treading) > 0) {
        foreach ($article_top_treading as $top_article) {
            $date_str = date_create($top_article['created_date']);
            ?> 
            <div class="col-md-6 wrap-news-thumb trending_articles">
                <figure>
                    <div class="wrap-thumb-img"  >
                        <a href="<?= base_url(); ?>news-detail/<?= $top_article['article_id'] ?>">
                            <img src="<?php echo base_url(); ?>uploads/articles/<?= $top_article['article_image'] ?>" style="width: 100%;height:220px"  >
                        </a>
                    </div>
                </figure>
                <div class="info-thumb">
                    <div class="title-thumb">
                        <a href="<?= base_url(); ?>news-detail/<?= $top_article['article_id'] ?>">
                            <?php
                            $article_description = $top_article['article_name'];
                            if (strlen($article_description) > 30) {
                                $article_description1 = substr($article_description, 0, 30) . '...';
                            } else {
                                $article_description1 = $article_description;
                            }
                            echo $article_description1;
                            ?> </a>
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
                         <?php
                            $tagstyle = explode(",", $top_article['tag_style']);
                            $tag_name = "THEORY";
                            $tag_color = "#dfdfdf";
                            if (!empty($tagstyle[0])) {
                                $tag_name = trim($tagstyle[0]);
                            }
                            if (!empty($tagstyle[1])) {
                                $tag_color = trim($tagstyle[1]);
                            }
                            ?>
                            <a href="#" class="normal-tag" style="border:1px solid <?= $tag_color ?>"><?= $tag_name ?></a> 
                        <?php if ($top_article['spoiler'] == 1) { ?>
                            <a href="#" class="red-tag">Spoiler</a>
                        <?php } ?> 
                    </div>
                </div>
            </div>
        <?php
        }
    } else {
        echo $error;
    }
} else {
    echo $error;
}
?>