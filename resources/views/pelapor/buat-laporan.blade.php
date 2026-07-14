@extends('layouts.dashboard-layout')

@section('content')
<style>
  .form-card {
    background: #ffffff;
    border-radius: 24px;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.05);
    padding: 50px 40px;
    border: none;
  }
  
  .form-header {
    text-align: center;
    margin-bottom: 35px;
  }
  .form-header .icon-box {
    width: 70px;
    height: 70px;
    background: #dcfce7;
    color: #16a34a;
    border-radius: 22px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    margin-bottom: 16px;
  }
  
  .form-control, .form-select {
    padding: 16px 20px;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    background-color: #f8fafc;
    font-size: 15px;
    transition: all 0.3s ease;
    color: #334155;
  }
  .form-control:focus, .form-select:focus {
    outline: none;
    border-color: #64CA3F;
    background-color: #ffffff;
    box-shadow: 0 0 0 4px rgba(100, 202, 63, 0.15);
  }
  
  .form-label {
    font-weight: 600;
    color: #475569;
    margin-bottom: 10px;
  }

  /* Custom Radio Buttons / Pills */
  .radio-group {
    display: flex;
    gap: 15px;
  }
  .radio-pill {
    flex: 1;
    position: relative;
  }
  .radio-pill input[type="radio"] {
    display: none;
  }
  .radio-pill label {
    display: block;
    padding: 20px 10px;
    border-radius: 16px;
    border: 2px solid #e2e8f0;
    background: #ffffff;
    cursor: pointer;
    text-align: center;
    font-weight: 600;
    color: #64748b;
    transition: all 0.3s;
  }
  .radio-pill input[type="radio"]:checked + label {
    border-color: #64CA3F;
    background: #f0fdf4;
    color: #15803d;
  }
  .radio-pill label i {
    font-size: 1.5rem;
    display: block;
    margin-bottom: 8px;
  }

  .btn-outline-custom {
    border: 2px dashed #cbd5e1;
    color: #64748b;
    background: transparent;
    padding: 14px 20px;
    border-radius: 14px;
    font-weight: 600;
    transition: all 0.3s;
  }
  .btn-outline-custom:hover, .btn-outline-custom.active-btn {
    border-color: #64CA3F;
    color: #15803d;
    background: #f0fdf4;
  }

  .btn-submit {
    background: linear-gradient(135deg, #64CA3F 0%, #4DA834 100%);
    color: white;
    font-size: 18px;
    font-weight: 700;
    padding: 16px 30px;
    border: none;
    border-radius: 16px;
    width: 100%;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(100, 202, 63, 0.3);
  }
  .btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(100, 202, 63, 0.4);
    color: white;
  }
</style>

