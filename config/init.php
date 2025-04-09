<?php
if (!session_id())
    session_start();

use App\General\All;
$rootpath = realpath(__DIR__ . '/..');
define('ROOTH', realpath(__DIR__ . '/..'));
require_once $rootpath.'/config/config.php';
require_once $rootpath.'/config/mail.php';
require_once $rootpath.'/config/database.php';
$rootpath2 = realpath(__DIR__ . '/..');
const PUBLICPATH = ROOTH."/Public";
const MAINPATH = ROOTH.ROOTH."/main";
const ADMINPATH =  ROOTH.ROOTH."/admin";
const AdminURL = '/SHU-Admin';
const LoginURL = APP_URL.AdminURL . '/login';
const LogoutURL = AdminURL . '/logout';
const Dashboard = AdminURL . '/dashboard';
const ErrorURL = APP_URL . '/error';
const AdminError =  AdminURL . '/error';
$controllerPath = $rootpath.'/Controllers';
$templatePath = $rootpath.'/Template';
const ASSETS = PUBLICPATH.'/assets';
const ADMINASSETS = APP_URL.'/Public/assets/admin';
const MAIN_ASSETS = APP_URL.'/Public/assets/main';



$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$domain = $_SERVER['HTTP_HOST'];
$path = $_SERVER['REQUEST_URI'];
$currentURL = $protocol . '://' . $domain . $path;
$lang = [];

require_once $rootpath. '/vendor/autoload.php';
require_once $rootpath.'/config/functions.php';
require_once $rootpath.'/config/lang.php';

if (!file_exists($rootpath . '/shuraih/lock.txt')) {

    if (str_contains($path, 'install')) {
    } else {
        Redirect('../install');
    }
}


$isLogin = false;
if(isset($_SESSION['loginID']) && isset($_SESSION['loginName'])) {
    $gen = new All();
    $AuthUser = $gen->getRow('users', 'id', $_SESSION['loginID']);

    if($AuthUser) {
        $isLogin = true;
    }
}









