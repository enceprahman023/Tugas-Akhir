<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru; // Pastikan model Guru ada dan benar
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Impor facade Auth
use Illuminate\Support\Facades\Log;  // Untuk logging

class LoginGuruController extends Controller
{
    // Menampilkan halaman login Guru BK
    public function showLoginForm()
    {
        return view('guru.login_guru');
    }

    // Menangani proses login Guru BK
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Log input dari user
        Log::info('Coba login dengan:', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Cek apakah email ditemukan di database
        $guru = Guru::where('email', $request->email)->first();

        if (!$guru) {
            Log::warning('Login gagal: email tidak ditemukan di tabel gurus.');
        } else {
            Log::info('Data Guru ditemukan:', [
                'email' => $guru->email,
                'password_hash' => $guru->password,
            ]);

            Log::info('Password cocok?', [
                'result' => Hash::check($request->password, $guru->password)
            ]);
        }

        // Coba autentikasi menggunakan guard 'guru'
        if (Auth::guard('guru')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            Log::info('Login BERHASIL untuk: ' . $request->email);
            return redirect()->route('guru.dashboard');
        }

        // Login gagal
        Log::error('Login GAGAL untuk: ' . $request->email);

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Logout Guru BK
    public function logout(Request $request)
    {
        Auth::guard('guru')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login-guru');
    }
}
