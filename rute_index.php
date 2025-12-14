<?php
session_start();
require "db.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'superadmin') {
  header("Location: login.php");
  exit;
}

$rutes = $conn->query("SELECT * FROM rute ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Rute</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">

<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Data Rute</h3>
  <a href="rute_create.php" class="btn btn-danger">+ Tambah Rute</a>
</div>

<div class="card shadow-sm">
  <div class="table-responsive">
    <table class="table table-bordered mb-0">
      <thead class="table-light">
        <tr>
          <th>No</th>
          <th>Kota Asal</th>
          <th>Kota Tujuan</th>
          <th>Wilayah</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>

      <?php if ($rutes->num_rows > 0): $no=1; ?>
        <?php while($r = $rutes->fetch_assoc()): ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= htmlspecialchars($r['kota_asal']); ?></td>
          <td><?= htmlspecialchars($r['kota_tujuan']); ?></td>
          <td><?= htmlspecialchars($r['wilayah']); ?></td>
          <td>
            <a href="rute_edit.php?id=<?= $r['id']; ?>"
               class="btn btn-sm btn-warning">Edit</a>
            <a href="rute_delete.php?id=<?= $r['id']; ?>"
               onclick="return confirm('Hapus rute ini?')"
               class="btn btn-sm btn-danger">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="5" class="text-center text-muted">
            Belum ada data rute
          </td>
        </tr>
      <?php endif; ?>

      </tbody>
    </table>
  </div>
</div>

<a href="dashboard_superadmin.php" class="btn btn-secondary mt-3">
  ← Kembali ke Dashboard
</a>

</div>
</body>
</html>
