<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => 'api'], function() use ($router) {

    $router->post('create-staff', ['as' => 'create.staff', 'uses' => 'StaffController@create']);
    $router->get('all-staff', [ 'as' => 'all.staff', 'uses' => 'StaffController@allStaff']);
});