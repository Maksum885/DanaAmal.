<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lupa Password</title>

    <link rel="shortcut icon" href="logodanaamal.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />

    <style>
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
        }

        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h3>Lupa Password</h3>
        <form method="POST" action="lupapassword.php">
            <div class="input-group">
                <label for="email">Masukkan Email Anda:</label><br>
                <input type="email" name="email" id="email" required placeholder="Email Anda" />
            </div>
            <button class="login-button" type="submit">Kirim Link Reset</button>
        </form>
    </div>
</body>

</html>