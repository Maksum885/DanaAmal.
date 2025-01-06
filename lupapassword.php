<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? mysqli_real_escape_string($koneksi, $_POST['email']) : null;

    // Validasi: Periksa apakah email diisi
    if (empty($email)) {
        echo "<script>
                alert('Email wajib diisi.');
                window.location.href = 'lupapassword.php';
              </script>";
        exit();
    }

    // Query untuk memeriksa apakah email ada di database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika email ditemukan, hapus akun dari database
        $deleteSql = "DELETE FROM users WHERE email = ?";
        $deleteStmt = $koneksi->prepare($deleteSql);
        $deleteStmt->bind_param("s", $email);
        if ($deleteStmt->execute()) {
            echo "<script>
                    alert('Akun Anda kami reset. Silakan melakukan pendaftaran ulang.');
                    window.location.href = 'registrasi.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Terjadi kesalahan saat mereset akun Anda. Silakan coba lagi.');
                    window.location.href = 'lupapassword.php';
                  </script>";
        }
        $deleteStmt->close();
    } else {
        // Jika email tidak ditemukan
        echo "<script>
                alert('Email tidak ditemukan dalam sistem.');
                window.location.href = 'lupapassword.php';
              </script>";
    }

    $stmt->close();
    $koneksi->close();
}
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
            <form method="POST" action="lupapassword.php">
                <div class="input-group">
                    <input type="email" name="email" id="email" required placeholder="Email Anda" />
                </div>
                <button class="login-button" type="submit">Kirim Link Reset</button>
            </form>
        </div>
</body>

</html>