<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="leaguememe.com">
        <meta name="keywords" content="leaguememe.com" />
        <meta name="description" content="Leaguememe-League of Legends Entertainment">

        <meta property = "og:description" content = "Entertainment legends" />
        <meta property = "og:title" content = "Leaguememe-League of Legends Entertainment" />
        <meta property = "og:url" content = "<?php echo base_url(); ?>" />
        <title>Admin - Login</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/iCheck/square/blue.css">

        <!-- jQuery 2.1.4 -->
        <script src="<?php echo base_url(); ?>assets/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>

        <!-- Bootstrap 3.3.5 -->
        <script src="<?php echo base_url(); ?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url(); ?>assets/admin/plugins/iCheck/icheck.min.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!--<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>-->
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    </head>

    <body class="hold-transition login-page">

        <div class="login-box">

            <div class="login-logo">
                <a href="<?php echo base_url(); ?>admin">
                    <img src="<?php echo base_url(); ?>assets/public/img/logo-simple.png" height="54" alt="Admin" /> Leaguememe
                </a>

            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <?php
                $flash = $this->session->flashdata('login_error');
                if ($flash) {
                    echo $flash;
                }
                ?>
                <!--<p class="login-box-msg">Sign in to start your session</p>-->
                <form id="login_form" action="<?php echo base_url(); ?>login/check_login" method="post">

                    <div class="form-group has-feedback">
                        <label>Username <i class="error text-danger">*</i></label>
                        <input type="text" name="username" value="" class="form-control" required id="username" tabindex="1" placeholder="Username" />		
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                    </div>
                    <div class="form-group has-feedback">
                        <label>Password <i class="error text-danger">*</i></label>
                        <input type="password" id="password" name="password" value=""  class="form-control" required tabindex="2" placeholder="Password" />
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                    </div>
                    <div class="row">
                        <div class="col-xs-8">

                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit"  id="button_click" class="btn btn-primary btn-block btn-flat">Login</button>
                        </div><!-- /.col -->
                    </div>
                </form>
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->
        <script src="<?php echo base_url(); ?>assets/admin/js/login.js" type="text/javascript"></script>
    </body>
</html>