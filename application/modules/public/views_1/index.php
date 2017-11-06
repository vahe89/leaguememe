<!--<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=1494694630834052";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>-->
<style>
    .affix{
        top: -20px;

    }
</style>
<section id="body_area">
    <div class="container">
        <div class="row">
            <div class="index-body">
                <?php
                echo $this->load->view('template/sidebar_list');
                ?>
                <?php
                $message = $this->session->flashdata('message');
                if ($message != '') {

                    if ($message === "regis_false") {
                        ?>
                        <center>
                            <div class="alert alert-danger alert-dismissable" style="width: 40%">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                <strong>
                                    <?php echo "Registration is not successfull"; ?>
                                </strong>
                            </div>
                        </center>
                        <?php
                    } else {
                        ?>
                        <center>
                            <div class="alert alert-success alert-dismissable" style="width: 40%">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                <strong>
                                    <?php echo $message; ?>
                                </strong>
                            </div>
                        </center>
                        <?php
                    }
                }
                ?>
                <div class="col-sm-9 col-lg-10 pad-right-0 ">
                    <ul class="animemoment">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">Leaguememes <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">View 1</a></li>
                                <li><a href="#">View 2</a></li>
                                <li><a href="#">View 3</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form action="<?php echo base_url(); ?>tag" id="search_form_name" method="post">
                        <input type="text" name="search" id="search" class="form-control pull-right"
                               placeholder="Search">
                    </form>
                    <div class="content_and_sidebar_area ">
                        <div class="row">
                            <div class="col-md-12 col-lg-7 col-sm-12 pad-right-0 pad-left-0 ">
                                <div class="content">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active tabs">
                                            <a href="#newTab" aria-controls="popular" id="popular" role="tab" data-toggle="tab"><b>Popular</b></a>
                                        </li>
                                        <li role="presentation" class="tabs"><a href="#newTab" id="new"
                                                                                aria-controls="new" role="tab"
                                                                                data-toggle="tab"><b>New</b></a></li>
                                        <li class="dropdown pull-right">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                               aria-haspopup="true" aria-expanded="false"><b id="freshVal">FRESH</b>
                                                <span class="caret"></span></a>
                                            <ul class="dropdown-menu font-play" id="subTabData">
                                                <!--                                                <li class="subTab active" id="9"><a class="active" id="1" href="javascript:void(0);">All the Things</a></li>
                                                                                                <li class="subTab" id="6"><a id="2" href="javascript:void(0);">Video</a></li>
                                                                                                <li class="subTab" id="0"><a id="3" href="javascript:void(0);">Random</a></li>
                                                                                                <li class="subTab" id="5"><a id="4" href="javascript:void(0);">Art</a></li>-->
                                            </ul>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="newTab">
                                            <!-- list league home  -->
                                            <div id="league_list_home">

                                            </div>
                                            <div class="animation_image" style="display:none;background: #F9FFFF;border: 1px solid #E1FFFF;padding: 10px;width: 500px;margin-right: auto;margin-left: auto;" align="center">
                                                <img src="<?php echo base_url(); ?>assets/public/images/ajax-loader.gif">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-11 col-lg-4 col-sm-12 col-sm-offset-1 pad-left-0 pad-right-0"   >
                                <div class="right-sidebar hidden-xs hidden-sm font-play"  >

                                    <div>
                                        <?php
                                        if (count($side_links) > 0) {
                                            $total_sidelink = count($side_links);
                                            for ($i = 0; $i < $total_sidelink; $i++) {
                                                ?>
                                                <?php
                                                if ($i % 7 == 0) {
                                                    ?>
                                                    <div class="row" style="margin-top:7%;margin-bottom:8%">
                                                        <div class="col-xs-12 col-sm-12 col-md-12 google-ad-rt">
                                                            <script type="text/javascript">(function () {
                                                                    var ref = '';
                                                                    var cachebuster = Math.round(Math.random() * 100000);
                                                                    try {
                                                                        if (window.top === window.self) {
                                                                            ref = window.location.href;
                                                                        } else if (window.top === parent || ref === '') {
                                                                            ref = document.referrer;
                                                                        }
                                                                    } catch (ignore) {
                                                                    }
                                                                    document.write('<scr' + 'ipt type="text/javascript" src="http://ib.adnxs.com/ttj?id=5029272&referrer=' + encodeURIComponent(ref) + '&cb=' + cachebuster + '"></scr' + 'ipt>');
                                                                })();</script>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                                <a href="<?php echo base_url() . $side_links[$i]['leagueimage_id']; ?>" ><img
                                                        src="<?php echo base_url(); ?>uploads/league/<?php echo $side_links[$i]['leagueimage_filename']; ?>"
                                                        class="box-sm img-responsive sideinfo" alt="">

                                                    <p><?php echo $side_links[$i]['leagueimage_name']; ?></p></a>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div id="myScrollspy">
                                        <div data-spy="affix" data-offset-top="2005">
                                            <div class="row" style="margin-top:7%;margin-bottom:8%" >
                                                <!--<h1>helloo</h1>-->
                                                <div class="col-xs-12 col-sm-12 col-md-12 google-ad-rt">
                                                    <script type="text/javascript">(function () {
                                                            var ref = '';
                                                            var cachebuster = Math.round(Math.random() * 100000);
                                                            try {
                                                                if (window.top === window.self) {
                                                                    ref = window.location.href;
                                                                } else if (window.top === parent || ref === '') {
                                                                    ref = document.referrer;
                                                                }
                                                            } catch (ignore) {
                                                            }
                                                            document.write('<scr' + 'ipt type="text/javascript" src="http://ib.adnxs.com/ttj?id=5029272&referrer=' + encodeURIComponent(ref) + '&cb=' + cachebuster + '"></scr' + 'ipt>');
                                                        })();</script>
                                                </div>
                                            </div>
                                            <ul class="list-inline hidden-xs set_a" >
                                                <script>(function (d, t) {
                                                        var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
                                                        g.src = "//x.instagramfollowbutton.com/follow.js";
                                                        s.parentNode.insertBefore(g, s);
                                                    }(document, "script"));</script>
                                                <script>!function (d, s, id) {
                                                        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                                                        if (!d.getElementById(id)) {
                                                            js = d.createElement(s);
                                                            js.id = id;
                                                            js.src = p + '://platform.twitter.com/widgets.js';
                                                            fjs.parentNode.insertBefore(js, fjs);
                                                        }
                                                    }(document, 'script', 'twitter-wjs');</script>

                                                <!--                                        <li><div class="fb-like" data-href="http://www.facebook.com/parthuphotography" data-width="200" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div></li>
                                                                                        <li><a href="https://twitter.com/mayur8189" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @mayur8189</a></li>
                                                                                        <li><span class="ig-follow" data-id="112877a633" data-handle="parthu.1404" data-count="true" data-size="large" data-username="true"></span></li>-->
                                                <li><a href="https://www.facebook.com/LeagueMemes"><img
                                                            src="<?php echo base_url(); ?>assets/public/img/facebook.png"
                                                            class="img-responsive" alt="facebook"></a></li>
                                                <li><a href="https://twitter.com/mayur8189"><img
                                                            src="<?php echo base_url(); ?>assets/public/img/tweeter.png"
                                                            class="img-responsive" alt="twitter"></a></li>
                                                <li><a href="http://instafollow.in/widgets/instagram/"><img
                                                            src="<?php echo base_url(); ?>assets/public/img/instagram.png"
                                                            class="img-responsive" alt="instagran"></a></li>
                                            </ul>
                                        </div>
                                    </div>
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

    
$(document).keyup(function(e) {
                    
        if (e.which === 27) { // escape key maps to keycode `27`
//        alert(e.which);
        $(".cpylink").hide(); 
//       $(".cpylink").val("");
    }
}); 

    $(document).ready(function () {

        var mainTab = "popular";
        var subTabs;
        var subTabValue = "All the Things";
        var track_load = 1; //total loaded record group(s)
        var loading = false; //to prevents multipal ajax loads
        var total_groups; //total record group(s)

        list_league(mainTab, subTabValue);
        $('#freshVal').text("All The Things");
        $.ajax({
            type: "POST",
            url: base_url + 'public/home/get_sub_tab_data',
            success: function (msg) {
                $('#subTabData').html(msg);
            }
        });
        $('.tabs').each(function () {
            var data = $(this).children().attr('id');
            $('#' + data).click(function () {
                mainTab = $(this).attr('id');
                list_league(mainTab, subTabValue);
            });
        });

        setTimeout(function () {
//          alert('hi');

            $(".cpylink").hide();
            $('.subTab').each(function () {
                var subids = $(this).children().attr('id');
                var subclass = $('#' + subids).attr('class');
                if (subclass == "active") {
                    subTabs = subids;
                    subTabValue = $('#' + subids).parent().attr('id');
                }
                $('#' + subids).bind('click', function () {
                    $('#' + subTabs).removeClass('active');
                    $('#' + subTabs).parent().removeClass('active');
                    $(this).addClass('active');
                    $(this).parent().addClass('active');
                    subTabs = subids;
                    subTabValue = $('#' + subids).parent().attr('id');
                    $('#freshVal').text($(this).text());
                    list_league(mainTab, subTabValue);
                });
            });
            $('.js-textareacopybtn').each(function () {
                var id = $(this).attr('id');

                $('#' + id).bind('click', function (e) {
                    var leagueid = id.split('_');
                    var selectorid = "#copytext_" + leagueid[1];
                    var copyTextarea = document.querySelector(selectorid);
                    $(selectorid).show();
                    copyTextarea.select();
                    try {
                        var successful = document.execCommand('copy');
                        $('#copy_user_msg').show(1000);
                        $('#copy_user_msg').hide(10000);
                    } catch (err) {
                        //console.log('Oops, unable to copy');
                    }
                    $('#copytext_' + leagueid[1]).css({top: 100, 'z-index': '100', 'left': 180});
                   
                });
                
            });
        }, 2000);
 
        function list_league(mainTab, subTabValue) {
            $.ajax({
                type: "POST",
                url: base_url + 'public/leaguelist/list_league',
                data: {main: mainTab, sub: subTabValue},
                success: function (msg) {
                    track_load = 1;
                    // console.log(msg);
                    $('#league_list_home').html(msg);
                    total_groups = $('.total_groups').val();
                }
            });
        }


        $(window).scroll(function () { //detect page scroll
            $('.js-textareacopybtn').each(function () {
                var id = $(this).attr('id');
                $('#' + id).bind('click', function () {
                    var leagueid = id.split('_');
                    var selectorid = "#copytext_" + leagueid[1];
                    $(selectorid).show();
                    var copyTextarea = document.querySelector(selectorid);
                    copyTextarea.select();
                    try {
                        var successful = document.execCommand('copy');
                        $('#copy_user_msg').show(1000);
                        $('#copy_user_msg').hide(10000);
                    } catch (err) {
                        //         console.log('Oops, unable to copy');
                    }

                });
            });
            if ($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
            {
                if (track_load <= total_groups && loading == false) //there's more data to load
                {
                    loading = true; //prevent further ajax loading
                    $('.animation_image').show(); //show loading image
                    $.ajax({
                        type: "POST",
                        url: base_url + 'public/leaguelist/list_scroll_data',
                        data: {group_no: track_load, main: mainTab, sub: subTabValue},
                        success: function (msg) {
                            $('#league_list_home').append(msg);
                            $('.animation_image').hide(); //hide loading image once data is received
                            track_load++; //loaded group increment
                            loading = false;
                        }
                    });
                }
            }
        });

        $('#search').on('keypress', function (event) {
            if (event.which == 13) {
                $('#search_form_name').submit();
            }
        });
    });
</script>
<!--<script src="<?php //echo base_url();                        ?>assets/public/js/home.js" type="text/javascript"></script>-->
<script src="<?php echo base_url(); ?>assets/public/js/league.js" type="text/javascript"></script>

<!--<script src="<?php //echo base_url();                              ?>assets/public/js/livestamp.min.js" type="text/javascript"></script>-->



