<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>TARUNA | Login</title>
    <link href='<?php echo base_url("assets/img/favicon.ico"); ?>' rel='shortcut icon' type='image/x-icon' />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('assets/js/plugins/iCheck/square/blue.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/main_style.css'); ?>" rel="stylesheet">

</head>

<style>
    body {
        background: url(<?= base_url('assets/img/bg-login.png') ?>) !important;
        background-position: 50%;
        /* background-attachment: fixed; */
        background-size: cover !important;
        background-repeat: no-repeat !important;
        height: unset;
    }

    .login-box {
        position: relative;
        width: 900px;
        margin: 0 auto;
        margin-top: 100px;
        height: 450px;

        border-radius: 25px !important;
        -webkit-border-radius: 25px !important;
        -moz-border-radius: 25px !important;

        box-shadow: 0px 0px 30px 0px rgba(0, 0, 0, 0.2);
        -webkit-box-shadow: 0px 0px 30px 0px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0px 0px 30px 0px rgba(0, 0, 0, 0.2);
    }

    .bg-login-side {
        background: url(<?php echo base_url('assets/img/bg-login-2.png') ?>) !important;
        background-size: 120% 120% !important;
        background-position: bottom right !important;
        /* background-position: ; */
        padding: 0;
        height: 100%;

        border-radius: 25px 0 0 25px !important;
        -webkit-border-radius: 25px 0 0 25px !important;
        -moz-border-radius: 25px 0 0 25px !important;

    }

    .login-form-side {
        padding: 0;
        background-color: white;
        height: 100%;

        border-radius: 0 25px 25px 0 !important;
        -webkit-border-radius: 0 25px 25px 0 !important;
        -moz-border-radius: 0 25px 25px 0 !important;
    }

    .primary-color {
        color: #0560af;
    }
    
    b, strong {
        font-weight: 600;
    }

    .login-logo, .register-logo {
        font-size: 28px;
        text-align: center;
        margin-bottom: 25px;
        font-weight: 300;
        margin-top: 20px;
    }

    .login-box-msg, .register-box-msg {
        margin: 0;
        text-align: center;
        padding: 0 15px 15px 15px;
    }
</style>

<body class="login-page">
    <div class="row login-box">
        <div class="col-md-8 bg-login-side"></div>
        <div class="col-md-4 login-form-side">
            <div class="login-logo">
                <a href="#"><b class="primary-color">APLIKASI PELAPORAN</a>
            </div><!-- /.login-logo -->

            <div class="login-box-body">
                <p class="login-box-msg text-bold"> Login dengan Email & Password Anda</p>
                <div id="infoMessage"><?php echo $message; ?></div>
                <?php
                echo form_open('auth/login');
                ?>
                <div class="form-group has-feedback">
                    <input type="text" name="identity" id="identity" class="form-control" placeholder="Email Address" />
                    <span class="glyphicon  glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?> Remember Me
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div><!-- /.col -->
                </div>
                <?php echo form_close(); ?>
                <p><a href="forgot_password"><?php echo lang('login_forgot_password'); ?></a></p>                

            </div><!-- /.login-box-body -->
        </div>
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('assets/js/plugins/iCheck/icheck.min.js'); ?>"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

</html>