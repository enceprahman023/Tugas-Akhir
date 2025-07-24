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

    .register-right form {
      max-width: 400px;
      margin: 0 auto;
    }

    .register-right input {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-sizing: border-box;
    }

    .password-wrapper {
      position: relative;
    }

    .password-wrapper input {
      padding-right: 130px; /* Untuk beri ruang ke ikon mata */
    }

    .toggle-password {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #888;
    }

    @keyframes ancul {
      0% { transform: rotate(0deg); }
      20% { transform: rotate(-10deg); }
      40% { transform: rotate(8deg); }
      60% { transform: rotate(-6deg); }
      80% { transform: rotate(4deg); }
      100% { transform: rotate(0deg); }
    }
    .logo-ancul:hover {
      animation: ancul 0.7s cubic-bezier(.4,2,.3,1);
    }
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

    {{-- Notifikasi sukses --}}
    @if (session('success'))
      <div class="alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{-- Notifikasi error --}}
    @if ($errors->any())
      <div class="alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Form Login --}}
    <form action="{{ route('login.store') }}" method="POST">
      @csrf
      <input type="text" name="email" placeholder="Email" required autocomplete="off">

      <div class="password-wrapper">
        <input type="password" name="password" id="password" placeholder="Kata Sandi" required>
        <i class="fa-solid fa-eye toggle-password" toggle="#password"></i>
      </div>

      <button type="submit" class="btn-login">Login</button>
    </form>

    <p class="login-link">Belum punya akun? <a href="{{ route('pelapor.register') }}">Daftar di sini</a></p>
  </div>
</div>

<!-- Script untuk toggle password -->
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

</body>
</html>
