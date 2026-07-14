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
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .register-right {
      background-color: #f0fdf4 !important; /* Soft green tint so white card stands out */
    }

    /* Menghilangkan icon mata bawaan dari browser (seperti di Microsoft Edge) */
    input[type="password"]::-ms-reveal,
    input[type="password"]::-ms-clear {
      display: none;
    }

    .register-right h2 {
      font-weight: 700;
      color: #1e293b;
      margin-bottom: 1.5rem;
      text-align: center;
    }

    .register-right form {
      max-width: 480px;
      margin: 0 auto;
      background: #ffffff;
      padding: 50px 40px;
      border-radius: 24px;
      box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
    }

    .register-right input:not([type="password"]),
    .register-right input[type="password"] {
      width: 100%;
      padding: 14px 18px;
      margin-bottom: 20px;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      box-sizing: border-box;
      background-color: #f8fafc;
      font-size: 15px;
      transition: all 0.3s ease;
      color: #334155;
    }

    .register-right input:not([type="password"]):focus,
    .register-right input[type="password"]:focus {
      outline: none;
      border-color: #64CA3F;
      background-color: #ffffff;
      box-shadow: 0 0 0 4px rgba(100, 202, 63, 0.15);
    }

    .password-wrapper {
      position: relative;
      width: 100%;
    }

    .password-wrapper input {
      padding-right: 45px !important;
    }

    .toggle-password {
      position: absolute;
      right: 16px;
      top: 36%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #94a3b8;
      transition: color 0.3s;
    }

    .toggle-password:hover {
      color: #64CA3F;
    }

    .register-right button[type="submit"] {
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, #64CA3F 0%, #4DA834 100%);
      color: white;
      font-size: 16px;
      font-weight: 600;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      box-shadow: 0 4px 15px rgba(100, 202, 63, 0.3);
      margin-top: 5px;
    }

    .register-right button[type="submit"]:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(100, 202, 63, 0.4);
    }

    .login-link {
      margin-top: 25px;
      text-align: center;
      color: #64748b;
      font-weight: 500;
    }

    .login-link a {
      color: #64CA3F;
      font-weight: 600;
      text-decoration: none;
      transition: color 0.3s;
    }
    
    .login-link a:hover {
      color: #4DA834;
      text-decoration: underline;
    }

    .logo-animated {
      transition: transform 0.5s cubic-bezier(.4,2,.3,1), filter 0.4s;
      cursor: pointer;
    }
    .logo-animated:hover {
      transform: scale(1.08) rotate(-5deg);
      filter: brightness(1.1) drop-shadow(0 8px 16px rgba(0,0,0,0.2));
    }
    
    .register-left {
      background: linear-gradient(135deg, #64CA3F 0%, #3e8a24 100%);
    }
    .register-left h2 { font-weight: 700; letter-spacing: 1px; }
    .register-left p { font-size: 1.1rem; opacity: 0.9; }
  </style>
</head>
<body>

<div class="register-wrapper">
  <div class="register-left">
    <img src="{{ asset('images/logo register.png') }}" style="width:400px;" alt="DUCARE Logo" class="logo-animated">
    <h2>DUCARE</h2>
    <p>Lindungi diri, laporkan bullying!</p>
  </div>
  <div class="register-right">
    <h2>Daftar Akun</h2>
    <form method="POST" action="{{ route('pelapor.register.store') }}" autocomplete="off">
    @csrf

    <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" autocomplete="off" required>

    <input type="text" name="nis" placeholder="NIS" value="{{ old('nis') }}" autocomplete="off" required>

    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off" required>

    <div class="password-wrapper">
        <input type="password" name="password" id="password" placeholder="Kata Sandi" autocomplete="new-password" required>
        <i class="fa-solid fa-eye toggle-password" toggle="#password"></i>
    </div>

    <div class="password-wrapper">
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Sandi" autocomplete="new-password" required>
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

@if($errors->any())
<script>
    let errorMsg = '';
    @foreach ($errors->all() as $error)
        errorMsg += '{{ $error }}\n';
    @endforeach

    Swal.fire({
        icon: 'error',
        title: 'Gagal Mendaftar',
        text: errorMsg,
        confirmButtonColor: '#64CA3F',
        confirmButtonText: 'Perbaiki'
    });
</script>
@endif

</body>
</html>
