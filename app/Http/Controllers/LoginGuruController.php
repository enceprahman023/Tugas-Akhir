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

        // Cek apakah NIP dan password sesuai (data dummy)
        $dummyNip = '12345678';
        $dummyPassword = 'password123';

        if ($request->nip === $dummyNip && $request->password === $dummyPassword) {
            // Simpan status login guru ke session
            session(['login_guru' => true]);

            // Redirect ke dashboard guru
            return redirect('/guru/dashboard');
        }

        // Jika login gagal, kembali dengan pesan error
        return back()->withErrors([
            'nip' => 'NIP atau password salah.',
        ]);
    }

    // Menangani logout guru
    public function logout(Request $request)
    {
        // Hapus session login guru
        $request->session()->forget('login_guru');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login guru BK
        return redirect('/login-guru');
    }
}
