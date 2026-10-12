<?php
$nama  = $_POST['nama'];
$harga = $_POST['harga'];
$stok  = $_POST['stok'];

$gambar = $_FILES['gambar']['name'];
$tmp    = $_FILES['gambar']['tmp_name'];

if($gambar != ""){
    move_uploaded_file($tmp, "../gambar/" . $gambar);
}

mysqli_query($conn, "INSERT INTO produk (nama_produk, harga, stok, gambar) VALUES ('$nama','$harga','$stok','$gambar')");
?>
<script>window.location="index.php?menu=produk";</script>
