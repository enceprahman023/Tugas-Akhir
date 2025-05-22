<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginGuruController;
use App\Http\Controllers\DashboardGuruController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;

// Halaman home
Route::get('/', [HomeController::class, 'index'])->name('home');

// halaman profil
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::get('/profile/laporan', [ProfileController::class, 'laporan'])->name('profile.laporan');

// route halaman logout pelapor
Route::get('/login-guru', [LoginGuruController::class, 'showLoginForm'])->name('guru.login');
Route::post('/login-guru', [LoginGuruController::class, 'login'])->name('guru.login.submit');
Route::post('/logout-guru', [LoginGuruController::class, 'logout'])->name('guru.logout');


// Halaman register
Route::get('/register', function () {
    return view('pelapor.register');
})->name('register');

// Proses register
Route::post('/register', function (Request $request) {
    return redirect()->route('login')->with('success', 'Berhasil daftar!');
})->name('register.store');

// Halaman login
Route::get('/login', function () {
    return view('pelapor.login');
})->name('login');

// halaman login guru bk
Route::get('/login-guru', [LoginGuruController::class, 'showLoginForm'])->name('guru.login');
Route::post('/login-guru', [LoginGuruController::class, 'login'])->name('guru.login.store');

// halaman dashboard guru_bk
Route::get('/guru/dashboard', [DashboardGuruController::class, 'index'])->name('guru.dashboard');


// Proses login (langsung redirect ke dashboard tanpa cek database)
Route::post('/login', function () {
    return redirect()->route('dashboard');
})->name('login.store');

// Halaman About
Route::get('/about-bullying', function () {
    return view('pelapor.about-bullying');
})->name('about.bullying');

// Halaman Dashboard Pelapor
Route::get('/dashboard', function () {
    return view('pelapor.dashboard'); // Ganti dengan nama file Blade dashboard kamu
})->name('dashboard');

// login to dashboard pelapor
Route::post('/login', function (Request $request) {
    session(['is_logged_in' => true]); // Simulasi login
    return redirect()->route('dashboard');
})->name('login.store');

// buat laporan pelapor
Route::get('/buat-laporan', function () {
    return view('pelapor.buat-laporan');
})->name('buat.laporan');

// status laporan pelapor
Route::get('/status-laporan', function () {
    return view('pelapor.status-laporan');
})->name('status.laporan');

// detail laporan pelapor
Route::get('/detail-laporan', function () {
    return view('pelapor.detail-laporan');
})->name('detail.laporan');

// buat laporan pelapor
Route::get('/ubah-laporan', function () {
    return view('pelapor.ubah-laporan');
})->name('ubah.laporan');

// halaman panduan
Route::get('/panduan-laporan', function () {
    return view('pelapor.panduan-laporan');
})->name('panduan.laporan');

// halaman profile
Route::get('/profile-laporan', function () {
    return view('pelapor.profile-laporan');
})->name('profile.laporan');

// halaman logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Arahkan ke halaman utama
})->name('logout');

// Route Akhir Pelapor

// halaman guru BK
// MENAMPILKAN FORM REGISTER (GET)
Route::get('/guru/register', function () {
    return view('guru.register');
})->name('guru.register');

// MEMPROSES FORM REGISTER (POST)
// MENAMPILKAN FORM REGISTER (GET)
Route::get('/guru/register', function () {
    return view('guru.register');
})->name('guru.register');

// MEMPROSES FORM REGISTER (POST)
Route::post('/guru/register', function (Request $request) {
    // Validasi inputan
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'nip' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'kontak' => 'nullable|string|max:15',
        'password' => 'required|min:6|confirmed',
    ]);

    // Simulasi simpan data, Anda dapat menambahkan logika penyimpanan ke database di sini
    // User::create([...]);

    return redirect()->route('guru.login')->with('success', 'Registrasi berhasil!');
})->name('guru.register.store');

Route::get('/guru/dashboard', function () {
    return view('guru.dashboard'); // ganti dengan nama file blade dashboard kamu
})->name('guru.dashboard');

// Route untuk halaman Kelola Laporan
Route::get('/guru/kelola-laporan', function () {
    return view('guru.kelola_laporan'); // Sesuaikan dengan lokasi dan nama file blade-nya
})->name('guru.kelola');

// Route untuk halaman Cetak Laporan
Route::get('/guru/cetak-laporan', function () {
    return view('guru.cetak_laporan'); // Sesuaikan dengan lokasi dan nama file blade-nya
})->name('guru.cetak');

// Halaman detail cetak detail laporan
Route::get('/guru/detail-laporan', function () {
    return view('guru.detail_laporan'); // menampilkan detail 1 laporan
})->name('guru.cetak.detail');

// halaman panduan guru
Route::get('/guru/panduan', function () {
    return view('guru.panduan-guru'); 
})->name('guru.panduan');

// halaman profile guruBK
Route::get('/guru/profile', function () {
    return view('guru.profile_guru');
})->name('guru.profile');

//  Akhir Untuk halaman guruBK

// Awal Untuk halaman admin
// Menampilkan halaman login admin
// Tampilkan form login admin
Route::GET('/admin/login', function () {
    return view('admin.login_admin');
})->name('admin.login');

Route::post('/admin/login', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');

    // Hardcode admin
    if ($username === 'admin' && $password === 'admin123') {
        session(['admin_logged_in' => true]);
        return redirect('/admin/dashboard');
    }
    return redirect()->back()->with('error', 'Username atau password salah!');
})->name('admin.login.store');

// Halaman Dashboard admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard_admin');
})->name('admin.dashboard');

// halaman kelola laporan
Route::get('/admin/kelola_laporan', function () {
    return view('admin.kelola_laporan');
})->name('admin.kelola.laporan');

// halaman cetak laporan admin
Route::get('/admin/cetak_laporan', function () {
    return view('admin.cetak_laporan');
})->name('admin.cetak');

// halaman detail laporan admin
Route::get('/admin/detail_laporan', function () {
    return view('admin.detail_laporan');
})->name('admin.detail');

// halaman kelola akun admin
Route::get('/admin/kelola_akun', function () {
    return view('admin.kelola_akun');
})->name('admin.kelola.akun');

// halaman panduan admin
Route::get('/admin/panduan_admin', function () {
    return view('admin.panduan_admin');
})->name('admin.panduan.admin');

// halaman logout admin
Route::post('/admin/logout', function () {
    Auth::logout();
    return redirect('/login'); // atau ke halaman login admin kamu
})->name('admin.logout');
