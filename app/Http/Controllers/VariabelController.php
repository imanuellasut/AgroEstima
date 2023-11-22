<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variabel_Himpunan;
use App\Models\FuzzyHimpunan;
use App\Models\User;


class VariabelController extends Controller {

    //Tampil Data Variabel
    public function index() {
        $dataVariabel = Variabel_Himpunan::all();
        return view('admin.fuzzy_variabel', compact('dataVariabel'));
    }

    //Tambah Data Variabel
    public function addVariabel(Request $request) {
        $request->validate(
            [
                'nama' => 'required|unique:variabel_himpunan',
                'satuan' => 'required',
            ],
            [
                'nama.required' => 'Nama Variabel tidak boleh kosong',
                'nama.unique' => 'Nama Variabel sudah ada',
                'satuan.required' => 'Satuan tidak boleh kosong',
            ]
        );

         // Insert Data variabel
        $variabel = new Variabel_Himpunan;
        $variabel->nama     = $request['nama'];
        $variabel->satuan   = $request['satuan'];
        $variabel->save();

        return response()->json([
            'status' => 'success',
        ]);
    }

    //Update Data Variabel
    public function updateVariabel(Request $request) {
        $request->validate(
            [
                'up_nama' => 'required|unique:variabel_himpunan,nama,'.$request->up_id,
                'up_satuan' => 'required',
            ],
            [
                'up_nama.required' => 'Nama Variabel tidak boleh kosong',
                'up_nama.unique' => 'Nama Variabel sudah ada',
                'up_satuan.required' => 'Satuan tidak boleh kosong',
            ]
        );

        // Update Data variabel
        Variabel_Himpunan::where('id', $request->up_id)
            ->update([
                'nama' => $request->up_nama,
                'satuan' => $request->up_satuan,
            ]);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function deleteVariabel(Request $request) {
        Variabel_Himpunan::where('id', $request->down_id)->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }

    // public function pagination(Request $request) {
    //     $dataVariabel = Variabel_Himpunan::paginate(5);
    //     return view('admin.fuzzy_variabel', compact('dataVariabel'));
    // }
}
