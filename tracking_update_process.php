<?php
session_start();
require "db.php";

/* ======================
   CEK LOGIN
====================== */
if (
    !isset($_SESSION['login']) ||
    !in_array($_SESSION['role'], ['admin','superadmin'])
) {
    header("Location: login.php");
    exit;
}

/* ======================
   VALIDASI INPUT
====================== */
if (
    !isset($_POST['shipment_id'], $_POST['status'], $_POST['lokasi'])
) {
    die("Data tidak lengkap");
}

$shipment_id = (int)$_POST['shipment_id'];
$status      = trim($_POST['status']);
$lokasi      = trim($_POST['lokasi']);
$keterangan  = trim($_POST['keterangan'] ?? '');

/* ======================
   SIMPAN KE TIMELINE
====================== */
$stmt = $conn->prepare("
    INSERT INTO shipment_tracking
    (shipment_id, status, lokasi, keterangan)
    VALUES (?,?,?,?)
");

$stmt->bind_param(
    "isss",
    $shipment_id,
    $status,
    $lokasi,
    $keterangan
);

$stmt->execute();

/* ======================
   OPTIONAL: UPDATE STATUS TERAKHIR
====================== */
// kalau kamu mau simpan status terakhir di shipments (opsional)
$conn->query("
    UPDATE shipments
    SET updated_at = NOW()
    WHERE id = $shipment_id
");

/* ======================
   KEMBALI KE DETAIL
====================== */
header("Location: pengiriman_detail.php?id=".$shipment_id);
exit;
