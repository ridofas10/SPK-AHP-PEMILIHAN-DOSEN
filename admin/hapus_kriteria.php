<?php
require 'functions.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID kriteria tidak ditemukan!'); window.location.href = 'data_kriteria.php';</script>";
    exit;
}

$id = $_GET['id'];
$query = "DELETE FROM tbl_kriteria WHERE id_kriteria = '$id'";
$hapus = mysqli_query($koneksi, $query);

if ($hapus) {
    echo "<script>alert('Data kriteria berhasil dihapus!'); window.location.href = 'data_kriteria.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data kriteria!'); window.location.href = 'data_kriteria.php';</script>";
}