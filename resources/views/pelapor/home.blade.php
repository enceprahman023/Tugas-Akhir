<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darul Ulum Care</title>
    {{--  link Boostrap  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">

    {{-- link untuk icon boostrap   --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    {{--  link Awesom  --}}
    <!-- Link Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{--  link css  --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logodu.png') }}" alt="Logo" width="40" height="40" class="me-5">
                <div class="brand-text">
                    <div class="brand-title">DUCARE</div>
                    <div class="brand-subtitle">Darul Ulum Care</div>
                </div>
              </a>

              {{--  Button Menu Tengah  --}}
             <div class="d-flex justify-content-center gap-2 middle-menu">
                <a class="btn btn-secondary" href="#">Home</a>
                    <a class="btn btn-secondary" href="/about-bullying">About Bullying</a>
                    <a class="btn btn-secondary" href="{{ url('/#team') }}">Team</a>
                    <a class="btn btn-secondary" href="{{ url('/#kontak') }}">Kontak</a>
                    </div>

              {{--  Button Menuh Kiri  --}}
              <div class="nav-menu">
                <a href="{{ route('register') }}" class="btn btn-outline-warning">Register</a>
                <a href="{{ route('login') }}" class="btn btn-outline-light ms-3">Login</a>
                </div>
          </div>
        </div>
      </nav>
       
      <section class="home-hero text-white">
        <div class="overlay">
          <div class="container h-100 d-flex align-items-center">
            <div class="row w-100">
                        {{--  Bagian Teks Penjelasan Ducare  --}}
                <div class="col-md-6 d-flex flex-column justify-content-center">
                <h2 class="fw-bold">Together Againts</h2>
                <h2 class="fw-bold">Bullying Act Now ! </h2>
                <br>
                <p>
                    DUCARE adalah website pelaporan bullying 
                    untuk siswa Darul Ulum Nurdiniyyah Pasir Jambu. 
                    Bersama DUCARE, kita ciptakan 
                    sekolah yang aman dan bebas bullying.
                </p>
              </div>
      
                    {{--  Bagian Penjelasan Gambar Logo Bullying  --}}
                    <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-center pe-md-20">
                        <img src="{{ asset('images/bullying home.png') }}" alt="logo-bullying" class="mb-3 logo-bullying">
                        <div class="text-center mt-3 slogan-text">
                            <h3 class="fw-bold">KAMU TIDAK SENDIRI</h3>
                            <h3 class="fw-bold">KAMI PEDULI !</h3>
                        </div>
                    </div>
            </div>
          </div>
        </div>
      </section>
      
      <section class="home-vision">
        <div class="container">
          <div class="row">
            <!-- Bagian Gambar -->
            <div class="col-md-6 d-flex justify-content-center align-items-center">
              <img src="{{ asset('images/gambar halaman visi.jpg') }}" alt="people-peace" class="img-fluid">
            </div>
      
            <!-- Bagian Penjelasan -->
            <div class="col-md-6 d-flex justify-content-center align-items-center">
              <div class="text-box">
                <h2 class="fw-bold">Visi Program Kami</h2>
                <p>
                  Melalui program aplikasi DUCARE yang kami buat, kami ingin memberikan wadah yang aman dan mudah digunakan bagi siswa untuk melaporkan kasus bullying. Program ini dirancang untuk membantu sekolah merespon dengan cepat, serta menciptakan lingkungan yang lebih peduli dan bebas dari perundungan.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      
      <section class="about-section">
        <div class="container">
          <div class="row align-items-center">
            <!-- Teks Penjelasan -->
            <div class="col-md-6">
              <div class="about-text">
                <h2 class="section-title">About Bullying</h2>
                <p>
                    Bullying adalah tindakan menyakiti orang lain secara sengaja, baik secara fisik, verbal, maupun emosional. 
                    Biasanya dilakukan berulang-ulang dan membuat korban merasa takut, tertekan, atau tidak nyaman.
                    Bullying bisa terjadi di mana saja, termasuk di sekolah, dan dapat berdampak serius pada mental maupun kehidupan sosial seseorang.
                </p>
                <a href="/detail-bullying" class="btn btn-light mt-3">About Bullying</a>
              </div>
            </div>
      
            <!-- Gambar Poster -->
            <div class="col-md-6 text-center">
              <img src="{{ asset('images/about bullying.jpg') }}" alt="Poster Bullying" class="img-fluid poster-img">
            </div>
          </div>
        </div>
      </section>
      <!-- Section Team -->
      <section id="team" class="team-section">
        <div class="container text-center">
      
          <!-- Judul "TEAM" dengan background rectangle -->
          <div class="team-title-wrapper">
            <h4 class="team-title">TEAM</h4>
          </div>
      
          <!-- Subjudul -->
          <h3 class="team-subtitle mt-3 mb-5">Team Develop Kami</h3>
      
          <!-- Card Tim -->
          <div class="team-cards">
            <div class="team-card p-4">
              <img src="{{ asset('images/team 1.jpg') }}" alt="Team 1" class="team-photo">
              <h5 class="fw-bold mt-3">Sholihin Mahmud</h5>
              <p>Frontend Developer</p>
            </div>
      
            <div class="team-card p-4">
              <img src="{{ asset('images/team 2.jpg') }}" alt="Team 2" class="team-photo">
              <h5 class="fw-bold mt-3">Mansyur Sudhama</h5>
              <p>Backend Developer</p>
            </div>
      
            <div class="team-card p-4">
              <img src="{{ asset('images/team 3.jpg') }}" alt="Team 3" class="team-photo">
              <h5 class="fw-bold mt-3">Nuril Sanusi</h5>
              <p>UI/UX Designer</p>
            </div>
          </div>
        </div>
      </section>
      
      <!-- SECTION: Kontak -->
      <section id="kontak" class="contact-section py-5">
        <div class="container">
          
          <!-- Judul Kontak dengan Background -->
          <div class="text-center mb-4">
            <div class="bg-success text-white py-2 px-4 d-inline-block rounded-3">
              <h2 class="mb-0">KONTAK</h2>
            </div>
            <h4 class="mt-3">Kontak Kami</h4>
          </div>
      
          <!-- 3 Card Kontak: Alamat, Email, Hubungi Kami -->
          <div class="row justify-content-center">
      
            <!-- Card Alamat -->
            <div class="col-md-4 mb-4">
              <div class="card h-100 shadow-sm text-center">
                <div class="card-body">
                  <!-- Icon Alamat -->
                  <i class="bi bi-geo-alt-fill fs-1 text-success mb-3"></i>
                  <h5 class="card-title fw-bold">Alamat</h5>
                  <p class="card-text">Jl. Raya Ciwidey KM.25, Pasirjambu, Bandung</p>
                </div>
              </div>
            </div>
      
            <!-- Card Email -->
            <div class="col-md-4 mb-4">
              <div class="card h-100 shadow-sm text-center">
                <div class="card-body">
                  <!-- Icon Email -->
                  <i class="bi bi-envelope-fill fs-1 text-success mb-3"></i>
                  <h5 class="card-title fw-bold">Email</h5>
                  <p class="card-text">dukungan@ducare.sch.id</p>
                </div>
              </div>
            </div>
      
            <!-- Card Hubungi Kami -->
            <div class="col-md-4 mb-4">
              <div class="card h-100 shadow-sm text-center">
                <div class="card-body">
                  <!-- Icon Telepon -->
                  <i class="bi bi-telephone-fill fs-1 text-success mb-3"></i>
                  <h5 class="card-title fw-bold">Hubungi Kami</h5>
                  <p class="card-text">(+62) 812-3456-7890</p>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </section>

      <!-- Google Maps Embed -->
      <div class="map-wrapper mt-5">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.3740012835606!2d107.47859798885497!3d-7.0825678999999955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ed592d7b2075%3A0xb9c07590bbee0f35!2sMA%20Darul%20&#39;Ulum%20Boarding%20School%2C%2C!5e0!3m2!1sid!2sid!4v1745108228708!5m2!1sid!2sid"
          width="100%"
          height="400"
          style="border:0; border-radius: 10px;"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
  </div>
</section>
<footer>
  <div class="footer-container">
    <div class="footer-logo">
      <img src="images/logo Du2.png" alt="Logo DUCARE">
    </div>
    <div class="footer-content">
      <ul class="footer-menu">
        <li><a href="#">Menu</a></li>
        <li><a href="#">About Bullying</a></li>
        <li><a href="#">Lapor</a></li>
        <li><a href="#">Team</a></li>
        <li><a href="#">Kontak</a></li>
      </ul>
      <div class="footer-social">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-tiktok"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </div>
  <p class="footer-copyright">© 2025 DUCARE. All rights reserved.</p>
</footer>

</body>
</html>