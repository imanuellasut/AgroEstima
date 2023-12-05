<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use App\Models\Data_Pertanian;
use App\Models\User;
use App\Models\Fuzzy_Hasil;
use App\Models\Fuzzy_Himpunan;
use App\Models\Variabel_Himpunan;
use Illuminate\Support\Facades\DB;

class DataPertanianController extends Controller
{
    public function v_pertanian(Request $request) {
        $dataVariabel = Variabel_Himpunan::all();
        $dataPertanian = Data_Pertanian::all();

        if ($request->has('perPage')) {
            session(['perPage' => $request->get('perPage')]);
        }

         // 'perPage' default
        $perPage = session('perPage', 10);

        $dataP = DB::table('data_pertanian')
        ->join('users', 'users.id', '=', 'data_pertanian.id_user')
        ->join('variabel_himpunan', 'variabel_himpunan.id', '=', 'data_pertanian.id_variabel')
        ->join('hasil_fuzzy', 'hasil_fuzzy.kode_pertanian', '=', 'data_pertanian.kode_pertanian')
        ->select(DB::raw('data_pertanian.kode_pertanian,
                        GROUP_CONCAT(DISTINCT users.name) as nama_anggota,
                        GROUP_CONCAT(data_pertanian.id_variabel) as id_variabel,
                        GROUP_CONCAT(variabel_himpunan.nama) as nama_variabel,
                        GROUP_CONCAT(data_pertanian.nilai) as nilai,
                        GROUP_CONCAT(DISTINCT data_pertanian.tgl_tanam) as tgl_tanam,
                        GROUP_CONCAT(DISTINCT COALESCE(data_pertanian.tgl_panen, "-")) as tgl_panen,
                        GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_produksi) as jml_produksi,
                        GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_prediksi) as jml_prediksi'))
        ->groupBy('data_pertanian.kode_pertanian')
        ->orderBy('data_pertanian.created_at', 'desc')
        ->paginate($perPage);
        // dd($dataP);
        return view('admin.d_pertanian', ['perPage' => $perPage],  compact('dataVariabel', 'dataPertanian', 'dataP'));
    }

