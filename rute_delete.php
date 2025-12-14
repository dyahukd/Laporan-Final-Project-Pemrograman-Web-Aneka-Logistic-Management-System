<?php
session_start();
require "db.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'superadmin') {
  header("Location: login.php"); exit;
}

$id = $_GET['id'];
$conn->query("DELETE FROM rute WHERE id=$id");

header("Location: rute_index.php");
