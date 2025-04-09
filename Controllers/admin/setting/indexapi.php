<?php
global $rootpath;
use App\General\Admin\Indexing;

$title = "Instant Indexing";


$logfile =  $rootpath . '/Log/instantindex.json';

if(Input('action')) {

    $action = Input('action');

    if($action === 'upload') {
        $file = $rootpath.'/config/secret.json';

        if(file_exists($file)) {
            unlink($file);
        }
    
        $file = $_FILES['file'];
    
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if($ext != 'json') {
            $status = 0;
            $message = "Unsupported file type"; 
        } else {
    
            $folder = $rootpath.'/config/';
            $filename = "secret.json";
            $target = $folder.$filename;
    
            if(move_uploaded_file($file['tmp_name'], $target)) {
                $status = 1;
                $message = "Successfully uploaded your Secret Service Json file";  
            }
        }
    } elseif ($action === 'clear') {
        $file = $logfile;
    
        if (!file_exists($logfile)) {
            $file = fopen($logfile, 'w'); // 'w' mode creates the file if it doesn't exist
            if ($file) {
                fclose($file);
            }
        } 
    
    
        if(WriteToFile($file, '') === true) {
         $message = "Successfully clear log file";   
         $status = 1;
        } else {
         $message = "log file not clear an error occur";   
         $status = 0;
        }
    } elseif($action == 'Index') {

        $status = 0;
        $message =  "";

        if(INSTANT_INDEXING !== 1) {
            $message = "Instant Indexing Plugin is not active, Pls activated it from general setting page";
        } else  {
            $class = new Indexing();
            $instance = $class->multiples($_POST['contents']);

            if($instance['success'] === true) {
                $message = $instance['message'];
                $status = 1;
            } else {
                $message = $instance['message'];
            }
        }
    }
}

$content = file_get_contents($logfile);