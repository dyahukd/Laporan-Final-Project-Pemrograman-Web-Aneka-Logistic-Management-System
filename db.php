<?php
$conn = new mysqli("localhost", "root", "", "aneka-logistic");

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}
