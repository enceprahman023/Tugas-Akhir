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
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return back()->with('error', 'Anda bukan admin.');
            }
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('error', 'Anda telah logout.');
    }
}

