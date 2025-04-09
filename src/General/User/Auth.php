<?php


namespace App\General\User;
use App\General\All;
use App\General\DB;
use App\General\Mailer;
use App\General\User\Notification;
use PDOException;

class Auth extends All {

    private $table = 'users';

    public function Set() {

        $db = new All();
  
        if(!$db->detectTable($this->table)) {
           $columns = [
               'id' => 'INT AUTO_INCREMENT',
               'name' => 'VARCHAR(255) NOT NULL',
               'email' => 'VARCHAR(255) NOT NULL',
               'username' => 'VARCHAR(255) NOT NULL',
               'password' => 'VARCHAR(255) NOT NULL',
               'image' => 'VARCHAR(255) NOT NULL',
               'token' => 'VARCHAR(255) DEFAULT NULL',
               'status' => 'INT(1) DEFAULT 1',
               'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
           ];
  
           $PKey = "id"; 
           $db->createTable($this->table, $columns, $PKey);
       }
  
      }

    public function Register($data) {
        $s = 0;
        if(REGISTER !== 1) {
            $m = "Registration is closed, you cannot register now";
        } else if(empty($data['username']) || empty($data['name']) || empty($data['password']) || empty($data['email'])) {
            $m = "All fields are required";
        } else if($this->selectBy('users', ['username' => Input('username'), 'id'])) {
            $m = "Username already taken pls choose another username";
        } else if($this->selectBy('users', ['email' => Input('email')])) {
            $m = "Email Address already exists pls change another one";
        } else if(!filter_var(Input('email'), FILTER_VALIDATE_EMAIL)) {
            $m = "Invalid email address pls change another email";
        } else {

            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            $data2 = [
                'username' => Input('username'),
                'name' => Input('name'),
                'password' => $password,
                'email' => Input('email'),

            ];

            try {
                $this->Insert('users', $data2);
                $s =  1;
                $m = " Account Created Successfully";
                $mailer = new Mailer();
                $details = [
                    'username' => Input('username'),
                    'email' => Input('email'),
                ];
                $mailer->Registration(Input('email'), Input('name'), $details);
            } catch(PDOException $e) {
                $m = "Fail to create account pls contact admin";
            }
        }

        return ['s' => $s, 'm' => $m];
    }

    public function login($data) {
        $s = 0;
        if(empty($data['password']) || empty($data['email'])) {
            $m = "All fields are required";
        } else {

            $user = $this->getRow('users', 'email', Input('email'));
            $password = Input('password');

            if(!$user) {
                $m = "Invalid Account / Email";
            } else if(!password_verify($password, $user['password'])) {
                $m = "Invalid Password";
            } else {
                $_SESSION['loginID'] = $user['id'];
                $_SESSION['loginName'] = $user['username'];
                $s = 1;
                $m = "Successfully Login";
                if(MAIL_ACTIVATION === 1) {
                    $mailer = new Mailer();
                    $details = "You successfully login on ".date("d-m-Y H:i:s")." Pls report this login / change your password if you are not the one that login.";
                    $mailer->Activity($user['email'], $user['name'], $details, "Login Notification");
                }
            }

        }

        return ['m' => $m, 's' => $s];
    }

    public function logout() {
        unset($_SESSION['loginID']);
        unset($_SESSION['loginName']);
        session_destroy();
    }

    public function changepass($data) {
        $s  =0;

        if(empty($data['old']) || empty($data['new']) || empty($data['confirm'])) {
            $m = "All passwords fiels are required";
        } else {

            $user = $this->getRow('users', 'id', Input('id'));
            
            if(!$user) {
                $m = "Unauthorized";
            } else if(!password_verify(Input('old'), $user['password'])) {
                $m =  " Invalid old password";
            } else if(Input('new') !== Input('confirm')) {
                $m = "New and confirmation password does not match";
            } else {
                $con = "id = ".Input('id');
                $new = password_hash(Input('new'), PASSWORD_DEFAULT);
                try {
                    $this->EditRow('users', ['password' => $new], $con);
                    $s = 1;
                    $m = "Password successfully Change";

                    if(MAIL_ACTIVATION === 1) {
                        $mailer = new Mailer();
                        $details = "You successfully change your password on ".date("d-m-Y H:i:s")." Pls report this if you are not the one. ";
                        $mailer->Activity($user['email'], $user['name'], $details, "Password Change");
                    }

                    $notification = new Notification();
                    $notification->addNotification([
                        'user_id' => $user['id'],
                        'title' => 'You change your Password',
                        'message' =>  $details,
                    ]);

                } catch(PDOException $e) {
                    $m = "Fail to channge password ";
                }
            }

        }

        return ['s' => $s, 'm' => $m];
    }

