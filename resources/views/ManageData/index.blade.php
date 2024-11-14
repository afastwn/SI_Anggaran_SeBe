@extends('layouts.main')

@section('title', 'Manage Data')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Manage Data</h1>

    <div class="mb-4">
        <a href="{{ route('manage.data.rekening.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Rekening</a>
    </div>

    <!-- Tampilkan daftar rekening jika ada -->
    <h2 class="text-xl font-semibold mt-6">Daftar Rekening</h2>
    <table class="table table-striped table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Rekening</th>
                <th>Alokasi Rekening</th>
                <th>Jenis Rekening</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rekings as $index => $rekening)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $rekening->nomor_rek }}</td>
                    <td>{{ $rekening->alokasi_rekening }}</td>
                    <td>{{ $rekening->jenis_rek }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
