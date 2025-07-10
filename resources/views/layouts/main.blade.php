<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Darul Ulum Care')</title>

    {{-- Bootstrap & Icons CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- SweetAlert2 CSS - Ditempatkan di HEAD UTAMA --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    {{-- Custom CSS --}}
    @if (Request::is('guru*'))
    <link rel="stylesheet" href="{{ asset('css/guru.css') }}">
    @elseif (Request::is('admin*'))
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @elseif (Request::is('pelapor*'))
    <link rel="stylesheet" href="{{ asset('css/pelapor.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('css/pelapor.css') }}">
    @endif
</head>
<body>
    @if (in_array(Route::currentRouteName(), ['home', 'about.bullying']))
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('images/logodu.png') }}" alt="Logo" width="40" height="40" class="me-5">
                <div class="brand-text">
                    <div class="brand-title">DUCARE</div>
                    <div class="brand-subtitle">Darul Ulum Care</div>
                </div>
            </a>

            {{-- Middle Menu Buttons --}}
            <div class="d-flex justify-content-center gap-2 middle-menu">
                <a class="btn btn-secondary" href="/">Home</a>
                <a class="btn btn-secondary" href="/about-bullying">About Bullying</a>
                <a class="btn btn-secondary" href="/#team">Team</a>
                <a class="btn btn-secondary" href="/#kontak">Kontak</a>
            </div>

            {{-- Right Menu Buttons --}}
            <div class="nav-menu">
                <a href="{{ route('pelapor.register') }}" class="btn btn-outline-warning">Register</a>
                <a href="{{ route('login') }}" class="btn btn-outline-light ms-3">Login</a>
            </div>
        </div>
    </nav>
    @endif

    {{-- Dynamic Content Section --}}
    <main class="container-fluid p-0 m-0">
        @yield('content')
    </main>

    {{-- Optional Footer Placeholder --}}
    @hasSection('footer')
        @yield('footer')
    @endif

    {{-- Bootstrap & SweetAlert2 JS - Ditempatkan di AKHIR BODY --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.all.min.js"></script>

    {{-- Script Logout Umum pelapor --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const logoutButton = document.getElementById('logout-button');
            const logoutForm = document.getElementById('logout-form');

            if (logoutButton && logoutForm) {
                logoutButton.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (confirm('Apakah kamu yakin ingin logout?')) {
                        logoutForm.submit();
                    }
                });
            }
        });
    </script>
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    {{-- Script Logout guruBK (Perhatikan ID yang berbeda agar tidak bentrok) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const guruLogoutButton = document.getElementById('guru-logout-button');
            const guruLogoutForm = document.getElementById('guru-logout-form');

            if (guruLogoutButton && guruLogoutForm) {
                guruLogoutButton.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (confirm('Apakah kamu yakin ingin logout Guru BK?')) {
                        guruLogoutForm.submit();
                    }
                });
            }
        });
    </script>
    {{-- Pastikan ID form logout Guru BK unik, contoh: guru-logout-form --}}
    {{-- <form id="guru-logout-form" action="{{ route('guru.logout') }}" method="POST" style="display: none;">
        @csrf
    </form> --}}
    @stack('scripts')

    
</body>

</html>