@extends('layouts.main')

@section('title', 'Panduan Laporan')

@section('content')
<div class="dashboard-container d-flex" style="min-height: 100vh; background-color: #f4f6f9;">
  {{-- Sidebar --}}
  <aside class="sidebar p-4 text-white" style="width: 250px; background: #1e2a38;">
    <div class="text-center mb-4" style="margin-top: 30px">
      <img src="{{ asset('images/logodu.png') }}" alt="Logo DUCARE" class="logo-dashboard mb-2" style="max-width: 80px;">
      <h5 class="fw-bold">DUCARE</h5>
    </div>
    <ul class="nav flex-column mt-4">
      <li class="nav-item mb-3"><a href="{{ route('pelapor.dashboard') }}" class="nav-link text-white">🏠 Dashboard</a></li>
      <li class="nav-item mb-3"><a href="{{ route('buat.laporan') }}" class="nav-link text-white">📝 Buat Laporan</a></li>
      <li class="nav-item mb-3"><a href="{{ route('status.laporan') }}" class="nav-link text-white">📋 Status Laporan</a></li>
      <li class="nav-item mb-3"><a href="{{ route('panduan.laporan') }}" class="nav-link text-white"><i class="bi bi-book me-2"></i> Panduan</a></li>
      <li class="nav-item mb-3"><span class="nav-link text-white"><i class="bi bi-person me-2"></i>Profil</span></li>
      <li class="nav-item"><span class="nav-link text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</span></li>
    </ul>
  </aside>

  {{-- Main --}}
  <main class="flex-grow-1 p-4">
    <div class="container bg-white p-4 rounded-4 shadow-sm">
      <h1 class="fw-bold mb-4 text-center" style="color: #1e2a38;">Panduan Penggunaan Aplikasi</h1>

      <div class="accordion" id="panduanAccordion">

        {{-- Langkah 1 --}}
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button collapsed bg-primary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              Langkah 1: Login ke Akun
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#panduanAccordion">
            <div class="accordion-body">
              <p>Masuk menggunakan NIS dan password yang telah diberikan oleh admin sekolah.</p>
              <img src="{{ asset('images/login-guide.png') }}" alt="Panduan Login" class="img-fluid rounded mb-3">
            </div>
          </div>
        </div>

        {{-- Langkah 2 --}}
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed bg-primary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Cara Membuat Akun
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#panduanAccordion">
            <div class="accordion-body">
              <p>Untuk membuat akun, klik tombol register dan isi NIS serta data diri Anda.</p>
              <img src="{{ asset('images/register-guide.png') }}" alt="Panduan Register" class="img-fluid rounded mb-3">
            </div>
          </div>
        </div>

        {{-- Langkah 3 --}}
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed bg-primary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Cara Melihat Status Laporan
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#panduanAccordion">
            <div class="accordion-body">
              <p>Setelah login, buka menu Status Laporan untuk melihat perkembangan laporan Anda.</p>
              <img src="{{ asset('images/status-guide.png') }}" alt="Panduan Status" class="img-fluid rounded mb-3">
            </div>
          </div>
        </div>

      </div>
    </div>
  </main>
</div>

@endsection
