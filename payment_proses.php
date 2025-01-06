<?php
session_start();
require_once 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['id'])) {
    echo "User tidak terdaftar.";
    exit;
}

// Proses form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil ID donasi dan nominal dari form
    $id_donasi = $_POST['id_donasi'];
    $nominal = $_POST['nominal'];

    // Validasi nominal
    if ($nominal < 5000) {
        echo "Nominal donasi minimal Rp 5.000.";
        exit;
    }

    // Ambil ID user dari sesi
    $id_user = $_SESSION['id'];

    // Query untuk memasukkan data donatur ke database
    $query = "INSERT INTO donatur (id_user, id_donasi, donasi, status, created_at, updated_at) 
              VALUES (?, ?, ?, 'pending', NOW(), NOW())";

    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("iis", $id_user, $id_donasi, $nominal); // Hanya mengikat ID user, ID donasi, dan nominal

    if ($stmt->execute()) {
        // Setelah berhasil insert, arahkan ke halaman qrcode.php
        header("Location: qrcode.php?id_donasi=" . $stmt->insert_id); // Mengirim ID donatur yang baru saja dimasukkan
        exit();
    } else {
        echo "Terjadi kesalahan saat memproses donasi.";
    }
} else {
    echo "Metode request tidak valid.";
    exit;
}
