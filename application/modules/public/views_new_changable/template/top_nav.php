
  <!-- Static navbar -->
  <nav class="navbar navbar-custom navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">
          <img src="<?php echo base_url();?>assets/public/img/logo-simple.png" alt="logo" />
        </a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav menu">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Discussion<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a class="res-caption-nav" href="#">Action</a></li>
              <li><a class="res-caption-nav" href="#">Another action</a></li>
              <li><a class="res-caption-nav" href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header separator-nav">Nav header</li>
              <li><a class="res-caption-nav" href="#">Separated link</a></li>
              <li><a class="res-caption-nav" href="#">One more separated link</a></li>
            </ul>
          </li>
          <li><a href="third-page.html">Anime</a></li>
          <li><a href="#contact">News</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right menu">
          <li class="hide-search-res">
            <a href="#" data-toggle="collapse" data-target="#search-collapse">
              <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </a>
          </li>
          <li class="search-res">
            <input type="text" class="search-query mac-style" placeholder="Search">
            <button type="submit" class="btn btn-search-res"><i class="glyphicon glyphicon-search"></i></button>
          </li>

          <li class="upload-triger">
            <a data-toggle="modal" href="#" data-target="#login" class="btn btn-green">Login</a>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </nav>
  
  <!-- Search box -->
  <div id="search-collapse" class="collapse" style="position: absolute; right: 213px;">
    <div class="container no-padding">
      <div class="input-group pull-right w-form-search">
        <input type="text" class="form-control" name="test" placeholder="Search for snippets and hit enter" style="height: 40px;">
      </div>
    </div>
  </div>
  <!-- Search Box -->

  <!-- Background Cover -->
  
  <!-- end background-cover -->


<div class="col-md-12 tab-top no-padding">
    <div class="container">
        <div class="row">
            <div class="draggable-container">
                <ul class="nav nav-tabs draggable draggable-center" role="tablist">
                    <li role="presentation" class="active"><a href="#moment" aria-controls="home" role="tab" data-toggle="tab">Anime Moment</a></li>
                    <li role="presentation"><a href="#other" aria-controls="profile" role="tab" data-toggle="tab">Other Tab</a></li>
                </ul>
            </div>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="moment">
                    <div class="non-res">
                        <div class="left-panel-sec white-bg">

                            <div class="wrap-panel">
                                <div class="title">
                                    <p>NEWS</p>
                                </div>
                                <div class="content-panel">
                                    <ul class="list-unstyled">
                                        <li><a href="">LINK 1</a>
                                        </li>
                                        <li><a href="">LINK 2</a>
                                        </li>
                                        <li><a href="">LINK 3</a>
                                        </li>
                                        <li><a href="">LINK 4</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end wrap-panel-->

                            <div class="wrap-panel uns-list">
                                <div class="title">
                                    <p>RECENT DISCUSSION</p>
                                </div>
                                <div class="content-panel">
                                    <ul class="list-unstyled">
                                        <li><a href="">ONE PIECE</a>
                                        </li>
                                        <li><a href="">NARUTO</a>
                                        </li>
                                        <li><a href="">DORAEMON</a>
                                        </li>
                                        <li><a href="">BLEACH</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end wrap-panel-->

                            <div class="wrap-panel uns-list">
                                <div class="title">
                                    <p>LIKES</p>
                                </div>
                                <div class="content-panel">
                                    <ul class="list-unstyled">
                                        <li><a href="">ONE PIECE</a>
                                        </li>
                                        <li><a href="">NARUTO</a>
                                        </li>
                                        <li><a href="">DORAEMON</a>
                                        </li>
                                        <li><a href="">BLEACH</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end wrap-panel-->

                            <div class="wrap-panel uns-list">
                                <div class="title">
                                    <p>GROUP</p>
                                </div>
                                <div class="content-panel">
                                    <ul class="list-unstyled">
                                        <li><a href="">ONE PIECE</a>
                                        </li>
                                        <li><a href="">NARUTO</a>
                                        </li>
                                        <li><a href="">DORAEMON</a>
                                        </li>
                                        <li><a href="">BLEACH</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end wrap-panel-->
                        </div>









