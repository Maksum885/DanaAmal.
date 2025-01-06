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
    <title>kelola donasi</title>
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
                    <h4>Kelola Donasi</h4>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahDonasi">
                        <i class="fas fa-plus "></i> Tambah Program Donasi
                    </button>
                </div>
                <!-- Daftar Donasi -->
                <div class="card">
                    <div class="card-header">

                        <strong>Daftar Program Donasi</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama Program</th>
                                    <th>Kategori</th>
                                    <th>Target Donasi</th>
                                    <th>Terkumpul</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data Program Donasi akan ditambahkan melalui JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Modal Tambah Donasi -->
                <div class="modal fade" id="modalTambahDonasi" tabindex="-1" aria-labelledby="modalTambahDonasiLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTambahDonasiLabel">Tambah Program Donasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" enctype="multipart/form-data" id="formTambahDonasi">
                                    <div class="mb-3">
                                        <label for="namaProgram" class="form-label">Nama Program</label>

                                        <input type="text" class="form-control" id="namaProgram" name="nama_program" placeholder="Masukkan nama program" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategoriProgram" class="form-label">Kategori</label>
                                        <select class="form-select" id="kategoriProgram" name="kategori_id" required>
                                            <option value="" disabled selected>Pilih kategori</option>
                                            <?php
                                            include 'koneksi.php';
                                            $result = $koneksi->query("SELECT id, nama FROM kategori_donasi");
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='{$row['id']}'>{$row['nama']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="targetDonasi" class="form-label">Target Donasi</label>
                                        <input type="number" class="form-control" id="targetDonasi" name="target_donasi" placeholder="Masukkan target donasi" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggalMulai" class="form-label">Tanggal Mulai Open Donasi</label>
                                        <input type="date" class="form-control" id="tanggalMulai" name="tgl_mulai" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggalBatas" class="form-label">Tanggal Batas Open Donasi</label>
                                        <input type="date" class="form-control" id="tanggalBatas" name="tgl_batas" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="deskripsiProgram" class="form-label">Deskripsi Program</label>
                                        <textarea class="form-control" id="deskripsiProgram" name="deskripsi" rows="3" placeholder="Masukkan deskripsi program"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gambarProgram" class="form-label">Upload Gambar</label>
                                        <input type="file" class="form-control" id="gambarProgram" name="gambar" accept="image/*" required>
                                        <div id="gambarPreview" style="margin-top: 10px;"></div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit Donasi -->
                <div class="modal fade" id="modalEditDonasi" tabindex="-1" aria-labelledby="modalEditDonasiLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditDonasiLabel">Edit Program Donasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" enctype="multipart/form-data" id="formEditDonasi">
                                    <div class="mb-3">
                                        <label for="editNamaProgram" class="form-label">Nama Program</label>
                                        <input type="text" class="form-control" id="editNamaProgram" name="nama_program" placeholder="Masukkan nama program" required>
                                        <input type="hidden" id="editIdDonasi" name="id_donasi">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editKategoriProgram" class="form-label">Kategori</label>
                                        <select class="form-select" id="editKategoriProgram" name="kategori_id" required>
                                            <option value="" disabled selected>Pilih kategori</option>
                                            <?php
                                            include 'koneksi.php';
                                            $result = $koneksi->query("SELECT id, nama FROM kategori_donasi");
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='{$row['id']}'>{$row['nama']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editTargetDonasi" class="form-label">Target Donasi</label>
                                        <input type="number" class="form-control" id="editTargetDonasi" name="target_donasi" placeholder="Masukkan target donasi" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editTanggalMulai" class="form-label">Tanggal Mulai Open Donasi</label>
                                        <input type="date" class="form-control" id="editTanggalMulai" name="tgl_mulai" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editTanggalBatas" class="form-label">Tanggal Batas Open Donasi</label>
                                        <input type="date" class="form-control" id="editTanggalBatas" name="tgl_batas" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editDeskripsiProgram" class="form-label">Deskripsi Program</label>
                                        <textarea class="form-control" id="editDeskripsiProgram" name="deskripsi" rows="3" placeholder="Masukkan deskripsi program"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editStatusProgram" class="form-label">Status Program</label>
                                        <select class="form-select" id="editStatusProgram" name="status" required>
                                            <option value="Aktif">Aktif</option>
                                            <option value="Selesai">Selesai</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editGambarProgram" class="form-label">Upload Gambar</label>
                                        <input type="file" class="form-control" id="editGambarProgram" name="gambar" accept="image/*">
                                        <input type="hidden" class="form-control" id="editGambarLama" name="gambar_lama" accept="image/*">
                                        <img id="editGambarPreview" style="margin-top: 10px; width:100%">
                                    </div>
                                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal Hapus Donasi -->
                <div class="modal fade" id="modalHapusDonasi" tabindex="-1" aria-labelledby="modalHapusDonasiLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalHapusDonasiLabel">Hapus Program Donasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin menghapus program donasi ini?</p>
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
            fetch('fetch_donasi.php')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.querySelector('table tbody');
                    tbody.innerHTML = ''; // Kosongkan tabel sebelum menambahkan data
                    data.forEach((donasi, index) => {
                        tbody.innerHTML += `
                            <tr>
                                <td>${donasi.id}</td>
                                <td><img src="assets/img/donasi/${donasi.gambar}" alt="Program" width="50"></td>
                                <td>${donasi.nama_program}</td>
                                <td>${donasi.kategori_nama}</td>
                                <td>Rp ${new Intl.NumberFormat('id-ID').format(donasi.target_donasi)}</td>
                                <td>Rp ${new Intl.NumberFormat('id-ID').format(donasi.terkumpul)}</td>
                                <td><span class="badge bg-${donasi.status === 'Aktif' ? 'success' : 'warning'}">${donasi.status}</span></td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditDonasi" 
                                        onclick="editDonasi(${donasi.id}, '${donasi.nama_program}', '${donasi.kategori_id}', '${donasi.target_donasi}', '${donasi.deskripsi}', '${donasi.gambar}', '${donasi.status}', '${donasi.tgl_batas}', '${donasi.tgl_mulai}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                   <button class="btn btn-danger btn-sm" onclick="deleteDonasi(${donasi.id})"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        `;
                    });
                })
                .catch(error => console.error('Error:', error));

            document.getElementById('formTambahDonasi').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch('add_donasi.php', {
                        method: 'POST',
                        body: formData
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
        });

        document.getElementById('formEditDonasi').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            console.log(...formData); // Debug isi FormData

            const donasiId = document.querySelector('#editIdDonasi').value;
            formData.append('id', donasiId); // Tambahkan ID secara eksplisit

            fetch('edit_donasi.php', {
                    method: 'POST',
                    body: formData
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


        function editDonasi(id, nama_program, kategori_id, target_donasi, deskripsi, gambar, status, tgl_batas, tgl_mulai) {
            // Set nilai pada form input modal edit
            console.log(id, nama_program, kategori_id, target_donasi, deskripsi, gambar, status, tgl_batas);
            document.querySelector('#editNamaProgram').value = nama_program;
            document.querySelector('#editTargetDonasi').value = target_donasi;
            document.querySelector('#editDeskripsiProgram').value = deskripsi;
            document.querySelector('#editIdDonasi').value = id;
            document.querySelector('#editTanggalMulai').value = tgl_mulai;
            document.querySelector('#editTanggalBatas').value = tgl_batas;
            document.querySelector('#editStatusProgram').value = status


            // Menyimpan gambar lama ke dalam form
            document.querySelector('#editGambarProgram').value = ''; // Kosongkan input gambar (user bisa memilih gambar baru)
            document.querySelector('#editGambarLama').value = gambar; // Menyimpan gambar lama yang ada

            const imagePreview = document.querySelector('#editGambarPreview');
            if (imagePreview) {
                imagePreview.src = `assets/img/donasi/${gambar}`;
                imagePreview.style.display = 'block'; // Menampilkan gambar lama jika ada
            }

            // Mengisi kategori dropdown
            fetch('get_kategori_donasi.php')
                .then(response => response.json())
                .then(kategori => {
                    const select = document.getElementById('editKategoriProgram');
                    select.innerHTML = ''; // Reset the options
                    kategori.forEach(cat => {
                        select.innerHTML += `<option value="${cat.id}" ${cat.id == kategori_id ? 'selected' : ''}>${cat.nama}</option>`;
                    });
                })
                .catch(error => console.error('Error fetching categories:', error));
        }



        function deleteDonasi(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data tidak dapat dikembalikan setelah dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('delete_donasi.php', {
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