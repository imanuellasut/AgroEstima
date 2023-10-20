<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variabel_Himpunan;
use App\Models\User;

class VariabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.f_data_variabel');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function v_DataVariabel() {
        $dataVariabel = Variabel_Himpunan::all();
        return view('admin.f_tabel_variabel', compact('dataVariabel'));
    }


    public function v_tambah()
    {
        return view('admin.modal.tambah_variabelFuzzy');
    }

    public function p_tambah(Request $request) {
        // Validasi Data variabel
        $request->validate([
            'kode'      => 'required',
            'nama'       => 'required',
            'satuan'    => 'required',
        ]);

        // Insert Data variabel
        $data['kode']      = $request->kode;
        $data['nama']       = $request->nama;
        $data['satuan']    = $request->satuan;
        Variabel_Himpunan::insert($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
