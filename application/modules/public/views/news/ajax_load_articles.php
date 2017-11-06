<?php
if (isset($action) && !empty($action)) {
    if ($action == 1) {
        $error = "No Data Found..!";
    } else {
        $error = "";
    }
} else {
    $error = "";
}

function get_words($sentence, $count) {
    preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
    return $matches[0];
}

if (isset($article_data)) {
    if (count($article_data) > 0) {
        foreach ($article_data as $article) {
            $date = date_create($article['created_date']);
            ?>
            <div class="news-articel col-md-12 col-sm-12 col-xs-12 latest_article">
                <div class="news-articel-left" >
                    <a href="<?= base_url(); ?>news-detail/<?= $article['article_id'] ?>" class="image-link">
                        <img src="<?php echo base_url(); ?>uploads/articles/<?= $article['article_image'] ?>" style="width:200px;height: 100px;" >
                    </a>
                </div>
                <div class="news-articel-right ">
                    <p class="title-articel">
                        <a href="<?= base_url(); ?>news-detail/<?= $article['article_id'] ?>" class="title-articel-link"><?php echo $article['article_name'] . " - " . date_format($date, "F Y"); ?> </a>

                    </p>
                    <div class="text-articel">
                        <?php
                        $string = strip_tags($article['article_description']);
                        if (str_word_count($string) > 150) {

                            // truncate string
                            $stringCut = get_words($string, 150);

                            // make sure it ends in a word so assassinate doesn't become ass...
                            $string = $stringCut . ' <a href="' . base_url() . 'news-detail/' . $article['article_id'] . '" style="color:#b83c54">...Read More</a>';
                        }
                        echo $string;
                        ?> 

                    </div>
                    <div class="information-articel">
                        <p class="info">
                            by <a href="javascript:void(0);">Admin</a>
                        </p>
                        <p class="view">
                            <?php echo $article['article_views'] ?> views
                        </p>
                        <div class="tag-minute-thumb">
                            <?php
                            $tagstyle = explode(",", $article['tag_style']);
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
                            <?php if ($article['spoiler'] == 1) { ?>
                                <a href="#" class="red-tag">Spoiler</a>
                            <?php } ?>
                        </div>
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