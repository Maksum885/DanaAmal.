<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Halaman Utama</title>
  <link rel="stylesheet" href="{{ asset('assets/css/menu.css') }}" />
  <link />
  <!-- logo shortcut -->
  <link rel="shortcut icon" href="logodanaamal.png" />

  <script
    src="https://kit.fontawesome.com/018ffcab47.js"
    crossorigin="anonymous"></script>
</head>

<body>
  <div class="wrapper hover-collapse">
    <!-- beranda -->
    <section id="beranda" class="section">
      <div id="mainBeranda">
        <div class="beranda">
          <div class="slider">
            <div class="list">
              <div class="item">
                <img src="{{ asset('assets/images/sample3.png') }}" />
              </div>
              <div class="item">
                <img src="{{ asset('assets/images/sample1.png') }}" />
              </div>
              <div class="item">
                <img src="{{ asset('assets/images/sample2.png') }}" />
              </div>
            </div>

            <!-- button prev and next -->
            <div class="buttons">
              <button id="prev">
                <
                  <button id="next">>
              </button>
            </div>
            <ul class="dots">
              <li class="active"></li>
              <li></li>
              <li></li>
            </ul>
          </div>
          <!-- data donasi -->
          <div class="data-donasi">
            <div class="data">
              <h2>7</h2>
              <p>Program Donasi</p>
            </div>
            <div class="data-garis1"></div>
            <div class="data">
              <h2>Rp. 1.000.000</h2>
              <p>Total Donasi Terkumpul</p>
            </div>
            <div class="data-garis2"></div>
            <div class="data">
              <h2>1</h2>
              <p>Total Donatur</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--  donasi -->
    <section id="donasi" class="section hidden">
      <div class="donasi">
        <div class="grid">
          <!-- card 1 -->
          <div class="card-container">
            <div class="card">
              <div class="card-image">
                <img src="{{ asset('assets/images/sample3.png') }}" />
                <div class="card-tag">
                  <h4>Sediakan Fasilitas Internet Gratis untuk Mahasiswa</h4>
                  <span>Pembangunan</span>
                </div>
              </div>
              <div class="progress-container">
                <div class="progress-bar">
                  <div class="progress-indicator"><span>20%</span></div>
                </div>
              </div>
              <div class="donation-info">
                <div>
                  <span class="label">Donasi Terkumpul:</span>
                  <hr />
                  <span class="value">Rp 80.000</span>
                </div>
                <div>
                  <span class="label">Sisa Waktu:</span>
                  <hr />
                  <span class="value">∞</span>
                </div>
              </div>
              <button class="donate-button">Donasi</button>
            </div>
          </div>
          <!-- card 2 -->
          <div class="card-container">
            <div class="card">
              <div class="card-image">
                <img src="{{ asset('assets/images/sample2.png') }}" />
                <div class="card-tag">
                  <h4>
                    Bantu Teman Difabel di Kampus Mendapatkan Fasilitas Layak
                  </h4>
                  <span>Sosial</span>
                </div>
              </div>
              <div class="progress-container">
                <div class="progress-bar">
                  <div class="progress-indicator2"><span>15%</span></div>
                </div>
              </div>
              <div class="donation-info">
                <div>
                  <span class="label">Donasi Terkumpul:</span>
                  <hr />
                  <span class="value">Rp 52.000</span>
                </div>
                <div>
                  <span class="label">Sisa Waktu:</span>
                  <hr />
                  <span class="value">∞</span>
                </div>
              </div>
              <button class="donate-button">Donasi</button>
            </div>
          </div>
          <!-- card 3 -->
          <div class="card-container">
            <div class="card">
              <div class="card-image">
                <img src="{{ asset('assets/images/sample1.png') }}" />
                <div class="card-tag">
                  <h4>Donasi untuk Taman Edukasi di Area Kampus</h4>
                  <span>Pembangunan</span>
                </div>
              </div>
              <div class="progress-container">
                <div class="progress-bar">
                  <div class="progress-indicator3"><span>37%</span></div>
                </div>
              </div>
              <div class="donation-info">
                <div>
                  <span class="label">Donasi Terkumpul:</span>
                  <hr />
                  <span class="value">Rp 193.000</span>
                </div>
                <div>
                  <span class="label">Sisa Waktu:</span>
                  <hr />
                  <span class="value">∞</span>
                </div>
              </div>
              <button class="donate-button">Donasi</button>
            </div>
          </div>
          <!-- card 4 -->
          <div class="card-container">
            <div class="card">
              <div class="card-image">
                <img src="{{ asset('assets/images/sample2.png') }}" />
                <div class="card-tag">
                  <h4>
                    Donasi untuk Mahasiswa Berprestasi tapi Kurang Mampu
                  </h4>
                  <span>Sosial</span>
                </div>
              </div>
              <div class="progress-container">
                <div class="progress-bar">
                  <div class="progress-indicator4"><span>61%</span></div>
                </div>
              </div>
              <div class="donation-info">
                <div>
                  <span class="label">Donasi Terkumpul:</span>
                  <hr />
                  <span class="value">Rp 348.000</span>
                </div>
                <div>
                  <span class="label">Sisa Waktu:</span>
                  <hr />
                  <span class="value">∞</span>
                </div>
              </div>
              <button class="donate-button">Donasi</button>
            </div>
          </div>
          <!-- card 5 -->
          <div class="card-container">
            <div class="card">
              <div class="card-image">
                <img src="{{ asset('assets/images/sample3.png') }}" />
                <div class="card-tag">
                  <h4>Sediakan Fasilitas Internet Gratis untuk Mahasiswa</h4>
                  <span>Pembangunan</span>
                </div>
              </div>
              <div class="progress-container">
                <div class="progress-bar">
                  <div class="progress-indicator"><span>20%</span></div>
                </div>
              </div>
              <div class="donation-info">
                <div>
                  <span class="label">Donasi Terkumpul:</span>
                  <hr />
                  <span class="value">Rp 50.000</span>
                </div>
                <div>
                  <span class="label">Sisa Waktu:</span>
                  <hr />
                  <span class="value">∞</span>
                </div>
              </div>
              <button class="donate-button">Donasi</button>
            </div>
          </div>
          <!-- card 6 -->
          <div class="card-container">
            <div class="card">
              <div class="card-image">
                <img src="{{ asset('assets/images/sample3.png') }}" />
                <div class="card-tag">
                  <h4>Sediakan Fasilitas Internet Gratis untuk Mahasiswa</h4>
                  <span>Pembangunan</span>
                </div>
              </div>
              <div class="progress-container">
                <div class="progress-bar">
                  <div class="progress-indicator"><span>20%</span></div>
                </div>
              </div>
              <div class="donation-info">
                <div>
                  <span class="label">Donasi Terkumpul:</span>
                  <hr />
                  <span class="value">Rp 50.000</span>
                </div>
                <div>
                  <span class="label">Sisa Waktu:</span>
                  <hr />
                  <span class="value">∞</span>
                </div>
              </div>
              <button class="donate-button">Donasi</button>
            </div>
          </div>
          <!-- card 7 -->
          <div class="card-container">
            <div class="card">
              <div class="card-image">
                <img src="{{ asset('assets/images/sample3.png') }}" />
                <div class="card-tag">
                  <h4>Sediakan Fasilitas Internet Gratis untuk Mahasiswa</h4>
                  <span>Pembangunan</span>
                </div>
              </div>
              <div class="progress-container">
                <div class="progress-bar">
                  <div class="progress-indicator"><span>20%</span></div>
                </div>
              </div>
              <div class="donation-info">
                <div>
                  <span class="label">Donasi Terkumpul:</span>
                  <hr />
                  <span class="value">Rp 50.000</span>
                </div>
                <div>
                  <span class="label">Sisa Waktu:</span>
                  <hr />
                  <span class="value">∞</span>
                </div>
              </div>
              <button class="donate-button">Donasi</button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Riwayat -->
    <section id="riwayat" class="section hidden">
      <h2>Riwayat</h2>
      <p>
        Ini adalah halaman Riwayat. Anda dapat melihat aktivitas donasi
        sebelumnya.
      </p>
    </section>

    <!--top navbar-->
    <div class="top-navbar">
      <div class="logo">
        <img src="{{ asset('assets/images/logodanaamal.png') }}" alt="Logo" />
      </div>
      <div class="menu">
        <div class="hamburger">
          <i class="fa-solid fa-bars"></i>
        </div>
        <div class="profile-wrap">
          <div class="profile">
            <img src="{{ asset('assets/images/user-account.png') }}" onclick="toggleMenu()" />
          </div>
        </div>
      </div>

      <!-- dopdrown profil -->
      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
          <div class="user-info">
            <img src="{{ asset('assets/images/user-account.png') }}" />
            <h3>Donatur</h3>
          </div>
          <hr />

          <a href="#menu-profile" class="sub-menu-link">
            <span class="icon">
              <i class="fa-solid fa-user-tie"></i>
            </span>
            <p id="menuProfil">Profil</p>
            <span class="klik">></span>
          </a>

          <a href="#menu-pengaturan" class="sub-menu-link">
            <span class="icon">
              <i class="fa-solid fa-gear"></i>
            </span>
            <p id="menuPengaturan">Pengaturan</p>
            <span class="klik">></span>
          </a>

          <a href="#" class="sub-menu-link" id="exitButton">
            <span class="icon">
              <i class="fa-solid fa-sign-out-alt"></i>
            </span>
            <p>Keluar</p>
            <span class="klik">></span>
          </a>
        </div>
      </div>
    </div>

    <!--sidebar-->
    <div class="sidebar">
      <div class="sidebar-inner">
        <ul>
          <li>
            <a href="#beranda" onclick="showSection('beranda')">
              <span class="icon">
                <i class="fa-solid fa-house"></i>
              </span>
              <span class="title">Beranda</span>
            </a>
          </li>

          <li>
            <a href="#donasi" onclick="showSection('donasi')">
              <span class="icon">
                <i class="fa-solid fa-hand-holding-heart"></i>
              </span>
              <span class="title">Donasi</span>
            </a>
          </li>

          <li>
            <a href="#riwayat" onclick="showSection('riwayat')">
              <span class="icon">
                <i class="fa-solid fa-clock-rotate-left"></i>
              </span>
              <span class="title">Riwayat</span>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!--profil-->
    <div id="profilDonatur">
      <div class="main-container" id="menu-profile">
        <h2>Profil Donatur</h2>
        <div class="profile-section">
          <h3>Identitas Donatur</h3>
          <div class="form-group">
            <label for="nim">NIDN/NIM</label>
            <input type="text" id="nim" value="3312411079" readonly />
          </div>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input
              type="text"
              id="nama"
              value="Muhammad Ali Maksum"
              readonly />
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email" value="Belum ada" readonly />
          </div>

          <div class="form-group">
            <label for="jurusan">Jurusan</label>
            <input
              type="text"
              id="jurusan"
              value="Teknik Informatika"
              readonly />
          </div>

          <div class="buttons">
            <button class="btn-edit">Ubah</button>
            <button class="btn-save">Simpan</button>
          </div>
        </div>
      </div>
    </div>

    <!-- pengaturan -->
    <div id="pengaturan">
      <div class="main-setting" id="menu-pengaturan">
        <h2>Pengaturan</h2>
        <div class="settings-container">
          <!-- Ganti Password -->
          <div class="settings-section">
            Ganti Password
            <div class="form-group">
              <label for="old-password">Password lama:</label>
              <input
                type="password"
                id="old-password"
                placeholder="Masukkan password lama" />
            </div>
            <div class="form-group">
              <label for="new-password">Password Baru:</label>
              <input
                type="password"
                id="new-password"
                placeholder="Masukkan password baru" />
            </div>
          </div>
          <!-- Ganti Email -->
          <div class="settings-section">
            Ganti Email
            <div class="form-group">
              <label for="old-email">Email lama:</label>
              <input
                type="email"
                id="old-email"
                placeholder="Masukkan email lama" />
            </div>
            <div class="form-group">
              <label for="new-email">Email Baru:</label>
              <input
                type="email"
                id="new-email"
                placeholder="Masukkan email baru" />
            </div>
          </div>
        </div>

        <!-- Ganti Bahasa -->
        <div class="language-section">
          Ganti Bahasa
          <div class="bahasa">
            <label for="language">Pilih Bahasa:</label>
            <select id="language">
              <option value="id">Indonesia</option>
              <option value="en">English (US)</option>
            </select>
          </div>
        </div>

        <!-- Tombol Simpan -->
        <button class="save-button">Simpan Perubahan</button>
      </div>
    </div>
  </div>
  <script src="{{ asset('assets/js/menu.js') }}"></script>
</body>

</html>