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
 
// route bawaan default laravel
Route::get('/', function () {
	return view('welcome');
});

Route::get('ha;o', function(){
    return "halo, selamat datang di tutorial laravel";
});
 
Route::get(blog, function(){
    return view('blog');
});

// route blog
// Route::get('/blog', 'BlogController@home');
// Route::get('/blog/tentang', 'BlogController@tentang');
// Route::get('/blog/kontak', 'BlogController@kontak');