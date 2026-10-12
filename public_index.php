<?php
// Koneksi database - sesuaikan path dengan struktur proyek Anda
$host = "localhost";
$user = "root";
$pass = "";
$db   = "dbumkm";
$conn = mysqli_connect($host, $user, $pass, $db);

// Ambil semua produk yang stoknya > 0
$produk_query = mysqli_query($conn, "SELECT * FROM produk WHERE stok > 0 ORDER BY id_produk DESC");
$total_produk = mysqli_num_rows(mysqli_query($conn, "SELECT id_produk FROM produk WHERE stok > 0"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UMKM Shop — Belanja Produk Lokal Berkualitas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
<style>
/* =============================================
   ROOT VARIABLES — sesuai tema proyek (navy/blue)
   ============================================= */
:root {
  --navy:       #1e3a5f;
  --navy-mid:   #2d6a9f;
  --navy-light: #e8f0fb;
  --accent:     #3b82f6;
  --accent-2:   #f59e0b;
  --radius:     14px;
  --shadow:     0 4px 6px -1px rgba(0,0,0,.07), 0 10px 30px -5px rgba(0,0,0,.1);
  --shadow-lg:  0 20px 60px rgba(0,0,0,.15);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
  font-family: 'Plus Jakarta Sans', sans-serif;
  background: #f8fafc;
  color: #1e293b;
  overflow-x: hidden;
}

/* =============================================
   NAVBAR
   ============================================= */
.navbar-custom {
  background: #fff;
  border-bottom: 1px solid #e2e8f0;
  padding: 14px 0;
  position: sticky;
  top: 0;
  z-index: 200;
  box-shadow: 0 1px 12px rgba(0,0,0,.06);
}

.navbar-custom .brand-icon {
  width: 38px;
  height: 38px;
  background: linear-gradient(135deg, var(--accent), var(--navy-mid));
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  box-shadow: 0 4px 10px rgba(59,130,246,.35);
}

.navbar-custom .brand-name {
  font-size: 17px;
  font-weight: 800;
  color: var(--navy);
  letter-spacing: -.3px;
}

.navbar-custom .brand-tagline {
  font-size: 11px;
  color: #94a3b8;
  font-weight: 500;
  margin-top: 1px;
}

.nav-link-custom {
  color: #64748b !important;
  font-size: 14px;
  font-weight: 600;
  padding: 8px 14px !important;
  border-radius: 8px;
  transition: all .2s;
  text-decoration: none;
}
.nav-link-custom:hover { background: var(--navy-light); color: var(--navy) !important; }

.btn-login-nav {
  background: linear-gradient(135deg, var(--navy), var(--navy-mid));
  color: #fff !important;
  border-radius: 10px;
  padding: 8px 20px !important;
  font-size: 13px;
  font-weight: 700;
  box-shadow: 0 3px 10px rgba(30,58,95,.3);
  transition: all .2s;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.btn-login-nav:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(30,58,95,.4); }

/* =============================================
   HERO SECTION
   ============================================= */
.hero {
  background: linear-gradient(135deg, #0f1e35 0%, var(--navy) 55%, var(--navy-mid) 100%);
  position: relative;
  overflow: hidden;
  padding: 80px 0 90px;
}

/* dekorasi latar */
.hero::before {
  content: '';
  position: absolute;
  width: 600px; height: 600px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(59,130,246,.12) 0%, transparent 70%);
  top: -180px; right: -180px;
  pointer-events: none;
}
.hero::after {
  content: '';
  position: absolute;
  width: 350px; height: 350px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(245,158,11,.07) 0%, transparent 70%);
  bottom: -100px; left: -80px;
  pointer-events: none;
}

/* grid dots dekorasi */
.hero-grid {
  position: absolute;
  inset: 0;
  background-image:
    radial-gradient(circle, rgba(255,255,255,.05) 1px, transparent 1px);
  background-size: 36px 36px;
  pointer-events: none;
}

.hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: rgba(255,255,255,.1);
  border: 1px solid rgba(255,255,255,.15);
  color: rgba(255,255,255,.9);
  font-size: 12px;
  font-weight: 700;
  padding: 6px 16px;
  border-radius: 50px;
  margin-bottom: 24px;
  letter-spacing: .04em;
  text-transform: uppercase;
  backdrop-filter: blur(10px);
}
.hero-badge span {
  width: 7px; height: 7px;
  background: var(--accent-2);
  border-radius: 50%;
  display: inline-block;
  animation: pulse-dot 1.8s infinite;
}
@keyframes pulse-dot {
  0%, 100% { opacity: 1; transform: scale(1); }
  50%       { opacity: .5; transform: scale(.7); }
}

