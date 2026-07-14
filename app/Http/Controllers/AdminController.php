<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;



class AdminController extends Controller
{
    public function dashboard()
    {
        $totalLaporan     = Laporan::count();
        $laporanSelesai   = Laporan::where('status', 'Selesai')->count();
        $laporanDitolak   = Laporan::where('status', 'Ditolak')->count();
        $laporanBelum     = Laporan::where('status', 'Dalam Proses')->count();
        $totalUser        = User::where('role', 'pelapor')->count();
        $totalGuru        = User::where('role', 'gurubk')->count();

    return view('admin.dashboard_admin', compact(
            'totalLaporan',
            'laporanSelesai',
            'laporanDitolak',
            'laporanBelum',
            'totalUser',
            'totalGuru'
        ));
    }

    public function kelolaLaporan()
    {
        $laporans = Laporan::with('pelapor')->latest()->get();
        return view('admin.kelola_laporan', compact('laporans'));
    }

public function cetakLaporan()
{
    $laporans = Laporan::with('pelapor')->latest()->get();
    return view('admin.cetak_laporan', compact('laporans'));
}

public function cetakDetail($id)
{
    $laporan = Laporan::with('pelapor')->findOrFail($id);
    $pdf = Pdf::loadView('pdf.detail-laporan', compact('laporan'));
    return $pdf->download('Detail_Laporan_'.$laporan->id.'.pdf');
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
        'foto'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $user = \App\Models\User::findOrFail($request->id);
    $user->name  = $request->name;
    $user->email = $request->email;
    
    // Map input role ke value enum database yang sesuai (lowercase / gurubk)
    $roleMap = [
        'Pelapor' => 'pelapor',
        'Guru'    => 'gurubk',
        'Admin'   => 'admin',
    ];
    $user->role  = $roleMap[$request->role] ?? 'pelapor';

    // Unggah foto baru jika ada
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        \Illuminate\Support\Facades\Storage::disk('public')->putFileAs('foto_profil', $file, $filename);

        // Hapus foto lama jika ada
        if ($user->foto && \Illuminate\Support\Facades\Storage::disk('public')->exists('foto_profil/' . $user->foto)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete('foto_profil/' . $user->foto);
        }

        $user->foto = $filename;
    }

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
