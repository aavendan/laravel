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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'MyController@index');
Route::resource('fabricantes','FabricanteController');
Route::resource('fabricantes.vehiculos','FabricanteVehiculoController',['except'=>['show']]);
//Route::get('/', 'VehiculoController@showAll');
Route::resource('vehiculos', 'VehiculoController',['only'=>['index','show']]);