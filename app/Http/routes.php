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

// middleware ili filter koji filtrira http zahtjeve, znaci npr. postoji auth middleware koji ako se koristi na odredenoj
// ruti prvo provjeri jeli korisnik autentificiran u app, ako jest pusta ga da izvrsi odredeni zahtjev, inace ga preusmjerava na login screen

Route::get('/', function () {
	return view('welcome');
});

Route::get('/test','GroupController@test');

// Authentication Routes...
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');

// Password Reset Routes...
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');

// grupa ruta na kojima se koriste middleware-i auth i check.role
Route::group(['middleware' => ['auth','check.role']], function(){

	// Registration Routes...
	Route::get('register', 'Auth\AuthController@showRegistrationForm');
	Route::post('register', 'Auth\AuthController@register');

	Route::post('/group','GroupController@createGroup'); // create group

	Route::post('/group/{id}','GroupController@editDeleteGroup'); // edit grupe

	Route::get('/group/list', 'GroupController@listGroups'); // lista svih grupa

	Route::get('/user/list', 'UserController@listUsers'); // lista svih korisnika

	Route::post('/user/{id}', 'UserController@addUserToGroup');
});

Route::group(['middleware' => ['auth']], function(){

Route::get('/user/groups', 'UserController@userGroups')->middleware('auth'); // korisnik ima izlist svih grupa u kojima se nalazi

Route::get('/user/group/{id}', 'UserController@showMyGroupData')->middleware('auth'); // korisnik moze vidjeti podatke grupe u kojoj se nalazi

});

Route::get('/home', 'HomeController@index');

Route::post('/github-data','GithubDataController@storeData');





