<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;

class GuruProfileController extends Controller
{
    /**
     * Menampilkan halaman profil Guru BK.
     */
    public function show()
{
    $guruId = session('guru_id');

    if (!$guruId) {
        return redirect()->route('guru.login')->withErrors([
            'message' => 'Silakan login terlebih dahulu.'
        ]);
    }

    $guru = \App\Models\Guru::find($guruId);
    return view('guru.profile_guru', compact('guru'));
}
}
