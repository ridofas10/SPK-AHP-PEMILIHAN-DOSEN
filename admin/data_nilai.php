<?php include 'header.php'; ?>
<?php
require 'functions.php'; // pastikan koneksi $koneksi ada di sini

// Ambil data dari tabel tbl_nilai
$query = "SELECT * FROM tbl_nilai ORDER BY id_nilai ASC";
$result = mysqli_query($koneksi, $query);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Nilai</h1>
    </div>

    <!-- Content Row -->
    <div class="row w-100">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="tambah_nilai.php" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambah Nilai
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row['jumlah']); ?></td>
                                    <td><?= htmlspecialchars($row['keterangan']); ?></td>
                                    <td>
                                        <a href="edit_nilai.php?id=<?= $row['id_nilai']; ?>"
                                            class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="hapus_nilai.php?id=<?= $row['id_nilai']; ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data ini?');">
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

</div>
<!-- /.container-fluid -->
<?php include 'footer.php'; ?>