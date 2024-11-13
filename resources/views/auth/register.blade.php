@extends('layouts.main')

@section('title', 'Pendaftaran User')

@section('content')
<body class="flex items-center justify-center min-h-screen bg-gray-200">
    <div class="bg-white p-6 rounded shadow-md w-96">
        <h1 class="text-2xl font-bold mb-4">Form Pendaftaran User</h1>
        @if(session('success'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('manage.user.store') }}">
            @csrf
            <div class="mb-4">
                <label for="nama_user" class="block text-sm font-medium text-gray-700">Nama User</label>
                <input type="text" name="nama_user" id="nama_user" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" id="role" class="border rounded w-full py-2 px-3" required>
                    <option value="">Pilih Role</option>
                    <option value="{{ App\User::ROLE_ADMIN }}">{{ App\Userr::ROLE_ADMIN }}</option>
                    <option value="{{ App\User::ROLE_KADIV }}">{{ App\Userr::ROLE_KADIV }}</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Daftar</button>
    </form>
</div>

@endsection
