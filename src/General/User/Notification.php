<?php

namespace App\General\User;
use App\General\Database;
use App\General\All;
use App\General\DB;
use PDOException;

class Notification

 {
    // TODO: Add class properties and method

    private $table = 'notifications';

    public function Set() {

      $db = new All();

      if(!$db->detectTable($this->table)) {
         $columns = [
             'id' => 'INT AUTO_INCREMENT',
             'user_id' => 'INT(11) NOT NULL',
             'title' => 'VARCHAR(255) NOT NULL',
             'message' => 'TEXT NOT NULL',
             'status' => 'INT(1) DEFAULT 1',
             'is_read' => 'INT(1) DEFAULT 0',
             'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
         ];

         $PKey = "id"; 
         $db->createTable($this->table, $columns, $PKey);
         $db->addForeignKey($this->table, 'id', 'users',  'user_id');
     }

    }

    public function addNotification($data)
    {
        
        if(empty($data['user_id']) || empty($data['title']) || empty($data['message'])) {
            return false;
        } else {
            
            $db = new DB();
            $db->table($this->table)->insert($data);
            return true;

        }
    }
 }