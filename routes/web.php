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
use App\Models\Laporan;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

// =====================================================================================================================
// Rute untuk Pelapor
// =====================================================================================================================

// Rute Registrasi Pelapor
Route::get('/register', [RegisteredPelaporController::class, 'create'])->name('register');
Route::get('/pelapor/register', [RegisteredPelaporController::class, 'create'])->name('pelapor.register');
Route::post('/pelapor/register', [RegisteredPelaporController::class, 'store'])->name('pelapor.register.store');

// Route Login Pelapor (Menggunakan LoginPelaporController)
Route::get('/login', [LoginPelaporController::class, 'create'])->name('login');
Route::post('/login', [LoginPelaporController::class, 'store'])->name('login.store');



// Halaman Utama & Informasi Umum (Tidak memerlukan autentikasi)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-bullying', fn () => view('pelapor.about-bullying'))->name('about.bullying');
Route::get('/panduan-laporan', fn () => view('pelapor.panduan-laporan'))->name('panduan.laporan');

// Route sementara untuk test email (bisa dinonaktifkan atau dihapus)
Route::get('/test-email', function () {
    Mail::raw('Test Email DUCARE', function ($message) {
        $message->to('enceprahman93@gmail.com')
            ->subject('Test Email');
    });
    return 'Email berhasil dikirim';
});

// Rute Pelapor yang Memerlukan Autentikasi (Wajib Login & Role Pelapor)
Route::middleware(['auth', 'role:pelapor'])->group(function () {
    // Halaman Dashboard Pelapor
    Route::get('/pelapor/dashboard', [DashboardPelaporController::class, 'index'])->name('pelapor.dashboard');
    Route::get('/dashboard', function () {
        return redirect()->route('pelapor.dashboard');
    })->name('dashboard');

    // Buat Laporan
    Route::get('/buat-laporan', [LaporanController::class, 'create'])->name('buat.laporan');
    Route::post('/laporan/store', [LaporanController::class, 'store'])->name('laporan.store');

    // Status & Detail Laporan
    Route::get('/status-laporan', [LaporanController::class, 'status'])->name('status.laporan');
    Route::get('/detail-laporan/{id}', [LaporanController::class, 'show'])->name('detail.laporan');
    Route::get('/ubah-laporan/{id}', [LaporanController::class, 'edit'])->name('ubah.laporan');

    // Profil Pelapor
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/laporan', [ProfileController::class, 'laporan'])->name('profile.laporan');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile-laporan', fn () => view('pelapor.profile-laporan'))->name('profile.laporan.view');

    // Rute Ganti Password Pelapor
    Route::get('/pelapor/ganti-password', [ProfileController::class, 'formGantiPassword'])->name('pelapor.password');
    Route::post('/pelapor/ganti-password', [ProfileController::class, 'updatePassword'])->name('pelapor.password.update');

    // Serving Profile Photo
    Route::get('/foto-profil/{filename}', function ($filename) {
        $path = storage_path('app/public/foto_profil/' . $filename);
        if (!file_exists($path)) {
            abort(404);
        }
        return response()->file($path);
    })->name('foto.profil');

    // Logout Pelapor
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

// Rute Bersama untuk Semua Aktor Terautentikasi
Route::middleware(['auth'])->group(function () {
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
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
// Route::get('/guru/profile', [GuruProfileController::class, 'show'])->name('guru.profile');
// Route::post('/guru/profile/update', [GuruProfileController::class, 'updateProfile'])->name('guru.profile.update');
// Route::put('/guru/profile/update', [GuruProfileController::class, 'updateProfile'])->name('guru.profile.update');
// Route::get('/guru/ganti-password', [GuruProfileController::class, 'showChangePasswordForm'])->name('guru.password');
// Route::post('/guru/password/update', [GuruProfileController::class, 'updatePassword'])->name('guru.password.update');


// Rute Guru BK yang Memerlukan Autentikasi (menggunakan middleware 'auth:guru' - khusus guard 'guru')
Route::middleware(['auth', 'role:gurubk'])->group(function () {
    Route::get('/guru/dashboard', [DashboardGuruController::class, 'index'])->name('guru.dashboard');
    // Halaman Dashboard Guru BK
    Route::get('/guru/profile', [GuruProfileController::class, 'show'])->name('guru.profile');
    Route::post('/guru/profile/update', [GuruProfileController::class, 'updateProfile'])->name('guru.profile.update');
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

    // Route Cetak Laporan guru
    Route::get('/guru/cetak-laporan', [GuruController::class, 'cetakLaporan'])->name('guru.cetak');
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
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route::get('/admin/kelola_laporan', fn() => view('admin.kelola_laporan'))->name('admin.kelola.laporan');
    // Route::get('/admin/panduan_admin', fn() => view('admin.panduan_admin'))->name('admin.panduan.admin');
    // Admin Dashboard Controller
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/kelola-laporan', [AdminController::class, 'kelolaLaporan'])->name('admin.kelola.laporan');
    // ✅ GUNAKAN YANG INI
    Route::get('/admin/cetak-laporan', [AdminController::class, 'cetakLaporan'])->name('admin.cetak');
    Route::get('/admin/cetak-laporan/{id}', [AdminController::class, 'cetakDetail'])->name('admin.cetak.detail');
    Route::get('/admin/detail_laporan/{id}', [AdminController::class, 'detailLaporan'])->name('admin.detail');
    Route::get('/admin/kelola_akun', [AdminController::class, 'kelolaAkun'])->name('admin.kelola.akun');
    Route::post('/admin/akun/update', [AdminController::class, 'updateAkun'])->name('admin.akun.update');
    Route::delete('/admin/akun/delete/{id}', [AdminController::class, 'hapusAkun'])->name('admin.akun.hapus');
    Route::post('/admin/akun/reset-password', [AdminController::class, 'resetPassword'])->name('admin.akun.resetpassword');
    Route::post('/logout-admin', [AdminController::class, 'logout'])->name('admin.logout.admin');

    // Panduan Admin
    Route::get('/admin/panduan', function () {
        return view('admin.panduan_admin');
    })->name('admin.panduan.admin');
});

// Route sementara untuk membuat akun admin. Silakan buka /buat-admin-temp di browser.
Route::get('/buat-admin-temp', function () {
    try {
        $user = \App\Models\User::updateOrCreate(
            ['email' => 'admin_baru@ducare.com'],
            [
                'name' => 'Admin Baru DUCARE',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ]
        );
        return 'Akun Admin berhasil dibuat/diperbarui!<br>Email: <strong>admin_baru@ducare.com</strong><br>Password: <strong>admin123</strong>';
    } catch (\Exception $e) {
        return 'Gagal membuat akun: ' . $e->getMessage();
    }
});
