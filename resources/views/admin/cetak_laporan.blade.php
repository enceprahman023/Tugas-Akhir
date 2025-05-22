@extends('layouts.main')

@section('title', 'Kelola Laporan')

@section('content')

<header>
  <div class="header-left">
    <img src="{{ asset('images/logodu.png') }}" alt="Logo Sekolah">
  </div>

  <nav class="menu">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.kelola.laporan') }}">Kelola Laporan</a>
    <a href="{{ route('admin.cetak') }}">Cetak Laporan</a>
    <a href="{{ route('admin.kelola.akun') }}">Kelola Akun</a>
    <a href="#">Panduan</a>
    <a href="#">Logout</a>
  </nav>

  <div class="header-right" title="Admin Profile">
    <img src="images/admin-profile.jpg" alt="Foto Admin" />
    <span>Nama Admin</span>
  </div>
</header>

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
                                <a href="{{ route('admin.detail') }}" class="btn btn-sm btn-primary">🖨️ Detail</a>
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
                                <a href="{{ route('admin.detail') }}" class="btn btn-sm btn-primary">🖨️ Detail</a>
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