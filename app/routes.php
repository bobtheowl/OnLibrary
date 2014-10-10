<?php

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
*/

Route::filter('requireAuth', function () {
    $user = App::make('OnLibrary\User\CurrentUser');
    if ($user->isLoggedIn() === false) {
        return Redirect::to('login');
    }//end if
});//end requireAuth filter

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('login', function () {
    return View::make('login');
});//end login GET route
Route::get('register', function () {
    return View::make('register');
});//end register GET route
Route::post('login', ['uses' => 'AuthenticationController@authenticate']);

// Routes which require authentication to access
Route::group(['before' => 'requireAuth'], function () {
    // Resource controllers
    Route::resource('author', 'AuthorResource');
    Route::resource('book', 'BookResource');
    Route::resource('publisher', 'PublisherResource');
    Route::resource('series', 'SeriesResource');
    Route::resource('user', 'UserResource');

    // Routes
    Route::get('logout', ['uses' => 'AuthenticationController@logout']);
    Route::get('/', function () {
        return View::make('dashboard');
    });//end / GET route
});//end route group

//end file routes.php
