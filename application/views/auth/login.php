<!DOCTYPE html>
<html lang="en">

<head>
    <title>TARUNA | Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>css/main.css">
    <!--===============================================================================================-->
    <style>
        #infoMessage p {
            color: red;

        }
    </style>
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img src="<?= base_url('assets/login/') ?>images/tarunalogo.png" alt="IMG" width="1000"  height="250" >
                        <center> <img src="<?= base_url('assets/login/') ?>images/x.png" alt="IMG" width="300"  height="70"  > </center>
                    </div>
    
                    <form class="login100-form validate-form" method="POST" action="<?= base_url('auth/login') ?>">
                        <span class="login100-form-title">
                            APLIKASI PELAPORAN
                        </span>
                        <p>Login dengan Email & Password Anda</p>
                        <br>
                        <div id="infoMessage"><?php echo $message; ?></div>
                        <br>
                        <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                            <input class="input100" type="text" name="identity" id="identity" placeholder="Email">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                        </div>
    
                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <input class="input100" type="password" name="password" id="password" placeholder="Password">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="checkbox icheck">
                            <label>
                                <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?> Remember Me
                            </label>
                        </div>
                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn">
                                Login
                            </button>
                        </div>

                        <div class="text-center p-t-12">
                            <span class="txt1">
                                Forgot
                            </span>
                            <a class="txt2" href="#">
                                Username / Password?
                            </a>
                        </div>


                    </form>
                </div>
                
        <!-- </div> -->
    </div>




    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>vendor/bootstrap/js/popper.js"></script>
    <script src="<?= base_url('assets/login/') ?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>js/main.js"></script>

</body>

</html>