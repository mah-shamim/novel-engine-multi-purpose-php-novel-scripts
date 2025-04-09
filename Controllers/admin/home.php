<?php
$title = "Admin Dashboard";
$gen = new App\General\All();
$db = new App\General\DB;

$totalFiles = $gen->getTotal("ebook");
$totalBooks = $gen->getTotal("book");
$totalCats = $gen->getTotal("category");
$totalAuthors = $gen->getTotal("author");
$totalGroups = $gen->getTotal("`groups`");
$totalcompiler = $gen->getTotal("compiler");
$totalUsers = $gen->getTotal("users");


$monthFiles = $db->table('ebook')
                 ->where('YEAR(created_at)', date('Y'))
                 ->where('MONTH(created_at)', date('m'))
                 ->count();

$downloads = $db->table('ebook')->select(['SUM(download) as total_download', 'SUM(views) as total_views'])->get();

$recentEbooks = $db->table('ebook as e')
                    ->leftJoin('category as c', 'e.cid', '=', 'c.id')
                    ->select(['e.name', 'e.image', 'e.img_folder', 'e.author', 'e.slug', 'c.name as cat_name'])
                    ->limit(10)
                    ->orderBy('e.id', 'DESC')
                    ->get();

$recentPosts = $db->table('blogs as e')
                    ->leftJoin('cats as c', 'e.cid', '=', 'c.id')
                    ->leftJoin('admin_tb as a', 'e.admin_id', '=', 'a.id')
                    ->select(['e.name', 'e.image', 'e.img_folder', 'e.slug', 'c.name as cat_name', 'a.name as admin'])
                    ->limit(10)
                    ->orderBy('e.id', 'DESC')
                    ->get();
