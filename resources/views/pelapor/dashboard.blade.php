@extends('layouts.dashboard-layout')

@section('content')
<style>
  /* Modern Dashboard Styles */
  .greeting-card {
    background: linear-gradient(135deg, #64CA3F 0%, #3e8a24 100%);
    color: white;
    border-radius: 20px;
    padding: 40px 35px;
    box-shadow: 0 10px 30px rgba(100, 202, 63, 0.2);
    position: relative;
    overflow: hidden;
  }
  .greeting-card::after {
    content: '';
    position: absolute;
    right: -50px;
    top: -50px;
    width: 250px;
    height: 250px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
  }
  .greeting-card::before {
    content: '';
    position: absolute;
    right: 150px;
    bottom: -80px;
    width: 150px;
    height: 150px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 50%;
  }
  
  .stat-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 28px;
    border: none;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    position: relative;
    overflow: hidden;
  }


  .stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
  }
  .icon-wrapper {
    width: 56px;
    height: 56px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    margin-bottom: 20px;
  }
  .icon-green { background: #dcfce7; color: #166534; }
  .icon-yellow { background: #fef08a; color: #854d0e; }
  
  .stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 4px;
    line-height: 1.1;
  }
  .stat-label {
    font-size: 1rem;
    color: #64748b;
    font-weight: 500;
  }

  .notif-card {
    background: #ffffff;
    border-radius: 20px;
    border: none;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
  }
  .notif-item {
    padding: 16px;
    border-radius: 14px;
    background: #f8fafc;
    margin-bottom: 12px;
    display: flex;
    align-items: flex-start;
    gap: 14px;
    transition: background 0.2s, transform 0.2s;
    border: 1px solid #f1f5f9;
  }
  .notif-item:hover {
    background: #f1f5f9;
    transform: translateX(5px);
  }
  .notif-icon {
    margin-top: 2px;
    color: #64CA3F;
    font-size: 1.2rem;
  }
</style>

<div class="container py-3">
  <!-- Greeting Banner -->
  <div class="greeting-card mb-5">
    <h2 class="fw-bold mb-2" style="position: relative; z-index: 2;">👋 Halo, {{ auth()->user()->name ?? 'Pelapor' }}!</h2>
    <p class="mb-0" style="opacity: 0.95; font-size: 1.15rem; position: relative; z-index: 2; max-width: 600px;">
      Selamat datang di Dashboard DUCARE. Jangan pernah ragu atau takut untuk melaporkan setiap tindak perundungan yang kamu lihat atau alami.
    </p>
  </div>

  <div class="row g-4">
    <!-- Card: Jumlah Laporan -->
    <div class="col-md-4">
      <div class="stat-card">
        <div class="icon-wrapper icon-green">
          <i class="bi bi-file-earmark-text-fill"></i>
        </div>
        <div class="stat-number">{{ $jumlahLaporan }}</div>
        <div class="stat-label">Total Laporan Kamu</div>
      </div>
    </div>

    <!-- Card: Status Terakhir -->
    <div class="col-md-4">
      <div class="stat-card">
        <div class="icon-wrapper icon-yellow">
          <i class="bi bi-activity"></i>
        </div>
        @php
            $statusStr = $statusTerakhir ? $statusTerakhir->status : 'Belum Ada';
            if($statusStr == 'Selesai') $statusColor = '#16a34a';
            elseif($statusStr == 'Ditolak') $statusColor = '#dc2626';
            elseif($statusStr == 'Dalam Proses') $statusColor = '#d97706';
            else $statusColor = '#64748b';
        @endphp
        <div class="stat-number" style="font-size: 2rem; color: {{ $statusColor }};">{{ $statusStr }}</div>
        <div class="stat-label">Status Laporan Terakhir</div>
      </div>
    </div>

    <!-- Card: Notifikasi -->
    <div class="col-md-4">
      <div class="notif-card p-4 h-100">
        <h5 class="fw-bold mb-4" style="color: #1e293b;"><i class="bi bi-bell-fill text-warning me-2"></i> Pembaruan Laporan</h5>
        
        @if ($notifikasi->isEmpty())
          <div class="text-center py-5">
            <i class="bi bi-inbox text-muted" style="font-size: 3rem; opacity: 0.5;"></i>
            <p class="text-muted mt-3 mb-0" style="font-weight: 500;">Belum ada pembaruan laporan saat ini.</p>
          </div>
        @else
          <div class="notif-list">
            @foreach ($notifikasi as $notif)
              <div class="notif-item">
                <div class="notif-icon"><i class="bi bi-check-circle-fill"></i></div>
                <div>
                  <h6 class="mb-1 fw-bold" style="color: #334155; font-size: 0.95rem;">{{ $notif->judul_laporan }}</h6>
                  <p class="mb-0 text-muted" style="font-size: 0.85rem;">Status saat ini: <span class="fw-bold" style="color: #64CA3F;">{{ $notif->status }}</span></p>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>

  </div>
</div>
@endsection