    public function editprofile($data) {
        $s = 0;
        if(empty($data['name']) || empty($data['email'])) {
            $m = "Fields cannot be empty";
        } else if (!filter_var(Input('email'), FILTER_VALIDATE_EMAIL)) {
            $m = "Invalid email";
        } else {

            $user = $this->getRow('users', 'id', Input('id'));

                $con = "id = ".Input('id');
                try {
                    $this->EditRow('users', ['email' => Input('email'), 'name' => Input('name')], $con);
                    $s = 1;
                    $m = "Password successfully Update";

                    if(MAIL_ACTIVATION === 1) {

                        $mailer = new Mailer();
                        $details = "You successfully update your profile on ".date("d-m-Y H:i:s")." Pls report this if you are not the one. ";
                        $mailer->Activity($user['email'], $user['name'], $details, "Profile Update");
                    }

                    $notification = new Notification();
                    $notification->addNotification([
                        'user_id' => $user['id'],
                        'title' => 'Profile Update',
                        'message' =>  $details,
                    ]);
                } catch(PDOException $e) {
                    $m = "Fail to Update profile";
                }
        }

        return ['s' => $s, 'm' => $m];
    }

    public function changepic($data) {
        $s = 0;
        $m = " YEYEYE";
        
        $image = [
            'img_name' => $_FILES['image']['name'],
            'img_size' => $_FILES['image']['size'],
            'img_tmp' => $_FILES['image']['tmp_name']
        ];

        if(empty($image['img_name'])) {
            $m = "Pls select Image";
        } else {
            if(checkImageSize($image)) {
                $m = " Image is not valid";
            } else if(checkImageType($image)) {
                $m = "Unsupported image format";
            } else {
                $dir = PUBLICPATH.'/thumb/users/';
                $target = $dir.$image['img_name'];
    
                if(move_uploaded_file($image['img_tmp'], $target)) {
                    
                    $user = $this->getRow('users', 'id', Input('id'));
                    try {
                        $col = "id = ".Input('id');
                        $this->EditRow('users', ['image' => $image['img_name']], $col);
                        $s = 1;
                        $m = "Profile Picture successfully Set";
                        if(MAIL_ACTIVATION === 1) {
                            $mailer = new Mailer();
                            $details = "You successfully change your profile picture on ".date("d-m-Y H:i:s")." Pls report this if you are not the one.";
                            $mailer->Activity($user['email'], $user['name'], $details, "profile picture update");
                        }

                        $notification = new Notification();
                        $notification->addNotification([
                            'user_id' => $user['id'],
                            'title' => 'profile picture update',
                            'message' =>  $details,
                        ]);

                    } catch(PDOException $e) {
                        $m = "Fail to update profile pic";
                    }
                } else {
                    $m = "Fail to upload Image";
                }
            }
        }

       


        return ['m' => $m, 's' => $s];

    }

    public function forgot($email) {
        $s = 0;
        if(empty($email)) {
            $m = "Email field cannot be empty";
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $m = "Email is not valid";
        } else {
            $db = new DB();
            $user = $db->table($this->table)->where('email', $email)->first();

            if(!$user) {
                $m = "user associated with this email not found";
            } else if(MAIL_ACTIVATION !== 1) {
                $m = "Unable to send Password reset link, pls contact Admin, to activate mailing system";
            } else {

                $mailer = new Mailer();
                $token = uniqid("tkn", true).time();
                $link = APP_URL.'/reset?token='.$token;
                $db->table($this->table)->where('id', $user['id'])->update(['token' => $token]);
                if($mailer->paswordReset($user['email'], $user['name'], $link)) {
                    $s = 1;
                    $m = "Successfully send password reset link, pls check your Mail, including Spam folder";
                } else {
                    $m = "Unable to send Password reset link";
                }

            }
        }

        return ['m' => $m, 's' => $s];
    }

    public function reset() {
        $s = 0;
        $db = new DB();
        if(empty(Input('token')) || empty(Input('password')) || empty(Input('confirm_password'))) {

            $m = "All fields are required";
        } else if(Input('password') !== Input('confirm_password')) {
            $m = "Confirm password does not match with password";
        } else {

            $user = $db->table($this->table)->where('token', Input('token'))->first();
            if(!$user) {
                $m = "Invalid user with this Token, pls regenerate another one";
            } else {
                $password = password_hash(Input('password'), PASSWORD_DEFAULT);

                try {
                    $db->table($this->table)->where('id', $user['id'])->update([
                        'token' => '', 
                        'password' => $password]);
                    
                    $s = 1;
                    $m = "Your password is successfully reset";

                    if(MAIL_ACTIVATION === 1) {
                        $mailer = new Mailer();
                        $details = "You successfully reset your password on ".date("d-m-Y H:i:s")." Pls report this if you are not the one.";
                        $mailer->Activity($user['email'], $user['name'], $details, "You reset your Password");
                    }

                    $notification = new Notification();
                    $notification->addNotification([
                        'user_id' => $user['id'],
                        'title' => 'You reset your Password',
                        'message' =>  $details,
                    ]);

                    
                } catch(PDOException $e) {
                    $m = "Unable to reset your password pls contact Admin";
                    error_log($e->getMessage());
                }


                
            }
        }

        return ['m' => $m, 's' => $s];
    }
}