<?php
// Koneksi ke database
session_start();
include 'koneksi.php';

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'Admin') {
    header('Location: login.php');
    exit;
}

$query = "
    SELECT 
        d.nama_program AS program_donasi,
        IFNULL(SUM(do.donasi), 0) AS donasi_terkumpul,
        IFNULL(COUNT(do.id), 0) AS jumlah_donatur
    FROM 
        donasi d
    LEFT JOIN 
        donatur do ON d.id = do.id_donasi
    WHERE 
        d.status = 'Aktif'
    GROUP BY 
        d.id;

";

$dashboard = mysqli_query($koneksi, $query);

// Proses unggah gambar slider
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['sliderImage'])) {
    $id_user =  $_SESSION['id']; // Ganti dengan ID user (misalnya dari session login)
    $upload_dir = "assets/img/slider/"; // Direktori untuk menyimpan file
    $file_name = time() . "_" . basename($_FILES['sliderImage']['name']); // Nama unik dengan timestamp
    $target_file = $upload_dir . $file_name;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi file
    if (in_array($file_type, ['jpg', 'jpeg', 'png', 'gif'])) {
        if (move_uploaded_file($_FILES['sliderImage']['tmp_name'], $target_file)) {
            // Simpan data ke database
            $query = "INSERT INTO slider (link_gambar, id_user) VALUES ('$target_file', '$id_user')";
            if (mysqli_query($koneksi, $query)) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Gambar slider berhasil diunggah.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = 'admindanaamal.php'; // Ganti dengan file Anda
                            });
                        });
                      </script>";
            } else {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Gagal menyimpan data ke database.',
                                confirmButtonText: 'OK'
                            });
                        });
                      </script>";
            }
        } else {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Gagal mengunggah file.',
                            confirmButtonText: 'OK'
                        });
                    });
                  </script>";
        }
    } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'warning',
                        title: 'File Tidak Valid!',
                        text: 'Hanya file dengan format JPG, JPEG, PNG, dan GIF yang diperbolehkan.',
                        confirmButtonText: 'OK'
                    });
                });
              </script>";
    }
}

// Proses hapus gambar slider
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $query = "SELECT link_gambar FROM slider WHERE id = '$delete_id'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $file_path = $row['link_gambar'];

        if (unlink($file_path)) { // Hapus file dari folder
            $delete_query = "DELETE FROM slider WHERE id = '$delete_id'";
            if (mysqli_query($koneksi, $delete_query)) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Gambar slider berhasil dihapus.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = 'admindanaamal.php'; // Ganti dengan file Anda
                            });
                        });
                      </script>";
            } else {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Gagal menghapus data dari database.',
                                confirmButtonText: 'OK'
                            });
                        });
                      </script>";
            }
        } else {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Gagal menghapus file.',
                            confirmButtonText: 'OK'
                        });
                    });
                  </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dana Amal</title>
    <!-- logo shortcut -->
    <link rel="shortcut icon" href="logodanaamal.png" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .card-stat {
            border-radius: 10px;
            background-color: mediumseagreen;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .card-stat h4 {
            font-size: 2rem;
        }

        .table img {
            width: 50px;
            height: auto;
            border-radius: 5px;
        }

        .modal-header {
            background-color: mediumseagreen;
            color: white;
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
                <div class="navbar mb-4">
                    <h4>Dasboard Admin Dana Amal</h4>
                </div>
                <!-- Slider Management -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Kelola Gambar Slider</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="sliderImage" class="form-label">Unggah Gambar Slider Baru</label>
                                <input type="file" class="form-control" id="sliderImage" name="sliderImage" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Unggah Gambar</button>
                        </form>
                        <div class="mt-4">
                            <h6>Gambar Slider Saat Ini</h6>
                            <div class="d-flex">
                                <?php
                                $query = "SELECT * FROM slider";
                                $result = mysqli_query($koneksi, $query);

                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<div class="me-2">
                                                <img src="' . $row['link_gambar'] . '" class="img-thumbnail" style="width: 150px; height: 80px; object-fit: cover;">
                                                <form method="POST" class="mt-2">
                                                    <input type="hidden" name="delete_id" value="' . $row['id'] . '">
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Statistik -->
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Dashboard</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Program Donasi</th>
                                    <th>Total Donasi Terkumpul</th>
                                    <th>Total Donatur</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($dashboard) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($dashboard)): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['program_donasi']); ?></td>
                                            <td><?= number_format($row['donasi_terkumpul'], 0, ',', '.'); ?></td>
                                            <td><?= htmlspecialchars($row['jumlah_donatur']); ?></td>
                                        </tr>

                                    <?php endwhile; ?>
                                    <tr>
                                        <td>
                                            <a href="keloladonasi.php" class="btn btn-warning btn-sm edit-btn">Edit</a>
                                        </td>
                                        <td>
                                            <a href="keloladonatur.php" class="btn btn-warning btn-sm edit-btn">Edit</a>

                                        </td>
                                        <td>
                                            <a href="keloladonatur.php" class="btn btn-warning btn-sm edit-btn">Edit</a>

                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data ditemukan.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

</body>

</html>