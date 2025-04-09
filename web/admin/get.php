<?php
    
    
    use App\Router\Handlers\AdminRoute;
    use App\General\Auth;
    use App\Middleware\AdminMiddleware;
    
    addRoute($router, AdminURL.'/login', AdminRoute::class.'::Login' );
    addRoute($router, AdminURL.'/logout', Auth::class.'::logOut' );
    addRoute($router, AdminURL, AdminRoute::class.'::Home' , AdminMiddleware::class);
    addRoute($router, AdminURL.'/ajax', AdminRoute::class.'::HandleAjax' , AdminMiddleware::class);
    addRoute($router, AdminURL.'/author', AdminRoute::class.'::Author', AdminMiddleware::class);
    addRoute($router, AdminURL.'/group', AdminRoute::class.'::Group', AdminMiddleware::class);
    addRoute($router, AdminURL.'/compiler', AdminRoute::class.'::Compiler', AdminMiddleware::class);
    addRoute($router, AdminURL.'/category', AdminRoute::class.'::category', AdminMiddleware::class);
    addRoute($router, AdminURL.'/blog-cats', AdminRoute::class.'::blogCats', AdminMiddleware::class);
    addRoute($router, AdminURL.'/book', AdminRoute::class.'::Book', AdminMiddleware::class);
    addRoute($router, AdminURL.'/ebook', AdminRoute::class.'::Ebook', AdminMiddleware::class);
    addRoute($router, AdminURL.'/page', AdminRoute::class.'::Page', AdminMiddleware::class);
    addRoute($router, AdminURL.'/setting', AdminRoute::class.'::setting', AdminMiddleware::class);
    addRoute($router, AdminURL.'/profile', AdminRoute::class.'::Profile', AdminMiddleware::class);
    addRoute($router, AdminURL.'/dashboard', AdminRoute::class.'::Dashboard', AdminMiddleware::class);
    addRoute($router, AdminURL.'/metacode', AdminRoute::class.'::Meta', AdminMiddleware::class);
    addRoute($router, AdminURL.'/adscode', AdminRoute::class.'::Adscode', AdminMiddleware::class);
    addRoute($router, AdminURL.'/adstxt', AdminRoute::class.'::Adstxt', AdminMiddleware::class);
    addRoute($router, AdminURL.'/packages', AdminRoute::class.'::Package', AdminMiddleware::class);
    addRoute($router, AdminURL.'/subscribe', AdminRoute::class.'::Subscribe', AdminMiddleware::class);
    addRoute($router, AdminURL.'/subscriptions', AdminRoute::class.'::Subscriptions', AdminMiddleware::class);
    addRoute($router, AdminURL.'/posts', AdminRoute::class.'::Posts', AdminMiddleware::class);
    addRoute($router, AdminURL.'/reviews', AdminRoute::class.'::Reviews', AdminMiddleware::class);
    addRoute($router, AdminURL.'/blog-comments', AdminRoute::class.'::blogComments', AdminMiddleware::class);
    addRoute($router, AdminURL.'/payments', AdminRoute::class.'::Payments', AdminMiddleware::class);
    addRoute($router, AdminURL.'/notifications', AdminRoute::class.'::Notifications', AdminMiddleware::class);
    addRoute($router, AdminURL.'/instant-indexing', AdminRoute::class.'::instantIndexing', AdminMiddleware::class);
    addRoute($router, AdminURL.'/mail-setting', AdminRoute::class.'::mailingSetting', AdminMiddleware::class);
    addRoute($router, AdminURL.'/error', AdminRoute::class.'::Error');
    addRoute($router, AdminURL.'/login-request', AdminRoute::class.'::LoginAjax');
    addRoute($router, AdminURL . '/users', AdminRoute::class . '::Users', AdminMiddleware::class);
    // addRoute($roter, AdminURL.'/([a-zA-Z0-9-]+)/process', AdminRoute::class.'::process');
    get($router, AdminURL.'/([a-zA-Z0-9-]+)/process', AdminRoute::class, 'process');

     $router->addNotFoundHandler( function () {
    Redirect(AdminURL.'/error');
});

    
?>