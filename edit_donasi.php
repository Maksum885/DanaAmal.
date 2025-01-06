<?php
header('Content-Type: application/json');

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama_program = $_POST['nama_program'];
    $kategori_id = $_POST['kategori_id'];
    $target_donasi = $_POST['target_donasi'];
    $deskripsi = $_POST['deskripsi'];
    $tgl_batas = $_POST['tgl_batas'];
    $tgl_mulai = $_POST['tgl_mulai'];
    $status = $_POST['status'];
    $gambar_lama = $_POST['gambar_lama'];

    // Proses upload gambar jika ada
    // Proses upload gambar jika ada
    if ($_FILES['gambar']['error'] == 0) {
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "assets/img/donasi/";
        $target_file = $target_dir . basename($gambar);
        // Menghapus gambar lama jika ada
        if (file_exists($target_dir . $gambar_lama)) {
            unlink($target_dir . $gambar_lama);
        }
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            // Berhasil upload
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Upload gambar gagal']);
            exit;
        }
    } else {
        // Jika gambar baru tidak diupload, gunakan gambar lama yang sudah ada
        $gambar = $_POST['gambar_lama'];
    }

    // Update data di database
    $query = "UPDATE donasi SET nama_program = ?, kategori_id = ?, target_donasi = ?, deskripsi = ?, status = ?, tgl_batas = ?, tgl_mulai = ?, gambar = ? WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("siisssssi", $nama_program, $kategori_id, $target_donasi, $deskripsi, $status, $tgl_batas, $tgl_mulai, $gambar, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Donatur berhasil diperbarui!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal memperbarui donatur.']);
    }

    $stmt->close();
}
