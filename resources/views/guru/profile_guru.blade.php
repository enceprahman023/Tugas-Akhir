@extends('layouts.main')

@section('title', 'Profil Guru BK')

@section('content')
<div class="d-flex" style="min-height: 100vh;">
    <!-- Sidebar -->
    <aside class="sidebar bg-primary text-white p-3 pt-5" style="width: 250px;">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logodu.png') }}" alt="Logo DUCARE" class="logo mb-2" style="width: 60px;">
            <h5 class="fw-bold">DUCARE</h5>
        </div>
        <nav class="nav flex-column">
            <a href="{{ route('guru.dashboard') }}" class="nav-link text-white">🏠 Dashboard</a>
            <a href="{{ route('guru.kelola') }}" class="nav-link text-white">📁 Kelola Laporan</a>
            <a href="{{ route('guru.cetak') }}" class="nav-link text-white">🖨️ Cetak Laporan</a>
            <a href="{{ route('guru.panduan') }}" class="nav-link text-white">📖 Panduan</a>
            <a href="{{ route('guru.profile') }}" class="nav-link text-white bg-dark rounded">👤 Profil</a>
            <a href="#" class="nav-link text-danger">🚪 Logout</a>
        </nav>
    </aside>

    <!-- Konten Profil -->
    <main class="flex-grow-1 p-4 bg-light">
        <div class="container">
            <div class="card shadow-sm p-4">
                <h3 class="fw-bold mb-4">Profil Guru BK</h3>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('images/profile_guru.png') }}" alt="Foto Guru BK" class="img-thumbnail rounded-circle mb-3" style="max-width: 150px;">
                        <h5 class="fw-semibold">Bu Dewi Lestari</h5>
                        <p class="text-muted">guru.bk@ducare.sch.id</p>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 180px;">Nama</th>
                                <td>: Bu Dewi Lestari</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>: guru.bk@ducare.sch.id</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>: Guru BK</td>
                            </tr>
                        </table>

                        <div class="mt-4">
                            <a href="#" class="btn btn-warning">🔑 Ganti Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
