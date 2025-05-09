@extends('layouts.main')

@section('title', 'Login Guru BK')

@section('content')
<div class="login-bg d-flex justify-content-center align-items-center">
    <div class="login-card">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logodu.png') }}" alt="Logo" class="animated-logo mb-2" style="width: 80px;">
            <h4 class="fw-bold">Login Guru BK</h4>
        </div>
        <form action="{{ route('guru.dashboard') }}" method="GET">
            @csrf
            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" required>
            </div>
            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <span onclick="togglePassword('password')" 
                      style="position: absolute; top: 70%; right: 12px; transform: translateY(-50%); cursor: pointer;">
                    👁️
                </span>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-2">Masuk</button>
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
