<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardGuruController extends Controller
{
    public function index()
    {
        // Cek apakah Guru BK sudah login (dari session)
        if (!session()->has('login_guru')) {
            return redirect()->route('guru.login')->withErrors([
                'message' => 'Silakan login terlebih dahulu sebagai Guru BK.',
            ]);
        }

       return view('guru.dashboard');
    }
}
