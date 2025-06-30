<?php
session_start();
require 'functions.php';

if (!isset($_GET['id'])) {
    echo "<script>
        alert('ID nilai tidak ditemukan!');
        window.location.href = 'data_nilai.php';
    </script>";
    exit;
}

$id = $_GET['id'];

$delete = mysqli_query($koneksi, "DELETE FROM tbl_nilai WHERE id_nilai = '$id'");

if ($delete) {
    echo "<script>
        alert('Data nilai berhasil dihapus!');
        window.location.href = 'data_nilai.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal menghapus data nilai!');
        window.location.href = 'data_nilai.php';
    </script>";
}
?>