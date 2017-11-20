<div class="non-res">
    <div class="right-panel-sec panel-edit-profile">
        <div class="row">


            <div class="col-md-12 no-padding">
                <div class="title-section">
                    <span>About <?php echo $userdetail['user_name']; ?> Profile</span>
                    <a  href="<?php echo base_url(); ?>leaguememe_profile/<?php echo $userdetail['user_name']; ?>" class="btn btn-red btn-back-review">Back</a>
                </div>
            </div>
            <div class="col-md-7 main-content"> 
                <div class="main-title">
                    Avatar
                </div>
                <div class="col-md-2 no-padding mar-t-30">
                    <?php
                    if (isset($userdetail['user_image']) && !empty($userdetail['user_image'])) {
                        ?>
                        <img class="avatar-middle" src="<?php echo base_url(); ?>uploads/users/<?php echo $userdetail['user_image']; ?>" alt="<?php echo $userdetail['user_name']; ?>">
                        <?php
                    } else {
                        ?>
                        <img class="avatar-middle " src="<?php echo base_url(); ?>assets/public/img/default_profile.jpeg" alt="<?php echo $userdetail['user_name']; ?>">
                        <?php
                    }
                    ?>

                    <input name="userimg_old" id="userimg_old" value="<?php echo $userdetail['user_image']; ?>" type="hidden">
                </div>


                <div class="col-md-12 no-padding mar-t-30">  
                    <div class="form-group">
                        <div class="sub-title">Name</div>
                        <input type="text" readonly="" class="form-control" name="name" value="<?= !empty($userdetail['name']) ? $userdetail['name'] : 'N/A'; ?>">
                        <div class="title-notice pad-t-6">This is the name that will be visible to other</div>
                    </div>  

                    <div class="form-group">
                        <div class="sub-title">Account Type</div>
                        <div class="radio">
                            <input id="public" type="radio" name="AccountType"  checked="">
                            <label for="public"><?= empty($userdetail['account_type']) ? "Public" : $userdetail['account_type']; ?></label>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="sub-title">Gender</div>
                        <div class="radio">
                            <?php
                            if (!empty($userdetail['gender'])) {
                                ?>
                                <input id="male" type="radio" name="gender" checked="">
                                <?php
                            }
                            ?>
                            <label for="male"><?= empty($userdetail['gender']) ? 'N/A' : $userdetail['gender']; ?></label>

                        </div>
                    </div> 
                    <?php if ($userdetail['dob'] !== '0000-00-00') { ?>
                        <ul class="form-group wrap-dropdown">
                            <div class="sub-title">Birthday</div>
                            <?php
                            $dd = explode('-', $userdetail['dob']);
                            ?>
                            <select class="btn btn-dropdown" name="year">
                                <option value="<?php echo $dd[0]; ?>"><?php echo $dd[0]; ?></option> 
                            </select>
                            <select class="btn btn-dropdown" name="month">
                                <option value="<?php echo $dd[0]; ?>"><?php echo $dd[1]; ?></option> 
                            </select>
                            <select class="btn btn-dropdown" name="date">
                                <option value="<?php echo $dd[0]; ?>"><?php echo $dd[2]; ?></option> 
                            </select>
                        </ul>
                    <?php } ?>
                    <?php if (!empty($userdetail['user_region'])) { ?>
                        <div class = "form-group dropdown">
                            <div class = "sub-title">Country</div>
                            <select class="btn btn-dropdown" name="country">
                                <option value="<?php echo $userdetail['user_region'] ?>" selected=""> <?php echo $userdetail['user_region'] ?> </option>
                            </select>
                            <div class = "title-notice pd-t-6">Tell us where you’re form so we can provide better serviece for you</div>
                        </div>
                    <?php } ?>
                    <?php if (!empty($userdetail['bio'])) { ?>
                        <div class = "form-group">
                            <div class = "sub-title">Tell people who you are </div>
                            <div><?php echo $userdetail['bio']; ?> </div>

                        </div>
                    <?php } ?>

                </div>

            </div>
        </div>
    </div>
</div>
