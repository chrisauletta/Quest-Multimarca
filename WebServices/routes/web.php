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

//USUARIO
$router->post('register', 'UserController@register');
$router->post('login', 'UserController@login');

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->post('carros/anuncio', 'CarroController@salvarCarros');
    $router->post('carros/buscar', 'CarroController@buscarCarros');
    $router->delete('carros/{id}', 'CarroController@deletarCarro');
});

//----------------------------------------------------------------
