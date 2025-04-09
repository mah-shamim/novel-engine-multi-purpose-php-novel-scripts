<?php
global $lang;
global $rootpath;
header('Content-Type: application/json; charset=utf-8');
if(Input('setting') == "changeP") {
    $s = 0;
    $error = [];
    $m = "";

    $username = Input("username");
    $name = Input("name");
    $email = Input("email");
    $gen =  new App\General\All();
    $user = $gen->getRow('admin_tb','id', $_SESSION['adminID']);
    $oldpass = $user['password'];
    $password = $user['password'];
    
    if(!empty(Input('oldpassword')) || !empty(Input('newpassword')) || !empty(Input('confirmnewpassword'))) {

        if(empty(Input('oldpassword'))) {
            $error[] = "Old Password field cannot be empty";
        }

        if(empty(Input('newpassword'))) {
            $error[] = "New Password field cannot be empty";
        }

        if(empty(Input('confirmnewpassword'))) {
            $error[] = "Confirm Password field cannot be empty";
        }

        if(!password_verify($_POST['oldpassword'], $user['password'])) {
            $error[] = "Invalid Old Password";
        }

        if(password_verify($_POST['newpassword'], $user['password'])) {
            $error[] = "new password and old password cannot be the same";
        }

        if($_POST['newpassword'] != $_POST['confirmnewpassword']) {
            $error[] = "New password and Confirm password must be the same";
        }

        if(count($error) > 0) {
            $m = $error[0];
 
        } else {
            $m = "";
            $password = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
        }
     


    }

    if(empty($m)) {

        $gen = new App\General\All();
        $data = [
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ];
        $id = $user['id'];
        $arg = "id = $id";

        if($gen->EditRow('admin_tb',$data, $arg)) {
            $s = 1;
            $m = "Updated successfully";
        }
    }



    $response = ['message' => $m, 'status' => $s];
    echo json_encode( $response );
} else {
    Redirect("/");
}


