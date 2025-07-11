<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Laporan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
class ProfileController extends Controller
{
    /**
     * Tampilkan form edit profil user.
     */
    public function show(Request $request): View
    
    {
        
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update data profil user.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Simpan field umum yang divalidasi (name, email, nis)
        $user->fill($request->validated());

        // ✅ Jika ada foto diupload, simpan ke folder "aneh"
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Simpan ke folder yang dibuat otomatis oleh Laravel
            Storage::disk('public')->putFileAs('foto_profil', $file, $filename);

    // Simpan ke database
    $user->foto = $filename;
        }

        // Reset verifikasi jika email berubah
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()->route('profile.laporan')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Hapus akun user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * ✅ Tampilkan semua laporan milik pelapor yang sedang login.
     */
    public function laporan(): View
    {
        $user = Auth::user();
        $laporans = Laporan::where('user_id', $user->nis)->get();

        return view('pelapor.profile-laporan', compact('laporans', 'user'));
    }

    // Tampilkan form edit
    public function edit(): View
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * ✅ Tampilkan form ganti password.
     */
    public function formGantiPassword(): RedirectResponse
    {
        return back();
    }

    /**
     * ✅ Proses update password user.
     */
    public function updatePassword(Request $request)
    
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    // Ambil user dari session pelapor
    $user = \App\Models\User::where('nis', session('login_pelapor'))->first();
    
    if (!$user) {
        return back()->withErrors(['current_password' => 'Akun tidak ditemukan.']);
    }

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Password lama tidak cocok.']);
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->route('profile.laporan')->with('success', 'Password berhasil diperbarui.');
}


}
