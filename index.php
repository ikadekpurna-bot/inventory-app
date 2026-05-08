<?php
require_once 'classes/Inventory.php';
$toko = new Inventory();

$pesan_status = "";
if (isset($_POST['proses_transaksi'])) {
    $pesan_status = $toko->updateStokBarang($_POST['id_brg'], $_POST['jml_keluar']);
}

$daftar_produk = $toko->ambilDataProduk();
?>

<!DOCTYPE html>
<html>
<head>
    <title>UTS Backend - I Kadek Purna</title>
</head>
<body>
    <h1>Dashboard Inventaris Toko</h1>
    <p><strong>Status:</strong> <?= $pesan_status; ?></p>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr bgcolor="#eee">
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Keterangan</th>
        </tr>
        <?php while($row = $daftar_produk->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id_produk']; ?></td>
            <td><?= $row['nama_barang']; ?></td>
            <td><?= $row['kategori']; ?></td>
            <td><?= $row['stok']; ?></td>
            <td><?= $toko->cekStatus($row['stok']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <br>
    <h3>Form Pengurangan Stok</h3>
    <form method="POST">
        ID Barang: <input type="number" name="id_brg" required> 
        Jumlah Keluar: <input type="number" name="jml_keluar" required>
        <button type="submit" name="proses_transaksi">Update Stok</button>
    </form>
</body>
</html>
