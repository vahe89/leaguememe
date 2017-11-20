 
<div classs="row">
    <div class="col-md-12 wrap-main">

        <?php
        if (count($league_details) > 0 && !empty($league_details)) {
             $k = 0;
            $divider = $perPage; 
            foreach ($league_details as $anim_img) {
                if (!empty($anim_img)) {
                    
                    ?>
                    <!--wrapper avatar-->
                    <div class="wrapper-avatar ">
                        <input type="hidden" class="season_total_groups" value="<?=$total_groups?>">
                        <div class="media info-avatar">
                            <div class="media-left">
                                <a href="javascript:void(0);">
                                    <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>assets/public/img/admin.png" alt="profile pic">
                                </a>
                            </div>
                            <div class="media-body w-2000">
                                <a  href="javascript:void(0);" ><h5> Admin </h5></a>

                                <div class="col-md-12 no-padding">
                                    <span class="minute" style="display: inline" ></span>
                                </div>

                            </div>


                        </div>
                        <h3> 

                        </h3>  
                        <a   class="image1" href="javasript:void(0)"> 
                            <img id="image1" class = "img-responsive meme-big" src="<?php echo base_url(); ?>uploads/backup/images/<?php echo $anim_img['leagueimage_filename']; ?>"  >
                        </a> 

                    </div>

                    <!-- wrapper avatar -->



                    <?php
              $k++;   
                      if (stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")) { // if mobile browser
                    if ($k % $divider == 0) {
                        ?>
                        <div align="center" class="Ad_google">
                              <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Automatic Responsive LM Boxes -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9746555787553362"
     data-ad-slot="5203425452"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
                        <?php
                    }
                }
                }
            }
        } else {
            ?>
            <div> 
                <div class="alert alert-danger">
                    <strong>Oops!</strong> No Image found  
                </div>
            </div>
            <?php
        }
        ?>

    </div>

    <!--end col-md-12-->

</div>  
