<?php
global $lang;
global $rootpath;
header('Content-Type: application/json; charset=utf-8');
if(Input('setting') == "general") {
    $appurl = APP_URL;
    $basename = basename(APP_URL);
    $s = 0;
    $error = [];
    $m = "1";
    $appname = empty(Input('appname')) ? '' : Input('appname');
    $appdesc = Input('appdesc') ? Input('appdesc') : '';
    $appkey = Input('appkey') ? Input('appkey') : '';
    $fburl = Input('facebookurl') ? Input('facebookurl') : '';
    $xurl = Input('xurl') ? Input('xurl') : '';
    $telegurl = Input('telegramurl') ? Input('telegramurl') : '';
    $tiktokurl = Input('tiktokurl') ? Input('tiktokurl') : '';
    $instaurl = Input('instagramurl') ? Input('instagramurl') : '';
    $register = Input('register') ? 1 : 0;
    $download = Input('download') ? 1 : 0;
    $subscribe = Input('subscribe') ? 1 : 0;
    $instant = Input('instant') ? 1 : 0;
    $read = Input('read') ? 1 : 0;
    $currency = Input('currency') ? Input('currency') : '';
    $cat_home_1 = Input('cat_home_1') ? Input('cat_home_1') : '';
    $cat_home_2 = Input('cat_home_2') ? Input('cat_home_2') : '';
    $file_limit = Input('file_limit') ? Input('file_limit') : '';
    $rel_limit = Input('rel_limit') ? Input('rel_limit') : '';
    $app_mail = Input('app_mail') ? Input('app_mail') : '';
    $app_phone = Input('app_phone') ? Input('app_phone') : '';
    $app_address = Input('app_address') ? Input('app_address') : '';
    $api = Input('api') ? trim(Input('api')) : '';
    $key = Input('key') ? trim(Input('key')) : '';


    $logourl = LOGO_URL;

    if(!empty($_FILES['logo']['name'])) {

        $logoname = $_FILES['logo']['name'];
        $logotmp = $_FILES['logo']['tmp_name'];
        $logosize = filesize($logotmp);

        if($logosize > 10000000) {
            $error[] = "Logo size exceed 1MB";
        }

        $AllowedExt = ["png", "jpg", "gif", "webp"];
        $ext = strtolower(pathinfo($logoname, PATHINFO_EXTENSION));
        if(!in_array($ext, $AllowedExt)) {
            $error[] = "Logo type is not supported";
        }

        $dir = PUBLICPATH.'/img/';
        $name = "logo.".$ext;

        if(move_uploaded_file($logotmp, $dir.$name)) {
            $logourl = APP_URL.'/Public/img/'.$name;
        } else {
            $error[] = "Uploading Logo Failed";
        } 
        
    } else {
       
        $logourl = LOGO_URL;
        $m = "2";

    }

    if(count($error) > 0) {
        foreach($error as $err) {
            $m = $err;
        }
    } else {

        $data = "<?php
        define('BASE_URL', '$basename');
        define('APP_URL', '$appurl');
        define('APP_NAME', '$appname');
        define('APP_DESC', '$appdesc');
        define('APP_KEY', '$appkey');
        define('REGISTER', $register);
        define('READ_FREE', $read);
        define('DOWNLOAD', $download);
        define('INSTANT_INDEXING', $instant);
        define('FILE_LIMIT', $file_limit);
        define('RELATED_LIMIT', $rel_limit);
        define('SUBSCRIBE', $subscribe);
        define('CURRENCY', '$currency');
        define('CAT_HOME1', $cat_home_1);
        define('CAT_HOME2', $cat_home_2);
        define('APP_MAIL', '$app_mail');
        define('PAYSTACK_API', '$api');
        define('PAYSTACK_KEY', '$key');
        define('APP_PHONE', '$app_phone');
        define('APP_ADDRESS', '$app_address');
        define('FACEBOOK_URL', '$fburl');
        define('X_URL', '$xurl');
        define('TELEGRAM_URL', '$telegurl');
        define('TIKTOK_URL', '$tiktokurl');
        define('INSTAGRAM_URL', '$instaurl');
        define('LOGO_URL', '$logourl');
        date_default_timezone_set('Africa/Lagos');
        ?>";

        WriteToFile($rootpath . '/config/config.php', $data);
            $m = "Successfully edited";
            $s = 1;
    }

    $response = ['message' => $m, 'status' => $s];
    echo json_encode( $response );
} else {
    Redirect("/");
}


