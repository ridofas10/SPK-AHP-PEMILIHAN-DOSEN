<?php
session_start();
require 'functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus user dari database
    $query = "DELETE FROM users WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
                alert('User berhasil dihapus!');
                window.location.href = 'users.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus user!');
                window.location.href = 'users.php';
              </script>";
    }
}
?>