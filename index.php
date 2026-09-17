<?php
include "config.php";

// Ambil kata kunci pencarian jika ada
$keyword = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($keyword !== '') {
    $keywordEsc = mysqli_real_escape_string($koneksi, $keyword);
    $query = "SELECT * FROM produk WHERE nama LIKE '%$keywordEsc%' ORDER BY id DESC";
} else {
    $query = "SELECT * FROM produk ORDER BY id DESC";
}

$result = mysqli_query($koneksi, $query);

// Hitung statistik dari seluruh data (tidak terpengaruh pencarian)
$statResult = mysqli_query($koneksi, "SELECT COUNT(*) AS total_produk, SUM(stok) AS total_stok, SUM(stok*harga) AS nilai_stok FROM produk");
$stat = mysqli_fetch_assoc($statResult);

function formatRupiah($angka) {
    return "Rp" . number_format((float)$angka, 0, ',', '.');
}

function statusStok($stok) {
    if ($stok <= 0) return ["kelas" => "habis", "label" => "Habis"];
    if ($stok <= 5) return ["kelas" => "rendah", "label" => "Rendah"];
    return ["kelas" => "aman", "label" => "Aman"];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Toko Gadget — Manajemen Produk</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap">

  <header>
    <div>
      <h1>Toko <span>Gadget</span></h1>
      <p>Kelola produk, stok, dan harga di satu tempat.</p>
    </div>
    <div class="stats">
      <div class="stat"><div class="n"><?= (int)$stat['total_produk'] ?></div><div class="l">Produk</div></div>
      <div class="stat"><div class="n"><?= (int)$stat['total_stok'] ?></div><div class="l">Total Stok</div></div>
      <div class="stat"><div class="n"><?= formatRupiah($stat['nilai_stok'] ?? 0) ?></div><div class="l">Nilai Stok</div></div>
    </div>
  </header>

  <div class="panel">
    <div class="topbar">
      <form class="search" method="get" action="index.php" style="display:flex; gap:10px; align-items:end;">
        <div>
          <label>Cari Produk</label>
          <input type="text" name="q" placeholder="Ketik nama produk..." value="<?= htmlspecialchars($keyword) ?>">
        </div>
        <button type="submit" class="btn btn-cancel">Cari</button>
      </form>
      <a href="tambah.php" class="btn btn-add">+ Tambah Produk</a>
    </div>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Produk</th>
          <th>Stok</th>
          <th>Harga</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $adaData = false;
        while ($row = mysqli_fetch_assoc($result)) {
            $adaData = true;
            $st = statusStok((int)$row['stok']);
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
            echo "<td><span class='stok {$st['kelas']}'>" . (int)$row['stok'] . " · {$st['label']}</span></td>";
            echo "<td class='harga'>" . formatRupiah($row['harga']) . "</td>";
            echo "<td class='aksi'>
                    <a class='btn btn-edit' href='edit.php?id={$row['id']}'>Edit</a>
                    <a class='btn btn-hapus' href='hapus.php?id={$row['id']}' onclick=\"return confirm('Hapus produk ini?');\">Hapus</a>
                  </td>";
            echo "</tr>";
        }
        ?>
      </tbody>
    </table>

    <?php if (!$adaData): ?>
      <div class="empty">Belum ada produk yang cocok. Tambahkan produk baru di atas.</div>
    <?php endif; ?>
  </div>

</div>
</body>
</html>
