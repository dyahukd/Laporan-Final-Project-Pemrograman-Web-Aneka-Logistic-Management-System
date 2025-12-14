<?php
session_start();
require "db.php";

/* ======================
   CEK LOGIN ADMIN
====================== */
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

/* ======================
   QUERY DASHBOARD
====================== */

// Pengiriman hari ini
$q_today = $conn->query("
    SELECT COUNT(*) AS total
    FROM shipments
    WHERE DATE(created_at) = CURDATE()
");
$today = $q_today ? (int)$q_today->fetch_assoc()['total'] : 0;

// Belum dibayar
$q_unpaid = $conn->query("
    SELECT COUNT(*) AS total
    FROM shipments
    WHERE payment_status = 'UNPAID'
");
$unpaid = $q_unpaid ? (int)$q_unpaid->fetch_assoc()['total'] : 0;

// Delivered (DIANGGAP = SUDAH BAYAR)
$q_delivered = $conn->query("
    SELECT COUNT(*) AS total
    FROM shipments
    WHERE payment_status = 'PAID'
");
$delivered = $q_delivered ? (int)$q_delivered->fetch_assoc()['total'] : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin | Aneka Logistic</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
:root{
  --primary:#b82025;
  --secondary:#f4c430;
  --bg:#f5f6fa;
}
body{
  background:var(--bg);
  font-family:'Poppins',sans-serif;
}

/* SIDEBAR */
.sidebar{
  width:240px;
  min-height:100vh;
  background:var(--primary);
}
.sidebar h5{
  font-weight:700;
}
.sidebar a{
  display:block;
  padding:13px 20px;
  color:#fff;
  text-decoration:none;
  font-weight:500;
}
.sidebar a:hover{
  background:#9f1b20;
}

/* CARD */
.stat-card{
  background:#fff;
  border-radius:18px;
  padding:26px;
  box-shadow:0 14px 35px rgba(0,0,0,.08);
  position:relative;
}
.stat-card::before{
  content:'';
  position:absolute;
  top:0; left:0;
  width:100%; height:6px;
  background:var(--primary);
}
.stat-card.yellow::before{ background:var(--secondary); }
.stat-card.green::before{ background:#2ecc71; }

.stat-title{
  font-size:14px;
  color:#777;
}
.stat-value{
  font-size:34px;
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
  <h5 class="text-white text-center py-4">Admin Panel</h5>
  <a href="dashboard_admin.php">Dashboard</a>
  <a href="pengiriman_create.php">Input Pengiriman</a>
  <a href="pengiriman_index.php">Data Pengiriman</a>
  <a href="logout.php">Logout</a>
</div>

<!-- CONTENT -->
<div class="flex-fill p-4">

  <h3 class="fw-bold mb-1">Dashboard Admin</h3>
  <p class="text-muted">
    Selamat datang, <strong><?= htmlspecialchars($_SESSION['name']); ?></strong>
  </p>

  <div class="row g-4 mt-4">

    <!-- Pengiriman Hari Ini -->
    <div class="col-md-4">
      <div class="stat-card">
        <div class="stat-title">Pengiriman Hari Ini</div>
        <div class="stat-value"><?= $today; ?></div>
      </div>
    </div>

    <!-- Belum Dibayar -->
    <div class="col-md-4">
      <div class="stat-card yellow">
        <div class="stat-title">Belum Dibayar</div>
        <div class="stat-value"><?= $unpaid; ?></div>
      </div>
    </div>

    <!-- Delivered -->
    <div class="col-md-4">
      <div class="stat-card green">
        <div class="stat-title">Delivered</div>
        <div class="stat-value"><?= $delivered; ?></div>
      </div>
    </div>

  </div>

</div>
</div>

</body>
</html>
