<?php


header('Content-Type: application/json');

$check = [];
use App\General\Auth;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['submit'] === 'login') {
        $username =  htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
        $password = $_POST['password'];
        $Auth = new Auth();

        $check = $Auth->check($username, $password);
    }

    $m = $check['m'];
    $s = $check['s'];

    echo json_encode(['s' => $s, 'm' => $m]);
} else {
    echo json_encode(['s' => 0, 'm' => 'ERROR']);

}
?>
