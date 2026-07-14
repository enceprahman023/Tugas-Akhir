@extends('layouts.main')

@section('content')
<style>
    body {
        background-color: #f8fafc;
        font-family: 'Plus Jakarta Sans', sans-serif;
        padding-top: 0 !important; /* Hilangkan padding navbar home */
    }
    .guru-wrapper {
        display: flex;
        min-height: 100vh;
        width: 100%;
    }
    
    /* Sidebar Guru BK (Navy Theme dengan aksen Oranye) */
    .guru-sidebar {
        width: 280px;
        background: #1e293b;
        color: #fff;
        padding: 40px 20px;
        box-shadow: 4px 0 20px rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 1000;
        overflow-y: auto;
    }
    .guru-sidebar::-webkit-scrollbar { width: 6px; }
    .guru-sidebar::-webkit-scrollbar-thumb { background: #475569; border-radius: 10px; }

    .guru-sidebar .logo-container {
        text-align: center;
        margin-bottom: 40px;
    }
    .guru-sidebar .logo-container img {
        width: 70px;
        filter: drop-shadow(0 4px 10px rgba(0,0,0,0.2));
        margin-bottom: 12px;
    }
    .guru-sidebar .nav-link {
        color: #cbd5e1;
        padding: 14px 20px;
        border-radius: 12px;
        margin-bottom: 8px;
        transition: all 0.3s;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 14px;
        text-decoration: none;
    }
    .guru-sidebar .nav-link i {
        font-size: 1.1rem;
        width: 20px;
        text-align: center;
    }
    .guru-sidebar .nav-link:hover {
        background: rgba(255,255,255,0.05);
        color: #fff;
        transform: translateX(5px);
    }
    .guru-sidebar .nav-link.active {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: #fff;
        font-weight: 700;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }
    .guru-sidebar .logout-btn {
        margin-top: auto;
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }
    .guru-sidebar .logout-btn:hover {
        background: #ef4444;
        color: #fff;
        transform: none;
    }

    /* Main Content */
    .guru-main {
        flex-grow: 1;
        margin-left: 280px; /* Lebar sidebar */
        padding: 50px;
        background-color: #f8fafc;
        min-height: 100vh;
    }

    .guru-overlay {
        display: none;
    }

    @media (max-width: 991px) {
       .guru-sidebar {
        position: fixed;
        top: 0;
        left: -280px;
        width: 280px;
        height: 100vh;
        z-index: 1055;
        transition: left 0.3s ease;
        padding: 30px 20px;
        flex-direction: column;
        flex-wrap: nowrap;
        justify-content: flex-start;
    }

    .guru-sidebar.active {
        left: 0;
    }

    .guru-sidebar .logo-container {
        margin-bottom: 30px;
    }

    .guru-sidebar .nav-link {
        width: 100%;
        margin-bottom: 8px;
        padding: 14px 20px;
    }

    .guru-main {
        margin-left: 0;
        padding: 90px 16px 20px 16px;
    }

    .guru-mobile-topbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: white;
        z-index: 1040;
        padding: 14px 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .guru-overlay.active {
        display: block;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.4);
        z-index: 1050;
    }
    }
</style>

<div class="guru-wrapper">
    <div class="guru-overlay" id="guruOverlay"></div>
    <!-- Sidebar -->
    <aside id="guruSidebar" class="guru-sidebar">
        <div class="logo-container">
            <img src="{{ asset('images/logodu.png') }}" alt="Logo">
            <h5 class="fw-bold text-white mb-0 mt-2">DUCARE BK</h5>
        </div>
        <nav class="nav flex-column w-100">
            <a href="{{ route('guru.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'guru.dashboard' ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Dashboard</a>
            <a href="{{ route('guru.kelola') }}" class="nav-link {{ Route::currentRouteName() == 'guru.kelola' ? 'active' : '' }}"><i class="fa-solid fa-clipboard-list"></i> Kelola Laporan</a>
            <a href="{{ route('guru.cetak') }}" class="nav-link {{ Route::currentRouteName() == 'guru.cetak' ? 'active' : '' }}"><i class="fa-solid fa-print"></i> Cetak Laporan</a>
            <a href="{{ route('guru.panduan') }}" class="nav-link {{ Route::currentRouteName() == 'guru.panduan' ? 'active' : '' }}"><i class="fa-solid fa-book"></i> Panduan</a>
            <a href="{{ route('guru.profile') }}" class="nav-link {{ Route::currentRouteName() == 'guru.profile' ? 'active' : '' }}"><i class="fa-solid fa-user"></i> Profile</a>
            
            <form id="logout-form" action="{{ route('guru.logout') }}" method="POST" class="mt-5 w-100">
                @csrf
                <a href="#" class="nav-link logout-btn" onclick="event.preventDefault(); showLogoutPopup();">
                    <i class="fa-solid fa-right-from-bracket"></i> Akhiri Sesi
                </a>
            </form>
        </nav>
    </aside>

{{--  Respon Mobile  --}}
<div class="guru-mobile-topbar d-lg-none">
    
    <button class="btn btn-warning" onclick="toggleGuruSidebar()">
        <i class="fa-solid fa-bars"></i>
    </button>
</div>

    <!-- Konten Utama -->
    <main class="guru-main">
        @yield('guru-content')
    </main>
</div>

<!-- SweetAlert Logout Script included globally for Guru pages -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function showLogoutPopup() {
    Swal.fire({
        title: 'Akhiri Sesi?',
        text: 'Anda akan keluar dari portal Guru BK.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#f59e0b',
        cancelButtonColor: '#94a3b8',
        confirmButtonText: 'Ya, Keluar',
        cancelButtonText: 'Batal',
        backdrop: true,
        customClass: {
            popup: 'rounded-4'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    });
}
</script>

<script>

function toggleGuruSidebar() {

    document.getElementById('guruSidebar')
        .classList.toggle('active');

    document.getElementById('guruOverlay')
        .classList.toggle('active');
}

document.getElementById('guruOverlay')
?.addEventListener('click', function () {

    document.getElementById('guruSidebar')
        .classList.remove('active');

    this.classList.remove('active');

});

</script>

@endpush
@endsection
