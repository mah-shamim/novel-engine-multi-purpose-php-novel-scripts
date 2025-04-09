<?php

namespace App\General;
use App\General\All;
use PDO;
class Auth extends Database
{
  private $username;
  private $password;
  

  public function __construct() 
  {
    parent::__construct();
    
    $table = 'admin_tb';
    $All = new All();
    if($All->detectTable($table) === false) {
        $columns = [
            "id" => "INT AUTO_INCREMENT",
            "name" => "VARCHAR(255) NOT NULL",
            "username" => "VARCHAR(255) NOT NULL",
            "email" => "VARCHAR(255) NOT NULL",
            "password" => "VARCHAR(255) NOT NULL",
            "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
            ];
        $Pkey = "id";
        $All->createTable($table, $columns, $Pkey);
        $password = password_hash("1234", PASSWORD_DEFAULT);
        $All->Insert($table, ['name' => "Shuraihu Usman", "username" => "shuraih99", "password" => $password, "email" => "shuraihusman@gmail.com"]);
        
    }


    
  }
  

  public function getUser($user) {

      $stmt = $this->pdo->prepare("SELECT * FROM admin_tb WHERE username = :name");
      $stmt->bindParam(":name", $user, PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetchObject();
  }

    public function check($username, $password) {
        $s = 0;
        $this->username = $username;
        $this->password = $password;

        $User = $this->getUser($this->username);

        if (!$User) {
            $m = "Invalid Username ID";
        } else if (!password_verify($this->password, $User->password)) {
            $m = "Invalid Password";
        } else {
            $s = 1;
            $m = "Login Successfully";
            $_SESSION['adminID'] = $User->id;
            $_SESSION['adminName'] = $User->username;
        }

        return ['s' => $s, 'm' => $m];
    }


  public function isLogin() {
      if(isset($_SESSION['adminID']) && isset($_SESSION['adminName'])) {
          if($this->getUser($_SESSION['adminName']))
              return true;
      }
  }

 public function logOut() {
     unset($_SESSION['adminID']);
     unset($_SESSION['adminName']);
     session_destroy();
     Redirect(LoginURL);
  }


}