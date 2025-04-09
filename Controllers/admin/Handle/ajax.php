<?php

use App\General\Admin;
require_once __DIR__.'/../../../config/config.php';

header("Content-Type: application/json");

$check = [];

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $action = Input('action');

    switch($action) {
        case 'addauthor':
            $Genre = new  Admin\Author();
            $All = new App\General\All();

            $data = [
                'name' => Input('name'),
                'slug' => Input('slug'),
                'img_name' => $_FILES['image']['name'],
                'img_tmp' => $_FILES['image']['tmp_name'],
                'img_size' => $_FILES['image']['size'],
                'img_url' => Input('img_url'),
                'status' => Input('status') ? 1 : 0,
                'isHome' => Input('isHome') ? 1 : 0,
                'meta_title' => Input('title'),
                'meta_key' => Input('keyword'),
                'meta_desc' => Input('Description'),

            ];

            $check = $Genre->addGenre($data);
            break;
        case 'editauthor' :
            $Genre = new  Admin\Author();
            $All = new App\General\All();

            $data = [
                'name' => Input('name'),
                'slug' => Input('slug'),
                'img_name' => $_FILES['image']['name'],
                'img_tmp' => $_FILES['image']['tmp_name'],
                'img_size' => $_FILES['image']['size'],
                'img_url' => Input('img_url'),
                'status' => Input('status') ? 1 : 0,
                'isHome' => Input('isHome') ? 1 : 0,
                'meta_title' => Input('title'),
                'meta_key' => Input('keyword'),
                'meta_desc' => Input('Description'),
                'hiddenimg' => Input('hiddenimg'),
                'hiddenimg_foler' => Input('hiddenimg_foler'),
                

            ];

            $id = Input('id');

            $check = $Genre->editGenre($data, $id);
            break;
            case 'addcompiler':
                $Star = new  Admin\Compiler();
                $All = new App\General\All();
    
                $data = [
                    'name' => Input('name'),
                    'slug' => Input('slug'),
                    'img_name' => $_FILES['image']['name'],
                    'img_tmp' => $_FILES['image']['tmp_name'],
                    'img_size' => $_FILES['image']['size'],
                    'img_url' => Input('img_url'),
                    'status' => Input('status') ? 1 : 0,
                    'isHome' => Input('isHome') ? 1 : 0,
                    'meta_title' => Input('title'),
                    'meta_key' => Input('keyword'),
                    'meta_desc' => Input('Description'),
    
                ];
    
                $check = $Star->add($data);
                break;
            case 'editcompiler':
                $Star = new  Admin\Compiler();
            $All = new App\General\All();

            $data = [
                'name' => Input('name'),
                'slug' => Input('slug'),
                'img_name' => $_FILES['image']['name'],
                'img_tmp' => $_FILES['image']['tmp_name'],
                'img_size' => $_FILES['image']['size'],
                'img_url' => Input('img_url'),
                'status' => Input('status') ? 1 : 0,
                'isHome' => Input('isHome') ? 1 : 0,
                'meta_title' => Input('title'),
                'meta_key' => Input('keyword'),
                'meta_desc' => Input('Description'),
                'hiddenimg' => Input('hiddenimg'),
                'hiddenimg_foler' => Input('hiddenimg_foler'),
                

            ];

            $id = Input('id');

            $check = $Star->edit($data, $id);
            break;

            case 'addgroup':
                $Director = new  Admin\Group();
    
                $data = [
                    'name' => Input('name'),
                    'slug' => Input('slug'),
                    'img_name' => $_FILES['image']['name'],
                    'img_tmp' => $_FILES['image']['tmp_name'],
                    'img_size' => $_FILES['image']['size'],
                    'img_url' => Input('img_url'),
                    'status' => Input('status') ? 1 : 0,
                    'isHome' => Input('isHome') ? 1 : 0,
                    'meta_title' => Input('title'),
                    'meta_key' => Input('keyword'),
                    'meta_desc' => Input('Description'),
    
                ];
    
                $check = $Director->Add($data);
                break;
        case 'editgroup':
            $Director = new  Admin\Group();
            

            $data = [
                'name' => Input('name'),
                'slug' => Input('slug'),
                'img_name' => $_FILES['image']['name'],
                'img_tmp' => $_FILES['image']['tmp_name'],
                'img_size' => $_FILES['image']['size'],
                'img_url' => Input('img_url'),
                'status' => Input('status') ? 1 : 0,
                'isHome' => Input('isHome') ? 1 : 0,
                'meta_title' => Input('title'),
                'meta_key' => Input('keyword'),
                'meta_desc' => Input('Description'),
                'hiddenimg' => Input('hiddenimg'),
                'hiddenimg_foler' => Input('hiddenimg_foler'),
                

            ];

            $id = Input('id');

            $check = $Director->Edit($data, $id);
            break;

        case 'addcategory':
                $Series = new  Admin\Category();
    
                $data = [
                    'name' => Input('name'),
                    'slug' => Input('slug'),
                    'description' => Input('desc'),
                    'img_name' => $_FILES['image']['name'],
                    'img_tmp' => $_FILES['image']['tmp_name'],
                    'img_size' => $_FILES['image']['size'],
                    'img_url' => Input('img_url'),
                    'status' => Input('status') ? 1 : 0,
                    'isHome' => Input('isHome') ? 1 : 0,
                    'meta_title' => Input('title'),
                    'meta_key' => Input('keyword'),
                    'meta_desc' => Input('Description'),
    
                ];
                $check = $Series->Add($data);
                break;
        case 'editcategory':
            $Series = new  Admin\Category();

            

            $data = [
                'name' => Input('name'),
                'slug' => Input('slug'), 
                'description' => Input('desc'),
                'img_name' => $_FILES['image']['name'],
                'img_tmp' => $_FILES['image']['tmp_name'],
                'img_size' => $_FILES['image']['size'],
                'img_url' => Input('img_url'),
                'status' => Input('status') ? 1 : 0,
                'isHome' => Input('isHome') ? 1 : 0,
                'meta_title' => Input('title'),
                'meta_key' => Input('keyword'),
                'meta_desc' => Input('Description'),
                'hiddenimg' => Input('hiddenimg'),
                'hiddenimg_foler' => Input('hiddenimg_foler'),
                

            ];

            $id = Input('id');

            $check = $Series->Edit($data, $id);
            break;
            case 'addpage':
                $Series = new  Admin\Page();
    
                $data = [
                    'name' => Input('name'),
                    'slug' => Input('slug'),
                    'description' => Input('desc'),
                    'img_name' => $_FILES['image']['name'],
                    'img_tmp' => $_FILES['image']['tmp_name'],
                    'img_size' => $_FILES['image']['size'],
                    'img_url' => Input('img_url'),
                    'status' => Input('status') ? 1 : 0,
                    'isHome' => Input('isHome') ? 1 : 0,
                    'meta_title' => Input('title'),
                    'meta_key' => Input('keyword'),
                    'meta_desc' => Input('Description'),
    
                ];
    
                $check = $Series->Add($data);
                break;
            case 'editpage':
            $Series = new  Admin\Page();

            

            $data = [
                'name' => Input('name'),
                'slug' => Input('slug'), 
                'description' => Input('desc'),
                'img_name' => $_FILES['image']['name'],
                'img_tmp' => $_FILES['image']['tmp_name'],
                'img_size' => $_FILES['image']['size'],
                'img_url' => Input('img_url'),
                'status' => Input('status') ? 1 : 0,
                'isHome' => Input('isHome') ? 1 : 0,
                'meta_title' => Input('title'),
                'meta_key' => Input('keyword'),
                'meta_desc' => Input('Description'),
                'hiddenimg' => Input('hiddenimg'),
                'hiddenimg_foler' => Input('hiddenimg_foler'),
                

            ];

            $id = Input('id');

            $check = $Series->Edit($data, $id);
            break;
            case 'addbook':
                $Book = new  Admin\Book();
    
                $data = [
                    'name' => Input('name'),
                    'author' => InputArray('author'),
                    'groups' => InputArray('groups'),
                    'slug' => Input('slug'),
                    'cid' => Input('cid'),
                    'description' => Input('desc'),
                    'img_name' => $_FILES['image']['name'],
                    'img_tmp' => $_FILES['image']['tmp_name'],
                    'img_size' => $_FILES['image']['size'],
                    'img_url' => Input('img_url'),
                    'status' => Input('status') ? 1 : 0,
                    'isHome' => Input('isHome') ? 1 : 0,
                    'meta_title' => Input('title'),
                    'meta_key' => Input('keyword'),
                    'meta_desc' => Input('Description'),
    
                ];
    
                $check = $Book->Add($data);
                break;
                case 'editbook':
                    $Book = new  Admin\Book();
        
                    $data = [
                        'name' => Input('name'),
                        'author' => InputArray('author'),
                        'groups' => InputArray('groups'),
                        'slug' => Input('slug'),
                        'cid' => Input('cid'),

                        'description' => Input('desc'),
                        'img_name' => $_FILES['image']['name'],
                        'img_tmp' => $_FILES['image']['tmp_name'],
                        'img_size' => $_FILES['image']['size'],
                        'img_url' => Input('img_url'),
                        'status' => Input('status') ? 1 : 0,
                        'isHome' => Input('isHome') ? 1 : 0,
                        'meta_title' => Input('title'),
                        'meta_key' => Input('keyword'),
                        'meta_desc' => Input('Description'),
                        'hiddenimg' => Input('hiddenimg'),
                        'hiddenimg_foler' => Input('hiddenimg_foler'),
        
                    ];
                    $id = Input('id');
                    $check = $Book->edit($data, $id);
                    break;
            case 'addebook':
                $Ebook = new  Admin\Ebook();
        
                    $data = [
                        'name' => Input('name'),
                        'author' => InputArray('author'),
                        'groups' => InputArray('groups'),
                        'compiler' => InputArray('compiler'),
                        'slug' => Input('slug'),
                        'phone' => Input('phone'),
                        'cid' => Input('cid'),
                        'baid' => !empty(Input('baid')) ? Input('baid') : NULL,
                        'description' => Input('desc'),
                        'img_name' => $_FILES['image']['name'],
                        'img_tmp' => $_FILES['image']['tmp_name'],
                        'img_size' => $_FILES['image']['size'],
                        'img_url' => Input('img_url'),
                        'file_name' => $_FILES['file']['name'],
                        'file_tmp' => $_FILES['file']['tmp_name'],
                        'file_size' => $_FILES['file']['size'],
                        'file_url' => Input('file_url'),
                        'status' => Input('status') ? 1 : 0,
                        'isHome' => Input('isHome') ? 1 : 0,
                        'isDownload' => Input('isDownload') ? 1 : 0,
                        'isRead' => Input('isRead') ? 1 : 0,
                        'Free' => Input('Free') ? 1 : 0,
                        'isTrend' => Input('isTrend') ? 1 : 0,
                        'meta_title' => Input('title'),
                        'meta_key' => Input('keyword'),
                        'meta_desc' => Input('Description'),
        
                    ];
        
                    $check = $Ebook->Adds($data);
                    break;
                    case 'editebook':
                        $Ebook = new  Admin\Ebook();
                
                            $data = [
                                'name' => Input('name'),
                                'author' => InputArray('author'),
                                'groups' => InputArray('groups'),
                                'compiler' => InputArray('compiler'),
                                'slug' => Input('slug'),
                                'phone' => Input('phone'),
                                'cid' => Input('cid'),
                                'ext' => Input('ext'),
                                'hiddenfile' => Input('hiddenfile'),
                                'hiddenff' => Input('hiddenfilefoler'),
                                'hiddenimg' => Input('hiddenimg'),
                                'hiddenimg_foler' => Input('hiddenimg_foler'),
                                'hidesize' => Input('hidesize'),
                                'baid' => !empty(Input('baid')) ? Input('baid') : NULL,
                                'description' => Input('desc'),
                                'img_name' => $_FILES['image']['name'],
                                'img_tmp' => $_FILES['image']['tmp_name'],
                                'img_size' => $_FILES['image']['size'],
                                'img_url' => Input('img_url'),
                                'file_name' => $_FILES['file']['name'],
                                'file_tmp' => $_FILES['file']['tmp_name'],
                                'file_size' => $_FILES['file']['size'],
                                'file_url' => Input('file_url'),
                                'status' => Input('status') ? 1 : 0,
                                'isHome' => Input('isHome') ? 1 : 0,
                                'isDownload' => Input('isDownload') ? 1 : 0,
                                'isTrend' => Input('isTrend') ? 1 : 0,
                                'isRead' => Input('isRead') ? 1 : 0,
                                'Free' => Input('Free') ? 1 : 0,
                                'meta_title' => Input('title'),
                                'meta_key' => Input('keyword'),
                                'meta_desc' => Input('Description'),
                
                            ];

                            $id = Input('id');
                            $check = $Ebook->Edit($data, $id);
                            break;
            case 'addpackage':
                $package = new App\General\Admin\Package();
                $check = $package->add($_POST);
                break;
            case 'subscribe':
                $subs = new App\General\Admin\Subscription();
                $check = $subs->add($_POST);
                break;
            case 'reviewreply':
                $subs = new App\General\Admin\Reviews();
                $check = $subs->addreply();
                break;
            case 'addblogcategory':
                $Series = new  Admin\Cats();
                $data = [
                    'name' => Input('name'),
                    'slug' => Input('slug'),
                    'description' => Input('desc'),
                    'img_name' => $_FILES['image']['name'],
                    'img_tmp' => $_FILES['image']['tmp_name'],
                    'img_size' => $_FILES['image']['size'],
                    'img_url' => Input('img_url'),
                    'status' => Input('status') ? 1 : 0,
                ];
                $check = $Series->Add($data);
                break;
            case 'editblogcategory':
                $blogCat = new  Admin\Cats();
                $data = [
                    'name' => Input('name'),
                    'slug' => Input('slug'), 
                    'description' => Input('desc'),
                    'img_name' => $_FILES['image']['name'],
                    'img_tmp' => $_FILES['image']['tmp_name'],
                    'img_size' => $_FILES['image']['size'],
                    'img_url' => Input('img_url'),
                    'status' => Input('status') ? 1 : 0,
                    'hiddenimg' => Input('hiddenimg'),
                    'hiddenimg_foler' => Input('hiddenimg_foler'),
                ];
                $id = Input('id');
                $check = $blogCat->Edit($data, $id);
                break;
            case 'addblog':
                $Blog = new  Admin\Blogs();
        
                $data = [
                    'name' => Input('name'),
                    'slug' => Input('slug'),
                    'cid' => Input('cid'),
                    'description' => Input('desc'),
                    'img_name' => $_FILES['image']['name'],
                    'img_tmp' => $_FILES['image']['tmp_name'],
                    'img_size' => $_FILES['image']['size'],
                    'img_url' => Input('img_url'),
                    'status' => Input('status') ? 1 : 0,
                    'isHome' => Input('isHome') ? 1 : 0,
                    'meta_title' => Input('title'),
                    'meta_key' => Input('keyword'),
                    'meta_desc' => Input('Description'),
    
                ];
    
                $check = $Blog->Adds($data);
                
                break;
            case 'editblogpost':

                $Blogs = new  Admin\Blogs();
                
                $data = [
                    'name' => Input('name'),
                    'slug' => Input('slug'),
                    'cid' => Input('cid'),
                    'hiddenimg' => Input('hiddenimg'),
                    'hiddenimg_foler' => Input('hiddenimg_foler'),
                    'description' => Input('desc'),
                    'img_name' => $_FILES['image']['name'],
                    'img_tmp' => $_FILES['image']['tmp_name'],
                    'img_size' => $_FILES['image']['size'],
                    'img_url' => Input('img_url'),
                    'status' => Input('status') ? 1 : 0,
                    'isHome' => Input('isHome') ? 1 : 0,
                    'meta_title' => Input('title'),
                    'meta_key' => Input('keyword'),
                    'meta_desc' => Input('Description'),
    
                ];

                $id = Input('id');
                $check = $Blogs->Edit($data, $id);

                break;
            case 'sitemap':
                $sitemap = new Admin\Sitemap();
                $check = $sitemap->Ping();
                break;
            default:
                $check = ['s' => 0, 'm' => 'Action not found'];
                break;

    }


        echo json_encode($check);








}




?>