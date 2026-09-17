# Toko Gadget — CRUD PHP + MySQL

Program sederhana untuk mengelola data produk toko gadget (CRUD: Create, Read, Update, Delete)
dengan fitur tambahan **stok** dan **harga**.

## Struktur File

```
toko-gadget-php/
├── config.php     # Koneksi ke database
├── database.sql   # Skema database + data contoh
├── style.css      # Tampilan halaman
├── index.php      # Menampilkan daftar produk + pencarian
├── tambah.php     # Form tambah produk baru
├── edit.php       # Form edit produk
├── hapus.php      # Proses hapus produk
└── README.md
```

## Cara Menjalankan

1. **Install XAMPP/Laragon** (atau server lokal PHP + MySQL lainnya).
2. Copy folder `toko-gadget-php` ke folder `htdocs` (XAMPP) atau `www` (Laragon).
3. Buka **phpMyAdmin**, lalu import file `database.sql` untuk membuat database
   `toko_gadget` beserta tabel dan data contohnya.
4. Jika username/password MySQL kamu berbeda dari default, sesuaikan di `config.php`.
5. Jalankan Apache & MySQL dari XAMPP/Laragon.
6. Buka browser ke: `http://localhost/toko-gadget-php/index.php`

## Fitur

- **Tambah produk** — nama, stok, harga
- **Lihat daftar produk** — dengan status stok (Aman / Rendah / Habis)
- **Edit produk**
- **Hapus produk**
- **Cari produk** berdasarkan nama
- **Statistik** — total produk, total stok, total nilai stok

## Data yang Dikelola

| Field | Keterangan |
|-------|------------|
| nama  | Nama produk |
| stok  | Jumlah stok tersedia |
| harga | Harga satuan produk (Rp) |