<!--<body id="body_id" xmlns="http://www.w3.org/1999/html" data-spy="scroll" data-target="#myScrollspy" data-offset="15">

    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-30586739-1', 'auto');
        ga('send', 'pageview');

    </script>

    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function () {
            FB.init({
                appId: '428116147382282',
                xfbml: true,
                version: 'v2.5'
            });
        };
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <section id="header_area">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="col-sm-1 pad-right-0 pad-left-0">
                    <div class="navbar-header">
                           <button class="navbar-toggle pull-left toggle-butt-1 collapsed" data-toggle="collapse" data-target="#bs-leftbar-collapse">
                              <img src="img/logo.png" alt="logo">
                          </button> 

                        <?php
                        if (isset($username) && !empty($username)) {
                            ?>
                            <button class="navbar-toggle  collapsed nonborder toggle-butt-2" data-toggle="collapse" data-target="#bs-profile-collapse">
                                <span class="profile">Profile</span>
                            </button>
                            <?php
                        } else {
                            ?>
                            <button type="button" id="login_modal" class="btn btn-default btn-upload navbar-toggle"   data-toggle="modal" data-target="#login-modal">Login</button>
                            <?php
                        }
                        ?>
                        <button class="navbar-toggle collapsed toggle-butt-3" data-toggle="collapse"
                                data-target="#bs-navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <?php
                        if (isset($username) && !empty($username)) {
                            ?>
                            <button type="button" class="btn btn-default btn-upload navbar-toggle " data-toggle="modal"
                                    data-target="#upmodel">Upload
                            </button>
                            <?php
                        } else {
                            ?>
                            <button type="button" class="btn btn-default btn-upload navbar-toggle" style="cursor: pointer"
                                    data-toggle="modal" data-target="#myModal">Sign Up
                            </button>
                            <?php
                        }
                        ?>

                        <a href="<?php echo base_url(); ?>" class="navbar-brand "><img
                                src="<?php echo base_url(); ?>assets/public/images/Layer-1.png" alt=""></a>
                    </div>
                </div>

                <div class="collapse text-center" id="bs-profile-collapse">
                    <div class="leftbar">
                        <div class="single-sidebar">
                            <div class="row">

                                <div class="col-sm-7 font-play">

                                    <ul class="list-unstyled">
                                        <li><a href="#"><i class="fa fa-bell-o"></i> Notifications </a></li>
                                        <li><a href="#">Edit profile</a></li>
                                        <li><a href="<?php echo base_url(); ?>user/change_pswd">Change Password</a></li>
                                        <li><a href="<?php echo base_url(); ?>user/logout">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="collapse navbar-collapse text-center" id="bs-navbar-collapse">
                    <div class="col-sm-7 col-lg-push-1">
                        <ul class="nav navbar-nav navbar_1">
                            <li><a href="#">Discusson</a></li>
                            <li><a href="#">Patch notes</a></li>
                            <li><a href="#">News</a></li>
                            <li><a href="#">Celendar</a></li>
                            <li><a href="#">Merchandise</a></li>
                        </ul>
                    </div>

                    <div
                        class="col-sm-6 col-lg-4 col-md-4 col-md-offset-0 col-lg-push-1 col-lg-push-1 col-md-push-0 pull-right pad-right-0 hidden-xs">
                        <div class="col-sm-5 col-lg-3 col-md-4 col-md-offset-1 col-lg-push-1 col-lg-push-0 col-md-push-0 pull-right pad-right-0 hidden-xs">
                        <ul class="nav navbar-nav navbar_2 text-center">
                            <li><a class="search" href="javascript:void(0);"><img
                                        src="<?php echo base_url(); ?>assets/public/images/Zoom.png" alt=""></a></li>
                            <li><a class="notification" href="#"><i class="fa fa-bell-o"></i></a></li>
                            <li class="dropdown">
                                <?php
                                if (isset($username) && !empty($username)) {
                                    ?>
                                                                    <a href = "<?php echo base_url(); ?>user/profile" class = "username" role = "button" ><?php echo $username; ?></a>
                                    <a href="#" class="dropdown-toggle username" data-toggle="dropdown" role="button"
                                       aria-haspopup="true" aria-expanded="false"> <?php echo $username; ?> <span
                                            class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Edit Profile</a></li>
                                        <li><a href="<?php echo base_url(); ?>user/change_pswd">Change Password</a></li>
                                        <li><a href="<?php echo base_url(); ?>user/logout">Logout</a></li>
                                    </ul>
                                    <?php
                                } else {
                                    ?>
                                    <a href="<?php echo base_url(); ?>user/login" class="username" role="button" >Login</a>
                                    <a href="javascript:void(0);" id="login_modal" style="cursor: pointer"
                                       data-toggle="modal" data-target="#login-modal">Login</a>
                                       <?php
                                   }
                                   ?>

                            <a href="#" class="dropdown-toggle username" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login <span class="caret"></span></a>
                                                                  <ul class="dropdown-menu">
                                                                    <li><a href="#">View 1</a></li>
                                                                    <li><a href="#">View 2</a></li>
                                                                    <li><a href="#">View 3</a></li>
                                                                  </ul>
                            </li>
                            <?php
                            if (isset($username) && !empty($username)) {
                                ?>
                                <li>
                                    <button type="button" class="btn btn-default btn-upload" data-toggle="modal"
                                            data-target="#upmodel">Upload
                                    </button>
                                </li>
                                <?php
                            } else {
                                ?>
                                <li>
                                    <button type="button" class="btn btn-default btn-upload" style="cursor: pointer"
                                            data-toggle="modal" data-target="#myModal">Sign Up
                                    </button>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </section>
    upload  Modal 


     upload url 
    <div class="modal fade" id="urlmodal" role="dialog">
        <div class="modal-dialog">

             Modal content
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Choose from URL</h4>
                </div>
                <div class="modal-body">
                    <p>Type url </p>

                    <form>
                        <input type="text" class="form-control" placeholder="http://www.example.com/upload/meme.jpg">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#upmodel" id="upmodal">
                        Back
                    </button>
                    <button type="button" class="btn btn-default" id="clsurl" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <form action="<?php echo base_url(); ?>user/login" method="post" id="user_llogin">
        <div class="modal fade " id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">


                <div class="modal-content">

                    <div class="modal-header ">

                        <button type="button" class="close" id="login_close_btn" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        <h2 id="myModalLabel">Login to Your Account</h2>

                        <div class="form-group ">
                            <h5>You can connect with a social network</h5>
                            <Center>
                                <ul class='list-inline'>
                                    <li>
                                        <a href="<?= base_url() . 'loginfacebook' ?>" class="btn btn-default facebook"> <i
                                                class="fa fa-facebook modal-icons"></i> Facebook </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url() . 'logingoogle' ?>" class="btn btn-default google"> <i
                                                class="fa fa-google-plus modal-icons"></i> Google+ </a>
                                    </li>
                                </ul>
                            </Center>
                        </div>
                        <div id='center-line'> OR</div>
                    </div>

                    <div class="modal-body login-modal">
                        <p style="font-weight: bold;margin:11px 2px 15px 1px !important;">Log in with your Email Address</p>

                        <div class="form-group">
                            <lable>Username</lable>
                            <input type="text" id="username" placeholder="Enter your user name" name="username"
                                   <?php if (isset($_COOKIE['username'])) { ?>value="<?= $_COOKIE['username']; ?>"<?php } ?>
                                   class="form-control login-field">
                                <i class="fa fa-user login-field-icon"></i>
                                <label class="error" for="username"
                                       generated="true"><?php echo form_error('username'); ?></label>
                        </div>
                        <div class="form-group">
                            <lable>Password</lable>
                            <input type="password" id="login-pass" placeholder="Password" name="password"
                                   <?php if (isset($_COOKIE['password'])) { ?>value="<?= $_COOKIE['password']; ?>"<?php } ?>
                                   class="form-control login-field">
                                <i class="fa fa-lock login-field-icon"></i>

                                <?php
                                if (isset($msg)) {
                                    echo "<h5 style='color:red'>$msg</h5>";
                                }
                                ?>
                        </div>
                        <button type="submit" class="btn btn-default btn-upload">LOG IN</button>
                        <p class='pull-right'>
                            <a href="javascript:void(0);" id="forget" data-toggle="modal" data-target="#forgetmodel"
                               style='font-size:16px'>Lost your password?</a>
                        </p>

                        <div class="form-group" style='margin-top:5%;font-weight:bold;font-size:16px;'>
                            <a href="javascript:void(0);" id="regi_model" style="cursor: pointer;color:#B5314E"
                               data-toggle="modal" data-target="#myModal">New User Please Register</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
        </div>
    </form>


     Modal 
    <div class="modal fade" id="forgetmodel" role="dialog">
        <div class="modal-dialog">

             Modal content
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Forgot Password</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="forgot_password">
                        <div id="forgot" style="display:none">

                            <p align="center" id="for_error22"
                               style="display:none; float:left;padding-left:20px; color:#F00" class="alert_style">Invalid
                                Email !</p>

                            <p align="center" id="change_pass"
                               style="display:none; float:left;padding-left:20px; color:#F00;" class="alert_style">Reset
                                password link has been sent to your mail id. </p>

                            <p align="center" id="email_error"
                               style="display:none; float:left;padding-left:20px; color:#F00;" class="alert_style">Please
                                enter valid mail. </p>

                            <div class="clear"></div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email" name="email" id="email">

                                    <div id="forgotemail" style="color:#F00" class="alert_style"></div>
                            </div>

                            <div class="form-group forgot">
                                <label>
                                    <button type="submit" class="btn btn-default pull-left" id="click_forgot">Submit
                                    </button>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog ">

             Modal content
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="form-group">
                        <h2>Sign Up With Us</h2>

                        <div class="form-group ">
                            <h5>You can connect with a social network</h5>
                            <Center>
                                <ul class='list-inline'>
                                    <li>
                                        <a href="<?= base_url() . 'loginfacebook' ?>" class="btn btn-default facebook"> <i
                                                class="fa fa-facebook modal-icons"></i> Facebook </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url() . 'logingoogle' ?>" class="btn btn-default google"> <i
                                                class="fa fa-google-plus modal-icons"></i> Google+ </a>
                                    </li>
                                </ul>
                            </Center>
                        </div>
                        <div id='center-line'> OR</div>
                    </div>
                </div>
                <form action="<?php echo base_url(); ?>user/reg" method="post" name="sign" id="register">
                    <div class="modal-body">
                        <?php
                        if (isset($msg)) {
                            echo "<h5 style='color:red'>$msg</h5>";
                        }
                        ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" placeholder="Username" class="form-control " id="fullname"
                                           name="fullname">

                                        <div id="usermsg" style="color:#F00"
                                             class="alert_style"> <?php echo form_error('fullname'); ?> </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" placeholder="Email" class="form-control  " id="email" name="email">

                                        <div id="emailmsg" style="color:#F00"
                                             class="alert_style"> <?php echo form_error('email'); ?></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" placeholder="Password" class="form-control  " id="password"
                                           name="password">

                                        <div style="color:#F00" class="alert_style"><?php echo form_error('password'); ?> </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Repeat Password</label>
                                    <input type="password" class="form-control required" placeholder="Conform Password"
                                           id="passconf" name="passconf">

                                        <div id="passconf" style="color:#F00"
                                             class="alert_style"> <?php echo form_error('passconf'); ?> </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <div class="g-recaptcha  " id="captcha"
                                         data-sitekey="6Lf2shITAAAAAHQFqV9V3e_0fesNbOqC6XHXaook"></div>
                                    <div id="captchamsg" style="color:#F00" class="alert_style"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>Server</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" value="NA" checked>
                                            North America: </label>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" value="EUW">
                                            Europe West: </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" value="EUNE">
                                            Europe Nordis - East: </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" value="OCE">
                                            Oceania: </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" value="RU">
                                            Russian: </label>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" value="TR">
                                            Turkish: </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" value="BR">
                                            Brazil: </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" value="LAS">
                                            Latin America (South): </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group forgot">
                                <label class="inline">
                                    <button type="submit" class="btn btn-default btn-upload" name="submit" id="submitt">Sign
                                        In
                                    </button>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <button type="hidden" class="btn btn-default btn-upload" style="display: none" data-toggle="modal" id="pick_load"
            data-target="#pickload">Upload
    </button>
    <button type="hidden" class="btn btn-default btn-upload" style="display: none" data-toggle="modal" id="image_upload"
            data-target="#imageload">Upload
    </button>

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="<?php echo base_url(); ?>assets/public/js/dropzone.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/public/js/login.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/public/js/registration.js" type="text/javascript"></script>


    <div class="modal fade" id="upmodel" role="dialog">
        <div class="modal-dialog">

             Modal content
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" id="url_close" data-dismiss="modal">&times;</button>
                    <h1 class="modal-title"> Upload Post</h1>

                    <p>Choose how you want to upload your post</p>

                    <div id="upload_alert" style="display: none" class="text-center alert alert-danger"></div>
                </div>
                <div class="modal-body">
                    <div class="upload-popup" id="upload-popup">
                        <div class="col-sm-12" id="file_upload"></div>

                        <div class="drag col-sm-12">

                            <form action="#" id="uploadform" class="dropzone col-sm-12">
                                <i class="fa fa-cloud-upload fa-4x" style="margin-top:11%;"></i>
                                <p>Choose or drag your Photo Here</p>
                            </form>
                        </div>
                        <div class="col-sm-12">
                            <div id="wait" style="display:none;width:69px;height:89px;margin-left:43%;"><img
                                    src='<?php echo base_url(); ?>assets/public/images/ajax-loader.gif' width="64"
                                    height="64"/><br><strong class="text">Uploading...</strong></div>
                        </div>
                        <div class="chooseURL col-sm-5" data-toggle="modal" data-target="#urlmodal" id="urlmodal1">
                            <i class="fa fa-globe fa-2x"></i>

                            <p>Choose from URL</p>
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="chooseAlbum col-sm-5">
                            <i class="fa fa-picture-o fa-2x"></i>

                            <p>Choose from Album</p>
                        </div>
                        <a class="hidepopup" href="javascript:HidePopup('upload-popup')"><span class="glyphicon glyphicon-remove"></span></a>

                    </div>
                </div>
                <div class="modal-footer" style="border: none"></div>

            </div>

        </div>
    </div>


    <div class="modal fade" id="imageload" role="dialog">
        <div class="modal-dialog">

             Modal content
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" id="image_url_close" data-dismiss="modal">&times;</button>
                    <h1>Give your Post A Title</h1>

                    <p>An accurate, discriptive title can help people discover your post</p>

                    <div id="alert" style="display: none" class="text-center alert alert-danger"></div>
                </div>

                <div class="modal-body">
                    <div class="img-title-form col-sm-12">

                        <input type="hidden" id="img_name" name="img_name">
                            <img id="img" name="img" src=""  style="width:150px;height: 150px; "   alt="">

                                <input type="text" id="upload_title" name="upload_title" placeholder="Give a Title Here..." style="padding:12% 0 12% 0;">
                                <label class="error" for="upload_title" generated="true"><?php echo form_error('upload_title'); ?></label>
                                    <textarea class="form-control desc" id="tag"  rows="2" placeholder="Describe your post with tags!" onkeypress="handle(event);"></textarea>
                                    <textarea style="display: none" class="form-control desc" id="tag2"  rows="2" ></textarea>
                                <label class="error" for="tag" generated="true"><?php echo form_error('tag'); ?></label>
                                    <ul class=" list-inline" id='tag1'>
                                        <li><div class="tag" > <a href="javascript:void();" title=""   id="btRemove"><i class="fa fa-remove"></i></a> </div></li>
                                        <li><div class="tag"><a href="" ><i class="fa fa-remove"></i></a> </div></li>
                                        <li><div class="tag">abcd<a href=""><i class="fa fa-remove"></i></a> </div></li>
                                    </ul>

                                    <span id="league_count">150</span>
                                    </div>
                                    <ul class="list-unstyled firstul">
                                        <li>
                                            <p class="title-form-desc">This post is Not Safe for work</p>
                                            <input type="checkbox" class="pull-right clearfix" id="not_safe" name="not_safe"   >
                                        </li>
                                        <li class="secondli" id="safe" style="display: inline-block">
                                            <p class="title-form-desc" >Credit the author</p>
                                            <input type="checkbox" class="pull-right clearfix" id="credit_author" name="credit_author">
                                                <ul class="list-inline author" style="display: none;" >
                                                    <li onclick="facebook_link();" style="height: 50px;width: 60px;"><img src="<?php echo base_url(); ?>assets/public/images/FaceBook.png" class="img-responsive" ></li>
                                                    <li onclick="twitter_link();" style="height: 50px;width: 60px;"><img src="<?php echo base_url(); ?>assets/public/images/Twitter.png" class="img-responsive" ></li>
                                                    <li onclick="instagram_link();"style="height: 50px;width: 60px;"><img src="<?php echo base_url(); ?>assets/public/images/Instagram.png" class="img-responsive" ></li>
                                                </ul>
                                                <input type="text"  placeholder="http://" id="author" style="display: none" name="author" class="author">
                                                    </li>
                                                    </ul>
                                                    </div>

                                                    <div class="modal-footer" style="border:none">
                                                        <button type="button" class="btn btn-default btn-upload pull-right next" onclick="next_page();">NEXT
                                                        </button>
                                                        <button type="button" class="btn btn-default btn-upload pull-right back" data-toggle="modal"
                                                                data-target="#upmodel" id="image_close">BACK
                                                        </button>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>


                                                    <div class="modal fade" id="pickload" role="dialog">
                                                        <div class="modal-dialog">

                                                             Modal content
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" id="pick_url_close" data-dismiss="modal">&times;</button>
                                                                    <h1>Pick A Section</h1>

                                                                    <p>Submitting to the right section to make sure your post gets the right exposure it deserves!</p>

                                                                    <div id="cat_alert" style="display: none" class="text-center alert alert-danger"></div>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" id="image_name" name="image_name">
                                                                        <input type="hidden" id="not_safe" name="not_safe">
                                                                            <input type="hidden" id="credit_author" name="credit_author">
                                                                                <input type="hidden" id="title" name="title">

                                                                                    <div class="section">
                                                                                        <ul class="list-unstyled" id="category_list">

                                                                                        </ul>
                                                                                    </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-default btn-upload pull-right next" onclick="save_category();">
                                                                                            SAVE
                                                                                        </button>
                                                                                        <button type="button" class="btn btn-default btn-upload pull-right back" onclick="back_image_load();">
                                                                                            BACK
                                                                                        </button>
                                                                                    </div>
                                                                                    </div>

                                                                                    </div>
                                                                                    </div>
                                                                                    <script>

                                                                                        var cnt = 0;
                                                                                        function handle(e) {



                                                                                            if (e.which === 32) {
                                                                                                cnt = cnt + 1;
                                                                                                var x = $('#tag').val();
                                                                                                //            document.getElementById("tag2").innerHTML=x;
                                                                                                //            $("#tag1").html('<li><div class="tag" >' + x +' <a href="" ><i class="fa fa-remove"></i></a> </div></li>');
                                                                                                if (x !== "") {
                                                                                                    $("#tag1").append('<li id="tagg_' + cnt + '"><div class="tag" >' + x + '<a href="javascript:void();" title="' + cnt + '" id="btRemove"><i class="fa fa-remove"></i></a> </div></li>');

                                                                                                    $("#tag").val("");
                                                                                                    $("#tag2").append(x);
                                                                                                }

                                                                                                //            var x1 = $('#tag1').val();
                                                                                                //            alert(x1);
                                                                                                //            document.getElementById("tag2").innerHTML=x1;    
                                                                                            }
                                                                                            return false;

                                                                                        }
//                                                                                        $("#btRemove").click(function () {
////                                                                                            var id = $(this).attr('id');
////                                                                                            alert(id);
//                                                                                            var x1 = $('#tag2').val();
////                                                                                            alert(x1);
//                                                                                            if (cnt !== 0) {
//                                                                                                $('#tagg_' + cnt).remove();
//
//                                                                                                $("#tag2").remove(x1);
//                                                                                                cnt--;
//                                                                                            }
//                                                                                            return false;
//                                                                                        });
//                                                                                         $('#btRemove' + cnt).click(function () {
//                                                                                            if (cnt !== 0) {
//                                                                                                $('#tagg_' + cnt).remove();
//                                                                                                cnt = cnt - 1;
//                                                                                            }
//                                                                                            if (cnt === 0) {
//                                                                                                $("#tag1").
//                                                                                                        .empty()
//                                                                                                        .remove();
//
//
//                                                                                            }
//                                                                                        });

                                                                                    </script>
                                                                                    <script>

                                                                                        $(document).ready(function () {

                                                                                            var limit = 150;
                                                                                            var text_remaining;
                                                                                            $('#upload_title').keyup(function () {
                                                                                                var text_length = $('#upload_title').val().length;
                                                                                                //    alert(text_length);
                                                                                                text_remaining = limit - text_length;

                                                                                                if (text_remaining == 150) {
                                                                                                    $("#league_count").html('<span id=league_count' + '>150</span>');
                                                                                                } else {
                                                                                                    if (text_remaining >= 0)
                                                                                                        $("#league_count").html('<span id=league_count' + '>' + text_remaining + '</span>');
                                                                                                    else if (text_remaining < 0) {

                                                                                                        $("#league_count").html('<span id=league_count' + '><font color=red>' + text_remaining + '</font></span>');

                                                                                                    }
                                                                                                }
                                                                                            });

                                                                                            $('#credit_author').change(function () {
                                                                                                if ($(this).is(':checked')) {
                                                                                                    $(".author").show();
                                                                                                } else {
                                                                                                    $(".author").hide();
                                                                                                }
                                                                                            });

                                                                                            $(".dz-details").hide();

                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: base_url + 'public/home/get_image_upload_category',
                                                                                                success: function (msg) {
                                                                                                    $('#category_list').html(msg);
                                                                                                }
                                                                                            });

                                                                                            $('#image_upload').hide();
                                                                                            $('#pick_load').hide();
                                                                                            var flag = 0;

                                                                                            var myDropzone = new Dropzone("#uploadform");
                                                                                            myDropzone.on("addedfile", function (file) {

                                                                                                var formData = new FormData();
                                                                                                formData.append('file', file);
                                                                                                $("#alert").hide();
                                                                                                $("#img_name").val('');
                                                                                                $("#video_name").val('');
                                                                                                $("#tag").val('');
                                                                                                $("#upload_title").val('');
                                                                                                $("#author").val('');
                                                                                                $("#not_safe").attr('checked', false);
                                                                                                $("#credit_author").attr('checked', false);

                                                                                                $(document).ajaxStart(function () {
                                                                                                    $("#wait").css("display", "block");
                                                                                                });
                                                                                                $(document).ajaxComplete(function () {
                                                                                                    $("#wait").css("display", "none");
                                                                                                });
                                                                                                $("button").click(function () {
                                                                                                    $("#txt").load("demo_ajax_load.asp");
                                                                                                });


                                                                                                $.ajax({
                                                                                                    url: "<?php echo site_url(); ?>public/home/upload/",
                                                                                                    type: "POST",
                                                                                                    data: formData,
                                                                                                    async: false,
                                                                                                    dataType: 'json',
                                                                                                    success: function (msg) {
                                                                                                        if (msg.result == "success") {
                                                                                                            $("#wait").hide();
                                                                                                            $("#txt").hide();
                                                                                                            $("#img").attr('src', 'uploads/dump/' + msg.name);
                                                                                                            $("#img_name").val(msg.name);
                                                                                                            $("#video_name").val(msg.videoname);
                                                                                                            $('#url_close').trigger('click');
                                                                                                            $('#image_upload').trigger('click');
                                                                                                        }
                                                                                                        else if (msg.result == "error") {
                                                                                                            $("#upload_alert").show();
                                                                                                            $("#upload_alert").html('<strong>' + msg.msg + '</strong>');
                                                                                                        }
                                                                                                    },
                                                                                                    cache: false,
                                                                                                    contentType: false,
                                                                                                    processData: false
                                                                                                });
                                                                                                this.removeFile(file);
                                                                                            });

                                                                                            $("#image_close").click(function () {
                                                                                                $('#image_url_close').trigger('click');

                                                                                            });

                                                                                            $("#regi_model").click(function () {
                                                                                                // alert("hi");
                                                                                                $('#login_close_btn').trigger('click');
                                                                                            });
                                                                                            $("#urlmodal1").click(function () {
                                                                                                // alert("hi");
                                                                                                $('#url_close').trigger('click');
                                                                                            });
                                                                                            $("#upmodal").click(function () {
                                                                                                $('#clsurl').trigger('click');
                                                                                            });
                                                                                        });

                                                                                        function facebook_link()
                                                                                        {
                                                                                            $("#author").val("http://facebook.com/");
                                                                                        }

                                                                                        function twitter_link()
                                                                                        {
                                                                                            $("#author").val("https://twitter.com/");
                                                                                        }

                                                                                        function instagram_link()
                                                                                        {
                                                                                            $("#author").val("https://www.instagram.com/");
                                                                                        }


                                                                                        /*    $("#url_close").click(function(){
                                                                                         $("#upmodel").remove();
                                                                                         });*/


                                                                                        function back_upload() {
                                                                                            $("#imageload").remove();
                                                                                            $("#upmodal").trigger('click');
                                                                                        }

                                                                                        function next_page() {

                                                                                            var wordd = $("#league_count").text();
                                                                                            var title = $("#upload_title").val();
                                                                                            var author = $("#author").val();
                                                                                            var tag = $("#tag").val();

                                                                                            if ($("#not_safe").is(':checked')) {
                                                                                                var not_safe = 1;
                                                                                            }
                                                                                            else {
                                                                                                var not_safe = 0;
                                                                                            }


                                                                                            if ($("#credit_author").is(':checked')) {
                                                                                                var credit_author = 1;
                                                                                            }
                                                                                            else {
                                                                                                var credit_author = 0;
                                                                                            }

                                                                                            if (wordd > 0) {
                                                                                                $.ajax({
                                                                                                    url: '<?php echo site_url(); ?>public/home/upload_image_next',
                                                                                                    type: 'POST',
                                                                                                    data: {
                                                                                                        'title': title,
                                                                                                        'not_safe': not_safe,
                                                                                                        'credit_author': credit_author,
                                                                                                        'author': author,
                                                                                                        'tag': tag,
                                                                                                    },
                                                                                                    dataType: 'json',
                                                                                                    success: function (data) {
                                                                                                        if (data.result == "success") {
                                                                                                            $('#image_url_close').trigger('click');
                                                                                                            $('#pick_load').trigger('click');
                                                                                                        }
                                                                                                        else if (data.result == "error") {
                                                                                                            $("#alert").show();
                                                                                                            $("#alert").html('<strong>' + data.msg + '</strong>');
                                                                                                        }

                                                                                                    }
                                                                                                });
                                                                                            }
                                                                                        }
                                                                                        function save_category() {

                                                                                            var category = $("#pic_category:checked").val();
                                                                                            var title = $("#upload_title").val();
                                                                                            var description = $("#upload_description").val();
                                                                                            var image_name = $("#img_name").val();
                                                                                            var video_name = $("#video_name").val();
                                                                                            var tag = $("#tag2").val();
                                                                                            var author = $("#author").val();

                                                                                            if ($("#not_safe").is(':checked')) {
                                                                                                var not_safe = 1;
                                                                                            }
                                                                                            else {
                                                                                                var not_safe = 0;
                                                                                            }


                                                                                            if ($("#credit_author").is(':checked')) {
                                                                                                var credit_author = 1;
                                                                                            }
                                                                                            else {
                                                                                                var credit_author = 0;
                                                                                            }


                                                                                            $.ajax({
                                                                                                url: '<?php echo site_url(); ?>public/home/save_upload_image',
                                                                                                type: 'POST',
                                                                                                data: {
                                                                                                    'title': title,
                                                                                                    'description': description,
                                                                                                    'not_safe': not_safe,
                                                                                                    'credit_author': credit_author,
                                                                                                    'category': category,
                                                                                                    'image_name': image_name,
                                                                                                    'video_name': video_name,
                                                                                                    'tag': tag,
                                                                                                    'author': author,
                                                                                                },
                                                                                                dataType: 'json',
                                                                                                success: function (data) {
                                                                                                    if (data.result == "success") {
                                                                                                        $("#imageload").remove();
                                                                                                        $("#pickload").remove();
                                                                                                        window.location.href = '<?php echo base_url(); ?>';
                                                                                                    }
                                                                                                    else if (data.result == "error") {
                                                                                                        $("#cat_alert").show();
                                                                                                        $("#cat_alert").html('<strong>' + data.msg + '</strong>');
                                                                                                    }
                                                                                                }
                                                                                            });
                                                                                        }

                                                                                        function back_image_load() {
                                                                                            $('#alert').hide();
                                                                                            $('#cat_alert').hide();
                                                                                            $('#pic_category').attr('checked', false);
                                                                                            $('#pick_url_close').trigger('click');
                                                                                            $('#image_upload').trigger('click');

                                                                                        }

                                                                                    </script>

-->
