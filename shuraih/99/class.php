<?php

namespace {{namespace}};
use App\General\Database;
use App\General\All;
use App\General\DB;
use PDOException;

class {{className}}

 {
    // TODO: Add class properties and method

    private $table = '{{table}}';

    public function __contstruct() {

      $db = new All();

      if(!$db->detectTable($this->table)) {
         $columns = [
             'id' => 'INT AUTO_INCREMENT',
             'user_id' => 'INT(11) NOT NULL',
             'status' => 'INT(1) DEFAULT 1',
             'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
         ];

         $PKey = "id"; 
         $db->createTable($this->table, $columns, $PKey);
         // $db->addForeignKey($this->table, 'id', 'users',  'user_id');
     }

    }
 }