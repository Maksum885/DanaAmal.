<?php
// Include file koneksi
require 'koneksi.php';
session_start();

// Cek jika user sudah login dan memiliki role yang sesuai
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'Admin') {
    header('Location: login.php');
    exit;
}

// Pastikan pustaka FPDF sudah di-include



// Ambil data filter dari form
$tanggalMulai = isset($_POST['filterTanggalMulai']) ? $_POST['filterTanggalMulai'] : '';
$tanggalSelesai = isset($_POST['filterTanggalSelesai']) ? $_POST['filterTanggalSelesai'] : '';
$kategori = isset($_POST['filterKategori']) ? $_POST['filterKategori'] : '';

// Buat query SQL berdasarkan filter
$sql = "SELECT d.tgl_mulai, d.tgl_batas, d.nama_program, 
        k.nama AS kategori_nama, 
        SUM(dt.donasi) AS total_donasi, 
        COUNT(dt.id) AS jumlah_donatur
    FROM donasi d
    LEFT JOIN donatur dt ON d.id = dt.id_donasi
    LEFT JOIN kategori_donasi k ON d.kategori_id = k.id
    WHERE 1=1 "; // Gunakan kondisi umum 1=1 yang memudahkan penambahan kondisi dinamis

if ($tanggalMulai) {
    $sql .= " AND d.tgl_mulai >= '$tanggalMulai'";
}

if ($tanggalSelesai) {
    $sql .= " AND d.tgl_batas <= '$tanggalSelesai'";
}

if ($kategori) {
    $sql .= " AND k.nama = '$kategori'";
}

$sql .= " GROUP BY d.id ORDER BY d.tgl_batas DESC";

$query = mysqli_query($koneksi, $sql);

