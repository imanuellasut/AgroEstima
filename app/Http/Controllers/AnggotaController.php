<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Fuzzy_Hasil;
use App\Models\Hasil_Fuzzy;
use App\Models\Fuzzy_Aturan;
use App\Models\Data_Pertanian;
use App\Models\Fuzzy_Himpunan;
use App\Models\Fuzzy_Keputusan;
use App\Models\Variabel_Himpunan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    public function indexAnggota(){

        //-----------------Menghitung Total Penanaman Anggota-----------------//
        $adataUsers = User::all();
        $totalTanam = Fuzzy_Hasil::join('data_pertanian', 'data_pertanian.kode_pertanian', '=', 'hasil_fuzzy.kode_pertanian')
        ->select(DB::raw('data_pertanian.kode_pertanian,
                GROUP_CONCAT(DISTINCT data_pertanian.tgl_tanam) as tgl_tanam,
                GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_produksi) as jml_produksi,
                GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_prediksi) as jml_prediksi'))
        ->where('data_pertanian.id_user', Auth::user()->id)
        ->groupBy('data_pertanian.kode_pertanian')
        ->get()
        ->count();

        // --------------Hitung TotalPanen Dari Setiap Anggota----------------///

        $dataPanen = Fuzzy_Hasil::join('data_pertanian', 'data_pertanian.kode_pertanian', '=', 'hasil_fuzzy.kode_pertanian')
        ->select(DB::raw('data_pertanian.kode_pertanian,
                GROUP_CONCAT(DISTINCT data_pertanian.tgl_tanam) as tgl_tanam,
                GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_produksi) as jml_produksi,
                GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_prediksi) as jml_prediksi'))
        ->where('data_pertanian.id_user', Auth::user()->id)
        ->groupBy('data_pertanian.kode_pertanian')
        ->get();

        $JmlPanen = 0;
        $JmlPrediksi = 0;
        foreach ($dataPanen as $key => $value) {
            $JmlPanen += $value->jml_produksi;
            $JmlPrediksi += $value->jml_prediksi;
        }

        $totalPanen = round($JmlPanen, 2);
        $totalPrediksi = round($JmlPrediksi, 2);

         //--------------MAPE (Mean Absolute Percentage Error)----------------//
        $dataHasil = Fuzzy_Hasil::join('data_pertanian', 'data_pertanian.kode_pertanian', '=', 'hasil_fuzzy.kode_pertanian')
        ->select(DB::raw('data_pertanian.kode_pertanian,
                GROUP_CONCAT(DISTINCT data_pertanian.tgl_tanam) as tgl_tanam,
                GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_produksi) as jml_produksi,
                GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_prediksi) as jml_prediksi'))
        ->where('data_pertanian.id_user', Auth::user()->id)
        ->groupBy('data_pertanian.kode_pertanian')
        ->get();

        $Produksi = array();
        $Prediksi = array();
        foreach ($dataHasil as $key => $value) {
            $Produksi[$key] = $value->jml_produksi;
            $Prediksi[$key] = $value->jml_prediksi;
        }

        $n = count($Produksi);
        $mape = 0;

        for($i = 0; $i < $n; $i++){
            if ($Produksi[$i] != 0) {
                $mape += abs(($Produksi[$i] - $Prediksi[$i]) / $Produksi[$i]);
            }
        }

        if ($n != 0) {
            $hasilMape = ($mape / $n) * 100;
        } else {
            $hasilMape = 0;
        }

        $akurasiPrediksi = round($hasilMape, 2);

        //-----------MemBuat Chart Perbandingan Produksi dan Prediksi----------------//
        $results = Data_Pertanian::join('hasil_fuzzy', 'hasil_fuzzy.kode_pertanian', '=', 'data_pertanian.kode_pertanian')
        ->select(DB::raw('data_pertanian.kode_pertanian,
                GROUP_CONCAT(DISTINCT data_pertanian.tgl_tanam ORDER BY data_pertanian.tgl_tanam) as tgl_tanam,
                GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_produksi) as jml_produksi,
                GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_prediksi) as jml_prediksi'))
        ->where('data_pertanian.id_user', Auth::user()->id)
        ->groupBy('data_pertanian.kode_pertanian')
        ->get();

        $tahun = array();
        $Produksi = array();
        $Prediksi = array();
        foreach ($results as $result) {
            $tahunT = date('Y', strtotime($result->tgl_tanam));
            if (!isset($tahun[$tahunT])) {
                $tahun[$tahunT] = $tahunT;
                $Produksi[$tahunT] = 0;
                $Prediksi[$tahunT] = 0;
            }
            $Produksi[$tahunT] += $result->jml_produksi;
            $Prediksi[$tahunT] += $result->jml_prediksi;
        }

        return view('anggota.dashboard', ['totalTanam' => $totalTanam, 'totalPanen' => $totalPanen,
        'totalPrediksi' => $totalPrediksi, 'akurasiPrediksi' => $akurasiPrediksi,
        'Produksi' => $Produksi, 'Prediksi' => $Prediksi], compact('adataUsers'));
    }

    public function v_pertanian() {
        $dataVariabel = Variabel_Himpunan::all();
        $dataPertanian = Data_Pertanian::all();

        $dataP = DB::table('data_pertanian')
        ->join('users', 'users.id', '=', 'data_pertanian.id_user')
        ->join('variabel_himpunan', 'variabel_himpunan.id', '=', 'data_pertanian.id_variabel')
        ->join('hasil_fuzzy', 'hasil_fuzzy.kode_pertanian', '=', 'data_pertanian.kode_pertanian')
        ->select(DB::raw('data_pertanian.kode_pertanian,
                GROUP_CONCAT(DISTINCT users.name) as nama_anggota,
                GROUP_CONCAT(variabel_himpunan.nama) as nama_variabel,
                GROUP_CONCAT(data_pertanian.id_variabel) as id_variabel,
                GROUP_CONCAT(data_pertanian.nilai) as nilai,
                GROUP_CONCAT(DISTINCT data_pertanian.tgl_tanam) as tgl_tanam,
                GROUP_CONCAT(DISTINCT COALESCE(data_pertanian.tgl_panen, "-")) as tgl_panen,
                GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_produksi) as jml_produksi,
                GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_prediksi) as jml_prediksi'))
        ->where('users.id', Auth::user()->id)
        ->groupBy('data_pertanian.kode_pertanian')
        ->get();

        return view('anggota.pertanian', compact('dataVariabel', 'dataPertanian', 'dataP'));
    }

    public function v_prediksi() {
        $variabels = Variabel_Himpunan::all();
        $dataPertanian = Data_Pertanian::join('users', 'users.id', '=', 'data_pertanian.id_user')
            ->join('variabel_himpunan', 'variabel_himpunan.id', '=', 'data_pertanian.id_variabel')
            ->join('hasil_fuzzy', 'hasil_fuzzy.kode_pertanian', '=', 'data_pertanian.kode_pertanian')
            ->select('data_pertanian.kode_pertanian',
                    DB::raw('GROUP_CONCAT(variabel_himpunan.id ORDER BY data_pertanian.id_variabel) as id_variabel'),
                    DB::raw('GROUP_CONCAT(DISTINCT users.name) as nama_anggota'),
                    DB::raw('GROUP_CONCAT(variabel_himpunan.nama ORDER BY data_pertanian.id_variabel) as nama_variabel'),
                    DB::raw('GROUP_CONCAT(data_pertanian.id_variabel) as id_variabel'),
                    DB::raw('GROUP_CONCAT(data_pertanian.nilai) as nilai_inputan'),
                    DB::raw('GROUP_CONCAT(DISTINCT data_pertanian.tgl_tanam) as tgl_tanam'),
                    DB::raw('GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_prediksi) as jml_prediksi'))
            ->where('users.id', Auth::user()->id)
            ->groupBy('data_pertanian.kode_pertanian')
            ->get();

            // dd($dataPertanian);

        return view('anggota.prediksi', compact('dataPertanian', 'variabels'));
    }

    public function v_akurasi_fuzzy() {
        $dataVariabel = Variabel_Himpunan::all();
        $dataPertanian = Data_Pertanian::all();

        $dataP = DB::table('data_pertanian')
            ->join('users', 'users.id', '=', 'data_pertanian.id_user')
            ->join('variabel_himpunan', 'variabel_himpunan.id', '=', 'data_pertanian.id_variabel')
            ->join('hasil_fuzzy', 'hasil_fuzzy.kode_pertanian', '=', 'data_pertanian.kode_pertanian')
            ->select(DB::raw('data_pertanian.kode_pertanian,
                GROUP_CONCAT(DISTINCT users.name) as nama_anggota,
                GROUP_CONCAT(variabel_himpunan.nama) as nama_variabel,
                GROUP_CONCAT(data_pertanian.nilai) as nilai,
                GROUP_CONCAT(DISTINCT data_pertanian.tgl_tanam) as tgl_tanam,
                GROUP_CONCAT(DISTINCT COALESCE(data_pertanian.tgl_panen, "-")) as tgl_panen,
                GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_produksi) as jml_produksi,
                GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_prediksi) as jml_prediksi'))
            ->where('data_pertanian.id_user',  Auth::user()->id)
            ->groupBy('data_pertanian.kode_pertanian')
            ->get();

        //--------------MAPE (Mean Absolute Percentage Error)----------------//
        // $dataHasil = Fuzzy_Hasil::get();
        $dataHasil = Fuzzy_Hasil::join('data_pertanian', 'data_pertanian.kode_pertanian', '=', 'hasil_fuzzy.kode_pertanian')
        ->where('data_pertanian.id_user', Auth::user()->id)
        ->get();

        $Produksi = array();
        $Prediksi = array();
        foreach ($dataHasil as $key => $value) {
            $Produksi[$key] = $value->jml_produksi;
            $Prediksi[$key] = $value->jml_prediksi;
        }

        $n = count($Produksi);
        $mape = 0;

        for($i = 0; $i < $n; $i++){
            if ($Produksi[$i] != 0) {
                $mape += abs(($Produksi[$i] - $Prediksi[$i]) / $Produksi[$i]);
            }
        }

        if ($n != 0) {
            $hasilMape = ($mape / $n) * 100;
        } else {
            $hasilMape = 0;
        }

        $akurasiPrediksi = round($hasilMape, 2);


        return view('anggota.akurasi', ['akurasiPrediksi' => $akurasiPrediksi], compact('dataVariabel', 'dataPertanian', 'dataP'));
    }

    public function v_profile(){
        return view('anggota.profile');
    }

}
