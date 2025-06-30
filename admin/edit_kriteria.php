<?php
session_start();
require 'functions.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID kriteria tidak ditemukan!'); window.location.href = 'data_kriteria.php';</script>";
    exit;
}

$id = $_GET['id'];
$query = "SELECT * FROM tbl_kriteria WHERE id_kriteria = '$id'";
$result = mysqli_query($koneksi, $query);
$kriteria = mysqli_fetch_assoc($result);

if (!$kriteria) {
    echo "<script>alert('Data kriteria tidak ditemukan!'); window.location.href = 'data_kriteria.php';</script>";
    exit;
}

if (isset($_POST['update'])) {
    $nama = $_POST['nama_kriteria'];

    $query_update = "UPDATE tbl_kriteria SET 
                        nama_kriteria = '$nama' 
                    WHERE id_kriteria = '$id'";
    $update = mysqli_query($koneksi, $query_update);

    if ($update) {
        echo "<script>alert('Nama kriteria berhasil diperbarui!'); window.location.href = 'data_kriteria.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui nama kriteria!'); window.location.href = 'data_kriteria.php';</script>";
    }
}
?>

<?php include 'header.php'; ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Nama Kriteria</h1>
    <div class="card shadow">
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label>ID Kriteria</label>
                    <input type="text" class="form-control" value="<?= $kriteria['id_kriteria'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Kriteria</label>
                    <input type="text" name="nama_kriteria" class="form-control"
                        value="<?= $kriteria['nama_kriteria'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Jumlah Kriteria</label>
                    <input type="number" step="0.00001" class="form-control" value="<?= $kriteria['jumlah_kriteria'] ?>"
                        readonly>
                </div>
                <div class="form-group">
                    <label>Bobot Kriteria</label>
                    <input type="number" step="0.00001" class="form-control" value="<?= $kriteria['bobot_kriteria'] ?>"
                        readonly>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                <a href="data_kriteria.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>