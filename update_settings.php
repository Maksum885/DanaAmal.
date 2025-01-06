<?php
session_start();
include 'koneksi.php';  // Pastikan koneksi database ada

// Pastikan pengguna sudah login
if (!isset($_SESSION['id'])) {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Harap login terlebih dahulu.',
                showConfirmButton: false,
                timer: 1500
            });
          </script>";
    exit;
}

// Ambil ID pengguna yang sedang login
$user_id = $_SESSION['id'];

// Ambil data yang dikirim dari form
$old_password = $_POST['old-password'] ?? '';
$new_password = $_POST['new-password'] ?? '';
$old_email = $_POST['old-email'] ?? '';
$new_email = $_POST['new-email'] ?? '';

// Cek jika pengguna ingin mengganti password
if ($new_password !== '' && $old_password !== '') {
    // Ambil password lama dari database
    $query = "SELECT password FROM users WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($stored_password);
    $stmt->fetch();

    // Verifikasi password lama
    if (password_verify($old_password, $stored_password)) {
        // Hash password baru
        $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);

        // Update password
        $update_query = "UPDATE users SET password = ? WHERE id = ?";
        $update_stmt = $koneksi->prepare($update_query);
        $update_stmt->bind_param("si", $new_password_hash, $user_id);
        if ($update_stmt->execute()) {
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Password berhasil diubah.'];
        } else {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Terjadi kesalahan dalam mengubah password.'];
        }
    } else {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Password lama salah.'];
    }
}

// Cek jika pengguna ingin mengganti email
if ($new_email !== '' && $old_email !== '') {
    // Ambil email lama dari database
    $query = "SELECT email FROM users WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($stored_email);
    $stmt->fetch();

    // Verifikasi email lama
    if ($old_email === $stored_email) {
        // Update email
        $update_query = "UPDATE users SET email = ? WHERE id = ?";
        $update_stmt = $koneksi->prepare($update_query);
        $update_stmt->bind_param("si", $new_email, $user_id);
        if ($update_stmt->execute()) {
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Email berhasil diubah.'];
        } else {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Terjadi kesalahan dalam mengubah email.'];
        }
    } else {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Email lama salah.'];
    }
}

// Redirect kembali ke menu.php setelah operasi selesai
header("Location: menu.php");
exit;
