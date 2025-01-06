<?php
// Pastikan koneksi sudah dibuka
require_once 'koneksi.php';  // Ganti dengan file koneksi Anda

// Ambil id_donasi dari URL
if (isset($_GET['id_donasi'])) {
    $id_donasi = $_GET['id_donasi'];
} else {
    echo "ID donasi tidak ditemukan.";
    exit;
}

// Query untuk mengambil data donasi berdasarkan id_donasi
$query = "SELECT * FROM donatur WHERE id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_donasi);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Ambil data yang diperlukan
    $nominal = $row['donasi']; // Nominal donasi
} else {
    echo "Donasi tidak ditemukan.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pembayaran</title>
    <!-- logo shortcut -->
    <link rel="shortcut icon" href="logodanaamal.png" />
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
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
        <div class="qr-container">
            <p class="caption">Batas waktu pembayaran</p>
            <div class="real-time">
                <div id="tanggal"></div>
                <div id="waktu"></div>
                <div class="waktu-mundur">
                    <i class="fa-solid fa-hourglass-half"></i>
                    <span class="countdown" id="countdown">5:00</span>
                </div>
            </div>
            <!-- Content -->
            <div class="content">
                <div class="atas">
                    <h4>Scan QR Code</h4>
                    <!-- QR Code -->
                    <div class="qrlogo">
                        <img src="qrlogo.svg"
                            alt="QR Code Pembayaran">
                    </div>
                </div>
                <!-- QRIS Icon -->
                <img src="qr.jpg"
                    alt="QRIS Logo" class="qris-icon">
                <div class="bawah">
                    <span>Total Donasi</span>
                    <strong>Rp <?= number_format($nominal, 0, ',', '.') ?></strong>
                </div>
                <div>
                    <button onclick="window.location.href='status.php?id_donasi=<?= $_GET['id_donasi']; ?>'" class="cek-status">Cek status pembayaran</button>
                </div>

            </div>
        </div>
    </div>
    <script src="qr.js"></script>
</body>

</html>