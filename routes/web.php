<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth', 'role:admin')->group(function () {
    Route::post('/materi/create', [App\Http\Controllers\MateriController::class, 'store'])->name('materi.store');
    Route::put('/materi/{materi}', [MateriController::class, 'update'])->name('materi.update');
    Route::delete('/materi/{materi}', [MateriController::class, 'destroy'])->name('materi.delete');
    Route::put('/kelas/{kelas}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/{kelas}', [KelasController::class, 'destroy'])->name('kelas.delete');
    Route::resource('code', CodeController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('materi', MateriController::class);
    Route::resource('absensi', AbsensiController::class);


    Route::resource('user', UserController::class);
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.delete');
});

Route::middleware('auth', 'role:admin,pj')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/home', [App\Http\Controllers\HomeController::class, 'store'])->name('home.store');
    Route::get('/home/show/{id}', [HomeController::class, 'show'])->name('home.show');
    Route::put('/home/{id}', [HomeController::class, 'update'])->name('home.update');
});
