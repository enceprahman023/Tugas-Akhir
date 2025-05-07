@extends('layouts.main')

@section('title', 'Profil Saya')

@section('content')
<div class="dashboard-container d-flex" style="min-height: 100vh; background-color: #f4f6f9;">

    {{-- Sidebar --}}
    <aside class="sidebar p-4 text-white" style="width: 250px; background: #1e2a38;">
        <div class="text-center mb-4" style="margin-top: 30px">
            <img src="{{ asset('images/logodu.png') }}" alt="Logo DUCARE" class="logo-dashboard mb-2" style="max-width: 80px;">
            <h5 class="fw-bold">DUCARE</h5>
        </div>

        <ul class="nav flex-column mt-4">
            <li class="nav-item mb-3">
                <a href="{{ route('dashboard') }}" class="nav-link text-white">🏠 Dashboard</a>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('buat.laporan') }}" class="nav-link text-white">📝 Buat Laporan</a>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('status.laporan') }}" class="nav-link text-white">📋 Status Laporan</a>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('panduan.laporan') }}" class="nav-link text-white"><i class="bi bi-book me-2"></i>Panduan</a>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('profile.laporan') }}" class="nav-link text-white"><i class="bi bi-person me-2"></i>Profile</a>
            </li>
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="button" id="logout-button" class="nav-link text-danger bg-transparent border-0 d-flex align-items-center p-0" style="width: 100%; text-align: left;">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                  </button>
                </form>
              </li>
        </ul>
    </aside>

    {{-- Main Content --}}
    <main class="flex-grow-1 p-4">
        <div class="container bg-white p-5 rounded-4 shadow-sm">
            <h1 class="fw-bold mb-4 text-center" style="color: #1e2a38;">Profil Saya</h1>

            <div class="card mx-auto" style="max-width: 500px;">
                <div class="card-body text-center">
                    <img src="{{ asset('images/team 1.jpg') }}" alt="Foto Profil" class="rounded-circle mb-3" width="120" height="120">
                    <h4 class="card-title mb-2">John Doe</h4>
                    <p class="text-muted mb-1">NIS: 12345678</p>
                    <p class="text-muted mb-1">Nama:jhon ilahi</p>
                    <p class="text-muted mb-3">Email: johndoe@example.com</p>

                    <a href="#" class="btn btn-primary">Edit Profil</a>
                    <a href="#" class="btn btn-primary">Ganti Password</a>
                </div>
            </div>
        </div>
    </main>

</div>
@endsection
