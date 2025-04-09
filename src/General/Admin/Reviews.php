<?php

namespace App\General\Admin;
use App\General\Database;
use App\General\All;
use App\General\Mailer;
use App\General\User\Notification;
use App\General\DB;
use PDOException;

class Reviews

 {
    // TODO: Add class properties and method

    private $table = 'reviews';

    protected $db;

    public function Set() {

        $db = new All();

        if(!$db->detectTable($this->table)) {
           $columns = [
               'id' => 'INT AUTO_INCREMENT',
               'user_id' => 'INT(11) NOT NULL',
               'file_id' => 'INT(11) NOT NULL',
               'parent_id' => 'INT(11)',
               'content' => 'TEXT NOT NULL',
               'status' => 'INT(1) DEFAULT 1',
               'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
           ];
  
           $PKey = "id"; 
           $db->createTable($this->table, $columns, $PKey);
           $db->addForeignKey($this->table, 'id', 'users',  'user_id');
           $db->addForeignKey($this->table, 'id', 'ebook',  'file_id');
           $db->addForeignKey($this->table, 'id', 'reviews',  'parent_id');
       }
  
  

    }


    public function add()
     {
        $s = 0;

        if(empty(Input('user_id')) || empty(Input('file_id'))) {
            $m = "Invalid user or posts";
        } elseif(empty(Input('content'))) {
            $m = "Content fields cannot be empty";
        } else {

            $data = [
                'user_id' => Input('user_id'),
                'file_id' => Input('file_id'),
                'content' => Input('content'),
            ];

            try {
                $dbs = new DB();
                $this->db = $dbs;
                $this->db->table($this->table)->insert($data);
                
                 $file = $this->db->table('ebook')->where('id', Input('file_id'))->first();
                $s = 1;
                $m = "You successfully Submitted a review";
                $notification = new Notification();
                $notification->addNotification([
                    'user_id' => Input('user_id'),
                    'title' => 'Reply a review',
                    'message' => $m." on <a href='".APP_URL."/".$file['slug']."'>".$file['name']."</a>",
                ]);

                $user = $this->db->table('users')->where('id', Input('user_id'))->first();
                if(MAIL_ACTIVATION === 1) {
                    $mailer = new Mailer();
                    $content = Input('content');
                    $details = $m." on <a href='".APP_URL."/".$file['slug']."'>".$file['name']."</a> at ".date("d-m-Y H:i:s")." Pls report this if you are not the one.<br>
                    <blockquote style='margin: 10px 0; padding: 10px; border-left: 5px solid #c416bb; font-size:20px; background-color: #f9f9f9;'>$content</blockquote>";

                    $mailer->Activity($user['email'], $user['name'], $details, "You make a Review");
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

        if(empty(Input('user_id')) || empty(Input('file_id')) || empty(Input('parent_id'))) {
            $m = "Invalid user or posts";
        } elseif(empty(Input('content'))) {
            $m = "Content fields cannot be empty";
        } else {

            $data = [
                'user_id' => Input('user_id'),
                'file_id' => Input('file_id'),
                'parent_id' => Input('parent_id'),
                'content' => Input('content'),
            ];
            $dbs = new DB();
            $this->db = $dbs;
            $file = $this->db->table('ebook')->where('id', Input('file_id'))->first();

            try {

                $this->db->table($this->table)->insert($data);
                $s = 1;
                $m = "You successfully make a reply";

                $notification = new Notification();
                $notification->addNotification([
                    'user_id' => Input('user_id'),
                    'title' => 'Reply a review',
                    'message' => $m." on <a href='".APP_URL."/".$file['slug']."'>".$file['name']."</a>",
                ]);

                $review = $this->db->table($this->table)->where('parent_id', Input('parent_id'))->first();
                $user = $this->db->table('users')->where('id', Input('id'))->first();

                $notification->addNotification([
                    'user_id' => $review['user_id'],
                    'title' => 'some one reply your review',
                    'message' =>  $user['username'].' reply your review  on <a href="'.APP_URL.'/'.$file['slug'].'">'.$file['name'].'</a>',
                ]);

                $user2 = $user = $this->db->table('users')->where('id', $review['user_id'])->first();
                $link = '<a href="'.APP_URL.'/'.$file['slug'].'">'.$file['name'].'</a>';
                $content = Input('content');
                if(MAIL_ACTIVATION === 1) {
                 $mailer = new Mailer();
                 $details = "You successfully make a reply on {$user2['name']} review on  $link at ".date("d-m-Y H:i:s")." Pls report this if you are not the one. <br>
                 <blockquote style='margin: 10px 0; padding: 10px; font-size:20px; border-left: 5px solid #c416bb; background-color: #f9f9f9;'>$content</blockquote>";

                 $details2 = $user['name']." reply your review on  $link at ".date("d-m-Y H:i:s")." Pls report this if you are not the one. <br>
                 <blockquote style='margin: 10px 0; padding: 10px; font-size:20px; border-left: 5px solid #c416bb; background-color: #f9f9f9;'>$content</blockquote>
                 ";
                 
                 $mailer->Activity($user['email'], $user['name'], $details, "You make a reply");
                 $mailer->Activity($user2['email'], $user2['name'], $details2, "Some one reply your comment");
              }
            } catch(PDOException $e) {
                $m = "Error fail to submit comment " ;
                $m .= $e->getMessage();
            }
        }

        return ['s' => $s, 'm' => $m];
     }
 }