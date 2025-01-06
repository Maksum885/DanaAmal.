<?php
session_start(); // Memulai sesi
header('Content-Type: application/json');
include 'koneksi.php'; // File koneksi database

// Pastikan session id pengguna telah diset
if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}


$sql = "
    SELECT 
        donasi.*, 
        kategori_donasi.nama AS kategori_nama,
        IFNULL(SUM(donatur.donasi), 0) AS terkumpul
    FROM 
        donasi
    JOIN 
        kategori_donasi ON donasi.kategori_id = kategori_donasi.id
    LEFT JOIN 
        donatur ON donasi.id = donatur.id_donasi
    GROUP BY 
        donasi.id
";


$stmt = $koneksi->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$stmt->close();
$koneksi->close();
