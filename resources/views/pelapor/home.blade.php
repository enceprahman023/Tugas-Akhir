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
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pelapor.css') }}">
    <style>
      .navbar {
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
      }
      .home-hero .overlay {
        /* Overlay lebih tipis agar gambar sekolah tetap terlihat */
        background: linear-gradient(120deg, rgba(100,202,63,0.35) 0%, rgba(2,79,112,0.25) 100%);
        z-index: 1;
      }
      .home-hero .container {
        position: relative;
        z-index: 2;
      }
      .cta-btn {
        background: #64CA3F;
        color: #fff;
        font-weight: 600;
        border-radius: 30px;
        padding: 12px 32px;
        box-shadow: 0 2px 8px rgba(100,202,63,0.12);
        transition: background 0.2s;
      }
      .cta-btn:hover {
        background: #4ea32e;
        color: #fff;
      }
      .team-card {
        min-height: 350px;
      }
      .footer-social a {
        font-size: 22px;
        margin: 0 8px;
      }
      .footer-menu {
        margin-bottom: 0;
      }
      /* Section visi: gambar dan card lebih kecil, proporsional */
      .home-vision .img-visi-custom {
        max-width: 320px;
        width: 100%;
        height: auto;
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        margin: 0 auto;
        display: block;
      }
      .home-vision .text-box {
        background-color: #ffffff;
        padding: 24px 20px;
        border-radius: 14px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.07);
        max-width: 350px;
        margin: 0 auto;
      }
      @media (min-width: 992px) {
        .home-vision .row {
          align-items: center;
          justify-content: center;
        }
        .home-vision .col-md-6 {
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          min-height: 340px;
        }
      }
      @media (max-width: 768px) {
        .home-hero { height: auto; padding: 40px 0; }
        .home-hero .row { flex-direction: column; }
        .team-cards { flex-direction: column; gap: 20px; }
        .footer-container { flex-direction: column; align-items: center; gap: 20px; }
        .home-vision .text-box, .home-vision .img-visi-custom { max-width: 100%; }
      }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-success py-3 fixed-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="#">
      <img src="{{ asset('images/logodu.png') }}" alt="Logo" width="40" height="40">
      <div>
        <div class="brand-title">DUCARE</div>
        <div class="brand-subtitle">Darul Ulum Care</div>
      </div>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-2">
        <li class="nav-item"><a class="nav-link active text-white fw-semibold" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="/about-bullying">About Bullying</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="#team">Team</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="#kontak">Kontak</a></li>
      </ul>
      <div class="d-flex gap-2">
        <a href="{{ route('register') }}" class="btn btn-outline-warning">Register</a>
        <a href="{{ route('login') }}" class="btn btn-outline-light">Login</a>
      </div>
    </div>
  </div>
</nav>
<style>
body { padding-top: 76px; }
</style>

