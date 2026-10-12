<?php
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM staf WHERE id='$id'");
$d = mysqli_fetch_array($data);
?>

<div class="page-heading">
  <div><h3>Edit Staf</h3><p>Perbarui informasi akun staf</p></div>
  <a href="?menu=staf" class="btn btn-secondary">← Kembali</a>
</div>

<div class="row justify-content-center">
<div class="col-md-6">
<div class="card">
  <div class="card-header-themed">
    <h5>Form Edit Staf</h5>
    <p>Mengubah data: <b style="color:#fff;"><?php echo $d['username']; ?></b></p>
  </div>
  <div class="card-body-themed">
    <form method="POST" action="index.php?menu=update_staf">
      <input type="hidden" name="id" value="<?php echo $d['id']; ?>">

      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($d['username']); ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password Baru <small class="text-muted fw-normal">(kosongkan jika tidak ingin mengubah)</small></label>
        <div class="position-relative">
          <input type="password" name="password" id="pwInput" class="form-control" placeholder="Isi jika ingin ganti password">
          <button type="button" onclick="togglePw()" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;">
            <svg id="eyeIco" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
      </div>

      <div class="mb-4">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($d['nama']); ?>" required>
      </div>

      <div class="d-flex gap-2">
        <button type="submit" class="btn-navy btn flex-fill">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="margin-right:6px"><polyline points="20 6 9 17 4 12"/></svg>
          Simpan Perubahan
        </button>
        <a href="?menu=staf" class="btn btn-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>
</div>
</div>

<script>
function togglePw(){
  var i=document.getElementById('pwInput'),ico=document.getElementById('eyeIco');
  if(i.type==='password'){i.type='text';ico.innerHTML='<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';}
  else{i.type='password';ico.innerHTML='<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';}
}
</script>
