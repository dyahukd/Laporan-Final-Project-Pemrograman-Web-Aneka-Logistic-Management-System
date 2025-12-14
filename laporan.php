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
   QUERY LAPORAN HARI INI
====================== */
$query = $conn->query("
    SELECT 
        DATE(created_at) AS tanggal,
        COUNT(*) AS total_pengiriman,
        SUM(CASE WHEN payment_status='PAID' THEN cost ELSE 0 END) AS total_pendapatan
    FROM shipments
    GROUP BY DATE(created_at)
    ORDER BY tanggal DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Pengiriman | Aneka Logistic</title>

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

.card {
  border-radius: 18px;
  border: none;
  box-shadow: 0 14px 35px rgba(0,0,0,.08);
}

.table thead {
  background: var(--primary);
  color: #fff;
}

.badge-income {
  background: var(--secondary);
  color:#000;
  font-weight:600;
}
</style>
</head>

<body>

<div class="container py-5">

  <!-- HEADER -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h3 class="fw-bold mb-1">Laporan Pengiriman</h3>
      <p class="text-muted mb-0">Rekap pengiriman & pendapatan</p>
    </div>

    <a href="dashboard_superadmin.php" class="btn btn-outline-secondary">
      ← Kembali
    </a>
  </div>

  <!-- CARD LAPORAN -->
  <div class="card">
    <div class="card-body p-4">

      <div class="table-responsive">
        <table class="table table-bordered align-middle mb-0">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Total Pengiriman</th>
              <th>Total Pendapatan</th>
            </tr>
          </thead>
          <tbody>

          <?php if ($query->num_rows > 0): ?>
            <?php while ($row = $query->fetch_assoc()): ?>
              <tr>
                <td><?= date('d M Y', strtotime($row['tanggal'])); ?></td>
                <td>
                  <span class="badge bg-primary">
                    <?= $row['total_pengiriman']; ?> Pengiriman
                  </span>
                </td>
                <td>
                  <span class="badge badge-income">
                    Rp <?= number_format($row['total_pendapatan'],0,',','.'); ?>
                  </span>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="3" class="text-center text-muted">
                Belum ada data laporan
              </td>
            </tr>
          <?php endif; ?>

          </tbody>
        </table>
      </div>

    </div>
  </div>

</div>

</body>
</html>
