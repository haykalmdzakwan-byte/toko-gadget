<?php
include "config.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$error = '';

// Ambil data produk yang akan diedit
$result = mysqli_query($koneksi, "SELECT * FROM produk WHERE id = $id");
$produk = mysqli_fetch_assoc($result);

if (!$produk) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = trim($_POST['nama']);
    $stok  = (int)$_POST['stok'];
    $harga = (int)$_POST['harga'];

    if ($nama === '' || $stok < 0 || $harga < 0) {
        $error = "Mohon isi semua data dengan benar.";
    } else {
        $namaEsc = mysqli_real_escape_string($koneksi, $nama);
        $query = "UPDATE produk SET nama='$namaEsc', stok=$stok, harga=$harga WHERE id=$id";
        if (mysqli_query($koneksi, $query)) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Gagal menyimpan perubahan: " . mysqli_error($koneksi);
        }
    }
} else {
    // Isi form dengan data lama saat pertama kali dibuka
    $_POST['nama']  = $produk['nama'];
    $_POST['stok']  = $produk['stok'];
    $_POST['harga'] = $produk['harga'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Produk — Toko Gadget</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap">

  <header>
    <div>
      <h1>Toko <span>Gadget</span></h1>
      <p>Ubah data produk.</p>
    </div>
  </header>

  <div class="panel">
    <h2>Edit Produk</h2>

    <?php if ($error): ?>
      <p style="color:var(--danger); margin-top:0;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" action="edit.php?id=<?= (int)$id ?>">
      <div>
        <label>Nama Produk</label>
        <input type="text" name="nama" required value="<?= htmlspecialchars($_POST['nama']) ?>">
      </div>
      <div>
        <label>Stok</label>
        <input type="number" name="stok" min="0" required value="<?= (int)$_POST['stok'] ?>">
      </div>
      <div>
        <label>Harga (Rp)</label>
        <input type="number" name="harga" min="0" required value="<?= (int)$_POST['harga'] ?>">
      </div>
      <div class="aksi" style="align-items:end;">
        <button type="submit" class="btn-add">Simpan Perubahan</button>
        <a href="index.php" class="btn btn-cancel">Batal</a>
      </div>
    </form>
  </div>

</div>
</body>
</html>
