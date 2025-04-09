<?php

$title = "Profile";

$gen =  new App\General\All();
$user = $gen->getRow('admin_tb','id', $_SESSION['adminID']);
