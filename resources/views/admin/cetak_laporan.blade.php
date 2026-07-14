@extends('layouts.admin-layout')

@section('title', 'Cetak Laporan - Admin')

@section('admin-content')
<style>
    /* Print Media Queries */
    @media print {
        body * {
            visibility: hidden;
        }
        .print-area, .print-area * {
            visibility: visible;
        }
        .print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .no-print {
            display: none !important;
        }
        .admin-navbar {
            display: none !important;
        }
        body {
            padding-top: 0 !important;
            background-color: white !important;
        }
        .table-responsive {
            overflow: visible !important;
        }
    }
</style>

<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <div>
            <h3 class="fw-bold" style="color: #0f172a;"><i class="fa-solid fa-print text-primary me-2"></i> Cetak Laporan</h3>
            <p class="text-muted mb-0">Kelola dan unduh dokumen laporan sistem DUCARE.</p>
        </div>
        <div>
            <!-- Tombol Cetak Rekap Keseluruhan (Native Browser Print) -->
            <button onclick="window.print()" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="fa-solid fa-print me-2"></i> Cetak Rekap Semua
            </button>
        </div>
    </div>

    <!-- Search / Filter Box (No Print) -->
    <div class="card border-0 shadow-sm rounded-4 mb-4 no-print bg-primary bg-opacity-10 border border-primary border-opacity-25">
        <div class="card-body p-3 d-flex align-items-center gap-3">
            <i class="fa-solid fa-magnifying-glass text-primary ms-2"></i>
            <input type="text" id="searchInput" class="form-control border-0 bg-transparent shadow-none" placeholder="Cari laporan berdasarkan nama, NIS, NIP, atau judul laporan..." onkeyup="filterLaporan()">
        </div>
    </div>

    <!-- Print Area -->
    <div class="print-area">
        <div class="d-none d-print-block text-center mb-4">
            <img src="{{ asset('images/logodu.png') }}" alt="Logo" style="width: 80px; margin-bottom: 10px;">
            <h3 class="fw-bold text-uppercase">Laporan Rekapitulasi Kasus Bullying</h3>
            <p class="mb-0">Sistem Pengaduan DUCARE - Divisi Administrator</p>
            <p class="small text-muted">Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}</p>
            <hr>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="tabelCetak">
                        <thead style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                            <tr>
                                <th class="text-secondary fw-semibold py-3" width="15%">No. Registrasi</th>
                                <th class="text-secondary fw-semibold py-3">Tanggal Laporan</th>
                                <th class="text-secondary fw-semibold py-3">Subjek / Pelaku</th>
                                <th class="text-secondary fw-semibold py-3">Status</th>
                                <th class="text-secondary fw-semibold py-3 text-center no-print" width="20%">Aksi Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($laporans as $laporan)
                            <tr class="laporan-row">
                                <td>
                                    <span class="badge bg-light text-dark border font-monospace">LAP-{{ str_pad($laporan->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td>
                                    <span class="fw-medium text-dark">{{ $laporan->created_at->format('d M Y') }}</span>
                                    <div class="small text-muted">{{ $laporan->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark laporan-searchable">{{ $laporan->nama_pembully }}</div>
                                    <div class="small text-muted laporan-searchable">{{ $laporan->judul_laporan }}</div>
                                </td>
                                <td>
                                    @php
                                        $badge = 'secondary';
                                        if ($laporan->status === 'Dalam Proses') $badge = 'warning';
                                        elseif ($laporan->status === 'Selesai') $badge = 'success';
                                        elseif ($laporan->status === 'Ditolak') $badge = 'danger';
                                    @endphp
                                    <span class="badge bg-{{ $badge }}-subtle text-{{ $badge }} px-3 py-1 rounded-pill border border-{{ $badge }}-subtle">
                                        {{ $laporan->status ?? 'Belum Ada' }}
                                    </span>
                                </td>
                                <td class="text-center no-print">
                                    <a href="{{ route('admin.cetak.detail', $laporan->id) }}" class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm" target="_blank">
                                        <i class="fa-solid fa-file-pdf me-1"></i> Download PDF
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <i class="fa-solid fa-folder-open text-muted mb-3" style="font-size: 3rem; opacity: 0.5;"></i>
                                        <h5 class="text-muted fw-medium">Belum ada laporan.</h5>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Fitur Live Search
    function filterLaporan() {
        let input = document.getElementById('searchInput');
        let filter = input.value.toLowerCase();
        let rows = document.querySelectorAll('.laporan-row');

        rows.forEach(row => {
            let searchableElements = row.querySelectorAll('.laporan-searchable, .font-monospace');
            let textMatch = false;

            searchableElements.forEach(el => {
                if (el.textContent.toLowerCase().includes(filter)) {
                    textMatch = true;
                }
            });

            if (textMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endpush
@endsection
