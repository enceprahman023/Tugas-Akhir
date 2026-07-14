<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class DashboardGuruController extends Controller
{
    public function index()
    {
        // Cek apakah Guru BK sudah login (dari session)
        if (!session()->has('login_guru')) {
            return redirect()->route('guru.login')->withErrors([
                'message' => 'Silakan login terlebih dahulu sebagai Guru BK.',
            ]);
        }

        // Ambil jumlah laporan berdasarkan status
        $jumlahProses  = Laporan::where('status', 'Dalam Proses')->count();
        $jumlahSelesai = Laporan::where('status', 'Selesai')->count();
        $jumlahTolak   = Laporan::where('status', 'Ditolak')->count();

        return view('guru.dashboard', compact(
            'jumlahProses',
            'jumlahSelesai',
            'jumlahTolak'
        ));
    }
}
