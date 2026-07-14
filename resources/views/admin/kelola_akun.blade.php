@extends('layouts.admin-layout')

@section('title', 'Kelola Akun Pengguna')

@section('admin-content')
<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold" style="color: #0f172a;"><i class="fa-solid fa-users-gear text-primary me-2"></i> Kelola Akun Pengguna</h3>
            <p class="text-muted mb-0">Manajemen akses dan data pengguna sistem DUCARE.</p>
        </div>
        <div>
            <!-- Bisa ditambah tombol tambah akun jika admin diizinkan create akun langsung -->
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                        <tr>
                            <th class="text-secondary fw-semibold py-3 text-center" width="5%">No</th>
                            <th class="text-secondary fw-semibold py-3 text-center" width="8%">Foto</th>
                            <th class="text-secondary fw-semibold py-3">Informasi Pengguna</th>
                            <th class="text-secondary fw-semibold py-3">Role Akses</th>
                            <th class="text-secondary fw-semibold py-3">Identitas (NIS/NIP)</th>
                            <th class="text-secondary fw-semibold py-3 text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                        <tr>
                            <td class="text-center text-muted fw-medium">{{ $index + 1 }}</td>
                            <td class="text-center">
                                @php
                                    $foto = $user['foto']
                                        ? asset('storage/foto_profil/' . $user['foto'])
                                        : 'https://ui-avatars.com/api/?name='.urlencode($user['name']).'&background=random&color=fff';
                                @endphp
                                <img src="{{ $foto }}" alt="Foto {{ $user['name'] }}" class="rounded-circle shadow-sm border border-2 border-white" style="width:45px; height:45px; object-fit:cover;">
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $user['name'] }}</div>
                                <div class="text-muted small"><i class="fa-solid fa-envelope me-1"></i> {{ $user['email'] }}</div>
                            </td>
                            <td>
                                @php
                                    $roleBadge = 'secondary';
                                    if(strtolower($user['role']) == 'admin') $roleBadge = 'danger';
                                    elseif(strtolower($user['role']) == 'gurubk' || strtolower($user['role']) == 'guru') $roleBadge = 'primary';
                                    elseif(strtolower($user['role']) == 'pelapor') $roleBadge = 'success';
                                @endphp
                                <span class="badge bg-{{ $roleBadge }}-subtle text-{{ $roleBadge }} px-3 py-1 rounded-pill border border-{{ $roleBadge }}-subtle text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                    {{ $user['role'] }}
                                </span>
                            </td>
                            <td>
                                @if($user['nis'])
                                    <span class="badge bg-light text-dark border">NIS: {{ $user['nis'] }}</span>
                                @elseif($user['nip'])
                                    <span class="badge bg-light text-dark border">NIP: {{ $user['nip'] }}</span>
                                @else
                                    <span class="text-muted fst-italic small">Tidak ada</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border dropdown-toggle rounded-pill px-3 shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Opsi
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                        @if(strtolower($user['role']) === 'siswa' || strtolower($user['role']) === 'pelapor')
                                        <li>
                                            <a class="dropdown-item py-2 text-primary" href="#" data-bs-toggle="modal" data-bs-target="#nisModal" data-userid="{{ $user['id'] }}" data-nis="{{ $user['nis'] }}">
                                                <i class="fa-solid fa-id-card me-2"></i> Update NIS
                                            </a>
                                        </li>
                                        @endif
                                        <li>
                                            <a class="dropdown-item py-2 text-primary" href="#"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal"
                                                data-userid="{{ $user['id'] }}"
                                                data-name="{{ $user['name'] }}"
                                                data-email="{{ $user['email'] }}"
                                                data-role="{{ $user['role'] }}"
                                                data-nis="{{ $user['nis'] }}"
                                                data-nip="{{ $user['nip'] }}">
                                                <i class="fa-solid fa-pen-to-square me-2"></i> Edit Akun
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2 text-warning" href="#" data-bs-toggle="modal" data-bs-target="#resetPasswordModal" data-userid="{{ $user['id'] }}" data-name="{{ $user['name'] }}">
                                                <i class="fa-solid fa-key me-2"></i> Reset Password
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form id="delete-form-{{ $user['id'] }}" action="{{ route('admin.akun.hapus', $user['id']) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a class="dropdown-item py-2 text-danger btn-hapus-akun" href="#" data-id="{{ $user['id'] }}" data-name="{{ $user['name'] }}">
                                                <i class="fa-solid fa-trash-can me-2"></i> Hapus Akun
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Akun -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('admin.akun.update') }}" enctype="multipart/form-data" class="w-100">
            @csrf
            <input type="hidden" name="id" id="editUserId">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header bg-light border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary"><i class="fa-solid fa-pen-to-square me-2"></i> Edit Data Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Nama Lengkap</label>
                        <input type="text" class="form-control" id="editNama" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Alamat Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Foto Profil</label>
                        <input type="file" class="form-control" name="foto" accept="image/*">
                        <span class="text-muted small" style="font-size: 0.8rem;">Pilih foto baru jika ingin mengganti foto saat ini.</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Role Akses</label>
                        <select class="form-select" id="editRole" name="role" required>
                            <option value="Pelapor">Pelapor / Siswa</option>
                            <option value="Guru">Guru BK</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small fw-semibold">NIS (Siswa)</label>
                            <input type="text" class="form-control" id="editNIS" name="nis" placeholder="Opsional">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small fw-semibold">NIP (Guru)</label>
                            <input type="text" class="form-control" id="editNIP" name="nip" placeholder="Opsional">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Reset Password -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('admin.akun.resetpassword') }}" class="w-100">
            @csrf
            <input type="hidden" name="id" id="resetUserId">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header bg-light border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-warning"><i class="fa-solid fa-key me-2"></i> Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="alert alert-warning border-0 rounded-3 d-flex align-items-center mb-4">
                        <i class="fa-solid fa-triangle-exclamation fs-4 me-3"></i>
                        <div>Anda akan me-reset password untuk pengguna:<br><strong id="resetUserName" class="text-dark"></strong></div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Password Baru</label>
                        <input type="password" class="form-control" id="newPassword" name="password" required minlength="8" placeholder="Minimal 8 karakter">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" required minlength="8">
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning rounded-pill px-4 text-dark fw-semibold">Reset Password</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Update NIS (Khusus Siswa) -->
<div class="modal fade" id="nisModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <!-- Form disesuaikan sesuai endpoint yang ada, jika tidak ada, gunakan editModal -->
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header bg-light border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-primary"><i class="fa-solid fa-id-card me-2"></i> Update NIS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-muted mb-0">Silakan gunakan fitur <strong>Edit Akun</strong> untuk memperbarui NIS pengguna ini.</p>
            </div>
            <div class="modal-footer border-top-0 bg-light">
                <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-dismiss="modal">Mengerti</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal Edit Data Binding
        const editModal = document.getElementById('editModal');
        if(editModal) {
            editModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                document.getElementById('editUserId').value = button.getAttribute('data-userid');
                document.getElementById('editNama').value = button.getAttribute('data-name');
                document.getElementById('editEmail').value = button.getAttribute('data-email');
                
                // Normalisasi role
                let r = button.getAttribute('data-role').toLowerCase();
                let selectRole = 'Pelapor';
                if(r === 'admin') selectRole = 'Admin';
                else if(r === 'guru' || r === 'gurubk') selectRole = 'Guru';
                
                document.getElementById('editRole').value = selectRole;
                document.getElementById('editNIS').value = button.getAttribute('data-nis') || '';
                document.getElementById('editNIP').value = button.getAttribute('data-nip') || '';
            });
        }

        // Modal Reset Password Binding
        const resetPasswordModal = document.getElementById('resetPasswordModal');
        if(resetPasswordModal) {
            resetPasswordModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                document.getElementById('resetUserId').value = button.getAttribute('data-userid');
                document.getElementById('resetUserName').textContent = button.getAttribute('data-name');
                document.getElementById('newPassword').value = '';
                document.getElementById('confirmPassword').value = '';
            });
        }

        // SweetAlert untuk Hapus Akun
        const deleteButtons = document.querySelectorAll('.btn-hapus-akun');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const userId = this.getAttribute('data-id');
                const userName = this.getAttribute('data-name');
                const form = document.getElementById(`delete-form-${userId}`);
                
                Swal.fire({
                    title: 'Hapus Akun Pengguna?',
                    html: `Anda akan menghapus akun <strong>${userName}</strong> secara permanen.<br>Tindakan ini tidak dapat dibatalkan.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Hapus Akun',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection
