<?php

namespace App\Http\Controllers;

use App\Models\Laporan; // <-- Pastikan ini ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Pastikan ini ada untuk Auth::id()
use Illuminate\Support\Facades\Storage; // <-- Pastikan ini ada untuk upload gambar
use app\Models\Pelapor;

class LaporanController extends Controller

{
    /**
     * Menampilkan daftar semua laporan (mungkin untuk admin/guru BK).
     */
    
    public function index()
    {
        $laporans = Laporan::all();
        return view('status-laporan', compact('laporans'));
    }

    /**
     * Menampilkan form untuk membuat laporan baru.
     * Ini yang akan dipanggil ketika pelapor mengklik "Buat Laporan".
     */
    public function create()
    {
        // Akan merender view 'laporan.create' (file yang baru kamu buat)
        return view('pelapor.buat-laporan');
    }

    /**
     * Menyimpan laporan baru ke database setelah form disubmit.
     */
    public function store(Request $request)
    {
        // --- 1. Validasi Input ---
       $validatedData = $request->validate([
    'jenis_pelaporan' => 'required|in:anonim,non-anonim',
    'nama_pelapor' => 'nullable|string|max:255',
    'tanggal_kejadian' => 'required|date',
    'orang_membuli' => 'required|string|max:255',
    'judul' => 'required|string|max:255',
    'isi' => 'required|string',
    'saksi' => 'nullable|string|max:255',
    'bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
]);

$namaPelapor = $request->jenis_pelaporan === 'anonim'
        ? 'Anonim'
        : $validatedData['nama_pelapor'];

    // 3. Upload gambar (jika ada)
    $imagePath = null;
    if ($request->hasFile('bukti')) {
        $imagePath = $request->file('bukti')->store('bukti_laporan', 'public');
    }

    // 4. Simpan data laporan ke database
    Laporan::create([
        'user_id' => Auth::id(),
        'jenis_pelaporan' => $validatedData['jenis_pelaporan'],
        'nama_pelapor' => $namaPelapor,
        'tanggal_kejadian' => $validatedData['tanggal_kejadian'],
        'nama_pembully' => $validatedData['orang_membuli'],
        'judul_laporan' => $validatedData['judul'],
        'isi_laporan' => $validatedData['isi'],
        'nama_saksi' => $validatedData['saksi'],
        'bukti_gambar' => $imagePath,
    ]);

    // 5. Redirect setelah sukses
    return redirect()->route('laporan.create')->with('success', 'Laporan berhasil dikirim!');
}
/**
     * Menampilkan daftar semua laporan untuk Guru BK.
     * Ini adalah metode BARU.
     */
    public function guruKelola()
    {
        $laporans = Laporan::orderBy('created_at', 'desc')->get(); // Ambil semua laporan
        return view('guru.kelola_laporan', compact('laporans')); // Arahkan ke view Guru BK
    }

    /**
     * Menampilkan daftar semua laporan untuk Admin.
     * Ini adalah metode BARU.
     */
    public function adminKelola()
    {
        $laporans = Laporan::orderBy('created_at', 'desc')->get(); // Ambil semua laporan
        return view('admin.kelola_laporan', compact('laporans')); // Arahkan ke view Admin
    }
    
    /**
     * Menampilkan detail laporan berdasarkan ID.
     */
    public function show($id)
    {
        $laporan = Laporan::find($id);

        if ($laporan) {
            return view('detail-laporan', compact('laporan'));
        } else {
            return redirect()->route('status.laporan')->with('error', 'Laporan tidak ditemukan');
        }
    }

    /**
     * Menampilkan form untuk mengubah laporan berdasarkan ID.
     */
    public function edit($id)
    {
        $laporan = Laporan::find($id);

        if ($laporan) {
            return view('ubah-laporan', compact('laporan'));
        } else {
            return redirect()->route('status.laporan')->with('error', 'Laporan tidak ditemukan');
        }
    }

    // --- Anda akan perlu menambahkan metode update(Request $request, $id) di sini nanti
    // public function update(Request $request, $id)
    // {
    //     // Logika untuk update laporan
    // }

    /**
     * Menghapus laporan berdasarkan ID.
     */
    public function destroy($id)
    {
        $laporan = Laporan::find($id);

        if ($laporan) {
            // Opsional: Hapus juga file gambar jika ada
            if ($laporan->bukti_gambar) {
                Storage::disk('public')->delete($laporan->bukti_gambar);
            }
            $laporan->delete();
            return redirect()->route('status.laporan')->with('success', 'Laporan berhasil dihapus');
        } else {
            return redirect()->route('status.laporan')->with('error', 'Laporan tidak ditemukan');
        }
    }
}