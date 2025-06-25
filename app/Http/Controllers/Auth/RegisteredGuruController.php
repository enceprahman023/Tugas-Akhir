<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RegisteredGuruController extends Controller
{
    public function create(): View
    {
        return view('guru.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'max:100', 'unique:users,nip'],
            'phone_number' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'nip' => $request->nip,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'gurubk',
            ]);

            event(new Registered($user));
            Auth::login($user);

            DB::commit();

            return redirect()->route('guru.dashboard')->with('success', 'Akun Guru BK berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->withErrors([
                'db_error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
            ]);
        }
    }
}
