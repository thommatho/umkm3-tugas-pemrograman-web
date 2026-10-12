<?php
$total_produk = mysqli_num_rows(mysqli_query($conn, "SELECT id_produk FROM produk"));
$total_staf   = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM staf"));
?>

<div class="page-heading">
  <div>
    <h3>Dashboard</h3>
    <p>Selamat datang di panel staff UMKM</p>
  </div>
</div>

<div class="row g-4 mb-4">
  <div class="col-md-4">
    <div class="stat-card">
      <div class="stat-icon blue">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
      </div>
      <div class="stat-info">
        <h3><?php echo $total_produk; ?></h3>
        <p>Total Produk</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="stat-card">
      <div class="stat-icon green">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      </div>
      <div class="stat-info">
        <h3><?php echo $total_staf; ?></h3>
        <p>Total Staf</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="stat-card">
      <div class="stat-icon orange">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
      </div>
      <div class="stat-info">
        <h3>0</h3>
        <p>Total Penjualan</p>
      </div>
    </div>
  </div>
</div>
