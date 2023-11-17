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
    public function index() {
        $variabel = Variabel_Himpunan::all();
        $himpunan = FuzzyHimpunan::all();
        $keputusan = Fuzzy_Keputusan::all();
        $aturan = Fuzzy_Aturan::with('himpunanFuzzy', 'keputusan')->get();

        $results = FuzzyHimpunan::select('fuzzy_aturan.kode_aturan', 'variabel_himpunan.nama as nama_variabel', 'fuzzy_himpunan.nama as nama_himpunan', 'fuzzy_himpunan.id as id_himpunan' , 'fuzzy_keputusan.nama_keputusan as nama_keputusan', 'fuzzy_keputusan.id_keputusan as id_keputusan')
            ->join('variabel_himpunan', 'fuzzy_himpunan.id_variabel', '=', 'variabel_himpunan.id')
            ->join('fuzzy_aturan', 'fuzzy_himpunan.id', '=', 'fuzzy_aturan.id_himpunan')
            ->join('fuzzy_keputusan', 'fuzzy_aturan.id_keputusan', '=', 'fuzzy_keputusan.id_keputusan')
            ->get();
        // dd($iniAturan);

        $aturan_tabel = array();
        foreach ($results as $a) {
            if (!isset($aturan_tabel[$a->kode_aturan])) {
                $aturan_tabel[$a->kode_aturan] = array(
                    'variabel' => array(),
                    'himpunan' => array(),
                    'id_himpunan' => array(),
                    'aturan' => array(),
                    'keputusan' => $a->nama_keputusan,
                    'id_keputusan' => $a->id_keputusan,
                );
            }
            array_push($aturan_tabel[$a->kode_aturan]['aturan'], $a->nama_variabel . ' = ' . $a->nama_himpunan);
            array_push($aturan_tabel[$a->kode_aturan]['variabel'], $a->nama_variabel);
            array_push($aturan_tabel[$a->kode_aturan]['himpunan'], $a->nama_himpunan);
            array_push($aturan_tabel[$a->kode_aturan]['id_himpunan'], $a->id_himpunan);
        }

        // dd($aturan_tabel);

        return view('admin.fuzzy_aturan', ['aturan_tabel' => $aturan_tabel],  compact('variabel', 'himpunan', 'keputusan'));
    }

    public function tambahAturan(Request $request) {
        //Mengambil data yang di inputkan
        $aturan = $request->get('himpunan');
        $id_keputusan = $request->get('id_keputusan');

        //Menghitung jumlah data aturan
        $totalAturan = Fuzzy_Aturan::count();
        $jumlahKode = Fuzzy_Aturan::where('kode_aturan', 'like', 'R1%')->count();

        // Untuk Membuat Kode Aturan Baru
        $kode_aturan = 'R';
        if ($jumlahKode == 0) {
            $kode_aturan .= '1';
        } else {
            $kode_aturan .= ceil(($totalAturan + 1 ) / $jumlahKode);
        }

        //Menyimpan data aturan
        foreach ($aturan as $id_himpunan) {
            Fuzzy_Aturan::create([
                'id_himpunan' => $id_himpunan,
                'id_keputusan' => $id_keputusan,
                'kode_aturan' => $kode_aturan,
            ]);
        }

        return redirect()->route('f_aturan_fuzzy')->with('success', 'Aturan Fuzzy Berhasil Ditambahkan');
    }

    public function perbaruiAturan(Request $request) {
        //Mengambil data yang di inputkan
        $aturan = $request->get('himpunan');
        $id_keputusan = $request->get('id_keputusan');
        $kode_aturan = $request->up_kode;

        // dd($kode_aturan);

         //Menghapus data aturan
        Fuzzy_Aturan::where('kode_aturan', $kode_aturan)->delete();

         //Menyimpan data aturan yang diubah
        foreach ($aturan as $id_himpunan) {
            Fuzzy_Aturan::create([
                'id_himpunan' => $id_himpunan,
                'id_keputusan' => $id_keputusan,
                'kode_aturan' => $kode_aturan,
            ]);
        }

        return redirect()->route('f_aturan_fuzzy')->with('success', 'Data Aturan Berhasil Diubah');
    }

    public function hapusAturan(Request $request) {
        //Menghapus data aturan
        Fuzzy_Aturan::where('kode_aturan', $request->down_kode)->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
