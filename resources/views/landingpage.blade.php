<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- font-awesome -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />

  <!-- logo shortcut -->
  <link rel="shortcut icon" href="logodanaamal.png" />

  <!-- johnsuh hamburger -->
  <link
    href="hamburgers-master/hamburgers-master/dist/hamburgers.css"
    rel="stylesheet" />

  <!-- AOS -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

  <!-- animate style -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <!-- css -->
  <link rel="stylesheet" href="{{ asset('assets/css/landingpage.css') }}" />
  <title>Dana Amal</title>
</head>

<body id="beranda">
  <header>
    <!-- navbar -->
    <div class="navbar">
      <div class="container">
        <div class="box-navbar">
          <div class="logo">
            <img src="{{ asset('assets/images/logodanaamal.png') }}" />
          </div>
          <ul class="menu">
            <li>
              <a href="#beranda"><i class="fa-solid fa-house"></i> Beranda</a>
            </li>
            <li>
              <a href="#donasi"><i class="fa-solid fa-hand-holding-heart"></i> Donasi</a>
            </li>
            <li>
              <a href="#tentang-kami"><i class="fa-solid fa-circle-info"></i> Tentang Kami</a>
            </li>
            <li>
              <a href="#kontak"><i class="fa-solid fa-phone"></i> Kontak</a>
            </li>
          </ul>
          <div class="logreg">
            <button class="registrasi-button">Registrasi</button>
            <button class="login-button">Login</button>
          </div>
          <button class="hamburger hamburger--spin" type="button">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button>
        </div>
      </div>
    </div>

    <!-- hero -->
    <div class="hero">
      <div class="container">
        <div class="box-hero">
          <div class="box">
            <h1
              class="animate__animated animate__fadeInUp animate__delay-0.4s">
              Berbagi Kebaikan, <br />Menginspirasi Perubahan
            </h1>
            <p class="animate__animated animate__fadeInUp animate__delay-1s">
              "Mulailah langkah kecil dengan donasi Anda untuk membantu masa
              depan yang lebih baik bagi banyak orang."
            </p>
          </div>
          <div class="box">
            <img
              class="animate__animated animate__zoomIn animate__delay-1s"
              src="{{ asset('assets/images/contoh1.jpg') }}" />
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Donasi -->
  <section class="donasi" id="donasi">
    <div class="container">
      <div class="box-donasi">
        <div class="box">
          <h1 data-aos="fade-up">Donasi</h1>
          <p data-aos="fade-up" data-aos-delay="200">
            Dalam Lingkungan kampus.
          </p>
        </div>
        <div
          class="box"
          data-aos="fade-up"
          data-aos-delay="400"
          data-aos-duration="1000">
          <div>
            <img src="{{ asset('assets/images/gambar1.png') }}" />
          </div>
          <div>
            <h2>Apa itu Donasi?</h2>
            <p>
              Donasi adalah pemberian secara sukarela oleh individu atau
              kelompok kepada mereka yang membutuhkan. Dalam lingkungan
              kampus, donasi sering dilakukan sebagai bentuk solidaritas dan
              dukungan terhadap mahasiswa lain atau kegiatan sosial.
            </p>
            <p>Donasi ini ditujukan untuk :</p>
            <ul>
              <li>Bantuan keuangan bagi mahasiwa yang membutuhkan</li>
              <li>Mendukung kegiatan amal atau sosial di kampus</li>
            </ul>
            <p>
              Kami memastikan setiap donasi yang diterima dikelola secara
              transparan dan tepat sasaran.
            </p>
            <p>
              Dengan berdonasi, mahasiswa dapat berkontribusi secara nyata
              dalam menciptakan lingkungan kampus yang peduli dan inklusif.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Tentang kami -->
  <section class="tentangkami" id="tentang-kami">
    <div class="container">
      <h2 data-aos="fade-up">Tentang Kami</h2>
      <p data-aos="fade-up" data-aos-delay="200">
        Dana Amal adalah platform yang menyediakan kemudahan bagi para donatur
        untuk menyalurkan bantuan secara transparan dan tepat sasaran. Di
        sini, informasi terkait program bantuan, laporan distribusi dana,
        serta pendampingan kepada penerima manfaat dapat diakses dengan mudah.
        Melalui platform ini, donatur dapat dengan cepat menemukan program
        yang sesuai dengan niat baik mereka, cukup dengan mengakses Dana Amal
        dan pilih program yang ingin didukung.
      </p>
    </div>
    <div
      class="image"
      data-aos="fade-down"
      data-aos-delay="400"
      data-aos-duration="1000">
      <img src="{{ asset('assets/images/gambar2.png') }}" />
    </div>
  </section>

  <!-- Kontak -->
  <section class="kontak" id="kontak">
    <div class="container">
      <h2>Hubungi Kami</h2>
      <p>
        Jika Anda memiliki atau membutuhkan bantuan lebih lanjut, silakan
        hubungi kami memalui informasi di bawah ini. Kami akan dengan senang
        hati membantu Anda.
      </p>
    </div>
    <div class="contact-info">
      <div class="info-box">
        <h3>Email</h3>
        <p>support@danaamal.com</p>
      </div>
      <div class="info-box">
        <h3>Nomor Telepon</h3>
        <p>0812-3456-7890</p>
      </div>
    </div>
    <form class="contact-form">
      <h3>Formulir Kontak</h3>
      <label for="name">Nama:</label>
      <input type="text" id="name" name="name" required />

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required />

      <label for="message">Pesan:</label>
      <textarea id="message" name="message" rows="4" required></textarea>

      <button type="submit">Kirim Pesan</button>
    </form>
  </section>

  <!-- Footer -->
  <div class="footer-container">
    <div class="footer-logo">
      <img src="logo.png" alt="Dana Amal Logo" />
      <h3>Dana Amal</h3>
    </div>
    <div class="footer-links">
      <h4>Navigasi</h4>
      <ul>
        <li><a href="#home">Beranda</a></li>
        <li><a href="#donasi">Donasi</a></li>
        <li><a href="#tentang">Tentang Kami</a></li>
        <li><a href="#kontak">Kontak</a></li>
        <li><a href="#login">Login</a></li>
      </ul>
    </div>
    <div class="footer-contact">
      <h4>Hubungi Kami</h4>
      <p>Email: support@danaamal.com</p>
      <p>Telp: +62 123 4567 890</p>
    </div>
    <div class="footer-social">
      <h4>Ikuti Kami</h4>
      <a href="#">Facebook</a>
      <a href="#">Twitter</a>
      <a href="#">Instagram</a>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2024 Dana Amal. All Rights Reserved.</p>
  </div>
  </footer> -->
  <section class="footer">
    <div class="container">
      <div class="footer-box">
        <p>
          &copy; Copyright by <span>Dana Amal</span> 2024, All Right Reserved.
        </p>
      </div>
    </div>
  </section>

  <!-- JS -->
  <script src="{{ asset('assets/js/landingpage.js') }}"></script>

  <!-- AOS -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>