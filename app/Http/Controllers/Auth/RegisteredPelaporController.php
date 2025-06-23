<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pelapor;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredPelaporController extends Controller
{
    public function create(): View
    {
        // Pastikan view yang dipanggil sesuai dengan lokasi file register.blade.php Anda
        // Jika file register.blade.php ada di resources/views/pelapor/, gunakan:
        return view('pelapor.register');
        // Jika file register.blade.php ada di resources/views/auth/, gunakan:
        // return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        //   dd($request->all());
        // Hapus atau tetap comment ini agar proses registrasi berjalan.
        // dd($request->all());

        $request->validate([
            'nis' => ['required', 'string', 'max:255', 'unique:pelapor,nis'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:pelapor,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $pelapor = Pelapor::create([
            'nis' => $request->nis,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($pelapor));

        Auth::login($pelapor);

       return redirect()->route('pelapor.register')->with('register_success', true);

    }
}