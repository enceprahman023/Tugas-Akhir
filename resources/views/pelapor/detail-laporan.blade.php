@extends('layouts.dashboard-layout')

@section('content')
<div class="container py-4">
  <h2 class="fw-bold mb-4">Detail Laporan</h2>

  <div class="card shadow-sm">
    <div class="card-header bg-light">
      <h5 class="mb-0">Laporan: {{ $laporan->judul_laporan }}</h5>
    </div>

    <div class="card-body">
      <table class="table table-borderless">
        <tr><th style="width: 200px;">No. Laporan</th><td>: LAP-{{ str_pad($laporan->id, 3, '0', STR_PAD_LEFT) }}</td></tr>
        <tr><th>Status</th><td>: <span class="badge bg-success">{{ $laporan->status }}</span></td></tr>
        <tr><th>Tanggal Kejadian</th><td>: {{ $laporan->tanggal_kejadian }}</td></tr>
        <tr><th>Pelapor</th><td>: {{ $laporan->nama_pelapor === 'Anonim' ? 'Anonim' : $laporan->nama_pelapor }}</td></tr>
        <tr><th>Pelaku</th><td>: {{ $laporan->nama_pembully }}</td></tr>
        <tr><th>Nama Saksi</th><td>: {{ $laporan->nama_saksi ?? '-' }}</td></tr>
        <tr><th>Isi Laporan</th><td>: {{ $laporan->isi_laporan }}</td></tr>
        <tr>
          <th>Bukti Foto</th>
          <td>
            @if ($laporan->bukti_gambar)
              <img src="{{ asset('storage/' . $laporan->bukti_gambar) }}" 
                   alt="Bukti Foto"
                   class="img-thumbnail zoomable-image"
                   style="max-height: 150px; cursor: zoom-in;">
            @else
              Tidak ada gambar
            @endif
          </td>
        </tr>
        <tr><th>Catatan Penanganan</th><td>: {{ $laporan->catatan_penanganan ?? '-' }}</td></tr>
        <tr><th>Tanggal Penanganan</th><td>: {{ $laporan->tanggal_penanganan ?? '-' }}</td></tr>
        <tr><th>Ditangani Oleh</th><td>: {{ $laporan->ditangani_oleh ?? '-' }}</td></tr>
      </table>
    </div>
  </div>
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
