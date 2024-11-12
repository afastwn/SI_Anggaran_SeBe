<?php
use App\Anggaran;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\pengajuanController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home/admin', function () {
    return view('home_admin');
})->name('home.admin');

Route::get('/home/kadiv', function () {
    return view('home_kadiv');
})->name('home.kadiv');


Route::get('/pengajuan', [PengajuanController::class, 'show'])->name('pengajuan.show');
Route::get('/pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
Route::post('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan.store');

Route::get('/anggaran', [YourController::class, 'yourMethod'])->name('anggaran');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.custom');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.custom');
