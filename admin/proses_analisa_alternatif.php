<?php
session_start();
include 'functions.php'; // koneksi database

if (isset($_POST['submit'])) {
    $id_kriteria = $_POST['id_kriteria'];
    $alternatif1 = $_POST['alternatif1'];
    $alternatif2 = $_POST['alternatif2'];
    $nilai = $_POST['nilai'];

    if (count($alternatif1) === count($alternatif2) && count($alternatif1) === count($nilai)) {

        // Validasi nilai input (harus > 0)
        foreach ($nilai as $val) {
            if (floatval($val) <= 0) {
                $_SESSION['error'] = "Nilai perbandingan harus lebih besar dari 0.";
                header("Location: analisa_alternatif.php?kriteria=" . urlencode($id_kriteria));
                exit;
            }
        }

        // Simpan nilai perbandingan dan nilai resiprokal
        foreach ($nilai as $key => $val) {
            $alt1 = mysqli_real_escape_string($koneksi, $alternatif1[$key]);
            $alt2 = mysqli_real_escape_string($koneksi, $alternatif2[$key]);
            $val = floatval($val);

            // Insert atau update nilai perbandingan
            $cek = mysqli_query($koneksi, "SELECT * FROM perbandingan_alternatif WHERE id_kriteria='$id_kriteria' AND alternatif1='$alt1' AND alternatif2='$alt2'");
            if (mysqli_num_rows($cek) > 0) {
                mysqli_query($koneksi, "UPDATE perbandingan_alternatif SET nilai='$val' WHERE id_kriteria='$id_kriteria' AND alternatif1='$alt1' AND alternatif2='$alt2'");
            } else {
                mysqli_query($koneksi, "INSERT INTO perbandingan_alternatif (id_kriteria, alternatif1, alternatif2, nilai) VALUES ('$id_kriteria', '$alt1', '$alt2', '$val')");
            }

            // Simpan nilai resiprokal
            $val_reciprocal = 1 / $val;
            $cek2 = mysqli_query($koneksi, "SELECT * FROM perbandingan_alternatif WHERE id_kriteria='$id_kriteria' AND alternatif1='$alt2' AND alternatif2='$alt1'");
            if (mysqli_num_rows($cek2) > 0) {
                mysqli_query($koneksi, "UPDATE perbandingan_alternatif SET nilai='$val_reciprocal' WHERE id_kriteria='$id_kriteria' AND alternatif1='$alt2' AND alternatif2='$alt1'");
            } else {
                mysqli_query($koneksi, "INSERT INTO perbandingan_alternatif (id_kriteria, alternatif1, alternatif2, nilai) VALUES ('$id_kriteria', '$alt2', '$alt1', '$val_reciprocal')");
            }
        }

        // Ambil semua alternatif untuk kriteria ini (gabung alternatif1 dan alternatif2, unik)
        $query_alt = mysqli_query($koneksi, "SELECT DISTINCT alternatif1 AS id FROM perbandingan_alternatif WHERE id_kriteria='$id_kriteria'
            UNION
            SELECT DISTINCT alternatif2 AS id FROM perbandingan_alternatif WHERE id_kriteria='$id_kriteria'");

        $alternatif = [];
        while ($row = mysqli_fetch_assoc($query_alt)) {
            $alternatif[] = $row['id'];
        }
        sort($alternatif);

        // Bangun matriks perbandingan alternatif dengan diagonal 1
        $matriks = [];
        foreach ($alternatif as $i) {
            $matriks[$i] = [];
            foreach ($alternatif as $j) {
                if ($i === $j) {
                    $matriks[$i][$j] = 1;
                } else {
                    $q = mysqli_query($koneksi, "SELECT nilai FROM perbandingan_alternatif WHERE id_kriteria='$id_kriteria' AND alternatif1='$i' AND alternatif2='$j'");
                    $r = mysqli_fetch_assoc($q);
                    $matriks[$i][$j] = $r ? floatval($r['nilai']) : 0;
                }
            }
        }

        // Hitung jumlah kolom matriks
        $jumlahKolom = [];
        foreach ($alternatif as $j) {
            $jumlahKolom[$j] = 0;
            foreach ($alternatif as $i) {
                $jumlahKolom[$j] += $matriks[$i][$j];
            }
        }

        // Normalisasi dan hitung bobot alternatif
        $bobotAlternatif = [];
        foreach ($alternatif as $i) {
            $total = 0;
            foreach ($alternatif as $j) {
                $normal = $jumlahKolom[$j] == 0 ? 0 : $matriks[$i][$j] / $jumlahKolom[$j];
                $total += $normal;
            }
            $bobotAlternatif[$i] = $total / count($alternatif);
        }

        // Fungsi hitung Konsistensi Rasio (CR)
        function hitungCR($matriks, $bobot)
        {
            $n = count($bobot);
            $lambda_arr = [];

            foreach ($matriks as $i => $row) {
                $sum = 0;
                foreach ($row as $j => $val) {
                    $sum += $val * $bobot[$j];
                }
                $lambda_arr[] = $bobot[$i] == 0 ? 0 : $sum / $bobot[$i];
            }

            $lambda_max = array_sum($lambda_arr) / $n;
            $CI = ($lambda_max - $n) / ($n - 1);

            $RI_values = [
                1 => 0,
                2 => 0,
                3 => 0.58,
                4 => 0.90,
                5 => 1.12,
                6 => 1.24,
                7 => 1.32,
                8 => 1.41,
                9 => 1.45,
                10 => 1.49
            ];

            $RI = $RI_values[$n] ?? 1.49;

            $CR = $RI == 0 ? 0 : $CI / $RI;
            return $CR;
        }

        // Hitung CR
        $CR = hitungCR($matriks, $bobotAlternatif);

        if ($CR > 0.1) {
            $_SESSION['error'] = "Konsistensi perbandingan alternatif kurang baik (CR = " . round($CR, 4) . "). Silakan perbaiki input.";
            header("Location: analisa_alternatif.php?kriteria=" . urlencode($id_kriteria));
            exit;
        }

        // Simpan bobot alternatif ke tabel hasil_alternatif (insert/update)
        foreach ($bobotAlternatif as $id_alt => $bobot) {
            $id_alt_esc = mysqli_real_escape_string($koneksi, $id_alt);
            $cek = mysqli_query($koneksi, "SELECT * FROM hasil_alternatif WHERE id_alternatif='$id_alt_esc' AND id_kriteria='$id_kriteria'");
            if (mysqli_num_rows($cek) > 0) {
                mysqli_query($koneksi, "UPDATE hasil_alternatif SET bobot='$bobot' WHERE id_alternatif='$id_alt_esc' AND id_kriteria='$id_kriteria'");
            } else {
                mysqli_query($koneksi, "INSERT INTO hasil_alternatif (id_alternatif, id_kriteria, bobot) VALUES ('$id_alt_esc', '$id_kriteria', '$bobot')");
            }
        }

        // Hitung nilai akhir tiap alternatif berdasarkan bobot kriteria dan bobot alternatif
        $kriteria_q = mysqli_query($koneksi, "SELECT id_kriteria, bobot_kriteria FROM tbl_kriteria");
        $bobotKriteria = [];
        while ($row = mysqli_fetch_assoc($kriteria_q)) {
            $bobotKriteria[$row['id_kriteria']] = floatval($row['bobot_kriteria']);
        }

        $alt_q = mysqli_query($koneksi, "SELECT id_alternatif FROM tbl_alternatif");
        while ($alt = mysqli_fetch_assoc($alt_q)) {
            $id_alt = $alt['id_alternatif'];
            $nilai_akhir = 0;

            foreach ($bobotKriteria as $id_krit => $b_krit) {
                $hasil_q = mysqli_query($koneksi, "SELECT bobot FROM hasil_alternatif WHERE id_alternatif='$id_alt' AND id_kriteria='$id_krit'");
                $h = mysqli_fetch_assoc($hasil_q);
                $b_alt = $h ? floatval($h['bobot']) : 0;
                $nilai_akhir += $b_krit * $b_alt;
            }

            // Update nilai akhir di tbl_alternatif
            mysqli_query($koneksi, "UPDATE tbl_alternatif SET hasil_akhir='$nilai_akhir' WHERE id_alternatif='$id_alt'");
        }

        $_SESSION['success'] = "Data perbandingan alternatif berhasil disimpan dan dianalisis dengan CR = " . round($CR, 4);
        header("Location: analisa_alternatif.php?kriteria=" . urlencode($id_kriteria));
        exit;

    } else {
        $_SESSION['error'] = "Input data tidak lengkap.";
        header("Location: analisa_alternatif.php?kriteria=" . urlencode($id_kriteria));
        exit;
    }
} else {
    $_SESSION['error'] = "Akses tidak valid.";
    header("Location: index.php");
    exit;
}