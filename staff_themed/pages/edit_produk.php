<?php
$id   = $_GET['id'];
$data = mysqli_query($conn,"SELECT * FROM produk WHERE id_produk='$id'");
$d    = mysqli_fetch_array($data);
?>

<div class="page-heading">
  <div><h3>Edit Produk</h3><p>Perbarui informasi produk</p></div>
  <a href="?menu=produk" class="btn btn-secondary">← Kembali</a>
</div>

<div class="row justify-content-center">
<div class="col-md-6">
<div class="card">
  <div class="card-header-themed">
    <h5>Form Edit Produk</h5>
    <p>Mengubah: <b style="color:#fff;"><?php echo $d['nama_produk']; ?></b></p>
  </div>
  <div class="card-body-themed">
    <form method="POST" action="index.php?menu=update_produk" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $d['id_produk']; ?>">
      <div class="mb-3">
        <label class="form-label">Nama Produk</label>
        <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($d['nama_produk']); ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Harga (Rp)</label>
        <input type="number" name="harga" class="form-control" value="<?php echo $d['harga']; ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Stok</label>
        <input type="number" name="stok" class="form-control" value="<?php echo $d['stok']; ?>" required>
      </div>
      <?php if($d['gambar'] != ""){ ?>
      <div class="mb-3">
        <label class="form-label">Gambar Saat Ini</label><br>
        <img src="../admin_themed/gambar/<?php echo $d['gambar']; ?>" width="100" style="border-radius:10px;object-fit:cover;height:80px;box-shadow:0 2px 8px rgba(0,0,0,.1);">
      </div>
      <?php } ?>
      <div class="mb-4">
        <label class="form-label">Ganti Gambar <small class="text-muted fw-normal">(kosongkan jika tidak ingin mengubah)</small></label>
        <input type="file" name="gambar" class="form-control" accept="image/*">
      </div>
      <div class="d-flex gap-2">
        <button type="submit" class="btn-navy btn flex-fill">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="margin-right:6px"><polyline points="20 6 9 17 4 12"/></svg>
          Simpan Perubahan
        </button>
        <a href="?menu=produk" class="btn btn-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>
</div>
</div>
