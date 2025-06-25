<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class GuruProfileController extends Controller
{
    /**
     * Menampilkan halaman profil Guru BK.
     */
    public function show()
    {
        // ✅ Pakai session yang benar
        $guruId = session('login_guru');

        if (!$guruId) {
            return redirect()->route('guru.login')->withErrors([
                'message' => 'Silakan login terlebih dahulu.'
            ]);
        }

        // ✅ Ambil dari model User, bukan Guru
        $guru = User::find($guruId);

        return view('guru.profile_guru', compact('guru'));
    }
}
