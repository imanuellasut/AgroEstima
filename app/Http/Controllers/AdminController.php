<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $adataUsers = User::all();
        return view('admin.dashboard', compact('adataUsers'));
    }

    public function v_pertanian() {
        return view('admin.d_pertanian');
    }

    public function v_prediksi() {
        return view('admin.d_prediksi');
    }

    public function v_akurasi_fuzzy() {
        return view('admin.d_aturan_fuzzy');
    }

    public function f_variabel() {
        return view('admin.f_data_variabel');
    }

    public function f_himmpunan() {
        return view('admin.f_data_himpunan');
    }

    public function f_aturan() {
        return view('admin.f_data_aturan');
    }

    public function v_profile() {
        return view('admin.profile');
    }

    public function v_editProfile() {
        return view('admin.profile-edit');
    }
}
