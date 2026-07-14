@extends('layouts.admin-layout')

@section('title', 'Kelola Laporan - Admin')

@section('admin-content')
<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
        <div>
            <h3 class="fw-bold" style="color: #0f172a;"><i class="fa-solid fa-clipboard-list text-primary me-2"></i> Kelola Laporan Masuk</h3>
            <p class="text-muted mb-0">Pantau, analisis, dan berikan tindakan pada laporan yang diajukan. Gunakan filter di samping untuk mempermudah pencarian.</p>
        </div>
        
        <!-- Filter Status -->
        <div class="bg-white p-2 rounded-3 shadow-sm border d-flex align-items-center">
            <i class="fa-solid fa-filter text-primary ms-2 me-2"></i>
            <select id="filterStatus" class="form-select border-0 shadow-none fw-semibold text-secondary" style="width: 200px; cursor: pointer;" onchange="filterTabelStatus()">
                <option value="all">Semua Status</option>
                <option value="Dalam Proses">⏳ Dalam Proses</option>
                <option value="Selesai">✅ Selesai</option>
                <option value="Ditolak">❌ Ditolak</option>
            </select>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="tabelLaporan">
                    <thead style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                        <tr>
                            <th class="text-secondary fw-semibold py-3" width="12%">No. Laporan</th>
                            <th class="text-secondary fw-semibold py-3">Judul Laporan</th>
                            <th class="text-secondary fw-semibold py-3" width="15%">Tanggal</th>
                            <th class="text-secondary fw-semibold py-3" width="15%">Status</th>
                            <th class="text-secondary fw-semibold py-3 text-center" width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelBodyLaporan">
                        @forelse ($laporans as $laporan)
                        <tr class="laporan-item" data-status="{{ $laporan->status ?? 'Belum Ada' }}">
                            <td>
                                <span class="badge bg-light text-dark border font-monospace">LAP-{{ str_pad($laporan->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="fw-medium text-dark">{{ $laporan->judul_laporan }}</td>
                            <td class="text-muted small">
                                <i class="fa-regular fa-calendar me-1"></i> {{ $laporan->created_at->format('d M Y') }}
                            </td>
                            <td>
                                @php
                                    $badge = 'secondary';
                                    $icon = 'fa-circle-question';
                                    if ($laporan->status === 'Dalam Proses') { $badge = 'warning'; $icon = 'fa-spinner fa-spin'; }
                                    elseif ($laporan->status === 'Selesai') { $badge = 'success'; $icon = 'fa-check'; }
                                    elseif ($laporan->status === 'Ditolak') { $badge = 'danger'; $icon = 'fa-xmark'; }
                                @endphp
                                <span class="badge bg-{{ $badge }}-subtle text-{{ $badge }} px-3 py-2 rounded-pill border border-{{ $badge }}-subtle">
                                    <i class="fa-solid {{ $icon }} me-1"></i> {{ $laporan->status ?? 'Belum Ada' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#detailModal-{{ $laporan->id }}">
                                    <i class="fa-solid fa-eye me-1"></i> Detail
                                </button>
                                
                                <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST" class="d-inline form-hapus">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm btn-hapus">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <i class="fa-solid fa-folder-open text-muted mb-3" style="font-size: 3rem; opacity: 0.5;"></i>
                                    <h5 class="text-muted fw-medium">Belum ada laporan yang masuk.</h5>
                                    <p class="text-muted small">Sistem pengaduan saat ini kosong.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach ($laporans as $laporan)
    <!-- Modal Detail Admin -->
    <div class="modal fade" id="detailModal-{{ $laporan->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $laporan->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header bg-light border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary">Detail Laporan LAP-{{ str_pad($laporan->id, 4, '0', STR_PAD_LEFT) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small fw-semibold text-uppercase d-block mb-1">Status Laporan</span>
                            @php
                                $badge = 'secondary';
                                if ($laporan->status === 'Dalam Proses') $badge = 'warning';
                                elseif ($laporan->status === 'Selesai') $badge = 'success';
                                elseif ($laporan->status === 'Ditolak') $badge = 'danger';
                            @endphp
                            <span class="badge bg-{{ $badge }} px-3 py-2 rounded-pill">{{ $laporan->status ?? 'Belum Ada' }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small fw-semibold text-uppercase d-block mb-1">Tanggal Masuk</span>
                            <span class="fw-medium text-dark"><i class="fa-regular fa-calendar-days me-1 text-primary"></i> {{ $laporan->created_at->format('d M Y, H:i') }} WIB</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small fw-semibold text-uppercase d-block mb-1">Pelapor</span>
                            <span class="fw-medium text-dark"><i class="fa-solid fa-user me-1 text-primary"></i> {{ $laporan->nama_pelapor === 'Anonim' ? 'Anonim (Dirahasiakan)' : $laporan->nama_pelapor }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small fw-semibold text-uppercase d-block mb-1">Saksi Mata</span>
                            <span class="fw-medium text-dark"><i class="fa-solid fa-users-viewfinder me-1 text-primary"></i> {{ $laporan->nama_saksi ?? 'Tidak ada saksi' }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-muted small fw-semibold text-uppercase d-block mb-1">Pelaku Terduga</span>
                            <span class="fw-bold text-danger"><i class="fa-solid fa-user-xmark me-1"></i> {{ $laporan->nama_pembully }}</span>
                        </div>
                    </div>

                    <div class="bg-light p-3 rounded-3 mb-4">
                        <span class="text-muted small fw-semibold text-uppercase d-block mb-2">Uraian Kejadian</span>
                        <p class="mb-0 text-dark" style="text-align: justify; line-height: 1.6;">{{ $laporan->isi_laporan }}</p>
                    </div>

                    <div class="mb-4">
                        <span class="text-muted small fw-semibold text-uppercase d-block mb-2">Bukti Lampiran</span>
                        @if ($laporan->bukti_gambar)
                            <div class="text-center bg-light p-2 rounded-3 border">
                                <img src="{{ asset('storage/' . $laporan->bukti_gambar) }}" class="img-fluid rounded" style="max-height: 250px; object-fit: contain;">
                            </div>
                        @else
                            <div class="alert alert-secondary border-0 mb-0 d-flex align-items-center">
                                <i class="fa-solid fa-image-slash fs-4 me-3 text-muted"></i>
                                <div>Tidak ada bukti gambar yang dilampirkan oleh pelapor.</div>
                            </div>
                        @endif
                    </div>

                    <!-- Area Aksi Admin -->
                    <div class="border-top pt-4">
                        <h6 class="fw-bold text-primary mb-3"><i class="fa-solid fa-shield-halved me-2"></i>Tindakan Admin</h6>
                        
                        <div class="d-flex gap-2 flex-wrap mb-4">
                            <!-- Update Status ke Selesai -->
                            <form action="{{ route('laporan.updateStatus', $laporan->id) }}" method="POST" class="form-status">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Selesai">
                                <button type="button" class="btn btn-success px-4 btn-ubah-status"><i class="fa-solid fa-check me-2"></i> Tandai Selesai</button>
                            </form>

                            <!-- Update Status ke Ditolak -->
                            <form action="{{ route('laporan.updateStatus', $laporan->id) }}" method="POST" class="form-status">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Ditolak">
                                <button type="button" class="btn btn-warning px-4 btn-ubah-status"><i class="fa-solid fa-ban me-2"></i> Tolak Laporan</button>
                            </form>
                        </div>

                        <!-- Form Penanganan Laporan -->
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3 border border-primary border-opacity-25">
                            <form action="{{ route('laporan.updatePenanganan', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label text-primary fw-semibold small">Catatan Penanganan Admin</label>
                                    <textarea name="catatan_penanganan" class="form-control border-primary border-opacity-25" rows="3" placeholder="Tambahkan catatan khusus admin...">{{ $laporan->catatan_penanganan }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-primary fw-semibold small">Tanggal Penanganan</label>
                                        <input type="date" name="tanggal_penanganan" class="form-control border-primary border-opacity-25" value="{{ $laporan->tanggal_penanganan ?? date('Y-m-d') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-primary fw-semibold small">Ditangani Oleh</label>
                                        <input type="text" name="ditangani_oleh" class="form-control border-primary border-opacity-25" value="{{ $laporan->ditangani_oleh ?? 'Administrator DUCARE' }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-primary fw-semibold small">Unggah Tanda Tangan (Opsional)</label>
                                    <input type="file" name="ttd" class="form-control border-primary border-opacity-25" accept="image/*">
                                    @if ($laporan->ttd_penangan)
                                    <div class="mt-2 bg-white p-2 border rounded text-center">
                                        <img src="{{ asset('storage/' . $laporan->ttd_penangan) }}" style="max-height: 80px;" alt="Tanda Tangan">
                                    </div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-floppy-disk me-2"></i> Simpan Catatan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Konfirmasi Hapus Menggunakan SweetAlert2
        const deleteButtons = document.querySelectorAll('.btn-hapus');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('.form-hapus');
                
                Swal.fire({
                    title: 'Hapus Laporan?',
                    text: "Tindakan ini akan menghapus data laporan secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Hapus Data',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Konfirmasi Ubah Status
        const statusButtons = document.querySelectorAll('.btn-ubah-status');
        statusButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('.form-status');
                const btnText = this.innerText.trim();
                let confirmColor = '#16a34a';
                
                if(btnText.includes('Tolak')) confirmColor = '#eab308';

                Swal.fire({
                    title: 'Konfirmasi Tindakan',
                    text: `Apakah Anda yakin ingin melakukan tindakan: ${btnText}?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: confirmColor,
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Lanjutkan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });

    // Fungsi Filter Status
    function filterTabelStatus() {
        const filterValue = document.getElementById('filterStatus').value;
        const rows = document.querySelectorAll('.laporan-item');
        
        rows.forEach(row => {
            const status = row.getAttribute('data-status');
            
            if (filterValue === 'all' || status === filterValue) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endpush
@endsection
