@extends('layouts.dashboard-layout')

@section('content')
<div class="container py-4">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Status Laporan</h2>
    <a href="{{ route('buat.laporan') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg"></i> Buat Laporan Baru
    </a>
  </div>

  @php
      $laporans = [
          (object)[ 'id' => 1, 'tentang' => 'Bullying di kelas', 'status' => 'Sedang Diproses' ],
          (object)[ 'id' => 2, 'tentang' => 'Perundungan di kantin', 'status' => 'Selesai' ],
          (object)[ 'id' => 3, 'tentang' => 'Ancaman lewat chat', 'status' => 'Ditolak' ],
      ];
  @endphp

  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-light">
        <tr class="text-center">
          <th style="width: 50px;">No</th>
          <th>Tentang</th>
          <th>Status</th>
          <th style="width: 100px;">Pilihan</th>
        </tr>
      </thead>
      <tbody>
        @foreach($laporans as $laporan)
          <tr class="text-center">
            <td>{{ $loop->iteration }}</td>
            <td class="text-start">{{ $laporan->tentang }}</td>
            <td>
              @if ($laporan->status == 'Sedang Diproses')
                  <span class="badge bg-warning text-dark">{{ $laporan->status }}</span>
              @elseif ($laporan->status == 'Selesai')
                  <span class="badge bg-success">{{ $laporan->status }}</span>
              @elseif ($laporan->status == 'Ditolak')
                  <span class="badge bg-danger">{{ $laporan->status }}</span>
              @else
                  <span class="badge bg-secondary">{{ $laporan->status }}</span>
              @endif
            </td>
            <td>
              <div class="dropdown">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ⚙️
                </button>
                <ul class="dropdown-menu">
                  <li><a href="{{ route('detail.laporan') }}" class="dropdown-item">📋 Detail Laporan</a></li>
                  <li><a class="dropdown-item" href="#">✏️ Ubah Laporan</a></li>
                  <li><a class="dropdown-item text-danger" href="#">🗑️ Hapus Laporan</a></li>
                </ul>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
