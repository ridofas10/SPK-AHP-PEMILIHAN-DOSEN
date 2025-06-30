<?php 
include 'header.php'; 
require 'functions.php'; 

// Ambil semua kriteria
$kriteria = [];
$qk = mysqli_query($koneksi, "SELECT id_kriteria, nama_kriteria FROM tbl_kriteria ORDER BY id_kriteria ASC");
while ($row = mysqli_fetch_assoc($qk)) {
    $kriteria[] = $row;
}

// Ambil nilai dari tbl_nilai untuk option select
$nilai_options = [];
$qnilai = mysqli_query($koneksi, "SELECT jumlah, keterangan FROM tbl_nilai ORDER BY jumlah ASC");
while ($row = mysqli_fetch_assoc($qnilai)) {
    $nilai_options[] = $row;
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Analisa Perbandingan Kriteria</h1>

    <form action="proses_analisa_kriteria.php" method="POST">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kriteria 1</th>
                                <th>Nilai Perbandingan</th>
                                <th>Kriteria 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        // Generate pasangan kriteria unik (tanpa pasangan terbalik dan tidak sama)
                        for ($i = 0; $i < count($kriteria); $i++) {
                            for ($j = $i + 1; $j < count($kriteria); $j++) {
                                $id1 = $kriteria[$i]['id_kriteria'];
                                $id2 = $kriteria[$j]['id_kriteria'];

                                // Cek nilai yang sudah disimpan
                                $cek_nilai = mysqli_query($koneksi, "SELECT nilai FROM perbandingan_kriteria WHERE kriteria1='$id1' AND kriteria2='$id2'");
                                $existing = mysqli_fetch_assoc($cek_nilai);
                                $selected_nilai = $existing ? $existing['nilai'] : '';
                                ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="kriteria1[]" value="<?= $id1 ?>">
                                    <input type="text" class="form-control"
                                        value="<?= htmlspecialchars($kriteria[$i]['nama_kriteria']) ?>" readonly>
                                </td>
                                <td>
                                    <select name="nilai[]" class="form-control" required>
                                        <option value="">-- Pilih Nilai --</option>
                                        <?php foreach ($nilai_options as $opt): ?>
                                        <option value="<?= $opt['jumlah'] ?>"
                                            <?= $opt['jumlah'] == $selected_nilai ? 'selected' : '' ?>>
                                            <?= $opt['jumlah'] ?> - <?= $opt['keterangan'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="hidden" name="kriteria2[]" value="<?= $id2 ?>">
                                    <input type="text" class="form-control"
                                        value="<?= htmlspecialchars($kriteria[$j]['nama_kriteria']) ?>" readonly>
                                </td>
                            </tr>
                            <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <button type="submit" name="submit" class="btn btn-primary mt-3">Simpan Perbandingan</button>
            </div>
        </div>
    </form>

    <!-- Tampilkan hasil bobot AHP -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-primary">Hasil Perhitungan Bobot Kriteria (AHP)</h5>
        </div>
        <div class="card-body">
            <?php 
            // Bangun matriks perbandingan kriteria NxN
            $n = count($kriteria);
            $matrix = [];

            // Inisialisasi diagonal matriks dengan 1 (karena kriteria dibandingkan dengan diri sendiri)
            for ($i = 0; $i < $n; $i++) {
                for ($j = 0; $j < $n; $j++) {
                    if ($i == $j) {
                        $matrix[$i][$j] = 1;
                    } else {
                        $matrix[$i][$j] = 0;
                    }
                }
            }

            // Isi matriks dengan nilai perbandingan
            for ($i = 0; $i < $n; $i++) {
                for ($j = $i + 1; $j < $n; $j++) {
                    $id1 = $kriteria[$i]['id_kriteria'];
                    $id2 = $kriteria[$j]['id_kriteria'];

                    $res = mysqli_query($koneksi, "SELECT nilai FROM perbandingan_kriteria WHERE kriteria1='$id1' AND kriteria2='$id2'");
                    $row = mysqli_fetch_assoc($res);
                    $val = $row ? floatval($row['nilai']) : 1;

                    $matrix[$i][$j] = $val;
                    $matrix[$j][$i] = 1 / $val;
                }
            }

            // Hitung jumlah kolom (untuk normalisasi)
            $col_sums = array_fill(0, $n, 0);
            for ($j = 0; $j < $n; $j++) {
                for ($i = 0; $i < $n; $i++) {
                    $col_sums[$j] += $matrix[$i][$j];
                }
            }

            // Normalisasi matriks dan hitung bobot (rata-rata baris)
            $normalized = [];
            $bobot = [];
            for ($i = 0; $i < $n; $i++) {
                $sum_row = 0;
                for ($j = 0; $j < $n; $j++) {
                    $normalized[$i][$j] = $matrix[$i][$j] / $col_sums[$j];
                    $sum_row += $normalized[$i][$j];
                }
                $bobot[$i] = $sum_row / $n;
            }

            // Tampilkan tabel matriks normalisasi dan bobot
            ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <?php foreach ($kriteria as $k): ?>
                            <th><?= htmlspecialchars($k['nama_kriteria']) ?></th>
                            <?php endforeach; ?>
                            <th>Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $n; $i++): ?>
                        <tr>
                            <td><?= htmlspecialchars($kriteria[$i]['nama_kriteria']) ?></td>
                            <?php for ($j = 0; $j < $n; $j++): ?>
                            <td><?= round($normalized[$i][$j], 3) ?></td>
                            <?php endfor; ?>
                            <td><strong><?= round($bobot[$i], 3) ?></strong></td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php include 'footer.php'; ?>