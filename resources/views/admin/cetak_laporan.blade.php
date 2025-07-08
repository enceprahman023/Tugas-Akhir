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
    <a href="{{ route('admin.panduan.admin') }}">Panduan</a>
    <a href="#" id="btn-logout-trigger">Logout</a>
  </nav>

  <div class="header-right" title="Admin Profile">
    <img src="{{ asset('images/admin-profile.jpg') }}" alt="Foto Admin" />
    <span>Nama Admin</span>
  </div>
</header>

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
                    @foreach($laporans as $laporan)
                    <tr>
                        <td>LAP-{{ str_pad($laporan->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $laporan->judul_laporan }}</td>
                        <td>{{ $laporan->created_at->format('Y-m-d') }}</td>
                        <td>
                            @php
                                $badge = 'secondary';
                                if ($laporan->status === 'Dalam Proses') $badge = 'warning';
                                elseif ($laporan->status === 'Selesai') $badge = 'success';
                                elseif ($laporan->status === 'Ditolak') $badge = 'danger';
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ $laporan->status ?? 'Belum Ada' }}</span>
                        </td>
                        <td>{{ $laporan->jenis_pelaporan }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal-{{ $laporan->id }}">🖨️ Detail</button>
                            <a href="{{ route('admin.cetak.detail', $laporan->id) }}" class="btn btn-sm btn-danger">🖨️ Cetak</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @foreach($laporans as $laporan)
    <!-- Modal Detail -->
    <div class="modal fade" id="detailModal-{{ $laporan->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $laporan->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Laporan LAP-{{ str_pad($laporan->id, 3, '0', STR_PAD_LEFT) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr><th>Judul</th><td>{{ $laporan->judul_laporan }}</td></tr>
                        <tr><th>Status</th><td><span class="badge bg-{{ $badge }}">{{ $laporan->status ?? 'Belum Ada' }}</span></td></tr>
                        <tr><th>Pelapor</th><td>{{ $laporan->nama_pelapor === 'Anonim' ? 'Anonim' : $laporan->nama_pelapor }}</td></tr>
                        <tr><th>Pelaku</th><td>{{ $laporan->nama_pembully }}</td></tr>
                        <tr><th>Saksi</th><td>{{ $laporan->nama_saksi ?? '-' }}</td></tr>
                        <tr><th>Isi Laporan</th><td>{{ $laporan->isi_laporan }}</td></tr>
                        <tr>
                            <th>Bukti Foto</th>
                            <td>
                                @if ($laporan->bukti_gambar)
                                    <img src="{{ asset('storage/' . $laporan->bukti_gambar) }}" class="img-fluid" style="max-height: 200px;">
                                @else
                                    Tidak ada gambar
                                @endif
                            </td>
                        </tr>
                    </table>

                    <h6 class="mt-4">Catatan Penanganan</h6>
                    <form action="{{ route('laporan.updatePenanganan', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <textarea name="catatan_penanganan" class="form-control" rows="3" placeholder="Tulis catatan...">{{ $laporan->catatan_penanganan }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Tanggal Penanganan</label>
                            <input type="date" name="tanggal_penanganan" class="form-control" value="{{ $laporan->tanggal_penanganan }}">
                        </div>
                        <div class="mb-3">
                            <label>Ditangani Oleh</label>
                            <input type="text" name="ditangani_oleh" class="form-control" value="{{ $laporan->ditangani_oleh ?? 'Admin' }}">
                        </div>
                        <div class="mb-3">
                            <label>Tanda Tangan (opsional)</label>
                            <input type="file" name="ttd" class="form-control">
                            @if ($laporan->ttd_penangan)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $laporan->ttd_penangan) }}" style="max-height: 100px;">
                            </div>
                            @endif
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Hapus</button>
                    </form>

                    <form action="{{ route('laporan.updateStatus', $laporan->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="Selesai">
                        <button class="btn btn-success">Tandai Selesai</button>
                    </form>

                    <form action="{{ route('laporan.updateStatus', $laporan->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="Ditolak">
                        <button class="btn btn-warning">Tolak</button>
                    </form>

                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</main>
@endsection
