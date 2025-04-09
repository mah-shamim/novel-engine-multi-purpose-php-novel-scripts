<?php

namespace {{namespace}};

class {{className}}

 {
    // TODO: define your Middleware  functions

    public function handle($callback, ...$params)
    {
        // Your authentication logic here
        if (!isset($_SESSION['Session_ID']) || !isset($_SESSION['Session_name'])) {
            header("HTTP/1.0 401 Unauthorized");
            redirect('/'); # Path to redirect
            return;
        }

        // If authenticated, proceed to the original callback
        call_user_func_array($callback, $params);
    }
 }