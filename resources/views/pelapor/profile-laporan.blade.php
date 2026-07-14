@extends('layouts.dashboard-layout')

@section('title', 'Profil Saya')

@section('content')
<style>
  .profile-banner {
    background: linear-gradient(135deg, #64CA3F 0%, #3e8a24 100%);
    border-radius: 24px 24px 0 0;
    height: 140px;
    position: relative;
  }
  .profile-card {
    background: #ffffff;
    border-radius: 24px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
    border: none;
    margin-top: -80px;
    position: relative;
    padding: 0 40px 40px;
    text-align: center;
  }
  .profile-img-container {
    margin-top: -60px;
    margin-bottom: 20px;
    display: inline-block;
    position: relative;
  }
  .profile-img {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    border: 6px solid #ffffff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    object-fit: cover;
  }
  .btn-edit-photo {
    position: absolute;
    bottom: 5px;
    right: 5px;
    background: #1e293b;
    color: white;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid #ffffff;
    cursor: pointer;
    transition: all 0.2s;
  }
  .btn-edit-photo:hover {
    background: #64CA3F;
  }

  .profile-name {
    font-size: 1.8rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 5px;
  }
  .profile-role {
    color: #64CA3F;
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 25px;
  }

  .info-box {
    background: #f8fafc;
    border-radius: 16px;
    padding: 20px;
    text-align: left;
    margin-bottom: 15px;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    gap: 15px;
  }
  .info-icon {
    width: 45px;
    height: 45px;
    background: #ffffff;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: #64CA3F;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
  }
  .info-text h6 {
    margin: 0;
    font-size: 0.85rem;
    color: #64748b;
    font-weight: 600;
  }
  .info-text p {
    margin: 0;
    font-size: 1.05rem;
    color: #1e293b;
    font-weight: 700;
  }

  .btn-action {
    padding: 12px 25px;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
  }
  .btn-primary-custom {
    background: #1e293b;
    color: white;
    border: none;
  }
  .btn-primary-custom:hover {
    background: #0f172a;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(15, 23, 42, 0.2);
  }
  .btn-secondary-custom {
    background: #f1f5f9;
    color: #475569;
    border: none;
  }
  .btn-secondary-custom:hover {
    background: #e2e8f0;
    transform: translateY(-2px);
  }

  /* Modal custom style */
  .modal-content {
    border-radius: 20px;
    border: none;
    box-shadow: 0 20px 50px rgba(0,0,0,0.1);
  }
  .modal-header {
    border-bottom: 1px solid #f1f5f9;
    padding: 20px 25px;
  }
  .modal-footer {
    border-top: 1px solid #f1f5f9;
    padding: 20px 25px;
  }
  .form-control {
    border-radius: 12px;
    padding: 12px 15px;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
  }
  .form-control:focus {
    border-color: #64CA3F;
    box-shadow: 0 0 0 4px rgba(100, 202, 63, 0.1);
    background: #ffffff;
  }
  
  /* Hilangkan icon mata bawaan edge di form password */
  input[type="password"]::-ms-reveal,
  input[type="password"]::-ms-clear {
    display: none;
  }
</style>

<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">

      @if(session('success'))
          <div class="alert alert-success border-0 shadow-sm" style="background:#dcfce7; color:#166534; border-radius:12px; padding:15px;">
             <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
          </div>
      @endif

      <!-- Card container -->
      <div class="profile-banner"></div>
      <div class="profile-card">
        
        <div class="profile-img-container">
          @if($user->foto)
            <img src="{{ route('foto.profil', $user->foto) }}" alt="Foto Profil" class="profile-img">
          @else
            <img src="{{ asset('images/default-profile.png') }}" alt="Foto Profil Default" class="profile-img">
          @endif
          <div class="btn-edit-photo" data-bs-toggle="modal" data-bs-target="#editProfilModal" title="Ubah Foto">
            <i class="bi bi-pencil-fill" style="font-size:0.8rem;"></i>
          </div>
        </div>

        <h3 class="profile-name">{{ $user->name }}</h3>
        <div class="profile-role"><i class="bi bi-shield-check me-1"></i> Pelapor Aktif</div>

        <div class="row mt-4">
          <div class="col-md-6">
            <div class="info-box">
              <div class="info-icon"><i class="bi bi-person-vcard-fill"></i></div>
              <div class="info-text">
                <h6>Nomor Induk Siswa (NIS)</h6>
                <p>{{ $user->nis }}</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="info-box">
              <div class="info-icon"><i class="bi bi-envelope-at-fill"></i></div>
              <div class="info-text">
                <h6>Email Terdaftar</h6>
                <p>{{ $user->email }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-center gap-3 mt-4">
          <button type="button" class="btn btn-action btn-primary-custom" data-bs-toggle="modal" data-bs-target="#editProfilModal">
            <i class="bi bi-pencil-square me-2"></i> Edit Profil
          </button>
          <button type="button" class="btn btn-action btn-secondary-custom" data-bs-toggle="modal" data-bs-target="#gantiPasswordModal">
            <i class="bi bi-key-fill me-2"></i> Ubah Password
          </button>
        </div>

      </div>

    </div>
  </div>
</div>

<!-- Modal Edit Profil -->
<div class="modal fade" id="editProfilModal" tabindex="-1" aria-labelledby="editProfilModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="w-100">
        @csrf
        @method('POST')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editProfilModalLabel">Edit Data Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body px-4 py-4">
                
                <div class="text-center mb-4">
                    <img id="previewFoto" src="{{ $user->foto ? route('foto.profil', $user->foto) : asset('images/default-profile.png') }}" class="rounded-circle mb-3 border shadow-sm" width="100" height="100" style="object-fit: cover;" alt="Preview Foto">
                    <input type="file" name="foto" class="form-control" accept="image/*" onchange="previewFotoProfil(this)">
                </div>

                <div class="mb-3">
                    <label for="nis" class="form-label fw-semibold text-secondary">NIS</label>
                    <input type="text" name="nis" class="form-control" value="{{ $user->nis }}" required>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold text-secondary">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold text-secondary">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold" style="background:#64CA3F; border:none;">Simpan Perubahan</button>
            </div>
        </div>
    </form>
  </div>
</div>

<!-- Modal Ganti Password -->
<div class="modal fade" id="gantiPasswordModal" tabindex="-1" aria-labelledby="gantiPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form action="{{ route('pelapor.password.update') }}" method="POST" class="w-100">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="gantiPasswordModalLabel">Ubah Kata Sandi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body px-4 py-4">

               <!-- Password Lama -->
                <div class="mb-3">
                    <label for="current_password" class="form-label fw-semibold text-secondary">Password Lama</label>
                    <div class="input-group">
                        <input type="password" id="current_password" name="current_password" class="form-control" required style="border-right:none;">
                        <span class="input-group-text bg-white" onclick="togglePassword('current_password')" style="cursor: pointer; border: 1px solid #e2e8f0; border-left: none; border-radius: 0 12px 12px 0;">
                          <i class="bi bi-eye text-muted toggle-icon"></i>
                        </span>
                    </div>
                    @error('current_password')
                        <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Baru -->
                <div class="mb-3">
                    <label for="new_password" class="form-label fw-semibold text-secondary">Password Baru</label>
                    <div class="input-group">
                        <input type="password" id="new_password" name="new_password" class="form-control" required style="border-right:none;">
                        <span class="input-group-text bg-white" onclick="togglePassword('new_password')" style="cursor: pointer; border: 1px solid #e2e8f0; border-left: none; border-radius: 0 12px 12px 0;">
                          <i class="bi bi-eye text-muted toggle-icon"></i>
                        </span>
                    </div>
                    @error('new_password')
                        <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-2">
                    <label for="new_password_confirmation" class="form-label fw-semibold text-secondary">Konfirmasi Password Baru</label>
                    <div class="input-group">
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required style="border-right:none;">
                        <span class="input-group-text bg-white" onclick="togglePassword('new_password_confirmation')" style="cursor: pointer; border: 1px solid #e2e8f0; border-left: none; border-radius: 0 12px 12px 0;">
                          <i class="bi bi-eye text-muted toggle-icon"></i>
                        </span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold" style="background:#64CA3F; border:none;">Update Password</button>
            </div>
        </div>
    </form>
  </div>
</div>

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

function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('.toggle-icon');
    
    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.remove('bi-eye');
      icon.classList.add('bi-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.remove('bi-eye-slash');
      icon.classList.add('bi-eye');
    }
}
</script>
@endsection