<section class="home-hero text-white position-relative" style="min-height: 520px;">
  <div class="overlay w-100 h-100 position-absolute top-0 start-0"></div>
  <div class="container position-relative z-2 py-5">
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <h2 class="fw-bold display-5 mb-2">Together Against</h2>
        <h2 class="fw-bold display-5 mb-4">Bullying, Act Now!</h2>
        <p class="lead mb-4">
          DUCARE adalah website pelaporan bullying untuk siswa Darul Ulum Nurdiniyyah Pasir Jambu. Bersama DUCARE, kita ciptakan sekolah yang aman dan bebas bullying.
        </p>
        <a href="/register" class="cta-btn">Mulai Lapor Sekarang</a>
      </div>
      <div class="col-md-6 text-center">
        <img src="{{ asset('images/bullying home.png') }}" alt="logo-bullying" class="mb-3 logo-bullying img-fluid" style="max-width: 320px;">
        <div class="mt-3 slogan-text">
          <h3 class="fw-bold mb-1">KAMU TIDAK SENDIRI</h3>
          <h3 class="fw-bold">KAMI PEDULI!</h3>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="home-vision py-5 bg-light">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-6 d-flex justify-content-center mb-4 mb-md-0">
        <img src="{{ asset('images/gambar halaman visi.jpg') }}" alt="people-peace" class="img-visi-custom">
      </div>
      <div class="col-md-6 d-flex justify-content-center">
        <div class="text-box">
          <h2 class="fw-bold mb-3">Visi Program Kami</h2>
          <p class="mb-0">
            Melalui program aplikasi DUCARE yang kami buat, kami ingin memberikan wadah yang aman dan mudah digunakan bagi siswa untuk melaporkan kasus bullying. Program ini dirancang untuk membantu sekolah merespon dengan cepat, serta menciptakan lingkungan yang lebih peduli dan bebas dari perundungan.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="about-section py-5" style="background: #e7eeff;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <div class="about-text">
          <h2 class="section-title mb-3">About Bullying</h2>
          <p>
            Bullying adalah tindakan menyakiti orang lain secara sengaja, baik secara fisik, verbal, maupun emosional. Biasanya dilakukan berulang-ulang dan membuat korban merasa takut, tertekan, atau tidak nyaman. Bullying bisa terjadi di mana saja, termasuk di sekolah, dan dapat berdampak serius pada mental maupun kehidupan sosial seseorang.
          </p>
          <a href="/detail-bullying" class="btn btn-outline-success mt-3">Pelajari Lebih Lanjut</a>
        </div>
      </div>
      <div class="col-md-6 text-center">
        <img src="{{ asset('images/about bullying.jpg') }}" alt="Poster Bullying" class="img-fluid poster-img rounded-4 shadow" style="max-width: 350px;">
      </div>
    </div>
  </div>
</section>

<section id="team" class="team-section py-5 bg-white">
  <div class="container text-center">
    <div class="team-title-wrapper mb-2 mx-auto">
      <h4 class="team-title mb-0">TEAM</h4>
    </div>
    <h3 class="team-subtitle mt-3 mb-5">Team Developer Kami</h3>
    <div class="team-cards d-flex justify-content-center gap-4 flex-wrap">
      <div class="team-card p-4">
        <img src="{{ asset('images/team 1.jpg') }}" alt="Team 1" class="team-photo mb-3 rounded-3 shadow">
        <h5 class="fw-bold mt-2">Sholihin Mahmud</h5>
        <p class="mb-0">Frontend Developer</p>
      </div>
      <div class="team-card p-4">
        <img src="{{ asset('images/team 2.jpg') }}" alt="Team 2" class="team-photo mb-3 rounded-3 shadow">
        <h5 class="fw-bold mt-2">Mansyur Sudhama</h5>
        <p class="mb-0">Backend Developer</p>
      </div>
      <div class="team-card p-4">
        <img src="{{ asset('images/team 3.jpg') }}" alt="Team 3" class="team-photo mb-3 rounded-3 shadow">
        <h5 class="fw-bold mt-2">Nuril Sanusi</h5>
        <p class="mb-0">UI/UX Designer</p>
      </div>
    </div>
  </div>
</section>

