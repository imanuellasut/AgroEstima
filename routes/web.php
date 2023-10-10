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
    Route::get('/admin/pertanian', [AdminController::class, 'v_pertanian'])->name('d_pertanian_admin');

    // CRUD DATA PREDIKSI
    Route::get('/admin/prediksi', [AdminController::class, 'v_prediksi'])->name('d_prediksi_admin');

    // DATA AKURASI FUZZY
    Route::get('/admin/akurasi-fuzzy', [AdminController::class, 'v_akurasi_fuzzy'])->name('d_aturan_fuzzy_admin');

    // DATA FUZZY TSUKAMOTO
    Route::get('/admin/data-variabel', [AdminController::class, 'f_variabel'])->name('f_variabel_fuzzy');
    Route::get('/admin/data-himpunan', [AdminController::class, 'f_himmpunan'])->name('f_himpunan_fuzzy');
    Route::get('/admin/data-aturan', [AdminController::class, 'f_aturan'])->name('f_aturan_fuzzy');

    // CRUD DATA ANGGOTA
    Route::get('/admin/data-user', [UserController::class, 'indexAnggota'])->name('get-anggota');
    Route::post('/admin/data-user', [UserController::class, 'store'])->name('add-anggota');
    // Route::get('/admin/{id}/Edit', [UserController::class, 'edit'])->name('edit-anggota');
    Route::put('/admin/update-data-user/{id}', [UserController::class, 'update'])->name('update-anggota');

    //DATA PROFILE
    Route::get('/admin/profile', [AdminController::class, 'v_profile'])->name('profil_admin');
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





