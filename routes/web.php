<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BukuController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function(){
    return view('about', [
        'name' => 'Antony Santos', 
        'email' => 'elgasing@gmail.com'
    ]);
});



Route::get('/about-us', function () {
    return view('about-us');
});


Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');


Route::get('/posts',[PostController::class, 'index']);

Route::get('/buku', [BukuController::class, 'index']);