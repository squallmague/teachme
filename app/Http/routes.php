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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['as' =>'auth/login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth/logout', 'uses' => 'Auth\AuthController@getLogout']);
 
// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', ['as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister']);

Route::get('/',[
	'as'	=> 'tickets.latest',
	'uses' 	=> 'TicketsController@latest'
]);

Route::get('/populares',[
	'as'	=> 'tickets.popular',
	'uses' 	=> 'TicketsController@popular'
]);

Route::get('/pendientes',[
	'as'	=> 'tickets.open',
	'uses' 	=> 'TicketsController@open'
]);

Route::get('/tutoriales',[
	'as'	=> 'tickets.closed',
	'uses' 	=> 'TicketsController@closed'
]);

Route::get('/solicitud/{id}',[
	'as'	=> 'tickets.details',
	'uses' 	=> 'TicketsController@details'
]);