<?php

namespace App\Middleware;

class AdminMiddleware
{
    public function handle($callback, ...$params)
    {
        // Your authentication logic here
        if (!isset($_SESSION['adminID']) || !isset($_SESSION['adminName'])) {
            header("HTTP/1.0 401 Unauthorized");
            redirect('/SHU-Admin/login');
            return;
        }

        // If authenticated, proceed to the original callback
        call_user_func_array($callback, $params);
    }
}