<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
      
      <div class="form-card">
        <div class="form-header">
          <div class="icon-box">
            <i class="bi bi-shield-lock-fill"></i>
          </div>
          <h3 class="fw-bold text-dark">Laporkan Kejadian Perundungan</h3>
          <p class="text-muted" style="font-size: 1.1rem;">Jangan takut untuk bersuara! Kami akan melindungi identitas dan privasimu.</p>
        </div>

        <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <!-- Pilihan Anonim / Non-Anonim -->
          <div class="mb-4 pb-2">
            <label class="form-label">Pilih Mode Pelaporan</label>
            <div class="radio-group">
              <div class="radio-pill">
                <input type="radio" name="jenis_pelaporan" id="anonim" value="anonim" checked>
                <label for="anonim">
                  <i class="bi bi-incognito"></i>
                  Mode Anonim
                  <small class="d-block text-muted mt-1" style="font-weight: 400;">Identitas disembunyikan</small>
                </label>
              </div>
              <div class="radio-pill">
                <input type="radio" name="jenis_pelaporan" id="non-anonim" value="non-anonim">
                <label for="non-anonim">
                  <i class="bi bi-person-badge-fill"></i>
                  Mode Terbuka
                  <small class="d-block text-muted mt-1" style="font-weight: 400;">Tampilkan identitas kamu</small>
                </label>
              </div>
            </div>
          </div>

          <!-- Form Identitas Pelapor -->
          <div id="identitasPelapor" class="mb-4" style="display: none;">
            <label class="form-label">Nama Lengkap Kamu</label>
            <input type="text" class="form-control" id="namaPelapor" name="nama_pelapor" placeholder="Ketik nama lengkapmu di sini...">
          </div>

          <div class="row g-4 mb-4">
            <div class="col-md-6">
              <label class="form-label">Tanggal Kejadian</label>
              <input type="date" class="form-control" id="tanggal_kejadian" name="tanggal_kejadian" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Nama Pelaku (Pembuli)</label>
              <input type="text" class="form-control" id="orangMembuli" name="orang_membuli" placeholder="Ketik nama pelaku..." required>
            </div>
          </div>

          <!-- Judul Laporan -->
          <div class="mb-4">
            <label for="judul" class="form-label">Judul / Ringkasan Kejadian</label>
            <input type="text" class="form-control" id="judul" name="judul" placeholder="Contoh: Pemalakan di kantin saat jam istirahat" required>
          </div>

          <!-- Isi Laporan -->
          <div class="mb-4 pb-2">
            <label for="isi" class="form-label">Ceritakan Kejadiannya</label>
            <textarea class="form-control" id="isi" name="isi" rows="6" placeholder="Ceritakan sedetail mungkin apa yang terjadi, di mana lokasinya, dan bagaimana situasinya..." required></textarea>
          </div>

          <!-- Opsional Buttons -->
          <div class="d-flex flex-column flex-sm-row gap-3 mb-4">
            <button type="button" class="btn btn-outline-custom flex-fill text-center" id="toggleSaksi">
              <i class="bi bi-person-plus-fill me-2"></i> Tambah Saksi <span class="fw-normal">(Opsional)</span>
            </button>
            <button type="button" class="btn btn-outline-custom flex-fill text-center" id="toggleBukti">
              <i class="bi bi-image-fill me-2"></i> Unggah Bukti <span class="fw-normal">(Opsional)</span>
            </button>
          </div>

          <!-- Form Saksi -->
          <div class="mb-4" id="formSaksi" style="display: none;">
            <label for="saksi" class="form-label">Nama Saksi (Jika Ada)</label>
            <input type="text" class="form-control" id="saksi" name="saksi" placeholder="Contoh: Budi, Andi">
          </div>

          <!-- Input Bukti Gambar -->
          <div class="mb-4" id="formBukti" style="display: none;">
            <label for="bukti" class="form-label">Unggah Foto Bukti</label>
            <input class="form-control p-3" type="file" id="bukti" name="bukti" accept="image/*">
            <small class="text-muted mt-2 d-block"><i class="bi bi-info-circle text-primary"></i> Format yang didukung: JPG, PNG, JPEG. (Maks 2MB)</small>
          </div>

          <!-- Tombol Kirim -->
          <div class="mt-5 pt-2 border-top">
            <button type="submit" class="btn btn-submit mt-4">
              <i class="bi bi-send-fill me-2"></i> Kirim Laporan Sekarang
            </button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const anonimRadio = document.getElementById('anonim');
    const nonAnonimRadio = document.getElementById('non-anonim');
    const identitasPelapor = document.getElementById('identitasPelapor');
    
    const btnSaksi = document.getElementById('toggleSaksi');
    const formSaksi = document.getElementById('formSaksi');
    
    const btnBukti = document.getElementById('toggleBukti');
    const formBukti = document.getElementById('formBukti');

    function toggleDisplay(element, show) {
        if(show) {
            element.style.display = 'block';
            // Smooth reveal animation
            element.animate([
                { opacity: 0, transform: 'translateY(-10px)' },
                { opacity: 1, transform: 'translateY(0)' }
            ], {
                duration: 300,
                easing: 'ease-out',
                fill: 'forwards'
            });
        } else {
            element.style.display = 'none';
        }
    }

    // Identitas pelapor logic
    nonAnonimRadio.addEventListener('change', function () {
      if (this.checked) toggleDisplay(identitasPelapor, true);
    });

    anonimRadio.addEventListener('change', function () {
      if (this.checked) {
        toggleDisplay(identitasPelapor, false);
        document.getElementById('namaPelapor').value = '';
      }
    });

    // Saksi logic
    btnSaksi.addEventListener('click', function () {
        const isHidden = formSaksi.style.display === 'none';
        toggleDisplay(formSaksi, isHidden);
        this.classList.toggle('active-btn');
        if(!isHidden) document.getElementById('saksi').value = '';
    });

    // Bukti logic
    btnBukti.addEventListener('click', function () {
        const isHidden = formBukti.style.display === 'none';
        toggleDisplay(formBukti, isHidden);
        this.classList.toggle('active-btn');
        if(!isHidden) document.getElementById('bukti').value = '';
    });
  });
</script>

@if (session('success'))
<script>
  document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      icon: 'success',
      title: 'Laporan Berhasil!',
      text: '{{ session('success') }}',
      showCancelButton: true,
      confirmButtonColor: '#64CA3F',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Lihat Status Laporan',
      cancelButtonText: 'Tutup',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "{{ route('status.laporan') }}";
      }
    });
  });
</script>
@endif
@endsection
