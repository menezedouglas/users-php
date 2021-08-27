<?php

use CoffeeCode\Router\Router;

$router = new Router(getenv('APP_URL'));

$router->namespace('App\Http\Controllers');

$router->get('/', 'UserController:index');

/**
 * execute
 */
$router->dispatch();

if ($router->error()) {
    var_dump($router->error());
    //router->redirect("/error/{$router->error()}");
}
