<?php
use App\Anggaran;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\pengajuanController;
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

    Route::get('/home/kadiv', function () {
        return view('home_kadiv');
    })->name('home.kadiv');

    Route::get('/pengajuan', [PengajuanController::class, 'show'])->name('pengajuan.show');
    Route::get('/pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan.store');

});

Route::get('/manage/user', [RegisterController::class, 'showRegistrationForm'])->name('manage.user'); // Semua pengguna bisa mengakses
Route::post('/manage/user/store', [RegisterController::class, 'register'])->name('manage.user.store'); // Semua pengguna bisa mengakses
