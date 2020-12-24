<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {

    // Staff management
    $router->post('staff/create', ['as' => 'create.staff', 'uses' => 'StaffController@create']);
    $router->get('staff/all', ['as' => 'all.staff', 'uses' => 'StaffController@all']);
    $router->get('staff/single/{id}', ['as' => 'single.staff', 'uses' => 'StaffController@single_staff']);
    $router->delete('staff/delete/{id}', ['as' => 'delete.staff', 'uses' => 'StaffController@delete']);
    $router->put('staff/update/{id}', ['as' => 'update.staff', 'uses' => 'StaffController@update']);
    $router->post('staff/search', ['as' => 'search.staff', 'uses' => 'StaffController@search']);

    // Hometown management
    $router->post('hometown/create', ['as' => 'create.hometown', 'uses' => 'HometownController@create']);
    $router->get('hometown/all', ['as' => 'all.hometown', 'uses' => 'HometownController@all']);
    $router->get('hometown/single/{id}', ['as' => 'single.hometown', 'uses' => 'HometownController@single_hometown']);
    $router->delete('hometown/delete/{id}', ['as' => 'delete.hometown', 'uses' => 'HometownController@delete']);
    $router->put('hometown/update/{id}', ['as' => 'update.hometown', 'uses' => 'HometownController@update']);
    $router->post('hometown/search', ['as' => 'search.hometown', 'uses' => 'HometownController@search']);

    // User management
    $router->post('user/create', ['as' => 'create.user', 'uses' => 'UserController@create']);
    $router->put('user/update/{id}', ['as' => 'update.user', 'uses' => 'UserController@update']);
    $router->get('user/single/{id}', ['as' => 'single.user', 'uses' => 'UserController@single_user']);
    $router->get('user/all', ['as' => 'all.user', 'uses' => 'UserController@all']);
    $router->delete('user/delete/{id}', ['as' => 'delete.user', 'uses' => 'UserController@delete']);
    $router->get('logout', ['as' => 'logout.user', 'uses' => 'UserController@logout']);
    $router->post('user/search', ['as' => 'search.user', 'uses' => 'UserController@search']);
});

$router->post('api/login', ['as' => 'login.user', 'uses' => 'UserController@login']);

