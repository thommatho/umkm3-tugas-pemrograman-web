<?php $data = mysqli_query($conn,"SELECT * FROM produk ORDER BY id_produk DESC"); ?>

<div class="page-heading">
  <div>
    <h3>Data Produk</h3>
    <p>Kelola seluruh produk UMKM</p>
  </div>
  <a href="?menu=tambah_produk" class="btn-navy btn">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="margin-right:6px"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    Tambah Produk
  </a>
</div>

<div class="card">
  <div class="card-header-themed">
    <h5>Daftar Produk</h5>
    <p>Total <?php echo mysqli_num_rows(mysqli_query($conn,"SELECT id_produk FROM produk")); ?> produk tersedia</p>
  </div>
  <div class="card-body-themed">
    <div class="table-responsive">
      <table class="table table-hover" id="tabelProduk">
        <thead>
          <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php $no=1; while($d=mysqli_fetch_array($data)){ ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td>
            <?php if($d['gambar'] != ""){ ?>
            <img src="../admin_themed/gambar/<?php echo $d['gambar']; ?>" width="60" style="border-radius:8px;object-fit:cover;height:50px;">
            <?php }else{ echo '<span style="color:#94a3b8;font-size:12px;">Tidak ada</span>'; } ?>
          </td>
          <td><b><?php echo $d['nama_produk']; ?></b></td>
          <td style="color:#1e3a5f;font-weight:600;">Rp <?php echo number_format($d['harga'],0,',','.'); ?></td>
          <td>
            <?php
            $stok = $d['stok'];
            $color = $stok > 10 ? '#10b981' : ($stok > 0 ? '#f59e0b' : '#ef4444');
            echo "<span style='color:$color;font-weight:700;'>$stok</span>";
            ?>
          </td>
          <td class="text-center">
            <a href="?menu=edit_produk&id=<?php echo $d['id_produk']; ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="?menu=hapus_produk&id=<?php echo $d['id_produk']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus produk ini?')">Hapus</a>
          </td>
        </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
