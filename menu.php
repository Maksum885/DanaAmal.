<?php
session_start();
include 'koneksi.php'; // File koneksi database

// Pastikan user logi
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'Donatur') {
    header('Location: login.php');
    exit;
}


if (isset($_SESSION['message'])) {
    $message = $_SESSION['message']; // Pastikan variabel $message mendapatkan data dari $_SESSION

    // Periksa apakah $message adalah array dan memiliki kunci 'type' dan 'text'
    if (is_array($message) && isset($message['type'], $message['text'])) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
                Swal.fire({
                    icon: '" . htmlspecialchars($message['type'], ENT_QUOTES, 'UTF-8') . "',
                    title: '" . htmlspecialchars($message['text'], ENT_QUOTES, 'UTF-8') . "',
                    showConfirmButton: false,
                    timer: 1500
                });
              </script>";
    } else {
        echo "<script>console.error('Invalid message structure.');</script>";
    }

    unset($_SESSION['message']); // Hapus session message setelah digunakan
}


$queryProgramDonasi = "SELECT COUNT(*) AS total_program FROM donasi where status='Aktif'";
$resultProgramDonasi = mysqli_query($koneksi, $queryProgramDonasi);
$dataProgramDonasi = mysqli_fetch_assoc($resultProgramDonasi);
$totalProgramDonasi = $dataProgramDonasi['total_program'];

// Query untuk menghitung total donasi terkumpul
$queryTotalDonasi = "SELECT SUM(donasi) AS total_terkumpul FROM donatur WHERE status='selesai'";
$resultTotalDonasi = mysqli_query($koneksi, $queryTotalDonasi);
$dataTotalDonasi = mysqli_fetch_assoc($resultTotalDonasi);
$totalTerkumpul = $dataTotalDonasi['total_terkumpul'];

// Query untuk menghitung jumlah donatur
$queryTotalDonatur = "SELECT COUNT(*) AS total_donatur FROM users WHERE role = 'donatur'";
$resultTotalDonatur = mysqli_query($koneksi, $queryTotalDonatur);
$dataTotalDonatur = mysqli_fetch_assoc($resultTotalDonatur);
$totalDonatur = $dataTotalDonatur['total_donatur'];



$id_user = $_SESSION['id']; // Ambil id_user dari sesi

// Query data slider untuk user yang sedang login
$sql = "SELECT link_gambar FROM slider";
$stmt = $koneksi->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// Ambil data ke dalam array
$sliderItems = [];
while ($row = $result->fetch_assoc()) {
    $sliderItems[] = $row;
}

$query = "
    SELECT 
        donasi.id, 
        donasi.nama_program, 
        donasi.target_donasi, 
        donasi.gambar, 
        donasi.tgl_batas,
        kategori_donasi.nama AS kategori,
        (SELECT IFNULL(SUM(donatur.donasi), 0) FROM donatur WHERE donatur.id_donasi = donasi.id AND donatur.status = 'selesai') AS donatur
    FROM donasi
    JOIN kategori_donasi ON donasi.kategori_id = kategori_donasi.id
    WHERE donasi.status = 'Aktif'
    
";


$result = $koneksi->query($query);

// Cek apakah ada data donasi
if ($result->num_rows > 0) {
    $donasis = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $donasis = [];
}

$query = "
    SELECT 
        donatur.donasi, 
        donatur.created_at, 
        donasi.nama_program,
        donatur.status
    FROM donatur 
    JOIN donasi ON donatur.id_donasi = donasi.id 
    WHERE donatur.id_user = ?
    ORDER BY donatur.created_at DESC
";

$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

// Menampilkan hasil riwayat donasi
$donations = [];
while ($row = $result->fetch_assoc()) {
    $donations[] = $row;
}

$query = "SELECT id, email, no_telepon, status, jabatan, nama FROM users WHERE id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

// Cek apakah ada data pengguna
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Data pengguna tidak ditemukan.";
    exit;
}

$stmt->close();
$koneksi->close();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="content.css" />
    <!-- logo shortcut -->
    <link rel="shortcut icon" href="logodanaamal.png" />
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

</head>

