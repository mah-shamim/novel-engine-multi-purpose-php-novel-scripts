<?php
namespace App\Migration;

use App\General\All;
use PDOException;


class comments

 {
   

    public function handle() {

        $this->add();

        // $this->edit()
    }

    public function add()
    {
        // Your authentication logic here
        $db = new All();

        if(!$db->detectTable('file_comments')) {
            $columns = [
                'id' => 'INT AUTO_INCREMENT',
                'user_id' => 'INT(11) NOT NULL',
                'file_id' => 'INT(11) NOT NULL',
                'parent_id' => 'INT (11) DEFAULT NULL',
                'content' => 'TEXT NOT NULL',
                'status' => 'INT(1) DEFAULT 1',
                'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            ];

            $PKey = "id"; 
            $db->createTable('file_comments', $columns, $PKey);
            $db->addForeignKey('file_comments', 'id', 'users',  'user_id');
            $db->addForeignKey('file_comments', 'id', 'ebook',  'file_id');
            $db->addForeignKey('file_comments', 'id', 'file_comments',  'parent_id');
        }
    }

    public function edit() {

        // Editing
    }


 }

