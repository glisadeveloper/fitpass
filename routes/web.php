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

$router->group(['prefix' => 'api/'], function() use($router){
  	$router->get('members', 'MemberController@index');  	
  	$router->get('reception/logs/{card_id}', 'MemberController@logs');
  	$router->get('reception/{card_id}/{object_name}', 'MemberController@show');  	
  	$router->post('reception', 'MemberController@create');
  	$router->put('reception/{id}', 'MemberController@update');
  	$router->delete('reception/{id}', 'MemberController@destroy');
});
