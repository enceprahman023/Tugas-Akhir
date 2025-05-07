<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::all();
        return view('status-laporan', compact('laporans'));
    }

    public function show($id)
    {
        $laporan = Laporan::find($id);

        if ($laporan) {
            return view('detail-laporan', compact('laporan'));
        } else {
            return redirect()->route('status.laporan')->with('error', 'Laporan tidak ditemukan');
        }
    }

    public function edit($id)
    {
        $laporan = Laporan::find($id);

        if ($laporan) {
            return view('ubah-laporan', compact('laporan'));
        } else {
            return redirect()->route('status.laporan')->with('error', 'Laporan tidak ditemukan');
        }
    }

    public function destroy($id)
    {
        $laporan = Laporan::find($id);

        if ($laporan) {
            $laporan->delete();
            return redirect()->route('status.laporan')->with('success', 'Laporan berhasil dihapus');
        } else {
            return redirect()->route('status.laporan')->with('error', 'Laporan tidak ditemukan');
        }
    }
}
