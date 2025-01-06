<?php
// Mengambil id_donasi dari URL
if (isset($_GET['id_donasi'])) {
    $id_donasi = $_GET['id_donasi'];
} else {
    echo "ID donasi tidak ditemukan.";
    exit;
}
?>
<?php
// Pastikan koneksi sudah dibuka
require_once 'koneksi.php';  // Ganti dengan file koneksi Anda

// Ambil id_donasi dari URL
if (isset($_GET['id_donasi'])) {
    $id_donasi = $_GET['id_donasi'];
} else {
    echo "ID donasi tidak ditemukan.";
    exit;
}

// Query untuk mengambil data donasi berdasarkan id_donasi
$query = "SELECT * FROM donatur WHERE id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_donasi);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Ambil data yang diperlukan
    $nominal = $row['donasi']; // Nominal donasi
    $metode = 'QRIS';  // Anda bisa mengubahnya jika ada kolom metode pembayaran
    $status = $row['status']; // Misalnya kolom status untuk menyimpan status pembayaran
    $tanggal = $row['created_at']; // Tanggal donasi (sesuaikan dengan nama kolom di database)
} else {
    echo "Donasi tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status</title>
    <!-- logo shortcut -->
    <link rel="shortcut icon" href="logodanaamal.png" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="donasi.css" />
    <style>
        .pending {
            background-color: orange;
            color: white;
        }

        .completed {
            background-color: green;
            color: white;
        }

        .back {
            color: black;
        }
    </style>
</head>

<body>
    <div class="container">
        <!--navbar-->
        <div class="navbar">
            <div class="logo">
                <img src="logodanaamal.png" alt="Logo" />
            </div>
        </div>
        <div class="waitpay">
            <h2>Menunggu Pembayaran</h2>
            <p>Segera melakukan pembayaran sebelum</p>
            <span>18 Desember 2024 15:33 WIB</span>
            <div class="spesifikasi" style="margin-bottom: 10px">
                <div class="tgl">
                    <p>Tanggal</p>
                    <span><?= date('d F Y - H:i', strtotime($tanggal)) ?></span>
                </div>
                <div class="metod">
                    <p>Metode Pembayaran</p>
                    <span><?= $metode ?></span>
                </div>
                <div class="noda">
                    <p>Nominal Donasi</p>
                    <span>Rp <?= number_format($nominal, 0, ',', '.') ?></span>
                </div>
                <div class="status">
                    <p>Status</p>
                    <button class="<?= $status == 'pending' ? 'pending' : 'completed' ?>"><?= ucfirst($status) ?></button>
                </div>
            </div>
            <a href="menu.php#donasi" class="back"><i class="fa-solid fa-backward"></i>Kembali</a>

        </div>
    </div>
</body>

</html>