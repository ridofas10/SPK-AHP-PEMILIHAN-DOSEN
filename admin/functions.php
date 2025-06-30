<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pemilihan Bidang Minat</title>
</head>

<body>
    <script src='assets/sweetalert2/dist/sweetalert2.all.min.js'></script>

</body>

</html>

<?php 
include '../assets/conn/koneksi.php';

function registrasi($data) {
    global $koneksi;

    $username = strtolower(trim($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
    $role = strtolower(trim($data["role"]));
    $nama = strtolower(trim($data["nama"]));

    // Cek apakah username sudah ada
    $result = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        return "Username sudah terdaftar!";
    }

    // Cek konfirmasi password
    if ($password !== $password2) {
        return "Konfirmasi password tidak sesuai!";
    }

    // Enkripsi password
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan user baru ke database
    $query = "INSERT INTO users (username, password, role, nama) VALUES ('$username', '$password_hashed', '$role', '$nama')";

    if (mysqli_query($koneksi, $query)) {
        return "success"; // Registrasi berhasil
    } else {
        return "Terjadi kesalahan: " . mysqli_error($koneksi);
    }
}

?>