@extends('layouts.dashboard-layout')

@section('content')
<div class="container py-4">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Status Laporan</h2>
    <a href="{{ route('buat.laporan') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg"></i> Buat Laporan Baru
    </a>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-light">
        <tr class="text-center">
          <th style="width: 50px;">No</th>
          <th>Judul</th>
          <th>Status</th>
          <th style="width: 100px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($laporans as $laporan)
          <tr class="text-center">
            <td>{{ $loop->iteration }}</td>
            <td class="text-start">{{ $laporan->judul_laporan }}</td>
            <td>
              @if ($laporan->status === 'Dalam Proses')
                  <span class="badge bg-warning text-dark">Dalam Proses</span>
              @elseif ($laporan->status === 'Selesai')
                  <span class="badge bg-success">Selesai</span>
              @elseif ($laporan->status === 'Ditolak')
                  <span class="badge bg-danger">Ditolak</span>
              @else
                  <span class="badge bg-secondary">{{ $laporan->status }}</span>
              @endif
            </td>
            <td>
              <div class="dropdown">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    ⚙️
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a href="{{ route('detail.laporan', $laporan->id) }}" class="dropdown-item">📋 Detail Laporan</a>
                  </li>
                    <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                      @csrf
                      @method('DELETE')
                      <button class="dropdown-item text-danger" type="submit">🗑️ Hapus</button>
                    </form>
                  </li>
                </ul>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center">Belum ada laporan.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
