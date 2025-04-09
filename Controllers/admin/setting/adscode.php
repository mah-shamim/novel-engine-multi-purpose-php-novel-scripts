<?php
global $rootpath;
if(!is_dir($rootpath . '/Template/ads')){
    mkdir($rootpath . '/Template/ads');
}
$title = "Adscode";
$widgetFiles =  scandir($rootpath . '/Template/ads', SCANDIR_SORT_ASCENDING);

if (Input('save')) {
    $file = $rootpath . '/Template/ads/' . Input('wid');
    if(WriteToFile($file, filter_input(INPUT_POST,'contents')) === true) {
        $message = "Edited / Inserted ";   
        $status = 1;
       } else {
        $message = "Ops Error occur";   
        $status = 0;
       }
}

$content = '';
if (Input('wid') != '') {
    $filenm = $rootpath . '/Template/ads/' . Input('wid');
    if (file_exists($filenm)) {
        $lines = file($filenm);
        foreach ($lines as $line_num => $line) {
            $content .= $line;
        }
    }
}