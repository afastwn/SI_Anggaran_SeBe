<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rekening;

class ManageDataController extends Controller
{
    public function index()
    {
        $rekings = Rekening::all(); // Ambil semua data rekening
        return view('ManageData/index', compact('rekings')); // Kirim data rekening ke view
    }

    public function createRekening()
    {
        return view('ManageData/create'); // Halaman untuk form tambah rekening
    }

    public function storeRekening(Request $request)
    {
        // Validasi data rekening
        $request->validate([
            'nomor_rek' => 'required|string|max:255',
            'alokasi_rekening' => 'required|string|max:255',
            'jenis_rek' => 'required|string|max:255',
        ]);

        // Menyimpan data rekening baru
        $rekening = new Rekening();
        $rekening->nomor_rek = $request->nomor_rek;
        $rekening->alokasi_rekening = $request->alokasi_rekening;
        $rekening->jenis_rek = $request->jenis_rek;
        $rekening->save();

        return redirect()->route('manage.data')->with('success', 'Rekening berhasil ditambahkan.');
    }
}
