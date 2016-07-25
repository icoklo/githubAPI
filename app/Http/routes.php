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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::post('/github-data','GithubDataController@storeData');

Route::post('/save_group/','GroupController@insertGroup');

Route::post('/group/{id}','GroupController@editGroup');

Route::get('/insert_group',function(){
	return view('insert_group');
});

// Route::get('/group/{id}', "")->where('id', '[0-9]+');

// Route::get('/group/list', "");