<section id="kontak" class="contact-section py-5" style="background: #e3f0ff;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-11">
        <div class="card border-0 shadow-lg rounded-4 p-4 mb-4" style="background: #f0faff;">
          <div class="row justify-content-center mb-4">
            <div class="col-lg-8 text-center">
              <div class="bg-success text-white py-2 px-4 d-inline-block rounded-3 mb-2">
                <h2 class="mb-0">KONTAK</h2>
              </div>
              <h4 class="mt-3 mb-2">Hubungi Kami</h4>
              <p class="text-muted mb-0">Jika ada pertanyaan, saran, atau ingin melaporkan sesuatu, silakan hubungi kami melalui kontak berikut:</p>
            </div>
          </div>
          <div class="row row-cols-1 row-cols-md-3 g-4 align-items-stretch justify-content-center">
            <div class="col d-flex">
              <div class="card flex-fill shadow-sm border-0 text-center py-4 h-100" style="background: #f0fff0;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                  <i class="bi bi-geo-alt-fill fs-1 text-success mb-3"></i>
                  <h5 class="card-title fw-bold mb-2">Alamat</h5>
                  <p class="card-text mb-0">Jl. Raya Ciwidey KM.25, Pasirjambu, Bandung</p>
                </div>
              </div>
            </div>
            <div class="col d-flex">
              <div class="card flex-fill shadow-sm border-0 text-center py-4 h-100" style="background: #f0fff0;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                  <i class="bi bi-envelope-fill fs-1 text-success mb-3"></i>
                  <h5 class="card-title fw-bold mb-2">Email</h5>
                  <p class="card-text mb-0">dukungan@ducare.sch.id</p>
                </div>
              </div>
            </div>
            <div class="col d-flex">
              <div class="card flex-fill shadow-sm border-0 text-center py-4 h-100" style="background: #f0fff0;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                  <i class="bi bi-telephone-fill fs-1 text-success mb-3"></i>
                  <h5 class="card-title fw-bold mb-2">Telepon</h5>
                  <p class="card-text mb-0">(+62) 812-3456-7890</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="py-5" style="background: #e6ffe6;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-11">
        <div class="card shadow border-0 rounded-4 overflow-hidden" style="background: #e6ffe6;">
          <div class="card-body p-0">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31674.340284952763!2d107.4369843492558!3d-7.0920497585975575!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ed56408530c9%3A0x5e331a2a59a3b3db!2sPondok%20Pesantren%20Darul%20Ulum%20Cikabuyutan!5e0!3m2!1sid!2sid!4v1748661714025!5m2!1sid!2sid" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="footer-custom mt-5">
  <div class="container py-4">
    <div class="row align-items-center">
      <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
        <img src="{{ asset('images/logo Du2.png') }}" alt="Logo DUCARE" style="max-width: 90px;">
      </div>
      <div class="col-md-4 d-flex justify-content-center mb-3 mb-md-0">
        <ul class="footer-menu d-flex flex-row flex-nowrap align-items-center justify-content-center mb-0 p-0" style="gap: 16px; font-size: 1rem;">
          <li><a href="#" class="text-white">Menu</a></li>
          <li><a href="/about-bullying" class="text-white">About Bullying</a></li>
          <li><a href="/buat-laporan" class="text-white">Lapor</a></li>
          <li><a href="#team" class="text-white">Team</a></li>
          <li><a href="#kontak" class="text-white">Kontak</a></li>
        </ul>
      </div>
      <div class="col-md-4 text-center text-md-end">
        <a href="#" class="me-2 text-white"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="me-2 text-white"><i class="fab fa-tiktok"></i></a>
        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    <hr class="my-3" style="border-color: #fff; opacity: 0.2;">
    <div class="text-center text-white-50 small">
      © 2025 DUCARE. All rights reserved.
    </div>
  </div>
</footer>
<style>
.footer-custom {
  background: #024f70;
  color: #fff;
}
.footer-menu {
  list-style: none;
  margin: 0;
  padding: 0;
}
.footer-menu a {
  color: #fff;
  font-weight: 500;
  text-decoration: none;
  transition: color 0.2s;
  white-space: nowrap;
}
.footer-menu a:hover, .footer-custom a:hover {
  color: #64CA3F;
}
.footer-custom .fab {
  font-size: 22px;
  transition: color 0.2s;
}
.footer-custom .fab:hover {
  color: #64CA3F;
}
@media (max-width: 768px) {
  .footer-custom .row > div {
    margin-bottom: 16px;
  }
  .footer-menu {
    flex-direction: column !important;
    gap: 8px !important;
    align-items: center !important;
  }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>