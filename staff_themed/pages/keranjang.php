<?php
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}
?>

<div class="table-responsive">
<table class="table table-hover">
  <thead>
    <tr>
      <th>No</th>
      <th>Produk</th>
      <th>Jumlah</th>
      <th class="text-center">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; foreach($_SESSION['keranjang'] as $key => $item){ ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><b><?= $item['nama_produk'] ?></b></td>
      <td><span style="background:#e8f0fb;color:#1e3a5f;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;"><?= $item['jumlah'] ?></span></td>
      <td class="text-center">
        <a href="index.php?menu=hapus_keranjang&id=<?= $key ?>" class="btn btn-danger btn-sm">Hapus</a>
      </td>
    </tr>
    <?php } ?>
    <?php if(empty($_SESSION['keranjang'])){ ?>
    <tr>
      <td colspan="4" class="text-center" style="color:#94a3b8;padding:24px;font-size:13px;">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" style="display:block;margin:0 auto 8px"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
        Keranjang masih kosong
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>
