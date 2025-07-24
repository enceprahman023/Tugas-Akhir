@extends('layouts.main')

@section('title', 'Detail Cetak Laporan')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Guru.css') }}">
<style>
@media print {
  aside.sidebar, .btn, .mt-4, .navbar, .footer-custom, .d-flex.gap-3, .mt-4.d-flex, .text-center.mt-3, .modal, .modal-backdrop, .zoomable-image.zoomed {
    display: none !important;
  }
  body, html {
    background: #fff !important;
    color: #000 !important;
  }
  main.flex-grow-1.bg-light.p-4, .container, .card.shadow-sm.p-4 {
    background: #fff !important;
    box-shadow: none !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  .card.shadow-sm.p-4 {
    border: none !important;
  }
  .ttd {
    page-break-inside: avoid;
    display: block !important;
  }
}
</style>

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
            <a href="{{ route('guru.panduan') }}" class="nav-link text-white">📖 Panduan</a>
            <a href="{{ route('guru.profile') }}" class="nav-link text-white">👤 Profile</a>
            <form id="logout-form" action="{{ route('guru.logout') }}" method="POST">
                @csrf
                <a href="#" class="nav-link text-white" onclick="event.preventDefault(); showLogoutPopup();">🚪 Keluar</a>
            </form>
        </nav>
    </aside>

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
                    <tr><th>Pelapor</th><td>: {{ $laporan->nama_pelapor === 'Anonim' ? 'Anonim' : $laporan->nama_pelapor }}</td></tr>
                    <tr><th>Pelaku</th><td>: {{ $laporan->nama_pembully }}</td></tr>
                    <tr><th>Saksi</th><td>: {{ $laporan->nama_saksi ?? '-' }}</td></tr>
                    <tr><th>Deskripsi</th><td>: {{ $laporan->isi_laporan }}</td></tr>
                    <tr>
                        <th>Bukti Foto</th>
                        <td>
                            @if ($laporan->bukti_gambar)
                                <img src="{{ asset('storage/' . $laporan->bukti_gambar) }}" 
                                     alt="Bukti Foto" 
                                     class="img-thumbnail zoomable-image" 
                                     style="max-height: 200px; cursor: zoom-in;">
                            @else
                                Tidak ada gambar
                            @endif
                        </td>
                    </tr>
                    <tr><th>Catatan Penanganan</th><td>: {{ $laporan->catatan_penanganan ?? '-' }}</td></tr>
                    <tr><th>Tanggal Penanganan</th><td>: {{ $laporan->tanggal_penanganan ? \Carbon\Carbon::parse($laporan->tanggal_penanganan)->format('d-m-Y') : '-' }}</td></tr>
                    <tr><th>Ditangani Oleh</th><td>: {{ $laporan->ditangani_oleh ?? '-' }}</td></tr>
                </table>

                <!-- Tanda Tangan Kanan Bawah -->
                <div class="ttd mt-5 text-end">
                    <div class="text-center" style="display: inline-block; min-width: 200px;">
                        <p class="mb-1">Bandung, {{ $laporan->tanggal_penanganan ? \Carbon\Carbon::parse($laporan->tanggal_penanganan)->format('d F Y') : now()->format('d F Y') }}</p>
                        <p class="mb-1">Guru BK</p>
                        @if ($laporan->ttd_penangan)
                            <img src="{{ asset('storage/' . $laporan->ttd_penangan) }}"
                                 alt="Tanda Tangan"
                                 class="zoomable-image mb-1"
                                 style="height: 80px; cursor: zoom-in; display: block; margin: 0 auto 8px auto;">
                        @else
                            <p class="mb-1">[Tanda Tangan Tidak Tersedia]</p>
                        @endif
                        <strong class="d-block mt-2">{{ $laporan->ditangani_oleh ?? 'Guru BK' }}</strong>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3">
                    <a href="{{ route('guru.cetak') }}" class="btn btn-secondary">← Kembali</a>
                    <button class="btn btn-danger" onclick="window.print()">��️ Cetak PDF</button>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Zoom Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const images = document.querySelectorAll('.zoomable-image');
    images.forEach(img => {
        img.addEventListener('click', () => {
            img.classList.toggle('zoomed');
        });
    });
});
</script>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function showLogoutPopup() {
    Swal.fire({
        title: 'Logout?',
        text: 'Apakah kamu yakin ingin logout?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal',
        backdrop: false
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    });
}
</script>
@endpush

