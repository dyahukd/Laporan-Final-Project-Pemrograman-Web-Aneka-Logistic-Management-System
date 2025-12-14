<?php
require "db.php";

header('Content-Type: application/json; charset=utf-8');

$id   = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$resi = isset($_GET['resi']) ? trim($_GET['resi']) : '';

if ($id <= 0 && $resi === '') {
  echo json_encode([]);
  exit;
}

/* kalau dikasih resi, cari shipment_id */
if ($id <= 0 && $resi !== '') {
  $stmt = $conn->prepare("SELECT id FROM shipments WHERE resi = ? LIMIT 1");
  $stmt->bind_param("s", $resi);
  $stmt->execute();
  $row = $stmt->get_result()->fetch_assoc();
  $id = $row ? (int)$row['id'] : 0;
}

if ($id <= 0) {
  echo json_encode([]);
  exit;
}

/* ambil timeline */
$stmt = $conn->prepare("
  SELECT status, lokasi, keterangan, created_at
  FROM shipment_tracking
  WHERE shipment_id = ?
  ORDER BY created_at DESC
");
$stmt->bind_param("i", $id);
$stmt->execute();

$data = [];
$res = $stmt->get_result();
while ($r = $res->fetch_assoc()) {
  $data[] = $r;
}

echo json_encode($data);
