<section class="container content-panel register">
    <form method="post" action="<?php echo base_url(); ?>user/update_password" id="change">
        <div class="row">
            <div class="col-md-10">
                <div class="left-nav">
                    <div class="form-group">
                        <h2>Reset Password</h2>
                    </div>
                    <input type="hidden" class="form-control"   name="email" id="current_password"  value="<?php echo $dat->user_email; ?>" readonly>

                    <div class="form-group">
                        <div class="name"> New Password:</div>
                        <input type="password" class="form-control"   name="new_password" id="new_password">
                    </div>
                    <div class="form-group">
                        <div class="name"> Confirm Password:</div>
                        <input type="password" class="form-control"   name="cpswd" id="cpswd">
                    </div>
                    <div class="form-group">
                        <div class="name"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default" name="submit">SUBMIT</button>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </form>
</section>
 
<script src="<?php echo base_url(); ?>assets/public/js/reset_password.js" type="text/javascript"></script>

</body>
</html>