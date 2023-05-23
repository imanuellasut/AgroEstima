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
        return view('admin.pertanian');
    }

    public function v_prediksi() {
        return view('admin.prediksi');
    }

    public function v_kriteria() {
        return view('admin.kriteria');
    }

    public function v_dataUser() {
        $adataUsers = User::all();
        return view('admin.data-users', compact('adataUsers'));
    }

    public function v_profile() {
        return view('admin.profile');
    }
}
