<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::name('posts.')->middleware(['auth'])->group(function () {
    Route::get('/posts', 'PostController@index')->withoutMiddleware('auth')->name('index');
    Route::get('/posts/create', 'PostController@create')->name('create');
    Route::post('/posts', 'PostController@store')->name('store');
    Route::get('/posts/{post:slug}/edit', 'PostController@edit')->name('edit');
    Route::patch('/posts/{post:slug}', 'PostController@update')->name('update');
    Route::delete('/posts/{post:slug}', 'PostController@destroy')->name('destroy');
    Route::get('/posts/{post:slug}', 'PostController@show')->withoutMiddleware('auth')->name('show');
});



Route::get('categories/{category:slug}', 'CategoryController@show')->name('categories.show');

route::get('/tags/{tag:slug}', 'TagController@show')->name('tags.show');



Route::view('/about', 'about');

Route::view('/contact', 'contact');



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// cuma buat uji route:list
Route::resource('Uji', 'UjiController');
