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

        // 🔴 BAGIAN PENTING DI SINI
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::guard('web')->user();

            if ($user && $user->role === 'pelapor') {
                return redirect()->route('pelapor.dashboard');
            }

            Auth::guard('web')->logout();
            return redirect()->route('login')
                ->withErrors(['email' => 'Akun ini bukan akun pelapor.']);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
}
