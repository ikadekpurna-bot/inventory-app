CREATE DATABASE IF NOT EXISTS db_inventaris_kadek;
USE db_inventaris_kadek;

-- Tabel Produk (CPMK091)
CREATE TABLE produk (
    id_produk INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(100),
    kategori ENUM('Laptop', 'Smartphone'),
    stok INT,
    harga DOUBLE
);

-- Tabel Transaksi
CREATE TABLE transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    id_produk INT,
    qty_keluar INT,
    waktu_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_produk) REFERENCES produk(id_produk)
);

-- Data Contoh
INSERT INTO produk (nama_barang, kategori, stok, harga) VALUES 
('Asus Vivobook', 'Laptop', 10, 8000000),
('Samsung A54', 'Smartphone', 4, 5000000),
('iPhone 11', 'Smartphone', 2, 7000000);
