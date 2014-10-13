<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::group(['before' => 'guest'], function () {
    Route::get('login', function () {
        return View::make('login');
    });//end login GET route
    Route::get('register', function () {
        return View::make('register');
    });//end register GET route
});
Route::post('login', ['uses' => 'AuthenticationController@authenticate']);
Route::resource('user', 'UserResource');

// Routes which require authentication to access
Route::group(['before' => 'auth'], function () {
    // Resource controllers
    Route::resource('author', 'AuthorResource');
    Route::resource('book', 'BookResource');
    Route::resource('publisher', 'PublisherResource');
    Route::resource('series', 'SeriesResource');

    // Routes
    Route::get('logout', ['uses' => 'AuthenticationController@logout']);
    Route::get('/', function () {
        return View::make('dashboard');
    });//end / GET route
    Route::get('add', function () {
        return View::make('add');
    });//end add GET route
    Route::get('search', function () {
        return View::make('search');
    });//end search GET route
});//end auth group
Route::group(['prefix' => 'manage', 'before' => 'auth'], function () {
    Route::get('books', function () {
        return View::make('manage.books');
    });//end manage/books GET route
    Route::get('profile', function () {
        return View::make('manage.profile');
    });//end manage/profile GET route
});//end manage/* group

//end file routes.php
