<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - DUCARE</title>
  <link rel="stylesheet" href="{{ asset('css/pelapor.css') }}">

  <!-- Font Awesome untuk ikon mata -->
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

    .alert-success {
      background-color: #d1fae5;
      color: #065f46;
      padding: 12px 16px;
      border-radius: 10px;
      margin-bottom: 20px;
      border: 1px solid #a7f3d0;
      font-weight: 500;
    }
    .alert-danger {
      background-color: #fee2e2;
      color: #991b1b;
      padding: 12px 16px;
      border-radius: 10px;
      margin-bottom: 20px;
      border: 1px solid #fecaca;
      font-weight: 500;
    }
    .alert-danger ul { margin: 0; padding-left: 20px; }

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

    .register-right input {
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

    .register-right input:focus {
      outline: none;
      border-color: #64CA3F;
      background-color: #ffffff;
      box-shadow: 0 0 0 4px rgba(100, 202, 63, 0.15);
    }

    .password-wrapper {
      position: relative;
    }

    .password-wrapper input {
      padding-right: 45px; /* Untuk beri ruang ke ikon mata */
    }

    .toggle-password {
      position: absolute;
      right: 16px;
      top: 40%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #94a3b8;
      transition: color 0.3s;
    }

    .toggle-password:hover {
      color: #64CA3F;
    }

    .btn-login {
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
    }

    .btn-login:hover {
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

    @keyframes ancul {
      0% { transform: scale(1) rotate(0deg); }
      20% { transform: scale(1.1) rotate(-5deg); }
      40% { transform: scale(1.1) rotate(5deg); }
      60% { transform: scale(1.1) rotate(-5deg); }
      80% { transform: scale(1.1) rotate(5deg); }
      100% { transform: scale(1) rotate(0deg); }
    }
    .logo-ancul {
      transition: transform 0.5s ease;
    }
    .logo-ancul:hover {
      animation: ancul 1s ease-in-out;
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
    <img src="{{ asset('images/logo login.png') }}" alt="DUCARE Logo" class="logo-login logo-ancul">
    <h2>DUCARE</h2>
    <p>Lindungi diri, laporkan bullying</p>
  </div>

  <div class="register-right">
    <h2>Login</h2>

    {{-- Notifikasi ditangani oleh SweetAlert di bawah --}}

    {{-- Form Login --}}
<form action="{{ route('login.store') }}" method="POST" autocomplete="off">
    @csrf

    <input 
        type="email" 
        name="email" 
        placeholder="Email" 
        value="{{ old('email') }}" 
        autocomplete="off"
        required
    >

    <div class="password-wrapper">
        <input 
            type="password" 
            name="password" 
            id="password" 
            placeholder="Kata Sandi" 
            autocomplete="new-password"
            required
        >
        <i class="fa-solid fa-eye toggle-password" toggle="#password"></i>
    </div>

    <button type="submit" class="btn-login">Login</button>
</form>

    <p class="login-link">Belum punya akun? <a href="{{ route('pelapor.register') }}">Daftar di sini</a></p>
  </div>
</div>

<!-- Script untuk toggle password & SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

  @if ($errors->any())
    let errorMsg = '';
    @foreach ($errors->all() as $error)
        errorMsg += '{{ $error }}\n';
    @endforeach

    Swal.fire({
        icon: 'error',
        title: 'Gagal Login',
        text: errorMsg,
        confirmButtonColor: '#64CA3F',
        confirmButtonText: 'Coba Lagi'
    });
  @endif

  @if (session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        confirmButtonColor: '#64CA3F',
        confirmButtonText: 'Lanjut'
    });
  @endif
</script>

</body>
</html>
