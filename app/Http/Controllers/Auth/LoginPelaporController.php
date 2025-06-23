<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginPelaporController extends Controller
{
    public function create()
    {
        // Tampilkan halaman login pelapor
        return view('pelapor.login');
    }

    public function store(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'nis' => 'required',
            'password' => 'required',
        ]);

        // Coba login
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard'); // Sesuaikan tujuan setelah login
        }

        return back()->withErrors([
            'nis' => 'NIS atau password salah.',
        ]);
    }
}
