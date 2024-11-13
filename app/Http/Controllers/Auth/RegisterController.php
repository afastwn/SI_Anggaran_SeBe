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

    protected $redirectTo = RouteServiceProvider::HOME;

    // public function __construct()
    // {
    //     $this->middleware('admin'); // Hanya bisa diakses oleh admin
    // }

    // Menampilkan form pendaftaran
    public function showRegistrationForm()
    {
        return view('auth.register'); // Pastikan ini adalah nama view yang benar
    }

    // Menyimpan pengguna baru
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'], // Simpan role
            'password' => Hash::make($data['password']),
        ]);
    }

    // Validasi data pendaftaran
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'in:' . implode(',', User::roles())], // Validasi role harus sesuai dengan enum
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // Mengoverride metode register
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $this->create($request->all());

        return redirect()->route('manage.user')->with('success', 'Pengguna berhasil ditambahkan.');
    }
}
