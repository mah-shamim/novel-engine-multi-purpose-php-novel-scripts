<?php
global $lang, $isLogin, $AuthUser;
$gen = new App\General\All();
$db = new App\General\DB;
$trend = $db->table('ebook')->where('isTrend', 1)->orderBy('views', 'DESC')->limit(20)->get();
$rand = $db->table('ebook')->where('status', 1)->orderBy('RAND()', '')->limit(5)->get();
$author = $db->table('author')->where('status', 1)->orderBy('RAND()', '')->limit(20)->get();



$limit = 12;
$cPage = 1;
$page = Input('page') ? Input('page') :1;
$offset = ($page - 1) * $limit;
$totalFiles = $db->table('ebook')->where('status', 1)->where('isHome', 1)->count();
$totalpages = ceil($totalFiles / $limit);

$files = $db->table('ebook')->where('status', 1)->where('isHome', 1)->orderBy('id', 'DESC')->limit($limit)->offset($offset)->get();

$title = "";
if(isset($_GET['page'])) {
    $title = 'Page '.Input('page').' of ' .$totalpages;
}



$cat_home_1 = $db->table('ebook as e')
                 ->select(['e.id', 'e.name', 'e.slug', 'e.author', 'e.img_folder', 'e.image', 'e.created_at', 'e.cid', 'c.name as cat_title', 'c.slug as cat_slug'])
                 ->leftJoin('category as c', 'e.cid', '=', 'c.id')
                 ->where('e.status', 1)
                 ->where('cid', CAT_HOME1)
                 ->orderBy('RAND()', '')
                 ->limit(10)
                 ->get();

$cat_home_2 = $db->table('ebook as e')
                 ->select(['e.id', 'e.name', 'e.slug', 'e.author', 'e.img_folder', 'e.image', 'e.created_at', 'e.cid', 'c.name as cat_title', 'c.slug as cat_slug'])
                 ->leftJoin('category as c', 'e.cid', '=', 'c.id')
                 ->where('e.status', 1)
                 ->where('cid', CAT_HOME2)
                 ->orderBy('RAND()', '')
                 ->limit(10)
                 ->get();


$latestblogs = $db->table("blogs as p")
                    ->where('p.status', 1)
                    ->leftJoin('cats as c', 'p.cid', '=', 'c.id')
                    ->leftJoin('admin_tb as a', 'p.admin_id', '=', 'a.id')
                    ->select(['p.*', 'c.name as cat_name', 'a.name as author'])
                    ->orderby('p.id', 'DESC')
                    ->limit(6)
                    ->get();  


?>