<body>
    <div class="container">
        <div class="wrapper hover-collapse">
            <!-- beranda -->
            <section id="beranda" class="section">
                <div class="beranda-container">
                    <div class="slider">
                        <div class="list">
                            <?php foreach ($sliderItems as $item): ?>
                                <div class="item">
                                    <img src="<?= $item['link_gambar'] ?>" alt="Slider Image">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- tombol slider -->
                        <div class="buttons">
                            <button id="prev">&lt;</button>
                            <button id="next">&gt;</button>
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
                            <h2><?php echo $totalProgramDonasi; ?></h2>
                            <p>Program Donasi</p>
                        </div>
                        <div class="data-garis1"></div>
                        <div class="data">
                            <h2>Rp. <?php echo number_format($totalTerkumpul, 0, ',', '.'); ?></h2>
                            <p>Total Donasi Terkumpul</p>
                        </div>
                        <div class="data-garis2"></div>
                        <div class="data">
                            <h2><?php echo $totalDonatur; ?></h2>
                            <p>Total Donatur</p>
                        </div>
                    </div>

                </div>
            </section>

            <!-- donasi -->
            <section id="donasi" class="section hidden">
                <div class="donasi-container">
                    <div class="grid">
                        <?php foreach ($donasis as $donasi): ?>
                            <?php
                            // Menghitung persentase donasi
                            $persentase = ($donasi['donatur'] / $donasi['target_donasi']) * 100;
                            $persentase = min($persentase, 100); // Membatasi persentase maksimal 100%

                            // Menghitung sisa waktu (hanya dalam hari)
                            $tgl_batas = new DateTime($donasi['tgl_batas']);
                            $now = new DateTime();
                            $interval = $now->diff($tgl_batas);
                            $sisa_waktu = $interval->format('%a'); // Hanya hari saja
                            ?>
                            <div class="card-container">
                                <div class="card">
                                    <div class="card-image">
                                        <img src="assets/img/donasi/<?= htmlspecialchars($donasi['gambar']) ?>" alt="Gambar Program Donasi" />
                                        <div class="card-tag">
                                            <h4><?= htmlspecialchars($donasi['nama_program']) ?></h4>
                                            <span><?= htmlspecialchars($donasi['kategori']) ?></span>
                                        </div>
                                    </div>
                                    <div class="progress-container">
                                        <div class="progress-bar">
                                            <div class="progress-indicator" style="width: <?= $persentase ?>%"><span><?= round($persentase) ?>%</span></div>
                                        </div>
                                    </div>
                                    <div class="donation-info">
                                        <div>
                                            <span class="label">Donasi Terkumpul:</span>
                                            <hr />
                                            <span class="value">Rp <?= number_format($donasi['donatur'], 0, ',', '.') ?></span>
                                        </div>
                                        <div>
                                            <span class="label">Sisa Waktu:</span>
                                            <hr />
                                            <span class="value"><?= $sisa_waktu ?> Hari</span>
                                        </div>
                                    </div>
                                    <button onclick="window.location.href='donasi.php?id=<?= $donasi['id'] ?>'" class="donate-button">Donasi</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <?php
            // Fungsi untuk menghitung waktu yang telah berlalu
            function time_elapsed_string($datetime, $full = false)
            {
                $now = new DateTime();
                $ago = new DateTime($datetime);
                $diff = $now->diff($ago);

                // Menghitung minggu dan sisa hari
                $weeks = floor($diff->days / 7); // Hitung minggu dari total hari
                $days = $diff->days % 7; // Hitung sisa hari

                // Array untuk mendefinisikan unit waktu
                $string = array(
                    'y' => 'tahun',
                    'm' => 'bulan',
                    'd' => 'hari',
                    'h' => 'jam',
                    'i' => 'menit',
                    's' => 'detik',
                );

                $result = [];

                // Jika ada minggu, tambahkan ke array
                if ($weeks > 0) {
                    $result[] = $weeks . ' minggu';
                }

                // Tambahkan elemen waktu lainnya (tahun, bulan, hari, dll)
                foreach ($string as $k => $v) {
                    if ($diff->$k) {
                        $result[] = $diff->$k . ' ' . $v;
                    }
                }

                // Jika hanya satu unit waktu yang ingin ditampilkan, ambil yang pertama
                if (!$full) {
                    $result = array_slice($result, 0, 1);
                }

                // Mengembalikan string yang dihasilkan
                return $result ? implode(', ', $result) . ' yang lalu' : 'baru saja';
            }



            ?>

            <!-- Riwayat -->
            <section id="riwayat" class="section hidden">
                <div class="riwayat-container">
                    <table>
                        <tr>
                            <th>Donatur</th>
                            <th>Nominal</th>
                            <th>Waktu Donasi</th>
                            <th>Status</th>
                        </tr>
                        <?php foreach ($donations as $donation): ?>
                            <tr>
                                <td><?= htmlspecialchars($donation['nama_program']) ?></td>
                                <td>Rp <?= number_format($donation['donasi'], 0, ',', '.') ?></td>
                                <td><?= time_elapsed_string($donation['created_at']) ?></td> <!-- Fungsi untuk menampilkan waktu -->
                                <td><?= htmlspecialchars($donation['status']) ?></td>

                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </section>


            <!--top navbar-->
            <div class="top-navbar">
                <div class="logo">
                    <img src="logodanaamal.png" alt="Logo" />
                </div>
                <div class="menu">
                    <div class="hamburger">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                    <div class="profile-wrap">
                        <div class="profile">
                            <img src="user-account.png" onclick="toggleMenu()" />
                        </div>
                    </div>
                </div>

                <!-- dopdrown profil -->
                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                            <img src="user-account.png" />
                            <h3>Donatur</h3>
                        </div>
                        <hr />

                        <a href="#menu-profile" class="sub-menu-link" onclick="showSection('profilDonatur')">
                            <span class="icon">
                                <i class="fa-solid fa-user-tie"></i>
                            </span>
                            <p id="menuProfil">Profil</p>
                            <span class="klik">></span>
                        </a>

                        <a href="#menu-pengaturan" class="sub-menu-link" onclick="showSection('pengaturan')">
                            <span class="icon">
                                <i class="fa-solid fa-gear"></i>
                            </span>
                            <p id="menuPengaturan">Pengaturan</p>
                            <span class="klik">></span>
                        </a>

                        <a href="logout.php" class="sub-menu-link" id="exitButton">
                            <span class="icon">
                                <i class="fa-solid fa-sign-out-alt"></i>
                            </span>
                            <p>Keluar</p>
                            <span class="klik">></span>
                        </a>
                    </div>
                </div>
            </div>

            <!--profil-->
            <div id="profilDonatur" class="section hidden">
                <div class="profile-container" id="menu-profile">
                    <h2>Profil Donatur</h2>
                    <div class="profile-section">
                        <h3>Identitas Donatur</h3>
                        <form id="form-profil" method="POST" action="update_profil.php">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($user['nama']) ?>" readonly />
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" readonly />
                            </div>
                            <div class="form-group">
                                <label for="no_telepon">No Telepon</label>
                                <input type="text" id="no_telepon" name="no_telepon" value="<?= htmlspecialchars($user['no_telepon']) ?>" readonly />
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" id="jabatan" name="jabatan" value="<?= !empty($user['jabatan']) ? htmlspecialchars($user['jabatan']) : '' ?>" readonly />


                            </div>
                            <div class="tombol">
                                <button type="button" class="btn-edit" onclick="enableEditing()">Ubah</button>
                                <button type="submit" class="btn-save" style="display:none;">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <script>
                function enableEditing() {
                    // Menghapus atribut readonly pada input fields
                    document.getElementById('nama').removeAttribute('readonly');
                    document.getElementById('email').removeAttribute('readonly');
                    document.getElementById('no_telepon').removeAttribute('readonly');
                    document.getElementById('jabatan').removeAttribute('readonly');

                    // Menampilkan tombol Simpan dan menyembunyikan tombol Ubah
                    document.querySelector('.btn-save').style.display = 'inline-block';
                    document.querySelector('.btn-edit').style.display = 'none';
                }
            </script>


            <!-- pengaturan -->
            <div id="pengaturan" class="section hidden">
                <div class="main-setting" id="menu-pengaturan">
                    <h2>Pengaturan</h2>
                    <!-- Ganti Password -->
                    <form action="update_settings.php" method="POST">
                        <div class="settings-container">
                            <div class="settings-section" id="password-section">
                                Ganti Password
                                <div class="form-group">
                                    <label for="old-password">Password lama:</label>
                                    <input
                                        type="password"
                                        name="old-password"
                                        id="old-password"
                                        placeholder="Masukkan password lama" />
                                </div>
                                <div class="form-group">
                                    <label for="new-password">Password Baru:</label>
                                    <input
                                        type="password"
                                        name="new-password"
                                        id="new-password"
                                        placeholder="Masukkan password baru" />
                                </div>
                            </div>
                            <!-- Ganti Email -->
                            <div class="settings-section" id="email-section">
                                Ganti Email
                                <div class="form-group">
                                    <label for="old-email">Email lama:</label>
                                    <input
                                        type="email"
                                        name="old-email"
                                        id="old-email"
                                        placeholder="Masukkan email lama" />
                                </div>
                                <div class="form-group">
                                    <label for="new-email">Email Baru:</label>
                                    <input
                                        type="email"
                                        name="new-email"
                                        id="new-email"
                                        placeholder="Masukkan email baru" />
                                </div>
                            </div>
                        </div>
                        <!-- Tombol Simpan -->
                        <button type="submit" class="save-button">Simpan Perubahan</button>
                    </form>
                </div>
            </div>


            <!-- sidebar -->
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

        </div>
    </div>
    <script src="content.js"></script>
    <script
        src="https://kit.fontawesome.com/018ffcab47.js"
        crossorigin="anonymous">
    </script>

    <?php
    if (isset($_GET['status']) && $_GET['status'] == 'success') {
        echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data Anda telah berhasil diperbarui.',
            icon: 'success',
            confirmButtonText: 'Tutup'
        });
    </script>
    ";
    }
    ?>


</body>

</html>