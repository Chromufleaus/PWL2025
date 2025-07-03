<?php
require 'koneksi_07057.php';

// Jika sudah login, arahkan ke dashboard
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard_07057.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "INSERT INTO users (username, password) VALUES (?, ?)"
    );
    $stmt->bind_param('ss', $username, $password);
    if ($stmt->execute()) {
        header('Location: login_07057.php?registered=1');
        exit;
    } else {
        $error = 'Gagal mendaftar: ' . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrasi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="css/styleku.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5" style="max-width: 400px;">
    <h2 class="mb-4 text-center"><i class="fa fa-user-plus me-2"></i>Daftar Akun</h2>
    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-success w-100">
        <i class="fa fa-user-plus me-1"></i>Daftar
      </button>
      <p class="mt-3 text-center">
        Sudah punya akun? <a href="login_07057.php">Login di sini</a>
      </p>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>