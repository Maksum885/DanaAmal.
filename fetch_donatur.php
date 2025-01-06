<?php
session_start(); // Memulai sesi
header('Content-Type: application/json');
include 'koneksi.php'; // File koneksi database

if (!isset($_SESSION['id'])) {
    die("User tidak terautentikasi."); // Atau redirect ke halaman login
}


// Query untuk menampilkan donatur berdasarkan donasi yang dibuat user login
$sql = "
    SELECT 
    users.*,
    IFNULL(SUM(donatur.donasi), 0) AS total_donasi
FROM 
    users
LEFT JOIN 
    donatur ON users.id = donatur.id_user
WHERE 
    users.role = 'Donatur'
GROUP BY 
    users.id
ORDER BY 
    total_donasi DESC; 


";
$stmt = $koneksi->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
