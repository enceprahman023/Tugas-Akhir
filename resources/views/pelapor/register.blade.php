<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - DUCARE</title>
  <link rel="stylesheet" href="{{ asset('css/pelapor.css') }}">

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    .password-wrapper {
      position: relative;
      width: 100%;
      margin-bottom: 15px;
    }

    .password-wrapper input {
      width: 100%;
      padding: 12px;
      padding-right: 40px;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-sizing: border-box;
    }

    .toggle-password {
      position: absolute;
      right: 12px;
      top: 40%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #888;
    }

    .register-right form {
      max-width: 400px;
      margin: 0 auto;
    }

    .register-right input:not([type="password"]) {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-sizing: border-box;
    }
  </style>
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

      <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
      <input type="text" name="nis" placeholder="NIS" value="{{ old('nis') }}" required>
      <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>

      <div class="password-wrapper">
        <input type="password" name="password" id="password" placeholder="Kata Sandi" required>
        <i class="fa-solid fa-eye toggle-password" toggle="#password"></i>
      </div>

      <div class="password-wrapper">
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Sandi" required>
        <i class="fa-solid fa-eye toggle-password" toggle="#password_confirmation"></i>
      </div>

      <button type="submit">Daftar Akun</button>
    </form>

    <p class="login-link">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
  </div>
</div>

<!-- Toggle Password -->
<script>
  document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', () => {
      const input = document.querySelector(icon.getAttribute('toggle'));
      const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
      input.setAttribute('type', type);
      icon.classList.toggle('fa-eye');
      icon.classList.toggle('fa-eye-slash');
    });
  });
</script>

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
