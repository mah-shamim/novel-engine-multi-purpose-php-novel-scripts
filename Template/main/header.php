<?php global $currentURL;
global $lang, $isLogin, $AuthUser;
$gen = new App\General\All();
$footCat = $gen->getList('category', 'id', 5);
$pages = $gen->getList('page', 'id', 5);

?>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo getMetaCode('head'); ?>
	<!-- CSS -->

	<link rel="stylesheet" href="<?=MAIN_ASSETS?>/owl.carousel.min.css">
	<!-- All CSS files -->
	<link rel="stylesheet" href="<?=MAIN_ASSETS?>/css/vendor/bootstrap.min.css" />
	<link rel="stylesheet" href="<?=MAIN_ASSETS?>/css/vendor/font-awesome.css" />
	<link rel="stylesheet" href="<?=MAIN_ASSETS?>/css/vendor/slick.css" />
	<link rel="stylesheet" href="<?=MAIN_ASSETS?>/css/vendor/slick-theme.css" />
	<link rel="stylesheet" href="<?=MAIN_ASSETS?>/css/app.css" />
  <link rel="stylesheet" href="<?=ADMINASSETS?>/css/sweetalert.css" />
	
<link rel="apple-touch-icon" sizes="180x180" href="<?=APP_URL?>/Public/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?=APP_URL?>/Public/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?=APP_URL?>/Public/favicon/favicon-16x16.png">
<link rel="manifest" href="<?=APP_URL?>/Public/favicon/site.webmanifest">

  <link rel="manifest" href="<?=APP_URL?>/Public/fav/manifest.json">

    <title><?php echo isset($title) ? $title.' '.APP_NAME : APP_NAME;?></title>
	<link rel="canonical" href="<?php echo $currentURL ?>">
	<?php if (isset($schema)) : ?>
        <script type="application/ld+json">
            <?php echo json_encode($schema); ?>
        </script>
    <?php endif; ?>
	<meta name="language" content="en">
  <meta name="theme-color" content="#c416bb">
	<!-- Webmaster Seo Tag -->
    <meta name="title" content="<?php echo $title; ?>">
    <?php if (isset($metadescription)) : ?>
        <meta name="description" content="<?php echo $metadescription; ?>">
    	<?php else: ?>
		<meta property="description" content="<?php echo $lang['SITE_DESCRIPTION']; ?>">
    <?php endif; ?>
    <?php if (isset($metakeyword)) : ?>
        <meta name="keywords" content="<?php echo $metakeyword; ?>">
		<?php else: ?>
		<meta property="keywords" content="<?php echo $lang['SITE_KEYWORDS'];; ?>">
    <?php endif; ?>
	<?php (isset($metanofollow) && $metanofollow == true) ? '<meta name="robots" content="noindex, nofollow">  ' : ''; ?> 
	
    <!-- Open Graph Meta Tag -->
    <meta property="og:url" content="<?php echo $currentURL;?>">
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?php echo $title; ?>">
	<?php if (isset($metadescription)) : ?>
		<meta property="og:description" content="<?php echo $metadescription; ?>">
	<?php else: ?>
		<meta property="og:description" content="<?php echo $lang['SITE_DESCRIPTION']; ?>">
    <?php endif; ?>
    <?php if (isset($metakeyword)) : ?>
		<meta property="og:keywords" content="<?php echo $metakeyword; ?>">
	<?php else: ?>
		<meta property="og:keywords" content="<?php echo $lang['SITE_KEYWORDS'];; ?>">
    <?php endif; ?>
	<?php if (isset($ogImage)) : ?>
    <meta property="og:image" content="<?php echo $ogImage; ?>">
    <?php else : ?>
	<meta property="og:image" content="<?php echo LOGO_URL; ?>">
	<?php endif;?>
	
	<style>
	    .float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:30px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;
}

.my-float{
	margin-top:16px;
}

.telegram-float {
  position: fixed;
  bottom: 40px;
  left: 40px;
  z-index: 1000;
}

.telegram-icon {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background-color: #0088cc;
  display: flex;
  justify-content: center;
  align-items: center;
  animation-name: pulse;
	animation-duration: 1.5s;
	animation-timing-function: ease-out;
	animation-iteration-count: infinite;
}

      @keyframes pulse {
	0% {
		box-shadow: 0 0 0 0 rgba(0, 136, 204, 0.5);
	}
	80% {
		box-shadow: 0 0 0 14px rgba(0, 136, 204, 0);
	}
}

