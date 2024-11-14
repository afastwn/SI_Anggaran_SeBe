<?php
use App\Anggaran;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\pengajuanController;
use App\Http\Controllers\ManageDataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.custom');


Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/home/admin', function () {
        return view('home_admin');
    })->name('home.admin');

    // Hanya Kadiv yang bisa mengakses halaman ini
    Route::get('/home/kadiv', [HomeController::class, 'homeKadiv'])->name('home.kadiv');

    Route::get('/pengajuan', [PengajuanController::class, 'show'])->name('pengajuan.show');
    Route::get('/pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan.store');

});

Route::middleware(['auth', 'Roles:admin'])->group(function () {
    Route::get('/manage/data', [ManageDataController::class, 'index'])->name('manage.data');
    Route::get('/manage/data/rekening/create', [ManageDataController::class, 'createRekening'])->name('manage.data.rekening.create');
    Route::post('/manage/data/rekening/store', [ManageDataController::class, 'storeRekening'])->name('manage.data.rekening.store');
});

Route::get('/manage/user', [RegisterController::class, 'showRegistrationForm'])->name('manage.user'); // Semua pengguna bisa mengakses
Route::post('/manage/user/store', [RegisterController::class, 'register'])->name('manage.user.store'); // Semua pengguna bisa mengakses
