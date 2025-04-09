<?php
    
    
    use App\Router\Handlers\AdminRoute;
    use App\Middleware\AdminMiddleware;
    postRoute($router, '/login-request', AdminRoute::class.'::HandleLogin');
    postRoute($router, AdminURL.'/ajax', AdminRoute::class.'::HandleAjax', AdminMiddleware::class);
    postRoute($router, AdminURL.'/metacode', AdminRoute::class.'::Meta', AdminMiddleware::class);
    postRoute($router, AdminURL.'/adscode', AdminRoute::class.'::Adscode', AdminMiddleware::class);
    postRoute($router, AdminURL.'/adstxt', AdminRoute::class.'::Adstxt', AdminMiddleware::class);
    postRoute($router, AdminURL.'/instant-indexing', AdminRoute::class.'::instantIndexing', AdminMiddleware::class);
    postRoute($router, AdminURL.'/mail-setting', AdminRoute::class.'::mailingSetting', AdminMiddleware::class);
    postRoute($router, AdminURL.'/([a-zA-Z0-9-]+)/process', AdminRoute::class.'::process', AdminMiddleware::class);


    $router->post(AdminURL.'/login-request', function (){
        require_once __DIR__.'/../../Controllers/admin/login/request.php';
    });
    
         $router->addNotFoundHandler( function () {
    Redirect(AdminURL.'/error');
});
?>