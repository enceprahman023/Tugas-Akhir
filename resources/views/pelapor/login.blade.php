<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - DUCARE</title>
  
  {{-- Favicon Logo DUCARE --}}
  <link rel="icon" href="{{ asset('images/logodu.png') }}" type="image/png">
  <link rel="shortcut icon" href="{{ asset('images/logodu.png') }}" type="image/png">

  <link rel="stylesheet" href="{{ asset('css/pelapor.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    * {
      box-sizing: border-box;
    }

    body, html {
      margin: 0;
      padding: 0;
      width: 100%;
      min-height: 100vh;
      font-family: 'Plus Jakarta Sans', sans-serif;
      background-color: #f4f6f8;
    }

    /* Menghilangkan icon mata bawaan browser Edge/IE */
    input[type="password"]::-ms-reveal,
    input[type="password"]::-ms-clear {
      display: none;
    }

    .register-wrapper {
      display: flex;
      min-height: 100vh;
      width: 100%;
    }

    /* Sisi Kiri: Branding DUCARE */
    .register-left {
      flex: 1;
      background-color: #64CA3F !important;
      color: #ffffff !important;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 40px 24px;
      text-align: center;
    }

    .register-left img {
      max-width: 180px !important;
      width: 100% !important;
      height: auto !important;
      margin-bottom: 20px;
      display: block;
      transition: transform 0.3s ease;
    }

    .register-left img:hover {
      transform: scale(1.05);
    }

    .register-left h2 {
      font-size: 2.2rem;
      font-weight: 800;
      margin: 0 0 8px 0;
      color: #ffffff !important;
      letter-spacing: 0.5px;
    }

    .register-left p {
      font-size: 1.1rem;
      color: #ffffff;
      opacity: 0.95;
      margin: 0;
      font-weight: 500;
    }

    /* Sisi Kanan: Form Card Login */
    .register-right {
      flex: 1;
      background-color: #f4f6f8 !important;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 40px 24px;
    }

    .register-right form {
      width: 100%;
      max-width: 420px;
      background: #ffffff;
      padding: 40px 32px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
      border: 1px solid #e2e8f0;
    }

    .register-right h2 {
      font-size: 1.8rem;
      font-weight: 800;
      color: #64CA3F !important;
      margin: 0 0 24px 0;
      text-align: center;
    }

    .register-right input {
      width: 100%;
      padding: 13px 16px;
      margin-bottom: 16px;
      border: 1px solid #cbd5e1;
      border-radius: 10px;
      box-sizing: border-box;
      background-color: #f8fafc;
      font-size: 15px;
      transition: all 0.25s ease;
      color: #1e293b;
      font-family: inherit;
    }

    .register-right input:focus {
      outline: none;
      border-color: #64CA3F;
      background-color: #ffffff;
      box-shadow: 0 0 0 3px rgba(100, 202, 63, 0.2);
    }

    .password-wrapper {
      position: relative;
      width: 100%;
      margin-bottom: 16px;
    }

    .password-wrapper input {
      margin-bottom: 0 !important;
      padding-right: 48px !important;
    }

    .toggle-password {
      position: absolute;
      right: 16px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #94a3b8;
      font-size: 16px;
      z-index: 5;
      padding: 4px;
      transition: color 0.25s ease;
    }

    .toggle-password:hover {
      color: #64CA3F;
    }

    .btn-login {
      width: 100%;
      padding: 13px;
      background-color: #64CA3F !important;
      color: #ffffff;
      font-size: 16px;
      font-weight: 700;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.25s ease;
      box-shadow: 0 4px 12px rgba(100, 202, 63, 0.3);
      margin-top: 6px;
    }

    .btn-login:hover {
      background-color: #4DA834 !important;
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(100, 202, 63, 0.4);
    }

    .login-link {
      margin-top: 20px;
      text-align: center;
      color: #64748b;
      font-size: 14px;
      font-weight: 500;
    }

    .login-link a {
      color: #64CA3F;
      font-weight: 700;
      text-decoration: none;
      transition: color 0.25s;
    }

    .login-link a:hover {
      color: #4DA834;
      text-decoration: underline;
    }

    /* RESPONSIVE DESIGN (HP / TABLET) */
    @media (max-width: 768px) {
      .register-wrapper {
        flex-direction: column;
        min-height: 100vh;
      }

      .register-left {
        padding: 30px 20px 20px 20px;
        flex: none;
      }

      .register-left img {
        max-width: 120px !important;
        margin-bottom: 12px;
      }

      .register-left h2 {
        font-size: 1.6rem;
        margin-bottom: 4px;
      }

      .register-left p {
        font-size: 0.95rem;
      }

      .register-right {
        padding: 24px 16px 40px 16px;
        flex: 1;
      }

      .register-right form {
        padding: 28px 20px;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
      }

      .register-right h2 {
        font-size: 1.5rem;
        margin-bottom: 18px;
      }

      .register-right input {
        padding: 12px 14px;
        font-size: 14px;
        margin-bottom: 14px;
      }

      .btn-login {
        padding: 12px;
        font-size: 15px;
      }
    }
  </style>
</head>
<body>

<div class="register-wrapper">
  {{-- Section Kiri: Branding DUCARE --}}
  <div class="register-left">
    <img src="{{ asset('images/logo login.png') }}" alt="DUCARE Logo">
    <h2>DUCARE</h2>
    <p>Lindungi diri, laporkan bullying!</p>
  </div>

  {{-- Section Kanan: Form Login --}}
  <div class="register-right">
    <form action="{{ route('login.store') }}" method="POST" autocomplete="off">
      @csrf

      <h2>Login Pelapor</h2>

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

      <p class="login-link">Belum punya akun? <a href="{{ route('pelapor.register') }}">Daftar di sini</a></p>
    </form>
  </div>
</div>

<script>
  // Toggle password visibility
  document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', () => {
      const input = document.querySelector(icon.getAttribute('toggle'));
      if (input) {
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
      }
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
