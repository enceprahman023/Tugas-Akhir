@extends('layouts.main')

@section('title', 'Login Guru BK')

@section('content')
<style>
    .login-bg {
        min-height: 100vh;
        background: linear-gradient(135deg, #f9e79f, #58d68d); /* Gradasi kuning ke hijau */
        padding: 40px;
    }

    .login-card {
        background: white;
        padding: 50px;
        border-radius: 20px;
        box-shadow: 0 12px 24px rgba(0,0,0,0.2);
        width: 100%;
        max-width: 600px; /* Fokus tampilan web */
    }

    .animated-logo {
        animation: bounce 1s infinite;
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-5px);
        }
    }
</style>

<div class="login-bg d-flex justify-content-center align-items-center">
    <div class="login-card">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logodu.png') }}" alt="Logo" class="animated-logo mb-2" style="width: 80px;">
            <h4 class="fw-bold">Login Guru BK</h4>
        </div>

        {{-- Alert error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/login-guru" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Aktif</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <span onclick="togglePassword('password')" 
                      style="position: absolute; top: 70%; right: 12px; transform: translateY(-50%); cursor: pointer;">
                    👁️
                </span>
            </div>

            <button type="submit" class="btn btn-success w-100 mt-2">Masuk</button>
        </form>

        <div class="text-center mt-3">
            <small>Belum punya akun? <a href="{{ route('guru.register') }}">Daftar di sini</a></small>
        </div>
    </div>
</div>

<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>
@endsection
