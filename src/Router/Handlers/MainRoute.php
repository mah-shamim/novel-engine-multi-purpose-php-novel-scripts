<?php

namespace App\Router\Handlers;

use App\General\DB;
use App\General\All;
class MainRoute  {
    public  $cP;
    public  $tP;

    
    private $rooth;
    private $header;
    private $footer;

    public function __construct()
    {
        global $rootpath, $controllerPath, $templatePath;
        $this->rooth = $rootpath;
        require_once $this->rooth.'/config/init.php';
        $this->header = $templatePath.'/main/header.php';
        $this->footer = $templatePath.'/main/footer.php';
        $this->cP = $controllerPath.'/main';
        $this->tP = $templatePath.'/main';
        
    }
    
    public function Sitemaps() {
    // Start output buffering to ensure no whitespace is sent before the XML declaration
    ob_start();

    // Set the content type header before any output
    header('Content-type: application/xml');

    $gen = new \App\General\All();

    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    // Echo the URL for the homepage
    echo '<url>
            <loc>'.APP_URL.'</loc>
            <lastmod>'. $gen->formatDate($gen->getLastRow('ebook')).'</lastmod>
          </url>';

    // Fetch categories
    $cats = $gen->listRow2('category', 'status', 1, 'id');
    foreach($cats as $row) {
        echo '<url>
                <loc>'.APP_URL.'/category/'.$row['slug'].'</loc>
                <lastmod>'.$gen->formatDate($row['created_at']).'</lastmod>
              </url>';
    }
    
    // Fetch Books Album
    $book = $gen->listRow2('book', 'status', 1, 'id');
    foreach($book as $row) {
        echo '<url>
                <loc>'.APP_URL.'/book/'.$row['slug'].'</loc>
                <lastmod>'.$gen->formatDate($row['created_at']).'</lastmod>
              </url>';
    }
    
    // Fetch Authors
    $author = $gen->listRow2('author', 'status', 1, 'id');
    foreach($author as $row) {
        echo '<url>
                <loc>'.APP_URL.'/author/'.$row['slug'].'</loc>
                <lastmod>'.$gen->formatDate($row['created_at']).'</lastmod>
              </url>';
    }
    
    // Fetch Ebooks
    $ebook = $gen->listRow2('ebook', 'status', 1, 'id');
    foreach($ebook as $row) {
        echo '<url>
                <loc>'.APP_URL.'/'.$row['slug'].'</loc>
                <lastmod>'.$gen->formatDate($row['created_at']).'</lastmod>
              </url>';
    }

    // Fetch Blogs
    $blog = $gen->listRow2('blogs', 'status', 1, 'id');
    foreach($blog as $row) {
        echo '<url>
                <loc>'.APP_URL.'/blog/'.$row['slug'].'</loc>
                <lastmod>'.$gen->formatDate($row['created_at']).'</lastmod>
              </url>';
    }
    
    echo '</urlset>';

    // Flush the output buffer to ensure headers are sent correctly
    ob_end_flush();
}


    public function Home() {
        global $lang, $isLogin, $AuthUser;
        view([$this->cP.'/index.php', $this->header, $this->tP.'/index.php', $this->footer], ['lang' => $lang]);
    }

    public function View($slug) {
        global $lang, $isLogin, $AuthUser;
        view([$this->cP.'/view.php', $this->header, $this->tP.'/view.php', $this->footer], ['slug' => $slug, 'lang' => $lang]);
    }

    public function blogView($slug) {
        global $lang, $isLogin, $AuthUser;
        view([$this->cP.'/blogs/view.php', $this->header, $this->tP.'/blogs/view.php', $this->footer], ['slug' => $slug, 'lang' => $lang, 'isLogin' => $isLogin, 'AuthUser' => $AuthUser]);
    }

    public function Blog()
    {
        global $lang, $isLogin, $AuthUser;
        view([$this->cP.'/blogs/blog.php',$this->header, $this->tP.'/blogs/blog.php', $this->footer]);
    }

    public function Ebooks() {
        global $lang;
        view([$this->cP.'/ebooks.php', $this->header, $this->tP.'/ebooks.php', $this->footer], ['lang' => $lang]);
    }

    public function Install() {
        global $lang;
        view(__DIR__.'/../../../shuraih/install/install.php', ['lang' => $lang]);
    }

    public function Archives() {
        global $lang, $isLogin, $AuthUser;
        view([$this->cP.'/archives.php', $this->header, $this->tP.'/archives.php', $this->footer], ['lang' => $lang]);
    }

    public function Archive($slug) {
        global $lang, $isLogin, $AuthUser;
        view([$this->cP.'/archive.php', $this->header, $this->tP.'/archive.php', $this->footer], ['lang' => $lang, 'slug' => $slug]);
    }

    public function Read($slug) {
        global $lang, $isLogin, $AuthUser;
        view([$this->cP.'/read.php', $this->header, $this->tP.'/read.php', $this->footer], ['lang' => $lang,'slug' => $slug]);
    }

    
    public function Page($slug) {
        global $lang, $isLogin, $AuthUser;
        view([$this->cP.'/page.php', $this->header, $this->tP.'/page.php', $this->footer], ['lang' => $lang,'slug' => $slug]);
    }
    

    





    
    public function Search() {
        global $lang, $isLogin, $AuthUser;
        view([$this->cP.'/search.php', $this->header, $this->tP.'/search.php', $this->footer], ['lang' => $lang]);
    }

    public function Download($slug) {
        view($this->cP.'/download.php', ['slug' => $slug]);
    }

    public function Register() {
        global $lang, $isLogin, $AuthUser;
        $db = new DB();
        $get = $db->table('ebook')->where('status', 1)->orderBy('RAND()', '')->limit(1)->get();
         $ebook = $get ? $get[0] : ['img_folder' => '', 'image' => ''];
        view($this->tP.'/register.php',  ['ebook' => $ebook]);
    }

    public function Login() {
        global $lang, $isLogin, $AuthUser;

        $db = new DB();
        $get = $db->table('ebook')->where('status', 1)->orderBy('RAND()', '')->limit(1)->get();
        
        $ebook = $get ? $get[0] : ['img_folder' => '', 'image' => ''];
        view($this->tP.'/login.php', ['ebook' => $ebook]);
    }

    public function forgotPassword() {
        global $lang, $isLogin, $AuthUser;

        $db = new DB();
        $ebook = $db->table('ebook')->where('status', 1)->orderBy('RAND()', '')->limit(1)->first();
        view($this->tP.'/forgot.php', ['ebook' => $ebook]);
    }

    public function Reset() {
        global $lang, $isLogin, $AuthUser;

        $db = new DB();
        $ebook = $db->table('ebook')->where('status', 1)->orderBy('RAND()', '')->limit(1)->first();
        $set = false;
        if(isset($_GET['token']) && $db->table('users')->where('token', $_GET['token'])->first()) {
            $set = true;
        }
        view($this->tP.'/reset.php', [
            'ebook' => $ebook,
            'set' => $set,
        ]);
    }


}