.hero-title {
  font-family: 'DM Serif Display', serif;
  font-size: clamp(34px, 5vw, 58px);
  color: #fff;
  line-height: 1.12;
  letter-spacing: -.5px;
  margin-bottom: 20px;
}
.hero-title em { color: #93c5fd; font-style: italic; }

.hero-desc {
  font-size: 16px;
  color: rgba(255,255,255,.65);
  line-height: 1.7;
  max-width: 480px;
  margin-bottom: 36px;
}

.btn-hero-primary {
  background: linear-gradient(135deg, #3b82f6, var(--navy-mid));
  color: #fff;
  border: none;
  border-radius: 12px;
  padding: 14px 32px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 15px;
  font-weight: 700;
  box-shadow: 0 6px 20px rgba(59,130,246,.45);
  transition: all .25s;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.btn-hero-primary:hover { color: #fff; transform: translateY(-2px); box-shadow: 0 10px 30px rgba(59,130,246,.6); }

.btn-hero-outline {
  background: rgba(255,255,255,.08);
  color: rgba(255,255,255,.9);
  border: 1.5px solid rgba(255,255,255,.2);
  border-radius: 12px;
  padding: 13px 28px;
  font-size: 15px;
  font-weight: 600;
  transition: all .25s;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  backdrop-filter: blur(8px);
}
.btn-hero-outline:hover { background: rgba(255,255,255,.15); color: #fff; border-color: rgba(255,255,255,.4); }

/* hero stats bar */
.hero-stats {
  display: flex;
  gap: 40px;
  margin-top: 48px;
  padding-top: 36px;
  border-top: 1px solid rgba(255,255,255,.1);
}
.hero-stat-num {
  font-size: 28px;
  font-weight: 900;
  color: #fff;
  letter-spacing: -1px;
}
.hero-stat-label {
  font-size: 12px;
  color: rgba(255,255,255,.5);
  font-weight: 500;
  margin-top: 2px;
}

/* hero product visual */
.hero-visual {
  position: relative;
}
.hero-card-float {
  background: rgba(255,255,255,.08);
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 20px;
  padding: 24px;
  backdrop-filter: blur(12px);
  animation: float-card 4s ease-in-out infinite;
}
@keyframes float-card {
  0%, 100% { transform: translateY(0); }
  50%       { transform: translateY(-10px); }
}
.hero-card-float .card-label {
  font-size: 11px;
  color: rgba(255,255,255,.5);
  text-transform: uppercase;
  letter-spacing: .1em;
  font-weight: 700;
  margin-bottom: 12px;
}
.hero-img-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
}
.hero-img-item {
  border-radius: 12px;
  overflow: hidden;
  aspect-ratio: 1;
  background: rgba(255,255,255,.06);
  display: flex;
  align-items: center;
  justify-content: center;
}
.hero-img-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.hero-img-placeholder {
  color: rgba(255,255,255,.2);
  font-size: 11px;
  text-align: center;
  padding: 10px;
}

/* =============================================
   SECTION PRODUK
   ============================================= */
.section-header {
  margin-bottom: 40px;
}
.section-badge {
  display: inline-block;
  background: var(--navy-light);
  color: var(--navy-mid);
  font-size: 11px;
  font-weight: 800;
  letter-spacing: .12em;
  text-transform: uppercase;
  padding: 5px 14px;
  border-radius: 50px;
  margin-bottom: 12px;
}
.section-title {
  font-family: 'DM Serif Display', serif;
  font-size: clamp(26px, 4vw, 38px);
  color: var(--navy);
  letter-spacing: -.4px;
  line-height: 1.2;
}
.section-desc {
  color: #64748b;
  font-size: 15px;
  margin-top: 10px;
  max-width: 500px;
}

/* =============================================
   PRODUCT CARD
   ============================================= */
.product-card {
  background: #fff;
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  overflow: hidden;
  transition: transform .25s, box-shadow .25s;
  height: 100%;
  display: flex;
  flex-direction: column;
  border: 1px solid #f1f5f9;
}
.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 16px 40px rgba(0,0,0,.14);
}

.product-img-wrap {
  position: relative;
  overflow: hidden;
  background: var(--navy-light);
  aspect-ratio: 4/3;
}
.product-img-wrap img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform .4s;
}
.product-card:hover .product-img-wrap img { transform: scale(1.05); }

.product-img-placeholder {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 8px;
  color: #94a3b8;
  font-size: 12px;
  font-weight: 600;
}

.product-badge-stok {
  position: absolute;
  top: 12px;
  left: 12px;
  font-size: 11px;
  font-weight: 700;
  padding: 3px 10px;
  border-radius: 50px;
}
.badge-habis   { background: #fef2f2; color: #ef4444; }
.badge-terbatas { background: #fffbeb; color: #d97706; }
.badge-tersedia { background: #f0fdf4; color: #16a34a; }

.product-body {
  padding: 18px 20px;
  flex: 1;
  display: flex;
  flex-direction: column;
}
.product-name {
  font-size: 15px;
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 6px;
  line-height: 1.4;
}
.product-price {
  font-size: 18px;
  font-weight: 800;
  color: var(--navy);
  margin-bottom: 4px;
}
.product-stok-label {
  font-size: 12px;
  color: #94a3b8;
  margin-bottom: 16px;
  flex: 1;
}

.btn-detail {
  background: linear-gradient(135deg, var(--navy), var(--navy-mid));
  color: #fff;
  border: none;
  border-radius: 9px;
  padding: 10px 16px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 13px;
  font-weight: 600;
  width: 100%;
  transition: all .2s;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  text-decoration: none;
  cursor: pointer;
}
.btn-detail:hover { color: #fff; transform: translateY(-1px); box-shadow: 0 5px 14px rgba(30,58,95,.35); }

/* =============================================
   SEARCH / FILTER BAR
   ============================================= */
.filter-bar {
  background: #fff;
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  padding: 20px 24px;
  margin-bottom: 36px;
  border: 1px solid #f1f5f9;
}
.search-input {
  border-radius: 10px;
  border: 1.5px solid #e2e8f0;
  background: #f8fafc;
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 14px;
  padding: 10px 14px 10px 42px;
  transition: all .2s;
  width: 100%;
  outline: none;
  color: #1e293b;
}
.search-input:focus {
  border-color: var(--navy-mid);
  background: #fff;
  box-shadow: 0 0 0 3px rgba(45,106,159,.12);
}
.search-wrap { position: relative; }
.search-ico {
  position: absolute;
  left: 13px;
  top: 50%;
  transform: translateY(-50%);
  color: #94a3b8;
  pointer-events: none;
}

.sort-select {
  border-radius: 10px;
  border: 1.5px solid #e2e8f0;
  background: #f8fafc;
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 14px;
  padding: 10px 14px;
  transition: all .2s;
  outline: none;
  color: #1e293b;
  cursor: pointer;
}
.sort-select:focus { border-color: var(--navy-mid); background: #fff; box-shadow: 0 0 0 3px rgba(45,106,159,.12); }

.filter-count {
  font-size: 13px;
  color: #64748b;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 6px;
}
.filter-count strong { color: var(--navy); font-weight: 800; }

/* =============================================
   EMPTY STATE
   ============================================= */
.empty-state {
  text-align: center;
  padding: 80px 20px;
  color: #94a3b8;
}
.empty-state svg { margin-bottom: 20px; opacity: .4; }
.empty-state h4 { font-size: 18px; font-weight: 700; color: #64748b; margin-bottom: 8px; }
.empty-state p { font-size: 14px; }

/* =============================================
   FITUR / WHY US
   ============================================= */
.features-section {
  background: linear-gradient(135deg, #0f1e35 0%, var(--navy) 100%);
  padding: 72px 0;
  position: relative;
  overflow: hidden;
}
.features-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: radial-gradient(circle, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 40px 40px;
  pointer-events: none;
}
.feature-item {
  display: flex;
  align-items: flex-start;
  gap: 18px;
}
.feature-icon {
  width: 52px;
  height: 52px;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.feature-icon.blue   { background: rgba(59,130,246,.2); }
.feature-icon.amber  { background: rgba(245,158,11,.2); }
.feature-icon.green  { background: rgba(16,185,129,.2); }
.feature-icon.purple { background: rgba(139,92,246,.2); }
.feature-title { font-size: 16px; font-weight: 700; color: #fff; margin-bottom: 6px; }
.feature-desc  { font-size: 13px; color: rgba(255,255,255,.5); line-height: 1.6; }

/* =============================================
   FOOTER
   ============================================= */
.footer-public {
  background: #0f1e35;
  color: #e2e8f0;
  padding: 56px 0 28px;
}
.footer-public h5 { color: #fff; font-weight: 800; font-size: 17px; margin-bottom: 6px; }
.footer-public h6 { color: #fff; font-weight: 700; font-size: 13px; margin-bottom: 14px; }
.footer-public p  { font-size: 13px; color: rgba(255,255,255,.45); line-height: 1.7; }
.footer-public ul { list-style: none; padding: 0; }
.footer-public ul li { margin-bottom: 8px; }
.footer-public ul li a {
  color: rgba(255,255,255,.45);
  text-decoration: none;
  font-size: 13px;
  transition: color .2s;
}
.footer-public ul li a:hover { color: #fff; }
.footer-contact-item {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 13px;
  color: rgba(255,255,255,.45);
  margin-bottom: 10px;
}
.footer-contact-item svg { flex-shrink: 0; color: var(--accent); }
.footer-divider { border-color: rgba(255,255,255,.08); margin: 36px 0 24px; }
.footer-copy { font-size: 12px; color: rgba(255,255,255,.3); text-align: center; }

/* =============================================
   MODAL DETAIL PRODUK
   ============================================= */
.modal-content { border: none; border-radius: 20px; overflow: hidden; box-shadow: var(--shadow-lg); }
.modal-header-custom {
  background: linear-gradient(135deg, var(--navy), var(--navy-mid));
  padding: 20px 24px;
  border: none;
  position: relative;
}
.modal-header-custom::before {
  content: '';
  position: absolute;
  top: -20px; right: -20px;
  width: 80px; height: 80px;
  border-radius: 50%;
  background: rgba(255,255,255,.07);
}
.modal-header-custom .modal-title { color: #fff; font-weight: 700; font-size: 16px; }
.btn-close-custom { background: rgba(255,255,255,.15) !important; border-radius: 8px !important; filter: none !important; }
.btn-close-custom:hover { background: rgba(255,255,255,.25) !important; }
.modal-body { padding: 28px; }
.modal-product-img {
  width: 100%;
  border-radius: 14px;
  aspect-ratio: 4/3;
  object-fit: cover;
  background: var(--navy-light);
}
.modal-product-name { font-size: 20px; font-weight: 800; color: #1e293b; margin-bottom: 8px; }
.modal-product-price { font-size: 26px; font-weight: 900; color: var(--navy); margin-bottom: 16px; }
.modal-info-row { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; font-size: 14px; color: #64748b; }
.modal-info-row svg { color: var(--navy-mid); flex-shrink: 0; }
.modal-info-row strong { color: #1e293b; }

/* =============================================
   ANIMASI MASUK
   ============================================= */
@keyframes fade-up {
  from { opacity: 0; transform: translateY(24px); }
  to   { opacity: 1; transform: translateY(0); }
}
.animate-fade-up { animation: fade-up .5s ease both; }
.delay-1 { animation-delay: .1s; }
.delay-2 { animation-delay: .2s; }
.delay-3 { animation-delay: .3s; }
.delay-4 { animation-delay: .4s; }

/* =============================================
   RESPONSIVE
   ============================================= */
@media (max-width: 768px) {
  .hero { padding: 52px 0 60px; }
  .hero-stats { gap: 24px; }
  .hero-visual { margin-top: 40px; }
  .btn-hero-primary, .btn-hero-outline { font-size: 14px; padding: 12px 22px; }
}
</style>
</head>
<body>

<!-- =============================================
     NAVBAR
     ============================================= -->
<nav class="navbar-custom">
  <div class="container">
    <div class="d-flex align-items-center justify-content-between">

      <!-- Brand -->
      <a href="public_index.php" class="d-flex align-items-center gap-3" style="text-decoration:none;">
        <div class="brand-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline points="9 22 9 12 15 12 15 22"/>
          </svg>
        </div>
        <div>
          <div class="brand-name">UMKM Shop</div>
          <div class="brand-tagline">Produk Lokal Berkualitas</div>
        </div>
      </a>

      <!-- Nav Links -->
      <div class="d-none d-md-flex align-items-center gap-1">
        <a href="#produk" class="nav-link-custom">Produk</a>
        <a href="#tentang" class="nav-link-custom">Tentang Kami</a>
        <a href="#kontak" class="nav-link-custom">Kontak</a>
      </div>

      <!-- Login Button -->
      <div class="d-flex align-items-center gap-2">
        <a href="staff_themed/login.php" class="nav-link-custom d-none d-md-flex align-items-center gap-1">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
          Staff
        </a>
        <a href="admin_themed/login.php" class="btn-login-nav">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          Login Admin
        </a>
      </div>

    </div>
  </div>
</nav>


<!-- =============================================
     HERO SECTION
     ============================================= -->
<section class="hero">
  <div class="hero-grid"></div>
  <div class="container position-relative">
    <div class="row align-items-center gy-4">

      <div class="col-lg-6">
        <div class="hero-badge animate-fade-up">
          <span></span> Produk Lokal Terpercaya
        </div>
        <h1 class="hero-title animate-fade-up delay-1">
          Temukan Produk <em>Terbaik</em> dari UMKM Kami
        </h1>
        <p class="hero-desc animate-fade-up delay-2">
          Kami menghadirkan produk-produk berkualitas hasil karya UMKM lokal. Belanja langsung, harga transparan, dan stok selalu diperbarui.
        </p>
        <div class="d-flex flex-wrap gap-3 animate-fade-up delay-3">
          <a href="#produk" class="btn-hero-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            Lihat Produk
          </a>
          <a href="#tentang" class="btn-hero-outline">
            Tentang Kami
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </a>
        </div>

        <div class="hero-stats animate-fade-up delay-4">
          <div>
            <div class="hero-stat-num"><?php echo $total_produk; ?>+</div>
            <div class="hero-stat-label">Produk Tersedia</div>
          </div>
          <div>
            <div class="hero-stat-num">100%</div>
            <div class="hero-stat-label">Produk Lokal</div>
          </div>
          <div>
            <div class="hero-stat-num">Fast</div>
            <div class="hero-stat-label">Update Stok</div>
          </div>
        </div>
      </div>

      <div class="col-lg-5 offset-lg-1">
        <div class="hero-visual animate-fade-up delay-2">
          <div class="hero-card-float">
            <div class="card-label">Produk Terbaru</div>
            <div class="hero-img-grid">
              <?php
              // Ambil 4 produk pertama untuk preview hero
              $hero_produk = mysqli_query($conn, "SELECT * FROM produk WHERE stok > 0 ORDER BY id_produk DESC LIMIT 4");
              $hero_count = 0;
              while ($hp = mysqli_fetch_array($hero_produk)) {
                $hero_count++;
                echo '<div class="hero-img-item">';
                if ($hp['gambar'] != '') {
                  echo '<img src="admin_themed/gambar/' . htmlspecialchars($hp['gambar']) . '" alt="' . htmlspecialchars($hp['nama_produk']) . '">';
                } else {
                  echo '<div class="hero-img-placeholder">';
                  echo '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.3)" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>';
                  echo '<span style="color:rgba(255,255,255,.3);font-size:10px;">' . htmlspecialchars(substr($hp['nama_produk'], 0, 12)) . '</span>';
                  echo '</div>';
                }
                echo '</div>';
              }
              // jika produk < 4, isi placeholder kosong
              for ($i = $hero_count; $i < 4; $i++) {
                echo '<div class="hero-img-item"><div class="hero-img-placeholder"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.15)" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></div></div>';
              }
              ?>
            </div>

            <div style="margin-top:14px;padding-top:14px;border-top:1px solid rgba(255,255,255,.1);display:flex;align-items:center;justify-content:space-between;">
              <span style="color:rgba(255,255,255,.5);font-size:12px;">Stok diperbarui otomatis</span>
              <span style="background:rgba(16,185,129,.2);color:#6ee7b7;font-size:11px;font-weight:700;padding:3px 10px;border-radius:50px;">● Live</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- =============================================
     SECTION PRODUK
     ============================================= -->
<section class="py-5" id="produk" style="padding-top:64px!important;padding-bottom:72px!important;">
  <div class="container">

    <div class="section-header animate-fade-up">
      <div class="section-badge">Katalog Produk</div>
      <h2 class="section-title">Semua Produk Kami</h2>
      <p class="section-desc">Temukan produk pilihan dengan harga terbaik. Stok selalu tersedia dan diupdate secara berkala.</p>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar animate-fade-up">
      <div class="row align-items-center gy-3">
        <div class="col-md-5">
          <div class="search-wrap">
            <svg class="search-ico" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" class="search-input" id="searchProduk" placeholder="Cari produk...">
          </div>
        </div>
        <div class="col-md-3">
          <select class="sort-select w-100" id="sortProduk">
            <option value="">Urutkan</option>
            <option value="harga-asc">Harga: Rendah ke Tinggi</option>
            <option value="harga-desc">Harga: Tinggi ke Rendah</option>
            <option value="nama-asc">Nama: A–Z</option>
            <option value="nama-desc">Nama: Z–A</option>
          </select>
        </div>
        <div class="col-md-4 text-md-end">
          <div class="filter-count">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            Menampilkan <strong id="jumlahTampil"><?php echo $total_produk; ?></strong> produk
          </div>
        </div>
      </div>
    </div>

    <!-- Grid Produk -->
    <div class="row g-4" id="gridProduk">
      <?php
      // Reset pointer query
      mysqli_data_seek($produk_query, 0);
      while ($d = mysqli_fetch_array($produk_query)):
        $stok = (int)$d['stok'];
        if ($stok > 10) {
          $badge_class = 'badge-tersedia'; $badge_text = 'Tersedia';
        } elseif ($stok > 0) {
          $badge_class = 'badge-terbatas'; $badge_text = 'Stok Terbatas';
        } else {
          $badge_class = 'badge-habis'; $badge_text = 'Habis';
        }
      ?>
      <div class="col-sm-6 col-lg-4 col-xl-3 product-item animate-fade-up"
           data-nama="<?php echo strtolower(htmlspecialchars($d['nama_produk'])); ?>"
           data-harga="<?php echo $d['harga']; ?>">
        <div class="product-card">
          <div class="product-img-wrap">
            <?php if ($d['gambar'] != ''): ?>
              <img src="admin_themed/gambar/<?php echo htmlspecialchars($d['gambar']); ?>"
                   alt="<?php echo htmlspecialchars($d['nama_produk']); ?>">
            <?php else: ?>
              <div class="product-img-placeholder">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5">
                  <rect x="3" y="3" width="18" height="18" rx="2"/>
                  <circle cx="8.5" cy="8.5" r="1.5"/>
                  <polyline points="21 15 16 10 5 21"/>
                </svg>
                <span>Belum ada foto</span>
              </div>
            <?php endif; ?>
            <span class="product-badge-stok <?php echo $badge_class; ?>"><?php echo $badge_text; ?></span>
          </div>

          <div class="product-body">
            <div class="product-name"><?php echo htmlspecialchars($d['nama_produk']); ?></div>
            <div class="product-price">Rp <?php echo number_format($d['harga'], 0, ',', '.'); ?></div>
            <div class="product-stok-label">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline;margin-right:4px;"><polyline points="20 12 20 22 4 22"/><rect x="2" y="7" width="20" height="5"/><path d="M12 22V7"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>
              Stok: <strong><?php echo $stok; ?></strong> unit
            </div>
            <button class="btn-detail"
                    onclick="showDetail('<?php echo htmlspecialchars($d['nama_produk'], ENT_QUOTES); ?>',
                                        '<?php echo $d['harga']; ?>',
                                        '<?php echo $stok; ?>',
                                        '<?php echo $d['gambar'] != '' ? "admin_themed/gambar/" . htmlspecialchars($d['gambar']) : ""; ?>')">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
              Lihat Detail
            </button>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>

    <!-- Empty state -->
    <div class="empty-state d-none" id="emptyState">
      <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <circle cx="11" cy="11" r="8"/>
        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
      </svg>
      <h4>Produk Tidak Ditemukan</h4>
      <p>Coba kata kunci lain atau hapus filter pencarian.</p>
    </div>

  </div>
</section>


<!-- =============================================
     FITUR / WHY US
     ============================================= -->
<section class="features-section" id="tentang">
  <div class="container position-relative">

    <div class="text-center mb-5">
      <div class="section-badge" style="background:rgba(255,255,255,.1);color:rgba(255,255,255,.7);">Mengapa Kami?</div>
      <h2 class="section-title" style="color:#fff;margin:0 auto;">Keunggulan Berbelanja di Sini</h2>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="feature-item">
          <div class="feature-icon blue">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          </div>
          <div>
            <div class="feature-title">Produk Terpercaya</div>
            <div class="feature-desc">Semua produk dikelola dan dikurasi langsung oleh tim kami.</div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="feature-item">
          <div class="feature-icon amber">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
          </div>
          <div>
            <div class="feature-title">Harga Transparan</div>
            <div class="feature-desc">Harga yang ditampilkan adalah harga final, tanpa biaya tersembunyi.</div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="feature-item">
          <div class="feature-icon green">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#34d399" stroke-width="2"><polyline points="20 12 20 22 4 22"/><rect x="2" y="7" width="20" height="5"/><path d="M12 22V7"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>
          </div>
          <div>
            <div class="feature-title">Stok Real-Time</div>
            <div class="feature-desc">Data stok selalu diperbarui secara langsung oleh staf kami.</div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="feature-item">
          <div class="feature-icon purple">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <div>
            <div class="feature-title">Produk UMKM Lokal</div>
            <div class="feature-desc">Mendukung pertumbuhan UMKM dan ekonomi lokal Indonesia.</div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>


<!-- =============================================
     FOOTER
     ============================================= -->
<footer class="footer-public" id="kontak">
  <div class="container">
    <div class="row gy-5">

      <div class="col-md-4">
        <div class="d-flex align-items-center gap-3 mb-16" style="margin-bottom:16px;">
          <div style="width:38px;height:38px;background:linear-gradient(135deg,var(--accent),var(--navy-mid));border-radius:10px;display:flex;align-items:center;justify-content:center;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          </div>
          <h5 style="margin:0;">UMKM Shop</h5>
        </div>
        <p>Sistem manajemen dan katalog produk untuk membantu pengelolaan UMKM secara efisien dan transparan.</p>
      </div>

      <div class="col-md-2">
        <h6>Navigasi</h6>
        <ul>
          <li><a href="public_index.php">Beranda</a></li>
          <li><a href="#produk">Produk</a></li>
          <li><a href="#tentang">Tentang</a></li>
          <li><a href="#kontak">Kontak</a></li>
        </ul>
      </div>

      <div class="col-md-2">
        <h6>Akses</h6>
        <ul>
          <li><a href="admin_themed/login.php">Login Admin</a></li>
          <li><a href="staff_themed/login.php">Login Staff</a></li>
        </ul>
      </div>

      <div class="col-md-4">
        <h6>Kontak Kami</h6>
        <div class="footer-contact-item">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          Cirebon, Jawa Barat, Indonesia
        </div>
        <div class="footer-contact-item">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          bahlilbahenol@umkm.com
        </div>
        <div class="footer-contact-item">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.65 3.34 2 2 0 0 1 3.64 1h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          0822-3104-4662
        </div>
      </div>

    </div>
    <hr class="footer-divider">
    <div class="footer-copy">
      © <?php echo date("Y"); ?> UMKM Shop — Semua hak dilindungi. Dibuat dengan ❤️ untuk UMKM Indonesia.
    </div>
  </div>
</footer>


<!-- =============================================
     MODAL DETAIL PRODUK
     ============================================= -->
<div class="modal fade" id="modalDetail" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header-custom d-flex align-items-center justify-content-between">
        <h5 class="modal-title">Detail Produk</h5>
        <button type="button" class="btn-close btn-close-custom btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-4">
          <div class="col-md-5">
            <img id="modalImg" src="" alt="" class="modal-product-img"
                 onerror="this.style.display='none';document.getElementById('modalImgPlaceholder').style.display='flex'">
            <div id="modalImgPlaceholder" style="display:none;width:100%;aspect-ratio:4/3;border-radius:14px;background:var(--navy-light);align-items:center;justify-content:center;flex-direction:column;gap:8px;color:#94a3b8;">
              <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
              <span style="font-size:12px;font-weight:600;">Belum ada foto</span>
            </div>
          </div>
          <div class="col-md-7">
            <h4 class="modal-product-name" id="modalNama">—</h4>
            <div class="modal-product-price" id="modalHarga">Rp 0</div>

            <div class="modal-info-row">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 12 20 22 4 22"/><rect x="2" y="7" width="20" height="5"/></svg>
              Stok: <strong id="modalStok">0</strong> unit
            </div>
            <div class="modal-info-row" id="modalStatusRow">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
              Status: <strong id="modalStatus">—</strong>
            </div>

            <div style="margin-top:20px;padding:14px;background:var(--navy-light);border-radius:10px;font-size:13px;color:var(--navy);font-weight:600;display:flex;align-items:center;gap:8px;">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
              Untuk pembelian, hubungi staf kami secara langsung.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- =============================================
     SCRIPTS
     ============================================= -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Modal Detail
function showDetail(nama, harga, stok, gambar) {
  document.getElementById('modalNama').textContent  = nama;
  document.getElementById('modalHarga').textContent = 'Rp ' + parseInt(harga).toLocaleString('id-ID');
  document.getElementById('modalStok').textContent  = stok;

  const stokInt = parseInt(stok);
  const statusEl = document.getElementById('modalStatus');
  if (stokInt > 10) {
    statusEl.textContent = 'Tersedia';
    statusEl.style.color = '#16a34a';
  } else if (stokInt > 0) {
    statusEl.textContent = 'Stok Terbatas (' + stok + ' tersisa)';
    statusEl.style.color = '#d97706';
  } else {
    statusEl.textContent = 'Habis';
    statusEl.style.color = '#ef4444';
  }

  const imgEl = document.getElementById('modalImg');
  const phEl  = document.getElementById('modalImgPlaceholder');
  if (gambar) {
    imgEl.src = gambar;
    imgEl.style.display = 'block';
    phEl.style.display  = 'none';
  } else {
    imgEl.style.display = 'none';
    phEl.style.display  = 'flex';
  }

  new bootstrap.Modal(document.getElementById('modalDetail')).show();
}

// Search & Sort
const items   = document.querySelectorAll('.product-item');
const searchEl = document.getElementById('searchProduk');
const sortEl   = document.getElementById('sortProduk');
const grid     = document.getElementById('gridProduk');
const countEl  = document.getElementById('jumlahTampil');
const emptyEl  = document.getElementById('emptyState');

function filterAndSort() {
  const q    = searchEl.value.toLowerCase().trim();
  const sort = sortEl.value;

  let arr = Array.from(items);

  // Filter by search
  arr.forEach(el => {
    const nama = el.dataset.nama || '';
    el.style.display = nama.includes(q) ? '' : 'none';
  });

  // Sort visible items
  const visible = arr.filter(el => el.style.display !== 'none');
  visible.sort((a, b) => {
    const ha = parseFloat(a.dataset.harga), hb = parseFloat(b.dataset.harga);
    const na = a.dataset.nama, nb = b.dataset.nama;
    if (sort === 'harga-asc')  return ha - hb;
    if (sort === 'harga-desc') return hb - ha;
    if (sort === 'nama-asc')   return na.localeCompare(nb);
    if (sort === 'nama-desc')  return nb.localeCompare(na);
    return 0;
  });

  // Re-append sorted items
  visible.forEach(el => grid.appendChild(el));

  // Update count
  countEl.textContent = visible.length;
  emptyEl.classList.toggle('d-none', visible.length > 0);
}

searchEl.addEventListener('input', filterAndSort);
sortEl.addEventListener('change', filterAndSort);

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', e => {
    const target = document.querySelector(a.getAttribute('href'));
    if (target) {
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});
</script>

</body>
</html>
