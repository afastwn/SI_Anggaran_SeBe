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

    public function index()
    {
        $users = Userr::all(); // Ambil semua data pengguna
        return view('KelolaUser/index', compact('users')); // Kirim data pengguna ke view
    }

    public function destroy($id)
    {
        $user = Userr::findOrFail($id);
        
        // Hapus pengguna
        $user->delete();

        return redirect()->route('manage.user')->with('success', 'Pengguna berhasil dihapus.');
    }

    // Menampilkan form pendaftaran
    public function showRegistrationForm()
    {
        return view('KelolaUser.create'); // Pastikan ini adalah nama view yang benar
    }

    public function editUser ($id)
    {
        $user = Userr::findOrFail($id); // Ambil data pengguna berdasarkan ID
        return view('KelolaUser/edit', compact('user')); // Kirim data pengguna ke view
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:userr',
            'role' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Userr::create([
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password,
        ]);

        return redirect()->route('manage.user')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $user = Userr::findOrFail($id);

        $request->validate([
            'nama_user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:userr,email,' . $id . ',id_user',
            'role' => 'required|string',
            'password' => 'nullable|string|min:8|confirmed', // Password bisa kosong
        ]);

        $user->nama_user = $request->nama_user;
        $user->email = $request->email;
        $user->role = $request->role;

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $user->password = $request->password;
        }

        $user->save();

        return redirect()->route('manage.user')->with('success', 'Pengguna berhasil diperbarui.');
    }
}
