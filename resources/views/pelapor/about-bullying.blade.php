@extends('layouts.main')

@section('content')
<div class="scroll-container">

  {{-- Section 1: About Bullying --}}
  <section class="about-bullying-section screen-section text-center">
    <div class="container">
      <h2 class="fw-bold mb-4">About Bullying</h2>
     <img src="{{ asset('images/poster about.jpg') }}" class="img-fluid mb-4 poster-image mx-auto d-block">
      <h3 class="fw-semibold mb-3">Apa Itu Bullying?</h3>
      <p class="px-md-5 md-2">
        Bullying adalah tindakan menyakiti atau merendahkan orang lain secara sengaja, baik secara fisik, verbal, maupun emosional.
        Biasanya dilakukan secara berulang dan dapat berdampak serius pada kesehatan mental, rasa percaya diri, dan kenyamanan seseorang.
        Bullying dapat terjadi di lingkungan sekolah, rumah, atau bahkan dunia maya.
      </p>
    </div>
  </section>

  {{-- Section 2: Macam-Macam Bullying --}}
  <section class="types-of-bullying-section screen-section">
    <div class="container">
      <h3 class="fw-semibold text-center mb-5">Macam-Macam Bullying</h3>
      <div class="row g-4">
        {{-- Verbal --}}
        <div class="col-md-6 col-lg-3">
          <div class="bullying-card shadow-sm">
            <h4 class="card-title">Verbal Bullying</h4>
            <img src="{{ asset('images/bullying verbal.jpg') }}" alt="Verbal Bullying" class="img-fluid mb-3 rounded">
            <p>Verbal bullying adalah perundungan dengan kata-kata. Misalnya mengejek, menghina, memanggil dengan julukan yang menyakitkan, atau menyebarkan gosip.</p>
          </div>
        </div>
        {{-- Fisik --}}
        <div class="col-md-6 col-lg-3">
          <div class="bullying-card shadow-sm">
            <h4 class="card-title">Fisik Bullying</h4>
            <img src="{{ asset('images/bullying visik.jpg') }}" alt="Fisik Bullying" class="img-fluid mb-3 rounded">
            <p>Fisik bullying adalah perundungan yang menyakiti tubuh orang lain. Contohnya memukul, menendang, mendorong, atau merusak barang milik teman.</p>
          </div>
        </div>
        {{-- Sosial --}}
        <div class="col-md-6 col-lg-3">
          <div class="bullying-card shadow-sm">
            <h4 class="card-title">Sosial Bullying</h4>
            <img src="{{ asset('images/bullying sosial.jpg') }}" alt="Sosial Bullying" class="img-fluid mb-3 rounded">
            <p>Bullying jenis ini dilakukan dengan cara menjauhkan seseorang dari teman-temannya. Misalnya mengucilkan atau membicarakan teman di belakang.</p>
          </div>
        </div>
        {{-- Cyber --}}
        <div class="col-md-6 col-lg-3">
          <div class="bullying-card shadow-sm">
            <h4 class="card-title">Cyber Bullying</h4>
            <img src="{{ asset('images/bullying cyber.jpg') }}" alt="Cyber Bullying" class="img-fluid mb-3 rounded">
            <p>Cyberbullying terjadi lewat internet. Misalnya mengirim pesan jahat atau menyebarkan foto tanpa izin.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Section 3: Dampak Bullying --}}
  <section class="bullying-impact-section screen-section">
    <div class="container text-center">
      <h2 class="fw-bold mb-4">Dampak Bullying</h2>
      <p class="px-md-5 mb-4">
        Dampak bullying sangat besar bagi kesehatan mental dan emosional. Berikut beberapa dampak yang bisa terjadi:
      </p>
      <div class="row">
        <div class="col-md-3 mb-4">
          <div class="impact-card p-4">
            <h3 class="impact-title">Dampak Sosial</h3>
            <ul class="impact-list">
              <li>Sering diganggu orang sekitar</li>
              <li>Rasa tidak nyaman saat berinteraksi</li>
              <li>Menjadi lebih tertutup</li>
            </ul>
          </div>
        </div>
        <div class="col-md-3 mb-4">
          <div class="impact-card p-4">
            <h3 class="impact-title">Dampak Emosional</h3>
            <ul class="impact-list">
              <li>Rasa malu berlebihan</li>
              <li>Tertekan atau cemas</li>
              <li>Sulit mengontrol emosi</li>
            </ul>
          </div>
        </div>
        <div class="col-md-3 mb-4">
          <div class="impact-card p-4">
            <h3 class="impact-title">Dampak Psikologis</h3>
            <ul class="impact-list">
              <li>Merasa tidak berharga</li>
              <li>Depresi atau gangguan kecemasan</li>
              <li>Turunnya rasa percaya diri</li>
            </ul>
          </div>
        </div>
        <div class="col-md-3 mb-4">
          <div class="impact-card p-4">
            <h3 class="impact-title">Dampak Fisik</h3>
            <ul class="impact-list">
              <li>Gangguan tidur</li>
              <li>Menurunnya kondisi fisik</li>
              <li>Sakit kepala atau fisik lain</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Section 4: Bahaya Bullying --}}
  <section class="bahaya-bullying-section screen-section">
    <div class="container text-center">
      <h3 class="fw-semibold mb-4">Bahaya Bullying</h3>
      <p class="mb-5 px-md-5">
        Bullying tidak hanya menyakiti secara fisik, tapi juga berdampak serius pada mental dan masa depan korban.
      </p>
      <div class="rectangle-wrapper d-flex flex-wrap justify-content-center gap-4">
        <div class="rectangle-item text-center">
          <img src="{{ asset('images/bahaya 1.jpg') }}" alt="Bahaya 1" class="img-fluid rounded-top">
          <p class="mt-3">Korban jadi mudah cemas & takut saat bersosialisasi.</p>
        </div>
        <div class="rectangle-item text-center">
          <img src="{{ asset('images/bahaya 2.jpg') }}" alt="Bahaya 2" class="img-fluid rounded-top">
          <p class="mt-3">Mengganggu proses belajar & prestasi akademik.</p>
        </div>
        <div class="rectangle-item text-center">
          <img src="{{ asset('images/bahaya 3.jpg') }}" alt="Bahaya 3" class="img-fluid rounded-top">
          <p class="mt-3">Meningkatkan risiko depresi & menyakiti diri.</p>
        </div>
      </div>
    </div>
  </section>

</div>
@endsection
