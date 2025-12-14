<?php
session_start();
require "db.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'superadmin') {
  header("Location: login.php"); exit;
}

$id = (int)($_GET['id'] ?? 0);

$stmt = $conn->prepare("DELETE FROM tarif WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();

header("Location: tarif_index.php?msg=success");
exit;
