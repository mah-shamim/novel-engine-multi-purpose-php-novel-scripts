<?php

namespace App\General\User;
use App\General\Database;
use App\General\All;
use App\General\Mailer;
use App\General\DB;
use PDOException;

class Comments

 {
    // TODO: Add class properties and method

    private $table = 'comments';

    public function Set() {

      $db = new All();

      if(!$db->detectTable($this->table)) {
         $columns = [
             'id' => 'INT AUTO_INCREMENT',
             'name' => 'VARCHAR(255) NOT NULL',
             'email' => 'VARCHAR(255) NOT NULL',
             'content' => 'TEXT NOT NULL',
             'parent_id' => 'INT(11) DEFAULT NULL',
             'post_id' => 'INT(11) NOT NULL',
             'status' => 'INT(1) DEFAULT 1',
             'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
         ];

         $PKey = "id"; 
         $db->createTable($this->table, $columns, $PKey);
         $db->addForeignKey($this->table, 'id', 'comments',  'parent_id');
         $db->addForeignKey($this->table, 'id', 'blogs', 'post_id');
     }

    }

    public function add()
    {
       $s = 0;

       $this->Set();
       
       if(empty(Input('post_id')) || empty(Input('name')) || empty(Input('email'))) {
           $m = "All fields are required";
       } elseif(empty(Input('content'))) {
           $m = "Content fields cannot be empty";
       } else {

           $data = [
               'post_id' => Input('post_id'),
               'name' => Input('name'),
               'email' => Input('email'),
               'content' => Input('content'),
           ];

           try {
               $dbs = new DB();
               $dbs->table($this->table)->insert($data);
               $s = 1;
               $m = "You successfully Submitted a comment";
               $post = $dbs->table('blogs')->where('id', Input('post_id'))->first();
               $link = '<a href="'.APP_URL.'/blog/'.$post['slug'].'">'.$post['name'].'</a>';
               if(MAIL_ACTIVATION === 1) {
                $mailer = new Mailer();
                $content = Input('content');
                $details = " $m on blog post $link at ".date("d-m-Y H:i:s")." Pls report this if you are not the one.<br>
                <blockquote style='margin: 10px 0; padding: 10px; border-left: 5px solid #c416bb; font-size:20px; background-color: #f9f9f9;'>$content</blockquote>";
                $mailer->Activity(Input('email'), Input('name'), $details, "You make a comment");
            }
           } catch(PDOException $e) {
               $m = "Error fail to submit comment " ;
               $m .= $e->getMessage();
           }
       }

       return ['s' => $s, 'm' => $m];
    }
    
    public function addreply()
    {
       $s = 0;

       if(empty(Input('post_id')) || empty(Input('name')) || empty(Input('parent_id')) || empty(Input('email'))) {
           $m = "All fields are required";
       } elseif(empty(Input('content'))) {
           $m = "Content fields cannot be empty";
       } else {

           $data = [
               'post_id' => Input('post_id'),
               'name' => Input('name'),
               'email' => Input('email'),
               'parent_id' => Input('parent_id'),
               'content' => Input('content'),
           ];

           try {
               $dbs = new DB();
               $dbs->table($this->table)->insert($data);
               $s = 1;
              
               $post = $dbs->table('blogs')->where('id', Input('post_id'))->first();
               $link = '<a href="'.APP_URL.'/blog/'.$post['slug'].'">'.$post['name'].'</a>';

               $comment = $dbs->table('comments')->where('id', Input('parent_id'))->first();
               $m = "You successfully make a reply ";
               $content = Input('content');
               if(MAIL_ACTIVATION === 1) {
                $mailer = new Mailer();
                $details = "$m on {$comment['name']} comment on blog post $link at ".date("d-m-Y H:i:s")." Pls report this if you are not the one. <br>
                <blockquote style='margin: 10px 0; padding: 10px; font-size:20px; border-left: 5px solid #c416bb; background-color: #f9f9f9;'>$content</blockquote>";
                $details2 = Input('name')." reply your comment on blog post  $link at ".date("d-m-Y H:i:s")." Pls report this if you are not the one. <br>
                <blockquote style='margin: 10px 0; padding: 10px; font-size:20px; border-left: 5px solid #c416bb; background-color: #f9f9f9;'>$content</blockquote>
                ";
                $mailer->Activity(Input('email'), Input('name'), $details, "You make a reply");
                $mailer->Activity($comment['email'], $comment['name'], $details2, "Some one reply your comment");
             }

           } catch(PDOException $e) {
               $m = "Error fail to submit comment " ;
               $m .= $e->getMessage();
           }
       }

       return ['s' => $s, 'm' => $m];
    }
 }