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
         'status' => 'Dalam Proses',
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

    public function cetakLaporan()
{
    $laporans = Laporan::whereIn('status', ['Selesai', 'Ditolak'])
                        ->orderBy('created_at', 'desc')
                        ->get();

    return view('guru.cetak_laporan', compact('laporans'));
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
    /**
 * Memperbarui catatan penanganan dan status laporan oleh Guru BK.
 */
public function updatePenanganan(Request $request, $id)
{
    $request->validate([
        'catatan_penanganan' => 'required|string|max:1000',
        'tanggal_penanganan' => 'required|date',
        'ttd' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $laporan = Laporan::findOrFail($id);

    $laporan->catatan_penanganan = $request->catatan_penanganan;
    $laporan->tanggal_penanganan = $request->tanggal_penanganan;

    // simpan nama guru dari input form
    $laporan->ditangani_oleh = $request->ditangani_oleh ?? (session('login_guru')['nama'] ?? 'Guru BK');

    // cek jika ada file ttd diupload
    if ($request->hasFile('ttd')) {
        $path = $request->file('ttd')->store('ttd', 'public');
        $laporan->ttd_penangan = $path;
    }

    $laporan->save();

    return redirect()->back()->with('success', 'Catatan penanganan berhasil disimpan.');
}


    /**
 * Memperbarui status laporan (Selesai atau Ditolak)
 */
public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Selesai,Ditolak',
    ]);

    $laporan = Laporan::findOrFail($id);

    // Validasi: pastikan catatan penanganan sudah ada sebelum update status
    if (empty($laporan->catatan_penanganan)) {
        return redirect()->back()->with('error', 'Isi catatan penanganan terlebih dahulu sebelum mengubah status.');
    }

    $laporan->status = $request->status;

    // Isi nama guru BK yang sedang login (jika pakai Auth user biasa atau guard khusus guru)
  $laporan->ditangani_oleh = session('login_guru')['nama'] ?? 'Guru BK';

    $laporan->save();

    return redirect()->back()->with('success', 'Status laporan berhasil diperbarui.');
}

public function cetakDetail($id)
{
    $laporan = Laporan::findOrFail($id);
    return view('guru.detail_laporan', compact('laporan'));
}

}