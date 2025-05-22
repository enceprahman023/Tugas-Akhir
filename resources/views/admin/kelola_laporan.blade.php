@extends('layouts.main')

@section('title', 'Kelola Laporan')

@section('content')

<header>
  <div class="header-left">
    <img src="{{ asset('images/logodu.png') }}" alt="Logo Sekolah">
  </div>

  <nav class="menu">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.kelola.laporan') }}">Kelola Laporan</a>
    <a href="{{ route('admin.cetak') }}">Cetak Laporan</a>
    <a href="{{ route('admin.kelola.akun') }}">Kelola Akun</a>
    <a href="#">Panduan</a>
    <a href="#">Logout</a>
  </nav>

  <div class="header-right" title="Admin Profile">
    <img src="images/admin-profile.jpg" alt="Foto Admin" />
    <span>Nama Admin</span>
  </div>
</header>

<!-- Konten -->
<div class="container-fluid py-4">
    <h3 class="mb-4">Kelola Laporan</h3>

    <!-- Tabel Laporan -->
    <div class="table-responsive mt-4">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>No. Laporan</th>
                    <th>Judul Laporan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Contoh Data -->
                <tr>
                    <td>LAP-001</td>
                    <td>Pelecehan Verbal di Lapangan</td>
                    <td><span class="badge bg-warning">Dalam Proses</span></td>
                    <td>2025-05-05</td>
                    <td><button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalLAP001">Detail</button></td>
                </tr>
                <tr>
                    <td>LAP-002</td>
                    <td>Tindakan Kekerasan di Kelas</td>
                    <td><span class="badge bg-success">Selesai</span></td>
                    <td>2025-05-04</td>
                    <td><button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalLAP002">Detail</button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal Laporan LAP-001 -->
    <div class="modal fade" id="modalLAP001" tabindex="-1" aria-labelledby="modalLabel001" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Laporan LAP-001</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr><th>Judul</th><td>Pelecehan Verbal di Lapangan</td></tr>
                        <tr><th>Status</th><td><span class="badge bg-warning">Dalam Proses</span></td></tr>
                        <tr><th>Pelapor</th><td>Siswa A</td></tr>
                        <tr><th>Pelaku</th><td>Siswa B</td></tr>
                        <tr><th>Saksi</th><td>Siswa C</td></tr>
                        <tr><th>Isi Laporan</th><td>Terjadi saat jam istirahat...</td></tr>
                        <tr><th>Bukti Foto</th><td><img src="{{ asset('images/bukti1.jpg') }}" class="img-fluid" style="max-height: 200px;"></td></tr>
                    </table>

                    <h6 class="mt-4">Catatan Penanganan</h6>
                    <form>
                        <div class="mb-3">
                            <textarea class="form-control" rows="3" placeholder="Tulis catatan..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Tanggal Penanganan</label>
                            <input type="date" class="form-control">
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger">Hapus</button>
                    <button class="btn btn-success">Tandai Selesai</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Laporan LAP-002 -->
    <div class="modal fade" id="modalLAP002" tabindex="-1" aria-labelledby="modalLabel002" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Laporan LAP-002</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr><th>Judul</th><td>Tindakan Kekerasan di Kelas</td></tr>
                        <tr><th>Status</th><td><span class="badge bg-success">Selesai</span></td></tr>
                        <tr><th>Pelapor</th><td><em>Anonim</em></td></tr>
                        <tr><th>Pelaku</th><td>Siswa X</td></tr>
                        <tr><th>Saksi</th><td>—</td></tr>
                        <tr><th>Isi Laporan</th><td>Siswa X mendorong Siswa Y...</td></tr>
                        <tr><th>Bukti Foto</th><td><img src="{{ asset('images/bukti2.jpg') }}" class="img-fluid" style="max-height: 200px;"></td></tr>
                    </table>

                    <h6 class="mt-4">Catatan Penanganan</h6>
                    <form>
                        <div class="mb-3">
                            <textarea class="form-control" rows="3" placeholder="Tulis catatan..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Tanggal Penanganan</label>
                            <input type="date" class="form-control">
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger">Hapus</button>
                    <button class="btn btn-success">Tandai Selesai</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
