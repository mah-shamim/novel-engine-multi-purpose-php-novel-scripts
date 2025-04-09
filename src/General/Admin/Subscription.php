<?php
    

    namespace App\General\Admin;
    use App\General\All;
    use Exception;
    use PDOException;


    class Subscription extends All {

        private $table = 'subscriptions';

        public function __construct() {

            parent::__construct();



        }

        public function Set()
        {
            $All =  new All();

            if(!$All->detectTable($this->table)) {

                $columns = [
                    'id' => 'INT AUTO_INCREMENT',
                    'package_id' => 'INT(11) NOT NULL',
                    'user_id' => 'INT(11) NOT NULL',
                    'days' => 'INT(11) NOT NULL',
                    'price' => 'DOUBLE',
                    'status' => 'INT(1) DEFAULT 1',
                    'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
                ];

                $PKey = "id";
                $Fkey1 = "package_id";
                $All->createTable($this->table, $columns, $PKey, $Fkey1, 'packages');
                $All->addForeignKey($this->table, 'id', 'users',  'user_id');
            }
        }

        public function add($req) {
            $s = 0;
            if(empty(Input('type_id')) || empty(Input('user_id'))) {

                $m = "All fields are required";
            } else {

                $package = $this->getRow('packages', 'id', Input('type_id'));
                if($package) {

                    $data = [
                        'package_id' => Input('type_id'),
                        'price' => $package['price'],
                        'days' => $package['days'],
                        'user_id' => Input('user_id'),
                    ];
    
                    try {
    
                        $this->Insert($this->table, $data);
                        $s = 1;
                        $m = "Successfully added this subscription to this User";
    
                    } catch(PDOException $e) {
                        $m = "Error occur pls contact the dev";
                        throw new Exception("Error ".$e->getMessage());
                    }
                    
                }

            }

            return ['s' => $s, 'm' => $m];
        }


        public function add2($req) {
            $s = 0;
            if(empty($req['type_id']) || empty($req['user_id'])) {
                $m = "All fields are required";
            } else {

                $package = $this->getRow('packages', 'id', $req['type_id']);
                if($package) {

                    $data = [
                        'package_id' => $req['type_id'],
                        'price' => $package['price'],
                        'days' => $package['days'],
                        'user_id' => $req['user_id'],
                    ];
    
                    try {
    
                        $this->Insert($this->table, $data);
                        $s = 1;
                        $m = "Successfully added this subscription to this User";
    
                    } catch(PDOException $e) {
                        $m = "Error occur pls contact the dev";
                        throw new Exception("Error ".$e->getMessage());
                    }
                    
                }

            }

            return ['s' => $s, 'm' => $m];
        }


        

 
    }
?> 