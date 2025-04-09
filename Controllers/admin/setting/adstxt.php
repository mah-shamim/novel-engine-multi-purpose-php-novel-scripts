<?php
global $rootpath;

$title = "Ads.txt Editor";
$adstxt =  $rootpath . '/ads.txt';


if (Input('save')) {
    $file = $rootpath . '/ads.txt';

    if (!file_exists($adstxt)) {
        $file = fopen($adstxt, 'w'); // 'w' mode creates the file if it doesn't exist
        if ($file) {
            fclose($file);
        }
    } 


    if(WriteToFile($file, filter_input(INPUT_POST,'contents')) === true) {
     $message = "Successfully set Ads.txt";   
     $status = 1;
    } else {
     $message = "Ads txt not set an error occur";   
     $status = 0;
    }
}

$content = file_get_contents($adstxt);
