<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Variabel_Himpunan;
use App\Models\Fuzzy_Aturan;
use App\Models\Fuzzy_Himpunan;
use App\Models\Fuzzy_Keputusan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AturanController extends Controller
{
    public function index() {
        $variabel = Variabel_Himpunan::all();
        $jumlahVariabel = Variabel_Himpunan::count();
        $himpunan = Fuzzy_Himpunan::all();
        $keputusan = Fuzzy_Keputusan::all();
        $aturan = Fuzzy_Aturan::with('himpunanFuzzy', 'keputusan')->get();

        $dataAturan = Fuzzy_Himpunan::join('variabel_himpunan', 'fuzzy_himpunan.id_variabel', '=', 'variabel_himpunan.id')
            ->join('fuzzy_aturan', 'fuzzy_himpunan.id', '=', 'fuzzy_aturan.id_himpunan')
            ->join('fuzzy_keputusan', 'fuzzy_aturan.id_keputusan', '=', 'fuzzy_keputusan.id_keputusan')
            ->select('fuzzy_aturan.kode_aturan',
                DB::raw('GROUP_CONCAT(variabel_himpunan.id ORDER BY fuzzy_aturan.id) as id_variabel'),
                DB::raw('GROUP_CONCAT(variabel_himpunan.nama ORDER BY fuzzy_aturan.id) as nama_variabel'),
                DB::raw('GROUP_CONCAT(fuzzy_himpunan.id ORDER BY fuzzy_aturan.id) as id_himpunan'),
                DB::raw('GROUP_CONCAT(fuzzy_himpunan.nama ORDER BY fuzzy_aturan.id) as nama_himpunan'),
                DB::raw('GROUP_CONCAT(fuzzy_keputusan.nama_keputusan ORDER BY fuzzy_aturan.id) as nama_keputusan'),
                DB::raw('GROUP_CONCAT(fuzzy_keputusan.id_keputusan ORDER BY fuzzy_aturan.id)  as id_keputusan'))
            ->groupBy('fuzzy_aturan.kode_aturan')
            ->get();

        // dd($aturan_tabel);

        return view('admin.fuzzy_aturan', ['jumlahVariabel' => $jumlahVariabel],  compact('dataAturan',  'variabel', 'himpunan', 'keputusan'));
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
