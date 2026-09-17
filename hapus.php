<?php
include "config.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    mysqli_query($koneksi, "DELETE FROM produk WHERE id = $id");
}

header("Location: index.php");
exit;
?>
