@extends('layouts.main')

@section('content')
<style>
    body {
        background-color: #f8fafc;
        font-family: 'Plus Jakarta Sans', sans-serif;
        padding-top: 85px !important; /* Offset untuk fixed navbar */
    }

    /* Admin Top Navbar (Tema Biru) */
    .admin-navbar {
        background: linear-gradient(90deg, #0f172a, #0284c7);
        padding: 0 40px;
        height: 85px;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 15px rgba(2, 132, 199, 0.2);
    }

    .admin-navbar .header-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .admin-navbar .header-left img {
        height: 45px;
        object-fit: contain;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
    }

    .admin-navbar .header-left h1 {
        font-size: 1.25rem;
        font-weight: 800;
        color: #ffffff;
        margin: 0;
        letter-spacing: 1px;
    }

    .admin-navbar .menu {
        display: flex;
        gap: 10px;
    }

    .admin-navbar .menu a {
        color: #e0f2fe;
        text-decoration: none;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .admin-navbar .menu a:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        transform: translateY(-2px);
    }

    .admin-navbar .menu a.active {
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .admin-navbar .header-right {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .admin-navbar .header-right .admin-profile {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #ffffff;
        font-weight: 600;
    }

    .admin-navbar .header-right .admin-profile img {
        height: 40px;
        width: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #38bdf8;
    }

    .admin-logout-btn {
        background: rgba(239, 68, 68, 0.1);
        color: #fca5a5;
        border: 1px solid rgba(239, 68, 68, 0.3);
        padding: 6px 15px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .admin-logout-btn:hover {
        background: #ef4444;
        color: #ffffff;
        border-color: #ef4444;
    }

    .admin-main {
        padding: 40px;
        min-height: calc(100vh - 85px);
    }

    .admin-overlay {
        display: none;
    }

    @media (max-width: 991px) {
        body {
        padding-top: 90px !important;
    }

    .admin-navbar {
        padding: 0 16px;
        height: 75px;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .admin-navbar .header-left h1 {
        font-size: 1rem;
    }

    .admin-navbar .header-left img {
        height: 38px;
    }

    .admin-navbar .menu {
        position: fixed;
        top: 75px;
        left: -100%;
        width: 280px;
        height: calc(100vh - 75px);
        background: #0f172a;
        flex-direction: column;
        align-items: flex-start;
        padding: 20px;
        transition: left 0.3s ease;
        z-index: 1050;
        overflow-y: auto;
    }

    .admin-navbar .menu.active {
        left: 0;
    }

    .admin-navbar .menu a {
        width: 100%;
        padding: 14px 16px;
        border-radius: 10px;
    }

    .admin-main {
        padding: 20px 16px;
    }

    .mobile-admin-toggle {
        display: flex !important;
        align-items: center;
        justify-content: center;
    }

    .admin-profile span {
        display: none;
    }

    .admin-overlay.active {
        display: block;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.4);
        z-index: 1040;
    }
    }
</style>

<!-- Top Navbar Admin -->
<div class="admin-overlay" id="adminOverlay"></div>
<header class="admin-navbar">
    <div class="header-left">

    {{-- Hamburger Mobile --}}
    <button
        class="btn btn-outline-light mobile-admin-toggle me-3 d-lg-none"
        onclick="toggleAdminMenu()">

        <i class="fa-solid fa-bars"></i>

    </button>

    {{-- Logo --}}
    <img src="{{ asset('images/logodu.png') }}" alt="Logo DUCARE">

    {{-- Title --}}
    <h1>ADMIN DUCARE</h1>

</div>

    <nav id="adminMenu" class="menu">
        <a href="{{ route('admin.dashboard') }}" class="{{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
        <a href="{{ route('admin.kelola.laporan') }}" class="{{ Route::currentRouteName() == 'admin.kelola.laporan' ? 'active' : '' }}"><i class="fa-solid fa-clipboard-list"></i> Kelola Laporan</a>
        <a href="{{ route('admin.cetak') }}" class="{{ Route::currentRouteName() == 'admin.cetak' ? 'active' : '' }}"><i class="fa-solid fa-print"></i> Cetak</a>
        <a href="{{ route('admin.kelola.akun') }}" class="{{ Route::currentRouteName() == 'admin.kelola.akun' ? 'active' : '' }}"><i class="fa-solid fa-users-gear"></i> Kelola Akun</a>
        <a href="{{ route('admin.panduan.admin') }}" class="{{ Route::currentRouteName() == 'admin.panduan.admin' ? 'active' : '' }}"><i class="fa-solid fa-book"></i> Panduan</a>
    </nav>

    <div class="header-right">
        <div class="admin-profile">
            <img src="{{ asset('images/admin-profile.jpg') }}" onerror="this.src='https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff'" alt="Admin" />
            <span>Admin</span>
        </div>
        <form id="admin-logout-form" action="{{ route('admin.logout.admin') }}" method="POST" class="m-0">
            @csrf
            <a href="#" class="admin-logout-btn" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                <i class="fa-solid fa-power-off"></i> Logout
            </a>
        </form>
    </div>
</header>

<!-- Main Content Area -->
<main class="admin-main">
    @yield('admin-content')
</main>
<script>

function toggleAdminMenu() {

    document.getElementById('adminMenu')
        .classList.toggle('active');

    document.getElementById('adminOverlay')
        .classList.toggle('active');
}

document.getElementById('adminOverlay')
?.addEventListener('click', function () {

    document.getElementById('adminMenu')
        .classList.remove('active');

    this.classList.remove('active');

});

</script>
@endsection
