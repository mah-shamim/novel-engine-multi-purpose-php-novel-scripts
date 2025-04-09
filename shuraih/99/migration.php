<?php
namespace {{namespace}};

use App\General\All;
use PDOException;


class {{className}}

 {
   

    public function handle() {

        $this->add();

        // $this->edit()
    }

    public function add()
    {
        // Your authentication logic here
        $db = new All();

        if(!$db->detectTable('{{table}}')) {
            $columns = [
                'id' => 'INT AUTO_INCREMENT',
                'name' => 'VARCHAR(255) NOT NULL',
                // 'slug' => 'VARCHAR(255) NOT NULL',
                // 'img_folder' => 'VARCHAR(255)',
                // 'image' => 'VARCHAR(255)',
                // 'status' => 'INT(1) DEFAULT 1',
                // 'isHome' => 'INT(1) DEFAULT 0',
                // 'title' => 'VARCHAR(255)',
                // 'meta_key' => 'VARCHAR(255)',
                // 'meta_desc' => 'VARCHAR(255)',
                'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            ];

            $PKey = "id"; 
            $db->createTable('{{table}}', $columns, $PKey);
            // $db->addForeignKey('{{table}}', 'id', 'book',  'baid');
        }
    }

    public function edit() {

        // Editing
    }


 }

