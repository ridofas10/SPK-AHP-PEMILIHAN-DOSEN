<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'header.php'; 
require 'functions.php';

// Ambil data alternatif
$data = [];
$query = mysqli_query($koneksi, "SELECT nama_alternatif, hasil_akhir FROM tbl_alternatif ORDER BY hasil_akhir DESC");
while ($row = mysqli_fetch_assoc($query)) {
    $data['label'][] = $row['nama_alternatif'];
    $data['value'][] = $row['hasil_akhir'];
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Welcome Card -->
        <div class="card shadow mb-4 w-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Hallo
                    <?php echo isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Admin'; ?></h6>
            </div>
            <div class="card-body">
                <p>Selamat datang di Aplikasi Sistem Pendukung Keputusan Penilaian Kinerja Dosen Berbasis Website.</p>
                <p class="mb-0">Aplikasi ini dirancang untuk membantu pihak manajemen atau lembaga pendidikan dalam
                    mengevaluasi dan menilai kinerja dosen secara objektif dan terstruktur. Dengan memanfaatkan metode
                    AHP (Analytical Hierarchy Process), proses pengambilan keputusan menjadi lebih sistematis dan dapat
                    dipertanggungjawabkan.</p>
                <p class="mb-0">
                    Melalui aplikasi ini, pengguna dapat membandingkan berbagai kriteria penilaian, menghitung bobot
                    masing-masing kriteria, dan menghasilkan peringkat dosen berdasarkan hasil analisis yang akurat.
                    Harapannya, aplikasi ini dapat menjadi alat bantu yang efektif dalam meningkatkan kualitas
                    pendidikan dan kinerja tenaga pengajar.

                    Terima kasih telah menggunakan aplikasi ini.</p>
            </div>
        </div>

        <!-- Grafik Alternatif -->
        <?php
// Ambil data bobot kriteria
$kriteria = mysqli_query($koneksi, "SELECT nama_kriteria, bobot_kriteria FROM tbl_kriteria");
$data_kriteria = [];
while ($row = mysqli_fetch_assoc($kriteria)) {
    $data_kriteria[] = $row;
}

// Ambil nilai akhir alternatif
$alternatif = mysqli_query($koneksi, "SELECT nama_alternatif, hasil_akhir FROM tbl_alternatif ORDER BY hasil_akhir DESC");
$data_alternatif = [];
$data_chart = ['label' => [], 'value' => []];
while ($row = mysqli_fetch_assoc($alternatif)) {
    $data_alternatif[] = $row;
    $data_chart['label'][] = $row['nama_alternatif'];
    $data_chart['value'][] = floatval($row['hasil_akhir']);
}
?>

        <!-- Grafik Alternatif -->
        <div class="card shadow mb-4 col-lg-6">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Hasil Alternatif</h6>
            </div>
            <div class="card-body">
                <canvas id="grafikAlternatif" width="100%" height="300"></canvas>
            </div>
        </div>

        <!-- Preferensi: Kriteria -->
        <div class="card shadow mb-4 col-lg-6">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Bobot Kriteria</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <th>Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_kriteria as $row): ?>
                        <tr>
                            <td><?= $row['nama_kriteria'] ?></td>
                            <td><?= round($row['bobot_kriteria'], 3) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Preferensi: Alternatif -->
        <div class="card shadow mb-4 col-lg-12">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Nilai Akhir Alternatif</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            <th>Nilai Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_alternatif as $row): ?>
                        <tr>
                            <td><?= $row['nama_alternatif'] ?></td>
                            <td><?= round($row['hasil_akhir'], 3) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script>
        window.onload = function() {
            const ctx = document.getElementById('grafikAlternatif').getContext('2d');
            const labels = <?= json_encode($data_chart['label']) ?>;
            const values = <?= json_encode($data_chart['value']) ?>;

            // Fungsi untuk menghasilkan warna acak
            function getRandomColor(opacity = 0.7) {
                const r = Math.floor(Math.random() * 256);
                const g = Math.floor(Math.random() * 256);
                const b = Math.floor(Math.random() * 256);
                return `rgba(${r}, ${g}, ${b}, ${opacity})`;
            }

            // Buat warna acak untuk setiap label
            const backgroundColors = labels.map(() => getRandomColor(0.7));
            const borderColors = backgroundColors.map(color => color.replace('0.7', '1'));

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Hasil Akhir',
                        data: values,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 2
                            }
                        }
                    }
                }
            });
        };
        </script>





        <?php include 'footer.php'; ?>