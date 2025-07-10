<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;



class AdminController extends Controller
{
    public function dashboard()
    {
        $totalLaporan     = Laporan::count();
        $laporanSelesai   = Laporan::where('status', 'Selesai')->count();
        $laporanDitolak   = Laporan::where('status', 'Ditolak')->count();
        $laporanBelum     = Laporan::where('status', 'Belum Ditangani')->count();

    return view('admin.dashboard_admin', compact(
            'totalLaporan',
            'laporanSelesai',
            'laporanDitolak',
            'laporanBelum'
        ));
    }

    public function kelolaLaporan()
    {
        $laporans = \App\Models\Laporan::latest()->get();
        $laporans = Laporan::latest()->get();
        return view('admin.kelola_laporan', compact('laporans'));
    }

        public function cetakLaporan()
{
    $laporans = Laporan::latest()->get();
    return view('admin.cetak_laporan', compact('laporans'));
}

public function cetakDetail($id)
{
    $laporan = \App\Models\Laporan::findOrFail($id);
    return view('admin.detail_laporan', compact('laporan'));
}


public function kelolaAkun()
{
    $usersRaw = User::select('id', 'name', 'email', 'role', 'nis', 'nip', 'foto')->get();

    $users = [];

    foreach ($usersRaw as $user) {
        $users[] = [
            'id' => $user->id,
            'foto' => $user->foto,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'nis' => $user->nis,
            'nip' => $user->nip,
        ];
    }

    return view('admin.kelola_akun', compact('users'));
}

public function updateAkun(Request $request)
{
    Log::info('UPDATE:', $request->all());
    $request->validate([
        'id'    => 'required|exists:users,id',
        'name'  => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'role'  => 'required|in:Pelapor,Guru,Admin',
        'nis'   => 'nullable|string|max:20',
        'nip'   => 'nullable|string|max:20',
    ]);

    $user = \App\Models\User::findOrFail($request->id);
    $user->name  = $request->name;
    $user->email = $request->email;
    $user->role  = $request->role;
    $user->nis   = $request->nis;
    $user->nip   = $request->nip;
    $user->save();
    

    return redirect()->back()->with('success', 'Akun berhasil diperbarui.');
}

public function hapusAkun($id)
{
    $user = User::findOrFail($id);
    $nama = $user->name;
    $user->delete();

    return redirect()->back()->with('success', "Akun '$nama' berhasil dihapus.");
}
public function resetPassword(Request $request)
{
    $request->validate([
        'id' => 'required|exists:users,id',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $user = User::findOrFail($request->id);
    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->back()->with('success', 'Password berhasil direset.');
}
public function logout(Request $request)
{
    Auth::logout();  // ganti guard jika kamu pakai default
    $request->session()->invalidate();
    $request->session()->regenerateToken();

   return redirect()->route('admin.login'); // arahkan ke halaman login admin
}

}
