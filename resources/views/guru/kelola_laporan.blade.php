@extends('layouts.guru-layout')

@section('title', 'Kelola Laporan')

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

        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .modal-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-bottom: 1px solid #e2e8f0;
            border-radius: 20px 20px 0 0;
            padding: 20px 25px;
        }
        .modal-title { font-weight: 800; color: #1e293b; }
        .table-detail th { width: 30%; color: #64748b; font-weight: 600; }
        .table-detail td { color: #1e293b; font-weight: 500; }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-4 rounded-4 shadow-sm border border-light">
        <div>
            <h3 class="fw-bold mb-1" style="color: #1e293b;"><i class="fa-solid fa-file-signature text-warning me-2"></i>Kelola Laporan Masuk</h3>
            <p class="text-muted mb-0 small">Tinjau, tangani, dan perbarui status laporan yang masuk secara berkala.</p>
        </div>
    </div>

        <div class="table-card">
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th>No. Laporan</th>
                            <th>Judul Laporan</th>
                            <th>Status</th>
                            <th>Tanggal Laporan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporans as $laporan)
                            <tr>
                                <td class="fw-bold text-secondary">LAP-{{ str_pad($laporan->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td class="fw-semibold">{{ $laporan->judul_laporan }}</td>
                                <td>
                                    @php
                                        $badge = 'secondary';
                                        if ($laporan->status === 'Dalam Proses') $badge = 'warning';
                                        elseif ($laporan->status === 'Selesai') $badge = 'success';
                                        elseif ($laporan->status === 'Ditolak') $badge = 'danger';
                                    @endphp
                                    <span class="badge-custom badge-{{ $badge }}"><i class="fa-solid fa-circle fa-2xs me-1"></i> {{ $laporan->status ?? 'Belum Ada' }}</span>
                                </td>
                                <td>{{ $laporan->created_at->format('d M Y') }}</td>
                                <td>
                                    <button class="btn btn-action btn-info-custom me-1" data-bs-toggle="modal" data-bs-target="#detailModal-{{ $laporan->id }}"><i class="fa-solid fa-eye"></i> Detail</button>
                                    
                                    <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST" class="d-inline" onsubmit="confirmDelete(event, this)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-action btn-danger-custom"><i class="fa-solid fa-trash-can"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <i class="fa-solid fa-inbox text-muted" style="font-size: 3rem; opacity: 0.5;"></i>
                                        <p class="mt-3 text-muted fw-medium">Belum ada laporan yang masuk.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @foreach ($laporans as $laporan)
        <!-- Modal Detail -->
        <div class="modal fade" id="detailModal-{{ $laporan->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $laporan->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Laporan LAP-{{ str_pad($laporan->id, 3, '0', STR_PAD_LEFT) }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-detail table-borderless">
                            <tr><th>Judul Laporan</th><td>: {{ $laporan->judul_laporan }}</td></tr>
                            <tr><th>Status</th><td>: <span class="badge-custom badge-secondary">{{ $laporan->status ?? 'Belum Ada' }}</span></td></tr>
                            <tr><th>Tanggal Laporan</th><td>: {{ $laporan->created_at->format('d M Y, H:i') }}</td></tr>
                            <tr><th>Pelaku</th><td>: <span class="text-danger fw-bold">{{ $laporan->nama_pembully }}</span></td></tr>
                            <tr><th>Pelapor</th><td>: {{ $laporan->nama_pelapor === 'Anonim' ? 'Laporan ini dikirim secara anonim' : $laporan->nama_pelapor }}</td></tr>
                            <tr><th>Saksi</th><td>: {{ $laporan->nama_saksi ?? '-' }}</td></tr>
                            <tr><th>Deskripsi</th><td>: {{ $laporan->isi_laporan }}</td></tr>
                            <tr>
                                <th>Bukti Foto</th>
                                <td>: 
                                    @if ($laporan->bukti_gambar)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $laporan->bukti_gambar) }}"
                                                class="img-fluid zoomable-image rounded-3 shadow-sm"
                                                style="max-height: 150px; cursor: zoom-in; border: 2px solid #f1f5f9;">
                                        </div>
                                    @else
                                        <span class="text-muted fst-italic">Tidak ada bukti gambar yang dilampirkan</span>
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <!-- Form Penanganan -->
                        <div class="mt-4 bg-light p-4 rounded-4 border border-warning border-opacity-25">
                            <h6 class="fw-bold text-warning mb-3"><i class="fa-solid fa-pen-to-square me-2"></i>Catatan Penanganan</h6>
                            <form action="{{ route('laporan.updatePenanganan', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-secondary small">Detail Penanganan</label>
                                    <textarea name="catatan_penanganan" class="form-control border-0 shadow-sm" rows="3" placeholder="Tulis catatan penanganan / hasil investigasi...">{{ $laporan->catatan_penanganan }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold text-secondary small">Tanggal Penanganan</label>
                                        <input type="date" name="tanggal_penanganan" class="form-control border-0 shadow-sm" value="{{ $laporan->tanggal_penanganan }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold text-secondary small">Ditangani Oleh</label>
                                        <input type="text" name="ditangani_oleh" class="form-control border-0 shadow-sm" value="{{ $laporan->ditangani_oleh ?? auth()->user()->name }}">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-secondary small">Tanda Tangan (opsional)</label>
                                    <input type="file" name="ttd" class="form-control border-0 shadow-sm" accept="image/*">
                                    @if ($laporan->ttd_penangan)
                                        <div class="mt-3 p-3 bg-white rounded-3 border">
                                            <p class="mb-2 small text-muted">Tanda tangan saat ini:</p>
                                            <img src="{{ asset('storage/' . $laporan->ttd_penangan) }}" alt="TTD" style="max-height: 60px;">
                                        </div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary px-4 py-2 fw-bold" style="border-radius: 10px;"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan Catatan</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between align-items-center bg-light border-top-0 rounded-bottom-4 py-3">
                        <div class="d-flex gap-2">
                            <form action="{{ route('laporan.updateStatus', $laporan->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Ditolak">
                                <button class="btn btn-outline-danger fw-bold rounded-pill px-4"><i class="fa-solid fa-ban me-1"></i> Tolak</button>
                            </form>

                            <form action="{{ route('laporan.updateStatus', $laporan->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Selesai">
                                <button class="btn btn-success fw-bold rounded-pill px-4"><i class="fa-solid fa-check me-1"></i> Selesaikan</button>
                            </form>
                        </div>

                        <div>
                            <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('shown.bs.modal', function () {
                const zoomableImages = modal.querySelectorAll('.zoomable-image');
                zoomableImages.forEach(img => {
                    img.addEventListener('click', function () {
                        img.classList.toggle('zoomed');
                    });
                });
            });
        });
    });

    function confirmDelete(event, form) {
        event.preventDefault();
        Swal.fire({
            title: 'Hapus Laporan Secara Permanen?',
            text: "Tindakan ini tidak dapat dibatalkan. Semua data dan bukti gambar laporan ini akan hilang!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fa-solid fa-trash-can me-1"></i> Ya, Hapus',
            cancelButtonText: 'Batal',
            backdrop: true,
            customClass: {
                popup: 'rounded-4',
                confirmButton: 'rounded-pill px-4',
                cancelButton: 'rounded-pill px-4'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
@endpush

