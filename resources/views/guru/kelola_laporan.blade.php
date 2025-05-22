@extends('layouts.main')

@section('title', 'Kelola Laporan')

@section('content')
<div class="d-flex vh-100">
    <!-- Sidebar -->
    <aside class="sidebar bg-primary text-white p-3 pt-5">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logodu.png') }}" alt="Logo" class="logo mb-2" style="width: 60px;">
            <h5 class="fw-bold">DUCARE</h5>
        </div>
        <nav class="nav flex-column">
            <a href="{{ route('guru.dashboard') }}" class="nav-link text-white">🏠 Dashboard</a>
            <a href="{{ route('guru.kelola') }}" class="nav-link text-white">📋 Kelola Laporan</a>
            <a href="#" class="nav-link text-white">🖨️ Cetak Laporan</a>
            <a href="#" class="nav-link text-white">📖 Panduan</a>
            <a href="#" class="nav-link text-white">🚪 Logout</a>
        </nav>
    </aside>

    <!-- Konten Utama -->
    <main class="flex-grow-1 px-4 pt-5 pb-4 bg-light">
        <h3 class="mb-4">Kelola Laporan</h3>

        <!-- Tabel Laporan -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No. Laporan</th>
                        <th>Judul Laporan</th>
                        <th>Status</th>
                        <th>Tanggal Laporan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>LAP-001</td>
                        <td>Laporan Bullying di Kelas 10</td>
                        <td><span class="badge bg-warning">Dalam Proses</span></td>
                        <td>2025-05-03</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal-001">Lihat Detail</button>
                        </td>
                    </tr>
                    <tr>
                        <td>LAP-002</td>
                        <td>Laporan Penganiayaan oleh Senior</td>
                        <td><span class="badge bg-success">Selesai</span></td>
                        <td>2025-05-02</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal-002">Lihat Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

      <!-- Modal Detail Laporan LAP-001 (Non-Anonim) -->
<div class="modal fade" id="detailModal-001" tabindex="-1" aria-labelledby="detailModalLabel001" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel001">Detail Laporan LAP-001</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>Judul Laporan</th>
                            <td>Laporan Bullying di Kelas 10</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><span class="badge bg-warning">Dalam Proses</span></td>
                        </tr>
                        <tr>
                            <th>Tanggal Laporan</th>
                            <td>2025-05-03</td>
                        </tr>
                        <tr>
                            <th>Pelaku</th>
                            <td>Siswa A</td>
                        </tr>
                        <tr>
                            <th>Pelapor</th>
                            <td>Rina Putri</td>
                        </tr>
                        <tr>
                            <th>Saksi</th>
                            <td>Siswa B, Siswa C</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>Laporan mengenai bullying yang terjadi di kelas 10. Siswa yang terlibat sudah teridentifikasi dan tindakan telah diambil oleh pihak sekolah.</td>
                        </tr>
                        <tr>
                            <th>Bukti Foto</th>
                            <td><img src="{{ asset('images/bukti_dummy.jpg') }}" alt="Bukti Foto" class="img-fluid" style="max-height: 250px;"></td>
                        </tr>
                    </tbody>
                </table>
                <!-- Catatan Penanganan -->
<div class="mt-4">
    <h6>Catatan Penanganan</h6>
    <form>
        <div class="mb-3">
            <textarea class="form-control" rows="3" placeholder="Tulis catatan penanganan..."></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Penanganan</label>
            <input type="date" class="form-control">
        </div>
        <button type="button" class="btn btn-primary">Simpan Catatan</button>
    </form>
</div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger">Hapus</button>
                <button class="btn btn-success">Selesaikan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Laporan LAP-002 (Anonim) -->
<div class="modal fade" id="detailModal-002" tabindex="-1" aria-labelledby="detailModalLabel002" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel002">Detail Laporan LAP-002</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>Judul Laporan</th>
                            <td>Laporan Penganiayaan oleh Senior</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><span class="badge bg-success">Selesai</span></td>
                        </tr>
                        <tr>
                            <th>Tanggal Laporan</th>
                            <td>2025-05-02</td>
                        </tr>
                        <tr>
                            <th>Pelaku</th>
                            <td>Siswa X</td>
                        </tr>
                        <tr>
                            <th>Pelapor</th>
                            <td><em>Laporan ini dikirim secara anonim</em></td>
                        </tr>
                        <tr>
                            <th>Saksi</th>
                            <td>Tidak disebutkan</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>Laporan anonim mengenai tindakan penganiayaan oleh siswa senior kepada junior saat kegiatan ekstrakurikuler.</td>
                        </tr>
                        <tr>
                            <th>Bukti Foto</th>
                            <td><img src="{{ asset('images/bukti_dummy2.jpg') }}" alt="Bukti Foto" class="img-fluid" style="max-height: 250px;"></td>
                        </tr>
                    </tbody>
                </table>
                <!-- Catatan Penanganan -->
<div class="mt-4">
    <h6>Catatan Penanganan</h6>
    <form>
        <div class="mb-3">
            <textarea class="form-control" rows="3" placeholder="Tulis catatan penanganan..."></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Penanganan</label>
            <input type="date" class="form-control">
        </div>
        <button type="button" class="btn btn-primary">Simpan Catatan</button>
    </form>
</div>
            </div>
           <div class="modal-footer">
            <button class="btn btn-danger">Hapus</button>
         <button class="btn btn-success">Selesaikan</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
</div>
        </div>
    </div>
</div>
</main>
</div>
@endsection
