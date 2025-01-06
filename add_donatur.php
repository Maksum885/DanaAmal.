<?php
header('Content-Type: application/json');
require 'koneksi.php'; // Ganti sesuai file koneksi Anda

$data = json_decode(file_get_contents('php://input'), true);

$nama = $data['nama'];
$email = $data['email'];
$telepon = $data['telepon'];
$status = $data['status'];
$password = 'password'; // Gantilah dengan password yang Anda inginkan atau menerima dari input
$role = 'Donatur';
// Meng-hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO users (nama, email, password, no_telepon, status, role) VALUES ('$nama', '$email', '$hashed_password', '$telepon', '$status', '$role')";
if (mysqli_query($koneksi, $query)) {
    echo json_encode(['success' => true, 'message' => 'Donatur berhasil ditambahkan!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal menambahkan donatur.']);
}
