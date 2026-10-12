<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Admin | UMKM</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;}
body{min-height:100vh;display:flex;align-items:center;justify-content:center;font-family:'Plus Jakarta Sans',sans-serif;background:linear-gradient(135deg,#0f1e35 0%,#1e3a5f 50%,#2d6a9f 100%);position:relative;overflow:hidden;}
body::before{content:'';position:absolute;width:500px;height:500px;border-radius:50%;background:rgba(59,130,246,.08);top:-150px;right:-150px;}
body::after{content:'';position:absolute;width:300px;height:300px;border-radius:50%;background:rgba(45,106,159,.1);bottom:-80px;left:-80px;}
.login-wrapper{width:100%;max-width:420px;position:relative;z-index:1;padding:20px;}
.card-login{border:none;border-radius:20px;box-shadow:0 25px 60px rgba(0,0,0,.4);overflow:hidden;background:#fff;}
.login-header{background:linear-gradient(135deg,#1e3a5f,#2d6a9f);padding:36px 32px 28px;text-align:center;position:relative;}
.login-header::before{content:'';position:absolute;top:-20px;right:-20px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.06);}
.brand-icon{width:56px;height:56px;background:rgba(255,255,255,.15);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;backdrop-filter:blur(10px);}
.login-header h4{color:#fff;font-size:20px;font-weight:800;margin:0;letter-spacing:-.3px;}
.login-header p{color:rgba(255,255,255,.6);font-size:13px;margin:6px 0 0;}
.login-body{padding:32px;}
.form-label{font-weight:600;font-size:13px;color:#374151;margin-bottom:6px;}
.form-control{border-radius:10px;border:1.5px solid #e2e8f0;background:#f8fafc;font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;padding:10px 14px 10px 42px;transition:all .2s;}
.form-control:focus{border-color:#2d6a9f;background:#fff;box-shadow:0 0 0 3px rgba(45,106,159,.12);outline:none;}
.input-wrap{position:relative;}
.input-ico{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:#9ca3af;pointer-events:none;}
.btn-login{width:100%;padding:12px;background:linear-gradient(135deg,#1e3a5f,#2d6a9f);color:#fff;border:none;border-radius:10px;font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;font-weight:700;cursor:pointer;transition:all .2s;box-shadow:0 4px 14px rgba(30,58,95,.4);letter-spacing:.01em;}
.btn-login:hover{transform:translateY(-1px);box-shadow:0 8px 20px rgba(30,58,95,.5);}
.captcha-row{display:flex;align-items:center;gap:10px;margin-bottom:6px;}
.captcha-row img{border-radius:8px;border:1.5px solid #e2e8f0;height:44px;}
.refresh-btn{background:none;border:1.5px solid #e2e8f0;border-radius:8px;padding:8px 10px;cursor:pointer;color:#64748b;transition:all .2s;display:flex;align-items:center;}
.refresh-btn:hover{border-color:#2d6a9f;color:#2d6a9f;}
.footer-note{text-align:center;font-size:12px;color:#9ca3af;margin-top:20px;}
.alert{border-radius:10px;font-size:13px;font-weight:500;}
</style>
</head>
<body>

<div class="login-wrapper">
<div class="card-login">

  <div class="login-header">
    <div class="brand-icon">
      <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
    </div>
    <h4>Admin UMKM</h4>
    <p>Masuk untuk mengakses dashboard</p>
  </div>

  <div class="login-body">

    <?php if(isset($_GET['pesan'])){ ?>
    <div class="alert alert-danger mb-3">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      Login gagal. Periksa username, password, atau captcha.
    </div>
    <?php } ?>

    <form method="POST" action="proses_login.php">

      <div class="mb-3">
        <label class="form-label">Username</label>
        <div class="input-wrap">
          <svg class="input-ico" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <div class="input-wrap">
          <svg class="input-ico" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>
      </div>

      <div class="mb-4">
        <label class="form-label">Verifikasi Captcha</label>
        <div class="captcha-row">
          <img src="captcha.php" id="captchaImg" alt="captcha">
          <button type="button" class="refresh-btn" onclick="document.getElementById('captchaImg').src='captcha.php?'+Date.now()">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
          </button>
        </div>
        <div class="input-wrap">
          <svg class="input-ico" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
          <input type="text" name="captcha" class="form-control" placeholder="Masukkan teks captcha" required>
        </div>
      </div>

      <button type="submit" class="btn-login">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="margin-right:7px"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
        Masuk
      </button>

    </form>

    <div class="footer-note">© <?php echo date("Y"); ?> Sistem Admin UMKM</div>
  </div>

</div>
</div>

</body>
</html>
