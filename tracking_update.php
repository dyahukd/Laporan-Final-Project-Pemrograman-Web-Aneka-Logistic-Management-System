<?php
session_start();
require "db.php";

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

if (!isset($_GET['id'])) {
  die("ID pengiriman tidak ditemukan!");
}

$shipment_id = intval($_GET['id']);

if (isset($_POST['simpan'])) {
  $stmt = $conn->prepare(
    "INSERT INTO tracking_pengiriman (shipment_id, status, lokasi, catatan)
     VALUES (?, ?, ?, ?)"
  );
  $stmt->bind_param(
    "isss",
    $shipment_id,
    $_POST['status'],
    $_POST['lokasi'],
    $_POST['catatan']
  );
  $stmt->execute();

  header("Location: pengiriman_index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <title>Update Status Pengiriman</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h3>Update Status Pengiriman</h3>

  <form method="POST" class="card p-4 shadow-sm mt-3">
    <select name="status" class="form-control mb-2" required>
      <option value="Pickup">Pickup</option>
      <option value="Gudang Asal">Gudang Asal</option>
      <option value="Transit">Transit</option>
      <option value="Gudang Tujuan">Gudang Tujuan</option>
      <option value="On Delivery">On Delivery</option>
      <option value="Delivered">Delivered</option>
    </select>

    <input name="lokasi" class="form-control mb-2" placeholder="Lokasi" required>
    <textarea name="catatan" class="form-control mb-3" placeholder="Catatan"></textarea>

    <button name="simpan" class="btn btn-danger">Simpan Status</button>
    <a href="pengiriman_index.php" class="btn btn-secondary ms-2">Batal</a>
  </form>
</div>

</body>
</html>
