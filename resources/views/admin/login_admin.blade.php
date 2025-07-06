<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-box">
            <div class="logo-section">
                <img src="{{ asset('images/logodu.png') }}" alt="Logo Sekolah">
                <h2>Login Admin</h2>
            </div>

            @if(session('error'))
                <div class="error-message">{{ session('error') }}</div>
            @endif

            <form action="{{ route('admin.login.store') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="text" id="username" name="email" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>
        </div>
    </div>
<script>
    const logo = document.querySelector('.logo-section img');

    if (logo) {
        logo.addEventListener('click', () => {
            logo.classList.add('animate-logo');

            setTimeout(() => {
                logo.classList.remove('animate-logo');
            }, 1000); // animasi jalan 1 detik
        });
    }
</script>

</body>
</html>
