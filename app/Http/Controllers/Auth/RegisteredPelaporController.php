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
use Illuminate\View\View;

class RegisteredPelaporController extends Controller
{
    public function create(): View
    {
        return view('pelapor.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nis' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
            ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'nis' => $request->nis,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'pelapor',
            ]);

            return redirect()->route('pelapor.register')->with('register_success', true);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal mendaftar: ' . $e->getMessage());
        }
    }
}
