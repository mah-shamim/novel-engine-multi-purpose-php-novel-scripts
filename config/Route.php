<?php
    
    function get($router, $urlPattern, $class, $method,  $middleware = null)
{
    $handler = function () use ($class, $method) {
        // Get the matched parameters from the router
        $params = func_get_args();

        // Instantiate the class
        $instance = new $class();

        // Call the specified method with the matched parameters
        call_user_func_array([$instance, $method], $params);
    };

    $router->get($urlPattern, $handler, $middleware);
    $router->get($urlPattern.'/', $handler, $middleware);
    }

    function post($router, $urlPattern, $class, $method, $middleware = null)
    {
    $handler = function () use ($class, $method) {
        $params = func_get_args();

        $instance = new $class();

        call_user_func_array([$instance, $method], $params);
    };

    $router->post($urlPattern, $handler, $middleware);
    $router->post($urlPattern.'/', $handler, $middleware);
    }

    function addRoute($router, $url, $handler,  $middleware = null)
    {
    
        $router->get($url, $handler, $middleware);
        $router->get($url.'/', $handler, $middleware); 
    }

    function postRoute($router, $url, $handler, $middleware = null)
    {
    
        $router->post($url, $handler, $middleware);
        $router->post($url.'/', $handler, $middleware); 
    }
?>