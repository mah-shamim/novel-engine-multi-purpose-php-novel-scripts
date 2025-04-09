<?php
global $lang, $isLogin, $AuthUser;
$url = $_SERVER['REQUEST_URI'];
$table = getPart($url, 1);
$gen = new App\General\All();
$db = new App\General\DB();


if($table == 'category'  || $table == 'author' || $table == 'group' || $table == 'compiler' || $table == 'book') {
    
    $popularLists = $gen->getList('ebook', 'views', 20);
    $limit = FILE_LIMIT;
    $cPage = 1;
    $page = Input('page') ? Input('page') :1;
    $offset = ($page - 1) * $limit;
    

    switch($table) {
        case "category":
            
            $data = $db->table($table)->where('slug', $slug)->first();

            if($data) {
                $id = $data['id'];
                $name = $data['name'];
                $rows = $db->table('ebook')
                            ->where('status', 1)
                            ->where('cid', $id)
                            ->orderby('id', 'DESC')
                            ->limit($limit)
                            ->offset($offset)
                            ->get();

                $totalFiles = $db->table('ebook')->where('status', 1)->where('cid', $id)->count();
                
                $title = $data['title'] ? $data['title'] : str_replace('{{CATEGORY_NAME}}', $name, $lang['CATLIST_TITLE']);
                $metadescription = $data['meta_desc'] ? $data['meta_desc'] : str_replace('{{CATEGORY_NAME}}',$name, $lang['CATLIST_META_DESCRIPTION']);
                $metakeyword = $data['meta_key'] ? $data['meta_key'] : str_replace('{{CATEGORY_NAME}}',$name, $lang['CATLIST_META_KEYWORDS']);

                $ogImage = $data['image'] ? APP_URL.'/Public/thumb/'.$data['img_folder'].'/'.$data['image'] : APP_URL.'/Public/assets/main/img/noimg.jpg';

            } else {
                Redirect("/");
            }
            break;
        case "author":

            $data = $db->table('author')->where('slug', $slug)->first();

            if($data) {
                
                $id = $data['id'];
                $name = $data['name'];
                $rows = $db->table('ebook')
                            ->where('status', 1)
                            ->search(['author'], $data['name'])
                            ->orderby('id', 'DESC')
                            ->limit($limit)
                            ->offset($offset)
                            ->get();

                $totalFiles = $db->table('ebook')
                            ->where('status', 1)
                            ->search(['author'], $data['name'])
                            ->count();
                
                $title = $data['title'] ? $data['title'] : str_replace('{{AUTHOR}}', $name, $lang['AUTHOR_TITLE']);
                $metadescription = $data['meta_desc'] ? $data['meta_desc'] : str_replace('{{CATEGORY_NAME}}',$name, $lang['AUTHOR_META_DESCRIPTION']);
                $metakeyword = $data['meta_key'] ? $data['meta_key'] : str_replace('{{CATEGORY_NAME}}',$name, $lang['AUTHOR_META_KEYWORDS']);
             
                $ogImage = $data['image'] ? APP_URL.'/Public/thumb/'.$data['img_folder'].'/'.$data['image'] : APP_URL.'/Public/assets/main/img/noimg.jpg';

            } else {
                Redirect("/");
            }
            break;
        case "group":
            $table = '`groups`';

            $data = $db->table($table)->where('slug', $slug)->first();

            if($data) {
                
                $id = $data['id'];
                $name = $data['name'];
                $rows = $db->table('ebook')
                            ->where('status', 1)
                            ->search(['groupes'], $data['name'])
                            ->orderby('id', 'DESC')
                            ->limit($limit)
                            ->offset($offset)
                            ->get();

                $totalFiles = $db->table('ebook')->where('status', 1)->search(['groupes'], $data['name'])->count();
                
                $title = $data['title'] ? $data['title'] : str_replace('{{CATEGORY_NAME}}', $name, $lang['CATLIST_TITLE']);
                $metadescription = $data['meta_desc'] ? $data['meta_desc'] : str_replace('{{CATEGORY_NAME}}',$name, $lang['CATLIST_META_DESCRIPTION']);
                $metakeyword = $data['meta_key'] ? $data['meta_key'] : str_replace('{{CATEGORY_NAME}}',$name, $lang['CATLIST_META_KEYWORDS']);

                $ogImage = $data['image'] ? APP_URL.'/Public/thumb/'.$data['img_folder'].'/'.$data['image'] : APP_URL.'/Public/assets/main/img/noimg.jpg';

            } else {
                Redirect("/");
            }

        
            break;
        case "compiler":


            $data = $db->table($table)->where('slug', $slug)->first();

            if($data) {
                
                $id = $data['id'];
                $name = $data['name'];
                $rows = $db->table('ebook')
                            ->where('status', 1)
                            ->search(['compiler'], $data['name'])
                            ->orderby('id', 'DESC')
                            ->limit($limit)
                            ->offset($offset)
                            ->get();

                $totalFiles = $db->table('ebook')->where('status', 1)->search(['compiler'], $data['name'])->count();
                
                $title = $data['title'] ? $data['title'] : str_replace('{{CATEGORY_NAME}}', $name, $lang['CATLIST_TITLE']);
                $metadescription = $data['meta_desc'] ? $data['meta_desc'] : str_replace('{{CATEGORY_NAME}}',$name, $lang['CATLIST_META_DESCRIPTION']);
                $metakeyword = $data['meta_key'] ? $data['meta_key'] : str_replace('{{CATEGORY_NAME}}',$name, $lang['CATLIST_META_KEYWORDS']);

                $ogImage = $data['image'] ? APP_URL.'/Public/thumb/'.$data['img_folder'].'/'.$data['image'] : APP_URL.'/Public/assets/main/img/noimg.jpg';

            } else {
                Redirect("/");
            }
            break;
        case "book":

            $data = $db->table($table)->where('slug', $slug)->first();

            if($data) {
                $id = $data['id'];
                $name = $data['name'];
                $rows = $db->table('ebook')
                            ->where('status', 1)
                            ->where('baid', $id)
                            ->orderby('id', 'DESC')
                            ->limit($limit)
                            ->offset($offset)
                            ->get();

                $totalFiles = $db->table('ebook')->where('status', 1)->where('baid', $id)->count();
                
                $title = $data['title'] ? $data['title'] : str_replace('{{BOOK}}', $name, $lang['BOOK_TITLE']);
                $metadescription = $data['meta_desc'] ? $data['meta_desc'] : str_replace(['{{BOOK}}', '{{AUTHOR}}'], [$name, $data['author']], $lang['BOOK_META_DESCRIPTION']);
                $metakeyword = $data['meta_key'] ? $data['meta_key'] : str_replace(['{{BOOK}}', '{{AUTHOR}}'], [$name, $data['author']], $lang['BOOK_META_KEYWORDS']);

                $ogImage = $data['image'] ? APP_URL.'/Public/thumb/450x650'.$data['img_folder'].'/'.$data['image'] : APP_URL.'/Public/assets/main/img/noimg.jpg';

            } else {
                Redirect("/");
            }
            break;
        default: 
            Redirect("/");
            break;
    }

}


$totalpages = ceil($totalFiles / $limit);

$title = $name.' Ebooks';

$latests = $db->table('ebook')
            ->select('*')
            ->where('status', 1)
            ->orderBy('RAND()', '')
            ->limit(3)
            ->get();


if(isset($_GET['page'])) {
    $title = 'Page '.Input('page').' of ' .$totalpages.' '. $title;
}

include('sidebar.php');

