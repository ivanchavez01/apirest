<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' => 'api.auth'], function($api) {

    $api->resource('user', '\App\Http\Controllers\userController');
    $api->get('users/{userId}/roles/{role}', '\App\Http\Controllers\AuthController@attachRole');
    $api->get('user/{userId}/role', '\App\Http\Controllers\AuthController@getRole');
    $api->get('role/permission', '\App\Http\Controllers\AuthController@getPermission');

    $api->post('role/permission/add', '\App\Http\Controllers\AuthController@attachPermission');
});

$api->version('v1', function($api){
    $api->post('auth', 'App\Http\Controllers\Auth\AuthController@authenticate');
    $api->get("products", "App\Http\Controllers\productsController@index");
    $api->get("groups", "App\Http\Controllers\GroupController@index");
});


Route::group(["prefix" => "admin"], function(){
    Route::resource("products", "admin\productsCtrl");
});

Route::get('/', 'productController@index');

//Route::auth();

Route::get('/home', 'HomeController@index');
