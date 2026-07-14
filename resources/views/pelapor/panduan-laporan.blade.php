@extends('layouts.dashboard-layout')

@section('title', 'Panduan Laporan')

@section('content')
<style>
  .guide-header {
    background: linear-gradient(135deg, #1e2a38 0%, #2b3e50 100%);
    color: white;
    border-radius: 20px;
    padding: 40px 30px;
    margin-bottom: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
  }
  .guide-header::after {
    content: '\F1BC'; /* bi-book */
    font-family: 'bootstrap-icons';
    position: absolute;
    right: -20px;
    top: -20px;
    font-size: 150px;
    opacity: 0.1;
    color: white;
    transform: rotate(-15deg);
  }
  
  .modern-accordion {
    gap: 15px;
    display: flex;
    flex-direction: column;
  }
  .modern-accordion .accordion-item {
    border: none;
    border-radius: 16px !important;
    background: #ffffff;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
  }
  .modern-accordion .accordion-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
  }
  .modern-accordion .accordion-button {
    background: #ffffff;
    color: #1e293b;
    font-weight: 700;
    font-size: 1.1rem;
    padding: 20px 25px;
    border: none;
    box-shadow: none !important;
  }
  .modern-accordion .accordion-button:not(.collapsed) {
    background: #f0fdf4;
    color: #15803d;
  }
  .modern-accordion .accordion-button::after {
    filter: grayscale(1);
    transition: all 0.3s ease;
  }
  .modern-accordion .accordion-button:not(.collapsed)::after {
    filter: invert(40%) sepia(80%) saturate(400%) hue-rotate(90deg) brightness(90%) contrast(90%);
  }
  
  .step-badge {
    background: #64CA3F;
    color: white;
    width: 35px;
    height: 35px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    margin-right: 15px;
    font-size: 1rem;
  }
  
  .modern-accordion .accordion-body {
    padding: 0 25px 25px 75px;
    color: #64748b;
    font-size: 1rem;
    line-height: 1.6;
  }
  .guide-img {
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    margin-top: 15px;
    border: 1px solid #e2e8f0;
  }
</style>

