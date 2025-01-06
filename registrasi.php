<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userType = $_POST['userType'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $no_telepon = mysqli_real_escape_string($koneksi, $_POST['no_telepon']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = $_POST['password'];
    $konfirmasiPassword = $_POST['konfirmasiPassword'];

    // Validasi password
    if ($password !== $konfirmasiPassword) {
        echo "<script> alert ('Password dan konfirmasi password tidak sama!'); window.location='registrasi.php'; </script>";
        exit;
    }

    // Enkripsi password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Periksa apakah email sudah terdaftar
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($koneksi, $checkEmailQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email sudah terdaftar!'); window.location='registrasi.php';</script>";
        exit;
    }

    // Simpan ke database
    $sql = "INSERT INTO users (nama, no_telepon, email, password, role, status) VALUES ('$nama', '$no_telepon', '$email', '$hashedPassword', '$userType', 'aktif')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Registrasi berhasil!'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . mysqli_error($koneksi) . "'); window.location='registrasi.php';</script>";
    }

    mysqli_close($koneksi);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dana Amal - Registrasi</title>

    <!-- logo shortcut -->
    <link rel="shortcut icon" href="logodanaamal.png" />
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.3)),
                url("bglogin.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-color: #d3d3d3;
        }

        select,
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .registrasi-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .registrasi-form {
            text-align: center;
        }

        .logo {
            width: 100px;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-group input {
            padding-right: 40px;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            cursor: pointer;
            background: none;
            border: none;
            font-size: 18px;
            color: #333;
        }

        .daftar-button {
            background-color: #0056b3;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .daftar-button:hover {
            background-color: #003d80;
        }
    </style>
</head>

<body>
    <div class="registrasi-container">
        <div class="registrasi-form">
            <img src="logodanaamal.png" class="logo" />
            <form id="form-group" action="registrasi.php" method="POST">
                <div class="input-group">
                    <input type="text" id="nama" name="nama" placeholder="Nama Lengkap" required />
                </div>
                <div class="input-group">
                    <input type="text" id="no_telepon" name="no_telepon" placeholder="Nomor Telepon" required />
                </div>
                <div class="input-group">
                    <select id="userType" name="userType" required>
                        <option value="" disabled selected>Pilih Jenis User</option>
                        <!-- <option value="Admin">Admin</option> -->
                        <option value="Donatur">Donatur</option>
                    </select>
                </div>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Email" required />
                </div>
                <div class="input-group">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Password"
                        required />
                    <span class="toggle-password"><i class="fa-regular fa-eye"></i></span>
                </div>
                <div class="input-group">
                    <input
                        type="password"
                        id="konfirmasiPassword"
                        name="konfirmasiPassword"
                        placeholder="Konfirmasi Password"
                        required />
                    <span class="toggle-password"><i class="fa-regular fa-eye"></i></span>
                </div>

                <button type="submit" name="register" class="daftar-button">Daftar</button>
            </form>
        </div>
    </div>

    <script>
        // JavaScript untuk toggle password
        document.querySelectorAll('.toggle-password').forEach(item => {
            item.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);

                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>

</html>