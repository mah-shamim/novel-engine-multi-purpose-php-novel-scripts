<?php
global $lang, $isLogin, $AuthUser;

    $gen = new App\General\All();
    $db = new App\General\DB();
    $post = $db->table('blogs as e')
                ->leftJoin('cats as c', 'e.cid', '=', 'c.id')
                ->leftJoin('admin_tb as b', 'e.admin_id', '=', 'b.id')
                ->select(['e.*', 'c.name as cat_name', 'c.slug as cat_slug', 'c.id as cat_id', 'b.name as author'])
                ->where('e.slug', $slug)
                ->first();  

  $latests = $db->table('ebook')
            ->select('*')
            ->where('status', 1)
            ->orderBy('RAND()', '')
            ->limit(3)
            ->get();

    if($post) {

        $breadcrumb = [];
        $schema = [];


        $id = $post['id'];
        $views = $post['views'] + 1;
        $db->table('blogs')->where('id', $id)->update(['views' => $views]);
        $image = '';
    
        if(empty($post['image'])) {
            $image = APP_URL.'/Public/assets/main/img/noimg.jpg';
        } else {
            $image = APP_URL.'/Public/thumb'.$post['img_folder'].'/'.$post['image'];
    
        }
        


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
                    '@id' => APP_URL.'/blog?cat=/'.$post['cat_id'],
                    'name' => $post['cat_name'],
                ],
            ];
            
            $breadcrumb[] = [
                '@type' => 'ListItem',
                'position' => 3,
                'item' => [
                    '@id' => APP_URL.'/blog/'.$post['slug'],
                    'name' => $post['name'],
                ],
            ];
        
    
        
    

        $reviews = $db->table('comments')->
                        where('status', 1)
                        ->where('post_id', $post['id'])
                        ->orderBy('id', 'DESC')
                        ->get();

        $_cats = $db->table('cats as c')
                   ->select(['c.*', '(SELECT COUNT(*) FROM blogs as e WHERE e.cid = c.id) as total_post'])
                   ->where('c.status', 1)
                   ->groupBy('c.id')
                   ->orderBy('c.id', 'DESC')
                   ->get();
                       
        
        $schema[] = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => APP_URL.'/blog/'.$post['slug'],
            ],
            "headline" => $post['name'],
            "image" => $image,
            "datePublished" => $post['created_at'],
            "author" => [
                "@type" => "Person",
                "name" => $post['author'],
            ],
            'breadcrumb' => [
                '@type' => 'BreadcrumbList',
                'itemListElement' => $breadcrumb,
            ],
        ];
    
        $title = $post['title'] ? $post['title'] : $post['name'];
        $metadescription = $post['meta_desc'] ? $post['meta_desc'] : substr($post['description'], 0, 500);
        $metakeyword = $post['meta_key'] ? $post['meta_key'] : $post['name'];

        $ogImage = $post['image'] ? APP_URL.'/Public/thumb'.$post['img_folder'].'/'.$post['image'] : APP_URL.'/Public/assets/main/img/noimg.jpg';

        $recents = $db->table('blogs')
        ->where('status', 1)
        ->orderBy('id', 'DESC')
        ->limit(10)
        ->get();

    } else {
        Redirect("/error");
    }
   





?>
