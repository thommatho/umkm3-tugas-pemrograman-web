<?php
$id   = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id'");
$d    = mysqli_fetch_array($data);

if($d['gambar'] != "" && file_exists("../admin/gambar/".$d['gambar'])){
    unlink("../admin/gambar/".$d['gambar']);
}

mysqli_query($conn, "DELETE FROM produk WHERE id_produk='$id'");
?>
<script>window.location="index.php?menu=produk";</script>
