<?php $query = mysqli_query($conn, "SELECT * FROM produk"); ?>

<div class="page-heading">
  <div>
    <h3>Transaksi Produk Masuk</h3>
    <p>Tambah stok produk melalui transaksi pembelian</p>
  </div>
</div>

<div class="row g-4">

  <!-- FORM TAMBAH KE KERANJANG -->
  <div class="col-md-5">
    <div class="card">
      <div class="card-header-themed">
        <h5>Pilih Produk</h5>
        <p>Tambahkan produk ke keranjang transaksi</p>
      </div>
      <div class="card-body-themed">
        <form method="POST" action="index.php?menu=tambah_keranjang">
          <div class="mb-3">
            <label class="form-label">Produk</label>
            <select name="id_produk" class="form-control" required>
              <option value="">-- Pilih Produk --</option>
              <?php while($row = mysqli_fetch_assoc($query)){ ?>
              <option value="<?= $row['id_produk'] ?>"><?= $row['nama_produk'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" placeholder="Masukkan jumlah" required min="1">
          </div>
          <button type="submit" class="btn-navy btn w-100">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="margin-right:6px"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah ke Keranjang
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- KERANJANG -->
  <div class="col-md-7">
    <div class="card">
      <div class="card-header-themed">
        <h5>Keranjang Transaksi</h5>
        <p>Daftar produk yang akan disimpan</p>
      </div>
      <div class="card-body-themed">
        <?php include 'keranjang.php'; ?>
        <form method="POST" action="index.php?menu=simpan_transaksi" class="mt-3">
          <button type="submit" class="btn btn-success w-100">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="margin-right:6px"><polyline points="20 6 9 17 4 12"/></svg>
            Simpan Transaksi
          </button>
        </form>
      </div>
    </div>
  </div>

</div>
