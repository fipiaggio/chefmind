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
	Route::post('/auth_register', 'AuthenticateController@register');
	Route::resource('recipes', 'RecipeController');
	Route::resource('users', 'UserController');
	Route::resource('categories', 'CategoryController');
	Route::resource('steps', 'StepController');
	Route::resource('ingredients', 'ingredientController');
	Route::get('image/{name?}', 'ImageController@getImage');
	Route::post('replaceImage', 'ImageController@replaceImage');
	Route::get('ingredient/{name?}', 'IngredientController@getIngredient');
	Route::get('recipeIngredients/{recipe?}', 'IngredientController@getIngredientByRecipe');
	Route::get('userRecipes', 'RecipeController@getRecipeByUser');
	Route::get('stepRecipes/{recipe?}', 'RecipeController@getStepsByRecipes');
	Route::post('list/', 'RecipeController@getRecipeByIngredients');
});