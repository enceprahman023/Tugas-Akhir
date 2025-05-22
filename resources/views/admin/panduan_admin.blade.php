@extends('layouts.main')

@section('title', 'Panduan Admin')

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
    <a href="{{ route('admin.panduan.admin') }}" class="active">Panduan</a>
    <a href="#">Logout</a>
  </nav>

  <div class="header-right" title="Admin Profile">
    <img src="{{ asset('images/admin-profile.jpg') }}" alt="Foto Admin" />
    <span>Nama Admin</span>
  </div>
</header>

<main class="p-4" style="background-color: #f4f6f9; min-height: 80vh;">
  <div class="container bg-white p-4 rounded-4 shadow-sm">
    <h1 class="fw-bold mb-4 text-center text-primary">Panduan Penggunaan untuk Admin</h1>

    <div class="accordion" id="panduanAccordion">

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button collapsed bg-primary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            Langkah 1: Login sebagai Admin
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#panduanAccordion">
          <div class="accordion-body">
            <p>Masukkan email dan password yang telah diberikan untuk masuk ke dashboard Admin.</p>
            <img src="{{ asset('images/login-guide.png') }}" alt="Login Admin" class="img-fluid rounded mb-3">
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed bg-primary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Mengelola Laporan Masuk
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#panduanAccordion">
          <div class="accordion-body">
            <p>Pilih menu "Kelola Laporan" untuk melihat daftar laporan bullying. Klik tombol "Detail" untuk melihat isi laporan lengkap dan tambahkan catatan penanganan jika diperlukan.</p>
            <img src="{{ asset('images/kelola-laporan-guide.png') }}" alt="Kelola Laporan" class="img-fluid rounded mb-3">
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed bg-primary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Mencetak Laporan
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#panduanAccordion">
          <div class="accordion-body">
            <p>Pilih menu "Cetak Laporan", lalu klik tombol cetak pada laporan yang ingin diunduh dalam format PDF. Anda juga bisa mengirimkan laporan ke email.</p>
            <img src="{{ asset('images/cetak-guide.png') }}" alt="Cetak Laporan" class="img-fluid rounded mb-3">
          </div>
        </div>
      </div>

    </div>
  </div>
</main>
@endsection
