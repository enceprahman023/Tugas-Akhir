<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginGuruController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('guru.login_guru');
    }

    // Menangani proses login
    public function login(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'nip' => 'required',
        'password' => 'required',
    ]);

    // Cek apakah NIP dan password sesuai
    if (auth()->guard('web')->attempt(['nip' => $request->nip, 'password' => $request->password], $request->remember)) {
        // Jika berhasil login, redirect ke halaman dashboard atau halaman yang diinginkan
        return redirect()->intended('/dashboard');
    }

    // Jika login gagal, kembali dengan pesan error
    return back()->withErrors([
        'nip' => 'NIP atau password salah.',
    ]);
}
}
