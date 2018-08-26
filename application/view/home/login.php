<!DOCTYPE html>
<html lang="en">
<head>
  <title>Authentification</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="<?php echo URL; ?>img/Logo.png"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>css/util.css">
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-image: url('<?php echo URL; ?>img/snop.jpg');background-size: 100%;overflow-y: hidden; overflow-x: hidden;">
  
  <div class="limiter" style="zoom: 85%;margin-top: 3%;">
    <div class="container-login50" style="margin-left: 38%;">
      <div class="wrap-login100">
        <form class="login100-form validate-form" action="<?php echo URL; ?>home/login" method="POST">
          <img src="<?php echo URL; ?>img/snop tanger.jpg" width="20%" style="margin-bottom: 10%;">
          <img src="<?php echo URL; ?>img/fsd.png" width="20%" style="margin-bottom: 10%;margin-left: 58%;">
          <span class="login100-form-title p-b-26">
            Bienvenue
          </span>
          

          <div class="wrap-input100 " data-validate = "">
            <input class="input100" type="text" name="username">
            <span class="focus-input100" data-placeholder="Utilisateur"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Enter password">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" type="password" name="password">
            <span class="focus-input100" data-placeholder="Mot De Passe"></span>
          </div>

          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn">
                S'Identifier
              </button>
            </div>
          </div>

          <div class="text-center p-t-100" style="color: red;">
              <?php echo $status; ?>
          </div>
        </form>
      </div>
    </div>
  </div>
  

  <div id="dropDownSelect1"></div>
  <footer class="footer uoo fixed-bottom" style="margin-top: 1%;">
    <div class="container">
        <img src="<?php echo URL; ?>img/footerr.png" style="margin-left: -18.5%;margin-top: 2%;">
    </div>
</footer>
  
<!--===============================================================================================-->
  <script src="<?php echo URL; ?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo URL; ?>vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo URL; ?>vendor/bootstrap/js/popper.js"></script>
  <script src="<?php echo URL; ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo URL; ?>vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo URL; ?>vendor/daterangepicker/moment.min.js"></script>
  <script src="<?php echo URL; ?>vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo URL; ?>vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo URL; ?>js/main.js"></script>

</body>
</html>