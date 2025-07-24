@extends('layouts.main')

@section('title', 'Cetak Laporan')

@section('content')
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
                        @foreach ($laporans as $laporan)
                            <tr>
                                <td>LAP-{{ str_pad($laporan->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $laporan->judul_laporan }}</td>
                                <td>{{ $laporan->created_at->format('Y-m-d') }}</td>
                                <td>
                                    @php
                                        $badge = 'secondary';
                                        if ($laporan->status === 'Dalam Proses') $badge = 'warning text-dark';
                                        elseif ($laporan->status === 'Selesai') $badge = 'success';
                                        elseif ($laporan->status === 'Ditolak') $badge = 'danger';
                                    @endphp
                                    <span class="badge bg-{{ $badge }}">{{ $laporan->status }}</span>
                                </td>
                                <td>{{ $laporan->nama_pelapor === 'Anonim' ? 'Anonim' : 'Non-Anonim' }}</td>
                                <td>
                                    <a href="{{ route('guru.cetak.detail', $laporan->id) }}" class="btn btn-sm btn-primary">🖨️ Detail</a>
                                    <button class="btn btn-danger btn-sm" onclick="window.print()">Cetak</button>
                                </td>
                            </tr>
                        @endforeach

                        @if ($laporans->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada laporan yang diproses.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
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
