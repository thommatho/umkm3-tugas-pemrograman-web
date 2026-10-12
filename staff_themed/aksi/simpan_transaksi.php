<?php

// cek keranjang
if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) {
echo "<script>window.location='index.php?menu=produk_masuk';</script>"; exit;
}

// simpan transaksi

$id_staf = $_SESSION['id_staf'];

mysqli_query($conn, "INSERT INTO produk_masuk (tanggal, id_staf) VALUES (NOW(), '$id_staf')");
$id_transaksi = mysqli_insert_id($conn);

// simpan detail + update stok
foreach ($_SESSION['keranjang'] as $item) {
    $id_produk = $item['id_produk'];
    $jumlah = $item['jumlah'];

    mysqli_query($conn, "
        INSERT INTO detail_produk_masuk (id_masuk, id_produk, jumlah)
        VALUES ('$id_transaksi', '$id_produk', '$jumlah')
    ");

    mysqli_query($conn, "
        UPDATE produk SET stok = stok + $jumlah
        WHERE id_produk = '$id_produk'
    ");
}

// hapus keranjang
unset($_SESSION['keranjang']);

// redirect
echo "<script>window.location='index.php?menu=produk_masuk';</script>"; exit;