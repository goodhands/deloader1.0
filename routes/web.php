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

Route::get('/import', 'PostsController@fetchPosts');

Route::post('/posts', 'PostsController@index');

Route::post('/subscribe', 'UserController@subscribe');

Route::post('/archive/{year}', 'PostsController@postsByYear');

// Route::post('/posts/{slug}', 'PostsController@find');

Route::post('/posts/featured', 'PostsController@featured');

Route::post('/posts/gallery', 'PostsController@gallery');

Route::post('/posts/quotes', 'PostsController@quotes');

Route::post('/posts/years', 'PostsController@years');

Route::post('/posts/notables', 'PostsController@notables');

Route::post('/posts/find/{slug}', 'PostsController@find');

Route::post('/category/post/{slug}', 'CategoryController@posts');

Route::post('/category/best3', 'CategoryController@bestThree');

Route::get('/{any}', 'VueController@index')->where('any', '.*');
