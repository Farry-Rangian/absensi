<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AsistenController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\DashboardController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::post('/', [DashboardController::class, 'store']);
    Route::put('/', [DashboardController::class, 'update']);
    Route::get('/riwayat-absensi', [AbsensiController::class, 'riwayat'])->name('absensi.riwayat');
});


Route::middleware('auth', 'role:admin')->group(function () {
    
    //MATERI
    Route::post('/materi/create', [App\Http\Controllers\MateriController::class, 'store'])->name('materi.store');
    Route::put('/materi/{materi}', [MateriController::class, 'update'])->name('materi.update');
    Route::delete('/materi/{materi}', [MateriController::class, 'destroy'])->name('materi.delete');
    Route::resource('materi', MateriController::class);

    //KELAS
    Route::put('/kelas/{kelas}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/{kelas}', [KelasController::class, 'destroy'])->name('kelas.delete');
    Route::resource('kelas', KelasController::class);
    
    //ABSENSI
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');

    //USER
    Route::resource('user', UserController::class);
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.delete');

});

Route::middleware('auth', 'role:admin,pj')->group(function () {

    //CODE
    Route::resource('code', CodeController::class);
});
