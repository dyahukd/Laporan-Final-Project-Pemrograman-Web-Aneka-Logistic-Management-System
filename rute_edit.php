<?php
session_start();
require "db.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'superadmin') {
  header("Location: login.php"); exit;
}

$id = $_GET['id'];
$rute = $conn->query("SELECT * FROM rute WHERE id=$id")->fetch_assoc();

if (isset($_POST['update'])) {
  $stmt = $conn->prepare(
    "UPDATE rute SET kota_asal=?, kota_tujuan=?, wilayah=? WHERE id=?"
  );
  $stmt->bind_param("sssi",
    $_POST['kota_asal'],
    $_POST['kota_tujuan'],
    $_POST['wilayah'],
    $id
  );
  $stmt->execute();

  header("Location: rute_index.php"); exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Rute</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
<h3>Edit Rute</h3>

<form method="POST" class="card p-4 shadow-sm mt-3">
<input name="kota_asal" class="form-control mb-2"
 value="<?= $rute['kota_asal']; ?>" required>
<input name="kota_tujuan" class="form-control mb-2"
 value="<?= $rute['kota_tujuan']; ?>" required>

<select name="wilayah" class="form-control mb-3">
  <?php foreach(['Jawa','Bali','Kalimantan'] as $w): ?>
    <option <?= $rute['wilayah']==$w?'selected':''; ?>><?= $w; ?></option>
  <?php endforeach; ?>
</select>

<button name="update" class="btn btn-danger">Update</button>
<a href="rute_index.php" class="btn btn-secondary ms-2">Batal</a>
</form>

</div>
</body>
</html>
