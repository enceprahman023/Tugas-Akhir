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
        $jumlahMasuk   = Laporan::where('status', 'masuk')->count();
        $jumlahProses  = Laporan::where('status', 'diproses')->count();
        $jumlahSelesai = Laporan::where('status', 'selesai')->count();
        $jumlahTolak   = Laporan::where('status', 'ditolak')->count();

        return view('guru.dashboard', compact(
            'jumlahMasuk',
            'jumlahProses',
            'jumlahSelesai',
            'jumlahTolak'
        ));
    }
}
