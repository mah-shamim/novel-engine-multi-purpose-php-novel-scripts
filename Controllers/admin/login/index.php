<?php
use App\General\Auth;
$Auth = new Auth();

if($Auth->isLogin()) {
    header("location:".LoginURL);
}


?>