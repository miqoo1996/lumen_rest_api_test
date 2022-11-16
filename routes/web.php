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

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->group(['prefix'=>'user'], function () use ($router) {
        $router->post('register','Auth\RegisterController@signUp');
        $router->post('login','Auth\LogInController@signIn');
        $router->post('recover-password','Auth\LogInController@submitRecoverPassword');
        $router->patch('recover-password','Auth\LogInController@recoverPassword');

        $router->group(['prefix' => 'companies','middleware' => 'auth'], function () use ($router) {
            $router->get('/','CompanyController@companies');
            $router->post('/','CompanyController@create');
        });
    });

});


