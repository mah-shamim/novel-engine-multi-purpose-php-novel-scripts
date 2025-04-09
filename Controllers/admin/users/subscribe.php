<?php
use App\General\All;

if(!isset($_GET['id'])) {
    Redirect(AdminError);
} else {

    $Gen =  new All();
    $user = $Gen->getRow('users', 'id', $_GET['id']);

    if($user) {

        $title = "Subscribe to user {$user['name']}";
        $packages = $Gen->selectBy('packages', ['status' => 1], 'id');
    } else {
        Redirect(AdminError);
    }
}