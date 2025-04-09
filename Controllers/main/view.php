<?php
global $lang, $isLogin, $AuthUser;
if(isset($slug)) {
    $gen = new App\General\All();
    $db = new App\General\DB();
    $file = $db->table('ebook as e')
                ->leftJoin('category as c', 'e.cid', '=', 'c.id')
                ->leftJoin('book as b', 'e.baid', '=', 'b.id')
                ->select(['e.*', 'c.name as cat_name', 'c.slug as cat_slug', 'b.name as book_name', 'b.slug as book_slug'])
                ->where('e.status', 1)
                ->where('e.slug', $slug)
                ->first();
                
  $latests = $db->table('ebook')
            ->select('*')
            ->where('status', 1)
            ->orderBy('RAND()', '')
            ->limit(3)
            ->get();

    if($file) {

        $breadcrumb = [];
        $schema = [];

        $isDownload = false;
        
        if(DOWNLOAD == 1) {
            $isDownload = true;
        } 

        

        $id = $file['id'];
        $views = $file['views'] + 1;
        $db->table('ebook')->where('id', $id)->update(['views' => $views]);
        $image = '';
    
        if(empty($file['image'])) {
            $image = APP_URL.'/Public/assets/main/img/noimg.jpg';
        } else {
            $image = APP_URL.'/Public/thumb/450x650'.$file['img_folder'].'/'.$file['image'];
    
        }
        
        if($file['author']) {
            $authors = explode(',', $file['author']);
    
            $authorLinks = [];
            foreach($authors as $art) {
                $author = $db->table('author')->search(['name'], $art)->first();
    
                if($author) {
                    $authorLinks[] = '<a href="'.APP_URL.'/author/'.$author['slug'].'">'.$author['name'].' </a>';
                }
            }
    
            $author = implode(', ', $authorLinks);
        }
    
        if($file['groupes']) {
            $groups = explode(',', $file['groupes']);
    
            $groupLinks = [];
            foreach($groups as $grp) {
                $groupD = $db->table('`groups`')->search(['name'], $grp)->first();
    
                if($groupD) {
                    $groupLinks[] = '<a href="'.APP_URL.'/group/'.$groupD['slug'].'">'.$groupD['name'].' </a>';
                }
            }
    
            $group = implode(', ', $groupLinks);
        }
    
        if($file['compiler']) {
            $compilers = explode(',', $file['compiler']);
    
            $compilerLinks = [];
            foreach($compilers as $crp) {
                $compilerD = $db->table('compiler')->search(['name'], $crp)->first();
    
                if($compilerD) {
                    $compilerLinks[] = '<a href="'.APP_URL.'/compiler/'.$compilerD['slug'].'">'.$compilerD['name'].' </a>';
                }
            }
    
            $compiler = implode(', ', $compilerLinks);
        }
    
        if ($file['baid']) {
    
            $book =  '<a href="'.APP_URL.'/book/'.$file['book_slug'].'">'.$file['book_name'].'</a>';

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
                    '@id' => APP_URL.'/category/'.$file['cat_slug'],
                    'name' => $file['cat_name'],
                ],
            ];

            $breadcrumb[] = [
                '@type' => 'ListItem',
                'position' => 3,
                'item' => [
                    '@id' => APP_URL.'/book/'.$file['book_slug'],
                    'name' => $file['book_name'],
                ],
            ];
            
            $breadcrumb[] = [
                '@type' => 'ListItem',
                'position' => 4,
                'item' => [
                    '@id' => APP_URL.'/'.$file['slug'],
                    'name' => $file['name'],
                ],
            ];
            
            
            
        } else {

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
                    '@id' => APP_URL.'/category/'.$file['cat_slug'],
                    'name' => $file['cat_name'],
                ],
            ];
            
            $breadcrumb[] = [
                '@type' => 'ListItem',
                'position' => 3,
                'item' => [
                    '@id' => APP_URL.'/'.$file['slug'],
                    'name' => $file['name'],
                ],
            ];
        }
    
        
    
        $relatedFiles = $db->table('ebook')->where('status', 1)->where('cid', $file['cid'])->limit(4)->get();

        $reviews = $db->table('reviews as r')->
                        where('r.status', 1)->
                        where('file_id', $file['id'])->
                        leftJoin('users as u', 'r.user_id', '=', 'u.id')
                        ->select(['r.*', 'u.username', 'name as user_name', 'image as user_image'])
                        ->orderBy('id', 'DESC')
                        ->get();
    
                        if($isLogin) {

                            $isSubscribe = $db->table('subscriptions')->where('user_id', $AuthUser['id'])->where('status', 1)->where('days', 0, '>')->first();
                        }
        
        $schema[] = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => APP_URL.'/'.$file['slug'],
            ],
            "headline" => $file['name'],
            "image" => $image,
            "datePublished" => $file['created_at'],
            "author" => [
                "@type" => "Person",
                "name" => "ShuraidDev",
            ],
            'breadcrumb' => [
                '@type' => 'BreadcrumbList',
                'itemListElement' => $breadcrumb,
            ],
        ];
    
        $title = $file['title'] ? $file['title'] : str_replace(['{{FILENAME}}', '{{CATEGORY_NAME}}', '{{AUTHOR}}'], [$file['name'], $file['cat_name'], $file['author']], $lang['FILE_TITLE']);
        $metadescription = $file['meta_desc'] ? $file['meta_desc'] : str_replace(['{{FILENAME}}', '{{CATEGORY_NAME}}', '{{AUTHOR}}'], [$file['name'], $file['cat_name'], $file['author']], $lang['FILE_META_DESCRIPTION']);
        $metakeyword = $file['meta_key'] ? $file['meta_key'] : str_replace(['{{FILENAME}}', '{{CATEGORY_NAME}}', '{{AUTHOR}}'], [$file['name'], $file['cat_name'], $file['author']], $lang['FILE_META_KEYWORDS']);

        $ogImage = $file['image'] ? APP_URL.'/Public/thumb/450x650'.$file['img_folder'].'/'.$file['image'] : APP_URL.'/Public/assets/main/img/noimg.jpg';



    } else {
        Redirect("/error");
    }
   

} else {
    Redirect("/error");
}



?>
