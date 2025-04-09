<?php

namespace App\Middleware;

class AuthMiddleware
{
    public function handle($callback, ...$params)
    {
        // Your authentication logic here
        if (!isset($_SESSION['loginID']) || !isset($_SESSION['loginName'])) {
            header("HTTP/1.0 401 Unauthorized");
            redirect('/login');
            return;
        }

        // If authenticated, proceed to the original callback
        call_user_func_array($callback, $params);
    }
}
