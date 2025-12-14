<?php
session_start();
require "db.php";
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'superadmin') {
  header("Location: login.php"); exit;
}
$result = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Data User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
<h3>Data User</h3>
<a href="user_create.php" class="btn btn-danger mb-3">+ Tambah User</a>

<table class="table table-bordered">
<tr>
<th>No</th><th>Nama</th><th>Email</th><th>Role</th>
</tr>
<?php $no=1; while($u=$result->fetch_assoc()): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $u['name'] ?></td>
<td><?= $u['email'] ?></td>
<td><?= $u['role'] ?></td>
</tr>
<?php endwhile; ?>
</table>

<a href="dashboard_superadmin.php" class="btn btn-secondary">← Kembali</a>
</div>
</body>
</html>
