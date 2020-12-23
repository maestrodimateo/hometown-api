<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {

    // Staff management
    $router->post('staff/create', ['as' => 'create.staff', 'uses' => 'StaffController@create']);
    $router->get('staff/all', ['as' => 'all.staff', 'uses' => 'StaffController@all']);
    $router->get('staff/single/{id}', ['as' => 'single.staff', 'uses' => 'StaffController@single_staff']);
    $router->delete('staff/delete/{id}', ['as' => 'delete.staff', 'uses' => 'StaffController@delete']);
    $router->put('staff/update/{id}', ['as' => 'update.staff', 'uses' => 'StaffController@update']);

    // Hometown management
    $router->post('hometown/create', ['as' => 'create.hometown', 'uses' => 'HometownController@create']);
    $router->get('hometown/all', ['as' => 'all.hometown', 'uses' => 'HometownController@all']);
    $router->get('hometown/single/{id}', ['as' => 'single.hometown', 'uses' => 'HometownController@single_hometown']);
    $router->delete('hometown/delete/{id}', ['as' => 'delete.hometown', 'uses' => 'HometownController@delete']);
    $router->put('hometown/update/{id}', ['as' => 'update.hometown', 'uses' => 'HometownController@update']);
});
