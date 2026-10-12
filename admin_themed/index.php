<?php
session_start();

if(!isset($_SESSION['login'])){
    header("location:login.php");
    exit;
}

include "layout/header.php";
?>

<!-- SIDEBAR -->
<?php include "layout/sidebar.php"; ?>

<!-- TOPBAR -->
<div class="topbar">
<div class="topbar-left">
  Selamat datang, <b><?php echo $_SESSION['nama']; ?></b>
</div>
<div class="topbar-badge">
  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="8" r="4"/><path d="M6 20v-2a6 6 0 0 1 12 0v2"/></svg>
  <?php echo $_SESSION['nama']; ?>
</div>
</div>

<!-- MAIN CONTENT -->
<div class="main">

<?php
include "koneksi.php";

$menu = isset($_GET['menu']) ? $_GET['menu'] : "dashboard";

if($menu=="dashboard")         include "pages/dashboard.php";
elseif($menu=="produk")        include "pages/produk.php";
elseif($menu=="tambah_produk") include "pages/tambah_produk.php";
elseif($menu=="edit_produk")   include "pages/edit_produk.php";
elseif($menu=="staf")          include "pages/staf.php";
elseif($menu=="tambah_staf")   include "pages/tambah_staf.php";
elseif($menu=="edit_staf")     include "pages/edit_staf.php";
elseif($menu=="laporan")       include "pages/laporan.php";
elseif($menu=="simpan_produk") include "aksi/simpan_produk.php";
elseif($menu=="update_produk") include "aksi/update_produk.php";
elseif($menu=="hapus_produk")  include "aksi/hapus_produk.php";
elseif($menu=="simpan_staf")   include "aksi/simpan_staf.php";
elseif($menu=="update_staf")   include "aksi/update_staf.php";
elseif($menu=="hapus_staf")    include "aksi/hapus_staf.php";
?>

</div>

<?php include "layout/footer.php"; ?>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function(){
  $('#tabelProduk').DataTable({language:{search:"Cari:",lengthMenu:"Tampilkan _MENU_ data",info:"Menampilkan _START_ sampai _END_ dari _TOTAL_ data",paginate:{next:"Next",previous:"Prev"}}});
  $('#tabelStaf').DataTable({language:{search:"Cari:",lengthMenu:"Tampilkan _MENU_ data",info:"Menampilkan _START_ sampai _END_ dari _TOTAL_ data",paginate:{next:"Next",previous:"Prev"}}});
});
</script>
</body>
</html>
