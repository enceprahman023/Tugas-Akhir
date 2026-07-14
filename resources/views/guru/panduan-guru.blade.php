@extends('layouts.guru-layout')

@section('title', 'Panduan Guru BK')

@section('guru-content')
<div class="container-fluid p-0">
    <style>
        .guide-header {
            background: linear-gradient(135deg, #ffffff 0%, #fffbeb 100%);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.04);
            border: 1px solid rgba(245, 158, 11, 0.1);
            margin-bottom: 30px;
            text-align: center;
        }
        .accordion-item {
            border: 1px solid #f1f5f9;
            border-radius: 15px !important;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            overflow: hidden;
        }
        .accordion-button {
            font-weight: 700;
            color: #1e293b;
            background-color: #ffffff;
            padding: 20px 25px;
            border: none;
            box-shadow: none !important;
        }
        .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #d97706;
        }
        .accordion-button::after {
            filter: grayscale(1);
        }
        .accordion-button:not(.collapsed)::after {
            filter: invert(50%) sepia(80%) saturate(2000%) hue-rotate(10deg) brightness(90%) contrast(90%);
        }
        .accordion-body {
            background-color: #fff;
            padding: 25px;
            color: #475569;
            line-height: 1.7;
        }
        .accordion-body img {
            border-radius: 15px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            margin-top: 15px;
        }
    </style>

    <div class="guide-header">
        <h2 class="fw-bold" style="color: #1e293b; margin-bottom: 5px;"><i class="fa-solid fa-book-open text-warning me-2"></i>Panduan Penggunaan</h2>
        <p class="text-muted mb-0">Langkah-langkah detail menggunakan portal Guru BK DUCARE.</p>
    </div>

    <div class="container bg-white p-4 rounded-4 shadow-sm border border-light" style="max-width: 900px; margin: 0 auto;">

            <div class="accordion" id="panduanGuruAccordion">

                {{-- Langkah 1 --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <i class="fa-solid fa-right-to-bracket text-warning me-2"></i> Langkah 1: Login Portal Guru BK
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#panduanGuruAccordion">
                        <div class="accordion-body">
                            <p>Untuk mengakses halaman Guru BK, ikuti langkah berikut:</p>
                            <ol class="ps-3">
                                <li>Buka rute khusus Guru BK di alamat <strong>`/login-guru`</strong> pada web browser.</li>
                                <li>Masukkan alamat email Guru BK yang sudah didaftarkan oleh Administrator dan ketik kata sandi Anda.</li>
                                <li>Klik tombol <strong>Login</strong>. Setelah autentikasi berhasil, Anda akan diarahkan ke halaman Dashboard Guru BK.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                {{-- Langkah 2 --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <i class="fa-solid fa-clipboard-list text-warning me-2"></i> Langkah 2: Meninjau & Mengelola Laporan Masuk
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#panduanGuruAccordion">
                        <div class="accordion-body">
                            <p>Guru BK bertanggung jawab penuh atas tindak lanjut laporan bullying yang dikirimkan oleh siswa:</p>
                            <ol class="ps-3">
                                <li>Masuk ke menu <strong>Kelola Laporan</strong> di sidebar kiri dashboard. Halaman ini menyajikan tabel daftar laporan terbaru.</li>
                                <li>Klik tombol opsi dan pilih <strong>Detail</strong> untuk meninjau secara menyeluruh kronologi kasus, terduga pelaku, saksi-saksi, serta mengunduh lampiran foto bukti yang diunggah.</li>
                                <li>Pada halaman detail tersebut, isi form penanganan:
                                    <ul>
                                        <li><strong>Catatan Penanganan:</strong> Tuliskan tindakan konseling atau hasil mediasi yang telah dilakukan untuk menyelesaikan kasus.</li>
                                        <li><strong>Tanggal Penanganan:</strong> Pilih tanggal penanganan diselesaikan.</li>
                                        <li><strong>Tanda Tangan (TTD):</strong> Unggah file gambar tanda tangan basah Anda (format PNG/JPG/JPEG maks 2MB) untuk legalitas dokumen.</li>
                                    </ul>
                                </li>
                                <li>Klik tombol <strong>Simpan Catatan</strong>.</li>
                                <li>Terakhir, ubah status laporan di bagian bawah halaman menjadi <strong>Selesai</strong> (jika kasus sudah tuntas diatasi) atau <strong>Ditolak</strong> (jika laporan terbukti palsu/spam).</li>
                                <li>Sistem akan otomatis mengirimkan notifikasi email pembaruan status beserta catatan penanganan Anda langsung ke email siswa pelapor.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                {{-- Langkah 3 --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <i class="fa-solid fa-print text-warning me-2"></i> Langkah 3: Cetak Berita Acara
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#panduanGuruAccordion">
                        <div class="accordion-body">
                            <p>Untuk kebutuhan administrasi sekolah dan pelaporan ke pihak yayasan/kepala sekolah, Anda dapat mencetak Berita Acara resmi:</p>
                            <ol class="ps-3">
                                <li>Masuk ke menu <strong>Cetak Laporan</strong> di sidebar dashboard.</li>
                                <li>Di sini Anda dapat melihat riwayat laporan yang sudah diselesaikan atau ditolak.</li>
                                <li>Pilih opsi cetak pada laporan yang bersangkutan, maka sistem akan mengunduh dokumen Berita Acara PDF resmi lengkap dengan rincian kronologi, catatan tindak lanjut, serta tanda tangan basah yang telah Anda bubuhkan sebelumnya.</li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection


