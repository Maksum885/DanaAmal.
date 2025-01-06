<?php
// Memulai session dan menghubungkan ke database
include 'koneksi.php';

// Query untuk mengambil semua kategori donasi dari database
$query = "SELECT id, nama FROM kategori_donasi";
$result = $koneksi->query($query);

// Memeriksa apakah ada data yang ditemukan
if ($result->num_rows > 0) {
    // Membuat array untuk menyimpan kategori
    $kategori = [];

    // Menyimpan setiap kategori ke dalam array
    while ($row = $result->fetch_assoc()) {
        $kategori[] = [
            'id' => $row['id'],
            'nama' => $row['nama']
        ];
    }

    // Mengirimkan hasil dalam format JSON
    echo json_encode($kategori);
} else {
    // Mengirimkan array kosong jika tidak ada kategori ditemukan
    echo json_encode([]);
}

// Menutup koneksi database
$koneksi->close();
