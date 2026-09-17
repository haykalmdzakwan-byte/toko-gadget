-- Buat database
CREATE DATABASE IF NOT EXISTS toko_gadget;
USE toko_gadget;

-- Buat tabel produk
CREATE TABLE IF NOT EXISTS produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    harga INT NOT NULL DEFAULT 0,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Data contoh
INSERT INTO produk (nama, stok, harga) VALUES
('Charger USB-C 20W', 25, 85000),
('Earphone Bluetooth', 4, 150000),
('Powerbank 10000mAh', 0, 210000),
('Case iPhone 15', 30, 65000),
('Kabel Data Type-C', 50, 25000);
