<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Variabel_Himpunan;
use App\Models\Fuzzy_Aturan;
use App\Models\FuzzyHimpunan;
use App\Models\Fuzzy_Keputusan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AturanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // $variabel = Variabel_Himpunan::with('himpunan')->get();
        $variabel = Variabel_Himpunan::all();
        $himpunan = FuzzyHimpunan::all();
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

        return view('admin.fuzzy_aturan', ['aturan_tabel' => $aturan_tabel], compact('variabel', 'himpunan', 'keputusan'));
    }

    public function tambahAturan(Request $request) {
        $aturan = $request->get('himpunan');
        $id_keputusan = $request->get('id_keputusan');

        $kode_aturan = 'R';

        $totalAturan = Fuzzy_Aturan::count();
        $jumlahKode = Fuzzy_Aturan::where('kode_aturan', 'like', 'R1%')->count();

        // Untuk Membuat Kode Aturan Baru
        if ($jumlahKode == 0) {
            $kode_aturan .= '1';
        } else {
            $kode_aturan .= ceil(($totalAturan + 1 ) / $jumlahKode);
        }

        foreach ($aturan as $id_himpunan) {
            Fuzzy_Aturan::create([
                'id_himpunan' => $id_himpunan,
                'id_keputusan' => $id_keputusan,
                'kode_aturan' => $kode_aturan,
            ]);
        }

        // dd($aturan, $id_keputusan, $kode_aturan);

        return redirect()->route('f_aturan_fuzzy')->with('success', 'Data Aturan Berhasil Ditambahkan');
    }
}
