@extends('layouts.main')

@section('title', 'Tambah User')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Tambah User</h1>

    <form action="{{ route('manage.user.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nama_user" class="block text-sm font-medium text-gray-700">Nama User</label>
            <input type="text" name="nama_user" id="nama_user" class="border rounded w-full py-2 px-3" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="border rounded w-full py-2 px-3" required>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role" id="role" class="border rounded w-full py-2 px-3" required>
                <option value="admin">Admin</option>
                <option value="kepala_divisi">Kepala Divisi</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="border rounded w-full py-2 px-3" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="border rounded w-full py-2 px-3" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('manage.user') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
    </form>

    @if ($errors->any())
    <div class="bg-red-500 text-white p-4 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif  
</div>
@endsection