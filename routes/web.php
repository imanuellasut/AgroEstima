<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\UserController;

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
    return view('auth.login');
});

Auth::routes();


//Route Untuk Admin
Route::middleware(['auth', 'check-role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard-admin');
    Route::get('/admin/pertanian', [AdminController::class, 'v_pertanian'])->name('pertanian-admin');

    // CRUD DATA PREDIKSI
    Route::get('/admin/prediksi', [AdminController::class, 'v_prediksi'])->name('prediksi-admin');

    // CRUD DATA KRITERIA
    Route::get('/admin/kriteria', [AdminController::class, 'v_kriteria'])->name('kriteria-admin');

    // CRUD DATA ANGGOTA
    Route::get('/admin/data-user', [AdminController::class, 'v_dataUser'])->name('data-user-admin');
    Route::post('/admin/data-user', [UserController::class, 'store'])->name('add-anggota');

    //DATA PROFILE
    Route::get('/admin/profile', [AdminController::class, 'v_profile'])->name('profile-admin');
});

//Route Untuk Anggota
Route::middleware(['auth', 'check-role:anggota'])->group(function(){
    Route::get('/anggota/dashboard', [AnggotaController::class, 'index'])->name('dashboard-anggota');
    Route::get('/anggota/pertanian', [AnggotaController::class, 'v_pertanian'])->name('pertanian-anggota');

    // CRUD DATA PREDIKSI
    Route::get('/anggota/prediksi', [AnggotaController::class, 'v_prediksi'])->name('prediksi-anggota');

    // DATA PROFILE
    Route::get('/anggota/profile', [AnggotaController::class, 'v_profile'])->name('profile-anggota');
});





