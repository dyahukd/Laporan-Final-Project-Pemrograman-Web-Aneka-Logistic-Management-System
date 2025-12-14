<?php
session_start();
require "db.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit;
}

$shipment_id = $_POST['shipment_id'];
$status      = $_POST['status'];
$lokasi      = $_POST['lokasi'];
$catatan     = $_POST['catatan'];

$stmt = $conn->prepare("
  INSERT INTO tracking_pengiriman
  (shipment_id, status, lokasi, catatan)
  VALUES (?, ?, ?, ?)
");
$stmt->bind_param("isss", $shipment_id, $status, $lokasi, $catatan);
$stmt->execute();

header("Location: pengiriman_index.php");
exit;
