<section id="body_area">
    <div class="container">
        <div class="row">
            <div class="index-body">
                <?php
                echo $this->load->view('template/sidebar_list');
                ?>
                <div class="col-sm-9 col-lg-10 pad-right-0 ">
                    <ul class="animemoment">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Animemoment <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">View 1</a></li>
                                <li><a href="#">View 2</a></li>
                                <li><a href="#">View 3</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!--<input type="text" name="league_search" class="form-control pull-right" placeholder="Search">-->
                    <form action="<?php echo base_url(); ?>tag" id="search_form_name" method="post">
                        <input type="text" name="search" id="search" class="form-control pull-right" placeholder="Search">
                    </form>
                    <input type="hidden" name="tag_names" id="tag_names" value="<?php echo $tag_league_name; ?>"/>
                    <div class="content_and_sidebar_area ">
                        <div class="row">
                            <div class="col-md-12 col-lg-7 col-sm-12 pad-right-0 pad-left-0 ">
                                <div class="content">
                                    <div class="tab-content">

                                        <div role="tabpanel" class="tab-pane fade in active" id="tag_list">
                                            <!-- list league tags  -->
                                            <div id="league_tag_list">

                                            </div> 
                                            <div class="animation_image" style="display:none;background: #F9FFFF;border: 1px solid #E1FFFF;padding: 10px;width: 500px;margin-right: auto;margin-left: auto;" align="center"><img src="<?php echo base_url(); ?>assets/public/images/ajax-loader.gif"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-11 col-lg-4 col-sm-12 col-sm-offset-1 pad-left-0 pad-right-0">
                                <div class="right-sidebar hidden-xs hidden-sm font-play">
                                    <div id="sidebar_youtube">
                                        <!--<a href="#"><img class="box-lg img-responsive" src="<?php //echo base_url();       ?>assets/public/img/photo-lg.jpg" alt=""></a>-->
                                        <?php
                                        if (count($youtube) > 0) {
                                            ?>
                                            <div class="video-responsive"><?php echo $youtube->url; ?></div><br/>

                                        <?php } else {
                                            ?>
                                            <div>
                                                <a href="http://www.youtube.com/baroonpartyhat" target="_blank"> 
                                                    <img class="box-lg img-responsive" src="<?php echo base_url(); ?>assets/public/images/youtube.png" alt="youtube"></a> 
                                            </div>
                                            <br/>
                                        <?php }
                                        ?>
                                    </div>
                                    <ul class="list-inline social hidden-xs">
                                        <li><a href="#"><img src="<?php echo base_url(); ?>assets/public/img/facebook.png" class="img-responsive" alt="facebook"></a></li>
                                        <li><a href="#"><img src="<?php echo base_url(); ?>assets/public/img/tweeter.png" class="img-responsive" alt="twitter"></a></li>
                                        <li><a href="#"><img src="<?php echo base_url(); ?>assets/public/img/instagram.png" class="img-responsive" alt="instagran"></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var tagname = $('#tag_names').val();
    var totalData = <?php echo $total_rows; ?>;
    var track_load = 1; //total loaded record group(s)
    var loading = false; //to prevents multipal ajax loads
    var total_groups = "<?php echo $total_groups ?>"; //total record group(s)
    list_tag_leagues();
    function list_tag_leagues() {
        $.ajax({
            type: "POST",
            url: base_url + 'public/leaguelist/list_tag_leagues',
            data: {
                tags: tagname,
                total_data: totalData
            },
            success: function (msg) {
                if (msg == "home")
                {
                    // window.location.href = "<?php //echo base_url();  ?>home";

                    var html_msg = '<strong><h2><u style="color:red">' + tagname + '</u> Tag Name Not Found</h2></strong>' +
                            '<a href="<?php echo base_url(); ?>home"><button class="btn btn-primary">Go to Home</button></a>';

                    $('#league_tag_list').html(html_msg);
                }
                else {
                    $('#league_tag_list').html(msg);
                }
            }
        });
    }

    $(document).ready(function () {

        $('#search').on('keypress', function (event) {
            if (event.which == 13) {
                $('#search_form_name').submit();
            }
        });

        $(window).scroll(function () { //detect page scroll

            if ($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
            {
                if (track_load <= total_groups - 1 && loading == false) //there's more data to load
                {
                    loading = true; //prevent further ajax loading
                    $('.animation_image').show(); //show loading image
                    $.ajax({
                        type: "POST",
                        url: base_url + 'public/leaguelist/list_tag_scroll',
                        data: {group_no: track_load, tags: tagname},
                        success: function (msg) {
                            $('#league_tag_list').append(msg);
                            //console.log(msg);
                            $('.animation_image').hide(); //hide loading image once data is received
                            track_load++; //loaded group increment
                            loading = false;
                        }
                    });
                }
            }
        });
    });
</script>
<!--<script src="<?php //echo base_url();                  ?>assets/public/js/home.js" type="text/javascript"></script>-->
<script src="<?php echo base_url(); ?>assets/public/js/league.js" type="text/javascript"></script>

<!--<script src="<?php //echo base_url();                        ?>assets/public/js/livestamp.min.js" type="text/javascript"></script>-->



