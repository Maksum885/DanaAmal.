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
    <title>kategori donasi</title>
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
                    <h4>Kelola Kategori Donasi</h4>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                        <i class="fas fa-plus "></i> Tambah Kategori
                    </button>
                </div>
                <div class="container mt-4">
                    <!-- Daftar Kategori Donasi -->
                    <div class="card">
                        <div class="card-header">
                            <strong>Daftar Kategori Donasi</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Deskripsi</th>
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

                <!-- Modal Tambah Kategori -->
                <div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="modalTambahKategoriLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTambahKategoriLabel">Tambah Kategori Donasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="namaKategori" class="form-label">Nama Kategori</label>
                                        <input type="text" class="form-control" id="namaKategori" placeholder="Masukkan nama kategori">
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsiKategori" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" id="deskripsiKategori" rows="3" placeholder="Masukkan deskripsi kategori"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit Kategori -->
                <div class="modal fade" id="modalEditKategori" tabindex="-1" aria-labelledby="modalEditKategoriLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditKategoriLabel">Edit Kategori Donasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="editNamaKategori" class="form-label">Nama Kategori</label>
                                        <input type="text" class="form-control" id="editNamaKategori" value="">
                                        <input type="hidden" class="form-control" id="editIdKategori" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editDeskripsiKategori" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" id="editDeskripsiKategori" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Hapus Kategori -->
                <div class="modal fade" id="modalHapusKategori" tabindex="-1" aria-labelledby="modalHapusKategoriLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalHapusKategoriLabel">Hapus Kategori Donasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin menghapus kategori ini?</p>
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
            fetch('fetch_kategori.php')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.querySelector('table tbody');
                    tbody.innerHTML = ''; // Kosongkan tabel sebelum menambahkan data
                    data.forEach((kategori, index) => {
                        tbody.innerHTML += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${kategori.nama}</td>
                                <td>${kategori.deskripsi}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditKategori" onclick="editKategori(${kategori.id}, '${kategori.nama}', '${encodeURIComponent(kategori.deskripsi)}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteKategori(${kategori.id})"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        `;
                    });
                });
        });


        // Tambah Kategori
        document.querySelector('#modalTambahKategori form').addEventListener('submit', function(e) {
            e.preventDefault();
            const nama = document.querySelector('#namaKategori').value;
            const deskripsi = document.querySelector('#deskripsiKategori').value;

            fetch('add_kategori.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        nama,
                        deskripsi
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

        // Edit Kategori
        document.querySelector('#modalEditKategori form').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.querySelector('#editIdKategori').value; // ID Kategori, ganti sesuai kebutuhan
            const nama = document.querySelector('#editNamaKategori').value;
            const deskripsi = document.querySelector('#editDeskripsiKategori').value;


            fetch('edit_kategori.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id,
                        nama,
                        deskripsi
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

        function editKategori(id, nama, deskripsi) {
            deskripsi = decodeURIComponent(deskripsi);
            // Set nilai pada form input modal edit
            document.querySelector('#editIdKategori').value = id;
            document.querySelector('#editNamaKategori').value = nama;
            document.querySelector('#editDeskripsiKategori').value = deskripsi;
        }


        // Hapus Kategori
        function deleteKategori(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data tidak dapat dikembalikan setelah dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('delete_kategori.php', {
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