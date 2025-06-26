<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Guru BK disimpan di tabel users
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

        // Logging aman untuk development
        Log::info('Coba login Guru BK dengan email: ' . $request->email);

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

            //auth untuk login 
          Auth::login($user);
        // Login berhasil → Simpan session login khusus guru
        session([
            'login_guru' => true,
            'guru_id' => $user->id,
        ]);
        $request->session()->regenerate();

        Log::info('Login BERHASIL untuk Guru BK: ' . $request->email);

        return redirect()->route('guru.dashboard');
    }

    // Logout Guru BK
    public function logout(Request $request)
    {
        session()->forget(['login_guru', 'guru_id']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('guru.login');
    }
}
 