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
          <form>
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
              <input type="text" class="form-control" id="namaPelapor" name="nama_pelapor" placeholder="Masukkan nama kamu..." required>
            </div>

            <!-- Tanggal Laporan -->
            <div id="tanggalLaporan" class="mb-3">
              <label class="form-label fw-semibold">Tanggal Laporan</label>
              <input type="date" class="form-control" id="tanggal" name="tanggal" required>
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
          </form>
          
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

    // Cek pilihan awal
    if (nonAnonimRadio.checked) {
      identitasPelapor.classList.remove('d-none');
    } else {
      identitasPelapor.classList.add('d-none');
    }

    // Event listener untuk memilih jenis pelaporan
    anonimRadio.addEventListener('change', function () {
      if (this.checked) {
        identitasPelapor.classList.add('d-none'); // Sembunyikan form identitas pelapor
        orangMembuli.placeholder = "Masukkan nama orang yang membuli..."; // Placeholder anonim
      }
    });

    nonAnonimRadio.addEventListener('change', function () {
      if (this.checked) {
        identitasPelapor.classList.remove('d-none'); // Tampilkan form identitas pelapor
        orangMembuli.placeholder = "Masukkan nama orang yang membuli (nama lengkap)"; // Placeholder non-anonim
      }
    });

    // Fungsi untuk menampilkan form saksi
    document.getElementById('toggleSaksi').addEventListener('click', function () {
      document.getElementById('formSaksi').classList.toggle('d-none');
    });

    // Fungsi untuk menampilkan form bukti
    document.getElementById('toggleBukti').addEventListener('click', function () {
      document.getElementById('formBukti').classList.toggle('d-none');
    });
  });
</script>
