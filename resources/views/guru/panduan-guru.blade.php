@extends('layouts.main')

@section('title', 'Panduan Guru BK')

@section('content')
<div class="d-flex" style="min-height: 100vh; background-color: #f4f6f9;">
    {{-- Sidebar --}}
    <aside class="sidebar bg-primary text-white p-3 pt-5" style="width: 250px;">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logodu.png') }}" alt="Logo DUCARE" class="logo mb-2" style="width: 60px;">
            <h5 class="fw-bold">DUCARE</h5>
        </div>
        <nav class="nav flex-column">
            <a href="{{ route('guru.dashboard') }}" class="nav-link text-white">🏠 Dashboard</a>
            <a href="{{ route('guru.kelola') }}" class="nav-link text-white">📋 Kelola Laporan</a>
            <a href="{{ route('guru.cetak') }}" class="nav-link text-white">🖨️ Cetak Laporan</a>
            <a href="{{ route('guru.panduan') }}" class="nav-link text-white active bg-dark rounded">📖 Panduan</a>
            <a href="#" class="nav-link text-white">🚪 Logout</a>
        </nav>
    </aside>

    {{-- Main --}}
    <main class="flex-grow-1 p-4">
        <div class="container bg-white p-4 rounded-4 shadow-sm">
            <h1 class="fw-bold mb-4 text-center text-primary">Panduan Penggunaan untuk Guru BK</h1>

            <div class="accordion" id="panduanGuruAccordion">

                {{-- Langkah 1 --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed bg-primary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Langkah 1: Login sebagai Guru BK
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#panduanGuruAccordion">
                        <div class="accordion-body">
                            <p>Masukkan email dan password yang telah diberikan admin untuk masuk ke dashboard Guru BK.</p>
                            <img src="{{ asset('images/login-guide.png') }}" alt="Login Guru BK" class="img-fluid rounded mb-3">
                        </div>
                    </div>
                </div>

                {{-- Langkah 2 --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed bg-primary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Mengelola Laporan Masuk
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#panduanGuruAccordion">
                        <div class="accordion-body">
                            <p>Pilih menu "Kelola Laporan" untuk melihat daftar laporan bullying. Klik tombol "Detail" untuk melihat isi laporan lengkap dan tambahkan catatan penanganan jika diperlukan.</p>
                            <img src="{{ asset('images/kelola-laporan-guide.png') }}" alt="Kelola Laporan" class="img-fluid rounded mb-3">
                        </div>
                    </div>
                </div>

                {{-- Langkah 3 --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed bg-primary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Mencetak Laporan
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#panduanGuruAccordion">
                        <div class="accordion-body">
                            <p>Pilih menu "Cetak Laporan", lalu klik tombol cetak pada laporan yang ingin diunduh dalam format PDF. Anda juga bisa mengirimkan laporan ke email.</p>
                            <img src="{{ asset('images/cetak-guide.png') }}" alt="Cetak Laporan" class="img-fluid rounded mb-3">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>
@endsection
