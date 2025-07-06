<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login_admin');
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate(); 

        $role = Auth::user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'guru') {
            return redirect()->route('guru.dashboard');
        } elseif ($role === 'pelapor') {
            return redirect()->route('pelapor.dashboard');
        } else {
            Auth::logout();
            return back()->with('error', 'Role tidak dikenali.');
        }
    }

    return back()->with('error', 'Email atau password salah.');
}
}

