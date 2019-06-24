<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);


	Route::resource('team', 'TeamController', ['except' => ['show']]);
	// Route::get('team-edit', ['as' => 'team.edit', 'uses' => 'TeamController@edit']);
	// Route::put('team-edit', ['as' => 'team.update', 'uses' => 'TeamController@update']);

	Route::resource('rest', 'RestController', ['except' => ['show']]);
	Route::resource('rest-history', 'RestHistoryController');
	
	// Request a REST break
	Route::get('/check-rest/{type}', 'RestController@rest');
});

// Route::group(['middleware' => 'auth'], function () {
	
// 	// Route::put('team/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
// });

