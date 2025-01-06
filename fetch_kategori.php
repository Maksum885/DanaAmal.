<?php
header('Content-Type: application/json');
include 'koneksi.php'; // File koneksi database

$sql = "SELECT * FROM kategori_donasi";
$result = $koneksi->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
