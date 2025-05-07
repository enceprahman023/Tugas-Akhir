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
            <a href="#" class="nav-link text-white">🏠 Dashboard</a>
            <a href="#" class="nav-link text-white">📋 Kelola Laporan</a>
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
                    <!-- Tambahkan baris lainnya sesuai laporan yang masuk -->
                </tbody>
            </table>
        </div>

        <!-- Modal Detail Laporan -->
        <div class="modal fade" id="detailModal-001" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Laporan LAP-001</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Judul Laporan: Laporan Bullying di Kelas 10</h6>
                        <p><strong>Status:</strong> Dalam Proses</p>
                        <p><strong>Tanggal Laporan:</strong> 2025-05-03</p>
                        <p><strong>Deskripsi:</strong> Laporan mengenai bullying yang terjadi di kelas 10. Siswa yang terlibat sudah teridentifikasi.</p>
                        <!-- Tambahkan detail lainnya yang relevan -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>
@endsection