<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-9">
      
      <div class="guide-header">
        <h2 class="fw-bold mb-2 position-relative" style="z-index: 2;">📖 Panduan Penggunaan DUCARE</h2>
        <p class="mb-0 position-relative" style="z-index: 2; opacity: 0.9;">Ikuti langkah-langkah di bawah ini untuk memahami cara melapor dan memantau status laporan kamu.</p>
      </div>

      <div class="accordion modern-accordion" id="panduanAccordion">
        
        <!-- Langkah 1 -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              <span class="step-badge">1</span> Cara Membuat Akun (Registrasi)
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#panduanAccordion">
            <div class="accordion-body">
              <p>Untuk membuat akun baru di sistem DUCARE, ikuti langkah berikut:</p>
              <ol class="ps-3">
                <li>Buka halaman utama portal DUCARE dan klik tombol <strong>Register</strong> di pojok kanan atas.</li>
                <li>Isi form pendaftaran dengan data diri lengkap Anda:
                  <ul>
                    <li><strong>Nama Lengkap:</strong> Masukkan nama lengkap Anda.</li>
                    <li><strong>NIS:</strong> Nomor Induk Siswa Anda yang terdaftar resmi.</li>
                    <li><strong>Alamat Email:</strong> Gunakan alamat email aktif (untuk menerima notifikasi).</li>
                    <li><strong>Password & Konfirmasi Password:</strong> Buat kata sandi minimal 6 karakter.</li>
                  </ul>
                </li>
                <li>Klik tombol <strong>Daftar</strong>. Sistem akan menyimpan data Anda dan menampilkan notifikasi sukses registrasi.</li>
              </ol>
            </div>
          </div>
        </div>

        <!-- Langkah 2 -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <span class="step-badge">2</span> Cara Login ke Akun
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#panduanAccordion">
            <div class="accordion-body">
              <p>Setelah akun terdaftar, Anda dapat masuk ke dalam dashboard pelapor dengan cara:</p>
              <ol class="ps-3">
                <li>Klik tombol <strong>Login</strong> di halaman utama aplikasi.</li>
                <li>Masukkan <strong>Email</strong> dan <strong>Password</strong> yang sudah didaftarkan pada langkah sebelumnya.</li>
                <li>Klik tombol <strong>Masuk</strong>. Sistem akan memvalidasi data Anda dan mengarahkan Anda ke Dashboard Pelapor.</li>
              </ol>
            </div>
          </div>
        </div>

        <!-- Langkah 3 -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              <span class="step-badge">3</span> Membuat Laporan Bullying Baru
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#panduanAccordion">
            <div class="accordion-body">
              <p>Untuk melaporkan tindakan perundungan (bullying) yang Anda alami atau lihat, ikuti alur berikut:</p>
              <ol class="ps-3">
                <li>Pilih menu <strong>Buat Laporan</strong> di sidebar kiri dashboard.</li>
                <li>Pilih <strong>Jenis Pelaporan</strong>:
                  <ul>
                    <li><strong>Anonim:</strong> Identitas Anda tidak akan ditampilkan ke Guru BK/Admin (Nama Pelapor tertulis sebagai 'Anonim').</li>
                    <li><strong>Non-Anonim:</strong> Identitas Anda (Nama Lengkap) akan dilampirkan secara transparan dalam laporan.</li>
                  </ul>
                </li>
                <li>Lengkapi detail kejadian pada form:
                  <ul>
                    <li><strong>Tanggal Kejadian:</strong> Pilih tanggal saat kejadian bullying berlangsung.</li>
                    <li><strong>Terduga Pelaku:</strong> Tulis nama siswa/pihak yang melakukan bullying.</li>
                    <li><strong>Judul Laporan & Isi Kejadian:</strong> Berikan judul yang jelas dan ceritakan kronologi secara rinci di kolom isi laporan.</li>
                    <li><strong>Saksi (Opsional):</strong> Tulis nama orang lain yang melihat kejadian tersebut.</li>
                    <li><strong>Bukti Gambar (Opsional):</strong> Unggah foto bukti (seperti screenshot chat, foto kejadian) maksimal 2MB.</li>
                  </ul>
                </li>
                <li>Tekan tombol <strong>Kirim Laporan</strong>. Sistem akan menyimpan laporan dan mengirimkan notifikasi email otomatis ke Guru BK & Admin.</li>
              </ol>
            </div>
          </div>
        </div>

        <!-- Langkah 4 -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              <span class="step-badge">4</span> Memantau Status & Mengelola Laporan
            </button>
          </h2>
          <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#panduanAccordion">
            <div class="accordion-body">
              <p>Anda dapat memantau respons sekolah terhadap laporan Anda secara real-time:</p>
              <ol class="ps-3">
                <li>Buka menu <strong>Status Laporan</strong> di sidebar kiri.</li>
                <li>Di halaman tersebut, Anda dapat melihat daftar seluruh laporan yang pernah dikirimkan beserta statusnya:
                  <ul>
                    <li><span class="badge bg-warning">Dalam Proses</span>: Laporan Anda sedang dalam penyelidikan atau tindak lanjut oleh Guru BK.</li>
                    <li><span class="badge bg-success">Selesai</span>: Kasus telah selesai ditangani dan Anda akan menerima email notifikasi beserta catatan solusi dari Guru BK.</li>
                    <li><span class="badge bg-danger">Ditolak</span>: Laporan ditolak (karena dianggap spam/tidak valid) beserta alasannya.</li>
                  </ul>
                </li>
                <li>Selama laporan masih berstatus <strong>Dalam Proses</strong>, Anda dapat menekan opsi <strong>Ubah Laporan</strong> untuk memperbaiki detail kronologi, atau <strong>Hapus Laporan</strong> untuk membatalkannya.</li>
              </ol>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>
@endsection
