<?php
header('Content-Type: application/json');
require 'koneksi.php'; // Ganti sesuai file koneksi Anda

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];

$query = "DELETE FROM kategori_donasi WHERE id = $id";
if (mysqli_query($koneksi, $query)) {
    echo json_encode(['success' => true, 'message' => 'Kategori Donasi berhasil dihapus!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal menghapus kategori donasi.']);
}
