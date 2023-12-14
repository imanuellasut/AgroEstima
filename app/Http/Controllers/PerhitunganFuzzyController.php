<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data_Pertanian;
use App\Models\User;
use App\Models\Fuzzy_Hasil;
use App\Models\Fuzzy_Himpunan;
use App\Models\Fuzzy_Keputusan;
use App\Models\Variabel_Himpunan;
use Illuminate\Support\Facades\DB;

class PerhitunganFuzzyController extends Controller {
    //--------------------Prhitungan Fuzzitung Tsukamoto Untuk Anggota-----------------------//
    public function calculateFuzzy(Request $request) {
        $jumlahVariabel = Variabel_Himpunan::count();
        $variabel = Variabel_Himpunan::all();
        $kode_pertanian = $request->input('kode_pertanian');


        //-----------------------Perhitungan Fuzzifikasi-----------------------//
        // Cari data pertanian dengan kode yang sama
        $dataPertanian = $this->getDataPertanian($kode_pertanian);

        if (!$dataPertanian) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data pertanian tidak ditemukan',
            ], 404);
        }

        // Perhitungan Fuzzy Tsukamoto untuk setiap variabel
        // Implementasi perhitungan tingkat keanggotaan
        $hasilFuzzifikasi = $this->fuzzifikasi($dataPertanian);

        //-----------------------Perhitungan Inferennsi Fuzzy Tsukamoto-----------------------//
        // Ambil semua aturan fuzzy
        $aturanFuzzy = $this->getAturanFuzzy();
        // Lakukan inferensi
        $hasilInferensi = $this->inferensi($aturanFuzzy, $hasilFuzzifikasi);
         // Lakukan defuzzifikasi
        $hasilDefuzzifikasi = $this->defuzzifikasi($hasilInferensi, $aturanFuzzy);

        // dd($hasilDefuzzifikasi['prediksi']);

        //-----------------------Simpan hasil defuzzifikasi ke Database-----------------------//
        $fuzzyHasil = Fuzzy_Hasil::where('kode_pertanian', $kode_pertanian);
        $fuzzyHasil->update([
            'jml_prediksi' => $hasilDefuzzifikasi['prediksi'],
        ]);

        return view('admin.modal_prediksi.hasil_prediksi', ['hasil' => $hasilFuzzifikasi, 'dataInferensi' => $hasilInferensi, 'jumlahVariabel' => $jumlahVariabel, 'hasilDefuzzifikasi' => $hasilDefuzzifikasi['hasilDefuzzifikasi'], 'prediksi' => $hasilDefuzzifikasi['prediksi']], compact('variabel'));
    }


    //--------------------Prhitungan Fuzzitung Tsukamoto Untuk Anggota-----------------------//
    public function calculateFuzzyAnggota(Request $request) {
        $jumlahVariabel = Variabel_Himpunan::count();
        $variabel = Variabel_Himpunan::all();
        $kode_pertanian = $request->input('kode_pertanian');


        //-----------------------Perhitungan Fuzzifikasi-----------------------//
        // Cari data pertanian dengan kode yang sama
        $dataPertanian = $this->getDataPertanian($kode_pertanian);

        if (!$dataPertanian) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data pertanian tidak ditemukan',
            ], 404);
        }

        // Perhitungan Fuzzy Tsukamoto untuk setiap variabel
        // Implementasi perhitungan tingkat keanggotaan
        $hasilFuzzifikasi = $this->fuzzifikasi($dataPertanian);

        //-----------------------Perhitungan Inferennsi Fuzzy Tsukamoto-----------------------//
        // Ambil semua aturan fuzzy
        $aturanFuzzy = $this->getAturanFuzzy();
        // Lakukan inferensi
        $hasilInferensi = $this->inferensi($aturanFuzzy, $hasilFuzzifikasi);
         // Lakukan defuzzifikasi
        $hasilDefuzzifikasi = $this->defuzzifikasi($hasilInferensi, $aturanFuzzy);

        // dd($hasilDefuzzifikasi['prediksi']);

        //-----------------------Simpan hasil defuzzifikasi ke Database-----------------------//
        $fuzzyHasil = Fuzzy_Hasil::where('kode_pertanian', $kode_pertanian);
        $fuzzyHasil->update([
            'jml_prediksi' => $hasilDefuzzifikasi['prediksi'],
        ]);

        return view('anggota.modal_prediksi.hasil_prediksiAnggota', ['hasil' => $hasilFuzzifikasi, 'dataInferensi' => $hasilInferensi, 'jumlahVariabel' => $jumlahVariabel, 'hasilDefuzzifikasi' => $hasilDefuzzifikasi['hasilDefuzzifikasi'], 'prediksi' => $hasilDefuzzifikasi['prediksi']], compact('variabel'));
    }

    private function getDataPertanian($kode_pertanian) {
        return Data_Pertanian::where('data_pertanian.kode_pertanian', $kode_pertanian)
            ->join('users', 'users.id', '=', 'data_pertanian.id_user')
            ->join('variabel_himpunan', 'variabel_himpunan.id', '=', 'data_pertanian.id_variabel')
            ->join('hasil_fuzzy', 'hasil_fuzzy.kode_pertanian', '=', 'data_pertanian.kode_pertanian')
            ->select('data_pertanian.kode_pertanian',
                    DB::raw('GROUP_CONCAT(DISTINCT users.name) as nama_anggota'),
                    DB::raw('GROUP_CONCAT(variabel_himpunan.id ORDER BY data_pertanian.id_variabel) as id_variabel'),
                    DB::raw('GROUP_CONCAT(variabel_himpunan.nama ORDER BY data_pertanian.id_variabel) as nama_variabel'),
                    DB::raw('GROUP_CONCAT(data_pertanian.id_variabel ORDER BY data_pertanian.id_variabel) as id_variabel'),
                    DB::raw('GROUP_CONCAT(data_pertanian.nilai ORDER BY data_pertanian.id_variabel) as nilai_inputan'),
                    DB::raw('GROUP_CONCAT(DISTINCT data_pertanian.tgl_tanam) as tgl_tanam'),
                    DB::raw('GROUP_CONCAT(DISTINCT hasil_fuzzy.jml_prediksi) as jml_prediksi'))
            ->groupBy('data_pertanian.kode_pertanian')
            ->first();
    }

    private function fuzzifikasi($dataPertanian) {
        $id_variabel = explode(',', $dataPertanian->id_variabel);
        $nilai_inputan = explode(',', $dataPertanian->nilai_inputan);
        $hasilFuzzifikasi = [];

        for ($i = 0; $i < count($id_variabel); $i++) {
            $variabel = Variabel_Himpunan::find($id_variabel[$i]);
            $himpunan = Fuzzy_Himpunan::where('id_variabel', $id_variabel[$i])->get();

            foreach ($himpunan as $h) {
                $jenis_kurva = $h->jenis_kurva;
                $nilai_bawah = $h->nilai_bawah;
                $nilai_atas = $h->nilai_atas;
                $nilai = $nilai_inputan[$i];

                if ($jenis_kurva == 'Linier Naik') {
                    if ($nilai <= $nilai_bawah) {
                        $hasilFuzzifikasi[$variabel->nama][$h->nama][$jenis_kurva] = 0;
                    } else if ($nilai > $nilai_bawah && $nilai < $nilai_atas) {
                        $hasilFuzzifikasi[$variabel->nama][$h->nama][$jenis_kurva] = ($nilai - $nilai_bawah) / ($nilai_atas - $nilai_bawah);
                    } else if ($nilai >= $nilai_atas) {
                        $hasilFuzzifikasi[$variabel->nama][$h->nama][$jenis_kurva] = 1;
                    }
                } else if ($jenis_kurva == 'Linier Turun') {
                    if ($nilai <= $nilai_bawah) {
                        $hasilFuzzifikasi[$variabel->nama][$h->nama][$jenis_kurva] = 1;
                    } else if ($nilai > $nilai_bawah && $nilai < $nilai_atas) {
                        $hasilFuzzifikasi[$variabel->nama][$h->nama][$jenis_kurva] = ($nilai_atas - $nilai) / ($nilai_atas - $nilai_bawah);
                    } else if ($nilai >= $nilai_atas) {
                        $hasilFuzzifikasi[$variabel->nama][$h->nama][$jenis_kurva] = 0;
                    }
                }
            }
        }
        return $hasilFuzzifikasi;
    }

    private function getAturanFuzzy() {
        return Fuzzy_Himpunan::join('variabel_himpunan', 'fuzzy_himpunan.id_variabel', '=', 'variabel_himpunan.id')
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
            ->get()
            ->toArray(); // Untuk mengubah hasil menjadi array
    }

    private function inferensi($aturanFuzzy, $hasilFuzzifikasi) {
        $hasilInferensi = [];

        foreach ($aturanFuzzy as $aturan) {
            $id_variabel = explode(',', $aturan['id_variabel']);
            $nama_variabel = explode(',', $aturan['nama_variabel']);
            $id_himpunan = explode(',', $aturan['id_himpunan']);
            $nama_himpunan = explode(',', $aturan['nama_himpunan']);

            $minValues = [];
            $aturanValues = [];

            // Cari nilai minimum dari setiap aturan
            for ($i = 0; $i < count($id_variabel); $i++) {
                if (isset($hasilFuzzifikasi[$nama_variabel[$i]][$nama_himpunan[$i]])) {
                    foreach ($hasilFuzzifikasi[$nama_variabel[$i]][$nama_himpunan[$i]] as $value) {
                        $minValues[] = $value;
                        $aturanValues[$nama_variabel[$i]][$nama_himpunan[$i]] = $value;
                        $aturanValues[$nama_variabel[$i]] = $value;
                    }
                }
            }

            if (!empty($minValues)) {
                // Dapatkan nilai minimum dari array $minValues
                $min = min($minValues);

                // Simpan hasil inferensi untuk setiap aturan
                $hasilInferensi[$aturan['kode_aturan']]['min'] = $min;
                $hasilInferensi[$aturan['kode_aturan']]['values'] = $aturanValues;
            }
        }
        return $hasilInferensi;
    }

    private function defuzzifikasi($hasilInferensi, $aturanFuzzy) {
        //Inisiasi Variabel
        $hasilDefuzzifikasi = [];
        $totalMin = 0;
        $totalAZ = 0;

        // Hitung nilai z untuk setiap aturan
        foreach ($hasilInferensi as $kodeAturan => $inferensi) {
            $min = $inferensi['min'];

            // Cari aturan yang sesuai dengan kode aturan
            $aturan = array_filter($aturanFuzzy, function($a) use ($kodeAturan) {
                return $a['kode_aturan'] == $kodeAturan;
            });

            // Ambil aturan pertama (karena kode aturan unik)
            $aturan = array_values($aturan)[0];

            // Ambil id keputusan dari aturan
            $idKeputusan = explode(',', $aturan['id_keputusan']);

            // Hitung nilai z untuk setiap keputusan
            foreach ($idKeputusan as $id) {
                // Misalkan Anda memiliki fungsi getNilaiZ yang mengembalikan nilai z untuk keputusan tertentu
                $nilaiZ = $this->getNilaiZ($id, $min);

                // $hasilDefuzzifikasi[$kodeAturan][$id] =  $nilaiZ;

                // Jika nilai z valid, simpan hasil defuzzifikasi
                if ($nilaiZ !== null) {
                    //Menampilkan Pada View
                    $hasilDefuzzifikasi[$kodeAturan][$id]['z'] = $nilaiZ;
                    $hasilDefuzzifikasi[$kodeAturan][$id]['a*z'] = $min * $nilaiZ;

                    //Deffuzifikasi Tsukamoto
                    $totalMin += $min;
                    $totalAZ += $min * $nilaiZ;
                }
            }
        }

        $prediksi = $this->getPrediksi($totalAZ, $totalMin);

        // return $hasilDefuzzifikasi;
        return ['hasilDefuzzifikasi' => $hasilDefuzzifikasi, 'prediksi' => $prediksi];
    }

    private function getPrediksi($totalAZ, $totalMin) {
        if ($totalMin != 0) {
            $prediksi = $totalAZ / $totalMin;
        } else {
            $prediksi = 0;
        }

        return $prediksi;
    }

    private function getNilaiZ($id, $min) {
        // Ambil keputusan berdasarkan id
        $keputusan = Fuzzy_Keputusan::find($id);

        // Jika keputusan tidak ditemukan, kembalikan null
        if ($keputusan === null) {
            return null;
        }

        // Ambil jenis kurva, nilai atas, dan nilai bawah dari keputusan
        $jenis_kurva = $keputusan->jenis_kurva;
        $kep_nilai_atas = $keputusan->kep_nilai_atas;
        $kep_nilai_bawah = $keputusan->kep_nilai_bawah;

        // Hitung nilai z berdasarkan jenis kurva dan nilai min
        if ($jenis_kurva == 'Linier Turun') {
            $nilaiZ = $kep_nilai_atas - ($min * ($kep_nilai_atas - $kep_nilai_bawah));
        } elseif ($jenis_kurva == 'Linier Naik') {
            $nilaiZ = $min * ($kep_nilai_atas - $kep_nilai_bawah) + $kep_nilai_bawah;
        } else {
            $nilaiZ = null;
        }

        return $nilaiZ;
    }

}
