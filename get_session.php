<?php
session_start(); // Memulai session

// Memeriksa apakah session 'nama' tersedia
if (isset($_SESSION['nama'])) {
    echo "Nama: " . $_SESSION['nama'] . "<br>";
    echo "User_Type: " . $_SESSION['user_type'] . "<br>";
    echo "<a href='destroy_session.php'>Hapus Session</a>";
} else {
    echo "Session belum diset. <a href='set_session.php'>Set Session</a>";
}
