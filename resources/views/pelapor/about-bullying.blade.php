@extends('layouts.main')

@section('content')
<section class="about-bullying-section py-5">
  <div class="container text-center">
    <!-- Judul -->
    <h2 class="fw-bold mb-4">About Bullying</h2>

    <!-- Gambar Poster -->
    <img src="{{ asset('images/poster about.jpg') }}" alt="Poster Bullying" class="img-fluid mb-4 poster-image">

    <!-- Penjelasan -->
    <h3 class="fw-semibold mb-3">Apa Itu Bullying?</h3>
    <p class="px-md-5 md-2">
      Bullying adalah tindakan menyakiti atau merendahkan orang lain secara sengaja, baik secara fisik, verbal, maupun emosional.
      Biasanya dilakukan secara berulang dan dapat berdampak serius pada kesehatan mental, rasa percaya diri, dan kenyamanan seseorang.
      Bullying dapat terjadi di lingkungan sekolah, rumah, atau bahkan dunia maya.
    </p>
  </div>
</section>

<!-- Macam-Macam Bullying -->
<section class="types-of-bullying-section py-5">
  <div class="container">
    <h3 class="fw-semibold text-center mb-5">Macam-Macam Bullying</h3>
    <div class="row g-4">
      <!-- Card 1 -->
      <div class="col-md-6 col-lg-3">
        <div class="bullying-card shadow-sm">
          <h4 class="card-title">Verbal Bullying</h4>
          <img src="{{ asset('images/bullying verbal.jpg') }}" alt="Verbal Bullying" class="img-fluid mb-3 rounded">
          <p>Verbal bullying adalah perundungan dengan kata-kata. Misalnya mengejek, menghina, memanggil dengan julukan yang menyakitkan, atau menyebarkan gosip. Kata-kata yang kasar bisa melukai perasaan, jadi kita harus selalu bicara dengan sopan dan ramah.
            </p>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="col-md-6 col-lg-3">
        <div class="bullying-card shadow-sm">
          <h4 class="card-title">Fisik Bullying</h4>
          <img src="{{ asset('images/bullying visik.jpg') }}" alt="Fisik Bullying" class="img-fluid mb-3 rounded">
          <p>Fisik bullying adalah perundungan yang menyakiti tubuh orang lain. Contohnya seperti memukul, menendang, mendorong, atau merusak barang milik teman. Ini sangat berbahaya karena bisa menyebabkan luka dan membuat teman merasa tidak aman.
          </p>
        </div>
      </div>
      <!-- Card 3 -->
      <div class="col-md-6 col-lg-3">
        <div class="bullying-card shadow-sm">
          <h4 class="card-title">Sosial Bullying</h4>
          <img src="{{ asset('images/bullying sosial.jpg') }}" alt="Sosial Bullying" class="img-fluid mb-3 rounded">
          <p>Bullying jenis ini dilakukan dengan cara menjauhkan seseorang dari teman-temannya. Misalnya mengucilkan, tidak mengajak bermain, atau membicarakan teman di belakang. Ini bisa membuat seseorang merasa kesepian dan sedih.</p>
        </div>
      </div>
      <!-- Card 4 -->
      <div class="col-md-6 col-lg-3">
        <div class="bullying-card shadow-sm">
          <h4 class="card-title">Cyber Bullying</h4>
          <img src="{{ asset('images/bullying cyber.jpg') }}" alt="Cyber Bullying" class="img-fluid mb-3 rounded">
          <p>Cyberbullying adalah perundungan yang terjadi lewat internet atau media sosial. Contohnya mengirim pesan jahat, menyebarkan foto atau video tanpa izin, atau menghina lewat komentar online. Meski tidak bertemu langsung, ini bisa sangat menyakitkan dan berbahaya.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="bullying-impact-section py-5">
  {{--  dampak bullying  --}}
  <div class="container text-center">
    <!-- Judul -->
    <h2 class="fw-bold mb-4">Dampak Bullying</h2>
    <p class="px-md-5 mb-4">
      Dampak bullying sangat besar bagi kesehatan mental dan emosional. Berikut adalah beberapa dampak yang bisa terjadi pada korban bullying.
    </p>

    <div class="row">
      <!-- Dampak Sosial -->
      <div class="col-md-3 mb-4">
        <div class="impact-card p-4 d-flex flex-column justify-content-start">
          <h3 class="impact-title">Dampak Sosial</h3>
          <ul class="impact-list">
            <li>Sering diganggu orang di sekitar</li>
            <li>Rasa tidak nyaman saat berinteraksi</li>
            <li>Menjadi lebih tertutup atau menghindari pergaulan</li>
          </ul>
        </div>
      </div>

      <!-- Dampak Emosional -->
      <div class="col-md-3 mb-4">
        <div class="impact-card p-4 d-flex flex-column justify-content-start">
          <h3 class="impact-title">Dampak Emosional</h3>
          <ul class="impact-list">
            <li>Rasa malu yang berlebihan</li>
            <li>Perasaan tertekan atau cemas</li>
            <li>Kesulitan mengontrol emosi</li>
          </ul>
        </div>
      </div>

      <!-- Dampak Psikologis -->
      <div class="col-md-3 mb-4">
        <div class="impact-card p-4 d-flex flex-column justify-content-start">
          <h3 class="impact-title">Dampak Psikologis</h3>
          <ul class="impact-list">
            <li>Merasa tidak berharga</li>
            <li>Depresi atau gangguan kecemasan</li>
            <li>Penurunan rasa percaya diri</li>
          </ul>
        </div>
      </div>

      <!-- Dampak Fisik -->
      <div class="col-md-3 mb-4">
        <div class="impact-card p-4 d-flex flex-column justify-content-start">
          <h3 class="impact-title">Dampak Fisik</h3>
          <ul class="impact-list">
            <li>Gangguan tidur (insomnia)</li>
            <li>Penurunan kondisi kesehatan fisik</li>
            <li>Sakit kepala atau gangguan fisik lainnya</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="bahaya-bullying-section py-5">
  <div class="container text-center">
    <h3 class="fw-semibold mb-4">Bahaya Bullying</h3>
    <p class="mb-5 px-md-5">
      Bullying tidak hanya menyakiti secara fisik, tetapi juga dapat berdampak serius pada kesehatan mental dan masa depan korban. Berikut beberapa bahaya yang dapat ditimbulkan:
    </p>

    <div class="rectangle-wrapper d-flex flex-wrap justify-content-center gap-4">
      <div class="rectangle-item text-center">
        <img src="{{ asset('images/bahaya 1.jpg') }}" alt="Bahaya 1" class="img-fluid rounded-top">
        <p class="mt-3">Korban menjadi mudah cemas dan takut saat berada di lingkungan sosial.</p>
      </div>
      <div class="rectangle-item text-center">
        <img src="{{ asset('images/bahaya 2.jpg') }}" alt="Bahaya 2" class="img-fluid rounded-top">
        <p class="mt-3">Dapat mengganggu proses belajar dan menurunkan prestasi akademik.</p>
      </div>
      <div class="rectangle-item text-center">
        <img src="{{ asset('images/bahaya 3.jpg') }}" alt="Bahaya 3" class="img-fluid rounded-top">
        <p class="mt-3">Meningkatkan risiko depresi dan bahkan pikiran untuk menyakiti diri.</p>
      </div>
    </div>
  </div>
</section>

@endsection
