<?php
require 'functions.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href='data_alternatif.php';</script>";
    exit;
}

$id = $_GET['id'];
$query = "DELETE FROM tbl_alternatif WHERE id_alternatif = '$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<script>alert('Alternatif berhasil dihapus!'); window.location.href='data_alternatif.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus alternatif!'); window.location.href='data_alternatif.php';</script>";
}