<?php
global $rootpath, $isLogin, $AuthUser;

if($slug) {
    $gen = new App\General\All();
    $db = new App\General\DB();
    $file = $gen->getRow('ebook', 'id', $slug);

    $isDownload = false;
    if($file) {

        if(($file['isFree'] == 1)) {
            $isDownload = true;
        } else {
            if(SUBSCRIBE === 1) {
                if($gen->isSubscribe($AuthUser['id'])) {
                        $isDownload = true;
                }
            }
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename =  $file['file_name'];
        $path = $rootpath.'/Public/files/'.$file['file_dir'].$filename;
        $dname = $file['name'].' By '.BASE_URL.'.'.$file['ext'];
        
        if($isDownload === true) {
            if(file_exists($path)) {
                $dl = $file['download'] + 1;
                $dlnow = date('Y-m-d H:i:s');
                $id = $file['id'];
                $gen->EditRow('ebook', ['download' => $dl, 'dl_last' => $dlnow], "id = $id");
                fileDownload($path, $dname, strtoupper($file['ext']));
                echo $path;
            } else {
                echo $path;
            }
        } else {
            Redirect("/");
        }


    } else {
        Redirect("/");
    }
} else {
    Redirect("/");
}