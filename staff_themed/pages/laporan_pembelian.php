<?php
$dari   = $_GET['dari'] ?? '';
$sampai = $_GET['sampai'] ?? '';

$where = "";
if (!empty($dari) && !empty($sampai)) {
    $where = "WHERE tanggal BETWEEN '$dari' AND '$sampai'";
}

$query = mysqli_query($conn, "SELECT * FROM v_laporan_pembelian $where ORDER BY tanggal DESC");

if (!$query) {
    die("Query error: " . mysqli_error($conn));
}
?>

<div class="page-heading">
  <div>
    <h3>Laporan Pembelian</h3>
    <p>Riwayat produk masuk / transaksi pembelian</p>
  </div>
</div>

<!-- FILTER -->
<div class="card mb-4">
  <div class="card-body-themed">
    <form method="GET" class="row g-3 align-items-end">
      <input type="hidden" name="menu" value="laporan_pembelian">
      <div class="col-md-4">
        <label class="form-label">Dari Tanggal</label>
        <input type="date" name="dari" class="form-control" value="<?= $dari ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Sampai Tanggal</label>
        <input type="date" name="sampai" class="form-control" value="<?= $sampai ?>">
      </div>
      <div class="col-md-4">
        <button class="btn-navy btn w-100">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="margin-right:6px"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          Filter
        </button>
      </div>
    </form>
  </div>
</div>

<!-- GRAFIK -->
<div class="card mb-4">
  <div class="card-header-themed">
    <h5>Grafik Produk Masuk</h5>
    <p>Visualisasi jumlah produk masuk per tanggal</p>
  </div>
  <div class="card-body-themed">
    <canvas id="grafikMasuk" style="max-height:300px;"></canvas>
  </div>
</div>

<!-- TABEL -->
<div class="card">
  <div class="card-header-themed">
    <h5>Detail Transaksi</h5>
    <p>Data lengkap produk masuk</p>
  </div>
  <div class="card-body-themed">
    <div class="table-responsive">
      <table class="table table-hover" id="tabelLaporan">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Tanggal</th>
            <th>Produk</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no=1; $total=0;
          while($row = mysqli_fetch_assoc($query)){
            $total += $row['jumlah'];
          ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><span style="background:#e8f0fb;color:#1e3a5f;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;">#<?= $row['id_masuk'] ?></span></td>
            <td><?= $row['tanggal'] ?></td>
            <td><b><?= $row['nama_produk'] ?></b></td>
            <td><?= $row['jumlah'] ?></td>
          </tr>
          <?php } ?>
          <?php if(mysqli_num_rows($query)==0){ ?>
          <tr><td colspan="5" class="text-center" style="color:#94a3b8;padding:24px;">Tidak ada data</td></tr>
          <?php } ?>
        </tbody>
        <tfoot>
          <tr style="background:#f8faff;">
            <th colspan="4" class="text-end" style="color:#1e3a5f;">Total Produk Masuk</th>
            <th style="color:#1e3a5f;"><?= $total ?></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('grafikMasuk').getContext('2d');
fetch('pages/get_grafik_pembelian.php')
.then(res => res.json())
.then(result => {
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: result.map(i => i.tanggal),
      datasets: [{
        label: 'Jumlah Produk Masuk',
        data: result.map(i => parseInt(i.total)),
        borderColor: '#2d6a9f',
        backgroundColor: 'rgba(45,106,159,.1)',
        borderWidth: 2,
        fill: true,
        tension: 0.3,
        pointBackgroundColor: '#1e3a5f',
        pointRadius: 4
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { labels: { font: { family: 'Plus Jakarta Sans', size: 13 } } } },
      scales: {
        x: { grid: { color: '#f1f5f9' }, ticks: { font: { family: 'Plus Jakarta Sans' } } },
        y: { grid: { color: '#f1f5f9' }, ticks: { font: { family: 'Plus Jakarta Sans' } } }
      }
    }
  });
}).catch(err => console.error("Fetch error:", err));
</script>
