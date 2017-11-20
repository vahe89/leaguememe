<meta charset="utf-8"/>
<style>
    div.background-cover {
        display: none;
    }
</style>

<?php
?>
<section style="background-color:#eee;" id="single_post">
    <div class="container no-padding">
        <div class="single-panel single-panel-view" style="margin-top: 90px;" >
            <div class="col-md-8 col-sm-12 no-padding">

                <div class="col-md-12 col-xs-12 no-padding">

                    <div class="col-md-9 col-xs-9 no-padding">
                        <div class="media info-avatar avatar-view">
                            <div class="media-left">
                                <img class="media-object avatar img-circle" src="<?php echo base_url(); ?>assets/public/img/default_profile.jpeg" alt="profile pic">
                            </div>
                            <div class="media-body">

                                <h5 class="text-uppercase">Admin</h5>

                            </div>
                        </div>
                    </div> 
                </div>

                <!--avatar -->
                <div class="col-md-12 wraper-view">


                    <h3 style="padding-left: 0px;"><a href="javascript:void(0);"><?php echo $patch_data['title']; ?></a></h3>



                    <div style="margin-left: 2%;"><?php echo $patch_data['description'] ?></div> 


                </div>
                <!-- wraper-view -->


            </div>

            <div class="col-md-4 col-sm-12 ads-view">
                <?php
                echo $this->load->view('template/right_sidebar');
                ?>
            </div>

        </div>
    </div>
</section>



