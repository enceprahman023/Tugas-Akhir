<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginPelaporController extends Controller
{
    public function create()
    {
        return view('pelapor.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

            // Arahkan sesuai role
            if ($role === 'pelapor') {
                return redirect()->route('pelapor.dashboard');
            } elseif ($role === 'guru') {
                return redirect()->route('guru.dashboard');
            } elseif ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Kalau role tidak dikenal, logout dan tolak
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Role tidak dikenali.']);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
}
