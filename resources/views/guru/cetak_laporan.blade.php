@extends('layouts.guru-layout')

@section('title', 'Cetak Laporan')

@section('guru-content')
<div class="container-fluid p-0">
    <style>
        .table-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            border: 1px solid #f1f5f9;
            overflow: hidden;
        }
        .table-custom th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 15px 20px;
            border-bottom: 2px solid #e2e8f0;
        }
        .table-custom td {
            padding: 15px 20px;
            vertical-align: middle;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }
        .table-custom tbody tr {
            transition: all 0.2s;
        }
        .table-custom tbody tr:hover {
            background-color: #f8fafc;
        }
        .badge-custom {
            padding: 8px 12px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.8rem;
        }
        .badge-warning { background: #fef3c7; color: #d97706; }
        .badge-success { background: #dcfce7; color: #15803d; }
        .badge-danger { background: #fee2e2; color: #b91c1c; }
        .badge-secondary { background: #f1f5f9; color: #475569; }

        .btn-action {
            border-radius: 10px;
            padding: 6px 12px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.2s;
        }
        .btn-info-custom {
            background: #e0f2fe; color: #0369a1; border: none;
        }
        .btn-info-custom:hover { background: #bae6fd; color: #0284c7; }
        
        .btn-danger-custom {
            background: #fee2e2; color: #b91c1c; border: none;
        }
        .btn-danger-custom:hover { background: #fecaca; color: #991b1b; }

        .search-container {
            position: relative;
            width: 250px;
        }
        .search-container i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }
        .search-input {
            padding-left: 40px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
            transition: all 0.2s;
        }
        .search-input:focus {
            background-color: #fff;
            border-color: #f59e0b;
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
        }

        @media print {
            @page { size: A4 landscape; margin: 15mm; }
            body { background: white !important; font-size: 12pt !important; color: #000 !important; }
            
            /* Sembunyikan elemen UI yang tidak perlu dicetak */
            .guru-sidebar, .d-flex.justify-content-between, .search-container, .btn, .btn-action, .mb-4.bg-white { display: none !important; }
            
            /* Hapus margin dan padding layout utama */
            .guru-main { margin-left: 0 !important; padding: 0 !important; }
            
            /* Tampilkan header khusus cetak */
            .print-header { display: block !important; text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
            .print-header h2 { font-weight: bold; font-size: 18pt; margin-bottom: 5px; }
            .print-header p { font-size: 12pt; margin: 0; }

            /* Sesuaikan gaya tabel untuk kertas */
            .table-card { border: none !important; box-shadow: none !important; }
            .table-custom { width: 100% !important; border-collapse: collapse !important; }
            .table-custom th, .table-custom td { border: 1px solid #000 !important; padding: 8px 10px !important; color: #000 !important; }
            .table-custom th { background-color: #f0f0f0 !important; -webkit-print-color-adjust: exact; }
            
            /* Sembunyikan kolom Aksi (kolom terakhir) */
            table th:last-child, table td:last-child { display: none !important; } 
            
            /* Perbaiki tampilan badge agar jelas saat dicetak hitam-putih/warna */
            .badge-custom, .badge { border: 1px solid #000; background: transparent !important; color: #000 !important; padding: 4px 8px; font-weight: bold; }
            .fa-circle, .fa-user, .fa-user-secret { display: none !important; } /* Sembunyikan ikon pada tabel saat cetak */
        }
        
        .print-header { display: none; }
    </style>

    <!-- Header Khusus Saat Dicetak -->
    <div class="print-header">
        <h2>Rekapitulasi Laporan Indikasi Bullying</h2>
        <p>DUCARE (Sistem Pengaduan dan Penanganan Bullying)</p>
        <p style="font-size: 10pt; margin-top: 5px;">Dicetak pada: {{ now()->format('d F Y, H:i') }}</p>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-4 rounded-4 shadow-sm border border-light flex-wrap gap-3">
        <div>
            <h3 class="fw-bold mb-1" style="color: #1e293b;"><i class="fa-solid fa-print text-warning me-2"></i>Cetak Data Laporan</h3>
            <p class="text-muted mb-0 small">Cari laporan atau cetak rekapitulasi data laporan yang masuk.</p>
        </div>
        <div class="d-flex gap-3 align-items-center flex-wrap">
            <div class="search-container">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" class="form-control search-input" placeholder="Cari judul laporan...">
            </div>
            <button onclick="window.print()" class="btn btn-primary fw-bold" style="border-radius: 12px; padding: 10px 20px;">
                <i class="fa-solid fa-print me-2"></i> Cetak Rekap Semua
            </button>
        </div>
    </div>

        <div class="table-card">
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th>No. Laporan</th>
                            <th>Judul Laporan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Jenis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporans as $laporan)
                            <tr>
                                <td class="fw-bold text-secondary">LAP-{{ str_pad($laporan->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td class="fw-semibold">{{ $laporan->judul_laporan }}</td>
                                <td>{{ $laporan->created_at->format('d M Y') }}</td>
                                <td>
                                    @php
                                        $badge = 'secondary';
                                        if ($laporan->status === 'Dalam Proses') $badge = 'warning';
                                        elseif ($laporan->status === 'Selesai') $badge = 'success';
                                        elseif ($laporan->status === 'Ditolak') $badge = 'danger';
                                    @endphp
                                    <span class="badge-custom badge-{{ $badge }}"><i class="fa-solid fa-circle fa-2xs me-1"></i> {{ $laporan->status }}</span>
                                </td>
                                <td>
                                    @if($laporan->nama_pelapor === 'Anonim')
                                        <span class="badge bg-dark rounded-pill"><i class="fa-solid fa-user-secret me-1"></i> Anonim</span>
                                    @else
                                        <span class="badge bg-primary rounded-pill"><i class="fa-solid fa-user me-1"></i> Terbuka</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('guru.cetak.detail', $laporan->id) }}" class="btn btn-action btn-danger-custom me-1"><i class="fa-solid fa-file-pdf"></i> Download PDF</a>
                                </td>
                            </tr>
                        @endforeach

                        @if ($laporans->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <i class="fa-solid fa-folder-open text-muted" style="font-size: 3rem; opacity: 0.5;"></i>
                                        <p class="mt-3 text-muted fw-medium">Tidak ada laporan yang dapat dicetak.</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('tbody tr');

    searchInput.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();

        tableRows.forEach(row => {
            // Abaikan baris "Kosong"
            if (row.querySelector('td[colspan]')) return;

            const title = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const id = row.querySelector('td:nth-child(1)').textContent.toLowerCase();

            if (title.includes(searchTerm) || id.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
</script>
@endpush
@endsection
