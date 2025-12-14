<?php
require "db.php";

$resi = $_GET['resi'] ?? '';
$data = null;
$timeline = [];

if ($resi !== '') {

  // Ambil data pengiriman
  $stmt = $conn->prepare("
    SELECT * FROM shipments
    WHERE resi = ?
    LIMIT 1
  ");
  $stmt->bind_param("s", $resi);
  $stmt->execute();
  $data = $stmt->get_result()->fetch_assoc();

  // Ambil timeline status
  if ($data) {
    $stmt2 = $conn->prepare("
      SELECT status, lokasi, catatan, created_at
      FROM tracking_pengiriman
      WHERE shipment_id = ?
      ORDER BY created_at DESC
    ");
    $stmt2->bind_param("i", $data['id']);
    $stmt2->execute();
    $timeline = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC);
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Lacak Pengiriman</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container py-5">

<h3 class="fw-bold mb-4">Lacak Pengiriman</h3>

<form method="GET" class="mb-4">
  <div class="input-group">
    <input type="text" name="resi" class="form-control form-control-lg"
           value="<?= htmlspecialchars($resi); ?>"
           placeholder="Masukkan nomor resi" required>
    <button class="btn btn-danger">Lacak</button>
  </div>
</form>

<?php if ($resi && $data): ?>

<!-- DETAIL -->
<div class="card mb-4">
  <div class="card-body">
    <h5 class="fw-bold mb-3">Detail Pengiriman</h5>
    <table class="table table-sm">
      <tr><td>Resi</td><td><strong><?= $data['resi']; ?></strong></td></tr>
      <tr><td>Pengirim</td><td><?= $data['sender_name']; ?></td></tr>
      <tr><td>Penerima</td><td><?= $data['receiver_name']; ?></td></tr>
      <tr><td>Rute</td><td><?= $data['origin']; ?> → <?= $data['destination']; ?></td></tr>
      <tr><td>Berat</td><td><?= $data['weight']; ?> kg</td></tr>
      <tr><td>Biaya</td><td>Rp <?= number_format($data['cost'],0,',','.'); ?></td></tr>
      <tr>
        <td>Status Pembayaran</td>
        <td>
          <?php if ($data['payment_status'] === 'PAID'): ?>
            <span class="badge bg-success">PAID</span>
          <?php else: ?>
            <span class="badge bg-danger">UNPAID</span>
          <?php endif; ?>
        </td>
      </tr>
    </table>
  </div>
</div>

<!-- STATUS -->
<div id="timelineWrap" class="mt-3"></div>

<script>
function loadTimeline(resi){
  fetch('tracking_timeline.php?resi=' + encodeURIComponent(resi))
    .then(r => r.json())
    .then(data => {
      const wrap = document.getElementById('timelineWrap');

      if(!data || data.length === 0){
        wrap.innerHTML = `
          <div class="alert alert-warning mb-0">
            Belum ada update status pengiriman.
          </div>
        `;
        return;
      }

      let html = '';
      data.forEach(item => {
        html += `
          <div class="card mb-2">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <b>${item.status}</b>
                <small class="text-muted">${item.created_at}</small>
              </div>
              <small>${item.lokasi ?? ''}</small>
              ${item.keterangan ? `<div class="mt-2">${item.keterangan}</div>` : ``}
            </div>
          </div>
        `;
      });

      wrap.innerHTML = html;
    });
}

// ini RESI dari data yang kamu tampilkan di halaman
loadTimeline("<?= htmlspecialchars($shipment['resi']); ?>");
</script>


<?php elseif ($resi): ?>
<div class="alert alert-danger">Resi tidak ditemukan.</div>
<?php endif; ?>

<a href="index.php" class="btn btn-secondary mt-4">← Kembali</a>

</div>
</body>
</html>
