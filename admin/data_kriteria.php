<?php include 'header.php'; ?>
<?php require 'functions.php'; ?>

<?php
// Ambil semua data kriteria
$query = "SELECT * FROM tbl_kriteria ORDER BY id_kriteria ASC";
$result = mysqli_query($koneksi, $query);
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Kriteria</h1>
        <a href="tambah_kriteria.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Kriteria</a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>ID Kriteria</th>
                                    <th>Nama Kriteria</th>
                                    <th>Jumlah Kriteria</th>
                                    <th>Bobot Kriteria</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($result)) :
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row['id_kriteria']); ?></td>
                                    <td><?= htmlspecialchars($row['nama_kriteria']); ?></td>
                                    <td><?= number_format($row['jumlah_kriteria'], 3); ?></td>
                                    <td><?= number_format($row['bobot_kriteria'], 3); ?></td>
                                    <td>
                                        <a href="edit_kriteria.php?id=<?= $row['id_kriteria'] ?>"
                                            class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="hapus_kriteria.php?id=<?= $row['id_kriteria'] ?>"
                                            class="btn btn-danger btn-sm delete-btn"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                                <?php if (mysqli_num_rows($result) === 0): ?>
                                <tr>
                                    <td colspan="5" class="text-center">Data kriteria belum tersedia.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 untuk konfirmasi hapus -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const deleteButtons = document.querySelectorAll(".delete-btn");
    deleteButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            const href = this.getAttribute("href");

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data ini akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    });
});
</script>

<?php include 'footer.php'; ?>