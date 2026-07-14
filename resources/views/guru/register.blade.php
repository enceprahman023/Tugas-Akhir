@extends('layouts.main')

@section('title', 'Register Guru BK')

@section('content')
<style>
    body {
        background-color: #f8fafc;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .auth-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }
    .auth-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        overflow: hidden;
        display: flex;
        width: 100%;
        max-width: 1000px;
    }
    .auth-left {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        padding: 50px;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        width: 40%;
    }
    .auth-right {
        padding: 50px 40px;
        width: 60%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .auth-title {
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 30px;
        text-align: center;
    }
    .form-control {
        background-color: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 18px;
        font-size: 0.95rem;
        transition: all 0.3s;
    }
    .form-control:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
        background-color: #ffffff;
    }
    .btn-auth {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 14px;
        font-weight: 700;
        font-size: 1.1rem;
        width: 100%;
        transition: all 0.3s;
        box-shadow: 0 10px 20px rgba(245, 158, 11, 0.2);
    }
    .btn-auth:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 25px rgba(245, 158, 11, 0.3);
        color: white;
    }
    .toggle-password {
        position: absolute;
        top: 50%;
        right: 18px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #94a3b8;
        transition: color 0.3s;
    }
    .toggle-password:hover {
        color: #1e293b;
    }
    @media (max-width: 768px) {
        .auth-card { flex-direction: column; }
        .auth-left, .auth-right { width: 100%; }
        .auth-left { padding: 40px 20px; }
        .auth-right { padding: 40px 20px; }
    }
</style>

<div class="auth-wrapper">
    <div class="auth-card">
        <!-- Kiri: Branding -->
        <div class="auth-left">
            <img src="{{ asset('images/logodu.png') }}" alt="Logo DUCARE" class="mb-4" style="width: 100px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2));">
            <h3 class="fw-bold mb-3">Registrasi<br>Guru BK</h3>
            <p class="mb-0" style="opacity: 0.9;">"Menjadi pilar perlindungan dan bimbingan bagi siswa DUCARE."</p>
        </div>
        
        <!-- Kanan: Form -->
        <div class="auth-right">
            <h3 class="auth-title">Daftar Akun Baru</h3>
            
            <form action="{{ route('guru.register.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label fw-bold text-secondary small">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nip" class="form-label fw-bold text-secondary small">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" placeholder="1980xxxx" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label fw-bold text-secondary small">Email Aktif</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="guru@ducare.sch.id" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone_number" class="form-label fw-bold text-secondary small">Nomor Kontak</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="0812xxxx" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="password" class="form-label fw-bold text-secondary small">Kata Sandi</label>
                        <div class="position-relative">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 8 karakter" required autocomplete="new-password">
                            <i class="fa-solid fa-eye toggle-password" onclick="togglePasswordVisibility('password', this)"></i>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="password_confirmation" class="form-label fw-bold text-secondary small">Konfirmasi Sandi</label>
                        <div class="position-relative">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi sandi" required autocomplete="new-password">
                            <i class="fa-solid fa-eye toggle-password" onclick="togglePasswordVisibility('password_confirmation', this)"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-auth">Buat Akun</button>
            </form>
            
            <div class="text-center mt-4">
                <p class="text-muted mb-0">Sudah terdaftar? <a href="{{ route('guru.login') }}" class="fw-bold" style="color: #d97706; text-decoration: none;">Masuk di sini</a></p>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility(inputId, iconElement) {
        const input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
            iconElement.classList.remove('fa-eye');
            iconElement.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            iconElement.classList.remove('fa-eye-slash');
            iconElement.classList.add('fa-eye');
        }
    }
</script>

{{-- SweetAlert untuk Error/Success --}}
@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Gagal Mendaftar',
            html: `
                <ul style="list-style-type: none; padding: 0; margin: 0; color: #dc3545; text-align: center;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
            confirmButtonColor: '#f59e0b'
        });
    });
</script>
@endif

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonColor: '#f59e0b',
            confirmButtonText: 'Lanjut Login'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('guru.login') }}";
            }
        });
    });
</script>
@endif

@endsection
