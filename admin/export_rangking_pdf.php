<?php
ob_start();
ini_set('display_errors', 0);
error_reporting(0);

require '../assets/vendor/autoload.php'; // sesuaikan path
require '../admin/functions.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$query = "SELECT id_alternatif, nama_alternatif, hasil_akhir FROM tbl_alternatif ORDER BY hasil_akhir DESC";
$result = mysqli_query($koneksi, $query);

// Hitung total alternatif
$total = mysqli_num_rows($result);
mysqli_data_seek($result, 0); // reset pointer untuk loop

$html = '
<h2 style="text-align:center;">Laporan Perankingan Alternatif</h2>
<table border="1" cellspacing="0" cellpadding="5" width="100%" style="border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th>No</th>
            <th>Id Alternatif</th>
            <th>Nama Alternatif</th>
            <th>Nilai Akhir</th>
            <th>Ranking</th>
            <th>Kategori</th>
        </tr>
    </thead>
    <tbody>';

$no = 1;
mysqli_data_seek($result, 0); // pastikan pointer dari awal lagi
while ($row = mysqli_fetch_assoc($result)) {
    // Tentukan kategori
    if ($no == 1 || $no == 2) {
        $kategori = 'Sangat Baik';
    } elseif ($no == $total) {
        $kategori = 'Perlu Diperbaiki';
    } elseif ($no == $total - 1 || $no == $total - 2) {
        $kategori = 'Cukup';
    } else {
        $kategori = 'Baik';
    }

    $html .= '<tr>
        <td style="text-align:center;">' . $no . '</td>
        <td>' . htmlspecialchars($row['id_alternatif']) . '</td>
        <td>' . htmlspecialchars($row['nama_alternatif']) . '</td>
        <td style="text-align:center;">' . number_format($row['hasil_akhir'], 3) . '</td>
        <td style="text-align:center;">' . $no . '</td>
        <td style="text-align:center;">' . $kategori . '</td>
    </tr>';
    $no++;
}

$html .= '</tbody></table>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

ob_end_clean(); // bersihkan buffer

$dompdf->stream("laporan_perankingan.pdf", ["Attachment" => false]);
exit;