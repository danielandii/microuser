<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group( ['prefix' => 'api'], function() use ($router) {

    $router->get('users', ['uses' => 'UsersController@index'] );

    $router->get('users/{id}', ['uses' => 'UsersController@show']);
    
    $router->delete('users/{id}',['uses' => 'UsersController@destroy']);
    
    $router->put('users/{id}',['uses' => 'UsersController@update']);
    
    $router->post('users',['uses' => 'UsersController@create']);

    $router->get('department', ['uses' => 'DepartmentController@index'] );

    $router->get('getDepartmentUsers/{id}', ['uses' => 'DepartmentController@getDepartmentUsers'] );

    $router->get('getDepartmentJabatan/{id}', ['uses' => 'DepartmentController@getDepartmentJabatan'] );

    $router->get('department/{id}', ['uses' => 'DepartmentController@show']);
    
    $router->delete('department/{id}',['uses' => 'DepartmentController@destroy']);
    
    $router->put('department/{id}',['uses' => 'DepartmentController@update']);
    
    $router->post('department',['uses' => 'DepartmentController@create']);

    $router->get('jabatan', ['uses' => 'JabatanController@index'] );

    $router->get('jabatan/{id}', ['uses' => 'JabatanController@show']);

    $router->delete('jabatan/{id}',['uses' => 'JabatanController@destroy']);

    $router->put('jabatan/{id}',['uses' => 'JabatanController@update']);

    $router->post('jabatan',['uses' => 'JabatanController@create']);

    /*Route::resource('jabatan', 'JabatanController');*/
});