@extends('layouts.dashboard-layout')

@section('content')
  <div class="mb-4">
    <h3 class="fw-bold">👋 Selamat datang di Dashboard DUCARE</h3>
    <p class="text-muted">Berikut adalah informasi laporan kamu atau informasi penting lainnya.</p>
  </div>

  <!-- Info Boxes -->
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h5 class="card-title fw-semibold">Jumlah Laporan</h5>
          <p class="card-text fs-4 text-success">0</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h5 class="card-title fw-semibold">Status Terakhir</h5>
          <p class="card-text text-warning">Belum ada laporan</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm border-0 bg-light">
        <div class="card-body">
          <h5 class="card-title fw-semibold">📢 Notifikasi</h5>
          <p class="card-text">Tidak ada notifikasi saat ini.</p>
        </div>
      </div>
    </div>
  </div>
@endsection
