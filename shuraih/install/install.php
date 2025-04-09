<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$currentStep = isset($_GET['step']) ? intval($_GET['step']) : 1;

if (file_exists(__DIR__ . '/../lock.txt')) {
    header('Location: ../');
    exit;
}

$errors = [];
$pages = array('policies', 'install', 'success');
$page = 'policies';

if (isset($_POST['page'])) {
    $getPage = filter_input(INPUT_POST, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (in_array($getPage, $pages)) {
        $page = $getPage;
    }
}



if (isset($_POST['action'])) {
    $page = 'install';
    $errors = [];


    // Collecting input data
    $dbhost = Input('host');
    $dbuser = Input('dbuser');
    $dbpassword = Input('dbpassword');
    $dbname = Input('dbname');
    $domain = Input('app_url');
    $sitename = Input('app_name');
    $sitedesc = Input('description');
    $sitekey = Input('keyword');
    $adminname = Input('admin_name');
    $email = Input('admin_email');
    $username = Input('username');
    $password = Input('password');
    $AdminURL = $domain . '/SHU-Admin';

    // Validation
    if (empty($email)) $errors[] = 'Admin Email cannot be empty';
    if (empty($sitename)) $errors[] = 'Site Name cannot be empty';
    if (empty($sitedesc)) $errors[] = 'Site Description cannot be empty';
    if (empty($sitekey)) $errors[] = 'Site Keywords cannot be empty';
    if (empty($username)) $errors[] = 'Admin Username cannot be empty';
    if (empty($password)) $errors[] = 'Admin Password cannot be empty';
    if (empty($domain)) $errors[] = 'Site URL cannot be empty';
    if (empty($dbhost)) $errors[] = 'Database Host cannot be empty';
    if (empty($dbuser)) $errors[] = 'Database User cannot be empty';
    if (empty($dbname)) $errors[] = 'Database Name cannot be empty';
    if (empty($adminname)) $errors[] = 'Admin Name cannot be empty';
    if (!extension_loaded('gd') || !function_exists('gd_info')) $errors[] = 'Required GD Library for Thumbnail Generator';
    if (version_compare(PHP_VERSION, '7.4', '<')) $errors[] = 'Required PHP version 7.4+ or more';
    if (!function_exists('mysqli_connect')) $errors[] = 'Required MySQLi PHP extension';
    if (!extension_loaded('fileinfo')) $errors[] = 'fileinfo extension required';
    if (!extension_loaded('PDO')) $errors[] = 'PDO extension required';
    if (!function_exists('curl_init')) $errors[] = 'Required cURL PHP extension';
    if (!ini_get('allow_url_fopen')) $errors[] = 'Enable allow_url_fopen in your php.ini';

    if (count($errors) === 0) {
        // Database configuration file content
        $databaseData = "<?php
        define('DBNAME','$dbname');
        define('DBUSER', '$dbuser');
        define('DBPASS','$dbpassword');
        define('DBHOST', '$dbhost');";

        $file = __DIR__ . '/../../config/database.php';

        if (!file_put_contents($file, $databaseData)) {
            $errors[] = 'Unable to Write to database file';
        }

        if (count($errors) === 0) {
            $conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

            if ($conn->connect_error) {
                $errors[] = 'DB Connection Failed: ' . $conn->connect_error;
            }

            try {
                // Initialize classes
                $Admin_class = new App\General\Admin\Admin;
                $Author = new App\General\Admin\Author;
                $Blog = new App\General\Admin\Blogs;
                $Books = new App\General\Admin\Book;
                $Category = new App\General\Admin\Category;
                $Cats = new App\General\Admin\Cats;
                $Compiler = new App\General\Admin\Compiler;
                $Ebook = new App\General\Book;
                $Group = new App\General\Admin\Group;
                $Package = new App\General\Admin\Package;
                $Page = new App\General\Admin\Page;
                $Review = new App\General\Admin\Reviews;
                $Subscription = new App\General\Admin\Subscription;
                $Users = new App\General\User\Auth;
                $Comment = new App\General\User\Comments;
                $Notification = new App\General\User\Notification;
                $Payment = new App\General\User\Payment;

                // Set up admin features
                $Admin_class->Set();
                $Author->Set();
                $Compiler->Set();
                $Group->Set();
                $Users->Set();
                $Cats->Set();
                $Blog->Set();
                $Category->Set();
                $Books->Set();
                $Ebook->Set();
                $Package->Set();
                $Page->Set();
                $Review->Set();
                $Subscription->Set();
                $Comment->Set();
                $Notification->Set();
                $Payment->Set();
            } catch (PDOException $e) {
                $errors[] = 'Error creating tables ' . $e->getMessage();
            }

            if (count($errors) === 0) {
                $db = new App\General\DB;

                try {
                    $db->table('admin_tb')->insert([
                        'name' => $adminname,
                        'username' => $username,
                        'email' => $email,
                        'password' => password_hash($password, PASSWORD_DEFAULT)
                    ]);
                } catch (PDOException $e) {
                    $errors[] = 'Error creating Admin ' . $e->getMessage();
                }

                if (count($errors) === 0) {
                    $baseURL = basename($domain);
                    $configData = "<?php
                    define('BASE_URL', '$baseURL');
                    define('APP_URL', '$domain');
                    define('APP_NAME', '$sitename');
                    define('APP_DESC', '$sitedesc');
                    define('APP_KEY', '$sitekey');
                    define('REGISTER', 0);
                    define('READ_FREE', 1);
                    define('DOWNLOAD', 1);
                    define('INSTANT_INDEXING', 1);
                    define('FILE_LIMIT', 20);
                    define('RELATED_LIMIT', 10);
                    define('SUBSCRIBE', 1);
                    define('CURRENCY', 'N');
                    define('CAT_HOME1', 2);
                    define('CAT_HOME2', 1);
                    define('APP_MAIL', 'novelengin@mail.com');
                    define('PAYSTACK_API', 'pk_test_9549d05f0e7cad7b7a15c166da6d4ccf88bfa865');
                    define('PAYSTACK_KEY', 'sk_test_781228e934e26d21f523197e85daaac548ebca86');
                    define('APP_PHONE', '65584-5678');
                    define('APP_ADDRESS', 'Robert Robertson, 1234 NW Bobcat Lane, St. Robert, MO 65584-5678');
                    define('FACEBOOK_URL', 'https://www.facebook.com/littafanyaki.com.ng?mibextid=ZbWKwL');
                    define('X_URL', '');
                    define('TELEGRAM_URL', 'https://t.me/+gq3s_oalACozZjhk');
                    define('TIKTOK_URL', 'https://vm.tiktok.com/ZMr1gp6tq/');
                    define('INSTAGRAM_URL', 'https://chat.whatsapp.com/FcgwPEaiXNK3rT2AkAIAdQ');
                    define('LOGO_URL', '$domain/Public/img/logo.png');
                    date_default_timezone_set('Africa/Lagos');
                    ?>";

                    $file = __DIR__ . '/../../config/config.php';

                    if (!file_put_contents($file, $configData)) {
                        $errors[] = 'Unable to Write to Configuration file';
                    }

                    if (count($errors) === 0) {
                        $lockFile = __DIR__ . '/../lock.txt';
                        $lockFileContent = "Script is Locked. Please don't delete this file unless you know what you are doing.
                        NovelEngine Php Script - Number One Novel multi-task script
                        Dev: Shuraihu Usman
                        Contact: WhatsApp - +2349035767018, shuraihusman@gmail.com";
                        file_put_contents($lockFile, $lockFileContent);

                        $directories = [
                            __DIR__ . '/../../Public/files',
                            __DIR__ . '/../../Public/thumb/182x268',
                            __DIR__ . '/../../Public/thumb/225x325',
                            __DIR__ . '/../../Public/thumb/450x650',
                            __DIR__ . '/../../Public/thumb/author',
                            __DIR__ . '/../../Public/thumb/blogs',
                            __DIR__ . '/../../Public/thumb/cats',
                            __DIR__ . '/../../Public/thumb/users',
                        ];

                        foreach ($directories as $dir) {
                            if (!is_dir($dir)) {
                                mkdir($dir, 0777, true);
                            }
                        }

                        $page = 'success';
                    }
                }
            }
        }
    }
    
        // Display errors if any
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NovelEngine PHP Installer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: black;
        }
        .container {
            margin-top: 50px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            
        }

        .alert {
            background: #dedede;
            color: red;
            padding: 9px;
            border-radius: 4px;
        }

        .header {
            text-align:center;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
        }
        h1, h2 {
            color: #c416bb;
        }
        .btn-custom {
            background-color: #c416bb;
            color: white;
            margin-right: 5px;
        }
        .form-control {
            border: 1px solid #c416bb;
        }
        .form-control:focus {
            box-shadow: 0 0 5px rgba(196, 22, 187, 0.5);
            border-color: #c416bb;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
    <h1>NovelEngine PHP Installer</h1>
    <p><strong>Developer:</strong> <a href="//fb.com/shuraih.usman">Shuraihu Usman</a><br>
       <strong>Contact:</strong> +2349035767018, shuraihusman@gmail.com
       <br> <strong>Description:</strong> The multi-task edge novel community script</p>
    </div>

    <?php if (count($errors) > 0) {
            echo '<div class="alert">';
            foreach ($errors as $error) {
                echo $error . '<br>';
            }
            echo '</div>';
        }; ?>

    <?php if ($page == 'policies') : ?>
    <h2><strong>Requirements:</strong></h2>
    <ul>
        <li>PHP >= 7.4</li>
        <li>MySQL or MariaDB</li>
        <li>PDO extension required</li>
        <li>Web Server (Apache, Nginx, etc.)</li>
        <li>PHP GD Library Extension</li>
        <li>PHP cURL Extension</li>
        <li>PHP fileinfo Extension</li>
        <li> allow_url_fopen in your php.ini</li>
    </ul>
    <div class="terms">
                <h1 style="font-size: 20px; font-weight: bold;">LICENSE AGREEMENT:</h1>
                <br>
                <b>You CAN:</b><br> 1) Use on one (1) domain only, additional license purchase required for each additional domain.<br> 2) Modify or edit as you see fit.<br> 3) Delete sections as you see fit.<br>
                <br><b style="color: red;">You CANNOT:</b> <br>1) Resell, distribute, give away or trade by any means to any third party or individual without permission.<br> 2) Use on more than one (1) domain.
                <br><br>If You Want to Install Multiple Site Or SELL,License, Sub-license Or Distribute Buy Extended License.
                <hr>
                <form action="" method="post">
                    <input type="hidden" name="page" value="install">
                    <div class="terms">
                        <input type="checkbox" name="agree" id="agree" value="checked" required>
                        <label for="agree"> I agree to the to above policies</label>
                    </div>
                    <button type="submit" class="btn btn-custom mt-3">Accept</button>
                </form>
            </div>


    <?php elseif ($page == 'install') : ?>

    <form class="row" action="" method="POST">
  
            <!-- Database Details -->
            <h2>Database Details</h2>
            <div class="col-md-6 mb-3">
                <label for="dbname" class="form-label">Database Name</label>
                <input type="text" class="form-control" id="dbname" name="dbname" required value="<?php echo isset($dbname) ? $dbname : ''; ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="host" class="form-label">Host</label>
                <input type="text" class="form-control" id="host" name="host" required value="<?php echo isset($dbhost) ? $dbhost : 'localhost'; ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="dbuser" class="form-label">Database User</label>
                <input type="text" class="form-control" id="dbuser" name="dbuser" required value="<?php echo isset($dbuser) ? $dbuser : ''; ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="dbpassword" class="form-label">Database Password</label>
                <input type="password" class="form-control" id="dbpassword" name="dbpassword" value="<?php echo isset($dbpassword) ? $dbpassword : ''; ?>">
            </div>

            <!-- Site Details -->
            <h2>Site Details</h2>
            <div class="col-md-6 mb-3">
                <label for="app_name" class="form-label">App Name</label>
                <input type="text" class="form-control" id="app_name" name="app_name" required value="<?php echo isset($sitename) ? $sitename : 'NovelEngine'; ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="app_url" class="form-label">App URL <small style="color:red;">remove end slash (<b>/</b>)</small> </label>
                <input type="url" class="form-control" id="app_url" name="app_url" required value="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . '://'.$_SERVER['HTTP_HOST'];?>">
            </div>
            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required> <?php echo isset($sitedesc) ? $sitedesc : 'Download / read Novels and Ebooks'; ?></textarea>
            </div>
            <div class="col-md-12 mb-3">
                <label for="keyword" class="form-label">Keyword</label>
                <input type="text" class="form-control" id="keyword" name="keyword" required value="<?php echo isset($sitekey) ? $sitekey : 'Novels, Ebook, Book, Fiction, non-fiction'; ?>">
            </div>

            <!-- Admin Details -->
            <h2>Admin Details</h2>
            <div class="col-md-6 mb-3">
                <label for="admin_name" class="form-label">Admin Name</label>
                <input type="text" class="form-control" id="admin_name" name="admin_name" required value="<?php echo @$adminname; ?>" placeholder="Set New Username">
            </div>
            <div class="col-md-6 mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required value="<?php echo @$username; ?>" placeholder="Set New Password">
            </div>
            <div class="col-md-6 mb-3">
                <label for="admin_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="admin_email" name="admin_email" required value="<?php echo @$email; ?>" placeholder="Set New Email">
            </div>

            <div class="col-md-6 mb-3">
                <label for="admin_password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required value="<?php echo @$password; ?>" placeholder="Set New Password">
            </div>
            <button type="submit" name="action" class="btn btn-custom">Install</button>
 
    </form>
    <?php else: ?>
        <h2 class="subheader">
                    Successfuly Installed.
                </h2>
                <div class="m-2" style="color: orangered;">
                    Thank You So Much.
                </div>
                <div class="alert m-2">
                    Note: First Login Admin Panel then update setting.
                </div>
                <div class="form-group">
                    <label>Admin Username:</label>
                    <input type="text" class="form-control" value="<?php echo @$username; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Admin Password:</label>
                    <input type="text" class="form-control" value="<?php echo @$password; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Admin URL:</label>
                    <input type="text" class="form-control" value="<?php echo @$AdminURL; ?>" readonly>
                </div>
                <div class="centerText m-2">
                    <a href="<?php echo @$AdminURL; ?>" target="_blank">Login Admin Panel</a>
                </div>

    <?php endif; ?>
</div>

</body>
</html>
