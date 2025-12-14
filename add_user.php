<?php
include "db.php";

$nama = "Admin Utama";
$email = "admin@aneka.com";
$password = password_hash("123456", PASSWORD_DEFAULT);
$role = "superadmin";

$stmt = $conn->prepare(
  "INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)"
);
$stmt->bind_param("ssss", $nama, $email, $password, $role);
$stmt->execute();

echo "USER BERHASIL DIBUAT";
