<?php
global $rootpath;

$title = "Mail Setting";

$file = $rootpath.'/config/mail.php';

if(Input('submit')) 
{
    $status = 0;
    $message =  "";

    $activate = Input('mail') ? 1 : 0;
    $host = Input('host') ?? null;
    $username = Input('username') ?? null;
    $password = Input('password') ?? null;
    $port = Input('port') ?? null;
    $from = Input('from') ?? null;


    $content = "

    <?php

    define('MAIL_ACTIVATION', $activate);
    define('MAIL_HOST', '$host');
    define('MAIL_USERNAME', '$username');
    define('MAIL_PASSWORD', '$password');
    define('MAIL_PORT', '$port');
    define('MAIL_FROM', '$from');
    
    ";

    if(WriteToFile($file, $content) === true) {
        $message = "Successfully Edited";   
        $status = 1;
       } else {
        $message = "Ops Error occur";   
        $status = 0;
       }
}

