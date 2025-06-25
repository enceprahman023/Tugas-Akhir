<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Gunakan model User karena Guru BK disimpan di tabel users
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
            // jangan log password asli di production
            
        ]);

        // Cari user dengan role gurubk
        $user = User::where('email', $request->email)
                    ->where('role', 'gurubk')
                    ->first();
        if (!$user) {
            Log::warning('Login gagal: email tidak ditemukan di tabel users untuk role gurubk.');
            return back()->withErrors([
                'email' => 'Akun Guru BK tidak ditemukan.',
            ])->onlyInput('email');
        }

        // Cek apakah password cocok
        if (!Hash::check($request->password, $user->password)) {
            Log::warning('Login gagal: password salah untuk email ' . $request->email);
            return back()->withErrors([
                'password' => 'Password salah.',
            ])->onlyInput('email');
        }

        // Login berhasil
        Auth::login($user);
        session(['login_guru' => $user->id]);
        $request->session()->regenerate();

        Log::info('Login BERHASIL untuk Guru BK: ' . $request->email);

        return redirect()->route('guru.dashboard');
    }

    // Logout Guru BK
    public function logout(Request $request)
    {
        session()->forget('login_guru');
        Auth::logout(); // tidak perlu pakai guard karena kita pakai default login

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login-guru');
    }
}
