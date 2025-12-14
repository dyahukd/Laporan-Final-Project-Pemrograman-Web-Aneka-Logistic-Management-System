<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aneka Logistic | Premium Cargo Service</title>

  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- navbar atas -->
<nav class="navbar navbar-expand-lg fixed-top bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
      <img src="logo.png" height="42" class="me-2" alt="Logo Aneka Logistic">
      Aneka Logistic
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="#services">Layanan</a></li>
        <li class="nav-item"><a class="nav-link" href="#tracking">Cek Resi</a></li>
        <li class="nav-item"><a class="nav-link" href="#locations">Lokasi</a></li>

        <!-- LOGIN SAJA -->
        <li class="nav-item ms-lg-3">
          <a href="login.php" class="btn btn-outline-danger btn-sm px-4">
            Login
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<section class="hero-slider">
  <div class="hero-slide active" style="background-image:url('hero1.jpeg')">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1>Aneka Logistic</h1>
      <p>Ekspedisi premium Jawa • Bali • Kalimantan dengan sistem tracking modern dan armada profesional.</p>
    </div>
  </div>

  <div class="hero-slide" style="background-image:url('hero2.jpeg')">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1>Everyday Delivery</h1>
      <p>Pengiriman rutin dengan jadwal terjamin untuk kebutuhan bisnis dan personal Anda.</p>
    </div>
  </div>

  <div class="hero-slide" style="background-image:url('hero3.jpg')">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1>Port to Door</h1>
      <p>Layanan logistik terintegrasi dari pelabuhan hingga depan pintu pelanggan.</p>
    </div>
  </div>
</section>

<!-- tracking -->
<section id="tracking" class="tracking-section">
  <div class="container text-center" data-aos="fade-up">
    <h2>Lacak Pengiriman Anda</h2>
    <div class="tracking-box">
     <form action="tracking.php" method="GET" class="tracking-box">
  <input type="text" name="resi"
         placeholder="Masukkan nomor resi"
         required>
  <button type="submit">Lacak</button>
</form>

    </div>
  </div>
</section>

<!-- servis -->
<section class="services-detail" id="services">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6 d-flex" data-aos="fade-up">
        <div class="service-icon">🚚</div>
        <div>
          <h5>Ekspedisi Barang Surabaya – Kupang</h5>
          <p>Pengiriman darat dan laut terjadwal dengan tenaga profesional hingga tujuan akhir di wilayah Kupang.</p>
        </div>
      </div>

      <div class="col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
        <div class="service-icon">📦</div>
        <div>
          <h5>Ekspedisi Barang Proyek Tujuan Kalimantan</h5>
          <p>Handling barang berat dan material proyek melalui jalur laut dan darat menuju Kalimantan.</p>
        </div>
      </div>

      <div class="col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
        <div class="service-icon">🚢</div>
        <div>
          <h5>Ekspedisi Laut Terjadwal</h5>
          <p>Layanan pengiriman menggunakan kapal dengan jadwal rutin dan pemantauan berkala.</p>
        </div>
      </div>

      <div class="col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
        <div class="service-icon">🏗️</div>
        <div>
          <h5>Logistik Proyek Skala Besar</h5>
          <p>Solusi logistik terintegrasi untuk kebutuhan proyek konstruksi dan industri.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- map and location -->
<section class="map-full" id="locations">
  <!-- BOX LOKASI -->
  <div class="location-box">
    <div class="location-header">Our Locations</div>

    <div class="location-item active" data-city="Surabaya">
      <div class="location-title">
        Surabaya
        <span>−</span>
      </div>
      <div class="location-content">
        <p>📍 Jl. Greges Jaya II No.Blok B11, Greges, Kec. Asem Rowo, Surabaya, Jawa Timur</p>
      </div>
    </div>

    <div class="location-item" data-city="Balikpapan">
      <div class="location-title">
        Balikpapan
        <span>+</span>
      </div>
      <div class="location-content">
        <p>📍 Jl. Mulawarman, Manggar, Kec. Balikpapan Tim., Kota Balikpapan, Kalimantan Timur</p>
      </div>
    </div>

    <div class="location-item" data-city="Jakarta">
      <div class="location-title">
        Jakarta
        <span>+</span>
      </div>
      <div class="location-content">
        <p>📍 Jl. Raya Harmoni Blok HZ 2 No 23 Kota Harapan Bekasi Kab Bekasi</p>
      </div>
    </div>

    <div class="location-item" data-city="Kupang">
      <div class="location-title">
        Pandaan
        <span>+</span>
      </div>
      <div class="location-content">
        <p>📍 Jl. Kalitengah Baru No.52, Sukorejo, Karang Jati, Kec. Pandaan, Pasuruan, Jawa Timur 67156</p>
      </div>
    </div>
  </div>

  <iframe
    id="mainMap"
    src="https://www.google.com/maps?q=Jl.+Greges+Jaya+II+No.Blok+B11,+Surabaya&output=embed"
    allowfullscreen
    loading="lazy">
  </iframe>
</section>

<!-- STATS -->
<section class="stats-section" id="stats">
  <div class="container">
    <div class="row align-items-center">

      <div class="col-md-6">
        <h2>Doing Express over 10 years of experience Logistics.</h2>
        <div class="stats-line"></div>
      </div>

      <div class="col-md-6">
        <div class="row text-center">

          <div class="col-md-4">
            <div class="stat-item">
              🏢
              <h3 class="counter" data-target="20">0</h3>
              <p>Kantor Cabang</p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="stat-item">
              👥
              <h3 class="counter" data-target="1987">0</h3>
              <p>Pelanggan</p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="stat-item">
              📦
              <h3 class="counter" data-target="983194">0</h3>
              <p>Barang Terkirim</p>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="footer">
  <div class="container">
    <div class="row g-4">

      <div class="col-md-4">
        <h5 class="footer-title">About</h5>
        <p class="footer-text">
          Aneka Logistic hadir untuk memenuhi kebutuhan jasa pengiriman barang yang
          murah, cepat, dan aman. Lebih dari 10 tahun kami dipercaya oleh perusahaan
          nasional hingga instansi pemerintah.
        </p>
      </div>

      <div class="col-md-4">
        <h5 class="footer-title">Services</h5>
        <ul class="footer-list">
          <li>Logistic &amp; Cargo</li>
          <li>Project Cargo</li>
          <li>Port to Door</li>
          <li>Ekspedisi Laut &amp; Darat</li>
        </ul>
      </div>

      <div class="col-md-4">
        <h5 class="footer-title">Quick Contact</h5>

        <p class="footer-contact">
          <span>📞</span> +62 813 333 28789<br>
          <span>📞</span> +62 811 546 56788
        </p>

        <p class="footer-address">
          Jl. Greges Jaya II blok B11<br>
          Surabaya, Jawa Timur 60183
        </p>
      </div>

    </div>

    <div class="footer-bottom">
      © 2025 Aneka Logistic. All Rights Reserved.
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script src="main.js"></script>

</body>
</html>