    //edit data pertanian
    public function editPertanian(Request $request) {
        $request->validate(
            [
                'tgl_panen' => 'required|date',
            ],
            [
                'tgl_panen.required' => 'Tanggal Tanam tidak boleh kosong',
            ]
        );

        $kode_pertanian = $request->input('kode_pertanian');
        $tgl_panen = $request->input('tgl_panen');
        $jml_produksi = $request->input('jml_produksi');

        //-----------------------Update data pertanian dan hasil fuzzy-----------------------//
        Fuzzy_Hasil::where('kode_pertanian', $kode_pertanian)
            ->update([
                'jml_produksi' => $jml_produksi,
            ]);

        Data_Pertanian::where('kode_pertanian', $kode_pertanian)
            ->update([
                'tgl_panen' => $tgl_panen,
            ]);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function v_prediksi(Request $request) {
        $variabels = Variabel_Himpunan::all();
        $tahun_tanam = request()->get('tahun_tanam');
        if ($tahun_tanam == '') {
            $request->session()->forget('tahun_tanam');
        } else {
            $request->session()->put('tahun_tanam', $tahun_tanam);
        }
         // 'perPage' default
        $perPage = session('perPage', 10);
        if ($request->has('perPage')) {
            session(['perPage' => $request->get('perPage')]);
        }

        $dataPertanian = Data_Pertanian::join('users', 'users.id', '=', 'data_pertanian.id_user')
        ->join('variabel_himpunan', 'variabel_himpunan.id', '=', 'data_pertanian.id_variabel')
        ->join('hasil_fuzzy', 'hasil_fuzzy.kode_pertanian', '=', 'data_pertanian.kode_pertanian')
        ->select('data_pertanian.kode_pertanian',
                DB::raw('GROUP_CONCAT(DISTINCT users.name) as nama_anggota'),
                DB::raw('GROUP_CONCAT(variabel_himpunan.nama ORDER BY data_pertanian.id_variabel) as nama_variabel'),
                DB::raw('GROUP_CONCAT(data_pertanian.id_variabel) as id_variabel'),
                DB::raw('GROUP_CONCAT(data_pertanian.nilai) as nilai_inputan'),
                DB::raw('GROUP_CONCAT(DISTINCT data_pertanian.tgl_tanam) as tgl_tanam'),
                DB::raw('GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_prediksi) as jml_prediksi'))
        ->groupBy('data_pertanian.kode_pertanian')
        ->when($tahun_tanam, function ($query, $tahun_tanam) {
            return $query->whereYear('data_pertanian.tgl_tanam', $tahun_tanam);
        })
        ->orderBy('data_pertanian.created_at', 'desc')
        ->paginate($perPage)->appends(request()->except('page'));

        // dd($dataPertanian);

        return view('admin.d_prediksi', ['perPage' => $perPage, 'tahun_tanam' => $tahun_tanam], compact('dataPertanian', 'variabels'));
    }

    //-----------------------Tambah Data Pertanian dan Hasil Fuzzy-----------------------//
    public function tambahPrediksi(Request $request) {
        $request->validate(
            [
                'tgl_tanam' => 'required|date',
            ],
            [
                'tgl_tanam.required' => 'Tanggal Tanam tidak boleh kosong',
            ]
        );

        $id_user = $request->input('id_user');
        $user = User::find($id_user);
        $firstName = strtoupper($user->name);
        $nameUser = substr($firstName, 0, 3);

        $tgl_tanam = $request->input('tgl_tanam');

        //-------------Proses Pembuatan Kode Pertanian-----------//
        $kode_awal = "DP-" .$nameUser ."-";
        $totalvariabel = Variabel_Himpunan::count();
        $dataUser = Data_Pertanian::where('id_user', $id_user)->count();

        $pengurutan = $dataUser/$totalvariabel;

        if ($dataUser == 0) {
            $kode_pertanian = "DP-" .$nameUser ."-". "1";
        } else {
            $kode_pertanian = "DP-".$nameUser."-".($pengurutan + 1);
        }

        //Proses Simpan Data Pertanian
        $variabels = Variabel_Himpunan::all();
        foreach ($variabels as $variabel) {
            $request->validate(
                [
                    'nilai_'. $variabel->id => 'required',
                ],
                [
                    'nilai_'.$variabel->id.'.required' => 'Nilai tidak boleh kosong',
                ]
            );

            $id_variabel = $request->input('id_variabel_' . $variabel->id);
            $nilai = $request->input('nilai_'. $variabel->id);

            // Simpan nilai variabel ke database
            Data_Pertanian::create([
                'id_user' => $id_user,
                'id_variabel' => $id_variabel,
                'kode_pertanian' => $kode_pertanian,
                'nilai' => $nilai,
                'tgl_tanam' => $tgl_tanam,
                'tgl_panen' => null,
            ]);
        }

        //Proses Simpan Data Hasil Fuzzy
        Fuzzy_Hasil::create([
            'kode_pertanian' => $kode_pertanian,
            'jml_produksi' => null,
            'jml_prediksi' => null,
        ]);

        return response()->json([
            'status' => 'success',
        ]);
    }

    //-----------------------Update Data Pertanian dan Hasil Fuzzy-----------------------//
    public function updatePrediksi(Request $request){
        $request->validate(
            [
                'tgl_tanam' => 'required|date',
            ],
            [
                'tgl_tanam.required' => 'Tanggal Tanam tidak boleh kosong',
            ]
            );

        $kode_pertanian = $request->input('kode_pertanian');
        $id_user = $request->input('id_user');
        $tgl_tanam = $request->input('tgl_tanam');

        //Proses Update Data Pertanian
        $variabels = Variabel_Himpunan::all();
        foreach ($variabels as $variabel) {
            $request->validate(
                [
                    'nilai_'. $variabel->id => 'required',
                ],
                [
                    'nilai_'.$variabel->id.'.required' => 'Nilai tidak boleh kosong',
                ]
            );

            $id_variabel = $request->input('id_variabel_' . $variabel->id);
            $nilai = $request->input('nilai_'. $variabel->id);

            // Update nilai variabel ke database
            $dataPertanian = Data_Pertanian::where('kode_pertanian', $kode_pertanian)->where('id_variabel', $id_variabel);
            $dataPertanian->update([
                'nilai' => $nilai,
                'tgl_tanam' => $tgl_tanam,
            ]);
        }

        $fuzzyHasil = Fuzzy_Hasil::where('kode_pertanian', $kode_pertanian)->first();
        $fuzzyHasil->update([
            'jml_produksi' => null,
            'jml_prediksi' => null,
        ]);

        return response()->json([
            'status' => 'success',
        ]);
    }


    //-----------------------Delete Data Pertanian dan Hasil Fuzzy-----------------------//
    public function deletePrediksi(Request $request) {
        $kode_pertanian = $request->input('kode_pertanian');

        //Menghapus data pertanian
        Data_Pertanian::where('kode_pertanian', $kode_pertanian)->delete();

        //Menghapus data hasil fuzzy
        Fuzzy_Hasil::where('kode_pertanian', $kode_pertanian)->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function calculateFuzzy(Request $request) {
        $kode_pertanian = $request->input('kode_pertanian');

        // Cari data pertanian dengan kode yang sama
        $dataPertanian = Data_Pertanian::where('data_pertanian.kode_pertanian', $kode_pertanian)
            ->join('users', 'users.id', '=', 'data_pertanian.id_user')
            ->join('variabel_himpunan', 'variabel_himpunan.id', '=', 'data_pertanian.id_variabel')
            ->join('hasil_fuzzy', 'hasil_fuzzy.kode_pertanian', '=', 'data_pertanian.kode_pertanian')
            ->select('data_pertanian.kode_pertanian',
                    DB::raw('GROUP_CONCAT(DISTINCT users.name) as nama_anggota'),
                    DB::raw('GROUP_CONCAT(variabel_himpunan.nama) as nama_variabel'),
                    DB::raw('GROUP_CONCAT(data_pertanian.id_variabel) as id_variabel'),
                    DB::raw('GROUP_CONCAT(data_pertanian.nilai) as nilai_inputan'),
                    DB::raw('GROUP_CONCAT(DISTINCT data_pertanian.tgl_tanam) as tgl_tanam'),
                    DB::raw('GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_prediksi) as jml_prediksi'))
            ->groupBy('data_pertanian.kode_pertanian')
            ->first();

        if (!$dataPertanian) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data pertanian tidak ditemukan',
            ], 404);
        }

