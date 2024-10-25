<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\Auth\LoginRegisterController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//pertemuan 3
Route::get('/about', function(){
    return view('about', [
        'name' => 'Antony Santos', 
        'email' => 'elgasing@gmail.com'
    ]);
});

Route::get('/about-us', function () {
    return view('about-us');
});


//latihan pertemuan 3
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');


//pertemuan 4
// Route::get('/posts',[PostController::class, 'index']);


//pertemuan 5
Route::get('/buku', [BukuController::class, 'index']);


//pertemuan 6
//routes > web.php
Route::get('/buku', [BukuController::class, 'index']); 
Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');

//routes > web.php
Route::get('/posts', [PostController::class, 'index']);

Route::get('/buku', [BukuController::class, 'index']);
Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');
Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');

Route::controller (LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/strore', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('restricted', function() {
    return redirect(route('dashboard'))->with('success', 'Anda berusia lebih dari 18 tahun!');
})->middleware('checkage');

// Route untuk Admin
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [LoginRegisterController::class, 'dashboard'])->name('admin.dashboard');
});

// Route untuk User Biasa
Route::get('/home', [LoginRegisterController::class, 'dashboard'])->name('home');


// Route::middleware(['admin'])->group(function () {
//     Route::get('/admin', [AdminController::class, 'index']);
// });


// Route::middleware(['auth', 'checkage'])->group(function () {
//     Route::get('/dashboard', [LoginRegisterController::class, 'dashboard'])->name('dashboard');
//     // Other protected routes
// });

// Route::get('/home', function () {
//     return view('home');
// })->name('home');