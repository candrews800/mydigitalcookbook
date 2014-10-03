<?php

Route::model('user', 'User');
Route::model('recipe', 'Recipe');
Route::model('tag', 'Tag');

Route::get('/', array('uses' => 'HomeController@displayIndex'));

Route::get('cookbook', array('before' => 'auth', 'uses' => 'CookbookController@displayCookbook'));
Route::get('recipe/{recipe}', array('uses' => 'CookbookController@displaySingleRecipe'));

// Search routes
Route::group(array('prefix' => 'search'), function(){
    Route::get('/', array('uses' => 'SearchController@displayAll'));
    Route::post('{i?}', array('uses' => 'SearchController@redirectSearchResults'));
    Route::get('{i}', array('uses' => 'SearchController@displaySearchResults'));
});

// Recipe routes
Route::group(array('prefix' => 'recipe', 'before' => 'auth'), function(){
    Route::get('add/{recipe}', array('uses' => 'RecipeController@addRecipeToUser'));
    Route::get('remove/{recipe}', array('uses' => 'RecipeController@removeRecipeFromUser'));

    Route::post('new', array('before' => 'csrf', 'uses' => 'RecipeController@saveRecipe'));
    Route::post('{recipe}/edit', array('before' => 'csrf', 'uses' => 'RecipeController@saveRecipe'));
    Route::post('note/{recipe}', array('before' => 'csrf', 'uses' => 'RecipeController@saveRecipeNote'));
});


// Meal routes
Route::group(array('prefix' => 'meal'), function(){
    Route::get('/', array('uses' => 'MealController@displayMeal'));
    Route::get('open', array('uses' => 'MealController@displayOpenMeal'));
    Route::get('add/{i}', array('uses' => 'MealController@addRecipe'));
    Route::get('remove/{i}', array('uses' => 'MealController@removeRecipe'));
});


// Admin routes
Route::group(array('prefix' => 'admin'), function(){

    Route::get('/', array('uses' => 'AdminController@index'));
    Route::get('users', array('uses' => 'AdminController@displayAllUsers'));
    Route::get('users/{user}', array('uses' => 'AdminController@displayUser'));
    Route::post('users/{user}', array('uses' => 'AdminController@editUser'));

    Route::get('recipes', array('uses' => 'AdminController@displayAllRecipes'));
    Route::get('recipes/{recipe}', array('uses' => 'AdminController@displayRecipe'));
    Route::get('recipes/{recipe}/delete', array('uses' => 'AdminController@deleteRecipe'));
    Route::post('recipes/{recipe}', array('uses' => 'AdminController@editRecipe'));

    Route::get('tags', array('uses' => 'AdminController@displayAllTags'));
    Route::post('tags/{tag?}', array('uses' => 'AdminController@editTag'));
    Route::get('tags/{tag}/delete', array('uses' => 'AdminController@deleteTag'));

    Route::get('frontpage', array('uses' => 'AdminController@displayFrontPage'));
    Route::post('frontpage', array('uses' => 'AdminController@editFrontPageDescription'));
    Route::get('frontpage/changeFeatured/{i}', array('uses' => 'AdminController@changeFeaturedRecipe'));

    Route::get('popular_searches', array('uses' => 'AdminController@displayPopularSearches'));
    Route::post('popular_searches/{i}', array('uses' => 'AdminController@editPopularSearches'));
});


// User routes
Route::group(array('prefix' => 'users'), function(){
    Route::get('settings', array('before' => 'auth', 'uses' => 'UsersController@settings'));
    Route::post('settings', array('before' => 'auth|csrf', 'uses' => 'UsersController@changeSettings'));
    Route::post('settings/password', array('before' => 'auth|csrf', 'uses' => 'UsersController@changePassword'));


    // Confide routes
    Route::get('create', 'UsersController@create');
    Route::post('/', 'UsersController@store');
    Route::get('login', 'UsersController@login');
    Route::post('login', 'UsersController@doLogin');
    Route::get('confirm/{code}', 'UsersController@confirm');
    Route::get('forgot_password', 'UsersController@forgotPassword');
    Route::post('forgot_password', 'UsersController@doForgotPassword');
    Route::get('reset_password/{token}', 'UsersController@resetPassword');
    Route::post('reset_password', 'UsersController@doResetPassword');
    Route::get('logout', 'UsersController@logout');
});

