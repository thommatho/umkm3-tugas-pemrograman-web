<?php
// ── Filter tanggal ────────────────────────────────────────────
$dari   = (!empty($_GET['dari']))   ? $_GET['dari']   : date('Y-m-01');
$sampai = (!empty($_GET['sampai'])) ? $_GET['sampai'] : date('Y-m-d');

// ── Ringkasan ─────────────────────────────────────────────────
$total_transaksi = mysqli_fetch_row(mysqli_query($conn,
    "SELECT COUNT(*) FROM produk_masuk
     WHERE tanggal BETWEEN '$dari' AND '$sampai'"))[0];

$total_unit = mysqli_fetch_row(mysqli_query($conn,
    "SELECT COALESCE(SUM(dpm.jumlah), 0)
     FROM detail_produk_masuk dpm
     JOIN produk_masuk pm ON pm.id_masuk = dpm.id_masuk
     WHERE pm.tanggal BETWEEN '$dari' AND '$sampai'"))[0];

// ── Detail transaksi ──────────────────────────────────────────
$detail_q = mysqli_query($conn,
    "SELECT pm.id_masuk, pm.tanggal,
            COALESCE(s.nama, '-') AS nama_staf,
            p.nama_produk,
            dpm.jumlah
     FROM produk_masuk pm
     LEFT JOIN staf s                  ON s.id         = pm.id_staf
     LEFT JOIN detail_produk_masuk dpm ON dpm.id_masuk = pm.id_masuk
     LEFT JOIN produk p                ON p.id_produk  = dpm.id_produk
     WHERE pm.tanggal BETWEEN '$dari' AND '$sampai'
     ORDER BY pm.tanggal DESC, pm.id_masuk DESC");
?>

<!-- PAGE HEADING -->
<div class="page-heading">
  <div>
    <h3>Laporan</h3>
    <p>Laporan data produk masuk UMKM</p>
  </div>
  <button onclick="window.print()" class="btn-navy btn">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="margin-right:6px"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
    Cetak
  </button>
</div>

<!-- FILTER -->
<div class="card mb-4">
  <div class="card-body-themed">
    <form method="GET" class="row g-3 align-items-end">
      <input type="hidden" name="menu" value="laporan">
      <div class="col-md-3">
        <label class="form-label">Dari Tanggal</label>
        <input type="date" name="dari" class="form-control" value="<?php echo $dari; ?>">
      </div>
      <div class="col-md-3">
        <label class="form-label">Sampai Tanggal</label>
        <input type="date" name="sampai" class="form-control" value="<?php echo $sampai; ?>">
      </div>
      <div class="col-md-6 d-flex gap-2 flex-wrap">
        <button type="submit" class="btn-navy btn">Filter</button>
        <a href="?menu=laporan" class="btn btn-secondary">Reset</a>
        <a href="?menu=laporan&dari=<?php echo date('Y-m-d'); ?>&sampai=<?php echo date('Y-m-d'); ?>" class="btn btn-secondary">Hari Ini</a>
        <a href="?menu=laporan&dari=<?php echo date('Y-m-d', strtotime('-6 days')); ?>&sampai=<?php echo date('Y-m-d'); ?>" class="btn btn-secondary">7 Hari</a>
        <a href="?menu=laporan&dari=<?php echo date('Y-m-01'); ?>&sampai=<?php echo date('Y-m-d'); ?>" class="btn btn-secondary">Bulan Ini</a>
      </div>
    </form>
  </div>
</div>

<!-- RINGKASAN -->
<div class="row g-4 mb-4">
  <div class="col-md-6">
    <div class="stat-card">
      <div class="stat-icon blue">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
      </div>
      <div class="stat-info">
        <h3><?php echo $total_transaksi; ?></h3>
        <p>Transaksi &nbsp;·&nbsp; <?php echo date('d M', strtotime($dari)).' – '.date('d M Y', strtotime($sampai)); ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="stat-card">
      <div class="stat-icon green">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 12 20 22 4 22"/><rect x="2" y="7" width="20" height="5"/><path d="M12 22V7"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>
      </div>
      <div class="stat-info">
        <h3><?php echo number_format($total_unit); ?></h3>
        <p>Total Unit Masuk</p>
      </div>
    </div>
  </div>
</div>

<!-- TABEL DETAIL -->
<div class="card">
  <div class="card-header-themed">
    <h5>Detail Produk Masuk</h5>
    <p>Periode <?php echo date('d M Y', strtotime($dari)); ?> – <?php echo date('d M Y', strtotime($sampai)); ?></p>
  </div>
  <div class="card-body-themed">
    <div class="table-responsive">
      <table class="table table-hover" id="tabelLaporan">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Tanggal</th>
            <th>Staf</th>
            <th>Produk</th>
            <th class="text-center">Jumlah</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no          = 1;
          $grand_total = 0;
          if (mysqli_num_rows($detail_q) == 0):
          ?>
          <tr>
            <td colspan="6" class="text-center" style="padding:32px;color:#94a3b8;">
              Tidak ada data pada periode ini
            </td>
          </tr>
          <?php else: while ($row = mysqli_fetch_assoc($detail_q)):
            $grand_total += (int)$row['jumlah'];
          ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td>
              <span style="background:#e8f0fb;color:#1e3a5f;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;">
                #<?php echo $row['id_masuk']; ?>
              </span>
            </td>
            <td><?php echo date('d M Y', strtotime($row['tanggal'])); ?></td>
            <td><?php echo htmlspecialchars($row['nama_staf']); ?></td>
            <td><b><?php echo htmlspecialchars($row['nama_produk'] ?? '-'); ?></b></td>
            <td class="text-center" style="font-weight:700;color:#1e3a5f;">
              <?php echo number_format((int)$row['jumlah']); ?>
            </td>
          </tr>
          <?php endwhile; endif; ?>
        </tbody>
        <?php if ($grand_total > 0): ?>
        <tfoot>
          <tr style="background:#f8faff;">
            <th colspan="5" class="text-end" style="color:#1e3a5f;">Total Unit Masuk</th>
            <th class="text-center" style="color:#1e3a5f;"><?php echo number_format($grand_total); ?></th>
          </tr>
        </tfoot>
        <?php endif; ?>
      </table>
    </div>
  </div>
</div>

<style>
@media print {
  .sidebar, .topbar, .card:first-of-type, .page-heading .btn { display: none !important; }
  .main { margin-left: 0 !important; padding: 20px !important; }
  .card { box-shadow: none !important; border: 1px solid #ddd !important; }
}
</style>

<script>
$(document).ready(function(){
  $('#tabelLaporan').DataTable({
    language: {
      search: "Cari:",
      lengthMenu: "Tampilkan _MENU_ data",
      info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
      paginate: { next: "Next", previous: "Prev" }
    },
    order: [[2, 'desc']]
  });
});
</script>