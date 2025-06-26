<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class GuruController extends Controller
{
    // Halaman cetak semua laporan
    public function cetakLaporan()
    {
        // Ambil semua laporan yang sudah diproses (ada status)
        $laporans = Laporan::whereNotNull('status')->get();

        return view('guru.cetak_laporan', compact('laporans'));
    }

    // Halaman cetak detail per laporan
    public function cetakDetail($id)
    {
        // Ambil satu laporan berdasarkan ID
        $laporan = Laporan::findOrFail($id);

        return view('guru.cetak_detail', compact('laporan'));
    }
}
