<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard DUCARE')</title>
  <link rel="shortcut icon" href="{{ asset('images/logodu.png') }}?v=3" type="image/png">
  <link rel="icon" href="{{ asset('images/logodu.png') }}?v=3" type="image/png">
  <link rel="icon" sizes="32x32" href="{{ asset('images/logodu.png') }}?v=3" type="image/png">
  <link rel="apple-touch-icon" href="{{ asset('images/logodu.png') }}?v=3">

  {{-- Bootstrap & Icons --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  {{--  SweetAlert2 untuk popup laporan pelapor  --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  {{-- Custom CSS --}}
  {{--  <link rel="stylesheet" href="{{ asset('css/style.css') }}">  --}}
    @if (Request::is('guru*'))
    <link rel="stylesheet" href="{{ asset('css/guru.css') }}">
    @elseif (Request::is('admin*'))
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @elseif (Request::is('pelapor*'))
    <link rel="stylesheet" href="{{ asset('css/pelapor.css') }}">
    @endif

    <style>
      .sidebar .nav-link {
        transition: all 0.3s ease;
        border-radius: 8px;
        margin-bottom: 5px;
      }
      .sidebar .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateX(5px);
      }
      .sidebar .nav-link.active-menu {
        background-color: #64CA3F !important;
        color: white !important;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(100, 202, 63, 0.3);
      }
      /* RESPONSIVE SIDEBAR */
  .sidebar {
    width: 250px;
    background: #1e2a38;
    min-height: 100vh;
    transition: all 0.3s ease;
    z-index: 1050;
  }

  .main-content {
    background-color: #f4f4f4;
    min-height: 100vh;
    width: 100%;
    padding: 100px 40px 40px 40px;
    transition: all 0.3s ease;
  }

  .mobile-overlay {
    display: none;
  }

  /* MOBILE */
  @media (max-width: 767.98px) {
.sidebar {
    position: fixed;
    top: 0;
    left: -100%;
    width: 250px !important;
    height: 100vh;
    z-index: 1055;
    overflow-y: auto;
    transition: left 0.3s ease;
    display: block !important;
  }

  .sidebar.active {
    left: 0;
  }

  .main-content {
    padding-top: 90px;
    padding-left: 16px;
    padding-right: 16px;
    padding-bottom: 20px;
    width: 100%;
  }

  .mobile-topbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background: white;
    z-index: 1040;
    padding: 15px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
  }

  .mobile-overlay.active {
    display: block;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.4);
    z-index: 1050;
  }
  }

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
  <div class="mobile-overlay" id="mobileOverlay"></div>
  <div class="d-flex">
    {{-- Sidebar --}}
    <aside id="sidebar" class="sidebar p-4 text-white" style="width: 250px; background: #1e2a38; min-height: 100vh;">
      <div class="mobile-overlay" id="mobileOverlay"></div>
      <div class="text-center mb-4" style="margin-top: 30px">
        <img src="{{ asset('images/logodu.png') }}" alt="Logo DUCARE" class="logo-dashboard mb-2" style="max-width: 80px;">
        <h5 class="fw-bold">DUCARE</h5>
      </div>

      <ul class="nav flex-column mt-4">
        <li class="nav-item mb-3">
          <a href="{{ route('pelapor.dashboard') }}" class="nav-link text-white {{ Route::currentRouteName() == 'pelapor.dashboard' ? 'active-menu' : '' }}">🏠 Dashboard</a>
        </li>
        <li class="nav-item mb-3">
          <a href="{{ route('buat.laporan') }}" class="nav-link text-white {{ in_array(Route::currentRouteName(), ['buat.laporan', 'laporan.create']) ? 'active-menu' : '' }}">📝 Buat Laporan</a>
        </li>
        <li class="nav-item mb-3">
          <a href="{{ route('status.laporan') }}" class="nav-link text-white {{ in_array(Route::currentRouteName(), ['status.laporan', 'detail.laporan', 'ubah.laporan']) ? 'active-menu' : '' }}">
            <i class="fas fa-clipboard-list me-2"></i> Status Laporan
          </a>
        </li>
        <li class="nav-item mb-3">
          <a class="nav-link text-white {{ Route::currentRouteName() == 'panduan.laporan' ? 'active-menu' : '' }}" href="{{ route('panduan.laporan') }}">
            <i class="bi bi-book me-2"></i>Panduan
          </a>
        </li>
        <li class="nav-item mb-3">
          <a href="{{ route('profile.laporan') }}" class="nav-link text-white {{ Route::currentRouteName() == 'profile.laporan' ? 'active-menu' : '' }}"><i class="bi bi-person me-2"></i>Profil</a>
        </li>
        <li class="nav-item mb-3">
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="button" id="logout-button"
              class="nav-link text-white w-100 text-start d-flex align-items-center border-0 bg-transparent">
              <i class="bi bi-box-arrow-right me-2"></i>Logout
            </button>
          </form>
        </li>
        
      </ul>
    </aside>

    <div class="mobile-topbar d-md-none">
  <button class="btn btn-success" onclick="toggleSidebar()">
    <i class="bi bi-list"></i>
  </button>


</div>

    {{-- Main Content --}}
    <main class="flex-grow-1 main-content">
      @yield('content')
    </main>
  </div>

  {{-- Bootstrap Bundle JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const logoutButton = document.getElementById('logout-button');
    const logoutForm = document.getElementById('logout-form');

    if (logoutButton && logoutForm) {
      logoutButton.addEventListener('click', function (e) {
        e.preventDefault();
        Swal.fire({
          title: 'Yakin ingin logout?',
          text: "Kamu akan keluar dari aplikasi.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, logout',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            showLoading();
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = logoutForm.action;

            const csrf = logoutForm.querySelector('input[name="_token"]');
            if (csrf) {
              const csrfInput = document.createElement('input');
              csrfInput.type = 'hidden';
              csrfInput.name = '_token';
              csrfInput.value = csrf.value;
              form.appendChild(csrfInput);
            }

            document.body.appendChild(form);
            form.submit();
          }
        });
      });
    }
  });

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

{{--  icon clik responsip Mobil  --}}
<script>

function toggleSidebar() {

  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('mobileOverlay');

  sidebar.classList.toggle('active');
  overlay.classList.toggle('active');
}

document.getElementById('mobileOverlay')
.addEventListener('click', function () {

  document.getElementById('sidebar')
    .classList.remove('active');

  this.classList.remove('active');

});

</script>
</body>
</html>
