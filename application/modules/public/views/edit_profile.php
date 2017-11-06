 
<style>
    .inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }
    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
</style>
<div class="non-res">
    <div class="right-panel-sec panel-edit-profile">
        <div class="row">
            <div class="col-md-6 main-content ">
                <div class="main-title"> Avatar </div>

                <div class="col-md-2 no-padding mar-t-30">
                    <img class="avatar-middle" src="<?php echo base_url(); ?>uploads/users/<?php echo $userdetail['user_image']; ?>" alt="<?php echo $userdetail['user_name']; ?>">
                    <input name="userimg_old" id="userimg_old" value="<?php echo $userdetail['user_image']; ?>" type="hidden">
                </div>
                <form action="<?php echo base_url(); ?>public/user/update_user" method="post"  enctype="multipart/form-data" id="profilechange">
                    <div class="col-md-8 mar-t-30 pad-t-6 mar-l-20">
                        <!--<input id="uploadFile" placeholder="Choose File" disabled="disabled" />-->

                        <div class="fileUpload btn btn-choose">
                            <span>Choose File</span>
                            <input id="uploadBtn" type="file" name="user_profile" class="upload form-control"  />
                        </div>

                        <input name="userimg_old" id="userimg_old" value="<?php echo $userdetail['user_image']; ?>" type="hidden" >
                        <span class="status-choose pad-l-10">No file choosen</span>
                        <div class="title-notice pad-t-6">JPG, GIF or PNG, Max size: 2MB</div>
                    </div>
                    <script>
                        document.getElementById("uploadBtn").onchange = function () {
                            document.getElementById("uploadFile").value = this.value;

                        };
                    </script>
                    <div class="col-md-12 no-padding mar-t-30">
                        <!--<form class="form-setting">-->
                        <div class="form-group">
                            <div class="sub-title">Your Name</div>
                            <input type="text" class="form-control" name="name" value="<?php echo $userdetail['name']; ?>">
                            <div class="title-notice pad-t-6">This is the name that will be visible to other</div>
                        </div>
                        <!--</form>-->

                        <div class="form-group spoiler-form">
                            <div class="sub-title">Account Type</div>
                            <div class="radio">
                                <input type="hidden" name="account_old" value="<?php echo $userdetail['account_type']; ?>">
                                <input id="public" type="radio" name="AccountType" value="public">
                                <label for="public">Public</label>
                                <input id="private" type="radio" name="AccountType" value="private">
                                <label for="private">Private</label>
                            </div>
                        </div>
                        <div class="form-group spoiler-form">
                            <div class="col-md-6">
                                <div class="spoiler-title">Show NFSW Post</div>
                                <div class="onoffswitch">
                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" <?php
                                    if ($userdetail['NFSW'] == 1) {
                                        $attrn = "checked" . " " . "value='1'";
                                    } else {
                                        $attrn = "value='0'";
                                    }
                                    echo $attrn;
                                    ?> >
                                    <label class="onoffswitch-label" for="myonoffswitch"> <span class="onoffswitch-inner"></span> 
                                        <span class="onoffswitch-switch"></span> 
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="spoiler-title">Show Spoiler Post</div>
                                <div class="onoffswitch">
                                    <input type="checkbox" name="onoffswitchspoiler" class="onoffswitch-checkbox" id="onoffswitch" <?php
                                    if ($userdetail['spoiler'] == 1) {
                                        $attr = "checked" . " " . "value='1'";
                                    } else {
                                        $attr = "value='0'";
                                    }
                                    echo $attr;
                                    ?> >
                                    <label class="onoffswitch-label" for="onoffswitch"> 
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span> 
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="form-group spoiler-form">
                            <div class="sub-title">Gender</div>
                            <div class="radio">
                                <input type="hidden" name="gender_old" value="<?php echo $userdetail['gender']; ?>">
                                <input id="male" type="radio" name="gender" value="male">
                                <label for="male">Male</label>
                                <input id="female" type="radio" name="gender" value="female">
                                <label for="female">Female</label>
                            </div>
                        </div>

                        <ul class="form-group wrap-dropdown">
                            <div class="sub-title">Birthday</div>
                            <?php
                            $dd = explode('-', $userdetail['dob']);
                            ?>
                            <select class="btn btn-dropdown" name="year">
                                <?php
                                for ($i = 1950; $i <= date('Y'); $i++) {
                                    $s = $dd[0] == $i ? 'selected="selected"' : '';
                                    echo '<option  ' . $s . '   value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                            <select class="btn btn-dropdown" name="month">
                                <?php
                                $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
                                foreach ($months as $key => $month) {
                                    $s = $dd[1] == $i ? 'selected="selected"' : '';
                                    echo "<option ' . $s . ' value=\"" . $key . "\">" . $month . "</option>";
                                }
                                ?>
                            </select>
                            <select class="btn btn-dropdown" name="date">
                                <?php
                                for ($i = 1; $i <= 31; $i++) {
                                    $s = $dd[2] == $i ? 'selected="selected"' : '';
                                    echo '<option  ' . $s . '   value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </ul>

                        <div class = "form-group dropdown">
                            <div class = "sub-title">Country</div>

                            <select class="btn btn-dropdown country" name="country">
                                <option value="<?php echo $userdetail['user_region'] ?>" selected=""> <?php echo $userdetail['user_region'] ?> </option>
                                <option value="Indonesia"> Indonesia </option>
                                <option value="US">US</option>
                                <option value="UK"> UK </option>
                                <option value="German"> German </option>
                            </select>
                            <div class = "title-notice pd-t-6">Tell us where you’re form so we can provide better serviece for you</div>

                        </div>
                        <div class = "form-group social-network-connect">
                            <div class = "sub-title">Social Network</div>
                            <div class = "wrap-socmed">
                                <div class = "facebook-conect">
                                    <img src = "<?php echo base_url(); ?>assets/public/img/fb-connect.png">
                                    <span>Facebook Connected</span>
                                    <div class = "btn btn-fb-connect"> Connect</div>
                                </div>
                            </div>
                            <div class = "wrap-socmed">
                                <div class = "facebook-conect">
                                    <img src = "<?php echo base_url(); ?>assets/public/img/gplus-connect.png">
                                    <span>Google+ Connected</span>
                                    <div class = "btn btn-gplus-connect"> Connect</div>
                                </div>
                            </div>
                        </div>

                        <button class = "btn btn-red" style = "margin-bottom: 8px;" name="save">Save Changes</button>
                    </div>
                </form>

            </div>
            <div class="col-md-6 main-content pad-l-20 pad-r-50">
                <h4 class="green-col">Username</h4>
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

                    <button type="submit" class="btn btn-red mar-t-20 pull-right" >Save Changes</button>
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

                    <button type="submit" class="btn btn-red mar-t-20 pull-right" > Save Changes </button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('#onoffswitch').click(function () {
            if ($('#onoffswitch').val() == 0) {
                $('#onoffswitch').val('1');
                $('#onoffswitch').attr('checked');
            } else {
                $('#onoffswitch').val('0');
                $('#onoffswitch').removeAttr('checked')
            }
        });
        $('#myonoffswitch').click(function () {
            if ($('#myonoffswitch').val() == 0) {
                $('#myonoffswitch').val('1');
                $('#myonoffswitch').attr('checked');
            } else {
                $('#myonoffswitch').val('0');
                $('#myonoffswitch').removeAttr('checked')
            }
        });
    });
</script>
<script src="<?php echo base_url(); ?>assets/public/js/settingprofile.js"></script>