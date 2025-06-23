<?php

namespace App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelapor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nis' => ['required', 'string', 'max:255', 'unique:pelapor'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pelapor'],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ]);

        $pelapor = Pelapor::create([
            'nis' => $request->nis,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($pelapor));
        Auth::login($pelapor);

        return redirect()->route('login');
    }
}
