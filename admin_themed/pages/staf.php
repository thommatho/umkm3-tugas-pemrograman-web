<?php include "koneksi.php"; $data = mysqli_query($conn,"SELECT * FROM staf ORDER BY id DESC"); ?>

<div class="page-heading">
  <div>
    <h3>Data Staf</h3>
    <p>Kelola akun staf sistem</p>
  </div>
  <a href="?menu=tambah_staf" class="btn-navy btn">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="margin-right:6px"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    Tambah Staf
  </a>
</div>

<div class="card">
  <div class="card-header-themed">
    <h5>Daftar Staf</h5>
    <p>Total <?php echo mysqli_num_rows(mysqli_query($conn,"SELECT id FROM staf")); ?> staf terdaftar</p>
  </div>
  <div class="card-body-themed">
    <div class="table-responsive">
      <table class="table table-hover" id="tabelStaf">
        <thead>
          <tr>
            <th>No</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Role</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php $no=1; while($d=mysqli_fetch_array($data)){ ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><b><?php echo $d['username']; ?></b></td>
          <td><?php echo $d['nama']; ?></td>
          <td><span style="background:#e8f0fb;color:#1e3a5f;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;"><?php echo $d['level']; ?></span></td>
          <td class="text-center">
            <a href="?menu=edit_staf&id=<?php echo $d['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="?menu=hapus_staf&id=<?php echo $d['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus staf ini?')">Hapus</a>
          </td>
        </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
