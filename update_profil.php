<?php
session_start();
require_once 'koneksi.php'; // Pastikan koneksi ke database sudah ada

// Cek apakah pengguna sudah login
if (!isset($_SESSION['id'])) {
    echo "User tidak terdaftar.";
    exit;
}

// Ambil ID user dari sesi
$id_user = $_SESSION['id'];

// Cek apakah data dikirim dengan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari formulir
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_telepon = $_POST['no_telepon'];
    $jabatan = $_POST['jabatan'];

    // Query untuk memperbarui data pengguna
    $query = "UPDATE users SET nama = ?, email = ?, no_telepon = ?, jabatan = ? WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ssssi", $nama, $email, $no_telepon, $jabatan, $id_user);

    // Eksekusi query dan periksa apakah berhasil
    if ($stmt->execute()) {
        // Redirect ke menu.php dan menampilkan SweetAlert sukses
        header("Location: menu.php?status=success");
        exit;
    } else {
        echo "Terjadi kesalahan saat memperbarui data.";
    }
}
