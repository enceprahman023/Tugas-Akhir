<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 34px;
            right: 15px;
            cursor: pointer;
            color: #666;
        }
    </style>
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
                    <input type="text" id="email" name="email" required>
                </div>

                <div class="input-group password-wrapper">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <span class="toggle-password" onclick="togglePassword()">
                        <i class="fa fa-eye" id="toggle-icon"></i>
                    </span>
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('toggle-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        const logo = document.querySelector('.logo-section img');
        if (logo) {
            logo.addEventListener('click', () => {
                logo.classList.add('animate-logo');
                setTimeout(() => {
                    logo.classList.remove('animate-logo');
                }, 1000);
            });
        }
    </script>
</body>
</html>
