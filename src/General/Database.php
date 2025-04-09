<?php

namespace App\General;

use PDO;
use PDOException;

class Database {

    public $pdo;
    private $dbname;
    private $dbuser;
    private $dbpass;
    private $dbhost;

    public function __construct() {

        $this->dbname = DBNAME; 
        $this->dbuser = DBUSER; 
        $this->dbpass = DBPASS; 
        $this->dbhost = DBHOST; 

        try {
            $this->pdo = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            

        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getPdo() {
        return $this->pdo;
    }

}
?>
