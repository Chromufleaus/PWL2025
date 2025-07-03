<?php
include "koneksi.php";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        header("Location: login.php?registered=1");
        exit();
    } else {
        $error = "Gagal mendaftar!";
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
    <link rel="stylesheet" href="bootstrap533/css/bootstrap.css">
    <link rel="stylesheet" href="css/styleku.css">
</head>
<body>
    <div class="container mt-5" style="max-width: 500px;">
        <h2 class="mb-4 text-center">Daftar Akun</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
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
            <button type="submit" class="btn btn-success w-100">Daftar</button>
        </form>

        <p class="mt-3 text-center">
            Sudah punya akun? <a href="login.php">Login di sini</a>
        </p>
    </div>

    <script src="bootstrap533/jquery/3.3.1/jquery-3.3.1.js"></script>
    <script src="bootstrap533/js/bootstrap.js"></script>
</body>
</html>
