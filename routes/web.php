<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AturanController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\HimpunanController;
use App\Http\Controllers\VariabelController;
use App\Http\Controllers\DataPertanianController;
use App\Http\Controllers\PerhitunganFuzzyController;

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

    // CRUD DATA PERTANIAN
        Route::get('/admin/pertanian', [DataPertanianController::class, 'v_pertanian'])->name('d_pertanian_admin');
        Route::post('/admin/perbarui-pertanian', [DataPertanianController::class, 'editPertanian'])->name('perbarui_pertanian');

    // CRUD DATA PREDIKSI
        Route::get('/admin/prediksi', [DataPertanianController::class, 'v_prediksi'])->name('d_prediksi_admin');
        Route::post('/admin/tambah-prediksi', [DataPertanianController::class, 'tambahPrediksi'])->name('tambah_prediksi');
        Route::post('/admin/perbarui-prediksi', [DataPertanianController::class, 'updatePrediksi'])->name('perbarui_prediksi');
        Route::delete('/admin/hapus-prediksi', [DataPertanianController::class, 'deletePrediksi'])->name('hapus_prediksi');
        Route::post('/admin/hitung-prediksi', [PerhitunganFuzzyController::class, 'calculateFuzzy'])->name('hitung_prediksi');

    // DATA AKURASI FUZZY
        Route::get('/admin/akurasi-fuzzy', [AdminController::class, 'v_akurasi_fuzzy'])->name('d_akurasi_fuzzy_admin');

    // DATA FUZZY TSUKAMOTO
    // DATA VARIABEL
        Route::get('/admin/data-variabel', [VariabelController::class, 'index'])->name('f_variabel_fuzzy');
        Route::post('/admin/data-variabel/pagination-data', [VariabelController::class, 'pagination'])->name('pagination_data_variabel');
        Route::post('/admin/data-variabel/tambah-variabel', [VariabelController::class, 'addVariabel'])->name('tambah_variabel');
        Route::post('/admin/data-variabel/perbarui-variabel', [VariabelController::class, 'updateVariabel'])->name('perbarui_variabel');
        Route::delete('/admin/data-variabel/hapus-variabel', [VariabelController::class, 'deleteVariabel'])->name('hapus_variabel');

    // DATA HIMPUNAN
        Route::get('/admin/data-himpunan', [HimpunanController::class, 'index'])->name('f_himpunan_fuzzy');
        Route::post('/admin/data-himpunan/tambah-keputusan', [HimpunanController::class, 'addKeputusan'])->name('tambah_keputusan');
        Route::post('/admin/data-himpunan/perbarui-keputusan', [HimpunanController::class, 'perbaruiKeputusan'])->name('perbarui_keputusan');
        Route::delete('/admin/data-himpunan/hapus-keputusan', [HimpunanController::class, 'deleteKeputusan'])->name('hapus_keputusan');
        Route::post('/admin/data-himpunan/tambah-himpunan', [HimpunanController::class, 'addHimpunan'])->name('tambah_himpunan');
        Route::post('/admin/data-himpunan/perbarui-himpunan', [HimpunanController::class, 'perbaruiHimpunan'])->name('perbarui_himpunan');
        Route::delete('/admin/data-himpunan/hapus-himpunan', [HimpunanController::class, 'deleteHimpunan'])->name('hapus_himpunan');

    // DATA ATURAN
        Route::get('/admin/data-aturan', [AturanController::class, 'index'])->name('f_aturan_fuzzy');
        Route::post('/admin/data-aturan/tambah-aturan', [AturanController::class, 'tambahAturan'])->name('tambah_aturan');
        Route::post('/admin/data-aturan/perbarui-aturan', [AturanController::class, 'perbaruiAturan'])->name('perbarui_aturan');
        Route::delete('/admin/data-aturan/hapus-aturan', [AturanController::class, 'hapusAturan'])->name('hapus_aturan');

    // CRUD DATA ANGGOTA
        Route::get('/admin/data-user', [UserController::class, 'indexAnggota'])->name('get-anggota');
        Route::post('/admin/data-user', [UserController::class, 'addUser'])->name('add-anggota');
        Route::post('/admin/update-user/{id}', [UserController::class, 'updateUser'])->name('update-anggota');
        Route::get('/admin/delete-user/{id}', [UserController::class, 'deleteUser'])->name('delete-anggota');
        Route::get('/admin/data-user/cari-data', [UserController::class, 'cariData'])->name('cariData');

    //DATA PROFILE
        Route::get('/admin/profile', [AdminController::class, 'v_profile'])->name('profil_admin');
        Route::post('/admin/profile/perbarui-profile', [UserController::class, 'updateProfile'])->name('update_profile_admin');
        Route::post('admin/profile/perbarui-password', [UserController::class, 'ubahPassword'])->name('update_password_admin');
});

//Route Untuk Anggota
Route::middleware(['auth', 'check-role:anggota'])->group(function(){
    Route::get('/anggota/dashboard', [AnggotaController::class, 'indexAnggota'])->name('dashboard-anggota');
    Route::get('/anggota/pertanian', [AnggotaController::class, 'v_pertanian'])->name('pertanian-anggota');
    Route::post('/anggota/perbarui-pertanian', [DataPertanianController::class, 'editPertanian'])->name('perbarui_pertanian_anggota');

    // CRUD DATA PREDIKSI
        Route::get('/anggota/prediksi', [AnggotaController::class, 'v_prediksi'])->name('prediksi-anggota');
        Route::post('/anggota/tambah-prediksi', [DataPertanianController::class, 'tambahPrediksi'])->name('tambah_prediksi_anggota');
        Route::post('/anggota/perbarui-prediksi', [DataPertanianController::class, 'updatePrediksi'])->name('perbarui_prediksi_anggota');
        Route::delete('/anggota/hapus-prediksi', [DataPertanianController::class, 'deletePrediksi'])->name('hapus_prediksi_anggota');
        Route::post('/anggota/hitung-prediksi', [PerhitunganFuzzyController::class, 'calculateFuzzyAnggota'])->name('hitung_prediks_anggota');

    //Akurasi Fuzzy Tsukamoto
        Route::get('/anggota/akurasi-fuzzy', [AnggotaController::class, 'v_akurasi_fuzzy'])->name('d_akurasi_fuzzy_anggota');

    // DATA PROFILE
        Route::get('/anggota/profile', [AnggotaController::class, 'v_profile'])->name('profile-anggota');
        Route::post('/admin/profile/perbarui-profile', [UserController::class, 'updateProfile'])->name('update_profile_anggota');
        Route::post('admin/profile/perbarui-password', [UserController::class, 'ubahPassword'])->name('update_password_anggota');
});





