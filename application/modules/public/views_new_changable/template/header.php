<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="<?php echo base_url(); ?>assets/public/images/favicon-96x96.png" type="image/png">

        <title><?php echo (isset($meta_title)) ? $meta_title : 'Leaguememe'; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="description" content="<?php echo (isset($meta_desc)) ? $meta_desc : 'Leaguememe'; ?>"/>
        <meta name="keywords" content="<?php echo (isset($meta_keywords)) ? $meta_keywords : 'Leaguememe'; ?>"/>
        <meta name="author" content="LeaguaMeme.com "/>
        <?php
        $actual_link = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        ?> 
        <?php
        if (isset($league_details[0]) && !empty($league_details[0])) {
            ?>         
            <meta property = "og:description" content = "Entertainment legends" />
            <meta property = "og:title" content = "<?php echo $league_details[0]->leagueimage_name; ?>" />
            <meta property = "og:url" content = "<?php echo $actual_link; ?>" />
            <meta property="fb:app_id" content="428116147382282" /> 
            <!--<meta property="og:image" content="<?php echo base_url(); ?>uploads/league/<?php echo $league_details[0]->leagueimage_filename; ?>" />-->

            <?php
            $filename = $league_details[0]->leagueimage_filename;
            $extention = pathinfo($filename, PATHINFO_EXTENSION);
            if ($extention) {
                ?>        
                <meta property="og:image" content="<?php echo base_url(); ?>uploads/league/<?php echo $league_details[0]->leagueimage_filename; ?>" />
                <meta property="og:image:width" content="200" />
                <meta property="og:image:height" content="200" />
                <?php
            } elseif (empty($league_details[0]->videoname)) {
                ?>
                <meta property="og:image" content="<?php echo base_url(); ?>uploads/league/<?php echo $league_details[0]->leagueimage_filename; ?>" />
                <meta property="og:image:width" content="200" />
                <meta property="og:image:height" content="200" />
                <?php
            } else {
                ?>
                <meta property="og:video"             content="<?php echo base_url(); ?>uploads/league/mp4/<?php echo $league_details[0]->videoname; ?>" />
                <meta property="og:video:secure_url"  content="<?php echo base_url(); ?>uploads/league/mp4/<?php $league_details[0]->videoname; ?>" />
                <meta property="og:video:type"        content="video/mp4" />
                <meta property="og:video:width"       content="822" />
                <?php
            }
        } else {
            ?>
            <meta property = "og:description" content = "Entertainment legends" />
            <meta property = "og:title" content = "Leaguememe-League of Legends Entertainment" />
            <meta property = "og:url" content = "<?php echo $actual_link; ?>" />
            <?php
        }
        ?>
        <script>
            var base_url = '<?php echo base_url(); ?>';
        </script>


        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>assets/public/css/bootstrap.css" rel="stylesheet">

        <!-- Custom styles -->
        <link href="<?php echo base_url(); ?>assets/public/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/public/css/helper.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/public/css/hack.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/public/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/public/css/pop-up.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/public/css/responsive.css" rel="stylesheet">
        <!--<link href="<?php echo base_url(); ?>assets/public/css/jquery-ui.min.css" rel="stylesheet">-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/public/css/dropzone.css">


        <!--Date Picker -->               
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/datepicker/datepicker3.css">


        <!--<script src="<?php echo base_url(); ?>assets/public/js/jquery-2.0.2.min.js"></script>-->
        <script src="https://code.jquery.com/jquery-2.0.2.js" integrity="sha256-0u0HIBCKddsNUySLqONjMmWAZMQYlxTRbA8RfvtCAW0=" crossorigin="anonymous"></script>

        <!-- Google Font -->
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

        <!--////////////////////////////                        footer               ///////////////////////////////////-->  


        <!-- Bootstrap core JavaScript
      ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/autosize.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/trigger.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/jquery.leanModal.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/pop-up.js"></script>

        <!-- DataTables -->
        <script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>


        <!-- datepicker -->
        <script src="<?php echo base_url(); ?>assets/admin/plugins/datepicker/bootstrap-datepicker.js"></script>

        <script src="<?php echo base_url(); ?>assets/admin/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>

        <script>
            autosize(document.querySelectorAll('textarea'));
            $('#myTabs a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
            })

            $('#pop a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
            })

            $(document).ready(function () {
                $('input[type="checkbox"]').click(function () {
                    if ($(this).attr("value") == "credit") {
                        $(".credit").toggle();
                    }
                });
            });

            function changeText(idElement) {
                if ($('#credit' + idElement).text() === 'Credit') {
                    $('#credit' + idElement).parent().children().eq(1).removeClass('fb-1');
                    $('#credit' + idElement).parent().children().eq(1).addClass('show-social');
                    $('#credit' + idElement).text('Dian Khisma wijaya');
                } else {
                    $('#credit' + idElement).parent().children().eq(1).removeClass('show-social');
                    $('#credit' + idElement).parent().children().eq(1).addClass('fb-1');
                    $('#credit' + idElement).text('Credit');
                }
            }

        </script>

        <script>
            // calculate and set .draggable width

            $.fn.draggable_nav_calc = function (options) {
                return this.each(function (i) {
                    var $element = $(this);
                    if ($element.is(":visible")) {
                        // x or y
                        if (options.axis === "x") {
                            // calculate
                            var navWidth = 1;
                            $element.find("> *").each(function (i) {
                                navWidth += $(this).outerWidth(true);
                            });
                            // set width
                            var parentWidth = $element.parent().width();
                            if (navWidth > parentWidth) {
                                $element.css("width", navWidth);
                            } else {
                                $element.css("width", parentWidth);
                            }
                        } else if (options.axis === "y") {
                            // calculate
                            var navHeight = 1;
                            $element.find("> *").each(function (i) {
                                navHeight += $(this).outerHeight(true);
                            });
                            // set height
                            var parentHeight = $element.parent().width();
                            if (navHeight > parentHeight) {
                                $element.css("height", navHeight);
                            } else {
                                $element.css("height", parentHeight);
                            }
                        }
                    }
                });
            };

            // check inside bounds

            $.fn.draggable_nav_check = function () {
                return this.each(function (i) {
                    var $element = $(this);
                    // calculate
                    var w = $element.width();
                    var pw = $element.parent().width();
                    var maxPosLeft = 0;
                    if (w > pw) {
                        maxPosLeft = -(w - pw);
                    }
                    var h = $element.height();
                    var ph = $element.parent().height();
                    var maxPosTop = 0;
                    if (h > ph) {
                        maxPosTop = h - ph;
                    }
                    // horizontal
                    var left = parseInt($element[0].style.left);
                    if (left > 0) {
                        $element.css("left", 0);
                    } else if (left < maxPosLeft) {
                        $element.css("left", maxPosLeft);
                    }
                    // vertical
                    var top = parseInt($element[0].style.top);
                    if (top > 0) {
                        $element.css("top", 0);
                    } else if (top < maxPosTop) {
                        $element.css("top", maxPosTop);
                    }
                });
            };

            // init draggable nav

            $.fn.draggable_nav = function (options) {
                return this.each(function (i) {
                    var $element = $(this);
                    // calculate first time, after delay to fix resize bugs
                    window.setTimeout(function (e) {
                        $element.draggable_nav_calc(options);
                    }, 100);
                    // on shown tabs recalculate
                    $element.find('[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                        $element.draggable_nav_calc(options);
                    });
                    // on resize recalculate
                    function draggable_nav_resize_after() {
                        clearTimeout($element.data("draggable_nav_timeout"));
                        var timeout = window.setTimeout(function (e) {
                            $element.draggable_nav_calc(options);
                            $element.draggable_nav_check();
                        }, 0);
                        $element.data("draggable_nav_timeout", timeout);
                    }
                    $(window).on('resize', draggable_nav_resize_after);
                    $(window).on('scroll', draggable_nav_resize_after);
                    // center clicked element
                    if ($element.hasClass("draggable-center")) {
                        $element.find('li a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
                            var $container = $(this).parents(".draggable-container");
                            var $li = $(this).parents("li");
                            if (options.axis === "x") {
                                var left = -$li.position().left + $container.outerWidth() / 2 - $li.outerWidth() / 2;
                                $element.css("left", left);
                            } else if (options.axis === "y") {
                                var top = -$li.position().top + $container.outerWidth() / 2 - $li.outerWidth() / 2;
                                $element.css("top", top);
                            }
                            // put inside bounds
                            $element.draggable_nav_check();
                        });
                    }
                });
            };
            $(".draggable").draggable_nav({
                axis: 'x' // only horizontally
            });

            // jquery ui draggable

            $(".draggable").draggable({
                axis: 'x', // only horizontally
                drag: function (e, ui) {
                    var $element = ui.helper;
                    // calculate
                    var w = $element.width();
                    var pw = $element.parent().width();
                    var maxPosLeft = 0;
                    if (w > pw) {
                        maxPosLeft = -(w - pw);
                    }
                    var h = $element.height();
                    var ph = $element.parent().height();
                    var maxPosTop = 0;
                    if (h > ph) {
                        maxPosTop = h - ph;
                    }
                    // horizontal
                    if (ui.position.left > 0) {
                        ui.position.left = 0;
                    } else if (ui.position.left < maxPosLeft) {
                        ui.position.left = maxPosLeft;
                    }
                    // vertical
                    if (ui.position.top > 0) {
                        ui.position.top = 0;
                    } else if (ui.position.top < maxPosTop) {
                        ui.position.top = maxPosTop;
                    }
                }
            });

            // jquey draggable also on touch devices
            // http://stackoverflow.com/questions/5186441/javascript-drag-and-drop-for-touch-devices

            function touchHandler(e) {
                var touch = e.originalEvent.changedTouches[0];
                var simulatedEvent = document.createEvent("MouseEvent");
                simulatedEvent.initMouseEvent({
                    touchstart: "mousedown",
                    touchmove: "mousemove",
                    touchend: "mouseup"
                }[e.type], true, true, window, 1,
                        touch.screenX, touch.screenY,
                        touch.clientX, touch.clientY, false,
                        false, false, false, 0, null);
                touch.target.dispatchEvent(simulatedEvent);
            }

            function preventPageScroll(e) {
                e.preventDefault();
            }

            function initTouchHandler($element) {
                $element.on("touchstart touchmove touchend touchcancel", touchHandler);
                $element.on("touchmove", preventPageScroll);
            }
            initTouchHandler($(".draggable"));
        </script>

        <script>
            function toggler(divId) {
                $("#" + divId).toggle();
            }
        </script>

        <script>
            $(document).ready(function () {
                $('input[type="checkbox"]').click(function () {
                    if ($(this).attr("value") == "credit") {
                        $(".credit").toggle();
                    }
                });
            });
        </script>

    </head>

    <body>

        <!-- Modal Login-->
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="<?php echo base_url(); ?>assets/public/img/close.png" alt="close" />
                    </button>
                    <div class="modal-header bor-none">
                        <h2 class="modal-title mar-t-40" id="myModalLabel">Login to Your Account</h2>
                        <p class="grey-color-xs">You can connect with a social network</p>
                        <div class="connect-social">
                            <div class="col-md-5">
                                <div class="wrap-fb pull-right">
                                    <div class="connect-l-fb">
                                        <i class="fa fa-facebook"></i>
                                    </div>
                                    <div class="connect-r-fb">
                                        Facebook
                                    </div>
                                </div>
                            </div>
                            <!-- end col-md-6 -->
                            <div class="col-md-2">
                                <div class="center-block">
                                    <span class="circles">OR</span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="wrap-gp pull-left">
                                    <div class="connect-l-gp">
                                        <img src="<?php echo base_url(); ?>assets/public/img/gplus.png" alt="">
                                    </div>
                                    <div class="connect-r-gp">
                                        Google
                                    </div>
                                </div>
                            </div>
                            <!-- end col-md-6 -->
                        </div>
                        <!-- connect social -->
                    </div>
                    <!-- end modal header-->

                    <div class="modal-footer">
                        <p class="text-left black-col">Login with your Email Address</p>
                        <form>
                            <div class="form-group text-left">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                            </div>
                            <div class="form-group text-left">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                <p class="text-right link-log">Forgot the password?</p>
                            </div>
                            <button type="submit" class="btn btn-login-green pull-left">Login</button>
                            <div class="clearfix"></div>
                            <p class="link-log text-left">Didn’t have an account? <a href="#">Sign up</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->

        <!-- modal report -->
        <div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="assets/public/img/close.png" alt="close" />
                    </button>
                    <div class="modal-header bor-none">
                        <h2 class="modal-title title-report" id="myModalLabel">Report Post</h2>
                        <p class="question-report">What do you report this post for?</p>

                        <div class="radio">
                            <input id="copyright" type="radio" name="AccountType" value="male">
                            <label for="copyright" class="radio-report">Contains a trademark or copyright violation</label>

                            <input id="spam" type="radio" name="AccountType" value="male">
                            <label for="spam" class="radio-report">Spam, blatant advertising, or solicitation</label>

                            <input id="porn" type="radio" name="AccountType" value="male">
                            <label for="porn" class="radio-report">Contains offensive materials/nudity</label>

                            <input id="repost" type="radio" name="AccountType" value="male">
                            <label for="repost" class="radio-report">Repost of another post on 9GAG</label>
                        </div>

                        <div class="form-group wrap-input-url">
                            <input type="text" class="report-url" placeholder="http://dev.leaguememe.com">
                            <a href="#" class="btn btn-green" type="submit">Submit</a>
                        </div>
                    </div>
                    <!-- end modal header-->
                </div>
            </div>
        </div>
        <!-- end modal -->
