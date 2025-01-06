<?php
header('Content-Type: application/json');
require 'koneksi.php'; // Ganti sesuai file koneksi Anda

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$nama = $data['nama'];
$email = $data['email'];
$telepon = $data['telepon'];
$status = $data['status'];

$query = "UPDATE users SET nama = '$nama', email = '$email', no_telepon = '$telepon', status = '$status' WHERE id = $id";
if (mysqli_query($koneksi, $query)) {
    echo json_encode(['success' => true, 'message' => 'Donatur berhasil diperbarui!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal memperbarui donatur.']);
}
