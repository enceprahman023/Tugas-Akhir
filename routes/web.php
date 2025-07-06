<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginGuruController; // Controller untuk login GuruBK
use App\Http\Controllers\DashboardGuruController;
use App\Http\Controllers\DashboardPelaporController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredPelaporController;
use App\Http\Controllers\Auth\RegisteredGuruController;
use App\Http\Controllers\Auth\AuthenticatedSessionController; // Jika dipakai untuk autentikasi default
use App\Http\Controllers\Auth\RegisteredController; // Jika dipakai untuk registrasi default
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Auth\LoginPelaporController; // Controller untuk login Pelapor
use App\Http\Controllers\GuruProfileController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PelaporController;
use App\Models\Laporan;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Controllers\AdminLoginController;
use Illuminate\Http\Request;

// =====================================================================================================================
// Rute untuk Pelapor
// =====================================================================================================================

// Rute Registrasi Pelapor
Route::get('/register', [RegisteredPelaporController::class, 'create'])->name('register');
Route::get('/pelapor/register', [RegisteredPelaporController::class, 'create'])->name('pelapor.register'); // Duplikat? Coba gunakan satu saja.
Route::post('/pelapor/register', [RegisteredPelaporController::class, 'store'])->name('pelapor.register.store');

// Route Login Pelapor (Menggunakan LoginPelaporController)
Route::get('/login', [LoginPelaporController::class, 'create'])->name('login');
Route::post('/login', [LoginPelaporController::class, 'store'])->name('login.store');

// Route Register Dashboard pelapor depan 
Route::get('/pelapor/dashboard', [PelaporController::class, 'dashboard'])->name('pelapor.dashboard');

// route ganti  password pelapor 
Route::get('/pelapor/ganti-password', [ProfileController::class, 'formGantiPassword'])->name('pelapor.password');
Route::post('/pelapor/ganti-password', [ProfileController::class, 'updatePassword'])->name('pelapor.password.update');

// Form Buat Laporan (GET)
Route::get('/buat-laporan', [LaporanController::class, 'create'])->name('buat.laporan');

//  Proses Simpan Laporan (POST)
Route::post('/laporan/store', [LaporanController::class, 'store'])->name('laporan.store');

// Route Dashboard Pelapor
Route::get('/pelapor/dashboard', [DashboardPelaporController::class, 'index'])->name('pelapor.dashboard');


// Route Login Pelapor
Route::middleware(['auth'])->group(function () {
    Route::get('/pelapor/buat-laporan', [LaporanController::class, 'create'])->name('laporan.create');
    Route::get('/pelapor/dashboard', [DashboardPelaporController::class, 'index'])->name('pelapor.dashboard');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/status-laporan', function () {
        return view('pelapor.status-laporan');
    })->name('status.laporan');
});

// Halaman Home (Tidak memerlukan autentikasi)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman About (Tidak memerlukan autentikasi)
Route::get('/about-bullying', function () {
    return view('pelapor.about-bullying');
})->name('about.bullying');

// Halaman Panduan (Tidak memerlukan autentikasi)
Route::get('/panduan-laporan', function () {
    return view('pelapor.panduan-laporan');
})->name('panduan.laporan');


