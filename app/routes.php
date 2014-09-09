<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'CookbookController@displayAllRecipes'));
Route::get('recipe/{i}', array('uses' => 'CookbookController@displaySingleRecipe'));

Route::post('search/{i?}', array('uses' => 'CookbookController@redirectSearchResults'));
Route::get('search/{i?}', array('uses' => 'CookbookController@displaySearchResults'));


Route::post('recipe/new', array('before' => 'auth|csrf', 'uses' => 'RecipeController@saveRecipe'));
Route::get('recipe/{i}/edit', array('before' => 'auth', 'uses' => 'CookbookController@displayEditRecipe'));
Route::post('recipe/{i}/edit', array('before' => 'auth|csrf', 'uses' => 'RecipeController@saveRecipe'));

Route::get('recipe/add/{i}', array('before' => 'auth', 'uses' => 'RecipeController@addRecipeToUser'));
Route::get('recipe/remove/{i}', array('before' => 'auth', 'uses' => 'RecipeController@removeRecipeFromUser'));


Route::post('register', array('uses' => 'UserController@register'));

Route::post('login', array('uses' => 'AuthController@login'));
Route::get('logout', array('uses' => 'AuthController@logout'));