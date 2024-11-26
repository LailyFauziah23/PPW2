<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\GreetController;
//Tugas Praktikum
use App\Http\Controllers\GalleryController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/info', [InfoController::class, 'index'])->name('info');
Route::get('/greet', [GreetController::class,'greet']) ->name('greet');

//Tugas Praktikum
Route::get('/gallery', [GalleryController::class, 'apiIndex'])->name('api.gallery');