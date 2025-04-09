<?php

namespace App\General\Admin;
use App\General\DB;

class Sitemap extends DB {
    
    public function Ping()
    {
        $db = new DB();
        $RootPath = __DIR__.'/../../../';

        
            $ebooks = $db->table('ebook')->where('status', 1)->get();
            $cats = $db->where('status', 1)->table('category')->get();
            $albums = $db->where('status', 1)->table('book')->get();
            $author =  $db->where('status', 1)->table('author')->get();
            $blogs =  $db->where('status', 1)->table('blogs')->get();
            $blog_cats =  $db->where('status', 1)->table('cats')->get();
            $compilers =  $db->where('status', 1)->table('compiler')->get();  
            $groups =  $db->where('status', 1)->table('`groups`')->get(); 
            $pages =  $db->where('status', 1)->table('page')->get();
            
            $str = '<?xml version="1.0" encoding="UTF-8"?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        <url>
        <loc>' . APP_URL . '</loc>
        <lastmod>' . date('Y-m-d') . '</lastmod>
        </url>';
        
        
            foreach ($cats as $c) {
                $url = APP_URL . '/category/' . $c['slug'];
                $publish = date('Y-m-d', strtotime($c['created_at']));
                $str .= " 
        <url>
        <loc>$url</loc>
        <lastmod>$publish</lastmod>
        </url>";
            }
            foreach ($albums as $a) {
                $url = APP_URL . '/book/' . $a['slug'];
                $publish = date('Y-m-d', strtotime($a['created_at']));
                $str .= " 
        <url>
        <loc>$url</loc>
        <lastmod>$publish</lastmod>
        </url>";
            }
        
            foreach ($ebooks as $m) {
                $url = APP_URL . '/' . $m['slug'];
                $publish = date('Y-m-d', strtotime($m['created_at']));
                $str .= "
        <url>
        <loc>$url</loc>
        <lastmod>$publish</lastmod>
        </url>";
            }
        
            foreach ($author as $ar) {
                $url = APP_URL . '/author/' . $ar['slug'] ;
                $publish = date('Y-m-d', strtotime($ar['created_at']));
                $str .= "
        <url>
        <loc>$url</loc>
        <lastmod>$publish</lastmod>
        </url>";
            }
            
            foreach ($compilers as $ar) {
                $url = APP_URL . '/compiler/' . $ar['slug'];
                $publish = date('Y-m-d', strtotime($ar['created_at']));
                $str .= "
        <url>
        <loc>$url</loc>
        <lastmod>$publish</lastmod>
        </url>";
            }
            
                foreach ($blogs as $ar) {
                $url = APP_URL . '/blog/' . $ar['slug'];
                $publish = date('Y-m-d', strtotime($ar['created_at']));
                $str .= "
        <url>
        <loc>$url</loc>
        <lastmod>$publish</lastmod>
        </url>";
            }
            
                  foreach ($blog_cats as $ar) {
                $url = APP_URL . '/blog?cat=' . $ar['id'];
                $publish = date('Y-m-d', strtotime($ar['created_at']));
                $str .= "
        <url>
        <loc>$url</loc>
        <lastmod>$publish</lastmod>
        </url>";
            }  
                foreach ($groups as $ar) {
                $url = APP_URL . '/group/' . $ar['slug'];
                $publish = date('Y-m-d', strtotime($ar['created_at']));
                $str .= "
        <url>
        <loc>$url</loc>
        <lastmod>$publish</lastmod>
        </url>";
            }    
            
                foreach ($pages as $ar) {
                $url = APP_URL . '/page/' . $ar['slug'];
                $publish = date('Y-m-d', strtotime($ar['created_at']));
                $str .= "
        <url>
        <loc>$url</loc>
        <lastmod>$publish</lastmod>
        </url>";
            }
            $str .= "</urlset>";
            
            if(!file_exists($RootPath . '/sitemap.xml')) {
                file_put_contents($RootPath . '/sitemap.xml', '');
            }
            
            file_put_contents($RootPath . '/sitemap.xml', $str);
        
            // WriteFile($RootPath . '/sitemap.xml', $str);
        
            if (file_exists($RootPath . '/sitemap.xml')) {
                $url = 'http://google.com/ping?sitemap=' . APP_URL . '/sitemap.xml';
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $data = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                if ($httpCode == 200)
                    $mgs = 'Successfuly Sitemap Submited and Ping';
                else {
                    $mgs = 'Successfuly Sitemap Submited';
                }
                return ['s' => '1', 'm' => $mgs];
            } else {
                return  ['s' => '0', 'm' => 'Unable Creating Sitemap'];
            }
        
    }
}