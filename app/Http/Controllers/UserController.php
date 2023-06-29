<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function store(Request $request) {
        // Validasi Data User
        $request->validate([
            'name'      => 'required',
            'nik'       => 'required',
            'alamat'    => 'required',
            'no_hp'     => 'required',
            'role'      => 'required',
            'email'     => 'required',
            'password'  => 'required'
        ]);

        // Cek apakah email sudah terdaftar
        $email = User::where('email', $request->email)->first();
        if($email) {
            return Response::json([
                'success' => false,
                'message' => 'Email Sudah Terdaftar!'
            ], 409);
        }

        // Cek apakah NIK sudah terdaftar
        $nik = User::where('nik', $request->nik)->first();
        if($nik) {
            return Response::json([
                'success' => false,
                'message' => 'NIK Sudah Terdaftar!'
            ], 409);
        }

        // Simpan Data User ke Database
        $data = new User();
        $data->name = $request->name;
        $data->nik = $request->nik;
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->role = $request->role;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->save();

        // Redirect respon JSON
        return Response::json([
            'success' => true,
            'message' => 'Data Anggota Berhasil Ditambahkan!',
            'data' => $data
        ], 200);
    }
}
