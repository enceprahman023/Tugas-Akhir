<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class GuruProfileController extends Controller
{
    public function show()
    {
        $guru = auth()->user();

        if (!$guru) {
            return redirect()->route('guru.login');
        }

        return view('guru.profile_guru', compact('guru'));
    }

public function updatePassword(Request $request)
{
    $guru = auth()->user();

    if (!$guru) {
        return redirect()->route('guru.login');
    }

    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed'
    ]);

    // Cek password lama
    if (!Hash::check($request->current_password, $guru->password)) {
        return back()->withErrors([
            'current_password' => 'Password lama tidak sesuai.'
        ]);
    }

    // Update password
    $guru->password = Hash::make($request->new_password);
    $guru->save();

    return back()->with('success', 'Password berhasil diperbarui.');
}
}
