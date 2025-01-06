<?php
// Konfigurasi koneksi database
include 'koneksi.php';



// Proses form jika ada pengiriman data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['name'];
    $email = $_POST['email'];
    $pesan = $_POST['message'];

    $query = "INSERT INTO hubungi_kami (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Pesan Anda telah dikirim.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'landingpage.php'; // Ganti dengan halaman tujuan Anda
                    });
                });
              </script>";
    } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Pesan Anda gagal dikirim.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.history.back();
                    });
                });
              </script>";
    }
}
?>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <title>Dana Amal</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            scroll-behavior: smooth;
        }

        /* style awal header */
        header {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.6)),
                url("contoh.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .container {
            width: 85%;
            margin-inline: auto;
        }

        .navbar {
            padding: 13px 0 13px 0;
            width: 100%;
            position: fixed;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .navbar.scrolling-active {
            background-color: #306030;
            padding: 15px 0 15px 0;
        }

        .navbar .box-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .box-navbar .logo img {
            width: 80px;
            height: auto;
            cursor: pointer;
        }

        .navbar .box-navbar .logo img:hover {
            transform: scale(1.05);
        }

        .navbar .box-navbar .menu {
            display: flex;
            column-gap: 30px;
        }

        .navbar .box-navbar .menu li {
            list-style: none;
        }

        .navbar .box-navbar .menu li a {
            text-decoration: none;
            color: rgba(255, 255, 255, 0.7);
            padding: 10px 15px 10px 15px;
            transition: all 0.3s ease;
        }

        .navbar .box-navbar .menu li a:hover {
            color: rgba(255, 255, 255, 1);
            transition: all 0.3s ease;
        }

        .navbar .box-navbar .menu li a i {
            display: none;
        }

        .navbar .registrasi-button {
            padding: 10px 20px 10px 20px;
            background-color: white;
            border: none;
            color: rgba(0, 0, 0, 0.5);
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s ease;
            margin-right: 20px;
        }

        .navbar .registrasi-button:hover {
            background-color: rgba(0, 0, 0, 0.3);
            color: white;
            transition: all 0.3s ease;
        }

        .navbar .login-button {
            padding: 10px 20px 10px 20px;
            background-color: white;
            border: none;
            color: rgba(0, 0, 0, 0.5);
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .navbar .login-button:hover {
            background-color: rgba(0, 0, 0, 0.3);
            color: white;
            transition: all 0.3s ease;
        }

        .hamburger {
            padding: 0;
            margin-left: 20px;
            height: 24px;
            display: none;
        }

        .hamburger .hamburger-box {
            width: 30px;
        }

        .hamburger-inner,
        .hamburger-inner::before,
        .hamburger-inner::after {
            width: 40px;
            height: 4px;
            background-color: rgba(255, 255, 255, 1);
        }

        .hamburger.is-active .hamburger-inner,
        .hamburger.is-active .hamburger-inner::before,
        .hamburger.is-active .hamburger-inner::after {
            background-color: rgba(255, 255, 255, 1);
        }

        @media screen and (max-width: 992px) {
            .navbar .box-navbar .logo {
                width: 100%;
            }

            .navbar .box-navbar .menu {
                position: absolute;
                top: 50%;
                left: -100%;
                transform: translate(0, 45%);
                flex-direction: column;
                background-color: rgba(255, 255, 255, 1);
                align-items: start;
                gap: 0;
                padding-inline: 10px;
                transition: all 0.3s ease;
                border-style: double;
                border-radius: 5px;
                z-index: 9999;
            }

            .navbar .box-navbar .menu.menu-active {
                left: 0;
            }

            .navbar .box-navbar .menu li {
                padding: 10px 0 10px 0;
                border-bottom: 1px solid black;
                width: 100%;
            }

            .navbar .box-navbar .menu li a {
                color: black;
                font-weight: bold;
                display: flex;
                gap: 10px;
            }

            .navbar .box-navbar .menu li a:hover {
                color: #306030;
            }

            .navbar .box-navbar .menu li a i {
                font-size: 18px;
                display: block;
            }

            .navbar .hamburger {
                display: block;
            }
        }

        /* hero */
        /* .menu-bar {
  display: none;
  color: white;
  font-size: 24px;
  cursor: pointer;
} */
        .hero {
            height: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 50px;
        }

        .hero .box-hero {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: 1fr;
            column-gap: 50px;
            align-items: center;
            justify-content: space-between;
        }

        .hero .box-hero .box:nth-child(1) h1 {
            color: white;
            font-size: 3vw;
            line-height: 1.3;
            margin-bottom: 20px;
        }

        .hero .box-hero .box:nth-child(1) p {
            line-height: 2;
            color: white;
            margin-bottom: 20px;
            font-weight: 200;
            font-size: 18px;
            --animate-delay: 0.4s;
        }

        .hero .box-hero .box:nth-child(2) img {
            width: 100%;
            border-radius: 20px;
            --animate-delay: 0.7s;
        }

        /* @media screen and (max-width: 990px) {
  .menu-bar {
    display: block;
  }

  .navbar .box-navbar .menu {
    position: absolute;
    flex-direction: column;
    width: 100%;
    height: 200px;
    row-gap: 20px;
    justify-content: center;
    align-items: center;
    top: 70px;
    right: 50%;
    transform: translateX(50%);
    opacity: 0;
    transition: all 0.3s ease;
    background-color: #0050b3;
  }

  .navbar .box-navbar .menu.show {
    top: 80px;
    opacity: 1;
    border-top: 1px solid white;
  }

  .hero .box-hero .box:nth-child(1) p {
    font-size: 14px;
  }
} */

        @media screen and (max-width: 768px) {
            .hero .box-hero {
                grid-template-columns: 1fr;
                grid-template-rows: repeat(2, 1fr);
                row-gap: 10px;
            }

            .hero .box-hero .box:nth-child(1) {
                order: 2;
                text-align: center;
            }

            .hero .box-hero .box:nth-child(2) {
                order: 1;
                text-align: center;
            }

            .hero .box-hero .box:nth-child(2) img {
                width: 55vw;
            }
        }

        @media screen and (max-width: 575px) {
            .hero .box-hero .box:nth-child(1) h1 {
                font-size: 18px;
            }
        }

        @media screen and (max-width: 370px) {
            .hero .box-hero .box:nth-child(2) {
                width: 55vw;
                align-self: flex-end;
                justify-self: center;
            }
        }

        /* style akhir header */

        /* style donasi */
        .donasi {
            padding-top: 100px;
            padding-bottom: 150px;
            border-bottom: 1px solid #000;
        }

        .box-donasi .box:nth-child(1) h1 {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .box-donasi .box:nth-child(1) p {
            line-height: 2;
        }

        .box-donasi .box:nth-child(2) {
            margin-top: 50px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .box-donasi .box:nth-child(2) div img {
            width: 100%;
        }

        .box-donasi .box:nth-child(2) div h2 {
            margin-bottom: 20px;
            text-decoration: underline;
        }

        .box-donasi .box:nth-child(2) div p {
            line-height: 2;
        }

        .box-donasi .box:nth-child(2) div p:nth-child(2) {
            margin-bottom: 15px;
        }

        .box-donasi .box:nth-child(2) div p:nth-child(3) {
            margin-bottom: 10px;
            font-weight: 500;
        }

        .box-donasi .box:nth-child(2) div ul {
            list-style-type: none;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .box-donasi .box:nth-child(2) div ul li {
            margin-bottom: 5px;
            font-style: italic;
        }

        @media screen and (max-width: 992px) {
            .box-donasi .box:nth-child(2) {
                grid-template-columns: repeat(1, 1fr);
            }
        }

        @media screen and (max-width: 475) {
            .box-donasi .box:nth-child(2) div p {
                font-size: 14px;
            }
        }

        /* style akhir donasi */

        /* style tentang kami */
        .tentangkami {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            margin: 30px;
        }

        .tentangkami .container {
            max-width: 50%;
        }

        .tentangkami .container h2 {
            font-size: 24px;
            margin-bottom: 25px;
            text-decoration: underline;
        }

        .tentangkami .container p {
            font-size: 17px;
            line-height: 1.8;
            color: #333;
        }

        .tentangkami .image img {
            width: 600px;
            height: auto;
        }

        @media (max-width: 992px) {
            .tentangkami {
                flex-direction: column;
                text-align: justify;
            }

            .tentangkami .container h2 {
                text-align: center;
            }

            .tentangkami .container p {
                margin-left: -150px;
                margin-right: -150px;
            }

            .tentangkami .image img {
                max-width: 100%;
            }

            .tentangkami .container h2 {
                font-size: 20px;
            }
        }

        @media (max-width: 560px) {
            .tentangkami {
                flex-direction: column;
                text-align: justify;
            }

            .tentangkami .container h2 {
                text-align: center;
            }

            .tentangkami .container p {
                margin-left: -100px;
                margin-right: -100px;
            }

            .tentangkami .image img {
                max-width: 100%;
            }
        }

        @media (max-width: 350px) {
            .tentangkami {
                flex-direction: column;
                text-align: justify;
            }

            .tentangkami .container h2 {
                text-align: center;
            }

            .tentangkami .container p {
                margin-left: -50px;
                margin-right: -50px;
            }

            .tentangkami .image img {
                max-width: 100%;
            }
        }

        /* kontak start */

        .kontak {
            width: 100%;
            margin: 40px auto;
            padding: 20px;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .kontak .container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #111;
        }

        .kontak p {
            text-align: center;
            margin-bottom: 40px;
            color: #111;
        }

        .contact-info {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 10px;
        }

        .info-box {
            background-color: rgba(255, 255, 255, 0.6);
            padding: 15px;
            border-radius: 8px;
            width: calc(50% - 25px);
            text-align: center;
        }

        .info-box h3 {
            color: #0072c6;
            margin-bottom: 15px;
        }

        .contact-form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .contact-form h3 {
            color: #111;
            text-decoration: underline;
        }

        .contact-form label {
            font-weight: bold;
        }

        .contact-form input,
        .contact-form textarea {
            padding: 10px;
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 5px;
            font-size: 16px;
        }

        .contact-form button {
            padding: 15px;
            background-color: #0072c6;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .contact-form button:hover {
            background-color: #005fa3;
        }

        @media (max-width: 768px) {
            .contact-info {
                flex-direction: column;
                align-items: center;
            }

            .info-box {
                width: 100%;
            }

            nav ul {
                flex-direction: column;
                gap: 10px;
            }

            .logreg {
                display: flex;
            }
        }

        @media (max-width: 480px) {
            .contact-section {
                padding: 15px;
            }

            .contact-form input,
            .contact-form textarea {
                font-size: 14px;
            }

            .contact-form button {
                padding: 10px;
                font-size: 14px;
            }

            .logreg {
                display: flex;
            }
        }

        /* kontak end */

        /* footer */

        /* footer {
  background-color: #0072c6;
  color: #ffffff;
  padding: 40px 20px;
}

.footer-container {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 20px;
}

.footer-logo {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.footer-logo img {
  width: 50px;
  height: auto;
  margin-bottom: 10px;
}

.footer-links,
.footer-contact,
.footer-social {
  flex: 1;
  min-width: 200px;
  text-align: center;
}

.footer-links h4,
.footer-contact h4,
.footer-social h4 {
  font-size: 18px;
  margin-bottom: 15px;
  color: #ffffff;
}

.footer-links ul {
  list-style: none;
  padding: 0;
}

.footer-links ul li {
  margin-bottom: 10px;
}

.footer-links ul li a,
.footer-social a {
  color: #ffffff;
  text-decoration: none;
  transition: color 0.3s;
}

.footer-links ul li a:hover,
.footer-social a:hover {
  color: #ffdd57;
}

.footer-contact p {
  margin: 5px 0;
}

.footer-bottom {
  text-align: center;
  margin-top: 20px;
  padding-top: 20px;
  border-top: 1px solid #ffffff;
  color: #ffffff;
  font-size: 14px;
} */
        /* Responsive Styling */
        /* @media (max-width: 768px) {
  .footer-container {
    flex-direction: column;
    align-items: center;
  }

  .footer-links,
  .footer-contact,
  .footer-social {
    text-align: center;
    margin-bottom: 20px;
  }
}

@media (max-width: 480px) {
  .footer-logo img {
    width: 40px;
  }

  .footer-links h4,
  .footer-contact h4,
  .footer-social h4 {
    font-size: 16px;
  }

  .footer-bottom {
    font-size: 12px;
  }
} */

        .footer {
            width: 100%;
            padding-top: 20px;
            padding-bottom: 20px;
            background-color: #306030;
        }

        .footer-box {
            text-align: center;
        }

        .footer-box p {
            color: rgba(255, 255, 255, 0.8);
            line-height: 2;
        }

        .footer-box p span {
            color: rgba(255, 255, 255, 1);
            font-weight: bold;
        }
    </style>
</head>

<body id="beranda">
    <header>
        <!-- navbar -->
        <div class="navbar">
            <div class="container">
                <div class="box-navbar">
                    <div class="logo">
                        <img src="logodanaamal.png" />
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
                            src="contoh1.jpg" />
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
                        <img src="gambar1.png" />
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
            <img src="gambar2.png" />
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
        <form class="contact-form" method="POST">
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
    <section class="footer">
        <div class="container">
            <div class="footer-box">
                <p>
                    &copy; Copyright by <span>Dana Amal</span> 2024, All Right Reserved.
                </p>
            </div>
        </div>
    </section>


    <!-- AOS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        const menuBar = document.querySelector(".menu-bar");
        const menuNav = document.querySelector(".menu");

        // menuBar.addEventListener("click", () => {
        //   menuNav.classList.toggle("show");
        // });

        const navBar = document.querySelector(".navbar");

        window.addEventListener("scroll", () => {
            const windowPosition = window.scrollY > 0;
            navBar.classList.toggle("scrolling-active", windowPosition);
        });

        // hamburger
        const hamburger = document.querySelector(".hamburger");
        const menu = document.querySelector(".menu");

        hamburger.addEventListener("click", () => {
            hamburger.classList.toggle("is-active");
            menu.classList.toggle("menu-active");
        });

        window.addEventListener("scroll", () => {
            hamburger.classList.remove("is-active");
            menu.classList.remove("menu-active");
        });

        // to login
        document.querySelector(".login-button").addEventListener("click", () => {
            window.location.href = "login.php";
        });

        // to registrasi
        document.querySelector(".registrasi-button").addEventListener("click", () => {
            window.location.href = "registrasi.php";
        });
    </script>
</body>

</html>