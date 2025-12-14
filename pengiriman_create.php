<?php
session_start();
require "db.php";

/* ======================
   CEK LOGIN
====================== */
if (!isset($_SESSION['login']) || !in_array($_SESSION['role'], ['admin','superadmin'])) {
  header("Location: login.php");
  exit;
}

/* ======================
   AMBIL RUTE + TARIF
====================== */
$rutes = $conn->query("
  SELECT 
    t.id AS tarif_id,
    r.kota_asal,
    r.kota_tujuan,
    r.wilayah,
    t.tarif_per_kg,
    t.minimal_kg,
    t.estimasi_hari
  FROM tarif t
  JOIN rute r ON t.rute_id = r.id
  ORDER BY r.kota_asal, r.kota_tujuan
");

/* ======================
   SIMPAN PENGIRIMAN
====================== */
if (isset($_POST['simpan'])) {

  $sender_name     = $_POST['sender_name'];
  $sender_phone    = $_POST['sender_phone'];
  $receiver_name   = $_POST['receiver_name'];
  $receiver_phone  = $_POST['receiver_phone'];
  $tarif_id        = (int)$_POST['tarif_id'];
  $weight          = (float)$_POST['weight'];

  /* Ambil data tarif */
  $stmt = $conn->prepare("
    SELECT 
      r.kota_asal,
      r.kota_tujuan,
      t.tarif_per_kg,
      t.minimal_kg
    FROM tarif t
    JOIN rute r ON t.rute_id = r.id
    WHERE t.id = ?
    LIMIT 1
  ");
  $stmt->bind_param("i", $tarif_id);
  $stmt->execute();
  $tarif = $stmt->get_result()->fetch_assoc();

  if (!$tarif) {
    die("Tarif tidak ditemukan");
  }

  /* Hitung biaya */
  $berat_pakai = max($weight, $tarif['minimal_kg']);
  $cost = $berat_pakai * $tarif['tarif_per_kg'];

  /* Generate RESI MPI (unik) */
  do {
    $resi = "MPI-" . date('Ymd') . "-" . rand(100000,999999);
    $cek = $conn->query("SELECT id FROM shipments WHERE resi='$resi'");
  } while ($cek->num_rows > 0);

  /* Simpan ke tabel shipments */
  $stmt = $conn->prepare("
    INSERT INTO shipments
    (
      resi,
      sender_name,
      sender_phone,
      receiver_name,
      receiver_phone,
      origin,
      destination,
      weight,
      cost,
      payment_status,
      created_at
    )
    VALUES (?,?,?,?,?,?,?,?,?,'UNPAID',NOW())
  ");

  $stmt->bind_param(
    "sssssssdd",
    $resi,
    $sender_name,
    $sender_phone,
    $receiver_name,
    $receiver_phone,
    $tarif['kota_asal'],
    $tarif['kota_tujuan'],
    $weight,
    $cost
  );

  $stmt->execute();

  header("Location: pengiriman_index.php?status=success");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Input Pengiriman | Aneka Logistic</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<script>
function hitungBiaya() {
  const select = document.getElementById('tarif_id');
  const berat  = parseFloat(document.getElementById('weight').value) || 0;
  if (!select.value) return;

  const tarif   = parseFloat(select.selectedOptions[0].dataset.tarif);
  const minimal = parseFloat(select.selectedOptions[0].dataset.minimal);

  const pakai = Math.max(berat, minimal);
  const total = pakai * tarif;

  document.getElementById('cost').value =
    total.toLocaleString('id-ID');
}
</script>
</head>

<body class="bg-light">

<div class="container mt-5">
  <h3 class="fw-bold">Input Pengiriman</h3>

  <form method="POST" class="card p-4 shadow-sm mt-3">

    <h5 class="mb-2">Data Pengirim</h5>
    <input name="sender_name" class="form-control mb-2" placeholder="Nama Pengirim" required>
    <input name="sender_phone" class="form-control mb-3" placeholder="No HP Pengirim" required>

    <h5 class="mb-2">Data Penerima</h5>
    <input name="receiver_name" class="form-control mb-2" placeholder="Nama Penerima" required>
    <input name="receiver_phone" class="form-control mb-3" placeholder="No HP Penerima" required>

    <h5 class="mb-2">Rute & Tarif</h5>
    <select name="tarif_id" id="tarif_id"
            class="form-control mb-2"
            onchange="hitungBiaya()" required>
      <option value="">-- Pilih Rute --</option>
      <?php while ($r = $rutes->fetch_assoc()): ?>
        <option value="<?= $r['tarif_id']; ?>"
          data-tarif="<?= $r['tarif_per_kg']; ?>"
          data-minimal="<?= $r['minimal_kg']; ?>">
          <?= $r['kota_asal']; ?> → <?= $r['kota_tujuan']; ?>
          (<?= $r['wilayah']; ?> | <?= $r['estimasi_hari']; ?> hari)
        </option>
      <?php endwhile; ?>
    </select>

    <label>Berat (kg)</label>
    <input type="number" step="0.01"
           id="weight" name="weight"
           class="form-control mb-2"
           oninput="hitungBiaya()" required>

    <label>Total Biaya (Rp)</label>
    <input type="text" id="cost" class="form-control mb-3" readonly>

    <button name="simpan" class="btn btn-danger">
      Simpan Pengiriman
    </button>
    <a href="pengiriman_index.php" class="btn btn-secondary ms-2">
      Batal
    </a>

  </form>
</div>

</body>
</html>
