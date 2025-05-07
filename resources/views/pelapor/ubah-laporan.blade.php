@extends('layouts.dashboard-layout')

@section('content')
<div class="container py-4">
  <h2 class="fw-bold mb-4">Ubah Laporan</h2>

  <div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
      <h5 class="fw-semibold">Ubah Laporan #12345: Bullying di kelas</h5>
    </div>
    <div class="card-body">
      <form>
        <div class="mb-3">
          <label for="judul" class="form-label fw-semibold">Judul Laporan</label>
          <input type="text" class="form-control" id="judul" name="judul" value="Bullying di kelas" required>
        </div>

        <div class="mb-3">
          <label for="tanggal" class="form-label fw-semibold">Tanggal Kejadian</label>
          <input type="date" class="form-control" id="tanggal" name="tanggal" value="2025-01-20" required>
        </div>

        <div class="mb-3">
          <label for="isi" class="form-label fw-semibold">Isi Laporan</label>
          <textarea class="form-control" id="isi" name="isi" rows="5" required>Siswa A mengalami perundungan verbal dan fisik oleh siswa B yang terjadi pada tanggal 20 Januari 2025 di kelas 12 IPA 1. Kejadian ini menyebabkan trauma dan ketidaknyamanan bagi siswa A.</textarea>
        </div>

        <div class="mb-3">
          <label for="saksi" class="form-label fw-semibold">Nama Saksi</label>
          <input type="text" class="form-control" id="saksi" name="saksi" value="Jane Doe" placeholder="Masukkan nama saksi jika ada">
        </div>

        <div class="mb-3">
          <label for="bukti" class="form-label fw-semibold">Unggah Bukti Foto</label>
          <input class="form-control" type="file" id="bukti" name="bukti" accept="image/*">
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
