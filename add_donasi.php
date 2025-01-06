<?php
// Koneksi ke database
include 'koneksi.php';

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menangkap data dari form
    $nama_program = $_POST['nama_program'];
    $kategori_id = $_POST['kategori_id'];
    $target_donasi = $_POST['target_donasi'];
    $deskripsi = $_POST['deskripsi'];
    $tgl_mulai = $_POST['tgl_mulai']; // Menangkap tanggal mulai open donasi
    $tgl_batas = $_POST['tgl_batas']; // Menangkap tanggal batas open donasi
    $status = "Aktif";

    // Proses upload gambar
    $upload_dir = "assets/img/donasi/";
    $gambar = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $path = $upload_dir . basename($gambar);

    // Validasi gambar yang diupload
    if (move_uploaded_file($tmp_name, $path)) {
        // Query untuk menyimpan data donasi ke dalam database
        $stmt = $koneksi->prepare("INSERT INTO donasi (nama_program, kategori_id, target_donasi, deskripsi, gambar, status, tgl_batas, tgl_mulai) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        // Menyusun parameter untuk query, memastikan tipe data sesuai dengan yang diharapkan
        $stmt->bind_param("siisssss", $nama_program, $kategori_id, $target_donasi, $deskripsi, $gambar, $status, $tgl_batas, $tgl_mulai);

        // Mengeksekusi query
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Program donasi berhasil ditambahkan.';
        } else {
            $response['success'] = false;
            $response['message'] = 'Gagal menyimpan data: ' . $stmt->error;
        }

        $stmt->close();
    } else {
        $response['success'] = false;
        $response['message'] = 'Gambar gagal diupload.';
    }

    echo json_encode($response);
}
