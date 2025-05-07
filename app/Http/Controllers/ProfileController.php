<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        // Menampilkan halaman profil
        return view('profile.show');
    }

    public function laporan()
    {
        // Menampilkan halaman laporan
        return view('profile.laporan');
    }
}
