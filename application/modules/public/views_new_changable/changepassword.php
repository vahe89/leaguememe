<?php if ($this->session->flashdata('message') != '') { ?>
                        <center>
                            <div class="alert alert-danger alert-dismissable" style="width: 40%">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>
                            <?php echo $this->session->flashdata('message'); ?>
                                </strong> 
                            </div> 
                        </center>
     
<?php } ?> 

<section class="container content-panel register">
    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>user/update_pswd" id="change_paswd" name="change_paswd" >
        <div class="row">
            
            <div class="col-md-12">
                <div class="left-nav">
                    <div class="form-group">
                        <h2>Change Password</h2>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label"> Current Password:</div>
                        <div class="col-sm-4">
                            <input type="password" class="form-control required"  name="current_password" id="current_password" />
                            <?php echo "<div class='text-danger'>" . form_error('current_password') . "</div>"; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label"> New Password:</div>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="new_password" id="new_password">
                            <?php echo "<div class='text-danger'>" . form_error('new_password') . "</div>"; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label"> Confirm Password:</div>
                        <div class="col-sm-4">
                            <input type="password" class="form-control"  name="new_password_repeat" id="cpswd">
                            <?php echo "<div class='text-danger'>" . form_error('new_password_repeat') . "</div>"; ?>
                        </div>
                        <div id="cpaswd" style="color:#F00" class="alert_style"> </div>
                    </div>
                    <div class="form-group">
                        <div class="name"></div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-default" name="submit" value="Submit"/>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
 
<script src="<?php echo base_url(); ?>assets/public/js/changepassword.js" type="text/javascript"></script>
 
 