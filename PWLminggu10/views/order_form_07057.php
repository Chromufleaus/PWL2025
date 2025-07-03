<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Checkout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h1>Form Checkout</h1>
  <form id="order-form" action="../charge_07057.php" method="post">
    <div class="mb-3">
      <label for="customer_name" class="form-label">Nama Anda</label>
      <input type="text" class="form-control" id="customer_name" name="customer_name" required>
    </div>
    <div class="mb-3">
      <label for="phone" class="form-label">No. Telepon</label>
      <input type="text" class="form-control" id="phone" name="phone" required>
    </div>
    <div class="mb-3">
      <label for="provinsi" class="form-label">Provinsi</label>
      <select id="provinsi" name="provinsi" class="form-select" required></select>
    </div>
    <div class="mb-3">
      <label for="kota" class="form-label">Kota</label>
      <select id="kota" name="kota" class="form-select" required></select>
    </div>
    <div class="mb-3">
      <p>Total Harga: <strong>Rp <?= number_format($_SESSION['order_total'],0,',','.') ?></strong></p>
      <p>Total Berat: <strong><?= $_SESSION['order_weight'] ?> gr</strong></p>
      <input type="hidden" name="gross_amount" value="<?= $_SESSION['order_total'] ?>">
      <input type="hidden" name="order_weight" value="<?= $_SESSION['order_weight'] ?>">
    </div>
    <button type="submit" class="btn btn-success">Bayar Sekarang</button>
  </form>
</div>
<script>
// Load provinsi
fetch("../api/get_provinces_07057.php")
  .then(res => res.json())
  .then(data => data.rajaongkir.results.forEach(p => {
    const o = document.createElement("option");
    o.value = p.province_id;
    o.textContent = p.province;
    document.getElementById("provinsi").appendChild(o);
  }));
// Load kota on change
document.getElementById("provinsi").addEventListener("change", e => {
  fetch(`../api/get_cities_07057.php?province_id=${e.target.value}`)
    .then(res => res.json())
    .then(data => {
      const kota = document.getElementById("kota"); kota.innerHTML = '';
      data.rajaongkir.results.forEach(c => {
        const o = document.createElement("option");
        o.value = c.city_id;
        o.textContent = c.city_name;
        kota.appendChild(o);
      });
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>