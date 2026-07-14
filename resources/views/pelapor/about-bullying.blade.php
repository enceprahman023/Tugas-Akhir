@extends('layouts.main')

@section('content')
<style>
  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: #334155;
    background-color: #f1f5f9;
  }
  
  /* Hilangkan gradient body bawaan CSS lama */
  body { background: #f8fafc !important; }

  /* Section Backgrounds avoiding plain white */
  .bg-about-1 { background-color: #f8fafc; } /* Slate Sangat Muda */
  .bg-about-2 { background-color: #f0fdf4; } /* Hijau Sangat Muda */
  .bg-about-3 { background-color: #ffffff; } /* Putih Bersih */
  .bg-about-4 { background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); color: white; } /* Navy Gelap */

  .section-padding {
    padding: 80px 0;
  }

  /* Titles */
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
  
  .section-title-light {
    color: #ffffff;
  }

  /* Section 1: Intro */
  .intro-text {
    font-size: 1.15rem;
    line-height: 1.8;
    color: #475569;
  }
  .poster-image {
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    max-width: 450px; /* Ukuran disesuaikan agar tidak kebesaran */
    width: 100%;
    border: 5px solid #ffffff;
  }

  /* Section 2: Macam-Macam Bullying */
  .bullying-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    height: 100%;
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.02);
  }
  .bullying-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    border-color: #64CA3F;
  }
  .bullying-card img {
    border-radius: 12px;
    width: 100%;
    height: 180px;
    object-fit: cover;
    margin-bottom: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
  }
  .bullying-card h4 {
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 12px;
    font-size: 1.25rem;
  }
  .bullying-card p {
    color: #64748b;
    font-size: 0.95rem;
    line-height: 1.7;
    margin-bottom: 0;
  }

  /* Section 3: Dampak Bullying */
  .impact-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 35px 25px;
    height: 100%;
    box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    transition: all 0.3s ease;
    border-top: 6px solid #ef4444;
  }
  .impact-card-1 { border-top-color: #64CA3F; } /* Hijau */
  .impact-card-2 { border-top-color: #3b82f6; } /* Biru */
  .impact-card-3 { border-top-color: #8b5cf6; } /* Ungu */
  .impact-card-4 { border-top-color: #f59e0b; } /* Kuning/Oranye */
  
  .impact-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
  }
  .impact-title {
    font-weight: 800;
    font-size: 1.25rem;
    color: #1e293b;
    margin-bottom: 25px;
    text-align: center;
  }
  .impact-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  .impact-list li {
    position: relative;
    padding-left: 30px;
    margin-bottom: 15px;
    color: #475569;
    font-size: 0.95rem;
    line-height: 1.5;
  }
  .impact-list li::before {
    content: '\F333'; /* bi-exclamation-circle-fill */
    font-family: 'bootstrap-icons';
    position: absolute;
    left: 0; top: 0;
    color: #ef4444; 
    font-size: 1.1rem;
  }

  /* Section 4: Bahaya Bullying */
  .rectangle-item {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    overflow: hidden;
    width: 100%;
    max-width: 350px;
    transition: all 0.3s;
  }
  .rectangle-item:hover {
    transform: translateY(-10px);
    background: rgba(255, 255, 255, 0.1);
    box-shadow: 0 15px 35px rgba(0,0,0,0.3);
  }
  .rectangle-item img {
    width: 100%;
    height: 200px;
    object-fit: cover;
  }
  .rectangle-item p {
    padding: 25px 20px;
    margin: 0;
    color: #e2e8f0;
    font-weight: 500;
    font-size: 1.05rem;
    line-height: 1.6;
  }
</style>

<div class="w-100">
  {{-- Section 1: About Bullying --}}
  <section class="bg-about-1 section-padding">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-6 text-center">
          <img src="{{ asset('images/poster about.jpg') }}" alt="Poster Bullying" class="poster-image">
        </div>
        <div class="col-lg-6">
          <h2 class="section-title">Kenali Apa Itu Bullying</h2>
          <div class="intro-text">
            <p class="mb-4">
              <strong>Bullying (Perundungan)</strong> adalah tindakan menyakiti atau merendahkan orang lain secara sengaja, baik secara fisik, verbal, maupun emosional.
            </p>
            <p class="mb-0">
              Biasanya dilakukan secara berulang-ulang dan dapat berdampak sangat serius pada kesehatan mental, rasa percaya diri, dan kenyamanan seseorang.
              Bullying bisa terjadi di mana saja: di lingkungan sekolah, rumah, lingkungan bermain, atau bahkan di dunia maya (internet).
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Section 2: Macam-Macam Bullying --}}
  <section class="bg-about-2 section-padding">
    <div class="container">
      <div class="text-center">
        <h2 class="section-title">Macam-Macam Bullying</h2>
      </div>
      <div class="row g-4 justify-content-center mt-3">
        {{-- Verbal --}}
        <div class="col-md-6 col-lg-3">
          <div class="bullying-card">
            <img src="{{ asset('images/bullying verbal.jpg') }}" alt="Verbal Bullying">
            <h4>Verbal Bullying</h4>
            <p>Perundungan lewat kata-kata. Termasuk mengejek, menghina, memanggil dengan julukan menyakitkan, atau menyebar fitnah.</p>
          </div>
        </div>
        {{-- Fisik --}}
        <div class="col-md-6 col-lg-3">
          <div class="bullying-card">
            <img src="{{ asset('images/bullying visik.jpg') }}" alt="Fisik Bullying">
            <h4>Fisik Bullying</h4>
            <p>Perundungan yang menyakiti fisik korban. Contohnya memukul, menendang, mendorong, menjegal, atau merusak barang.</p>
          </div>
        </div>
        {{-- Sosial --}}
        <div class="col-md-6 col-lg-3">
          <div class="bullying-card">
            <img src="{{ asset('images/bullying sosial.jpg') }}" alt="Sosial Bullying">
            <h4>Sosial Bullying</h4>
            <p>Bullying yang merusak hubungan sosial. Dilakukan dengan cara mengucilkan, menjauhi, atau menghasut orang lain untuk memusuhi korban.</p>
          </div>
        </div>
        {{-- Cyber --}}
        <div class="col-md-6 col-lg-3">
          <div class="bullying-card">
            <img src="{{ asset('images/bullying cyber.jpg') }}" alt="Cyber Bullying">
            <h4>Cyber Bullying</h4>
            <p>Perundungan digital. Misalnya mengirim pesan ancaman, menyebarkan foto memalukan, atau mengolok-olok lewat media sosial.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Section 3: Dampak Bullying --}}
  <section class="bg-about-3 section-padding">
    <div class="container text-center">
      <h2 class="section-title">Dampak & Bahaya</h2>
      <p class="mb-5 text-secondary" style="font-size: 1.15rem; max-width: 700px; margin: 0 auto;">
        Dampak bullying sangat besar dan destruktif bagi kesehatan korban. Luka yang tidak terlihat dari luar sering kali jauh lebih menyakitkan.
      </p>
      
      <div class="row g-4 justify-content-center text-start">
        <div class="col-md-6 col-lg-3">
          <div class="impact-card impact-card-1">
            <h3 class="impact-title">Dampak Sosial</h3>
            <ul class="impact-list">
              <li>Sering merasa diintimidasi</li>
              <li>Rasa tidak nyaman saat berinteraksi</li>
              <li>Menarik diri dari pergaulan</li>
              <li>Sulit mempercayai orang lain</li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="impact-card impact-card-2">
            <h3 class="impact-title">Dampak Emosional</h3>
            <ul class="impact-list">
              <li>Malu dan bersalah berlebihan</li>
              <li>Terus merasa tertekan / cemas</li>
              <li>Sulit mengontrol emosi</li>
              <li>Sedih yang berkepanjangan</li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="impact-card impact-card-3">
            <h3 class="impact-title">Dampak Psikologis</h3>
            <ul class="impact-list">
              <li>Merasa diri tidak berharga</li>
              <li>Depresi tingkat tinggi</li>
              <li>Turun drastisnya percaya diri</li>
              <li>Pikiran menyakiti diri sendiri</li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="impact-card impact-card-4">
            <h3 class="impact-title">Dampak Fisik</h3>
            <ul class="impact-list">
              <li>Gangguan jam tidur & insomnia</li>
              <li>Menurunnya daya tahan fisik</li>
              <li>Sering sakit kepala / maag stres</li>
              <li>Luka akibat kontak fisik</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Section 4: Bahaya Bullying (Long Term) --}}
  <section class="bg-about-4 section-padding">
    <div class="container text-center">
      <h2 class="section-title section-title-light">Risiko Jangka Panjang</h2>
      <p class="mb-5 text-white-50" style="font-size: 1.15rem; max-width: 700px; margin: 0 auto;">
        Bullying tidak hanya menyakiti sesaat, tetapi meninggalkan bekas luka permanen yang mengancam kesejahteraan dan masa depan korban.
      </p>
      
      <div class="d-flex flex-wrap justify-content-center gap-4">
        <div class="rectangle-item text-center">
          <img src="{{ asset('images/bahaya 1.jpg') }}" alt="Bahaya 1">
          <p>Korban menjadi rentan mengalami kecemasan sosial dan phobia kronis untuk berada di keramaian.</p>
        </div>
        <div class="rectangle-item text-center">
          <img src="{{ asset('images/bahaya 2.jpg') }}" alt="Bahaya 2">
          <p>Fokus terganggu secara drastis, berujung pada penurunan drastis prestasi dan minat belajar di sekolah.</p>
        </div>
        <div class="rectangle-item text-center">
          <img src="{{ asset('images/bahaya 3.jpg') }}" alt="Bahaya 3">
          <p>Meningkatkan risiko trauma mendalam, depresi klinis, hingga percobaan melukai diri sendiri yang fatal.</p>
        </div>
      </div>
    </div>
  </section>

</div>
@endsection
