<?php include 'header.php'; ?>
<?php
require 'functions.php';

$query = "SELECT * FROM tbl_alternatif ORDER BY id_alternatif ASC";
$result = mysqli_query($koneksi, $query);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Alternatif</h1>
        <a href="tambah_alternatif.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Alternatif</a>
    </div>

    <!-- Content Row -->
    <div class="row col-lg-12">
        <div class="card shadow mb-4 w-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>ID Alternatif</th>
                                <th>Nama Alternatif</th>
                                <th>Hasil Akhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['id_alternatif']) ?></td>
                                <td><?= htmlspecialchars($row['nama_alternatif']) ?></td>
                                <td><?= number_format($row['hasil_akhir'], 3) ?></td>
                                <td>
                                    <a href="edit_alternatif.php?id=<?= $row['id_alternatif'] ?>"
                                        class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="hapus_alternatif.php?id=<?= $row['id_alternatif'] ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus alternatif ini?')">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include 'footer.php'; ?>