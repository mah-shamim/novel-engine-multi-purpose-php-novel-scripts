<?php

namespace App\Admin;
class AdminConfig {
    public static $controllerPath;
    public static $AcPath;
    public static $AtPath;
    public static $templatePath;

    public static $adheader;
    public static $adfooter;
    

    public static function setPaths($controllerPath, $templatePath) {
        self::$controllerPath = $controllerPath;
        self::$templatePath = $templatePath;
        self::$AcPath = $controllerPath.'/admin/';
        self::$AtPath = $templatePath.'/admin/';
        self::$adheader = $templatePath.'/admin/header.php';
        self::$adfooter = $templatePath.'/admin/footer.php';
    }

    public static function login() {
        view([self::$controllerPath . '/admin/login/index.php', self::$templatePath . '/admin/login.php']);
    }

    public static function posts()
    {
        view([self::$AcPath.'blog/index.php', self::$adheader, self::$AtPath.'blog/index.php', self::$adfooter]);
    }

    public static function package() {
        view([self::$controllerPath.'/admin/packages/index.php', self::$adheader, self::$templatePath.'/admin/packages/index.php', self::$adfooter]);
    }

    public static function subscriptions() {
        view([self::$AcPath.'subscriptions/index.php',self::$adheader, self::$AtPath.'subscriptions/index.php', self::$adfooter]);
    }

        public static function reviews() {
        view([self::$AcPath.'reviews/index.php',self::$adheader, self::$AtPath.'reviews/index.php', self::$adfooter]);
    }

    public static function loginAjax() {
        view(self::$controllerPath . '/admin/login/request.php');
    }

    public static function HandleLogin() {
        view(self::$controllerPath . '/admin/login/request.php');
    }

    public static function dashboard() {
        view([self::$controllerPath.'/admin/home.php',self::$adheader, self::$templatePath.'/admin/dashboard.php', self::$adfooter]);
    }

    public static function author() {
        view([self::$controllerPath.'/admin/author/index.php',self::$adheader, self::$templatePath.'/admin/author/index.php', self::$adfooter]);
    }

    public static function user() {
        view([self::$controllerPath.'/admin/users/index.php',self::$adheader, self::$templatePath.'/admin/users/index.php', self::$adfooter]);
    }

    public static function subscribe() {
        view([self::$controllerPath.'/admin/users/subscribe.php',self::$adheader, self::$templatePath.'/admin/users/subscribe.php', self::$adfooter]);
    }

    public static function compiler() {
        view([self::$controllerPath.'/admin/compiler/index.php',self::$adheader, self::$templatePath.'/admin/compiler/index.php', self::$adfooter]);
    }

    public static function group() {
        view([self::$controllerPath.'/admin/groups/index.php',self::$adheader, self::$templatePath.'/admin/groups/index.php', self::$adfooter]);
    }

    public static function category() {
        view([self::$controllerPath.'/admin/category/index.php',self::$adheader, self::$templatePath.'/admin/category/index.php', self::$adfooter]);
    }

    public static function book() {
        view([self::$controllerPath.'/admin/book/index.php',self::$adheader, self::$templatePath.'/admin/book/index.php', self::$adfooter]);
    }

    public static function ebook() {
        view([self::$controllerPath.'/admin/ebook/index.php',self::$adheader, self::$templatePath.'/admin/ebook/index.php', self::$adfooter]);
    }

    public static function page() {
        view([self::$controllerPath.'/admin/page/index.php',self::$adheader, self::$templatePath.'/admin/page/index.php', self::$adfooter]);
    }

    public static function setting() {
        view([self::$controllerPath.'/admin/setting/index.php',self::$adheader, self::$templatePath.'/admin/setting/index.php', self::$adfooter]);
    }

    public static function profile() {
        view([self::$controllerPath.'/admin/profile/index.php',self::$adheader, self::$templatePath.'/admin/profile/index.php', self::$adfooter]);
    }
    
        public static function meta() {
        view([self::$controllerPath.'/admin/setting/meta.php',self::$adheader, self::$templatePath.'/admin/setting/meta.php', self::$adfooter]);
    }
    
            public static function adscode() {
        view([self::$controllerPath.'/admin/setting/adscode.php',self::$adheader, self::$templatePath.'/admin/setting/adscode.php', self::$adfooter]);
    }

   

    


}



?>
