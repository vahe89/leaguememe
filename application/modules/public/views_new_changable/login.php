
<section id="body_area">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12  ">
                <!-- <ul class="animemoment">
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Animemoment <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="#">View 1</a></li>
                            <li><a href="#">View 2</a></li>
                            <li><a href="#">View 3</a></li>
                          </ul>
                        </li>
                    </ul> -->

                <div class="clicked-body">
                    <form action="<?php echo base_url(); ?>tag" id="search_form_name" method="post">
                        <input type="text" name="search" id="search" class="form-control pull-right" placeholder="Search">
                    </form>
                    <div class="content_and_sidebar_area-clicked ">
                        <div class="row">
                            <div class="col-md-7 col-lg-7  col-sm-12 pad-right-0 pad-left-0 ">
                                <div class="content-clicked">
                                    <form  action="<?php echo base_url(); ?>user/login" method="post" id="user_llogin">
                                       <h2 id="myModalLabel">Login to Your Account</h2>
                                        <div class="form-group ">
                                            <h5>You can connect with a social network</h5>
                                            <Center>
                                            <ul class='list-inline'>
                                                <li>
                                                    <a href="<?= base_url() . 'loginfacebook' ?>" class="btn btn-default facebook"> <i class="fa fa-facebook modal-icons"></i>  Facebook </a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() . 'logingoogle' ?>" class="btn btn-default google"> <i class="fa fa-google-plus modal-icons"></i>  Google+ </a>
                                                </li>
                                            </ul>
                                            </Center>
                                        </div>
                                         <div id='center-line'> OR </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="username" name="username" placeholder="User Name" <?php if (isset($_COOKIE['username'])) { ?>value="<?= $_COOKIE['username']; ?>"<?php } ?> >
                                            <label class="error" for="username" generated="true"><?php echo form_error('username'); ?></label>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="password" placeholder="password" name="password" <?php if (isset($_COOKIE['password'])) { ?>value="<?= $_COOKIE['password']; ?>"<?php } ?>>
                                            <label class="error" for="password" generated="true"><?php echo form_error('password'); ?></label>
                                        <?php
                                        if (isset($msg)) {
                                            echo "<h5 style='color:red'>$msg</h5>";
                                        }
                                        ?>
                                        </div>
                                       
                                        <div class="form-group forgot" >
                                            <label class="inline">
                                                <button type="submit" class="btn btn-default" id="clickuser_log">Sign In</button>
                                                <label class="checkbox-inline"> <a href="#" id="forget">Forgot password?</a> </label>
                                            </label>

                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-11 col-sm-offset-1 col-lg-offset-1 pad-right-0">
                                <div class="right-sidebar-clicked hidden-xs hidden-sm font-play">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<script src="<?php echo base_url(); ?>assets/js/login.js" type="text/javascript"></script>