if (!$query) {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>

<?php
require('vendor/fpdf/fpdf.php');

if (isset($_POST['formatLaporan']) && $_POST['formatLaporan'] == 'pdf') {

    // Buat instance FPDF dengan orientasi landscape
    $pdf = new FPDF('L', 'mm', 'A4'); // 'L' untuk landscape
    $pdf->AddPage();

    // Set font untuk judul
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Laporan Donasi', 0, 1, 'C');

    // Set font untuk tabel
    $pdf->SetFont('Arial', '', 10);

    // Data header
    $header = ['No', 'Tgl Mulai', 'Tgl Selesai', 'Nama Donasi', 'Kategori', 'Total Donasi', 'Jumlah Donatur'];

    // Menentukan lebar kolom dengan ukuran yang lebih seimbang
    $widths = [20, 30, 30, 50, 30, 40, 30];  // Menetapkan lebar kolom yang konsisten

    // Menambahkan header tabel
    foreach ($header as $i => $col) {
        $pdf->Cell($widths[$i], 10, $col, 1, 0, 'C'); // Header center align
    }
    $pdf->Ln();

    // Menambahkan data laporan
    $no = 1;
    while ($row = mysqli_fetch_assoc($query)) {
        // Data baris
        $data = [
            $no,
            $row['tgl_mulai'],
            $row['tgl_batas'],
            $row['nama_program'],
            $row['kategori_nama'],
            $row['total_donasi'] ?? 0,
            $row['jumlah_donatur'] ?? 0,
        ];

        // Menambahkan data ke tabel dengan lebar kolom yang konsisten
        foreach ($data as $i => $cell) {
            // Menyesuaikan lebar kolom agar tidak terlalu sempit
            $pdf->Cell($widths[$i], 10, $cell, 1, 0, 'C');
        }
        $pdf->Ln();
        $no++;
    }

    // Output PDF
    $pdf->Output('D', 'laporan_donasi.pdf'); // Mengunduh file PDF
    exit;
}


// Include file autoloader PhpSpreadsheet
require 'vendor/autoload.php'; // pastikan autoload PHP Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['formatLaporan']) && $_POST['formatLaporan'] == 'excel') {

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header kolom
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Tgl Mulai');
    $sheet->setCellValue('C1', 'Tgl Selesai');
    $sheet->setCellValue('D1', 'Nama Donasi');
    $sheet->setCellValue('E1', 'Kategori');
    $sheet->setCellValue('F1', 'Total Donasi');
    $sheet->setCellValue('G1', 'Jumlah Donatur');

    // Data laporan
    $rowNum = 2;
    $no = 1;
    while ($row = mysqli_fetch_assoc($query)) {
        $sheet->setCellValue('A' . $rowNum, $no);
        $sheet->setCellValue('B' . $rowNum, $row['tgl_mulai']);
        $sheet->setCellValue('C' . $rowNum, $row['tgl_batas']);
        $sheet->setCellValue('D' . $rowNum, $row['nama_program']);
        $sheet->setCellValue('E' . $rowNum, $row['kategori_nama']);
        $sheet->setCellValue('F' . $rowNum, $row['total_donasi']);
        $sheet->setCellValue('G' . $rowNum, $row['jumlah_donatur']);
        $rowNum++;
        $no++;
    }

    // Menghasilkan file Excel
    $writer = new Xlsx($spreadsheet);
    $fileName = 'laporan_donasi.xlsx';

    // Set headers untuk mengunduh file Excel
    ob_end_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="laporan_donasi.xlsx"');
    header('Cache-Control: max-age=0');


    // Simpan file Excel ke output browser
    $writer->save('php://output');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laporan</title>
    <!-- logo shortcut -->
    <link rel="shortcut icon" href="logodanaamal.png" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: mediumseagreen;
            min-height: 100vh;
            color: white;
        }

        .sidebar .img-fluid {
            width: 100px;
            height: auto;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            border: 1px solid #222;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link {
            color: white;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: seagreen;
            border-radius: 5px;
        }

        .sidebar .nav-link i {
            margin-right: 12px;
        }

        .navbar {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar h4 {
            margin: 0;
            padding: 5px;
        }

        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-3 sidebar">
                <div class="d-flex flex-column">
                    <a class="navbar-brand p-3 text-center">
                        <img src="logodanaamal.png" alt="Logo" class="img-fluid">
                    </a>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="admindanaamal.php"><i class="fas fa-chart-line"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="keloladonasi.php"><i class="fas fa-hand-holding-heart"></i> Kelola Donasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="keloladonatur.php"><i class="fas fa-users"></i> Kelola Donatur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="kategoridonasi.php"><i class="fas fa-list"></i> Kategori Donasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="laporan.php"><i class="fas fa-file-alt"></i> Laporan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt" style="transform: scaleX(-1);"></i> Keluar</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <!-- Navbar -->
                <div class="container mt-4">
                    <h4>Laporan Donasi</h4>
                    <button class="btn btn-primary" id="btnUnduhLaporan" data-bs-toggle="modal" data-bs-target="#modalUnduhLaporan">
                        <i class="fas fa-download"></i> Unduh Laporan
                    </button>

                    <div class="card mt-4">
                        <div class="card-header">
                            <strong>Filter Laporan</strong>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="laporan.php">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="filterTanggalMulai" class="form-label">Tanggal Mulai</label>
                                        <input type="date" class="form-control" name="filterTanggalMulai" id="filterTanggalMulai" value="<?php echo $tanggalMulai; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="filterTanggalSelesai" class="form-label">Tanggal Selesai</label>
                                        <input type="date" class="form-control" name="filterTanggalSelesai" id="filterTanggalSelesai" value="<?php echo $tanggalSelesai; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="filterKategori" class="form-label">Kategori Donasi</label>

                                        <?php
                                        $kueri = "SELECT * FROM kategori_donasi";
                                        $result = mysqli_query($koneksi, $kueri);

                                        // Memeriksa apakah hasil query adalah objek mysqli_result
                                        if ($result) {
                                            echo '<select class="form-control" name="filterKategori" id="filterKategori">';
                                            echo '<option value="">Semua Kategori</option>';

                                            while ($row = mysqli_fetch_assoc($result)) {
                                                // Memastikan nama kategori yang dipilih tetap terpilih
                                                $selected = ($kategori == $row['nama']) ? 'selected' : '';
                                                echo "<option value=\"{$row['nama']}\" $selected>{$row['nama']}</option>";
                                            }

                                            echo '</select>';
                                        } else {
                                            // Menampilkan error jika query gagal
                                            echo 'Gagal mengambil data kategori: ' . mysqli_error($koneksi);
                                        }
                                        ?>

                                    </div>

                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success" id="btnTerapkanFilter">
                                        Terapkan Filter
                                    </button>
                                    <a href="laporan.php" class="btn btn-secondary" id="btnResetFilter">
                                        Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Laporan -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <strong>Hasil Laporan</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="tabelLaporan">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Mulai</th>
                                        <th>Tgl Selesai</th>
                                        <th>Nama Donasi</th>
                                        <th>Kategori</th>
                                        <th>Total Donasi</th>
                                        <th>Jumlah Donatur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        echo "<tr>
                                    <td>{$no}</td>
                                    <td>{$row['tgl_mulai']}</td>
                                    <td>{$row['tgl_batas']}</td>
                                    <td>{$row['nama_program']}</td>
                                    <td>{$row['kategori_nama']}</td>
                                    <td>" . ($row['total_donasi'] ? $row['total_donasi'] : '0') . "</td>
                                    <td>{$row['jumlah_donatur']}</td>
                                </tr>";
                                        $no++;
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal Unduh Laporan -->
                <!-- Modal Unduh Laporan -->
                <div class="modal fade" id="modalUnduhLaporan" tabindex="-1" aria-labelledby="modalUnduhLaporanLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="laporan.php">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalUnduhLaporanLabel">Unduh Laporan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda ingin mengunduh laporan dalam format berikut?</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="formatLaporan" id="formatPDF" value="pdf" checked>
                                        <label class="form-check-label" for="formatPDF">
                                            PDF
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="formatLaporan" id="formatExcel" value="excel">
                                        <label class="form-check-label" for="formatExcel">
                                            Excel
                                        </label>
                                    </div>

                                    <!-- Input Tersembunyi untuk Filter -->
                                    <input type="hidden" name="filterTanggalMulai" value="<?php echo $tanggalMulai; ?>">
                                    <input type="hidden" name="filterTanggalSelesai" value="<?php echo $tanggalSelesai; ?>">
                                    <input type="hidden" name="filterKategori" value="<?php echo $kategori; ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Unduh</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>


                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<?php
// Tutup koneksi database
mysqli_close($koneksi);
?>