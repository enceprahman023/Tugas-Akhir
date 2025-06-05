<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DUCARE</title>
    <link rel="stylesheet" href="{{ asset('css/pelapor.css') }}">
</head>
<body>

<div class="register-wrapper">
    <div class="register-left">
        <img src="{{ asset('images/logo register.png') }}" style="width:400px; solid green;" alt="DUCARE Logo">
        <h2>DUCARE</h2>
        <p>Lindungi diri, laporkan bullying !</p>
    </div>
    <div class="register-right">
        <h2>Daftar Akun</h2>
        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <input type="text" name="nis" placeholder="NIS" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Kata Sandi" required>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Sandi" required>
            <button type="submit">Daftar Akun</button>
        </form>
        <p class="login-link">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
    </div>
</div>

</body>
</html>