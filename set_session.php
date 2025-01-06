<?php
session_start(); // Memulai session

// Menyimpan data ke dalam session
$_SESSION['nama'] = 'admin';
$_SESSION['user_type'] = 'administrator';

echo "Session telah dibuat. <a href='get_session.php'>Lihat Session</a>";
