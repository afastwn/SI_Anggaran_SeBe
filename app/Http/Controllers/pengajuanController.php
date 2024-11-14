<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengajuan;
use App\Divisi;
use App\Anggaran;
use App\Rekening;
use App\TahunAktif;

class PengajuanController extends Controller
{
    // Menampilkan semua data pengajuan
// Menampilkan semua data pengajuan
public function show()
{
    // Mengambil semua data pengajuan beserta relasi divisi dan anggaran, diurutkan dari yang paling lama ke terbaru
    $pengajuans = Pengajuan::with('divisi', 'anggaran')
        ->orderBy('tanggal', 'asc') // Urutkan berdasarkan tanggal secara ascending (lama ke terbaru)
        ->get();

    // Mengambil semua data divisi dan rekening untuk form
    $divisis = Divisi::all();
    $rekings = Rekening::all();

    $totalAnggaran = Anggaran::selectRaw('id_divisi, SUM(jumlah) as total')
        ->groupBy('id_divisi')
        ->pluck('total', 'id_divisi')
        ->toArray();

    // Hitung total penerimaan dan pengeluaran yang disetujui
    $totalPenerimaan = 0;
    $totalPengeluaran = 0;

    foreach ($pengajuans as $pengajuan) {
        if ($pengajuan->tipe_transaksi === 'Penerimaan' && $pengajuan->status === 'Disetujui') {
            $totalPenerimaan += $pengajuan->jumlah;
        } elseif ($pengajuan->tipe_transaksi === 'Pengeluaran' && $pengajuan->status === 'Disetujui') {
            $totalPengeluaran += $pengajuan->jumlah;
        }
    }

    // Hitung sisa saldo
    $sisaSaldo = $totalPenerimaan - $totalPengeluaran;

    // Mengirim data ke view
    return view('pengajuan', compact('pengajuans', 'divisis', 'rekings', 'totalAnggaran', 'sisaSaldo'));
}



    // Menampilkan form pengajuan
    public function create()
    {
        $divisis = Divisi::all();
        $anggarans = Anggaran::all();
        return view('pengajuan.create', compact('divisis', 'anggarans'));
    }


    // Menyimpan data pengajuan
    public function store(Request $request)
{
    // Validasi data yang diterima
    $request->validate([
        'id_divisi' => 'required|exists:divisi,id_divisi',
        'id_rekening' => 'required|exists:rekening,id_rekening',
        'jumlah' => 'required|numeric',
        'tanggal' => 'required|date',
        'tipe_transaksi' => 'required|string',
        'nama_anggaran' => 'required|string',
    ]);

    // Menyimpan pengajuan baru
    $pengajuan = new Pengajuan();
    $pengajuan->id_divisi = $request->id_divisi;
    $pengajuan->id_rekening = $request->id_rekening;
    $pengajuan->jumlah = $request->jumlah;
    $pengajuan->tanggal = $request->tanggal;
    $pengajuan->tipe_transaksi = $request->tipe_transaksi;
    $pengajuan->save();

    // Mendapatkan tahun dari tanggal yang diinput
    $tahunInput = \Carbon\Carbon::parse($request->tanggal)->year;

    // Cari id_tahun yang sesuai di tabel tahun
    $tahun = TahunAktif::where('tahun', $tahunInput)->first();

    // Cek apakah id_tahun ditemukan
    if (!$tahun) {
        return redirect()->back()->with('error', 'Tahun tidak ditemukan.')->withInput();
    }

    // Menyimpan data anggaran
    // $anggaran = new Anggaran();
    // $anggaran->id_pengajuan = $pengajuan->id_pengajuan;
    // $anggaran->jumlah = $request->jumlah;
    // $anggaran->tanggal = $request->tanggal;
    // $anggaran->status = 'pending';
    // $anggaran->nama_anggaran = $request->nama_anggaran;
    // $anggaran->id_divisi = $request->id_divisi;
    // $anggaran->id_rekening = $request->id_rekening;
    // $anggaran->id_tahun = $tahun->id_tahun;

    // // Simpan data anggaran
    // $anggaran->save();

    // // Update total anggaran berdasarkan tipe transaksi
    // if ($request->tipe_transaksi === 'Penerimaan') {
    //     // Tambah jumlah ke total anggaran
    //     $totalAnggaran = Anggaran::where('id_divisi', $request->id_divisi)->first();
    //     if ($totalAnggaran) {
    //         $totalAnggaran->jumlah += $request->jumlah;
    //         $totalAnggaran->save();
    //     }
    // } else if ($request->tipe_transaksi === 'Pengeluaran') {
    //     // Kurangi jumlah dari total anggaran
    //     $totalAnggaran = Anggaran::where('id_divisi', $request->id_divisi)->first();
    //     if ($totalAnggaran) {
    //         $totalAnggaran->jumlah -= $request->jumlah;
    //         $totalAnggaran->save();
    //     }
    // }

    return redirect()->back()->with('success', 'Pengajuan berhasil dibuat.');
}


}
