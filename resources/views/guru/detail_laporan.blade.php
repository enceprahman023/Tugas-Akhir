@extends('layouts.main')

@section('title', 'Detail Cetak Laporan')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Guru.css') }}">

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
                    <p class="mb-1">Bandung, {{ $laporan->tanggal_penanganan ? \Carbon\Carbon::parse($laporan->tanggal_penanganan)->format('d F Y') : now()->format('d F Y') }}</p>
                    <p class="mb-1">Guru BK</p>
                    @if ($laporan->ttd_penangan)
                        <img src="{{ asset('storage/' . $laporan->ttd_penangan) }}"
                             alt="Tanda Tangan"
                             class="zoomable-image mb-1"
                             style="height: 80px; cursor: zoom-in;">
                    @else
                        <p class="mb-1">[Tanda Tangan Tidak Tersedia]</p>
                    @endif
                    <strong>{{ $laporan->ditangani_oleh ?? 'Guru BK' }}</strong>
                </div>

                <div class="mt-4 d-flex gap-3">
                    <a href="{{ route('guru.cetak') }}" class="btn btn-secondary">← Kembali</a>
                    <button class="btn btn-danger" onclick="window.print()">🖨️ Cetak PDF</button>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Saat modal dibuka, pasang ulang event listener zoom
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('shown.bs.modal', function () {
                const zoomableImages = modal.querySelectorAll('.zoomable-image');
                zoomableImages.forEach(img => {
                    img.addEventListener('click', function () {
                        img.classList.toggle('zoomed');
                    });
                });
            });
        });
    });
</script>
@endpush

