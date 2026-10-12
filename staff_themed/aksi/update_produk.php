<?php
$id    = $_POST['id'];
$nama  = $_POST['nama'];
$harga = $_POST['harga'];
$stok  = $_POST['stok'];

$gambar = $_FILES['gambar']['name'];
$tmp    = $_FILES['gambar']['tmp_name'];

if($gambar != ""){
    $data = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id'");
    $d    = mysqli_fetch_array($data);
    if($d['gambar'] != "" && file_exists("../admin/gambar/".$d['gambar'])){
        unlink("../admin/gambar/".$d['gambar']);
    }
    move_uploaded_file($tmp, "../admin/gambar/".$gambar);
    mysqli_query($conn, "UPDATE produk SET nama_produk='$nama', harga='$harga', stok='$stok', gambar='$gambar' WHERE id_produk='$id'");
} else {
    mysqli_query($conn, "UPDATE produk SET nama_produk='$nama', harga='$harga', stok='$stok' WHERE id_produk='$id'");
}
?>
<script>window.location="index.php?menu=produk";</script>
