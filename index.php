<?php
    
    require_once __DIR__.'/config/init.php';

    use App\Router\Route;
 

    $router = new Route();

    
    
    require_once __DIR__."/web/index.php";


    


    $router->run();



?>