@extends('layouts.admin-layout')

@section('title', 'Panduan Admin - DUCARE')

@section('admin-content')
<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold" style="color: #0f172a;"><i class="fa-solid fa-book-open-reader text-primary me-2"></i> Pusat Bantuan & Panduan</h3>
            <p class="text-muted mb-0">Dokumentasi lengkap cara penggunaan sistem untuk Administrator.</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <!-- Sidebar Bantuan -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 bg-primary bg-opacity-10 border border-primary border-opacity-25">
                <div class="card-body p-4 text-center">
                    <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm mb-3" style="width: 80px; height: 80px;">
                        <i class="fa-solid fa-headset text-primary fs-1"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Butuh Bantuan Teknis?</h5>
                    <p class="text-muted small mb-4">Tim IT Support kami siap membantu kendala Anda 24/7.</p>
                    <button class="btn btn-primary rounded-pill w-100 fw-semibold shadow-sm">
                        <i class="fa-brands fa-whatsapp me-2"></i> Hubungi Support
                    </button>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-dark mb-3">Tautan Cepat</h6>
                    <div class="d-flex flex-column gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted small hover-primary p-2 rounded bg-light"><i class="fa-solid fa-arrow-right text-primary me-2"></i> Kembali ke Dashboard</a>
                        <a href="{{ route('admin.kelola.akun') }}" class="text-decoration-none text-muted small hover-primary p-2 rounded bg-light"><i class="fa-solid fa-arrow-right text-primary me-2"></i> Manajemen Akun</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Accordion Panduan -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-4">FAQ & Panduan Sistem</h5>

                    <div class="accordion accordion-flush" id="panduanAccordion">
                        
                        <!-- Panduan 1 -->
                        <div class="accordion-item border border-light rounded-3 mb-3 shadow-sm overflow-hidden">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed bg-white fw-semibold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <i class="fa-solid fa-user-shield text-primary me-3 fs-5"></i> 1. Pengantar & Cara Login
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#panduanAccordion">
                                <div class="accordion-body bg-light text-muted" style="text-align: justify;">
                                    <p>Sebagai Administrator utama sistem DUCARE, Anda memiliki kewenangan tertinggi untuk mengawasi seluruh aktivitas dan data:</p>
                                    <ol class="ps-3">
                                        <li>Buka alamat khusus administrator di rute <strong>`/admin/login`</strong> pada web browser Anda.</li>
                                        <li>Masukkan alamat email admin resmi Anda (misal: <code>admin_baru@ducare.com</code>) dan kata sandi Anda.</li>
                                        <li>Klik tombol <strong>Login</strong>. Setelah masuk, Anda akan diarahkan ke Dashboard Utama Admin.</li>
                                    </ol>
                                    <p class="mb-0 text-danger"><i class="fa-solid fa-triangle-exclamation me-1"></i> <strong>Penting:</strong> Demi keamanan data sekolah dan siswa, jagalah kerahasiaan kredensial login ini dan pastikan untuk selalu melakukan logout setelah selesai mengelola sistem.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Panduan 2 -->
                        <div class="accordion-item border border-light rounded-3 mb-3 shadow-sm overflow-hidden">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed bg-white fw-semibold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fa-solid fa-clipboard-check text-primary me-3 fs-5"></i> 2. Mengelola Laporan Masuk
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#panduanAccordion">
                                <div class="accordion-body bg-light text-muted" style="text-align: justify;">
                                    <p>Melalui menu <strong>Kelola Laporan</strong>, Anda dapat melihat seluruh riwayat pelaporan. Admin berhak untuk:</p>
                                    <ul>
                                        <li>Melihat detail kejadian beserta bukti foto.</li>
                                        <li>Memperbarui status laporan (Selesai/Ditolak).</li>
                                        <li>Menambahkan catatan penanganan.</li>
                                        <li>Menghapus laporan yang bersifat <em>spam</em> (permanen).</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Panduan 3 -->
                        <div class="accordion-item border border-light rounded-3 mb-3 shadow-sm overflow-hidden">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed bg-white fw-semibold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fa-solid fa-users-gear text-primary me-3 fs-5"></i> 3. Menambah dan Mengelola Akun
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#panduanAccordion">
                                <div class="accordion-body bg-light text-muted" style="text-align: justify;">
                                    <p>Menu <strong>Kelola Akun</strong> digunakan untuk mengontrol siapa saja yang memiliki akses ke sistem. Sebagai Admin, Anda dapat me-<em>reset</em> password pengguna yang lupa, mengubah Role (Pelapor/Guru BK), atau menghapus akun siswa yang melanggar aturan penggunaan aplikasi.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Panduan 4 -->
                        <div class="accordion-item border border-light rounded-3 mb-3 shadow-sm overflow-hidden">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed bg-white fw-semibold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <i class="fa-solid fa-print text-primary me-3 fs-5"></i> 4. Cetak Dokumen PDF
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#panduanAccordion">
                                <div class="accordion-body bg-light text-muted" style="text-align: justify;">
                                    <p>Untuk mencetak Berita Acara, masuk ke menu <strong>Cetak Laporan</strong>. Anda dapat mengunduh dokumen per kasus (Berita Acara Detail) dalam format PDF, atau mencetak seluruh daftar kasus sekaligus ke kertas menggunakan fitur <em>Print Browser</em>.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling khusus panduan */
    .hover-primary:hover {
        background-color: #e0f2fe !important;
        color: #0284c7 !important;
    }
    .accordion-button:not(.collapsed) {
        background-color: #f0f9ff;
        color: #0284c7;
        box-shadow: inset 0 -1px 0 rgba(0,0,0,.125);
    }
    .accordion-button:focus {
        border-color: #bae6fd;
        box-shadow: 0 0 0 0.25rem rgba(2, 132, 199, 0.25);
    }
</style>
@endsection
