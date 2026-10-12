<?php
//tambah_keranjang.php
$id_produk = $_POST['id_produk'];
$jumlah = $_POST['jumlah'];

// ambil nama produk
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id_produk'");
$data = mysqli_fetch_assoc($query);

$item = [
    'id_produk' => $id_produk,
    'nama_produk' => $data['nama_produk'],
    'jumlah' => $jumlah
];

// simpan ke session
$_SESSION['keranjang'][] = $item;

echo "<script>window.location='index.php?menu=produk_masuk';</script>";