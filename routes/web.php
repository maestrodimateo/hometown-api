<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => 'api'], function() use ($router) {

    $router->post('staff/create', ['as' => 'create.staff', 'uses' => 'StaffController@create']);
    $router->get('staff/all', [ 'as' => 'all.staff', 'uses' => 'StaffController@all']);
    $router->delete('staff/delete/{id}', ['as' => 'delete.staff', 'uses' => 'StaffController@delete']);
});