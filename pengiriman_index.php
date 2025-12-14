<?php
session_start();
require "db.php";

/* ======================
   CEK LOGIN ADMIN
====================== */
if (
    !isset($_SESSION['login']) ||
    !in_array($_SESSION['role'], ['admin', 'superadmin'])
) {
    header("Location: login.php");
    exit;
}

/* ======================
   AMBIL DATA PENGIRIMAN
====================== */
$result = $conn->query("SELECT * FROM shipments ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Pengiriman</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Data Pengiriman</h3>
  <a href="pengiriman_create.php" class="btn btn-danger">
    + Input Pengiriman
  </a>
  <a href="status_update.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">
  Update Status
</a>

</div>

<?php if (isset($_GET['status']) && $_GET['status']==='success'): ?>
  <div class="alert alert-success">
    Data pengiriman berhasil disimpan.
  </div>
<?php endif; ?>

<!-- TABLE -->
<div class="card shadow-sm">
<div class="table-responsive">
<table class="table table-bordered table-striped mb-0">
<thead class="table-light">
<tr>
  <th>No</th>
  <th>Resi</th>
  <th>Pengirim</th>
  <th>Penerima</th>
  <th>Asal</th>
  <th>Tujuan</th>
  <th>Berat</th>
  <th>Biaya</th>
  <th>Status Bayar</th>
  <th>Aksi</th>
  <th>Tanggal</th>
</tr>
</thead>
<tbody>

<?php if ($result && $result->num_rows > 0): ?>
<?php $no=1; ?>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
  <td><?= $no++; ?></td>
  <td><?= htmlspecialchars($row['resi']); ?></td>

  <td>
    <?= htmlspecialchars($row['sender_name']); ?><br>
    <small><?= htmlspecialchars($row['sender_phone']); ?></small>
  </td>

  <td>
    <?= htmlspecialchars($row['receiver_name']); ?><br>
    <small><?= htmlspecialchars($row['receiver_phone']); ?></small>
  </td>

  <td><?= htmlspecialchars($row['origin']); ?></td>
  <td><?= htmlspecialchars($row['destination']); ?></td>
  <td><?= number_format($row['weight'],2); ?></td>
  <td>Rp <?= number_format($row['cost'],0,',','.'); ?></td>

  <td class="text-center">
    <?php if ($row['payment_status']==='UNPAID'): ?>
      <span class="badge bg-danger">UNPAID</span>
    <?php else: ?>
      <span class="badge bg-success">PAID</span>
    <?php endif; ?>
  </td>

  <!-- AKSI -->
  <td class="text-center">
    <a href="pengiriman_detail.php?id=<?= $row['id']; ?>"
       class="btn btn-info btn-sm mb-1">
       Update Status
    </a>

    <?php if ($row['payment_status']==='UNPAID'): ?>
      <a href="tagihan_kirim.php?id=<?= $row['id']; ?>"
         class="btn btn-warning btn-sm">
         Tagihan
      </a>
    <?php endif; ?>
  </td>

  <td><?= $row['created_at']; ?></td>
</tr>
<?php endwhile; ?>
<?php else: ?>
<tr>
  <td colspan="11" class="text-center text-muted">
    Belum ada data pengiriman.
  </td>
</tr>
<?php endif; ?>

</tbody>
</table>
</div>
</div>

<!-- BACK -->
<a href="<?= $_SESSION['role']==='superadmin'
  ? 'dashboard_superadmin.php'
  : 'dashboard_admin.php'; ?>"
  class="btn btn-secondary mt-3">
← Kembali ke Dashboard
</a>

</div>
</body>
</html>
