<?php
session_start();
require "db.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'superadmin') {
  header("Location: login.php"); exit;
}

$id = (int)($_GET['id'] ?? 0);

$stmt = $conn->prepare("SELECT * FROM tarif WHERE id=? LIMIT 1");
$stmt->bind_param("i",$id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
if (!$data) die("Data tarif tidak ditemukan.");

$rutes = $conn->query("SELECT id, kota_asal, kota_tujuan, wilayah FROM rute ORDER BY id DESC");

if (isset($_POST['update'])) {
  $rute_id = (int)$_POST['rute_id'];
  $tarif_per_kg = (float)$_POST['tarif_per_kg'];
  $minimal_kg = (float)$_POST['minimal_kg'];
  $estimasi_hari = trim($_POST['estimasi_hari']);

  $stmt = $conn->prepare("UPDATE tarif SET rute_id=?, tarif_per_kg=?, minimal_kg=?, estimasi_hari=? WHERE id=?");
  $stmt->bind_param("iddsi", $rute_id, $tarif_per_kg, $minimal_kg, $estimasi_hari, $id);
  $stmt->execute();

  header("Location: tarif_index.php?msg=success");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Tarif</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3>Edit Tarif</h3>

  <form method="POST" class="card p-4 shadow-sm mt-3">
    <label class="form-label">Pilih Rute</label>
    <select name="rute_id" class="form-control mb-3" required>
      <?php while($r=$rutes->fetch_assoc()): ?>
        <option value="<?= $r['id']; ?>" <?= ($r['id']==$data['rute_id'])?'selected':''; ?>>
          <?= htmlspecialchars($r['kota_asal']); ?> → <?= htmlspecialchars($r['kota_tujuan']); ?>
          (<?= htmlspecialchars($r['wilayah']); ?>)
        </option>
      <?php endwhile; ?>
    </select>

    <label class="form-label">Tarif per Kg</label>
    <input type="number" name="tarif_per_kg" class="form-control mb-3"
           value="<?= htmlspecialchars($data['tarif_per_kg']); ?>" required>

    <label class="form-label">Minimal Kg</label>
    <input type="number" step="0.01" name="minimal_kg" class="form-control mb-3"
           value="<?= htmlspecialchars($data['minimal_kg']); ?>" required>

    <label class="form-label">Estimasi Hari</label>
    <input type="text" name="estimasi_hari" class="form-control mb-3"
           value="<?= htmlspecialchars($data['estimasi_hari']); ?>" required>

    <button name="update" class="btn btn-warning">Update</button>
    <a href="tarif_index.php" class="btn btn-secondary ms-2">Batal</a>
  </form>
</div>
</body>
</html>
