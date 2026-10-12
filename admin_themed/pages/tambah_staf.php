<div class="page-heading">
  <div><h3>Tambah Staf</h3><p>Tambah akun staf baru</p></div>
  <a href="?menu=staf" class="btn btn-secondary">← Kembali</a>
</div>

<div class="row justify-content-center">
<div class="col-md-6">
<div class="card">
  <div class="card-header-themed">
    <h5>Form Tambah Staf</h5>
    <p>Isi data staf dengan lengkap</p>
  </div>
  <div class="card-body-themed">
    <form method="POST" action="?menu=simpan_staf">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" required>
      </div>
      <div class="d-flex gap-2">
        <button type="submit" class="btn-navy btn flex-fill">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="margin-right:6px"><polyline points="20 6 9 17 4 12"/></svg>
          Simpan
        </button>
        <a href="?menu=staf" class="btn btn-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>
</div>
</div>
