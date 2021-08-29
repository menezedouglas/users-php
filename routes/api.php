<?php

use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter as Router;

Router::group(['prefix' => 'user'], function() {
    Router::get(
        '/',
        'UserController@index'
    )->name('api.user');

    Router::post(
        '/new',
        'UserController@store'
    )->name('api.user');
});
