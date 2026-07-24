@extends('layouts.guru-layout')

@section('title', 'Profil Guru BK')

@section('guru-content')
<div class="container-fluid p-0">
    <style>
        .profile-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            border: 1px solid #f1f5f9;
            overflow: hidden;
            max-width: 900px;
            margin: 0 auto;
        }
        .profile-header {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            height: 120px;
            position: relative;
        }
        .profile-avatar-container {
            text-align: center;
            margin-top: -60px;
            position: relative;
            z-index: 2;
        }
        .profile-avatar {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            border: 5px solid #ffffff;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            object-fit: cover;
            background: #f8fafc;
        }
        .profile-info {
            padding: 30px 40px;
        }
        .profile-table th {
            color: #64748b;
            font-weight: 600;
            padding: 12px 0;
            width: 150px;
        }
        .profile-table td {
            color: #1e293b;
            font-weight: 700;
            padding: 12px 0;
        }
        .btn-custom {
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.2s;
        }
        
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
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #cbd5e1;
            background-color: #f8fafc;
        }
        .form-control:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 0.25rem rgba(245, 158, 11, 0.25);
            background-color: #ffffff;
        }
    </style>

        <div class="container py-4">
            <div class="profile-card">
                <div class="profile-header"></div>
                
                <div class="profile-avatar-container">
                    <img src="{{ $guru->foto ? (str_contains($guru->foto, '/') ? asset('storage/' . $guru->foto) : asset('storage/foto_profil/' . $guru->foto)) : asset('images/team 3.jpg') }}" alt="Foto Guru BK" class="profile-avatar">
                    <h4 class="fw-bold mt-3 mb-0" style="color: #1e293b;">{{ $guru->name }}</h4>
                    <span class="badge bg-warning text-dark mt-2 rounded-pill px-3 py-2"><i class="fa-solid fa-shield-halved me-1"></i> Guru BK</span>
                </div>

                <div class="profile-info">
                    <div class="row justify-content-center">
                        <div class="col-md-9">
                            <div class="bg-light rounded-4 p-4 mb-4 border border-light">
                        <table class="table profile-table table-borderless mb-0">
                            <tr>
                                <th><i class="fa-regular fa-envelope me-2 text-muted"></i> Email</th>
                                <td>{{ $guru->email }}</td>
                            </tr>
                            <tr>
                                <th><i class="fa-regular fa-id-badge me-2 text-muted"></i> NIP</th>
                                <td>{{ $guru->nip ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th><i class="fa-solid fa-phone me-2 text-muted"></i> Kontak</th>
                                <td>{{ $guru->phone_number ?? '-' }}</td>
                            </tr>
                        </table>
                            </div>

                        <!-- Tombol Edit & Ganti Password -->
                        <div class="d-flex justify-content-center gap-3">
                            <button class="btn btn-custom btn-primary px-4" data-bs-toggle="modal" data-bs-target="#editProfileModal"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Profil</button>
                            <button class="btn btn-custom btn-outline-dark px-4" data-bs-toggle="modal" data-bs-target="#changePasswordModal"><i class="fa-solid fa-key me-2"></i>Ganti Password</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Profil -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('guru.profile.update') }}" method="POST" enctype="multipart/form-data" class="modal-content">
      @csrf
       @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title" id="editProfileModalLabel"><i class="fa-solid fa-user-pen text-warning me-2"></i>Edit Profil</h5>
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
          <label for="foto" class="form-label">Foto Profil</label>
          <input type="file" name="foto" id="fotoInput" class="form-control">
          <div class="mt-2">
            <img id="previewfoto" src="{{ $guru->foto ? (str_contains($guru->foto, '/') ? asset('storage/' . $guru->foto) : asset('storage/foto_profil/' . $guru->foto)) : asset('images/team 3.jpg') }}" width="100" class="rounded">
          </div>
        </div>

      </div>
      <div class="modal-footer bg-light border-top-0 rounded-bottom-4">
        <button type="button" class="btn btn-secondary rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan Perubahan</button>
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
        <h5 class="modal-title" id="changePasswordModalLabel"><i class="fa-solid fa-shield-halved text-warning me-2"></i>Ganti Password</h5>
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
      <div class="modal-footer bg-light border-top-0 rounded-bottom-4">
        <button type="button" class="btn btn-secondary rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold"><i class="fa-solid fa-lock me-2"></i>Simpan Password</button>
      </div>
    </form>
  </div>
</div>

<!-- Preview Foto Script -->
<script>
document.getElementById('fotoInput')?.addEventListener('change', function(event) {
    const preview = document.getElementById('previewfoto');
    const file = event.target.files[0];
    if (file) {
        preview.src = URL.createObjectURL(file);
    }
});
</script>
@endsection
