<div class="page-heading">
  <div><h3>Tambah Produk</h3><p>Tambah produk baru ke daftar</p></div>
  <a href="?menu=produk" class="btn btn-secondary">← Kembali</a>
</div>

<div class="row justify-content-center">
<div class="col-md-6">
<div class="card">
  <div class="card-header-themed">
    <h5>Form Tambah Produk</h5>
    <p>Isi informasi produk dengan lengkap</p>
  </div>
  <div class="card-body-themed">
    <form method="POST" action="?menu=simpan_produk" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Nama Produk</label>
        <input type="text" name="nama" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Harga (Rp)</label>
        <input type="number" name="harga" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Stok</label>
        <input type="number" name="stok" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Gambar Produk</label>
        <input type="file" name="gambar" class="form-control" accept="image/*">
      </div>
      <div class="d-flex gap-2">
        <button type="submit" class="btn-navy btn flex-fill">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="margin-right:6px"><polyline points="20 6 9 17 4 12"/></svg>
          Simpan
        </button>
        <a href="?menu=produk" class="btn btn-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>
</div>
</div>
