<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DUCARE</title>
    <link rel="stylesheet" href="{{ asset('css/pelapor.css') }}">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="register-wrapper">
    <div class="register-left">
        <img src="{{ asset('images/logo register.png') }}" style="width:400px;" alt="DUCARE Logo">
        <h2>DUCARE</h2>
        <p>Lindungi diri, laporkan bullying!</p>
    </div>
    <div class="register-right">
        <h2>Daftar Akun</h2>
        <form method="POST" action="{{ route('pelapor.register.store') }}">
            @csrf

            <!-- Nama Lengkap -->
            <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>

            <!-- NIS -->
            <input type="text" name="nis" placeholder="NIS" value="{{ old('nis') }}" required>

            <!-- Email -->
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>

            <!-- Password -->
            <input type="password" name="password" placeholder="Kata Sandi" required>

            <!-- Konfirmasi Password -->
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Sandi" required>

            <button type="submit">Daftar Akun</button>
        </form>

        <p class="login-link">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
    </div>
</div>

<!-- Notifikasi Berhasil -->
@if(session('register_success'))
<script>
    Swal.fire({
        title: 'Berhasil!',
        text: 'Akun berhasil didaftarkan. Silakan login.',
        icon: 'success',
        confirmButtonText: 'Oke'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('login') }}";
        }
    });
</script>
@endif

</body>
</html>
