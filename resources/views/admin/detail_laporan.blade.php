@extends('layouts.main')

@section('title', 'Detail Cetak Laporan')

@section('content')
<div class="d-flex" style="min-height: 100vh;">
    <!-- Header Navbar Admin -->
<header>
  <div class="header-left">
    <img src="{{ asset('images/logodu.png') }}" alt="Logo Sekolah">
  </div>

  <nav class="menu">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.kelola.laporan') }}">Kelola Laporan</a>
    <a href="{{ route('admin.cetak') }}">Cetak Laporan</a>
    <a href="#">Kelola Akun</a>
    <a href="#">Panduan</a>
    <a href="#">Logout</a>
  </nav>

  <div class="header-right" title="Admin Profile">
    <img src="{{ asset('images/admin-profile.jpg') }}" alt="Foto Admin" />
    <span>Nama Admin</span>
  </div>
</header>

<!-- Konten -->
<main class="flex-grow-1 bg-light p-4">
    <div class="container">
        <h3 class="mb-4 fw-bold">Detail Laporan</h3>

        <div class="card shadow-sm p-4">
            <h5 class="fw-bold mb-3">Laporan: {{ $laporan->judul_laporan }}</h5>

            <table class="table table-borderless">
                <tr><th style="width: 200px;">No. Laporan</th><td>: LAP-{{ str_pad($laporan->id, 3, '0', STR_PAD_LEFT) }}</td></tr>
                <tr><th>Status</th><td>: <span class="badge bg-success">{{ $laporan->status }}</span></td></tr>
                <tr><th>Tanggal Laporan</th><td>: {{ $laporan->created_at->format('Y-m-d') }}</td></tr>
                <tr><th>Pelapor</th><td>: {{ $laporan->nama_pelapor ?? 'Anonim' }}</td></tr>
                <tr><th>Pelaku</th><td>: {{ $laporan->nama_pembully }}</td></tr>
                <tr><th>Saksi</th><td>: {{ $laporan->nama_saksi ?? '-' }}</td></tr>
                <tr><th>Deskripsi</th><td>: {{ $laporan->isi_laporan }}</td></tr>
                <tr>
                    <th>Bukti Foto</th>
                    <td>
                        @if ($laporan->bukti_gambar)
                            <img src="{{ asset('storage/' . $laporan->bukti_gambar) }}" alt="Bukti Foto" class="img-thumbnail" style="max-height: 200px;">
                        @else
                            Tidak ada gambar
                        @endif
                    </td>
                </tr>
                <tr><th>Catatan Penanganan</th><td>: {{ $laporan->catatan_penanganan ?? '-' }}</td></tr>
            </table>

            <!-- Tanda Tangan -->
            <div class="ttd mt-5 text-end">
                @if ($laporan->tanggal_penanganan)
                    <p class="mb-1">Bandung, {{ \Carbon\Carbon::parse($laporan->tanggal_penanganan)->translatedFormat('d F Y') }}</p>
                @endif

                <p class="mb-5">Yang Menangani,</p>

                @if ($laporan->ttd_penangan)
                    <img src="{{ asset('storage/' . $laporan->ttd_penangan) }}" alt="Tanda Tangan" style="height: 80px;"><br>
                @endif

                <strong>{{ $laporan->ditangani_oleh ?? '-' }}</strong>
            </div>

            <div class="mt-4 d-flex gap-3 no-print">
                <a href="{{ route('admin.cetak') }}" class="btn btn-secondary">← Kembali</a>
                <button class="btn btn-danger" onclick="window.print()">🖨️ Cetak PDF</button>
            </div>
        </div>
    </div>
</main>
</div>

<style>
@media print {
    header, nav, .btn, .header-right, .sidebar, .back-button, .print-button, .no-print {
        display: none !important;
    }

    body {
        background: #fff !important;
        margin: 0;
    }

    main {
        margin: 0 !important;
        padding: 0 !important;
        width: 100%;
    }

    .card {
        box-shadow: none !important;
        border: none !important;
    }
}
</style>
@endsection
