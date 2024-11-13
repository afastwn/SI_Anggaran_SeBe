<?php

namespace App\Http\Controllers\Auth;

use App\Userr; // Pastikan Anda mengimpor model Userr
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; // Import Request

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika login berhasil, periksa peran pengguna
            $user = Auth::userr();

            if ($user->role == 'admin') {
                return redirect()->route('home.admin'); // Halaman untuk admin
            } elseif ($user->role == 'kepala_divisi') {
                return redirect()->route('home.kadiv'); // Halaman untuk kepala divisi
            }
        }

        // Jika login gagal
        return redirect()->back()->withErrors(['email' => 'Kredensial tidak valid.'])->withInput();
    }
}
