<?php
session_start();
require "db.php";
if ($_SESSION['role'] !== 'superadmin') exit;

if (isset($_POST['simpan'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $stmt = $conn->prepare(
    "INSERT INTO users (name,email,password,role) VALUES (?,?,?,?)"
  );
  $stmt->bind_param("ssss",$name,$email,$password,$role);
  $stmt->execute();
  header("Location: user_index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Tambah User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
<h3>Tambah User</h3>
<form method="POST" class="card p-4">
<input name="name" class="form-control mb-2" placeholder="Nama" required>
<input name="email" type="email" class="form-control mb-2" placeholder="Email" required>
<select name="role" class="form-control mb-2">
<option value="admin">Admin</option>
<option value="customer">Customer</option>
</select>
<input name="password" type="password" class="form-control mb-3" placeholder="Password" required>
<button name="simpan" class="btn btn-danger">Simpan</button>
</form>
</div>
</body>
</html>
