<?php 
$db = new App\General\DB();
?>
<!DOCTYPE html>
<html
    lang="en"
    class="light-style layout-menu-fixed layout-compact"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="<?=ADMINASSETS?>/"
    data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title> <?=isset($title) ? $title : ''?> | <?=APP_NAME?></title>

    <meta name="description" content="" />
    <meta name="robots" content="noindex, nofollow">

    <!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="<?=APP_URL?>/Public/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?=APP_URL?>/Public/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?=APP_URL?>/Public/favicon/favicon-16x16.png">
<link rel="manifest" href="<?=APP_URL?>/Public/favicon/site.webmanifest">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="<?=ADMINASSETS?>/vendor/fonts/materialdesignicons.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="<?=ADMINASSETS?>/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?=ADMINASSETS?>/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?=ADMINASSETS?>/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?=ADMINASSETS?>/css/demo.css" />
    <link rel="stylesheet" href="<?=ADMINASSETS?>/css/component-custom-switch.min.css" />


    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?=ADMINASSETS?>/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?=ADMINASSETS?>/css/sweetalert.css" />
    <link rel="stylesheet" href="<?=ADMINASSETS?>/css/select2.min.css" />
    <link href="<?=ADMINASSETS?>/vendor/DataTables/datatables.min.css" rel="stylesheet">
    <link href="<?=ADMINASSETS?>/vendor/ckeditor/styles.css" rel="stylesheet">
    <link href="<?=ADMINASSETS?>/vendor/ckeditor/ckeditor5.css" rel="stylesheet">
    


    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?=ADMINASSETS?>/vendor/js/helpers.js"></script>

    <script src="<?=ADMINASSETS?>/js/config.js"></script>
    <script src="<?=ADMINASSETS?>/js/jquery-3.6.4.min.js"></script>
    <script src="<?=ADMINASSETS?>/js/select2.min.js"></script>
    <script src="<?=ADMINASSETS?>/js/sweetalert.js"></script>
    


    <style>
    


.overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 20000 !important;
        }

        .loader-shu {
  width: 48px;
  height: 48px;
  border: 3px dotted #FFF;
  border-style: solid solid dotted dotted;
  border-radius: 50%;
  display: inline-block;
  position: relative;
  box-sizing: border-box;
  animation: rotation 2s linear infinite;
}
.loader-shu::after {
  content: '';  
  box-sizing: border-box;
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  margin: auto;
  border: 3px dotted #FF3D00;
  border-style: solid solid dotted;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  animation: rotationBack 1s linear infinite;
  transform-origin: center center;
}
    
@keyframes rotation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
} 
@keyframes rotationBack {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(-360deg);
  }
} 


