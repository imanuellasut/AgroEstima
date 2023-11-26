<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Variabel_Himpunan;
use App\Models\Fuzzy_Aturan;
use App\Models\FuzzyHimpunan;
use App\Models\Fuzzy_Keputusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function v_akurasi_fuzzy() {
        return view('admin.d_akurasi_fuzzy');
    }

    public function f_aturan() {

        $variabel = Variabel_Himpunan::with('himpunan')->get();
        $keputusan = Fuzzy_Keputusan::all();

        $results = FuzzyHimpunan::select('fuzzy_aturan.kode_aturan', 'variabel_himpunan.nama as nama_variabel', 'fuzzy_himpunan.nama as nama_himpunan', 'fuzzy_keputusan.nama_keputusan as nama_keputusan')
            ->join('variabel_himpunan', 'fuzzy_himpunan.id_variabel', '=', 'variabel_himpunan.id')
            ->join('fuzzy_aturan', 'fuzzy_himpunan.id', '=', 'fuzzy_aturan.id_himpunan')
            ->join('fuzzy_keputusan', 'fuzzy_aturan.id_keputusan', '=', 'fuzzy_keputusan.id_keputusan')
            ->get();
        // dd($results);

        $aturan_tabel = array();
        foreach ($results as $a) {
            if (!isset($aturan_tabel[$a->kode_aturan])) {
                $aturan_tabel[$a->kode_aturan] = array(
                    'aturan' => array(),
                    'keputusan' => $a->nama_keputusan
                );
            }
            array_push($aturan_tabel[$a->kode_aturan]['aturan'], $a->nama_variabel . ' = ' . $a->nama_himpunan);
        }

        return view('admin.fuzzy_aturan', ['aturan_tabel' => $aturan_tabel], compact('variabel', 'keputusan'));
    }

    public function v_profile() {
        return view('admin.profile');
    }

    public function v_editProfile() {
        return view('admin.profile-edit');
    }
}
