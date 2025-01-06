<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'Admin') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kelola donatur</title>
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
                <div class="navbar mb-4">
                    <h4>Kelola Donatur</h4>
                </div>
                <div class="container mt-4">
                    <!-- Daftar Donatur -->
                    <div class="card">
                        <div class="card-header">
                            <strong>Daftar Donatur</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Donatur</th>
                                        <th>Email</th>
                                        <th>Nomor Telepon</th>
                                        <th>Total Donasi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- Tambahkan lebih banyak data -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit Donatur -->
                <div class="modal fade" id="modalEditDonatur" tabindex="-1" aria-labelledby="modalEditDonaturLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditDonaturLabel">Edit Donatur</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="editNamaDonatur" class="form-label">Nama Donatur</label>
                                        <input type="text" class="form-control" id="editNamaDonatur" value="">
                                        <input type="hidden" class="form-control" id="editIdDonatur" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEmailDonatur" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="editEmailDonatur" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editTeleponDonatur" class="form-label">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="editTeleponDonatur" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editStatusDonatur" class="form-label">Status</label>
                                        <select class="form-select" id="editStatusDonatur">
                                            <option value="aktif" selected>Aktif</option>
                                            <option value="nonaktif">Nonaktif</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Hapus Donatur -->
                <div class="modal fade" id="modalHapusDonatur" tabindex="-1" aria-labelledby="modalHapusDonaturLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalHapusDonaturLabel">Hapus Donatur</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin menghapus donatur ini?</p>
                                <button type="button" class="btn btn-danger">Hapus</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('fetch_donatur.php')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.querySelector('table tbody');
                    tbody.innerHTML = ''; // Kosongkan tabel sebelum menambahkan data
                    data.forEach((donatur, index) => {
                        tbody.innerHTML += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${donatur.nama}</td>
                                <td>${donatur.email}</td>
                                <td>${donatur.no_telepon ?? "-"}</td>
                                <td>Rp ${parseFloat(donatur.total_donasi).toLocaleString()}</td>
                                <td>
                                    <span class="badge bg-${donatur.status === 'aktif' ? 'success' : 'warning'}">
                                        ${donatur.status}
                                    </span>
                                </td>
                                <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditDonatur" onclick="editDonatur(${donatur.id}, '${donatur.nama}', '${donatur.email}', '${donatur.no_telepon}', '${donatur.status}')"><i class="fas fa-edit"></i></button>

                                    <button class="btn btn-danger btn-sm" onclick="deleteDonatur(${donatur.id})"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        `;
                    });
                });
        });

        // Edit Donatur
        document.querySelector('#modalEditDonatur form').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.querySelector('#editIdDonatur').value; // ID Donatur, ganti sesuai kebutuhan
            const nama = document.querySelector('#editNamaDonatur').value;
            const email = document.querySelector('#editEmailDonatur').value;
            const telepon = document.querySelector('#editTeleponDonatur').value;
            const status = document.querySelector('#editStatusDonatur').value;


            fetch('edit_donatur.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id,
                        nama,
                        email,
                        telepon,
                        status
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Berhasil!', data.message, 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Gagal!', data.message, 'error');
                    }
                });
        });

        function editDonatur(id, nama, email, telepon, status, total_donasi) {
            // Set nilai pada form input modal edit
            document.querySelector('#editIdDonatur').value = id;
            document.querySelector('#editNamaDonatur').value = nama;
            document.querySelector('#editEmailDonatur').value = email;
            document.querySelector('#editTeleponDonatur').value = telepon;
            document.querySelector('#editStatusDonatur').value = status;
        }


        // Hapus Donatur
        function deleteDonatur(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data tidak dapat dikembalikan setelah dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('delete_donatur.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Berhasil!', data.message, 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Gagal!', data.message, 'error');
                            }
                        });
                }
            });
        }
    </script>


</body>

</html>