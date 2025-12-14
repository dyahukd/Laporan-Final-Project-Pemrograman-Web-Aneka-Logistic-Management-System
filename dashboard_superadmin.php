<?php
session_start();
require "db.php";

/* ======================
   CEK LOGIN SUPER ADMIN
====================== */
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'superadmin') {
    header("Location: login.php");
    exit;
}

/* ======================
   QUERY DASHBOARD
====================== */
$total_users = $conn->query("SELECT COUNT(*) total FROM users")->fetch_assoc()['total'];
$total_shipments = $conn->query("SELECT COUNT(*) total FROM shipments")->fetch_assoc()['total'];
$unpaid = $conn->query("SELECT COUNT(*) total FROM shipments WHERE payment_status='UNPAID'")->fetch_assoc()['total'];
$total_income = $conn->query("
    SELECT IFNULL(SUM(cost),0) total 
    FROM shipments 
    WHERE payment_status='PAID'
")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Super Admin | Aneka Logistic</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
:root {
  --primary:#b82025;
  --secondary:#f4c430;
  --bg:#f5f6fa;
}

body {
  background: var(--bg);
  font-family: 'Poppins', sans-serif;
}

/* ===== SIDEBAR ===== */
.sidebar {
  width:260px;
  min-height:100vh;
  background:var(--primary);
}

.sidebar a {
  display:block;
  padding:13px 22px;
  color:#fff;
  text-decoration:none;
  font-weight:500;
  border-left:4px solid transparent;
}

.sidebar a:hover {
  background:rgba(255,255,255,.15);
  border-left:4px solid var(--secondary);
}

/* ===== STAT CARD ===== */
.stat-card {
  background:#fff;
  border-radius:22px;
  padding:26px 28px;
  box-shadow:0 14px 35px rgba(0,0,0,.08);
  position:relative;
  transition:.25s;
}

.stat-card::before {
  content:'';
  position:absolute;
  top:0; left:0;
  width:100%; height:6px;
  background:var(--primary);
}

.stat-card.yellow::before { background:var(--secondary); }
.stat-card.green::before { background:#2ecc71; }
.stat-card.blue::before { background:#3498db; }

.stat-card:hover {
  transform:translateY(-6px);
  box-shadow:0 20px 45px rgba(0,0,0,.12);
}

.stat-label {
  font-size:14px;
  color:#777;
  font-weight:500;
}

.stat-value {
  font-size:36px;
  font-weight:700;
  color:var(--primary);
  margin-top:8px;
}
</style>
</head>

<body>

<div class="d-flex">

<!-- SIDEBAR -->
<div class="sidebar">
  <div class="text-center py-4">
    <img src="logo.png" height="42" class="mb-2">
    <h6 class="text-white fw-bold mb-0">Super Admin</h6>
  </div>

  <a href="dashboard_superadmin.php">Dashboard</a>
  <a href="user_index.php">Data User</a>
  <a href="rute_index.php">Data Rute</a>
  <a href="tarif_index.php">Data Tarif</a>
  <a href="pengiriman_index.php">Data Pengiriman</a>
  <a href="laporan.php">Laporan</a>
  <a href="logout.php">Logout</a>
</div>

<!-- CONTENT -->
<div class="flex-fill p-4">

  <h3 class="fw-bold mb-1">Dashboard Super Admin</h3>
  <p class="text-muted">
    Selamat datang kembali, <strong><?= htmlspecialchars($_SESSION['name']); ?></strong>
  </p>

  <div class="row g-4 mt-4">

    <div class="col-md-3">
      <div class="stat-card">
        <div class="stat-label">Total User</div>
        <div class="stat-value"><?= $total_users; ?></div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="stat-card yellow">
        <div class="stat-label">Total Pengiriman</div>
        <div class="stat-value"><?= $total_shipments; ?></div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="stat-card green">
        <div class="stat-label">Belum Dibayar</div>
        <div class="stat-value"><?= $unpaid; ?></div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="stat-card blue">
        <div class="stat-label">Total Pendapatan</div>
        <div class="stat-value">
          Rp <?= number_format($total_income,0,',','.'); ?>
        </div>
      </div>
    </div>

  </div>

</div>
</div>

</body>
</html>
