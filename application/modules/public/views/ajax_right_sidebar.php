<?php
if (count($side_links) > 0) {
    
    if ($sideadd == 'dtlPage') {

        if (count($side_links) <= 12) {
            $tot_count = count($side_links);
        } else {
            $tot_count = 12;
        }

        $divider = "6";
    } else {

        if (count($side_links) <= 28) {
            $tot_count = count($side_links);
        } else {
            $tot_count = 28;
        }

        $divider = "4";
    } ?>
    <div class="summary">
    <?php for ($i = 0; $i < $tot_count; $i++) {
        ?>
        <?php
        if ($i % $divider == 0) {
            ?>
            <?php if($i > 0) { ?></div><div class="summary"><?php } ?>
            <div class="banner">
                <!--<a href="#" target="_self">
                    <img src="<?php /*echo base_url(); */?>assets/public/img/asasa.png" alt="ads" style=""class="img-responsive" />
                </a>-->

               <!--  Leaguememe Right Side -->

               <ins class="adsbygoogle"
                     style="display:inline-block;width:300px;height:280px"
                     data-ad-client="ca-pub-9746555787553362"
                     data-ad-slot="1902005285"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>

            </div>
        <?php } ?>
        <div class="banner_cont">
            <div class="banner" style="display: block; overflow: hidden; ;  margin-bottom: 3px; background-color: rgb(244, 244, 244);height: 97px;" onmouseover="change_on_hover(<?= $side_links[$i]['leagueimage_id'] ?>, 1)" onmouseout="change_on_hover(<?= $side_links[$i]['leagueimage_id'] ?>, 0)">
                <a href="<?php echo base_url() . $side_links[$i]['leagueimage_id']; ?>" target="_self">

                    <img src="<?php echo base_url(); ?>uploads/league_resize/<?php echo $side_links[$i]['leagueimage_filename']; ?>" alt="banner" class="img-responsive" style="height:157px; display: block; border: 0px none; ; margin-top: -37px;"/>

                </a>
            </div>
            <div class="banner">
                <a href="<?php echo base_url() . $side_links[$i]['leagueimage_id']; ?>" target="_self" >
                    <h4 class="league_side_id_<?= $side_links[$i]['leagueimage_id'] ?>"><?php echo $side_links[$i]['leagueimage_name']; ?></h4>
                </a>

            </div>
        </div>

        <?php
    } ?>
</div>
<?php } ?>
