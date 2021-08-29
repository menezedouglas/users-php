<?php

require_once __DIR__.'/../vendor/autoload.php';

use Pecee\Http\Middleware\Exceptions\TokenMismatchException;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\Exceptions\HttpException;
use Pecee\SimpleRouter\SimpleRouter;

require_once __DIR__.'/../routes/api.php';

/**
 * The default namespace for route-callbacks, so we don't have to specify it each time.
 * Can be overwritten by using the namespace config option on your routes.
 */

SimpleRouter::setDefaultNamespace('\App\Http\Controllers');

// Start the routing
try {
    SimpleRouter::start();
} catch (TokenMismatchException | NotFoundHttpException | HttpException $e) {
    echo "<pre>";
    var_dump($e);
}