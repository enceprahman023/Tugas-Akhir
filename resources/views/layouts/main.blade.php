<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Darul Ulum Care')</title>
    <link rel="shortcut icon" href="{{ asset('images/logodu.png') }}?v=3" type="image/png">
    <link rel="icon" href="{{ asset('images/logodu.png') }}?v=3" type="image/png">
    <link rel="icon" sizes="32x32" href="{{ asset('images/logodu.png') }}?v=3" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logodu.png') }}?v=3">

    {{-- Bootstrap & Icons CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- SweetAlert2 CSS - Ditempatkan di HEAD UTAMA --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    {{-- Custom CSS --}}
    @if (Request::is('guru*') || Request::is('login-guru') || Request::is('register-guru'))
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
    <!-- Fullscreen Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay">
        <div class="loading-content">
            <img src="{{ asset('images/logodu.png') }}" alt="Logo DUCARE" class="loading-logo">
            <div class="spinner-border text-success loading-spinner" role="status"></div>
            <p class="loading-text">Memuat Halaman...</p>
        </div>
    </div>

    <style>
      /* Navbar Tetap Hijau dari home.blade.php */
      .navbar {
        background-color: #15803d !important;
        box-shadow: 0 4px 15px rgba(21, 128, 61, 0.2);
      }
      .navbar-brand .brand-title { font-weight: 800; color: #ffffff; line-height: 1.2; font-size: 1.25rem;}
      .navbar-brand .brand-subtitle { font-size: 0.75rem; color: #dcfce7; font-weight: 600; letter-spacing: 1px; }
      .nav-link { color: #f0fdf4 !important; font-weight: 500; transition: color 0.3s; font-family: 'Plus Jakarta Sans', sans-serif;}
      .nav-link:hover, .nav-link.active { color: #fef08a !important; font-weight: 700; }
      
      .btn-outline-warning { border: 2px solid #fef08a; color: #fef08a; font-weight: 600; border-radius: 12px; font-family: 'Plus Jakarta Sans', sans-serif;}
      .btn-outline-warning:hover { background: #fef08a; color: #15803d; border-color: #fef08a; }
      .btn-outline-light { background: #ffffff; color: #15803d; border: none; font-weight: 600; border-radius: 12px; font-family: 'Plus Jakarta Sans', sans-serif;}
      .btn-outline-light:hover { background: #f0fdf4; color: #166534; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
      body { padding-top: 76px; }

      /* Fullscreen Loading Overlay */
      .loading-overlay {
        position: fixed;
        inset: 0;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(8px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        transition: opacity 0.3s ease;
      }
      .loading-overlay.show {
        display: flex;
        opacity: 1;
      }
      .loading-content {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
      }
      .loading-logo {
        width: 80px;
        height: 80px;
        object-fit: contain;
        animation: pulse-loading 1.5s ease-in-out infinite;
      }
      .loading-spinner {
        width: 3rem;
        height: 3rem;
        border-width: 0.25em;
      }
      .loading-text {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
      }
      @keyframes pulse-loading {
        0%, 100% {
          transform: scale(1);
          opacity: 1;
        }
        50% {
          transform: scale(1.1);
          opacity: 0.8;
        }
      }
    </style>
    @if (in_array(Route::currentRouteName(), ['home', 'about.bullying']))
    <nav class="navbar navbar-expand-lg fixed-top py-3">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-3" href="/">
          <img src="{{ asset('images/logodu.png') }}" alt="Logo" width="45" height="45">
          <div>
            <div class="brand-title">DUCARE</div>
            <div class="brand-subtitle">DARUL ULUM CARE</div>
          </div>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" style="filter: invert(1);">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
          <ul class="navbar-nav mx-auto gap-3">
            <li class="nav-item"><a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="/">Home</a></li>
            <li class="nav-item"><a class="nav-link {{ Route::currentRouteName() == 'about.bullying' ? 'active' : '' }}" href="/about-bullying">About Bullying</a></li>
            <li class="nav-item"><a class="nav-link" href="/#team">Team</a></li>
            <li class="nav-item"><a class="nav-link" href="/#kontak">Kontak</a></li>
          </ul>
          <div class="d-flex gap-3 mt-3 mt-lg-0">
            <a href="{{ route('pelapor.register') }}" class="btn btn-outline-warning px-4">Register</a>
            <a href="{{ route('login') }}" class="btn btn-outline-light px-4">Login</a>
          </div>
        </div>
      </div>
    </nav>
    @endif

    {{-- Dynamic Content Section --}}
    <main class="container-fluid p-0 m-0 w-100 d-block">
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

    <script>
      @if(session('success'))
          Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: '{{ session('success') }}',
              timer: 3000,
              showConfirmButton: false
          });
      @endif

      @if(session('error'))
          Swal.fire({
              icon: 'error',
              title: 'Gagal',
              text: '{{ session('error') }}'
          });
      @endif

      // Add loading state to forms and links
      function showLoading() {
          const overlay = document.getElementById('loadingOverlay');
          if(overlay) {
              overlay.style.display = 'flex';
              overlay.offsetHeight; // force reflow
              overlay.classList.add('show');
          }
      }

      function hideLoading() {
          const overlay = document.getElementById('loadingOverlay');
          if(overlay) {
              overlay.classList.remove('show');
              setTimeout(() => {
                  if (!overlay.classList.contains('show')) {
                      overlay.style.display = 'none';
                  }
              }, 300);
          }
      }

      // Tampilkan loading saat form dikirim
      document.querySelectorAll('form').forEach(form => {
          form.addEventListener('submit', function(e) {
              setTimeout(() => {
                  if (!e.defaultPrevented) {
                      showLoading();
                  }
              }, 50);
          });
      });

      // Tampilkan loading saat navigasi link diklik
      document.querySelectorAll('a').forEach(link => {
          link.addEventListener('click', function(e) {
              const href = this.getAttribute('href');
              const target = this.getAttribute('target');
              
              if (href && 
                  !href.startsWith('#') && 
                  !href.startsWith('javascript:') && 
                  !this.hasAttribute('download') &&
                  target !== '_blank' &&
                  !e.defaultPrevented) {
                  
                  // Jangan tampilkan langsung untuk link logout yang memerlukan konfirmasi popup
                  if (this.id !== 'logout-button' && 
                      !this.classList.contains('logout-btn') && 
                      !this.classList.contains('admin-logout-btn') &&
                      !this.classList.contains('logout-link') &&
                      this.getAttribute('onclick') === null) {
                      showLoading();
                  }
              }
          });
      });

      // Hilangkan loading jika halaman kembali dari history cache (back/forward button)
      window.addEventListener('pageshow', function(event) {
          hideLoading();
      });
    </script>

    @stack('scripts')

    
</body>

</html>