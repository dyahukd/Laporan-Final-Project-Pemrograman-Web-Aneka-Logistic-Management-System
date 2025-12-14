<?php
session_start();
require "db.php";

if (!isset($_SESSION['login'])) {
  die("Belum login");
}
if (!in_array($_SESSION['role'], ['admin','superadmin'])) {
  die("Tidak punya akses");
}

if (!isset($_GET['id'])) {
  die("ID pengiriman tidak ada");
}

$shipment_id = (int)$_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Update Status</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
<h4>Update Status Pengiriman</h4>

<div class="card p-3 mb-4">
  <select id="status" class="form-control mb-2">
    <option>Pickup</option>
    <option>Gudang Asal</option>
    <option>Transit</option>
    <option>Gudang Tujuan</option>
    <option>On Delivery</option>
    <option>Delivered</option>
  </select>

  <input id="lokasi" class="form-control mb-2" placeholder="Lokasi">
  <textarea id="keterangan" class="form-control mb-2" placeholder="Catatan"></textarea>

  <button class="btn btn-danger" onclick="updateStatus()">Update Status</button>
</div>

<h5>Timeline</h5>
<div id="timeline"></div>
</div>

<script>
function updateStatus(){
  fetch('status_update.php', {
    method:'POST',
    headers:{'Content-Type':'application/x-www-form-urlencoded'},
    body:
      'shipment_id=<?= $shipment_id ?>' +
      '&status=' + encodeURIComponent(document.getElementById('status').value) +
      '&lokasi=' + encodeURIComponent(document.getElementById('lokasi').value) +
      '&keterangan=' + encodeURIComponent(document.getElementById('keterangan').value)
  }).then(()=>loadTimeline());
}

function loadTimeline(){
  fetch('tracking_timeline.php?id=<?= $shipment_id ?>')
    .then(r=>r.json())
    .then(data=>{
      let html='';
      data.forEach(i=>{
        html+=`
          <div class="card mb-2">
            <div class="card-body">
              <b>${i.status}</b><br>
              <small>${i.lokasi}</small><br>
              <small class="text-muted">${i.created_at}</small>
              <p>${i.keterangan ?? ''}</p>
            </div>
          </div>`;
      });
      document.getElementById('timeline').innerHTML=html;
    });
}
loadTimeline();
</script>

</body>
</html>
