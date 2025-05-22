@extends('layouts.main')

@section('title', 'Detail Cetak Laporan')

@section('content')
<div class="d-flex" style="min-height: 100vh;">
    <!-- Sidebar -->
    <aside class="sidebar bg-primary text-white p-3 pt-5" style="width: 250px;">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logodu.png') }}" alt="Logo" class="logo mb-2" style="width: 60px;">
            <h5 class="fw-bold">DUCARE</h5>
        </div>
        <nav class="nav flex-column">
            <a href="{{ route('guru.dashboard') }}" class="nav-link text-white">🏠 Dashboard</a>
            <a href="{{ route('guru.kelola') }}" class="nav-link text-white">📋 Kelola Laporan</a>
            <a href="{{ route('guru.cetak') }}" class="nav-link text-white active bg-dark rounded">🖨️ Cetak Laporan</a>
            <a href="#" class="nav-link text-white">📖 Panduan</a>
            <a href="#" class="nav-link text-white">🚪 Logout</a>
        </nav>
    </aside>

    <!-- Konten -->
    <main class="flex-grow-1 bg-light p-4">
        <div class="container">
            <h3 class="mb-4 fw-bold">Detail Laporan</h3>

            <div class="card shadow-sm p-4">
                <h5 class="fw-bold mb-3">Laporan: Kasus Bullying di Kelas 10</h5>

                <table class="table table-borderless">
                    <tr>
                        <th style="width: 200px;">No. Laporan</th>
                        <td>: LAP-001</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: <span class="badge bg-success">Selesai</span></td>
                    </tr>
                    <tr>
                        <th>Tanggal Laporan</th>
                        <td>: 2025-05-03</td>
                    </tr>
                    <tr>
                        <th>Pelapor</th>
                        <td>: Rina Putri</td>
                    </tr>
                    <tr>
                        <th>Pelaku</th>
                        <td>: Siswa A</td>
                    </tr>
                    <tr>
                        <th>Saksi</th>
                        <td>: Siswa B, Siswa C</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>: Siswa mengalami tindakan bullying verbal dan fisik selama kegiatan belajar di kelas. Sudah ditindaklanjuti pihak sekolah.</td>
                    </tr>
                    <tr>
                        <th>Bukti Foto</th>
                        <td>
                            <img src="{{ asset('images/bukti_dummy.jpg') }}" alt="Bukti Foto" class="img-thumbnail" style="max-height: 200px;">
                        </td>
                    </tr>
                </table>

                <!-- Tanda Tangan -->
                <div class="ttd mt-5 text-end">
                    <p class="mb-1">Bandung, 14 Mei 2025</p>
                    <p class="mb-5">Guru BK</p>
                    <img src="{{ asset('images/ttd_dummy.png') }}" alt="Tanda Tangan" style="height: 80px;"><br>
                    <strong>Ibu Siti Rahma, S.Psi</strong>
                </div>

                <div class="mt-4 d-flex gap-3">
                    <a href="{{ route('guru.cetak') }}" class="btn btn-secondary">← Kembali</a>
                    <button class="btn btn-danger">🖨️ Cetak PDF</button>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
