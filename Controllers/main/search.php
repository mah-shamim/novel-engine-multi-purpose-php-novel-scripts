<?php
global $lang, $isLogin, $AuthUser;
$sett = false;
$query = '';
$gen =  new App\General\All();
$db =  new App\General\DB();
include('sidebar.php');

$query = Input('novel');
$limit = FILE_LIMIT;
$cPage = 1;
$page = Input('page') ? Input('page') :1;
$offset = ($page - 1) * $limit;
$totalFiles = 0;
$totalpages = 0;
$rows = [];
if(Input('novel')) {



    $rows = $db->table('ebook')->where('status', 1)->search(['name'], $query)->limit($limit)->offset($offset)->get();
    $totalFiles = $db->table('ebook')->where('status', 1)->search(['name'], $query)->count();
    $totalpages = ceil($totalFiles / $limit);


    if(count($rows) < 1) {
        $title = "No result for search ".$query;
    } else {
        $title = $query." Search Result";
    }

    $latests = $db->table('ebook')
            ->select('*')
            ->where('status', 1)
            ->orderBy('RAND()', '')
            ->limit(3)
            ->get();

} else {
    $title = "You did not search for anything";

    $latests = $db->table('ebook')
            ->select('*')
            ->where('status', 1)
            ->orderBy('RAND()', '')
            ->limit(3)
            ->get();
}



?>