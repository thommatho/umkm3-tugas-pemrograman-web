<?php

// cek apakah keranjang ada
if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) {
echo "<script>window.location='index.php?menu=produk_masuk';</script>"; exit;
}

// ambil id dari URL
$id = $_GET['id'] ?? null;

// validasi id
if ($id !== null && isset($_SESSION['keranjang'][$id])) {
    unset($_SESSION['keranjang'][$id]);

    // reindex array biar rapi
    $_SESSION['keranjang'] = array_values($_SESSION['keranjang']);
}

echo "<script>window.location='index.php?menu=produk_masuk';</script>"; exit;