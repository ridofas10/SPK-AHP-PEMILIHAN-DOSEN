<?php
session_start();
require 'assets/conn/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            // Simpan data penting ke session
            $_SESSION['id'] = $row['id'];               // ID user
            $_SESSION['username'] = $row['username'];   // Username
            $_SESSION['role'] = $row['role'] ?? 'user'; // Role (default 'user' jika kosong)
            $_SESSION['nama'] = $row['nama'] ?? '';     // Nama (default)

            // Redirect sesuai role
            if ($_SESSION['role'] == 'admin') {
                header("Location: admin/index.php");
                exit;
            } else {
                header("Location: user/index.php");
                exit;
            }
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>SPK Kinerja Dosen</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background-image: url('assets/img/bg1.jpg');
        background-size: cover;
        background-position: center;
        height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>

    <link href="assets/css/floating-labels.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LeKH7IkAAAAAHehEYcO9Gr3KwbdZDgo28q6Rv3S"></script>
</head>

<body>

    <form class="form-signin" method="post" action="">
        <div class="text-center mb-4">
            <img class="mb-4" src="assets/img/logo.png" width="300" height="300">
            <h1 class="h3 mb-3 font-weight-normal">Sistem Pendukung Keputusan Metode AHP</h1>
        </div>

        <div class="form-label-group">
            <input type="text" id="username" name="username" class="form-control" placeholder="Username" required
                autofocus>
            <label for="username">Username</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
            <label for="password">Password</label>
        </div>

        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        <p class="mt-5 mb-3 text-muted text-center">&copy; Ridofas Tri Sandi Fantiantoro <?= date('Y') ?></p>
    </form>

</body>

</html>