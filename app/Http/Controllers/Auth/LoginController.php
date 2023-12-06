<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
        $input = $request->all();
        $this->validate($request,
        [
            'email' => 'required|email',
            'password' => 'required',
        ],
        [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        // dd($input);

        if (Auth::attempt(['email' => $input["email"], 'password' => $input["password"]])) {
            if (Auth::user()->role == "admin") {
                return redirect()->route('dashboard-admin');
            } else if (Auth::user()->role == "anggota") {
                return redirect()->route('dashboard-anggota');
            } else {
                return redirect()->route('/logout');
            }
        } else {
            return redirect()
            ->route('login')
            ->with('error','Tidak dapat login, silahkan cek Email dan password anda');
        }
    }
}
