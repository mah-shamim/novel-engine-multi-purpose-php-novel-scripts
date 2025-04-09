<?php
global $lang, $isLogin, $AuthUser;
if(isset($slug)) {
    $gen = new App\General\All();
    $db = new App\General\DB;
    $page = $gen->getRow('page', 'slug', $slug);
    if($page) {
        $imagepage = '';
    
        if(empty($page['image'])) {
            $imagepage = APP_URL.'/Public/assets/main/img/noimg.jpg';
        } else {
            $imagepage = APP_URL.'/Public/thumb'.$page['img_folder'].'/'.$page['image'];
        }
        

        $popularLists = $gen->getList('ebook', 'views', 20);
    
        $breadcrumb = [];
        $schema = [];
    
        $breadcrumb[] = [
            '@type' => 'ListItem',
            'position' => 1,
            'item' => [
                '@id' => '/',
                'name' => 'Home',
            ],
        ];
            
        $breadcrumb[] = [
            '@type' => 'ListItem',
            'position' => 2,
            'item' => [
                '@id' => APP_URL.'/page/'.$page['slug'],
                'name' => $page['name'],
            ],
        ];
        
        $schema[] = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => APP_URL.'/page/'.$page['slug'],
            ],
            "headline" => $page['name'],
            "image" => $imagepage,
            "datePublished" => date('d m y', strtotime($page['created_at'])),
            "author" => [
                "@type" => "Person",
                "name" => "ShuraidDev",
            ],
            'breadcrumb' => [
                '@type' => 'BreadcrumbList',
                'itemListElement' => $breadcrumb,
            ],
        ];
    
        $title = $page['title'] ? $page['title'] : $page['name'];
        $metadescription = $page['meta_desc'] ? $page['meta_desc'] :  "";
        $metakeyword = $page['meta_key'] ? $page['meta_key'] : "";

        $latests = $db->table('ebook')
        ->select('*')
        ->where('status', 1)
        ->orderBy('RAND()', '')
        ->limit(3)
        ->get();

        $ogImage = $page['image'] ? APP_URL.'/Public/thumb'.$page['img_folder'].'/'.$page['image'] : APP_URL.'/Public/assets/main/img/noimg.jpg';
        include('sidebar.php');
    } else {
        Redirect("/");
        exit;
    }
} else {
    Redirect("/");
    exit;
}



?>
