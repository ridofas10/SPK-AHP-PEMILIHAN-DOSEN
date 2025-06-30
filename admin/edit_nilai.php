<?php
session_start();
require 'functions.php';

// Cek apakah ada parameter id
if (!isset($_GET['id'])) {
    echo "<script>
        alert('ID nilai tidak ditemukan!');
        window.location.href = 'data_nilai.php';
    </script>";
    exit;
}

$id = $_GET['id'];

// Ambil data nilai berdasarkan id
$query = "SELECT * FROM tbl_nilai WHERE id_nilai = '$id'";
$result = mysqli_query($koneksi, $query);
$nilai = mysqli_fetch_assoc($result);

if (!$nilai) {
    echo "<script>
        alert('Data nilai tidak ditemukan!');
        window.location.href = 'data_nilai.php';
    </script>";
    exit;
}

// Proses jika form disubmit
if (isset($_POST['update'])) {
    $jumlah = $_POST['jumlah'];
    $keterangan = htmlspecialchars($_POST['keterangan']);

    $updateQuery = "UPDATE tbl_nilai SET jumlah = '$jumlah', keterangan = '$keterangan' WHERE id_nilai = '$id'";
    $update = mysqli_query($koneksi, $updateQuery);

    if ($update) {
        echo "<script>
            alert('Data nilai berhasil diperbarui!');
            window.location.href = 'data_nilai.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal memperbarui data!');
            window.location.href = 'data_nilai.php';
        </script>";
    }
}
?>

<?php include 'header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Data Nilai</h1>

    <div class="row">
        <div class="col-md-6">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" step="0.0001" name="jumlah" id="jumlah" class="form-control"
                        value="<?= htmlspecialchars($nilai['jumlah']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control"
                        value="<?= htmlspecialchars($nilai['keterangan']); ?>" required>
                </div>

                <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                <a href="data_nilai.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include 'footer.php'; ?>