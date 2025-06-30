<?php
include 'header.php';
require 'functions.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href='data_alternatif.php';</script>";
    exit;
}

$id = $_GET['id'];
$query = "SELECT * FROM tbl_alternatif WHERE id_alternatif = '$id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='data_alternatif.php';</script>";
    exit;
}

if (isset($_POST['update'])) {
    $nama = trim($_POST['nama_alternatif']);
    $queryUpdate = "UPDATE tbl_alternatif SET nama_alternatif = '$nama' WHERE id_alternatif = '$id'";
    $update = mysqli_query($koneksi, $queryUpdate);

    if ($update) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='data_alternatif.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Alternatif</h1>
    <div class="card shadow">
        <div class="card-body">
            <form action="" method="POST">
                <div class="form-group">
                    <label>ID Alternatif</label>
                    <input type="text" class="form-control" value="<?= $data['id_alternatif'] ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Nama Alternatif</label>
                    <input type="text" name="nama_alternatif" class="form-control"
                        value="<?= $data['nama_alternatif'] ?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                <a href="data_alternatif.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>