        // Perhitungan Fuzzy Tsukamoto untuk setiap variabel
        // Implementasi perhitungan tingkat keanggotaan
        $id_variabel = explode(',', $dataPertanian->id_variabel);
        $nilai_inputan = explode(',', $dataPertanian->nilai_inputan);
        $hasil = ['Linier Naik' => [], 'Linier Turun' => []];

        for ($i = 0; $i < count($id_variabel); $i++) {
            $himpunan = Fuzzy_Himpunan::where('id_variabel', $id_variabel[$i])->get();

            foreach ($himpunan as $h) {
                $jenis_kurva = $h->jenis_kurva;
                $nilai_bawah = $h->nilai_bawah;
                $nilai_atas = $h->nilai_atas;
                $nilai = $nilai_inputan[$i];

                if ($jenis_kurva == 'Linier Naik') {
                    if ($nilai <= $nilai_bawah) {
                        $hasil['Linier Naik'][$h->nama] = 0;
                    } else if ($nilai > $nilai_bawah && $nilai < $nilai_atas) {
                        $hasil['Linier Naik'][$h->nama] = ($nilai - $nilai_bawah) / ($nilai_atas - $nilai_bawah);
                    } else if ($nilai >= $nilai_atas) {
                        $hasil['Linier Naik'][$h->nama] = 1;
                    }
                } else if ($jenis_kurva == 'Linier Turun') {
                    if ($nilai <= $nilai_bawah) {
                        $hasil['Linier Turun'][$h->nama] = 1;
                    } else if ($nilai > $nilai_bawah && $nilai < $nilai_atas) {
                        $hasil['Linier Turun'][$h->nama] = ($nilai_atas - $nilai) / ($nilai_atas - $nilai_bawah);
                    } else if ($nilai >= $nilai_atas) {
                        $hasil['Linier Turun'][$h->nama] = 0;
                    }
                }
            }
        }
        // dd($hasil);
        return view('admin.d_akurasi_fuzzy', ['hasil' => $hasil]);
    }
}
