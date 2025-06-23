@extends('layouts.main')

@section('title', 'Register guru')

@section('content')

<div class="container-fluid vh-100 d-flex">
    <!-- KIRI: Branding -->
    <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center text-white p-5" style="background: linear-gradient(to bottom right, #03d106cd, #a3bb09d5);">
        <img src="{{ asset('images/logodu.png') }}" alt="Logo" class="mb-4 logo-animated" style="width: 120px;">
        <h2 class="mb-3">Selamat Datang Admin BK</h2>
        <p class="text-center" style="max-width: 400px;">
            "Menjadi cahaya bagi siswa yang membutuhkan bimbingan dan dukungan."
        </p>
    </div>

    <!-- KANAN: Form -->
    <div class="col-md-6 d-flex justify-content-center align-items-center p-5">
        <div class="form-wrapper">
            <h2 class="mb-4 text-center">Daftar Guru BK</h2>
            <form action="{{ route('guru.register.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                         @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" required>
                        @error('nip')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Aktif</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="phone_number" class="form-label">Nomor Kontak</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number">
                        @error('phone_number')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <div class="position-relative">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <span onclick="togglePassword('password')" 
                                style="position: absolute; top: 50%; right: 12px; transform: translateY(-50%); cursor: pointer; font-size: 16px;">
                                👁️
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                        <div class="position-relative">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            <span onclick="togglePassword('password_confirmation')" 
                                style="position: absolute; top: 50%; right: 12px; transform: translateY(-50%); cursor: pointer; font-size: 16px;">
                                👁️
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Tombol Daftar -->
                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-primary w-50">Daftar</button>
                </div>

                <!-- Teks Login -->
                <div class="mt-3 text-center">
                    <small>Sudah punya akun? <a href="{{ route('guru.login') }}">Login di sini</a></small>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Animasi logo -->
<style>
    .logo-animated {
        transition: transform 0.4s ease;
    }
    .logo-animated:hover {
        transform: scale(1.1) rotate(-3deg);
    }
</style>

<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>

{{--  Popup Data berhasil masuk ke DB  --}}
@if (session('success'))
    <script>
        window.onload = function () {
            setTimeout(function () {
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('guru.login') }}";
                    }
                });
            }, 100);
        }
    </script>
@endif

@endsection
