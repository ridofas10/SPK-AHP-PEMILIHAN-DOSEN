<?php 
require 'functions.php'; 
include 'header.php';

$message = "";

if (isset($_POST['simpan'])) {
    $id = trim($_POST['id_kriteria']);
    $nama = trim($_POST['nama_kriteria']);

    if ($id != "" && $nama != "") {
        $query = "INSERT INTO tbl_kriteria (id_kriteria, nama_kriteria) VALUES ('$id', '$nama')";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            $message = "Swal.fire('Berhasil!', 'Kriteria berhasil ditambahkan.', 'success').then(() => { window.location.href = 'data_kriteria.php'; });";
        } else {
            $message = "Swal.fire('Gagal!', 'Gagal menambahkan kriteria. Mungkin ID sudah digunakan.', 'error');";
        }
    } else {
        $message = "Swal.fire('Oops...', 'Semua field wajib diisi.', 'warning');";
    }
}
?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if ($message): ?>
<script>
<?= $message ?>
</script>
<?php endif; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Kriteria</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="id_kriteria">ID Kriteria</label>
                            <input type="text" name="id_kriteria" id="id_kriteria" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="nama_kriteria">Nama Kriteria</label>
                            <input type="text" name="nama_kriteria" id="nama_kriteria" class="form-control" required>
                        </div>

                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        <a href="data_kriteria.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>