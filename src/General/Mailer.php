<?php
namespace App\General;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{

    private $mail;

    public function __construct() 
    {
        $this->mail = new PHPMailer(true);
        
        $this->mail->isSMTP();
        $this->mail->Host = MAIL_HOST; 
        $this->mail->SMTPAuth = true;
        $this->mail->Username = MAIL_USERNAME; 
        $this->mail->Password = MAIL_PASSWORD; 
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
        $this->mail->Port = MAIL_PORT; 
        
        // Email settings
        $this->mail->setFrom(MAIL_FROM, APP_NAME);
    }

    public function Registration($toEmail, $toName, $details) {
        try {

              // Clear previous recipients
              $this->mail->clearAddresses();
            // Recipient
            $this->mail->addAddress($toEmail, $toName);

            // Content
            $this->mail->isHTML(true);
            $this->mail->Subject = 'Registration Successful';
            $this->mail->Body = $this->registrationBody($details);

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$this->mail->ErrorInfo} and {$e->getMessage()}");
            return false;
        }
    }

    public function Activity($toEmail, $toName, $details, $title) {
        try {

                    // Clear previous recipients
        $this->mail->clearAddresses();
        
            // Recipient
            $this->mail->addAddress($toEmail, $toName);

            // Content
            $this->mail->isHTML(true);
            $this->mail->Subject = $title;
            $this->mail->Body = $this->activityBody($details, $title);

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}");
            return false;
        }
    }

    public function paswordReset($toEmail, $toName, $resetLink) {
        try {
            // Recipient
            $this->mail->addAddress($toEmail, $toName);

            // Content
            $this->mail->isHTML(true);
            $this->mail->Subject = 'Password Reset Request';
            $this->mail->Body = $this->resetBody($resetLink);

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}");
            return false;
        }
    }

    private function registrationBody($details) {
        // Customize this HTML as per your requirements
        $device_info = $_SERVER['HTTP_USER_AGENT'];
        $ip = get_client_ip();
        $response = file_get_contents("http://ip-api.com/json/{$ip}");
        $location = json_decode($response, true);
        return '
        <body style="font-family: Arial, sans-serif; color: #333; margin: 0; padding: 0; background-color: #f4f4f4;">
            <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px;">
                <div style="text-align: center;">
                    <h1 style="color: #c416bb;">Welcome to '.APP_NAME.'</h1>
                    <p style="font-size: 16px;">Thank you for registering with us. We are thrilled to have you!</p>
                    <p style="font-size: 16px;">Details:</p>
                    <p style="font-size: 15px;">
                    Username: '.$details['username'].'<br>
                    Email: '.$details['email'].'
                    </p>
                    <p>Best regards</p>
                </div>
                <div style="border-top: 1px solid #e0e0e0; padding-top: 20px; margin-top: 20px;">
                    <h2>Device Info</h2>
                    <p style="font-size: 14px;">
                        IP Address: ' . $ip . '<br>
                        Device Information: ' . $device_info . '<br>
                        Country: ' . (isset($location['country']) ? $location['country'] : '') . '<br>
                        Region: ' . (isset($location['regionName']) ? $location['regionName'] : '') . '<br>
                        City: ' . (isset($location['city']) ? $location['city'] : '') . '
                    </p>
                </div>
                <footer style="font-size: 11px; color: #585656; margin-top: 30px; text-align: center;">
                    ' . BASE_URL . '
                </footer>
            </div>
        </body>
        ';

        return '
            <body style="font-family: Arial, sans-serif; color: #333; margin: 0; padding: 0;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                    <td style="padding: 20px; background-color: #f4f4f4;">
                        <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff; padding: 20px;">
                        <tr>
                            <td style="text-align: center;">
                            <h1 style="color: #c416bb;">Welcome to '.APP_NAME.'</h1>
                            <p style="font-size: 16px;">Thank you for registering with us. We are thrilled to have you!</p>
                            <p style="font-size: 16px;">Details:</p>
                            <ul>
                                <li>Username: '.$details['username'].'</li>
                                <li>Email: '.$details['email'].'</li>
                            </ul>
                            <p>Best regards</p>
                            <br>
                            
                            <p style="font-size: 11px; color:#585656; margin-top:30px;">'.BASE_URL.' </p>
                            </td>
                        </tr>
                        </table>
                    </td>
                    </tr>
                </table>
            </body>
        ';
    }

    private function resetBody($resetLink) {
        // Customize this HTML as per your requirements

        $device_info = $_SERVER['HTTP_USER_AGENT'];
        $ip = get_client_ip();
        $response = file_get_contents("http://ip-api.com/json/{$ip}");
        $location = json_decode($response, true);

        return '
        <body style="font-family: Arial, sans-serif; color: #333; margin: 0; padding: 0; background-color: #f4f4f4;">
            <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px;">
                <div style="text-align: center;">
                    <h1 style="color: #c416bb;">Password Reset</h1>
                    <p style="font-size: 16px;">We received a request to reset your password.</p>
                    <p style="font-size: 16px;">Click the button below to reset your password, if you did not request for this pls disregard it.</p>
                    <a href="'.$resetLink.'" style="display: inline-block; padding: 10px 20px; color: #ffffff; background-color: #c416bb; text-decoration: none; border-radius: 5px;">Reset Password</a>
                </div>
                <div style="border-top: 1px solid #e0e0e0; padding-top: 20px; margin-top: 20px;">
                    <h2>Device Info</h2>
                    <p style="font-size: 14px;">
                        IP Address: ' . $ip . '<br>
                        Device Information: ' . $device_info . '<br>
                        Country: ' . (isset($location['country']) ? $location['country'] : '') . '<br>
                        Region: ' . (isset($location['regionName']) ? $location['regionName'] : '') . '<br>
                        City: ' . (isset($location['city']) ? $location['city'] : '') . '
                    </p>
                </div>
                <footer style="font-size: 11px; color: #585656; margin-top: 30px; text-align: center;">
                    ' . BASE_URL . '
                </footer>
            </div>
        </body>
        ';
    }

    private function commentBody($details) 
    {
        return '
        <body style="font-family: Arial, sans-serif; color: #333; margin: 0; padding: 0;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                <td style="padding: 20px; background-color: #f4f4f4;">
                    <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff; padding: 20px;">
                    <tr>
                        <td style="text-align: center;">
                        <h1 style="color: #c416bb;">You make a comment</h1>
                        <p style="font-size: 16px;">'.$details.'.</p>
                        <p style="font-size: 11px; color:#585656; margin-top:30px;">'.BASE_URL.' </p>
                        </td>
                    </tr>
                    </table>
                </td>
                </tr>
            </table>
            </body>
        ';
    }

    private function replyBody($details) 
    {
        return '
        <body style="font-family: Arial, sans-serif; color: #333; margin: 0; padding: 0;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                <td style="padding: 20px; background-color: #f4f4f4;">
                    <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff; padding: 20px;">
                    <tr>
                        <td style="text-align: center;">
                        <h1 style="color: #c416bb;">Someone reply your comment</h1>
                        <p style="font-size: 16px;">'.$details.'.</p>
                        <p style="font-size: 11px; color:#585656; margin-top:30px;">'.BASE_URL.' </p>
                        </td>
                    </tr>
                    </table>
                </td>
                </tr>
            </table>
            </body>
        ';
    }

    private function paymentBody($details)
    {
        return '
        <body style="font-family: Arial, sans-serif; color: #333; margin: 0; padding: 0;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
            <td style="padding: 20px; background-color: #f4f4f4;">
                <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff; padding: 20px;">
                <tr>
                    <td style="text-align: center;">
                    <h1 style="color: #c416bb;">Payment Confirmation</h1>
                    <p style="font-size: 16px;">'.$details.'.</p>
                    <p style="font-size: 11px; color:#585656; margin-top:30px;">'.BASE_URL.' </p>
                    </td>
                </tr>
                </table>
            </td>
            </tr>
        </table>
        </body>
        ';
    }

    private function subscriptionBody($details)
    {
        return '
        <body style="font-family: Arial, sans-serif; color: #333; margin: 0; padding: 0;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
            <td style="padding: 20px; background-color: #f4f4f4;">
                <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff; padding: 20px;">
                <tr>
                    <td style="text-align: center;">
                    <h1 style="color: #c416bb;">Subscription Confirmation</h1>
                    <p style="font-size: 16px;">'.$details.'.</p>
                    <p style="font-size: 11px; color:#585656; margin-top:30px;">'.BASE_URL.' </p>
                    </td>
                </tr>
                </table>
            </td>
            </tr>
        </table>
        </body>
        ';
    }

    private function expireBody($details)
    {
        return '
        <body style="font-family: Arial, sans-serif; color: #333; margin: 0; padding: 0;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
            <td style="padding: 20px; background-color: #f4f4f4;">
                <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff; padding: 20px;">
                <tr>
                    <td style="text-align: center;">
                     <h1 style="color: #c416bb;">Subscription Expired</h1>
                    <p style="font-size: 16px;">Your subscription has expired.</p>
                    <p style="font-size: 16px;">To continue enjoying our services, please renew your subscription.</p>
                    <a href="'.APP_URL.'/account?shu=subscribe" style="display: inline-block; padding: 10px 20px; color: #ffffff; background-color: #c416bb; text-decoration: none; border-radius: 5px;">Renew Subscription</a>
                    <p style="font-size: 11px; color:#585656; margin-top:30px;">'.BASE_URL.' </p>
                    </td>
                </tr>
                </table>
            </td>
            </tr>
        </table>
        </body>
        ';
    }

    private function activityBody($details, $title)
    {
        $device_info = $_SERVER['HTTP_USER_AGENT'];
        $ip = get_client_ip();
        $response = file_get_contents("http://ip-api.com/json/{$ip}");
        $location = json_decode($response, true);

        return '
        <body style="font-family: Arial, sans-serif; color: #333; margin: 0; padding: 0; background-color: #f4f4f4;">
            <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px;">
                <div style="text-align: center;">
                    <h1 style="color: #c416bb;">' . $title . '</h1>
                    <p style="font-size: 16px;">' . $details . '.</p>
                </div>
                <div style="border-top: 1px solid #e0e0e0; padding-top: 20px; margin-top: 20px;">
                    <h2>Device Info</h2>
                    <p style="font-size: 14px;">
                        IP Address: ' . $ip . '<br>
                        Device Information: ' . $device_info . '<br>
                        Country: ' . (isset($location['country']) ? $location['country'] : '') . '<br>
                        Region: ' . (isset($location['regionName']) ? $location['regionName'] : '') . '<br>
                        City: ' . (isset($location['city']) ? $location['city'] : '') . '
                    </p>
                </div>
                <footer style="font-size: 11px; color: #585656; margin-top: 30px; text-align: center;">
                    ' . BASE_URL . '
                </footer>
            </div>
        </body>
        ';
        
    }
    


}