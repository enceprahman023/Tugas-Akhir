@extends('layouts.main')

@section('title', 'Login Guru BK')

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
        max-width: 900px;
    }
    .auth-left {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); /* Warna Oranye khas Guru BK */
        padding: 50px;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        width: 50%;
    }
    .auth-right {
        padding: 60px 50px;
        width: 50%;
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
        padding: 14px 20px;
        font-size: 1rem;
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
        right: 20px;
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
            <img src="{{ asset('images/logodu.png') }}" alt="Logo DUCARE" class="mb-4" style="width: 120px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2));">
            <h2 class="fw-bold mb-3">Portal Guru BK</h2>
            <p class="fs-5 mb-0" style="opacity: 0.9;">"Dedikasi Membangun Karakter,<br>Menjaga Masa Depan Siswa"</p>
        </div>
        
        <!-- Kanan: Form -->
        <div class="auth-right">
            <h3 class="auth-title">Login Guru</h3>
            
            <form action="/login-guru" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="form-label fw-bold text-secondary">Email Terdaftar</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email anda..." required>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label fw-bold text-secondary">Kata Sandi</label>
                    <div class="position-relative">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi..." required>
                        <i class="fa-solid fa-eye toggle-password" onclick="togglePasswordVisibility('password', this)"></i>
                    </div>
                </div>
                
                <button type="submit" class="btn-auth mt-2">Masuk Sekarang</button>
            </form>
            
            <div class="text-center mt-4">
                <p class="text-muted mb-0">Belum memiliki akses? <a href="{{ route('guru.register') }}" class="fw-bold" style="color: #d97706; text-decoration: none;">Daftar di sini</a></p>
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

{{-- SweetAlert untuk Error --}}
@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            html: `
                <ul style="list-style-type: none; padding: 0; margin: 0; color: #dc3545;">
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
@endsection
