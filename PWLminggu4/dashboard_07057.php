<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login_07057.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Aplikasi Saya</a>
      <div class="d-flex">
        <span class="navbar-text me-3">
          <i class="fa fa-user me-1"></i><?= htmlspecialchars($_SESSION['username']) ?>
        </span>
        <a class="btn btn-outline-light" href="logout_07057.php">
          <i class="fa fa-sign-out-alt me-1"></i>Logout
        </a>
      </div>
    </div>
  </nav>
  <div class="container mt-4">
    <h2>Selamat datang di Dashboard!</h2>
    <p>Anda sudah login sebagai <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>.</p>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
