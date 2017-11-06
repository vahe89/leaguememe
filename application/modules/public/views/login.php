<?php error_reporting(0); ?>
<div class="container no-padding">
    <div class="single-panel panel-login-page" style="margin-top: 90px;">
        <div class="modal-header bor-none">
            <h2 class="modal-title mar-t-40" id="myModalLabel" style="text-align: center;">Login to Your Account</h2>
            <p class="grey-color-xs" style="text-align: center;">You can connect with a social network</p>
            <div class="connect-social ">
                <div class="wrap-socmed" style="width: 100%">
                    <div class="facebook-conect">
                        <img src="<?=  base_url()?>assets/public/img/fb-connect.png">
                        <span style="padding-left: 0px"> Facebook</span>
                        <a href="<?= base_url() . 'public/loginfacebook' ?>" class="btn btn-fb-connect"> Connect</a>
                    </div>
                </div>
                <div class="wrap-socmed" style="width: 100%">
                    <div class="facebook-conect">
                        <img src="<?=  base_url()?>assets/public/img/gplus-connect.png">
                        <span style="padding-left: 0px"> Google+</span>
                        <a href="<?= base_url() . 'public/logingoogle' ?>" class="btn btn-gplus-connect"> Connect</a>
                    </div>
                </div>
                 
                 
            </div><!-- connect social -->

             
        </div><!-- end modal header-->

        <div class="modal-footer">
            <p class="text-left black-col mar-t-10">Login with your Email Address</p>
            <form action="<?php echo base_url(); ?>public/user/login" method="post" id="user_llogin">
                <div class="form-group text-left">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text"  name="username" <?php if (isset($_COOKIE['username'])) { ?>value="<?= $_COOKIE['username']; ?>"<?php } ?> class="form-control" id="exampleInputEmail1" placeholder="Username" >
                    <label class="error" for="username" generated="true"><?php echo form_error('username'); ?></label>
                </div>
                <div class="form-group text-left">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password"  name="password"  <?php if (isset($_COOKIE['password'])) { ?>value="<?= $_COOKIE['password']; ?>"<?php } ?> class="form-control" id="exampleInputPassword1" placeholder="Password" >
                    <label class="error" for="password" generated="true"><?php echo form_error('password'); ?></label>
                    <?php
                    if (isset($msg)) {
                        echo "<h5 style='color:red'>$msg</h5>";
                    }
                    ?>
                    <p class="text-right link-log"  data-toggle="modal" data-target="#forgetmodel">Forgot the password?</p>
                </div>
                <button type="submit" class="btn btn-login-green pull-left" >Login</button>
                <div class="clearfix"></div>
                <p class="link-log text-left">Didn’t have an account? <a href="<?= base_url()?>public/user/sign_up">Sign up</a></p> 
            </form>
        </div>
    </div>
</div>


