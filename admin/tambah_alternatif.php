<?php
include 'header.php';
require 'functions.php';

if (isset($_POST['submit'])) {
    $id = trim($_POST['id_alternatif']);
    $nama = trim($_POST['nama_alternatif']);

    $query = "INSERT INTO tbl_alternatif (id_alternatif, nama_alternatif) VALUES ('$id', '$nama')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Alternatif berhasil ditambahkan!'); window.location.href = 'data_alternatif.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan alternatif!');</script>";
    }
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Alternatif</h1>
    <div class="card shadow">
        <div class="card-body">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="id_alternatif">ID Alternatif</label>
                    <input type="text" name="id_alternatif" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nama_alternatif">Nama Alternatif</label>
                    <input type="text" name="nama_alternatif" class="form-control" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                <a href="data_alternatif.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>