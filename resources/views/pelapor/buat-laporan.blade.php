@extends('layouts.dashboard-layout')

@section('content')
<div class="container py-0">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white fw-semibold">
          📝 Buat Laporan
        </div>
        <div class="card-body">
          <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Pilihan Anonim / Non-Anonim -->
            <div class="mb-3">
              <label class="form-label fw-semibold">Jenis Pelaporan</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="jenis_pelaporan" id="anonim" value="anonim" checked>
                <label class="form-check-label" for="anonim">
                  Anonim (identitas kamu disembunyikan)
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="jenis_pelaporan" id="non-anonim" value="non-anonim">
                <label class="form-check-label" for="non-anonim">
                  Non-Anonim (identitas kamu ditampilkan)
                </label>
              </div>
            </div>

            <!-- Form Identitas Pelapor (hanya tampil jika non-anonim) -->
            <div id="identitasPelapor" class="d-none mb-3">
              <label class="form-label fw-semibold">Identitas Pelapor</label>
              <input type="text" class="form-control" id="namaPelapor" name="nama_pelapor" placeholder="Masukkan nama kamu...">
            </div>

            <!-- Tanggal Laporan -->
            <div id="tanggalLaporan" class="mb-3">
              <label class="form-label fw-semibold">Tanggal Laporan</label>
              <input type="date" class="form-control" id="tanggal_kejadian" name="tanggal_kejadian" required>
            </div>

            <!-- Orang yang Membuli -->
            <div class="mb-3">
              <label class="form-label fw-semibold">Orang yang Membuli</label>
              <input type="text" class="form-control" id="orangMembuli" name="orang_membuli" placeholder="Masukkan nama orang yang membuli..." required>
            </div>

            <!-- Judul Laporan -->
            <div class="mb-3">
              <label for="judul" class="form-label fw-semibold">Judul Laporan</label>
              <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul laporan..." required>
            </div>

            <!-- Isi Laporan -->
            <div class="mb-3">
              <label for="isi" class="form-label fw-semibold">Isi Laporan</label>
              <textarea class="form-control" id="isi" name="isi" rows="6" placeholder="Tulis laporanmu di sini..." required></textarea>
            </div>

            <!-- Tombol Tambah Saksi di atas sebelah kiri -->
            <div class="mb-3 d-inline-block">
              <button type="button" class="btn btn-outline-secondary" id="toggleSaksi">
                <i class="bi bi-person-plus"></i> Tambah Saksi
              </button>
            </div>

            <!-- Tombol Unggah Bukti -->
            <div class="mb-3">
              <button type="button" class="btn btn-outline-secondary" id="toggleBukti">
                <i class="bi bi-image"></i> Unggah Bukti
              </button>
            </div>

            <!-- Form Saksi (disembunyikan dulu) -->
            <div class="mb-3 d-none" id="formSaksi">
              <label for="saksi" class="form-label fw-semibold">Nama Saksi (Opsional)</label>
              <input type="text" class="form-control" id="saksi" name="saksi" placeholder="Masukkan nama saksi jika ada">
            </div>

            <!-- Input Bukti Gambar (disembunyikan dulu) -->
            <div class="mb-3 d-none" id="formBukti">
              <label for="bukti" class="form-label fw-semibold">Unggah Bukti Foto (Opsional)</label>
              <input class="form-control" type="file" id="bukti" name="bukti" accept="image/*">
            </div>

            <!-- Tombol Kirim Laporan (di bawah kanan) -->
            <div class="text-end">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-send"></i> Kirim Laporan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const anonimRadio = document.getElementById('anonim');
    const nonAnonimRadio = document.getElementById('non-anonim');
    const identitasPelapor = document.getElementById('identitasPelapor');
    const orangMembuli = document.getElementById('orangMembuli');

    if (nonAnonimRadio.checked) {
      identitasPelapor.classList.remove('d-none');
    } else {
      identitasPelapor.classList.add('d-none');
    }

    anonimRadio.addEventListener('change', function () {
      if (this.checked) {
        identitasPelapor.classList.add('d-none');
        orangMembuli.placeholder = "Masukkan nama orang yang membuli...";
      }
    });

    nonAnonimRadio.addEventListener('change', function () {
      if (this.checked) {
        identitasPelapor.classList.remove('d-none');
        orangMembuli.placeholder = "Masukkan nama orang yang membuli (nama lengkap)";
      }
    });

    document.getElementById('toggleSaksi').addEventListener('click', function () {
      document.getElementById('formSaksi').classList.toggle('d-none');
    });

    document.getElementById('toggleBukti').addEventListener('click', function () {
      document.getElementById('formBukti').classList.toggle('d-none');
    });
  });
</script>

{{--  popup untuk data laporan berhasil terkirim ke data base  --}}
@if (session('success'))
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      Swal.fire({
        icon: 'success',
        title: 'Laporan Berhasil Dikirim!',
        text: '{{ session('success') }}',
        showCancelButton: true,
        confirmButtonText: 'Lihat Status Laporan',
        cancelButtonText: 'Tetap di Sini',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "{{ route('status.laporan') }}";
        }
        // Kalau klik "Tetap di Sini", tidak perlu redirect
      });
    });
  </script>
@endif