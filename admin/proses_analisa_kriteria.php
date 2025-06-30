<?php 
include 'header.php'; 
require 'functions.php';

if (isset($_POST['submit'])) {
    $kriteria1 = $_POST['kriteria1'];
    $kriteria2 = $_POST['kriteria2'];
    $nilai = $_POST['nilai'];

    $success = true;

    // Simpan/update nilai perbandingan ke tabel perbandingan_kriteria
    for ($i = 0; $i < count($nilai); $i++) {
        $k1 = mysqli_real_escape_string($koneksi, $kriteria1[$i]);
        $k2 = mysqli_real_escape_string($koneksi, $kriteria2[$i]);
        $val = floatval($nilai[$i]);

        $cek = mysqli_query($koneksi, "SELECT * FROM perbandingan_kriteria WHERE kriteria1='$k1' AND kriteria2='$k2'");
        if (mysqli_num_rows($cek) > 0) {
            $query = "UPDATE perbandingan_kriteria SET nilai = $val WHERE kriteria1='$k1' AND kriteria2='$k2'";
        } else {
            $query = "INSERT INTO perbandingan_kriteria (kriteria1, kriteria2, nilai) VALUES ('$k1', '$k2', $val)";
        }

        if (!mysqli_query($koneksi, $query)) {
            $success = false;
            break;
        }

        // Simpan kebalikannya
        $val_inverse = 1 / $val;
        $cek_reverse = mysqli_query($koneksi, "SELECT * FROM perbandingan_kriteria WHERE kriteria1='$k2' AND kriteria2='$k1'");
        if (mysqli_num_rows($cek_reverse) > 0) {
            $query_reverse = "UPDATE perbandingan_kriteria SET nilai = $val_inverse WHERE kriteria1='$k2' AND kriteria2='$k1'";
        } else {
            $query_reverse = "INSERT INTO perbandingan_kriteria (kriteria1, kriteria2, nilai) VALUES ('$k2', '$k1', $val_inverse)";
        }

        if (!mysqli_query($koneksi, $query_reverse)) {
            $success = false;
            break;
        }
    }

    if ($success) {
        // Hitung bobot tiap kriteria
        $kriteria = [];
        $res_kriteria = mysqli_query($koneksi, "SELECT id_kriteria FROM tbl_kriteria ORDER BY id_kriteria ASC");
        while ($row = mysqli_fetch_assoc($res_kriteria)) {
            $kriteria[] = $row['id_kriteria'];
        }

        $n = count($kriteria);
        $matrix = [];

        // Inisialisasi matrix
        foreach ($kriteria as $i) {
            foreach ($kriteria as $j) {
                $q = mysqli_query($koneksi, "SELECT nilai FROM perbandingan_kriteria WHERE kriteria1='$i' AND kriteria2='$j'");
                $row = mysqli_fetch_assoc($q);
                $matrix[$i][$j] = $row ? $row['nilai'] : 1;
            }
        }

        // Hitung jumlah kolom
        $col_sums = [];
        foreach ($kriteria as $j) {
            $col_sums[$j] = 0;
            foreach ($kriteria as $i) {
                $col_sums[$j] += $matrix[$i][$j];
            }
        }

        // Normalisasi dan hitung rata-rata bobot
        foreach ($kriteria as $i) {
            $jumlah_kriteria = 0;
            foreach ($kriteria as $j) {
                $normal = $matrix[$i][$j] / $col_sums[$j];
                $jumlah_kriteria += $normal;
            }
            $bobot = round($jumlah_kriteria / $n, 4);
            $jumlah_kriteria = round($jumlah_kriteria, 4);

            // Update ke tbl_kriteria
            mysqli_query($koneksi, "UPDATE tbl_kriteria SET jumlah_kriteria='$jumlah_kriteria', bobot_kriteria='$bobot' WHERE id_kriteria='$i'");
        }

        echo "<script>
            alert('Data perbandingan dan bobot kriteria berhasil disimpan.');
            window.location.href = 'analisa_kriteria.php';
        </script>";
    } else {
        echo "<script>
            alert('Terjadi kesalahan saat menyimpan data.');
            window.location.href = 'analisa_kriteria.php';
        </script>";
    }
} else {
    header('Location: analisa_kriteria.php');
    exit;
}