<?php
session_start();
require "db.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit;
}

$id = $_GET['id'] ?? 0;

// ambil data shipment
$stmt = $conn->prepare("SELECT resi FROM shipments WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$shipment = $stmt->get_result()->fetch_assoc();

if (!$shipment) die("Data tidak ditemukan");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Update Status Pengiriman</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h4>Update Status – <?= $shipment['resi']; ?></h4>

  <form method="POST" action="status_update_process.php" class="card p-4 mt-3">
    <input type="hidden" name="shipment_id" value="<?= $id; ?>">

    <div class="mb-3">
      <label>Status</label>
      <select name="status" class="form-control" required>
        <option value="">-- pilih --</option>
        <option>Pickup</option>
        <option>Di Gudang Asal</option>
        <option>Transit</option>
        <option>Di Gudang Tujuan</option>
        <option>On Delivery</option>
        <option>Delivered</option>
      </select>
    </div>

    <div class="mb-3">
      <label>Lokasi</label>
      <input type="text" name="lokasi" class="form-control">
    </div>

    <div class="mb-3">
      <label>Catatan</label>
      <textarea name="catatan" class="form-control"></textarea>
    </div>

    <button class="btn btn-danger">Simpan Status</button>
    <a href="pengiriman_index.php" class="btn btn-secondary ms-2">Batal</a>
  </form>
</div>

</body>
</html>
