@extends('layouts.main')

@section('title', 'Profil Guru BK')

@section('content')
<div class="d-flex" style="min-height: 100vh;">
    <!-- Sidebar -->
    <aside class="sidebar bg-primary text-white p-3 pt-5" style="width: 250px;">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logodu.png') }}" alt="Logo DUCARE" class="logo mb-2" style="width: 60px;">
            <h5 class="fw-bold">DUCARE</h5>
        </div>
        <nav class="nav flex-column">
            <a href="{{ route('guru.dashboard') }}" class="nav-link text-white">🏠 Dashboard</a>
            <a href="{{ route('guru.kelola') }}" class="nav-link text-white">📁 Kelola Laporan</a>
            <a href="{{ route('guru.cetak') }}" class="nav-link text-white">🖨️ Cetak Laporan</a>
            <a href="{{ route('guru.panduan') }}" class="nav-link text-white">📖 Panduan</a>
            <a href="{{ route('guru.profil') }}" class="nav-link text-white bg-dark rounded">👤 Profil</a>
            <form action="{{ route('guru.logout') }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="nav-link text-danger border-0 bg-transparent text-start">🚪 Logout</button>
            </form>
        </nav>
    </aside>

    <!-- Konten Profil -->
    <main class="flex-grow-1 p-4 bg-light">
        <div class="container">
            <div class="card shadow-sm p-4">
                <h3 class="fw-bold mb-4">Profil Guru BK</h3>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('images/team 3.jpg') }}" alt="Foto Guru BK" class="img-thumbnail rounded-circle mb-3" style="max-width: 150px;">
                        <h5 class="fw-semibold">{{ $guru->name }}</h5>
                        <p class="text-muted">{{ $guru->email }}</p>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 180px;">Nama</th>
                                <td>: {{ $guru->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>: {{ $guru->email }}</td>
                            </tr>
                            <tr>
                                <th>NIP</th>
                                <td>: {{ $guru->nip ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Kontak</th>
                                <td>: {{ $guru->phone_number ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>: {{ ucfirst($guru->role) }}</td>
                            </tr>
                        </table>

                        <!-- Tombol Edit & Ganti Password -->
                        <div class="mt-4 d-flex gap-2">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">✏️ Edit Profil</button>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#changePasswordModal">🔑 Ganti Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Modal Edit Profil -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('guru.profil.update') }}" method="POST" enctype="multipart/form-data" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">

        <div class="mb-3">
          <label for="name" class="form-label">Nama Lengkap</label>
          <input type="text" name="name" id="name" class="form-control" value="{{ $guru->name }}" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email Aktif</label>
          <input type="email" name="email" id="email" class="form-control" value="{{ $guru->email }}" required>
        </div>

        <div class="mb-3">
          <label for="nip" class="form-label">NIP</label>
          <input type="text" name="nip" id="nip" class="form-control" value="{{ $guru->nip }}">
        </div>

        <div class="mb-3">
          <label for="phone_number" class="form-label">Nomor Kontak</label>
          <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $guru->phone_number }}">
        </div>

        <div class="mb-3">
          <label for="photo" class="form-label">Foto Profil</label>
          <input type="file" name="photo" id="photoInput" class="form-control">
          <div class="mt-2">
            <img id="previewPhoto" src="{{ asset('images/team 3.jpg') }}" width="100" class="rounded">
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success">💾 Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Ganti Password -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('guru.password.update') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordModalLabel">Ganti Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">

        <div class="mb-3">
          <label for="current_password" class="form-label">Password Lama</label>
          <input type="password" name="current_password" id="current_password" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="new_password" class="form-label">Password Baru</label>
          <input type="password" name="new_password" id="new_password" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
          <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success">🔐 Simpan Password</button>
      </div>
    </form>
  </div>
</div>

<!-- Preview Foto Script -->
<script>
document.getElementById('photoInput')?.addEventListener('change', function(event) {
    const preview = document.getElementById('previewPhoto');
    const file = event.target.files[0];
    if (file) {
        preview.src = URL.createObjectURL(file);
    }
});
</script>
@endsection
