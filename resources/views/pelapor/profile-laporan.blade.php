@extends('layouts.main')

@section('title', 'Profil Saya')

@section('content')
<div class="dashboard-container d-flex" style="min-height: 100vh; background-color: #f4f6f9;">

    {{-- Sidebar --}}
    <aside class="sidebar p-4 text-white" style="width: 250px; background: #1e2a38;">
        <div class="text-center mb-4" style="margin-top: 30px">
            <img src="{{ asset('images/logodu.png') }}" alt="Logo DUCARE" class="logo-dashboard mb-2" style="max-width: 80px;">
            <h5 class="fw-bold">DUCARE</h5>
        </div>

        <ul class="nav flex-column mt-4">
            <li class="nav-item mb-3">
                <a href="{{ route('pelapor.dashboard') }}" class="nav-link text-white">🏠 Dashboard</a>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('buat.laporan') }}" class="nav-link text-white">📝 Buat Laporan</a>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('status.laporan') }}" class="nav-link text-white">📋 Status Laporan</a>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('panduan.laporan') }}" class="nav-link text-white"><i class="bi bi-book me-2"></i>Panduan</a>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('profile.laporan') }}" class="nav-link text-white active bg-dark rounded"><i class="bi bi-person me-2"></i>Profile</a>
            </li>
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="button" id="logout-button" class="nav-link text-danger bg-transparent border-0 d-flex align-items-center p-0" style="width: 100%; text-align: left;">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </form>
            </li>
        </ul>
    </aside>
    
    {{-- Main Content --}}
    <main class="flex-grow-1 p-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="container bg-white p-5 rounded-4 shadow-sm">
            <h1 class="fw-bold mb-4 text-center" style="color: #1e2a38;">Profil Saya</h1>

            <!-- Card Profil Saya -->
            <div class="profile-card;">
                <div class="card-body text-center">
                   <img src="{{ route('foto.profil', $user->foto) }}" alt="Foto Profil" class="rounded-circle mb-3" width="120" height="120">
                    <h4 class="card-title mb-2">{{ $user->name }}</h4>
                    <p class="text-muted mb-1">NIS: {{ $user->nis }}</p>
                    <p class="text-muted mb-1">Nama: {{ $user->name }}</p>
                    <p class="text-muted mb-3">Email: {{ $user->email }}</p>

                    <!-- Tombol Edit Profil -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfilModal">
                        Edit Profil
                    </button>

                    <!-- Tombol Ganti Password -->
                   <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#gantiPasswordModal">
    Ubah Password
</button>

                </div>
            </div>
        </div>
    </main>
</div>
<!-- Modal Edit Profil -->
<div class="modal fade" id="editProfilModal" tabindex="-1" aria-labelledby="editProfilModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfilModalLabel">Edit Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <!-- Foto Profil -->
                <div class="mb-3 text-center">
                    <img id="previewFoto" src="{{ asset('images/team 1.jpg') }}" class="rounded-circle mb-2" width="100" height="100" alt="Preview Foto">
                    <div>
                        <input type="file" name="foto" class="form-control" accept="image/*" onchange="previewFotoProfil(this)">
                    </div>
                </div>

                <!-- NIS -->
                <div class="mb-3">
                    <label for="nis" class="form-label">NIS</label>
                    <input type="text" name="nis" class="form-control" value="{{ $user->nis }}" required>
                </div>

                <!-- Nama -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </form>
  </div>
</div>

<!-- Modal Ganti Password -->
<div class="modal fade" id="gantiPasswordModal" tabindex="-1" aria-labelledby="gantiPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('pelapor.password.update') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gantiPasswordModalLabel">Ganti Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">

               <!-- Password Lama -->
<div class="mb-3">
    <label for="current_password" class="form-label">Password Lama</label>
    <div class="input-group">
        <input type="password" id="current_password" name="current_password" class="form-control" required>
        <span class="input-group-text" onclick="togglePassword('current_password')" style="cursor: pointer;">👁️</span>
    </div>
    @error('current_password')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<!-- Password Baru -->
<div class="mb-3">
    <label for="new_password" class="form-label">Password Baru</label>
    <div class="input-group">
        <input type="password" id="new_password" name="new_password" class="form-control" required>
        <span class="input-group-text" onclick="togglePassword('new_password')" style="cursor: pointer;">👁️</span>
    </div>
    @error('new_password')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<!-- Konfirmasi Password -->
<div class="mb-3">
    <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
    <div class="input-group">
        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
        <span class="input-group-text" onclick="togglePassword('new_password_confirmation')" style="cursor: pointer;">👁️</span>
    </div>
</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Password</button>
            </div>
        </div>
    </form>
  </div>
</div>


<!-- Script untuk Preview Gambar -->
<script>
function previewFotoProfil(input) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewFoto').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<!-- Script Bootstrap Modal (pastikan sudah include Bootstrap JS) -->
<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
@endsection
