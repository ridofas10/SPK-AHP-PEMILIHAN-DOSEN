<?php 
include 'header.php'; 
require 'functions.php'; 

// Ambil semua kriteria untuk dropdown pilih kriteria
$kriteria = [];
$qk = mysqli_query($koneksi, "SELECT id_kriteria, nama_kriteria FROM tbl_kriteria ORDER BY id_kriteria ASC");
while ($row = mysqli_fetch_assoc($qk)) {
    $kriteria[] = $row;
}

// Ambil semua alternatif
$alternatif = [];
$qa = mysqli_query($koneksi, "SELECT id_alternatif, nama_alternatif FROM tbl_alternatif ORDER BY id_alternatif ASC");
while ($row = mysqli_fetch_assoc($qa)) {
    $alternatif[] = $row;
}

// Ambil nilai opsi
$nilai_options = [];
$qnilai = mysqli_query($koneksi, "SELECT jumlah, keterangan FROM tbl_nilai ORDER BY jumlah ASC");
while ($row = mysqli_fetch_assoc($qnilai)) {
    $nilai_options[] = $row;
}

// Tangkap kriteria yang dipilih dari GET atau POST (default null)
$id_kriteria_selected = isset($_GET['kriteria']) ? $_GET['kriteria'] : (isset($_POST['kriteria']) ? $_POST['kriteria'] : '');

?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Analisa Perbandingan Alternatif</h1>

    <!-- Form pilih kriteria -->
    <form method="GET" action="analisa_alternatif.php" class="mb-4">
        <div class="form-group w-50">
            <label for="kriteria">Pilih Kriteria</label>
            <select name="kriteria" id="kriteria" class="form-control" required onchange="this.form.submit()">
                <option value="">-- Pilih Kriteria --</option>
                <?php foreach($kriteria as $k): ?>
                <option value="<?= $k['id_kriteria'] ?>"
                    <?= $k['id_kriteria'] == $id_kriteria_selected ? 'selected' : '' ?>>
                    <?= htmlspecialchars($k['nama_kriteria']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>

    <?php if ($id_kriteria_selected): ?>
    <form action="proses_analisa_alternatif.php" method="POST">
        <input type="hidden" name="id_kriteria" value="<?= htmlspecialchars($id_kriteria_selected) ?>">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Alternatif 1</th>
                                <th>Nilai Perbandingan</th>
                                <th>Alternatif 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        // Generate pasangan alternatif unik (tanpa pasangan terbalik dan tidak sama)
                        for ($i = 0; $i < count($alternatif); $i++) {
                            for ($j = $i + 1; $j < count($alternatif); $j++) {
                                $alt1 = $alternatif[$i]['id_alternatif'];
                                $alt2 = $alternatif[$j]['id_alternatif'];

                                // Cek nilai yang sudah ada di DB untuk kriteria dan pasangan alternatif ini
                                $cek_nilai = mysqli_query($koneksi, "SELECT nilai FROM perbandingan_alternatif WHERE id_kriteria='$id_kriteria_selected' AND alternatif1='$alt1' AND alternatif2='$alt2'");
                                $existing = mysqli_fetch_assoc($cek_nilai);
                                $selected_nilai = $existing ? $existing['nilai'] : '';
                                ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="alternatif1[]" value="<?= $alt1 ?>">
                                    <input type="text" class="form-control"
                                        value="<?= htmlspecialchars($alternatif[$i]['nama_alternatif']) ?>" readonly>
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
                                    <input type="hidden" name="alternatif2[]" value="<?= $alt2 ?>">
                                    <input type="text" class="form-control"
                                        value="<?= htmlspecialchars($alternatif[$j]['nama_alternatif']) ?>" readonly>
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

    <!-- Tampilkan hasil bobot alternatif untuk kriteria yang dipilih -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-primary">Hasil Perhitungan Bobot Alternatif untuk Kriteria:
                <?php
                    // Cari nama kriteria dari id
                    foreach($kriteria as $k){
                        if($k['id_kriteria'] == $id_kriteria_selected) {
                            echo htmlspecialchars($k['nama_kriteria']);
                            break;
                        }
                    }
                ?>
            </h5>
        </div>
        <div class="card-body">
            <?php 
            $n = count($alternatif);
            $matrix = [];

            // Inisialisasi diagonal matriks
            for ($i = 0; $i < $n; $i++) {
                for ($j = 0; $j < $n; $j++) {
                    $matrix[$i][$j] = ($i == $j) ? 1 : 0;
                }
            }

            // Isi matriks perbandingan alternatif untuk kriteria terpilih
            for ($i = 0; $i < $n; $i++) {
                for ($j = $i + 1; $j < $n; $j++) {
                    $alt1 = $alternatif[$i]['id_alternatif'];
                    $alt2 = $alternatif[$j]['id_alternatif'];

                    $res = mysqli_query($koneksi, "SELECT nilai FROM perbandingan_alternatif WHERE id_kriteria='$id_kriteria_selected' AND alternatif1='$alt1' AND alternatif2='$alt2'");
                    $row = mysqli_fetch_assoc($res);
                    $val = $row ? floatval($row['nilai']) : 1;

                    $matrix[$i][$j] = $val;
                    $matrix[$j][$i] = 1 / $val;
                }
            }

            // Hitung jumlah kolom untuk normalisasi
            $col_sums = array_fill(0, $n, 0);
            for ($j = 0; $j < $n; $j++) {
                for ($i = 0; $i < $n; $i++) {
                    $col_sums[$j] += $matrix[$i][$j];
                }
            }

            // Normalisasi matriks dan hitung bobot rata-rata baris
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

            // Tampilkan tabel bobot alternatif
            ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            <?php foreach ($alternatif as $a): ?>
                            <th><?= htmlspecialchars($a['nama_alternatif']) ?></th>
                            <?php endforeach; ?>
                            <th>Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $n; $i++): ?>
                        <tr>
                            <td><?= htmlspecialchars($alternatif[$i]['nama_alternatif']) ?></td>
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

    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>