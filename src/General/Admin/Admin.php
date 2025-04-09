<?php
    

    namespace App\General\Admin;
    use App\General\Database;
    use App\General\All;
    use PDOException;


    class Admin extends Database {

        private $table = 'admin_tb';

        public function __construct() {

            parent::__construct();

        }

        public function Set()
         {
            $All =  new All();

            if(!$All->detectTable($this->table)) {

                $columns = [
                    'id' => 'INT AUTO_INCREMENT',
                    'name' => 'VARCHAR(255) NOT NULL',
                    'username' => 'VARCHAR(255) NOT NULL',
                    'email' => 'VARCHAR(255)',
                    'password' => 'VARCHAR(255) NOT NULL',
                    'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
                ];

                $PKey = "id";

                $All->createTable($this->table, $columns, $PKey);
            }
        }

 
    }
?> 