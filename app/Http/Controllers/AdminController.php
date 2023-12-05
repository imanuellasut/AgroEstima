<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Variabel_Himpunan;
use App\Models\Fuzzy_Aturan;
use App\Models\FuzzyHimpunan;
use App\Models\Fuzzy_Keputusan;
use App\Models\Fuzzy_Hasil;
use App\Models\Data_Pertanian;
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
        $totalTanam = Fuzzy_Hasil::count();
        // $totalPanen = Fuzzy_Hasil::get();;
        // Hitung TotalPanen Dari Fuzzy_Hasil
        $JmlPanen = Fuzzy_Hasil::sum('jml_produksi');
        $JmlPrediksi = Fuzzy_Hasil::sum('jml_prediksi');
        $totalPanen = round($JmlPanen, 2);
        $totalPrediksi = round($JmlPrediksi, 2);


        //--------------MAPE (Mean Absolute Percentage Error)----------------//
        $dataHasil = Fuzzy_Hasil::get();
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
        $results = DB::select(
            DB::raw("
            SELECT data_pertanian.kode_pertanian,
                    GROUP_CONCAT(DISTINCT data_pertanian.tgl_tanam ORDER BY data_pertanian.tgl_tanam) as tgl_tanam,
                    GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_produksi) as jml_produksi,
                    GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_prediksi) as jml_prediksi
                FROM
                    data_pertanian
                JOIN
                    hasil_fuzzy ON hasil_fuzzy.kode_pertanian = data_pertanian.kode_pertanian
                GROUP BY
                    data_pertanian.kode_pertanian
            "));

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

        return view('admin.dashboard', ['totalTanam' => $totalTanam, 'totalPanen' => $totalPanen,
        'totalPrediksi' => $totalPrediksi, 'akurasiPrediksi' => $akurasiPrediksi,
        'Produksi' => $Produksi, 'Prediksi' => $Prediksi], compact('adataUsers'));
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
        ->groupBy('data_pertanian.kode_pertanian')
        ->get();

        //--------------MAPE (Mean Absolute Percentage Error)----------------//
        $dataHasil = Fuzzy_Hasil::get();
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


        return view('admin.d_akurasi_fuzzy', ['akurasiPrediksi' => $akurasiPrediksi], compact('dataVariabel', 'dataPertanian', 'dataP'));
    }

    public function f_aturan() {

        $variabel = Variabel_Himpunan::with('himpunan')->get();
        $keputusan = Fuzzy_Keputusan::all();

        $results = FuzzyHimpunan::select('fuzzy_aturan.kode_aturan', 'variabel_himpunan.nama as nama_variabel',
                        'fuzzy_himpunan.nama as nama_himpunan', 'fuzzy_keputusan.nama_keputusan as nama_keputusan')
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
