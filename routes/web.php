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
    Route::get('/manage/data/rekening/edit/{id}', [ManageDataController::class, 'editRekening'])->name('manage.data.rekening.edit');
    Route::delete('/manage/data/rekening/{id}', [ManageDataController::class, 'destroyRekening'])->name('manage.data.rekening.destroy');
    Route::put('/manage/data/rekening/update/{id}', [ManageDataController::class, 'updateRekening'])->name('manage.data.rekening.update');
});

Route::middleware(['auth', 'Roles:admin'])->group(function () {
    Route::get('/manage/user', [RegisterController::class, 'index'])->name('manage.user'); // Menampilkan daftar pengguna
    Route::get('/manage/user/create', [RegisterController::class, 'showRegistrationForm'])->name('manage.user.create'); // Menampilkan form pendaftaran pengguna baru
    Route::get('/manage/user/edit/{id}', [RegisterController::class, 'editUser'])->name('manage.user.edit');
    Route::delete('/manage/user/{id}', [RegisterController::class, 'destroy'])->name('manage.user.destroy'); // Menghapus pengguna
    Route::post('/manage/user/store', [RegisterController::class, 'store'])->name('manage.user.store'); // Menyimpan pengguna baru
    Route::put('/manage/user/{id}', [RegisterController::class, 'update'])->name('manage.user.update'); // Memperbarui pengguna
});

// Route::get('/manage/user', [RegisterController::class, 'showRegistrationForm'])->name('manage.user'); // Semua pengguna bisa mengakses
// Route::post('/manage/user/store', [RegisterController::class, 'register'])->name('manage.user.store'); // Semua pengguna bisa mengakses
