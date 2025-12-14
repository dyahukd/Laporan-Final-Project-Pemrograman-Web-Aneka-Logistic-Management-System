<?php
session_start();
require "db.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'superadmin') {
  header("Location: login.php"); exit;
}

$dashboard = 'dashboard_superadmin.php';

$sql = "
  SELECT t.id, t.tarif_per_kg, t.minimal_kg, t.estimasi_hari, t.created_at,
         r.kota_asal, r.kota_tujuan, r.wilayah
  FROM tarif t
  JOIN rute r ON t.rute_id = r.id
  ORDER BY t.id DESC
";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Tarif</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Tarif</h3>
    <a href="tarif_create.php" class="btn btn-danger">+ Tambah Tarif</a>
  </div>

  <?php if (isset($_GET['msg']) && $_GET['msg'] === 'success'): ?>
    <div class="alert alert-success">Berhasil diproses.</div>
  <?php endif; ?>

  <div class="card shadow-sm">
    <div class="table-responsive">
      <table class="table table-bordered table-striped mb-0">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Rute</th>
            <th>Wilayah</th>
            <th>Tarif / Kg</th>
            <th>Minimal Kg</th>
            <th>Estimasi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
          <?php $no=1; while($row=$result->fetch_assoc()): ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= htmlspecialchars($row['kota_asal']); ?> → <?= htmlspecialchars($row['kota_tujuan']); ?></td>
              <td><?= htmlspecialchars($row['wilayah']); ?></td>
              <td>Rp <?= number_format($row['tarif_per_kg'],0,',','.'); ?></td>
              <td><?= number_format($row['minimal_kg'],2); ?></td>
              <td><?= htmlspecialchars($row['estimasi_hari']); ?></td>
              <td class="text-center">
                <a class="btn btn-sm btn-warning" href="tarif_edit.php?id=<?= $row['id']; ?>">Edit</a>
                <a class="btn btn-sm btn-danger"
                   href="tarif_delete.php?id=<?= $row['id']; ?>"
                   onclick="return confirm('Hapus tarif ini?')">Hapus</a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="7" class="text-center text-muted">Belum ada data tarif.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <a href="<?= $dashboard; ?>" class="btn btn-secondary mt-3">← Kembali ke Dashboard</a>

</div>
</body>
</html>
