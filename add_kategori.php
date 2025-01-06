<?php
header('Content-Type: application/json');
require 'koneksi.php'; // Ganti sesuai file koneksi Anda

$data = json_decode(file_get_contents('php://input'), true);

$nama = $data['nama'];
$deskripsi = $data['deskripsi'];

$query = "INSERT INTO kategori_donasi (nama, deskripsi) VALUES ('$nama', '$deskripsi')";
if (mysqli_query($koneksi, $query)) {
    echo json_encode(['success' => true, 'message' => 'Kategori Donasi berhasil ditambahkan!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal menambahkan kategori donasi.']);
}
