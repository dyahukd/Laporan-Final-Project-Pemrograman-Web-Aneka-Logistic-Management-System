<?php
session_start();
require "db.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'superadmin') {
  header("Location: login.php"); exit;
}

if (isset($_POST['simpan'])) {
  $asal = $_POST['kota_asal'];
  $tujuan = $_POST['kota_tujuan'];
  $wilayah = $_POST['wilayah'];

  $stmt = $conn->prepare(
    "INSERT INTO rute (kota_asal, kota_tujuan, wilayah)
     VALUES (?,?,?)"
  );
  $stmt->bind_param("sss",$asal,$tujuan,$wilayah);
  $stmt->execute();

  header("Location: rute_index.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Tambah Rute</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
<h3>Tambah Rute</h3>

<form method="POST" class="card p-4 shadow-sm mt-3">
<input name="kota_asal" class="form-control mb-2" placeholder="Kota Asal" required>
<input name="kota_tujuan" class="form-control mb-2" placeholder="Kota Tujuan" required>

<select name="wilayah" class="form-control mb-3" required>
  <option value="">-- Pilih Wilayah --</option>
  <option>Jawa</option>
  <option>Bali</option>
  <option>Kalimantan</option>
</select>

<button name="simpan" class="btn btn-danger">Simpan</button>
<a href="rute_index.php" class="btn btn-secondary ms-2">Batal</a>
</form>

</div>
</body>
</html>
