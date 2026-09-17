<?php
include "config.php";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = trim($_POST['nama']);
    $stok  = (int)$_POST['stok'];
    $harga = (int)$_POST['harga'];

    if ($nama === '' || $stok < 0 || $harga < 0) {
        $error = "Mohon isi semua data dengan benar.";
    } else {
        $namaEsc = mysqli_real_escape_string($koneksi, $nama);
        $query = "INSERT INTO produk (nama, stok, harga) VALUES ('$namaEsc', $stok, $harga)";
        if (mysqli_query($koneksi, $query)) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Produk — Toko Gadget</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap">

  <header>
    <div>
      <h1>Toko <span>Gadget</span></h1>
      <p>Tambah produk baru ke daftar.</p>
    </div>
  </header>

  <div class="panel">
    <h2>Tambah Produk Baru</h2>

    <?php if ($error): ?>
      <p style="color:var(--danger); margin-top:0;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" action="tambah.php">
      <div>
        <label>Nama Produk</label>
        <input type="text" name="nama" placeholder="mis. iPhone 15 Case" required value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '' ?>">
      </div>
      <div>
        <label>Stok</label>
        <input type="number" name="stok" min="0" placeholder="0" required value="<?= isset($_POST['stok']) ? (int)$_POST['stok'] : '' ?>">
      </div>
      <div>
        <label>Harga (Rp)</label>
        <input type="number" name="harga" min="0" placeholder="0" required value="<?= isset($_POST['harga']) ? (int)$_POST['harga'] : '' ?>">
      </div>
      <div class="aksi" style="align-items:end;">
        <button type="submit" class="btn-add">Tambah</button>
        <a href="index.php" class="btn btn-cancel">Batal</a>
      </div>
    </form>
  </div>

</div>
</body>
</html>
