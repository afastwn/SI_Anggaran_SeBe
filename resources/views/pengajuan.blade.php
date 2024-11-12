@extends('layouts.main')

@section('title', 'Pengajuan Anggaran')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Pengajuan Anggaran</h1>

    <!-- Menampilkan pesan sukses -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol untuk tambah pengajuan baru -->
    <div class="mb-4">
        <button id="btnTambah" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Pengajuan Baru</button>
    </div>

    <!-- Form pengajuan anggaran (awalnya disembunyikan) -->
    <div id="formPengajuan" class="hidden mb-6">
        <h2 class="text-xl font-semibold">Form Pengajuan Anggaran</h2>
        <form action="{{ route('pengajuan.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="id_divisi" class="block text-sm font-medium text-gray-700">Divisi</label>
                <select name="id_divisi" id="id_divisi" class="border rounded w-full py-2 px-3">
                    @foreach($divisis as $divisi)
                        <option value="{{ $divisi->id_divisi }}">{{ $divisi->nama_divisi }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="tipe_transaksi" class="block text-sm font-medium text-gray-700">Tipe Transaksi</label>
                <select name="tipe_transaksi" id="tipe_transaksi" class="border rounded w-full py-2 px-3">
                    <option value="pengeluaran">Pengeluaran</option>
                    <option value="penerimaan">Penerimaan</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="id_rekening" class="block text-sm font-medium text-gray-700">Rekening</label>
                <select name="id_rekening" id="id_rekening" class="border rounded w-full py-2 px-3">
                    @foreach($rekings as $rekening)
                        <option value="{{ $rekening->id_rekening }}">
                            {{ $rekening->nomor_rek }} - {{ $rekening->alokasi_rekening }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="nama_anggaran" class="block text-sm font-medium text-gray-700">Nama Anggaran</label>
                <input type="text" name="nama_anggaran" id="nama_anggaran" class="border rounded w-full py-2 px-3" required>
            </div>

            <div class="mb-4">
                <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Pengajuan</label>
                <input type="number" name="jumlah" id="jumlah" class="border rounded w-full py-2 px-3" required>
            </div>

            <div class="mb-4">
                <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Pengajuan</label>
                <input type="date" name="tanggal" id="tanggal" class="border rounded w-full py-2 px-3" required>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                <button type="button" id="btnBatal" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Pengajuan -->
    <h2 class="text-xl font-semibold mt-6">Daftar Pengajuan Anggaran</h2>
    <table id="pengajuanTable" class="table table-striped table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Divisi</th>
                <th>Rekening</th>
                <th>Tipe Transaksi</th>
                <th>Nama Anggaran</th> <!-- Kolom untuk nama anggaran -->
                <th>Jumlah Pengajuan</th>
                <th>Sisa Saldo</th>
                <th>Tanggal Pengajuan</th>
                <th>Status</th> <!-- Kolom untuk status -->
            </tr>
        </thead>
        <tbody>
            @php
            // Inisialisasi array sisa saldo per divisi berdasarkan total anggaran awal
            $sisaSaldoDivisi = $totalAnggaran;
            @endphp
            @foreach($pengajuans as $index => $pengajuan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pengajuan->divisi->nama_divisi }}</td>
                    <td>
                        @if($pengajuan->rekening) <!-- Menampilkan nomor rekening -->
                            {{ $pengajuan->rekening->nomor_rek }} - {{ $pengajuan->rekening->alokasi_rekening }}
                        @else
                            Tidak ada rekening
                        @endif
                    </td>
                    <td>{{ $pengajuan->tipe_transaksi }}</td>
                    <td>
                        @if($pengajuan->anggaran) <!-- Menampilkan nama anggaran dari tabel anggaran -->
                            {{ $pengajuan->anggaran->nama_anggaran }} <!-- Ganti dengan nama kolom yang sesuai -->
                        @else
                            Tidak ada anggaran
                        @endif
                    </td>
                    <td>Rp {{ number_format($pengajuan->jumlah, 0, ',', '.') }}</td> <!-- Format jumlah pengajuan -->
                    <td>
                @php
                    // Dapatkan ID divisi dari pengajuan saat ini
                    $idDivisi = $pengajuan->id_divisi;

                    // Hitung sisa saldo dengan mengurangkan jumlah pengajuan dari saldo yang tersisa
                    $sisaSaldo = $sisaSaldoDivisi[$idDivisi] - $pengajuan->jumlah;

                    // Update saldo yang tersisa untuk iterasi berikutnya
                    $sisaSaldoDivisi[$idDivisi] = $sisaSaldo;
                @endphp
                Rp {{ number_format($sisaSaldo, 0, ',', '.') }}
            </td>

                    <td>{{ \Carbon\Carbon::parse($pengajuan->tanggal)->format('d-m-Y') }}</td>
                    <td>
                        @if($pengajuan->anggaran) <!-- Menampilkan status dari anggaran -->
                            {{ $pengajuan->anggaran->status }} <!-- Ganti dengan nama kolom status yang sesuai -->
                        @else
                            Pending <!-- Status default untuk pengajuan baru -->
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@section('scripts')
<script>
    document.getElementById('btnTambah').addEventListener('click', function() {
        document.getElementById('formPengajuan').classList.remove('hidden');
        document.getElementById('pengajuanTable').classList.add('hidden'); // Menyembunyikan tabel
    });

    document.getElementById('btnBatal').addEventListener('click', function() {
        document.getElementById('formPengajuan').classList.add('hidden');
        document.getElementById('pengajuanTable').classList.remove('hidden'); // Menampilkan tabel lagi
    });

    $(document).ready(function() {
        $('#pengajuanTable').DataTable();
    });
</script>
@endsection
@endsection
