@extends('layouts.main')

@section('title', 'Dashboard Admin')

@section('content')
<div class="d-flex vh-100">
    <!-- Sidebar -->
    <aside class="sidebar bg-primary text-white p-3 pt-5">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logodu.png') }}" alt="Logo" class="logo mb-2" style="width: 60px;">
            <h5 class="fw-bold">DUCARE</h5>
        </div>
        <nav class="nav flex-column">
            <a href="#" class="nav-link text-white">🏠 Dashboard</a>
            <a href="{{ route('guru.kelola') }}" class="nav-link text-white">📋 Kelola Laporan</a>
            <a href="{{ route ('guru.cetak') }}" class="nav-link text-white">🖨️ Cetak Laporan</a>
            <a href="{{ route('guru.panduan') }}" class="nav-link text-white">📖 Panduan</a>
            <a href="{{ route ('guru.profile') }}" class="nav-link text-white">👤 Profile</a>
            <form id="logout-form" action="{{ route('guru.logout') }}" method="POST">
    @csrf
    <a href="#" class="nav-link text-white"
       onclick="event.preventDefault(); if(confirm('Apakah kamu yakin ingin logout?')) document.getElementById('logout-form').submit();">
        🚪 Keluar
    </a>
</form>
        </nav>
    </aside>

    <!-- Konten Utama -->
    <main class="flex-grow-1 px-4 pt-5 pb-4 bg-light">
        <h3 class="mb-4">Selamat Datang, Admin</h3>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="card shadow-sm p-3 text-center">
                    <h6>Laporan Masuk</h6>
                    <h4 class="text-primary">12</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm p-3 text-center">
                    <h6>Dalam Proses</h6>
                    <h4 class="text-warning">5</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm p-3 text-center">
                    <h6>Selesai</h6>
                    <h4 class="text-success">3</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm p-3 text-center">
                    <h6>Ditolak</h6>
                    <h4 class="text-danger">2</h4>
                </div>
            </div>
        </div>
  @endsection
