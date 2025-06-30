<?php 
include 'header.php'; 
require 'functions.php'; // atau file koneksi dan fungsi lain

// Ambil data alternatif dengan hasil_akhir, urut dari terbesar ke terkecil (ranking terbaik di atas)
$query = mysqli_query($koneksi, "SELECT id_alternatif, nama_alternatif, hasil_akhir FROM tbl_alternatif ORDER BY hasil_akhir DESC");

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
                                <th>Nama Alternatif</th>
                                <th>Hasil Akhir (Ranking)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($query)) :
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row['nama_alternatif']); ?></td>
                                <td><?= number_format($row['hasil_akhir'], 5); ?></td>
                            </tr>
                            <?php endwhile; ?>
                            <?php if (mysqli_num_rows($query) == 0) : ?>
                            <tr>
                                <td colspan="3" class="text-center">Data alternatif belum ada.</td>
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