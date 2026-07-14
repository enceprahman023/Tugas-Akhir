<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - DUCARE</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #0284c7 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Dekorasi Background */
        .bg-shape-1 {
            position: absolute; width: 400px; height: 400px; background: rgba(56, 189, 248, 0.2);
            border-radius: 50%; filter: blur(60px); top: -100px; left: -100px; z-index: 1;
        }
        .bg-shape-2 {
            position: absolute; width: 300px; height: 300px; background: rgba(14, 165, 233, 0.2);
            border-radius: 50%; filter: blur(50px); bottom: -50px; right: -50px; z-index: 1;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            z-index: 10;
            position: relative;
        }

        .logo-section { text-align: center; margin-bottom: 30px; }
        .logo-section img {
            width: 80px; height: 80px; object-fit: contain; margin-bottom: 15px;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2));
            transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .logo-section img:hover { transform: scale(1.1) rotate(5deg); }
        .logo-section h2 { color: #ffffff; font-size: 24px; font-weight: 800; margin-bottom: 5px; letter-spacing: 1px; }
        .logo-section p { color: #bae6fd; font-size: 14px; font-weight: 500; }

        .input-group { margin-bottom: 20px; position: relative; }
        .input-group label { display: block; margin-bottom: 8px; color: #e0f2fe; font-size: 14px; font-weight: 600; }
        
        .input-wrapper { position: relative; }
        .input-wrapper i {
            position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
            color: #7dd3fc; font-size: 16px;
        }
        
        .input-group input {
            width: 100%; padding: 14px 16px 14px 45px;
            background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px; color: #ffffff; font-size: 15px; font-family: inherit;
            transition: all 0.3s ease;
        }
        .input-group input:focus {
            background: rgba(255, 255, 255, 0.1); border-color: #38bdf8;
            outline: none; box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.1);
        }
        .input-group input::placeholder { color: rgba(255, 255, 255, 0.4); }

        .toggle-password {
            position: absolute; right: 16px; top: 50%; transform: translateY(-50%);
            color: #7dd3fc; cursor: pointer; font-size: 16px; transition: color 0.3s;
        }
        .toggle-password:hover { color: #ffffff; }

        .btn-login {
            width: 100%; padding: 14px; margin-top: 10px;
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: white; font-size: 16px; font-weight: 700; font-family: inherit;
            border: none; border-radius: 12px; cursor: pointer;
            transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(2, 132, 199, 0.4);
            display: flex; justify-content: center; align-items: center; gap: 10px;
        }
        .btn-login:hover {
            transform: translateY(-2px); box-shadow: 0 8px 20px rgba(2, 132, 199, 0.6);
            background: linear-gradient(135deg, #0369a1 0%, #075985 100%);
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5; padding: 12px 16px; border-radius: 10px; font-size: 14px;
            margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-weight: 500;
        }

        .back-link {
            text-align: center; margin-top: 25px;
        }
        .back-link a {
            color: #bae6fd; text-decoration: none; font-size: 14px; font-weight: 500;
            transition: color 0.3s;
        }
        .back-link a:hover { color: #ffffff; text-decoration: underline; }

        /* Animation */
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .login-container { animation: fadeIn 0.6s ease-out forwards; }
    </style>
</head>
<body>
    <div class="bg-shape-1"></div>
    <div class="bg-shape-2"></div>

    <div class="login-container">
        <div class="logo-section">
            <img src="{{ asset('images/logodu.png') }}" alt="Logo DUCARE">
            <h2>Portal Admin</h2>
            <p>Sistem Pengaduan Bullying DUCARE</p>
        </div>

        @if(session('error'))
            <div class="error-message">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.login.store') }}" method="POST">
            @csrf
            
            <div class="input-group">
                <label for="email">Alamat Email</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" id="email" name="email" placeholder="admin@ducare.com" required autocomplete="email">
                </div>
            </div>

            <div class="input-group">
                <label for="password">Kata Sandi</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                    <i class="fa-solid fa-eye toggle-password" id="toggle-icon" onclick="togglePassword()"></i>
                </div>
            </div>

            <button type="submit" class="btn-login">
                Masuk ke Sistem <i class="fa-solid fa-arrow-right-to-bracket"></i>
            </button>
        </form>

        <div class="back-link">
            <a href="{{ route('home') }}"><i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Halaman Utama</a>
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
    </script>
</body>
</html>
