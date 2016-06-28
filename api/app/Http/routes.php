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
    return view('index');
});

Route::group(['middleware' => 'cors'], function(){
	Route::post('/auth_login', 'AuthenticateController@userAuth');
	//$router->post('/auth_register', 'AuthenticateController@register');
	Route::post('/auth_register', 'AuthenticateController@register');
	Route::resource('recipes', 'RecipeController');
	Route::resource('users', 'UserController');
	Route::resource('categories', 'CategoryController');
});