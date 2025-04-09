<?php

namespace App\General\User;
use App\General\Database;
use App\General\All;
use App\General\Mailer;
use App\General\User\Notification;
use App\General\Admin\Subscription;
use App\General\DB;
use PDOException;


class Payment

 {
    // TODO: Add class properties and method

    private $table = 'payments';

    public function Set() {

      $db = new All();

      if(!$db->detectTable($this->table)) {
         $columns = [
             'id' => 'INT AUTO_INCREMENT',
             'user_id' => 'INT(11) NOT NULL',
             'amount' => 'DOUBLE NOT NULL',
             'package_id' => 'INT(11) NOT NULL',
             'reference' => 'INT(255) NOT NULL',
             'status' => 'INT(1) DEFAULT 0',
             'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
         ];

         $PKey = "id"; 
         $db->createTable($this->table, $columns, $PKey);
         $db->addForeignKey($this->table, 'id', 'users',  'user_id');
         $db->addForeignKey($this->table, 'id', 'packages',  'package_id');
     }

    }

    public function Add($data) 
    {
        $this->Set();
        $db = new DB();
        $s = 0;
        $user = '';
        $reference = strval(time());
        $package = '';
        if(empty($data['user_id']) || empty($data['package'])) {
            $m = "Invalid user or Package";
        } else {
            
            $user = $db->table('users')->where('id', $data['user_id'])->first();
            $package = $db->table('packages')->where('id', $data['package'])->first();

            try {

                $db->table($this->table)->insert(['user_id' => $user['id'], 'package_id' => $package['id'], 'amount' => $package['price'], 'reference' => $reference, 'status' => 2]);
                $s = 1;
                $m = "";

            } catch(PDOException $e) {
                $m = "an Error Occur ".$e->getMessage();
            }
        }

        return ['s' => $s, 'm' => $m, 'user' => $user, 'package' => $package, 'reference' => $reference];
    }

    public function paystack($reference)
    {
        $s = 0;
        $m = '';
        $apikey = PAYSTACK_KEY;
        try {
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.paystack.co/transaction/verify/' . $reference,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, // Fix typo in CURLOPT_HTTP_VERSION
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_SSL_VERIFYHOST => false, // Fix typo in CURLOPT_SSL_VERIFYHOST
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => ["accept: application/json", "Authorization: Bearer $apikey", "Cache-Control: no-cache"]
            ]);
    
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            $output = [];
    
            if ($err) {
                $m =  "Something went wrong";
            } else {

                $db = new DB();
                $payment = $db->table($this->table)->where('reference', $reference)->first();
                $user = $db->table('users')->where('id', $payment['user_id'])->first();
                $notification = new Notification();

                $output = json_decode($response, true);
                if (array_key_exists('data', $output) && array_key_exists('status', $output['data']) && $output['data']['status'] === 'success') {
                    $notification->addNotification([
                        'user_id' => $user['id'],
                        'title' => 'Payment Successfull',
                        'message' => "Your payment of ".CURRENCY.$payment['amount']." is Successfully",
                    ]);

                    if(MAIL_ACTIVATION === 1) {
                     $mailer = new Mailer();
                     $details = "Your payment of ".CURRENCY.$payment['amount']." is Successfully";
                     $mailer->Activity($user['email'], $user['name'], $details, "Payment Successfull");
                  }
                    $s = 1;
                } else {
                    $m = "Your payment is unsuccessfull but if you are debited pls contact us with your reference id $reference";
                    $notification->addNotification([
                        'user_id' => $user['id'],
                        'title' => 'Payment Fail',
                        'message' => $m,
                    ]);

                    if(MAIL_ACTIVATION === 1) {
                        $mailer = new Mailer();
                        $details = $m;
                        $mailer->Activity($user['email'], $user['name'], $details, "Payment Fail");
                     }
                }
            }
        } catch (\Exception $e) {
            $m = $e->getMessage();
        }

        return ['s' => $s, 'm' => $m];
    }

    public function Verify($reference)
    {
        $db = new Db();
        $s = 0;
        $payment = $db->table($this->table)->where('reference', $reference)->first();
        $package = $db->table('packages')->where('id', $payment['package_id'])->first();
        $user = $db->table('users')->where('id', $payment['user_id'])->first();

        if(!$payment) {
            $m = "failed to submit payment, pls contact us if you are debited";
        } else {

            $verify = $this->paystack($reference);

            if($verify['s'] == 1) {

                try {
                    $db->table($this->table)->where('reference', $reference)->update(['status' => 1]);

                    $subscriptions = new Subscription();

                    $subscribe = $subscriptions->add2([
                        'user_id' => $user['id'],
                        'type_id' => $package['id'],
                    ]);


                    if($subscribe['s'] == 1) {
                        $s = 1;
                        $m = " You successfully Subscribe to {$package['package_name']} which will last of {$package['days']} Days at ".CURRENCY.$package['price'];
                        $notification = new Notification();

                        $notification->addNotification([
                            'user_id' => $user['id'],
                            'title' => 'Your subscribtion is active',
                            'message' => $m,
                        ]);

                        if(MAIL_ACTIVATION === 1) {
                            $mailer = new Mailer();
                            $details = $m;
                            $mailer->Activity($user['email'], $user['name'], $details, "Your subscribtion is active");
                         }

                    } else {
                        $m = $subscribe['m'];
                    }


                } catch(PDOException $e) {
                    $m = "An Error occur pls contact us if you are debited";
                }
            } else {
                $m = $verify['m'];
            }
        }

        return ['s' => $s, 'm' => $m];
    }
 }