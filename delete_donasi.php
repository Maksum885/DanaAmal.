<?php
header('Content-Type: application/json');
require 'koneksi.php'; // Ganti sesuai file koneksi Anda

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];

// Ambil nama file gambar berdasarkan ID
$query_select = "SELECT gambar FROM donasi WHERE id = $id";
$result_select = mysqli_query($koneksi, $query_select);

if ($result_select && mysqli_num_rows($result_select) > 0) {
    $row = mysqli_fetch_assoc($result_select);
    $gambar = $row['gambar'];

    // Hapus file gambar jika ada
    $file_path = "assets/img/donasi/$gambar"; // Pastikan path sesuai dengan lokasi file Anda
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    // Hapus data dari database
    $query_delete = "DELETE FROM donasi WHERE id = $id";
    if (mysqli_query($koneksi, $query_delete)) {
        echo json_encode(['success' => true, 'message' => 'Donasi berhasil dihapus!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menghapus donasi.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan.']);
}
