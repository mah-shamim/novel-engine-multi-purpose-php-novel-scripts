<?php
    

    namespace App\General\Admin;
    use App\General\All;
    use Exception;
    use PDOException;


    class Package extends All {

        private $table = 'packages';

        public function __construct() {

            parent::__construct();



        }

        public function Set()
        {
            $All =  new All();

            if(!$All->detectTable($this->table)) {

                $columns = [
                    'id' => 'INT AUTO_INCREMENT',
                    'package_name' => 'VARCHAR(255) NOT NULL',
                    'days' => 'INT(11) NOT NULL',
                    'price' => 'DOUBLE',
                    'status' => 'INT(1) DEFAULT 1',
                    'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
                ];

                $PKey = "id";

                $All->createTable($this->table, $columns, $PKey);
            }
        }

        public function add($req) {
            $s = 0;
            if(empty(Input('name')) || empty(Input('price')) || empty(Input('days'))) {

                $m = "All fields are required";
            } else {

                $data = [
                    'package_name' => Input('name'),
                    'price' => Input('price'),
                    'days' => Input('days'),
                ];

                try {

                    $this->Insert($this->table, $data);
                    $s = 1;
                    $m = "Successfully added a package";

                } catch(PDOException $e) {
                    $m = "Error occur pls contact the dev";
                    throw new Exception("Error ".$e->getMessage());
                }
            }

            return ['s' => $s, 'm' => $m];
        }
        

 
    }
?> 