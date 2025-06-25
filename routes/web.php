<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginGuruController; // Controller untuk login GuruBK
use App\Http\Controllers\DashboardGuruController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredPelaporController;
use App\Http\Controllers\Auth\RegisteredGuruController;
use App\Http\Controllers\Auth\AuthenticatedSessionController; // Jika dipakai untuk autentikasi default
use App\Http\Controllers\Auth\RegisteredController; // Jika dipakai untuk registrasi default
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Auth\LoginPelaporController; // Controller untuk login Pelapor
use App\Http\Controllers\GuruProfileController;
use Illuminate\Http\Request;

// =====================================================================================================================
// Rute untuk Pelapor
// =====================================================================================================================

// Rute Registrasi Pelapor
Route::get('/register', [RegisteredPelaporController::class, 'create'])->name('register');
Route::get('/pelapor/register', [RegisteredPelaporController::class, 'create'])->name('pelapor.register'); // Duplikat? Coba gunakan satu saja.
Route::post('/pelapor/register', [RegisteredPelaporController::class, 'store'])->name('pelapor.register.store');

// Rute Login Pelapor (Menggunakan LoginPelaporController)
Route::get('/login', [LoginPelaporController::class, 'create'])->name('login');
Route::post('/login', [LoginPelaporController::class, 'store'])->name('login.store');

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
    Route::get('/dashboard', function () {
        return view('pelapor.dashboard'); // Pastikan ini mengarah ke view dashboard pelapor Anda
    })->name('dashboard');

    // Rute Profil Pelapor
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/laporan', [ProfileController::class, 'laporan'])->name('profile.laporan');

    // Rute Buat Laporan
    Route::get('/buat-laporan', [LaporanController::class, 'create'])->name('buat.laporan');
    Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');

    // Status Laporan Pelapor
    Route::get('/status-laporan', function () {
        return view('pelapor.status-laporan');
    })->name('status.laporan');

    // Detail Laporan Pelapor
    Route::get('/detail-laporan', function () {
        return view('pelapor.detail-laporan');
    })->name('detail.laporan');

    // Ubah Laporan Pelapor
    Route::get('/ubah-laporan', function () {
        return view('pelapor.ubah-laporan');
    })->name('ubah.laporan');

    // Halaman Profile Laporan Pelapor
    Route::get('/profile-laporan', function () {
        return view('pelapor.profile-laporan');
    })->name('profile.laporan.view');

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
Route::get('/guru/profil', [GuruProfileController::class, 'show'])->name('guru.profil');
Route::post('/guru/profil/update', [GuruProfileController::class, 'updateProfile'])->name('guru.profil.update');
Route::put('/guru/profil/update', [GuruProfileController::class, 'update'])->name('guru.profil.update');
Route::get('/guru/ganti-password', [GuruProfileController::class, 'showChangePasswordForm'])->name('guru.password');
Route::post('/guru/password/update', [GuruProfileController::class, 'updatePassword'])->name('guru.password.update');


// Rute Guru BK yang Memerlukan Autentikasi (menggunakan middleware 'auth:guru' - khusus guard 'guru')
Route::middleware(['auth'])->group(function () {
    // Halaman Dashboard Guru BK
    Route::get('/guru/dashboard', [DashboardGuruController::class, 'index'])->name('guru.dashboard'); // Menggunakan Controller
    // Atau jika hanya menampilkan view langsung:
    // Route::get('/guru/dashboard', function () {
    //     return view('guru.dashboard');
    // })->name('guru.dashboard');

    // Rute Kelola Laporan Guru
    Route::get('/guru/kelola-laporan', [LaporanController::class, 'guruKelola'])->name('guru.kelola');

    // Rute Cetak Laporan Guru
    Route::get('/guru/cetak-laporan', function () {
        return view('guru.cetak_laporan');
    })->name('guru.cetak');

    // Halaman Detail Cetak Laporan Guru
    Route::get('/guru/detail-laporan', function () {
        return view('guru.detail_laporan');
    })->name('guru.cetak.detail');

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

// Rute Login Admin (Menggunakan logika manual, disarankan untuk direfactor menggunakan Auth Guards)
Route::GET('/admin/login', function () {
    return view('admin.login_admin');
})->name('admin.login');

Route::post('/admin/login', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');

    if ($username === 'admin' && $password === 'admin123') {
        session(['admin_logged_in' => true]);
        return redirect('/admin/dashboard');
    }
    return redirect()->back()->with('error', 'Username atau password salah!');
})->name('admin.login.store');

// Rute Admin yang Memerlukan Autentikasi (menggunakan middleware 'admin' - pastikan middleware ini ada dan terdaftar)
Route::middleware(['admin'])->group(function () { // Contoh middleware khusus admin
    // Halaman Dashboard Admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard_admin');
    })->name('admin.dashboard');

    // Halaman Kelola Laporan Admin
    Route::get('/admin/kelola_laporan', function () {
        return view('admin.kelola_laporan');
    })->name('admin.kelola.laporan');

    // Halaman Cetak Laporan Admin
    Route::get('/admin/cetak_laporan', function () {
        return view('admin.cetak_laporan');
    })->name('admin.cetak');

    // Halaman Detail Laporan Admin
    Route::get('/admin/detail_laporan', function () {
        return view('admin.detail_laporan');
    })->name('admin.detail');

    // Halaman Kelola Akun Admin
    Route::get('/admin/kelola_akun', function () {
        return view('admin.kelola_akun');
    })->name('admin.kelola.akun');

    // Halaman Panduan Admin
    Route::get('/admin/panduan_admin', function () {
        return view('admin.panduan_admin');
    })->name('admin.panduan.admin');

    // Logout Admin
    Route::post('/admin/logout', function () {
        Auth::logout(); // Logout dari semua guard, termasuk default
        session()->forget('admin_logged_in'); // Hapus sesi admin manual
        return redirect('/admin/login');
    })->name('admin.logout');
});
