<?php

namespace App\Http\Controllers;

use App\Models\Laporan; // <-- Pastikan ini ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Pastikan ini ada untuk Auth::id()
use Illuminate\Support\Facades\Storage; // <-- Pastikan ini ada untuk upload gambar
use App\Models\Pelapor;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\LaporanBaruMail;

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

        try {
            // 4. Simpan data laporan ke database
            $laporan = Laporan::create([
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

            // Kirim Notifikasi Email ke Guru BK & Admin
            try {
                $emailPenerima = User::whereIn('role', ['gurubk', 'guru', 'admin'])
                    ->whereNotNull('email')
                    ->pluck('email')
                    ->toArray();

                if (!empty($emailPenerima)) {
                    Mail::to($emailPenerima)->send(new LaporanBaruMail($laporan));
                }
            } catch (\Exception $e) {
                // Log error email, tapi jangan gagalkan submit laporan
                \Illuminate\Support\Facades\Log::error('Gagal mengirim email notifikasi: ' . $e->getMessage());
            }
            // 5. Redirect setelah sukses
            return redirect()->route('laporan.create')->with('success', 'Laporan berhasil dikirim!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal mengirim laporan: ' . $e->getMessage());
        }
    }
    /**
     * Menampilkan daftar semua laporan untuk Guru BK.
     * Ini adalah metode BARU.
     */
    public function guruKelola()
    {
        $laporans = Laporan::with('pelapor')->orderBy('created_at', 'desc')->get(); // Ambil semua laporan dengan relasi pelapor
        return view('guru.kelola_laporan', compact('laporans')); // Arahkan ke view Guru BK
    }

    /**
     * Menampilkan daftar semua laporan untuk Admin.
     * Ini adalah metode BARU.
     */
    public function adminKelola()
    {
        $laporans = Laporan::with('pelapor')->orderBy('created_at', 'desc')->get(); // Ambil semua laporan dengan relasi pelapor
        return view('admin.kelola_laporan', compact('laporans')); // Arahkan ke view Admin
    }

    /**
     * Menampilkan detail laporan berdasarkan ID.
     */
    public function show($id)
    {
        $laporan = Laporan::find($id);

        if ($laporan) {
            return view('pelapor.detail-laporan', compact('laporan'));
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
        $laporans = Laporan::with('pelapor')->whereIn('status', ['Selesai', 'Ditolak'])
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('pdf.laporan', compact('laporans'));
        return $pdf->download('Riwayat_Laporan_Selesai_DUCARE.pdf');
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
        $laporan->ditangani_oleh = $request->ditangani_oleh ?? (Auth::user()->name ?? 'Guru BK');

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

        $laporan = Laporan::with('pelapor')->findOrFail($id);

        // Validasi: pastikan catatan penanganan sudah ada sebelum update status
        if (empty($laporan->catatan_penanganan)) {
            return redirect()->back()->with('error', 'Isi catatan penanganan terlebih dahulu sebelum mengubah status.');
        }

        $laporan->status = $request->status;

        // Isi nama guru BK yang sedang login jika belum diisi
        if (empty($laporan->ditangani_oleh)) {
            $laporan->ditangani_oleh = Auth::user()->name ?? 'Guru BK';
        }

        $laporan->save();

        // Kirim Notifikasi Email ke Pelapor
        try {
            $pelaporEmail = $laporan->pelapor->email ?? null;

            if ($pelaporEmail) {
                Mail::to($pelaporEmail)->send(new \App\Mail\LaporanStatusMail($laporan));
            }
        } catch (\Exception $e) {
            // Log error email, tapi jangan gagalkan update status
            \Illuminate\Support\Facades\Log::error('Gagal mengirim email update status ke pelapor: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function cetakDetail($id)
    {
        $laporan = Laporan::with('pelapor')->findOrFail($id);
        $pdf = Pdf::loadView('pdf.detail-laporan', compact('laporan'));
        return $pdf->download('Detail_Laporan_' . $laporan->id . '.pdf');
    }
    public function status()
    {
        $user = Auth::user(); // Ambil user yang sedang login

        // Ambil laporan berdasarkan user_id pelapor ini
        $laporans = Laporan::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pelapor.status-laporan', compact('laporans'));
    }
}
