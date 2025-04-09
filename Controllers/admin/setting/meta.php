<?php
global $rootpath;
if(!is_dir($rootpath . '/Template/widget')){
    mkdir($rootpath . '/Template/widget');
}
$title = "Header / Footer Code";
$widgetFiles =  scandir($rootpath . '/Template/widget', SCANDIR_SORT_ASCENDING);

if (Input('save')) {
    $file = $rootpath . '/Template/widget/' . Input('wid');
    WriteToFile($file, filter_input(INPUT_POST,'contents'));
}

$content = '';
if (Input('wid') != '') {
    $filenm = $rootpath . '/Template/widget/' . Input('wid');
    if (file_exists($filenm)) {
        $lines = file($filenm);
        foreach ($lines as $line_num => $line) {
            $content .= $line;
        }
    }
}