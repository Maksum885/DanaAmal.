<?php
session_start();
require_once 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['id'])) {
    echo "User tidak terdaftar.";
    exit;
}

// Ambil ID donasi dan nominal dari URL
if (isset($_GET['id']) && isset($_GET['nominal'])) {
    $id_donasi = $_GET['id'];
    $nominal = $_GET['nominal'];

    // Validasi nominal
    if ($nominal < 5000) {
        echo "Nominal donasi minimal Rp 5.000.";
        exit;
    }
} else {
    echo "Data tidak lengkap.";
    exit;
}

// Proses form submit ketika tombol "Donasi Sekarang" diklik

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <!-- logo shortcut -->
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
        <div class="payment-container">
            <h3 class="ds">Ringkasan Donasi</h3>
            <div class="donation-amount">
                <span>Nominal donasi Anda</span>
                <div class="change">
                    <button onclick="window.location.href='donasi.php?id=15'" class="edit-button">Ubah</button>
                    <!-- <button onclick="window.location.href='donasi.php?id=<?= $donasi['id'] ?>'" class="edit-button">Ubah</button> -->
                    <span class="amount">Rp <?= number_format($nominal, 0, ',', '.') ?></span>
                </div>
            </div>

            <div class="payment-method">
                <span>Metode Pembayaran</span>
                <img src="qrlogo.svg" alt="QRIS" class="qris-logo">
            </div>

            <!-- Form untuk mengirimkan data donasi -->
            <form action="payment_proses.php" method="POST">
                <input type="hidden" name="id_donasi" value="<?= $id_donasi ?>">
                <input type="hidden" name="nominal" value="<?= $nominal ?>">
                <button type="submit" class="donate-button">Donasi Sekarang</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("donation-input").addEventListener("input", function(e) {
            const nominal = parseInt(e.target.value) || 0; // Menghindari NaN jika kosong
            const formattedNominal = new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0,
            }).format(nominal);

            document.getElementById("total-donation").textContent = formattedNominal;
        });
    </script>

</body>

</html>