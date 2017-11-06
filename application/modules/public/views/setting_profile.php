
<div class="col-md-12 no-padding">
    <div class="title-section">
        <span>Setting Profile</span>
        <a href="<?php echo base_url(); ?>leaguememe_profile/<?php echo $userdetail['user_name']; ?>"class="btn btn-red btn-back-review">Back</a>
    </div>
</div>
<div class="col-md-7 main-content">
    <h4 class="green-col">About <?php echo $userdetail['name']; ?></h4>
    <hr />
    <center>
        <div class="alert alert-danger alert-dismissable" style="display: none" id="alert_username" >
            <button type="button" class="close" data-dismiss="alert" 
                    aria-hidden="true">&times;</button>

        </div>
        <div class="alert alert-success alert-dismissable" style="display: none" id="alert_user" >
            <button type="button" class="close" data-dismiss="alert" 
                    aria-hidden="true">&times;</button>

        </div>
    </center>


    <form class="form-setting" action="<?php echo base_url(); ?>public/user/set_user_mail" method="post" id="useremail" >
        <div class="form-group">
            <label for="username1">Username</label>
            <input type="text" class="form-control" id="username1" name="username" placeholder="<?php echo $userdetail['user_name']; ?>">
            <input  name="old_username" type="hidden"  value="<?php echo $userdetail['user_name']; ?>" >
            <div id="usermsg1" style="color:#F00"  class="alert_style">  </div>
        </div>
        <div class="form-group">
            <label for="email1">Email</label>
            <input type="text" class="form-control" id="email1" name="email" placeholder="example@xyz.com">
            <input  name="old_email" type="hidden" id="old_email"  value="<?php echo $userdetail['user_email']; ?>" >
            <!--<div id="emailmsg1" style="color:#F00"  class="alert_style"> </div>-->
            <p>Email will not be displayed publicity</p>
        </div>

        <div class="col-md-6">
            <div class="spoiler-title">Show NFSW Post</div>
            <div class="onoffswitch">
                <input type="checkbox" name="onoffswitch_nsfw" class="onoffswitch-checkbox" value="1" <?php
                if ($userdetail['NFSW'] == 1) {
                    echo 'checked';
                } else {
                    echo '';
                }
                ?> id="myonoffswitch">     
                <label class="onoffswitch-label" for="myonoffswitch" >
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
                <input type="checkbox" name="onoffswitch_nsfw" class="onoffswitch-checkbox" value="0" <?php
                if ($userdetail['NFSW'] == 0) {
                    echo 'checked';
                } else {
                    echo '';
                }
                ?> id="myonoffswitch" checked>

            </div>
        </div>

        <div class="col-md-6">
            <div class="spoiler-title">Show Spoiler Post</div>
            <div class="onoffswitch">
                <input type="checkbox" name="onoffswitch_spoiler" class="onoffswitch-checkbox" value="1"  <?php
                if ($userdetail['spoiler'] == 1) {
                    echo 'checked';
                } else {
                    echo '';
                }
                ?> id="onoffswitch">
                <label class="onoffswitch-label" for="onoffswitch">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
                <input type="checkbox" name="onoffswitch_spoiler" class="onoffswitch-checkbox" value="0" <?php
                if ($userdetail['spoiler'] == 0) {
                    echo 'checked';
                } else {
                    echo '';
                }
                ?> id="onoffswitch" checked>
            </div>
        </div>

        <button type="submit" class="btn btn-red mar-t-50 pull-right" >Save Changes</button>
    </form>

    <div class="clearfix"></div>

    <h4 class="green-col mar-t-40">Password</h4>
    <hr />
    <center>
        <div class="alert alert-danger alert-dismissable" style="display: none" id="alert_password" >
            <button type="button" class="close" data-dismiss="alert" 
                    aria-hidden="true">&times;</button>

        </div>
        <div class="alert alert-success alert-dismissable" style="display: none" id="alert_pass" >
            <button type="button" class="close" data-dismiss="alert" 
                    aria-hidden="true">&times;</button>

        </div>
    </center>
    <form class="form-setting" action="<?php echo base_url(); ?>public/user/update_pswd" id="passwordchnage" method="post">
        <div class="form-group">
            <label >Old Password</label>
            <input type="password" class="form-control"  name="current_password">
        </div>
        <div class="form-group">
            <label >New Password</label>
            <input type="password" class="form-control"  name="new_password">
        </div>
        <div class="form-group mar-b-30">
            <label  >Re-Type New Password</label>
            <input type="password" class="form-control"  name="new_password_repeats">
        </div>

        <button type="submit" class="btn btn-red pull-right" > Save Changes </button>
    </form>

</div>
<script src="<?php echo base_url(); ?>assets/public/js/settingprofile.js"></script>