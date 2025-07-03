<?php
session_start();

// Daftar produk
$products = [
    1 => ['name' => 'Kaos Polos',  'price' => 120000, 'weight' => 200],
    2 => ['name' => 'Celana Jeans','price' => 220000, 'weight' => 500],
    3 => ['name' => 'Topi Keren', 'price' =>  80000, 'weight' => 150],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Daftar Produk</h1>
    <div class="row">
      <?php foreach ($products as $id => $p): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
            <p class="card-text">Harga: Rp <?= number_format($p['price'],0,',','.') ?></p>
            <p class="card-text">Berat: <?= $p['weight'] ?> gr</p>
            <a href="cart_07057.php?action=add&id=<?= $id ?>" class="btn btn-primary">Tambah ke Keranjang</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <a href="cart_07057.php" class="btn btn-success">Lihat Keranjang</a>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
