<?php

$router->post('/ajax', function() {
    global $controllerPath;
   return view($controllerPath.'/main/ajax.php');
});

$router->post('/install', function() {
   return view(__DIR__.'/../../shuraih/install/install.php');
});