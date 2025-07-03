<?php
session_start();

// Data produk sama seperti index
$products = [
    1 => ['name' => 'Kaos Polos',  'price' => 120000, 'weight' => 200],
    2 => ['name' => 'Celana Jeans','price' => 220000, 'weight' => 500],
    3 => ['name' => 'Topi Keren', 'price' =>  80000, 'weight' => 150],
];

// Inisialisasi keranjang
$cart = &$_SESSION['cart'];
if (!isset($cart)) {
    $cart = [];
}

// Proses add/remove
if (isset($_GET['action'])) {
    $id = (int)$_GET['id'];
    if ($_GET['action'] === 'add') {
        $cart[$id] = ($cart[$id] ?? 0) + 1;
    } elseif ($_GET['action'] === 'remove') {
        unset($cart[$id]);
    }
    header('Location: cart_07057.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang Belanja</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Keranjang Belanja</h1>
    <?php if (empty($cart)): ?>
      <p>Keranjang Anda kosong. <a href="index_07057.php">Kembali belanja</a>.</p>
    <?php else: ?>
      <table class="table table-bordered">
        <thead>
          <tr><th>Produk</th><th>Qty</th><th>Subtotal</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        <?php
        $total = 0;
        $totalWeight = 0;
        foreach ($cart as $id => $qty) {
            $p = $products[$id];
            $subtotal = $p['price'] * $qty;
            $weight = $p['weight'] * $qty;
            $total += $subtotal;
            $totalWeight += $weight;
        ?>
          <tr>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= $qty ?></td>
            <td>Rp <?= number_format($subtotal,0,',','.') ?></td>
            <td><a href="cart_07057.php?action=remove&id=<?= $id ?>" class="btn btn-danger btn-sm">Hapus</a></td>
          </tr>
        <?php } ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="2">Total</th>
            <th>Rp <?= number_format($total,0,',','.') ?></th>
            <th></th>
          </tr>
        </tfoot>
      </table>
      <?php
        // Simpan info order untuk checkout
        $_SESSION['order_total']  = $total;
        $_SESSION['order_weight'] = $totalWeight;
      ?>
      <a href="views/order_form_07057.php" class="btn btn-primary">Checkout & Bayar</a>
    <?php endif; ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
