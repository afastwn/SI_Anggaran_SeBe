@extends('layouts.main')

@section('title', 'Edit Rekening')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Rekening</h1>

    <form action="{{ route('manage.data.rekening.update', $rekening->id_rekening) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nomor_rek" class="block text-sm font-medium text-gray-700">Nomor Rekening</label>
            <input type="text" name="nomor_rek" id="nomor_rek" class="border rounded w-full py-2 px-3" value="{{ $rekening->nomor_rek }}" required>
        </div>

        <div class="mb-4">
            <label for="alokasi_rekening" class="block text-sm font-medium text-gray-700">Alokasi Rekening</label>
            <input type="text" name="alokasi_rekening" id="alokasi_rekening" class="border rounded w-full py-2 px-3" value="{{ $rekening->alokasi_rekening }}" required>
        </div>

        <div class="mb-4">
            <label for="jenis_rek" class="block text-sm font-medium text-gray-700">Jenis Rekening</label>
            <select name="jenis_rek" id="jenis_rek" class="border rounded w-full py-2 px-3" required>
                <option value="Bendahara" {{ $rekening->jenis_rek == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                <option value="Operasional" {{ $rekening->jenis_rek == 'Operasional' ? 'selected' : '' }}>Operasional</option>
                <option value="Investasi" {{ $rekening->jenis_rek == 'Investasi' ? 'selected' : '' }}>Investasi</option>
                <!-- Tambahkan jenis rekening lain sesuai kebutuhan -->
            </select>
        </div>

        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('manage.data') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
        </div>
    </form>
</div>
@endsection
