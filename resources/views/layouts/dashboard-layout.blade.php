<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard DUCARE')</title>

  {{-- Bootstrap & Icons --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  {{-- Custom CSS --}}
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

  <div class="d-flex">
    {{-- Sidebar --}}
    <aside class="sidebar p-4 text-white" style="width: 250px; background: #1e2a38; min-height: 100vh;">
      <div class="text-center mb-4" style="margin-top: 30px">
        <img src="{{ asset('images/logodu.png') }}" alt="Logo DUCARE" class="logo-dashboard mb-2" style="max-width: 80px;">
        <h5 class="fw-bold">DUCARE</h5>
      </div>

      <ul class="nav flex-column mt-4">
        <li class="nav-item mb-3">
          <a href="{{ route('dashboard') }}" class="nav-link text-white">🏠 Dashboard</a>
        </li>
        <li class="nav-item mb-3">
          <a href="{{ route('buat.laporan') }}" class="nav-link text-white">📝 Buat Laporan</a>
        </li>
        <li class="nav-item mb-3">
          <a href="{{ route('status.laporan') }}" class="nav-link text-white">
            <i class="fas fa-clipboard-list me-2"></i> Status Laporan
          </a>
        </li>
        <li class="nav-item mb-3">
          <a class="nav-link text-white" href="{{ route('panduan.laporan') }}">
            <i class="bi bi-book me-2"></i>Panduan
          </a>
        </li>
        <li class="nav-item mb-3">
          <a href="{{ route('profile.laporan') }}" class="nav-link text-white"><i class="bi bi-person me-2"></i>Profil</a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="button" id="logout-button"
            class="logout-btn w-100 text-start d-flex align-items-center border-0 bg-transparent px-3 py-2">
            <i class="bi bi-box-arrow-right me-2"></i>Logout
          </button>
        </form>
        
      </ul>
    </aside>

    {{-- Main Content --}}
    <main class="flex-grow-1 p-5" style="background-color: #f4f4f4;">
      @yield('content')
    </main>
  </div>

  {{-- Bootstrap Bundle JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const logoutButton = document.getElementById('logout-button');
      const logoutForm = document.getElementById('logout-form');

      if (logoutButton && logoutForm) {
        logoutButton.addEventListener('click', function (e) {
          e.preventDefault(); // Hindari default POST yang bisa bermasalah karena <form> di <ul>
          if (confirm('Apakah kamu yakin ingin logout?')) {
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
      }
    });
  </script>

</body>
</html>
