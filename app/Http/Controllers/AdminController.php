<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Variabel_Himpunan;
use Illuminate\Http\Request;
use App\Models\FuzzyHimpunan;

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
        $dataVariabel = Variabel_Himpunan::all();
        return view('admin.d_pertanian', compact('dataVariabel'));
    }

    public function v_prediksi() {
        return view('admin.d_prediksi');
    }

    public function v_akurasi_fuzzy() {
        return view('admin.d_akurasi_fuzzy');
    }


    public function f_himmpunan() {
        $dataHimpunan = FuzzyHimpunan::all();
        $dataVariabel = Variabel_Himpunan::all();
        return view('admin.fuzzy_himpunan', compact('dataVariabel', 'dataHimpunan'));
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
