<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Laporan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
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
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user(); // ⛳ pastikan kamu menggunakan model User atau Pelapor sesuai config/auth.php

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak cocok.']);
        }

        $user->password = Hash::make($request->new_password);

        return redirect()->route('pelapor.password')->with('success', 'Password berhasil diperbarui.');
    }
}
