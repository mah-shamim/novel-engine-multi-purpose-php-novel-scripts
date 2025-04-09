<?php
require_once __DIR__.'/../../config/config.php';
header("Content-Type: application/json");

use App\General\User\Auth;
use App\General\Admin\Reviews;
use App\General\User\Comments;
use App\General\User\Payment;

$check = [];

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $action = Input('action');

    if($action === 'register') {
        $auth = new Auth();
        $check = $auth->Register($_POST);    
    } else if($action === 'addblogcomment') {
        $review = new Comments();
        $check = $review->add();
        
    } else if($action === "addblogreply") {
        $review = new Comments();
        $check = $review->addreply();
    } else if($action === 'login') {  
        $auth = new Auth();
        $check = $auth->login($_POST);
    } else if($action === 'changepass') {
        $auth = new Auth();
        $check = $auth->changepass($_POST);
    } else if($action === 'editprofile') {
        $auth = new Auth();
        $check = $auth->editprofile($_POST);
    } else if($action === 'changepic') {
        $auth = new Auth();
        $check = $auth->changepic($_POST);
    } else if($action === 'addreview') {
        $review = new Reviews();
        $check = $review->add();
    } else if($action === "addreply") {

        $review = new Reviews();
        $check = $review->addreply();
    } else if($action === "pay") {
        $class = new Payment();
        $check = $class->Add($_POST);
    } else if($action === "verify") {
        $class = new Payment();
        $check = $class->Verify($_POST['reference']);
    } else if($action === 'forgot') {
        $class = new Auth();
        $check = $class->forgot(Input('email'));
    }  else if($action === 'reset') {
        $class = new Auth();
        $check = $class->reset();
    } else {
        // $m = "";
        // foreach($_POST as $key => $val) {
        //     $m .= "$key : $val";
        // }
        $check['m'] = "No action";
        $check['s'] = 0;
    }

    echo json_encode($check);
}