<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginGuruController;
use App\Http\Controllers\DashboardGuruController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredPelaporController;
use App\Http\Controllers\Auth\RegisteredController;
use Illuminate\Http\Request;

// Route untuk Halaman & Proses Registrasi Pelapor
Route::get('/register', [RegisteredPelaporController::class, 'create'])->name('register');
Route::post('/register', [RegisteredPelaporController::class, 'store'])->name('register.store');

// Halaman home
Route::get('/', [HomeController::class, 'index'])->name('home');

// halaman profil
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::get('/profile/laporan', [ProfileController::class, 'laporan'])->name('profile.laporan');

// route halaman login/logout guru bk
Route::get('/login-guru', [LoginGuruController::class, 'showLoginForm'])->name('guru.login');
Route::post('/login-guru', [LoginGuruController::class, 'login'])->name('guru.login.submit');
Route::post('/logout-guru', [LoginGuruController::class, 'logout'])->name('guru.logout');


// Halaman login
Route::get('/login', function () {
    return view('pelapor.login');
})->name('login');

// Proses login
Route::post('/login', function (Request $request) {
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }
    return back()->withErrors(['email' => 'Email atau password salah!']);
})->name('login.store');


// Halaman About
Route::get('/about-bullying', function () {
    return view('pelapor.about-bullying');
})->name('about.bullying');

// Halaman Dashboard Pelapor
Route::get('/dashboard', function () {
    return view('pelapor.dashboard');
})->name('dashboard')->middleware('auth');

// buat laporan pelapor
Route::get('/buat-laporan', function () {
    return view('pelapor.buat-laporan');
})->name('buat.laporan')->middleware('auth');

// status laporan pelapor
Route::get('/status-laporan', function () {
    return view('pelapor.status-laporan');
})->name('status.laporan')->middleware('auth');

// detail laporan pelapor
Route::get('/detail-laporan', function () {
    return view('pelapor.detail-laporan');
})->name('detail.laporan')->middleware('auth');

// ubah laporan pelapor
Route::get('/ubah-laporan', function () {
    return view('pelapor.ubah-laporan');
})->name('ubah.laporan')->middleware('auth');

// halaman panduan
Route::get('/panduan-laporan', function () {
    return view('pelapor.panduan-laporan');
})->name('panduan.laporan');

// halaman profile laporan pelapor
Route::get('/profile-laporan', function () {
    return view('pelapor.profile-laporan');
})->name('profile.laporan.view');

// halaman logout pelapor
Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Akhir Route Pelapor


// Awal Route Guru BK
Route::get('/guru/register', function () {
    return view('guru.register');
})->name('guru.register');

Route::post('/guru/register', function (Request $request) {
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'nip' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'kontak' => 'nullable|string|max:15',
        'password' => 'required|min:6|confirmed',
    ]);

    // TODO: Tambahkan logika penyimpanan Guru ke database di sini
    // Contoh: User::create([...]);

    return redirect()->route('guru.login')->with('success', 'Registrasi berhasil!');
})->name('guru.register.store');

Route::get('/guru/dashboard', function () {
    return view('guru.dashboard');
})->name('guru.dashboard')->middleware('auth:guru'); // Contoh guard: guru

// Route untuk halaman Kelola Laporan Guru
Route::get('/guru/kelola-laporan', function () {
    return view('guru.kelola_laporan');
})->name('guru.kelola')->middleware('auth:guru');

// Route untuk halaman Cetak Laporan Guru
Route::get('/guru/cetak-laporan', function () {
    return view('guru.cetak_laporan');
})->name('guru.cetak')->middleware('auth:guru');

// Halaman detail cetak detail laporan Guru
Route::get('/guru/detail-laporan', function () {
    return view('guru.detail_laporan');
})->name('guru.cetak.detail')->middleware('auth:guru');

// halaman panduan guru
Route::get('/guru/panduan', function () {
    return view('guru.panduan-guru');
})->name('guru.panduan')->middleware('auth:guru');

// halaman profile guruBK
Route::get('/guru/profile', function () {
    return view('guru.profile_guru');
})->name('guru.profile')->middleware('auth:guru');

// Akhir Route Guru BK


// Awal Route Admin
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

// Halaman Dashboard admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard_admin');
})->name('admin.dashboard')->middleware('admin'); // Contoh middleware khusus admin

// halaman kelola laporan admin
Route::get('/admin/kelola_laporan', function () {
    return view('admin.kelola_laporan');
})->name('admin.kelola.laporan')->middleware('admin');

// halaman cetak laporan admin
Route::get('/admin/cetak_laporan', function () {
    return view('admin.cetak_laporan');
})->name('admin.cetak')->middleware('admin');

// halaman detail laporan admin
Route::get('/admin/detail_laporan', function () {
    return view('admin.detail_laporan');
})->name('admin.detail')->middleware('admin');

// halaman kelola akun admin
Route::get('/admin/kelola_akun', function () {
    return view('admin.kelola_akun');
})->name('admin.kelola.akun')->middleware('admin');

// halaman panduan admin
Route::get('/admin/panduan_admin', function () {
    return view('admin.panduan_admin');
})->name('admin.panduan.admin')->middleware('admin');

// halaman logout admin
Route::post('/admin/logout', function () {
    Auth::logout();
    session()->forget('admin_logged_in'); // Hapus sesi admin
    return redirect('/admin/login');
})->name('admin.logout');
// Akhir Route Admin