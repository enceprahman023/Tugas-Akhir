<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DUCARE</title>
    <link rel="stylesheet" href="{{ asset('css/pelapor.css') }}">

    <style>
 .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
    </style>
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
         @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
        {{-- END PERBAIKAN --}}

        {{-- START PERBAIKAN: Tambahkan ini untuk menampilkan pesan error login --}}
        @if ($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- END PERBAIKAN --}}

        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            {{-- START PERBAIKAN: Hapus value="{{ old('email') }}" dan tambahkan autocomplete="off" --}}
            <input type="text" name="email" placeholder="Email" required autocomplete="off">
            {{-- END PERBAIKAN --}}
            <input type="password" name="password" placeholder="Kata Sandi" required>
            <button type="submit" class="btn-login">Login</button>
        </form>
        <p class="login-link">Belum punya akun? <a href="{{ route('pelapor.register') }}">Daftar di sini</a></p>
    </div>
</div>

</body>
</html>
