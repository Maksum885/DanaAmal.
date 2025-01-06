<?php
header('Content-Type: application/json');
require 'koneksi.php'; // Ganti sesuai file koneksi Anda

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$nama = $data['nama'];
$deskripsi = $data['deskripsi'];

$query = "UPDATE kategori_donasi SET nama = '$nama', deskripsi = '$deskripsi' WHERE id = $id";
if (mysqli_query($koneksi, $query)) {
    echo json_encode(['success' => true, 'message' => 'Kategori Donasi berhasil diperbarui!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal memperbarui Kategori Donasi.']);
}
