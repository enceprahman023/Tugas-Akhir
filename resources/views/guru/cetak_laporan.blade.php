@extends('layouts.main')

@section('title', 'Cetak Laporan')

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
            <h3 class="mb-4 fw-bold">Daftar Laporan Masuk</h3>

            <div class="table-responsive">
                <table class="table table-striped table-bordered shadow-sm bg-white">
                    <thead class="table-primary">
                        <tr>
                            <th>No. Laporan</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Jenis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>LAP-001</td>
                            <td>Bullying Kelas 10</td>
                            <td>2025-05-03</td>
                            <td><span class="badge bg-success">Selesai</span></td>
                            <td>Non-Anonim</td>
                            <td>
                                <a href="{{ route('guru.cetak.detail') }}" class="btn btn-sm btn-primary">🖨️ Detail</a>
                                <button class="btn btn-danger btn-sm">Cetak</button>
                            </td>
                        </tr>
                        <tr>
                            <td>LAP-002</td>
                            <td>Bullying di Kantin</td>
                            <td>2025-05-07</td>
                            <td><span class="badge bg-warning text-dark">Proses</span></td>
                            <td>Anonim</td>
                            <td>
                                <a href="{{ route('guru.cetak.detail') }}" class="btn btn-sm btn-primary">🖨️ Detail</a>
                                <button class="btn btn-danger btn-sm">Cetak</button>
                            </td>
                        </tr>
                        <!-- Tambahkan baris dummy lainnya jika perlu -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection
