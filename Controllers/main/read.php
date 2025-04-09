<?php
global $rootpath;
global $lang, $isLogin, $AuthUser;
use PhpOffice\PhpWord\IOFactory;
use Smalot\PdfParser\Parser;
if(isset($slug)) {
    $gen = new App\General\All();
    $db = new App\General\DB();
    $file = $db->table('ebook as e')
                ->leftJoin('category as c', 'e.cid', '=', 'c.id')
                ->leftJoin('book as b', 'e.baid', '=', 'b.id')
                ->select(['e.*', 'c.name as cat_name', 'c.slug as cat_slug', 'b.name as book_name', 'b.slug as book_slug'])
                ->where('e.status', 1)
                ->where('e.id', $slug)
                ->first();

    if($file) {

        $isRead = false;
        $isembed = false;
        $message = "";

        if(($file['isFree'] == 1)) {
            $isRead = true;
        } else if(!$isLogin)  {
            
            if(READ_FREE === 1 && $file['isRead']) {
                $isRead = true;
            } else {
                $message = "Pls Login or Register in order to read this novel";
            }
        } else {
            if(SUBSCRIBE === 1) {
                if($gen->isSubscribe($AuthUser['id'])) {
                        $isRead = true;
                } else {
                    $message = "You cannot read this novel untill you Subscribe to one of our subscriptions package";
                }
            } else if(READ_FREE === 1 && $file['isRead'] == 1) {
                $isRead = true;
            } else {
                $message = "You cannot read / download this novel untill you Subscribe to one of our subscriptions package";
            }
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

        $id = $file['id'];
        $view = $file['views'] + 1;
        $gen->EditRow('ebook', ['views' => $view], "id = $id");
        
        $fileSource = $rootpath.'/Public/files/'.$file['file_dir'].$file['file_name'];
        $pdfPath = '/Public/files/'.$file['file_dir'].$file['file_name'];

                if($file['ext'] == 'txt') {
            $novel = file_get_contents($fileSource) or die("Can not read from file");
        } else if($file['ext'] == 'docx') {

            $filePath = $fileSource;
            try {
                $phpWord = IOFactory::load($filePath);
                $text = '';
            
                foreach ($phpWord->getSections() as $section) {
                    foreach ($section->getElements() as $element) {
                        $text .= extractText($element);
                    }
                }
            
                $novel = nl2br($text);
            
            } catch (\PhpOffice\PhpWord\Exception\Exception $e) {
                $novel =  'Error loading file: ' . $e->getMessage();
            }
     
        } else if($file['ext'] == 'doc') {
            $text = file_get_contents($fileSource) or die("Can not read from file");
            $novel = mb_convert_encoding($text, 'UTF-8', 'auto');
        } else if($file['ext'] == 'pdf') {
            $fileSize = filesize($fileSource);
            
            if ($fileSize > 5 * 1024 * 1024) { // Check if file size is greater than 4MB
                $isembed = true;
                $novel = "This novel exceed 5MB it cannot open, unless in IFRAME";
            } else {
                $parser = new Parser();
                $pdf = $parser->parseFile($fileSource);
                $novel = $pdf->getText();
            }


        }

        $wordsPerPage = 3000;

        $words = explode(' ', $novel);
        $totalWords = count($words);
        $totalPages = ceil($totalWords / $wordsPerPage);

        $page = isset($_GET['chapter']) && is_numeric($_GET['chapter']) ? intval($_GET['chapter']) : 1;

        $page = max(1, min($totalPages, $page));

        $startIndex = ($page - 1) * $wordsPerPage;

        $pagedWords = array_slice($words, $startIndex, $wordsPerPage);

        $novelText = implode(' ', $pagedWords);
        $novelText = $isRead === true ? nl2br($novelText) : $message;

        $pageLink = APP_URL.'/read/'.$file['id'].'?chapter=';

        $limit = $wordsPerPage;
        $totalFiles = $totalWords;
        $totalPages = ceil($totalFiles / $limit); 
        $totalpages = $totalPages; 
        $title = "Reading ".$file['name'];
        $title = $page ? "Chapter ".$page.' '.$title : $title;

        $metanofollow = true;

        $reviews = $db->table('reviews as r')->
                        where('r.status', 1)->
                        where('file_id', $file['id'])->
                        leftJoin('users as u', 'r.user_id', '=', 'u.id')
                        ->orderBy('id', 'DESC')
                        ->select(['r.*', 'u.username', 'name as user_name', 'image as user_image'])
                        ->get();
        
    $recents = $db->table('ebook as e')
                ->leftJoin('category as c', 'e.cid', '=', 'c.id')
                ->leftJoin('book as b', 'e.baid', '=', 'b.id')
                ->select(['e.*', 'c.name as cat_name', 'c.slug as cat_slug', 'b.name as book_name', 'b.slug as book_slug'])
                ->where('e.cid', $file['cid'])
                ->orderBy('rand', '')
                ->limit(10)
                ->get();
        
    } else {
        Redirect('/');
    }
} else {
    Redirect('/');
}