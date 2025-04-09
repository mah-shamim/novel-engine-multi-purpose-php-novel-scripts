<?php

global $lang, $isLogin, $AuthUser;
use App\General\DB;

$setting = 0;
$title = " Account Page ";
$db = new DB();
$isSubscribe = false;
$isNotification = false;

if(isset($_GET['shu']) && $_GET['shu'] === 'subscribe') {
    $isSubscribe = true;
    $packages = $db->table('packages')->where('status', 1)->get();
    $title = "Subscribe  ";
} else if(isset($_GET['shu']) && $_GET['shu'] === 'notification') {

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 10;
    $offset = ($page - 1) * $limit;
    $title = "Notifications";
    $isNotification = true;
    $notifications = $db->table('notifications')->where('user_id', $AuthUser['id'])->where('status', 1)->orderBy('id', 'DESC')->limit($limit)->offset($offset)->get();

    $totalFiles = $db->table('notifications')->where('user_id', $AuthUser['id'])->where('status', 1)->count();
    $totalpages = ceil($totalFiles / $limit);

    if(isset($_GET['page'])) {
        $title = 'Page '.Input('page').' of ' .$totalpages.' | '. $title;
    }

    $db->table('notifications')->where('is_read', 0)->where('user_id',$AuthUser['id'])->update(['is_read' => 1]);
} else {

}