.telegram-icon svg {
  fill: #fff;
  width: 30px;
  height: 30px;
}
	</style>


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
	<a href="#main-wrapper" id="backto-top" class="back-to-top"><i class="fas fa-angle-up"></i></a>
	  <!-- Main Wrapper Start -->
	  <div id="main-wrapper" class="main-wrapper overflow-hidden">

<!-- Header Area Start -->
<header class="header">
  <div class="container-fluid">
    <nav class="navbar upper d-lg-flex d-none">
      <a class="navbar-brand" href="/">
        <img alt="<?=APP_NAME?>" src="<?=LOGO_URL?>" width="200px"/>
      </a>
      <div class="search-bar">
        <form method="get" action="<?=APP_URL?>/search">
          <div class="form-group header-search">
            <button type="submit" class="fa fa-search form-control-search"></button>
            <input type="text" name="novel" class="form-control" placeholder="Search Any novel you want..." />
          </div>
        </form>
      </div>
      <div class="right-content">
        <ul class="unstyled">
          <?php if($isLogin) : ?>
            <li>
              <a href="/account" class="login-border active">
                <h6>Account</h6>
              </a>
            </li>
            <li>
              <a href="/logout">
                <h6>Logout</h6>
              </a>
            </li>
          <?php else: ?>
            <li>
              <a href="/login" class="login-border active">
                <h6>Login</h6>
              </a>
            </li>
            <li>
              <a href="/signup">
                <h6>Register</h6>
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
  </div>
  <nav class="navbar navbar-expand-lg">
    <a class="navbar-brand d-lg-none" href="/">
      <img alt="<?=APP_NAME?>" src="<?=LOGO_URL?>" width="200px"/>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav mainmenu m-0">
        <li class="menu-item">
          <h6><a href="/" class="active">Home</a></h6>
        </li>
        <li class="menu-item">
          <h6><a href="/blog">Blog</a></h6>
        </li>
        <li class="menu-item-has-children">
          <h6><a href="javascript:void(0);">Categories</a></h6>
          <ul class="submenu">
            <?php foreach($footCat as $cat) {
              echo '<li><a href="'.APP_URL.'/category/'.$cat['slug'].'">'.$cat['name'].'</a></li>';
            } ?>
          </ul>
        </li>
        <li class="menu-item-has-children">
          <h6><a href="javascript:void(0);">Pages</a></h6>
          <ul class="submenu">
            <?php foreach($pages as $cat) {
              echo '<li><a href="'.APP_URL.'/page/'.$cat['slug'].'">'.$cat['name'].'</a></li>';
            } ?>
          </ul>
        </li>
        <li class="menu-item d-lg-none">
          <form method="get" action="<?=APP_URL?>/search" class="d-flex">
            
            <div class="form-group has-search">
            <input type="text" name="novel" class="form-control" placeholder="Search Any novel you want..." />
                <button type="submit" class="b-unstyle"><i class="fal fa-search"></i></button>
            </div>
          </form>
        </li>
        <?php if($isLogin) : ?>
          <li class="menu-item d-lg-none">
            <a href="/account" class="login-border active">
              <h6>Account</h6>
            </a>
          </li>
          <li class="menu-item d-lg-none">
            <a href="/logout">
              <h6>Logout</h6>
            </a>
          </li>
        <?php else: ?>
          <li class="menu-item d-lg-none">
            <a href="/login" class="login-border active">
              <h6>Login</h6>
            </a>
          </li>
          <li class="menu-item d-lg-none">
            <a href="/signup">
              <h6>Register</h6>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
</header>
<!-- Header Area end -->



	
<div class="ads-container">
				<div class="ads">
				<?php echo getAds('header'); ?>
				</div>
	</div>



<a href="<?=TELEGRAM_URL?>" target="_blank" class="telegram-float">
		<div class="telegram-icon">
			<svg viewBox="0 0 64 64"><path d="M56.4,8.2l-51.2,20c-1.7,0.6-1.6,3,0.1,3.5l9.7,2.9c2.1,0.6,3.8,2.2,4.4,4.3l3.8,12.1c0.5,1.6,2.5,2.1,3.7,0.9 l5.2-5.3c0.9-0.9,2.2-1,3.2-0.3l11.5,8.4c1.6,1.2,3.9,0.3,4.3-1.7l8.7-41.8C60.4,9.1,58.4,7.4,56.4,8.2z M50,17.4L29.4,35.6 c-1.1,1-1.9,2.4-2,3.9c-0.2,1.5-2.3,1.7-2.8,0.3l-0.9-3c-0.7-2.2,0.2-4.5,2.1-5.7l23.5-14.6C49.9,16.1,50.5,16.9,50,17.4z"></path></svg>
</div>
</a>

