<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function indexAnggota(Request $request) {
        $dataUser = User::all();
        return view('admin.data_anggota', compact('dataUser'));
    }

    public function addUser(Request $request) {
        // Validasi Data User
        $request->validate([
            'name'      => 'required',
            'nik'       => 'required|max:16',
            'alamat'    => 'required',
            'no_hp'     => 'required|max:12',
            'role'      => 'required',
            'email'     => 'required|email|max:255',
            'password'  => 'nullable|min:8'
        ]);

        // Cek apakah email sudah terdaftar
        $email = User::where('email', $request->email)->first();
        if($email) {
            return back()->with('error', 'Email Sudah Terdaftar!');
        }

        // Cek apakah NIK sudah terdaftar
        $nik = User::where('nik', $request->nik)->first();
        if($nik) {
            return back()->with('error', 'NIK Sudah Terdaftar!');
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

        return back()->with('success', 'Data Anggota Berhasil Ditambahkan!');
    }

    public function updateUser(Request $request, $id) {

         // Validasi Data User
        $request->validate([
            'name'      => 'required',
            'nik'       => 'required|max:16',
            'alamat'    => 'required',
            'no_hp'     => 'required|max:12',
            'role'      => 'required',
            'email'     => 'required|email|max:255',
            'password'  => 'nullable|min:8'
        ]);

        // Simpan Data User ke Database

        $dataUser = User::find($id);
        $dataUser->name = $request->name;
        $dataUser->nik = $request->nik;
        $dataUser->alamat = $request->alamat;
        $dataUser->no_hp = $request->no_hp;
        $dataUser->role = $request->role;
        $dataUser->email = $request->email;
        if($request->password)
        {
            $dataUser->password = Hash::make($request->password);
        }
        $dataUser->save();

        return back()->with('success', 'Data Anggota Berhasil Diubah!');
    }

    public function updateProfile(Request $request, User $user){

    }

    public function deleteUser($id) {
        $dataUser = User::find($id);
        $dataUser->delete();
        return redirect()->route('get-anggota')->with('success', 'Data Anggota Berhasil Dihapus!');
    }

}
