<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Guru; 
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse; // Pastikan ini ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB; 
use Illuminate\View\View; // Pastikan ini ada

class RegisteredGuruController extends Controller
{
    /**
     * Menampilkan tampilan registrasi Guru BK.
     */
    public function create(): View
    {
        // Pastikan ini mengarah ke view form registrasi Guru BK Anda.
        // Jika file 'register guru.blade.php' ada di 'resources/views/auth/',
        // Anda mungkin perlu mengganti nama file menjadi 'register-guru.blade.php'
        // dan memanggilnya dengan 'auth.register-guru'.
        // Atau jika letaknya langsung di 'resources/views/', panggil 'register guru'.
        return view('guru.register'); // Sesuaikan dengan path sebenarnya
    }

    /**
     * Menangani permintaan registrasi Guru BK yang masuk.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse 
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'max:255', 'unique:gurus'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:gurus'],
            'phone_number' => ['nullable', 'string', 'max:20'], // Pastikan ini 'phone_number'
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        // dd($request->all());
        
        DB::beginTransaction();

        try {
            $guru = Guru::create([
                'name' => $request->name,
                'nip' => $request->nip,
                'email' => $request->email,
                'phone_number' => $request->phone_number, // Pastikan ini 'phone_number'
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($guru));

            Auth::guard('guru')->login($guru);

            DB::commit();

            return redirect()->route('guru.register')->with('success', 'Akun Guru BK berhasil dibuat dan Anda telah login!');

        } catch (\Exception $e) {
            DB::rollBack();
            // PENTING: Pastikan tidak ada dd() atau die() di sini.
            // Baris di bawah ini SUDAH mengembalikan RedirectResponse.
            return back()->withInput()->withErrors([
            'db_error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
        ]);
        }
    }
}