
<?php
echo $this->load->view('template/sidebar_list');
?>
<div class="right-panel-sec">
    <div class="row">
        <div class="col-md-7 main-content">

            <section class=" content-panel register">
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

        </div>
        <div class="col-md-5 col-sm-12 ads">
            <?php
            echo $this->load->view('template/right_sidebar');
            ?>
        </div>
    </div>
</div>



