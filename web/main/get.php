<?php

use App\Router\Handlers\MainRoute;
use App\Middleware\AuthMiddleware;
use App\General\User\Auth;

addRoute($router, '/', MainRoute::class.'::Home');
get($router, '/category', MainRoute::class, 'Archives');
get($router, '/install', MainRoute::class, 'Install');
get($router, '/authors', MainRoute::class, 'Archives');
get($router, '/compilers', MainRoute::class, 'Archives');
get($router, '/groups', MainRoute::class, 'Archives');
get($router, '/books', MainRoute::class, 'Archives');
get($router, '/ebooks', MainRoute::class, 'Archives');
get($router, '/category/([a-zA-Z0-9-]+)', MainRoute::class, 'Archive');
get($router, '/author/([a-zA-Z0-9-]+)', MainRoute::class, 'Archive');
get($router, '/compiler/([a-zA-Z0-9-]+)', MainRoute::class, 'Archive');
get($router, '/group/([a-zA-Z0-9-]+)', MainRoute::class, 'Archive');
get($router, '/book/([a-zA-Z0-9-]+)', MainRoute::class, 'Archive');
get($router, '/ebooks/([a-zA-Z0-9-]+)', MainRoute::class, 'Ebooks');
get($router, '/blog/([a-zA-Z0-9-]+)', MainRoute::class, 'blogView');
get($router, '/read/([a-zA-Z0-9-]+)', MainRoute::class, 'Read');
get($router, '/download/([a-zA-Z0-9-]+)', MainRoute::class, 'Download');
get($router, '/page/([a-zA-Z0-9-]+)', MainRoute::class, 'Page');
get($router, '/blog', MainRoute::class, 'Blog');
get($router, '/search', MainRoute::class, 'Search');
$router->get('/error', function() {
    
    global $templatePath;
         $title = "Error Page not Found";
         $path = $templatePath.'/main/error.php';
          view([$templatePath.'/main/header.php', $path, $templatePath.'/main/footer.php'], ['title' => $title]);
    
});
get($router, '/signup', MainRoute::class, 'Register');
get($router, '/login', MainRoute::class, 'Login');
get($router, '/forgot-password', MainRoute::class, 'forgotPassword');
get($router, '/reset', MainRoute::class, 'Reset');

$router->get('/ajax', function() {
    global $controllerPath;
    return view($controllerPath.'/main/ajax.php');
});
$router->get('/account', function() {
    global $controllerPath, $templatePath;
    return view([$controllerPath.'/main/account.php', $templatePath.'/main/header.php', $templatePath.'/main/account.php', $templatePath.'/main/footer.php']);
}, AuthMiddleware::class);

$router->get('/logout', function() {
    $auth = new Auth();
    $auth->logout();
    redirect('/');
});

get($router, '/([a-zA-Z0-9-]+)', MainRoute::class, 'View');


     $router->addNotFoundHandler( function () {
         global $templatePath;
         $title = "Error Page not Found";
         $path = $templatePath.'/main/error.php';
          view([$templatePath.'/main/header.php', $path, $templatePath.'/main/footer.php'], ['title' => $title]);
});