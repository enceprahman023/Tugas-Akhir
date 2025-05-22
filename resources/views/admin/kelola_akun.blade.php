@extends('layouts.main')

@section('title', 'Kelola Akun')

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

<div class="container py-4">
  <h2 class="mb-4">Kelola Akun Pengguna</h2>

  <table class="table table-bordered align-middle">
    <thead class="table-light">
      <tr>
        <th>No</th>
        <th>Foto</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>NIS</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @php
        $users = [
          ['id'=>1,'foto'=>'user1.jpg','nama'=>'Rina Putri','email'=>'rina@example.com','role'=>'Siswa','nis'=>'123456'],
          ['id'=>2,'foto'=>'user2.jpg','nama'=>'Budi Santoso','email'=>'budi@example.com','role'=>'Siswa','nis'=>''],
          ['id'=>3,'foto'=>'user3.jpg','nama'=>'Guru BK','email'=>'guru@example.com','role'=>'Guru BK','nis'=>null],
        ];
      @endphp

      @foreach ($users as $index => $user)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>
          <img src="{{ asset('images/'.$user['foto']) }}" alt="Foto {{ $user['nama'] }}" class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
        </td>
        <td>{{ $user['nama'] }}</td>
        <td>{{ $user['email'] }}</td>
        <td>{{ $user['role'] }}</td>
        <td>{{ $user['nis'] ?: '-' }}</td>
        <td>
          <div class="dropdown">
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Aksi
            </button>
            <ul class="dropdown-menu">
              @if($user['role'] === 'Siswa')
              <li>
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#nisModal" data-userid="{{ $user['id'] }}" data-nis="{{ $user['nis'] }}">
                  Input/Update NIS
                </a>
              </li>
              @endif
              <li>
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editModal" data-userid="{{ $user['id'] }}" data-nama="{{ $user['nama'] }}" data-email="{{ $user['email'] }}" data-role="{{ $user['role'] }}">
                  Edit Akun
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#resetPasswordModal" data-userid="{{ $user['id'] }}" data-nama="{{ $user['nama'] }}">
                  Reset Password
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $user['id'] }}, '{{ $user['nama'] }}')">
                  Hapus Akun
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

<!-- Modal Input/Update NIS -->
<div class="modal fade" id="nisModal" tabindex="-1" aria-labelledby="nisModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="#" method="POST" id="nisForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="nisModalLabel">Input/Update NIS</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="user_id" id="modalUserId" value="">
          <div class="mb-3">
            <label for="modalNIS" class="form-label">Nomor Induk Siswa (NIS)</label>
            <input type="text" class="form-control" id="modalNIS" name="nis" placeholder="Masukkan NIS" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit Akun -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="#" method="POST" id="editForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Akun</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="user_id" id="editUserId" value="">
          <div class="mb-3">
            <label for="editNama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="editNama" name="nama" required>
          </div>
          <div class="mb-3">
            <label for="editEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="editEmail" name="email" required>
          </div>
          <div class="mb-3">
            <label for="editRole" class="form-label">Role</label>
            <select class="form-select" id="editRole" name="role" required>
              <option value="Siswa">Siswa</option>
              <option value="Guru BK">Guru BK</option>
              <option value="Admin">Admin</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Reset Password -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="#" method="POST" id="resetPasswordForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="resetPasswordModalLabel">Reset Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="user_id" id="resetUserId" value="">
          <p>Reset password untuk: <strong id="resetUserName"></strong></p>
          <div class="mb-3">
            <label for="newPassword" class="form-label">Password Baru</label>
            <input type="password" class="form-control" id="newPassword" name="password" required>
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Reset Password</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  // Modal NIS
  const nisModal = document.getElementById('nisModal');
  nisModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    const userId = button.getAttribute('data-userid');
    const nis = button.getAttribute('data-nis');

    document.getElementById('modalUserId').value = userId;
    document.getElementById('modalNIS').value = nis || '';
  });

  // Modal Edit Akun
  const editModal = document.getElementById('editModal');
  editModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    const userId = button.getAttribute('data-userid');
    const nama = button.getAttribute('data-nama');
    const email = button.getAttribute('data-email');
    const role = button.getAttribute('data-role');

    document.getElementById('editUserId').value = userId;
    document.getElementById('editNama').value = nama;
    document.getElementById('editEmail').value = email;
    document.getElementById('editRole').value = role;
  });

  // Modal Reset Password
  const resetPasswordModal = document.getElementById('resetPasswordModal');
  resetPasswordModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    const userId = button.getAttribute('data-userid');
    const nama = button.getAttribute('data-nama');

    document.getElementById('resetUserId').value = userId;
    document.getElementById('resetUserName').textContent = nama;
    document.getElementById('newPassword').value = '';
    document.getElementById('confirmPassword').value = '';
  });

  // Konfirmasi hapus akun
  function confirmDelete(userId, userName) {
    if (confirm(`Apakah Anda yakin ingin menghapus akun "${userName}"? Tindakan ini tidak dapat dibatalkan.`)) {
      // Kirim request hapus akun via form atau AJAX, contoh:
      // location.href = `/admin/hapus-akun/${userId}`;

      alert('Fungsi hapus akun masih belum diimplementasikan.');
    }
  }
</script>
@endsection
