@extends('layouts.main')

@section('title', 'Dashboard GuruBK')

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
            <a href="{{ route('guru.cetak') }}" class="nav-link text-white">🖨️ Cetak Laporan</a>
            <a href="{{ route('guru.panduan') }}" class="nav-link text-white">📖 Panduan</a>
            <a href="{{ route('guru.profile') }}" class="nav-link text-white">👤 Profile</a>
            <form id="logout-form" action="{{ route('guru.logout') }}" method="POST">
                @csrf
                <a href="#" class="nav-link text-white" onclick="event.preventDefault(); showLogoutPopup();">🚪 Keluar</a>
            </form>
        </nav>
    </aside>

    <!-- Konten Utama -->
    <main class="flex-grow-1 px-4 pt-5 pb-4 bg-light">
        <h3 class="mb-4">Selamat Datang, GuruBK</h3>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="card shadow-sm p-3 text-center">
                    <h6>Laporan Masuk</h6>
                    <h4 class="text-primary">{{ $jumlahMasuk }}</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm p-3 text-center">
                    <h6>Dalam Proses</h6>
                    <h4 class="text-warning">{{ $jumlahProses }}</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm p-3 text-center">
                    <h6>Selesai</h6>
                    <h4 class="text-success">{{ $jumlahSelesai }}</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm p-3 text-center">
                    <h6>Ditolak</h6>
                    <h4 class="text-danger">{{ $jumlahTolak }}</h4>
                </div>
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
