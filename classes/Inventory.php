<?php
require_once __DIR__ . '/../config/Database.php';

class Inventory extends Database {
    
    public function ambilDataProduk() {
        return $this->conn->query("SELECT * FROM produk");
    }

    public function updateStokBarang($id, $qty) {
        // Validasi input negatif (CPMK093)
        if ($qty <= 0) {
            return "Peringatan: Jumlah tidak boleh 0 atau negatif!";
        }

        $ambil = $this->conn->query("SELECT stok FROM produk WHERE id_produk = $id");
        $data = $ambil->fetch_assoc();

        if ($data['stok'] >= $qty) {
            $this->conn->query("UPDATE produk SET stok = stok - $qty WHERE id_produk = $id");
            $this->conn->query("INSERT INTO transaksi (id_produk, qty_keluar) VALUES ($id, $qty)");
            return "Sukses: Stok berhasil dikurangi.";
        }
        return "Gagal: Stok tidak mencukupi!";
    }

    // Fitur Peringatan Otomatis (CPMK102)
    public function cekStatus($stok) {
        if ($stok < 5) {
            return "<span style='color:red; font-weight:bold;'>Stok Menipis!</span>";
        }
        return "Tersedia";
    }
}
