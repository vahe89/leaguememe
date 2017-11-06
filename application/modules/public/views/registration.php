<?php error_reporting(0); ?>
<div class="container no-padding">
    <div class="single-panel panel-login-page" style="margin-top: 90px;">
        <div class="modal-header bor-none">
            <h2 class="modal-title mar-t-40" id="myModalLabel" style="text-align: center;">Sign Up With Us</h2>
            <p class="grey-color-xs" style="text-align: center;">You can connect with a social network</p>
            <div class="connect-social social-hide-res">
                <div class="col-md-5 col-xs-12">
                    <a href="<?= base_url() . 'public/loginfacebook' ?>">
                        <div class="wrap-fb pull-right">
                            <div class="connect-l-fb">
                                <i class="fa fa-facebook"></i>
                            </div>
                            <div class="connect-r-fb">
                                Facebook
                            </div>
                        </div>
                    </a>
                </div><!-- end col-md-6 -->
                <div class="col-md-2">
                    <div class="center-block">
                        <span class="circles cricles-page-signup">OR</span>
                    </div>
                </div>
                <div class="col-md-5 col-xs-12">
                    <a href="<?= base_url() . 'public/logingoogle' ?>">
                        <div class="wrap-gp pull-left">
                            <div class="connect-l-gp">
                                <img src="<?php echo base_url(); ?>assets/public/img/gplus.png" alt="">
                            </div>
                            <div class="connect-r-gp">
                                Google
                            </div>
                        </div>
                    </a>
                </div><!-- end col-xs-12 -->
            </div><!-- connect social -->

            <div class="connect-social social-show-res">
                <div class="col-xs-12 no-padding bottom-connect">
                    <a href="<?= base_url() . 'public/loginfacebook' ?>">
                        <div class="wrap-fb pull-right">
                            <div class="connect-l-fb">
                                <i class="fa fa-facebook"></i>
                            </div>
                            <div class="connect-r-fb">
                                Facebook
                            </div>
                        </div>
                    </a>
                </div><!-- end col-md-6 -->

                <div class="col-xs-12 no-padding bottom-connect">
                    <a href="<?= base_url() . 'public/logingoogle' ?>">
                        <div class="wrap-gp pull-left">
                            <div class="connect-l-gp">
                                <img src="<?php echo base_url(); ?>assets/public/img/gplus.png" alt="">
                            </div>
                            <div class="connect-r-gp">
                                Google
                            </div>
                        </div>
                    </a>
                </div><!-- end col-xs-12 -->

                <div class="col-xs-12">
                    <div class="center-block">
                        <span class="circles cricles-page-signup">OR</span>
                    </div>
                </div>
            </div><!-- connect social -->
        </div><!-- end modal header-->

        <div class="modal-footer">
            <form class="mar-t-20" action="<?php echo base_url(); ?>public/user/sign_up" method="post" name="sign" id="register1">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group text-left">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" id="username1" placeholder="Username" name="username">
                            <div id="usermsg1" style="color:#F00"  class="alert_style"> <?php echo form_error('username'); ?> </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group text-left">
                            <label for="exampleInputEmail1">Email Address</label>
                            <input type="email" id="email1" class="form-control"  placeholder="Email" name="email">
                            <div id="emailmsg1" style="color:#F00"  class="alert_style"> <?php echo form_error('email'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group text-left">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password">
                            <div style="color:#F00" class="alert_style"><?php echo form_error('password'); ?> </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group text-left">
                            <label for="exampleInputPassword1">Repeat Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password" name="passconf">
                            <div id="passconf1" style="color:#F00" class="alert_style"> <?php echo form_error('passconf'); ?> </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-login-green btn-res pull-left">Sign up</button>
                <div class="clearfix"></div>
                <p class="link-log text-left">Have an account? <a href="login.html">Login</a></p> 
            </form>
        </div>
    </div>
</div>
