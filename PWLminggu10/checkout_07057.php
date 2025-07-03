<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Checkout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script>
</head>
<body class="p-4">
  <div class="container text-center" style="max-width:400px;">
    <h2 class="mb-4"><i class="fa fa-credit-card me-2"></i>Checkout</h2>
    <button id="pay-button" class="btn btn-success">
      <i class="fa fa-wallet me-1"></i>Bayar Sekarang
    </button>
  </div>

  <script>
    document.getElementById('pay-button').onclick = function () {
      fetch('../charge_07057.php', { method: 'POST' })
        .then(r => r.json())
        .then(data => {
          window.snap.pay(data.token);
        });
    };
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

