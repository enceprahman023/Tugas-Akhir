<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darul Ulum Care</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
      body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #334155;
        padding-top: 76px;
      }
      
      /* Navbar Tetap Hijau */
      .navbar {
        background-color: #15803d !important; /* Hijau yang solid dan profesional */
        box-shadow: 0 4px 15px rgba(21, 128, 61, 0.2);
      }
      .navbar-brand .brand-title { font-weight: 800; color: #ffffff; line-height: 1.2; }
      .navbar-brand .brand-subtitle { font-size: 0.75rem; color: #dcfce7; font-weight: 600; letter-spacing: 1px; }
      .nav-link { color: #f0fdf4 !important; font-weight: 500; transition: color 0.3s; }
      .nav-link:hover, .nav-link.active { color: #fef08a !important; font-weight: 700; }
      
      .btn-outline-warning { border: 2px solid #fef08a; color: #fef08a; font-weight: 600; border-radius: 12px; }
      .btn-outline-warning:hover { background: #fef08a; color: #15803d; border-color: #fef08a; }
      .btn-outline-light { background: #ffffff; color: #15803d; border: none; font-weight: 600; border-radius: 12px; }
      .btn-outline-light:hover { background: #f0fdf4; color: #166534; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }

      /* Hero Section */
      .home-hero {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        min-height: 550px;
        position: relative;
        overflow: hidden;
      }
      .home-hero::before {
        content: ''; position: absolute; width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(100,202,63,0.15) 0%, rgba(0,0,0,0) 70%);
        top: -100px; right: -100px; border-radius: 50%;
      }
      .cta-btn {
        background: linear-gradient(135deg, #64CA3F 0%, #4DA834 100%);
        color: #fff;
        font-weight: 700;
        font-size: 1.1rem;
        border-radius: 14px;
        padding: 14px 35px;
        box-shadow: 0 10px 25px rgba(100,202,63,0.3);
        transition: all 0.3s;
        display: inline-block;
        text-decoration: none;
      }
      .cta-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(100,202,63,0.4);
        color: #fff;
      }
      .hero-img {
        animation: float 6s ease-in-out infinite;
        max-width: 380px; /* Diperkecil sesuai request */
        width: 100%;
      }
      @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
      }

      /* Unified Section Styling */
      section { padding: 80px 0; }
      .section-title {
        font-weight: 800;
        color: #1e293b;
        position: relative;
        display: inline-block;
        margin-bottom: 2rem;
      }
      .section-title::after {
        content: ''; position: absolute; left: 0; bottom: -10px;
        width: 50px; height: 4px; background: #64CA3F; border-radius: 2px;
      }
      .text-center .section-title::after { left: 50%; transform: translateX(-50%); }

      /* Variasi Background per Section (Modern Pastels) */
      .bg-section-visi { background-color: #f8fafc; } /* Slate sangat muda */
      .bg-section-about { background-color: #f0fdf4; } /* Hijau sangat muda */
      .bg-section-team { background-color: #ffffff; } /* Putih bersih */
      .bg-section-contact { background-color: #f1f5f9; } /* Slate agak abu */

      /* Cards & Images */
      .feature-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.05);
        height: 100%;
        border: 1px solid rgba(0,0,0,0.02);
      }
      .img-custom {
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
        max-width: 380px; /* Gambar tidak terlalu besar */
        width: 100%;
        margin: 0 auto;
        display: block;
      }
      .img-custom:hover { transform: scale(1.02); }

      /* Team Section */
      .team-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.02);
      }
      .team-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.08);
      }
      .team-photo {
        width: 110px; height: 110px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #f1f5f9;
        margin-bottom: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      }

      /* Contact Section */
      .contact-box {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        height: 100%;
        transition: all 0.3s;
        border: 1px solid #e2e8f0;
      }
      .contact-box:hover {
        border-color: #64CA3F;
        transform: translateY(-5px);
      }
      .contact-icon {
        width: 60px; height: 60px;
        background: #dcfce7;
        color: #16a34a;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 24px; margin: 0 auto 15px;
      }

      /* Footer */
      .footer-custom {
        background: #0f172a;
        color: #94a3b8;
        padding: 60px 0 20px;
      }
      .footer-menu { list-style: none; padding: 0; display: flex; gap: 20px; justify-content: center; }
      .footer-menu a { color: #cbd5e1; text-decoration: none; font-weight: 500; transition: color 0.3s; }
      .footer-menu a:hover { color: #64CA3F; }
      .social-icons a {
        display: inline-flex; width: 40px; height: 40px;
        background: rgba(255,255,255,0.05); color: #fff;
        border-radius: 50%; align-items: center; justify-content: center;
        transition: all 0.3s; margin: 0 5px;
      }
      .social-icons a:hover { background: #64CA3F; transform: translateY(-3px); }
    </style>
</head>
<body>

<!-- Navbar (Hijau) -->
<nav class="navbar navbar-expand-lg fixed-top py-3">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-3" href="#">
      <img src="{{ asset('images/logodu.png') }}" alt="Logo" width="45" height="45">
      <div>
        <div class="brand-title">DUCARE</div>
        <div class="brand-subtitle">DARUL ULUM CARE</div>
      </div>
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" style="filter: invert(1);">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav mx-auto gap-3">
        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/about-bullying">About Bullying</a></li>
        <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
        <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
      </ul>
      <div class="d-flex gap-3 mt-3 mt-lg-0">
        <a href="{{ route('register') }}" class="btn btn-outline-warning px-4">Register</a>
        <a href="{{ route('login') }}" class="btn btn-outline-light px-4">Login</a>
      </div>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="home-hero d-flex align-items-center pt-5">
  <div class="container position-relative z-2">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start">
        <h1 class="fw-bold text-white mb-3" style="font-size: 3.2rem; line-height: 1.15;">
          Together Against <span style="color: #64CA3F;">Bullying</span>,<br>Act Now!
        </h1>
        <p class="lead text-white-50 mb-5" style="font-size: 1.1rem; max-width: 500px; line-height: 1.7; margin: 0 auto;">
          DUCARE adalah platform pelaporan pintar untuk siswa Darul Ulum Nurdiniyyah Pasir Jambu. Mari ciptakan lingkungan sekolah yang aman, nyaman, dan bebas perundungan.
        </p>
        <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
          <a href="{{ route('register') }}" class="cta-btn">Mulai Lapor Sekarang</a>
        </div>
      </div>
      <div class="col-lg-6 text-center">
        <img src="{{ asset('images/bullying home.png') }}" alt="logo-bullying" class="img-fluid hero-img">
      </div>
    </div>
  </div>
</section>

<!-- Vision Section -->
<section class="bg-section-visi">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <img src="{{ asset('images/gambar halaman visi.jpg') }}" alt="Visi" class="img-fluid img-custom">
      </div>
      <div class="col-lg-6">
        <div class="feature-card">
          <h2 class="section-title">Visi Program Kami</h2>
          <p class="fs-5 text-muted mb-4" style="line-height: 1.7;">
            Melalui platform DUCARE, kami menghadirkan ruang aman bagi siswa untuk bersuara tanpa rasa takut. 
          </p>
          <p class="text-muted" style="line-height: 1.7; font-size: 1.05rem;">
            Program ini dirancang tidak hanya untuk memudahkan pelaporan, tetapi juga mempercepat respon sekolah dalam menangani setiap indikasi perundungan. Bersama, kita wujudkan generasi peduli yang saling melindungi.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- About Section -->
<section class="bg-section-about">
  <div class="container">
    <div class="row align-items-center g-5 flex-lg-row-reverse">
      <div class="col-lg-6">
        <img src="{{ asset('images/about bullying.jpg') }}" alt="About Bullying" class="img-fluid img-custom">
      </div>
      <div class="col-lg-6">
        <div class="feature-card">
          <h2 class="section-title">Kenali Bullying</h2>
          <p class="text-muted mb-4" style="line-height: 1.7; font-size: 1.05rem;">
            Bullying bukan sekadar candaan. Ini adalah tindakan menyakiti orang lain secara sengaja dan berulang, baik secara fisik, verbal, maupun emosional.
          </p>
          <p class="text-muted mb-4" style="line-height: 1.7; font-size: 1.05rem;">
            Dampaknya sangat serius terhadap mental dan kehidupan sosial korban. Memahami bentuk-bentuk bullying adalah langkah pertama untuk menghentikannya. Jangan biarkan terjadi di sekitarmu!
          </p>
          <a href="/detail-bullying" class="btn btn-outline-light text-dark bg-white border mt-2 px-4 py-2 rounded-pill fw-bold shadow-sm" style="border-color: #cbd5e1 !important;">Pelajari Lebih Lanjut <i class="bi bi-arrow-right ms-2"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Team Section -->
<section id="team" class="bg-section-team">
  <div class="container text-center">
    <h2 class="section-title mb-5">Tim Pengembang</h2>
    <div class="row justify-content-center g-4">
      <div class="col-lg-4 col-md-6">
        <div class="team-card">
          <img src="{{ asset('images/team 1.jpg') }}" alt="Sholihin Mahmud" class="team-photo">
          <h5 class="fw-bold text-dark mb-1">Sholihin Mahmud</h5>
          <p class="text-success fw-semibold mb-0" style="color:#16a34a !important;">Frontend Developer</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="team-card">
          <img src="{{ asset('images/team 2.jpg') }}" alt="Mansyur Sudhama" class="team-photo">
          <h5 class="fw-bold text-dark mb-1">Mansyur Sudhama</h5>
          <p class="text-success fw-semibold mb-0" style="color:#16a34a !important;">Backend Developer</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="team-card">
          <img src="{{ asset('images/team 3.jpg') }}" alt="Nuril Sanusi" class="team-photo">
          <h5 class="fw-bold text-dark mb-1">Nuril Sanusi</h5>
          <p class="text-success fw-semibold mb-0" style="color:#16a34a !important;">UI/UX Designer</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Contact & Map Section -->
<section id="kontak" class="bg-section-contact">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title">Hubungi Kami</h2>
      <p class="text-muted" style="font-size: 1.05rem;">Punya pertanyaan atau butuh bantuan darurat? Kami siap mendengarkan.</p>
    </div>
    
    <div class="row g-4 mb-5">
      <div class="col-md-4">
        <div class="contact-box text-center">
          <div class="contact-icon"><i class="bi bi-geo-alt-fill"></i></div>
          <h5 class="fw-bold mb-2">Lokasi Sekolah</h5>
          <p class="text-muted mb-0">Jl. Raya Ciwidey KM.25,<br>Pasirjambu, Bandung</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="contact-box text-center">
          <div class="contact-icon"><i class="bi bi-envelope-fill"></i></div>
          <h5 class="fw-bold mb-2">Email Layanan</h5>
          <p class="text-muted mb-0">dukungan@ducare.sch.id<br>info@ducare.sch.id</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="contact-box text-center">
          <div class="contact-icon"><i class="bi bi-telephone-fill"></i></div>
          <h5 class="fw-bold mb-2">Telepon Darurat</h5>
          <p class="text-muted mb-0">(+62) 812-3456-7890<br>Senin - Jumat, 07:00 - 15:00</p>
        </div>
      </div>
    </div>

    <!-- Map -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mt-4">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31674.340284952763!2d107.4369843492558!3d-7.0920497585975575!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ed56408530c9%3A0x5e331a2a59a3b3db!2sPondok%20Pesantren%20Darul%20Ulum%20Cikabuyutan!5e0!3m2!1sid!2sid!4v1748661714025!5m2!1sid!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="footer-custom">
  <div class="container">
    <div class="row align-items-center mb-4">
      <div class="col-md-4 text-center text-md-start mb-4 mb-md-0">
        <img src="{{ asset('images/logo Du2.png') }}" alt="DUCARE" style="max-width: 110px;">
        <p class="mt-3 text-white-50 small">Platform Pelaporan Bullying Cerdas & Aman untuk Sekolah.</p>
      </div>
      <div class="col-md-4 mb-4 mb-md-0">
        <ul class="footer-menu">
          <li><a href="#">Home</a></li>
          <li><a href="/about-bullying">Tentang</a></li>
          <li><a href="{{ route('login') }}">Lapor</a></li>
          <li><a href="#kontak">Kontak</a></li>
        </ul>
      </div>
      <div class="col-md-4 text-center text-md-end social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-tiktok"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
    <div class="border-top border-secondary pt-4 text-center text-white-50 small">
      &copy; 2025 DUCARE. Darul Ulum Nurdiniyyah Pasir Jambu. All rights reserved.
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>