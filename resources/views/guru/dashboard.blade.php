@extends('layouts.guru-layout')

@section('title', 'Dashboard Guru BK')

@section('guru-content')
<style>
    .welcome-card {
        background: linear-gradient(135deg, #ffffff 0%, #fffbeb 100%);
        border-radius: 20px;
        padding: 35px 40px;
        box-shadow: 0 10px 30px rgba(245, 158, 11, 0.04);
        border: 1px solid rgba(245, 158, 11, 0.1);
        margin-bottom: 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        overflow: hidden;
    }
    .welcome-card::after {
        content: ''; position: absolute; right: -50px; top: -50px;
        width: 200px; height: 200px; background: rgba(245, 158, 11, 0.05);
        border-radius: 50%;
    }
    .welcome-text h3 {
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 8px;
        font-size: 2rem;
    }
    .welcome-text p {
        color: #64748b;
        margin-bottom: 0;
        font-size: 1.1rem;
    }

    /* Stat Cards */
    .stat-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        border: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 24px;
        transition: all 0.3s;
        height: 100%;
    }
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.06);
    }
    .stat-icon {
        width: 75px;
        height: 75px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
    }
    .stat-proses .stat-icon { background: #fef3c7; color: #f59e0b; }
    .stat-selesai .stat-icon { background: #dcfce7; color: #16a34a; }
    .stat-tolak .stat-icon { background: #fee2e2; color: #ef4444; }
    
    .stat-info h6 {
        color: #64748b;
        font-size: 0.95rem;
        font-weight: 700;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .stat-info h4 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 0;
        line-height: 1;
    }

    /* Chart Card */
    .chart-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        border: 1px solid #f1f5f9;
        height: 100%;
    }
    .chart-card h5 {
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 30px;
        text-align: center;
    }
</style>

<div class="welcome-card">
    <div class="welcome-text">
        <h3>Selamat Datang, Guru BK</h3>
        <p>Pantau statistik dan kelola semua laporan indikasi bullying dengan mudah.</p>
    </div>
    <div class="d-none d-md-block" style="position: relative; z-index: 2;">
        <i class="fa-solid fa-shield-halved" style="font-size: 70px; color: #f59e0b; opacity: 0.2;"></i>
    </div>
</div>

<div class="row g-4 mb-5">
    <!-- Dalam Proses -->
    <div class="col-md-4">
        <div class="stat-card stat-proses">
            <div class="stat-icon">
                <i class="fa-solid fa-spinner fa-spin-pulse"></i>
            </div>
            <div class="stat-info">
                <h6>Dalam Proses</h6>
                <h4>{{ $jumlahProses }}</h4>
            </div>
        </div>
    </div>
    <!-- Selesai -->
    <div class="col-md-4">
        <div class="stat-card stat-selesai">
            <div class="stat-icon">
                <i class="fa-solid fa-check-double"></i>
            </div>
            <div class="stat-info">
                <h6>Telah Selesai</h6>
                <h4>{{ $jumlahSelesai }}</h4>
            </div>
        </div>
    </div>
    <!-- Ditolak -->
    <div class="col-md-4">
        <div class="stat-card stat-tolak">
            <div class="stat-icon">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <div class="stat-info">
                <h6>Ditolak</h6>
                <h4>{{ $jumlahTolak }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="chart-card">
            <h5>Visualisasi Status Laporan</h5>
            <div style="height: 350px; position: relative; margin: 0 auto; width: 100%; display: flex; justify-content: center;">
                <canvas id="laporanChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('laporanChart').getContext('2d');
    
    // Gradasi untuk chart agar terlihat modern
    const gradientProses = ctx.createLinearGradient(0, 0, 0, 400);
    gradientProses.addColorStop(0, '#fcd34d');
    gradientProses.addColorStop(1, '#f59e0b');

    const gradientSelesai = ctx.createLinearGradient(0, 0, 0, 400);
    gradientSelesai.addColorStop(0, '#86efac');
    gradientSelesai.addColorStop(1, '#22c55e');

    const gradientTolak = ctx.createLinearGradient(0, 0, 0, 400);
    gradientTolak.addColorStop(0, '#fca5a5');
    gradientTolak.addColorStop(1, '#ef4444');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Dalam Proses', 'Selesai', 'Ditolak'],
            datasets: [{
                data: [{{ $jumlahProses }}, {{ $jumlahSelesai }}, {{ $jumlahTolak }}],
                backgroundColor: [gradientProses, gradientSelesai, gradientTolak],
                borderWidth: 0,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 25,
                        font: {
                            family: "'Plus Jakarta Sans', sans-serif",
                            size: 14,
                            weight: '600'
                        },
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    titleFont: { size: 14, family: "'Plus Jakarta Sans'" },
                    bodyFont: { size: 14, family: "'Plus Jakarta Sans'", weight: 'bold' },
                    displayColors: false,
                    cornerRadius: 8
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
});
</script>
@endpush
