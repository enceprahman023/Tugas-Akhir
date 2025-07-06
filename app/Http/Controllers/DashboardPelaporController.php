<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Laporan;

class DashboardPelaporController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user(); // Ambil user yang login sekarang

        // Cek apakah sudah login dan role-nya pelapor
        if (!$user || $user->role !== 'pelapor') {
            return redirect()->route('login')->withErrors(['email' => 'Silakan login sebagai pelapor.']);
        }

        // Ambil jumlah laporan
        $jumlahLaporan = Laporan::where('user_id', $user->id)->count();

        // Ambil status laporan terakhir
        $statusTerakhir = Laporan::where('user_id', $user->id)
                                  ->latest()
                                  ->first();

        // Ambil 3 notifikasi laporan terbaru dengan status tertentu
        $notifikasi = Laporan::where('user_id', $user->id)
                             ->whereIn('status', ['Selesai', 'Ditolak', 'Dalam Proses'])
                             ->orderBy('updated_at', 'desc')
                             ->take(3)
                             ->get();

        return view('pelapor.dashboard', compact('jumlahLaporan', 'statusTerakhir', 'notifikasi'));
    }
}
