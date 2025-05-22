<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Dashboard Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="dashboard-admin">

<header>
  <div class="header-left">
    <img src="{{ asset('images/logodu.png') }}" alt="Logo Sekolah">
  </div>

  <nav class="menu">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.kelola.laporan') }}">Kelola Laporan</a>
    <a href="{{ route('admin.cetak') }}">Cetak Laporan</a>
    <a href="{{ route('admin.kelola.akun') }}">Kelola Akun</a>
    <a href="{{ route('admin.panduan.admin') }}">Panduan</a>
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Logout
</a>

  </nav>

  <div class="header-right" title="Admin Profile">
    <img src="images/admin-profile.jpg" alt="Foto Admin" />
    <span>Nama Admin</span>
  </div>
</header>

<main>
    <div class="widget statistik">
  <h2>Statistik Laporan</h2>
  <div class="stat-grid">
    <div class="stat-card">
      <span class="icon">🔢</span>
      <div>
        <p class="stat-value">120</p>
        <p class="stat-label">Total Laporan Masuk</p>
      </div>
    </div>
    <div class="stat-card">
      <span class="icon">📄</span>
      <div>
        <p class="stat-value">85</p>
        <p class="stat-label">Laporan Ditangani</p>
      </div>
    </div>
    <div class="stat-card">
      <span class="icon">🕒</span>
      <div>
        <p class="stat-value">35</p>
        <p class="stat-label">Belum Ditangani</p>
      </div>
    </div>
    <div class="stat-card">
      <span class="icon">👥</span>
      <div>
        <p class="stat-value">50</p>
        <p class="stat-label">Jumlah Pengguna</p>
      </div>
    </div>
  </div>
</div>
</main>

</body>
</html>
