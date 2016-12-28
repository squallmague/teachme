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

//passwords
Route::get('password/email','Auth\PasswordController@getEmail');
Route::post('password/email','Auth\PasswordController@postEmail');

//passwords reset
Route::get('password/reset/{token}','Auth\PasswordController@getReset');
Route::post('password/reset','Auth\PasswordController@postReset');

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

Route::group(['middleware' => 'auth'], function () {

	//Crear Solicitudes

	Route::get('/solicitar',[
		'as' 	=> 'tickets.create',
		'uses' 	=> 'TicketsController@create'
	]);

	Route::post('/solicitar',[
		'as' 	=> 'tickets.store',
		'uses' 	=> 'TicketsController@store'
	]);

	//Votar

	Route::post('votar/{id}',[
		'as' 	=> 'votes.submit',
		'uses' 	=> 'VotesController@submit'
	]);

	Route::delete('votar/{id}',[
		'as' 	=> 'votes.destroy',
		'uses' 	=> 'VotesController@destroy'
	]);

	Route::post('comentar/{id}',[
		'as' 	=> 'comments.submit',
		'uses' 	=> 'CommentsController@submit'
	]);

	//Comentar
	//comentar/5
	//comentar/10
});