<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>

    <!-- Tambahkan di dalam tag <head> di layout utama -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css"> <!-- Jika menggunakan Bootstrap -->

</head>
<body class="bg-gray-100 font-roboto">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/6 bg-white h-screen p-4 shadow-lg">
            <div class="flex items-center mb-8">
                <img alt="Company Logo" class="mr-2" height="50" src="{{ asset('images/logo.png') }}" width="150"/>
            </div>
            <ul>
                <li class="mb-4 flex items-center {{ request()->routeIs('home.kadiv') ? 'bg-green-200 text-green-600' : '' }}">
                    <i class="fas fa-home mr-3"></i>
                    <a href="{{ route('home.kadiv') }}">Halaman Utama</a>
                </li>
                @if (request()->routeIs('home.admin')) <!-- Pengecekan rute untuk admin -->
                <li class="mb-4 flex items-center {{ request()->routeIs('manage.data') ? 'bg-green-200 text-green-600' : '' }}">
                    <i class="fas fa-database mr-5"></i>
                    <a href="#">Manage Data</a>
                </li>
                @endif
                @if (request()->routeIs('home.admin')) <!-- Pengecekan rute untuk admin -->
                    <li class="mb-4 flex items-center {{ request()->routeIs('manage.user') ? 'bg-green-200 text-green-600' : '' }}">
                        <i class="fas fa-users mr-5"></i>
                        <a href="{{ route('manage.user') }}">Kelola User</a>
                    </li>
                @endif
                <li class="mb-4 flex items-center {{ request()->routeIs('pengajuan.show') ? 'bg-green-200 text-green-600' : '' }}">
                    <i class="fas fa-file-alt mr-5"></i>
                    <a href="{{ route('pengajuan.show') }}">Pengajuan</a>
                </li>
                @if (Route::has('anggaran'))
                    <li class="mb-4 flex items-center {{ request()->routeIs('anggaran') ? 'bg-green-200 text-green-600' : '' }}">
                        <i class="fas fa-file-alt mr-5"></i>
                        <a href="{{ route('anggaran') }}">Anggaran</a>
                    </li>
                @endif
                <li class="mb-4 flex items-center {{ request()->routeIs('anggaran') ? 'bg-green-200 text-green-600' : '' }}">
                    <i class="fas fa-money-bill-alt mr-3"></i>
                        <a href="">Anggaran</a>
                    </li>
                <li class="mb-4 flex items-center {{ request()->routeIs('realisasi') ? 'bg-green-200 text-green-600' : '' }}">
                    <i class="fas fa-check-circle mr-4"></i>
                    <a href="#">Realisasi</a>
                </li>
                <li class="mb-4 flex items-center {{ request()->routeIs('dokumen.anggaran') ? 'bg-green-200 text-green-600' : '' }}">
                    <i class="fas fa-folder-open mr-3"></i>
                    <a href="#">Dokumen Anggaran</a>
                </li>
                <li class="mb-4 flex items-center {{ request()->routeIs('report') ? 'bg-green-200 text-green-600' : '' }}">
                    <i class="fas fa-file mr-5"></i>
                    <a href="#">Report</a>
                </li>
                <li class="mb-4 flex items-center {{ request()->routeIs('setting') ? 'bg-green-200 text-green-600' : '' }}">
                    <i class="fas fa-cog mr-4"></i>
                    <a href="#">Setting</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-5/6 p-8">
            @yield('content')
        </div>
    </div>

    <!-- Tambahkan di bawah jQuery sebelum penutup </body> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script> <!-- Jika menggunakan Bootstrap -->
@yield('scripts')
</body>
</html>
