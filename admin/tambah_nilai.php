<?php 
include 'header.php'; 
require 'functions.php';

if (isset($_POST['simpan'])) {
    $jumlah = trim($_POST['jumlah']);
    $keterangan = trim($_POST['keterangan']);

    $query = "INSERT INTO tbl_nilai (jumlah, keterangan) VALUES ('$jumlah', '$keterangan')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
            alert('Data berhasil ditambahkan!');
            window.location.href = 'data_nilai.php'; // pastikan file ini adalah file tampilan nilai
        </script>";
    } else {
        echo "<script>
            alert('Gagal menambahkan data!');
        </script>";
    }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Nilai</h1>
    </div>

    <div class="row w-100">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" step="0.0001" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                        </div>

                        <button type="submit" name="simpan" class="btn btn-primary">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="data_nilai.php" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include 'footer.php'; ?>