// Rute Pelapor yang Memerlukan Autentikasi (menggunakan middleware 'auth' - default 'web' guard)
Route::middleware(['auth'])->group(function () {
    // Halaman Dashboard Pelapor
    
    
    // route update profile 
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    
    // Rute Profil Pelapor
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/laporan', [ProfileController::class, 'laporan'])->name('profile.laporan');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // foto supaya tersimpan di Profile
    Route::get('/foto-profil/{filename}', function ($filename) {
    $path = storage_path('app/public/foto_profil/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->name('foto.profil');


    //Route halaman pelapor cek status
     Route::get('/status-laporan', [LaporanController::class, 'status'])
    ->middleware('auth')
    ->name('status.laporan');

    // route parameter detail laporan dan ubah laporan
    Route::get('/status-laporan', [LaporanController::class, 'status'])->name('status.laporan');
    Route::get('/detail-laporan/{id}', [LaporanController::class, 'show'])->name('detail.laporan');
    Route::get('/ubah-laporan/{id}', [LaporanController::class, 'edit'])->name('ubah.laporan');
    Route::delete('/hapus-laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');

    // Ubah Laporan Pelapor
    Route::get('/ubah-laporan', function () {
        return view('pelapor.ubah-laporan');
    })->name('ubah.laporan');

    // Halaman Profile Laporan Pelapor
    Route::get('/profile-laporan', function () {
        return view('pelapor.profile-laporan');
    })->name('profile.laporan.view');

    Route::get('/dashboard', function () {
    return redirect()->route('pelapor.dashboard');
    })->name('dashboard');


    // Logout Pelapor
    Route::post('/logout', function (Request $request) {
        Auth::logout(); // Logout dari guard default (web)
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

// =====================================================================================================================
// Rute untuk Guru BK
// =====================================================================================================================

// Rute Registrasi Guru BK
Route::get('/guru/register', [RegisteredGuruController::class, 'create'])->name('guru.register');
Route::post('/guru/register', [RegisteredGuruController::class, 'store'])->name('guru.register.store');

// Rute Login/Logout Guru BK (Menggunakan LoginGuruController)
Route::get('/login-guru', [LoginGuruController::class, 'showLoginForm'])->name('guru.login');
Route::post('/login-guru', [LoginGuruController::class, 'login'])->name('guru.login.submit');
Route::post('/logout-guru', [LoginGuruController::class, 'logout'])->name('guru.logout');

//Route Profile guruBK
Route::get('/guru/profile', [GuruProfileController::class, 'show'])->name('guru.profile');
Route::post('/guru/profile/update', [GuruProfileController::class, 'updateProfile'])->name('guru.profile.update');
Route::put('/guru/profile/update', [GuruProfileController::class, 'update'])->name('guru.profile.update');
Route::get('/guru/ganti-password', [GuruProfileController::class, 'showChangePasswordForm'])->name('guru.password');
Route::post('/guru/password/update', [GuruProfileController::class, 'updatePassword'])->name('guru.password.update');


// Rute Guru BK yang Memerlukan Autentikasi (menggunakan middleware 'auth:guru' - khusus guard 'guru')
Route::middleware(['auth'])->group(function () {
    Route::get('/guru/dashboard', [DashboardGuruController::class, 'index'])->name('guru.dashboard');
    // Halaman Dashboard Guru BK
   Route::get('/guru/profile', [GuruProfileController::class, 'show'])->name('guru.profile');
    Route::post('/guru/profile/update', [GuruProfileController::class, 'updateProfile'])->name('guru.profile.update');
    Route::put('/guru/profile/update', [GuruProfileController::class, 'update'])->name('guru.profile.update');
    Route::get('/guru/ganti-password', [GuruProfileController::class, 'showChangePasswordForm'])->name('guru.password');
    Route::post('/guru/password/update', [GuruProfileController::class, 'updatePassword'])->name('guru.password.update');
    // Atau jika hanya menampilkan view langsung:
    // Route::get('/guru/dashboard', function () {
    //     return view('guru.dashboard');
    // })->name('guru.dashboard');

    // Route Kelola Laporan Guru
    Route::get('/guru/kelola-laporan', [LaporanController::class, 'guruKelola'])->name('guru.kelola');
    
    // Route update untuk kelola laporan guruBK
    Route::post('/laporan/{id}/update-penanganan', [LaporanController::class, 'updatePenanganan'])->name('laporan.updatePenanganan');
    Route::put('/laporan/{id}/update-status', [LaporanController::class, 'updateStatus'])->name('laporan.updateStatus');
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');

    // Route Cetak Laporan guru
    Route::get('/guru/cetak-laporan', [LaporanController::class, 'cetakLaporan'])->name('guru.cetak');
    Route::get('/guru/cetak-laporan/{id}', [LaporanController::class, 'cetakDetail'])->name('guru.cetak.detail');


    

    // Halaman Panduan Guru
    Route::get('/guru/panduan', function () {
        return view('guru.panduan-guru');
    })->name('guru.panduan');

    // Halaman Profile Guru BK
    Route::get('/guru/profile', [GuruProfileController::class, 'show'])->name('guru.profile'); // Menggunakan Controller
    // Atau jika hanya menampilkan view langsung:
    // Route::get('/guru/profile', function () {
    //     return view('guru.profile_guru');
    // })->name('guru.profile');
});

// =====================================================================================================================
// Rute untuk Admin
// =====================================================================================================================
// Halaman login admin
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');

// Proses login admin
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.store');

// Logout admin
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');


// 🔐 Route ADMIN - hanya bisa diakses kalau login & role admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('admin.dashboard_admin'))->name('admin.dashboard');
    Route::get('/admin/kelola_laporan', fn() => view('admin.kelola_laporan'))->name('admin.kelola.laporan');
    Route::get('/admin/cetak_laporan', fn() => view('admin.cetak_laporan'))->name('admin.cetak');
    Route::get('/admin/detail_laporan', fn() => view('admin.detail_laporan'))->name('admin.detail');
    Route::get('/admin/kelola_akun', fn() => view('admin.kelola_akun'))->name('admin.kelola.akun');
    Route::get('/admin/panduan_admin', fn() => view('admin.panduan_admin'))->name('admin.panduan.admin');
});


/*
|--------------------------------------------------------------------------
| Middleware untuk admin
|--------------------------------------------------------------------------
*/



    // Kelola Laporan
    Route::get('/kelola_laporan', function () {
        return view('admin.kelola_laporan');
    })->name('kelola.laporan');

    // Cetak Laporan
    Route::get('/cetak_laporan', function () {
        return view('admin.cetak_laporan');
    })->name('cetak');

    // Detail Laporan
    Route::get('/detail_laporan', function () {
        return view('admin.detail_laporan');
    })->name('detail');

    // Kelola Akun
    Route::get('/kelola_akun', function () {
        return view('admin.kelola_akun');
    })->name('kelola.akun');

    // Panduan Admin
    Route::get('/panduan_admin', function () {
        return view('admin.panduan_admin');
    })->name('panduan.admin');


    // Logout Admin
    Route::post('/logout', function () {
        session()->forget('admin_logged_in');
        session()->forget('admin_nama');
        return redirect()->route('admin.login')->with('error', 'Anda telah logout.');
    })->name('logout');