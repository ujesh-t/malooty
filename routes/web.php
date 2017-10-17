<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');


Route::get('/discover', 'ProfileController@all');

Route::get('/user/{username}', 'ProfileController@single_user');

Route::get('/photos/{image}', function($image = null)
{
    $path = storage_path() .'\\app\\photos\\'. $image;
    Log::info($path);
    if (file_exists($path)) { 
        return Response::download($path);
    }
});


Route::get('/photo/{photo_id}', 'HomeController@single');
Route::get('/upload', 'PhotoController@index')->name('upload');

Route::post('/user/follow/{id}', 'FollowController@follow')->name('follow'); // Using a fix but this is not secure because no csrf user can be tricked to follow anyone
 // Not using id because its not seo friendly

Route::post('/upload', 'PhotoController@store');

Route::post('/like/{id}', 'LikesController@like')->name('like');

Route::post('/comment/{photo_id}', 'CommentController@store')->name('add_comment');


//Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');