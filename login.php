<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userType = isset($_POST['userType']) ? $_POST['userType'] : null;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($koneksi, $_POST['email']) : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    // Validasi: Pastikan semua input diisi
    if (empty($userType) || empty($email) || empty($password)) {
        echo "<script>
                    alert('Semua kolom wajib diisi.');
                    window.location.href = 'landingpage.php';
                </script>";
        exit();
    }

    // Query untuk memeriksa user di database
    $sql = "SELECT * FROM users WHERE role = ? AND email = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ss", $userType, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Periksa status akun
        if ($row['status'] === 'nonaktif') {
            echo "<script>
                    alert('Akun Anda telah dinonaktifkan. Silakan hubungi admin.');
                    window.location.href = 'login.php';
                  </script>";
            exit();
        }

        // Periksa password
        if (password_verify($password, $row['password'])) {
            if (isset($row['id'])) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
            } else {
                echo "<script>alert('ID User tidak ditemukan.');</script>";
                exit();
            }
            if ($userType === "Admin") {
                header("Location: admindanaamal.php");
            } elseif ($userType === "Donatur") {
                header("Location: menu.php");
            }
            exit();
        } else {
            echo "<script>alert('Password salah.');</script>";
        }
    } else {
        echo "<script>alert('Email atau user tidak ditemukan.');</script>";
    }
    $stmt->close();
}
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dana Amal</title>

    <!-- logo shortcut -->
    <link rel="shortcut icon" href="logodanaamal.png" />
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .login-form {
            text-align: center;
        }

        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
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
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
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

        .login-button {
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

        .login-button:hover {
            background-color: #003d80;
        }

        .lupapw {
            margin-top: 15px;
            display: flex;
            justify-content: right;
        }

        .lupapw a {
            color: #0056b3;
            font-size: 14px;
            text-decoration: none;
        }

        .lupapw a:hover {
            text-decoration: underline;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .login-container {
                margin: 0 40px;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 0 40px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-form">
            <img src="logodanaamal.png" class="logo" />
            <form id="form-group" action="login.php" method="POST">
                <div class="input-group">
                    <select id="userType" name="userType">
                        <option value="" disabled selected>Pilih Jenis User</option>
                        <option value="Admin">Admin</option>
                        <option value="Donatur">Donatur</option>
                    </select>
                </div>

                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Email" />
                </div>

                <div class="input-group">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Password" />
                    <button type="button" class="toggle-password" id="togglePassword">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>
                <div class="lupapw" style="margin-bottom:20px">
                    <a href="lupapassword.php" class>Lupa password ?</a>
                </div>
                <button type="submit" class="login-button">Log in</button>
            </form>
        </div>
    </div>

    <script>
        // JavaScript untuk toggle password
        const togglePassword = document.getElementById("togglePassword");
        const passwordField = document.getElementById("password");

        togglePassword.addEventListener("click", function() {
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);

            const icon = this.querySelector("i");
            icon.classList.toggle("fa-eye");
            icon.classList.toggle("fa-eye-slash");
        });
    </script>
</body>

</html>