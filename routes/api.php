<?php

use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter as Router;

/**
 * User Route's
 */
Router::group(['prefix' => 'user'], function() {
    
    Router::get(
        '/',
        'UserController@index'
    )->name('api.user');

    Router::post(
        '/new',
        'UserController@store'
    )->name('api.user.new');

    Router::get(
        '/{id}/show',
        'UserController@show'
    )->name('api.user.show');

    Router::put(
        '/{id}/update',
        'UserController@update'
    )->name('api.user.update');

    Router::delete(
        '/{id}/delete',
        'UserController@delete'
    )->name('api.user.delete');

    Router::group(['prefix' => 'by'], function () {

        Router::get(
            '/state',
            'StateController@usersByState'
        )->name('api.user.by.state');

        Router::get(
            '/city',
            'CityController@usersByCity'
        )->name('api.user.by.city');

    });

});

/**
 * Address Route's
 */
Router::group(['prefix' => 'address'], function() {
    
    Router::get(
        '/',
        'AddressController@index'
    )->name('api.address');

    Router::get(
        '/{id}/show',
        'AddressController@show'
    )->name('api.address.show');
    
});

/**
 * State Route's
 */
Router::group(['prefix' => 'state'], function() {
    
    Router::get(
        '/',
        'StateController@index'
    )->name('api.state');

    Router::get(
        '/{id}/show',
        'StateController@show'
    )->name('api.state.show');
    
});

/**
 * City Route's
 */
Router::group(['prefix' => 'city'], function() {
    
    Router::get(
        '/',
        'CityController@index'
    )->name('api.city');

    Router::get(
        '/{id}/show',
        'CityController@show'
    )->name('api.city.show');
    
});
