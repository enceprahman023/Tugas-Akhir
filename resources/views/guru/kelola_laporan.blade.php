@extends('layouts.main')

@section('title', 'Kelola Laporan')

@section('content')
<div class="d-flex vh-100">
    <!-- Sidebar -->
    <aside class="sidebar bg-primary text-white p-3 pt-5">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logodu.png') }}" alt="Logo" class="logo mb-2" style="width: 60px;">
            <h5 class="fw-bold">DUCARE</h5>
        </div>
        <nav class="nav flex-column">
            <a href="{{ route('guru.dashboard') }}" class="nav-link text-white">🏠 Dashboard</a>
            <a href="{{ route('guru.kelola') }}" class="nav-link text-white">📋 Kelola Laporan</a>
            <a href="#" class="nav-link text-white">🖨️ Cetak Laporan</a>
            <a href="#" class="nav-link text-white">📖 Panduan</a>
            <a href="#" class="nav-link text-white">🚪 Logout</a>
        </nav>
    </aside>

    <!-- Konten Utama -->
    <main class="flex-grow-1 px-4 pt-5 pb-4 bg-light">
        <h3 class="mb-4">Kelola Laporan</h3>

        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No. Laporan</th>
                        <th>Judul Laporan</th>
                        <th>Status</th>
                        <th>Tanggal Laporan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporans as $laporan)
                        <tr>
                            <td>LAP-{{ str_pad($laporan->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $laporan->judul_laporan }}</td>
                            <td>
                                @php
                                    $badge = 'secondary';
                                    if ($laporan->status === 'Dalam Proses') $badge = 'warning';
                                    elseif ($laporan->status === 'Selesai') $badge = 'success';
                                    elseif ($laporan->status === 'Ditolak') $badge = 'danger';
                                @endphp
                                <span class="badge bg-{{ $badge }}">{{ $laporan->status ?? 'Belum Ada' }}</span>
                            </td>
                            <td>{{ $laporan->created_at->format('Y-m-d') }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal-{{ $laporan->id }}">Lihat Detail</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @foreach ($laporans as $laporan)
        <!-- Modal Detail -->
        <div class="modal fade" id="detailModal-{{ $laporan->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $laporan->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Laporan LAP-{{ str_pad($laporan->id, 3, '0', STR_PAD_LEFT) }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <tr><th>Judul Laporan</th><td>{{ $laporan->judul_laporan }}</td></tr>
                            <tr><th>Status</th><td><span class="badge bg-secondary">{{ $laporan->status ?? 'Belum Ada' }}</span></td></tr>
                            <tr><th>Tanggal Laporan</th><td>{{ $laporan->created_at->format('Y-m-d') }}</td></tr>
                            <tr><th>Pelaku</th><td>{{ $laporan->nama_pembully }}</td></tr>
                            <tr><th>Pelapor</th><td>{{ $laporan->nama_pelapor === 'Anonim' ? 'Laporan ini dikirim secara anonim' : $laporan->nama_pelapor }}</td></tr>
                            <tr><th>Saksi</th><td>{{ $laporan->nama_saksi ?? '-' }}</td></tr>
                            <tr><th>Deskripsi</th><td>{{ $laporan->isi_laporan }}</td></tr>
                            <tr>
                                <th>Bukti Foto</th>
                                <td>
                                    @if ($laporan->bukti_gambar)
                                        <img src="{{ asset('storage/' . $laporan->bukti_gambar) }}" class="img-fluid" style="max-height: 250px;">
                                    @else
                                        Tidak ada gambar
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <!-- Catatan Penanganan -->
                        <div class="mt-4">
                            <h6>Catatan Penanganan</h6>
                            <form action="{{ route('laporan.updatePenanganan', $laporan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <textarea name="catatan_penanganan" class="form-control" rows="3" placeholder="Tulis catatan penanganan...">{{ $laporan->catatan_penanganan }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Penanganan</label>
                                    <input type="date" name="tanggal_penanganan" class="form-control" value="{{ $laporan->tanggal_penanganan }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Catatan</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus laporan ini?')">Hapus</button>
                        </form>
                        <form action="{{ route('laporan.updateStatus', $laporan->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="Selesai">
                            <button class="btn btn-success">Selesaikan</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </main>
</div>
@endsection
