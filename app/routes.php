<?php


Route::get('/', array('uses' => 'HomeController@displayIndex'));
Route::get('cookbook', array('before' => 'auth', 'uses' => 'CookbookController@displayCookbook'));
Route::get('recipe/{i}', array('uses' => 'CookbookController@displaySingleRecipe'));

Route::post('search/{i?}', array('uses' => 'CookbookController@redirectSearchResults'));
Route::get('search/{i?}', array('uses' => 'CookbookController@displaySearchResults'));


Route::post('recipe/new', array('before' => 'auth|csrf', 'uses' => 'RecipeController@saveRecipe'));
Route::get('recipe/{i}/edit', array('before' => 'auth', 'uses' => 'CookbookController@displayEditRecipe'));
Route::post('recipe/{i}/edit', array('before' => 'auth|csrf', 'uses' => 'RecipeController@saveRecipe'));

Route::get('recipe/add/{i}', array('before' => 'auth', 'uses' => 'RecipeController@addRecipeToUser'));
Route::get('recipe/remove/{i}', array('before' => 'auth', 'uses' => 'RecipeController@removeRecipeFromUser'));

Route::post('recipe/note/{i}', array('before' => 'auth|csrf', 'uses' => 'RecipeController@editRecipeNote'));

Route::get('menu', array('uses' => 'MenuController@displayMenu'));
Route::get('menu/open', array('uses' => 'MenuController@displayOpenMenu'));
Route::get('menu/add/{i}', array('uses' => 'MenuController@addRecipe'));
Route::get('menu/remove/{i}', array('uses' => 'MenuController@removeRecipe'));

Route::get('user/settings', array('before' => 'auth', 'uses' => 'UsersController@settings'));
Route::post('user/settings/password', array('before' => 'auth|csrf', 'uses' => 'UsersController@changePassword'));
Route::post('user/settings', array('before' => 'auth|csrf', 'uses' => 'UsersController@changeSettings'));


// Admin routes
Route::get('admin', array('uses' => 'AdminController@index'));

Route::get('admin/users', array('uses' => 'AdminController@displayAllUsers'));
Route::get('admin/users/{i}', array('uses' => 'AdminController@displayUser'));
Route::post('admin/users/{i}', array('uses' => 'AdminController@editUser'));

Route::get('admin/recipes', array('uses' => 'AdminController@displayAllRecipes'));
Route::get('admin/recipes/{i}', array('uses' => 'AdminController@displayRecipe'));
Route::post('admin/recipes/{i}', array('uses' => 'AdminController@editRecipe'));


// Confide routes
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('logout', 'UsersController@logout');
