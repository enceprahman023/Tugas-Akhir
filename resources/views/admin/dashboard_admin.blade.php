@extends('layouts.admin-layout')

@section('title', 'Dashboard Admin')

@section('admin-content')
<style>
    .welcome-banner {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        border-radius: 20px;
        padding: 40px;
        color: white;
        margin-bottom: 30px;
        box-shadow: 0 10px 25px rgba(2, 132, 199, 0.2);
        position: relative;
        overflow: hidden;
    }

    .welcome-banner::after {
        content: '';
        position: absolute;
        right: -50px;
        top: -100px;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .welcome-banner h2 {
        font-weight: 800;
        margin-bottom: 10px;
        position: relative;
        z-index: 2;
    }

    .welcome-banner p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin: 0;
        position: relative;
        z-index: 2;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 25px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        border: 1px solid #f1f5f9;
        transition: all 0.3s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(2, 132, 199, 0.1);
        border-color: #e0f2fe;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    .stat-info h6 {
        color: #64748b;
        font-size: 0.9rem;
        font-weight: 700;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-info h3 {
        font-size: 2rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
        line-height: 1;
    }

    /* Icon Colors */
    .icon-primary { background: #e0f2fe; color: #0284c7; }
    .icon-warning { background: #fff7ed; color: #ea580c; }
    .icon-success { background: #dcfce7; color: #16a34a; }
    .icon-danger { background: #fee2e2; color: #dc2626; }
    .icon-purple { background: #f3e8ff; color: #9333ea; }
    .icon-teal { background: #ccfbf1; color: #0d9488; }
</style>

<div class="welcome-banner">
    <h2>Selamat Datang, Administrator</h2>
    <p>Kelola seluruh aktivitas pengguna, laporan bullying, dan akses sistem melalui panel ini.</p>
</div>

<h4 class="fw-bold mb-4" style="color: #1e293b;"><i class="fa-solid fa-chart-line text-info me-2"></i> Ringkasan Sistem</h4>

<div class="row g-4">
    <!-- Total Laporan -->
    <div class="col-md-4 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon icon-primary">
                <i class="fa-solid fa-inbox"></i>
            </div>
            <div class="stat-info">
                <h6>Total Laporan</h6>
                <h3>{{ $totalLaporan }}</h3>
            </div>
        </div>
    </div>

    <!-- Belum Ditangani -->
    <div class="col-md-4 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon icon-warning">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <div class="stat-info">
                <h6>Belum Ditangani</h6>
                <h3>{{ $laporanBelum }}</h3>
            </div>
        </div>
    </div>

    <!-- Selesai -->
    <div class="col-md-4 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon icon-success">
                <i class="fa-solid fa-check-double"></i>
            </div>
            <div class="stat-info">
                <h6>Laporan Selesai</h6>
                <h3>{{ $laporanSelesai }}</h3>
            </div>
        </div>
    </div>

    <!-- Ditolak -->
    <div class="col-md-4 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon icon-danger">
                <i class="fa-solid fa-ban"></i>
            </div>
            <div class="stat-info">
                <h6>Laporan Ditolak</h6>
                <h3>{{ $laporanDitolak }}</h3>
            </div>
        </div>
    </div>

    <!-- Total Pelapor -->
    <div class="col-md-4 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon icon-purple">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stat-info">
                <h6>Total Pelapor (Siswa)</h6>
                <h3>{{ $totalUser }}</h3>
            </div>
        </div>
    </div>

    <!-- Total Guru -->
    <div class="col-md-4 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon icon-teal">
                <i class="fa-solid fa-user-tie"></i>
            </div>
            <div class="stat-info">
                <h6>Total Guru BK</h6>
                <h3>{{ $totalGuru }}</h3>
            </div>
        </div>
    </div>
</div>

@endsection
