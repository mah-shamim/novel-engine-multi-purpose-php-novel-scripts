<?php
global $lang, $isLogin, $AuthUser;

$db = new App\General\DB();
$table = 'blogs';

$limit = 20;
$cPage = 1;
$page = Input('page') ? Input('page') : 1;
$offset = ($page - 1) * $limit;


    if(Input('cat')) {
        $id = Input('cat');
        $name = $db->where('id', $id)->table('cats')->first();
        if($name) {
            $rows = $db->table($table." as p")
            ->where('p.status', 1)
            ->where('cid', $id)
            ->leftJoin('cats as c', 'p.cid', '=', 'c.id')
            ->leftJoin('admin_tb as a', 'p.admin_id', '=', 'a.id')
            ->select(['p.*', 'c.name as cat_name', 'a.name as author'])
            ->orderby('p.id', 'DESC')
            ->limit($limit)
            ->offset($offset)
            ->get();        
        $totalFiles = $db->table($table)->where('status', 1)->where('cid', $id)->count();

        $totalpages = ceil($totalFiles / $limit);
        }

        $title = $name['name']." | Blog";

        if(isset($_GET['page'])) {
            $title = 'Page '.Input('page').' of ' .$totalpages.' '. $title;
        }

    } else if(Input('search')) {
        $search = Input('search');
        $rows = $db->table($table." as p")
                ->where('p.status', 1)
                ->search(['p.name'], $search)
                ->leftJoin('cats as c', 'p.cid', '=', 'c.id')
                ->leftJoin('admin_tb as a', 'p.admin_id', '=', 'a.id')
                ->select(['p.*', 'c.name as cat_name', 'a.name as author'])
                ->orderby('p.id', 'DESC')
                ->limit($limit)
                ->offset($offset)
                ->get();        
    $totalFiles = $db->table($table)->where('status', 1)->search(['name'], $search)->count(); 

    $title = $totalFiles > 0 ? "($search) Search Result " : "No result for search ".$search;
    $totalpages = ceil($totalFiles / $limit);
    if(isset($_GET['page'])) {
        $title = 'Page '.Input('page').' of ' .$totalpages.' '. $title;
    }
} else {
    $rows = $db->table($table." as p")
            ->where('p.status', 1)
            ->leftJoin('cats as c', 'p.cid', '=', 'c.id')
            ->leftJoin('admin_tb as a', 'p.admin_id', '=', 'a.id')
            ->select(['p.*', 'c.name as cat_name', 'a.name as author'])
            ->orderby('p.id', 'DESC')
            ->limit($limit)
            ->offset($offset)
            ->get();        
$totalFiles = $db->table($table)->where('status', 1)->count();
        
    
    


$totalpages = ceil($totalFiles / $limit);

$title = "Blogs";
if(isset($_GET['page'])) {
    $title = 'Page '.Input('page').' of ' .$totalpages.' '. $title;
}
}



$latests = $db->table('ebook')
            ->select('*')
            ->where('status', 1)
            ->orderBy('RAND()', '')
            ->limit(3)
            ->get();

$categories = $db->table('cats')
            ->where('status', 1)
            ->get();


