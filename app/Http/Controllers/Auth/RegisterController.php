<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Userr; // Import model Userr
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; // Import Request

class RegisterController extends Controller
{
    use RegistersUsers;

    // Menampilkan form pendaftaran
    public function showRegistrationForm()
    {
        return view('auth.register'); // Pastikan ini adalah nama view yang benar
    }

    // Menyimpan pengguna baru
    protected function create(array $data)
    {
        return Userr::create([
            'nama_user' => $data['nama_user'],
            'role' => $data['role'], // Simpan role
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    // Validasi data pendaftaran
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama_user' => ['required', 'string', 'max:255'],
            'role' => ['required', 'in:' . implode(',', Userr::roles())], // Validasi role harus sesuai dengan enum
            'email' => ['required', 'string', 'email', 'max:255', 'unique:userr'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // Mengoverride metode register
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $this->create($request->all());

        return redirect()->route('login')->with('success', 'Pengguna berhasil ditambahkan.');
    }
}
