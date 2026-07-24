<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class GuruProfileController extends Controller
{
    /**
     * Tampilkan profil Guru BK
     */
    public function show()
    {
        $guru = auth()->user();

        if (!$guru) {
            return redirect()->route('guru.login');
        }

        return view('guru.profile_guru', compact('guru'));
    }

    /**
     * Update data profil Guru BK (nama, email, NIP, phone_number, foto)
     */
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $guru */
        $guru = auth()->user();

        if (!$guru) {
            return redirect()->route('guru.login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $guru->id,
            'nip' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $guru->name = $request->name;
        $guru->email = $request->email;
        $guru->nip = $request->nip;
        $guru->phone_number = $request->phone_number;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            Storage::disk('public')->putFileAs('foto_profil', $file, $filename);

            // Hapus foto lama jika ada
            if ($guru->foto && Storage::disk('public')->exists('foto_profil/' . $guru->foto)) {
                Storage::disk('public')->delete('foto_profil/' . $guru->foto);
            }

            $guru->foto = $filename;
        }

        $guru->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Update password Guru BK
     */
    public function updatePassword(Request $request)
    {
        /** @var \App\Models\User $guru */
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
