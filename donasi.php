<?php
session_start();
require_once 'koneksi.php';

// Ambil ID donasi dari URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $donasi_id = $_GET['id'];

    // Query untuk mengambil data donasi berdasarkan ID
    $query = "SELECT donasi.id, donasi.nama_program, donasi.target_donasi, donasi.gambar, kategori_donasi.nama AS kategori
              FROM donasi
              JOIN kategori_donasi ON donasi.kategori_id = kategori_donasi.id
              WHERE donasi.id = $donasi_id";
    $result = $koneksi->query($query);

    // Cek jika data ditemukan
    if ($result->num_rows > 0) {
        $donasi = $result->fetch_assoc();
    } else {
        // Jika donasi tidak ditemukan, tampilkan pesan error
        echo "<p>Donasi tidak ditemukan.</p>";
        exit;
    }
} else {
    // Jika ID tidak valid, arahkan kembali ke halaman daftar donasi atau tampilkan pesan error
    echo "<p>ID donasi tidak valid.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Donasi</title>
    <link rel="shortcut icon" href="logodanaamal.png" />
    <link rel="stylesheet" href="donasi.css" />
</head>

<body>
    <div class="container">
        <!--navbar-->
        <div class="navbar">
            <div class="logo">
                <img src="logodanaamal.png" alt="Logo" />
            </div>
        </div>

        <!--Donasi -->
        <div class="donasi-container">
            <div class="poster">
                <img src="assets/img/donasi/<?= htmlspecialchars($donasi['gambar']) ?>" alt="Gambar Program Donasi" />
                <p><?= htmlspecialchars($donasi['nama_program']) ?></p>
            </div>
            <div class="nominal">
                <h3>Nominal</h3>
                <p>Pilih nominal yang tersedia</p>
                <div class="nominal-options">
                    <button class="nominal-button">Rp30.000</button>
                    <button class="nominal-button active">Rp50.000</button>
                    <button class="nominal-button">Rp75.000</button>
                    <button class="nominal-button">Rp100.000</button>
                </div>

                <h4>Nominal Lainnya</h4>
                <div class="custom-nominal">
                    <span class="rp">Rp</span>
                    <input type="number" id="customNominal" placeholder="0" value="50000" />
                </div>
                <p class="min-donation">Minimum donasi Rp 5.000</p>

                <!-- Ambil nilai nominal yang dipilih dan kirimkan ke payment.php -->
                <button id="nextButton" class="next-button">Selanjutnya</button>
                <p id="error-message" style="color: red; display: none;">Nominal donasi minimal Rp 5.000</p>
            </div>
        </div>
    </div>

    <script>
        let selectedNominal = 50000; // Nilai default (misalnya Rp50.000)

        // Fungsi untuk memilih nominal
        document.querySelectorAll('.nominal-button').forEach(button => {
            button.addEventListener('click', function() {
                // Menghapus class active dari tombol lain
                document.querySelectorAll('.nominal-button').forEach(btn => btn.classList.remove('active'));
                // Menambahkan class active ke tombol yang dipilih
                button.classList.add('active');
                // Menyimpan nilai nominal yang dipilih
                selectedNominal = parseInt(button.innerText.replace('Rp', '').replace('.', '').trim());
                // Update input field dengan nominal yang dipilih
                document.getElementById('customNominal').value = selectedNominal;
            });
        });

        // Menyertakan nilai nominal saat mengklik tombol "Selanjutnya"
        document.getElementById('nextButton').addEventListener('click', function() {
            const customNominal = parseInt(document.getElementById('customNominal').value);

            // Validasi: Nominal harus lebih dari atau sama dengan 5000
            if (customNominal < 5000) {
                // Tampilkan pesan error jika nominal kurang dari 5000
                document.getElementById('error-message').style.display = 'block';
            } else {
                // Hapus pesan error jika validasi berhasil
                document.getElementById('error-message').style.display = 'none';
                // Arahkan ke halaman payment.php dengan ID donasi dan nominal
                window.location.href = 'payment.php?id=<?= $donasi['id'] ?>&nominal=' + customNominal;
            }
        });
    </script>

</body>

</html>