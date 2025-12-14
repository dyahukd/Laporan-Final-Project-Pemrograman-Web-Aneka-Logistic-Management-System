<?php
session_start();
include "db.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit;
}

$id = $_GET['id'] ?? 0;

// ambil data
$stmt = $conn->prepare(
  "SELECT resi, cost, payment_status
   FROM shipments WHERE id=? LIMIT 1"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if (!$data) die("Data tidak ditemukan");

// konfirmasi bayar
if (isset($_POST['konfirmasi'])) {
  $stmt = $conn->prepare(
    "UPDATE shipments 
     SET payment_status='PAID', paid_at=NOW()
     WHERE id=?"
  );
  $stmt->bind_param("i", $id);
  $stmt->execute();

  header("Location: pengiriman_index.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Tagihan Pengiriman</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h3>Tagihan Pengiriman</h3>

  <div class="card p-4 shadow-sm mt-3">
    <p><b>Resi:</b> <?= $data['resi']; ?></p>
    <p><b>Total Biaya:</b> Rp <?= number_format($data['cost'],0,',','.'); ?></p>
    <p><b>Status:</b> <?= $data['payment_status']; ?></p>

    <?php if ($data['payment_status'] == 'UNPAID'): ?>
      <form method="POST">
        <button name="konfirmasi" class="btn btn-success">
          Konfirmasi Pembayaran
        </button>
        <a href="pengiriman_index.php" class="btn btn-secondary ms-2">
          Kembali
        </a>
      </form>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
