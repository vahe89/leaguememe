<?php
if (isset($article_top_view_pages)) {
    if (count($article_top_view_pages) > 0) {
        foreach ($article_top_view_pages as $key =>$art_top_views) {
            $key++;
            ?>
            <li class="featured">
                <a href="<?= base_url(); ?>news-detail/<?= $art_top_views['article_id'] ?>" class="img-featured">
                    <img src="<?php echo base_url(); ?>uploads/articles/<?= $art_top_views['article_image'] ?>" style="width:50px;height:50px">
                </a>
                
                <div class="detail-featured">

                    <a href="<?= base_url(); ?>news-detail/<?= $art_top_views['article_id'] ?>" class="detail-featured-title"><?= $key ?>.<?= empty($art_top_views['article_name']) ? 'N/A' : $art_top_views['article_name'] ?></a>
                    <br>
                    <div class="information-featured">
                        <p class="info-featured">
                            by <a href="#">Admin</a>
                        </p>
                        <div class="tag-minute-featured">
                            <a href="#" class="normal-tag">Theory</a>
                        </div>
                    </div>
                </div>
            </li>
            <?php
        }
    } else {
        echo "No Data Found..!";
    }
} else {
    echo "No Data Found..!";
}
?>
