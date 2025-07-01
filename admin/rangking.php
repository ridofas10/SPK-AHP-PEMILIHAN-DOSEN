<?php 
include 'header.php'; 
require 'functions.php'; // koneksi dan fungsi lain

// Ambil semua alternatif dan urutkan berdasarkan hasil_akhir DESC
$query = mysqli_query($koneksi, "SELECT id_alternatif, nama_alternatif, hasil_akhir FROM tbl_alternatif ORDER BY hasil_akhir DESC");

// Ambil seluruh hasil ke array
$alternatif = [];
while ($row = mysqli_fetch_assoc($query)) {
    $alternatif[] = $row;
}
$total = count($alternatif);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ranking Alternatif Terbaik</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Ranking Alternatif</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Id Alternatif</th>
                                <th>Nama Alternatif</th>
                                <th>Hasil Akhir</th>
                                <th>Ranking</th>
                                <th>Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($total > 0): ?>
                            <?php foreach ($alternatif as $index => $row): ?>
                            <?php
                                $no = $index + 1;
                                $kategori = '';

                                if ($no == 1 || $no == 2) {
                                    $kategori = 'Sangat Baik';
                                } elseif ($no == $total) {
                                    $kategori = 'Perlu Diperbaiki';
                                } elseif ($no == $total - 1 || $no == $total - 2) {
                                    $kategori = 'Cukup';
                                } else {
                                    $kategori = 'Baik';
                                }
                            ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= htmlspecialchars($row['id_alternatif']); ?></td>
                                <td><?= htmlspecialchars($row['nama_alternatif']); ?></td>
                                <td><?= number_format($row['hasil_akhir'], 3); ?></td>
                                <td><strong><?= $no; ?></strong></td>
                                <td><span class="badge badge-info"><?= $kategori; ?></span></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Data alternatif belum tersedia.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include 'footer.php'; ?>