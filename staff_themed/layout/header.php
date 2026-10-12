<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Staff</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--navy:#1e3a5f;--navy-mid:#2d6a9f;--navy-light:#e8f0fb;--accent:#3b82f6;--sidebar-w:260px;--radius:14px;--shadow:0 4px 6px -1px rgba(0,0,0,.07),0 10px 30px -5px rgba(0,0,0,.1);}
*,*::before,*::after{box-sizing:border-box;}
body{font-family:'Plus Jakarta Sans',sans-serif;background:#f1f5f9;overflow-x:hidden;color:#1e293b;}

/* SIDEBAR */
.sidebar{width:var(--sidebar-w);height:100vh;position:fixed;top:0;left:0;background:linear-gradient(180deg,var(--navy) 0%,#162d4a 100%);display:flex;flex-direction:column;z-index:100;box-shadow:4px 0 20px rgba(0,0,0,.15);}
.sidebar-brand{padding:28px 24px 20px;border-bottom:1px solid rgba(255,255,255,.08);}
.sidebar-brand .brand-icon{width:42px;height:42px;background:linear-gradient(135deg,var(--accent),var(--navy-mid));border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:10px;box-shadow:0 4px 12px rgba(59,130,246,.4);}
.sidebar-brand h4{color:#fff;font-size:16px;font-weight:700;margin:0;letter-spacing:-.2px;}
.sidebar-brand p{color:rgba(255,255,255,.45);font-size:11px;margin:2px 0 0;}
.sidebar-nav{padding:16px 12px;flex:1;overflow-y:auto;}
.nav-label{color:rgba(255,255,255,.3);font-size:10px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:8px 12px 6px;display:block;}
.sidebar a{display:flex;align-items:center;gap:10px;padding:10px 14px;color:rgba(255,255,255,.65);text-decoration:none;border-radius:10px;font-size:14px;font-weight:500;transition:all .2s;margin-bottom:2px;}
.sidebar a svg{flex-shrink:0;opacity:.7;transition:opacity .2s;}
.sidebar a:hover{background:rgba(255,255,255,.08);color:#fff;}
.sidebar a:hover svg{opacity:1;}

/* DROPDOWN SIDEBAR */
.sidebar-dropdown{margin-bottom:2px;}
.sidebar-dropdown-toggle{display:flex;align-items:center;gap:10px;padding:10px 14px;color:rgba(255,255,255,.65);text-decoration:none;border-radius:10px;font-size:14px;font-weight:500;transition:all .2s;cursor:pointer;width:100%;background:none;border:none;text-align:left;}
.sidebar-dropdown-toggle:hover{background:rgba(255,255,255,.08);color:#fff;}
.sidebar-dropdown-toggle svg{flex-shrink:0;opacity:.7;}
.sidebar-dropdown-arrow{margin-left:auto;transition:transform .2s;opacity:.5;}
.sidebar-dropdown-toggle.open .sidebar-dropdown-arrow{transform:rotate(180deg);}
.sidebar-dropdown-menu{display:none;padding:4px 0 4px 36px;}
.sidebar-dropdown-menu.show{display:block;}
.sidebar-dropdown-menu a{padding:8px 12px;font-size:13px;color:rgba(255,255,255,.55);}
.sidebar-dropdown-menu a:hover{color:#fff;background:rgba(255,255,255,.06);}

.sidebar-footer{padding:14px 12px;border-top:1px solid rgba(255,255,255,.08);}
.sidebar-footer a{display:flex;align-items:center;gap:10px;padding:10px 14px;color:rgba(255,255,255,.5);text-decoration:none;border-radius:10px;font-size:14px;font-weight:500;transition:all .2s;}
.sidebar-footer a:hover{background:rgba(239,68,68,.15);color:#fca5a5;}

/* TOPBAR */
.topbar{margin-left:var(--sidebar-w);background:#fff;padding:14px 28px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #e2e8f0;position:sticky;top:0;z-index:50;box-shadow:0 1px 3px rgba(0,0,0,.05);}
.topbar-left{font-size:14px;color:#64748b;}
.topbar-left b{color:#1e293b;font-weight:700;}
.topbar-badge{display:inline-flex;align-items:center;gap:6px;background:var(--navy-light);color:var(--navy);font-size:12px;font-weight:600;padding:5px 12px;border-radius:20px;}

/* MAIN */
.main{margin-left:var(--sidebar-w);padding:0 28px 28px;min-height:calc(100vh - 90px);}

/* PAGE HEADING */
.page-heading{padding:28px 0 18px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;}
.page-heading h3{font-size:22px;font-weight:800;color:#1e293b;margin:0;letter-spacing:-.3px;}
.page-heading p{color:#64748b;font-size:13px;margin:3px 0 0;}

/* CARD */
.card{border:none;border-radius:var(--radius);box-shadow:var(--shadow);background:#fff;}
.card-header-themed{background:linear-gradient(135deg,var(--navy) 0%,var(--navy-mid) 100%);padding:20px 24px;border-radius:var(--radius) var(--radius) 0 0;position:relative;overflow:hidden;}
.card-header-themed::before{content:'';position:absolute;top:-30px;right:-30px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.06);}
.card-header-themed h5{color:#fff;font-size:16px;font-weight:700;margin:0;}
.card-header-themed p{color:rgba(255,255,255,.6);font-size:12px;margin:4px 0 0;}
.card-body-themed{padding:24px;}

/* STAT CARDS */
.stat-card{background:#fff;border-radius:var(--radius);padding:22px;box-shadow:var(--shadow);display:flex;align-items:center;gap:16px;transition:transform .2s,box-shadow .2s;}
.stat-card:hover{transform:translateY(-2px);box-shadow:0 8px 30px rgba(0,0,0,.12);}
.stat-icon{width:52px;height:52px;border-radius:14px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.stat-icon.blue{background:linear-gradient(135deg,#3b82f6,#1e40af);}
.stat-icon.green{background:linear-gradient(135deg,#10b981,#065f46);}
.stat-icon.orange{background:linear-gradient(135deg,#f59e0b,#b45309);}
.stat-icon svg{color:#fff;}
.stat-info h3{font-size:26px;font-weight:800;margin:0;color:#1e293b;}
.stat-info p{font-size:13px;color:#64748b;margin:2px 0 0;}

/* TABLE */
.table{font-size:14px;}
.table thead th{background:var(--navy-light);color:var(--navy);font-weight:700;font-size:12px;text-transform:uppercase;letter-spacing:.05em;border:none;padding:12px 16px;}
.table tbody td{padding:12px 16px;vertical-align:middle;border-color:#f1f5f9;}
.table tbody tr:hover{background:#f8faff;}

/* BUTTONS */
.btn-navy{background:linear-gradient(135deg,var(--navy),var(--navy-mid));color:#fff;border:none;border-radius:8px;padding:9px 20px;font-family:'Plus Jakarta Sans',sans-serif;font-size:13px;font-weight:600;box-shadow:0 2px 8px rgba(30,58,95,.3);transition:all .2s;}
.btn-navy:hover{color:#fff;transform:translateY(-1px);box-shadow:0 5px 14px rgba(30,58,95,.4);}
.btn-warning{border-radius:8px;font-size:12px;font-weight:600;}
.btn-danger{border-radius:8px;font-size:12px;font-weight:600;}
.btn-success{border-radius:8px;font-weight:600;}
.btn-primary{border-radius:8px;font-weight:600;}
.btn-secondary{border-radius:8px;font-weight:600;}

/* FORM */
.form-control,.form-select{border-radius:10px;border:1.5px solid #e2e8f0;background:#f8fafc;font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;padding:10px 14px;transition:all .2s;}
.form-control:focus,.form-select:focus{border-color:var(--navy-mid);background:#fff;box-shadow:0 0 0 3px rgba(45,106,159,.12);}
.form-label{font-weight:600;font-size:13px;color:#374151;margin-bottom:6px;}

/* FOOTER */
.footer{margin-left:var(--sidebar-w);background:linear-gradient(135deg,var(--navy) 0%,#162d4a 100%);color:#e2e8f0;padding:36px 28px 24px;}
.footer h5,.footer h6{color:#fff;font-weight:700;}
.footer p,.footer li{font-size:13px;color:rgba(255,255,255,.55);}
.footer a{color:rgba(255,255,255,.5);text-decoration:none;transition:color .2s;}
.footer a:hover{color:#fff;}
.footer hr{border-color:rgba(255,255,255,.1);}
.footer .small{color:rgba(255,255,255,.35);font-size:12px;}
</style>
</head>
<body>
