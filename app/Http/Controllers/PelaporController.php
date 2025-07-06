<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class PelaporController extends Controller
{
    public function dashboard(Request $request)
    {
        $pelapor = session('login_pelapor');

        if (!$pelapor) {
            return redirect()->route('login')->withErrors(['email' => 'Silakan login terlebih dahulu.']);
        }

        // Mengambil laporan berdasarkan NIS
        $jumlahLaporan = Laporan::where('nis', $pelapor['nis'])->count();

        $statusTerakhir = Laporan::where('nis', $pelapor['nis'])
                                  ->latest()
                                  ->first();

        $notifikasi = Laporan::where('nis', $pelapor['nis'])
                             ->whereIn('status', ['Selesai', 'Ditolak', 'Dalam Proses'])
                             ->orderBy('updated_at', 'desc')
                             ->take(3)
                             ->get();

        return view('pelapor.dashboard', compact('jumlahLaporan', 'statusTerakhir', 'notifikasi'));
    }
}
