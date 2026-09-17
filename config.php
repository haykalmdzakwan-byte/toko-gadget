<?php
// Konfigurasi koneksi database
// Sesuaikan host, username, password, dan nama database jika perlu

$host     = "localhost";
$username = "root";
$password = "";
$database = "toko_gadget";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($koneksi, "utf8mb4");
?>