.ck-custom-height {
    padding:5px;
    min-height: 500px;
    max-height: 500px; /* Set max-height to the same value to ensure scrollability */
    overflow-y: auto; /* Enable vertical scrolling */
}

        /* Override Select2 styles with Bootstrap 5 styles
        .select2-container {
            width: 100% !important;
        }

        .select2-container .select2-selection--single {
            height: calc(1.5em + 0.75rem + 2px) !important;
            padding: 0.375rem 1.75rem 0.375rem 0.75rem !important;
            font-size: 1rem !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(1.5em + 0.75rem + 2px) !important;
            right: 0.75rem !important;
        } */
        </style>
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="index.html" class="app-brand-link">
              <img src="<?php echo LOGO_URL ?>" width="150"/>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                    <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <!-- Dashboards -->
                <li class="menu-item">
                    <a href="<?php echo AdminURL ?>" class="menu-link">
                        <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                        <div data-i18n="Dashboards">Dashboards</div>

                    </a>
                </li>

                <!-- Layouts -->

                <li class="menu-item">
                            <a href="<?php echo AdminURL.'/ebook'; ?>" class="menu-link">
                            <i class="menu-icon mdi mdi-file-multiple"></i>   <div data-i18n="ebook">Ebook Files</div>
                </a>
                </li>
                <li class="menu-item">
                            <a href="<?php echo AdminURL.'/category'; ?>" class="menu-link">
                            <i class="menu-icon mdi mdi-folder-open-outline"></i>   <div data-i18n="categories">Categories</div>
                </a>
                </li>

                <li class="menu-item">
                            <a href="<?php echo AdminURL.'/book'; ?>" class="menu-link">
                            <i class="menu-icon mdi mdi-book-open"></i>   <div data-i18n="books">Books</div>
                </a>
                </li>

                <li class="menu-item">
                            <a href="<?php echo AdminURL.'/reviews'; ?>" class="menu-link">
                            <i class="menu-icon mdi mdi-message-reply-text"></i>   <div data-i18n="Reviews">Ebook Reviews (<?php echo $db->table('reviews')->count();?>)</div>
                </a>
                </li>




                <li class="menu-item">
                            <a href="<?php echo AdminURL.'/users'; ?>" class="menu-link">
                            <i class="menu-icon mdi mdi-account-box-multiple"></i>   <div data-i18n="Users">Users</div>
                </a>
                </li>

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons mdi mdi-post"></i>
                        <div data-i18n="Blog">Blog</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="<?php echo AdminURL.'/posts'; ?>" class="menu-link">
                                <div data-i18n="Posts">Posts</div>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="<?php echo AdminURL.'/blog-cats'; ?>" class="menu-link">
                                <div data-i18n="Categories">Categories</div>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="<?php echo AdminURL.'/blog-comments'; ?>" class="menu-link">
                                <div data-i18n="Comments">Comments</div>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons mdi mdi-cube-outline"></i>
                        <div data-i18n="others">Others</div>
                    </a>
                    <ul class="menu-sub">
                                                <li class="menu-item">
                            <a href="<?php echo AdminURL.'/author'; ?>" class="menu-link">
                                <div data-i18n="Authors">Authors</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="<?php echo AdminURL.'/group'; ?>" class="menu-link">
                                <div data-i18n="groups">Writer Groups</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="<?php echo AdminURL.'/compiler'; ?>" class="menu-link">
                                <div data-i18n="compiler">Ebook Compiler</div>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="<?php echo AdminURL.'/page'; ?>" class="menu-link">
                                <div data-i18n="pages">Page</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons mdi mdi-account-cash"></i>
                        <div data-i18n="Subscriptions">Subscriptions</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="<?php echo AdminURL.'/subscriptions'; ?>" class="menu-link">
                                <div data-i18n="Subscriptions">Subscriptions</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="<?php echo AdminURL.'/payments'; ?>" class="menu-link">
                                <div data-i18n="Payments">Payments</div>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="<?php echo AdminURL.'/packages'; ?>" class="menu-link">
                                <div data-i18n="Packages">Packages</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item">
                            <a href="<?php echo AdminURL.'/notifications'; ?>" class="menu-link">
                            <i class="menu-icon mdi mdi-bell-badge-outline"></i>   <div data-i18n="Notifications">Notifications</div>
                </a>
                </li>

                
                <li class="menu-item">
                            <a href="<?php echo AdminURL.'/instant-indexing'; ?>" class="menu-link">
                            <i class="menu-icon mdi mdi-broadcast"></i>   <div data-i18n="Instant Indexing">Instant Indexing</div>
                </a>
                </li>

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons mdi mdi-google-ads"></i>
                        <div data-i18n="Ads Management">Ads Management</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="<?php echo AdminURL.'/adscode'; ?>" class="menu-link">
                                <div data-i18n="Ads Code Editor">Ads Code Editor</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="<?php echo AdminURL.'/adstxt'; ?>" class="menu-link">
                                <div data-i18n="Ads Txt Editor">Ads Txt Editor</div>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="<?php echo AdminURL.'/metacode'; ?>" class="menu-link">
                                <div data-i18n="Meta Code Editor">Meta Code Editor</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons mdi mdi-cog-outline"></i>
                        <div data-i18n="others">Settings</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="<?php echo AdminURL.'/setting'; ?>" class="menu-link">
                                <div data-i18n="gsetting">General Setting</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="<?php echo AdminURL.'/profile'; ?>" class="menu-link">
                                <div data-i18n="profile">Profile</div>
                            </a>
                        </li>
                        
                        <li class="menu-item">
                            <a href="<?php echo AdminURL.'/metacode'; ?>" class="menu-link">
                                <div data-i18n="metacode">Head / Foot code</div>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="<?php echo AdminURL.'/mail-setting'; ?>" class="menu-link">
                                <div data-i18n="metacode">Mail Setting</div>
                            </a>
                        </li>
                        
                        <li class="menu-item mb-5">
                            <a href="<?php echo AdminURL.'/logout'; ?>" class="menu-link">
                                <div data-i18n="logout">Logout</div>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <nav
                class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                id="layout-navbar">
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="mdi mdi-menu mdi-24px"></i>
                    </a>
                </div>

                <a href="<?=APP_URL?>" target="_blank">View Site </a>
            </nav>

            <!-- / Navbar -->

            <div class="overlay d-none">
        <div class="spinner-border text-primary" role="status">
        <span class="loader-shu"></span>
        </div>
    </div>