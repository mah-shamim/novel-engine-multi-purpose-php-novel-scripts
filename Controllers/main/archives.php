<?php
global $lang, $isLogin, $AuthUser;

$gen = new App\General\All();
$db = new App\General\DB;

$par = str_replace('/', '', $_SERVER['REQUEST_URI']);
$slug = removeQ($par);
$isLatest = false;





if($slug == 'category') {
    $table =  'category';
    $title = "Category";

    $limit = FILE_LIMIT;
    $cPage = 1;
    $page = Input('page') ? Input('page') :1;
    $offset = ($page - 1) * $limit;
    $totalFiles = $db->table($table)->where('status', 1)->count();
    $totalpages = ceil($totalFiles / $limit);

    $lists = $db->table('category as c')
                   ->select(['c.*', '(SELECT COUNT(*) FROM ebook as e WHERE e.cid = c.id) as total_post'])
                   ->where('c.status', 1)
                   ->groupBy('c.id')
                   ->orderBy('c.id', 'DESC')
                   ->limit($limit)
                   ->offset($offset)
                   ->get();

}elseif($slug == 'authors') {
    $table =  'author';
    $title = "Authors";
    $slug = "author";

    $limit = FILE_LIMIT;
    $cPage = 1;
    $page = Input('page') ? Input('page') :1;
    $offset = ($page - 1) * $limit;
    $totalFiles = $db->table($table)->where('status', 1)->count();
    $totalpages = ceil($totalFiles / $limit);


    $lists = $db->table('author as a')
                    ->select([
                    'a.*',
                    "(SELECT COUNT(*) FROM ebook as e WHERE e.author LIKE CONCAT('%', a.name, '%')) as total_post"
                    ])
                    ->where('a.status', 1)
                    ->groupBy('a.id')
                   ->orderBy('a.id', 'DESC')
                   ->limit($limit)
                   ->offset($offset)
                   ->get();

} elseif($slug == 'groups') {
    $table = '`groups`';
    $title = "Groups";
    $slug = "group";

    $limit = FILE_LIMIT;
    $cPage = 1;
    $page = Input('page') ? Input('page') :1;
    $offset = ($page - 1) * $limit;
    $totalFiles = $db->table($table)->where('status', 1)->count();
    $totalpages = ceil($totalFiles / $limit);


    $lists = $db->table('`groups` as g')
                    ->select([
                    'g.*',
                    "(SELECT COUNT(*) FROM ebook as e WHERE e.groupes LIKE CONCAT('%', g.name, '%')) as total_post"
                ])
                    ->where('g.status', 1)
                    ->groupBy('g.id')
                   ->orderBy('g.id', 'DESC')
                   ->limit($limit)
                   ->offset($offset)
                   ->get();

}else if($slug == 'compilers') {
    $table = 'compiler';
    $title = "Compiler";
    $slug = "compiler";

    $limit = FILE_LIMIT;
    $cPage = 1;
    $page = Input('page') ? Input('page') :1;
    $offset = ($page - 1) * $limit;
    $totalFiles = $db->table($table)->where('status', 1)->count();
    $totalpages = ceil($totalFiles / $limit);


    $lists = $db->table('compiler as c')
                ->select([
                'c.*',
                "(SELECT COUNT(*) FROM ebook as e WHERE e.compiler LIKE CONCAT('%', c.name, '%')) as total_post"
            ])
                ->where('c.status', 1)
                ->groupBy('c.id')
                ->orderBy('c.id', 'DESC')
                ->limit($limit)
                ->offset($offset)
                ->get();

} else if($slug == 'books') {
    $table =  'book';
    $title = "Books Album";
    $slug = "book";

    $limit = FILE_LIMIT;
    $cPage = 1;
    $page = Input('page') ? Input('page') :1;
    $offset = ($page - 1) * $limit;
    $totalFiles = $db->table($table)->where('status', 1)->count();
    $totalpages = ceil($totalFiles / $limit);


    $lists = $db->table('book as b')
                ->select(['b.*', '(SELECT COUNT(*) FROM ebook as e WHERE e.baid = b.id) as total_post'])
                ->where('b.status', 1)
                ->orderBy('b.id', 'DESC')
                ->limit($limit)
                ->offset($offset)
                ->get();

} else if($slug == "ebooks") {
    $table =  'ebook';
    $title = "Latest Ebooks";
    $slug = "ebook";
    $isLatest = true;

    $limit = FILE_LIMIT;
    $cPage = 1;
    $page = Input('page') ? Input('page') :1;
    $offset = ($page - 1) * $limit;
    $totalFiles = $db->table($table)->where('status', 1)->count();
    $totalpages = ceil($totalFiles / $limit);

    
} else {
    Redirect("/");
}






$rows = $isLatest ? $db->table("$table as e")
                    ->select(['e.id', 'e.name', 'e.slug', 'e.author', 'e.img_folder', 'e.image', 'e.created_at', 'e.cid', 'c.name as cat_title', 'c.slug as cat_slug', 'e.views'])
                    ->leftJoin('category as c', 'e.cid', '=', 'c.id')
                    ->where('e.status', 1)
                    ->orderBy('e.id', 'DESC')
                    ->limit($limit)
                    ->offset($offset)
                    ->get() 
                  : 
                    $lists;

$latests = $db->table('ebook')
            ->select('*')
            ->where('status', 1)
            ->orderBy('RAND()', '')
            ->limit(3)
            ->get();

$title .= $isLatest ? '' : ' Archives';

if(isset($_GET['page'])) {
    $title = 'Page '.Input('page').' of ' .$totalpages.' '. $title;
}

include('sidebar.php');
?>