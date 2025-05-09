<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DUCARE</title>
    <link rel="stylesheet" href="{{ asset('css/pelapor.css') }}">
</head>
<body>

<div class="register-wrapper">
    <div class="register-left">
        <img src="{{ asset('images/logo login.png') }}" alt="DUCARE Logo" class="logo-login">
        <h2>DUCARE</h2>
        <p>Lindungi diri, laporkan bullying</p>
    </div>

    <div class="register-right">
        <h2>Login</h2>
        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Kata Sandi" required>
            <button type="submit" class="btn-login">Login</button>
        </form>
        <p class="login-link">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
    </div>
</div>

</body>
</html>
