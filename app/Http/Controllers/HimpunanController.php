<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Fuzzy_Aturan;
use Illuminate\Http\Request;
use App\Models\Fuzzy_Himpunan;
use App\Models\Fuzzy_Keputusan;
use Illuminate\Validation\Rule;
use App\Models\Variabel_Himpunan;
use Illuminate\Support\Facades\Validator;

class HimpunanController extends Controller
{
    public function index() {
        $dataHimpunan   = Fuzzy_Himpunan::all();
        $dataVariabel = Variabel_Himpunan::all();
        $dataKeputusan = Fuzzy_Keputusan::all();
        return view('admin.fuzzy_himpunan', compact('dataVariabel', 'dataHimpunan','dataKeputusan'));
    }

    public function addKeputusan(Request $request) {
        $request ->validate(
            [
                'nama_keputusan' => 'required|unique:fuzzy_keputusan',
                'jenis_kurva' => 'required|in:Linier Naik,Linier Turun|unique:fuzzy_keputusan,jenis_kurva',
                'kep_nilai_bawah' => 'required',
                'kep_nilai_atas' => 'required',
            ],
            [
                'nama_keputusan.required' => 'Nama Keputusan tidak boleh kosong',
                'nama_keputusan.unique' => 'Nama Keputusan sudah ada',
                'jenis_kurva.unique' => 'Jenis Kurva sudah ada',
                'jenis_kurva.required' => 'Jenis Kurva tidak boleh kosong',
                'kep_nilai_bawah.required' => 'Nilai Bawah tidak boleh kosong',
                'kep_nilai_atas.required' => 'Nilai Atas tidak boleh kosong',
            ]
        );

         // Insert Data Himpunan Keputusan
        Fuzzy_Keputusan::create([
            'nama_keputusan' => $request->nama_keputusan,
            'jenis_kurva' => $request->jenis_kurva,
            'kep_nilai_bawah' => $request->kep_nilai_bawah,
            'kep_nilai_atas' => $request->kep_nilai_atas,
        ]);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function perbaruiKeputusan(Request $request){
        $request->validate(
            [
                'up_nama_keputusan' => 'required',
                'up_kep_nilai_bawah' => 'required',
                'up_kep_nilai_atas' => 'required',
            ],
            [
                'up_nama_keputusan.required' => 'Nama Keputusan tidak boleh kosong',
                'up_kep_nilai_bawah.required' => 'Nilai Bawah tidak boleh kosong',
                'up_kep_nilai_atas.required' => 'Nilai Atas tidak boleh kosong',
            ]
        );

        // Update Data Himpunan Keputusan
        Fuzzy_Keputusan::where('id_keputusan', $request->up_id_keputusan)
            ->update([
                'nama_keputusan' => $request->up_nama_keputusan,
                'jenis_kurva' => $request->up_jenis_kurva_keputusan,
                'kep_nilai_bawah' => $request->up_kep_nilai_bawah,
                'kep_nilai_atas' => $request->up_kep_nilai_atas,
            ]);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function deleteKeputusan(Request $request) {

        Fuzzy_Keputusan::where('id_keputusan', $request->down_id_keputusan)->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function addHimpunan(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => [
                'required',
                Rule::unique('fuzzy_himpunan')->where(function ($query) use ($request) {
                    return $query->where('id_variabel', $request->id_variabel);
                }),
            ],
            'jenis_kurva' => [
                'required',
                Rule::unique('fuzzy_himpunan')->where(function ($query) use ($request) {
                    return $query->where('id_variabel', $request->id_variabel);
                }),
            ],
            'nilai_bawah' => 'required',
            'nilai_atas' => 'required',
        ], [
            'nama.required' => 'Nama Himpunan tidak boleh kosong',
            'nama.unique' => 'Nama Keputusan sudah ada',
            'jenis_kurva.unique' => 'Jenis Kurva sudah ada',
            'jenis_kurva.required' => 'Jenis Kurva tidak boleh kosong',
            'nilai_bawah.required' => 'Nilai Bawah tidak boleh kosong',
            'nilai_atas.required' => 'Nilai Atas tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Insert Data Himpuanan Variabel
        Fuzzy_Himpunan::create([
            'id_variabel' => $request->id_variabel,
            'nama' => $request->nama,
            'jenis_kurva' => $request->jenis_kurva,
            'nilai_bawah' => $request->nilai_bawah,
            'nilai_atas' => $request->nilai_atas,
        ]);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function perbaruiHimpunan(Request $request){
        $request->validate(
            [
                'up_nama' => 'required',
                'up_him_nilai_bawah' => 'required',
                'up_him_nilai_atas' => 'required',
            ],
            [
                'up_nama.required' => 'Nama Anggota tidak boleh kosong',
                'up_him_nilai_bawah.required' => 'Nilai Bawah tidak boleh kosong',
                'up_him_nilai_atas.required' => 'Nilai Atas tidak boleh kosong',
            ]
        );

        // Update Data Himpunan Keputusan
        Fuzzy_Himpunan::where('id', $request->up_id)
            ->update([
                'id_variabel' => $request->id_variabel,
                'nama' => $request->up_nama,
                'jenis_kurva' => $request->up_jenis_kurva,
                'nilai_bawah' => $request->up_him_nilai_bawah,
                'nilai_atas' => $request->up_him_nilai_atas,
            ]);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function deleteHimpunan(Request $request) {

        Fuzzy_Himpunan::where('id', $request->down_id)->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
