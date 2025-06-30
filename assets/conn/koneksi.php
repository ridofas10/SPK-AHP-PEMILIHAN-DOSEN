<?php 
$koneksi = mysqli_connect("localhost", "root", "", "spk-ahp");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
    }
?>