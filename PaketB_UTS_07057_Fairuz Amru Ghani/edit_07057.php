<?php
include 'config.php';

// 1. Cek keberadaan dan kevalidan parameter id
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Kalau tidak valid, kembalikan ke daftar
    header('Location: tabel_karyawan.php');
    exit();
}
$id = (int) $_GET['id'];

// 2. Ambil data karyawan dari database
$result = $conn->query("SELECT * FROM karyawan WHERE id = $id");
if (!$result || $result->num_rows === 0) {
    // Kalau id tidak ditemukan, kembali ke daftar
    header('Location: tabel_karyawan.php');
    exit();
}
$data = $result->fetch_assoc();

// 3. Proses form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama          = $conn->real_escape_string($_POST['nama']);
    $kelamin       = $conn->real_escape_string($_POST['kelamin']);
    $tanggal_lahir = $conn->real_escape_string($_POST['tanggal_lahir']);
    $email         = $conn->real_escape_string($_POST['email']);
    $telephone     = $conn->real_escape_string($_POST['telephone']);

    $sql = "
      UPDATE karyawan
      SET 
        nama          = '$nama',
        kelamin       = '$kelamin',
        tanggal_lahir = '$tanggal_lahir',
        email         = '$email',
        telephone     = '$telephone'
      WHERE id = $id
    ";
    $conn->query($sql);

    header("Location: tabel_karyawan.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Karyawan</title>
  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-4">
    <h2>Edit Karyawan</h2>
    <form method="post">
      <div class="mb-3">
        <label class="form-label">Nama</label>
        <input 
          type="text" 
          name="nama" 
          class="form-control" 
          value="<?= htmlspecialchars($data['nama']) ?>" 
          required>
      </div>
      <div class="mb-3">
        <label class="form-label">Kelamin</label>
        <select name="kelamin" class="form-select" required>
          <option value="Laki-laki"  
            <?= $data['kelamin']==='Laki-laki'  ? 'selected' : '' ?>>
            Laki-laki
          </option>
          <option value="Perempuan" 
            <?= $data['kelamin']==='Perempuan' ? 'selected' : '' ?>>
            Perempuan
          </option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Tanggal Lahir</label>
        <input 
          type="date" 
          name="tanggal_lahir" 
          class="form-control" 
          value="<?= $data['tanggal_lahir'] ?>" 
          required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input 
          type="email" 
          name="email" 
          class="form-control" 
          value="<?= htmlspecialchars($data['email']) ?>" 
          required>
      </div>
      <div class="mb-3">
        <label class="form-label">Telephone</label>
        <input 
          type="text" 
          name="telephone" 
          class="form-control" 
          value="<?= htmlspecialchars($data['telephone']) ?>" 
          required>
      </div>
      <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-1"></i>Update
      </button>
      <a href="tabel_karyawan.php" class="btn btn-secondary ms-2">
        <i class="fas fa-arrow-left me-1"></i>Kembali
      </a>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
