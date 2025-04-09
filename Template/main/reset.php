<!DOCTYPE html>
<html lang="en">


<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>Forgot Password | <?=APP_NAME?></title>

	<!-- All CSS files -->
	<link rel="stylesheet" href="<?=MAIN_ASSETS?>/css/vendor/bootstrap.min.css" />
	<link rel="stylesheet" href="<?=MAIN_ASSETS?>/css/vendor/font-awesome.css" />
	<link rel="stylesheet" href="<?=MAIN_ASSETS?>/css/vendor/slick.css" />
	<link rel="stylesheet" href="<?=MAIN_ASSETS?>/css/vendor/slick-theme.css" />
	<link rel="stylesheet" href="<?=MAIN_ASSETS?>/css/app.css" />
	
	<link rel="apple-touch-icon" sizes="180x180" href="/fav/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/fav/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/fav/favicon-16x16.png">
	<link rel="manifest" href="/fav/site.webmanifest">
    <link rel="stylesheet" href="<?=ADMINASSETS?>/css/sweetalert.css" />
    </head>

    <body>
        <!-- Preloader-->
  <div id="preloader">
    <div class="loader">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  <div id="" class="overlay2 d-none">
                    
                    <span class="loader21"></span>
  </div>
        <!-- Back To Top Start -->
        <a href="#main-wrapper" id="backto-top" class="back-to-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Main Wrapper Start -->
        <div id="main-wrapper" class="main-wrapper overflow-hidden">

            <!-- Header Start-->
            <header class="header st-2">
                <div class="container">
                    <a class="navbar-brand" href="/">
                        <img alt="<?=APP_NAME?>" src="<?=LOGO_URL?>" width="150px"/>
                    </a>
                </div>
            </header>
            <!-- Header End-->            
            
            <!-- signup area Start -->
            <section class="signup p-40 mb-64">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <div class="form-block bg-lightest-gray">
                                <h3 class="mb-48">Password Reset</h3>
                               <?php if($set === true): ?>
                                <form class="auth" method="POST">
                                    <div class="mb-24">
                                        <input type="password" class="form-control" id="" name="password" placeholder="Password">
                                    </div>
                                    <div class="mb-24">
                                        <input type="password" class="form-control" id="" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                    <input type="hidden" name="action" value="reset">
                                    <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                                    <button type="submit" class="b-unstyle cus-btn w-100 mb-24">
                                        <span class="icon"><img src="<?=MAIN_ASSETS?>/media/icons/click-button.png" alt=""></span>Send Reset Link
                                    </button>
                                </form>
                                <?php else: ?>
                                    <div class="register-bottom">
                                    <h6>Invalid / expired reset token, pls regenerate another one in Forgot password page</h6>
                                </div>
                                <?php endif; ?>
                                <div class="register-bottom">
                                    <h6>If you don’t have account? <a href="/signup" class="color-primary">Register</a></h6>
                                    <h6 class="text-end"><a href="/forgot" class="color-primary">Forgot Password?</a></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 ">
                        <div class="p-4 sign-up-image bg-lightest-gray d-flex align-items-center justify-content-center br-30 box-shadow">
                            <img class="round" src="<?=APP_URL.'/Public/thumb/450x650/'.$ebook['img_folder'].'/'.$ebook['image'];?>" alt="">
                        </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
        <!-- Jquery Js -->
	  <!-- Jquery Js -->
      <script src="<?=MAIN_ASSETS?>/js/vendor/jquery-3.6.3.min.js"></script>
	<script src="<?=MAIN_ASSETS?>/js/vendor/bootstrap.min.js"></script>
    <script src="<?=ADMINASSETS?>/js/sweetalert.js"></script>
	<script src="<?=MAIN_ASSETS?>/js/vendor/slick.min.js"></script>
	<script src="<?=MAIN_ASSETS?>/js/vendor/jquery-appear.js"></script>
	<script src="<?=MAIN_ASSETS?>/js/vendor/jquery-validator.js"></script>
	<script src="<?=MAIN_ASSETS?>/js/vendor/jquery.countdown.min.js"></script>
	<script src="<?=MAIN_ASSETS?>/owl.carousel.min.js"></script>


  <!-- Site Scripts -->
  <script src="<?=MAIN_ASSETS?>/js/app.js"></script>
  <script src="<?=MAIN_ASSETS?>/js/main.js"></script>
    </body>


</html>


