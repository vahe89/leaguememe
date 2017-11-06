<div class="panel panel-default pad-12" style="max-height: 285px;overflow: auto;">
    <div class="helpful-title">
        <?php echo $text; ?>
    </div>
    <ul class="helpful">
        <?php
 
        foreach ($anime_list as $value) {
            ?>
            <li>
                <span class="name-helpful"><?php echo empty($value['name']) ? $value['user_name'] : $value['name']; ?></span>
                <span class="count-helpful"><?php echo $value['total_review']; ?></span>
            </li>
            <?php
        }
        ?>


    </ul>
</div>