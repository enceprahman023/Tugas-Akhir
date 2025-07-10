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
    <a href="{{ route('admin.panduan.admin') }}">Panduan</a>
    <a href="{{ route('admin.logout.admin') }}">Logout</a>
  </nav>

  <div class="header-right" title="Admin Profile">
    <img src="{{ asset('images/admin-profile.jpg') }}" alt="Foto Admin" />
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
        <th>NIP</th> 
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $index => $user)
      <tr>
        <td>{{ $index + 1 }}</td>
       <td>
  @php
    $foto = $user['foto']
        ? asset('storage/foto_profil/' . $user['foto'])
        : asset('images/default-user.png');
  @endphp

  <img src="{{ $foto }}" alt="Foto {{ $user['name'] ?? 'Pengguna' }}" style="width:40px; height:40px; object-fit:cover;">
</td>
        <td>{{ $user['name'] }}</td>
        <td>{{ $user['email'] }}</td>
        <td>{{ $user['role'] }}</td>
        <td>{{ $user['nis'] ?? '-' }}</td>
        <td>{{ $user['nip'] ?? '-' }}</td>
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
                <a class="dropdown-item" href="#"
   data-bs-toggle="modal"
   data-bs-target="#editModal"
   data-userid="{{ $user['id'] }}"
   data-name="{{ $user['name'] }}"
   data-email="{{ $user['email'] }}"
   data-role="{{ $user['role'] }}"
   data-nis="{{ $user['nis'] }}"
   data-nip="{{ $user['nip'] }}">
   Edit Akun
</a>
              </li>
              <li>
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#resetPasswordModal" data-userid="{{ $user['id'] }}" data-name="{{ $user['name'] }}">
                  Reset Password
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form id="delete-form-{{ $user['id'] }}" action="{{ route('admin.akun.hapus', $user['id']) }}" method="POST" style="display: none;">
  @csrf
  @method('DELETE')
</form>
<a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $user['id'] }}, '{{ $user['name'] }}')">
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

<script>
  const nisModal = document.getElementById('nisModal');
  nisModal?.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    document.getElementById('modalUserId').value = button.getAttribute('data-userid');
    document.getElementById('modalNIS').value = button.getAttribute('data-nis') || '';
  });

  const editModal = document.getElementById('editModal');
  editModal?.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    console.log('Data user ID:', button.getAttribute('data-userid'));
    document.getElementById('editUserId').value = button.getAttribute('data-userid');
    document.getElementById('editNama').value = button.getAttribute('data-name');
    document.getElementById('editEmail').value = button.getAttribute('data-email');
    document.getElementById('editRole').value = button.getAttribute('data-role');
    document.getElementById('editNIS').value = button.getAttribute('data-nis') || '';
    document.getElementById('editNIP').value = button.getAttribute('data-nip') || '';
  });
  const editButtons = document.querySelectorAll('[data-bs-target="#editModal"]');
editButtons.forEach(button => {
  button.addEventListener('click', () => {
    document.getElementById('editUserId').value = button.getAttribute('data-userid');
    document.getElementById('editNama').value = button.getAttribute('data-name');
    document.getElementById('editEmail').value = button.getAttribute('data-email');
    document.getElementById('editRole').value = button.getAttribute('data-role');
    document.getElementById('editNIS').value = button.getAttribute('data-nis') || '';
    document.getElementById('editNIP').value = button.getAttribute('data-nip') || '';
  });
});

  const resetPasswordModal = document.getElementById('resetPasswordModal');
resetPasswordModal?.addEventListener('show.bs.modal', event => {
  const button = event.relatedTarget;
  document.getElementById('resetUserId').value = button.getAttribute('data-userid');
  document.getElementById('resetUserName').textContent = button.getAttribute('data-name');
  document.getElementById('newPassword').value = '';
  document.getElementById('confirmPassword').value = '';
});

 function confirmDelete(userId, userName) {
  if (confirm(`Yakin ingin menghapus akun "${userName}"? Tindakan ini tidak bisa dibatalkan.`)) {
    document.getElementById(`delete-form-${userId}`).submit();
  }
}
</script>
<!-- Modal Edit Akun -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('admin.akun.update') }}">
      @csrf
      <input type="hidden" name="id" id="editUserId">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Akun</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
  <div class="mb-3">
    <label for="editNama" class="form-label">Nama</label>
    <input type="text" class="form-control" id="editNama" name="name" required>
  </div>
  <div class="mb-3">
    <label for="editEmail" class="form-label">Email</label>
    <input type="email" class="form-control" id="editEmail" name="email" required>
  </div>
  <div class="mb-3">
    <label for="editRole" class="form-label">Role</label>
    <select class="form-select" id="editRole" name="role" required>
      <option value="Pelapor">Pelapor</option>
      <option value="Guru">Guru</option>
      <option value="Admin">Admin</option>
    </select>
  </div>
  <div class="mb-3">
    <label for="editNIS" class="form-label">NIS</label>
    <input type="text" class="form-control" id="editNIS" name="nis">
  </div>
  <div class="mb-3">
    <label for="editNIP" class="form-label">NIP</label>
    <input type="text" class="form-control" id="editNIP" name="nip">
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

<!-- Modal Reset Password -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('admin.akun.resetpassword') }}">
      @csrf
      <input type="hidden" name="id" id="resetUserId">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="resetPasswordModalLabel">Reset Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
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
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Reset</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection
