@extends('layouts.dashboard-layout')

@section('content')
<div class="container py-4">
  <h2 class="fw-bold">Detail Laporan</h2>

  <div class="card mt-4">
    <div class="card-header bg-light">
      <h5 class="card-title">Laporan #1: Bullying di kelas</h5>
    </div>
    <div class="card-body">
      <p><strong>Pelapor:</strong> John Doe</p>
      <p><strong>Tanggal Kejadian:</strong> 2025-04-20</p>
      <p><strong>Nama Pelaku:</strong> Jane Smith</p>
      <p><strong>Isi Laporan:</strong> Terdapat perundungan yang terjadi di kelas yang melibatkan siswa X dan Y. Saksi dari kejadian tersebut adalah Z.</p>
      <p><strong>Status Laporan:</strong> <span class="badge bg-warning text-dark">Sedang Diproses</span></p>
      <p><strong>Nama Saksi:</strong> Z</p>
      <p><strong>Gambar Bukti:</strong></p>
      <img src="{{ asset('images/bukti.jpg') }}" alt="Bukti" class="img-fluid" style="max-width: 500px;">

      <a href="{{ route('ubah.laporan') }}" class="btn btn-primary mt-3">✏️ Ubah Laporan</a>
    </div>
  </div>
</div>
@endsection
