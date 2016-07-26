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

// grupa ruta na kojima se koriste middleware-i auth i check.role 
Route::group(['middleware' => ['auth','check.role']], function(){

	Route::auth();

	Route::post('/group','GroupController@createGroup'); // create group

	Route::post('/group/{id}','GroupController@editGroup'); // edit grupe

	Route::get('/group/{id}', 'GroupController@showGroupData')->where('id', '[0-9]+'); // show group data

	Route::get('/group/list', 'GroupController@listGroups'); // lista svih grupa
});

Route::get('/home', 'HomeController@index');

Route::post('/github-data','GithubDataController@storeData');





