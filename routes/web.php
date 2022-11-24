<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\biodataController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Models\Artikel;
use Illuminate\Routing\RouteGroup;
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
// Halaman Awal
Route::get('/', function () {
    $datas = Artikel::all();
        
    return view('index', [
        'items' => $datas
    ]);
});

// Route dapat diakses oleh admin
Route::middleware(['auth', 'admin'])->group(function () {
    // Route Untuk Masuk ke page untuk mengolah user
    Route::resource('user', UserController::class);

    // Route Untuk Masuk ke page mengisi biodata
    Route::resource('biodata', biodataController::class);
});

// Route dapat diakses ketika sudah login
Route::middleware(['auth'])->group(function () {
    // Route Untuk Masuk ke page untuk mengolah Kategori
    Route::resource('kategori', KategoriController::class);

    // Route Untuk Masuk ke page untuk mengolah Artikel
    Route::resource('artikel', ArtikelController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
